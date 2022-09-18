@extends('admin.layouts.admin')
@section('title',$type->title)
@section('css')
<link href="{{asset('admin/assets/css/select2.css')}}" rel="stylesheet" />
 <style>
        .normal-btn{
              background: white;
            border: none;
        }

      /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }

        /* Firefox */
        input[type=number] {
        -moz-appearance: textfield;
        }

        .normal-btn{
             background: white;
            border: none;
        }

        .invoice{
            border: 1px solid;
        }

        .invoice .card-body{
            padding: 0px;
        }

        /* invoice-top */

            .invoice-top{
                background-color: #3281f2;
                color: white;
                padding: 14px 0px;
            }

            .invoice-top p{
                margin: 0px;
            }

            
            /* Invoice Header */

            table{
                margin: auto;
                width: 100%;
                font-family: Arial, Helvetica, sans-serif;
                border-collapse: collapse;
            }

            table th{
                border: 1px solid #ddd;
                text-align: center;
                padding: 12px 0px;
                background-color: #3281f2;
                color: white;

            }

            table td{
                border: 1px solid #ddd;
                padding: 8px;
                color: black;
            }

            table th {
                padding-top: 12px 0px;
                text-align: left;
                background-color: #3281f2;
                color: white;
            }

            hr{
                margin-top: 20px;
                margin-bottom: 20px;
                border: 0;
                border-top: 1px solid #eee;
            }
            
              .sign {
                    padding-top: 5px;
                    font-weight: bold;
                    margin: auto;
                    border-top: 1px solid black;
                    width: 122px;
                    margin-top: 45px;
                    margin-left: auto;
                    margin-right: 50px;
            }

            .btn-little{
                background: none;
                border: none!important
            }

</style>
@endsection
@section('content')
<?php 
    if($order){
        $orderid = $order->id;
        $ordercounts = count($order->items);
    }else{
        $orderid = 0;
        $ordercounts = 0;
    }

    $colors = Con::colors();
    $sizes = Con::sizes();
   

?>
<div class="container-fluid">
    
    <!-- start page title -->
        <div class="row">
          <div class="col-12">
              <div class="page-title-box d-flex align-items-center justify-content-between">
                  <h4 class="mb-0 font-size-18">Purchase Order "{{$type->title}}"</h4>
                  <div class="page-title-right">
                      <ol class="breadcrumb m-0">
                          <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                          <li class="breadcrumb-item active"> purchase-orders</li>
                      </ol>
                  </div>
              </div>
          </div>
      </div>
    <!-- end page title -->

    <div class="row">
      <div class="col-12">
        <form method="post" action="{{route('admin.purchase_orders.sandles_update',$orderid)}}"  >
            @csrf
          <input type="hidden" name="type_id" value="{{$type->id}}" >
          <div class="card">
            <div class="card-body">
                <div class="container-fluid">
                      <div class="row" >
                          <div class="col-md-4" >
                            <div class="form-group">
                              <label for="simpleinput">Date</label>
                              <input required name="date" type="date" value="{{($order)?$order->date->format('Y-m-d'): ''}}"  class="form-control"/>
                               @if($errors->has('date'))
                                   <div class="error text-danger">{{ $errors->first('date') }}</div>
                               @endif
                             </div>       
                          </div>
                          <div class="col-md-4" >
                            <div class="form-group">
                                <label for="simpleinput">Article</label>
                                <select required name="article_id" class="article_id form-control">
                                    @if($order)
                                    <option value="{{$order->article_id}}">{{'SAS'.$order->product->category->initials.$order->product->article_no}}</option>
                                    @endif
                                </select>
                            </div>      
                          </div> 
                          <div class="col-md-4" >
                            <div class="form-group">
                                <label for="simpleinput">Vendor</label>
                                <select required name="vendor_id" class="vendor_id form-control">
                                    @if($order)
                                    <option value="{{$order->vendor_id}}">{{$order->vendor->name}}</option>
                                    @endif
                                </select>
                            </div>      
                          </div>     
                     </div>
                     <div class="row" >
                        <div class="col-md-11" >
                            <select  class="product_id js-example-basic-single form-control" ><option disabled >Select Product</option></select>
                        </div>
                        <div class="col-md-1" >
                              <button type="button" class="addproduct btn btn-success">Add</button>
                        </div>
                    </div>
                </div>
            </div>
         </div>

        <div class="card">
          <div class="card-body">
            <div class="container-fluid">
              <div class="row">
                <div class="col-6">
                  <h4 class="card-title">Order Items</h4>
                </div>
              </div>
            </div>          
            <div class="container-fluid">
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th style="text-align: center" >Sandles</th>
                                    <th style="text-align: center" >Remarks</th>
                                    <th style="text-align: center">Size</th>
                                    <th style="text-align: center">Color</th>
                                    <th style="text-align: center">Size</th>
                                    <th style="text-align: center">Qty</th>
                                    <th style="text-align: center">Rate</th>
                                    <th style="text-align: center">Total</th>
                                    <th style="text-align: center">Action</th>
                                </tr>        
                            </thead>
                            <tbody class="items-list">  
                                @if($order)   
                                @foreach($order->items as $key => $item)
                                <tr>
                                    <td>{{$item->attribute->title}}
                                        <input value="{{$item->attribute_id}}" name="items[{{$key}}][attribute_id]" type="hidden" />
                                        <input value="{{$item->id}}" name="items[{{$key}}][item_id]" type="hidden"/></td>
                                    <td style="width: 100px;">
                                        <input name="items[{{$key}}][remarks]" value="{{$item->remarks}}" class="form-control"/>
                                    </td>
                                    <td style="width: 140px;">
                                        <select name="items[{{$key}}][color]"  class="form-control" >
                                            @foreach ($colors as $color)
                                            <option @if($color->title == $item->color){{'selected'}} @endif >{{$color->title}}</option>    
                                            @endforeach
                                        </select>
                                    </td>
                                    <td style="width: 140px;">
                                        <select name="items[{{$key}}][size]"  class="form-control" >
                                            @foreach ($sizes as $size)
                                            <option @if($size->title == $item->size){{'selected'}} @endif >{{$size->title}}</option>    
                                            @endforeach
                                        </select>
                                    </td>
                                    <td style="width: 150px;">
                                        <input name="items[{{$key}}][description]" value="{{$item->description}}" class="form-control"/>
                                    </td>
                                    <td style="width: 82px;">
                                        <input name="items[{{$key}}][qty]" value="{{$item->qty}}" class="qty form-control"/>
                                    </td>
                                    <td style="width: 82px;">
                                        <input value="{{$item->price}}" name="items[{{$key}}][price]" class="rate form-control"/>
                                    </td>
                                    <td class="text-center total">0</td>
                                    <td class="text-center"><button type="button" class="delete_item btn-little"><i class="text-danger fa-2x fas fa-window-close"></i></button></td>
                                </tr>
                                @endforeach 
                                @endif                 
                            </tbody>
                     </table>
               </div>
                <div class="row" >   
                    <div class="col-md-12 pt-5 py-3 text-center" >
                          <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                </div>
              </div>
            </div>
          </div>
       </form>
     </div>
 </div>
