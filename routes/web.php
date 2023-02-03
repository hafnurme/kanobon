<?php

use App\Http\Controllers\Beranda;
use App\Http\Controllers\Kasir;
use App\Http\Controllers\LaporanPenjualan;
use App\Http\Controllers\Produk;
use App\Http\Controllers\RiwayatTransaksi;
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

Route::get('/', [Kasir::class, 'index']);
Route::post('/search', [Kasir::class, 'show']);
Route::get('/dashboard', [Beranda::class, 'index']);
Route::get('/produk', [Produk::class, 'index']);
Route::post('/produk/search', [Produk::class, 'show']);
Route::post('/produk/update/{id}', [Produk::class, 'update']);
Route::get('/produk/{export}', [Produk::class, 'print']);
Route::get('/tambah-produk', [Produk::class, 'create']);
Route::post('/tambah-produk/simpan', [Produk::class, 'store']);
Route::get('/riwayat-transaksi', [RiwayatTransaksi::class, 'index']);
Route::get('/riwayat-transaksi/{export}', [RiwayatTransaksi::class, 'export']);
Route::post('/riwayat-transaksi/add', [RiwayatTransaksi::class, 'store']);
Route::get('/laporan-penjualan', [LaporanPenjualan::class, 'index']);
Route::get('/laporan-penjualan/{export}', [LaporanPenjualan::class, 'print']);
