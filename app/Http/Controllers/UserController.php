<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function showUser()
    {
        $user = Auth::user();

        $storeWithNullDetailAlamatUser = User::where('id', $user->id)
            ->whereNull('detail_alamat_user')
            ->first();

        if ($storeWithNullDetailAlamatUser) {
            // User has null detail_alamat_user, show alert
            $alertMessage = "Profil belum lengkap. Harap tambahkan alamat anda.";
            return view('pages.profile', compact('user', 'alertMessage'));
        } else {
            // User has a detail_alamat_user
            return view('pages.profile', compact('user'));
        }
    }

    public function updateNoRekening(request $request)
    {
        $user = Auth::user();
        $validatedData = $request->validate([
            'bank' => 'required|string',
            'no_rekening' => 'required',
        ]);
        // dd($validatedData);
        $user->update($validatedData);
        return back()->with('success', 'Rekening Berhasil Ditambahkan');
    }

    public function requestPenarikanSaldo($id)
    {
        $user = User::find($id);
        $user->update(['status_penarikan_saldo' => 'diproses']);

        // Redirect atau tampilkan halaman yang sesuai
        return back()->with('success', 'Request penarikan saldo diproses.');
    }

    public function searchTransactions(Request $request)
    {
        $searchQuery = $request->input('search');

        // Use the where clause to filter transactions based on the search query
        $products = Product::where('title', 'like', '%' . $searchQuery . '%')
            ->get();

        return view('pages.search', compact('products', 'searchQuery'));
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
    public function edit()
    {
        $user = auth()->user();
        return view('pages.editProfile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            // Define your validation rules here based on your user model fields
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'no_telepon_user' => 'required|max:15',
            'provinsi_user' => 'required|string|max:50',
            'kabupaten_user' => 'required|string|max:50',
            'kecamatan_user' => 'required|string|max:50',
            'kode_pos_user' => 'required|max:5',
            'detail_alamat_user' => 'required|string|max:255',
        ]);

        $user->update($validatedData);

        return redirect('/user/profile')->with('success', 'Profile updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
