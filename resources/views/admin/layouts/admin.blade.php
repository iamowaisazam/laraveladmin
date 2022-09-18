<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@yield('title')</title>
    
        <meta name="csrf-token" content="{{csrf_token()}}">
        <meta name="path" content="{{env('APP_URL')}}">

        <link rel="icon" href="#" type="image/x-icon">
        <link href="{{asset('admin/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin/assets/css/theme.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin/plugins/toast/toast.css')}}" rel="stylesheet" type="text/css" />
        
        <style>
        
            #sidebar-menu ul li a i {
                    color: black;
            }
                
            #sidebar-menu ul li a {
                        display: block;
                        padding: 0.65rem 1.5 rem;
                        color: #012;
                        position: relative;
                        font-size: 14.5px;
                        -webkit-transition: all .4s;
                        transition: all .4s;
                        font-family:revert;
                  }
                       
            #sidebar-menu .active {
                        background: #3281f238;
            }
                  
            .page-title-box{
                 padding: 17px 14px;
                 background: white;
                 margin-bottom: 12px;    
            }
                  
            .small-nav .vertical-menu ul li > a > span{
                display:none;
            }
            
            .small-nav .vertical-menu ul li > ul{
                display:none!important;
            }
            
            .small-nav .vertical-menu ul li > a::after{
                display:none !important;
            }
            
            .small-nav .vertical-menu {
                width: 74px;
            }
            
            .small-nav .main-content{
               margin-left: 64px;
            }
            
            
            /* width */
            ::-webkit-scrollbar {
              width: 10px;
            }
            
            /* Track */
            ::-webkit-scrollbar-track {
              background: #f1f1f1; 
            }
             
            /* Handle */
            ::-webkit-scrollbar-thumb {
              background: #888; 
            }
            
            /* Handle on hover */
            ::-webkit-scrollbar-thumb:hover {
              background: #555; 
            }
            
            .vertical-menu{
                position: absolute;
                top: 70px;
                display: none;
            }

            .main-content{
                width: 100%;
                margin: 0px;
            }

            .vertical-menu-open .vertical-menu{
             display: block;   
             position: absolute;
            }

            .vertical-menu-open .main-content{
                /* width: calc(100% - 250px); */
                width: 100%;
                margin: 0px;
                /* margin-left: 250px; */
            }

            .footer {
                left:0px;
            }
            
            .select2-selection{
                border-radius: 0px!important;
                height: 34px!important;
                padding-top: 3px!important;
                border: 1px solid #ced4da!important;
            }

            .footer{
                background: #3281f2;
                color: white;
            }

        </style>
        @yield('css')
    </head>
