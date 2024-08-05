@extends('layouts.app')
@push('css')
    <link rel="stylesheet" href="{{ asset_url('css/custom.css') }}" />
@endpush
@section('content')
<div id="app" class="layout-wrapper">
  @include('include.sidebar') 

<div class="container">
@include('include.navbar') 
    <div class="row">
        <div class="col-md-12 d-flex justify-content-between align-items-center editpadding">
            <a href="{{ url()->previous() }}" class="float-left d-flex text-black"><i
                    class="ti ti-arrow-narrow-left border border-dark rounded-circle mx-1 me-2 text-black"></i>Back</a>
            <button type="button" class="btn btn-primary btn btn-dark float-end"
                onclick="window.location.href='{{ route('showproduct') }}'">
                View
            </button>
        </div>
    </div>

<div class="container mt-5">
    <div class="inner-container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Add New Product</h2>
                </div>
                <div class="pull-left">
                    <h5>Please enter product detail</h5>
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

        <form action="{{ route('addproduct') }}" method="POST" enctype="multipart/form-data" id="addProductForm">
            @csrf

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">Product Name</p>
                        <input type="text" name="product_name" class="form-control border border-white-50" placeholder="Name">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">Product Image</p>
                        <input type="file" name="product_image" class="form-control border border-white-50" placeholder="Upload Image" onchange="previewImage(event)">
                        <img id="imagePreview" style="display:none; max-width: 100%; height: auto; margin-top: 10px;" />
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">Product Description:</p>
                        <textarea class="form-control border border-white-50" style="height:150px !important;" name="product_description"
                            placeholder="Description"></textarea>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">Product Code:</p>
                        <input type="text" name="product_code" class="form-control border border-white-50" placeholder="Product Code">
                    </div>
                </div>

                <!-- <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">Price:</p>
                        <input type="text" name="product_price" class="form-control" placeholder="Price">
                    </div>
                </div> -->

                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">Stock:</p>
                        <input type="text" name="product_stock" class="form-control border border-white-50" placeholder="Stock">
                    </div>
                </div>

                <div class="pull-right mt-1 text-center">
                    <button type="submit" class="btn btn-primary btn btn-dark me-1">Save</button>
                    <button type="reset" class="btn btn-outline-dark waves-effect" data-bs-dismiss="modal"
                        aria-label="Close">Cancel</button>
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
        
    function previewImage(event) {

        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('imagePreview');
            output.src = reader.result;
            output.style.display = 'block';

        };

        reader.readAsDataURL(event.target.files[0]);
    }

    $(document).ready(function () {

        $.validator.addMethod("validPrice", function(value, element) {

            return this.optional(element) || /^\d+(\.\d{1,2})?$/.test(value);
            
        }, "Please enter a valid price.");

        $.validator.addMethod("uniqueProductCode", function(value, element) {
            var isUnique = false;

            $.ajax({

                type: "POST",
                url: "{{ route('checkProductCode') }}",

                data: {

                    product_code: value,
                    _token: "{{ csrf_token() }}"

                },

                async: false,
                success: function(response) {
                    isUnique = !response.exists;

                }
            });

            return isUnique;
        }, "This product code is already used.");

        $("#addProductForm").validate({
            rules: {
                product_name: {
                    required: true,
                    minlength: 3
                },
                product_image: {
                    required: true,
                },
                product_description: {
                    required: true,
                    minlength: 10
                },
                product_code: {
                    required: true,
                    minlength: 3,
                    uniqueProductCode: true
                },
               
                product_stock: {
                    required: true,
                    digits: true
                }
            },
            messages: {
                product_name: {
                    required: "Please enter the product name",
                    minlength: "Product name must consist of at least 3 characters"
                },
                product_image: {
                    required: "Please upload a product image",
                },
                product_description: {
                    required: "Please enter the product description",
                    minlength: "Product description must consist of at least 10 characters"
                },
                product_code: {
                    required: "Please enter the product code",
                    minlength: "Product code must consist of at least 3 characters"
                },
              
                product_stock: {
                    required: "Please enter the product stock",
                    digits: "Stock must be a positive number"
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
        $('#addProductForm input, #addProductForm textarea').on('focus', function() {
            $(this).valid();
        });
    });

    </script>

@endpush
