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
                    <h4 class="card-title">Create</h4>
                  </div>
                  <div class="col-6 text-right ">
                    <a class="btn btn-primary" href="{{route('admin.vendors.index')}}">Back</a>
                  </div>
                </div>
              </div>

              <form  method="post" action="{{route('admin.vendors.store')}}"  >
                  @csrf
                   <div class="row" >
                              <div class="col-md-3" >
                              <div class="form-group">
                                  <label for="simpleinput">Name</label>
                                  <input value="{{old('name')}}" required name="name" type="text"  class="form-control" />
                                  @if($errors->has('name'))
                                    <div class="error text-danger">{{ $errors->first('name') }}</div>
                                  @endif
                              </div>
                             </div>
                             
                              <div class="col-md-3" >
                              <div class="form-group">
                                  <label for="simpleinput">Email</label>
                                  <input value="{{old('email')}}"  name="email" type="text"  class="form-control" />
                                  @if($errors->has('email'))
                                    <div class="error text-danger">{{ $errors->first('email') }}</div>
                                  @endif
                             </div>
                             </div>
                             
                             <div class="col-md-3" >
                             <div class="form-group">
                                <label for="simpleinput">Address</label>
                                <input value="{{old('address')}}" name="address" type="text"  class="form-control" />
                             </div>
                            </div>
                            
                            
                            <div class="col-md-3" >
                             <div class="form-group">
                                <label for="simpleinput">Country</label>
                                <input value="{{old('country')}}" name="country" type="text"  class="form-control" />
                             </div>
                             </div>
                             
                             <div class="col-md-3" >
                             <div class="form-group">
                                <label for="simpleinput">City</label>
                                <input value="{{old('city')}}" name="city" type="text"  class="form-control" />
                             </div>
                             </div>
                             
                             <div class="col-md-3" >
                             <div class="form-group">
                                <label for="simpleinput">Telephone</label>
                                <input value="{{old('tel')}}" name="tel" type="text"  class="form-control" />
                             </div>
                            </div>
                            
                             <div class="col-md-3" >
                             <div class="form-group">
                                <label for="simpleinput">RES#</label>
                                <input value="{{old('res')}}" name="res" type="text"  class="form-control" />
                             </div>
                            </div>
                            
                             <div class="col-md-3" >
                             <div class="form-group">
                                <label for="simpleinput">FAX#</label>
                                <input value="{{old('fax')}}" name="fax" type="text"  class="form-control" />
                             </div>
                            </div>
                            
                            <div class="col-md-3" >
                             <div class="form-group">
                                <label for="simpleinput">S.Man</label>
                                <input value="{{old('s_man')}}" name="s_man" type="text"  class="form-control" />
                             </div>
                            </div>
                            
                            <div class="col-md-3" >
                             <div class="form-group">
                                <label for="simpleinput">Mobile</label>
                                <input value="{{old('mobile')}}" name="mobile" type="text"  class="form-control" />
                             </div>
                            </div>
                            
                            <div class="col-md-3" >
                             <div class="form-group">
                                <label for="simpleinput">STRN</label>
                                <input value="{{old('strn')}}" name="strn" type="text"  class="form-control" />
                             </div>
                            </div>
                            
                            <div class="col-md-3" >
                             <div class="form-group">
                                <label for="simpleinput">NTN</label>
                                <input value="{{old('ntn')}}" name="ntn" type="text"  class="form-control" />
                             </div>
                            </div>
                             
                            <div class="col-md-4" >
                              <div class="form-group">
                                <label for="simpleinput">Date</label>
                                <input name="date" type="date"  class="form-control" />
                             </div>
                            </div>
                           
                           <div class="col-md-4" >
                              <div class="form-group">
                                <label for="simpleinput">Payment type</label>
                                <select name="payment_type" class="form-control payment_type" >
                                    <option value="credit">Credit</option>
                                    <option value="cash">Cash</option>
                                </select>
                              </div>
                           </div>
                           
                            <div class="col-md-4 payment_days" >
                              <div class="form-group">
                                <label for="simpleinput">Number of Credit Days</label>
                                <select name="payment_days" class="form-control " >
                                    <option value="0" >Select Days</option>
                                    <option value="45" >45 days</option>
                                    <option value="60">60 days</option>
                                    <option value="90">90 days</option>
                                </select>
                              </div>
                           </div>
                           
                           <div class="col-md-4" >
                             <div class="form-group">
                                <label for="simpleinput">Opening Balance</label>
                                <input value="{{old('opening_balance')}}" name="opening_balance" type="number" step=".01"  class="form-control" />
                             </div>
                           </div>
                           
                           <div class="col-md-12 text-center " >
                               <button type="submit" class="btn btn-info">Submit</button>
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