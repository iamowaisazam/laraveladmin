@extends('admin.layouts.admin')
@section('title','Purchase Receipt')
@section('css')

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
                <h4 class="mb-0 font-size-18">Purchase Receipt</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                      <li class="breadcrumb-item active"> purchases-receipt</li>
                    </ol>
                </div>
            </div>
        </div>
      </div>
    <!-- end page title -->

    <?php $purchase = $receipt->purchase; ?>

    <div class="row">
      <div class="col-12">
        <form class="myform" method="post" action="{{route('admin.purchase-receipts.update',$receipt->id)}}" > 
          @csrf 
        
        <div class="card">
            <div class="card-body">
              <div class="container-fluid">
                  <div class="row">
                      <div class="col-6 align-self-center "><h4 class=" m-0 card-title">Edit</h4></div>
                      <div class="col-6 text-right ">
                        <a class="btn btn-primary" 
                          href="{{route('admin.purchase-receipts.index')}}">Back</a>
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
                    <h4 class="card-title">Purchase Order Details</h4>
                  </div>
                </div>
                <div class="row" > 
                    <div class="col-md-10" >
                        <label for="simpleinput">Product</label>    
                    </div>
                    <div class="col-md-2 text-center " >
                        <label for="simpleinput">Quantity</label>
                    </div>
                </div>
                  @if(count($receipt->purchase->items) > 0 )
                         @foreach($purchase->items as $key => $item )
                               <div class="row py-1" > 
                                  <div class="col-md-10" >
                                    <input readonly value="{{$item->product->title}}" type="text" class="form-control" />
                                  </div>
                                  <div class="col-md-2" >
                                    <input  readonly value="{{$item->qty}}" class="form-control" />
                                  </div>
                              </div>
                          @endforeach
                  @endif
              </div>
            </div>
        </div>
        

       
        <div class="card">
          <div class="card-body">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12"><h4 class="card-title">Receipt Details</h4></div>
              </div>
              <div class="row" >
                <div class="col-md-3" >
            		 <div class="form-group">
            			<label for="simpleinput">Lot No </label>
            			<div class="input-group">
            			  <div class="input-group-prepend">
            				<span class="input-group-text" >PR-{{$purchase->date->format('ym')}}</span>
            			  </div>
            			  <input required type="number" name="serial_no" class="form-control" value="{{ str_pad(intval($purchase->serial), 3, '0', STR_PAD_LEFT) }}" >
            			</div>
            			
            			 @if($errors->has('serial_no'))
            			  <div class="error text-danger">{{ $errors->first('serial_no') }}</div>
            			 @endif
            		</div>
                </div>
                <div class="col-md-3" >
                    <label for="simpleinput">Date</label>
                    <input required type="datetime-local" name="date" value="{{date('Y-m-d\TH:i', strtotime($receipt->date))}}" class=" form-control" />
                </div>
                <div class="col-md-3" >
                    <label for="simpleinput1">Due Date</label>
                    <input type="date" name="due_date" value="{{$receipt->due_date->format('Y-m-d')}}"  class="form-control" />     
                </div>
                <div class="col-md-3" >
                    <label>Vendor Name</label>
                    <input readonly type="text" value="{{$purchase->vendor->name}}"  class="form-control" />
                </div>
                
                <div class="col-md-12" >
                    <label>Vendor Address</label>
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
                  <div class="col-12"><h4 class="card-title">Product Details</h4></div>
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
                  
                  <div class="line-items" >
                      @foreach($receipt->items as $key => $item )
                        <div class="row py-1" > 
                              <input type="hidden" name="items[{{$key}}][id]" value="{{$item->id}}" />
                              <div class="col-md-5" >
                                <input readonly value="{{$item->product->title}}" type="text" class="form-control" />
                              </div>
                              
                              <div class="col-md-2" >
                                <input name="items[{{$key}}][qty]" value="{{$item->qty}}" type="number" step=".01"  class="qty form-control" />
                              </div>
                              
                              <div class="col-md-2" >
                                <input name="items[{{$key}}][price]" value="{{$item->rate}}" step=".01" type="number" class="price form-control" />
                              </div>

                              <div class="col-md-2" >
                                <input readonly type="number" value="{{$item->total}}" class="total form-control" />
                              </div>

                              <div class="col-md-1 text-center " >
                                  <input class="delete_item btn btn-danger" value="Delete" type="button"   />
                              </div>

                          </div>
                        @endforeach
                    </div>
                    <div class="row" >   
                        <div class="pt-4 col-md-12 text-center " >
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
@endsection
@section('js')

<script>

  $(document).ready(function() {

      $('input').change(function(){
            $('.line-items').children().each(function () {
              let qty =  $(this).find('.qty').val() | 0;
              let pp = $(this).find('.price').val() | 0;
              $(this).find('.total').val(pp * qty);
            });
      });

      $('.line-items').on("click", ".delete_item" , function() {
         $(this).parent().parent().remove();
      });

  });
</script>
@endsection