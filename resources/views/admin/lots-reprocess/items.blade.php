@extends('admin.layouts.admin')
@section('title','Lots Reprocess')
@section('css')

<link href="{{asset('admin/plugins/select/css.css')}}" rel="stylesheet" type="text/css" />

<style>
    .remove-icon{
        position: absolute;
        right: 0px;
        top: 0px;
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
                <form  method="post" action="{{route('admin.lots-reprocess.items_submit',$module->id)}}"  >
                    @csrf
                    <div class="mb-3 card">
                        <div class="card-body">
                          <div class="container">
                            <div class="row">
                              <div class="col-6"><h4 class="card-title">Lot Items</h4></div>
                              <div class="col-6 text-right "><a  class="add-icon text-white  btn btn-success " >Add New</a></div>
                            </div>
                          </div>
                        </div>
                   </div>
                   <div class=" custom_field ">
                       @foreach ($module->item as $key => $item)
                            <div class="mb-3 card">
                                <div class="card-body">
                                <div class="container" >
                                  <div class="row pt-3" >
                                    <div class="col-md-3" >
                                        <div class="form-group">
                                            <input name="items[{{$key}}][id]" type="hidden" value="{{$item->id}}" />
                                            <label for="simpleinput">Description</label>
                                            <select required class="types type{{$key}} form-control" >
                                                @foreach(Con::types() as $types)
                                                <option @if($item->product->types->id == $types->id) {{'selected'}} @endif  value="{{$types->id}}" >{{$types->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3" >
                                        <div class="form-group">
                                            <label for="simpleinput">Color</label>
                                            <select required class="colors form-control" name="items[{{$key}}][product_id]" >
                                                @foreach ($item->product->types->product as $pp)
                                                    <option @if($pp->id == $item->product_id) {{'selected'}} @endif value="{{$pp->id}}">{{$pp->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3" >
                                        <label for="simpleinput">Rate</label>
                                        <input required  type="number" min="0"  name="items[{{$key}}][rate]" class="rate form-control" value="{{$item->rate}}" >
                                    </div>
                                    <div class="col-md-3" >
                                        <label for="simpleinput">Total</label>
                                        <input readonly required  type="number" name="items[{{$key}}][total]" class="subtotal form-control" value="{{$item->total}}"  >
                                    </div>
                                </div>
                                
                                  <div class="row " >
                                        <div class="col-md-12" >
                                            <label>Weight</label>
                                          <input style="width: 97%;display: inline;" placeholder="weight" required  type="number" 
                                          name="items[{{$key}}][weight]" min="0"  class="weight form-control" value="{{$item->weight}}" >
                                        </div>
                                  </div>
                                  <?php 
                                     $weights = explode(",",$item->additional_weight); 
                                  ?>
                                  <div data-id="{{$key}}" class="weight-container " >
                                       @foreach($weights as $keyWeight => $weight)
                                       <div class="pt-2" >
                                           <input style="width: 97%;display:inline;" placeholder="weight" required type="number" 
                                            name="items[{{$key}}][additional_weight][{{$keyWeight}}]" min="0"  class="additional_weight form-control" value="{{$weight}}"  >
                                           <a class="remove-weight px-2 bg-white" ><i class="fa fa-times"></i></a>
                                       </div>
                                       @endforeach
                                  </div>
                                  <div class="pt-2 text-center" >
                                        <a class="add-weight px-2 bg-white" ><i class="fa fa-plus"></i></a>
                                  </div>
                                </div>
                            </div>
                            <a  class="remove-icon text-danger"><i class="fas fa-window-close fa-2x"></i></a>
                        </div>
                           
                      @endforeach
                   </div>

                   <div class="additional field">
                      <div class="card">
                          <div class="card-body">
                            <div class="container">
                              <div class="row">
                                <div class="col-12">
                                  <h4 class="card-title">Additional Fields</h4>
                                </div>
                              </div>
                              <div class="row">
                                    <div class="col-md-2" >
                                      <div class="form-group">
                                        <label for="simpleinput">Material</label>
                                        <input name="material" type="number" min="0"   class="material form-control" value="{{$module->material}}" />
                                      </div>
                                    </div>
                                    <div class="col-md-2" >
                                      <div class="form-group">
                                        <label for="simpleinput">Labour</label>
                                        <input name="labour" type="number" min="0"   class="labour form-control" value="{{$module->labour}}" />
                                      </div>
                                    </div>
                                    <div class="col-md-2" >
                                      <div class="form-group">
                                        <label for="simpleinput">O/H</label>
                                        <input name="oh" type="number" min="0"  class="oh form-control" value="{{$module->oh}}" />
                                      </div>
                                    </div>
                                    <div class="col-md-2" >
                                      <div class="form-group">
                                        <label for="simpleinput">ETC</label>
                                        <input name="etc" type="number" min="0"  class="etc form-control" value="{{$module->etc}}" />
                                      </div>
                                    </div>
                                    <div class="col-md-4" >
                                      <div class="form-group">
                                        <label for="simpleinput">Grand Total</label>
                                        <input readonly name="gtotal" value="{{$module->gtotal}}" type="text"  class="gtotal form-control" />
                                      </div>
                                    </div>
                              </div>
                            </div>
                        </div> 
                      </div>
                   </div>

                  <div class="container">
                          <div class="row" >
                            <div class="col-md-12" >
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
  
    const characters ='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    function generateString(length) {
        let result = ' ';
        const charactersLength = characters.length;
        for ( let i = 0; i < length; i++ ) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
    
        return result;
    }

  </script>

<?php echo '<script>var items = ' . json_encode($products) . ';</script>'; ?>
<script>
    $(document).ready(function () {
      
      $('.example-getting-started').multiselect();
          
      $("body").on('change', "input", function() { calculate(); });
      var index = <?php echo count($module->item) ?> ;
        
        // Add Items
        $('.add-icon').on('click',function (){
               index = index + 1;
               $(".custom_field").append(`
                            <div class="card">
                                <div class="card-body">
                                <div class="  container" >
                                  <div class="row pt-3" >
                                    <div class="col-md-3" >
                                        <div class="form-group">
                                            <label for="simpleinput">Description</label>
                                            <select required class="types type${index} form-control" >
                                                @foreach(Con::types() as $types)
                                                <option value="{{$types->id}}" >{{$types->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3" >
                                        <div class="form-group">
                                            <label for="simpleinput">Color</label>
                                            <select required class="colors form-control" name="items[${index}][product_id]"></select>
                                        </div>
                                    </div>
                                    <div class="col-md-3" >
                                        <label for="simpleinput">Rate</label>
                                        <input required min="0"  type="number" name="items[${index}][rate]" class="rate form-control" value="0" >
                                    </div>
                                    <div class="col-md-3" >
                                        <label for="simpleinput">Total</label>
                                        <input readonly  required  type="number" name="items[${index}][total]" class="subtotal form-control" value="0"  >
                                    </div>
                                  </div>
                                  <div class="row " >
                                        <div class="col-md-12" >
                                            <label>Weight</label>
                                          <input min="0" style="width: 97%;display: inline;" placeholder="weight" required  type="number" 
                                          name="items[${index}][weight]" class="weight form-control" value="0" >
                                        </div>
                                  </div>
                                  <div data-id="${index}" class="weight-container"></div>
                                  <div class="pt-2 text-center" ><a class="add-weight px-2 bg-white" ><i class="fa fa-plus"></i></a></div>
                                </div>
                            </div>
                            <a class="remove-icon text-danger"><i class="fas fa-window-close fa-2x"></i></a>
                        </div>`);
               
               $(`.type${index}`).trigger('change');
               calculate();
               
               $(`input[name="items[${index}][rate]"]`).focus();
        });
        
        
        // Delete Items
        $('.custom_field').on("click", ".remove-icon" , function() {
            $(this).parent().remove();
            calculate();
        });
    
        
        // OnChange Categoey
        $('.custom_field').on("change", ".types" , function() {
              let id = $(this).val();
              let dd = $(this);
              let select = dd.parent().parent().parent().find('.colors');
              select.empty();
              items.forEach(element => {
                if(id == element.type){
                  select.append(`<option value="${element.id}" >${element.title}</option>`);
                }
              });
        });
        
        
        //Remove Weights
        $('.custom_field').on("click", ".remove-weight" , function() {
            $(this).parent().remove();
            calculate();
        });
        
        
        //Add Weight
        $('.custom_field').on("click", ".add-weight" , function() {
            
           let myid = $(this).parent().parent().find('.weight-container').attr("data-id");
           let dd = $(this).parent().parent().find('.weight-container').append(`<div class="pt-2" ><input style="width: 97%;display:inline;" placeholder="weight" 
           required type="number" name="items[${myid}][additional_weight][${generateString(2)}]" class="additional_weight form-control" value="0"  >
           <a class="remove-weight px-2 bg-white" ><i class="fa fa-times"></i></a></div>`);
           calculate();
        });

        calculate();

        function calculate() {

              let total = 0;
              var loop =  $('.custom_field').children().each(function(){

                  var main = $(this);
                  var rate = parseInt(main.find('.rate').val() | 0 );
                  var weight = parseInt(main.find('.weight').val() | 0 );
                  var weightcontainer = main.find('.weight-container');
                  
                  weightcontainer.children().each(function(index) {
                   var additional_weight =  parseInt($(this).find('.additional_weight').val() | 0 ); 
                      weight += additional_weight;
                  });    
                  
                  let step = parseFloat(rate * weight);
                  var subtotal = main.find('.subtotal').val(step.toFixed(2));
                  total += step;
                  
             });


              var material = $('.material').val() | 0 ;
              var labour = $('.labour').val() | 0 ;
              var oh = $('.oh').val() | 0 ;
              var etc = $('.etc').val() | 0 ;
              
              total += parseInt(material);
              total += parseInt(labour);
              total += parseInt(oh);
              total += parseInt(etc);
              $('.gtotal').val(total);
        }



    });

</script>

@endsection