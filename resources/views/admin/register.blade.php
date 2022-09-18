@extends('admin.layouts.auth')
@section('title','Register') 
@section('css')
    

@endsection
@section('content')
<div class="bg-primary">
    <div class="container">
        <div class="row">
            <div class="m-auto col-md-6">
                <div class="d-flex align-items-center min-vh-100">
                    <div class="w-100 d-block bg-white shadow-lg rounded my-5">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <form method="post" action="{{route('admin.register_submit')}}"  class="user">
                                        @csrf
                                        
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input name="name" type="text" class="form-control form-control-user" placeholder="Name" value="{{old('name')}}"/>
                                            @if($errors->has('name'))
                                             <span class="d-block mt-2 text-danger">{{ $errors->first('name') }}</span>    
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input  name="email" type="email" class="form-control form-control-user" placeholder="Email Address" value="{{old('email')}}"/>
                                            @if($errors->has('email'))
                                             <span class="d-block mt-2 text-danger">{{ $errors->first('email') }}</span>    
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label>Password</label>
                                            <input  name="password" type="password" class="form-control form-control-user"  placeholder="Password"  />
                                            @if($errors->has('password'))
                                            <span class="d-block mt-2 text-danger">{{ $errors->first('password') }}</span>    
                                            @endif
                                        </div>

                                        <button type="submit" class="btn btn-success btn-block waves-effect waves-light"> Register </button>

                                        <div class="text-center pt-3" >
                                            <a href="{{route('admin.login')}}">Already Have Account ?</a>
                                        </div>
                                    </form>
                                </div> 
                            </div> 
                        </div> 
                    </div> 
                </div> 
            </div> 
        </div> 
    </div>
</div>
@endsection
@section('js')
    



@endsection