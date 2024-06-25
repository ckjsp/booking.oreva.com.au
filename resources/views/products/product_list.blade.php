@extends('layouts.app')
@push('css')
    <link rel="stylesheet" href="{{ asset_url('css/custom.css') }}" />
@endpush
@section('content')

<div class="container mt-5">
    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
        <div class="card-header flex-column flex-md-row">
            <div class="head-label text-center">
                <h2 class="card-title mb-0">Product Listing Page</h2>
            </div>
        </div>
        <div class="d-flex justify-content-spacebetween">
            <form></form>
            <div class=" ms-auto">
                <button onclick="window.location.href='{{ route('products.create') }}'"
                    class="btn btn-primary create-new waves-effect waves-light btn-dark" tabindex="0"
                    aria-controls="DataTables_Table_0" type="button"><span><i class="ti ti-plus me-sm-1"></i> Add
                        Product</span></button>
            </div>
        </div>

        <!-- <a class="btn btn-success" href="{{ route('products.create') }}"> Add Product</a> -->


        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="mt-3 card">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th class="sorting_disabled dt-checkboxes-cell dt-checkboxes-select-all" rowspan="1" colspan="1"
                            style="width: 18px;" data-col="1" aria-label=""><input type="checkbox"
                                class="form-check-input round-checkbox"></th>
                        <th>Profile Info</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <!-- <th>Stock</th> -->
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td class="  dt-checkboxes-cell"><input type="checkbox"
                                    class="dt-checkboxes form-check-input round-checkbox">
                            </td>
                            <td>{{ $product->product_name }}</td>
                            <!-- <td>{{ $product->product_code }}</td> -->
                            <!-- <td>{{ $product->product_description }}</td> -->
                            <td>{{ $product->product_price }}</td>
                            <td>{{ $product->product_stock }}</td>
                            <td class="d-flex">

                                <button type="button" class="btn px-1 py-0 edit-btn me-1 text-secondary btn-outline-light"
                                    onclick="window.location.href='{{ route('products.edit', $product->id) }}'">
                                    <i class="ti ti-pencil me-1"></i> Edit </button>
                                <button type="button" class="btn px-1 py-0 view-btn me-1 text-secondary btn-outline-light"
                                    onclick="window.location.href='{{ route('products.show', $product->id) }}'">
                                    <i class="ti ti-eye me-1"></i> View
                                </button>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn p-2 delete-btn text-danger"
                                        onclick="this.closest('form').submit();">
                                        <i class="ti ti-trash me-1"></i>
                                    </button>
                                </form>

                            </td>
                            
                            <!-- <td>
                                                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                                                        onsubmit="return confirmDelete()">
                                                                        <a class="btn btn-info" href="{{ route('products.show', $product->id) }}">Show</a>
                                                                        <a class="btn btn-primary" href="{{ route('products.edit', $product->id) }}">Edit</a>
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                                    </form>
                                                                </td> -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {!! $products->links() !!}
    </div>
</div>

<script>

    function confirmDelete() {
        return confirm('Are you sure you want to delete this product?');
    }

</script>

@endsection