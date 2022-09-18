@extends('admin.layouts.admin')
@section('title','Vendors')

@section('css')


@endsection

@section('content')
<div class="container-fluid">
        <!-- start page title -->
    <div class="row">
      <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18">Vendors</h4>
              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                      <li class="breadcrumb-item active"> vendors</li>
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
                    <h4 class="card-title">Edit</h4>
                  </div>
                  <div class="col-6 text-right ">
                     <a class="btn btn-primary" href="{{route('admin.vendors.index')}}">Back</a>
                  </div>
                </div>
              </div>

              <form  method="post" action="{{route('admin.vendors.update',$module->id)}}"  >
                  @csrf 
                       <div class="row" >
                              <div class="col-md-3" >
                              <div class="form-group">
                                  <label for="simpleinput">Name</label>
                                  <input value="{{$module->name}}" required name="name" type="text"  class="form-control" />
                                  @if($errors->has('name'))
                                    <div class="error text-danger">{{ $errors->first('name') }}</div>
                                  @endif
                              </div>
                              </div>
                              
                              <div class="col-md-3" >
                              <div class="form-group">
                                  <label for="simpleinput">Email</label>
                                  <input value="{{$module->email}}"  name="email" type="text"  class="form-control" />
                                  @if($errors->has('email'))
                                    <div class="error text-danger">{{ $errors->first('email') }}</div>
                                  @endif
                             </div>
                             </div>
                             
                             <div class="col-md-3" >
                             <div class="form-group">
                                <label for="simpleinput">Address</label>
                                <input value="{{$module->address}}" name="address" type="text"  class="form-control" />
                             </div>
                             </div>
                             
                             <div class="col-md-3" >
                             <div class="form-group">
                                <label for="simpleinput">Country</label>
                                <input value="{{$module->country}}" name="country" type="text"  class="form-control" />
                             </div>
                             </div>
                             
                             <div class="col-md-3" >
                             <div class="form-group">
                                <label for="simpleinput">City</label>
                                <input value="{{$module->city}}" name="city" type="text"  class="form-control" />
                             </div>
                             </div>
                             
                             <div class="col-md-3" >
                             <div class="form-group">
                                <label for="simpleinput">Telephone</label>
                                <input value="{{$module->tel}}" name="tel" type="text"  class="form-control" />
                             </div>
                             </div>
                             
                             <div class="col-md-3" >
                             <div class="form-group">
                                <label for="simpleinput">RES#</label>
                                <input value="{{$module->res}}" name="res" type="text"  class="form-control" />
                             </div>
                             </div>
                             
                             <div class="col-md-3" >
                             <div class="form-group">
                                <label for="simpleinput">FAX#</label>
                                <input value="{{$module->fax}}" name="fax" type="text"  class="form-control" />
                             </div>
                             </div>
                             
                             <div class="col-md-3" >
                             <div class="form-group">
                                <label for="simpleinput">S.Man</label>
                                <input value="{{$module->s_man}}" name="s_man" type="text"  class="form-control" />
                             </div>
                             </div>
                             
                             <div class="col-md-3" >
                             <div class="form-group">
                                <label for="simpleinput">Mobile</label>
                                <input value="{{$module->mobile}}" name="mobile" type="text"  class="form-control" />
                             </div>
                             </div>

                             <div class="col-md-3" >
                             <div class="form-group">
                                <label for="simpleinput">STRN</label>
                                <input value="{{$module->strn}}" name="strn" type="text"  class="form-control" />
                             </div>
                             </div>
                            
                            
                             <div class="col-md-3" >
                             <div class="form-group">
                                <label for="simpleinput">NTN</label>
                                <input value="{{$module->ntn}}" name="ntn" type="text"  class="form-control" />
                             </div>
                             </div>
                            <?php 
                            //  dd($module->date);
                            ?>
                             <div class="col-md-4" >
                               <div class="form-group">
                                <label for="simpleinput">Date</label>
                                <input value="@if($module->date){{$module->date->format('Y-m-d')}}@endif" name="date" type="date"  class="form-control" />
                             </div>
                           </div>
                           
                           <div class="col-md-4" >
                              <div class="form-group">
                                <label for="simpleinput">Payment type</label>
                                <select name="payment_type" class="form-control payment_type" >
                                    <option @if($module->payment_type == 'credit') {{'selected'}} @endif value="credit">Credit</option>
                                    <option @if($module->payment_type == 'cash') {{'selected'}} @endif value="cash">Cash</option>
                                </select>
                              </div>
                           </div>
                           
                            <div class="col-md-4 payment_days" >
                              <div class="form-group">
                                <label for="simpleinput">Number of Credit Days</label>
                                <select name="payment_days" class="form-control " >
                                    <option @if($module->payment_days == '0') {{'selected'}} @endif value="0">Select Days</option>
                                    <option @if($module->payment_days == '45') {{'selected'}} @endif value="45" >45 days</option>
                                    <option @if($module->payment_days == '60') {{'selected'}} @endif value="60">60 days</option>
                                    <option @if($module->payment_days == '90') {{'selected'}} @endif value="90">90 days</option>
                                </select>
                              </div>
                           </div>
                           
                           <div class="col-md-4" >
                               <div class="form-group">
                                <label for="simpleinput">Opening Balance</label>
                                <input value="{{$module->opening_balance}}" step=".01" name="opening_balance" type="number"  class="form-control" />
                             </div>
                           </div>
                           
                           <div class="col-md-12 text-center " >
                                <div class="form-group">
                                  <button type="submit" class="btn btn-info">Submit</button>
                               </div>
                           </div>
                      </div>
                </form>
            </div>
        </div>
    </div>
 </div>
@endsection
@section('js')
<script>
    $(document).ready(function () {
        
         $('.payment_type').on('change', function() {
             if(this.value == 'credit'){
                 $('.payment_days').show();
             }else{
                 $('.payment_days').hide();
                 $('.payment_days select').val("0").change();
             }
         }).change();
     
    });
</script>
@endsection