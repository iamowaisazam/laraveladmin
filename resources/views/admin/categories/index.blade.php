@extends('admin.layouts.admin')
@section('title','Categories')
@section('css')

<link href="{{asset('admin/plugins/datatables/table.css')}}" rel="stylesheet">
<style>
    .table{
      width: 100%!important;
    }

    table tbody td{
      text-align: center;
    }
    
    
</style>
@endsection
@section('content')
<div class="container-fluid">
    
        <!-- start page title -->
            <div class="row">
              <div class="col-12">
                  <div class="page-title-box d-flex align-items-center justify-content-between">
                      <h4 class="mb-0 font-size-18">Category</h4>
                      <div class="page-title-right">
                          <ol class="breadcrumb m-0">
                              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                              <li class="breadcrumb-item active">categories</li>
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
                      <h4 class="card-title">All Categories</h4>
                    </div>
                    <div class="col-6 text-right ">
                      <a class="btn btn-primary" href="{{route('admin.categories.create')}}">Add New Category</a>
                    </div>
                  </div>
            </div>
            <div class="table-responsive">
                  <table class="data-table table mb-0">
                      <thead>
                          <tr>  
                            <th class="text-center" >ID</th>
                            <th class="text-center" >Title</th>
                            <th class="text-center" >Sequence</th>
                            <th class="text-center" >Initials</th>
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
          ajax: "{{route('admin.categories.index') }}",
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
                        data: 'sequence', 
                        name: 'sequence'
                      },
                      {
                        data: 'initials', 
                        name: 'initials'
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