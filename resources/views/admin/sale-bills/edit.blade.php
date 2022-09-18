@extends('admin.layouts.admin')
@section('title','Sale Bills')
@section('css')
<style>
            .normal-btn{
                 background: white;
                border: none;
            }

            .invoice-header table{
                width: 100%;
            }

            .invoice-header table th {
                border: 1px solid #ddd;
                text-align: center;
                padding: 12px 0px;
                background-color: #3281f2;
                color: white;
            }

            .invoice-header table td {
                border: 1px solid #ddd;
                padding: 8px;
                color: black;
            }

</style>
@endsection
@section('content')
<?php

  
  $customer = $bill->items[0]->lot->customer;
?>
<div class="container-fluid">
      <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Sale Bill</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active"> sale-bill</li>
                    </ol>
                </div>
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <form action="{{route('admin.sale-bills.update',$bill->id)}}" method="post">
              @csrf
              
            <div class="card">
                <div class="card-body">
                  <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3" >
                    		 <div class="form-group">
                    			<label for="simpleinput">SB</label>
                    			<div class="input-group">
                    			  <div class="input-group-prepend">
                    				<span class="input-group-text" >SB-{{$bill->date->format('ym')}}</span>
                    			  </div>
                    			  <input required type="number" name="serial_no" class="form-control" value="{{ str_pad(intval($bill->serial), 3, '0', STR_PAD_LEFT) }}" >
                    			</div>
                    			
                    			 @if($errors->has('serial_no'))
                    			  <div class="error text-danger">{{ $errors->first('serial_no') }}</div>
                    			 @endif
                    		</div>
                        </div>
                         <div class="col-md-3">
                         <label>Date</label>
                         <input name="date" class="form-control" type="date" value="{{$bill->date->format('Y-m-d')}}" />
                        </div>
                        <div class="col-md-3">
                         <label>Due Date</label>
                         <input name="due_date" class="form-control" type="date" value="{{$bill->due_date->format('Y-m-d')}}" />
                        </div>
                        <div class="col-md-3">
                         <label>GST</label>
                         <select class="form-control inv_gst" name="gst" >
                             <option @if($bill->gst == 0) {{'selected'}} @endif value="0" >No</option>
                             <option @if($bill->gst != 0) {{'selected'}} @endif value="{{$_settings->gst}}" >Yes</option>
                         </select>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
            
            <div class="card">
              <div class="card-body">
                  <div class="container-fluid pb-3">
                    <div class="row">
                      <div class="col-6"><h4 class="card-title">Sale Bills</h4></div>
                      <div class="col-6 text-right"> </div>
                    </div>
                  </div>
                  <div class="container-fluid" >
                        <div class="invoice-header">
                                <table >
                                    <thead>
                                        <tr>
                                            <th style="width: 203px;" class="text-center" >Lot</th>
                                            <th class="text-center">Quality</th>
                                            <th style="width: 124px;" class="text-center">Roll Delivered</th>
                                            <th style="width: 124px;" class="text-center">Weight Delivered</th>
                                            <th style="width: 106px;" class="text-center">Rate</th>
                                            <th class="text-center">Total</th>
                                        </tr>        
                                    </thead>
                                    <tbody class="line-items" >
                                            @foreach($bill->items as $key =>  $billItem)
                                                <?php 
                                                     $weight = 0;
                                                     $rolls = 0;
                                                     foreach($billItem->lot->qualities as $quality){
                                                         $weight += $quality->weight;
                                                         $rolls += $quality->roll;
                                                     }
                                                ?>
                                                   <tr>
                                                      <td>{{$billItem->lot->serial_no}} <input name="bill[{{$key}}][id]" value="{{$billItem->id}}" type="hidden" /></td>
                                                      <td>{{$billItem->lot->fabric_quality}}</td>
                                                      <td class="text-center">{{$rolls}}</td>
                                                      <td class="text-center weight">{{$weight}}</td>
                                                      <td class="text-center" ><input required name="bill[{{$key}}][rate]" value="{{$billItem->rate}}" step=".01" min="1" type="number" class="rate form-control" /></td>
                                                      <td class="text-center ltotal " >0</td>
                                                  </tr> 
                                            @endforeach
                                </tbody>
                                <tfoot>
                                        <tr>
                                            <td style="border:none" rowspan="3" colspan="4" ></td>
                                            <td class="text-center" >Subtotal</td>
                                            <td class="text-center subtotal"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">
                                              GST <span class="show_gst">{{$gst}}</span>%</td>
                                            <td class="text-center gst"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">Grand Total</td>
                                            <td class="text-center gtotal"></td>
                                        </tr>
                                 </tfoot>
                            </table>
                        </div>
                            
                        <div class="py-3 text-center" >
                            <input type="submit" value="Submit" class="btn btn-primary" />
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
      $(document).ready(function(){
          $('input,select').change(function(){

              let subtotal = 0;
              let gst =  $('.inv_gst').val() | 0;
              let gtotal = 0;

              $('.line-items').children().each(function () {     

                let qty =  $(this).find('.weight').text();
                let pp = $(this).find('.rate').val() | 0;
                
                
                $(this).find('.ltotal').text(qty * pp);
                 subtotal += qty * pp;
              });

                let calculateGst = 0;
                         
                        calculateGst = subtotal * (gst / 100);
                        calculateGstRatio = calculateGst.toFixed(2);
                        if(calculateGst == Infinity){
                          calculateGst = 0;
                        }

                    $('.gst').text(calculateGstRatio);

                    gtotal = subtotal + calculateGst;
                    
                    $('.show_gst').text(gst);
                    $('.subtotal').text(subtotal);
                    $('.gtotal').text(gtotal.toFixed(2));
                });
              
                $("input").change();
      });
    </script>
@endsection