<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Order;


class OrdersController extends Controller

{
    public function showallorderdata()
    {
        // Fetch orders with related customer and product data
        $orders = Order::with(['customer', 'product'])->orderBy('created_at', 'desc')->paginate(20);
    
        return view('order.order_list', compact('orders'));
    }
    

    public function viewsingalorders($id)
    {
        // Find the order by ID
        $order = Order::with('product', 'customer')->findOrFail($id);
    
        // Pass the order to the view
        return view('order.show_orders', compact('order'));
    }
    
    
    
}
