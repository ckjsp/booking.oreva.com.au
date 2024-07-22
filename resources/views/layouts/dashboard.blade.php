
<!doctype html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
  data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template">

<head>

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Customer Listing</title>

  <meta name="description" content="" />

  <!-- Custom CSS -->
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet"/>

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

  <!-- Icons -->
  <link rel="stylesheet" href="{{ asset('fonts/fontawesome.css') }}" />
  <link rel="stylesheet" href="{{ asset('fonts/tabler-icons.css') }}" />
  <link rel="stylesheet" href="{{ asset('fonts/flag-icons.css') }}" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="{{ asset('css/rtl/core.css') }}" class="template-customizer-core-css" />
  <link rel="stylesheet" href="{{ asset('css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="{{ asset('css/demo.css') }}" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="{{ asset('libs/node-waves/node-waves.css') }}" />
  <link rel="stylesheet" href="{{ asset('libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
  <link rel="stylesheet" href="{{ asset('libs/typeahead-js/typeahead.css') }}" />
  <link rel="stylesheet" href="{{ asset('libs/apex-charts/apex-charts.css') }}" />
  <link rel="stylesheet" href="{{ asset('libs/swiper/swiper.css') }}" />
  <link rel="stylesheet" href="{{ asset('libs/datatables-bs5/datatables.bootstrap5.css') }}" />
  <link rel="stylesheet" href="{{ asset('libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
  <link rel="stylesheet" href="{{ asset('libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />

  <!-- Page CSS -->
  <link rel="stylesheet" href="{{ asset('css/pages/cards-advance.css') }}" />

  <!-- Helpers -->
  <script src="{{ asset('js/helpers.js') }}"></script>
  <!-- Template customizer & Theme config files -->
  <script src="{{ asset('assets/vendor/js/template-customizer.js') }}"></script>
  <script src="{{ asset('assets/js/config.js') }}"></script>

</head>

<body>

  <!-- Content goes here -->


    <style>

    body

    {
      max-width: 800px;
      margin: 0 auto;
    }

    .layout-wrapper {

        display: flex;
        /* height: 100vh; */

    }

    .sidebar {


        width: 80px;
        background-color: #001D22;

    }

    .content-wrapper {

        flex-grow: 1;
        padding: 20px;

    }

    .content-wrapper {
   
    justify-content: flex-start !important;
}

    .navbar {

        background-color: #f8f9fa;

    }

    .navbar-brand {

        display: flex;
        align-items: center;

    }

    .navbar-brand img {

        margin-right: 10px;

    }

    .navbar-nav .nav-link {

        color: #343a40;

    }

    .navbar-nav .nav-link img {

        margin-left: 10px;

    }

    .pd

    {

      padding: 15px;

    }

    .menu-inner

    {
      flex-direction: column;
    }



</style>
</head>
<body>

  <div id="app" class="layout-wrapper">
      <aside class="sidebar">
  <div class="app-brand demo">
      <a href="#" class="app-brand-link">
      <img src="{{ asset('img/dashboardlogo.svg') }}" alt="Logo" class="pd">
         </a>
  </div>
<hr class="text-secondary"/>
  <ul class="menu-inner align-items-center py-1">
      <!-- Dashboards -->
      <li class="menu-item">
          <a href="#" class="menu-link">
             
             <img  src="{{ asset('img/dashboardhomeicon.png') }}" class="pd"/> 
          </a>
      </li>
      <!-- Users List -->
      <li class="menu-item ">
          <a href="#" class="menu-link">
           
               <img  src="{{ asset('img/Frame (10).png') }}"   class="pd"/>
          </a>
      </li>
      <!-- Add other menu items here -->
      <li class="menu-item ">
        <a href="#" class="menu-link">
         
            <img  src="{{ asset('img/Frame (11).png') }}"   class="pd"/>

        </a>
    </li>

    <li class="menu-item ">
      <a href="#" class="menu-link">
        
          <img  src="{{ asset('img/Frame (12).png') }}"   class="pd"/>

      </a>
  </li>

  <li class="menu-item ">
    <a href="#" class="menu-link">
    
        <img  src="{{ asset('img/Frame (13).png') }}"   class="pd"/>

    </a>
</li>

<li class="menu-item">
  <a href="#" class="menu-link">
    
      <img  src="{{ asset('img/Frame (14).png') }}"   class="pd"/>

  </a>
</li>
  </ul>
</aside>


<!-- Including the sidebar partial -->

      <div class="content-wrapper">
          <nav class="navbar navbar-expand-lg navbar-light">
  <div class="container-fluid">
   
      <p class="dashboard_text fw-bolder text-black">Dashboard</p>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse " id="navbarNav">
          <ul class="navbar-nav ms-auto column-gap-3">
          <img  src="{{ asset('img/Frame (15).png') }}"   class="pd"/>

                  <span class="text-black">MENU</span>
              </li>
              <li class="nav-item">
                <div class="avatar avatar-sm"><img  src="{{ asset('img/Mask group (20).png') }}" alt="Avatar"
                  class="rounded-circle pull-up"></div>
              </li>
          </ul>
      </div>
  </div>
</nav>

