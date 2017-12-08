<?php $__env->startSection('breadcrumb-item'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(asset('quantri/chude')); ?>">Chủ đề sản phẩm</a></li>
<li class="breadcrumb-item active">Danh sách loại sản phẩm</li>
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
		<h1 class="page-header"><?php echo e($chude->cd_ten); ?>

			
		</h1>
		<!-- Example DataTables Card-->
		<div class="table-responsive" style="padding-bottom: 18px">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr class="odd gradeX" align="center">
						<th>Tên loại</th>
						<th>Diễn giải</th>
						
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = $ds_loaisanpham; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loaisanpham): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
					<tr>
						<td align="left"><?php echo e($loaisanpham->l_ten); ?></td>
						<?php if(count($loaisanpham->l_dienGiai) > 0): ?>
						<td align="left"><?php echo e($loaisanpham->l_dienGiai); ?></td>
						<?php else: ?>
						<td align="left"><?php echo e($loaisanpham->l_ten); ?></td>
						<?php endif; ?>				
						
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
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
		"searching": false
	} );
</script>

<script type="text/javascript" src="<?php echo e(asset('app/controllers/LoaisanphamController.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>