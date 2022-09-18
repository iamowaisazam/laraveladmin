@extends('admin.layouts.admin')
@section('title',$type->title)
@section('css')

<style>

   .form-error{
      padding-top: 8px;
    }
</style>
@endsection
@section('content')
<div class="container-fluid">
    
  <!-- start page title -->
      <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Edit {{$type->title}}</h4>
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

  <div class="row">
       <div class="col-12">
        <form enctype="multipart/form-data" method="post" action="{{route('admin.attributes.update',['slug'=>$type->slug,'id'=>$module->id])}}"  >
          @csrf
          <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                              <label for="simpleinput">Title</label>
                              <input required name="title" class="title form-control" value="{{$module->title}}" />
                          </div>
                      </div>

                      @if($type->slug == 'fabric')

                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="simpleinput">Lot</label>
                            <input name="lot" value="{{$module->lot}}" class="form-control"  />
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="simpleinput">Color</label>
                            <input name="color" value="{{$module->color}}" class="form-control" />
                        </div>
                     </div>

                     <div class="col-md-12">
                      <div class="form-group">
                          <label for="simpleinput">Remarks</label>
                          <input  name="remarks" value="{{$module->remarks}}" class="form-control" />
                      </div>
                    </div>

                      @endif

                      <div class="col-md-12">
                        <div class="form-group text-center ">
                          <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
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