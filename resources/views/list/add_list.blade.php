@extends('layouts.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <a href="{{ url()->previous() }}" class="float-left d-flex"><i
                    class="ti ti-arrow-narrow-left border border-dark rounded-circle mx-1 me-2"></i>Back</a>
            
        </div>
    </div>
</div>
<div class="container mt-5">
    <div class="inner-container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Create a List</h2>
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

        <form action="{{ route('lists.store') }}" method="POST" id="createBranchForm">

            @csrf

            <input type="hidden" name="customer_id" value="{{ $customer_id }}">

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">Property Address</p>
                        <input type="text" name="list_name" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

            

                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">Number</p>
                        <input type="text" name="contact_number" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">Email</p>
                        <input type="email" name="contact_email" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">Description</p>
                        <textarea class="form-control" style="height:150px !important;" name="list_description"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <div class="pull-right mt-1 text-center">
    <button type="submit" class="btn btn-primary me-1">Save</button>
    <a href="{{ url()->previous() }}" class="btn btn-outline-dark waves-effect">Cancel</a>
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

        $("#createBranchForm").validate({
            rules: {
                list_name: {
                    required: true,
                    minlength: 3
                },
                list_description: {
                    required: true,
                    minlength: 10
                },
                contact_number: {
                    required: true,
                    validPhone: true
                },
                contact_email: {
                    required: true,
                    email: true,
                    validEmail: true
                }
            },
            messages: {
                list_name: {
                    required: "Please enter the property address",
                    minlength: "property address must consist of at least 3 characters"
                },
                list_description: {
                    required: "Please enter the list description",
                    minlength: "List description must consist of at least 10 characters"
                },
                contact_number: {
                    required: "Please enter the contact number"
                },
                contact_email: {
                    required: "Please enter the contact email",
                    email: "Please enter a valid email address",
                    validEmail: "Please enter a valid email address ending with '.com'"
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

        // Trigger validation when an input field gains focus
        $('#createBranchForm input, #createBranchForm textarea').on('focus', function() {
            $(this).valid();
        });
    });
    </script>
@endpush
