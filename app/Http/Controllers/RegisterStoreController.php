<?php

namespace App\Http\Controllers;

use App\Models\RegisterStore;
use Illuminate\Http\Request;
use App\Models\User;
// use App\Post;

class RegisterStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.registerStore');
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
    $validatedData = $request->validate([
        'photo_toko' => 'required|image|file|mimes:jpg,png|max:2048',
        'nama_toko' => 'required|string|max:255',
    ]);

    if($request->file('photo_toko')){
        $validatedData['photo_toko'] = $request->file('photo_toko')->store('store-images');
    }
    $user = auth()->user();

    // Generate Slug
    $validatedData['slug'] = \Illuminate\Support\Str::slug($validatedData['nama_toko']);

    $validatedData['user_id'] = $user->id;

    RegisterStore::create($validatedData);

    // Update role menjadi 'petani'
    $user->update(['role' => 'petani']);

    $request->session()->flash('success', 'Akun petani berhasil dibuat!');
    return redirect('/seller/dashboard');
    }


    /**
     * Display the specified resource.
     */
    public function show(RegisterStore $registerStore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RegisterStore $registerStore)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RegisterStore $registerStore)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RegisterStore $registerStore)
    {
        //
    }
}
