@extends('layouts.app')
@push('css')
    <link rel="stylesheet" href="{{ asset_url('css/custom.css') }}" />
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

    <div class="inner-container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Welcome!</h2>
                </div>
                <div class="pull-left">
                    <h5>Please enter you detail</h5>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('customers.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">Your Name</p>
                        <input type="text" name="name" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">E-mail Address</strong>
                            <input type="email" name="email" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">Your City</p>
                        <input type="text" name="city" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">Your Phone</p>
                        <input type="text" name="phone" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <p class="text-secondary mb-1">Requirement</p>
                        <select name="status" class="form-control">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="pull-right mt-1 text-center">
                    <!-- <a class="btn btn-primary btn btn-dark" href="{{ route('customers.index') }}"> Back</a> -->
                    <button type="submit" class="btn btn-primary btn btn-dark me-1">Submit</button>
                    <button type="reset" class="btn btn-outline-dark waves-effect" data-bs-dismiss="modal"
                        aria-label="Close">Cancel</button>



                    <!-- <button onclick="window.location.href='{{ route('customers.index') }}'"
                        class="btn btn-primary create-new waves-effect waves-light btn-dark" tabindex="0"
                        aria-controls="DataTables_Table_0" type="button">Back</button> -->
                </div>
            </div>
        </form>
    </div>
</div>
</body>

</html>
@endsection