@extends('master')

@section('breadcrumb-item')
<li class="breadcrumb-item active">Tổng quan</li>
@stop

@section('noiDung')
<div class="row">
	<div class="col-xl-3 col-sm-6 mb-3">
		<div class="card text-white bg-primary o-hidden h-100">
			<div class="card-body">
				<div class="card-body-icon">
					<i class="fa fa-fw fa-users"></i>
				</div>
				<div class="mr-5">Tổng số {{ count($ds_nhanvien) }} nhân viên</div>
			</div>
			<a class="card-footer text-white clearfix small z-1" href="#" onclick="ktQuyen({{ Session::get('nhanvien_quyen') }}, 'nhanvien')">
				<span class="float-left">Xem chi tiết</span>
				<span class="float-right">
					<i class="fa fa-angle-right"></i>
				</span>
			</a>
		</div>
	</div>
	<div class="col-xl-3 col-sm-6 mb-3">
		<div class="card text-white bg-success o-hidden h-100">
			<div class="card-body">
				<div class="card-body-icon">
					<i class="fa fa-fw fa-cubes"></i>
				</div>
				<div class="mr-5">{{ count($ds_sanpham) }} sản phẩm</div>
			</div>
			<a class="card-footer text-white clearfix small z-1" href="{{ asset('quantri/sanpham') }}">
				<span class="float-left">Xem chi tiết</span>
				<span class="float-right">
					<i class="fa fa-angle-right"></i>
				</span>
			</a>
		</div>
	</div>
	<div class="col-xl-3 col-sm-6 mb-3">
		<div class="card text-white bg-danger o-hidden h-100">
			<div class="card-body">
				<div class="card-body-icon">
					<i class="fa fa-fw fa-shopping-cart"></i>
				</div>
				<div class="mr-5">{{ count($ds_donhang) }} đơn hàng</div>
			</div>
			<a class="card-footer text-white clearfix small z-1" href="{{ asset('quantri/donhang') }}">
				<span class="float-left">Xem chi tiết</span>
				<span class="float-right">
					<i class="fa fa-angle-right"></i>
				</span>
			</a>
		</div>
	</div>
	{{-- <div class="col-xl-3 col-sm-6 mb-3">
		<div class="card text-white bg-danger o-hidden h-100">
			<div class="card-body">
				<div class="card-body-icon">
					<i class="fa fa-fw fa-support"></i>
				</div>
				<div class="mr-5">13 New Tickets!</div>
			</div>
			<a class="card-footer text-white clearfix small z-1" href="#">
				<span class="float-left">View Details</span>
				<span class="float-right">
					<i class="fa fa-angle-right"></i>
				</span>
			</a>
		</div>
	</div> --}}
</div>
@stop

@section('thuVien')
<script type="text/javascript" src="{{ asset('app/controllers/NhanvienController.js') }}"></script>
@stop