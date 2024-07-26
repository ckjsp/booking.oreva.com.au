@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row mb-3">
        <div class="col-12">
            <a href="{{ route('home') }}">
                <i class="ti ti-arrow-narrow-left border border-dark rounded-circle mx-1 me-2"></i> Back 
            </a>
        </div>
    </div>

    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
        <div class="card-header flex-column flex-md-row">
            <div class="head-label text-center">
                <h2 class="card-title mb-0">All Customer</h2>
            </div>
            <div class="dt-action-buttons text-end pt-6 pt-md-0 p-2">
                <div class="dt-buttons flex-wrap">
                    <button onclick="window.location.href='{{ route('customers.create') }}'"
                        class="btn btn-primary create-new waves-effect waves-light btn-dark" tabindex="0"
                        aria-controls="DataTables_Table_0" type="button">
                        <span><i class="ti ti-plus me-sm-1"></i> Add Customer</span>
                    </button>
                </div>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="card mt-6 p-2">
            <table class="table datatables-projects" id="customerlist">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Selection For</th>
                        <th></th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($customers as $customer)
                        <tr>
                            <td>{{ $customer->id }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->status }}</td>
                            <td>
                                <button class="btn btn-primary btn-sm set-btn" data-customer-id="{{ $customer->id }}">
                                    Set
                                </button>       
                            </td>
                            <td>
                                <div class="d-inline-block">   
                                        <i class="ti ti-dots-vertical ti-md"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end m-0">
                                        <button type="button" class="btn p-0 edit-btn text-info dropdown-item" onclick="window.location.href='{{ route('customers.edit', $customer->id) }}'">
                                            <i class="ti ti-pencil me-1"></i> Edit 
                                        </button>
                                        <button type="button" class="btn p-0 view-btn text-info dropdown-item" onclick="window.location.href='{{ route('customers.show', $customer->id) }}'">
                                            <i class="ti ti-eye me-1"></i> View
                                        </button>
                                        <div class="dropdown-divider"></div>
                                        <form action="{{ route('customers.destroy', $customer->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn p-0 delete-btn text-danger dropdown-item" onclick="this.closest('form').submit();">
                                                <i class="ti ti-trash me-1"></i> Delete
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

<!-- Bootstrap Modal -->
<div class="modal fade" id="setModal" tabindex="-1" aria-labelledby="setModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="setModalLabel"></h5>
                <a href="#" id="createListLink" class="ms-auto">Create List</a>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="setCustomerForm">
                    <div class="mb-3">
                        <label for="dropdownList" class="form-label">Select List</label>
                        <select id="dropdownList" class="form-select" aria-label="Select an Option">
                            <option disabled>Loading...</option>
                        </select>
                    </div>
                    <input type="hidden" id="selectedCustomerId" name="customer_id" />
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary" id="selectButton">Select</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script>

$(document).ready(function () {
    $('#customerlist').DataTable({
        order: [[1, 'desc']]
    });

    // Handle "Set" button click
    $(document).on('click', '.set-btn', function () {
        var customerId = $(this).data('customer-id');
        $('#selectedCustomerId').val(customerId);

        // Fetch the list options from the server
        $.ajax({
            url: '/get-lists',
            method: 'GET',
            data: { customer_id: customerId },
            success: function (response) {
                // Populate dropdown with options or show a message if no lists are available
                var options = '';
                if (response.length > 0) {
                    response.forEach(function (list) {
                        options += `<option value="${list.id}">${list.name}</option>`;
                    });
                    $('#dropdownList').html(options);
                } else {
                    $('#dropdownList').html('<option disabled>No lists available</option>');
                }
                // Set the create list link
                var createUrl = '{{ route('createlist', ['customer_id' => ':customer_id']) }}';
                createUrl = createUrl.replace(':customer_id', customerId);
                $('#createListLink').attr('href', createUrl);

                $('#setModal').modal('show');
            },
            error: function (xhr, status, error) {
                console.error('Error fetching lists:', error);
            }
        });
    });

    // Handle form submission
    $('#setCustomerForm').on('submit', function (event) {
        event.preventDefault();
        var customerId = $('#selectedCustomerId').val();
        var selectedOption = $('#dropdownList').val();

        // Construct the URL
        var url = '{{ route('lists.addcartproduct', ['list' => 'LIST_ID', 'customer' => 'CUSTOMER_ID']) }}';
        url = url.replace('LIST_ID', selectedOption).replace('CUSTOMER_ID', customerId);

        // Redirect to the constructed URL
        window.location.href = url;
    });
});

</script>

@endsection
