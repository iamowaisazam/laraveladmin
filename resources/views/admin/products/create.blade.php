@extends('admin.layouts.admin')
@section('title','Products')
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
    
    <!-- start page title -->
    <div class="row">
      <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18">Create</h4>
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

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="container-fluid">
                 <form  method="post" action="{{route('admin.products.store')}}">
                  @csrf

                  <div class="row">
           
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Title</label>
                        <input required name="title" type="text" class="form-control"/>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Article No</label>
                        <input required  name="article_no" class="form-control"/>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Product Price(Rs)</label>
                        <input  name="price" type="number" class="form-control"/>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Product Price($)</label>
                        <input  name="dollar_price" type="number" class="form-control"/>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Select SubCategory</label>
                        <select required class="form-control" name="subcategory_id">
                          @foreach (Con::subcategories() as $subcategory)
                           <option value="{{$subcategory->id}}">{{$subcategory->title}}</option>
                          @endforeach
                        </select>                    
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Select Fabrics</label>
                        <select required class="form-control" name="fabric_id">
                          @foreach (Con::fabrics() as $fabric)
                           <option value="{{$fabric->id}}">{{$fabric->lot}} - {{$fabric->title}} - {{$fabric->color}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Select Stylings </label>
                        <select multiple class="form-control" name="style_id[]">
                          @foreach (Con::styles() as $style)
                           <option  value="{{$style->id}}">{{$style->title}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label >Select Color</label>
                        <select class="form-control" name="color_id">
                          @foreach (Con::colors() as $color)
                              <option  value="{{$color->id}}">{{$color->title}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Select Button</label>
                        <select multiple class="form-control" name="button_id[]">
                          @foreach(Con::buttons() as $button)
                            <option value="{{$button->id}}">{{$button->title}}</option>
                           @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Select Size</label>
                        <select multiple class="form-control" name="size_id[]">
                          @foreach (Con::sizes() as $size)
                            <option value="{{$size->id}}">{{$size->title}}</option>
                           @endforeach
                        </select>
                      </div>
                    </div>

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

       $("select[name='button_id[]']").select2({
            placeholder: "Select Button",
            multiple:true
        });

       $("select[name='style_id[]']").select2({
            placeholder: "Select Style",
            multiple:true
        });

        $("select[name='size_id[]']").select2({
            placeholder: "Select Size",
            multiple:true
        });

        $("select[name='color_id']").select2({
            placeholder: "Select Color",
        });

        $("select[name='fabric_id']").select2({
            placeholder: "Select Fabric",
        });

        $("select[name='subcategory_id']").select2({
            placeholder: "Select SubCategory",
        });

    
    });

</script>
@endsection