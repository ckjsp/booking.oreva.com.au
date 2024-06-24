@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
    <div class="col-md-12 d-flex justify-content-between align-items-center">
            <a href="{{ url()->previous() }}" class="float-left d-flex"><i
                    class="ti ti-arrow-narrow-left border border-dark rounded-circle mx-1 me-2"></i>Back</a>
           
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-xs-12 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">List Details</h5>

                    <div class="form-group">
                        <strong>Name:</strong>
                        {{ $customer->name }}
                    </div>

                    <div class="form-group">
                        <strong>Customer Id:</strong>
                        {{ $customer->id }}
                    </div>

                    <div class="form-group">
                        <strong>Email ID:</strong>
                        {{ $customer->email }}
                    </div>
                    
                    <div class="form-group">
                        <strong>Phone Number:</strong>
                        {{ $customer->phone }}
                    </div>
                  
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
