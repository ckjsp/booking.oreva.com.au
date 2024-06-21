@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Customer Listing</h2>
            </div>

            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('customers.create') }}"> Add Profile</a>
                <a class="btn btn-primary" href="{{ route('showproduct') }}"> Products</a>
                <!-- Added Products Button -->

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <thead class="bg_clr">
            <tr>
                <!-- <th>No</th> -->
                <th>Client ID</th>
                <th>Customer Name</th>
                <th>Email</th>
                <!-- <th>City</th> -->
                <!-- <th>Phone</th> -->
                <th>Status</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
                <tr>
                    <!-- <td>{{ $loop->iteration }}</td> -->
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <!-- <td>{{ $customer->city }}</td> -->
                    <!-- <td>{{ $customer->phone }}</td> -->
                    <td>{{ $customer->status }}</td>
                    <td>
                        <form action="{{ route('customers.destroy', $customer->id) }}" method="POST">
                            <!-- <button type="button" class="btn p-0 edit-btn text-info"
                                        onclick="window.location.href=`{{ route('customers.show', $customer->id) }}`"><i
                                            class=" ti ti-pencil text-primary"></i></button> -->
                            <button type="button" class="btn p-0 edit-btn text-info"
                                onclick="window.location.href='{{ route('customers.edit', $customer->id) }}'">
                                <i class="ti ti-pencil me-1"></i> Edit
                            </button>
                            <button type="button" class="btn p-0 view-btn text-info"
                                onclick="window.location.href='{{ route('customers.show', $customer->id) }}'">
                                <i class="ti ti-eye me-1"></i> View
                            </button>
                            @csrf
                            @method('DELETE')
                            <!-- <button type="submit" class="btn btn-danger">Delete</button> -->
                            <button type="button" class="btn p-0 delete-btn text-danger">
                                <i class="ti ti-trash me-1"></i>Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>

    function confirmDelete() {

        return confirm('Are you sure you want to delete this customer?');

    }
    
</script>

@endsection
