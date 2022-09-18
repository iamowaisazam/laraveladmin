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
                <h4 class="mb-0 font-size-18">Create Delivery Challan</h4>
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

    <div class="mb-2 bg-white container-fluid">
      <form class="pt-3" action="{{route('admin.delivery-challans.create')}}" method="get">
        <div class="row" >
           <div class="col-md-11 align-self-center " >
              <div class="form-group">
                <select required class="js-example-basic-single form-control"  name="lot_id" >
                    <option disabled >Select Lot</option>
                    @foreach ($modules as $item)
                        <option @if(isset($_GET['lot_id']) && $_GET['lot_id'] == $item->id) {{'selected'}} @endif  value="{{$item->id}}">{{$item->serial_no}} </option>
                    @endforeach
                    </select>
               </div>       
            </div>
            <div class="col-md-1 align-self-center " >
                <div class="form-group"><button class="btn btn-success" >Search</button></div>       
            </div>
         </div>
        </form>
    </div>
    <div class="row">
      <div class="col-12">

        @if(isset($_GET['lot_id']))
          
          <?php $lot = Con::lot($_GET['lot_id']); ?>

        <form method="post" action="{{route('admin.delivery-challans.store')}}"  >         
            @csrf
                  @if(count($lot->qualities) > 0 )
                    @foreach ($lot->qualities as $key => $item)

                    <?php 
                  
                       $max = Con::challanCheck($item['id']);
                       $max = number_format($item['weight'] - $max,2);
                    ?>

                
                        <div class="card my-2">
                            <div style="padding: 0px 18px;" class="card-body">
                                <div class="py-3 my-1  container-fluid">
                                    @if($max != 0)
                                    <input name="items[{{$key}}][id]" type="hidden" value="{{$item['id']}}" />

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="simpleinput">Quality</label>
                                                <input readonly class="form-control" value="{{$item->description}}" >
                                            </div>
                                        </div>

                                        <div class="col-md-1">
                                          <div class="form-group">
                                        <label for="simpleinput">Rolls.R</label>
                                        <input readonly class="form-control" value="{{$item['roll']}}" />
                                          </div>
                                        </div>

                                        <div class="col-md-2">
                                          <div class="form-group">
                                        <label for="simpleinput">Weight.R </label>
                                        <input readonly class="form-control" value="{{$item['weight']}}" />
                                          </div>
                                        </div>

                                        <div class="col-md-1">
                                          <div class="form-group">
                                            <label for="simpleinput">Rolls.D</label>
                                            <input min="0" required  name="items[{{$key}}][rec_rolls]" type="number" class="form-control" />
                                          </div>
                                        </div>

                                        <div class="col-md-2">
                                          <div class="form-group">
                                            <label for="simpleinput">Weight.D</label>
                                            <input min="0" step=".01" required name="items[{{$key}}][rec_weight]" type="number" class="form-control" max="{{$max}}" />
                                          </div>
                                        </div>

                                        <div class="col-md-4">
                                          <div class="form-group">
                                            <label for="simpleinput">Remarks</label>
                                            <input  name="items[{{$key}}][rec_remarks]" type="text" class="form-control" />
                                          </div>
                                        </div>
                                    </div>
                                    @endif

                                    @foreach ($item->challan as $challan)

                                    <div class="row">
                                      <div class="col-md-2">
                                          <div class="form-group">
                                              <label for="simpleinput">Quality</label>
                                              <input readonly class="form-control" value="{{$challan->quality->description}}" >
                                          </div>
                                      </div>

                                      <div class="col-md-1">
                                        <div class="form-group">
                                      <label for="simpleinput">Rolls.R</label>
                                      <input readonly class="form-control" value="{{$challan->quality->roll}}" />
                                        </div>
                                      </div>

                                      <div class="col-md-2">
                                        <div class="form-group">
                                      <label for="simpleinput">Weight.R </label>
                                      <input readonly class="form-control" value="{{$challan->quality->weight}}" />
                                        </div>
                                      </div>

                                      <div class="col-md-1">
                                        <div class="form-group">
                                          <label for="simpleinput">Rolls.D</label>
                                          <input  readonly class="form-control" value="{{$challan->rolls_delivered}}" />
                                        </div>
                                      </div>

                                      <div class="col-md-2">
                                        <div class="form-group">
                                          <label for="simpleinput">Weight.D</label>
                                          <input readonly class="form-control" value="{{$challan->weight_delivered}}"/>
                                        </div>
                                      </div>

                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="simpleinput">Remarks</label>
                                          <input readonly class="form-control" value="{{$challan->remarks}}" />
                                        </div>
                                      </div>
                                  </div>
                                        
                                    @endforeach
                                </div>  
                            </div>
                        </div>

            
                    @endforeach

                  @else
                    <div class="card my-2">
                      <div style="padding: 0px 18px;" class="pt-3 card-body">
                         <p class="text-center" > No Items Found </p>
                      </div>          
                     </div> 
                  @endif
                  
                    <div class="card">
                      <div class="bg-white  card-body">
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
                                                   <input step=".01" min="0" name="finishfirst" class="form-control" type="number" value="0"  >
                                                </div>
                                                <div class="col-6" >
                                                   <input step=".01" min="0" name="finishtwo" class="form-control"  type="number" value="0"  >        
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group text-center">
                                            <label for="simpleinput">Shrinkage</label>
                                            <div class="row" >
                                                <div class="col-6" >
                                                   <input step=".01" min="0" name="shrinkagefirst" class="form-control" type="number" value="0" >
                                                </div>
                                                <div class="col-6" >
                                                   <input step=".01" min="0" name="shrinkagetwo" class="form-control"  type="number" value="0" >        
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group text-center">
                                            <label for="simpleinput">Date</label>
                                            <input required name="date" type="date" class="form-control"  />    
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group text-center">
                                            <label for="simpleinput">Remarks</label>
                                            <input name="remarks" class="form-control" value=""  />    
                                        </div>
                                    </div>
                                </div>
                          </div>
                       </div>
                    </div>
                    
                    <div class=" text-center pt-5 container">
                      <button type="submit" class="btn btn-info">Submit</button>
                    </div>
            </form>
          @endif
      </div>
  </div>
 </div>
@endsection
@section('js')

    <script src="{{asset('admin/plugins/select2/select2.min.js')}}"></script>
    <script>
        $('.js-example-basic-single').select2();
    </script>

    @if(isset($_GET['lot_id']))
      <script>        
        $(document).ready(function() {

    
        
        });
      </script>
    @endif
@endsection