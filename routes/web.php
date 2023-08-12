<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuyController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\CashController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UtilsController;
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
    Route::get('/login-log',  [UserController::class, 'loginLog'])->name('admin.loginLog');
    
    Route::prefix('/transaksi')->group(function(){
        Route::get('/tambah-penjualan',  [SellController::class, 'entrySell'])->name('admin.trx.sellEntry');
        Route::get('/print/receipt',  [PrintController::class, 'receipt'])->name('receipt');
        Route::get('/daftar-penjualan',  [SellController::class, 'sellList'])->name('admin.trx.sellList');
        Route::get('/tambah-pembelian',  [BuyController::class, 'entryBuy'])->name('admin.trx.buyEntry');
        Route::get('/daftar-pembelian',  [BuyController::class, 'buyList'])->name('admin.trx.buyList');
        Route::get('/tambah-penjualan-online',  [SellController::class, 'entrySellOnline'])->name('admin.trx.sellEntryOnline');
        Route::get('/daftar-penjualan-online',  [SellController::class, 'sellOnlineList'])->name('admin.trx.sellOnlineList');
    Route::get('/daftar-hutang',  [BuyController::class, 'debtList'])->name('admin.trx.debtList');
        Route::get('/daftar-piutang',  [SellController::class, 'piutangList'])->name('admin.trx.piutangList');
    });
    Route::prefix('/cash')->group(function(){
        Route::get('/in-out', [CashController::class, 'inOut'])->name('admin.cash.inOut');
        Route::get('/asset', [CashController::class, 'assets'])->name('admin.cash.assets');
    });

    Route::prefix('/master-data')->group(function(){
        Route::get('/informasi-toko',  [UtilsController::class, 'generalInfo'])->name('admin.master.generalInfo');
        Route::get('/cabang',  [CabangController::class, 'index'])->name('admin.master.cabang');
        Route::get('/kategory',  [CategoryController::class, 'index'])->name('admin.master.category');
        Route::get('/barang',  [ItemController::class, 'index'])->name('admin.master.item');
        Route::get('/harga-multi',  [ItemController::class, 'multiPrice'])->name('admin.master.multiPrice');
        Route::get('/supplier',  [SupplierController::class, 'index'])->name('admin.master.supplier');
        Route::get('/pelanggan',  [CustomerController::class, 'index'])->name('admin.master.customer');
    });
    Route::prefix('/gudang')->group(function(){
        Route::get('/stok-barang',  [ItemController::class, 'stock'])->name('admin.gudang.stock');
        Route::get('/cek-expired',  [ItemController::class, 'expired'])->name('admin.gudang.expired');
        Route::get('/stock-opname',  [ItemController::class, 'stockOpname'])->name('admin.gudang.stockOpname');
        Route::get('/verifikasi-stock-opname',  [ItemController::class, 'verifStockOpname'])->name('admin.gudang.verifStockOpname');
        Route::get('/atur-barang',  [ItemController::class, 'manageItem'])->name('admin.gudang.manageItem');
        Route::get('/transfer-stok',  [ItemController::class, 'transfer'])->name('admin.gudang.transferStock');
    });
});
