<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller


{
  
    public function showallproductdata()

{
    // Use paginate instead of all() to get a paginated collection
    $products = Product::paginate(10); 

    return view('products.product_list', compact('products'));
    
}


   //  create a product page ridirect controller start  // 

    public function create()
    
    {
        return view('products.add_product');
    }


    // product insert controller start //

    public function addproduct(Request $request)

    {

        $request->validate([

            'product_name' => 'required',
            'product_description' => 'required',
            'product_code' => 'required|unique:products,product_code',
            'product_price' => 'required|numeric',
            'product_stock' => 'required|integer',
            'product_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);


        $input = $request->all();


        if ($image = $request->file('product_image')) {

            $destinationPath = 'images/products/';
            $productImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $productImage);
            $input['product_image'] = "$productImage";
            
        }

        Product::create($input);

        return redirect()->route('showproduct')
                        ->with('success', 'Product created successfully.');
    }


   // view product show contaroller start //
    
    public function show(Product $product)

    {
        return view('products.show_product', compact('product'));
    }


    // product edit button edit page redirect controller start //

    public function edit(Product $product)

    {
        return view('products.edit_product', compact('product'));
    }


    // product update controller start //
    
    public function update(Request $request, Product $product)

{
    
    $request->validate([

        'product_name' => 'required|string|max:255',
        'product_description' => 'nullable|string',
        'product_code' => 'required|string|',
        'product_price' => 'required|numeric|min:0',
        'product_stock' => 'required|integer|min:0',
        'product_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
        
    ]);

    $input = $request->all();


    if ($image = $request->file('product_image')) {

        $destinationPath = 'images/products/';
        $productImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        $image->move($destinationPath, $productImage);
        $input['product_image'] = "$productImage";

        if ($product->product_image && file_exists(public_path('images/products/' . $product->product_image))) {
            unlink(public_path('images/products/' . $product->product_image));
        }

    } else {

        unset($input['product_image']);

    }

    $product->update($input);

    return redirect()->route('showproduct')
    
                    ->with('success', 'Product updated successfully');

}

    //  product delete controller start //

    public function destroy(Product $product)

    {
        $product->delete();

        return redirect()->route('showproduct')->with('success', 'Product deleted successfully.');
    }

    public function checkProductCode(Request $request)
    
{

    $productCode = $request->input('product_code');

    $exists = Product::where('product_code', $productCode)->exists();

    return response()->json(['exists' => $exists]);

}

  

}
