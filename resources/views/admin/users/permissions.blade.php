@extends('admin.layouts.admin')
@section('title','All Permissions')

@section('css')
    <!-- data tables -->

 
@endsection

@section('content')

     <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
          <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
              <div class="d-flex align-items-center flex-wrap mr-2">
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                  <li class="breadcrumb-item">
                    <a href="{{route('admin.home')}}" class="text-muted">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item active">
                    <a href="{{route('admin.users.index')}}" class="text-muted">Permissions</a>
                  </li>
                </ul>
              </div>
              <div class="d-flex align-items-center">
                <button onclick="update_form()" class="btn btn-success">Update</button>
              </div>
            </div>
          </div>
            
          <div class="d-flex flex-column-fluid">
            <div class="container">
              <div class="card card-custom">
                <div class="card-body">
            

               <form  class="permission_form" action="{{route('admin.users.addpermission',$user->id)}}" method="post" > 
                 @csrf
                 
                <div class="row">
                <div class="col-md-12">
                 <div class="row">
                    <div class="col-md-6">
                        <h4> <strong>Edit</strong>  Permissions</h4>
                     </div>
                     <div class="col-md-6 align-self-center">
                        @can('roles.manage_permissions','none')
                        <div class="text-right py-2">
                            <button type="submit" class="btn btn-info text-right">Update</button>
                        </div>
                        @endcan
                     </div>
                 </div>
                        <div class="row">
                                <div class="py-3 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="card card-custom" data-card="true" id="users_permissions">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h3 class="card-label">Users & Roles Permissions</h3>
                                            </div>
                                            <div class="card-toolbar">
                                                <a href="#" class="btn btn-icon btn-sm btn-hover-light-primary mr-1" data-card-tool="toggle" data-toggle="tooltip" data-placement="top" ><i class="ki ki-arrow-down icon-nm"></i></a>  
                                            </div>
                                        </div>
                                        <div class="p-0 card-body">
                                            <ul class="list-group list-group-unbordered">
                                                
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <label class="col-10 col-form-label">Access Admin Panel</label>
                                                        <div class="col-2 text-right ">
                                                            <span class="switch">
                                                                <label class="ml-auto" >
                                                                    <input name="access_admin_panel" value="access_admin_panel" @if(in_array('access_admin_panel',$rp)){{'checked'}} @endif type="checkbox"  /> 
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </li>
                                                
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <label class="col-10 col-form-label">Access Users & Roles Panel</label>
                                                        <div class="col-2 text-right ">
                                                            <span class="switch">
                                                                <label class="ml-auto" >
                                                                <input name="users.access" value="users.access" @if(in_array('users.access',$rp)){{'checked'}} @endif type="checkbox"  /> 
                                                                <span></span>
                                                                </label>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </li>
                        
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <label class="col-10 col-form-label">View All Users</label>
                                                        <div class="col-2 text-right ">
                                                            <span class="switch">
                                                                <label class="ml-auto" >
                                                                <input name="users.view_all" value="users.view_all" @if(in_array('users.view_all',$rp)){{'checked'}} @endif type="checkbox"  /> 
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </li>
                        
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <label class="col-10 col-form-label">Edit Users</label>
                                                        <div class="col-2 text-right ">
                                                            <span class="switch">
                                                                <label class="ml-auto" >
                                                                <input name="users.edit" value="users.edit" @if(in_array('users.edit',$rp)){{'checked'}} @endif type="checkbox"  /> 
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </li>
                        
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <label class="col-10 col-form-label">Delete Users</label>
                                                        <div class="col-2 text-right ">
                                                            <span class="switch">
                                                                <label class="ml-auto" >
                                                                <input name="users.delete" value="users.delete" @if(in_array('users.delete',$rp)){{'checked'}} @endif type="checkbox"  /> 
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </li>
                        
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <label class="col-10 col-form-label">Create User</label>
                                                        <div class="col-2 text-right ">
                                                            <span class="switch">
                                                                <label class="ml-auto" >
                                                                <input name="users.create" value="users.create" @if(in_array('users.create',$rp)){{'checked'}} @endif type="checkbox"  /> 
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </li>
                                                
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <label class="col-10 col-form-label">Manage Roles</label>
                                                        <div class="col-2 text-right ">
                                                            <span class="switch">
                                                                <label class="ml-auto" >
                                                                <input name="users.roles" value="users.roles" @if(in_array('users.roles',$rp)){{'checked'}} @endif type="checkbox"  /> 
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </li>
                        
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <label class="col-10 col-form-label">Manage Permissions</label>
                                                        <div class="col-2 text-right ">
                                                            <span class="switch">
                                                                <label class="ml-auto" >
                                                                <input name="users.permissions" value="users.permissions" @if(in_array('users.permissions',$rp)){{'checked'}} @endif type="checkbox"  /> 
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </li>
                        
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <label class="col-10 col-form-label">Dashboard Access</label>
                                                        <div class="col-2 text-right ">
                                                            <span class="switch">
                                                                <label class="ml-auto" >
                                                                <input name="users.dashboard" value="users.dashboard" @if(in_array('users.dashboard',$rp)){{'checked'}} @endif type="checkbox"  /> 
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </li>
                                          </ul>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="py-3 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card card-custom" data-card="true" id="modules_permissions">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h3 class="card-label">Inventories Permissions</h3>
                                        </div>
                                        <div class="card-toolbar">
                                            <a href="#" class="btn btn-icon btn-sm btn-hover-light-primary mr-1" data-card-tool="toggle" data-toggle="tooltip" data-placement="top" >
                                                <i class="ki ki-arrow-down icon-nm"></i>
                                            </a>  
                                        </div>
                                    </div>
                                    <div class="p-0 card-body">
                                        <ul class="list-group list-group-unbordered">
                                            
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <label class="col-10 col-form-label">Access Inventories </label>
                                                    <div class="col-2 text-right ">
                                                        <span class="switch">
                                                            <label class="ml-auto" >
                                                            <input name="{{'inventories.access'}}" value="{{'inventories.access'}}" @if(in_array('inventories.access',$rp)){{'checked'}} @endif type="checkbox"  /> <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>
                                            
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <label class="col-10 col-form-label">Manage Suppliers </label>
                                                    <div class="col-2 text-right ">
                                                        <span class="switch">
                                                            <label class="ml-auto" >
                                                            <input name="{{'suppliers.access'}}" value="{{'suppliers.access'}}" @if(in_array('suppliers.access',$rp)){{'checked'}} @endif type="checkbox"  /> <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>
                                            
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <label class="col-10 col-form-label">Manage Stocks </label>
                                                    <div class="col-2 text-right ">
                                                        <span class="switch">
                                                            <label class="ml-auto" >
                                                            <input name="{{'stocks.access'}}" value="{{'stocks.access'}}" @if(in_array('stocks.access',$rp)){{'checked'}} @endif type="checkbox"  /> <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>
                                            
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <label class="col-10 col-form-label">Manage Items </label>
                                                    <div class="col-2 text-right ">
                                                        <span class="switch">
                                                            <label class="ml-auto" >
                                                            <input name="{{'items.access'}}" value="{{'items.access'}}" @if(in_array('items.access',$rp)){{'checked'}} @endif type="checkbox"  /> <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>
                                            
                                            
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <label class="col-10 col-form-label">Manage Newsletters </label>
                                                    <div class="col-2 text-right ">
                                                        <span class="switch">
                                                            <label class="ml-auto" >
                                                            <input name="{{'newsletters.access'}}" value="{{'newsletters.access'}}" @if(in_array('newsletters.access',$rp)){{'checked'}} @endif type="checkbox"  /> <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>
                                            
                                            
    
                                          </ul>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="py-3 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card card-custom" data-card="true" id="modules_permissions">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h3 class="card-label">Sales Permissions</h3>
                                        </div>
                                        <div class="card-toolbar">
                                            <a href="#" class="btn btn-icon btn-sm btn-hover-light-primary mr-1" data-card-tool="toggle" data-toggle="tooltip" data-placement="top" >
                                                <i class="ki ki-arrow-down icon-nm"></i>
                                            </a>  
                                        </div>
                                    </div>
                                    <div class="p-0 card-body">
                                        <ul class="list-group list-group-unbordered">
                                            
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <label class="col-10 col-form-label"> Access Sales </label>
                                                    <div class="col-2 text-right ">
                                                        <span class="switch">
                                                            <label class="ml-auto" >
                                                              <input name="{{'sales.manage'}}" value="{{'sales.manage'}}" @if(in_array('sales.manage',$rp)){{'checked'}} @endif type="checkbox"  /> <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>
                                            
                                            
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <label class="col-10 col-form-label"> Manage Customers </label>
                                                    <div class="col-2 text-right ">
                                                        <span class="switch">
                                                            <label class="ml-auto" >
                                                              <input name="{{'customers.access'}}" value="{{'customers.access'}}" @if(in_array('customers.access',$rp)){{'checked'}} @endif type="checkbox"  /> <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>
                                            
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <label class="col-10 col-form-label"> Manage Orders </label>
                                                    <div class="col-2 text-right ">
                                                        <span class="switch">
                                                            <label class="ml-auto" >
                                                              <input name="{{'orders.access'}}" value="{{'orders.access'}}" @if(in_array('orders.access',$rp)){{'checked'}} @endif type="checkbox"  /> <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>
                                            
                                             <li class="list-group-item">
                                                <div class="row">
                                                    <label class="col-10 col-form-label"> Manage Payments </label>
                                                    <div class="col-2 text-right ">
                                                        <span class="switch">
                                                            <label class="ml-auto" >
                                                              <input name="{{'payments.access'}}" value="{{'payments.access'}}" @if(in_array('payments.access',$rp)){{'checked'}} @endif type="checkbox"  /> <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>
                                            
                                            <li class="list-group-item">
                                                <div class="row">
                                                        <label class="col-10 col-form-label">Manage Expenses </label>
                                                        <div class="col-2 text-right ">
                                                            <span class="switch">
                                                                <label class="ml-auto" >
                                                                <input name="{{'expenses.access'}}" value="{{'expenses.access'}}" @if(in_array('expenses.access',$rp)){{'checked'}} @endif type="checkbox"  /> <span></span>
                                                                </label>
                                                            </span>
                                                        </div>
                                                </div>
                                            </li>
                                            
                                            
                                            
                                            
                                            <li class="d-none list-group-item">
                                                <div class="row">
                                                        <label class="col-10 col-form-label">Manage Accounts </label>
                                                        <div class="col-2 text-right ">
                                                            <span class="switch">
                                                                <label class="ml-auto" >
                                                                <input name="{{'accounts.manage'}}" value="{{'accounts.manage'}}" @if(in_array('accounts.manage',$rp)){{'checked'}} @endif type="checkbox"  /> <span></span>
                                                                </label>
                                                            </span>
                                                        </div>
                                                </div>
                                            </li>
                                            
                                             <li class="list-group-item">
                                                <div class="row">
                                                        <label class="col-10 col-form-label">Manage Reports </label>
                                                        <div class="col-2 text-right ">
                                                            <span class="switch">
                                                                <label class="ml-auto" >
                                                                <input name="{{'reports.access'}}" value="{{'reports.access'}}" @if(in_array('reports.access',$rp)){{'checked'}} @endif type="checkbox"  /> <span></span>
                                                                </label>
                                                            </span>
                                                        </div>
                                                </div>
                                            </li>
                                            
                                          </ul>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                        
                                  <div class="py-3 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="card card-custom" data-card="true" id="modules_permissions">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h3 class="card-label">Settings Permissions</h3>
                                            </div>
                                            <div class="card-toolbar">
                                                <a href="#" class="btn btn-icon btn-sm btn-hover-light-primary mr-1" data-card-tool="toggle" data-toggle="tooltip" data-placement="top" >
                                                    <i class="ki ki-arrow-down icon-nm"></i>
                                                </a>  
                                            </div>
                                        </div>
                                                <div class="p-0 card-body">
                                                    <ul class="list-group list-group-unbordered">
                                                        
                                                        <li class="list-group-item">
                                                            <div class="row">
                                                                    <label class="col-10 col-form-label">Access Settings Panel</label>
                                                                    <div class="col-2 text-right ">
                                                                        <span class="switch">
                                                                            <label class="ml-auto" >
                                                                            <input name="{{'settings.access'}}" value="{{'settings.access'}}" @if(in_array('settings.access',$rp)){{'checked'}} @endif type="checkbox"  /> <span></span>
                                                                            </label>
                                                                        </span>
                                                                    </div>
                                                            </div>
                                                        </li>
                        
                                                        <li class="d-none list-group-item">
                                                            <div class="row">
                                                                    <label class="col-10 col-form-label">Create Settings</label>
                                                                    <div class="col-2 text-right ">
                                                                        <span class="switch">
                                                                            <label class="ml-auto" >
                                                                            <input name="{{'settings.create'}}" value="{{'settings.create'}}" @if(in_array('settings.create',$rp)){{'checked'}} @endif type="checkbox"  /> <span></span>
                                                                            </label>
                                                                        </span>
                                                                    </div>
                                                            </div>
                                                        </li>
                                    
                                                        <li class="list-group-item">
                                                            <div class="row">
                                                                    <label class="col-10 col-form-label">General</label>
                                                                    <div class="col-2 text-right ">
                                                                        <span class="switch">
                                                                            <label class="ml-auto" >
                                                                            <input name="{{'settings.general'}}" value="{{'settings.general'}}" @if(in_array('settings.general',$rp)){{'checked'}} @endif type="checkbox"  /> <span></span>
                                                                            </label>
                                                                        </span>
                                                                    </div>
                                                            </div>
                                                        </li>
                                                        
                                                        <li class="list-group-item">
                                                            <div class="row">
                                                                    <label class="col-10 col-form-label">Shop</label>
                                                                    <div class="col-2 text-right ">
                                                                        <span class="switch">
                                                                            <label class="ml-auto" >
                                                                            <input name="{{'settings.shop'}}" value="{{'settings.shop'}}" @if(in_array('settings.shop',$rp)){{'checked'}} @endif type="checkbox"  /> <span></span>
                                                                            </label>
                                                                        </span>
                                                                    </div>
                                                            </div>
                                                        </li>
                                            
                                                        <li class="d-none list-group-item">
                                                            <div class="row">
                                                                    <label class="col-10 col-form-label">Customizations</label>
                                                                    <div class="col-2 text-right ">
                                                                        <span class="switch">
                                                                            <label class="ml-auto" >
                                                                            <input name="{{'settings.customizations'}}" value="{{'settings.customizations'}}" @if(in_array('settings.customizations',$rp)){{'checked'}} @endif type="checkbox"  /> <span></span>
                                                                            </label>
                                                                        </span>
                                                                    </div>
                                                            </div>
                                                        </li>
                                                        
                                                        <li class="list-group-item">
                                                            <div class="row">
                                                                    <label class="col-10 col-form-label">Create Module</label>
                                                                    <div class="col-2 text-right ">
                                                                        <span class="switch">
                                                                            <label class="ml-auto" >
                                                                            <input name="{{'settings.modules'}}" value="{{'settings.modules'}}" @if(in_array('settings.modules',$rp)){{'checked'}} @endif type="checkbox"  /> <span></span>
                                                                            </label>
                                                                        </span>
                                                                    </div>
                                                            </div>
                                                        </li>
                                                        
                                                        <li class="list-group-item">
                                                            <div class="row">
                                                                    <label class="col-10 col-form-label">Access Modules</label>
                                                                    <div class="col-2 text-right ">
                                                                        <span class="switch">
                                                                            <label class="ml-auto" >
                                                                            <input name="{{'settings.custom_modules'}}" value="{{'settings.custom_modules'}}" @if(in_array('settings.custom_modules',$rp)){{'checked'}} @endif type="checkbox"  /> <span></span>
                                                                            </label>
                                                                        </span>
                                                                    </div>
                                                            </div>
                                                        </li>
                                                        
                                                        
                                                        <li class="list-group-item">
                                                            <div class="row">
                                                                    <label class="col-10 col-form-label">FileManager</label>
                                                                    <div class="col-2 text-right ">
                                                                        <span class="switch">
                                                                            <label class="ml-auto" >
                                                                            <input name="{{'settings.filemanager'}}" value="{{'settings.filemanager'}}" @if(in_array('settings.filemanager',$rp)){{'checked'}} @endif type="checkbox"  /> <span></span>
                                                                            </label>
                                                                        </span>
                                                                    </div>
                                                            </div>
                                                        </li>
                                                  </ul>
                                                </div>
                                            </div>
                                        </div>
                                 </div>
                            </div>
                           </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          
@endsection


@section('js')


<script>

function update_form(){
    document.querySelector('.permission_form').submit();
}
    
  </script>
@endsection