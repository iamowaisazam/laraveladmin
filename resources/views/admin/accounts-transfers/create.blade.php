@extends('admin.layouts.admin')
@section('title','Accounts')
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
                      <h4 class="mb-0 font-size-18">Transfers</h4>
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
             <form method="post" action="{{route('admin.accounts_transfers.store')}}"  >
                @csrf
                
                <div class="card">
                  <div class="card-body">
                    <div class="container-fluid">
                        <div class="py-3 container-fluid">
                            <div class="row">
                                
                                 <div class="col-3">
                                     <div class="form-group">
                                        <label>Transform From (Account)</label>
                                        <select class="form-control trasnfer_from" name="sender_id" >
                                            @foreach($accounts as $account)
                                                <option value="{{$account->id}}">{{$account->account_name}}</option>
                                            @endforeach
                                        </select>
                                     </div>
                                </div>
                                
                                <div class="col-3">
                                     <div class="form-group">
                                        <label>Transform To (Account)</label>
                                        <select class="form-control trasnfer_to" name="receiver_id" >
                                            @foreach($accounts as $account)
                                               <option value="{{$account->id}}">{{$account->account_name}}</option>
                                            @endforeach
                                        </select>
                                     </div>
                                </div>
                                
                                 <div class="form-group col-md-3">
                                        <label for="date">Date</label>
                                        <input required type="date" name="date" class="form-control date">
                                </div>
                                
                                <div class="bal form-group col-md-3">
                                    <label>Amount</label>
                                    <input required  min="1" type="number" name="amount" class="form-control amount" value="0" >
                                    @if($errors->has('amount'))
                                     <div class="text-danger">{{ $errors->first('amount') }}</div>
                                    @endif
                                </div>
                                
                                 <div class="bank col-md-12">
                                     <div class="form-group">
                                        <label for="simpleinput">Remarks</label>
                                        <textarea name="remarks" class="form-control" ></textarea>
                                     </div>
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
        
     $('.account_type').on('change', function() {
         
          if(this.value == 'Cash'){
             $('.bank input').val('');
             $('.bank').hide();
         }else{
             $('.bank').show();
         }
         
     }).change();
     
     
     $('.opening_balance').on('change', function() {
         
         if(this.value == 'Yes'){
             $('.bal').show();
         }else{
             $('.bal').hide();
             $('.bal input').val(0);
         }
         
     }).change();
     
    
    });
</script>
@endsection