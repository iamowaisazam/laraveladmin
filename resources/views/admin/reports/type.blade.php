@extends('admin.layouts.admin')
@section('title','Reports')
@section('css')

<link href="{{asset('admin/plugins/datatables/table.css')}}" rel="stylesheet">
  
 <style>
    
    th{
         text-align: center;
     }

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
                  <h4 class="mb-0 font-size-18">Reports</h4>
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

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0 data-table ">
                                <thead>
                                    <tr>
                                        <th class="text-left" >#</th>
                                        <th class="text-left">Title</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
          </div>
      </div>
   </div>
@endsection
@section('js')
   
<script src="{{asset('admin/plugins/datatables/table.js')}}"></script>
<script>
            var table = $('.data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{route('admin.reports.type') }}",
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
                                    data: 'action', 
                                    name: 'action', 
                                    orderable: false, 
                                    searchable: false
                                },
                            ]
            });
  </script>
@endsection