@extends('admin.layouts.admin')
@section('title',$product->title.'Stock')
@section('css')

<link href="{{asset('admin/plugins/datatables/table.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap4.min.css"  >
<style>
    table{
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
                  <h4 class="mb-0 font-size-18">"{{$product->title}}" Stock History</h4>
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
            <div class="py-3 card-body">
                <form action="{{route('admin.reports.product',$product->id)}}"  class="searchfilter">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-5">
                          <div class="form-group">
                              <label>Start Date</label>
                              <input name="sdate" type="date" class="form-control" value="{{request()->sdate}}">
                          </div>
                      </div>
                      <div class="col-5 text-left ">
                           <div class="form-group">
                               <label>End Date</label>
                              <input name="edate" type="date" class="form-control" value="{{request()->edate}}">
                          </div>
                      </div>
                      <div class="col-2 text-left align-self-end">
                           <div class="form-group">
                               <button  type="submit"  class=" btn btn-primary form-control">Submit</button>
                          </div>
                      </div>
                    </div>
                  </div>
              </form>
          </div>
     </div>

      <div class="card">
          <div class="card-body">
            <div class="table-responsive">
                   {!! $dataTable->table() !!}
            </div>
          </div>
      </div>
</div>
@endsection


@section('js')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap4.min.js"></script>
<script src="{{asset('/vendor/datatables/buttons.server-side.js')}}"></script>
{!! $dataTable->scripts() !!}

@endsection