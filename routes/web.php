<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

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
Route::middleware('guest')->group(function(){
    Route::get('/login', [AuthController::class, 'login'])->name('login_page');
});

Route::middleware('auth')->group(function(){
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/ubah-password', [AuthController::class, 'changePassword'])->name('changePassword');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');


    Route::get('/dashboard',  [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/atur-pengguna',  [UserController::class, 'manageUserPage'])->name('admin.manageUser');
    
    Route::prefix('/master-data')->group(function(){
        Route::get('/cabang',  [CabangController::class, 'index'])->name('admin.master.cabang');
        Route::get('/kategory',  [CategoryController::class, 'index'])->name('admin.master.category');
        Route::get('/barang',  [ItemController::class, 'index'])->name('admin.master.item');
        Route::get('/supplier',  [SupplierController::class, 'index'])->name('admin.master.supplier');
    });
    Route::prefix('/gudang')->group(function(){
        Route::get('/stok-barang',  [ItemController::class, 'stock'])->name('admin.gudang.stock');
        Route::get('/cek-expired',  [ItemController::class, 'expired'])->name('admin.gudang.expired');
        Route::get('/stock-opname',  [ItemController::class, 'stockOpname'])->name('admin.gudang.stockOpname');
        Route::get('/verifikasi-stock-opname',  [ItemController::class, 'verifStockOpname'])->name('admin.gudang.verifStockOpname');

    });
});
