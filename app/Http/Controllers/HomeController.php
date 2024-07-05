<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Order;

class HomeController extends Controller

{
    /**
     * Create a new controller instance.
     *
     * @return void
     */     

    public function __construct()

    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     public function index()

    {
        
        $customerCount = Customer::count(); // Get the count of customers
        $productCount = Product::count(); // Get the count of products
        $orderCount = Order::count(); // Get the count of orders
        $recentOrders = Order::latest()->take(5)->get(); // Get the 5 most recent orders
        $totalEarnings = Order::sum('price'); // Calculate the total earnings


        return view('home', compact('customerCount', 'productCount', 'orderCount', 'recentOrders', 'totalEarnings'));

    }

}
