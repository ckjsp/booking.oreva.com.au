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
    /* .space
    {
      border-collapse: separate;
      border-spacing: 0 15px;
      padding: 10px;
    } */
  



 
</style>
</head>


<body>

  <div id="app" class="layout-wrapper">
      <aside class="sidebar">
  <div class="app-brand demo">
      <a href="https://booking.oreva.com.au/home" class="app-brand-link">
      <img src="{{ asset('img/dashboardlogo.svg') }}" alt="Logo" class="pd">
      <!-- <img src="https://booking.oreva.com.au/img/logo.svg" alt="Logo" class="w-100 full-logo"> -->
         </a>
  </div>
<hr class="text-secondary"/>
  <ul class="menu-inner align-items-center py-1">
      <!-- Dashboards -->
      <li class="menu-item">
          <a href="https://booking.oreva.com.au/home" class="menu-link">
              <!-- <i class="menu-icon tf-icons ti ti-smart-home"></i> -->
              <!-- <i class="menu-icon tf-icons ti ti-smart-home p-4" style="width: 24px !important; height: 24px !important; color: #ffffff;"></i> -->
             <img  src="{{ asset('img/dashboardhomeicon.png') }}" class="pd"/> 
              <!-- <div data-i18n="Dashboard">Dashboard</div> -->
          </a>
      </li>
      <!-- Users List -->
      <li class="menu-item ">
          <a href="https://booking.oreva.com.au/home" class="menu-link">
              <!-- <i class="menu-icon tf-icons ti ti-users"></i> -->
              <!-- <i class="menu-icon tf-icons ti ti-smart-home p-4" style="width: 24px !important; height: 24px !important; color: #ffffff;"></i> -->
               <img  src="{{ asset('img/Frame (10).png') }}"   class="pd"/>
              <!-- <div data-i18n="Users">Users</div> -->
          </a>
      </li>
      <!-- Add other menu items here -->
      <li class="menu-item ">
        <a href="https://booking.oreva.com.au/home" class="menu-link">
            <!-- <i class="menu-icon tf-icons ti ti-users"></i> -->
            <!-- <i class="menu-icon tf-icons ti ti-smart-home p-4" style="width: 24px !important; height: 24px !important; color: #ffffff;"></i> -->
            <img  src="{{ asset('img/Frame (11).png') }}"   class="pd"/>

            <!-- <div data-i18n="Users">Users</div> -->
        </a>
    </li>

    <li class="menu-item ">
      <a href="https://booking.oreva.com.au/home" class="menu-link">
          <!-- <i class="menu-icon tf-icons ti ti-users"></i> -->
          <!-- <i class="menu-icon tf-icons ti ti-smart-home p-4" style="width: 24px !important; height: 24px !important; color: #ffffff;"></i> -->
          <img  src="{{ asset('img/Frame (12).png') }}"   class="pd"/>

          <!-- <div data-i18n="Users">Users</div> -->
      </a>
  </li>

  <li class="menu-item ">
    <a href="https://booking.oreva.com.au/home" class="menu-link">
        <!-- <i class="menu-icon tf-icons ti ti-users"></i> -->
        <!-- <i class="menu-icon tf-icons ti ti-smart-home p-4" style="width: 24px !important; height: 24px !important; color: #ffffff;"></i> -->
        <img  src="{{ asset('img/Frame (13).png') }}"   class="pd"/>

        <!-- <div data-i18n="Users">Users</div> -->
    </a>
</li>

<li class="menu-item ">
  <a href="https://booking.oreva.com.au/home" class="menu-link">
      <!-- <i class="menu-icon tf-icons ti ti-users"></i> -->
      <!-- <i class="menu-icon tf-icons ti ti-settings p-4" style="width: 24px !important; height: 24px !important; color: #ffffff;"></i> -->
      <img  src="{{ asset('img/Frame (14).png') }}"   class="pd"/>

      <!-- <div data-i18n="Users">Users</div> -->
  </a>
</li>
  </ul>
