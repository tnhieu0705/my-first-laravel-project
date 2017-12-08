@extends('master')

@section('breadcrumb-item')
<li class="breadcrumb-item"><a href="{{ asset('quantri/khachhang') }}">Danh sách khách hàng</a></li>
<li class="breadcrumb-item active">Khách hàng</li>
@stop

@section('noiDung')

<style type="text/css" media="screen">
.control-label {
	font-weight: bold;
}
.btn-xs {
	padding: 0.25rem 0.5rem;
	font-size: 0.7rem;
	line-height: 1.5;
	border-radius: 0.2rem;
}
</style>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class="h4 mb-0"><i class="fa fa-info-circle"></i> Thông tin khách hàng</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col">
						Họ tên khách hàng <br>
						Địa chỉ <br>
						Số điện thoại <br>
						Địa chỉ email 
					</div>
					<div class="col">
						{{ $khachhang->kh_hoTen }} <br>
						{{ $khachhang->kh_diaChi }} <br>
						{{ $khachhang->kh_dienThoai }} <br>
						{{ $khachhang->kh_email }}
					</div>
				</div>
			</div>
			<div class="card-footer small text-muted">
				Đăng ký {{ $khachhang->created_at }}
			</div>
		</div>
	</div>
	<div class="col-12 mt-4 mb-4">
		<div class="card">
			<div class="card-header">
				<div class="h5 mb-0"><i class="fa fa-exchange"></i> Lịch sử giao dịch</div>
			</div>
			<div class="card-body">
				<table class="table table-striped mt-0" width="100%" cellspacing="0">
					<thead>
						<tr class="odd gradeX" align="center">
							<th>#</th>
							<th>Ngày đặt</th>
							<th>Giá trị đơn hàng</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$stt = 1;
						?>
						@foreach($ds_donhang as $donhang)
						<tr class="font-weight-normal" align="center">
							<th>{!! $stt++ !!}</th>
							<td>{{ date_format($donhang->dh_thoiGianDatHang, 'd/m/Y H:i:s') }}</td>
							<td>{{ number_format($donhang->giaTriDonHang($donhang->dh_ma)) }} VND</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	<div>
</div>
@stop

@section('thuVien')
@stop