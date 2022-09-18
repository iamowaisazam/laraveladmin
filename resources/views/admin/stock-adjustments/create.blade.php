@extends('admin.layouts.admin')
@section('title','Stock Adjustment')

@section('css')

<link href="{{asset('admin/plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />


@endsection

@section('content')
<div class="container-fluid">
        <!-- start page title -->
    <div class="row">
      <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18">Stock Adjustments</h4>
              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                      <li class="breadcrumb-item active"> stock-adjustments</li>
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
                    <h4 class="card-title">Create</h4>
                  </div>
                  <div class="col-6 text-right ">
                    <a class="btn btn-primary" href="{{route('admin.stock-adjustments.index')}}">Back</a>
                  </div>
                </div>
              </div>

              <form  method="post" action="{{route('admin.stock-adjustments.store')}}"  >
                  @csrf       
                               <div class="row" >
                              <div class="col-md-6" >
                              <div class="form-group">
                                  <label for="simpleinput">Product</label>
                                  <select required class="js-example-basic-single form-control"  name="product_id">
                                     @foreach(Con::products() as $product)
                                      <option value="{{$product->id}}" >{{$product->title}}</option>
                                     @endforeach
                                  </select>
                                  @if($errors->has('product_id'))
                                    <div class="error text-danger">{{ $errors->first('product_id') }}</div>
                                  @endif
                              </div>
                              </div>

                              <div class="col-md-6" >
                              <div class="form-group">
                                  <label for="simpleinput">Date</label>
                                  <input required value="{{old('date')}}" name="date" type="datetime-local"  class="form-control" />
                                  @if($errors->has('date'))
                                    <div class="error text-danger">{{ $errors->first('date') }}</div>
                                  @endif
                             </div>
                             </div>

                             <div class="col-md-4" >
                             <div class="form-group">
                                <label for="simpleinput">Quantity</label>
                                <input required step=".01" value="{{old('qty')}}" name="qty" type="number"  class="form-control" />
                                @if($errors->has('qty'))
                                    <div class="error text-danger">{{ $errors->first('qty') }}</div>
                                @endif
                             </div>
                             </div>

                             <div class="col-md-4" >
                             <div class="form-group">
                                <label for="simpleinput">Rate</label>
                                <input required step=".01" value="{{old('rate')}}" name="rate" type="number"  class="form-control" />
                                @if($errors->has('rate'))
                                    <div class="error text-danger">{{ $errors->first('rate') }}</div>
                                  @endif
                             </div>
                             </div>
                             
                             <div class="col-md-4" >
                              <div class="form-group">
                                  <label for="simpleinput">Type</label>
                                  <select required class="form-control"  name="type">
                                      <option>Increament</option>
                                      <option>Decrement</option>
                                  </select>
                                  @if($errors->has('type'))
                                    <div class="error text-danger">{{ $errors->first('type') }}</div>
                                  @endif
                             </div>
                             </div>
                             
                             <div class="col-md-12" >
                             <div class="form-group">
                                <label for="simpleinput">Details</label>
                                 <textarea class="form-control" name="details" >{{old('details')}}</textarea>
                             </div>
                             </div>
                             
                             <div class="col-md-12 text-center pt-3" >
                                <button type="submit" class="btn btn-info">Submit</button>
                             </div>

                        </div>
                </form>
            </div>
    </div>
  </div>
</div>
@endsection

@section('js')

  <script src="{{asset('admin/plugins/select2/select2.min.js')}}"></script>
  <script>
      $('.js-example-basic-single').select2();
  </script>

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