</aside>
<!-- Including the sidebar partial -->
      <div class="content-wrapper">
          <nav class="navbar navbar-expand-lg navbar-light">
  <div class="container-fluid">
      <!-- <a class="navbar-brand" href="https://booking.oreva.com.au/home">
          <img src="https://booking.oreva.com.au/img/logo.svg" alt="Logo" class="d-inline-block align-text-top" width="30" height="30">
          Dashboard
      </a> -->
      <p class="dashboard_text fw-bolder text-black">Dashboard</p>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse " id="navbarNav">
          <ul class="navbar-nav ms-auto column-gap-3">
          <!-- <i class="menu-icon tf-icons ti ti-smart-home" style="width: 24px !important; height: 24px !important; color: #000000;"></i> -->
          <img  src="{{ asset('img/Frame (15).png') }}"   class="pd"/>

                  <span class="text-black">MENU</span>
              </li>
              <li class="nav-item">
                <div class="avatar avatar-sm"><img  src="{{ asset('img/10.png') }}" alt="Avatar"
                  class="rounded-circle pull-up"></div>
              </li>
          </ul>
      </div>
  </div>
</nav>
<!-- Including the header partial -->
          <!-- <main class="py-4">
              <div class="container">
  <h1>Welcome to the Dashboard</h1>
