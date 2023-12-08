<?php

namespace App\Http\Controllers;

use App\Models\SellerCenter;
use App\Models\Category;
use App\Models\Store;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SellerCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        if ($user && $user->role === 'petani') {
            $storeWithNullDetailAlamatToko = SellerCenter::where('user_id', $user->id)
                ->whereNull('detail_alamat_toko')
                ->first();

            $showAlert = $storeWithNullDetailAlamatToko !== null;

            return view('sellerCenter.dashboard', compact('showAlert'));
        }

        return view('sellerCenter.dashboard');
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

    public function showProduct()
    {
        $user = auth()->user();
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SellerCenter $sellerCenter)
    {
        //
    }
}
