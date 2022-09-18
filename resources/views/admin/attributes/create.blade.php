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
                <h4 class="mb-0 font-size-18">Create {{$type->title}}</h4>
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
        <form enctype="multipart/form-data" method="post" action="{{route('admin.attributes.store',$type->slug)}}"  >
          @csrf
          <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                              <label for="simpleinput">Title</label>
                              <input required name="title" class="title form-control" value="{{old('title')}}" />
                              @if($errors->has('title'))
                                <div class="form-error text-danger">{{ $errors->first('title') }}</div>
                              @endif
                          </div>
                      </div>
                      @if($type->slug == 'fabric')

                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="simpleinput">Lot</label>
                            <input name="lot" class="form-control"  />
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="simpleinput">Color</label>
                            <input name="color" class="form-control" />
                        </div>
                     </div>

                     <div class="col-md-12">
                      <div class="form-group">
                          <label for="simpleinput">Remarks</label>
                          <input  name="remarks" class="form-control" />
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

    

      $(".title").change(function() {
        var Text = $(this).val();
        Text = Text.toLowerCase();
        Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
        $(".slug").val(Text); 
      }).change();

    });
</script>
@endsection