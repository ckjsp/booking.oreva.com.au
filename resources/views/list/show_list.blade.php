@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.3.1/jquery.bootstrap-touchspin.min.css">
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <a href="{{ url()->previous() }}" class="float-left d-flex align-items-center">
                <i class="ti ti-arrow-narrow-left border border-dark rounded-circle mx-1 me-2"></i>
                Back
            </a>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="mb-4">View Profile</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <div class="profile-image mb-4">
                <img src="{{ !empty(Auth::user()->image) ? url('storage/app/'. Auth::user()->image) : asset('img/avatars/1.png') }}"
                    alt="Profile Image" class="profile-img img-fluid" />
            </div>
        </div>

        <div class="col-lg-9">
            <div class="row mb-2">
                <div class="col-4 fw-bold">Customer Name:</div>
                <div class="col-8">{{ $customer->name }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-4 fw-bold">Customer ID:</div>
                <div class="col-8">{{ $customer->id }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-4 fw-bold">Email ID:</div>
                <div class="col-8">{{ $customer->email }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-4 fw-bold">Phone Number:</div>
                <div class="col-8">{{ $customer->phone }}</div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(count($cartItems) > 0)
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Product Image</th>
                                <th>Product Code</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $item)
                                <tr>
                                    <td>
                                        @if($item['product']->product_image)
                                            <img src="{{ asset('images/products/' . $item['product']->product_image) }}" alt="{{ $item['product']->product_name }}" class="img-fluid" style="max-width: 100px;">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td>{{ $item['product']->product_code }}</td>
                                    <td>{{ $item['product']->product_name }}</td>
                                   <td>

                                    <form id="updateQuantityForm{{ $item['product']->id }}" data-product-id="{{ $item['product']->id }}" data-list-id="{{ $list->id }}" data-customer-id="{{ $customer->id }}">
                                        @csrf
                                        @method('PATCH')
                                        <div class="input-group">
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control">
                                            <button type="button" class="btn btn-primary ms-2 update-quantity-btn">Update</button>
                                        </div>
                                    </form>
                                </td>
                                    
                                    <td>₹ {{ $item['product']->product_price }}</td>
                                    <td>
                                        <form action="{{ route('cart.removeShowListFromCart', ['list' => $list->id, 'productId' => $item['product']->id, 'customerId' => $customer->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this item?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

       
    @else
        <p>Your cart is empty.</p>
    @endif
</div>

@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.7.3/jquery.bootstrap-touchspin.min.js" integrity="sha512-uztszeSSfG543xhjG/I7PPljUKKbcRnVcP+dz9hghb9fI/AonpYMErdJQtLDrqd9M+STTHnTh49h1Yzyp//d6g==" crossorigin="anonymous" referr
@endpush
