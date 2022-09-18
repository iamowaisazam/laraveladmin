@extends('admin.layouts.admin')
@section('title','Dashboard')
@section('css')
<style>
	.panel {
  box-shadow: 0 2px 0 rgba(0,0,0,0.05);
  border-radius: 0;
  border: 0;
  margin-bottom: 24px;
}

.panel-dark.panel-colorful {
  background-color: #3b4146;
  border-color: #3b4146;
  color: #fff;
}

.panel-danger.panel-colorful {
  background-color: #f76c51;
  border-color: #f76c51;
  color: #fff;
}

.panel-primary.panel-colorful {
  background-color: #3281f2;
  border-color: #5fa2dd;
  color: #fff;
}

.panel-info.panel-colorful {
  background-color: #d93232;
  border-color: #4ebcda;
  color: #fff;
}

.panel-warning.panel-colorful {
  background-color: #cde721;
  border-color: #4ebcda;
  color: #fff;
}

.panel-success.panel-colorful {
  background-color: #16bf5e;
  border-color: #4ebcda;
  color: #fff;
}

.panel-purple.panel-colorful {
  background-color: #cb4ee5;
  border-color: #4ebcda;
  color: #fff;
}

.panel-pink.panel-colorful {
  background-color: #e74d7b;
  border-color: #4ebcda;
  color: #fff;
}

.panel-cgreen.panel-colorful {
  background-color: #0fd1b2;
  border-color: #4ebcda;
  color: #fff;
}

.panel-brown.panel-colorful {
  background-color: #d1910ff5;
  border-color: #4ebcda;
  color: #fff;
}










.panel-body {
  padding: 25px 20px;
}

.panel hr {
  border-color: rgba(0,0,0,0.1);
}

.mar-btm {
  margin-bottom: 15px;
}

h2, .h2 {
  font-size: 28px;
}

.small, small {
  font-size: 85%;
}

.text-sm {
  font-size: .9em;
}

.text-thin {
  font-weight: 300;
}

.text-semibold {
  font-weight: 600;
}
</style>
       
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
					</ol>
				</div>
			</div>
		</div>
	</div>     
	<!-- end page title -->
</div>

<div class="container-fluid bootstrap snippets bootdey">
	<div class="row">
		<div class="col-md-12">
			<div class="row ">
				<div class=" col-md-3 col-sm-6 col-xs-12">
					<a href="#">
					<div class="panel panel-primary panel-colorful">
						<div class="panel-body text-center">
							<p class="text-uppercase mar-btm text-sm">Vendors</p>
							<i class="fas fa-people-carry fa-5x"></i>
							<hr>
							<p class="text-white h4 text-thin m-0">254,487</p>
						</div>
					</div>
					</a>
				</div>

				<div class=" col-md-3 col-sm-6 col-xs-12">
					<a href="#">
					<div class="panel panel-success panel-colorful">
						<div class="panel-body text-center">
							<p class="text-uppercase mar-btm text-sm">Categories</p>
							<i class="fas fa-users fa-5x"></i>
							<hr>
							<p class="text-white h4 text-thin m-0">254,487</p>
						</div>
					</div>
					</a>
				</div>

				<div class=" col-md-3 col-sm-6 col-xs-12">
					<a href="#">
					<div class="panel panel-info panel-colorful">
						<div class="panel-body text-center">
							<p class="text-uppercase mar-btm text-sm">Products</p>
							<i class="fab fa-product-hunt fa-5x"></i>
							<hr>
							<p class="text-white h4 text-thin m-0">254,487</p>
						</div>
					</div>
					</a>
				</div>

				<div class=" col-md-3 col-sm-6 col-xs-12">
					<a href="#">
					<div class="panel panel-warning panel-colorful">
						<div class="panel-body text-center">
							<p class="text-uppercase mar-btm text-sm">SubCategories</p>
							<i class="fa fa-shopping-cart fa-5x"></i>
							<hr>
							<p class="text-white h4 text-thin m-0">254,487</p>
						</div>
					</div>
					</a>
				</div>

				{{-- <div class=" col-md-3 col-sm-6 col-xs-12">
					<a href="">
					<div class="panel panel-purple panel-colorful">
						<div class="panel-body text-center">
							<p class="text-uppercase mar-btm text-sm">Expenses </p>
							<i class="far fa-credit-card fa-5x"></i>
							<hr>
							<p class="text-white h4 text-thin m-0">Add New</p>
						</div>
					</div>
					</a>
				</div>
				
				<div class=" col-md-3 col-sm-6 col-xs-12">
					<div class="panel panel-pink panel-colorful">
						<div class="panel-body text-center">
							<p class="text-uppercase mar-btm text-sm">Inventory </p>
							<i class="fa fa-shopping-cart fa-5x"></i>
							<hr>
							<p class="text-white h4 text-thin m-0">View</p>
						</div>
					</div>
				</div>

				<div class=" col-md-3 col-sm-6 col-xs-12">
					<div class="panel panel-cgreen panel-colorful">
						<div class="panel-body text-center">
							<p class="text-uppercase mar-btm text-sm">Stock Adjustment </p>
							<i class="far fa-credit-card fa-5x"></i>
							<hr>
							<p class="text-white h4 text-thin m-0">View</p>
						</div>
					</div>
				</div>

				<div class=" col-md-3 col-sm-6 col-xs-12">
					<div class="panel panel-brown panel-colorful">
						<div class="panel-body text-center">
							<p class="text-uppercase mar-btm text-sm">Settings</p>
							<i class="fa fa-shopping-cart fa-5x"></i>
							<hr>
							<p class="text-white h4 text-thin m-0">View</p>
						</div>
					</div>
				</div> --}}

			</div>
		</div>
		<div class="col-md-3">


			
		</div>
	</div>




</div>

	
@endsection
@section('js')


      
@endsection
