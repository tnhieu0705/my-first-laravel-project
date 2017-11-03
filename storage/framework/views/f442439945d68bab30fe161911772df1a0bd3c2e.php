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
  <!-- Custom styles for this template-->
  <link href="<?php echo e($rootPath); ?>templates/backend/css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Đăng nhập</div>
      <div class="alert alert-danger" style="display: none;" id="login-errors">
      </div>
      <div class="card-body">
        <form role="form" action="javascript:void(0)" method="POST" id="form-dangnhap">
          <div class="form-group">
            <label for="exampleInputEmail1">Địa chỉ email</label>
            <input class="form-control" name="email" id="email" type="email" aria-describedby="emailHelp" value="hieuc1500109@student.ctu.edu.vn" required>
            <p style="color: red;" class="error email-error"></p>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Mật khẩu</label>
            <input class="form-control" name="password" id="mat-khau" type="password" value="12345" required>
            <p style="color: red;" class="error matkhau-error"></p>
          </div>
          <!-- <div class="form-group">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox"> Remember Password</label>
            </div>
          </div> -->
          <button type="submit" class="btn btn-primary btn-block" id="dang-nhap">Đăng nhập</button>
        </form>
          <!-- <div class="text-center">
            <a class="d-block small mt-3" href="register.html">Register an Account</a>
            <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
          </div> -->
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo e($rootPath); ?>libs/jquery/jquery.min.js"></script>
    <script src="<?php echo e($rootPath); ?>libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?php echo e($rootPath); ?>libs/jquery-easing/jquery.easing.min.js"></script>

    <script type="text/javascript" src="<?php echo e(asset('app/controllers/DangnhapController.js')); ?>"></script>
    
  </body>

  </html>
