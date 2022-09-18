@extends('admin.layouts.admin')
@section('title','Lots Fresh')
@section('css')
<link href="{{asset('admin/plugins/select/css.css')}}" rel="stylesheet" type="text/css" />
<style>
      
        .remove-icon{
              position: absolute;
              right: 0px;
              top: -1px;
        }
      
      .multiselect-native-select .btn-group{
            border: 1px solid #817e7e6e;
            width: 100%;
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
              /* background: #3281f2; */
              /* color: white; */
              /* padding: 7px 0px; */
          }

          .invoice-top p{
              margin: 0px;
              font-size: 16px;
              font-weight: 400;
              color: black;
          }

          .invoice-top .logo{
              width: 50px;
          }

          .invoice-top h6{
            padding-top: 24px;
            font-size: 33px;
            text-transform: uppercase;
            display: inline-block;
            border-bottom: 1px solid;
            color: black;
          }

        /* invoice-top */



        /* invoice-general */

        .invoice-genral{
          /* border: 1px solid; */
          margin-bottom: 0px;
          padding: 17px 3px;
        }

        .invoice-genral > .row > div {
          display: flex;
          flex-direction: row;
          align-items: center;
          padding: 11px 0px;

        }

        .invoice-genral input{
          flex-grow: 1;
          border: 0px!important;
        }

        .invoice-genral input{
          border-bottom: 1px solid #b3a8a8 !important;
        }

        .invoice-genral label{
          margin-bottom: 0px;
          padding: 0px 10px;
          color: black;
        }

            
        /* invoice-general */



             /* Invoice Header */

              .invoice-header {
                padding-bottom: 12px;
            }

            .invoice-header table{
                margin: auto;
                width: 100%;
                font-family: Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                background: white;
            }

            .invoice-header table thead th{
                border: 1px solid #ddd;
                text-align: center;
                padding: 5px 0px;
                background-color: #3281f2;
                color: white;

            }

            .invoice-header table td{
                border: 1px solid #ddd;
                padding: 8px;
                color: black;
            }

            hr{
                margin-top: 20px;
                margin-bottom: 20px;
                border: 0;
                border-top: 1px solid #eee;
            }
            
            .invoice input:focus{
               /*border:0px!important;*/
               outline:0px!important;
            }
            
             .invoice input:focus-visible {
               /*border:0px!important;     */
               outline:0px!important;
            }


