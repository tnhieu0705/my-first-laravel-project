<?php
$rootPath = asset('/');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="copyright" content="tnhieu">
  <meta name="author" content="Trần Ngọc Hiếu">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <title>TNH | Laravel project</title>
  <!-- Bootstrap core CSS-->
  <link href="<?php echo e($rootPath); ?>libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="<?php echo e($rootPath); ?>libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="<?php echo e($rootPath); ?>libs/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="<?php echo e($rootPath); ?>templates/backend/css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <?php if(Session::has('nhanvien_email')): ?>
    <?php echo $__env->make('layouts/sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php endif; ?>

  <!--Kiểm tra #nhanvien đăng nhập -->
  <?php if(Session::has('nhanvien_email')): ?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo e(asset('quantri/tongquan')); ?>">Hệ thống</a>
        </li>
        <?php echo $__env->yieldContent('breadcrumb-item'); ?>
      </ol>
      
      <?php $__env->startSection('noiDung'); ?>
      
      <?php echo $__env->yieldSection(); ?>

    </div><!-- /.container-fluid-->
  </div><!-- /.content-wrapper-->

  <footer class="sticky-footer">
    <div class="container">
      <div class="text-center">
        <small>Copyright © Your Website 2017</small>
      </div>
    </div>
  </footer>

  
  <?php else: ?>
    <?php echo $__env->make('dangnhap', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php endif; ?><!--/end kiểm tra đăng nhập -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo e($rootPath); ?>libs/jquery/jquery.min.js"></script>
  <script src="<?php echo e($rootPath); ?>libs/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="<?php echo e($rootPath); ?>libs/jquery-easing/jquery.easing.min.js"></script>
  <!-- Page level plugin JavaScript-->
  
  <script src="<?php echo e($rootPath); ?>libs/datatables/jquery.dataTables.js"></script>
  <script src="<?php echo e($rootPath); ?>libs/datatables/dataTables.bootstrap4.js"></script>
  <!-- Custom scripts for all pages-->
  <script src="<?php echo e($rootPath); ?>templates/backend/js/sb-admin.min.js"></script>
  <!-- Custom scripts for this page-->
  <script src="<?php echo e($rootPath); ?>templates/backend/js/sb-admin-datatables.min.js"></script>
  
  <?php $__env->startSection('thuVien'); ?>
  <?php echo $__env->yieldSection(); ?>

  <?php if(Session::has('nhanvien_email')): ?>
  <script type="text/javascript" src="<?php echo e(asset('app/controllers/DangnhapController.js')); ?>"></script>
  <?php endif; ?>
</body>

</html>