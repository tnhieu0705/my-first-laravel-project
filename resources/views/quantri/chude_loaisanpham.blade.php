@extends('master')

@section('breadcrumb-item')
<li class="breadcrumb-item"><a href="{{ asset('quantri/chude') }}">Chủ đề sản phẩm</a></li>
<li class="breadcrumb-item active">Danh sách loại sản phẩm</li>
@stop

@section('noiDung')

<style type="text/css" media="screen">
.control-label {
	font-weight: bold;
}
.btn-xs {
	padding: 0.25rem 0.5rem;
	font-size: 0.7rem;
	line-height: 1.5;
	border-radius: 0.2rem;
}
</style>

<div class="row">
	<div class="col-12">
		<h1 class="page-header">{{ $chude->cd_ten }}
			{{-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-create" title="Thêm mới" id="get-modalCreate">
				<i class="fa fa-fw fa-plus"></i>
			</button> --}}
		</h1>
		<!-- Example DataTables Card-->
		<div class="table-responsive" style="padding-bottom: 18px">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr class="odd gradeX" align="center">
						<th>Tên loại</th>
						<th>Diễn giải</th>
						{{-- <th></th> --}}
					</tr>
				</thead>
				<tbody>
					@foreach($ds_loaisanpham as $loaisanpham) 
					<tr>
						<td align="left">{{ $loaisanpham->l_ten }}</td>
						@if(count($loaisanpham->l_dienGiai) > 0)
						<td align="left">{{ $loaisanpham->l_dienGiai }}</td>
						@else
						<td align="left">{{ $loaisanpham->l_ten }}</td>
						@endif				
						{{-- <td align="center" data-id="{{ $loaisanpham->l_ma }}">
							<button type="button" class="btn btn-info btn-xs get-modalEdit" data-toggle="modal" data-target="#modal-create" data-placement="bottom" title="Chỉnh sửa">
								<i class="fa fa-fw fa-pencil-square-o"></i>
							</button>
							<button type="button" class="btn btn-danger btn-xs xoa" data-placement="bottom" title="Xóa">
								<i class="fa fa-fw fa-trash-o"></i>
							</button>
						</td> --}}
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

@stop

@section('thuVien')
<script type="text/javascript">
	$('#dataTable').dataTable( {
		"language": {
			"paginate": {
				"next": '<i class="fa fa-fw fa-forward"></i>',
				"previous": '<i class="fa fa-fw fa-backward"></i>'
			},
			"search": "Tìm kiếm",
		},
		"ordering": false,
		"searching": false
	} );
</script>

<script type="text/javascript" src="{{ asset('app/controllers/LoaisanphamController.js') }}"></script>
@stop