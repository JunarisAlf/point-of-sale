<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuyController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\CashController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GrafikController;
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
Route::get('ajax/get-item', [ItemController::class, 'ajaxItemSearch']);

Route::middleware('guest')->group(function(){
    Route::get('/login', [AuthController::class, 'login'])->name('login_page');
});

Route::middleware('auth')->group(function(){
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/ubah-password', [AuthController::class, 'changePassword'])->name('changePassword');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');


    Route::get('/dashboard',  [DashboardController::class, 'index'])->name('admin.dashboard')->middleware('master');
    Route::get('/atur-pengguna',  [UserController::class, 'manageUserPage'])->name('admin.manageUser')->middleware('master');
    Route::get('/login-log',  [UserController::class, 'loginLog'])->name('admin.loginLog')->middleware('master');

    Route::prefix('/transaksi')->group(function(){
        Route::get('/tambah-penjualan',  [SellController::class, 'entrySell'])->name('admin.trx.sellEntry')->middleware('admin');
        Route::get('/tambah-penjualan-old',  [SellController::class, 'entrySellOld'])->name('admin.trx.sellEntryOld')->middleware('admin');
        Route::get('/print/receipt',  [PrintController::class, 'receipt'])->name('receipt');
        Route::get('/daftar-penjualan',  [SellController::class, 'sellList'])->name('admin.trx.sellList');
        Route::get('/tambah-pembelian',  [BuyController::class, 'entryBuy'])->name('admin.trx.buyEntry');
        Route::get('/daftar-pembelian',  [BuyController::class, 'buyList'])->name('admin.trx.buyList');
        Route::get('/tambah-penjualan-online',  [SellController::class, 'entrySellOnline'])->name('admin.trx.sellEntryOnline');
        Route::get('/daftar-penjualan-online',  [SellController::class, 'sellOnlineList'])->name('admin.trx.sellOnlineList');
        Route::get('/daftar-hutang',  [BuyController::class, 'debtList'])->name('admin.trx.debtList');
        Route::get('/daftar-piutang',  [SellController::class, 'piutangList'])->name('admin.trx.piutangList');
        Route::get('/invoice-piutang/{id}',  [SellController::class, 'invoicePiutang'])->name('admin.trx.invoicePiutang');

    });
    Route::prefix('/cash')->group(function(){
        Route::get('/in-out', [CashController::class, 'inOut'])->name('admin.cash.inOut');
        Route::get('/cash-in', [CashController::class, 'cashIn'])->name('admin.cash.cashIn');
        Route::get('/cash-out', [CashController::class, 'cashOut'])->name('admin.cash.cashOut');
        Route::get('/setoran', [CashController::class, 'setoran'])->name('admin.cash.setoran');
        Route::get('/setoran/{id}', [CashController::class, 'setoranDetail'])->name('admin.cash.setoranDetail');
        Route::get('/asset', [CashController::class, 'assets'])->name('admin.cash.assets');
    });

    Route::prefix('/master-data')->middleware('master')->group(function(){
        Route::get('/cabang',  [CabangController::class, 'index'])->name('admin.master.cabang');
        Route::get('/kategory',  [CategoryController::class, 'index'])->name('admin.master.category')->withoutMiddleware('master');
        Route::get('/barang',  [ItemController::class, 'index'])->name('admin.master.item')->withoutMiddleware('master');
        Route::get('/harga-multi',  [ItemController::class, 'multiPrice'])->name('admin.master.multiPrice')->withoutMiddleware('master');
        Route::get('/supplier',  [SupplierController::class, 'index'])->name('admin.master.supplier')->withoutMiddleware('master');
        Route::get('/pelanggan',  [CustomerController::class, 'index'])->name('admin.master.customer')->withoutMiddleware('master');
    });

    Route::prefix('/gudang')->group(function(){
        Route::get('/retur',  [ItemController::class, 'retur'])->name('admin.gudang.retur');
        Route::get('/daftar-retur',  [ItemController::class, 'returList'])->name('admin.gudang.returList');
        Route::get('/stok-barang',  [ItemController::class, 'stock'])->name('admin.gudang.stock');
        Route::get('/cek-expired',  [ItemController::class, 'expired'])->name('admin.gudang.expired');
        Route::get('/stock-opname',  [ItemController::class, 'stockOpname'])->name('admin.gudang.stockOpname');
        Route::get('/verifikasi-stock-opname',  [ItemController::class, 'verifStockOpname'])->name('admin.gudang.verifStockOpname')->middleware('master');
        Route::get('/atur-barang',  [ItemController::class, 'manageItem'])->name('admin.gudang.manageItem')->middleware('master');
        Route::get('/transfer-stok',  [ItemController::class, 'transfer'])->name('admin.gudang.transferStock');
        Route::get('/daftar-transfer-stock',  [ItemController::class, 'transferList'])->name('admin.gudang.transferList');

    });

    Route::prefix('/setting')->middleware('master')->group(function(){
        Route::get('/informasi-toko',  [UtilsController::class, 'generalInfo'])->name('admin.master.generalInfo');
        Route::get('/lain-lain',  [UtilsController::class, 'otherInfo'])->name('admin.master.otherInfo');
    });

    Route::prefix('/grafik')->middleware('master')->group(function(){
        Route::get('/penjualan',  [GrafikController::class, 'sell'])->name('admin.grafik.sell');
        Route::get('/penjualan-online',  [GrafikController::class, 'sellOnline'])->name('admin.grafik.sellOnline');
        Route::get('/pembelian',  [GrafikController::class, 'buy'])->name('admin.grafik.buy');
        Route::get('/kategori',  [GrafikController::class, 'category'])->name('admin.grafik.category');
        Route::get('/barang-terlaris',  [GrafikController::class, 'mostSell'])->name('admin.grafik.mostSell');

    });
});
