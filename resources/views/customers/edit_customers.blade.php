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
            <a href="{{ route('customers.index') }}"  class="float-left d-flex text-black">
                <i class="ti ti-arrow-narrow-left border border-dark rounded-circle mx-1 me-2 text-black"></i>Back
            </a>
            <button type="button" class="btn btn-primary btn btn-dark float-end" onclick="window.location.href='{{ route('customers.show', $customer->id) }}'">
                View
            </button>
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
                    <h5>Please enter your details</h5>
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
                        <p class="text-secondary mb-1">Location/Address</p>
                        <input type="text" name="city" value="{{ old('city', $customer->city) }}" class="form-control border border-white-50" placeholder="City">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">Builder Name</p>
                        <input type="text" name="builder" value="{{ old('builder', $customer->builder) }}" class="form-control border border-white-50" placeholder="Builder Name">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
    <div class="form-group">
        <p class="text-secondary mb-1">Selection For</p>
        <div class="input-group">
            <select name="status" class="form-control border border-white-50">
                <option value="Fast Home" {{ $customer->status == 'Fast Home' ? 'selected' : '' }}>Fast Home</option>
                <option value="Investment" {{ $customer->status == 'Investment' ? 'selected' : '' }}>Investment</option>
            </select>
            <span class="text-danger error-text status-error"></span>
        </div>
        <div class="invalid-feedback"></div>
    </div>
</div>

                <div class="pull-right mt-1 text-center">
                    <button type="submit" class="btn btn-primary btn btn-dark me-1">Save</button>
                    <a  class="btn btn-outline-dark waves-effect"  href="{{ route('customers.index') }}"  >Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script>
    $(document).ready(function () {
        $.validator.addMethod("validEmail", function(value, element) {
            return this.optional(element) || /.+\.com$/.test(value);
        }, "Please enter a valid email address ending with '.com'.");

        $.validator.addMethod("validPhone", function(value, element) {
            return this.optional(element) || /^[0-9]{10}$/.test(value);
        }, "Please enter a 10-digit phone number.");

        $.validator.addMethod("validCity", function(value, element) {
            return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
        }, "City should contain only letters and spaces.");

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
                city: {
                    required: true
                },
                phone: {
                    required: true,
                    validPhone: true
                },
                status: {
                    required: true
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
                city: {
                    required: "Please enter your Address/Location"
                },
                phone: {
                    required: "Please enter your phone number"
                },
                status: {
                    required: "Please select a status"
                }
            },
            errorElement: 'div',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                error.insertBefore(element); // Places the error message above the input field
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).addClass('is-valid').removeClass('is-invalid');
            }
        });

        // Trigger validation immediately to check if it's working
        $("#editCustomerForm").valid();
    });
    </script>
@endpush
