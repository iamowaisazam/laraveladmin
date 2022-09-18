@extends('admin.layouts.admin')
@section('title','Accounts')
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
                  <h4 class="mb-0 font-size-18">Accounts</h4>
                  <div class="page-title-right">
                      <ol class="breadcrumb m-0">
                          <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                          <li class="breadcrumb-item active"> accounts</li>
                      </ol>
                  </div>
              </div>
          </div>
      </div>
    <!-- end page title -->

      <div class="card">
          <div class="card-body">
            <div class="pt-1 pb-4 container-fluid">
                <div class="row">
                    <div class="col-6"><h4 class="card-title">All Accounts</h4></div>
                    <div class="col-6 text-right ">
                      <a class="btn btn-primary" href="{{route('admin.accounts.create')}}">Add New Account</a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table data-table">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Title</th>
                          <th>Type</th>
                          <th>Balance</th>
                          <th width="100px">Action</th>
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
          ajax: "{{route('admin.accounts.index')}}",
          columns: [
                      {
                        data: 'id', 
                        name: 'id'
                      },
                      {
                        data: 'account_name', 
                        name: 'account_name'
                      },
                      {
                        data: 'account_type', 
                        name: 'account_type'
                      },
                      {
                        data: 'balance', 
                        name: 'balance'
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