@extends('admin.layouts.admin')
@section('title','Customers')

@section('css')


@endsection

@section('content')
<div class="container-fluid">
        <!-- start page title -->
    <div class="row">
      <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18">Customer</h4>
              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                      <li class="breadcrumb-item active"> customers</li>
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
                    <a class="btn btn-primary" href="{{route('admin.customers.index')}}">Back</a>
                  </div>
                </div>
              </div>

              <form  method="post" action="{{route('admin.customers.update',$module->id)}}"  >
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
                           
                           <div class="col-md-4" >
                               <div class="form-group">
                                <label for="simpleinput">Date</label>
                                <input value="@if($module->date){{$module->date->format('Y-m-d')}}@endif" name="date" type="date"  class="form-control" />
                             </div>
                           </div>
                           
                           <div class="col-md-4" >
                               <div class="form-group">
                                <label for="simpleinput">Balance Type</label>
                                <select name="balance_type" class="form-control" >
                                    <option @if($module->balance_type == 'Debit') {{'selected'}} @endif >Debit</option>
                                    <option @if($module->balance_type == 'Credit') {{'selected'}} @endif >Credit</option>
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

      
        // $(".title").keyup(function(){
        //     var Text = $(this).val();
        //     Text = Text.toLowerCase();
        //     Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
        //     $(".slug").val(Text);        
        // });

    });
      
</script>
@endsection