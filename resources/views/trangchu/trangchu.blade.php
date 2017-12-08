@extends('trangchu/trangchu_master')

@section('noiDung')

@include('layouts/trangchu_sidemenu')

<div class="col-lg-9">

	<div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
		</ol>
		<div class="carousel-inner" role="listbox">
			<div class="carousel-item active">
				<img class="d-block img-fluid" src="{{ asset('uploaded/slide1.jpeg') }}" alt="First slide">
			</div>
			<div class="carousel-item">
				<img class="d-block img-fluid" src="{{ asset('uploaded/slide2.jpg') }}" alt="Second slide">
			</div>
			<div class="carousel-item">
				<img class="d-block img-fluid" src="{{ asset('uploaded/slide3.png') }}" alt="Third slide">
			</div>
		</div>
		<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>

	<div class="row" id="load-data">
		@foreach($ds_sanpham as $sanpham)
		<div class="col-lg-4 col-md-6 mb-4">
			<div class="card h-100">
				@if($sanpham->sp_hinh != '')
				<a href="#"><img class="card-img-top" src="{{ asset('uploaded/sanpham/'.$sanpham->sp_hinh) }}" alt=""></a>
				@else
				<a href="#"><img class="card-img-top" src="{{ asset('uploaded/700x400.png') }}" alt=""></a>
				@endif
				<div class="card-body">
					<h4 class="card-title">
						<a href="#">{{ $sanpham->sp_ten }}</a>
					</h4>
					<h5>{{ number_format($sanpham->sp_giaBan, '0', ',', '.') }} VNĐ </h5>
					{{-- <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p> --}}
				</div>
				<div class="card-footer">
					<a class="btn btn-info btn-sm" role="button" href="{{ URL::to('dathang/'.$sanpham->sp_ma) }}">
						<i class="fa fa-fw fa-cart-arrow-down"></i> Thêm vào giỏ hàng
					</a>
				</div>
			</div>
		</div>
		@endforeach
		<div class="col-lg-12 col-md-12 mb-2 align-middle" id="remove-row">
			<button id="btn-more" data-id="{{ $sanpham->sp_ma }}" class="btn btn-block btn-primary" > Xem thêm </button>
		</div>
	</div>	<!-- /.row -->
</div><!-- /.col-lg-9 -->
@stop

@section('thuVien')
<script type="text/javascript">
	$(document).ready(function() {
		
		$('#menu > li').next().slideToggle();

		$('#menu > li').click(function(e) {
			e.preventDefault();
			if($(this).attr('class') != 'active')
			{
				$('#menu > li').next().slideUp();
				$(this).next().slideToggle();
				$('#menu li').removeClass('active');
				$(this).addClass('active');
			}

		});

		// Load thêm sản phẩm
		$(document).on('click', function() {
			var id = $('#btn-more').data('id');
			$('#btn-more').html("Đang tải...");

			$.ajax({
				url: 'http://localhost:1000/www/my-project/public/',
				type: 'post',
				dataType : 'text',
				data: { 'id': id },
				success: function(data) {
					if(data != '') {
						$('#remove-row').remove();
						$('#load-data').append(data);
					} else {
						$('#btn-more').html("Đã tải đầy đủ dữ liệu");
					}
				}
			});
		});
	});	
</script>
<script type="text/javascript" src="{{ asset('app/controllers/DangnhapController.js') }}"></script>
@stop