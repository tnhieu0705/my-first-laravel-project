<?php $__env->startSection('breadcrumb-item'); ?>
<li class="breadcrumb-item active">Tổng quan</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('noiDung'); ?>
<div class="row">
	<div class="col-xl-3 col-sm-6 mb-3">
		<div class="card text-white bg-primary o-hidden h-100">
			<div class="card-body">
				<div class="card-body-icon">
					<i class="fa fa-fw fa-users"></i>
				</div>
				<div class="mr-5">Tổng số <?php echo e(count($ds_nhanvien)); ?> nhân viên</div>
			</div>
			<a class="card-footer text-white clearfix small z-1" href="<?php echo e(asset('quantri/nhanvien')); ?>">
				<span class="float-left">Xem chi tiết</span>
				<span class="float-right">
					<i class="fa fa-angle-right"></i>
				</span>
			</a>
		</div>
	</div>
	
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('thuVien'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>