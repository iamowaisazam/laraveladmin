@extends('admin.layouts.admin')
@section('title','Products')
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
                  <h4 class="mb-0 font-size-18">Products</h4>
                  <div class="page-title-right">
                      <ol class="breadcrumb m-0">
                          <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                          <li class="breadcrumb-item active"> products</li>
                      </ol>
                  </div>
              </div>
          </div>
      </div>
   <!-- end page title -->


  <div class="card">
      <div class="card-body">
        <div class="pt-1 pb-3 container-fluid">
          <div class="row">
            <div class="col-6">
              <h4 class="card-title">All Products</h4>
            </div>
            <div class="col-6 text-right ">
              <a class="btn btn-primary" href="{{route('admin.products.create')}}">Add New Product</a>
            </div>
          </div>
        </div>
        <div class="table-responsive">
              <table class="data-table table mb-0">
                  <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Style #</th>
                        <th>Category</th>
                        <th>Fabric</th>
                        <th>Color</th>
                        <th>Price (Rs)</th>
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
        order: [[ 1, "asc" ]],
        processing: true,
        serverSide: true,
        ajax: "{{route('admin.products.index') }}",
        columns: [
                   { 
                    data: 'DT_RowIndex', 
                    name: 'DT_RowIndex', 
                    orderable: false, 
                    searchable: false 
                    },
                    {
                      data: 'title', 
                      name: 'title'
                    },
                    {
                      data: 'style', 
                      name: 'style'
                    },
                     {
                      data: 'category', 
                      name: 'category'
                    },
                    {
                      data: 'fabric', 
                      name: 'fabric'
                    },
                    {
                      data: 'color', 
                      name: 'color'
                    },
                    {
                      data: 'price', 
                      name: 'price'
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