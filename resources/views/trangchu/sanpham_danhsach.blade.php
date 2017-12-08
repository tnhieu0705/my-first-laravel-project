@extends('trangchu/trangchu_master')

@section('noiDung')

@include('layouts/sanpham_sidemenu')

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

	<div class="row">
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
					<h5>{{ number_format($sanpham->sp_giaBan) }} VNĐ </h5>
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
	</div><!-- /.row -->
</div><!-- /.col-lg-9 -->
@stop