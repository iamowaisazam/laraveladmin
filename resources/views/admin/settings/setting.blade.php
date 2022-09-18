@extends('admin.layouts.admin')
@section('title','Settings')
@section('css')


@endsection
@section('content')
<div class="container-fluid">
    
            <!-- start page title -->
                <div class="row">
                  <div class="col-12">
                      <div class="page-title-box d-flex align-items-center justify-content-between">
                          <h4 class="mb-0 font-size-18">Settings</h4>
                          <div class="page-title-right">
                              <ol class="breadcrumb m-0">
                                  <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                                  <li class="breadcrumb-item active"> Settings</li>
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
                                <h4 class="card-title">All Settings</h4>
                              </div>
                              <div class="col-6 text-right ">
                                <a class="btn btn-primary" href="{{route('admin.home')}}">Back</a>
                              </div>
                            </div>
                          </div>
                          <form  method="post" action="{{route('admin.settings.update')}}"  >
                                  @csrf
                                    <div class="form-group">
                                        <label for="simpleinput">GST</label>
                                        <input required name="gst" type="number" value="{{$settings['gst']}}"  class="form-control" />
                                    </div>
                                    <div class="form-group">
                                      <button type="submit" class="btn btn-info">Submit</button>
                                   </div>
                           </form>
                        </div>
                      </div>
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