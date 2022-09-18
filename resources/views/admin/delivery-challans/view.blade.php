@extends('admin.layouts.admin')
@section('title','Delivery Challan')
@section('css')
<style>
        .normal-btn{
             background: white;
            border: none;
        }

        .invoice{
            border: 1px solid;
            max-width: 700px;
            margin: auto;
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
                padding-bottom: 17px;
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
    
   <?php
        $lot = $modules->items[0]->quality->lot;
        $rroll = 0;
        $rweight = 0;
        $dweight = 0;
        $droll = 0;

        foreach($modules->items as $item){
            
             $rroll += $item->quality->roll;
             $rweight += $item->quality->weight;
             $droll += $item->roll_delivered; 
             $dweight += $item->weight_delivered; 
        }
        
        
    
   ?>
   
      <!-- start page title -->
        <div class="row">
          <div class="col-12">
              <div class="page-title-box d-flex align-items-center justify-content-between">
                  <h4 class="mb-0 font-size-18">View Delivery Challan</h4>
                  <div class="page-title-right">
                      <ol class="breadcrumb m-0">
                          <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                          <li class="breadcrumb-item active"> delivery-challan</li>
                      </ol>
                  </div>
              </div>
          </div>
        </div>
      <!-- end page title -->

      <!-- start page title -->
      <div class="row">
        <div class="col-12">
            
            <div class="card">
                <div class="card-body"> 
                
                <div class="invoice" >
                  <div class="container">
                    <div class="invoice-address">
                        <div class="text-center">
                            <h2 style="color:black;" >Delivery Challan</h2>
                            <h6>AHMED FABRICS</h6>
                        </div>
                  <div style="display: flex" >
                     <div style="width: 50%;">
                        <ul>
                            <li>Lot: #{{$lot->serial_no}}</li>
                            <li>Lot Date: {{$lot->date->format('d-M-Y')}}</li>
                            <li>Job: {{$lot->party_job_number}}</li>
                            <li>Color: {{$lot->color}}</li>
                            <li>Quality: {{$lot->fabric_quality}}</li>
                        </ul>
                    </div>
                    <div style="display: flex;justify-content: end;width: 49%;" >
                        <ul>
                            <li>Date: 01-19-09</li>
                            <li>Customer: {{$lot->customer->name}}</li>
                            <li>Address: {{$lot->customer->address}} </li>
                        </ul>
                    </div>
                  </div>
                  <div class="invoice-header">
                             <table >
                                    <thead>
                                        <tr>
                                            <th colspan="2" >Finish</th>
                                            <th colspan="2">Received</th>
                                            <th colspan="2">Delivered</th>
                                            <th colspan="2" >Shrinkage</th>
                                            <th>Wastage</th>
                                            <th>Remarks</th>
                                        </tr>        
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$modules->finishfirst}}</td>
                                            <td>{{$modules->finishtwo}}</td>
                                            <td class="text-center">{{$rroll}}</td>
                                            <td class="text-center">{{$rweight}}</td>
                                            <td class="text-center">{{$droll}}</td>
                                            <td class="text-center">{{$dweight}}</td>
                                            <td class="text-center">{{$modules->shrinkagefirst}}</td>
                                            <td class="text-center">{{$modules->shrinkagetwo}}</td>
                                            <td class="text-center">{{ ($rweight - $dweight) / 100 }}%</td>
                                            <td class="text-center">{{$modules->remarks}}</td>
                                        </tr>
                                        <tr>
                                            <td style="border:none" colspan="1" class="text-center">
                                                <p class="sign" >Approved by</p>
                                            </td>
                                            <td style="border:none"  colspan="8"></td>
                                            <td style="border:none" colspan="1" class="text-center" >
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
       <!-- start page title -->
       
 </div>
@endsection
@section('js')
      <script>        
            $(document).ready(function() {
              

             });
      </script>
@endsection