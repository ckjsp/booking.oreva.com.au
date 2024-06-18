@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Show Customer</h2>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $customer->name }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                {{ $customer->email }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>City:</strong>
                {{ $customer->city }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Phone:</strong>
                {{ $customer->phone }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Status:</strong>
                {{ $customer->status }}
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Lists</h2>
            </div>
            
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('createlist', ['customer_id' => $customer->id]) }}">Create List</a>
            </div>
        </div>
    </div>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>List Name</th>
                <th>Product Description</th>
                <th>Contact Number</th>
                <th>Contact Email</th>
                <th>Product Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach ($customer->lists as $list)
                <tr>
                    <td>{{ $list->name }}</td>
                    <td>{{ $list->description }}</td>
                    <td>{{ $list->contact_number }}</td>
                    <td>{{ $list->contact_email }}</td>
                    <td>{{ $list->product_name }}</td>
                    <td>
                        <a class="btn btn-info" href="{{ route('lists.show', $list->id) }}">View</a>
                        <a class="btn btn-primary" href="{{ route('lists.edit', $list->id) }}">Edit</a>
                        <form action="{{ route('lists.destroy', $list->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <a class="btn btn-primary" href="{{ route('lists.addcartproduct', $list->id) }}">Add Product</a>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('customers.index') }}">Back</a>
    </div>
</div>

@endsection
