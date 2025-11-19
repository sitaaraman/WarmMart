<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CustomerController;

// Route::get('/', function () {
//     return view('welcome');
// });


// Admin Product Routes
// Route::prefix('admin')->name('admin.')->group(function () {
//     Route::resource('products', ProductController::class);
// });

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('products/show/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::get('products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
});

Route::prefix('')->name('customers.')->group(function () {
    Route::get('/', [CustomerController::class, 'index'])->name('index');
    Route::get('/create', [CustomerController::class, 'create'])->name('create');
    Route::post('/store', [CustomerController::class, 'store'])->name('store');
    Route::get('/{id}', [CustomerController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [CustomerController::class, 'edit'])->name('edit');
    Route::put('/{id}/update', [CustomerController::class, 'update'])->name('update');
    Route::delete('/{id}/delete', [CustomerController::class, 'destroy'])->name('destroy');
});