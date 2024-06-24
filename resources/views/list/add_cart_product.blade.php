@extends('layouts.app')
@push('css')
    <link rel="stylesheet" href="{{ asset_url('css/custom.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.3.1/jquery.bootstrap-touchspin.min.css">
@endpush
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 d-flex justify-content-between align-items-center"> 
            <h2>Our Product</h2>
            <form action="{{ route('lists.view-cart', ['list' => $list->id, 'customer_id' => $list->customer_id]) }}" method="GET">
            @csrf
                <button type="submit" class="border-0" ><i class="ti ti-shopping-cart ti-md"></i></button>
            </form>
        </div>    
    </div>
    @if(session('success'))x
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
                <td class="border">
                    @if($product->product_image)
                        <img src="{{ asset('images/products/' . $product->product_image) }}" alt="{{ $product->product_name }}" width="100">
                    @else
                        No Image
                    @endif
                </td>
                <td class="border">{{ $product->product_code }}</td>
                <td class="border">
                    <div>{{ $product->product_name }}</div>
                    <div>{{ $product->product_description }}</div>
                </td>
                <td class="border">
                    <form action="{{ route('lists.add-to-cart', ['list' => $list->id, 'customer' => $list->customer_id]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="input-group justify-content-center align-items-center">
                            <span class="d-flex align-items-center justify-content-center"><span class="me-3">Qty: </span><input type="number" name="quantity" value="1" min="1" required class="form-control input-touchspin text-center border"></span>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2 w-70 px-2">Add to Cart</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@push('scripts')
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
        });
    </script>
@endpush

