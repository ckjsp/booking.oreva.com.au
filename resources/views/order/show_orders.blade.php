@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}"/>
@endpush

@section('content')
<div id="app" class="layout-wrapper">
    @include('include.sidebar') 

    <div class="container">
        @include('include.navbar') 
        <div class="listpadding">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ url()->previous() }}" class="float-left d-flex text-black">
                        <i class="ti ti-arrow-narrow-left border border-dark rounded-circle mx-1 me-2"></i>Back
                    </a>
                </div>
            </div>

            <div class="container mt-5">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left head-label">
                            <h2>View Order</h2>
                        </div>
                    </div>
                </div>

                <div class="card px-3 py-4 table_scroll customer_table_width">
                    <div class="d-flex flex-end ms-auto"></div>

                    <div class="d-flex">
                        <div class="ms-4 d-flex flex-column justify-content-center w-100">
                            <div class="row mb-2">
                                <div class="col-md-4 fw-bold">Product Name:</div>
                                <div class="col-md-8">{{ $order->product->product_name }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-4 fw-bold">Quantity:</div>
                                <div class="col-md-8">{{ $order->quantity }}</div>
                            </div>
                            
                            <div class="row mb-2">
                                <div class="col-md-4 fw-bold">Product Order Image:</div>
                                <div class="col-md-8">
                                    <img src="{{ asset('images/products/' . $order->product->product_image) }}" alt="{{ $order->product->product_name }}" width="100">
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-4 fw-bold">Customer Email:</div>
                                <div class="col-md-8">{{ $order->customer->email }}</div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#customerListsTable').DataTable();
    });
</script>
@endpush

@endsection
