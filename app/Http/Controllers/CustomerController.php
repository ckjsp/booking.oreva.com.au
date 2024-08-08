<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller

{
    /**
     * Display a listing of the resource.
     */

    public function index()

    {
        $customers = Customer::orderBy('created_at', 'desc')->get();
        return view('customers.customers_list', compact('customers'));
    }
    
    /**
     * Show the form for creating a new resource.
     */

    public function create()

    {
        return view('customers.add_customers');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)

    {
        $request->validate([

            'name' => 'required',
            'email' => 'required|email|unique:customers,email',
            'city' => 'required',
            'phone' => 'required',
            'builder' => 'required',
            'status' => 'required',
        ], [
            'phone.regex' => 'The phone number must be in international format, e.g., +1234567890.',
            'email.unique' => 'The email address has already been taken.',
        ]);

        Customer::create($request->only(['name', 'email', 'city', 'phone','builder', 'status']));
        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');

    }

    /**
     * Display the specified resource.
     */

    public function show(Customer $customer)
{
    // Ensure lists are sorted by 'created_at' in descending order
    $lists = $customer->lists()->orderBy('created_at', 'desc')->get();

    return view('customers.show_customers', compact('customer', 'lists'));
}

     

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(Customer $customer)

    {
        return view('customers.edit_customers', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */

     public function update(Request $request, Customer $customer)
     {
         $request->validate([
             'name' => 'required',
             'email' => 'required|email|unique:customers,email,' . $customer->id,
             'city' => 'required',
             'phone' => 'required',
             'builder' => 'required',
             'status' => 'required',
         ], [
             'phone.regex' => 'The phone number must be in international format, e.g., +1234567890.',
             'email.unique' => 'The email address has already been taken.',
         ]);
     
         $customer->update($request->only(['name', 'email', 'city', 'phone', 'builder', 'status']));
     
         return redirect()->route('customers.edit', ['customer' => $customer->id])->with('success', 'Customer updated successfully.');
     }
     

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Customer $customer)

    {

        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');

    }

    public function updateStatus(Request $request, $id)

    {
        $customer = Customer::findOrFail($id);

        $customer->status = $request->input('status');

        $customer->save();

        // Store email in session

        $request->session()->put('status_email', $customer->email);

        // Fetch all customers again for display (or you can fetch just one customer and pass it to the view)

        $customers = Customer::all();

        // Return view with updated status message
        return response()->json(['success' => 'Status updated successfully']);
        // return redirect()->route('customers.index')->with('success', 'Customer status updated successfully.');

    }


    public function showlistcoustomer($id)

{
    // Fetch the customer details based on $id
    $customer = Customer::findOrFail($id); 

    return view('list.show_list', compact('customer'));
}

public function checkEmail(Request $request)
{
    $email = $request->input('email');
    $exists = Customer::where('email', $email)->exists();

    return response()->json(['available' => !$exists]);
}




}
