@extends('admin.layouts.admin')
@section('title','Customers')
@section('css')

<link href="{{asset('admin/plugins/datatables/table.css')}}" rel="stylesheet">
<style>
    .table{
      width: 100%!important;
    }
</style>
  

@endsection
@section('content')
<div class="container-fluid">

    <!-- start page title -->
      <div class="beard row">
          <div class="col-12">
              <div class="page-title-box d-flex align-items-center justify-content-between">
                  <h4 class="mb-0 font-size-18">Customers</h4>
                  <div class="page-title-right">
                      <ol class="breadcrumb m-0">
                          <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                          <li class="breadcrumb-item active"> customers</li>
                      </ol>
                  </div>
              </div>
          </div>
      </div>
    <!-- end page title -->

  <div class="card">
      <div class="card-body">
        <div class=" pt-1 pb-3 container-fluid">
          <div class="row">
            <div class="col-6">
              <h4 class="card-title">All Customers</h4>
            </div>
            <div class="col-6 text-right ">
              <a class="btn btn-primary" href="{{route('admin.customers.create')}}">Add Customer</a>
            </div>
          </div>
        </div>
         
          <div class="table-responsive">
              <table class="data-table table mb-0">
                  <thead>
                      <tr>
                        <th class="text-left" >Name</th>
                        <th class="text-left" >Email</th>
                        <th class="text-left" >Address</th>
                        <th class="text-left" >City</th>
                        <th class="text-left" >Mobile</th>
                        <th class="text-left" >STRN</th>
                        <th class="text-left" >NTN</th>
                        <th class="text-center" >Actions</th>
                      </tr>
                  </thead>
                  <tbody>

                  </tbody>
              </table>
          </div>
      </div>
  </div>

  
</div>
@endsection


@section('js')
<script src="{{asset('admin/plugins/datatables/table.js')}}"></script>

   <script>
    $(document).ready(function(){

        var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{route('admin.customers.index') }}",
          columns: [
                      {
                        data: 'name', 
                        name: 'name'
                      },
                      {
                        data: 'email',
                        name: 'email'
                      },
                      { 
                        data: 'address', 
                        name: 'address'
                      },
                      { 
                        data: 'city', 
                        name: 'city'
                      },
                      { 
                        data: 'mobile', 
                        name: 'mobile'
                      },
                      { 
                        data: 'strn', 
                        name: 'strn'
                      },
                      { 
                        data: 'ntn', 
                        name: 'ntn'
                      },
                      { 
                        data: 'action', 
                        name: 'action', 
                        orderable: false, 
                        searchable: false
                      },
                    ]
              });
    });
  </script>
@endsection