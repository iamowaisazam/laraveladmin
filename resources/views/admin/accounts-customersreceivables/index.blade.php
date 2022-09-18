@extends('admin.layouts.admin')
@section('title','Customer Receivables')
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
                  <h4 class="mb-0 font-size-18">Customer Receivables</h4>
                  <div class="page-title-right">
                      <ol class="breadcrumb m-0">
                          <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                          <li class="breadcrumb-item active">accounts</li>
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
                    <div class="col-6"><h4 class="card-title">All Customer Receivables</h4></div>
                    <div class="col-6 text-right ">
                      <a class="btn btn-primary" href="{{route('admin.accounts_customersreceivables.create')}}">Add New</a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table data-table">
                  <thead>
                      <tr>
                          <th width="20px" >#</th>
                          <th>Vendor</th>
                          <th>Transfer</th>
                          <th>Payment Type</th>
                          <th>Amount</th>
                          <th>Date</th>
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
          ajax: "{{route('admin.accounts_customersreceivables.index')}}",
          columns: [
                      {
                        data: 'id', 
                        name: 'id'
                      },
                      {
                        data: 'customer', 
                        name: 'customer'
                      },
                      {
                        data: 'receiver', 
                        name: 'receiver'
                      },
                      {
                        data: 'payment_type', 
                        name: 'payment_type'
                      },
                      {
                        data: 'amount', 
                        name: 'amount'
                      },
                      {
                        data: 'date', 
                        name: 'date'
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