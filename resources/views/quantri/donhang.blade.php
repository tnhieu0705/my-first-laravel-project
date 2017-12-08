@extends('master')

@section('breadcrumb-item')
<li class="breadcrumb-item active">Danh sách đơn hàng</li>
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
		<h1 class="page-header">Danh sách đơn hàng
			{{-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-create" title="Thêm mới" id="get-modalCreate">
				<i class="fa fa-fw fa-plus"></i>
			</button> --}}
		</h1>
		<!-- Example DataTables Card-->
		<div class="table-responsive" style="padding-bottom: 18px">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr class="odd gradeX" align="center">
						<th>Mã đơn hàng</th>
						<th>Khách hàng</th>
						<th>Nhân viên xử lý</th>
						<th>Trạng thái</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($ds_donhang as $donhang) 
					<tr>
						<td align="left">{{ $donhang->dh_ma }}</td>
						<td align="left">{{ $donhang->thuocKhachHang->kh_hoTen }}</td>
						<td align="left">{{ $donhang->nhanVienXuLy($donhang->nv_xuLy) }}</td>
						@switch($donhang->dh_trangThai)
						@case('1')
						<td align="left">Nhận đơn</td>
						@break
						@endcase
						@endswitch
						
						<td align="center">
							<a type="" class="btn btn-info btn-xs " data-placement="bottom" title="Chi tiết" href="{{ route('donhang.show', $donhang->dh_ma) }}">
								<i class="fa fa-fw fa-info"></i>
							</a>
							{{-- <button type="button" class="btn btn-info btn-xs get-modalEdit" data-toggle="modal" data-target="#modal-create" data-placement="bottom" title="Chỉnh sửa" onclick="getModalEdit({{ $donhang->dh_ma }})">
								<i class="fa fa-fw fa-pencil-square-o"></i>
							</button> --}}
							<a type="" class="btn btn-danger btn-xs xoa" data-placement="bottom" title="Xóa" onclick="deleteOrder({{ $donhang->dh_ma }})" href="#">
								<i class="fa fa-fw fa-trash"></i>
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
		"columnDefs": [{
			"searchable": true,
			"targets": 0
		}]
	} );
</script>

<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	function deleteOrder(id) {
		var del = confirm("Bạn chắc chắn muốn xóa ?");
		if(del) {
			$.ajax({
				dataType: 'json',
				url: 'http://localhost:1000/www/my-project/public/quantri/donhang/' +id,
				type: 'delete',
				success: function(data) {
					console.log(data);
				}
			}).done(function(data) {
				$('#modal-dialog').modal('show');
				$('.modal-title').append('Xóa đơn hàng');
				var message = '';
				message = message + '<span>';
				message = message + '<i class="fa fa-fw fa-check"></i> ';
				message = message + ' Xóa <b>thành công</b> đơn hàng ' + '<b>' + data.donhang + '</b>' ;
				message = message + '</span>';
				$('#message').append(message);
				$('.close').on('click', function() {
					window.location.reload();
				});
			});
		} else return false;
	}
</script>
@stop