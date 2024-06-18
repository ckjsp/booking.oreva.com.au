@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <h2>Our Product</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered mt-3">
        <thead style="background-color: black; color: white;">
            <tr>
                <th>No</th>
                <th>Product Code</th>
                <th>Product Name</th>
                <th>Product Description</th>
                <th>Product Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach($products as $product)

                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->product_code }}</td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->product_description }}</td>
                    <td>
                        @if($product->product_image)
                            <img src="{{ asset('images/products/' . $product->product_image) }}" alt="{{ $product->product_name }}" width="100">
                        @else
                            No Image
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('lists.add-to-cart', $list->id) }}" method="POST">

                            @csrf
                            
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="number" name="quantity" value="1" min="1" required>

                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                        </form>
                    </td>
                </tr>

            @endforeach

        </tbody>
    </table>
</div>

@endsection