@endsection
@section('js')
<script src="{{asset('admin/assets/js/select2.js')}}"></script>
<script>
    $(document).ready(function () {

        $(".vendor_id").select2({
            placeholder: "Search Vendor",
            minimumInputLength: 2,
            ajax: {
                url: "{{route('admin.vendors.search')}}",
                dataType: 'json',
                delay: 250,
                data: function (term, page) {
                    return {search:term.term}
                },
                processResults: function (response) {
                    return { results: response};
                },
                cache: true
            },
        });
        
         $(".article_id").select2({
            placeholder: "Search Article",
            minimumInputLength: 2,
            ajax: {
                url: "{{route('admin.products.article_search')}}",
                dataType: 'json',
                delay: 250,
                data: function (term, page) {
                    return {search:term.term}
                },
                processResults: function (response) {
                    return { results: response};
                },
                cache: true
            },
        });
        

       let type = '{{$type->id}}';
       let fd = $(".product_id").select2({
            placeholder: "Search Product",
            minimumInputLength: 2,
            ajax: {
                url: `{{route('admin.purchase_orders.search')}}?type=${type}`,
                dataType: 'json',
                delay: 250,
                data: function (term, page) {
                    return {search:term.term}
                },
                processResults: function (response) {
                    return { results: response};
                },
                cache: true
            },
        });
        
        


        fd.on("change", function (e) { 
        });

        let key = {{$ordercounts}};
        $('.addproduct').click(() => {
            key +=1;
            let productTitle = $('.product_id :selected').text();
            let productId = $('.product_id').val();

            if(productId != null){
                $('.items-list').append(`<tr>
                                    <td>${productTitle}
                                        <input value="${productId}" name="items[${key}][attribute_id]" type="hidden" />
                                    <td style="width: 140px;">
                                        <select name="items[${key}][color]"  class="form-control" >
                                            @foreach ($colors as $color)
                                            <option>{{$color->title}}</option>    
                                            @endforeach
                                        </select>
                                    </td>
                                    <td style="width: 140px;">
                                        <select name="items[${key}][size]"  class="form-control" >
                                            @foreach($sizes as $size)
                                            <option>{{$size->title}}</option>    
                                            @endforeach
                                        </select>
                                    </td>
                                    <td style="width: 150px;">
                                        <input name="items[${key}][description]" class="form-control"/>
                                    </td>
                                    <td style="width: 82px;">
                                        <input name="items[${key}][qty]" class="qty form-control"/>
                                    </td>
                                    <td style="width: 82px;">
                                        <input name="items[${key}][price]" class="rate form-control"/>
                                    </td>
                                    <td class="text-center total">0</td>
                                    <td class="text-center"><button type="button" class="delete_item btn-little"><i class="text-danger fa-2x fas fa-window-close"></i></button></td>
                                </tr>`);
                calculate();
            }
        });


        $('.items-list').on("click", ".delete_item" , function() {
              $(this).parent().parent().remove();
        });


        $('.items-list').on("change", "input" , function() {
            calculate();
        });


        calculate();
        function calculate(){
                let total = 0;
                let loop =  $('.items-list').children().each(async function(){
                let main = $(this);

                let qty = parseFloat(main.find('.qty').val());
                qty = isNaN(qty) ? 0 : qty; 

                let rate = parseFloat(main.find('.rate').val());
                rate = isNaN(rate) ? 0 : rate; 

                main.find('.total').text(qty * rate);
            });
        }

});
</script>
@endsection