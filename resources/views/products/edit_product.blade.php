@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
@endpush

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <a href="{{ url()->previous() }}" class="float-left d-flex">
                <i class="ti ti-arrow-narrow-left border border-dark rounded-circle mx-1 me-2"></i>Back
            </a>
            <button type="button" class="btn btn-primary btn btn-dark float-end" onclick="window.location.href='{{ route('showproduct') }}'">View</button>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="inner-container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Edit Product</h2>
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

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" id="editProductForm">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">Product Name</p>
                        <input type="text" name="product_name" value="{{ $product->product_name }}" class="form-control" placeholder="Name">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">Existing Product Image:</p><br>
                        <img src="{{ asset('images/products/' . $product->product_image) }}" alt="Product Image" class="img-fluid" width="150">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">New Product Image:</p>
                        <input type="file" name="product_image" class="form-control" id="productImageInput">
                        <img id="imagePreview" src="#" alt="New Product Image" class="img-fluid mt-3" style="display: none;" width="150">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">Product Code:</p>
                        <input type="text" name="product_code" value="{{ $product->product_code }}" class="form-control" placeholder="Code">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">Product Description:</p>
                        <textarea class="form-control" style="height:150px" name="product_description" placeholder="Description">{{ $product->product_description }}</textarea>
                    </div>
                </div>
               
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">Product Stock:</p>
                        <input type="text" name="product_stock" value="{{ $product->product_stock }}" class="form-control" placeholder="Stock">
                    </div>
                </div>
                <div class="pull-right mt-1 text-center">
                    <button type="submit" class="btn btn-primary btn btn-dark me-1">Save</button>
                    <button type="reset" class="btn btn-outline-dark waves-effect" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
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
            $.validator.addMethod("validPrice", function(value, element) {
                return this.optional(element) || /^\d+(\.\d{1,2})?$/.test(value);
            }, "Please enter a valid price.");

            $("#editProductForm").validate({
                rules: {
                    product_name: {
                        required: true,
                        minlength: 3
                    },
                    product_image: {
                        accept: "image/*"
                    },
                    product_code: {
                        required: true,
                        minlength: 3
                    },
                    product_description: {
                        required: true,
                        minlength: 10
                    },
                    product_price: {
                        required: true,
                        validPrice: true
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
                        accept: "Please upload a valid image file"
                    },
                    product_code: {
                        required: "Please enter the product code",
                        minlength: "Product code must consist of at least 3 characters"
                    },
                    product_description: {
                        required: "Please enter the product description",
                        minlength: "Product description must consist of at least 10 characters"
                    },
                    product_price: {
                        required: "Please enter the product price"
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
            $('#editProductForm input, #editProductForm textarea').on('focus', function() {
                $(this).valid();
            });

            // Image preview
            $('#productImageInput').on('change', function() {
                const [file] = this.files;
                if (file) {
                    $('#imagePreview').attr('src', URL.createObjectURL(file)).show();
                } else {
                    $('#imagePreview').hide();
                }
            });
        });
    </script>
@endpush
