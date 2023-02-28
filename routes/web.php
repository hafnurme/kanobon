<?php

use App\Http\Controllers\CashierController;
use App\Http\Controllers\LaporanPenjualan;
use App\Http\Controllers\RiwayatTransaksi;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/login',[UserController::class,'login'])->name('login');
Route::post('/auth',[UserController::class,'auth']);
Route::get('/', [CashierController::class, 'index'])->middleware('auth');
Route::post('/search', [CashierController::class, 'show']);
Route::get('/dashboard', [AppController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('/produk', [ProductController::class, 'index'])->middleware('auth');
Route::post('/produk/search', [ProductController::class, 'show']);
Route::post('/produk/update/{id}', [ProductController::class, 'update']);
Route::get('/produk/{export}', [ProductController::class, 'print']);
Route::get('/tambah-produk', [ProductController::class, 'create']);
Route::post('/tambah-produk/simpan', [ProductController::class, 'store'])->name('add-product');;
Route::get('/riwayat-transaksi', [RiwayatTransaksi::class, 'index']);
Route::get('/riwayat-transaksi/{export}', [RiwayatTransaksi::class, 'export']);
Route::post('/riwayat-transaksi/add', [RiwayatTransaksi::class, 'store']);
Route::get('/laporan-penjualan', [LaporanPenjualan::class, 'index']);
Route::get('/laporan-penjualan/{export}', [LaporanPenjualan::class, 'print']);
