@extends('admin.layouts.admin')
@section('title','Sale Invoice')
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

   <?php
    $customer = $invoice->items[0]->bill->items[0]->lot->customer;
   ?>

      <div class="row">
        <div class="col-12">
            
          <div class="invoice card">
            <div class="card-body"> 
              <div class="container-fluid">

                <div class="invoice-top row">
                    <div class="col-6">
                        <p>Sale Invoice: #{{$invoice->po}}<p>   
                    </div>
                    <div class="col-6 text-right">
                        <p>Date: {{$invoice->created_at}}<p>
                    </div>
                </div>

                 <div class="row invoice-address">
                     <div class="col-12 text-center " >
                         <img class="logo" src="{{asset('/admin/images/logo.jpeg')}}" />
                         <span class="title">AHMED FABRICS</span>   
                     </div>
                    <div class="col-6 text-left">
        
                         <h6>Bill From:</h6>
                        <ul>
                            <li>PLOT # D-94 A SHERSHA ROAD</li>
                            <li>Site, Karachi</li>
                            <li>NTN:2654077-7</li>
                            <li>STRN:3277876235794</li>
                        </ul>
                    </div>
                    <div class="col-6 text-right">
                        <h6>Bill To:</h6>
                        <ul>
                            <li>Customer: {{$customer->name}}</li>
                            <li>Address: {{$customer->address}}</li>
                        </ul>
                    </div>
                    <div class="col-12 text-center " >
                        <h6 style="font-size: 35px;" >Order Details</h6>
                    </div>
                 </div>
                 <hr>
                    <?php  
                        
                     $globalSubtotal = 0;
                     $globalGST = 0;
                     $globalGrandtotal = 0;
                    ?>
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
                                        @foreach($invoice->items as $key => $invoiceItem)
                                            <?php
                                            
                                                $subtotal = 0;
                                                $gst = 0;
                                                $gtotal = 0;
                                                
                                                foreach($invoiceItem->bill->items as $billItem){
                                                  $weight = 0;
                                                  foreach($billItem->lot->qualities as $quality){
                                                     $weight = $quality->weight;
                                                  }
                                                  $subtotal += $weight * $billItem->rate;
                                                }
                                                
                                                $globalSubtotal += $subtotal;
                                                $gst = (( $subtotal * $invoiceItem->bill->gst ) / 100);
                                                $globalGST += $gst;
                                                $globalGrandtotal += $subtotal + $gst;
                                                
                                            ?>
                                            <tr>
                                                <td>{{$key + 1}}</td>
                                                <td> <input type="hidden" name="items[{{$key}}][id]" value="{{$invoiceItem->id}}" />{{$invoiceItem->bill->serial_no}}</td>
                                                <td>{{$invoiceItem->description}}</td>
                                                <td class="text-center" >{{number_format($subtotal,2)}}</td>
                                                <td class="text-center">{{number_format($gst,2)}}</td>
                                                <td class="text-center" >{{number_format($subtotal + $gst,2)}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfooter>
                                            <tr>
                                                <td style="border: 0px;" rowspan="3" colspan="4">
                                                    <p>
                                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.  <br>Lorem Ipsum has been the industry's standard dummy <br> text ever since the 1500s, when an unknown printer took a galley of type and scram
                                                   </p>
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
                                            <tr>
                                            <td style="border:none" colspan="1" class="text-center">
                                                <p class="sign" >Approved by</p>
                                            </td>
                                            <td style="border:none"  colspan="4"></td>
                                            <td style="border:none" colspan="3" class="text-center" >
                                                 <p class="sign" >Recieved by</p>
                                            </td>
                                        </tr>
                                    </tfooter>
                                </table>
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