<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Order;
use App\Models\Setting;

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
        $customers = Customer::with('orders')->get();
        $productCount = Product::count(); // Get the count of products
        $orderCount = Order::count(); // Get the count of orders
        $recentProduct = Product::latest()->take(3)->get(); // Get the 3 most recent products

      

        return view('home', compact('customerCount', 'productCount', 'orderCount', 'recentProduct', 'customers'));
    }
}
