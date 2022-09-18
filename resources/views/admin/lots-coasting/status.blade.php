@extends('admin.layouts.admin')
@section('title','Lots Status')
@section('css')
<link href="{{asset('admin/plugins/datatables/table.css')}}" rel="stylesheet">
<style>
    .table{
      width: 100%!important;
    }
</style>
  
@endsection
@section('content')
<div class="container-fluid">
    
        <!-- start page title -->
            <div class="beard row">
                <div class="col-12">
                  <div class="page-title-box d-flex align-items-center justify-content-between">
                      <h4 class="mb-0 font-size-18">Lots Status</h4>
                      <div class="page-title-right">
                          <ol class="breadcrumb m-0">
                              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                              <li class="breadcrumb-item active">Lots Status</li>
                          </ol>
                      </div>
                  </div>
                </div>
            </div>
        <!-- end page title -->
        
        <div class="card">
            <div class="py-3 card-body">
                <form class="searchfilter" >
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-5">
                          <div class="form-group" >
                              <label>Start Date</label>
                              <input name="sdate" type="date" class="form-control" value="" />
                          </div>
                      </div>
                      <div class="col-5 text-left ">
                           <div class="form-group" >
                               <label>End Date</label>
                              <input name="edate" type="date" class="form-control" value="" />
                          </div>
                      </div>
                      <div class="col-2 text-left align-self-end">
                           <div class="form-group" >
                               <button class=" btn btn-primary form-control" >Submit</button>
                          </div>
                      </div>
                    </div>
                  </div>
              </form>
          </div>
     </div>
    
        <div class="card">
            <div class="py-3 card-body">
              <div class="table-responsive">
                    <table class="data-table table mb-0">
                        <thead>
                            <tr>
                              <th class="text-left">#</th>
                              <th class="text-left">IssueDate</th>
                              <th class="text-left">Customer</th>
                              <th class="text-left">Color</th>
                              <th class="text-left">Quality</th>
                              <th class="text-left">Party Ch</th>
                              <th class="text-left">Weight / Roll</th>
                              <th class="text-left">Processing</th>
                              <th class="text-left">Machine</th>
                              <th class="text-left">Daying Date</th>
                              <th class="text-left">Status</th>
                              <th class="text-left">Date (Out)</th>
                              <th class="text-left">CH#</th>
                              <th class="text-left">Del. Weight</th>
                              <th class="text-left">Wastage</th>
                              <th class="text-left">Bill Mon</th>
                              <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                         
                        </tbody>
                    </table>
              </div>
          </div>
     </div>
</div>
@endsection
@section('js')

<script src="{{asset('admin/plugins/datatables/table.js')}}"></script>
<script>
$(document).ready(function(){

    var table = $('.data-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{route('admin.lots-status')}}",
      columns: [
                  {
                    data: 'serial_no', 
                    name: 'serial_no',
                    orderable: false, 
                  },
                  {
                    data: 'issue_date', 
                    name: 'issue_date'
                  },
                  {
                    data: 'customer', 
                    name: 'customer'
                  },
                  {
                    data: 'color', 
                    name: 'color'
                  },
                   {
                    data: 'fabric_quality', 
                    name: 'fabric_quality'
                  },
                  {
                    data: 'party_challan', 
                    name: 'party_challan'
                  },
                  {
                    data: 'roll_weight', 
                    name: 'roll_weight'
                  },
                  {
                    data: 'lot_process', 
                    name: 'lot_process'
                  },
                   {
                    data: 'machines', 
                    name: 'machines'
                  },
                  {
                    data: 'daying_date', 
                    name: 'daying_date'
                  },
                  {
                    data: 'status', 
                    name: 'status'
                  },
                  {
                    data: 'date_out', 
                    name: 'date_out'
                  },
                  {
                    data: 'id', 
                    name: 'id'
                  },
                  {
                    data: 'del_weight', 
                    name: 'del_weight'
                  },
                  {
                    data: 'wastage', 
                    name: 'wastage'
                  },
                  {
                    data: 'id', 
                    name: 'id'
                  },
                  { 
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false
                  },
                ]
          });
          
          
          
         $(".searchfilter").submit(function(e){
             
             e.preventDefault();
            let url = "{{route('admin.lots-status')}}";
            var Link = new URL(url);
            table.ajax.url(Link +'?startdate='+e.target.sdate.value+'&enddate='+e.target.edate.value).load();
         });
          
});
</script>

 
@endsection