@extends('admin.layouts.admin')
@section('title','Sale Invoice')
@section('css')
<link href="{{asset('admin/plugins/datatables/table.css')}}" rel="stylesheet">
<style>
        .normal-btn{
          background: white;
          border: none;
        }

        .table{
          width: 100%!important;
        }
</style>
@endsection
@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
      <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18">Sale Invoice</h4>
              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                      <li class="breadcrumb-item active"> sale-invoices</li>
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
                      <div class="py-3 row">
                        <div class="col-6">
                          <h4 class="card-title">{{$customer->name}} Bills </h4>
                        </div>
                        <div class="col-6 text-right ">
                          <button class="create_invoice btn btn-primary" >Create Invoice</button>
                        </div>
                      </div>

                      <div class="table-responsive">
                        <table class="table data-table">
                          <thead>
                              <tr>
                                  <th>Bills</th>
                                  <th>Date</th>
                                  <th width="100px">Action</th>
                              </tr>
                          </thead>
                          <tbody>
                          </tbody>
                      </table>
                    </div>
                    </div>
                  </div>
              </div>
          </div>
      </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form class="myform" action="{{route('admin.sale-invoices.add')}}" method="post" >
             @csrf
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Sale Bill</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-container">
                    <input type="hidden" name="customer_id" value="{{$customer->id}}" />
                    <input type="hidden" name="challan_id" class="challan_id" value="" />
                    <label for="">GST Apply ?</label>
                    <select name="gst" class="form-control" > 
                      <option value="1" >Yes</option>
                      <option value="0" >No</option>
                    </select>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Create Bill</button>
              </div>
       </form>
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
      pageLength: 100,
      ajax: "{{route('admin.sale-invoices.create',$customer->id) }}",
      columns: [
                  {
                    data: 'serial_no', 
                    name: 'serial_no'
                  },
                  { 
                    data: 'date', 
                    name: 'date'
                  },
                  { 
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false
                  },
              ]
    });


        $('.create_invoice').click(() => {
              var selected = [];
              $('tbody input:checked').each(function() {
                  selected.push($(this).val());
              });
              
              if(selected.length != 0){
                
                $('.challan_id').val(selected.toString());
                $('.myform').trigger('submit');
                
              }else{
                    toastr.warning('Please Select Bill');
              }
       });

  });
</script>
@endsection