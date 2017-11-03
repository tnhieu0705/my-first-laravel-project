@extends('master')

@section('breadcrumb-item')
<li class="breadcrumb-item active">Quản lý nhân viên</li>
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
		<h1 class="page-header">Danh sách nhân viên
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-create" title="Thêm mới" id="get-modalCreate">
				<i class="fa fa-fw fa-plus"></i>
			</button>
		</h1>
		<!-- Example DataTables Card-->
		<div class="table-responsive" style="padding-bottom: 18px">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr class="odd gradeX" align="center">
						<th>Họ tên</th>
						<th>Email</th>
						<th>Điện thoại</th>
						<th>Giới tính</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($ds_nhanvien as $nhanvien) 
					<tr>
						<td align="left">{{ $nhanvien->nv_hoTen }}</td>
						<td align="left">{{ $nhanvien->nv_email }}</td>
						<td align="left">{{ $nhanvien->nv_dienThoai }}</td>
						@if($nhanvien->nv_gioiTinh == 1)
						<td align="left">Nam</td>
						@else
						<td align="left">Nữ</td>
						@endif						
						<td align="center" data-id="{{ $nhanvien->nv_ma }}">
							<button type="button" class="btn btn-info btn-xs get-modalEdit" data-toggle="modal" data-target="#modal-create" data-placement="bottom" title="Chỉnh sửa">
								<i class="fa fa-fw fa-pencil-square-o"></i>
							</button>
							<button type="button" class="btn btn-danger btn-xs xoa" data-placement="bottom" title="Xóa">
								<i class="fa fa-fw fa-trash-o"></i>
							</button>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Modal thêm mới -->
<div class="modal fade" id="modal-create">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Thêm nhân viên mới</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="alert alert-danger" id="modal-errors" style="display: none;">
				<ul>			
				</ul>
			</div>
			<div class="modal-body">
				<form role="form" action="" method="post" accept-charset="utf-8">
					<div class="form-group">
						<label class="control-label">Họ tên</label>
						<input class="form-control" type="text" value="" name="hoTen" id="ho-ten">
					</div>
					<div class="form-group">
						<label class="control-label">Giới tính</label>
						<label class="form-check-label">
							<input class="form-check-inline gioi-tinh" type="radio" name="rdoGioitinh" id="rdo-nam" value="1" checked="">
							Nam
						</label>
						<label class="form-check-label">
							<input class="form-check-inline gioi-tinh" type="radio" name="rdoGioitinh" id="rdo-nu" value="2">
							Nữ
						</label>
					</div>
					<div class="form-group">
						<label class="control-label">Ngày sinh</label>
						<input class="form-control" type="date" name="ngaySinh" id="ngay-sinh" value="">
					</div>
					<div class="form-group">
						<label class="control-label">Địa chỉ liên lạc</label>
						<input class="form-control" type="text" name="diaChi" id="dia-chi">
					</div>
					<div class="form-group">
						<label class="control-label">Số điện thoại</label>
						<input class="form-control" type="tel" name="sdt" id="sdt">
					</div>
					<div class="form-group">
						<label class="control-label">Địa chỉ Email</label>
						<input class="form-control" type="email" name="email" id="email">
					</div>
					{{-- <div class="form-group">
						<label class="control-label">Mật khẩu</label>
						<input class="form-control" type="password" name="mat-khau" id="mat-khau">
					</div> --}}
					<div class="form-group">
						<label class="control-label" for="ten">Cấp quyền</label>
						<label class="form-check-label">
							<input class="form-check-inline quyen" type="radio" name="rdoQuyen" id="rdo-thuong" value="1" checked="">
							Thường
						</label>
						<label class="form-check-label">
							<input class="form-check-inline quyen" type="radio" name="rdoQuyen" id="rdo-quantri" value="2">
							Quản trị
						</label>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" id="huy">Hủy</button>
				<button type="button" class="btn btn-primary" id="them-moi">Thêm</button>
			</div>
		</div><!-- /Modal #content--> 
	</div><!-- /Modal #dialog--> 
</div><!-- /Modal #end-->   

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
			"search": "Tìm kiếm:",
		},
		"ordering": false,
	} );
</script>

<script type="text/javascript" src="{{ asset('app/controllers/NhanvienController.js') }}"></script>
@stop