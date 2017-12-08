<?php $__env->startSection('breadcrumb-item'); ?>
<li class="breadcrumb-item active">Sản phẩm</li>
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
.form-image {
  height: auto;
  display: block;
  margin: auto;
  font-size: 14px;
  line-height: 1.42857143;
  color: #555;
  border: solid 1px #ccc;
  background-color: #fff; 
  background-image: none; 
  border-radius: 4px;
}

.image-display {
  border-radius: 6px;
  height: 10rem;
  width: 8.2rem;
  margin: 5px 6px;
}

.delete-image {
  height: auto;
  width: auto;
  position: relative;
  top: -74px;
  left: -20px;
}
</style>

<div class="row">
	<div class="col-12">
		<h1 class="page-header">Danh sách sản phẩm
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-create" title="Thêm mới" id="get-modalCreate">
				<i class="fa fa-fw fa-plus"></i>
			</button>
		</h1>
		<!-- Example DataTables Card-->
		<div class="table-responsive" style="padding-bottom: 18px">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr class="odd gradeX" align="center">
						<th>Tên sản phẩm</th>
						<th>Giá gốc</th>
						<th>Giá bán</th>
						<th>Số lượng</th>
						<th>Loại</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = $ds_sanpham; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sanpham): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
					<tr>
						<td align="left"><?php echo e($sanpham->sp_ten); ?></td>
						<td align="left"><?php echo e(number_format($sanpham->sp_giaGoc)); ?></td>
						<td align="left"><?php echo e(number_format($sanpham->sp_giaBan)); ?></td>
						<td align="left"><?php echo e($sanpham->sp_soLuong); ?></td>
						<td align="left"><?php echo e($sanpham->thuocLoaiSanPham->l_ten); ?></td>					
						<td align="center">
							<button type="button" class="btn btn-warning btn-xs get-modalImage" data-placement="bottom" data-toggle="modal" data-target="#modalImages" title="Thêm ảnh" onclick="getModalImage(<?php echo e($sanpham->sp_ma); ?>)">
								<i class="fa fa-fw fa-picture-o"></i>
							</button>
							<button type="button" class="btn btn-info btn-xs get-modalEdit" data-toggle="modal" data-target="#modal-create" data-placement="bottom" title="Chỉnh sửa" onclick="getModalEdit(<?php echo e($sanpham->sp_ma); ?>)">
								<i class="fa fa-fw fa-pencil-square-o"></i>
							</button>
							<button type="button" class="btn btn-danger btn-xs xoa" data-placement="bottom" title="Xóa" onclick="deleteProduct(<?php echo e($sanpham->sp_ma); ?>)">
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
				<h4 class="modal-title">Thêm mới loại sản phẩm</h4>
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
						<label class="control-label">Chủ đề</label>
						<select class="form-control" name="chuDe" id="chu-de">
							<?php $__currentLoopData = $ds_chude; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chude): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($chude->cd_ma); ?>"><?php echo e($chude->cd_ten); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</div>
					<div class="form-group">
						<label class="control-label">Loại sản phẩm</label>
						<select class="form-control" name="loaiSanPham" id="loai-sanpham">
							
						</select>
					</div>
					<div class="form-group">
						<label class="control-label">Tên sản phẩm</label>
						<input class="form-control" type="text" value="" name="ten" id="ten">
					</div>
					<div class="form-group">
						<label class="control-label">Xuất xứ sản phẩm</label>
						<input class="form-control" type="text" value="" name="xuatXu" id="xuat-xu">
					</div>
					<div class="form-group">
						<label class="control-label">Thông tin sản phẩm</label>
						<textarea class="form-control" name="thongTin" id="thong-tin"></textarea>
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

<!-- Modal hình ảnh -->
<div class="modal fade" id="modalImages" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Quản lý hình ảnh</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label class="control-label" for="ten">Hình ảnh</label>
					<div class="form-image" id="form-image">
						
					</div>
				</div>
				<form action="" method="POST" enctype="multipart/form-data" class="upload-form">
					<div class="form-group">
						<label class="control-label" for="ten">Upload ảnh</label>
						<input type="file" name="hinhAnh" id="upload-image">
						<div class="help-block with-errors"></div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default huy" data-dismiss="modal">Hủy</button>
				<button type="button" class="btn btn-primary" id="upload-hinh">Thêm ảnh</button>
			</div>
		</div><!-- /Modal content-->
	</div><!-- /Modal dialog-->
</div><!-- /Modal-->   

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
			"search": "Tìm kiếm:",
		},
		"ordering": false,
	} );
</script>

<script type="text/javascript" src="<?php echo e(asset('app/controllers/SanphamController.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>