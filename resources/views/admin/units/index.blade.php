@extends('admin.layouts.admin')
@section('title','Units')
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
                  <h4 class="mb-0 font-size-18">Units</h4>
                  <div class="page-title-right">
                      <ol class="breadcrumb m-0">
                          <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                          <li class="breadcrumb-item active"> units</li>
                      </ol>
                  </div>
              </div>
            </div>
        </div>
    <!-- end page title -->

        <div class="card">
            <div class="py-3 card-body">
              <div class="pt-1 pb-3 container-fluid">
                <div class="row">
                  <div class="col-6">
                    <h4 class="card-title">All Units</h4>
                  </div>
                  <div class="col-6 text-right">
                    <a class="btn btn-primary" href="{{route('admin.units.create')}}"> Add New Unit </a>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                    <table class="data-table table mb-0">
                        <thead>
                            <tr>
                              <th class="text-left" >Title</th>
                              <th class="text-left" >Short Name</th>
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
          ajax: "{{route('admin.units.index') }}",
          columns: [
                     {
                        data: 'title', 
                        name: 'title'
                      },
                      {
                        data: 'short_name', 
                        name: 'short_name'
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