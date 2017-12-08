@extends('master')

@section('breadcrumb-item')
<li class="breadcrumb-item"><a href="{{ asset('quantri/donhang') }}">Danh sách đơn hàng</a></li>
<li class="breadcrumb-item active">Đơn hàng</li>
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
				<div class="h4 mb-0"><i class="fa fa-info-circle"></i> Thông tin đơn hàng</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col">
						Mã số đơn hàng <br>
						Họ tên khách hàng <br>
						Thời gian đặt hàng <hr>
						<div class="h4 mb-0 text-success">Thành tiền</div>
					</div>
					<div class="col">
						{{ $donhang->dh_ma }} <br>
						{{ $donhang->thuocKhachHang->kh_hoTen }} <br>
						{{ date_format($donhang->dh_thoiGianDatHang, 'H:i:s | d \t\h\á\n\g m \n\ă\m Y') }} <hr>
						<div class="h4 mb-0 text-success">{{ number_format($dh_tongTien) }} VND</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-12 mb-4">
	<table class="table table-striped mt-4" width="100%" cellspacing="0">
		<thead>
			<tr class="odd gradeX" align="center">
				<th>#</th>
				<th>Sản phẩm</th>
				<th>Số lượng</th>
				<th>Đơn giá (VND)</th>
				<th>Tổng giá (VND)</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$stt = 1;
			?>
			@foreach($ds_sanpham as $sanpham)
			<tr>
				<th>{!! $stt++ !!}</th>
				<td>{{ $sanpham->thuocSanPham->sp_ten }}</td>
				<td align="center">{{ $sanpham->ctdh_soLuong }}</td>
				<td align="center">{{ number_format($sanpham->ctdh_donGia) }}</td>
				<td align="center">{{ number_format($sanpham->ctdh_soLuong * $sanpham->ctdh_donGia) }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<div>
</div>
@stop

@section('thuVien')
@stop