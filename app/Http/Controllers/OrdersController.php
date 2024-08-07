<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Order;


class OrdersController extends Controller

{
    public function showallorderdata()

    {
        // Use paginate instead of all() to get a paginated collection
        $orders = Order::orderBy('created_at', 'desc')->paginate(20);
    
        return view('order.order_list', compact('orders'));
        
    }

    public function viewsingalorders($id)

    {

        // Find the order by ID
        $order = Order::findOrFail($id);
    
        // Pass the order to the view
        return view('order.show_orders', compact('order'));
        
    }
    
    
}
