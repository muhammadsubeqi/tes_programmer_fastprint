<?php

use App\Http\Controllers\ProductController;
use App\Http\Services\Product;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// route untuk upload data dari api ke database
Route::get('/produk-api', [ProductController::class, 'uploadFromApi']);

// route tampilan daftar product
Route::get('/', [ProductController::class, 'index'])->name('produk.daftar');
// route menampilkan tambah data produk
Route::get('/create', [ProductController::class, 'create'])->name('produk.create');
// route memasukkan data produk ke database
Route::post('/store', [ProductController::class, 'store'])->name('produk.store');
// route mengedit data produk 
Route::post('/edit', [ProductController::class, 'edit'])->name('produk.edit');
// route menghapus data produk
Route::delete('/delete', [ProductController::class, 'destroy'])->name('produk.delete');
