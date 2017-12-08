var baseUrl   = 'http://localhost:1000/www/my-project/public/quantri/';
var baseImgUrl = 'http://localhost:1000/www/my-project/public/uploaded/sanpham/';
var title     = 'sản phẩm';
var status    = 'Đã thêm';
var maLoai    = '';
var ten       = '';
var giaGoc    = 0;
var giaBan    = 0;
var xuatXu    = '';
var thongTin  = '';
var idSanPham = -1;

$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

// Bật #modal quản lý hình ảnh
function getModalImage(id) {
	$('#upload-image').val('');
	idSanPham = id;
	$.ajax({
		dataType: 'json',
		url: baseUrl + 'hinhanh',
		type: 'get',
		data: {'sp_ma': idSanPham},
		success: function(response) {
			if(response.error == false) {
				var img = '';
				var ds_hinhanh = JSON.parse(response.message);
				$.each(ds_hinhanh, function(key, value) {
					img += '<img src="' + baseImgUrl + value.ha_ten + '" class="image-display"';
					img += ' id="' + value.ha_stt +'">';
					img += '</img>';
					img += '<a href="javascript:void(0)" class="delete-image"';
					img += ' id="' + value.ha_stt +'"><i class="fa fa-times"></i></a>';
					$('.form-image').html(img);				 
				});	
			}
			else {
				var msg = '';
				msg += '<h4 style="text-align: center;">' + response.message;
				msg += '</h4>';
				$('.form-image').html(msg);
			}
		},
	});
}

/*
Xử lý sự kiện #thêm hình ảnh mới
*/
$('#upload-hinh').click(function(e) {
	e.preventDefault();
	var frmData = new FormData($('.upload-form')[0]);

	$.ajax({
		dataType: 'json',
		url: baseUrl + 'hinhanh/' + idSanPham,
		type: 'post',
		data: frmData,
		processData: false,
		contentType: false,
		success: function(response){
			if(response.error) {
				alert(response.message);
			} else {
				var hinhanh = JSON.parse(response.message);
				var img = '';
				img += '<img src="' + baseImgUrl + hinhanh.ha_ten + '" class="image-display"';
				img += ' id="' + hinhanh.ha_stt +'">';
				img += '</img>';
				img += '<a href="javascript:void(0)" class="delete-image"';
				img += ' id="' + hinhanh.ha_stt +'"><i class="fa fa-times icon-delete"></i></a>';
				$('.form-image').append(img);
			}
		},
		error: function(response) {
			console.log(response);
		}
	}).done(function(response) {
		$('#form-image').find('h4').remove();
	});
});

// Xử lý #xóa hình ảnh sản phẩm
$('#modalImages').on('click', '.delete-image', function(e) {
	e.preventDefault();
	var el = $(this);
	var sttHinh = $(this).attr('id');

	$.ajax({
		dataType: 'json',
		url: baseUrl + 'hinhanh/del/' + sttHinh,
		type: 'post',
		cache: false,
		data: {
			'sp_ma': idSanPham,
			'h_stt': sttHinh,
		},
		beforeSend: function() {
			el.remove();
			$('#' + sttHinh).remove();
		},
		success: function(response) {
			alert('thanh cong');
		}
	});
});

// Đổ dữ liệu ra #select loại sản phẩm
$('#get-modalCreate').click(function(e) {
	var idChuDe = $('#chu-de').val();
	$.get(baseUrl + 'sanpham/' + idChuDe + '/loaisanpham', function(data) {
		$('#loai-sanpham').html(data);
	});
	$('#chu-de').change(function() {
		var idChuDe = $('#chu-de').val();
		$.get(baseUrl + 'sanpham/' + idChuDe + '/loaisanpham', function(data) {
			$('#loai-sanpham').html(data);
		});
	});
});

/*
Xử lý sự kiện #thêm mới sản phẩm
*/
$('#them-moi').click(function(e) {
	e.preventDefault();
	$('#modal-errors').hide();
	maLoai   = $('#loai-sanpham').val();
	ten      = $('#ten').val();
	giaGoc   = $('#gia-goc').val();
	giaBan   = $('#gia-ban').val();
	xuatXu   = $('#xuat-xu').val();
	thongTin = $('#thong-tin').val();

	if((giaGoc < 0) || (giaBan < 0)) {
		var error = { message: 'Giá gốc hoặc giá bán không hợp lệ (giá trị âm)'	};
		printModalErrors(error);
	} 
	else if(giaGoc > giaBan) {
		var error = { message: 'Giá trị không hợp lệ (giá gốc lơn hơn giá bán)' };
		printModalErrors(error);
	} else {
		$.ajax({
			dataType: 'json',
			url: baseUrl + 'sanpham',
			type: 'post',
			data: {
				'ten': ten,
				'giaGoc': giaGoc,
				'giaBan': giaBan,
				'xuatXu': xuatXu,
				'thongTin': thongTin,
				'maLoai': maLoai,
			},
			success: function(data) {
				console.log(data);
				$('#modal-errors').hide();
				printModalSuccess(status);
				refreshModal();
			},
			error: function(data) {
				var errors = data.responseJSON.errors;
				printModalErrors(errors);	
			}
		}).done(function() {
			$('.close').on('click', function() {
				refreshModal();
				window.location.reload();
			});
			$('#huy').on('click', function() {
				refreshModal();
				window.location.reload();
			});
		});
	}
});

