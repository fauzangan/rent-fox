<?php

use App\Http\Controllers\CategoryItemController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TagihanController;
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

Route::get('/', function () {
    return view('dashboard.main-dashboard.index');
});


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
Route::get('/dashboard/orders/create', [OrderController::class, 'create'])->name('dashboard.orders.create');
Route::post('/dashboard/orders/create', [OrderController::class, 'store'])->name('dashboard.orders.store');
Route::get('/dashboard/orders/edit/{order}', [OrderController::class, 'edit'])->name('dashboard.orders.edit');
Route::delete('/dashboard/orders/delete/{order}', [OrderController::class, 'destroy'])->name('dashboard.orders.delete');

// Tagihan Route
Route::get('/dashboard/tagihans', [TagihanController::class, 'index'])->name('dashboard.tagihans.index');
Route::get('/dashboard/tagihans/create', [TagihanController::class, 'create'])->name('dashboard.tagihans.create');
Route::post('/dashboard/tagihans/create', [TagihanController::class, 'store'])->name('dashboard.tagihans.store');
Route::get('/dashboard/tagihans/edit/{tagihan}', [TagihanController::class, 'edit'])->name('dashboard.tagihans.edit');
Route::put('/dashboard/tagihans/update/{tagihan}', [TagihanController::class, 'update'])->name('dashboard.tagihans.update');


Route::get('/test', function(){
    return view('test');
});
