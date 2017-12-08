<div class="col-lg-3">
	<h1 class="my-4">TNHs Shop</h1>
	<div class="list-group">
		{{-- <li href="#" class="list-group-item active">Menu</li> --}}
		<ul class="list-group" id="menu">
			@foreach($ds_chude as $chude)
			@if(count($chude->coLoaiSanPham) > 0)
			<li class="list-group-item list-group-item-action">
				<a>{{ $chude->cd_ten }}</a>
			</li>
			<ul>
				@foreach($chude->coLoaiSanPham as $l_sanpham)
				@if(count($l_sanpham->coSanPham) > 0)
				<a class="list-group-item list-group-item-action" href="{{ URL::to(stripUnicode($l_sanpham->l_ten).'/'.$l_sanpham->l_ma) }}">{{ $l_sanpham->l_ten }}</a>
				@endif
				@endforeach
			</ul>
			@endif
			@endforeach
		</ul>
	</div>
</div><!-- /.col-lg-3 -->