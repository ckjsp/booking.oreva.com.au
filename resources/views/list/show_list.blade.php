@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset_url('css/custom.css') }}" />
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ url()->previous() }}" class="float-left d-flex"><i
                    class="ti ti-arrow-narrow-left border border-dark rounded-circle mx-1 me-2"></i>Back</a>
        </div>
      
    </div>
    
</div>

<div class="container mt-5">

    <div class="row">
    
        <div class="col-lg-12 margin-tb">
      
            <div class="pull-left">
                <h2>View Customer Details</h2>
               
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <!-- <div class="col-xs-12 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">List Details</h5>

                    <div class="form-group">
                        <strong>Name:</strong>
                        {{ $list->name }}
                    </div>

                    <div class="form-group">
                        <strong>Description:</strong>
                        {{ $list->description }}
                    </div>

                    <div class="form-group">
                        <strong>Contact Number:</strong>
                        {{ $list->contact_number }}
                    </div>
                    
                    <div class="form-group">
                        <strong>Contact Email:</strong>
                        {{ $list->contact_email }}
                    </div>
                    
                    <div class="form-group">
                        <strong>Product:</strong>
                        {{ $list->product_name ?? 'N/A' }}
                    </div>
                </div>
            </div>
        </div> -->
        <div class="col-xs-12 col-sm-6">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h5 class="card-title"></h5>
                <div>
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
            </div>
            <div class="form-group mt-3">
                <strong>Customer Name:</strong>
                {{ $customer->name }}
            </div>
            <div class="form-group">
                <strong>Customer ID:</strong>
                {{ $customer->id }}
            </div>
            <div class="form-group">
                <strong>Email ID:</strong>
                {{ $customer->email }}
            </div>
            <div class="form-group">
                <strong>Phone Number:</strong>
                {{ $customer->phone }}
            </div>
        </div>
    </div>
</div>

    
                        
    <div class="container">
  
    <div class="row">
   
      
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
    <button onclick="window.location.href='{{ route('lists.addcartproduct', ['list' => $list->id, 'customer' => $list->customer_id]) }}'" class="btn btn-primary create-new waves-effect waves-light btn-dark" tabindex="0"
                        aria-controls="DataTables_Table_0" type="button"><span><i class="ti ti-plus me-sm-1"></i> Add New
                        Product</span></button>
        <div class="card">
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
                                    <div class="text-dark fs-4 fw-bold text-capitalize">{{ $order->product_name }}
                                    </div>
                                    <div><strong class="text-secondary">Brand Name:</strong><span class="text-secondary">
                                    {{ $list->name }}
                                    </span></div>
                                    <div>

                                    <form
                                    action="{{ route('orders.updateQuantity', ['order' => $order->id]) }}"
                                    method="POST" class="d-flex qty-update-form">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="quantity" value="{{ $order['quantity'] }}">
                                    <div class="input-group align-items-center">
                                        <span class="d-flex align-items-center"><span class="me-3">Qty:
                                            </span><input type="number" name="quantity" value="{{ $order['quantity'] }}" min="1" required
                                                class="form-control input-touchspin text-center border quantity-input"></span>
                                    </div>
                                </form>
                                                                            
                                       
                                    </div>
                                    <!-- <div class="fs-5 fw-bold text-dark" style="line-height: 28px;"><span> ₹
                                        </span>{{ $order->price }}</div> -->
                                </div>
                                <div class="d-flex ms-auto">
                                        
                                    <form
                                        action="{{ route('orders.destroyOrders', ['order' => $order->id]) }}"
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
</div>
<script>

    function confirmRemove() {

        return confirm('Are you sure you want to remove this item from the cart?');

    }
    $(document).ready(function() {
        $('#customerListsTable').DataTable();
    });
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
        var input = $(this).closest('.input-group').find('.quantity-input');
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            input.val(currentVal + 1);
            updateQuantity(input);
        }
    });

    // Handle minus button click
    $('.bootstrap-touchspin-down').click(function() {
        var input = $(this).closest('.input-group').find('.quantity-input');
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal) && currentVal > 0) {
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
            type: 'PATCH',  // Correctly use PATCH method
            data: form.serialize(), // Include CSRF token and other form data
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            
            success: function(response) {
                console.log('Quantity updated successfully:', response);
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
@endpush
