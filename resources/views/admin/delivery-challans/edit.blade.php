@extends('admin.layouts.admin')
@section('title','Delivery Challans')
@section('css')

<link href="{{asset('admin/plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />

  <style>
      .normal-btn {
        background: white;
        border: none;
      }

      .select2-container--default .select2-selection--single {
        border-radius: 0px!important;
      }
  </style>

@endsection
@section('content')
 <div class="container-fluid">

    
    <!-- start page title -->
      <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Edit Delivery Challans</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                      <li class="breadcrumb-item active">delivery-challans</li>
                    </ol>
                </div>
            </div>
        </div>
      </div>
    <!-- end page title -->
    
    <div class="row">
      <div class="col-12">
        <form method="post" action="{{route('admin.delivery-challans.update',$modules->id)}}"  >         
            @csrf
                    @foreach ($modules->items as $key => $item)
                    <?php

                       $quality = $item->quality;
                       $weights = $quality->weight; 
                       $max = Con::challanCheck($item->quality->id);
                       $usedChallan = $max - $item->weight_delivered;
                       $availChallan = number_format($weights - $usedChallan,2);

                    ?>
                        <div class="card my-2">
                           <input name="items[{{$key}}][id]" type="hidden" value="{{$item->id}}" />
                            <div style="padding: 0px 18px;" class="card-body">
                                <div class="py-3 my-1 container-fluid">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="simpleinput">Quality </label>
                                                <input name="items[{{$key}}][quality]" readonly class="form-control" value="{{$quality->description}}" >
                                            </div>
                                        </div>

                                        <div class="col-md-1">
                                          <div class="form-group">
                                        <label for="simpleinput">Rolls.R</label>
                                        <input name="items[{{$key}}][roll]" readonly type="number" class="form-control" value="{{$quality->roll}}" />
                                          </div>
                                        </div>

                                        <div class="col-md-2">
                                          <div class="form-group">
                                            <label for="simpleinput">Weight.R </label>
                                            <input name="items[{{$key}}][weight]" readonly type="number" class="form-control" value="{{$quality->weight}}" />
                                          </div>
                                        </div>

                                        <div class="col-md-1">
                                          <div class="form-group">
                                            <label for="simpleinput">Rolls.D</label>
                                            <input required name="items[{{$key}}][rolls_delivered]" type="number" class="form-control" value="{{$item->rolls_delivered}}" />
                                          </div>
                                        </div>

                                        <div class="col-md-2">
                                          <div class="form-group">
                                            <label for="simpleinput">Weight.D </label>
                                            <input step=".01" required name="items[{{$key}}][weight_delivered]" type="number" min="0" max="{{$availChallan}}" value="{{$item->weight_delivered}}" class="form-control" />
                                          </div>
                                        </div>

                                        <div class="col-md-4">
                                          <div class="form-group">
                                            <label for="simpleinput">Remarks</label>
                                            <input value="{{$item->remarks}}" name="items[{{$key}}][remarks]" type="text" class="form-control" />
                                          </div>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </div>    
                    @endforeach
                    
                    <div class="card">
                      <div class="bg-white card-body">
                          <div class="container-fluid">
                            <div class="row">
                              <div class="col-6"><h4 class="card-title">Additional Fields</h4></div>
                            </div>
                          </div>
                          <div class="container-fluid">
                             <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group text-center">
                                            <label for="simpleinput">Finish</label>
                                            <div class="row" >
                                                <div class="col-6" >
                                                   <input step=".01" min="0" name="finishfirst" class="form-control" type="number" value="{{$modules->finishfirst}}"  >
                                                </div>
                                                <div class="col-6" >
                                                   <input step=".01" min="0" name="finishtwo" class="form-control"  type="number" value="{{$modules->finishtwo}}"  >        
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group text-center">
                                            <label for="simpleinput">Shrinkage</label>
                                            <div class="row" >
                                                <div class="col-6" >
                                                   <input step=".01" min="0" name="shrinkagefirst" class="form-control" type="number" value="{{$modules->shrinkagefirst}}" >
                                                </div>
                                                <div class="col-6" >
                                                   <input step=".01" min="0" name="shrinkagetwo" class="form-control"  type="number" value="{{$modules->shrinkagetwo}}" >        
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" >
                                		 <div class="form-group">
                                			<label for="simpleinput">DC</label>
                                			<div class="input-group">
                                			  <div class="input-group-prepend">
                                				<span class="input-group-text" >DC-{{$modules->date->format('ym')}}</span>
                                			  </div>
                                			  <input required type="number" name="serial_no" class="form-control" value="{{ str_pad(intval($modules->serial), 3, '0', STR_PAD_LEFT) }}" >
                                			</div>
                                			
                                			 @if($errors->has('serial_no'))
                                			  <div class="error text-danger">{{ $errors->first('serial_no') }}</div>
                                			 @endif
                                		</div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group text-center">
                                            <label for="simpleinput">Date</label>
                                            <input name="date" type="date" class="form-control" value="{{$modules->date->format('Y-m-d')}}"  />    
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group text-center">
                                            <label for="simpleinput">Remarks</label>
                                            <input name="remarks" class="form-control" value="{{$modules->remarks}}"  />    
                                        </div>
                                    </div>
                                </div>
                          </div>
                       </div>
                    </div>
                    
                    <div class=" text-center pt-2 container">
                      <button type="submit" class="btn btn-info">Submit</button>
                    </div>
            </form>
      </div>
  </div>
 </div>
@endsection
@section('js')

    <script src="{{asset('admin/plugins/select2/select2.min.js')}}"></script>
    <script>
        $('.js-example-basic-single').select2();
    </script>
    
@endsection