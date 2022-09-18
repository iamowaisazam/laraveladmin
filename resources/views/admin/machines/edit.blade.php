@extends('admin.layouts.admin')
@section('title','Machines')

@section('css')


@endsection

@section('content')
<div class="container-fluid">

        <!-- start page title -->
          <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Machine</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active"> machines</li>
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
                  <div class="col-6">
                    <h4 class="card-title">Edit</h4>
                  </div>
                  <div class="col-6 text-right ">
                    <a class="btn btn-primary" href="{{route('admin.machines.index')}}">Back</a>
                  </div>
                </div>
              </div>

              <form  method="post" action="{{route('admin.machines.update',$module->id)}}"  >
                @csrf
                   
                   <div class="form-group">
                        <label for="simpleinput">Name/Number</label>
                        <input name="title" type="text" value="{{$module->title}}"  class="form-control" />
                        @if($errors->has('title'))
                          <div class="error text-danger">{{ $errors->first('title') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                      <label class="col-form-label text-left">Category</label>
                      <select required class="form-control" name="category">
                        <option  @if($module->category == 'category-1') {{'selected'}} @endif value="category-1">Category 1</option>
                       </select>
                      @if($errors->has('category'))
                      <div class="text-danger">{{ $errors->first('category') }}</div>
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

@endsection

@section('js')

<script>

    $(document).ready(function () {

      
        // $(".title").keyup(function(){
        //     var Text = $(this).val();
        //     Text = Text.toLowerCase();
        //     Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
        //     $(".slug").val(Text);        
        // });

    });
      

</script>

@endsection