<div class="col-lg-3">
	<h1 class="my-4">Shop Name</h1>
	<div class="list-group" id="menu">
		<li href="#" class="list-group-item active">{{ $chude }}</li>
		<ul class="list-group" id="menu">
			@foreach($ds_loaisanpham as $l_sanpham)
			@if(count($l_sanpham->coSanPham) > 0)
			<a class="list-group-item list-group-item-action" href="{{ URL::to(stripUnicode($l_sanpham->l_ten).'/'.$l_sanpham->l_ma) }}">{{ $l_sanpham->l_ten }}</a>
			@endif
			@endforeach
		</ul>
	</div>
</div><!-- /.col-lg-3 -->