// Bật modal edit sản phẩm
function getModalEdit(id) {
	$('.modal-title').html('Chỉnh sửa loại sản phẩm');
	var bts = '';
	bts += '<button type="button" class="btn btn-default" data-dismiss="modal" id="huy">Hủy</button>';
	bts += '<button type="button" class="btn btn-primary chinh-sua" id="chinh-sua">Lưu</button>';
	$('.modal-footer').html(bts);

	$.ajax({
		dataType: 'json',
		url: baseUrl + 'sanpham/' + id,
		type: 'get',
		data: {},
		success: function(response) {
			console.log('Lấy dữ liệu thành công: ' + response[1]);
			$('#chu-de').val(response[1]);
			var idChuDe = response[1];
			$.get(baseUrl + 'sanpham/' + idChuDe + '/loaisanpham', function(data) {
				$('#loai-sanpham').html(data);
				$('#loai-sanpham').val(response[0].l_ma);
			});
			$('#chu-de').change(function() {
				var idChuDe = $('#chu-de').val();
				$.get(baseUrl + 'sanpham/' + idChuDe + '/loaisanpham', function(data) {
					$('#loai-sanpham').html(data);
				});
			});
			$('#ten').val(response[0].sp_ten);
			$('#gia-goc').val(response[0].sp_giaGoc);
			$('#gia-ban').val(response[0].sp_giaBan);
			$('#xuat-xu').val(response[0].sp_xuatXu);
			$('#thong-tin').val(response[0].sp_thongTin);
		},
	}).done(function(e) {
		$('.close').on('click', function() {
			window.location.reload();
		});

		$('#huy').on('click', function() {
			window.location.reload();
		});

		$('#chinh-sua').on('click', function(e) {
			e.preventDefault();
			$('#modal-errors').hide();
			maLoai   = $('#loai-sanpham').val();
			ten      = $('#ten').val();
			giaGoc   = $('#gia-goc').val();
			giaBan   = $('#gia-ban').val();
			xuatXu   = $('#xuat-xu').val();
			thongTin = $('#thong-tin').val();

			if((giaGoc < 0) || (giaBan < 0)) {
				var error = { message: 'Giá gốc hoặc giá bán không hợp lệ (giá trị âm)'	};
				printModalErrors(error);
			} 
			else if(giaGoc > giaBan) {
				var error = { message: 'Giá trị không hợp lệ (giá gốc lơn hơn giá bán)' };
				printModalErrors(error);
			} else {
				$.ajax({
					dataType: 'json',
					url: baseUrl + 'sanpham/' + id,
					type: 'patch',
					data: {
						'ten': ten,
						'giaGoc': giaGoc,
						'giaBan': giaBan,
						'xuatXu': xuatXu,
						'thongTin': thongTin,
						'maLoai': maLoai,
					},
					success: function(data) {
						console.log(data);
						$('#modal-errors').hide();
						status = 'Đã cập nhật';
						printModalSuccess(status);
						refreshModal();
					},
					error: function(data) {
						var errors = data.responseJSON.errors;
						printModalErrors(errors);	
					}
				});
			}
		});
	});
}

/*
Xử lý sự kiện xóa sản phẩm #id
*/
function deleteProduct(id) {
	var del = confirm("Bạn chắc chắn muốn xóa ?");
	if(del) {
		$.ajax({
			dataType: 'json',
			url: baseUrl + 'sanpham/' + id,
			type: 'delete',
			success: function (data) {
				console.log(data);
			}
		}).done(function(data) {			
			$('#modal-dialog').modal('show');
			$('.modal-title').append('Xóa sản phẩm');
			var message = '';
			message = message + '<span>';
			message = message + '<i class="fa fa-fw fa-check"></i> ';
			message = message + ' Xóa <b>thành công</b> '+ title + ' ' + '<b>' + data.sanpham + '</b>' ;
			message = message + '</span>';
			$('#message').append(message);
			$('.close').on('click', function() {
				window.location.reload();
			});
		});
	}
	else return false;
}

// Làm mới #Modal
function refreshModal() {
	$('#ten').val();
	$('#gia-goc').val();
	$('#gia-ban').val();
	$('#xuat-xu').val();
	$('#thong-tin').val();
}

// Xử liệu lỗi nhập liệu #request validation errors.
function printModalErrors(errors) {
	$('#modal-errors').hide();
	$('#modal-errors').removeAttr('style');
	var error = '';
	$.each(errors, function(key, value) {
		// console.log(errors);
		// console.log(value);
		error += '<li>';
		error += '<b>' + value + '</b>';
		error += '</li>';
		$('#modal-errors').find('ul').html(error);
	}); 
}

// Thông báo thêm/chỉnh sửa thành công #success
function printModalSuccess(status) {
	var message = '';
	message = message + '<div class="alert alert-success" id="modal-success">';
	message = message + '<span>';
	message = message + '<i class="fa fa-fw fa-check"></i> ';
	message = message + ' ' + status + ' <b>thành công</b> ' + title + ' ' + '<b>' + ten + '</b>' ;
	message = message + '</span>';
	message = message + '</div>';
	$('.modal-header').after(message);
	$('#modal-success').fadeTo(5000, 500).slideUp(500, function(){
		$('#modal-success').remove();
	});		
}