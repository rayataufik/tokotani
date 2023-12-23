<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Delete Product!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('admin.category', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function showCategoryProduct()
    {
        return view('sellerCenter.postProduk', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
        ]);
        // Generate Slug
        $validatedData['slug'] = \Illuminate\Support\Str::slug($validatedData['nama']);

        Category::create($validatedData);
        return redirect('/admin/category')->with('success', 'Kategory Created Successfully!');
    }

    public function categoryBySlug($slug)
    {
        // Ambil kategori berdasarkan slug
        $category = Category::where('slug', $slug)->first();

        // Ambil produk yang terkait dengan kategori
        $products = Product::where('category_id', $category->id)->get();

        // Kirim data ke tampilan
        return view('pages.discovery', compact('category', 'products'));
    }



    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        // dd($product);
        $category = Category::where("slug", $slug)->first();

        $category->delete($category->slug);

        return redirect('/admin/category');
    }
}
