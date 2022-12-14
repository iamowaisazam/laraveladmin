@extends('admin.layouts.admin')
@section('title','Good Receipts')
@section('css')

<link href="{{asset('admin/plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />

  <style>
      .normal-btn {
        background: white;
        border: none;
      }
  </style>

@endsection
@section('content')
 <div class="container-fluid">

    
    <!-- start page title -->
      <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Good Receipts</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                      <li class="breadcrumb-item active"> Good Receipts</li>
                    </ol>
                </div>
            </div>
        </div>
      </div>
    <!-- end page title -->
     
    <div class="mb-2 bg-white container-fluid">
      <form class="pt-3" action="{{route('admin.purchase_receipts.create')}}" method="get">
        <div class="row" >
            <div class="col-md-11" >
                <div class="form-group">
                <select required class="js-example-basic-single form-control"  name="purchase_id" >
                    <option disabled >Select Purchase</option>
                    @foreach ($purchases as $item)
                      @if($item->receipt == null)
                         <option @if(isset($_GET['purchase_id']) && $_GET['purchase_id'] == $item->id) {{'selected'}} @endif  value="{{$item->id}}">#{{$item->id}} </option>
                      @endif
                    @endforeach
                    </select>
                  </div>       
                </div>
                <div class="col-md-1" >
                  <div class="form-group"><button class="btn btn-success" >Search</button></div>       
                </div>
            </div>
        </form>
      </div>

    <div class="row">
      <div class="col-12">

        @if(isset($purchase))
        
    
        
        <form class="myform"  method="post" action="{{route('admin.purchase_receipts.store')}}"  >
          <input name="purchase_id" type="hidden" value="{{$purchase->id}}" class=" form-control" />
          @csrf
          
                <div class="card">
                    <div class="card-body">
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-12">
                            <h4 class="card-title">Receipt Details</h4>
                          </div>
                        </div>
                        <div class="row" >
                          <div class="col-md-2" >
                              <label for="simpleinput">Date</label>
                              <input required type="datetime-local" name="date" class="form-control" />
                               @if($errors->has('date'))
        			                <div class="error text-danger">{{ $errors->first('date') }}</div>
        			            @endif
                          </div>
                          <div class="col-md-2" >
                              <label for="simpleinput">Due Date</label>
                              <input type="date" name="due_date"  class=" form-control" />
                          </div>
                          <div class="col-md-3" >
                              <label for="simpleinput">Vendor Name</label>
                              <input readonly type="text" value="{{$purchase->vendor->name}}" class=" form-control" />     
                          </div>
                          <div class="col-md-5" >
                              <label for="simpleinput">Vendor Address</label>
                              <input readonly type="text" value="{{$purchase->vendor->address}}"  class="form-control" />   
                          </div>
                      </div>
                      </div>
                    </div>
                </div>
        
    
                    <div class="card">
                      <div class="card-body">
                          <div class="container-fluid">
                            <div class="row">
                              <div class="col-12">
                                <h4 class="card-title">Product Details</h4>
                              </div>
                            </div>
                              <div> 
                                  <div class="row" > 
                                        <div class="col-md-5" >
                                            <label for="simpleinput">Product</label>    
                                        </div>
                                        <div class="col-md-2 text-center " >
                                            <label for="simpleinput">Quantity</label>
                                        </div>
                                        <div class="col-md-2 text-center " >
                                          <label for="simpleinput">Rate</label>
                                        </div>
                                        <div class="col-md-2 text-center " >
                                          <label for="simpleinput">Total</label>
                                        </div>
                                        <div class="col-md-1 text-center " >
                                          <label for="simpleinput">Action</label>
                                        </div>
                                  </div>
                              </div>    
                              <!--Item Header-->
                              
                          <div class="line-items" >
                              @if(count($purchase->items) > 0 )
                                     @foreach($purchase->items as $key => $item )
                                           <div class="row py-1" > 
                                              <div class="col-md-5" >
                                                <input name="items[{{$key}}][id]" value="{{$item->attribute->id}}" type="text" class="d-none form-control" />
                                                <input readonly value="{{$item->attribute->title}}" type="text" class="form-control" />
                                              </div>
                                              
                                              <div class="col-md-2" >
                                                <input name="items[{{$key}}][qty]" step=".01" value="{{$item->qty}}" type="number"  class="qty form-control" />
                                              </div>
                                              
                                              <div class="col-md-2" >
                                                <input name="items[{{$key}}][rate]" min="1" value="{{$item->price}}" step=".01" type="number" class="price form-control" />
                                              </div>
                    
                                              <div class="col-md-2" >
                                                <input readonly type="number" value="{{$item->qty * $item->price}}" step=".01" class="total form-control" />
                                              </div>
                    
                                              <div class="col-md-1 text-center " >
                                                <input class="delete_item btn btn-danger" value="Delete" type="button"   />
                                              </div>
                                          </div>
                                      @endforeach
                             @else
                                  <p  class="pt-5  text-center"> No Items Found</p>
                            @endif
                            </div>
                                <div class="pt-4 row" >   
                                  <div class="col-md-12 text-center " >
                                        <button type="submit" class="btn btn-info">Submit</button>
                                  </div>
                                </div>
                            </div>
                          </div>
                      </div>
          
         </form>
        @endif

      </div>
  </div>
  
 </div>
@endsection

@section('js')

  <script src="{{asset('admin/plugins/select2/select2.min.js')}}"></script>
  <script>
      $('.js-example-basic-single').select2();
  </script>
  

    @if(isset($_GET['purchase_id']))
    <script>        
      $(document).ready(function() {

             $('input').change(function(){
    
                  $('.line-items').children().each(function () {
                    
                    let qty =  $(this).find('.qty').val() | 0;
                    let pp = $(this).find('.price').val() | 0;
                    $(this).find('.total').val(pp * qty);
    
                    $(this).find('.delete-button').click(function(){
                         
                        
                    });
    
                  });
    
            }).change();
            
             
            $('.line-items').on("click", ".delete_item" , function() {
                
                $(this).parent().parent().remove();
            });
            
            
            //$('input').trigger('change');


      });
    </script>
    @endif

@endsection