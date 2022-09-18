@extends('admin.layouts.admin')
@section('title','Sale Invoice')
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
                <h4 class="mb-0 font-size-18">Sale Invoice</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active"> sale-Invoice</li>
                    </ol>
                </div>
            </div>
        </div>
      </div>
    <!-- end page title -->

      <div class="row">
        <div class="col-12">
          <form action="{{route('admin.sale-invoices.store')}}" method="post">
              @csrf
              <div class="card">
                <div class="card-body">
                  <div class="container-fluid pb-3">
                    <div class="row">
                      <div class="col-md-9"><h4 class="card-title">Create Sale Invoice</h4></div>
                      <div class="col-md-3 text-left">
                          <label for="simpleinput">Date </label>
                          <input name="date" type="date" required class="form-control" value="" /> 
                      </div>
                    </div>
                  </div>
                  <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="invoice-header">
                                <table >
                                    <thead>
                                        <tr>
                                            <th style="width: 30px;" class="text-center" >#</th>
                                            <th style="width: 203px;" class="text-center" >Bill</th>
                                            <th class="text-center">Description</th>
                                            <th style="width: 124px;" class="text-center">Subtotal</th>
                                            <th style="width: 124px;" class="text-center">GSt</th>
                                            <th style="width: 106px;" class="text-center">Total</th>
                                        </tr>        
                                    </thead>
                                            <tbody class="line-items">
                                               <?php  
                                                
                                                $globalSubtotal = 0;
                                                $globalGST = 0;
                                                $globalGrandtotal = 0;
                                                
                                               ?>
                                                @foreach($bills as $key => $bill)
                                                    <?php
                                                    
                                                        $subtotal = 0;
                                                        $gst = 0;
                                                        $gtotal = 0;
                                                        
                                                        foreach($bill->items as $billItem){
                                                            $weight = 0;
                                                            foreach($billItem->lot->qualities as $quality){
                                                                $weight += $quality->weight;
                                                            }
                                                            $subtotal += $weight * $billItem->rate;
                                                        }
                                                        
                                                        $globalSubtotal += $subtotal;
                                                        $gst = (( $subtotal * $bill->gst ) / 100);
                                                        $globalGST += $gst;
                                                        $globalGrandtotal += $subtotal + $gst;
                                                    ?>
                                                    <tr>
                                                        <td>{{$key + 1}}</td>
                                                        <td> <input type="hidden" name="items[{{$key}}][id]" value="{{$bill->id}}" />{{$bill->serial_no}}</td>
                                                        <td><input name="items[{{$key}}][des]"  class="form-control" /></td>
                                                        <td class="text-center" >{{number_format($subtotal,2)}}</td>
                                                        <td class="text-center">{{number_format($gst,2)}}</td>
                                                        <td class="text-center" >{{number_format($subtotal + $gst,2)}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                               <tfooter>
                                            <tr>
                                                <td style="border: 0px;" rowspan="3" colspan="4">
                                                </td>
                                                <td style="font-weight: bold" class="text-center">Subtotal:</td>
                                                <td class="text-center">{{number_format($globalSubtotal,2)}}</td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: bold" class="text-center">GST %:</td>
                                                <td class="text-center">{{number_format($globalGST,2)}}</td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: bold" class="text-center">Grand Total:</td>
                                                <td class="text-center">{{number_format($globalGrandtotal,2)}}</td>
                                            </tr>      
                                    </tfooter>
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

       
     
      });
    </script>
@endsection