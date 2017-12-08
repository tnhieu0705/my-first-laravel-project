var baseUrl  = 'http://localhost:1000/www/my-project/public/quantri/';
var title    = 'nhân viên';
var hoTen    = '';
var gioiTinh = 1;
var diaChi   = '';
var sdt      = '';
var email    = '';
var matKhau  = '';
var maQuyen  = 0;
var status   = 'Đã thêm';

$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

/*
Xử lý sự kiện #thêm nhân viên mới
*/
$('#them-moi').click(function(e) {
	e.preventDefault();
	hoTen    = $('#ho-ten').val();
	gioiTinh = $('.gioi-tinh:checked').val();
	ngaySinh = $('#ngay-sinh').val();
	diaChi   = $('#dia-chi').val();
	sdt      = $('#sdt').val();
	email    = $('#email').val();
	// var matKhau = $('#mat-khau').val();
	maQuyen  = $('#quyen').val();
	
	$.ajax({
		dataType: 'json',
		url: baseUrl + 'nhanvien',
		type: 'post',
		data: {
			'hoTen': hoTen,
			'gioiTinh': gioiTinh,
			'ngaySinh': ngaySinh,
			'diaChi': diaChi,
			'sdt': sdt,
			'email': email,
			// 'matKhau': matKhau,
			'maQuyen': maQuyen,
		},
		success: function(data) {
			console.log(data);
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
});

/*
Lấy dữ liệu lên #modal edit
*/
function getModalEdit(id) {
	$('.modal-title').html('Chỉnh sửa nhân viên');
	var bts = '';
	bts += '<button type="button" class="btn btn-default" data-dismiss="modal" id="huy">Hủy</button>';
	bts += '<button type="button" class="btn btn-primary chinh-sua" id="chinh-sua">Lưu</button>';
	$('.modal-footer').html(bts);

	$.ajax({
		dataType: 'json',
		url: baseUrl + 'nhanvien/' + id,
		type: 'get',
		data: {},
		success: function(response) {
			console.log('Lấy dữ liệu thành công: ' + response.nv_hoTen);
			$('#ho-ten').val(response.nv_hoTen);
			if(response.nv_gioiTinh == 1) { $('#rdo-nam').prop('checked', true); }
			else { $('#rdo-nu').prop('checked', true); }
			var d = getDate(response.nv_ngaySinh);
			$('#ngay-sinh').val(d);
			$('#dia-chi').val(response.nv_diaChi);
			$('#sdt').val(response.nv_dienThoai);
			$('#email').val(response.nv_email);
			$('#quyen').val(response.q_ma);
		}
	}).done(function(e) {
		$('.close').on('click', function() {
			window.location.reload();
		});

		$('#huy').on('click', function() {
			window.location.reload();
		});

		// Xử lý sự kiện cập nhật nhân viên #id
		$('#chinh-sua').on('click', function(e) {
			e.preventDefault();
			status   = 'Đã cập nhật';
			hoTen    = $('#ho-ten').val();
			gioiTinh = $('.gioi-tinh:checked').val();
			ngaySinh = $('#ngay-sinh').val();
			diaChi   = $('#dia-chi').val();
			sdt      = $('#sdt').val();
			email    = $('#email').val();
			maQuyen  = $('#quyen').val();
			
			$.ajax({
				dataType: 'json',
				url: baseUrl + 'nhanvien/' + id,
				type: 'patch',
				data: {
					'hoTen': hoTen,
					'gioiTinh': gioiTinh,
					'ngaySinh': ngaySinh,
					'diaChi': diaChi,
					'sdt': sdt,
					'email': email,
					'maQuyen': maQuyen,
				},
				success: function(data) {
					console.log(data);
					printModalSuccess(status);
				},
				error: function(data) {
					var errors = data.responseJSON.errors;
					printModalErrors(errors);	
				}
			});
		});
	});
}

/*
Xử lý sự kiện xóa nhân viên #id
*/
function deleteEmployee(id) {
	var del = confirm("Bạn chắc chắn muốn xóa ?");
	if(del) {
		$.ajax({
			dataType: 'json',
			url: baseUrl + 'nhanvien/' + id,
			type: 'delete',
			success: function (data) {
				console.log(data);
			}
		}).done(function(data) {			
			$('#modal-dialog').modal('show');
			$('.modal-title').append('Xóa nhân viên');
			var message = '';
			message = message + '<span>';
			message = message + '<i class="fa fa-fw fa-check"></i> ';
			message = message + ' Xóa <b>thành công</b> '+ title + ' ' + '<b>' + data.nhanvien + '</b>' ;
			message = message + '</span>';
			$('#message').append(message);
			$('.close').on('click', function() {
				window.location.reload();
			});
		});
	}
	else return false;
}

// Kiểm tra quyền truy cập
function ktQuyen(quyen, address) {
	if(quyen == 1) {
		alert('Không có quyền truy cập');
		return false;
	} else {
		location.href = baseUrl + address;
	}
}

// Định dạng #date yyyy-mm-dd
function getDate(datetime) {
	var date = new Date(datetime);
	var dd   = date.getDate();
	var mm   = date.getMonth() + 1; //January = 0!
	var yyyy = date.getFullYear();

	if(dd < 10) {
		dd = '0' + dd
	} 
	if(mm < 10) {
		mm = '0' + mm
	} 
	return today = yyyy + '-' + mm + '-' + dd;
}

// Làm mới #Modal
function refreshModal() {
	$('#ho-ten').val('');
	document.getElementById('rdo-nam').checked = true;
	$('#ngay-sinh').val('');	
	$('#dia-chi').val('');
	$('#sdt').val('');
	$('#email').val('');
	$('#quyen').val(1);
}

// Xử liệu lỗi nhập liệu #request validation errors.
function printModalErrors(errors) {
	$('#modal-errors').removeAttr('style');
	var error = '';
	$.each(errors, function(key, value) {
		// console.log(errors);
		// console.log(value);
		error += '<li>';
		error += '<b>' + value + '</b>';
		error += '</li>';
		$('#modal-errors').find('ul').html(error);
		$('#modal-errors').fadeTo(5000, 500).slideUp(500, function(){
			$('#modal-errors').slideUp(500);
		});
	}); 
}

// Thông báo thêm/chỉnh sửa thành công #success
function printModalSuccess(status) {
	var message = '';
	message = message + '<div class="alert alert-success" id="modal-success">';
	message = message + '<span>';
	message = message + '<i class="fa fa-fw fa-check"></i> ';
	message = message + ' ' + status + ' <b>thành công</b> ' + title + ' ' + '<b>' + hoTen + '</b>' ;
	message = message + '</span>';
	message = message + '</div>';
	$('.modal-header').after(message);
	$('#modal-success').fadeTo(5000, 500).slideUp(500, function(){
		$('#modal-success').remove();
	});		
}