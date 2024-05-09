<?php

use App\Http\Controllers\CustomerController;
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

Route::get('/dashboard/customers', [CustomerController::class, 'index'])->name('dashboard.customers.index');
Route::get('/dashboard/customers/create', [CustomerController::class, 'create'])->name('dashboard.customers.create');
Route::post('/dashboard/customers/create', [CustomerController::class, 'store'])->name('dashboard.customers.store');
Route::get('/dashboard/customers/detail/{customer}', [CustomerController::class, 'getCustomerDetails'])->name('dashboard.customers.detail');
Route::get('/dashboard/customers/edit/{customer}', [CustomerController::class, 'edit'])->name('dashboard.customers.edit');
Route::put('/dashboard/customers/update/{customer}', [CustomerController::class, 'update'])->name('dashboard.customers.update');
Route::delete('/dashboard/customers/delete/{customer}', [CustomerController::class, 'destroy'])->name('dashboard.customers.delete');

