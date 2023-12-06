<?php

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RegisterStoreController;
use App\Http\Controllers\SellerCenterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ProductController::class, 'index']);

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/pendaftaran-toko', [RegisterStoreController::class, 'index'])->middleware('auth');
Route::post('/pendaftaran-toko', [RegisterStoreController::class, 'store']);

// Mengelompokkan route dengan middleware 'IsPetani'
Route::middleware(['IsPetani'])->group(function () {
    Route::prefix('/seller')->group(function () {
        Route::get('/dashboard', [SellerCenterController::class, 'index']);
        Route::get('/profile', [SellerCenterController::class, 'showProfile']);
        Route::get('/profile/{slug}/edit', [SellerCenterController::class, 'edit']);
        Route::put('/profile/{slug}', [SellerCenterController::class, 'update']);
        Route::get('/produk/baru', [CategoryController::class, 'showCategoryProduct']);
        Route::post('/produk/baru', [ProductController::class, 'store']);
        Route::get('/produk', [SellerCenterController::class, 'showProduct']);
        Route::delete('/produk/{slug}', [ProductController::class, 'destroy'])->name('product.delete');
        Route::get('/produk/{slug}/edit', [ProductController::class, 'edit']);
        Route::put('/produk/{slug}', [ProductController::class, 'update']);
    });
});



Route::get('/seller/category', [CategoryController::class, 'index'])->middleware('auth');
Route::post('/seller/category', [CategoryController::class, 'store']);
Route::get('/produk/{slug}', [ProductController::class, 'detailProduct']);


Route::get('/discovery', function () {
    return view('pages.discovery');
});

Route::get('/transaction', function () {
    return view('pages.transaction');
});

Route::get('/payment', function () {
    return view('pages.payment');
});

Route::get('/seller/pesanan', function () {
    return view('sellerCenter.pesanan');
});


Route::get('/seller/keuangan', function () {
    return view('sellerCenter.keuangan');
});
