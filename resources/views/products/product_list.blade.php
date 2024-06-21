@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Product Listing</h2>
            </div>
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('products.create') }}"> Add Product</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Product Code</th>
                <th>Description</th>
                <th>Price</th>
                <th>Stock</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->product_code }}</td>
                    <td>{{ $product->product_description }}</td>
                    <td>{{ $product->product_price }}</td>
                    <td>{{ $product->product_stock }}</td>
                    <td>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirmDelete()">
                            <a class="btn btn-info" href="{{ route('products.show', $product->id) }}">Show</a>
                            <a class="btn btn-primary" href="{{ route('products.edit', $product->id) }}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {!! $products->links() !!}
</div>

<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this product?');
    }
</script>

@endsection
