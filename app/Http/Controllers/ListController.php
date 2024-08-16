<?php

namespace App\Http\Controllers;

// make sure to import listmodel
use App\Models\ListModel;
use App\Models\Order;
use App\Models\Customer; // Import the Customer model
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;


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

            'list_name' => 'required|max:255',
            'suburb' => 'required|max:255',
            'state' => 'required|max:255',
            'pincod' => 'required|max:255',
            'list_description' => 'required|string',
            'contact_number' => 'max:20',
            'contact_email' => 'required|email|max:255',
            'builder_name' => 'required|max:255',
            'status' => 'required|max:255',
            'product_name' => 'nullable|string|max:255', 
            'customer_id' => 'required|exists:customers,id',

        ]);
    

        ListModel::create([
            
            'name' => $request->input('list_name'),
            'suburb' => $request->input('suburb'),
            'state' => $request->input('state'),
            'pincod' => $request->input('pincod'),
            'description' => $request->input('list_description'),
            'contact_number' => $request->input('contact_number'),
            'contact_email' => $request->input('contact_email'),
            'builder_name' => $request->input('builder_name'),
            'status' => $request->input('status'),
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
            'name' => 'required|max:255',
            'suburb' => 'required|max:255',

            'state' => 'required|max:255',

            'pincod' => 'required|max:255',

            'description' => 'required|string',
            'contact_number' => 'max:20',
            'contact_email' => 'required|email|max:255',
            'builder_name' => 'required|max:255',
            'status' => 'required|max:255',
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
    
        // Retrieve only products that are in stock
        $products = Product::where('in_stock', 1)->orderBy('created_at', 'desc')->get();
    
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
  
  public function saveOrder(Request $request)
{
    if ($request->isMethod('post')) {
        $listId = $request->input('list_id');
        $customerId = $request->input('customer_id');
        $cartItems = $request->input('cart_items');
        $listEmail = $request->input('list_email');
        $customerEmail = $request->input('customer_email');

        try {
            // Retrieve the list data based on the list_id
            $list = ListModel::find($listId);

            if (!$list) {
                throw new \Exception("List not found.");
            }

            $ordersData = [];
            $orderId = null;

            foreach ($cartItems as $item) {
                $productCode = $item['product_code'];
                $productName = $item['product_name'];
                $quantity = $item['quantity'];
                $productImage = $item['product_order_image'];
                $productId = $item['product_id']; // Make sure this exists in your cart items

                // Check if an order with the same product_code and list_id exists
                $existingOrder = Order::where('product_id', $productId)
                    ->where('list_id', $listId)
                    ->where('customer_id', $customerId)
                    ->first();

                if ($existingOrder) {
                    // Update the quantity of the existing order
                    $existingOrder->quantity = $quantity;
                    $existingOrder->save();
                    
                    // Add the updated order details to ordersData
                    $ordersData[] = [
                        'product_name' => $productName,
                        'product_code' => $productCode,
                        'quantity' => $existingOrder->quantity, // Updated quantity
                        'product_order_image' => $productImage,
                        'order_id' => $existingOrder->id, // Existing order ID
                    ];
                } else {
                    // Create a new order
                    $order = Order::create([
                        'product_name' => $productName,
                        'product_code' => $productCode,
                        'quantity' => $quantity,
                        'product_order_image' => $productImage,
                        'list_email' => $listEmail,
                        'customer_email' => $customerEmail,
                        'customer_id' => $customerId,
                        'list_id' => $listId,
                        'product_id' => $productId, // Include the product_id
                    ]);

                    // Add the order ID to the ordersData array
                    $ordersData[] = [
                        'product_name' => $productName,
                        'product_code' => $productCode,
                        'quantity' => $quantity,
                        'product_order_image' => $productImage,
                        'order_id' => $order->id, // New order ID
                    ];

                    if (!$orderId) {
                        $orderId = $order->id;
                    }
                }
            }

            // Clear the cart from session
            $request->session()->forget('cart.' . $listId);

            $customer = Customer::find($customerId); // Ensure $customer is correctly retrieved
            $customerName = $customer ? $customer->name : 'Customer';

            $orderDate = now()->format('Y-m-d H:i:s');

            $orderData = [
                'customerName' => $customerName,
                'orderId' => $orderId,
                'orderDate' => $orderDate,
                'ordersData' => $ordersData,
                'customerEmail' => $customerEmail,
                'customer' => $customer, // Pass all customer details to the view
                'list' => $list, // Use the retrieved $list data here
            ];

            // Optionally send order confirmation emails
            // Mail::to($customerEmail)->send(new OrderConfirmation($orderData));
            // Mail::to($listEmail)->send(new OrderConfirmation($orderData));


            $pdf = Pdf::loadView('emails.order_confirmation', compact('orderData'));

    // Send the email to the customer with the PDF attachment
    Mail::send([], [], function ($message) use ($customer, $list, $pdf) {
        $message->to($customer->email)
                ->subject('Order Confirmation')
                ->attachData($pdf->output(), "invoice_{$list->id}.pdf");
    });

    // Send the email to the list email with the PDF attachment
    Mail::send([], [], function ($message) use ($list, $pdf) {
        $message->to($list->contact_email)
                ->subject('Order Confirmation')
                ->attachData($pdf->output(), "invoice_{$list->id}.pdf");
    });

            return redirect()->route('showlistcustomer', [
                'listId' => $listId,
                'customerId' => $customerId
                ])->with('success', 'Order saved successfully and email sent successfully.');


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

    $orders = Order::where('list_id', $listId)
    ->where('customer_id', $customerId)
    ->orderBy('created_at', 'desc') // Adjust as needed
    ->get();


    return view('list.show_list', compact('list', 'customer', 'orders'));
}


//  show list order update qty //

public function updateQuantity(Request $request, $orderId)

{
    $order = Order::find($orderId);
    
    if ($order) {

        $order->quantity = $request->input('quantity');

        $order->save();

        return response()->json(['success' => true, 'message' => 'Quantity updated successfully']);
    }

    return response()->json(['success' => false, 'message' => 'Order not found'], 404);
}


//  show list delete order  //

public function destroyOrders(Order $order)

{
    $order->delete();

    return redirect()->back()->with('success', 'Order deleted successfully.');
}

public function getLists(Request $request)

{
    $customerId = $request->input('customer_id');
    $lists = ListModel::where('customer_id', $customerId)->get(['id', 'name']);

    return response()->json($lists);
}


public function showList($list, $customer_id)

{
    // Fetch the necessary data based on $list and $customer_id
    // For example, fetch list details, customer details, etc.
    
    // Return a view with the data
    return view('lists.show_list', compact('list', 'customer_id'));
}


public function sendEmail($list_id, $customer_id)

{
    // Retrieve the list and customer based on the IDs
    $list = ListModel::find($list_id); // Replace with your actual model
    $customer = Customer::find($customer_id); // Replace with your actual model
    
    // Retrieve all orders associated with the list_id
    $ordersData = Order::where('list_id', $list_id)->get();

    // Prepare the order data to be sent to the email view
    $orderData = [
        'list' => $list,
        'customer' => $customer,
        'ordersData' => $ordersData
    ];

    // Generate the PDF from the Blade view
    $pdf = Pdf::loadView('emails.order_confirmation', compact('orderData'));

    // Send the email to the customer with the PDF attachment
    Mail::send([], [], function ($message) use ($customer, $list, $pdf) {
        $message->to($customer->email)
                ->subject('Order Confirmation')
                ->attachData($pdf->output(), "invoice_{$list->id}.pdf");
    });

    // Send the email to the list email with the PDF attachment
    Mail::send([], [], function ($message) use ($list, $pdf) {
        $message->to($list->contact_email)
                ->subject('Order Confirmation')
                ->attachData($pdf->output(), "invoice_{$list->id}.pdf");
    });

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Email sent successfully!');
}

}






