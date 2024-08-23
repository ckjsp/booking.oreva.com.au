@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
@endpush

@section('content')
<div id="app" class="layout-wrapper">
  @include('include.sidebar') 
  <div class="container">
    @include('include.navbar') 

    <div class="row">
      <div class="col-md-12 d-flex justify-content-between align-items-center editpadding">
        <div class="col-md-12">
          <a href="{{ route('home') }}" class="float-left d-flex text-black">
            <i class="ti ti-arrow-narrow-left border border-dark rounded-circle mx-1 me-2 text-black rounded"></i>Back
          </a>
        </div>
      </div>
    </div>
    <div class="container mt-5">
      <div class="inner-container custmrmt0">
        <div class="row">
          <div class="col-lg-12 margin-tb">
            <div class="pull-left">
              <h2>Update Setting</h2>
            </div>
            <div class="pull-left">
              <h5>Please enter your details</h5>
            </div>
          </div>
        </div>

        <!-- Display success message with close button -->
        @if (session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        @if ($errors->any())
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                <div class="form-group">
                    <label for="logo" class="text-secondary mb-1">Logo</label>
                    <input type="file" class="form-control border border-white-50 @error('logo') is-invalid @enderror" id="logo" name="logo">
                    @if(isset($settings['logo']))
                        <img src="{{ asset('/' . get_setting('logo')) }}" alt="Logo" style="max-width: 100px;">
                    @endif
                    @error('logo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control border border-white-50 @error('address') is-invalid @enderror" id="address" name="address" value="{{ $settings['address']->setting_value ?? '' }}">
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="pull-right mt-1 text-center">
                <button type="submit" class="btn btn-primary btn btn-dark me-1 rounded">Save Setting</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
