<?php $__env->startSection('breadcrumb-item'); ?>
<li class="breadcrumb-item active">Quản lý nhân viên</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('noiDung'); ?>

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
				<thead >
					<tr class="odd gradeX" align="center">
						<th>Họ tên</th>
						<th>Email</th>
						<th>Điện thoại</th>
						<th>Giới tính</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = $ds_nhanvien; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nhanvien): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
					<tr>
						<td align="left"><?php echo e($nhanvien->nv_hoTen); ?></td>
						<td align="left"><?php echo e($nhanvien->nv_email); ?></td>
						<td align="left"><?php echo e($nhanvien->nv_dienThoai); ?></td>
						<?php if($nhanvien->nv_gioiTinh == 1): ?>
						<td align="center"><i class="fa fa-fw fa-male"></td>
						<?php else: ?>
						<td align="center"><i class="fa fa-fw fa-female"></td>
						<?php endif; ?>						
						<td align="center">
							<button type="button" class="btn btn-info btn-xs get-modalEdit" data-toggle="modal" data-target="#modal-create" data-placement="bottom" title="Chỉnh sửa" onclick="getModalEdit(<?php echo e($nhanvien->nv_ma); ?>)">
								<i class="fa fa-fw fa-pencil-square-o"></i>
							</button>
							<button type="button" class="btn btn-danger btn-xs xoa" data-placement="bottom" title="Xóa" onclick="deleteEmployee(<?php echo e($nhanvien->nv_ma); ?>)">
								<i class="fa fa-fw fa-trash-o"></i>
							</button>
						</td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
					
					<div class="form-group">
						<label class="control-label">Cấp quyền</label>
						<select class="form-control" name="quyen" id="quyen">
							<?php $__currentLoopData = $ds_quyen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quyen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($quyen->q_ma); ?>"><?php echo e($quyen->q_ten); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('thuVien'); ?>
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

<script type="text/javascript" src="<?php echo e(asset('app/controllers/NhanvienController.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>