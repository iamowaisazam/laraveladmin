@extends('admin.layouts.admin')
@section('title','Orders')
@section('css')

<link href="{{asset('admin/assets/css/select2.css')}}" rel="stylesheet" />
<style>
  .select2-selection__choice {
    color: #0a0a0a!important;
  }

  .select2-selection {
    height: auto!important;
}

</style>
@endsection
@section('content')
<div class="container-fluid">
<?php //dd($orders); ?>    
    <!-- start page title -->
    <div class="row">
      <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18">Update</h4>
              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                      <li class="breadcrumb-item active">Orders</li>
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
              <div class="container-fluid">
                 <form  method="post" action="{{route('admin.orders.update',$module->id)}}">
                      @csrf
                      <div class="row">
                          <?php unset($orders[0]); unset($orders[1]); ?>
                            @foreach($orders as $order)
                              <div class="col-md-4">
                                  <div class="form-group">
                                    <label>{{ucfirst(str_replace("_"," ",$order))}}</label>
                                    <input  name="{{$order}}" type="text" class="form-control" value="{{$module[$order]}}" />
                                  </div>
                              </div>
                            @endforeach
                            <div class="col-md-12">
                              <div class="form-group text-center ">
                                <button type="submit" class="btn btn-info">Submit</button>
                             </div>
                            </div>
                      </div>
                 </form>
              </div>
            </div>
        </div>     
      </div>
 </div>
@endsection
@section('js')
<script src="{{asset('admin/assets/js/select2.js')}}"></script>
<script>

    $(document).ready(function () {

   
    
    });

</script>
@endsection