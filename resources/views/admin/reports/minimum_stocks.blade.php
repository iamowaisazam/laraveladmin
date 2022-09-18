@extends('admin.layouts.admin')
@section('title','Low Stocks')
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
                <div class="row">
                      <div class="col-12">
                          <div class="page-title-box d-flex align-items-center justify-content-between">
                              <h4 class="mb-0 font-size-18"> Low Stocks</h4>
                              <div class="page-title-right">
                                  <ol class="breadcrumb m-0">
                                      <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                                      <li class="breadcrumb-item active"> Reports</li>
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
                                      <th>ID</th>
                                      <th>Product Name</th>
                                      <th>Type</th>
                                      <th>Unit</th>
                                      <th>Minimum Quantity</th>
                                      <th>Stock</th>
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
          ajax: "{{route('admin.reports.low_stocks')}}",
          columns: [
                      {
                        data: 'id', 
                        name: 'id'
                      },
                      {
                        data: 'title', 
                        name: 'title'
                      },
                      {
                        data: 'type', 
                        name: 'type'
                      },
                      {
                        data: 'unit', 
                        name: 'unit'
                      },
                      {
                        data: 'minimum', 
                        name: 'minimum'
                      },
                      {
                        data: 'stock', 
                        name: 'stock'
                      }
                    ]
              });
    });
  </script>
 
@endsection