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
                onclick="window.location.href='{{ route('customers.show', $list->customer_id) }}'">
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
                    <h2>Edit List</h2>
                </div>
                <div class="pull-left">
                    <h5>Please enter list detail</h5>
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

        <form action="{{ route('lists.update', $list->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="row mt-3">
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">List Name</p>
                        <input type="text" name="name" value="{{ $list->name }}" class="form-control"
                            placeholder="Name">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">Description:</p>
                        <textarea class="form-control" style="height:150px !important;" name="description"
                            placeholder="Description">{{ $list->description }}</textarea>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">Contact Number:</p>
                        <input type="text" name="contact_number" value="{{ $list->contact_number }}"
                            class="form-control" placeholder="Contact Number">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">Contact Email:</p>
                        <input type="email" name="contact_email" value="{{ $list->contact_email }}" class="form-control"
                            placeholder="Contact Email">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">Product Name:</p>
                        <input type="text" name="product_name" value="{{ $list->product_name }}" class="form-control"
                            placeholder="Product Name (Optional)">
                    </div>
                </div>

                <div class="pull-right mt-1 text-center">
                    <button type="submit" class="btn btn-primary btn btn-dark me-1">Save</button>
                    <button type="reset" class="btn btn-outline-dark waves-effect" data-bs-dismiss="modal"
                        aria-label="Close">Cancel</button>
                    <!-- <a class="btn btn-primary btn btn-dark"
                        href="{{ route('customers.show', $list->customer_id) }}">Back</a>
                    <button type="submit" class="btn btn-primary btn btn-dark">Update</button> -->
                </div>
            </div>

        </form>
    </div>
</div>
@endsection