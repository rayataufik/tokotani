<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Store;
use App\Models\Product;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\SellerCenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SellerCenterController extends Controller
{

    public function showProduct()
    {

        $title = 'Delete Product!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        $user = Auth::user();

        // Mengambil semua produk yang terkait dengan toko yang login
        $products = Product::where('store_id', $user->store->id)->get();

        if ($user && $user->role === 'petani') {
            $storeWithNullDetailAlamatToko = SellerCenter::where('user_id', $user->id)
                ->whereNull('detail_alamat_toko')
                ->first();

            $showAlert = $storeWithNullDetailAlamatToko !== null;

            return view('sellerCenter.produk', [
                'products' => $products,
                'showAlert' => $showAlert ?? false, // Use a default value if $showAlert is not set
            ]);
        }

        return view('sellerCenter.produk', [
            'products' => $products
        ]);
    }

    public function showProfile(SellerCenter $sellerCenter)
    {
        $user = auth()->user();
        // Mengambil toko dari pengguna yang sedang login
        $sellerCenter = $user->store;

        if ($user && $user->role === 'petani') {
            $storeWithNullDetailAlamatToko = SellerCenter::where('user_id', $user->id)
                ->whereNull('detail_alamat_toko')
                ->first();

            $showAlert = $storeWithNullDetailAlamatToko !== null;

            return view('sellerCenter.profile', [
                'sellerCenter' => $sellerCenter,
                'showAlert' => $showAlert ?? false, // Use a default value if $showAlert is not set
            ]);
        }



        return view('sellerCenter.produk', [
            'sellerCenter' => $sellerCenter
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $sellerCenter = Store::where("slug", $slug)->first();

        return view('sellerCenter.editProfile', compact('sellerCenter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $store = Store::where("slug", $slug)->first();

        $validatedData = $request->validate([
            'nama_toko' => 'required',
            'provinsi_toko' => 'required|max:50',
            'photo_toko' => 'image|file|mimes:jpg,png|max:2048',
            'kecamatan_toko' => 'required|max:50',
            'kabupaten_toko' => 'required|max:50',
            'kode_pos_toko' => 'required|max:5',
            'detail_alamat_toko' => 'required|max:255'
        ]);

        if ($request->file('photo_toko')) {
            if ($request->photo_toko) {
                Storage::delete($store->photo_toko);
            }
            $validatedData['photo_toko'] = $request->file('photo_toko')->store('store-images');
        }

        $validatedData['slug'] = \Illuminate\Support\Str::slug($validatedData['nama_toko']);
        // dd($store);
        $store->update($validatedData);

        return redirect('/seller/profile')->with('success', 'Profile Updated Successfully!');
    }

    public function tampilkanTransaksiByIdStore()
    {
        $user = Auth::user();

        if ($user && $user->role === 'petani') {
            $storeWithNullDetailAlamatToko = SellerCenter::where('user_id', $user->id)
                ->whereNull('detail_alamat_toko')
                ->first();

            $showAlert = $storeWithNullDetailAlamatToko !== null;

            $id_store = $user->store->id;

            $transactions = Transaction::whereHas('order.product.store', function ($query) use ($id_store) {
                $query->where('id', $id_store);
            })->with(['order.product.store'])->get();

            $products = Product::where('store_id', $user->store->id)->get();

            $unpaidCount = $transactions->where('status', 'unpaid')->count();
            $paidCount = $transactions->where('status', 'paid')->count();
            $dikirimCount = $transactions->where('status', 'dikirim')->count();
            $respon_pembatalan = $transactions->where('menunggu_pembatalan', 'menunggu')->count();
            // Ambil transaksi berdasarkan id_store dengan status "selesai"
            $transactionsSelesai = Transaction::whereHas('order.product.store', function ($query) use ($id_store) {
                $query->where('id', $id_store);
            })->where('status', 'selesai')->with(['order.product.store'])->get();


            $transactionsSelesaiByProduct = $transactionsSelesai->groupBy('order.product.id');

            $transactionsSelesaiCounts = $transactionsSelesaiByProduct->map(function ($transactions) {
                return $transactions->count();
            });



            return view('sellerCenter.dashboard', compact('showAlert', 'products', 'transactions', 'transactionsSelesaiCounts', 'respon_pembatalan', 'unpaidCount', 'paidCount', 'dikirimCount'));
        }

        return view('sellerCenter.dashboard');
    }

    public function pesanan()
    {
        $user = auth()->user();
        $id_store = $user->store->id;

        $transactions = Transaction::whereHas('order.product.store', function ($query) use ($id_store) {
            $query->where('id', $id_store);
        })->with(['order.product.store', 'user'])->latest()->get();

        return view('sellerCenter.pesanan', compact('transactions'));
    }

    public function updatePesanan(Request $request, $midtrans_id)
    {
        $transaction = Transaction::where("midtrans_id", $midtrans_id)->first();

        if ($transaction) {
            $validatedData = $request->validate([
                "resi_pengiriman" => "required",
            ]);

            $validatedData["status"] = 'dikirim';

            $transaction->update($validatedData);

            return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }
    }


    public function updateRekeningSeller(Request $request)
    {
        // Validasi request
        $validatedData = $request->validate([
            'bank' => 'required|string',
            'no_rekening' => 'required',
        ]);

        $user = Auth::user();
        $store = $user->store;

        // Update kolom bank dan no_rekening pada model Store
        $store->update([
            'bank' => $validatedData['bank'],
            'no_rekening' => $validatedData['no_rekening'],
        ]);

        // Redirect atau tampilkan halaman yang sesuai
        return back()->with('success', 'Rekening berhasil diperbarui.');
    }


    public function requestPenarikanSaldo($id)
    {
        $store = Store::find($id);

        $store->update(['status_penarikan_saldo' => 'diproses']);

        return back()->with('success', 'Request penarikan saldo diproses.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SellerCenter $sellerCenter)
    {
        //
    }
}