</div> -->
<div class="row g-2">
  <!-- section 1 start -->
  <div class="col-12 col-sm-6  col-lg-3">
    <div class="card rounded-0">
          <div class="card-body text-nowrap">
            <div class="d-flex justify-content-between">
              <h5 class="card-title mb-0 fs-5">54</h5>
              <!-- <i class="menu-icon tf-icons ti ti-users" style="width: 24px !important; height: 24px !important; color: #000000; margin-left: 80px;"></i> -->
               <img   src="{{ asset('img/Frame (16).png') }}">

             
            </div>
            <p class="mb-2">Customers</p>
          </div>
    </div>
  </div>

  
  

  <div class="col-12 col-sm-6  col-lg-3">
    <div class="card rounded-0">
          <div class="card-body text-nowrap">
            <div class="d-flex justify-content-between">
              <h5 class="card-title mb-0 fs-5">79</h5>
              <!-- <i class="menu-icon tf-icons ti ti-users" style="width: 24px !important; height: 24px !important; color: #000000; margin-left: 80px;"></i> -->
              <img   src="{{ asset('img/Frame (17).png') }}">
              </div>
            <p class="mb-2">Projects</p>
          </div>
    </div>
  </div>
  

  <div class="col-12 col-sm-6  col-lg-3">
    <div class="card rounded-0">
          <div class="card-body text-nowrap">
            <div class="d-flex justify-content-between">
              <h5 class="card-title mb-0 fs-5">101</h5>
              <!-- <i class="menu-icon tf-icons ti ti-users" style="width: 24px !important; height: 24px !important; color: #000000; margin-left: 80px;"></i> -->
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
              <h5 class="card-title mb-0 fs-5">54</h5>
              <!-- <i class="menu-icon tf-icons ti ti-users" style="width: 24px !important; height: 24px !important; color: #000000; margin-left: 80px;"></i> -->
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
    <div class="card rounded-0 mt-3" style=" height: 290px;">
      <div class="pd d-flex justify-content-between ">
        <div class="card-title mb-0">
          <h5 class="mb-1 fs-6">Recent Order</h5>
          
        </div>
        <div>
          <a href="#" class="fs-6 text-primary">See All</a>
        </div>
      </div>
      <table class="">
        <tr class="border">
          <td class="pt-2 pb-2">
            <img src="{{ asset('img/product(1).png') }}"/>
          </td>
          <td class="customertext">Lorem Ipsum<br/>2 minutes ago</td>
          <td class="customertext">$170.00</td>
        </tr>
       
        <tr class=" border">
          <td class="pt-2 pb-2">
          <img src="{{ asset('img/product(1).png') }}"/>
          </td>
          <td class="customertext ">Lorem Ipsum<br/>2 minutes ago</td>
          <td class="customertext">$170.00</td>
        </tr>

        <tr class=" border">
          <td class="pt-2 pb-2">
          <img src="{{ asset('img/product(1).png') }}"/>
          </td>
          <td class="customertext">Lorem Ipsum<br/>2 minutes ago</td>
          <td class="customertext">$170.00</td>
        </tr>

        <tr class="border">
          <td class="pt-2 pb-2">
          <img src="{{ asset('img/product(1).png') }}"/>
          </td>
          <td class="customertext">Lorem Ipsum<br/>2 minutes ago</td>
          <td class="customertext">$170.00</td>
        </tr>
      </table>
    </div>
  </div>  
       
  </div>
   
  <!-- section 2 end -->
   <div class="row mt-3">
    <div class="col-12">
      <!-- <h5 class="card-maintitle">Customer Listing</h5> -->
      <div class="card rounded-0">
        <div class="card-datatable table-responsive">
          <table class="datatables-projects table border-top">

            <thead class="">
              <tr>
                <th class="customerlist_text  text-black d-flex"><input type="checkbox"
                    class="dt-checkboxesbox  form-check-input">Customer</th>
                <!-- <th></th>
                  <th></th> -->
                <th class="customerlist_text text-black">Status</th>
                <th class="customerlist_text text-black">Qty</th>
                <th class="customerlist_text text-black">Ordered</th>
                <th class="w-px-50 customerlist_text text-black">Estimate</th>
                <th class="w-px-50 customerlist_text text-black">Product</th>
                

              </tr>
            </thead>
            <tbody>

              <tr class="odd">
                <!-- <td class=""style="display: none;"></td>
                  <td class=""><div class="d-flex align-items-center">  
                    <input type="checkbox" class="dt-checkboxes form-check-input">#001</div></td> -->
                <td class="customertext text-black d-flex"><input type="checkbox"
                  class="dt-checkboxesbox  form-check-input">
                    <!-- <td class="d-flex customertext  text-black"> -->
                      <div class="avatar avatar-sm"><img  src="{{ asset('img/10.png') }}"  alt="Avatar"
                          class="rounded-circle pull-up"></div>
                          <div>                 

                            <span>Jane Cooper</span><br/>
                            <span>jane@acme.com</span>
                          </div>
                          
                          
                    <!-- </td> -->
                   
        </div>

        </td>
        <td>
          <div class="d-flex align-items-center customertext">
            <div class="round_Dot"></div>Active
          </div>
        </td>
        <td>
          <div class="d-flex align-items-center customertext">1000</div>
        </td>
        <td>
          <div class="d-flex align-items-center customertext">Nov 14,2023</div>
        </td>
        <td>
          <div class="d-flex align-items-center customertext">Nov 17, 2023</div>
        </td>
        <td>
        <img  src="{{ asset('img/product(1).png') }}"/>
        
        <td>
          <div class="d-inline-block"><a href="javascript:;" class="btn-sm btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical ti-md"></i></a>
              <div class="dropdown-menu dropdown-menu-end m-0" style="">
                  <button type="button" class="btn p-0 edit-btn text-info dropdown-item" onclick="window.location.href='https://booking.oreva.com.au/customers/5/edit'">
                      <i class="ti ti-pencil me-1"></i> Edit </button>
                  <button type="button" class="btn p-0 view-btn text-info dropdown-item" onclick="window.location.href='https://booking.oreva.com.au/customers/5'">
                      <i class="ti ti-eye me-1"></i> View
                  </button>
                  <div class="dropdown-divider"></div>
                  <form action="https://booking.oreva.com.au/customers/5" method="POST">
                      <input type="hidden" name="_token" value="YN9tXAWgrgBd8uKtP7IUi9QtxwIHjlpifzqYlWx0" autocomplete="off">                                            <input type="hidden" name="_method" value="DELETE">                                            <button type="button" class="btn p-0 delete-btn text-danger dropdown-item" onclick="this.closest('form').submit();">
                          <i class="ti ti-trash me-1"></i>Delete
                      </button>
                  </form>
              </div>
          </div>
      </td>
        </td>
        </tr>

        <tr class="odd">
          <!-- <td class=""style="display: none;"></td>
            <td class=""><div class="d-flex align-items-center">  
              <input type="checkbox" class="dt-checkboxes form-check-input">#001</div></td> -->
          <td class="customertext text-black d-flex"><input type="checkbox"
              class="dt-checkboxesbox form-check-input ">
              <!-- <td class="d-flex customertext  text-black"> -->
                <div class="avatar avatar-sm"><img  src="{{ asset('img/10.png') }}" alt="Avatar"
                    class="rounded-circle pull-up"></div>
                    <div>
                      <span>Jane Cooper</span><br/>
                      <span>jane@acme.com</span>
                    </div>
                    
                    
              <!-- </td> -->
             
  </div>

  </td>
  <td>
    <div class="d-flex align-items-center customertext">
      <div class="round_Dot"></div>Active
    </div>
  </td>
  <td>
    <div class="d-flex align-items-center customertext">1000</div>
  </td>
  <td>
    <div class="d-flex align-items-center customertext">Nov 14,2023</div>
  </td>
  <td>
    <div class="d-flex align-items-center customertext">Nov 17, 2023</div>
  </td>
  <td>
  <img src="{{ asset('img/product(1).png') }}"/>
  <td>
    <div class="d-inline-block"><a href="javascript:;" class="btn-sm btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical ti-md"></i></a>
        <div class="dropdown-menu dropdown-menu-end m-0" style="">
            <button type="button" class="btn p-0 edit-btn text-info dropdown-item" onclick="window.location.href='https://booking.oreva.com.au/customers/5/edit'">
                <i class="ti ti-pencil me-1"></i> Edit </button>
            <button type="button" class="btn p-0 view-btn text-info dropdown-item" onclick="window.location.href='https://booking.oreva.com.au/customers/5'">
                <i class="ti ti-eye me-1"></i> View
            </button>
            <div class="dropdown-divider"></div>
            <form action="https://booking.oreva.com.au/customers/5" method="POST">
                <input type="hidden" name="_token" value="YN9tXAWgrgBd8uKtP7IUi9QtxwIHjlpifzqYlWx0" autocomplete="off">                                            <input type="hidden" name="_method" value="DELETE">                                            <button type="button" class="btn p-0 delete-btn text-danger dropdown-item" onclick="this.closest('form').submit();">
                    <i class="ti ti-trash me-1"></i>Delete
                </button>
            </form>
        </div>
    </div>
