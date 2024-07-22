@extends('layouts.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
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
                <h2>View Profile</h2>
            </div>
        </div>
    </div>

    <div class="card px-3 py-4">
        <div class="d-flex flex-end ms-auto">
            <!-- <div class="status-active me-3 border">
                @if($customer->status === 'Active')
                    <span class="dot" style="background-color: green;"></span>
                @else
                    <span class="dot" style="background-color: orange;"></span>
                @endif
                {{ $customer->status }}
            </div> -->

            <button type="button" class="btn p-0 edit-btn text-info"
                onclick="window.location.href='{{ route('customers.edit', $customer->id) }}'">
                <i class="ti ti-pencil me-1"></i></button>
            <form action="{{ route('customers.destroy', $customer->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button" class="btn p-0 delete-btn text-danger dropdown-item"
                    onclick="this.closest('form').submit();">
                    <i class="ti ti-trash me-1"></i> </button>
            </form>
        </div>

        <div class="d-flex">
            <!-- <div class="profile-image me-4">
                <img src="{{ !empty(Auth::user()->image) ? url('storage/app/'. Auth::user()->image) : asset('img/avatars/1.png') }}"
                    alt="Profile Image" class="profile-img" />
            </div> -->

            <div class="ms-4 d-flex flex-column justify-content-center w-100">
                <div class="row mb-2">
                    <div class="col-4 fw-bold">Customer Name:</div>
                    <div class="col-8">{{ $customer->name }}</div>
                </div>

                <div class="row mb-2">
                    <div class="col-4 fw-bold">Customer ID:</div>
                    <div class="col-8">{{ $customer->id }}</div>
                </div>
                
                <div class="row mb-2">
                    <div class="col-4 fw-bold">Email ID:</div>
                    <div class="col-8">{{ $customer->email }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-4 fw-bold">Phone Number:</div>
                    <div class="col-8">{{ $customer->phone }}</div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right text-end">
                    <button onclick="window.location.href='{{ route('createlist', ['customer_id' => $customer->id]) }}'"
                        class="btn btn-outline-dark text-dark" tabindex="0" aria-controls="DataTables_Table_0"
                        type="button"><span><i class="ti ti-plus me-sm-1"></i> Create List</span></button>
                </div>
            </div>
        </div>

        <table class="table table-bordered mt-3" style="border: 1px solid #DDDDDD; border-spacing: 0 10px;">
            <thead class="table-dark">
                <tr>
                    <th>List</th>
                    <th>Description</th>
                    <th>Product Count</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customer->lists as $list)
                    <tr class="mt-2">
                        <td style="border: 1px solid #DDDDDD !important">{{ $list->name }}</td>
                        <td style="border: 1px solid #DDDDDD !important;">{{ $list->description }}</td>
                        <td style="border: 1px solid #DDDDDD !important;">
                            {{ $list->orders->count() }}
                        </td>
                        <td class="p-2" style="border: 1px solid #DDDDDD !important;">
                            <div class="d-flex justify-content-between">
                                <button type="button"
                                    class="btn p-2 edit-btn text-dark btn-outline-light me-1 show-customer-btn"
                                    onclick="window.location.href='{{ route('lists.edit', $list->id) }}'">
                                    <i class="ti ti-pencil me-1"></i> </button>
                                    <button type="button"
                                    class="btn p-2 view-btn text-dark btn-outline-light me-1 show-customer-btn"
                                    onclick="window.location.href='{{ route('showlistcustomer', ['listId' => $list->id, 'customerId' => $customer->id]) }}'">
                                <i class="ti ti-eye me-1"></i> 
                                </button>

                                <button type="button" class="btn p-2 view-btn text-dark btn-outline-light show-customer-btn"
                                    onclick="window.location.href='{{ route('lists.addcartproduct', ['list' => $list->id, 'customer' => $list->customer_id]) }}'"><span><i
                                            class="ti ti-plus me-sm-1 border border-dark rounded-circle mx-1 me-2 text-dark"></i></span>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>

    function confirmDelete() {
        return confirm('Are you sure you want to delete this list?');
    }
    
</script>

@endsection
