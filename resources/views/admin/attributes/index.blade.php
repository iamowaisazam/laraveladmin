@extends('admin.layouts.admin')
@section('title',$type->title)
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
                      <h4 class="mb-0 font-size-18">{{$type->title}}</h4>
                      <div class="page-title-right">
                          <ol class="breadcrumb m-0">
                              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                              <li class="breadcrumb-item active">attributes</li>
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
                      <h4 class="card-title">All "{{$type->title}}"</h4>
                    </div>
                    <div class="col-6 text-right ">
                      <a class="btn btn-primary" href="{{route('admin.attributes.create',$type->slug)}}">Add New {{$type->title}}</a>
                    </div>
                  </div>
            </div>
            <div class="table-responsive">
                  <table class="data-table table mb-0">
                      <thead>
                          <tr>  
                            <th class="text-center" >ID</th>
                            <th class="text-center" >Title</th>
                            @if($type->slug == 'fabric')
                            <th class="text-center" >Lot</th>
                            <th class="text-center" >Color</th>
                            <th class="text-center" >Remarks</th>
                            @endif
                            <th class="text-center" >Date</th>
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
          ajax: "{{route('admin.attributes.index',$type->slug)}}",
          columns: [
                     {
                        data: 'id', 
                        name: 'id'
                      },
                      {
                        data: 'title', 
                        name: 'title'
                      },
                      @if($type->slug == 'fabric')
                      {
                        data: 'lot', 
                        name: 'lot'
                      },
                      {
                        data: 'color', 
                        name: 'color'
                      },
                      {
                        data: 'remarks', 
                        name: 'remarks'
                      },
                      @endif
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