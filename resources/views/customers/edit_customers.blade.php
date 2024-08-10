@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
@endpush

@section('content')
<div id="app" class="layout-wrapper">
    @include('include.sidebar')

    <div class="container">
        @include('include.navbar')
        
        <div class="row">
            <div class="col-md-12 d-flex justify-content-between align-items-center editpadding">
                <a href="{{ route('customers.index') }}" class="float-left d-flex text-black">
                    <i class="ti ti-arrow-narrow-left border border-dark rounded-circle mx-1 me-2 text-black"></i>Back
                </a>
                <button type="button" class="btn btn-primary btn btn-dark float-end rounded" onclick="window.location.href='{{ route('customers.show', $customer->id) }}'">
                    View
                </button>
            </div>
        </div>
        
        <div class="container mt-5">
            <div class="inner-container custmrmt0">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h2>Edit Customer</h2>
                        </div>
                        <div class="pull-left">
                            <h5>Please update the details below</h5>
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

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('customers.update', $customer->id) }}" method="POST" id="editCustomerForm">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                            <div class="form-group">
                                <p class="text-secondary mb-1">Name</p>
                                <input type="text" name="name" value="{{ old('name', $customer->name) }}" class="form-control border border-white-50" placeholder="Name">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                            <div class="form-group">
                                <p class="text-secondary mb-1">Phone</p>
                                <input type="text" name="phone" value="{{ old('phone', $customer->phone) }}" class="form-control border border-white-50" placeholder="Phone">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                            <div class="form-group">
                                <p class="text-secondary mb-1">E-mail Address</p>
                                <input type="email" name="email" value="{{ old('email', $customer->email) }}" class="form-control border border-white-50" placeholder="Email">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                            <div class="form-group">
                                <p class="text-secondary mb-1">Street Name</p>
                                <input type="text" name="street" value="{{ old('street', $customer->street) }}" class="form-control border border-white-50" placeholder="Street">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                            <div class="form-group">
                                <p class="text-secondary mb-1">Suburb</p>
                                <input type="text" name="suburb" value="{{ old('suburb', $customer->suburb) }}" class="form-control border border-white-50" placeholder="Suburb">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                            <div class="form-group">
                                <p class="text-secondary mb-1">State</p>
                                <input type="text" name="state" value="{{ old('state', $customer->state) }}" class="form-control border border-white-50" placeholder="State">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                            <div class="form-group">
                                <p class="text-secondary mb-1">Pincode</p>
                                <input type="text" name="pincod" value="{{ old('pincod', $customer->pincod) }}" class="form-control border border-white-50" placeholder="Pincode">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="pull-right mt-1 text-center">
                            <button type="submit" class="btn btn-primary btn btn-dark me-1 rounded">Save</button>
                            <a class="btn btn-outline-dark waves-effect rounded" href="{{ route('customers.index') }}">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
   
    <script>
        
    $(document).ready(function () {
        $.validator.addMethod("validEmail", function(value, element) {
            return this.optional(element) || /.+\.com$/.test(value);
        }, "Please enter a valid email address ending with '.com'.");

        $.validator.addMethod("validPhone", function(value, element) {
            return this.optional(element) || /^[0-9]{10}$/.test(value);
        }, "Please enter a 10-digit phone number.");

      
        $.validator.addMethod("validName", function(value, element) {
            return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
        }, "Name should contain only letters and spaces.");

        $("#editCustomerForm").validate({
            rules: {
                name: {
                    required: true,
                    validName: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true,
                    validEmail: true
                },
                phone: {
                    required: true,
                    validPhone: true
                },
                street: {
                    required: true
                },
                suburb: {
                    required: true
                },
                state: {
                    required: true
                },
                pincod: {
                    required: true,
                }
            },
            messages: {
                name: {
                    required: "Please enter your name",
                    minlength: "Name must consist of at least 3 characters",
                    validName: "Name should contain only letters and spaces"
                },
                email: {
                    required: "Please enter your email address",
                    email: "Please enter a valid email address",
                    validEmail: "Please enter a valid email address ending with '.com'"
                },
                phone: {
                    required: "Please enter your phone number"
                },
                street: {
                    required: "Please enter your street address"
                },
                suburb: {
                    required: "Please enter your suburb"
                },
                state: {
                    required: "Please enter your state"
                },
                pincod: {
                    required: "Please enter your pincode",
                }
            },
            errorElement: 'div',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                error.insertBefore(element);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).addClass('is-valid').removeClass('is-invalid');
            }
        });
    });
    </script>
@endpush
