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
  <!-- Page level plugin CSS-->
  <link href="{{ $rootPath }}libs/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="{{ $rootPath }}templates/backend/css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  @if(Session::has('nhanvien_email'))
    @include('layouts/sidebar')
  @endif

  <!--Kiểm tra #nhanvien đăng nhập -->
  @if(Session::has('nhanvien_email'))
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ asset('quantri/tongquan') }}">Hệ thống</a>
        </li>
        @yield('breadcrumb-item')
      </ol>
      
      @section('noiDung')
      {{-- Nội dung trang quản trị --}}
      @show

    </div><!-- /.container-fluid-->
  </div><!-- /.content-wrapper-->

  <footer class="sticky-footer">
    <div class="container">
      <div class="text-center">
        <small>Copyright © Your Website 2017</small>
      </div>
    </div>
  </footer>

  {{--Nếu #nhanvien chưa đăng nhập --}}
  @else
    @include('dangnhap')
  @endif<!--/end kiểm tra đăng nhập -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ $rootPath }}libs/jquery/jquery.min.js"></script>
  <script src="{{ $rootPath }}libs/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="{{ $rootPath }}libs/jquery-easing/jquery.easing.min.js"></script>
  <!-- Page level plugin JavaScript-->
  {{-- <script src="{{ $rootPath }}libs/chart.js/Chart.min.js"></script> --}}
  <script src="{{ $rootPath }}libs/datatables/jquery.dataTables.js"></script>
  <script src="{{ $rootPath }}libs/datatables/dataTables.bootstrap4.js"></script>
  <!-- Custom scripts for all pages-->
  <script src="{{ $rootPath }}templates/backend/js/sb-admin.min.js"></script>
  <!-- Custom scripts for this page-->
  <script src="{{ $rootPath }}templates/backend/js/sb-admin-datatables.min.js"></script>
  {{-- <script src="{{ $rootPath }}templates/backend/js/sb-admin-charts.min.js"></script> --}}
  @section('thuVien')
  @show

  @if(Session::has('nhanvien_email'))
  <script type="text/javascript" src="{{ asset('app/controllers/DangnhapController.js') }}"></script>
  @endif
</body>

</html>