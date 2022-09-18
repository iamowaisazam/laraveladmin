@extends('admin.layouts.admin')
@section('title','Customer Receivables')
@section('css')
 <style>
 
        .normal-btn{
              background: white;
            border: none;
        }

</style>
@endsection
@section('content')
<div class="container-fluid">
    
        <!-- start page title -->
            <div class="row">
              <div class="col-12">
                  <div class="page-title-box d-flex align-items-center justify-content-between">
                      <h4 class="mb-0 font-size-18">Customer Receivables</h4>
                      <div class="page-title-right">
                          <ol class="breadcrumb m-0">
                              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                              <li class="breadcrumb-item active">accounts</li>
                          </ol>
                      </div>
                      
                  </div>
              </div>
          </div>
        <!-- end page title -->

          <div class="row">
            <div class="col-12">
             <form method="post" action="{{route('admin.accounts_customersreceivables.store')}}"  >
                @csrf
                
                <div class="card">
                  <div class="card-body">
                    <div class="container-fluid">
                            <div class="row">
                                
                                <div class="form-group col-md-3">
                                     <label for="date">Date</label>
                                     <input type="date" name="date" class="form-control date" />
                                </div>
                                
                                <div class="col-md-3">
                                     <div class="form-group">
                                        <label>Select Customer</label>
                                        <select name="customer_id" class="customer_id form-control " >
                                            @foreach(Con::customers() as $customer)    
                                              <option data-id="{{Con::customer_balance($customer->id)}}" value="{{$customer->id}}" >{{$customer->name}}</option>
                                            @endforeach
                                        </select>
                                     </div>
                                </div>
                               
                                <div class="col-md-3">
                                     <div class="form-group ">
                                        <label>Balance</label>
                                        <input readonly value="1233"  class="customer_balance form-control">
                                     </div>
                                </div>
                                
                                <div class="col-md-3">
                                     <div class="form-group">
                                        <label>Receive in:</label>
                                        <select name="receive_in" class="form-control receive_in" >
                                              <option>Account</option>
                                              <option>Vendor</option>
                                        </select>
                                     </div>
                                </div>
                                
                                <div class="col-md-3 vendor">
                                     <div class="form-group">
                                        <label>Select Vendor</label>
                                        <select name="vendor_id" class="form-control">
                                            @foreach(Con::vendors() as $vendor)    
                                              <option value="{{$vendor->id}}" >{{$vendor->name}}</option>
                                            @endforeach
                                        </select>
                                     </div>
                                </div>
                                
                                <div class="col-md-3 account">
                                     <div class="form-group">
                                        <label>Select Account</label>
                                        <select name="account_id" class="form-control" >
                                            @foreach(Con::accounts() as $account)    
                                              <option value="{{$account->id}}" >{{$account->account_name}}</option>
                                            @endforeach
                                        </select>
                                     </div>
                                </div>
                                
                                <div class="col-md-3">
                                     <div class="form-group">
                                        <label>Payment Type</label>
                                        <select name="payment_type" class="form-control payment_type" >
                                              <option>Cash</option>
                                              <option>Cheque</option>
                                              <option>Online Transfer</option>
                                        </select>
                                     </div>
                                </div>
                                
                                <div class="col-md-3 bank_name">
                                     <div class="form-group">
                                        <label>Bank Name</label>
                                        <input  name="bank_name" class="form-control">
                                     </div>
                                </div>
                                
                                <div class="col-md-3 branch_name">
                                     <div class="form-group">
                                        <label>Branch Name</label>
                                        <input  name="branch_name" class="form-control">
                                     </div>
                                </div>
                                
                                <div class="col-md-3 account_title">
                                     <div class="form-group">
                                        <label>Account Title</label>
                                        <input  name="account_title" class="form-control">
                                     </div>
                                </div>
                                
                                <div class="col-md-3 cheque">
                                     <div class="form-group">
                                        <label>Cheque #</label>
                                        <input  name="cheque" class="form-control">
                                     </div>
                                </div>
                                
                                <div class="col-md-3 cheque_date">
                                     <div class="form-group">
                                        <label>Cheque Date</label>
                                        <input  name="cheque_date" type="date" class="form-control">
                                     </div>
                                </div>
                                
                                <div class="col-md-3 ">
                                     <div class="form-group">
                                        <label>Amount</label>
                                        <input step=".01" min="0" required name="amount" type="number" class="amount form-control">
                                     </div>
                                </div>
                                
                                 <div class="col-md-3">
                                     <div class="form-group ">
                                        <label>New Balance</label>
                                        <input readonly  class="new_balance form-control">
                                     </div>
                                </div>
                                
                                 <div class="col-md-12 ">
                                     <div class="form-group ">
                                        <label>Remarks</label>
                                        <textarea name="remarks" class="form-control" ></textarea>
                                     </div>
                                </div>
                            </div>
                     
                       <div class="row" >   
                            <div class="col-md-12 pt-5 py-3 text-center" >
                                  <button type="submit" class="btn btn-info">Submit</button>
                            </div>
                        </div>
                      </div>
                  </div>
              </div>
           </form>
         </div>
     </div>
 </div>
@endsection
@section('js')
<script>
    $(document).ready(function () {
        
     
    $('.customer_id,.amount').on('change', function() {
          call();
    }).change(); 
    
    
    function call(){
        
         let balance = $('.customer_id').find(':selected').data('id');
         let amount = $('.amount').val();  
         balance = parseFloat(balance);
         let result = balance - amount;
         
         $('.customer_balance_balance').val(balance);
         $('.new_balance').val(result);
    }
        
    
     $('.receive_in').on('change', function() {
        
         if(this.value == 'Vendor'){
            $('.account').hide();    
            $('.vendor').show();    
         }else{
            $('.account').show();    
            $('.vendor').hide();   
         }
         
     }).change();
     
     
     $('.payment_type').on('change', function() {
         
         if(this.value == 'Cash'){
             $('.bank_name').hide();
             $('.branch_name').hide();
             $('.account_title').hide();
             $('.cheque').hide();
             $('.cheque_date').hide();
        
         }else if(this.value == 'Cheque'){
             
             $('.bank_name').show();
             $('.branch_name').show();
             $('.account_title').show();
             $('.cheque').show();
             $('.cheque_date').show();
             
         }else{
             
             $('.bank_name').show();
             $('.branch_name').show();
             $('.account_title').show();
             $('.cheque').hide();
             $('.cheque_date').hide();
             
         }
         
     }).change();
     
    
    });
</script>
@endsection