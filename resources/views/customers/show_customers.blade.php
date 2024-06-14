@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Show Customer</h2>
            </div>
          
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $customer->name }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                {{ $customer->email }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>City:</strong>
                {{ $customer->city }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Phone:</strong>
                {{ $customer->phone }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Status:</strong>
                {{ $customer->status }}
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>List</h2>
            </div>
            
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('createlist') }}">Create List</a>
            </div>
        </div>
    </div>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>List</th>
                <th>Product Description</th>
                <th>Product Count</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <a class="btn btn-info" href="">View</a>
                    <a class="btn btn-primary" href="">Add Product</a>
                </td>
            </tr>
        </tbody>
    </table>
      <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('customers.index') }}">Back</a>
                          </div>
                        </div>
@endsection
