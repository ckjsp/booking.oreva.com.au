@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
@endpush

@section('content')
<div id="app" class="layout-wrapper">
  @include('include.sidebar')

  <div class="container-customerlist">
    @include('include.navbar')
    <div class="row mb-3">
    <div class="col-12 editpadding">
    <a href="{{ route('home') }}" class="d-flex align-items-center text-dark">
        <i class="ti ti-arrow-narrow-left border border-dark rounded-circle mx-1 me-2"></i> Back 
    </a>
</div>
    </div>
    
    <!-- Alert container -->
    <div id="alert-container"></div>
    
    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
        <div class="d-flex justify-content-between">
        <div class="card-header flex-column flex-md-row">
            <div class="head-label text-center">
                <h2 class="card-title mb-0">Product Listing Page</h2>
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <form></form>
            <div class="ms-auto">
                <button onclick="window.location.href='{{ route('products.create') }}'"
                    class="btn btn-primary create-new waves-effect waves-light btn-dark" tabindex="0"
                    aria-controls="DataTables_Table_0" type="button"><span><i class="ti ti-plus me-sm-1"></i> Add
                    Product</span></button>
            </div>
        </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="mt-3 card">
            <table id="productTable" class="table table-bordered">
                <thead class="table-dark">

                    <tr>
                        <th>Product Image</th>
                        <th>Profile Info</th>
                        <th>Qty</th>
                        <th>Stock</th>
                        <th>Action</th>
                    </tr>
                    
                </thead>

                <tbody>

                    @foreach ($products as $product)
                    
                        <tr>
                            <td><img src="{{ asset('images/products/' . $product->product_image) }}" alt="{{ $product->product_name }}" width="100"></td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->product_stock }}</td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input stock-toggle" type="checkbox" role="switch" id="stockSwitch{{ $product->id }}" data-id="{{ $product->id }}" {{ $product->in_stock ? 'checked' : '' }}>
                                    <label class="form-check-label" for="stockSwitch{{ $product->id }}"></label>
                                </div>
                            </td>
                            <td class="d-flex">
                                <button type="button" class="btn px-1 py-0 edit-btn me-1 text-secondary btn-outline-light"
                                    onclick="window.location.href='{{ route('products.edit', $product->id) }}'">
                                    <i class="ti ti-pencil me-1"></i> Edit </button>
                                <button type="button" class="btn px-1 py-0 view-btn me-1 text-secondary btn-outline-light"
                                    onclick="window.location.href='{{ route('products.show', $product->id) }}'">
                                    <i class="ti ti-eye me-1"></i> View
                                </button>
                                
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" id="deleteForm{{ $product->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn p-2 delete-btn text-danger" onclick="return confirmDelete('{{ $product->id }}');">
                                        <i class="ti ti-trash me-1"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- <div class="d-flex justify-content-center mt-3">
            {!! $products->links() !!}
        </div> -->

    </div>
</div>

<script>
    
    $(document).ready(function() {

        // Initialize DataTable
        $('#productTable').DataTable({
            "order": [[0, 'desc']] 
        });

        // Handle toggle switch change
        $('.stock-toggle').on('change', function() {

            const productId = $(this).data('id');
            const inStock = $(this).is(':checked');
            
            $.ajax({

                url: '{{ route('products.updateStock') }}', 
                type: 'POST',
                data: {

                    _token: '{{ csrf_token() }}',
                    id: productId,
                    in_stock: inStock ? 1 : 0 
                },

                success: function(response) {
                    const alertType = response.success ? 'success' : 'danger';
                    const message = response.success ? 'Stock status updated successfully!' : 'Failed to update stock status.';
                    
                    // Append Bootstrap alert message
                    $('#alert-container').html(`
                        <div class="alert alert-${alertType} alert-dismissible fade show" role="alert">
                            <strong>${message}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `);
                    
                    if (!response.success) {
                        // Optionally, revert the toggle state if update fails
                        $(this).prop('checked', !inStock);
                    }

                }.bind(this) // Bind context to handle `this` correctly
            });
        });
    });

    function confirmDelete(productId) {

        if (confirm("Are you sure you want to delete this product?")) {
            document.getElementById('deleteForm' + productId).submit();
        }

        return false;
        
    }
  
</script>

@endsection
