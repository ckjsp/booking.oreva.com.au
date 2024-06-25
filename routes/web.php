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

    // Product resource routes  //
    Route::resource('products', ProductController::class);

    Route::post('/products/add', [ProductController::class, 'addproduct'])->name('addproduct');

    // showproduct  routes  //
    Route::get('/showproduct', [ProductController::class, 'showallproductdata'])->name('showproduct'); 

    // Customer status routes  
    Route::put('/customers/{id}/updateStatus', [CustomerController::class, 'updateStatus'])->name('customers.updateStatus');

    //  createlist form route //
    Route::get('/createlist/{customer_id}', [ListController::class, 'createlist'])->name('createlist');

    // insert list data route 
    Route::post('/lists', [ListController::class, 'store'])->name('lists.store');

    // show list data route //
    Route::get('/lists/{id}', [ListController::class, 'show'])->name('lists.show');

    //  edit list data route //
    Route::get('/lists/{id}/edit', [ListController::class, 'edit'])->name('lists.edit');

    Route::put('/lists/{id}', [ListController::class, 'update'])->name('lists.update');

    // delete list data route //
    Route::delete('lists/{id}', [ListController::class, 'destroy'])->name('lists.destroy');
    
    // add cart product route //
    Route::get('/lists/{list}/products/{customer}', [ListController::class, 'addCartProduct'])->name('lists.addcartproduct');

    // add to cart product route //
    Route::post('/lists/add-to-cart/{list}/{customer}', [ListController::class, 'addToCart'])->name('lists.add-to-cart');

    // add to cart product save button route //
    Route::get('/lists/{list}/view-cart/{customer_id}', [ListController::class, 'viewCart'])->name('lists.view-cart');

    // remove cart item route //
    Route::delete('/cart/remove/{list}/{productId}/{customerId}', [ListController::class, 'removeFromCart'])->name('cart.remove');

    // remove product redirect view paroduct route // 
    Route::get('/cart/view/{listId}', [ListController::class, 'viewCart'])->name('cart.view');

    // product  updateqty qty route //
    Route::patch('/cart/update/{list}/{productId}', [ListController::class, 'updateqty'])->name('cart.updateqty');

    // save orders route //
    Route::post('/orders/save', [ListController::class, 'saveOrder'])->name('orders.save');

    Route::get('/lists/{list}/showlistcoustomer/{customer_id}', [ListController::class, 'showlistcoustomer'])->name('lists.showlistcoustomer');


    Route::delete('/cart/removeShowListFromCart/{list}/{productId}/{customerId}', [ListController::class, 'removeShowListFromCart'])->name('cart.removeShowListFromCart');


});
