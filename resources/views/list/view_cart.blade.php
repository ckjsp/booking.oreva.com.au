@extends('layouts.app')
@push('css')
    <link rel="stylesheet" href="{{ asset_url('css/custom.css') }}" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.3.1/jquery.bootstrap-touchspin.min.css">
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
    @if(count($cartItems) > 0)
        <div class="card">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Product</th>
                        <th>Code</th>
                        <th>Description</th>
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
                                    <div class="text-dark fs-4 fw-bold text-capitalize">{{ $item['product']->product_name }}
                                    </div>
                                    <div><strong class="text-secondary">Brand Name:</strong><span class="text-secondary">
                                            {{ $list->name }}</span></div>
                                    <div>

                                        <form
                                            action="{{ route('cart.updateqty', ['list' => $list->id, 'productId' => $item['product']->id, 'customerId' => $list->customer_id]) }}"
                                            method="POST" class="d-flex qty-update-form">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="quantity" value="{{ $item['quantity'] }}">
                                            <div class="input-group align-items-center">
                                                <span class="d-flex align-items-center"><span class="me-3">Qty:
                                                    </span><input type="number" name="quantity" value= "{{ $item['quantity'] }}" min="1" required
                                                        class="form-control input-touchspin text-center border quantity-input"></span>
                                                        
                                            </div>
                                        </form>
                                        
                                       
                                    </div>
                                    <div class="fs-5 fw-bold text-dark" style="line-height: 28px;"><span> ₹
                                        </span>{{ $item['product']->product_price }}</div>
                                </div>
                                <div class="d-flex ms-auto">
                                    <button type="button" class="btn p-0 edit-btn text-info dropdown-item align-items-baseline"
                                        onclick="window.location.href='{{ route('products.edit', $item['product']->id) }}'">
                                        <i class="ti ti-pencil me-1"></i></button>
                                    <form
                                        action="{{ route('cart.remove', ['list' => $list->id, 'productId' => $item['product']->id, 'customerId' => $list->customer_id]) }}"
                                        method="POST" onsubmit="return confirmRemove()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn p-0 delete-btn text-danger dropdown-item"
                                            onclick="this.closest('form').submit();">
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

        <form action="{{ route('orders.save') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="hidden" name="list_id" value="{{ $list->id }}">
    <input type="hidden" name="customer_id" value="{{ $list->customer_id }}">

    @foreach($cartItems as $index => $item)
        <input type="hidden" name="cart_items[{{ $index }}][product_code]" value="{{ $item['product']->product_code }}">
        <input type="hidden" name="cart_items[{{ $index }}][price]" value="{{ $item['product']->product_price }}">
        <input type="hidden" name="cart_items[{{ $index }}][product_name]" value="{{ $item['product']->product_name }}">
        <input type="hidden" name="cart_items[{{ $index }}][quantity]" value="{{ $item['quantity'] }}">
        <input type="hidden" name="cart_items[{{ $index }}][product_order_image]" value="{{ $item['product']->product_image }}">
    @endforeach

    <div class="pull-right mt-4">
        <button type="submit" class="btn btn-primary btn btn-dark me-1 rounded">Save</button>
        <button type="submit" class="btn btn-primary btn btn-dark me-1 rounded">Save & Send</button>
        <button type="reset" class="btn btn-outline-dark waves-effect rounded" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.7.3/jquery.bootstrap-touchspin.min.js"
        integrity="sha512-uztszeSSfG543xhjG/I7PPljUKKbcRnVcP+dz9hghb9fI/AonpYMErdJQtLDrqd9M+STTHnTh49h1Yzyp//d6g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>

        $(document).ready(function () {
            $('.input-touchspin').TouchSpin({
                min: 1,
                max: 1000,
                step: 1,
                boostat: 5,
                maxboostedstep: 10,
                postfix: 'items'
            });
        });

    </script>

<script>

$(document).ready(function() {
    
    // Handle plus button click
    $('.bootstrap-touchspin-up').click(function() {
        var input = $(this).siblings('.quantity-input');
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            input.val(currentVal + 1);
            updateQuantity(input);
        }
    });

    // Handle minus button click
    $('.bootstrap-touchspin-down').click(function() {
        var input = $(this).siblings('.quantity-input');
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal) && currentVal > 1) {
            input.val(currentVal - 1);
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
            type: 'POST',
            data: form.serialize(), // Include CSRF token and other form data
            success: function(response) {
                // Handle success (e.g., show a message or update the cart UI)
                console.log('Quantity updated successfully:', response);
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error('Failed to update quantity:', error);
            }   
        });
    }

    // Update quantity when input value is manually changed
    $('.quantity-input').change(function() {
        updateQuantity($(this));
    });
});

</script>
@endpush