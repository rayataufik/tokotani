<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Store;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug, Request $request)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        // Retrieve the currently logged-in user
        $user = Auth::user();

        $quantity = $request->query('quantity', 1);
        $total = $request->query('total', $product->harga);
        $berat = $request->query('berat');

        return view('pages.transaction', compact('product', 'quantity', 'total', 'user', 'berat'));
    }

    public function process(Request $request)
    {
        try {
            // Check if the user is authenticated
            if (!Auth::check()) {
                return redirect()->back()->with('error', 'User not authenticated.');
            }

            // Retrieve the authenticated user
            $user = Auth::user();

            // Check if the user has an ID
            if (!$user->id) {
                return redirect()->back()->with('error', 'User ID not found.');
            }

            // Retrieve values from the request
            $product_id = $request->input('product_id');
            $quantity = $request->input('quantity');
            $berat = $request->input('berat');
            $sicepat = $request->input('sicepat');
            $metode_pembayaran = $request->input('metode_pembayaran');

            // Retrieve product price based on product_id
            $product = Product::find($product_id);

            // Check if the product exists
            if (!$product) {
                return redirect()->back()->with('error', 'Product not found.');
            }

            // Calculate total tagihan
            $hargaProduk = $product->harga;
            $totalTagihan = ($hargaProduk * $quantity) + 18000;

            // Generate a unique order ID
            $orderId = Str::uuid()->toString();

            // Perform Midtrans API request
            $url = 'https://api.sandbox.midtrans.com/v2/charge';
            $serverkey = config('midtrans.key');
            $response = Http::withBasicAuth($serverkey, '')
                ->post($url, [
                    "payment_type" => "bank_transfer",
                    "transaction_details" => [
                        "order_id" => $orderId,
                        "gross_amount" => $totalTagihan,
                    ],
                    "bank_transfer" => [
                        "bank" => $metode_pembayaran,
                    ],
                    "customer_details" => [
                        "first_name" => "TKN - ",
                        "last_name" => $user->fullname
                    ],
                ]);

            // Save transaction details to the database
            $midtransResponse = $response->json();
            if (isset($midtransResponse['status_code']) && $midtransResponse['status_code'] === '201') {
                $vaNumber = $midtransResponse['va_numbers'][0]['va_number'];
                $expiryTime = $midtransResponse['expiry_time'];

                $product->stok -= $quantity;
                $product->save();

                $transaction = new Transaction();
                $transaction->user_id = $user->id;
                $transaction->jasa_pengiriman = $sicepat;
                $transaction->total_ongkir = 18000;
                $transaction->status = 'unpaid';
                $transaction->metode_pembayaran = $metode_pembayaran;
                $transaction->total_tagihan = $totalTagihan;
                $transaction->total_harga = $hargaProduk;
                $transaction->midtrans_id = $orderId;
                $transaction->va_number = $vaNumber;
                $transaction->expiry_time = $expiryTime;
                $transaction->save();

                $transaction->product()->attach($product_id, [
                    'quantity' => $quantity
                ]);

                // Redirect or respond as needed
                return redirect('/payment');
            } else {
                // Redirect back with an error message
                return redirect()->back()->with('error', 'Failed to create va_number for this transaction.');
            }
        } catch (\Exception $e) {
            // Handle exceptions, log errors, and return an error response if needed
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function showPayment()
    {
        // Retrieve transaction details from the database
        $transaction = Transaction::where('user_id', auth()->id())->latest()->first();
        // dd($transaction);

        return view('pages.payment', compact('transaction'));
    }


    public function orderList()
    {
        $transactions = Transaction::where('user_id', auth()->id())
            ->with('order.product')
            ->latest()
            ->get();

        return view('pages.orderList', ['transactions' => $transactions]);
    }

    public function batalkanPesananUser($midtrans_id)
    {
        // Temukan transaksi berdasarkan midtrans_id
        $transaction = Transaction::where('midtrans_id', $midtrans_id)->first();

        if ($transaction) {
            // Temukan pesanan terkait dengan transaksi
            $order = Order::where('transaction_id', $transaction->id)->first();

            if ($order) {
                // Ambil product_id dan quantity dari pesanan
                $product_id = $order->product_id;
                $quantity = $order->quantity;

                // Update stok pada tabel product
                $product = Product::find($product_id);

                if ($product) {
                    // Tambahkan quantity kembali ke stok
                    $product->stok += $quantity;
                    $product->save();
                }
                $order->save();
            }
            $transaction->status = 'dibatalkan';
            $transaction->save();
            return redirect()->back()->with('success', 'Pesanan Berhasil Dibatalkan');
        }
    }

    public function updatePesananSelesai($midtrans_id)
    {
        $transaction = Transaction::where("midtrans_id", $midtrans_id)->first();

        if ($transaction) {
            $transaction->update(['status' => 'selesai']);

            return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }
    }

    public function saldoUser()
    {
        $user = Auth::user();

        $saldo = Transaction::where('status', 'dibatalkan')
            ->where('menunggu_pembatalan', 'dibatalkan')
            ->whereNull('cek_is_refund')
            ->where('user_id', $user->id)
            ->sum('total_tagihan');

        // Simpan nilai saldo ke dalam kolom saldo pada model User
        $user->update(['saldo' => $saldo]);

        return view('pages.saldo', compact('saldo', 'user'));
    }




    public function requestBatalkanUser($midtrans_id)
    {
        $transaction = Transaction::where('midtrans_id', $midtrans_id)->first();

        $transaction->menunggu_pembatalan = 'menunggu';
        $transaction->save();
        return redirect()->back()->with('success', 'Menunggu Konfirmasi Penjual');
    }

    public function updateRequestPembatalan($midtrans_id)
    {
        // Temukan transaksi berdasarkan midtrans_id
        $transaction = Transaction::where('midtrans_id', $midtrans_id)->first();

        if ($transaction) {
            // Temukan pesanan terkait dengan transaksi
            $order = Order::where('transaction_id', $transaction->id)->first();

            if ($order) {
                // Ambil product_id dan quantity dari pesanan
                $product_id = $order->product_id;
                $quantity = $order->quantity;

                // Update stok pada tabel product
                $product = Product::find($product_id);

                if ($product) {
                    // Tambahkan quantity kembali ke stok
                    $product->stok += $quantity;
                    $product->save();
                }
                $order->save();
            }
            $transaction->status = 'dibatalkan';
            $transaction->menunggu_pembatalan = 'dibatalkan';
            $transaction->save();
            return redirect()->back()->with('success', 'Pesanan Berhasil Dibatalkan');
        }
    }

    public function saldoSeller()
    {
        $user = Auth::user();
        $store = $user->store;

        $saldo = Transaction::whereHas('order.product.store', function ($query) use ($store) {
            $query->where('id', $store->id);
        })
            ->whereNull('cek_is_refund')
            ->where('status', 'selesai')
            ->sum('total_tagihan');

        // Simpan nilai saldo ke dalam kolom saldo pada model Store
        $store->update(['saldo' => $saldo]);

        return view('sellerCenter.keuangan', compact('saldo', 'store'));
    }





    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
