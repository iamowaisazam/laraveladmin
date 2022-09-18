@extends('admin.layouts.admin')
@section('title','Account Ledger')
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
                  <h4 class="mb-0 font-size-18">Accounts Ledger "{{$account->account_name}}"</h4>
                  <div class="page-title-right">
                      <ol class="breadcrumb m-0">
                          <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                          <li class="breadcrumb-item active">reports</li>
                      </ol>
                  </div>
              </div>
          </div>
      </div>
    <!-- end page title -->

      <div class="card">
          <div class="card-body">
            <div class="table-responsive">
                <table class="table data-table">
                  <thead>
                      <tr>
                          <th>Date</th>
                          <th>Ref Account</th>
                          <th>Description</th>
                          <th>Credit</th>
                          <th>Debit</th>
                          <th>Balance</th>
                          <th>Action</th>
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
          ajax: "{{route('admin.reports.accounts_ledger_detail',$account->id)}}",
          columns: [
                      {
                        data: 'date', 
                        name: 'date'
                      },
                      {
                        data: 'ref', 
                        name: 'ref'
                      },
                      {
                        data: 'description', 
                        name: 'description'
                      },
                      {
                        data: 'credit', 
                        name: 'credit'
                      },
                      {
                        data: 'debit', 
                        name: 'debit'
                      },
                      {
                        data: 'balance', 
                        name: 'balance'
                      },
                      {
                        data: 'action', 
                        name: 'action'
                      },
                    ]
              });
    });
  </script>
@endsection