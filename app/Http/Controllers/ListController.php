<?php

namespace App\Http\Controllers;

// make sure to import listmodel
use App\Models\ListModel;

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

        return redirect()->route('lists.show', $list->id)
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
        // Retrieve the list based on the provided list ID
        $list = ListModel::findOrFail($listId);
    
        // Retrieve customer ID from session
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
    
        return view('list.view_cart', compact('list', 'cartItems'));
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

  public function removeFromCart($listId, $productId)
  
{
    $customerId = session()->get('customer_id');

    $cart = session()->get('cart', []);

    if (isset($cart[$listId][$customerId]) && array_key_exists($productId, $cart[$listId][$customerId])) {
        unset($cart[$listId][$customerId][$productId]);

        session()->put('cart', $cart);

        return redirect()->route('lists.view-cart', $listId)->with('success', 'Product removed from cart successfully.');
    }

    return redirect()->route('lists.view-cart', $listId)->with('error', 'Product not found in cart.');
}

}