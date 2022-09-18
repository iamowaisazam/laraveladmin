@extends('admin.layouts.admin')
@section('title','Sale Bill')
@section('css')

    <link href="{{asset('admin/plugins/datatables/table.css')}}" rel="stylesheet">
    <style>
            .normal-btn {
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
              <h4 class="mb-0 font-size-18">Sale Bill</h4>
              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                      <li class="breadcrumb-item active"> sale-bills</li>
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
                          <h4 class="card-title">{{$customer->name}} Lots </h4>
                        </div>
                        <div class="col-6 text-right ">
                          <button class="create_invoice btn btn-primary" >Create Bill</button>
                        </div>
                      </div>

                      <div class="table-responsive">
                        <table class="table data-table">
                          <thead>
                              <tr>
                                  <th>Date</th>
                                  <th>Lot</th>
                                  <th>Quality</th>
                                  <th>Color</th>
                                  <th>Job</th>
                                  <th>Weight</th>
                                  <th>Status</th>
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


    <form class="my_form d-none " action="{{route('admin.sale-bills.add')}}" method="post" >
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
                    <input type="hidden" name="lot_id" class="lot_id" value="" />
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Create Bill</button>
              </div>
       </form>
@endsection

@section('js')
  
<script src="{{asset('admin/plugins/datatables/table.js')}}"></script>
<script>
  $(document).ready(function(){

    var table = $('.data-table').DataTable({
      processing: true,
      serverSide: true,
      pageLength: 100,
      ajax: "{{route('admin.sale-bills.create',$customer->id) }}",
      columns: [
                  { 
                    data: 'date', 
                    name: 'date'
                  },
                  {
                    data: 'serial_no', 
                    name: 'serial_no'
                  },
                  { 
                    data: 'fabric_quality', 
                    name: 'fabric_quality'
                  },
                  { 
                    data: 'color', 
                    name: 'color'
                  },
                  { 
                    data: 'party_job_number', 
                    name: 'party_job_number'
                  },
                   { 
                    data: 'total_weight', 
                    name: 'total_weight'
                  },
                  { 
                    data: 'status', 
                    name: 'status'
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
                $('.lot_id').val(selected.toString());
                $('.my_form').trigger('submit');
              }else{
                    toastr.warning('Please Select Receipt');
              }
       });

  });
</script>
@endsection