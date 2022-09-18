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
<div class="container-fluid">
   
    <!-- start page title -->
      <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Create Sale Bill</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active"> sale-bill</li>
                    </ol>
                </div>
            </div>
        </div>
      </div>
    <!-- end page title -->

      <div class="row">
        <div class="col-12">
          <form action="{{route('admin.sale-bills.store')}}" method="post">
              @csrf
              
              <div class="card">
                <div class="card-body">
                  <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4">
                         <label>Date</label>
                         <input name="date" required class="form-control" type="date" value="" />
                        </div>
                        <div class="col-md-4">
                         <label>Due Date</label>
                         <input name="due_date" required class="form-control" type="date" value="" />
                        </div>
                        <div class="col-md-4">
                         <label>GST</label>
                         <select class="inv_gst form-control" name="gst" >
                             <option value="0" >No</option>
                             <option value="{{$_settings->gst}}" >Yes</option>
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
                      <div class="col-6"><h4 class="card-title">Sale Bill</h4></div>
                      <div class="col-6 text-right"></div>
                    </div>
                  </div>
                  <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
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
                                        
                                            @foreach ($lots as $key => $lot)
                                                 <?php
                                                      $weight = 0;
                                                      $rolls = 0;
                                                      $rate = 0;
                                                      
                                                      foreach($lot->qualities as $quality){
                                                        $rolls += $quality->roll;
                                                        $weight += $quality->weight;
                                                      }
                                                 ?>
                                                  <tr>
                                                      <td>{{$lot->serial_no}} <input name="lot[{{$lot->id}}][id]" type="hidden" value="{{$lot->id}}" /></td>
                                                      <td>{{$lot->fabric_quality}}</td>
                                                      <td class="text-center">{{$rolls}}</td>
                                                      <td class="text-center weight">{{$weight}}</td>
                                                      <td class="text-center">
                                                       <input required name="lot[{{$lot->id}}][rate]" step=".01" min="1" type="number" class="rate form-control" value="1" /></td>
                                                      <td class="text-center ltotal " >0</td>
                                                  </tr> 
                                            @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td style="border:none" rowspan="3" colspan="4"  ></td>
                                            <td class="text-center" >Subtotal</td>
                                            <td class="text-center subtotal"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center" >GST <span class="gstext" ></span>%</td>
                                            <td class="text-center gst"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center" >Grand Total</td>
                                            <td class="text-center gtotal"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row" >   
                      <div class="col-md-12 text-center py-3" >
                        <button class="btn btn-info" type="submit" >Submit</button>  
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
                        calculateGs = calculateGst.toFixed(2);
                        if(calculateGst == Infinity){
                          calculateGst = 0;
                        }

                    $('.gst').text(calculateGs);

                    gtotal = subtotal + calculateGst;

                    $('.subtotal').text(subtotal);
                    $('.gstext').text(gst);
                    $('.gtotal').text(gtotal.toFixed(2));

          });
              
          $("input").change();
     
      });
    </script>
@endsection