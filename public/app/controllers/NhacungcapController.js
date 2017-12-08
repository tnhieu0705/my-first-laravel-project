var baseUrl  = 'http://localhost:1000/www/my-project/public/quantri/';
var title    = 'nhà cung cấp';
var ten      = '';
var daiDien  = '';
var diaChi   = '';
var sdt      = '';
var email 	 = '';
var status   = 'Đã thêm';

$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

/*
Xử lý sự kiện thêm mới nhà cung cấp
*/
$('#them-moi').click(function(e) {
	e.preventDefault();
	ten     = $('#ten').val();
	daiDien = $('#dai-dien').val();
	diaChi  = $('#dia-chi').val();
	sdt     = $('#sdt').val();
	email   = $('#email').val();
	
	$.ajax({
		dataType: 'json',
		url: baseUrl + 'nhacungcap',
		type: 'post',
		data: {
			'ten': ten,
			'daiDien': daiDien,
			'diaChi': diaChi,
			'sdt': sdt,
			'email': email
		},
		success: function(response) {
			console.log(response);
			$('#modal-errors').hide();
			printModalSuccess(status);
			refreshModal();
		},
		error: function(response) {
			var errors = response.responseJSON.errors;
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
});

// #get dữ liệu #modal edit
function getModalEdit(id) {
	$('.modal-title').html('Chỉnh sửa nhà cung cấp');
	var bts = '';
	bts += '<button type="button" class="btn btn-default" data-dismiss="modal" id="huy">Hủy</button>';
	bts += '<button type="button" class="btn btn-primary chinh-sua" id="chinh-sua">Lưu</button>';
	$('.modal-footer').html(bts);

	$.ajax({
		dataType: 'json',
		url: baseUrl + 'nhacungcap/' + id,
		type: 'get',
		data: {},
		success: function(response) {
			$('#ten').val(response.ncc_ten);
			$('#dai-dien').val(response.ncc_daiDien);
			$('#dia-chi').val(response.ncc_diaChi);
			$('#sdt').val(response.ncc_dienThoai);
			$('#email').val(response.ncc_email);
		}
	}).done(function() {
		$('.close').on('click', function() {
			window.location.reload();
		});

		$('#huy').on('click', function() {
			window.location.reload();
		});

		// Xử lý sự kiện chỉnh sửa nhà cung cấp
		$('#chinh-sua').on('click', function(e) {
			e.preventDefault();
			ten     = $('#ten').val();
			daiDien = $('#dai-dien').val();
			diaChi  = $('#dia-chi').val();
			sdt     = $('#sdt').val();
			email   = $('#email').val();

			$.ajax({
				dataType: 'json',
				url: baseUrl + 'nhacungcap/' + id,
				type: 'patch',
				data: {
					'ten': ten,
					'daiDien': daiDien,
					'diaChi': diaChi,
					'sdt': sdt,
					'email': email
				},
				success: function(response) {
					$('#modal-errors').hide();
					status = 'Đã cập nhật';
					printModalSuccess(status);
					refreshModal();
				},
				error: function(response) {
					var errors = data.responseJSON.errors;
					printModalErrors(errors);
				}
			});
		});
	});
}

function deleteSupplier(id) {
	var del = confirm("Bạn chắc chắn muốn xóa ?");
	if(del) {
		$.ajax({
			dataType: 'json',
			url: baseUrl + 'nhacungcap/' + id,
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
			message = message + ' Xóa <b>thành công</b> '+ title + ' ' + '<b>' + data.nhacungcap + '</b>' ;
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
	$('#ten').val('');
	$('#dai-dien').val('');
	$('#dia-chi').val('');
	$('#sdt').val('');
	$('#email').val('');
}

// Xử liệu lỗi nhập liệu #request validation errors.
function printModalErrors(errors) {
	$('#modal-errors').removeAttr('style');
	var error = '';
	$.each(errors, function(key, value) {
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