</style>
@endsection
@section('content')
<div class="container-fluid">
    
      <!-- start page title -->
            <div class="beard row">
              <div class="col-12">
                  <div class="page-title-box d-flex align-items-center justify-content-between">
                      <h4 class="mb-0 font-size-18">Lots Fresh</h4>
                      <div class="page-title-right">
                          <ol class="breadcrumb m-0">
                              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                              <li class="breadcrumb-item active"> Lots Fresh</li>
                          </ol>
                      </div>
                  </div>
              </div>
          </div>
      <!-- end page title -->

      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-body">
                <div class="container-fluid">
                  <div class="row">
                      <div class="col-6">
                      <h4 class="card-title">View</h4>
                      </div>
                      <div class="col-6 text-right ">
                        <a href="{{route('admin.lots-fresh.index')}}" class="btn btn-primary" >Back</a>
                      </div>
                  </div>
                  </div> 
              </div>
          </div>

          <div class="invoice card">
             <div class="card-body">
                <div class="container-fluid">

                    <div class="invoice-top row">
                        <div class="col-12 text-center">
                            <h6>Job Card<h6>
                        </div>
                    </div>

                    <div class="invoice-genral">
                    <div class="row" >
                      <div class="col-md-4" >
                            <label>Lot: </label>
                            <input readonly value="{{$module->serial_no}}" />
                      </div>
                      <div class="col-md-4" >
                              <label>Receive Date: </label>
                              <input readonly value="{{$module->date->format('Y-m-d')}}" />
                      </div>                          
                      <div class="col-md-4" >
                              <label>Customer: </label>
                              <input readonly value="{{$module->customer->name }}" />
                      </div>
                      <div class="col-md-3" >
                        <label >Color: </label>
                        <input readonly value="{{$module->color}}" />
                     </div>
                   
                      <div class="col-md-5" >
                           <label>Customer Weight kg / Roll: </label>
                           <input readonly value="{{$module->qty_type}} {{$module->qty}}" />
                      </div>
                    
                      <div class="col-md-4" >
                              <label>Fabric Quality: </label>
                              <input readonly value="{{$module->fabric_quality}}" />

                      </div>
                      <div class="col-md-4" >
                        <label>Party challan: </label>
                        <input readonly value="{{$module->party_challan}}" />
                     </div>
                      <div class="col-md-4" >
                              <label>Party Job Number: </label>
                              <input readonly value="{{$module->party_job_number}}" />
                      </div>
                      
                      <div class="col-md-4" >
                          <label>Production Date: </label>
                          <input readonly value="{{$module->production_date->format('Y-m-d')}}" />
                      </div>
                      
                      <?php $entry = explode(',',$module->shift_entry); ?>
                      <div class="col-md-8" >
                          <label>Shift Entry: </label>
                          <input readonly value="@foreach(Con::shifts() as  $shifts)@if(in_array($shifts,$entry)){{$shifts}},@endif @endforeach" />
                      </div>
                      
                      <div class="col-md-4" >
                          <label>Issue Date: </label>
                          <input readonly value="{{ $module->issue_date ? $module->issue_date->format('Y-m-d') : '' }}" />
                      </div>

                      <?php $machiness = explode(',',$module->machines); ?>
                      <div class="col-md-6" >
                          <label>Machines: </label>
                          <input readonly value="@foreach(Con::machines() as $machine)@if(in_array($machine->title,$machiness)){{$machine->title}},@endif @endforeach" />
                      </div>
                      
                      <div class="col-md-6" >
                              <?php  $process = explode(",",$module->lot_process); ?>
                             <label>Process: </label>
                             <input readonly value="@foreach(Con::lot_process() as $item)@if(in_array($item->id, $process)){{$item->title}}@endif @endforeach" />
                     </div>
                  </div>
                  </div>

                    <div class="invoice-header">
                      <table>
                        <thead>
                            <tr>
                                <th style="font-size: 24px;" colspan="5" >Qualities</th>
                            </tr> 
                            <tr>
                                <th>#</th>
                                <th>Quality</th>
                                <th>Description</th>
                                <th>Rolls</th>
                                <th>Weight</th>
                            </tr>        
                        </thead>
                        <tbody>
                            <?php $lotQualityTotal = 0; ?>
                          @foreach( $module->qualities as $key => $item)
                          <?php $lotQualityTotal += $item->weight;  ?>
                             <tr>
                                <td class="text-center" >{{$key + 1}}</td>
                                <td>{{$item->quality}}</td>
                                <td>{{$item->description}}</td>
                                <td class="text-center">{{ number_format($item->roll,2)}}</td>
                                <td class="text-center">{{ number_format($item->weight,2)}}</td>
                            </tr>

                            @endforeach
                              <tr>
                                  <td style="border: 0px;" colspan="3"></td>
                                  <td class="text-center" >Total</td>
                                  <td class="text-center" >{{number_format($lotQualityTotal,2)}}</td>
                              </tr>
                        </tbody>
                        
                    </table>
                  </div>
                  
                  
                  
                  <?php 
                     $challansId = [];
                     foreach ($module->qualities as $key => $value){
                       foreach($value->challan as $challan){
                          array_push($challansId,$challan->challan_id);
                       }
                     }
                    $challans = App\DeliveryChallan::whereIn('id',$challansId)->get();
                  ?>
                  
                  <!--Challan-->
                  <div class="invoice-header">
                      <table>
                        <thead>
                            <tr>
                                <th style="font-size: 24px;" colspan="12" >Delivery Challans</th>
                            </tr> 
                            <tr>
                                <th>#</th>
                                <th colspan="2" >Finish</th>
                                <th colspan="2">Received</th>
                                <th colspan="2">Delivered</th>
                                <th colspan="2" >Shrinkage</th>
                                <th>Wastage</th>
                                <th>Remarks</th>
                                <th>Action</th>
                            </tr>        
                        </thead>
                        <tbody>
                            @foreach($challans as $key => $challan)
                                <?php 
                                
                                    $rroll = 0;
                                    $rweight = 0;
                                    $dweight = 0;
                                    $droll = 0;
                            
                                    foreach($challan->items as $challanitem){
                                        
                                         $rroll += $challanitem->quality->roll;
                                         $rweight += $challanitem->quality->weight;
                                         $droll += $challanitem->roll_delivered; 
                                         $dweight += $challanitem->weight_delivered; 
                                    }
                                ?>
                                     <tr>
                                            <td>{{$challan->po}}</td>
                                            <td>{{$challan->finishfirst}}</td>
                                            <td>{{$challan->finishtwo}}</td>
                                            <td class="text-center">{{$rroll}}</td>
                                            <td class="text-center">{{$rweight}}</td>
                                            <td class="text-center">{{$droll}}</td>
                                            <td class="text-center">{{$dweight}}</td>
                                            <td class="text-center">{{$challan->shrinkagefirst}}</td>
                                            <td class="text-center">{{$challan->shrinkagetwo}}</td>
                                            <td class="text-center">{{ ($rweight - $dweight) / 100 }}%</td>
                                            <td class="text-center">{{$challan->remarks}}</td>
                                            <td class="text-center"><a href=".route('admin.delivery-challans.view',$challan->id)." title='View'> <i class='fas fa-eye fa-2x text-warning'></i></a></td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                  </div>






                <?php  
                  $subtotal = 0;
                  $gtotal = 0;
                 ?>
  
               <div class="invoice-header">
                        <table>
                            <thead>
                                <tr>
                                  <th style="font-size: 24px;" colspan="7" >Coasting</th>
                                </tr>
                                <tr>
                                    <th>#</th>
                                    <th>Description</th>
                                    <th>Product</th>
                                    <th>Weight</th>
                                    <th>Additional Weight</th>
                                    <th>Rate</th>
                                    <th>Total</th>
                                </tr>        
                            </thead>
                            <tbody>
                                @foreach ($module->item as $key => $item)
                                  <?php 
                                      $tweight = 0;
                                      $weights = explode(",",$item->additional_weight); 
                                      foreach($weights as $keyWeight => $weight){
                                        $tweight +=  floatval($weight);
                                      }
                                      $tweight += $item->weight;
                                      $subtotal += $tweight * $item->rate;
                                  ?>
                                <tr>
                                    <td class="text-center" >{{$key + 1}}</td>
                                    <td>{{$item->product->types->title}}</td>
                                    <td>{{$item->product->title}}</td>
                                    <td class="text-center">{{ number_format($item->weight,2)}}</td>
                                    <td class="text-center">{{ number_format($tweight,2)}}</td>
                                    <td class="text-center">{{ number_format($item->rate,2)}}</td>
                                    <td class="text-center">{{ number_format($item->total,2)}}</td>
                                </tr>
                                @endforeach
                                <?php 
                                    $gtotal = $subtotal;
                                    $gtotal += $module->material;
                                    $gtotal += $module->labour;
                                    $gtotal += $module->oh;
                                    $gtotal += $module->etc;
                                ?>
                                <tr>
                                  <td style="border: 0px;" colspan="5"></td>
                                  <td class="text-center" >Subtotal</td>
                                  <td class="text-center" >{{number_format($subtotal,2)}}</td>
                                </tr>
                                <tr>
                                  <td style="border: 0px;" colspan="5"></td>
                                  <td class="text-center">Material</td>
                                  <td class="text-center">{{number_format($module->material,2)}}</td>
                                </tr>
                                <tr>
                                  <td style="border: 0px;" colspan="5"></td>
                                  <td class="text-center">Labour</td>
                                  <td class="text-center" >{{number_format($module->labour,2)}}</td>
                                </tr>
                                <tr>
                                  <td style="border: 0px;" colspan="5"></td>
                                  <td class="text-center">O/H</td>
                                  <td class="text-center" >{{number_format($module->oh,2)}}</td>
                                </tr>
                                <tr>
                                  <td style="border: 0px;" colspan="5"></td>
                                  <td class="text-center">ETC</td>
                                  <td class="text-center" >{{number_format($module->etc,2)}}</td>
                                </tr>
                                <tr>
                                  <td style="border: 0px;" colspan="5"></td>
                                  <td class="text-center">Grand Total</td>
                                  <td class="text-center" >{{number_format($gtotal,2)}}</td>
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
 <script src="{{asset('admin/plugins/select/js.js')}}"></script>
 <script>
   $(document).ready(function () {
      $('.example-getting-started').multiselect();
   });
 </script>
@endsection