@extends('layouts.app')
@push('css')
    <link rel="stylesheet" href="{{ asset_url('css/custom.css') }}" />
@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <a href="{{ url()->previous() }}" class="float-left d-flex"><i
                    class="ti ti-arrow-narrow-left border border-dark rounded-circle mx-1 me-2"></i>Back</a>
            <button type="button" class="btn btn-primary btn btn-dark float-end"
                onclick="window.location.href='{{ route('showproduct') }}'">
                View
            </button>
        </div>
    </div>
</div>
<div class="container mt-5">
    <div class="inner-container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Edit Product</h2>
                </div>
                <div class="pull-left">
                    <h5>Please enter product detail</h5>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">Product Name</p>
                        <input type="text" name="product_name" value="{{ $product->product_name }}" class="form-control"
                            placeholder="Name">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">Existing Product Image:</p><br>
                        <img src="{{ asset('images/products/' . $product->product_image) }}" alt="Product Image"
                            class="img-fluid">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">New Product Image:</p>
                        <input type="file" name="product_image" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">Product Code:</p>
                        <input type="text" name="product_code" value="{{ $product->product_code }}" class="form-control"
                            placeholder="Code">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">Product Description:</p>
                        <textarea class="form-control" style="height:150px" name="product_description"
                            placeholder="Description">{{ $product->product_description }}</textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">Product Price:</p>
                        <input type="text" name="product_price" value="{{ $product->product_price }}"
                            class="form-control" placeholder="Price">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">Product Stock:</p>
                        <input type="text" name="product_stock" value="{{ $product->product_stock }}"
                            class="form-control" placeholder="Stock">
                    </div>
                </div>
                <div class="pull-right mt-1 text-center">
                    <button type="submit" class="btn btn-primary btn btn-dark me-1">Save</button>
                    <button type="reset" class="btn btn-outline-dark waves-effect" data-bs-dismiss="modal"
                        aria-label="Close">Cancel</button>
                    <!-- <a class="btn btn-primary btn btn-dark" href="{{ route('showproduct') }}"> Back</a>

                    <button type="submit" class="btn btn-primary btn btn-dark">Submit</button> -->
                </div>
            </div>
        </form>
    </div>
</div>
@endsection