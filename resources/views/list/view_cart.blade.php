@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.3.1/jquery.bootstrap-touchspin.min.css">
@endpush

@section('content')
<div id="app" class="layout-wrapper">
  @include('include.sidebar') 

<div class="container">
@include('include.navbar') 
    <div class="row">
        <div class="col-md-12 d-flex justify-content-between align-items-center p-5">
            <a href="{{ route('lists.addcartproduct', ['list' => $list->id, 'customer' => $list->customer_id]) }}" class="float-left d-flex text-black">
                <i class="ti ti-arrow-narrow-left border border-dark rounded-circle mx-1 me-2 text-black"></i>Back
            </a>
        </div>
    </div>

    <div class="container mt-3 viewcardpad viewresponsivecard">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div id="alert-container"></div> <!-- This is where we will display our JavaScript alerts -->

        @if(count($cartItems) > 0)
            <div class="card p-2 table_scrl custmrmt0">
                <table id="cartTable" class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Product</th>
                            <th>Code</th>
                            <th>Product Name/Qty.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartItems as $index => $item)
                            <tr>
                                <td class="border">
                                    @if($item['product']->product_image)
                                        <img src="{{ asset('images/products/' . $item['product']->product_image) }}"
                                            alt="{{ $item['product']->product_name }}" width="100">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td class="border">{{ $item['product']->product_code }}</td>
                                <td class="d-flex">
                                    <div>
                                        <div class="text-dark fs-4 fw-bold text-capitalize">{{ $item['product']->product_name }}</div>
                                        <div><strong class="text-secondary">Brand Name:</strong><span class="text-secondary">{{ $list->name }}</span></div>
                                        <div>
                                            <form action="{{ route('cart.updateqty', ['list' => $list->id, 'productId' => $item['product']->id, 'customerId' => $list->customer_id]) }}"
                                                method="POST" class="d-flex qty-update-form">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="quantity" value="{{ $item['quantity'] }}">
                                                <div class="input-group align-items-center">
                                                    <span class="d-flex align-items-center">
                                                        <span class="me-3">Qty:</span>
                                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="{{ $item['product']->product_stock }}" required class="form-control input-touchspin text-center border quantity-input" maxStock="{{ $item['product']->product_stock }}">
                                                    </span>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="d-flex ms-auto">
                                        <form action="{{ route('cart.remove', ['list' => $list->id, 'productId' => $item['product']->id, 'customerId' => $list->customer_id]) }}" method="POST" onsubmit="return confirmRemove()">
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

        <form action="{{ route('orders.save') }}" method="POST" enctype="multipart/form-data" id="orderForm" class="viewcardpad">

            @csrf

            <input type="hidden" name="list_id" value="{{ $list->id }}">
            <input type="hidden" name="customer_id" value="{{ $list->customer_id }}">
            <input type="hidden" name="list_email" value="{{ $list->contact_email }}">
            <input type="hidden" name="customer_email" value="{{ $customer->email }}">

            @foreach($cartItems as $index => $item)

                <input type="hidden" name="cart_items[{{ $index }}][product_code]" value="{{ $item['product']->product_code }}">
                <!-- <input type="hidden" name="cart_items[{{ $index }}][price]" value="{{ $item['product']->product_price }}"> -->
                <input type="hidden" name="cart_items[{{ $index }}][product_name]" value="{{ $item['product']->product_name }}">
                <input type="hidden" name="cart_items[{{ $index }}][quantity]" class="quantity-hidden" value="{{ $item['quantity'] }}">
                <input type="hidden" name="cart_items[{{ $index }}][product_order_image]" value="{{ $item['product']->product_image }}">

            @endforeach

            <div class="pull-right mt-4">

                <button type="submit" class="btn btn-primary btn btn-dark me-1 rounded">Save</button>
                <button type="submit" class="btn btn-primary btn btn-dark me-1 rounded spacebtwn">Save & Send</button>
                <!-- <button type="reset" class="btn btn-outline-dark waves-effect rounded" data-bs-dismiss="modal" aria-label="Close">Cancel</button> -->
                
            </div>
        </form>

    @else

        <p>Your cart is empty.</p>

    @endif

</div>

<script>

    function confirmRemove() {

        return confirm('Are you sure you want to remove this item from the cart?');
        
    }

</script>

@endsection

@push('scripts')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.7.3/jquery.bootstrap-touchspin.min.js" integrity="sha512-uztszeSSfG543xhjG/I7PPljUKKbcRnVcP+dz9hghb9fI/AonpYMErdJQtLDrqd9M+STTHnTh49h1Yzyp//d6g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    
$(document).ready(function () {

    $('.input-touchspin').TouchSpin({
        min: 1,
        step: 1,
        boostat: 5,
        maxboostedstep: 10,
        postfix: ' items'
    });

    // $('#cartTable').DataTable();
    let table = new DataTable('#cartTable');

    $('.bootstrap-touchspin-up').click(function () {
        var input = $(this).closest('.input-group').find('.quantity-input');
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            input.val(currentVal + 1);
            updateQuantity(input);
        }
    });

    $('.bootstrap-touchspin-down').click(function () {
        var input = $(this).closest('.input-group').find('.quantity-input');
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal) && currentVal > 1) {
            input.val(currentVal - 1);
            updateQuantity(input);
        }
    });

    function updateQuantity(input) {

        var form = input.closest('.qty-update-form');

        var action = form.attr('action');

        var quantity = input.val();

        var maxStock = parseInt(input.attr('maxStock'));       

        if (quantity > maxStock) {

            displayAlert('Cannot exceed available stock of ' + maxStock + ' items.', 'danger');

            input.val(maxStock);

            return;
        }

        $.ajax({

            url: action,
            type: 'POST',
            data: form.serialize(),

            success: function (response) {

                console.log('Quantity updated successfully:', response);

            },

            error: function (xhr, status, error) {
                console.error('Failed to update quantity:', error);
                
            }
        });
    }

    $('.quantity-input').change(function () {
        updateQuantity($(this));
    });

    $('#orderForm').on('submit', function (e) {
        e.preventDefault();

        // Update hidden inputs with current quantity values
        $('.quantity-input').each(function (index) {
            var quantity = $(this).val();
            $('.quantity-hidden').eq(index).val(quantity);
        });

        // Submit the form
        this.submit();

    });

    function displayAlert(message, type) {

        var alertHTML = '<div class="alert alert-' + type + ' alert-dismissible fade show" role="alert">' +
                        message +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                        '</div>';
        $('#alert-container').html(alertHTML);

    }

});

</script>

@endpush

