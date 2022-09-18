
@extends('admin.layouts.admin')
@section('title','Users')

@section('css')


@endsection

@section('content')

 <div class="container-fluid">

  	<!-- start page title -->
      <div class="row">
        <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Dashboard</h4>
            <div class="page-title-right">
              <ol class="breadcrumb m-0">
                <li class="breadcrumb-item active">Dashboard</li>
                <li class="breadcrumb-item ">Users</li>
              </ol>
            </div>
          </div>
        </div>
      </div>     
   <!-- end page title -->


        <!--begin::Card-->
        <div style="max-width:600px;margin:auto; " class="mb-4 card card-custom">
          <div class="card-body">
            <div class=" pt-1 pb-3 container-fluid">
              <div class="row">
                <div class="col-6">
                  <h4 class="card-title">Edit</h4>
                </div>
                <div class="col-6 text-right ">
                  {{-- <a href="{{route('admin.users.create')}}"><i class="fa fa-plus  fa-2x "></i></a> --}}
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 my-2">
              <form method="post" action="{{route('admin.users.update',$data->id)}}"  class="form-horizontal">
                  @csrf
                  @method('PUT')
                <div class="form-body">
                    <div class="row">
                        
                        <div class="col-md-12">
                            <div class="form-group ">
                                <label class="col-form-label text-left">Name</label>
                                <input  pattern="^[a-z0-9]+(?:-[a-z0-9]+)*$"  name="name" value="{{$data->name}}"  class="username form-control " type="text"  />
                                @if($errors->has('name'))
                                    <div class="error text-danger">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group ">
                                <label class="col-form-label text-left">Email</label>
                                  <input  name="email" value="{{$data->email}}" class="form-control " type="email"  />
                                  @if($errors->has('email'))
                                      <div class="error text-danger">{{ $errors->first('email') }}</div>
                                  @endif
                              </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-form-label text-left">Password</label>
                                  <input type="password" name="password" class="form-control" placeholder="leave It Blank" />
                                  @if($errors->has('password'))
                                      <div class="text-danger">{{ $errors->first('password') }}</div>
                                  @endif
                              </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-form-label text-left">Status</label>
                                <select required class="form-control" name="status">
                                  <option {{$data->status == 'apprvoed' ? 'selected' : ''}} value="approved">Approved</option>  
                                  <option {{$data->status == 'pending' ? 'selected' : ''}}  value="pending">Pending</option> 
                                  <option {{$data->status == 'blocked' ? 'selected' : ''}}  value="blocked">Blocked</option>  
                                </select>
                                @if($errors->has('status'))
                                 <div class="text-danger">{{ $errors->first('status') }}</div>
                                @endif
                              </div>
                        </div>

                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                    </div>
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


        $(".username").keyup(function(){
              var Text = $(this).val();
              Text = Text.toLowerCase();
              Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
              $(".username").val(Text);        
          });


    });
</script>
@endsection