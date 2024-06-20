@extends('layouts.app')
@push('css')
    <link rel="stylesheet" href="{{ asset_url('css/custom.css') }}" />
    <link rel="stylesheet" href="{{ asset_url('libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset_url('libs/dropzone/dropzone.css') }}" />
@endpush
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
                <a class="btn btn-danger" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
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
                <th>No</th>
                <th>Client ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>City</th>
                <th>Phone</th>
                <th>Status</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->city }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>
                        <form action="{{ route('customers.updateStatus', $customer->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <select name="status" class="form-control" onchange="this.form.submit()">
                                <option value="active">Select Status</option>
                                <option value="active" {{ $customer->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $customer->status == 'inactive' ? 'selected' : '' }}>Inactive
                                </option>
                            </select>
                            <input type="hidden" name="email" value="{{ $customer->email }}">
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('customers.destroy', $customer->id) }}" method="POST">
                            <!-- <button type="button" class="btn p-0 edit-btn text-info"
                                        onclick="window.location.href=`{{ route('customers.show', $customer->id) }}`"><i
                                            class=" ti ti-pencil text-primary"></i></button> -->
                            <button type="button" class="btn p-0 edit-btn text-info"
                                onclick="window.location.href='{{ route('customers.show', $customer->id) }}'">
                                <i class="ti ti-pencil text-primary"></i> Edit
                            </button>

                            <a class="btn btn-info" href="{{ route('customers.show', $customer->id) }}">Show</a>
                            <a class="btn btn-primary" href="{{ route('customers.edit', $customer->id) }}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection