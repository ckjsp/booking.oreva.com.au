@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset_url('css/custom.css') }}" />
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ url()->previous() }}" class="float-left d-flex"><i
                    class="ti ti-arrow-narrow-left border border-dark rounded-circle mx-1 me-2"></i>Back</a>
        </div>
    </div>
</div>
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>View Profile</h2>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-xs-12 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">List Details</h5>

                    <div class="form-group">
                        <strong>Name:</strong>
                        {{ $list->name }}
                    </div>

                    <div class="form-group">
                        <strong>Description:</strong>
                        {{ $list->description }}
                    </div>

                    <div class="form-group">
                        <strong>Contact Number:</strong>
                        {{ $list->contact_number }}
                    </div>
                    
                    <div class="form-group">
                        <strong>Contact Email:</strong>
                        {{ $list->contact_email }}
                    </div>
                    
                    <div class="form-group">
                        <strong>Product:</strong>
                        {{ $list->product_name ?? 'N/A' }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Customer Details</h5>

                    <div class="form-group">
                        <strong>Customer Name:</strong>
                        {{ $customer->name }}
                    </div>
                    <div class="form-group">
                        <strong>Customer email:</strong>
                        {{ $customer->email }}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
