<?php

namespace App\Http\Controllers;

// make sure to import listmodel
use App\Models\ListModel;
use App\Models\Order;
use App\Models\Customer; // Import the Customer model
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Mail;

// Make sure to import Product model    
use App\Models\Product; 
use Illuminate\Http\Request;
class ListController extends Controller


//  crate a new  list  file redirect controller  start  //

{
    public function createlist($customer_id)

    {
        return view('list.add_list', compact('customer_id'));
    }



// insert new list controller start //

    public function store(Request $request)


    {
        $request->validate([

            'list_name' => 'required|string|max:255',
            'list_description' => 'required|string',
            'contact_number' => 'required|string|max:20',
            'contact_email' => 'required|email|max:255',
            'product_name' => 'nullable|string|max:255', 
            'customer_id' => 'required|exists:customers,id',

        ]);
    

        ListModel::create([
            
            'name' => $request->input('list_name'),
            'description' => $request->input('list_description'),
            'contact_number' => $request->input('contact_number'),
            'contact_email' => $request->input('contact_email'),
            'product_name' => $request->input('product_name'),
            'customer_id' => $request->input('customer_id'),

        ]);

    
        return redirect()->route('customers.show', $request->input('customer_id'))
                         ->with('success', 'List created successfully.');
    }


    //  singal list show contriller start //

    public function show($id)

    {
        $list = ListModel::findOrFail($id);
        
        return view('list.show_list', compact('list'));
    }


    // list edit file redirect  controller start  //


    public function edit($id)

    {
        $list = ListModel::findOrFail($id);
        return view('list.edit_list', compact('list'));
    }



    // list update controller strat //

    public function update(Request $request, $id)

    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'contact_number' => 'required|string|max:20',
            'contact_email' => 'required|email|max:255',
            'product_name' => 'nullable|string|max:255',
        ]);
        
        $list = ListModel::findOrFail($id);
    
        $list->update($request->all());
    
        return redirect()->route('customers.show', $list->customer_id)
                         ->with('success', 'List updated successfully.');
    }
    

    // list delete controller start  //

    public function destroy($id)

    {
        $list = ListModel::findOrFail($id);

        $customer_id = $list->customer_id;
        
        $list->delete();

        return redirect()->route('customers.show', $customer_id)->with('success', 'List deleted successfully.');
    }  

    // add cart product controller start  //

    public function addcartproduct(ListModel $list, $customerId)

    {
    
        $list->load('products');

        $products = Product::all();

        return view('list.add_cart_product', compact('list', 'products'));

    }


     // addtocart product  create a session listid wise code //

    public function addToCart(Request $request, $listId)

    {
        $productId = $request->input('product_id');

        $quantity = $request->input('quantity');
    
        $customerId = session()->get('customer_id');
    
        $cart = session()->get('cart', []);
    
        if (!isset($cart[$listId])) {

            $cart[$listId] = [];

        }
    
        if (!isset($cart[$listId][$customerId])) {

            $cart[$listId][$customerId] = [];

        }
    
        $cart[$listId][$customerId][$productId] = [

            'product_id' => $productId,

            'quantity' => $quantity,

        ];
    
        session()->put('cart', $cart);
    
        return redirect()->back()->with('success', 'Product added to cart successfully.');
        
    }
    

    // add to cart product is a view listid wise //

    public function viewCart($listId)

    {   

        $list = ListModel::findOrFail($listId);


           $customerId = $list->customer_id;
    
           $customer = Customer::findOrFail($customerId); 
    
        $customerId = session()->get('customer_id');

        $cart = session()->get('cart', []);
        
        $cartItems = [];
    
        if (isset($cart[$listId][$customerId])) {

            $productIds = array_keys($cart[$listId][$customerId]);

            $products = Product::whereIn('id', $productIds)->get();
    
            foreach ($products as $product) {
                
                if (isset($cart[$listId][$customerId][$product->id])) {

                    $cartItems[] = [

                        'product' => $product,

                        'quantity' => $cart[$listId][$customerId][$product->id]['quantity'],

                    ];
                }

               }

        }
    
        return view('list.view_cart', compact('list', 'customer', 'cartItems'));
    }


    public function updateqty(Request $request, $listId, $productId)
    
    {
        $customerId = session()->get('customer_id');

        $cart = session()->get('cart', []);

        $quantity = $request->input('quantity');

        if (isset($cart[$listId][$customerId][$productId])) {

            $cart[$listId][$customerId][$productId]['quantity'] = $quantity;

            session()->put('cart', $cart);

            return redirect()->route('cart.view', $listId)->with('success', 'Quantity updated successfully.');
        }

        return redirect()->route('cart.view', $listId)->with('error', 'Product not found in cart.');
    }

  //  remove product in add to cart product //

  public function removeFromCart($listId, $productId, $customerId)
  
  {

      $sessionCustomerId = session()->get('customer_id');
  
   
      $cart = session()->get('cart', []);
  
      if (isset($cart[$listId][$sessionCustomerId]) && array_key_exists($productId, $cart[$listId][$sessionCustomerId])) {

          unset($cart[$listId][$sessionCustomerId][$productId]);
  
          session()->put('cart', $cart);


          return redirect()->route('lists.view-cart', ['list' => $listId, 'customer_id' => $customerId])
                         ->with('success', 'Product removed from cart successfully.');

      }
  
   return redirect()->route('lists.view-cart', ['list' => $listId, 'customer_id' => $customerId])
                     ->with('error', 'Product not found in cart.');

  }
  

  // save orders controller //

  public function saveOrder(Request $request)
{
    if ($request->isMethod('post')) {

        $listId = $request->input('list_id');
        $customerId = $request->input('customer_id');
        $cartItems = $request->input('cart_items');
        $listEmail = $request->input('list_email');
        $customerEmail = $request->input('customer_email');

        try {
            $ordersData = [];
            $totalAmount = 0;

            foreach ($cartItems as $item) {
                $productCode = $item['product_code'];
                $productName = $item['product_name'];
                $quantity = $item['quantity'];
                $productImage = $item['product_order_image'];

                $product = Product::where('product_code', $productCode)->first();

                if (!$product) {
                    return redirect()->back()->with('error', 'Product with code ' . $productCode . ' not found.');
                }

                if ($product->product_stock < $quantity) {
                    return redirect()->back()->with('error', 'Insufficient stock for product ' . $productName . '.');
                }

                $product->product_stock -= $quantity;
                $product->save();

                $order = Order::create([
                    'product_name' => $productName,
                    'product_code' => $productCode,
                    'quantity' => $quantity,
                    'product_order_image' => $productImage,
                    'list_email' => $listEmail,
                    'customer_email' => $customerEmail,
                    'customer_id' => $customerId,
                    'list_id' => $listId,
                ]);

                $ordersData[] = [
                    'product_name' => $productName,
                    'product_code' => $productCode,
                    'quantity' => $quantity,
                ];
            }

            $request->session()->forget('cart.' . $listId);

            $customer = Customer::find($customerId);
            $customerName = $customer ? $customer->name : 'Customer';

            $latestOrder = Order::latest()->first();
            $orderId = $latestOrder ? $latestOrder->id : 'N/A';
            $orderDate = $latestOrder ? $latestOrder->created_at->format('Y-m-d H:i:s') : now();

            $orderData = [
                'customerName' => $customerName,
                'orderId' => $orderId,
                'orderDate' => $orderDate,
                'ordersData' => $ordersData,
                'customerEmail' => $customerEmail,
            ];

            Mail::to($customerEmail)->send(new OrderConfirmation($orderData));
            Mail::to($listEmail)->send(new OrderConfirmation($orderData));

            return redirect()->route('lists.view-cart-get-method', ['list' => $listId, 'customer_id' => $customerId])
                             ->with('success', 'Order saved successfully! Cart items removed.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to save order. ' . $e->getMessage());
        }

    } else {
        return redirect()->back();
    }
}



  public function removeShowListFromCart($listId, $productId, $customerId)
  
  {

      $sessionCustomerId = session()->get('customer_id');
     
      $cart = session()->get('cart', []);
  
      if (isset($cart[$listId][$sessionCustomerId]) && array_key_exists($productId, $cart[$listId][$sessionCustomerId])) {

          unset($cart[$listId][$sessionCustomerId][$productId]);
  
          session()->put('cart', $cart);


          return redirect()->route('lists.showlistcoustomer', ['list' => $listId, 'customer_id' => $customerId])
                         ->with('success', 'Product removed from cart successfully.');

      }
  
   return redirect()->route('lists.showlistcoustomer', ['list' => $listId, 'customer_id' => $customerId])
                     ->with('error', 'Product not found in cart.');
  }

  public function showListCustomer($listId, $customerId)

{

    $list = ListModel::find($listId);
    $customer = Customer::find($customerId);

    if (!$list || !$customer) {

        abort(404, 'List or Customer not found');

    }

    $orders = Order::where('list_id', $listId)->where('customer_id', $customerId)->get();

    return view('list.show_list', compact('list', 'customer', 'orders'));
}


//  show list order update qty //

public function updateQuantity(Request $request, $id)

{   
    try {

        $order = Order::findOrFail($id);
        $order->quantity = $request->input('quantity');
        $order->save();

        return response()->json(['success' => true, 'message' => 'Quantity updated successfully.']);

    } catch (\Exception $e) {

        Log::error('Failed to update quantity: ' . $e->getMessage());
        return response()->json(['success' => false, 'message' => 'Failed to update quantity.'], 500);
        
    }
}

//  show list delete order  //

public function destroyOrders(Order $order)

{
    $order->delete();

    return redirect()->back()->with('success', 'Order deleted successfully.');
}

}



