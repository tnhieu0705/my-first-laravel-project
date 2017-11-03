<?php $__env->startSection('breadcrumb-item', 'Chủ đề sản phẩm'); ?>

<?php $__env->startSection('noiDung'); ?>
<style type="text/css" media="screen">
.control-label {
	font-weight: bold;
}
</style>
<h1 class="page-header">Quản lý chủ đề
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-create" title="Thêm mới" id="get-modalCreate">
		<i class="fa fa-fw fa-plus"></i>
	</button>
</h1>

<div class="row">
	<?php $__currentLoopData = $ds_chude; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chude): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<div class="col-xl-3 col-sm-3 mb-3">
		<div class="card o-hidden h-100" id="chude-item">
			<div class="card-body">
				<ul class="navbar-nav ml-auto float-right" style="top: -5px; right: 5px; position: absolute;">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
							<a class="dropdown-item chinh-sua" href="javascript:void(0)" id="<?php echo e($chude->cd_ma); ?>" onclick="getEdit(this.id)" data-toggle="modal" data-target="#modal-create" data-placement="bottom">
								<h6> Chỉnh sửa</h6>
							</a>
							<a class="dropdown-item xoa" href="javascript:void(0)" id="<?php echo e($chude->cd_ma); ?>" onclick="deleteChude(this.id)">
								<h6> Xóa</h6>
							</a>
						</div>
					</li>
				</ul>				
				<div class="text-primary mr-5"><strong><?php echo e($chude->cd_ten); ?></strong><br>
				</div>
				<?php echo e($chude->created_at); ?>

			</div>
			<a class="card-footer clearfix small z-1" href="#" id="<?php echo e($chude->cd_ma); ?>">
				<span class="float-left">Xem chi tiết</span>
				<span class="float-right">
					<i class="fa fa-angle-right"></i>
				</span>
			</a>
		</div>
	</div>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<!-- Modal thêm mới -->
<div class="modal fade" id="modal-create">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Thêm nhân chủ đề</h4>
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
						<label class="control-label">Tên chủ đề</label>
						<input class="form-control" type="text" value="" name="ten" id="ten">
					</div>
					<div class="form-group">
						<label class="control-label">Diễn giải</label>
						<textarea class="form-control" name="dienGiai" id="dien-giai"></textarea>
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
<script type="text/javascript" src="<?php echo e(asset('app/controllers/ChudeController.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>