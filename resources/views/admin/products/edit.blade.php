@extends('admin.layouts.admin')
@section('title','Products')
@section('css')
<link href="{{asset('admin/assets/css/select2.css')}}" rel="stylesheet" />

<style>
  .select2-selection__choice{
    color: black;
  }

  .select2-selection__choice {
    color: #0a0a0a!important;
  }

</style>
@endsection
@section('content')
<div class="container-fluid">
    
    <!-- start page title -->
    <div class="row">
      <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18">Edit</h4>
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
                 <form  method="post" action="{{route('admin.products.update',$module->id)}}">
                  @csrf

                  <div class="row">
           
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Title</label>
                        <input required value="{{$module->title}}" name="title" type="text" class="form-control"/>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Article No</label>
                        <input value="{{$module->article_no}}" name="article_no" class="form-control"/>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Product Price(Rs)</label>
                        <input value="{{$module->price}}" name="price" type="number" class="form-control"/>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Product Price($)</label>
                        <input value="{{$module->dollar_price}}" name="dollar_price" type="number" class="form-control"/>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Select SubCategory</label>
                        <select required class="form-control" name="subcategory_id">
                          @foreach (Con::subcategories() as $subcategory)
                           <option @if($subcategory->id == $module->subcategory_id) {{'selected'}} @endif value="{{$subcategory->id}}">{{$subcategory->title}}</option>
                          @endforeach
                        </select>                    
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Select Fabrics</label>
                        <select required class="form-control" name="fabric_id">
                          @foreach (Con::fabrics() as $fabric)
                           <option @if($fabric->id == $module->fabric_id){{'selected'}}@endif value="{{$fabric->id}}">{{$fabric->lot}} - {{$fabric->title}} - {{$fabric->color}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Select Stylings </label>
                        <?php $styles = explode(',',$module->style_id);?>
                        <select multiple class="form-control" name="style_id[]">
                          @foreach (Con::styles() as $style)
                           <option @if(in_array($style->id,$styles)){{'selected'}}@endif value="{{$style->id}}">{{$style->title}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label >Select Color</label>
                        <select class="form-control" name="color_id">
                          @foreach (Con::colors() as $color)
                              <option @if($module->color_id == $color->id) {{'selected'}} @endif value="{{$color->id}}">{{$color->title}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Select Button</label>
                        <?php $buttons = explode(',',$module->button_id);?>
                        <select multiple class="form-control" name="button_id[]">
                          @foreach (Con::buttons() as $button)
                            <option @if(in_array($button->id,$buttons)){{'selected'}}@endif value="{{$button->id}}">{{$button->title}}</option>
                           @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Select Size</label>
                        <select multiple class="form-control" name="size_id[]">
                          <?php $sizes = explode(',',$module->size_id);?>
                          @foreach (Con::sizes() as $size)
                            <option @if(in_array($size->id,$sizes)){{'selected'}}@endif value="{{$size->id}}">{{$size->title}}</option>
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

        
        
      
        // $(".title").keyup(function(){
        //     var Text = $(this).val();
        //     Text = Text.toLowerCase();
        //     Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
        //     $(".slug").val(Text);        
        // });

    });

</script>
@endsection