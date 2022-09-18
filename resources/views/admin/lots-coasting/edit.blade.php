@extends('admin.layouts.admin')
@section('title','Lot Coasting')
@section('css')

<link href="{{asset('admin/plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
  <style>

      .normal-btn {
        background: white;
        border: none;
      }
      
      .remove-icon{
            position: absolute;
            right: 0px;
            top: -1px;
      }
      
      .select2-container{
          width:100%!important;
      }
      
      
      .select2-selection--single{
         height: 39px !important;
         padding: 4px 0px !important;
      }
      
      .stock-warning{
        margin: 0px;
        text-align: center;
        background: red;
        color: white;
        font-size: 15px;
        padding: 6px 0px;
      }

      .multiselect-native-select .btn-group{
          border: 1px solid #817e7e6e;
          width: 100%;
      }

      .example-getting-started{
        display: none;
      }

      .example-getting-started1{
        display: none;
      }

      /* .example-getting-started li,.example-getting-started li{

      } */

      .multiselect-container li{
        margin-left: 10px;  
      }

      

  </style>
@endsection
@section('content')
 <div class="container-fluid">

      <!-- start page title -->
        <div class="row">
          <div class="col-12">
              <div class="page-title-box d-flex align-items-center justify-content-between">
                  <h4 class="mb-0 font-size-18">Lot Coasting</h4>
                  <div class="page-title-right">
                      <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">lot-coasting</li>
                      </ol>
                  </div>
              </div>
          </div>
        </div>
      <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <form  method="post" action="{{route('admin.lots-coasting.submit',$module->id)}}"   >
                    @csrf
                    <div class="mb-3 card">
                        <div class="card-body">
                          <div class="container-fluid">
                            <div class="row">
                              <div class="col-6 align-self-center"><h4 class="m-0 card-title">Lot Items</h4></div>
                              <div class="col-6 text-right "><a  onClick="$('#exampleModalCenter').modal('show');" class="add-icon text-white  btn btn-success " >Add New</a></div>
                            </div>
                          </div>
                        </div>
                   </div>
                   <div class="custom_field">
                       @foreach($module->item as $key => $item)
                            <div class="mb-3 card" data-card="{{$key}}">
                                <div class="card-body">
                                <div class="container-fluid" >
                                  <div class="row pt-3" >
                                    <div class="col-md-3" >
                                        <div class="form-group">
                                            <input type="hidden" name="items[{{$key}}][product_id]" class="product_id" value="{{$item->product_id}}" />
                                            <input name="items[{{$key}}][id]" type="hidden" value="{{$item->id}}" />
                                            <label for="simpleinput">Description</label>
                                            <input readonly value="{{$item->product->types->title}}" class="form-control"  />
                                        </div>
                                    </div>
                                    <div class="col-md-3" >
                                        <div class="form-group">
                                            <label for="simpleinput">Product</label>
                                            <input readonly required value="{{$item->product->title}}" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-3" >
                                        <label for="simpleinput">Rate</label>
                                        <input required min="0" step=".01" type="number" name="items[{{$key}}][rate]" class="trigger rate form-control" value="{{$item->rate}}" >
                                    </div>
                                    <div class="col-md-3" >
                                        <label for="simpleinput">Total</label>
                                        <input readonly name="items[{{$key}}][total]" class="subtotal form-control" value="{{$item->total}}"  >
                                    </div>
                                </div>
                                 <div class="row">
                                        <div class="col-md-12" >
                                            <label>Weight</label>
                                          <input required style="width: 97%;display: inline;" placeholder="weight"
                                          name="items[{{$key}}][weight]" class="weight_trigger weight form-control" value="{{$item->weight}}" >
                                        </div>
                                  </div>
                                  <?php  
                                      $weights = explode(",",$item->additional_weight); 
                                    ?>
                                  <div data-id="{{$key}}" class="weight-container " >
                                       @foreach($weights as $keyWeight => $weight)
                                       @if($weight != '')
                                       <div class="pt-2" >
                                           <input style="width: 97%;display:inline;" placeholder="weight" required  
                                            name="items[{{$key}}][additional_weight][{{$keyWeight}}]" class="weight_trigger additional_weight form-control" value="{{$weight}}"  >
                                           <a class="remove-weight px-2 bg-white" ><i class="fa fa-times"></i></a>
                                       </div>
                                       @endif
                                       @endforeach
                                  </div>
                                  <div class="pt-2 text-center" >
                                        <a class="add-weight px-2 bg-white" ><i class="fa fa-plus"></i></a>
                                  </div>
                                </div>
                            </div>
                            <a  class="remove-icon text-danger"><i class="fas fa-window-close fa-2x"></i></a>
                            <p style="display: none;"  class="stock-warning" >Product Out Of Stock</p>
                        </div>
                           
                      @endforeach
                   </div>

                   <div class="additional field">
                      <div class="card">
                          <div class="card-body">
                            <div class="container-fluid">
                              <div class="row">
                                <div class="col-12">
                                  <h4 class="card-title">Additional Fields</h4>
                                </div>
                              </div>
                              <div class="row">
                                    <div class="col-md-3" >
                                      <div class="form-group">
                                        <label for="simpleinput">Production Date</label>
                                        <input type="date" name="production_date" class="form-control" value="{{$module->production_date->format('Y-m-d')}}" />
                                      </div>
                                    </div>
                                    
                                    <?php $entry = explode(',',$module->shift_entry); ?>
                                    <div class="col-md-3" >
                                      <div class="form-group">
                                        <label for="simpleinput">Shift Entry</label>
                                        <select multiple name="shift_entry[]" class=" example-getting-started">
                                          @foreach(Con::shifts() as  $shifts)
                                              <option @if(in_array($shifts,$entry)) {{'selected'}} @endif >{{$shifts}}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>
                                    <?php $machiness = explode(',',$module->machines); ?>
                                    <div class="col-md-3" >
                                      <div class="form-group">
                                        <label for="simpleinput">Machines</label>
                                        <select multiple name="machines[]" class="example-getting-started1">
                                          @foreach(Con::machines() as $machine)
                                              <option @if(in_array($machine->title,$machiness)) {{'selected'}} @endif >{{$machine->title}}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>

                                    
                                    <div class="col-md-3" >
                                      <div class="form-group">
                                        <label for="simpleinput">Material</label>
                                        <input required min="0" step=".01"  type="number" name="material" class="trigger material form-control" value="{{$module->material}}" />
                                      </div>
                                    </div>

                                    <div class="col-md-3" >
                                      <div class="form-group">
                                        <label for="simpleinput">Labour</label>
                                        <input required min="0" step=".01"  type="number" name="labour" class="trigger labour form-control" value="{{$module->labour}}" />
                                      </div>
                                    </div>

                                    <div class="col-md-3" >
                                      <div class="form-group">
                                        <label for="simpleinput">O/H</label>
                                        <input required min="0" step=".01"  type="number" name="oh" class="trigger oh form-control" value="{{$module->oh}}" />
                                      </div>
                                    </div>

                                    <div class="col-md-3" >
                                      <div class="form-group">
                                        <label for="simpleinput">ETC</label>
                                        <input required min="0" step=".01" type="number" name="etc" class="trigger etc form-control" value="{{$module->etc}}" />
                                      </div>
                                    </div>

                                    <div class="col-md-3" >
                                      <div class="form-group">
                                        <label for="simpleinput">Grand Total</label>
                                        <input readonly name="gtotal" value="{{$module->gtotal}}" class="gtotal form-control" />
                                      </div>
                                    </div>

                                    @if($module->ref)
                                      <div class="col-md-3" >
                                        <div class="form-group">
                                          <label for="simpleinput">Fresh Lot Total</label>
                                          <input readonly value="{{$module->ref->gtotal}}" class="reftotal form-control" />
                                        </div>
                                      </div>
                                      
                                      <div class="col-md-3" >
                                        <div class="form-group">
                                          <label for="simpleinput">Final Total</label>
                                          <input readonly value="{{$module->ref->gtotal + $module->gtotal}}" class="ftotal form-control" />
                                        </div>
                                      </div>
                                    @endif

                              </div>
                            </div>
                        </div> 
                      </div>
                   </div>

                  <div class="container">
                          <div class="row" >
                            <div class="col-md-12 text-center " >
                                <div class="form-group"><button type="submit" class="form-send btn btn-info">Submit</button></div>
                            </div>
                        </div>
                  </div>
             </form>
        </div>
        
        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                  <form class="add-new-product" >
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add New Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                            <div class="form-group" >
                            <select name="product" required class="current-product js-example-basic-single " >
                                <option disabled >Select Product</option>
                                @foreach($products as $product)
                                <option data-id="{{$product->id}}"  data-type="{{$product->types->title}}" data-name="{{ $product->title}}" >{{$product->types->title}} - {{ $product->title}}</option>
                                @endforeach
                            </select>
                            </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                  </form>
                </div>
              </div>
            </div>
     
            
     </div>
 </div>
