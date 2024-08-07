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
            <a href="{{ url()->previous() }}" class="float-left d-flex text-black">
                <i class="ti ti-arrow-narrow-left border border-dark rounded-circle mx-1 me-2 text-black"></i>Back
            </a>
            <button type="button" class="btn btn-primary btn btn-dark float-end rounded"
                onclick="window.location.href='{{ route('customers.show', $customer_id) }}'">
                View
            </button>
        </div>
    </div>

<div class="container mt-5">
    <div class="inner-container custmrmt0">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Create List</h2>
                </div>
                <div class="pull-left">
                    <h5>Please enter detail</h5>
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
                        <input type="text" name="list_name" class="form-control border border-white-50">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">Description</p>
                        <textarea class="form-control border border-white-50" style="height:150px !important;" name="list_description"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">Contact Number</p>
                        <input type="text" name="contact_number" class="form-control border border-white-50">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">Builder Email</p>
                        <input type="email" name="contact_email" class="form-control border border-white-50">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <label for="builder" class="text-secondary mb-1">Builder Name</label>
                        <input type="text" id="builder" name="builder_name" class="form-control border border-white-50">
                        <span class="text-danger error-text builder-error"></span>
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
                    <button type="reset" class="btn btn-outline-dark waves-effect rounded" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
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
                },
                builder_name: {
                    required: true,
                },
                status: {
                    required: true
                }
            },
            messages: {
                list_name: {
                    required: "Please enter the property address",
                    minlength: "Property address must consist of at least 3 characters"
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
                },
                builder_name: {
                    required: "Please enter the builder name",
                },
                status: {
                    required: "Please select an option"
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

        // Trigger validation when an input field gains focus
        $('#createBranchForm input, #createBranchForm textarea, #createBranchForm select').on('focus', function() {
            $(this).valid();
        });
    });
    </script>
@endpush
