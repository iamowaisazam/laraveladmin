@extends('admin.layouts.admin')
@section('title','Companies')

@section('css')
  
@endsection

@section('content')

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
      <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18">Company
              </h4>

              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                      <li class="breadcrumb-item active"> companies</li>
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
              <h4 class="card-title">All Companies</h4>
            </div>
            <div class="col-6 text-right ">
              <a href="{{route('admin.companies.create')}}"><i class="fa fa-plus  fa-2x "></i></a>
            </div>
          </div>
        </div>
         
          <div class="table-responsive">
              <table class="table mb-0">
                  <thead>
                      <tr>
                        <th>#</th>
                        <th class="text-left" >Logo</th>
                        <th class="text-left" >Title</th>
                        <th class="text-left" >Created At</th>
                        <th class="text-center" >Actions</th>
                      </tr>
                  </thead>
                  <tbody>
                        @foreach ($modules as $key => $item)
                          <tr class="odd gradeX">
                                <td class="center" >{{$key + 1}}</td>
                                <td class="text-left" > <img style="width: 40px" src="{{ asset($item->logo) }}" /></td>
                                <td class="text-left" > {{ $item->title }} </td>
                                <td class="text-left" > {{ $item->created_at->format('Y-m-d') }} </td>
                                <td class="text-center">
                                  <a href="{{route('admin.companies.edit', $item->id)}}"  title="Edit"> 
                                    <i class="fas fa-edit fa-2x" aria-hidden="true"></i></a>
                                  <a href="{{route('admin.companies.delete', $item->id)}}" title="Delete"><i class="text-danger fa-2x fas fa-window-close "></i></a>
                                </td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>
          </div>
      </div>
  </div>
</div>
@endsection


@section('js')
{{-- <script src="{{asset('admin/assets/plugins/custom/datatables/datatables.bundle9cd7.js?v=7.1.5')}}"></script> --}}


<script>
    $(document).ready(function(){



    });


  </script>

@endsection