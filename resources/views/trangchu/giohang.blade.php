@extends('trangchu/trangchu_master')

@section('noiDung')
@if(count($cart))
<div class="row mt-4">
	
	<table class="table table-striped" width="100%" cellspacing="0">
		<thead>
			<tr class="odd gradeX" align="center">
				<th>#</th>
				<th>Sản phẩm</th>
				<th>Số lượng</th>
				<th>Đơn giá (VND)</th>
				<th>Tổng giá (VND)</th>
				<th><a href="{{ route('giohang') }}" title=""><i class="fa fa-fw fa-refresh"></i></a></th>
			</tr>
		</thead>
		<tbody>
			<?php
			$stt = 1;
			?>
			@foreach($cart as $item)
			<tr>
				<th scope="row">{!! $stt++ !!}</th>
				<td>{{ $item->name }}</td>
				<td>
					<input class="sl-sanpham" type="text" size="1" value="{{ $item->qty }}" width="100%">
				</td>
				<td>{{ number_format($item->price, '0', ',', '.') }}</td>
				<td>{{ number_format($item->price * $item->qty, '0', ',', '.') }}</td>
				<td>
					<a href="#" class="capnhat-soluong" id="{{ $item->rowId }}"><i class="fa fa-fw fa-cart-plus"></i></a>
					<a href="{{ asset('xoahang/'.$item->rowId) }}"><i class="fa fa-fw fa-trash"></i></a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	<div class="container">
		<div class="pull-right mb-4">
			<table class="table table-bordered">
				<thead>
					<tr class="odd gradeX" align="center">
						<th colspan="2">Thông tin đơn hàng</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><span>Tạm tính</span></td>
						<td>{{ number_format($total, '0') }} VND</td>
					</tr>
					<tr style="color: red;">
						<td><span>Thành tiền</span></td>
						<td><b>{{ number_format($total, '0') }} VND</b></td>
					</tr>
					<tr>
						<td colspan="2"><a href="{{ asset('donhang') }}" class="btn btn-block btn-success">Đặt hàng</a></td>
					</tr>
				</tbody>
			</table>
		</div>		
	</div>
</div><!-- /.row -->
@else
<div class="row justify-content-center mt-4 mb-4">
	@if(Session::has('orderMessage'))
	<h4>{{ Session::get('orderMessage') }}</h4>
	@else
	<h4>Không có sản phẩm nào trong giỏ hàng</h4>
	@endif
	<a href="{{ asset('/') }}" class="btn btn-primary ml-2">Mua hàng</a>
</div>
@endif
@stop

@section('thuVien')
<script type="text/javascript">
	$(document).ready(function() {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$('.capnhat-soluong').on('click', function(e) {
			e.preventDefault();
			var rowId = $(this).attr('id');
			var sl = $(this).parent('td').siblings().find('.sl-sanpham').val();
			
			$.ajax({
				dataType: 'json',
				url: 'capnhat/' + rowId + '/' + sl,
				type: 'get',
				data: {
					'rowId': rowId,
					'sl': sl
				},
				success: function(response) {
					if(!response.error) {
						window.location = 'giohang';
					} else {
						alert(response.message);
					}
				}
			});
		});
	});	
</script>
@stop