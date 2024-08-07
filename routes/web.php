<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\DashboardController;


// Authentication routes
Auth::routes();

Route::middleware(['auth'])->group(function () {

    // Route to home or root
    // Route::get('/', [CustomerController::class, 'index'])->name('home');

    // Route::get('/home', [CustomerController::class, 'index'])->name('home');

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Customer resource routes
    Route::resource('customers', CustomerController::class);

    Route::get('/get-lists', [ListController::class, 'getLists'])->name('get-lists');

    // Product resource routes
    Route::resource('products', ProductController::class);

    Route::post('/check-product-code', [ProductController::class, 'checkProductCode'])->name('checkProductCode');


    Route::post('/products/add', [ProductController::class, 'addproduct'])->name('addproduct');

    // showproduct  routes
    Route::get('/showproduct', [ProductController::class, 'showallproductdata'])->name('showproduct');


    // Customer status routes  
    Route::put('/customers/{id}/updateStatus', [CustomerController::class, 'updateStatus'])->name('customers.updateStatus');

    //  createlist form route 
    Route::get('/createlist/{customer_id}', [ListController::class, 'createlist'])->name('createlist');

    // insert list data route 
    Route::post('/lists', [ListController::class, 'store'])->name('lists.store');

    // show list data route 
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
    Route::post('/lists/{list}/view-cart/{customer_id}', [ListController::class, 'viewCart'])->name('lists.view-cart');


    Route::get('/lists/{list}/view-cart/{customer_id}', [ListController::class, 'viewCart'])->name('lists.view-cart-get-method');

    // remove cart item route //
    Route::delete('/cart/remove/{list}/{productId}/{customerId}', [ListController::class, 'removeFromCart'])->name('cart.remove');

    // remove product redirect view paroduct route // 
    Route::get('/cart/view/{listId}', [ListController::class, 'viewCart'])->name('cart.view');

    // product  updateqty qty route //
    Route::patch('/cart/update/{list}/{productId}', [ListController::class, 'updateqty'])->name('cart.updateqty');

    // save orders route //
    Route::post('/orders/save', [ListController::class, 'saveOrder'])->name('orders.save');


    Route::get('/list/{listId}/customer/{customerId}', [ListController::class, 'showListCustomer'])->name('showlistcustomer');

    // show list page update qty //
    Route::patch('/orders/{order}/updateQuantity', [ListController::class, 'updateQuantity'])->name('orders.updateQuantity');

    // orders delete show list page //
    Route::delete('/orders/{order}', [ListController::class, 'destroyOrders'])->name('orders.destroyOrders');

    Route::post('/products/update-stock', [ProductController::class, 'updateStock'])->name('products.updateStock'); 

    // showorder routes
    Route::get('/showorder', [OrdersController::class, 'showallorderdata'])->name('showorder');

    Route::get('/vieworders/{id}', [OrdersController::class, 'viewsingalorders'])->name('vieworders');

    // In your routes/web.php
    Route::post('/check-email', [CustomerController::class, 'checkEmail'])->name('check.email');

    


});
