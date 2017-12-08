<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
	<div class="container">
		<a class="navbar-brand" href="javascript:void(0)">TNHs Shop</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item active">
					<a class="nav-link" href="{{ URL::to('/') }}">Home
						<span class="sr-only">(current)</span>
					</a>
				</li>
				{{-- Kiểm tra có #nhanvien hay #khachhang khong --}}
				@if((!Session::has('nhanvien_hoten')) && (!Session::has('khachhang_hoten')))
				<li class="nav-item">
					<a class="nav-link" href="{{ asset('dangky') }}">Đăng ký</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ asset('dangnhap') }}">Đăng nhập</a>
				</li>
				{{-- Nếu có #session của quyền nhanvien --}}
				@else
				@if(in_array(Session::get('nhanvien_quyen'), [2]))
				<li class="nav-item">
					<a class="nav-link" href="{{ URL::to('quantri/tongquan') }}">Hệ thống</a>
				</li>
				{{-- Nếu có #session của nhóm khachhang --}}
				@endif {{-- #end-if ktquyen nhavien--}}
				@endif {{-- #end-if kiểm tra --}}
				<li class="nav-item">
					<a class="nav-link" id="gio-hang" href="{{ route('giohang') }}">
						<i class="fa fa-fw fa-shopping-cart"></i>
						<span class="badge badge-pill badge-primary" title=""></span>
						@if($sl_dat > 0)
						<span class="badge badge-pill badge-primary"	> {{ $sl_dat }}</span>
						@else
						<span class="badge badge-pill badge-primary"></span>
						@endif
					</a>
				</li>
				@if((Session::has('nhanvien_hoten')) || (Session::has('khachhang_hoten')))
				<ul class="navbar-nav ml-auto">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fa fa-fw fa-user-circle"></i>
							@if(Session::has('nhanvien_hoten')) {{ Session::get('nhanvien_hoten') }}
							@else {{ Session::get('khachhang_hoten') }}
							@endif
						</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
							<a class="dropdown-item" href="{{ URL::to('dangxuat') }}" id="dang-xuat">
								<h6> Đăng xuất</h6>
							</a>
						</div>
					</li>
				</ul>
				@endif {{-- #end-if kiểm tra --}}
			</ul>
		</div>
	</div>
</nav>