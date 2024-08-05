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
        <div class="d-flex justify-content-between productlistcenter">
          <div class="card-header flex-column flex-md-row">
            <div class="head-label text-center">
              <h2 class="card-title mb-0">Order Listing Page</h2>
            </div>
          </div>

          <!-- <div class="d-flex justify-content-between">
              <form></form>
              <div class="ms-auto displaycenter">
                  <button onclick="window.location.href='{{ route('products.create') }}'"
                      class="btn btn-primary create-new waves-effect waves-light btn-dark" tabindex="0"
                      aria-controls="DataTables_Table_0" type="button"><span><i class="ti ti-plus me-sm-1"></i> Add
                      Product</span></button>
              </div>
          </div> -->
          
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="mt-3 card p-2 table_scroll">
            <table id="orderTable" class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Customer Email</th>
                        <th>Qty</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td><img src="{{ asset('images/products/' . $order->product_order_image) }}" alt="{{ $order->product_name }}" width="100"></td>
                            <td>{{ $order->product_name }}</td>
                            <td>{{ $order->customer_email }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td class="d-flex">
                                <button type="button" class="btn px-1 py-0 view-btn me-1 text-secondary btn-outline-light"
                                    onclick="window.location.href='{{ route('products.show', $order->id) }}'">
                                    <i class="ti ti-eye me-1"></i> View
                                </button>
                                
                                <form action="{{ route('products.destroy', $order->id) }}" method="POST" id="deleteForm{{ $order->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn p-2 delete-btn text-danger" onclick="return confirmDelete('{{ $order->id }}');">
                                        <i class="ti ti-trash me-1"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>

@push('scripts')
   
    <script>

        $(document).ready(function() {
            $('#orderTable').DataTable({
                order: [[0, 'desc']],
                responsive: true
            });
        });

        function confirmDelete(id) {

            if (confirm('Are you sure you want to delete this product?')) {
                document.getElementById('deleteForm' + id).submit();
            }

            return false;

        }

    </script>

@endpush
@endsection
