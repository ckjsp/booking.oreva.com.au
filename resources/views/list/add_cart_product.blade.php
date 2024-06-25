@extends('layouts.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.3.1/jquery.bootstrap-touchspin.min.css">
@endpush
@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 d-flex justify-content-between align-items-center"> 
            <h2>Our Product</h2>
            <form action="{{ route('lists.view-cart', ['list' => $list->id, 'customer_id' => $list->customer_id]) }}" method="GET">
                @csrf
                <button type="submit" class="border-0 position-relative">
                    <i class="ti ti-shopping-cart ti-md"></i>
                </button>
            </form>
        </div>    
    </div>                 

    @if(session('success'))
        <div class="alert alert-success">   
            {{ session('success') }}
        </div>  
    @endif
    <table class="table table-bordered mt-3 text-center">
        <thead class="table-dark">
            <tr>
                <th class="col-md-3">Product</th>
                <th>Code</th>
                <th class="col-md-4">Description</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td style="border: 1px solid #DDDDDD !important">
                        @if($product->product_image)
                            <img src="{{ asset('images/products/' . $product->product_image) }}" alt="{{ $product->product_name }}" width="100">
                        @else
                            No Image
                        @endif
                    </td>
                    <td style="border: 1px solid #DDDDDD !important">{{ $product->product_code }}</td>
                    <td style="border: 1px solid #DDDDDD !important">
                        <div>{{ $product->product_name }}</div>
                        <div>{{ $product->product_description }}</div>
                    </td>
                    <td style="border: 1px solid #DDDDDD !important">
                        <div class="input-group justify-content-center">
                            <span class="d-flex align-items-center">
                                <span class="me-1">Qty: </span>
                                <input type="number" name="quantity" value="1" min="1" required class="form-control input-touchspin text-center" data-product-id="{{ $product->id }}">
                            </span>
                        </div>
                        <button type="button" class="btn btn-primary mt-2 add-to-cart" data-product-id="{{ $product->id }}">Add to Cart</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@push('scripts')
    <script>
        console.log('Additional script loaded');
        console.log($.fn.TouchSpin);
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.7.3/jquery.bootstrap-touchspin.min.js" integrity="sha512-uztszeSSfG543xhjG/I7PPljUKKbcRnVcP+dz9hghb9fI/AonpYMErdJQtLDrqd9M+STTHnTh49h1Yzyp//d6g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script>
        $(document).ready(function() {
            $('.input-touchspin').TouchSpin({
                min: 1,
                max: 1000,
                step: 1,
                boostat: 5,
                maxboostedstep: 10,
                postfix: 'items'
            });

            $('.add-to-cart').click(function() {
                var button = $(this);
                var productId = button.data('product-id');
                var quantity = $('input[data-product-id="' + productId + '"]').val();

                $.ajax({
                    url: "{{ route('lists.add-to-cart', ['list' => $list->id, 'customer' => $list->customer_id]) }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        product_id: productId,
                        quantity: quantity
                    },
                    success: function(response) {
                        alert('Product added to cart successfully');
                    },
                    error: function(response) {
                        alert('An error occurred while adding the product to the cart');
                    }
                });
            });
        });
    </script>
@endpush
