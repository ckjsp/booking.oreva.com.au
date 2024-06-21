@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Create List</h2>
            </div>
            <div class="pull-right">
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

    <form action="{{ route('lists.store') }}" method="POST">

        @csrf
        
        <input type="hidden" name="customer_id" value="{{ $customer_id }}">

        <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
        <div class="form-group">
                    <strong>List Name:</strong>
                    <input type="text" name="list_name" class="form-control" placeholder="List Name">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                <div class="form-group">
                    <strong>List Description:</strong>
                    <textarea class="form-control" style="height:150px" name="list_description" placeholder="List Description"></textarea>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                <div class="form-group">
                    <strong>Contact Number:</strong>
                    <input type="text" name="contact_number" class="form-control" placeholder="Contact Number">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                <div class="form-group">
                    <strong>Contact Email:</strong>
                    <input type="email" name="contact_email" class="form-control" placeholder="Contact Email">
                </div>
            </div>

        
            <div class="pull-right mt-1">
            <a class="btn btn-primary btn btn-dark" href="{{ route('customers.show', $customer_id) }}">Back</a>
                <button type="submit" class="btn btn-primary btn btn-dark">Submit</button>
            </div>
        </div>
        
    </form>
</div>

@endsection