@endsection
@section('js')

  <script src="{{asset('admin/plugins/select2/select2.min.js')}}"></script>
  <script src="{{asset('admin/plugins/select/js.js')}}"></script>

  <script>
    $(document).ready(function () {

        $('.js-example-basic-single').select2();     

        $('.example-getting-started').multiselect();
        $('.example-getting-started1').multiselect();
   
        var index = <?php echo count($module->item) ?> ;
        
        $('.add-new-product').submit(function(e){
            e.preventDefault(); 
            
            let currentproduct = $(`.current-product option:selected`);
            let producttype = currentproduct.attr('data-type');
            let productname = currentproduct.attr('data-name');
            let productid = currentproduct.attr('data-id');
           
            let response = true;
            if($('.product_id')[0]){
               $('.product_id').each(function(index){
                  if(productid == $(this).val()){
                      response = false;
                      toastr.warning('Cannot Add Duplicate Product');
                  }
              });
            }
            
            if(response == false){
                return false;       
            }
           
            index = index + 1;
            $(".custom_field").append(`
                  <div data-card="${index}" class="card">
                        <div  class="card-body">
                        <div class="container-fluid" >
                          <div class="row pt-3" >
                            <div class="col-md-3" >
                                <div class="form-group">
                                    <label for="simpleinput">Description</label>
                                    <input readonly value="${producttype}" class="form-control"  />
                                </div>
                            </div>
                            <div class="col-md-5" >
                                <div class="form-group">
                                    <label for="simpleinput">Product</label>
                                    <input type="hidden" value="${productid}" class="product_id form-control" name="items[${index}][product_id]" />
                                    <input readonly value="${productname}" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-2" >
                                <div class="form-group">
                                    <label for="simpleinput">Price</label>
                                    <input required min="1" type="number" class="trigger rate form-control" name="items[${index}][rate]" step=".01" />
                                </div>
                            </div>
                            <div class="col-md-2" >
                                <div class="form-group">
                                    <label for="simpleinput">Total</label>
                                    <input readonly class="subtotal form-control" name="items[${index}][total]" />
                                </div>
                            </div>
                          </div>
                          <div class="row"> 
                            <div class="col-md-12" >
                                    <label for="simpleinput">Weight</label>
                                    <input required value="1" class="weight_trigger weight form-control" name="items[${index}][weight]" />
                            </div>
                          </div>

                          <div data-id="${index}" class="weight-container"></div>
                          <div class="pt-2 text-center" ><a class="add-weight px-2 bg-white" ><i class="fa fa-plus"></i></a></div>

                          </div>
                        </div>
                      <a  class="remove-icon text-danger"><i class="fas fa-window-close fa-2x"></i></a>
                      <p style="display:none;" class="stock-warning" >Product Out Of Stock</p>
                  </div>`);
                
                $('#exampleModalCenter').modal('hide');

              weightChange(index);

        });
        

        // Delete Items
        $('.custom_field').on("click", ".remove-icon" , function() {
            $(this).parent().remove();
            calculate();
        });
    
    
        //Remove Weights
        $('.custom_field').on("click", ".remove-weight" , function() {
            let ppid = $(this).parent().parent().parent().parent().parent().attr('data-card');
            $(this).parent().remove();
            weightChange(ppid);
            
        });
        
        
        //Add Weight
        $('.custom_field').on("click", ".add-weight" , function() {

           let myid = $(this).parent().parent().find('.weight-container').attr("data-id");
           let dd = $(this).parent().parent().find('.weight-container').append(`<div class="pt-2" ><input style="width: 97%;display:inline;" placeholder="weight" required type="text" name="items[${myid}][additional_weight][${generateString(2)}]" class="weight_trigger additional_weight form-control" value="0"  >
           <a class="remove-weight px-2 bg-white" ><i class="fa fa-times"></i></a></div>`);
          
           weightChange($(this).parent().parent().parent().parent().attr('data-card'));
        });

        $("body").on('change',".trigger",function(){ calculate(); });
        $("body").on('change',".weight_trigger",async function(){ 
            let pp = $(this).parent().parent().parent().parent().parent();
            weightChange(pp.attr('data-card'));
        });

        const weightChange = async (id) => {

              let parent = $(`[data-card="${id}"]`);
              let productId = parent.find('.product_id').val();
              let weight = parseFloat(parent.find('.weight').val());
              weight = isNaN(weight) ? 0 : weight; 
              let weightcontainer = parent.find('.weight-container');
              
              weightcontainer.children().each(function(index){
                let additional_weight =  parseFloat($(this).find('.additional_weight').val()); 
                additional_weight = isNaN(additional_weight) ? 0 : additional_weight; 
                weight += additional_weight;
              });
              
              let response = await getPrice(productId,weight);
              if(response.price){

                    parent.find('.rate').val(response.price.toFixed(2));
                    parent.find('.stock-warning').text('');
                    parent.find('.stock-warning').hide();
                    calculate();

              }else{
                    
                    calculate();
                    parent.find('.stock-warning').show();
                    parent.find('.stock-warning').text('Product Out Of Stock');
            
              }
        
        } 

        function calculate(){

                  let total = 0;
                  let loop =  $('.custom_field').children().each(async function(){

                      let main = $(this);
                      let weight = parseFloat(main.find('.weight').val());
                       weight = isNaN(weight) ? 0 : weight; 
                      let weightcontainer = main.find('.weight-container');
                      weightcontainer.children().each(function(index) {
                      let additional_weight =  parseFloat($(this).find('.additional_weight').val()); 
                      additional_weight = isNaN(additional_weight) ? 0 : additional_weight; 
                          
                          weight += additional_weight;
                      }); 
                  
                      let rate = parseFloat(main.find('.rate').val());
                      let step = parseFloat(rate * weight);
                      let subtotal = main.find('.subtotal').val(step.toFixed(2));
                      total += step;
                  });
                  
                 
                  var material = parseFloat($('.material').val());
                  material = isNaN(material) ? 0 : material; 
                  
                  var labour = parseFloat($('.labour').val());
                  labour = isNaN(labour) ? 0 : labour; 
                  
                  var oh = parseFloat($('.oh').val());
                  oh = isNaN(oh) ? 0 : oh; 
                  
                  var etc = parseFloat($('.etc').val());
                  etc = isNaN(etc) ? 0 : etc;
                  
                  total += material;
                  total += labour;
                  total += oh;
                  total += etc;
                  
                  $('.gtotal').val(total);

                  if($('.ftotal')[0]){

                    let reftotal = $('.reftotal').val() | 0; 
                    let finaltotal = total + reftotal;
                    $('.ftotal').val(finaltotal);

                  }
                  
        }
        
        calculate();

    });
  </script>
@endsection