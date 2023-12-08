<?php

namespace App\Http\Controllers;

use App\Models\SellerCenter;
use App\Models\Product;
use App\Models\Category;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // Logika untuk menampilkan semua produk
        $products = Product::all();

        // Kemudian, lempar data ke view
        return view('home', compact('products'));
    }

    public function detailProduct($slug)
    {
        $products = Product::with('store')->where("slug", $slug)->first();
        // dd($products);
        return view('pages.productDetail', compact('products'));
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
        $user = Auth::user();
        $validatedData = $request->validate([
            'category_id' => 'required',
            'title' => 'required|max:255',
            'photo_produk' => 'required|image|file|mimes:jpg,png|max:2048',
            'description' => 'required',
            'stok' => 'required',
            'harga' => 'required',
            'berat_produk' => 'required'
        ]);

        $validatedData['store_id'] = Store::where('user_id', $user->id)->value('id');

        if ($request->file('photo_produk')) {
            $validatedData['photo_produk'] = $request->file('photo_produk')->store('product-images');
        }

        $validatedData['slug'] = \Illuminate\Support\Str::slug($validatedData['title']);

        Product::create($validatedData);
        return redirect('/seller/produk')->with('success', 'Product Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('sellerCenter.show', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $categories = Category::all();
        $product = Product::where("slug", $slug)->first();
        return view('sellerCenter.editProduk', ['product' => $product, 'categories' => $categories]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product, $slug)
    {
        $product = Product::where("slug", $slug)->first();
        $user = Auth::user();
        $validatedData = $request->validate([
            'category_id' => 'required',
            'title' => 'required|max:255',
            'photo_produk' => 'image|file|mimes:jpg,png|max:2048',
            'description' => 'required',
            'stok' => 'required',
            'harga' => 'required',
            'berat_produk' => 'required'
        ]);

        $validatedData['store_id'] = Store::where('user_id', $user->id)->value('id');

        if ($request->file('photo_produk')) {
            if ($request->photo_produk) {
                Storage::delete($product->photo_produk);
            }
            $validatedData['photo_produk'] = $request->file('photo_produk')->store('product-images');
        }

        $validatedData['slug'] = \Illuminate\Support\Str::slug($validatedData['title']);

        Product::where('slug', $slug)->update($validatedData);

        return redirect('/seller/produk')->with('success', 'Product Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        // dd($product);
        $product = Product::where("slug", $slug)->first();
        // dd($product['photo_produk']);
        if ($product->photo_produk) {
            Storage::delete($product->photo_produk);
        }
        $product->delete($product->slug);

        return redirect('/seller/produk');
    }
}
