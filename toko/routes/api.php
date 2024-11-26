<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['auth:sanctum', 'logreq'])->group(function () {  
    Route::get('/productsBrand/{id}', [ProductController::class, 'filterByBrand'])->name('filterByBrand');    
    Route::get('/productsCategory/{id}', [ProductController::class, 'filterByCategory'])->name('filterByCategory');
    Route::apiResource('products', ProductController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('brands', BrandController::class);
    Route::post('/logout',[UserController::class, 'logout']);
});

Route::post('login',[UserController::class, 'login'])->name('login');
Route::post('/register', [UserController::class, 'store'])->name('users.store');

// // Route untuk menampilkan daftar produk
// Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// // Route untuk menampilkan formulir tambah produk
// Route::get('/products/create', [ProductController::class, 'create'])->name('products.create'); // BELUM ADA BELUM PAKAI

// // Route untuk menyimpan produk baru
// Route::post('/products', [ProductController::class, 'store'])->name('products.store');

// // Route untuk menampilkan detail produk berdasarkan ID
// Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// // Route untuk menampilkan formulir edit produk berdasarkan ID
// Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit'); // BELUM ADA BELUM PAKAI

// // Route untuk memperbarui produk berdasarkan ID
// Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');

// // Route untuk menghapus produk berdasarkan ID
// Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
