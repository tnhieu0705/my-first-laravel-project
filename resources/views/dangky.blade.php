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
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>TNH | Laravel project</title>
	<!-- Bootstrap core CSS-->
	<link href="{{ $rootPath }}libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom fonts for this template-->
	<link href="{{ $rootPath }}libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<!-- Custom styles for this template-->
	<link href="{{ $rootPath }}templates/backend/css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
	<div class="container">
		<div class="card card-register mx-auto mt-5">
			<div class="card-header modal-header"><strong>Đăng ký tài khoản</strong></div>
			<div class="alert alert-danger" style="display: none;" id="modal-errors">
				<ul>
					{{-- Hiển thị lỗi --}}
				</ul>
			</div>
			<div class="card-body">
				<form role="form" action="javascript:void(0)" method="POST" id="form-dangky">
					<div class="form-group">
						<div class="form-row">
							<div class="col-md-6">
								<label>Họ tên</label>
								<input class="form-control" name="hoTen" id="ho-ten" type="text" aria-describedby="nameHelp">
							</div>
							<div class="col-md-6">
								<label for="exampleInputLastName">Giới tính</label>
								<select class="form-control" name="gioiTinh" id="gioi-tinh">
									<option value="1">Nam</option>
									<option value="2">Nữ</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Địa chỉ email</label>
						<input class="form-control" id="email" type="email" aria-describedby="emailHelp">
					</div>
					<div class="form-group">
						<div class="form-row">
							<div class="col-md-6">
								<label>Mật khẩu</label>
								<input class="form-control" name="matKhau" id="mat-khau" type="password">
							</div>
							<div class="col-md-6">
								<label>Xác nhận mật khẩu</label>
								<input class="form-control" name="matKhauConfirmed" id="matkhau-confirmed" type="password">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="form-row">
							<div class="col-md-6">
								<label>Địa chỉ</label>
								<input class="form-control" name="diaChi" id="dia-chi" type="text" aria-describedby="nameHelp">
							</div>
							<div class="col-md-6">
								<label>Số điện thoại</label>
								<input class="form-control" name="sdt" id="sdt" type="text" aria-describedby="nameHelp">
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-primary btn-block" id="dang-ky">Đăng ký</button>
				</form>
				<div class="text-center">
					<a class="d-block small mt-3" href="{{ asset('dangnhap') }}">Đã có tài khoản</a>
					{{-- <a class="d-block small" href="forgot-password.html">Forgot Password?</a> --}}
				</div>
			</div>
		</div>
	</div>
	<!-- Bootstrap core JavaScript-->
	<script src="{{ $rootPath }}libs/jquery/jquery.min.js"></script>
	<script src="{{ $rootPath }}libs/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- Core plugin JavaScript-->
	<script src="{{ $rootPath }}libs/jquery-easing/jquery.easing.min.js"></script>

	<script type="text/javascript" src="{{ asset('app/controllers/KhachhangController.js') }}"></script>
</body>

</html>
