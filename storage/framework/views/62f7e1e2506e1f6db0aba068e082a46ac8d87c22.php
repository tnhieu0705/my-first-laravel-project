<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
  <a class="navbar-brand" href="#">Hệ thống quản lý</a>
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Trang chủ">
        <a class="nav-link" href="<?php echo e(asset('/')); ?>">
          <i class="fa fa-fw fa-home"></i>
          <span class="nav-link-text">Trang chủ</span>
        </a>
      </li>
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tổng quan">
        <a class="nav-link" href="<?php echo e(asset('quantri/tongquan')); ?>">
          <i class="fa fa-fw fa-th-list"></i>
          <span class="nav-link-text">Tổng quan</span>
        </a>
      </li>
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Quản lý hàng hóa">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#hang-hoa" data-parent="#exampleAccordion">
          <i class="fa fa-fw fa-industry"></i>
          <span class="nav-link-text">Quản lý hàng hóa</span>
        </a>
        <ul class="sidenav-second-level collapse" id="hang-hoa">
          <li>
            <a href="<?php echo e(asset('quantri/chude')); ?>">Chủ đề</a>
          </li>
          <li>
            <a href="<?php echo e(asset('quantri/loaisanpham')); ?>">Loại sản phẩm</a>
          </li>
          <li>
            <a href="<?php echo e(asset('quantri/sanpham')); ?>">Sản phẩm</a>
          </li>
          <li>
            <a href="<?php echo e(asset('quantri/nhacungcap')); ?>">Nhà cung cấp</a>
          </li>
          
        </ul>
      </li>
      <?php if(in_array(Session::get('nhanvien_quyen'), [2])): ?>
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Quản lý khách hàng">
        <a class="nav-link" href="<?php echo e(asset('quantri/khachhang')); ?>">
          <i class="fa fa-fw fa-user"></i>
          <span class="nav-link-text">Khách hàng</span>
        </a>
      </li>
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Hóa đơn chứng từ">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#hoa-don" data-parent="#exampleAccordion">
          <i class="fa fa-fw fa-list"></i>
          <span class="nav-link-text">Hóa đơn chứng từ</span>
        </a>
        <ul class="sidenav-second-level collapse" id="hoa-don">
          <li>
            <a href="<?php echo e(asset('quantri/donhang')); ?>">Đơn hàng</a>
          </li>
        </ul>
      </li>
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Quản lý nhân sự">
        <a class="nav-link" href="<?php echo e(asset('quantri/nhanvien')); ?>">
          <i class="fa fa-fw fa-id-card-o"></i>
          <span class="nav-link-text">Quản lý nhân sự</span>
        </a>
      </li>
      <?php endif; ?>
    </ul>
    
    <ul class="navbar-nav sidenav-toggler">
      <li class="nav-item">
        <a class="nav-link text-center" id="sidenavToggler">
          <i class="fa fa-fw fa-angle-left"></i>
        </a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-user-circle"></i> <?php echo e(Session::get('nhanvien_hoten')); ?>

          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
            <a class="dropdown-item" href="javascript:void(0)" id="ho-so">
              <h6> Hồ sơ</h6>
            </a>
            <a class="dropdown-item" href="javascript:void(0)" id="doi-matkhau">
              <h6> Đổi mật khẩu</h6>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="javascript:void(0)" id="dang-xuat">
              <h6> Đăng xuất</h6>
            </a>
          </div>
        </li>
    </ul>
  </div>
</nav>