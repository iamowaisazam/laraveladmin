@extends('admin.layouts.admin')
@section('title','Vendors Purchases')
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
     
     .type-heading{
         border-top: 1px solid !important;
         border-bottom: 1px solid !important;
     }
  </style>
@endsection
@section('content')
<div class="container-fluid">

    <!-- start page title -->
        <div class="beard row">
          <div class="col-12">
              <div class="page-title-box d-flex align-items-center justify-content-between">
                  <h4 class="mb-0 font-size-18">"{{$vendor->name}}" Purchases</h4>
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
                          <th class="d-none" >ID</th>
                          <th class="text-center" >Description Of Goods</th>
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
          pageLength: 100,
          processing: true,
          serverSide: true,
          ajax: "{{route('admin.reports.vendors_purchases_detail',$vendor->id)}}",
          createdRow: function(row, data, dataIndex){
               
                if(data.type === 'type'){
                    $('td:eq(1)', row).addClass("type-heading");
                    
                    $('td:eq(0)', row).css('display', 'none');
                    $('td:eq(1)', row).attr('colspan', 7);
                    $('td:eq(2)', row).css('display', 'none');
                    $('td:eq(3)', row).css('display', 'none');
                    $('td:eq(4)', row).css('display', 'none');
                    $('td:eq(5)', row).css('display', 'none');
                    $('td:eq(6)', row).css('display', 'none');
                    $('td:eq(7)', row).css('display', 'none');
                    
                }else{
                    $('td:eq(0)', row).css('display', 'none');
                }
                
            },
          columns: [
                      {
                        data: 'DT_RowIndex', 
                        name: 'DT_RowIndex'
                      },
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