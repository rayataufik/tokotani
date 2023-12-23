<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Store;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function dashboard()
    {
        // Menghitung jumlah transaksi yang berhasil (status: selesai)
        $successfulTransactions = Transaction::where('status', 'selesai')->count();

        // Menghitung jumlah user
        $totalUsers = User::count();

        // Menghitung jumlah produk
        $totalProducts = Product::count();

        // Kirim data ke tampilan dashboard
        return view("admin.dashboard", compact('successfulTransactions', 'totalUsers', 'totalProducts'));
    }

    public function keuangan()
    {
        $userRequest = User::Where('status_penarikan_saldo', 'diproses')->get();
        $storeRequest = Store::Where('status_penarikan_saldo', 'diproses')->get();
        return view('admin.keuangan', compact('userRequest', 'storeRequest'));
    }

    public function penarikanSeller($slug)
    {
        $storeRequest = Store::where('slug', $slug)->first();


        if ($storeRequest) {
            // Update the status_penarikan_saldo column in the stores table
            $storeRequest->update(['status_penarikan_saldo' => 'selesai']);


            // Update the cek_is_refund column in the transactions table
            Transaction::where('status', 'selesai')
                ->where('user_id', $storeRequest->user_id)
                ->update(['cek_is_refund' => 'refunded']);

            // Redirect back with a success message
            return back()->with('success', 'Penarikan saldo selesai.');
        }
    }

    public function penarikanUser($id)
    {
        // Find the user with the given ID
        $user = User::find($id);

        if ($user) {
            // Update the status_penarikan_saldo column in the users table to "selesai"
            $user->update(['status_penarikan_saldo' => 'selesai']);

            // Update the cek_is_refund column in the transactions table
            Transaction::where('status', 'dibatalkan')
                ->where('menunggu_pembatalan', 'dibatalkan')
                ->where('user_id', $id)
                ->update(['cek_is_refund' => 'refunded']);

            // Redirect back with a success message
            return back()->with('success', 'Penarikan saldo selesai.');
        }
    }
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
    public function show(string $id)
    {
        //
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
