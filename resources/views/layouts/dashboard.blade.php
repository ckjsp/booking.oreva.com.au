@extends('layouts.app')

  <div id="app" class="layout-wrapper">
  @include('include.sidebar')

<!-- Including the sidebar partial -->

      <div class="content-wrapper">
          <nav class="navbar navbar-expand-lg navbar-light">
  <div class="container-fluid px-0">
   
      <p class="dashboard_text f-600 text-black">Dashboard</p>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse " id="navbarNav">
          <ul class="navbar-nav ms-auto align-items-center gap-2">
          <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1.5"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-menu-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 6l16 0" /><path d="M4 12l16 0" /><path d="M4 18l16 0" /></svg>
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
<div class="container px-0">
    

<div class="row g-3">
  <!-- section 1 start -->
  <div class="col-12 col-sm-6  col-lg-3">
  <a href="{{ route('customers.index') }}" class="menu-link d-block">

    <div class="dashboard-card card ">
          
            <div class="d-flex justify-content-between mb-2"> 
            <h5 class=" mb-0 fs-5">{{ $customerCount }}</h5> 
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users-group">
  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
  <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
  <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />
  <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
  <path d="M17 10h2a2 2 0 0 1 2 2v1" />
  <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
  <path d="M3 13v-1a2 2 0 0 1 2 -2h2" />
</svg>            </div>
            <p class="text-secondary">Customers</p>
          
    </div>
</a>
  </div>

  <div class="col-12 col-sm-6  col-lg-3">
  <a href="{{ route('showproduct') }}" class="menu-link d-block">

    <div class="dashboard-card card ">
         
            <div class="d-flex justify-content-between mb-2">
            <h5 class=" mb-0 fs-4">{{ $productCount }}</h5> 
            <svg  xmlns="http://www.w3.org/2000/svg"  width="32"  height="32"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1.5"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-report"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h5.697" /><path d="M18 14v4h4" /><path d="M18 11v-4a2 2 0 0 0 -2 -2h-2" /><path d="M8 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M8 11h4" /><path d="M8 15h3" /></svg>                      </div>
            <p class="text-secondary">Projects</p>
         
    </div>
    </a>

  </div>

  <div class="col-12 col-sm-6  col-lg-3">
    <div class="dashboard-card card  ">
          
            <div class="d-flex justify-content-between mb-2">
              <h5 class=" mb-0 fs-4">{{$orderCount}}</h5>
              <svg  xmlns="http://www.w3.org/2000/svg"  width="32"  height="32"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1.5"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-invoice"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M19 12v7a1.78 1.78 0 0 1 -3.1 1.4a1.65 1.65 0 0 0 -2.6 0a1.65 1.65 0 0 1 -2.6 0a1.65 1.65 0 0 0 -2.6 0a1.78 1.78 0 0 1 -3.1 -1.4v-14a2 2 0 0 1 2 -2h7l5 5v4.25" /></svg>              </div>
            <p class="text-secondary">Order</p>
    
    </div>
  </div>

  
  <div class="col-12 col-sm-6  col-lg-3">
  <div class="dashboard-card card  ">
          
          <div class="d-flex justify-content-between mb-2">
            <h5 class=" mb-0 fs-4">{{$orderCount}}</h5>
            <svg  xmlns="http://www.w3.org/2000/svg"  width="32"  height="32"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1.5"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-moneybag"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9.5 3h5a1.5 1.5 0 0 1 1.5 1.5a3.5 3.5 0 0 1 -3.5 3.5h-1a3.5 3.5 0 0 1 -3.5 -3.5a1.5 1.5 0 0 1 1.5 -1.5z" /><path d="M4 17v-1a8 8 0 1 1 16 0v1a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z" /></svg>            </div>
          <p class="text-secondary">Sales</p>
  
  </div>
  </div>

  <!-- section 1 end -->

  <!-- section 2 start -->
   
  <div class="col-xl-7  col-12">
      <!-- Payment Tabs -->
   <div class="card-box">
   <ul class="nav nav-tabs dashboard-tabs  flex-nowrap mb-3" id="paymentTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button
                            class="nav-link active"
                            id="customer-tab"
                            data-bs-toggle="pill"
                            data-bs-target="#nav-customer"
                            type="button"
                            role="tab"
                            aria-controls="nav-customer"
                            aria-selected="true">
                            Customer
                          </button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button
                            class="nav-link"
                            id="product-tab"
                            data-bs-toggle="pill"
                            data-bs-target="#nav-product"
                            type="button"
                            role="tab"
                            aria-controls="nav-product"
                            aria-selected="false">
                            Product
                          </button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button
                            class="nav-link"
                            id="other-tab"
                            data-bs-toggle="pill"
                            data-bs-target="#nav-other"
                            type="button"
                            role="tab"
                            aria-controls="nav-other"
                            aria-selected="false">
                            Order
                          </button>
                        </li>
                      </ul>
                      <div class="tab-content px-0" id="paymentTabsContent">
                    
                        <div
                          class="tab-pane fade show active"
                          id="nav-customer"
                          role="tabpanel"
                          aria-labelledby="customer-tab">
                       <h4>tab 1</h4>
                        </div>

                       
                        <div class="tab-pane fade" id="nav-product" role="tabpanel" aria-labelledby="product-tab">
                         <h3>tab 2</h3>
                        </div>

                      
                        <div
                          class="tab-pane fade"
                          id="nav-other"
                          role="tabpanel"
                          aria-labelledby="other-tab">
                          <h6>Enter Gift Card Details</h6>
                        
                        </div>
                      </div>
   </div>
                    
                
  </div>
  <div class="col-xl-5 col-12">
    <div class=" card-box " >
        <div class="px-3 py-3 d-flex align-items-center justify-content-between">
   
        <h6 class="mb-0 small f-600">Recent Order</h5>
          
         
                <a href="{{ route('showproduct') }}" class=" route-link f-600 link-color ">See All</a>
            
        </div>
      <div class="d-flex flex-column mx-3 gap-3" >
<div class="recent-card">
120
</div>
      </div>
</table>

    </div>
</div>
<div class="col-12">
        <div class="card-box  ">
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

  <!-- section 2 end -->

   


</div>
<!--/ Projects table -->
</div>
</div>
</div>
</div>

  <script src="https://booking.oreva.com.au/js/app.js" defer=""></script>

</body>

</html>