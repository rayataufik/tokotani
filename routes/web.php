<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\SellerCenterController;
use App\Http\Controllers\RegisterStoreController;
use App\Http\Controllers\UserController;
use App\Models\SellerCenter;

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
Route::post('/pendaftaran-toko', [RegisterStoreController::class, 'store'])->middleware('auth');;

// Mengelompokkan route dengan middleware 'IsPetani'
Route::middleware(['IsPetani'])->group(function () {
    Route::prefix('/seller')->group(function () {
        Route::get('/dashboard', [SellerCenterController::class, 'tampilkanTransaksiByIdStore']);
        Route::get('/profile', [SellerCenterController::class, 'showProfile']);
        Route::get('/profile/{slug}/edit', [SellerCenterController::class, 'edit']);
        Route::put('/profile/{slug}', [SellerCenterController::class, 'update']);
        Route::get('/produk/baru', [CategoryController::class, 'showCategoryProduct']);
        Route::post('/produk/baru', [ProductController::class, 'store']);
        Route::get('/produk', [SellerCenterController::class, 'showProduct']);
        Route::delete('/produk/{slug}', [ProductController::class, 'destroy'])->name('product.delete');
        Route::get('/produk/{slug}/edit', [ProductController::class, 'edit']);
        Route::put('/produk/{slug}', [ProductController::class, 'update']);
        Route::get('/pesanan', [SellerCenterController::class, 'pesanan']);
        Route::put('/pesanan/{midtrans_id}', [SellerCenterController::class, 'updatePesanan']);
        Route::put('/pesanan/{midtrans_id}/update-request-pembatalan', [TransactionController::class, 'updateRequestPembatalan']);
        Route::get('/keuangan', [TransactionController::class, 'saldoSeller']);
        Route::put('/keuangan/baru', [SellerCenterController::class, 'updateRekeningSeller']);
        Route::put('/keuangan/{id}/request-penarikan', [SellerCenterController::class, 'requestPenarikanSaldo']);
    });
});

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->middleware('IsAdmin');
Route::get('/admin/category', [CategoryController::class, 'index'])->middleware('IsAdmin');
Route::post('/admin/category/baru', [CategoryController::class, 'store'])->middleware('IsAdmin');
Route::delete('/admin/category/{slug}', [CategoryController::class, 'destroy'])->middleware('IsAdmin');
Route::get('/admin/keuangan', [AdminController::class, 'keuangan'])->middleware('IsAdmin');
Route::get('/admin/penarikan-user/{id}', [AdminController::class, 'penarikanUser'])->middleware('IsAdmin');
Route::get('/admin/penarikan/{slug}', [AdminController::class, 'penarikanSeller'])->middleware('IsAdmin');

Route::get('/kategori/{slug}', [CategoryController::class, 'categoryBySlug']);
Route::get('/produk/{slug}', [ProductController::class, 'detailProduct']);

Route::get('/user/profile', [UserController::class, 'showUser'])->middleware('auth');
Route::get('/user/profile/edit', [UserController::class, 'edit'])->middleware('auth');
Route::put('/user/update', [UserController::class, 'update'])->middleware('auth');
Route::get('/user/saldo', [TransactionController::class, 'saldoUser'])->middleware('auth');
Route::put('/user/saldo/baru', [UserController::class, 'updateNoRekening'])->middleware('auth');
Route::put('/user/saldo/{id}/request-penarikan', [UserController::class, 'requestPenarikanSaldo'])->middleware('auth');

Route::get('/beli-langsung/{slug}', [TransactionController::class, 'show'])->middleware('auth');
Route::post('/beli-langsung/process', [TransactionController::class, 'process'])->middleware('auth');

Route::get('/payment', [TransactionController::class, 'showPayment'])->middleware('auth');

Route::get('/order-list', [TransactionController::class, 'orderList'])->middleware('auth');
Route::put('/order-list/{midtrans_id}/batalkan-pesanan', [TransactionController::class, 'batalkanPesananUser'])->middleware('auth');
Route::put('/order-list/{midtrans_id}/selesai', [TransactionController::class, 'updatePesananSelesai'])->middleware('auth');
Route::put('/order-list/{midtrans_id}/request-batalkan', [TransactionController::class, 'requestBatalkanUser'])->middleware('auth');

Route::get('/search-transactions', [UserController::class, 'searchTransactions']);


Route::get('/discovery', function () {
    return view('pages.discovery');
});
