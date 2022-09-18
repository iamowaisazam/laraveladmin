@extends('admin.layouts.admin')
@section('title','Purchase Order')
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
              <h4 class="mb-0 font-size-18">View Purchase Order "{{$type->title}}"</h4>
              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                      <li class="breadcrumb-item active"> purchases-orders</li>
                  </ol>
              </div>
          </div>
      </div>
    </div>
  <!-- end page title -->

   <?php $vendor = $order->vendor; ?>

      <div class="row">
        <div class="col-12">
          <div class="invoice card">
            <div class="card-body"> 
              <div class="container-fluid">

                <div class="invoice-top row">
                    <div class="col-6">
                        <p>Purchase Order: #{{$order->id}}<p>   
                    </div>
                    <div class="col-6 text-right">
                        <p>Date: {{$order->date->format('y-m-d')}}<p>
                    </div>
                </div>

                <div class="row invoice-address">
                    <div class=" col-12" >
                          <div class="d-flex">
                              <div class="mr-auto">
                                    <img class="logo" src="{{asset('/admin/images/logo.jpeg')}}" />
                                    <span class="title">Company Name</span>
                                    <ul>
                                        <li>Address: #Street Address</li>
                                        <li>Site, Karachi</li>
                                        <li>NTN:2654077-7</li>
                                        <li>STRN:3277876235794</li>
                                    </ul>
                              </div>
                              <div class="">
                                    <h6 class="text-center" >Ship To:</h6>
                                    <ul>
                                        <li>Name: {{$vendor->name}}</li>
                                        <li>Address:{{$vendor->address}}</li>
                                        <li>{{$vendor->city}}, {{$vendor->coountry}}</li>
                                        <li>NTN:{{$vendor->ntn}}</li>
                                        <li>STRN:{{$vendor->strn}}</li>
                                    </ul>
                             </div>
                          </div>
                    </div>
                    <div class="col-12 text-center">
                        <h6 style="font-size: 34px;">Order Details</h6>
                    </div>
                 </div>
                 <hr>
                      <?php  $total = 0; ?>
                            <div class="invoice-header">
                                <table >
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Polybags</th>
                                            <th>Remarks</th>
                                            <th>Color</th>
                                            <th>Size</th>
                                            <th>Rate</th>
                                            <th>Qty</th>
                                            <th>Total</th>
                                        </tr>        
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $gsubtotal = 0;
                                            $ggst = 0;
                                            $gtotal = 0;
                                            
                                            $subtotal = 0;
                                        ?>
                                        @foreach($order->items as $key => $item)
                                              <?php  
                                                    $qty = $item->qty;
                                                    $rate = $item->price;
                                                    $total = $rate * $qty;
                                                    $subtotal += $rate * $qty; 
                                              ?>
                                                <tr>
                                                    <td>{{$key + 1}}</td>
                                                    <td class="text-center">{{$item->attribute->title}}</td>
                                                    <td class="text-center">{{$item->remarks}}</td>
                                                    <td class="text-center">{{$item->color}}</td>
                                                    <td class="text-center">{{$item->size}}</td>
                                                    <td class="text-center">{{$item->qty}}</td>
                                                    <td class="text-center">{{$item->price}}</td>
                                                    <td class="text-center">{{$total}}</td>
                                                </tr>
                                        @endforeach
                                        <tr>
                                            <td style="border: 0px;vertical-align: bottom;" rowspan="3" colspan="6">
                                                <p class="d-none m-0" >Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum has <br> been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scram</p>
                                            </td>
                                            <td style="font-weight: bold" class="text-center">Grand Total:</td>
                                            <td class="text-center">{{number_format($subtotal,2)}}</td>
                                        </tr>
                                        <tr class="d-none" >
                                            <td style="font-weight: bold" class="text-center">GST:</td>
                                            <td class="text-center">{{number_format($ggst,2)}}</td>
                                        </tr>
                                        <tr class="d-none" >
                                            <td style="font-weight: bold" class="text-center">Grand Total:</td>
                                            <td class="text-center" >{{number_format($gtotal,2)}}</td>
                                        </tr>
                                        <tr class="d-none" >
                                            <td style="border:none" colspan="1" class="text-center">
                                                <p class="sign" >Approved by</p>
                                            </td>
                                            <td style="border:none"  colspan="4"></td>
                                            <td style="border:none" colspan="3" class="text-center" >
                                                 <p class="sign" >Recieved by</p>
                                            </td>
                                        </tr>
                                    </tbody>
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
     
     
@endsection