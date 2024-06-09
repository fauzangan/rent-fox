<?php

use App\Http\Controllers\AutentikasiController;
use App\Http\Controllers\BukuHarianController;
use App\Http\Controllers\CategoryItemController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\JurnalBulananController;
use App\Http\Controllers\LogistikController;
use App\Http\Controllers\LogistikHarianController;
use App\Http\Controllers\MainDashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\TotalLogistikController;
use App\Http\Controllers\UserController;
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

// Temporary Route
Route::get('/', function() {
    return redirect()->route('dashboard.main-dashboard.index');
});

Route::group(['middleware' => ['guest']], function () {
    // Authentication Route
    Route::get('/login', [AutentikasiController::class, 'index'])->name('login');
    Route::post('/login', [AutentikasiController::class, 'authenticate'])->name('authenticate');
});

Route::group(['middleware' => ['auth']], function () {
    // Logout Route
    Route::post('/logout', [AutentikasiController::class, 'logout'])->name('logout');

    // Main Dashboard Route
    Route::get('/dashboard', [MainDashboardController::class, 'index'])->name('dashboard.main-dashboard.index');
    Route::get('/dashboard/getOrdersByDate', [MainDashboardController::class, 'getOrdersByDate'])->name('dashboard.main-dashboard.getOrdersByDate');
    Route::get('/dashboard/getTagihansByDate', [MainDashboardController::class, 'getTagihansByDate'])->name('dashboard.main-dashboard.getTagihansByDate');
    Route::get('/dashboard/getLogistikHariansByDate', [MainDashboardController::class, 'getLogistikHariansByDate'])->name('dashboard.main-dashboard.getLogistikHariansByDate');

    // Customers Route
    Route::get('/dashboard/customers', [CustomerController::class, 'index'])->name('dashboard.customers.index');
    Route::get('/dashboard/customers/create', [CustomerController::class, 'create'])->name('dashboard.customers.create');
    Route::post('/dashboard/customers/create', [CustomerController::class, 'store'])->name('dashboard.customers.store');
    Route::get('/dashboard/customers/detail/{customer}', [CustomerController::class, 'getCustomerDetails'])->name('dashboard.customers.detail');
    Route::get('/dashboard/customers/edit/{customer}', [CustomerController::class, 'edit'])->name('dashboard.customers.edit');
    Route::put('/dashboard/customers/update/{customer}', [CustomerController::class, 'update'])->name('dashboard.customers.update');
    Route::delete('/dashboard/customers/delete/{customer}', [CustomerController::class, 'destroy'])->name('dashboard.customers.delete');

    // Category Item Route
    Route::get('/dashboard/category-items/index', [CategoryItemController::class, 'index'])->name('dashboard.category-items.index');
    Route::get('/dashboard/category-items/create', [CategoryItemController::class, 'create'])->name('dashboard.category-items.create');
    Route::post('/dashboard/category-items/create', [CategoryItemController::class, 'store'])->name('dashboard.category-items.store');
    Route::get('/dashboard/category-items/edit/{categoryItem}', [CategoryItemController::class, 'edit'])->name('dashboard.category-items.edit');
    Route::put('/dashboard/category-items/update/{categoryItem}', [CategoryItemController::class, 'update'])->name('dashboard.category-items.update');

    // Items Route
    Route::get('/dashboard/items', [ItemController::class, 'index'])->name('dashboard.items.index');
    Route::get('/dashboard/items/create', [ItemController::class, 'create'])->name('dashboard.items.create');
    Route::post('/dashboard/items/create', [ItemController::class, 'store'])->name('dashboard.items.store');
    Route::get('/dashboard/items/edit/{item}', [ItemController::class, 'edit'])->name('dashboard.items.edit');
    Route::put('/dashboard/items/update/{item}', [ItemController::class, 'update'])->name('dashboard.items.update');
    Route::delete('/dashboard/items/delete/{item}', [ItemController::class, 'destroy'])->name('dashboard.items.delete');

    // Order Route
    Route::get('/dashboard/orders', [OrderController::class, 'index'])->name('dashboard.orders.index');
    Route::get('/dashboard/orders/detail/{order}', [OrderController::class, 'detail'])->name('dashboard.orders.detail');
    Route::post('/dashboard/orders/detail/{order}/post-discount', [OrderController::class, 'postDiscount'])->name('dashboard.orders.detail.post-discount');
    Route::post('/dashboard/orders/detail/{order}/post-biaya-transport', [OrderController::class, 'postBiayaTransport'])->name('dashboard.orders.detail.post-biaya-transport');
    Route::post('/dashboard/orders/detail/{order}/post-down-payment', [OrderController::class, 'postDownPayment'])->name('dashboard.orders.detail.post-down-payment');
    Route::get('/dashboard/orders/detail/{order}/get-order-data', [OrderController::class, 'getOrder'])->name('dashboard.orders.detail.get-order-data');
    Route::get('/dashboard/orders/create', [OrderController::class, 'create'])->name('dashboard.orders.create');
    Route::post('/dashboard/orders/create', [OrderController::class, 'store'])->name('dashboard.orders.store');
    Route::get('/dashboard/orders/edit/{order}', [OrderController::class, 'edit'])->name('dashboard.orders.edit');
    Route::put('/dashboard/orders/update/{order}', [OrderController::class, 'update'])->name('dashboard.orders.update');
    Route::delete('/dashboard/orders/delete/{order}', [OrderController::class, 'destroy'])->name('dashboard.orders.delete');

    // Tagihan Route
    Route::get('/dashboard/tagihans', [TagihanController::class, 'index'])->name('dashboard.tagihans.index');
    Route::get('/dashboard/tagihans/create', [TagihanController::class, 'create'])->name('dashboard.tagihans.create');
    Route::get('/dashboard/tagihans/getOrderData/{order}', [TagihanController::class, 'getOrder'])->name('dashboard.tagihans.get-order-data');
    Route::post('/dashboard/tagihans/create', [TagihanController::class, 'store'])->name('dashboard.tagihans.store');
    Route::get('/dashboard/tagihans/edit/{tagihan}', [TagihanController::class, 'edit'])->name('dashboard.tagihans.edit');
    Route::put('/dashboard/tagihans/update/{tagihan}', [TagihanController::class, 'update'])->name('dashboard.tagihans.update');

    // Logistik Route
    Route::get('/dashboard/logistiks', [LogistikController::class, 'index'])->name('dashboard.logistiks.index');

    // Logistik Harian Route
    Route::get('/dashboard/logistik-harians', [LogistikHarianController::class, 'index'])->name('dashboard.logistik-harians.index');
    Route::get('/dashboard/logistik-harians/edit/{logistikHarian}', [LogistikHarianController::class, 'edit'])->name('dashboard.logistik-harians.edit');
    Route::put('/dashboard/logistik-harians/update/{logistikHarian}', [LogistikHarianController::class, 'update'])->name('dashboard.logistik-harians.update');
    Route::get('/dashboard/logistik-harians/create', [LogistikHarianController::class, 'create'])->name('dashboard.logistik-harians.create');
    Route::post('/dashboard/logistik-harians/create', [LogistikHarianController::class, 'store'])->name('dashboard.logistik-harians.store');
    Route::get('/dashboard/logistik-harians/getLogistikHarians/{orderId}', [LogistikHarianController::class, 'getLogistikHarian'])->name('dashboard.logistik-harians.getLogistikHarian');
    Route::get('/dashboard/logistik-harians/getOrder/{orderId}', [LogistikHarianController::class, 'getOrder'])->name('dashboard.logistik-harians.getOrder');
    Route::get('/dashboard/logistik-harians/getOrderItem/{orderId}', [LogistikHarianController::class, 'getOrderItems'])->name('dashboard.logistik-harians.getOrderItem');
    Route::get('/dashboard/logistik-harians/getCustomerOrders/{customerId}', [LogistikHarianController::class, 'getCustomerOrders'])->name('dashboard.logistik-harians.getCustomerOrder');

    // Reservasi Route
    Route::get('/dashboard/reservasis', [ReservasiController::class, 'index'])->name('dashboard.reservasis.index');
    Route::get('/dashboard/reservasis/create', [ReservasiController::class,'create'])->name('dashboard.reservasis.create');
    Route::post('/dashboard/reservasis/create', [ReservasiController::class,'store'])->name('dashboard.reservasis.store');
    Route::get('/dashboard/reservasis/edit/{reservasi}', [ReservasiController::class, 'edit'])->name('dashboard.reservasis.edit');
    Route::put('/dashboard/reservasis/update/{reservasi}', [ReservasiController::class, 'update'])->name('dashboard.reservasis.update');

    // Total Logistik Route
    Route::get('/dashboard/total-logistiks', [TotalLogistikController::class, 'index'])->name('dashboard.total-logistiks.index');
    Route::get('/dashboard/total-logistiks/create', [TotalLogistikController::class, 'create'])->name('dashboard.total-logistiks.create');
    Route::post('/dashboard/total-logistiks/create', [TotalLogistikController::class, 'store'])->name('dashboard.total-logistiks.store');
    Route::get('/dashboard/total-logistiks/edit/{totalLogistik}', [TotalLogistikController::class, 'edit'])->name('dashboard.total-logistiks.edit');
    Route::put('/dashboard/total-logistiks/update/{totalLogistik}', [TotalLogistikController::class, 'update'])->name('dashboard.total-logistiks.update');

    // Buku Harian Route
    Route::get('/dashboard/buku-harians', [BukuHarianController::class, 'index'])->name('dashboard.buku-harians.index');
    Route::get('/dashboard/buku-harians/create', [BukuHarianController::class, 'create'])->name('dashboard.buku-harians.create');
    Route::get('/dashboard/buku-harians/getSaldoData', [BukuHarianController::class, 'getSaldoData'])->name('dashboard.buku-harians.getSaldoData');
    Route::get('/dashboard/buku-harians/getSaldoData/{bukuHarian}', [BukuHarianController::class, 'getSaldoDataEdit'])->name('dashboard.buku-harians.getSaldoData-edit');
    Route::get('/dashboard/buku-harians/getOrderData/{orderId}', [BukuHarianController::class, 'getOrderData'])->name('dashboard.buku-harians.getOrderData');
    Route::get('/dashboard/buku-harians/getCustomerData/{customerId}', [BukuHarianController::class, 'getCustomerData'])->name('dashboard.buku-harians.getCustomerData');
    Route::post('/dashboard/buku-harians/store', [BukuHarianController::class, 'store'])->name('dashboard.buku-harians.store');
    Route::get('/dashboard/buku-harians/edit/{bukuHarian}', [BukuHarianController::class, 'edit'])->name('dashboard.buku-harians.edit');
    Route::put('/dashboard/buku-harians/update/{bukuHarian}', [BukuHarianController::class, 'update'])->name('dashboard.buku-harians.update');

    // Jurnal Bulanan Route
    Route::get('/dashboard/jurnal-bulanans', [JurnalBulananController::class, 'index'])->name('dashboard.jurnal-bulanans.index');
    Route::post('/dashboard/jurnal-bulanans', [JurnalBulananController::class, 'filter'])->name('dashboard.jurnal-bulanans.filter');

    // Hak Akses Route
    Route::get('/dashboard/hak-akses', [RoleController::class, 'index'])->name('dashboard.hak-akses.index');
    Route::get('/dashboard/hak-akses/create', [RoleController::class, 'create'])->name('dashboard.hak-akses.create');
    Route::post('/dashboard/hak-akses/create', [RoleController::class, 'store'])->name('dashboard.hak-akses.store');
    Route::get('/dashboard/hak-akses/edit/{role}', [RoleController::class, 'edit'])->name('dashboard.hak-akses.edit');
    Route::put('/dashboard/hak-akses/update/{role}', [RoleController::class, 'update'])->name('dashboard.hak-akses.update');

    // User Route
    Route::get('/dashboard/users', [UserController::class, 'index'])->name('dashboard.users.index');
    Route::get('/dashboard/users/create', [UserController::class, 'create'])->name('dashboard.users.create');
    Route::post('/dashboard/users/create', [UserController::class, 'store'])->name('dashboard.users.store');
    Route::get('/dashboard/users/edit/{user}', [UserController::class, 'edit'])->name('dashboard.users.edit');
    Route::put('/dashboard/users/update/{user}', [UserController::class, 'update'])->name('dashboard.users.update');
    Route::get('/dashboard/users/edit-password/{user}', [UserController::class, 'editPassword'])->name('dashboard.users.editPassword');
    Route::put('/dashboard/users/edit-password/{user}', [UserController::class, 'updatePassword'])->name('dashboard.users.updatePassword');
});



Route::get('/test', function(){
    return view('test');
});