</td>
  </td>
  </tr>

  <tr class="odd">
    <!-- <td class=""style="display: none;"></td>
      <td class=""><div class="d-flex align-items-center">  
        <input type="checkbox" class="dt-checkboxes form-check-input">#001</div></td> -->
    <td class="customertext text-black d-flex"><input type="checkbox"
        class="dt-checkboxesbox form-check-input ">
        <!-- <td class="d-flex customertext  text-black"> -->
          <div class="avatar avatar-sm"><img src="{{ asset('img/product(1).png') }}" alt="Avatar"
              class="rounded-circle pull-up"></div>
              <div>
                <span>Jane Cooper</span><br/>
                <span class="">jane@acme.com</span>
              </div>
              
              
        <!-- </td> -->
       
</div>

</td>
<td>
<div class="d-flex align-items-center customertext">
<div class="round_Dot"></div>Active
</div>
</td>
<td>
<div class="d-flex align-items-center customertext">1000</div>
</td>
<td>
<div class="d-flex align-items-center customertext">Nov 14,2023</div>
</td>
<td>
<div class="d-flex align-items-center customertext">Nov 17, 2023</div>
</td>
<td>
<img src="{{ asset('img/product(1).png') }}"/>
<td>
<div class="d-inline-block"><a href="javascript:;" class="btn-sm btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical ti-md"></i></a>
  <div class="dropdown-menu dropdown-menu-end m-0" style="">
      <button type="button" class="btn p-0 edit-btn text-info dropdown-item" onclick="window.location.href='https://booking.oreva.com.au/customers/5/edit'">
          <i class="ti ti-pencil me-1"></i> Edit </button>
      <button type="button" class="btn p-0 view-btn text-info dropdown-item" onclick="window.location.href='https://booking.oreva.com.au/customers/5'">
          <i class="ti ti-eye me-1"></i> View
      </button>
      <div class="dropdown-divider"></div>
      <form action="https://booking.oreva.com.au/customers/5" method="POST">
          <input type="hidden" name="_token" value="YN9tXAWgrgBd8uKtP7IUi9QtxwIHjlpifzqYlWx0" autocomplete="off">                                            <input type="hidden" name="_method" value="DELETE">                                            <button type="button" class="btn p-0 delete-btn text-danger dropdown-item" onclick="this.closest('form').submit();">
              <i class="ti ti-trash me-1"></i>Delete
          </button>
      </form>
  </div>
</div>
</td>
</td>
</tr>

<tr class="odd">
  <!-- <td class=""style="display: none;"></td>
    <td class=""><div class="d-flex align-items-center">  
      <input type="checkbox" class="dt-checkboxes form-check-input">#001</div></td> -->
  <td class="customertext text-black d-flex"><input type="checkbox"
      class="dt-checkboxesbox form-check-input ">
      <!-- <td class="d-flex customertext  text-black"> -->
        <div class="avatar avatar-sm"><img src="{{ asset('img/product(1).png') }}" alt="Avatar"
            class="rounded-circle pull-up"></div>
            <div>
              <span>Jane Cooper</span><br/>
              <span>jane@acme.com</span>
            </div>
            
            
      <!-- </td> -->
     
