@extends('admin.layouts.admin')
@section('title','Lots Fresh')
@section('css')

<link href="{{asset('admin/plugins/select/css.css')}}" rel="stylesheet" type="text/css" />
<style>
      .remove-icon{
        position: absolute;
        right: 1px;
        top: -1px;
      }
      
      .multiselect-native-select .btn-group{
          border: 1px solid #817e7e6e;
          width: 100%;
      }
</style>

@endsection
@section('content')

<div class="container-fluid">
    
      <!-- start page title -->
            <div class="beard row">
              <div class="col-12">
                  <div class="page-title-box d-flex align-items-center justify-content-between">
                      <h4 class="mb-0 font-size-18">Lots Fresh</h4>
                      <div class="page-title-right">
                          <ol class="breadcrumb m-0">
                              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                              <li class="breadcrumb-item active"> Lots Fresh</li>
                          </ol>
                      </div>
                  </div>
              </div>
          </div>
      <!-- end page title -->

     
      <div class="row">
        <div class="col-12">
            <form  method="post" action="{{route('admin.lots-fresh.store')}}"  >
                @csrf
                <div class="card">
                    <div class="card-body">
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-6"><h4 class="card-title">Create</h4></div>
                          <div class="col-6 text-right "><a href="{{route('admin.lots-fresh.index')}}" class="btn btn-primary" >Back</a></div>
                        </div>
                      </div>
                      <div class="py-3 container-fluid" >
                            <div class="row" >
                                <div class="col-md-3" >
                                     <div class="form-group">
                                        <label for="simpleinput">Receive Date</label>
                                        <input required name="date" type="date" value="{{old('date')}}"  class="form-control" />
                                         @if($errors->has('date'))
                                          <div class="error text-danger">{{ $errors->first('date') }}</div>
                                         @endif
                                     </div>
                                </div>
                                
                                <div class="col-md-3" >
                                     <div class="form-group">
                                        <label for="simpleinput">Issue Date</label>
                                        <input  name="issue_date" type="date" value="{{old('issue_date')}}"  class="form-control" />
                                     </div>
                                </div>
                                
                                <div class="col-md-3" >
                                     <div class="form-group">
                                        <label>Customer</label>
                                        <select name="customer_id" class="form-control" >
                                           @foreach(Con::customers() as $customer)
                                            <option value="{{$customer->id}}" >{{$customer->name}}</option>
                                           @endforeach
                                        </select>
                                     </div>
                                </div>
                                 <div class="col-md-3" >
                                     <div class="form-group">
                                        <label for="simpleinput">Process</label> <br>
                                          <select class="example-getting-started form-control" name="lot_process[]" multiple="multiple" >
                                            @foreach (Con::lot_process() as $item)
                                              <option value="{{$item->id}}" >{{$item->title}}</option>  
                                            @endforeach
                                          </select>
                                     </div>
                                </div>
                                <div class="col-md-3" >
                                     <div class="form-group">
                                        <label for="simpleinput">Party challan #</label>
                                        <input name="party_challan" type="text"  class="form-control" value="{{old('party_challan')}}" />
                                     </div>
                                </div>
                                <div class="col-md-3" >
                                    <label for="simpleinput">Customer Weight kg / Roll</label>
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                          <select class="form-control" name="qty_type" >
                                              <option>KG</option>
                                              <option>ROLL</option>
                                          </select>
                                      </div>
                                      <input name="qty" type="number" step=".01" class="form-control" placeholder="Quantity" value="{{old('qty')}}" />
                                    </div>
                                </div>
                                <div class="col-md-3" >
                                     <div class="form-group">
                                        <label for="simpleinput">Fabric Quality</label>
                                        <input name="fabric_quality" type="text"  class="form-control" value="{{old('fabric_quality')}}" />
                                     </div>
                                </div>
                                <div class="col-md-3" >
                                     <div class="form-group">
                                        <label for="simpleinput">Color</label>
                                        <input name="color" type="text"  class="form-control" value="{{old('color')}}" />
                                     </div>
                                </div>
                                <div class="col-md-3" >
                                     <div class="form-group">
                                        <label for="simpleinput">Party Job Number</label>
                                        <input name="party_job_number" type="text"  class="form-control" value="{{old('party_job_number')}}" />
                                     </div>
                                </div>
                            </div>
                        </div>
                    </div>
               </div>
               
               <div class="card">
                    <div class="card-body">
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-6"><h4 class="card-title">Lot Items</h4></div>
                          <div class="col-6 text-right "><a  class="add-icon text-white  btn btn-success " >Add New</a></div>
                        </div>
                      </div>
                    </div>
               </div>
               <div class="custom_field"></div>
               <div class="container-fluid pt-2">
                          <div class="row" >
                            <div class="col-md-12 text-center" >
                                <div class="form-group"><button type="submit" class="btn btn-info">Submit</button></div>
                            </div>
                        </div>
                </div>
             </form>
        </div>
 </div>
 
 </div>

@endsection

@section('js')

  <script src="{{asset('admin/plugins/select/js.js')}}"></script>
  <script>
   $(document).ready(function () {
         $('.example-getting-started').multiselect();
   });
  </script>

<script>
    $(document).ready(function () {


      var index = 0 ;
      $('.custom_field').on("click", ".remove-icon" , function() {
            $(this).parent().remove();
      });


      $('.add-icon').on('click', function () {
            index = index + 1;
            
            $(".custom_field").append(`<div class="card my-2">
                        <div style="padding: 0px 18px;" class="card-body">
                            <div class="py-3  container-fluid" >
                                <div class="row" >
                                    <div class="col-md-3" >
                                        <div class="form-group">
                                            <label for="simpleinput">Quality</label>
                                            <select required class="form-control" name="items[${index}][quality]" >
                                            @foreach(Con::qualities() as $key)
                                              <option>{{$key}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5" >
                                        <div class="form-group">
                                            <label for="simpleinput">Description</label>
                                            <input required name="items[${index}][description]" type="text"  class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-2" >
                                      <label for="simpleinput">Rolls</label>
                                      <input required  type="number" name="items[${index}][roll]" class="form-control" value="0" >
                                    </div>
                                    <div class="col-md-2" >
                                      <label for="simpleinput">Weight</label>
                                      <input required  type="number" name="items[${index}][weight]" step=".01" class="form-control" value="0" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="remove-icon text-danger " ><i class="fas fa-window-close  fa-2x "></i></a>
                      </div>`);
        });

        
        
    });
</script>
@endsection