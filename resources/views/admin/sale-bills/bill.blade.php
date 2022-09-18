@extends('admin.layouts.admin')
@section('title','Sale Bill')
@section('css')
<style>

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

        /* invoice-top */

        /* invoice-address */

            .invoice-address{
                margin-top: 9px;
                padding: 0px;
            }

            .invoice-address .logo{
                width: 66px;
            }

            .invoice-address .title{
                font-size: 28px;
                margin: 0px 14px;
                top: 10px;
                position: relative;
                color: black;
            }

            .invoice-address h6{
                font-size: 20px;
                margin: 0px 0px;
                color: black;
            }

            .invoice-address ul{
                list-style: none;
                padding: 0px 0px;
                margin: 6px 0px 13px 0px;
                color: black;
            }

        /* invoice-address */


              /* Invoice Header */

              .invoice-header {
                padding-bottom: 29px;
            }

            .invoice-header table{
                margin: auto;
                width: 100%;
                font-family: Arial, Helvetica, sans-serif;
                border-collapse: collapse;
            }

            .invoice-header table th{
                border: 1px solid #ddd;
                text-align: center;
                padding: 12px 0px;
                background-color: #3281f2;
                color: white;

            }

            .invoice-header table td{
                border: 1px solid #ddd;
                padding: 8px;
                color: black;
            }

            .invoice-header th {
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

</style>
@endsection
@section('content')
<div class="container-fluid">
   
  <!-- start page title -->
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
  <!-- end page title -->

   <?php
     $customer = $bill->items[0]->lot->customer;
   ?>

   <div class="row">
      <div class="col-12">
          <div class="invoice card">
            <div class="card-body"> 
              <div class="container-fluid">

                <div class="invoice-top row">
                    <div class="col-6">
                        <p>Sale Invoice: #{{$bill->po}}<p>   
                    </div>
                    <div class="col-6 text-right">
                        <p>Date: {{$bill->created_at}}<p>
                    </div>
                </div>

                <div class="row invoice-address">
                    <div class="col-12 text-center" >
                        <h6 style="font-size: 35px;">AF</h6>
                        <h6 style="font-size: 35px;">Order Details</h6>
                    </div>
                 </div>
                 <hr>
                    <?php  $total = 0; ?>
                            <div class="invoice-header">
                                <div class="table-responsive" >
                                <table >
                                    <thead>
                                        <tr>
                                            <th style="width: 203px;" class="text-center" >Lot</th>
                                            <th class="text-center">Party Challan</th>
                                            <th class="text-center">Delivery challan</th>
                                            <th class="text-center">Delivery Date</th>
                                            <th class="text-center">Color</th>
                                            <th class="text-center">Quality</th>
                                            <th class="text-center">Process</th>
                                            <th class="text-center">Rolls</th>
                                            <th class="text-center">Weights</th>
                                            <th class="text-center">Rate</th>
                                            <th class="text-center">Total</th>
                                        </tr>        
                                    </thead>
                                    <tbody>
                                        <?php
                                          
                                          $gloablSubtotal = 0;
                                          $gloablGSt = 0;
                                          
                                        ?>
                                       @foreach($bill->items as $key =>  $billItem)
                                                <?php 
                                                     $subtotal = 0;
                                                     $weight = 0;
                                                     $rolls = 0;
                                                     
                                                     foreach($billItem->lot->qualities as $quality){
                                                             $rolls += $quality->roll;
                                                             $weight += $quality->weight;
                                                     }
                                                     $subtotal = $weight * $billItem->rate;
                                                     $gloablSubtotal += $subtotal;
                                                     
                                                 ?>
                                                   <tr>
                                                      <td>{{$billItem->lot->serial_no}}</td>
                                                      <td>{{$billItem->lot->party_challan}}</td>
                                                      <td>Delivery challan</td>
                                                      <td>Challan Date</td>
                                                      <td>{{$billItem->lot->color}}</td>
                                                      <td>{{$billItem->lot->fabric_quality}}</td>
                                                      <td>Process </td>
                                                      <td>{{$rolls}}</td>
                                                      <td>{{$weight}}</td>
                                                      <td>{{$billItem->rate}}</td>
                                                      <td>{{number_format($subtotal,2)}}</td>
                                                  </tr> 
                                            @endforeach     
                                    </tbody>
                                    <?php $gloablGSt = $gloablSubtotal * ($bill->gst / 100); ?>
                                    <tfoot>
                                        <tr>
                                            <td style="border:none" rowspan="3" colspan="9" >Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</td>
                                            <td class="text-center" >Subtotal</td>
                                            <td class="text-center subtotal">{{number_format($gloablSubtotal,2)}}</td>
                                        </tr>
                                        @if($gloablGSt > 0)
                                        <tr>
                                            <td class="text-center" >
                                              GST <span class="show_gst">{{$bill->gst}}</span>%</td>
                                            <td class="text-center gst">{{number_format($gloablGSt,2)}}</td>
                                        </tr>
                                        @endif
                                        
                                        <tr>
                                            <td class="text-center" >Grand Total</td>
                                            <td class="text-center gtotal">{{number_format($gloablSubtotal + $gloablGSt,2)}}</td>
                                        </tr>
                                        <tr>
                                            <td style="border:none" colspan="1" class="text-center">
                                                <p class="sign" >Approved by</p>
                                            </td>
                                            <td style="border:none" colspan="10" class="text-center" >
                                                <div class="text-right" >
                                                  <p class="sign text-center " >Recieved by</p>   
                                                </div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                                </div>
                            </div>
                      </div>
                  </div>
             </div>
        </div>
     </div>
 </div>
@endsection
@section('js')
      <script>        
            $(document).ready(function() {
              

             });
      </script>
@endsection