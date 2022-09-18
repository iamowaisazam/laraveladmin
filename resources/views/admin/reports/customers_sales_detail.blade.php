@extends('admin.layouts.admin')
@section('title','Customers Sales')
@section('css')

  <link href="{{asset('admin/plugins/datatables/table.css')}}" rel="stylesheet">
  <style>
      .table{
        width: 100%!important;
      }
      
      td{
          text-align:center;
          border:0px;
      }
      
     body td{
         border-top: none!important;
     }
  </style>
@endsection
@section('content')
<div class="container-fluid">

    <!-- start page title -->
        <div class="beard row">
          <div class="col-12">
              <div class="page-title-box d-flex align-items-center justify-content-between">
                  <h4 class="mb-0 font-size-18">"{{$customer->name}}" Sales</h4>
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
                          <th class="text-center">Lot</th>
                          <th class="text-center">Qty</th>
                          <th class="text-center">Rate/U</th>
                          <th class="text-center">Total</th>
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
          ajax: "{{route('admin.reports.customers_sales_detail',$customer->id)}}",
          createdRow: function(row, data, dataIndex){
               
            },
          columns: [
                      {
                        data: 'des', 
                        name: 'des'
                      },
                      {
                        data: 'qty', 
                        name: 'qty'
                      },
                      {
                        data: 'rate', 
                        name: 'rate'
                      },
                      {
                        data: 'total', 
                        name: 'total'
                      },
                      
                    ]
              });
    });
  </script>
@endsection