@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <h2>Your Cart for List: {{ $list->name }}</h2> <!-- Display the list name or any relevant info -->

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(count($cartItems) > 0)
        <table class="table table-bordered mt-3">
            <thead style="background-color: black; color: white;">
                <tr>
                    <th>No</th>
                    <th>Product Code</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item['product']->product_code }}</td>
                        <td>{{ $item['product']->product_name }}</td>
                        <td>
                            <form action="{{ route('cart.updateqty', ['list' => $list->id, 'productId' => $item['product']->id, 'customerId' => $list->customer_id]) }}" method="POST" class="d-flex">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control mr-2">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </td>
                        <td>
                            <!-- Remove from cart button -->
                            <form action="{{ route('cart.remove', ['list' => $list->id, 'productId' => $item['product']->id, 'customerId' => $list->customer_id]) }}" method="POST" onsubmit="return confirmRemove()">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <form action="{{ route('orders.save') }}" method="POST">

            @csrf

            <input type="hidden" name="list_id" value="{{ $list->id }}">
            <input type="hidden" name="customer_id" value="{{ $list->customer_id }}">
            
            @foreach($cartItems as $index => $item)

                <input type="hidden" name="cart_items[{{ $index }}][product_code]" value="{{ $item['product']->product_code }}">
                <input type="hidden" name="cart_items[{{ $index }}][product_name]" value="{{ $item['product']->product_name }}">
                <input type="hidden" name="cart_items[{{ $index }}][quantity]" value="{{ $item['quantity'] }}">
                
            @endforeach
            
            <button type="submit" class="btn btn-success">Save Order</button>
        </form>
    @else
        <p>Your cart is empty.</p>
    @endif
</div>

<script>

    function confirmRemove() {

        return confirm('Are you sure you want to remove this item from the cart?');

    }
    
</script>

@endsection
