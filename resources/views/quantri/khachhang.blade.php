@extends('master')

@section('breadcrumb-item')
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
		<h1 class="page-header">Danh sách khách hàng
		</h1>
		<!-- Example DataTables Card-->
		<div class="table-responsive" style="padding-bottom: 18px">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead >
					<tr class="odd gradeX" align="center">
						<th>Họ tên</th>
						<th>Giới tính</th>
						<th>Email</th>
						<th>Điện thoại</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($ds_khachhang as $khachhang) 
					<tr>
						<td align="left">{{ $khachhang->kh_hoTen }}</td>
						@if($khachhang->kh_gioiTinh == 1)
						<td align="center"><i class="fa fa-fw fa-male"></i></td>
						@else
						<td align="center"><i class="fa fa-fw fa-female"></i></td>
						@endif	
						<td align="left">{{ $khachhang->kh_email }}</td>
						@if($khachhang->kh_dienThoai != '')
						<td align="left">{{ $khachhang->kh_dienThoai }}</td>
						@else
						<td align="left">Chưa cập nhật</td>
						@endif				
						<td align="center">
							<a type="" class="btn btn-info btn-xs " data-placement="bottom" title="Chi tiết" href="{{ route('khachhang.show', $khachhang->kh_ma) }}">
								<i class="fa fa-fw fa-info"></i>
							</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Modal dialog #hiển thị thông báo -->
<div class="modal fade" id="modal-dialog" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"></h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<div class="alert alert-success" id="message">
					<!-- Nội dung #thông báo -->
				</div>
			</div>
		</div>
	</div>
</div>
@stop

@section('thuVien')
<script type="text/javascript">
	$('#dataTable').dataTable( {
		"language": {
			"paginate": {
				"next": '<i class="fa fa-fw fa-forward"></i>',
				"previous": '<i class="fa fa-fw fa-backward"></i>'
			},
			"search": "Tìm kiếm",
		},
		"ordering": false,
	} );
</script>

<script type="text/javascript" src="{{ asset('app/controllers/khachhangController.js') }}"></script>
@stop