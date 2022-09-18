@extends('admin.layouts.admin')
@section('title','Payables')
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
                      <h4 class="mb-0 font-size-18">Payables</h4>
                      <div class="page-title-right">
                          <ol class="breadcrumb m-0">
                              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                              <li class="breadcrumb-item active">expenses</li>
                          </ol>
                      </div>
                  </div>
              </div>
          </div>
        <!-- end page title -->


          <div class="row">
            <div class="col-12">
             <form method="post" action="{{route('admin.expenses_receivables.store')}}"  >
                @csrf
                <div class="card">
                  <div class="card-body">
                        <div class="py-3 container-fluid">
                            <div class="row">
                                 <div class="col-md-3">
                                     <div class="form-group" >
                                          <label for="date">Date</label>
                                          <input required type="date" name="date" class="form-control date" />
                                     </div>
                                </div>
                    
                                 <div class="col-md-3">
                                     <div class="form-group">
                                        <label>Account</label>
                                        <select class="form-control" name="account_id" >
                                            @foreach(Con::accounts() as $account)
                                                <option value="{{$account->id}}" >{{$account->account_name}}</option>
                                            @endforeach
                                        </select>
                                     </div>
                                </div>
                    
                                <div class="col-md-3">
                                     <div class="form-group">
                                        <label>Expense</label>
                                        <select class="form-control" name="expense_id" >
                                            @foreach(Con::expense_account() as $expense)
                                                <option value="{{$expense->id}}" >{{$expense->account_name}}</option>
                                            @endforeach
                                        </select>
                                     </div>
                                </div>
                    
                                <div class="col-md-3">
                                     <div class="form-group">
                                        <label for="simpleinput">Amount</label>
                                        <input type="number" min="1" required name="amount" class="form-control" value="0" />
                                     </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Remarks</label>
                                        <textarea class="form-control" name="remarks"></textarea>
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
        

     
    });
</script>
@endsection