@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="pull-left">
                <h2>Show List</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('customers.show', $list->customer_id) }}">Back</a>
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
    </div>

</div>

@endsection
