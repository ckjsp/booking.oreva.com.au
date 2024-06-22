@extends('layouts.app')
@push('css')
    <link rel="stylesheet" href="{{ asset_url('css/custom.css') }}" />
@endpush
@section('content')
<!-- <!DOCTYPE html>
<html>
<head>
    <title>Edit Customer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body> -->
<div class="container">
    <div class="row">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <a href="{{ url()->previous() }}" class="float-left d-flex"><i
                    class="ti ti-arrow-narrow-left border border-dark rounded-circle mx-1 me-2"></i>Back</a>
            <button type="button" class="btn btn-primary btn btn-dark float-end"
                onclick="window.location.href='{{ route('customers.show', $customer->id) }}'">
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
                    <h2>Edit Detail</h2>
                </div>
                <div class="pull-left">
                    <h5>Please enter you detail</h5>
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

        <form action="{{ route('customers.update', $customer->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">Name</p>
                        <input type="text" name="name" value="{{ $customer->name }}" class="form-control"
                            placeholder="Name">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">Email Address</p>
                        <input type="email" name="email" value="{{ $customer->email }}" class="form-control"
                            placeholder="Email">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">City</p>
                        <input type="text" name="city" value="{{ $customer->city }}" class="form-control"
                            placeholder="City">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">Phone</p>
                        <input type="text" name="phone" value="{{ $customer->phone }}" class="form-control"
                            placeholder="Phone">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">Requirement</p>
                        <select name="status" class="form-control">
                            <option value="Active" {{ $customer->status == 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="Inactive" {{ $customer->status == 'Inactive' ? 'selected' : '' }}>Inactive
                            </option>
                        </select>
                    </div>
                </div>
                <div class="pull-right mt-1 text-center">
                    <!-- <a class="btn btn-primary btn btn-dark" href="{{ route('customers.index') }}"> Back</a> -->
                    <button type="submit" class="btn btn-primary btn btn-dark me-1">Save</button>
                    <button type="reset" class="btn btn-outline-dark waves-effect" data-bs-dismiss="modal"
                        aria-label="Close">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection