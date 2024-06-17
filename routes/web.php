<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ListController;

// Authentication routes
Auth::routes();

Route::middleware(['auth'])->group(function () {

    // Route to home or root
    Route::get('/', [CustomerController::class, 'index'])->name('home');

    Route::get('/home', [CustomerController::class, 'index'])->name('home');

    // Customer resource routes
    Route::resource('customers', CustomerController::class);

    // Product resource routes
    Route::resource('products', ProductController::class);

    Route::post('/products/add', [ProductController::class, 'addproduct'])->name('addproduct');

    // showproduct  routes
    Route::get('/showproduct', [ProductController::class, 'showallproductdata'])->name('showproduct'); 

   // Customer status routes  
    Route::put('/customers/{id}/updateStatus', [CustomerController::class, 'updateStatus'])->name('customers.updateStatus');

    //  createlist form route 
    Route::get('/createlist/{customer_id}', [ListController::class, 'createlist'])->name('createlist');

    Route::post('/lists', [ListController::class, 'store'])->name('lists.store');


Route::get('lists/create/{customer_id}', [ListController::class, 'createlist'])->name('createlist');
Route::post('lists/store', [ListController::class, 'store'])->name('lists.store');
Route::get('lists/show/{id}', [ListController::class, 'show'])->name('lists.show');


});
