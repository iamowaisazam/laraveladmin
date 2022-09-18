@extends('admin.layouts.admin')
@section('title','Lots Reprocess')
@section('css')
<link href="{{asset('admin/plugins/select/css.css')}}" rel="stylesheet" type="text/css" />
<style>
      .remove-icon{
            position: absolute;
            right: 0px;
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
                      <h4 class="mb-0 font-size-18">Lots Reprocess</h4>
                      <div class="page-title-right">
                          <ol class="breadcrumb m-0">
                              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                              <li class="breadcrumb-item active"> Lots Reprocess</li>
                          </ol>
                      </div>
                  </div>
              </div>
          </div>
      <!-- end page title -->


      <div class="row">
        <div class="col-12">
            <form  method="post" action="{{route('admin.lots-reprocess.update',$module->id)}}"  >
                @csrf
                
               <div class="card">
                  <div class="card-body">
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-6  ">
                            <h4 class="card-title">Edit</h4>
                          </div>
                          <div class="col-6 text-right ">
                            <a href="{{route('admin.lots-reprocess.index')}}" class="btn btn-primary" >Back</a>
                          </div>
                        </div>
                      </div>
                        <div class="py-3 container-fluid" >
                            <div class="row" >
                              <div class="col-md-3" >
                                  <div class="form-group">
                                    <label for="simpleinput">Reference Lot</label>
                                    <input value="{{$module->ref->serial_no}}" readonly type="text" class="form-control" />
                                </div>
                               </div>
                               
                                <div class="col-md-3" >
                                     <div class="form-group">
                                        <label for="simpleinput">Lot No</label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text" >RP-{{$module->date->format('ym')}}</span>
                                          </div>
                                          <input required type="number" name="serial_no" class="form-control" value="{{ str_pad(intval($module->serial), 3, '0', STR_PAD_LEFT) }}" >
                                        </div>
                                        
                                         @if($errors->has('serial_no'))
                                          <div class="error text-danger">{{ $errors->first('serial_no') }}</div>
                                         @endif
                                    </div>
                                </div>
                                
                                <div class="col-md-3" >
                                     <div class="form-group">
                                        <label for="simpleinput">Receive Date</label>
                                        <input name="date" type="date"  class="form-control" value="{{$module->date->format('Y-m-d')}}" />
                                     </div>
                                </div>
                                
                                 <div class="col-md-3" >
                                     <div class="form-group">
                                        <label for="simpleinput">Issue Date</label>
                                        <input  name="issue_date" type="date" value="{{ $module->issue_date ? $module->issue_date->format('Y-m-d') : '' }}"  class="form-control" />
                                     </div>
                                </div>
                                
                                <div class="col-md-3" >
                                     <div class="form-group">
                                        <label for="simpleinput">Customer</label>
                                        <select name="customer_id" class="form-control" >
                                           @foreach(Con::customers() as $customer)
                                            <option @if($module->customer_id == $customer->id ) {{'selected'}}  @endif value="{{$customer->id}}" >{{$customer->name}}</option>
                                           @endforeach
                                        </select>
                                     </div>
                                </div>
                                
                                <?php 
                                  $process = explode(",",$module->lot_process); 
                                ?>
                                <div class="col-md-3" >
                                     <div class="form-group">
                                        <label for="simpleinput">Process</label> <br>
                                          <select class="example-getting-started form-control" name="lot_process[]" multiple >
                                            @foreach(Con::lot_process() as $item)
                                              <option @if(in_array($item->id, $process)) {{'selected'}}  @endif  value="{{$item->id }}" >{{$item->title}}</option>  
                                            @endforeach
                                          </select>
                                     </div>
                                </div>
                                
                                <div class="col-md-3" >
                                     <div class="form-group">
                                        <label for="simpleinput">Party challan #</label>
                                        <input value="{{$module->party_challan}}" name="party_challan" type="text"  class="form-control" />
                                     </div>
                                </div>
                                
                                <div class="col-md-3" >
                                     <label for="simpleinput">Customer Weight kg / Roll</label>
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                          <select class="form-control" name="qty_type" >
                                              <option @if($module->qty_type == 'KG' ) {{'selected'}}  @endif >KG</option>
                                              <option @if($module->qty_type == 'ROLL' ) {{'selected'}}  @endif >ROLL</option>
                                          </select>
                                      </div>
                                      <input step=".01" value="{{$module->qty}}" name="qty" type="number" class="form-control" placeholder="Quantity" />
                                    </div>
                                </div>
                                
                                <div class="col-md-3" >
                                     <div class="form-group">
                                        <label for="simpleinput">Color</label>
                                        <input name="color" type="text"  class="form-control" value="{{$module->color}}" />
                                     </div>
                                </div>
                             
                                <div class="col-md-3" >
                                     <div class="form-group">
                                        <label for="simpleinput">Fabric Quality</label>
                                        <input value="{{$module->fabric_quality}}" name="fabric_quality" type="text"  class="form-control" />
                                     </div>
                                </div>
                                
                                <div class="col-md-3" >
                                     <div class="form-group">
                                        <label for="simpleinput">Party Job Number</label>
                                        <input value="{{$module->party_job_number}}" name="party_job_number" type="text"  class="form-control" />
                                     </div>
                                </div>
                            </div>
                        </div>
                    </div>
              </div>

              <div class="old-lot" >
                <?php $totalweight = 0; ?>
              @foreach($module->ref->qualities as $item)
              <?php $totalweight += $item['weight']; ?>
                <div class="card my-2">
                    <div style="padding: 0px 18px;" class="card-body">
                        <div class="py-3  container-fluid" >
                            <div class="row" >
                                <div class="col-md-3" >
                                    <div class="form-group">
                                        <label for="simpleinput">Quality</label>
                                        <input readonly type="text"  class="form-control" value="{{$item['quality']}}" />
                                    </div>
                                </div>
                                <div class="col-md-5" >
                                    <div class="form-group">
                                        <label for="simpleinput">Description</label>
                                        <input readonly type="text"  class="form-control" value="{{$item['description']}}" />
                                    </div>
                                </div>
                                <div class="col-md-2" >
                                  <label for="simpleinput">Rolls</label>
                                  <input  readonly class="form-control" value="{{$item['roll']}}" />
                                </div>
                                <div class="col-md-2" >
                                  <label for="simpleinput">Weight</label>
                                  <input readonly class="form-control" value="{{$item['weight']}}" />
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
             @endforeach
            </div>
         
              <div class="card">
                    <div class="card-body">
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-6 align-self-center "><h4 class="card-title mb-0">Lot Items</h4></div>
                          <div class="col-6 text-right ">
                            <button type="button" class="show-ref-lot text-white  btn btn-success ">Show Reference </button>
                            <a class="d-none add-icon text-white  btn btn-success ">Add New</a>
                          </div>
                        </div>
                      </div>
                    </div>
             </div>
             <div class="custom_field">
              @foreach($module->qualities as $key => $item)
              
                    <div class="card my-2">
                      <input type="hidden" name="items[{{$key}}][id]" value="{{$item->id}}" />
                        <div style="padding: 0px 18px;" class="card-body">
                            <div class="py-3  container-fluid" >
                                <div class="row" >
                                    <div class="col-md-3" >
                                        <div class="form-group">
                                            <label for="simpleinput">Quality</label>
                                            <select required class="form-control" name="items[{{$key}}][quality]" >
                                            @foreach(Con::qualities() as $keyy)
                                              <option @if($item['quality'] == $keyy) {{'selected'}} @endif >{{$keyy}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5" >
                                        <div class="form-group">
                                            <label for="simpleinput">Description</label>
                                            <input required name="items[{{$key}}][description]" type="text"  class="form-control" value="{{$item['description']}}" />
                                        </div>
                                    </div>
                                    <div class="col-md-2" >
                                      <label for="simpleinput">Rolls</label>
                                      <input required  type="number" name="items[{{$key}}][roll]" class="form-control" value="{{$item['roll']}}" >
                                    </div>
                                    <div class="col-md-2" >
                                      <label for="simpleinput">Weight</label>
                                      <input required step=".01" type="number" name="items[{{$key}}][weight]" class="weight form-control" value="{{$item['weight']}}" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="remove-icon text-danger " ><i class="fas fa-window-close  fa-2x "></i></a>
                      </div>
                   @endforeach
                </div>
                
                <div class="container-fluid pt-2">
                          <div class="row">
                            <div class="col-md-12 text-center ">
                                <div class="form-group"><button type="submit" class="form-submit btn btn-info">Submit</button></div>
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

      $('.show-ref-lot').click(function(){
            if($('.old-lot').css('display') == 'none') {
              $('.old-lot').show();
            }else{
              $('.old-lot').hide();
            }
      });


      var index = <?php echo count($module->qualities) ?>;
      //Delete   
      $('.custom_field').on("click", ".remove-icon" , function() {
          $(this).parent().remove();
      });
      
     
      $("body").on('change',"input",function(){ check(); });
      function check(){
          
          var cweight = <?php echo $totalweight; ?>;
          var totalWeight = 0;

          $('.custom_field').children().each(async function(){
                let main = $(this);
                let weight = $('.weight').val() | 0;
                totalWeight += weight;
          });

          if(totalWeight < cweight){
            $('.form-submit').prop('disabled', false);
          }else{
            $('.form-submit').prop('disabled', true);
          
          }
      }



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
                                    <input required  type="number" name="items[${index}][weight]" class="form-control" value="0" >
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