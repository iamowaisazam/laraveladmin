@extends('admin.layouts.admin')
@section('title','Expenses Receivables')
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
                  <h4 class="mb-0 font-size-18">Receivables</h4>
                  <div class="page-title-right">
                      <ol class="breadcrumb m-0">
                          <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                          <li class="breadcrumb-item active"> Expenses</li>
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
                    <div class="col-6"><h4 class="card-title">All Receivables</h4></div>
                    <div class="col-6 text-right">
                      <a class="btn btn-primary" href="{{route('admin.expenses_receivables.create')}}">Add New Receivables</a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table data-table">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Account</th>
                          <th>Expense</th>
                          <th>Amount</th>
                          <th>Date</th>
                          <th>Remarks</th>
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
          ajax: "{{route('admin.expenses_receivables.index')}}",
          columns: [
                      {
                        data: 'id', 
                        name: 'id'
                      },
                      {
                        data: 'account', 
                        name: 'account'
                      },
                      {
                        data: 'expense', 
                        name: 'expense'
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
                        data: 'remarks', 
                        name: 'remarks'
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