<body>

   <!-- Begin page -->
   <div class="small-na" id="layout-wrapper">
        <header id="page-topbar">
            <div class="navbar-header">
               <div class="navbar-brand-box d-flex align-items-left">
                    <a href="#" class="logo"><span style="color: white;font-size: 31px;">ERPS</span></a>
                    <button type="button" class="menu-button btn header-item"><i class="fa fa-fw fa-bars"></i></button>
                </div>
                <div class="d-flex align-items-center">
                  <div class="dropdown d-inline-block ml-2">
                        <button type="button" class="menu-button btn header-item"><i class="fa fa-fw fa-bars"></i></button>
                    </div>
                </div>
            </div>
        </header>

               <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">
                <div  class="h-100">
                    <div id="sidebar-menu">
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li><a href="{{route('admin.dashboard')}}" class="waves-effect"><i class="mdi mdi-view-dashboard"></i><span>Dashboard</span></a></li>

                            <li><a href="{{route('admin.users.index')}}" class="waves-effect {{(request()->segment(2) == 'users') ? 'active mm-active' : '' }} "><i class="mdi mdi-view-dashboard"></i><span>Users</span></a></li>

                            <li class="{{(request()->segment(2) == 'categories') ? 'active mm-active' : '' }}" >
                               <a href="" class="waves-effect"><i class="fas fa-list"></i><span>Categories</span></a>
                            </li> 
                            
                            <li class="{{(request()->segment(2) == 'subcategories') ? 'active mm-active' : '' }}" >
                              <a href="" class="waves-effect"><i class="fas fa-stream"></i><span>SubCategories</span></a>
                           </li> 
      
                            <li class="{{(request()->segment(2) == 'products') ? 'active mm-active' : '' }}" >
                              <a href="" class="waves-effect"><i class="fab fa-product-hunt"></i><span>Products</span></a>
                           </li> 

                           <li class="{{(request()->segment(2) == 'purchase-orders') ? 'active' : '' }} {{(request()->segment(2) == 'purchase-receipts') ? 'active' : '' }}  menu-drop-down" >
                            <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="true">
                                <i class="fas fa-shopping-cart"></i><span>Purchases </span></a>
                                <ul class="sub-menu mm-collapse {{(request()->segment(2) == 'purchase-orders') ? 'd-block' : '' }} {{(request()->segment(2) == 'purchase-receipts') ? 'd-block' : '' }} ">
                                    <li class="{{(request()->segment(2) == 'purchase-orders') ? 'active mm-active' : '' }}" ><a href="#"><i class="fa fa-circle"></i>Purchase Order</a></li>

                                    <li class="{{(request()->segment(2) == 'purchase-receipts') ? 'active mm-active' : '' }}" ><a href="#"><i class="fa fa-circle"></i> Good Receipts </a></li>
                                    
                                </ul>
                           </li>
                           
                           <li class="{{(request()->segment(2) == 'orders') ? 'active mm-active' : '' }}" >
                            <a href="#" class="waves-effect"><i class="fas fa-people-carry"></i><span>Shopify</span></a>
                           </li> 
                           
                           <li class="{{(request()->segment(2) == 'vendors') ? 'active mm-active' : '' }}" >
                            <a href="#" class="waves-effect"><i class="fas fa-people-carry"></i><span>Vendors</span></a>
                           </li> 
                           
                            <li class="" >
                               <a href="{{route('admin.logout')}}" class="waves-effect"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
                            </li>
                            
                        
                              
                              {{-- <li class="{{(request()->segment(2) == 'customers') ? 'active mm-active' : '' }}" >
                                  <a href="{{route('admin.customers.index')}}" class="waves-effect"><i class="fas fa-users"></i><span>Customers</span></a>
                              </li>
      
                              <li class="{{(request()->segment(2) == 'lots-fresh') ? 'active' : '' }} {{(request()->segment(2) == 'lots-reprocess') ? 'active' : '' }} {{(request()->segment(2) == 'lots-status') ? 'active' : '' }} menu-drop-down " >
                                  <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="true">
                                       <i class="fas fa-box"></i><span>Lot Receiving </span></a>
                                  <ul class="sub-menu mm-collapse" style="">
                                      
                                      <li class="{{(request()->segment(2) == 'lots-process') ? 'active mm-active' : '' }}" ><a href="{{route('admin.lot-process.index')}}"><i class="fa fa-circle"></i> Process</a></li>
                                      <li class="{{(request()->segment(2) == 'lots-fresh') ? 'active mm-active' : '' }}" ><a href="{{route('admin.lots-fresh.index')}}"><i class="fa fa-circle"></i> Fresh</a></li>
                                      <li class="{{(request()->segment(2) == 'lots-reprocess') ? 'active mm-active' : '' }}" ><a href="{{route('admin.lots-reprocess.index')}}"><i class="fa fa-circle"></i> Reprocess</a></li>
                                      <li class="{{(request()->segment(2) == 'lots-coasting') ? 'active mm-active' : '' }}" ><a href="{{route('admin.lots-coasting.index')}}"><i class="fa fa-circle"></i>Coasting </a></li>
                                      <li class="{{(request()->segment(2) == 'lot-status') ? 'active mm-active' : '' }}" ><a href="{{route('admin.lots-status')}}"><i class="fa fa-circle"></i> Lot Status</a></li>
                                      <li class="{{(request()->segment(2) == 'delivery-challans') ? 'active mm-active' : '' }}" ><a href="{{route('admin.delivery-challans.index')}}"><i class="fa fa-circle"></i> Delivery Challans</a></li>
                                      <li class="{{(request()->segment(2) == 'sale-bills') ? 'active mm-active' : '' }}" ><a href="{{route('admin.sale-bills.customers')}}"><i class="fa fa-circle"></i> Sale Bills</a></li>
                                      <li class="{{(request()->segment(2) == 'sale-invoices') ? 'active mm-active' : '' }}" ><a href="{{route('admin.sale-invoices.customers')}}"><i class="fa fa-circle"></i> Sale Invoices</a></li>
                                  </ul>
                              </li>
                            
                              <li class="{{(request()->segment(2) == 'warehouses') ? 'active mm-active' : '' }}" >
                                  <a href="{{route('admin.warehouses.index')}}" class="waves-effect"><i class="fas fa-warehouse"></i><span>Warehouses</span></a>
                              </li>
                              
                              <li class="{{(request()->segment(2) == 'machines') ? 'active mm-active' : '' }}" >
                                  <a href="{{route('admin.machines.index')}}" class="waves-effect"><i class="far fa-hdd"></i><span>Machines</span></a>
                              </li>
                              
                              <li class="{{(request()->segment(2) == 'units') ? 'active mm-active' : '' }}" >
                                  <a href="{{route('admin.units.index')}}" class="waves-effect"><i class="fab fa-uniregistry"></i><span>Units</span></a>
                              </li>
                      
                              <li class="{{(request()->segment(2) == 'types') ? 'active mm-active' : '' }}" >
                                  <a href="{{route('admin.types.index')}}" class="waves-effect"><i class="fas fa-text-height"></i><span>Types</span></a>
                              </li>
                              
                              <li class="{{(request()->segment(2) == 'products') ? 'active mm-active' : '' }}" >
                                  <a href="{{route('admin.products.index')}}" class="waves-effect"><i class="fab fa-product-hunt"></i><span>Products</span></a>
                              </li>
                              
                              <li class="{{(request()->segment(2) == 'stock-adjustments') ? 'active mm-active' : '' }}" >
                                  <a href="{{route('admin.stock-adjustments.index')}}" class="waves-effect"><i class="fab fa-product-hunt"></i><span>Stock Adjustments</span></a>
                              </li>
      
                              <li class="{{(request()->segment(2) == 'vendors') ? 'active mm-active' : '' }}" >
                                  <a href="{{route('admin.vendors.index')}}" class="waves-effect"><i class="fas fa-people-carry"></i><span>Vendors</span></a>
                              </li>
                              
                              
                           
                              --}}
                          
                           
                              
                              {{-- <li class="{{(request()->segment(2) == 'accounts') ? 'active' : '' }} menu-drop-down " >
                                  <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="true">
                                    <i class="fas fa-box"></i><span>Accounts </span></a>
                                  <ul class="sub-menu mm-collapse" style="">
                                      <li class="{{(request()->segment(3) == 'manage') ? 'active mm-active' : '' }}" ><a href="{{route('admin.accounts.index')}}"><i class="fa fa-circle"></i>All Accounts</a></li>
                                      <li class="{{(request()->segment(3) == 'accounts-transfers') ? 'active mm-active' : '' }}" ><a href="{{route('admin.accounts_transfers.index')}}"><i class="fa fa-circle"></i>Transfers</a></li>
                                      <li class="{{(request()->segment(3) == 'accounts-vendorspayables') ? 'active mm-active' : '' }}" ><a href="{{route('admin.accounts_vendorspayables.index')}}"><i class="fa fa-circle"></i>Vendors Payables</a></li>
                                      <li class="{{(request()->segment(3) == 'accounts-customersreceivables') ? 'active mm-active' : '' }}" ><a href="{{route('admin.accounts_customersreceivables.index')}}"><i class="fa fa-circle"></i>Customer Receivable</a></li>
                                  </ul>
                              </li>
                              
                              <li class="{{(request()->segment(2) == 'expenses') ? 'active' : '' }} menu-drop-down " >
                                  <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="true">
                                    <i class="fas fa-box"></i><span>Expenses </span></a>
                                  <ul class="sub-menu mm-collapse">
                                      <li class="{{(request()->segment(3) == 'accounts') ? 'active mm-active' : '' }}" ><a href="{{route('admin.expenses_accounts.index')}}"><i class="fa fa-circle"></i>Accounts</a></li>
                                      <li class="{{(request()->segment(3) == 'payables') ? 'active mm-active' : '' }}" ><a href="{{route('admin.expenses_payables.index')}}"><i class="fa fa-circle"></i>Payables</a></li>
                                      <li class="{{(request()->segment(3) == 'receivables') ? 'active mm-active' : '' }}" ><a href="{{route('admin.expenses_receivables.index')}}"><i class="fa fa-circle"></i>Receivables</a></li>
                                  </ul>
                              </li>
                              
                              <li class="{{(request()->segment(2) == 'reports') ? 'active' : '' }} menu-drop-down" >
                                  <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="true">
                                       <i class="fas fa-file-invoice"></i><span>Reports</span></a>
                                  <ul class="sub-menu mm-collapse {{(request()->segment(2) == 'reports') ? 'mm-show' : '' }}"  >
                                      <li class="{{(request()->segment(3) == 'inventory') ? 'active mm-active' : '' }} " ><a href="{{route('admin.reports.type')}}"><i class="fa fa-circle"></i> Inventory</a></li>
                                      <li class="{{(request()->segment(3) == 'accounts-ledger') ? 'active mm-active' : '' }}" ><a href="{{route('admin.reports.accounts_ledger')}}"><i class="fa fa-circle"></i> Accounts Ledger</a></li>
                                      <li class="{{(request()->segment(3) == 'customers-ledger') ? 'active mm-active' : '' }}" ><a href="{{route('admin.reports.customers_ledger')}}"><i class="fa fa-circle"></i> Customers Ledger</a></li>
                                      <li class="{{(request()->segment(3) == 'vendors-ledger') ? 'active mm-active' : '' }}" ><a href="{{route('admin.reports.vendors_ledger')}}"><i class="fa fa-circle"></i> Vendors Ledger</a></li>
                                      <li class="{{(request()->segment(3) == 'expenses-ledger') ? 'active mm-active' : '' }}" ><a href="{{route('admin.reports.expenses_ledger')}}"><i class="fa fa-circle"></i> Expenses Ledger</a></li>
                                      <li class="{{(request()->segment(3) == 'due-payables') ? 'active mm-active' : '' }}" ><a href="{{route('admin.reports.due_payables')}}"><i class="fa fa-circle"></i>Due Payables</a></li>
                                      <li class="{{(request()->segment(3) == 'low-stocks') ? 'active mm-active' : '' }}" ><a href="{{route('admin.reports.low_stocks')}}"><i class="fa fa-circle"></i>Low stocks</a></li>
                                      <li class="{{(request()->segment(3) == 'customers-sales') ? 'active mm-active' : '' }}" ><a href="{{route('admin.reports.customers_sales')}}"><i class="fa fa-circle"></i>Customers Sales</a></li>
                                      <li class="{{(request()->segment(3) == 'vendors-purchases') ? 'active mm-active' : '' }}" ><a href="{{route('admin.reports.vendors_purchases')}}"><i class="fa fa-circle"></i>Vendors Purchases</a></li>
                                      <li class="{{(request()->segment(3) == 'products-consumptions') ? 'active mm-active' : '' }}" ><a href="{{route('admin.reports.products_consumptions')}}"><i class="fa fa-circle"></i>Consumptions</a></li>
                                  </ul>
                              </li>
      
                              <li class="{{(request()->segment(2) == 'settings') ? 'active mm-active' : '' }}" >
                                  <a href="{{route('admin.settings.index')}}" class="waves-effect  "><i class="fas fa-cogs"></i><span>Settings</span></a>
                              </li> --}} 
      
                  
                        </ul>
                    </div>
                </div>
                </div>


        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->          
                <div class="main-content">
                <div class="page-content">
                    @yield('content')
                </div>
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6"> 2019 © ERPS.</div>
                            <div class="col-sm-6">
                                <div class="text-sm-right d-none d-sm-block">Design & Develop by Kreatix Solutions</div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>       
      <!-- end main content-->


    </div>
    <!-- END layout-wrapper -->
          
    <!-- Overlay-->
    <div class="menu-overlay"></div>
 
          <!-- jQuery  -->
          <script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
          <script src="{{asset('admin/assets/js/bootstrap.bundle.min.js')}}"></script>
          <script src="{{asset('admin/assets/js/theme.js')}}"></script>
          <script src="{{asset('admin/plugins/toast/toast.js')}}"></script>
          <script>
                toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
        </script>           
      	@include('admin.components.notifications')
        <script>
                let navbar  = localStorage.getItem("vertical-menu-open");
                if(navbar){
                    document.getElementById("layout-wrapper").classList.add("vertical-menu-open");
                }else{
                    document.getElementById("layout-wrapper").classList.remove("vertical-menu-open");
                }
        </script>
        <script>
                $('.menu-button').click(function(){
                    if($('#layout-wrapper').hasClass("vertical-menu-open")){
                        $('#layout-wrapper').removeClass("vertical-menu-open");
                        localStorage.removeItem("vertical-menu-open",true);
                    }else{
                        $('#layout-wrapper').addClass("vertical-menu-open");
                        localStorage.setItem("vertical-menu-open",true);
                    }
                });

                $('.menu-drop-down').click(function(){     
                    let submenu = $(this).find('.sub-menu');
                    if(submenu.hasClass("d-block")){
                        submenu.removeClass("d-block");
                    }else{
                        submenu.addClass("d-block");
                    }
                });
        </script>
        @yield('js')
    </body>
</html>