</div>

</td>
<td>
<div class="d-flex align-items-center customertext">
<div class="round_Dot"></div>Active
</div>
</td>
<td>
<div class="d-flex align-items-center customertext">1000</div>
</td>
<td>
<div class="d-flex align-items-center customertext">Nov 14,2023</div>
</td>
<td>
<div class="d-flex align-items-center customertext">Nov 17, 2023</div>
</td>
<td>
<img src="{{ asset('img/product(1).png') }}"/>
<td>
<div class="d-inline-block"><a href="javascript:;" class="btn-sm btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical ti-md"></i></a>
<div class="dropdown-menu dropdown-menu-end m-0" style="">
    <button type="button" class="btn p-0 edit-btn text-info dropdown-item" onclick="window.location.href='https://booking.oreva.com.au/customers/5/edit'">
        <i class="ti ti-pencil me-1"></i> Edit </button>
    <button type="button" class="btn p-0 view-btn text-info dropdown-item" onclick="window.location.href='https://booking.oreva.com.au/customers/5'">
        <i class="ti ti-eye me-1"></i> View
    </button>
    <div class="dropdown-divider"></div>
    <form action="https://booking.oreva.com.au/customers/5" method="POST">
        <input type="hidden" name="_token" value="YN9tXAWgrgBd8uKtP7IUi9QtxwIHjlpifzqYlWx0" autocomplete="off">                                            <input type="hidden" name="_method" value="DELETE">                                            <button type="button" class="btn p-0 delete-btn text-danger dropdown-item" onclick="this.closest('form').submit();">
            <i class="ti ti-trash me-1"></i>Delete
        </button>
    </form>
</div>
</div>
</td>
</td>
</tr>

<tr class="odd">
  <!-- <td class=""style="display: none;"></td>
    <td class=""><div class="d-flex align-items-center">  
      <input type="checkbox" class="dt-checkboxes form-check-input">#001</div></td> -->
  <td class="customertext text-black d-flex"><input type="checkbox"
      class="dt-checkboxesbox form-check-input ">
      <!-- <td class="d-flex customertext  text-black"> -->
        <div class="avatar avatar-sm"><img src="{{ asset('img/10.png') }}g" alt="Avatar"
            class="rounded-circle pull-up"></div>
            <div>
              <span>Jane Cooper</span><br/>
              <span>jane@acme.com</span>
            </div>
            
            
      <!-- </td> -->
     
</div>

</td>
<td>
<div class="d-flex align-items-center customertext">
<div class="round_Dot"></div>Active
</div>
</td>
<td>
<div class="d-flex align-items-center customertext">1000</div>
</td>
<td>
<div class="d-flex align-items-center customertext">Nov 14,2023</div>
</td>
<td>
<div class="d-flex align-items-center customertext">Nov 17, 2023</div>
</td>
<td>
<img src="{{ asset('img/product(1).png') }}"/>
<td>
<div class="d-inline-block"><a href="javascript:;" class="btn-sm btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical ti-md"></i></a>
<div class="dropdown-menu dropdown-menu-end m-0" style="">
    <button type="button" class="btn p-0 edit-btn text-info dropdown-item" onclick="window.location.href='https://booking.oreva.com.au/customers/5/edit'">
        <i class="ti ti-pencil me-1"></i> Edit </button>
    <button type="button" class="btn p-0 view-btn text-info dropdown-item" onclick="window.location.href='https://booking.oreva.com.au/customers/5'">
        <i class="ti ti-eye me-1"></i> View
    </button>
    <div class="dropdown-divider"></div>
    <form action="https://booking.oreva.com.au/customers/5" method="POST">
        <input type="hidden" name="_token" value="YN9tXAWgrgBd8uKtP7IUi9QtxwIHjlpifzqYlWx0" autocomplete="off">                                            <input type="hidden" name="_method" value="DELETE">                                            <button type="button" class="btn p-0 delete-btn text-danger dropdown-item" onclick="this.closest('form').submit();">
            <i class="ti ti-trash me-1"></i>Delete
        </button>
    </form>
</div>
</div>
</td>
</td>
</tr>



</tbody>

</table>
</div>
</div>
</div>
<!--/ Projects table -->
</div>
</div>

    
   </div>

  <!-- section 3 start -->
          
  <!-- section 3 end -->

  <!-- Scripts -->

  <script src="https://booking.oreva.com.au/js/app.js" defer=""></script>

</body>

</html>