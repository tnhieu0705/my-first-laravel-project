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

	<title>TNHs Shop</title>

	<!-- Bootstrap core CSS -->
	<link href="{{ $rootPath }}libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom fonts for this template-->
	<link href="{{ $rootPath }}libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<!-- Custom styles for this template -->
	<link href="{{ $rootPath }}templates/frontend/css/shop-homepage.css" rel="stylesheet">

</head>

<body>
	@include('layouts/trangchu_navbar')

	<!-- Page Content -->
	<div class="container">
		<div class="row">

			@section('noiDung')
			{{-- Nội dung trang quản trị --}}
			@show
			
		</div><!-- /.row -->
	</div><!-- /.container -->

	<!-- Footer -->
	<footer class="py-5 bg-dark">
		<div class="container">
			<p class="m-0 text-center text-white">Copyright &copy; CTU - Trần Ngọc Hiếu 8/2017</p>
		</div><!-- /.container -->
	</footer>

	<!-- Bootstrap core JavaScript -->
	<script src="{{ $rootPath }}libs/jquery/jquery.min.js"></script>
	<script src="{{ $rootPath }}libs/bootstrap/js/bootstrap.bundle.min.js"></script>
	
	@section('thuVien')
	@show

	@if((Session::has('khachhang_hoten')) || (Session::has('nhanvien_email')))
	<script type="text/javascript" src="{{ asset('app/controllers/DangnhapController.js') }}"></script>
	@endif
</body>

</html>
