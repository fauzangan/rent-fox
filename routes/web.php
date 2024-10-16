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
use App\Http\Controllers\TestingWordController;
use App\Http\Controllers\TotalLogistikController;
use App\Http\Controllers\UserController;
use App\Models\Logistik;
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
    Route::get('/dashboard/customers', [CustomerController::class, 'index'])
        ->name('dashboard.customers.index')
        ->middleware('can:lihat-customers');

    Route::get('/dashboard/customers/create', [CustomerController::class, 'create'])
        ->name('dashboard.customers.create')
        ->middleware('can:tambah-customers');

    Route::post('/dashboard/customers/create', [CustomerController::class, 'store'])
        ->name('dashboard.customers.store')
        ->middleware('can:tambah-customers');

    Route::get('/dashboard/customers/detail/{customer}', [CustomerController::class, 'getCustomerDetails'])
        ->name('dashboard.customers.detail')
        ->middleware('can:lihat-customers');

    Route::get('/dashboard/customers/edit/{customer}', [CustomerController::class, 'edit'])
        ->name('dashboard.customers.edit')
        ->middleware('can:edit-customers');

    Route::put('/dashboard/customers/update/{customer}', [CustomerController::class, 'update'])
        ->name('dashboard.customers.update')
        ->middleware('can:edit-customers');

    Route::delete('/dashboard/customers/delete/{customer}', [CustomerController::class, 'destroy'])
        ->name('dashboard.customers.delete')
        ->middleware('can:hapus-customers');

    // Category Item Route
    Route::get('/dashboard/category-items/index', [CategoryItemController::class, 'index'])
        ->name('dashboard.category-items.index')
        ->middleware('can:lihat-category-items');

    Route::get('/dashboard/category-items/create', [CategoryItemController::class, 'create'])
        ->name('dashboard.category-items.create')
        ->middleware('can:tambah-category-items');

    Route::post('/dashboard/category-items/create', [CategoryItemController::class, 'store'])
        ->name('dashboard.category-items.store')
        ->middleware('can:tambah-category-items');

    Route::get('/dashboard/category-items/edit/{categoryItem}', [CategoryItemController::class, 'edit'])
        ->name('dashboard.category-items.edit')
        ->middleware('can:edit-category-items');

    Route::put('/dashboard/category-items/update/{categoryItem}', [CategoryItemController::class, 'update'])
        ->name('dashboard.category-items.update')
        ->middleware('can:edit-category-items');

    // Items Route
    Route::get('/dashboard/items', [ItemController::class, 'index'])
        ->name('dashboard.items.index')
        ->middleware('can:lihat-items');

    Route::get('/dashboard/items/create', [ItemController::class, 'create'])
        ->name('dashboard.items.create')
        ->middleware('can:tambah-items');

    Route::post('/dashboard/items/create', [ItemController::class, 'store'])
        ->name('dashboard.items.store')
        ->middleware('can:tambah-items');

    Route::get('/dashboard/items/edit/{item}', [ItemController::class, 'edit'])
        ->name('dashboard.items.edit')
        ->middleware('can:edit-items');

    Route::put('/dashboard/items/update/{item}', [ItemController::class, 'update'])
        ->name('dashboard.items.update')
        ->middleware('can:edit-items');

    Route::delete('/dashboard/items/delete/{item}', [ItemController::class, 'destroy'])
        ->name('dashboard.items.delete')
        ->middleware('can:hapus-items');

    // Order Route
    Route::get('/dashboard/orders', [OrderController::class, 'index'])
        ->name('dashboard.orders.index')
        ->middleware('can:lihat-orders');

    Route::get('/dashboard/orders/detail/{order}', [OrderController::class, 'detail'])
        ->name('dashboard.orders.detail')
        ->middleware('can:lihat-orders');

    Route::post('/dashboard/orders/detail/{order}/post-discount', [OrderController::class, 'postDiscount'])
        ->name('dashboard.orders.detail.post-discount')
        ->middleware('can:edit-orders');

    Route::post('/dashboard/orders/detail/{order}/post-biaya-transport', [OrderController::class, 'postBiayaTransport'])
        ->name('dashboard.orders.detail.post-biaya-transport')
        ->middleware('can:edit-orders');

    Route::post('/dashboard/orders/detail/{order}/post-down-payment', [OrderController::class, 'postDownPayment'])
        ->name('dashboard.orders.detail.post-down-payment')
        ->middleware('can:edit-orders');

    Route::get('/dashboard/orders/detail/{order}/get-order-data', [OrderController::class, 'getOrder'])
        ->name('dashboard.orders.detail.get-order-data')
        ->middleware('can:lihat-orders');

    Route::get('/dashboard/orders/create', [OrderController::class, 'create'])
        ->name('dashboard.orders.create')
        ->middleware('can:tambah-orders');

    Route::post('/dashboard/orders/create', [OrderController::class, 'store'])
        ->name('dashboard.orders.store')
        ->middleware('can:tambah-orders');

    Route::get('/dashboard/orders/edit/{order}', [OrderController::class, 'edit'])
        ->name('dashboard.orders.edit')
        ->middleware('can:edit-orders');

    Route::put('/dashboard/orders/update/{order}', [OrderController::class, 'update'])
        ->name('dashboard.orders.update')
        ->middleware('can:edit-orders');

    Route::delete('/dashboard/orders/delete/{order}', [OrderController::class, 'destroy'])
        ->name('dashboard.orders.delete')
        ->middleware('can:hapus-orders');

    // Tagihan Route
    Route::get('/dashboard/tagihans', [TagihanController::class, 'index'])
        ->name('dashboard.tagihans.index')
        ->middleware('can:lihat-tagihans');

    Route::get('/dashboard/tagihans/create', [TagihanController::class, 'create'])
        ->name('dashboard.tagihans.create')
        ->middleware('can:tambah-tagihans');

    Route::get('/dashboard/tagihans/getOrderData/{order}', [TagihanController::class, 'getOrder'])
        ->name('dashboard.tagihans.get-order-data')
        ->middleware('can:lihat-tagihans');

    Route::post('/dashboard/tagihans/create', [TagihanController::class, 'store'])
        ->name('dashboard.tagihans.store')
        ->middleware('can:tambah-tagihans');

    Route::get('/dashboard/tagihans/edit/{tagihan}', [TagihanController::class, 'edit'])
        ->name('dashboard.tagihans.edit')
        ->middleware('can:edit-tagihans');

    Route::put('/dashboard/tagihans/update/{tagihan}', [TagihanController::class, 'update'])
        ->name('dashboard.tagihans.update')
        ->middleware('can:edit-tagihans');

    // Logistik Route
    Route::get('/dashboard/logistiks', [LogistikController::class, 'index'])
        ->name('dashboard.logistiks.index')
        ->middleware('can:lihat-logistiks');

    // Logistik Harian Route
    Route::get('/dashboard/logistik-harians', [LogistikHarianController::class, 'index'])
        ->name('dashboard.logistik-harians.index')
        ->middleware('can:lihat-logistiks');

    Route::get('/dashboard/logistik-harians/edit/{logistikHarian}', [LogistikHarianController::class, 'edit'])
        ->name('dashboard.logistik-harians.edit')
        ->middleware('can:edit-logistik-harians');

    Route::put('/dashboard/logistik-harians/update/{logistikHarian}', [LogistikHarianController::class, 'update'])
        ->name('dashboard.logistik-harians.update')
        ->middleware('can:edit-logistik-harians');

    Route::get('/dashboard/logistik-harians/create', [LogistikHarianController::class, 'create'])
        ->name('dashboard.logistik-harians.create')
        ->middleware('can:tambah-logistik-harians');

    Route::post('/dashboard/logistik-harians/create', [LogistikHarianController::class, 'store'])
        ->name('dashboard.logistik-harians.store')
        ->middleware('can:tambah-logistik-harians');

    Route::get('/dashboard/logistik-harians/getLogistikHarians/{orderId}', [LogistikHarianController::class, 'getLogistikHarian'])
        ->name('dashboard.logistik-harians.getLogistikHarian')
        ->middleware('can:lihat-logistik-harians');

    Route::get('/dashboard/logistik-harians/getOrder/{orderId}', [LogistikHarianController::class, 'getOrder'])
        ->name('dashboard.logistik-harians.getOrder')
        ->middleware('can:lihat-logistik-harians');

    Route::get('/dashboard/logistik-harians/getOrderItem/{orderId}', [LogistikHarianController::class, 'getOrderItems'])
        ->name('dashboard.logistik-harians.getOrderItem')
        ->middleware('can:lihat-logistik-harians');

    Route::get('/dashboard/logistik-harians/getCustomerOrders/{customerId}', [LogistikHarianController::class, 'getCustomerOrders'])
        ->name('dashboard.logistik-harians.getCustomerOrder')
        ->middleware('can:lihat-logistik-harians');

    Route::get('/dashboard/logistik-harians/getSisa/{orderId}', [LogistikHarianController::class, 'getPengirimanAndPengembalian'])
        ->name('dashboard.logistik-harians.getPengiriman')
        ->middleware('can:lihat-logistik-harians');

    // Reservasi Route
    Route::get('/dashboard/reservasis', [ReservasiController::class, 'index'])
        ->name('dashboard.reservasis.index')
        ->middleware('can:lihat-reservasis');

    Route::get('/dashboard/reservasis/create', [ReservasiController::class,'create'])
        ->name('dashboard.reservasis.create')
        ->middleware('can:tambah-reservasis');

    Route::post('/dashboard/reservasis/create', [ReservasiController::class,'store'])
        ->name('dashboard.reservasis.store')
        ->middleware('can:tambah-reservasis');

    Route::get('/dashboard/reservasis/edit/{reservasi}', [ReservasiController::class, 'edit'])
        ->name('dashboard.reservasis.edit')
        ->middleware('can:edit-reservasis');

    Route::put('/dashboard/reservasis/update/{reservasi}', [ReservasiController::class, 'update'])
        ->name('dashboard.reservasis.update')
        ->middleware('can:edit-reservasis');

    // Total Logistik Route
    Route::get('/dashboard/total-logistiks', [TotalLogistikController::class, 'index'])
        ->name('dashboard.total-logistiks.index')
        ->middleware('can:lihat-logistik-totals');

    Route::get('/dashboard/total-logistiks/create', [TotalLogistikController::class, 'create'])
        ->name('dashboard.total-logistiks.create')
        ->middleware('can:tambah-logistik-totals');

    Route::post('/dashboard/total-logistiks/create', [TotalLogistikController::class, 'store'])
        ->name('dashboard.total-logistiks.store')
        ->middleware('can:tambah-logistik-totals');

    Route::get('/dashboard/total-logistiks/edit/{totalLogistik}', [TotalLogistikController::class, 'edit'])
        ->name('dashboard.total-logistiks.edit')
        ->middleware('can:edit-logistik-totals');

    Route::put('/dashboard/total-logistiks/update/{totalLogistik}', [TotalLogistikController::class, 'update'])
        ->name('dashboard.total-logistiks.update')
        ->middleware('can:edit-logistik-totals');


    // Buku Harian Route
    Route::get('/dashboard/buku-harians', [BukuHarianController::class, 'index'])
        ->name('dashboard.buku-harians.index')
        ->middleware('can:lihat-buku-harians');

    Route::get('/dashboard/buku-harians/create', [BukuHarianController::class, 'create'])
        ->name('dashboard.buku-harians.create')
        ->middleware('can:tambah-buku-harians');

    Route::get('/dashboard/buku-harians/getSaldoData', [BukuHarianController::class, 'getSaldoData'])
        ->name('dashboard.buku-harians.getSaldoData')
        ->middleware('can:lihat-buku-harians');

    Route::get('/dashboard/buku-harians/getSaldoData/{bukuHarian}', [BukuHarianController::class, 'getSaldoDataEdit'])
        ->name('dashboard.buku-harians.getSaldoData-edit')
        ->middleware('can:lihat-buku-harians');

    Route::get('/dashboard/buku-harians/getOrderData/{orderId}', [BukuHarianController::class, 'getOrderData'])
        ->name('dashboard.buku-harians.getOrderData')
        ->middleware('can:lihat-buku-harians');

    Route::get('/dashboard/buku-harians/getCustomerData/{customerId}', [BukuHarianController::class, 'getCustomerData'])
        ->name('dashboard.buku-harians.getCustomerData')
        ->middleware('can:lihat-buku-harians');

    Route::post('/dashboard/buku-harians/store', [BukuHarianController::class, 'store'])
        ->name('dashboard.buku-harians.store')
        ->middleware('can:tambah-buku-harians');

    Route::get('/dashboard/buku-harians/edit/{bukuHarian}', [BukuHarianController::class, 'edit'])
        ->name('dashboard.buku-harians.edit')
        ->middleware('can:edit-buku-harians');

    Route::put('/dashboard/buku-harians/update/{bukuHarian}', [BukuHarianController::class, 'update'])
        ->name('dashboard.buku-harians.update')
        ->middleware('can:edit-buku-harians');

    // Jurnal Bulanan Route
    Route::get('/dashboard/jurnal-bulanans', [JurnalBulananController::class, 'index'])
        ->name('dashboard.jurnal-bulanans.index')
        ->middleware('can:lihat-journal-bulanans');

    Route::post('/dashboard/jurnal-bulanans', [JurnalBulananController::class, 'filter'])
        ->name('dashboard.jurnal-bulanans.filter')
        ->middleware('can:lihat-journal-bulanans');

    // Hak Akses Route
    Route::get('/dashboard/hak-akses', [RoleController::class, 'index'])
        ->name('dashboard.hak-akses.index')
        ->middleware('can:lihat-hak-akses');

    Route::get('/dashboard/hak-akses/create', [RoleController::class, 'create'])
        ->name('dashboard.hak-akses.create')
        ->middleware('can:tambah-hak-akses');

    Route::post('/dashboard/hak-akses/create', [RoleController::class, 'store'])
        ->name('dashboard.hak-akses.store')
        ->middleware('can:tambah-hak-akses');

    Route::get('/dashboard/hak-akses/edit/{role}', [RoleController::class, 'edit'])
        ->name('dashboard.hak-akses.edit')
        ->middleware('can:edit-hak-akses');

    Route::put('/dashboard/hak-akses/update/{role}', [RoleController::class, 'update'])
        ->name('dashboard.hak-akses.update')
        ->middleware('can:edit-hak-akses');

    // User Route
    Route::get('/dashboard/users', [UserController::class, 'index'])
        ->name('dashboard.users.index')
        ->middleware('can:lihat-users');

    Route::get('/dashboard/users/create', [UserController::class, 'create'])
        ->name('dashboard.users.create')
        ->middleware('can:tambah-users');

    Route::post('/dashboard/users/create', [UserController::class, 'store'])
        ->name('dashboard.users.store')
        ->middleware('can:tambah-users');

    Route::get('/dashboard/users/edit/{user}', [UserController::class, 'edit'])
        ->name('dashboard.users.edit')
        ->middleware('can:edit-users');

    Route::put('/dashboard/users/update/{user}', [UserController::class, 'update'])
        ->name('dashboard.users.update')
        ->middleware('can:edit-users');

    Route::get('/dashboard/users/edit-password/{user}', [UserController::class, 'editPassword'])
        ->name('dashboard.users.editPassword')
        ->middleware('can:edit-users');

    Route::put('/dashboard/users/edit-password/{user}', [UserController::class, 'updatePassword'])
        ->name('dashboard.users.updatePassword')
        ->middleware('can:edit-users');
});

Route::get('/export/invoice/{id}', [TestingWordController::class, 'createInvoiceFromTemplate']);

Route::get('/test', function(){
    return view('test');
});
