@extends('admin.layouts.admin')
@section('title','Users')
@section('css')
  


<style>
  svg{
    width: 19px!important;
  }
</style>


@endsection
@section('content')

<div class="conainer-fluid">

	<!-- start page title -->
      <div class="row">
        <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Dashboard</h4>
            <div class="page-title-right">
              <ol class="breadcrumb m-0">
                <li class="breadcrumb-item active">Dashboard</li>
                <li class="breadcrumb-item ">Users</li>
              </ol>
            </div>
          </div>
        </div>
      </div>     
	<!-- end page title -->

          <div class="card">
            <div class="py-3 card-body">
                <form action="{{route('admin.users.index')}}"  class="searchfilter">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-3">
                          <div class="form-group">
                              <label>Name</label>
                              <input name="search" type="text" class="form-control" value="">
                          </div>
                      </div>
                      <div class="col-3 text-left ">
                          <div class="form-group">
                              <label>Type</label>
                              <select class="form-control" name="type">
                                <option value="customer">Customer</option>
                                <option value="guest">Guest</option>
                                <option value="Vendor">Vendor</option>
                                <option value="User">User</option>
                              </select>
                          </div>
                      </div>
                      <div class="col-3 text-left ">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="type">
                              <option value="approved">Approved</option>
                              <option value="pending">Pending</option>
                              <option value="blocked">Blocked</option>
                            </select>
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
              <div class=" pt-1 pb-3 container-fluid">
                <div class="row">
                  <div class="col-6">
                    <h4 class="card-title">All Users</h4>
                  </div>
                  <div class="col-6 text-right ">
                    <a href="{{route('admin.users.create')}}"><i class="fa fa-plus  fa-2x "></i></a>
                  </div>
                </div>
              </div>
            
              <div class="table-responsive">
                  <table class="table mb-0">
                      <thead>
                          <tr>
                            <th>#</th>
                            <th class="text-left" >Name</th>
                            <th class="text-left" >Email</th>
                            <th class="text-left" >Type</th>
                            <th class="text-left" >Country</th>
                            <th class="text-left" >Status</th>
                            <th class="text-left" >Joined Date</th>
                            <th class="text-center" >Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($data as $key => $item)
                            <tr class="odd ">
                                  <td class="center" >{{$key + 1}}</td>
                                  <td class="text-left" >{{ $item->name }}</td>
                                  <td class="text-left" > {{ $item->email }}</td>
                                  <td class="text-left" > {{ $item->type ? $item->type : 'none' }}</td>
                                  <td class="text-left" > {{ $item->country }}</td>
                                  <td class="text-left" > {{ $item->status }}</td>
                                  <td class="text-left" > {{ $item->created_at->format('Y-m-d') }} </td>
                                  <td class="text-center">
                                    <a href="{{route('admin.users.edit', $item->id)}}"  title="Edit"> 
                                      <i class="fas fa-edit fa-2x" aria-hidden="true"></i></a>

                                     <a href="{{route('admin.users.destroy', $item->id)}}" title="Delete"><i class="text-danger fa-2x fas fa-window-close "></i></a>        
                                  </td>
                            </tr>
                      @endforeach
                      </tbody>
                  </table>
              </div>
              
              <div class="text-center" >
                {{$data->links()}}
              </div>
           
          </div>
      </div>
  </div>
@endsection


@section('js')


<script>
    $(document).ready(function(){


   
   

  });


  </script>

@endsection
