@extends('admin.layouts.admin')
@section('title','Lot Process')
@section('css')


@endsection
@section('content')
<div class="container-fluid">
    
      <!-- start page title -->
      <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Lot Process</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">lot-process</li>
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
                    <div class="row">
                      <div class="col-6"><h4 class="card-title">Edit</h4></div>
                      <div class="col-6 text-right ">
                        <a class="btn btn-primary" href="{{route('admin.lot-process.index')}}">Back</a>
                      </div>
                    </div>
                  </div>
                  <form class="pt-3" method="post" action="{{route('admin.lot-process.update',$module->id)}}"  >
                      @csrf
                        <div class="form-group">
                            <label for="simpleinput">Title</label>
                            <input name="title" type="text"  class="form-control" value="{{$module->title}}" />
                            @if($errors->has('title'))
                              <div class="error text-danger">{{ $errors->first('title') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                          <button type="submit" class="btn btn-info">Submit</button>
                       </div>
                    </form>
                </div>
              </div>
          </div>
     </div>
 
 
 </div>
@endsection
@section('js')
<script>
    $(document).ready(function () {

     

    });
</script>
@endsection