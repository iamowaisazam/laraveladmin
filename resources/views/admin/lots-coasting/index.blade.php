@extends('admin.layouts.admin')
@section('title','Lot Coasting')
@section('css')

<link href="{{asset('admin/plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />

  <style>
      .normal-btn {
        background: white;
        border: none;
      }
      
      .remove-icon{
            position: absolute;
            right: 0px;
            top: -1px;
      }
      
      .select2-container{
          width:100%!important;
      }
      
      
     .select2-selection--single{
         height: 39px !important;
         padding: 4px 0px !important;
      }
      
      .stock-warning{
        margin: 0px;
        text-align: center;
        background: red;
        color: white;
        font-size: 15px;
        padding: 6px 0px;
      }
  </style>

@endsection
@section('content')
 <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Lot Coasting</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">lot-coasting</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="mb-2 bg-white container-fluid">
            <form class="pt-3" method="get" action="{{route('admin.lots-coasting.edit')}}"  >
                <div class="row" >
                    <div class="col-md-11" >
                        <div class="form-group">
                        <input required name="lot" type="text" value="@if(isset($_GET['lot'])){{$_GET['lot']}}@endif" class="form-control" />
                        </div>       
                    </div>
                    <div class="col-md-1" >
                    <div class="form-group"><button class="btn btn-success" >Search</button></div>       
                    </div>
                </div>
            </form>
        </div>
 </div>
@endsection

@section('js')

 


@endsection