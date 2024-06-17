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

    // showproduct  routes
    Route::get('/showproduct', [ProductController::class, 'showallproductdata'])->name('showproduct'); 

   // Customer status routes  
    Route::put('/customers/{id}/updateStatus', [CustomerController::class, 'updateStatus'])->name('customers.updateStatus');

    //  createbranch form route 
    
    Route::get('/createlist/{customer_id}', [ListController::class, 'createlist'])->name('createlist');

    Route::post('/lists', [ListController::class, 'store'])->name('lists.store');


    
});
