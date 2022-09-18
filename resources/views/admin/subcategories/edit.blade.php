@extends('admin.layouts.admin')
@section('title','SubCategory')
@section('css')
<link href="{{asset('admin/assets/css/select2.css')}}" rel="stylesheet" />
<style>
   .form-error{
      padding-top: 8px;
    }

    .thumbnail{
      width: 100px;
      height: 100px;
    }
</style>
@endsection
@section('content')
<div class="container-fluid">
    
  <!-- start page title -->
      <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Edit SubCategory</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">subcategories</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
  <!-- end page title -->

  <div class="row">
       <div class="col-12">
        <form enctype="multipart/form-data" method="post" action="{{route('admin.subcategories.update',$module->id)}}"  >
          @csrf
          <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="simpleinput">Title</label>
                              <input required name="title" class="title form-control" value="{{$module->title}}"  />
                              @if($errors->has('title'))
                                <div class="form-error text-danger">{{ $errors->first('title') }}</div>
                              @endif
                          </div>
                      </div>

                      <div class="col-md-6">
                        <div class="pb-2 form-group">
                          <label>Category</label> <br>
                          <select class="category_id form-control" name="category_id">
                            <option value="{{$module->category_id}}">{{$module->category->title}}</option>
                          </select>
                          @if($errors->has('category_id'))
                            <div class="form-error text-danger">{{ $errors->first('category_id') }}</div>
                          @endif
                        </div>
                      </div>

                      <div class="d-none col-md-6">
                        <div class="form-group">
                          <label>Slug</label>
                          <input required name="slug" class="slug form-control" value="{{$module->slug}}" />
                          @if($errors->has('slug'))
                            <div class="form-error text-danger">{{ $errors->first('slug') }}</div>
                          @endif
                        </div>
                      </div>

                      <div class="d-none col-md-6">
                        <div class="form-group">
                          <label>Sequence</label>
                          <input name="sequence" type="number" class="form-control" value="{{$module->sequence}}"  />
                          @if($errors->has('sequence'))
                            <div class="form-error text-danger">{{ $errors->first('sequence') }}</div>
                          @endif
                        </div>
                      </div>

                      <div class="d-none col-md-6">
                        <div class="form-group">
                          <label>Initials</label>
                          <input name="initials" class="form-control" value="{{$module->initials}}" />
                          @if($errors->has('initials'))
                            <div class="form-error text-danger">{{ $errors->first('initials') }}</div>
                          @endif
                        </div>
                      </div>

                      <div class="d-none col-md-6">
                        <div class="pb-2 form-group">
                          <label>Thumbnail</label> <br>
                          <input name="thumbnail" type="file" />
                          @if($errors->has('thumbnail'))
                            <div class="form-error text-danger">{{ $errors->first('thumbnail') }}</div>
                          @endif
                          @if($module->thumbnail)
                          <img class="pt-2 d-block thumbnail" src="{{asset($module->thumbnail)}}" />
                          @endif
                        </div>
                      </div>


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
<script src="{{asset('admin/assets/js/select2.js')}}"></script>
<script>
    $(document).ready(function () {

      $(".category_id").select2({
            placeholder: "Search Category",
            minimumInputLength: 2,
            ajax: {
                url: "http://localhost/shahidafridi/public/admin/categories/search",
                dataType: 'json',
                delay: 250,
                data: function (term, page) {
                    return {search:term.term}
                },
                processResults: function (response) {
                    return { results: response};
                },
                cache: true
            },
        });

      $(".title").change(function() {
          var Text = $(this).val();
          Text = Text.toLowerCase();
          Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
          $(".slug").val(Text); 
      });

    });
</script>
@endsection