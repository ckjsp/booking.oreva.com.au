@extends('layouts.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
@endpush
@section('content')
<div id="app" class="layout-wrapper">
    @include('include.sidebar') 

    <div class="container">
        @include('include.navbar') 
        <div class="listpadding">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ url()->previous() }}" class="float-left d-flex text-black"><i
                            class="ti ti-arrow-narrow-left border border-dark rounded-circle mx-1 me-2 "></i>Back</a>
                </div>
            </div>

            <div class="container mt-5">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left head-label">
                            <h2>View Customer Details</h2>
                        </div>
                    </div>
                </div>
                <div id="success-message" class="alert alert-success d-none" role="alert">
                  Quantity updated successfully!
                </div>

                <div class="card px-3 py-4 table_scroll customer_table_width">
                    <div class="d-flex flex-end ms-auto">
                        <button type="button" class="btn p-0 edit-btn text-info"
                            onclick="window.location.href='{{ route('customers.edit', $customer->id) }}'">
                            <i class="ti ti-pencil me-1"></i>
                        </button>
                        <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn p-0 delete-btn text-danger"
                                onclick="if(confirm('Are you sure you want to delete this customer?')) { this.closest('form').submit(); }">
                                <i class="ti ti-trash me-1"></i>
                            </button>
                        </form>
                    </div>

                    <div class="d-flex">
                        <div class="ms-4 d-flex flex-column justify-content-center w-100">
                            <div class="row mb-2">
                                <div class="col-md-4 fw-bold">Customer Name:</div>
                                <div class="col-md-8">{{ $customer->name }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-4 fw-bold">Customer ID:</div>
                                <div class="col-md-8">{{ $customer->id }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-4 fw-bold">Email ID:</div>
                                <div class="col-md-8">{{ $customer->email }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4 fw-bold">Phone Number:</div>
                                <div class="col-md-8">
                                    <a href="tel:{{ $customer->phone }}" class="text-dark">{{ $customer->phone }}</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3 customr_btn_centr">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-right text-end">
                                <button onclick="window.location.href='{{ route('lists.addcartproduct', ['list' => $list->id, 'customer' => $list->customer_id]) }}'" class="btn btn-outline-dark text-dark rounded" tabindex="0"
                                        aria-controls="DataTables_Table_0" type="button"><span><i class="ti ti-plus me-sm-1"></i> Add New
                                        Product</span></button>
                            </div>
                        </div>
                    </div>

                    <table id="customerListsTable" class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Product Image</th>
                                <th>Code</th>
                                <th>Product Name/Qty.</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $index => $order)
                                <tr>
                                    <td class="border">
                                        @if($order->product_order_image)
                                            <img src="{{ asset('images/products/' . $order->product_order_image) }}" alt="{{ $order->product_name }}" width="100">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td class="border">{{ $order->product_code }}</td>
                                    <td class="d-flex">
                                        <div>
                                            <div class="text-dark fs-5 fw-bold text-capitalize">{{ $order->product_name }}</div>
                                            <div><strong class="text-secondary">Brand Name:</strong><span class="text-secondary">{{ $list->name }}</span></div>
                                            <div>
                                            <form action="{{ route('orders.updateQuantity', ['order' => $order->id]) }}" method="POST" class="d-flex qty-update-form">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="quantity" value="{{ $order->quantity }}">
                                                <div class="input-group align-items-center">
                                                    <span class="d-flex align-items-center">
                                                        <span class="me-3">Qty:</span>
                                                        <input type="number" name="quantity" value="{{ $order->quantity }}" min="0" required class="form-control input-touchspin text-center border quantity-input">
                                                    </span>
                                                </div>
                                            </form>

                                            </div>
                                        </div>
                                        <div class="d-flex ms-auto">
                                            <form action="{{ route('orders.destroyOrders', ['order' => $order->id]) }}" method="POST" onsubmit="return confirmRemove()">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn p-0 delete-btn text-danger dropdown-item" onclick="this.closest('form').submit();">
                                                    <i class="ti ti-trash me-1"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    
    function confirmDelete() {

        return confirm('Are you sure you want to delete this Project?');

    }

    $(document).ready(function() {

        $('#customerListsTable').DataTable();

    });


    $(document).ready(function() {

    $('.input-touchspin').TouchSpin({

        min: 0,
        max: Infinity,
        step: 1,
        boostat: 5,
        postfix: 'items'

    });

    // Handle plus button click
    $('.bootstrap-touchspin-up').click(function() {
        var input = $(this).closest('.input-group').find('.quantity-input');
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            input.val(currentVal + 0);
            updateQuantity(input);
        }
    });

    // Handle minus button click
    $('.bootstrap-touchspin-down').click(function() {
        var input = $(this).closest('.input-group').find('.quantity-input');
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal) && currentVal > 1) {
            input.val(currentVal - 0);
            updateQuantity(input);
        }
    });

    // Update quantity via AJAX
    function updateQuantity(input) {
        var form = input.closest('.qty-update-form');
        var action = form.attr('action');
        var quantity = input.val();
        $.ajax({
            url: action,
            type: 'PATCH',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                quantity: quantity
            },
            success: function(response) {
                console.log('Quantity updated successfully:', response);

                // Show success message
                $('#success-message').removeClass('d-none').text('Quantity updated successfully!');

                // Hide the message after a few seconds
                setTimeout(function() {
                    $('#success-message').addClass('d-none');
                }, 3000);
            },
            error: function(xhr, status, error) {
                console.error('Failed to update quantity:', error);
                console.log(xhr.responseText);
            }
        });
    }

    // Update quantity when input value changes (including manual input)
    $('.quantity-input').on('input', function() {
        updateQuantity($(this));
    });
});

</script>
@endsection
