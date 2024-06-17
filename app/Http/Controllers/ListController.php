<?php

namespace App\Http\Controllers;

use App\Models\ListModel;
use Illuminate\Http\Request;

class ListController extends Controller

{
    public function createlist($customer_id)

    {
        return view('list.add_list', compact('customer_id'));
    }

    public function store(Request $request)

    {
        $request->validate([

            'list_name' => 'required',
            'list_description' => 'required',
            'contact_number' => 'required',
            'contact_email' => 'required|email',
            'product_name' => 'nullable', // Allow null values
            'customer_id' => 'required|exists:customers,id',

        ]);

        ListModel::create([

            'name' => $request->input('list_name'),
            'description' => $request->input('list_description'),
            'contact_number' => $request->input('contact_number'),
            'contact_email' => $request->input('contact_email'),
            'product_name' => $request->input('product_name'), // Nullable field
            'customer_id' => $request->input('customer_id'),
        ]);

        return redirect()->route('customers.show', $request->input('customer_id'))
                         ->with('success', 'List created successfully.');

    }
}
