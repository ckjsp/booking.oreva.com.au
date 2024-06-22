@extends('layouts.app')
@push('css')
    <link rel="stylesheet" href="{{ asset_url('css/custom.css') }}" />
    <link rel="stylesheet" href="{{ asset_url('libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset_url('libs/dropzone/dropzone.css') }}" />
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" /> -->

@endpush
@section('content')

<div class="container mt-5">
    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
        <div class="card-header flex-column flex-md-row">
            <div class="head-label text-center">
                <h2 class="card-title mb-0">Customer Listing</h2>
            </div>
            <div class="dt-action-buttons text-end pt-6 pt-md-0">
                <div class="dt-buttons flex-wrap">
                    <button onclick="window.location.href='{{ route('customers.create') }}'"
                        class="btn btn-primary create-new waves-effect waves-light btn-dark" tabindex="0"
                        aria-controls="DataTables_Table_0" type="button"><span><i class="ti ti-plus me-sm-1"></i> Add
                            Profile</span></button>
                </div>
            </div>
        </div>

        <!-- <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Customer Listing</h2>
                </div>

                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('customers.create') }}"> Add Profile</a> -->
        <!-- <a class="btn btn-primary" href="{{ route('showproduct') }}"> Products</a> -->
        <!-- Added Products Button -->

        <!-- <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div> -->

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="card mt-4">
            <table class="table datatables-projects" id="customerlist">
                <thead class="table-dark">
                    <tr>
                        <th>Client ID</th>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($customers as $customer)
                        <tr>
                            <td>{{ $customer->id }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>@if($customer->status === 'Active')
                                <span class="dot" style="background-color: green;"></span>
                            @else
                                <span class="dot" style="background-color: orange;"></span>
                            @endif
                                {{ $customer->status }}
                            </td>
                            <td>
                                <div class="d-inline-block"><a href="javascript:;"
                                        class="btn-sm btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow show"
                                        data-bs-toggle="dropdown" aria-expanded="true"><i
                                            class="ti ti-dots-vertical ti-md"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end m-0">
                                        <button type="button" class="btn p-0 edit-btn text-info dropdown-item"
                                            onclick="window.location.href='{{ route('customers.edit', $customer->id) }}'">
                                            <i class="ti ti-pencil me-1"></i> Edit </button>
                                        <button type="button" class="btn p-0 view-btn text-info dropdown-item"
                                            onclick="window.location.href='{{ route('customers.show', $customer->id) }}'">
                                            <i class="ti ti-eye me-1"></i> View
                                        </button>
                                        <div class="dropdown-divider"></div>
                                        <form action="{{ route('customers.destroy', $customer->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn p-0 delete-btn text-danger dropdown-item"
                                                onclick="this.closest('form').submit();">
                                                <i class="ti ti-trash me-1"></i>Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
<!-- @push('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            var table = $('#customerlist').DataTable();
        });
    </script>
@endpush -->