<div class="row g-2">
  <!-- section 1 start -->
  <div class="col-12 col-sm-6  col-lg-3">
  <a href="{{ route('customers.index') }}" class="menu-link d-block">

    <div class="card rounded-0">
          <div class="card-body text-nowrap">
            <div class="d-flex justify-content-between"> 
            <h5 class="card-title mb-0 fs-5">{{ $customerCount }}</h5> 
               <img   src="{{ asset('img/Frame (16).png') }}">

            </div>
            <p class="mb-2">Customers</p>
          </div>
    </div>
</a>
  </div>

  <div class="col-12 col-sm-6  col-lg-3">
  <a href="{{ route('showproduct') }}" class="menu-link d-block">

    <div class="card rounded-0">
          <div class="card-body text-nowrap">
            <div class="d-flex justify-content-between">
            <h5 class="card-title mb-0 fs-5">{{ $productCount }}</h5> 
              <img   src="{{ asset('img/Frame (17).png') }}">
              </div>
            <p class="mb-2">Product</p>
          </div>
    </div>
    </a>

  </div>

  <div class="col-12 col-sm-6  col-lg-3">
    <div class="card rounded-0">
          <div class="card-body text-nowrap">
            <div class="d-flex justify-content-between">
              <h5 class="card-title mb-0 fs-5">{{$orderCount}}</h5>
              <img   src="{{ asset('img/Frame (18).png') }}">
              </div>
            <p class="mb-2">Order</p>
          </div>
    </div>
  </div>

  
  <div class="col-12 col-sm-6  col-lg-3">
    <div class="card rounded-0">
          <div class="card-body text-nowrap">
            <div class="d-flex justify-content-between">
            <h5 class="card-title mb-0 fs-5"></h5>
              <img   src="{{ asset('img/Frame (19).png') }}">
              </div>
            <p class="mb-2">Earnings</p>
          </div>
    </div>
  </div>

  <!-- section 1 end -->

  <!-- section 2 start -->
   
  <div class="col-xl-7 col-12">
    <div class="card rounded-0 mt-3 ">
      <div class=" d-flex justify-content-between">
        <div class="mt-17">
         <span class="border border-bottom-0 text-black p-3">Customer</span>
         <span class="p-3 text-black">Product</span>
         <span class="text-black">Order</span>
        </div>
      </div>
      <hr/>

      <div class="text-center mb-3">
      <img   src="{{ asset('img/Frame (16).png') }}">
       <img   src="{{ asset('img/dashboardimg.png') }}" width="400px">
      </div>
    </div>
  </div>
  <div class="col-xl-5 col-12">
    <div class="card rounded-0 mt-3" style="height: 316px;">
        <div class="pd d-flex justify-content-between">
            <div class="card-title mb-0">
                <h5 class="mb-1 fs-6">Recent Product</h5>
            </div>
            <div>
                <a href="{{ route('showproduct') }}" class="fs-6 text-primary">See All</a>
            </div>
        </div>
        <table class="table">
    <thead>
        <tr>
            <th>Product Image</th>
            <th>Product Name</th>
            <th>View Product</th>
        </tr>
    </thead>
    <tbody>
        @foreach($recentProduct as $product)
        <tr>
            <td>
                <img src="{{ asset('images/products/' . $product->product_image) }}" alt="" style="max-width: 50px;">
            </td>
            <td>
                <p>{{ substr($product->product_name, 0, 5) }}</p>
            </td>
            <td>
                <a href="{{ route('products.show', ['product' => $product->id]) }}" class="btn-sm btn-text-secondary rounded-pill btn-icon">
                    <i class="ti ti-eye"></i> View
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

    </div>
</div>
  </div>

  <!-- section 2 end -->
  <div class="row mt-3">
    <div class="col-12">
        <div class="card rounded-0">
            <div class="card-datatable table-responsive">
                <table class="datatables-projects table border-top">

                    <thead>
                        <tr>
                            <th class="customerlist_text text-black d-flex">
                                <input type="checkbox" class="dt-checkboxesbox form-check-input">Customer
                            </th>
                            <th class="customerlist_text text-black">Email</th>
                            <th class="customerlist_text text-black">Status</th>
                            <th class="customerlist_text text-black">Orders</th>
                            <th class="w-px-50 customerlist_text text-black">Estimate</th>
                            <th class="customerlist_text text-black">Actions</th> <!-- New column for Actions -->
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($customers as $customer)
                        <tr>
                            <td class="customertext text-black d-flex">
                                <input type="checkbox" class="dt-checkboxesbox form-check-input">
                                <div>
                                    <span>{{ $customer->name }}</span><br>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center customertext">
                                    {{ $customer->email }}
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center customertext">
                                    {{ $customer->status }}
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center customertext">
                                    {{ $customer->orders->count() }}
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center customertext">
                                    {{ $customer->estimate_date }}
                                </div>
                            </td>
                            <td>
                                <div class="d-inline-block">
                                    <a href="{{ route('customers.show', ['customer' => $customer->id]) }}" class="btn-sm btn-text-secondary rounded-pill btn-icon">
                                        <i class="ti ti-eye"></i> View
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</div>
<!--/ Projects table -->
</div>
</div>
</div>

  <script src="https://booking.oreva.com.au/js/app.js" defer=""></script>

</body>

</html>