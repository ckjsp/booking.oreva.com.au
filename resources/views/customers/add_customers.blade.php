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

        <div class="col-md-12">
            <a href="{{ url()->previous() }}" class="float-left d-flex text-black"><i class="ti ti-arrow-narrow-left border border-dark rounded-circle mx-1 me-2 text-black"></i>Back</a>
        </div>
    </div>
</div>
<div class="container mt-5">
    <div class="inner-container custmrmt0">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Add Customers</h2>
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

        <form id="customerForm" action="{{ route('customers.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <label for="name" class="text-secondary mb-1">Name</label>
                        <input type="text" id="name" name="name" class="form-control border border-white-50">
                        <span class="text-danger error-text name-error"></span>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <label for="phone" class="text-secondary mb-1">Phone</label>
                        <input type="text" id="phone" name="phone" class="form-control border border-white-50">
                        <span class="text-danger error-text phone-error"></span>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <label for="email" class="text-secondary mb-1">E-mail Address</label>
                        <input type="email" id="email" name="email" class="form-control border border-white-50">
                        <span class="text-danger error-text email-error"></span>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <label for="city" class="text-secondary mb-1">Address/Location</label>
                        <input type="text" id="city" name="city" class="form-control border border-white-50">
                        <span class="text-danger error-text city-error"></span>
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                <div class="form-group">
                        <label for="name" class="text-secondary mb-1">Builder Name</label>
                        <input type="text" id="builder" name="builder" class="form-control border border-white-50">
                        <span class="text-danger error-text name-error"></span>
                    </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
    <div class="form-group">
        <label for="status" class="text-secondary mb-1">Selection For</label>
        <div class="input-group">
            <select id="status" name="status" class="form-select">
                <option value=""></option>
                <option value="Fast Home">Fast Home</option>
                <option value="Investment">Investment</option>
            </select>
        </div>
        <span class="text-danger error-text status-error"></span>
    </div>
</div>


                <div class="pull-right mt-1 text-center">
                    <button type="submit" class="btn btn-primary btn btn-dark me-1 rounded">Save</button>
                    <a href="{{ url()->previous() }}" class="btn btn-outline-dark waves-effect rounded">Cancel</a>
                    </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<script>
    $(document).ready(function () {
        $.validator.addMethod("validName", function(value, element) {
            return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
        }, "Name should contain only letters.");

        $.validator.addMethod("validEmail", function(value, element) {
            return this.optional(element) || /.+\.com$/.test(value);
        }, "Please enter a valid email address ending with '.com'.");

        $.validator.addMethod("validPhone", function(value, element) {
            return this.optional(element) || /^[0-9]{10}$/.test(value);
        }, "Please enter a 10-digit phone number.");

        $.validator.addMethod("validCity", function(value, element) {
            return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
        }, "City should contain only letters.");

        $('#customerForm').validate({
            rules: {
                name: {
                    required: true,
                    validName: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    validEmail: true
                },
                city: {
                    required: true,
                    
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
                    required: "Please enter your name"
                },
                email: {
                    required: "Please enter your email address"
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

            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                error.appendTo(element.parent().find('.error-text'));
            },

            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },

            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid').addClass('is-valid');
            },

            submitHandler: function(form) {
                form.submit(); // Submit the form
            }
        });
    });
</script>
@endpush
