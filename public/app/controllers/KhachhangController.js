var baseUrl          = 'http://localhost:1000/www/my-project/public/';
var title            = 'khách hàng';
var hoTen            = '';
var gioiTinh         = 1;
var diaChi           = '';
var sdt              = '';
var email            = '';
var matKhau          = '';
var matKhauConfirmed = '';
var status           = 'Đã thêm';

$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

// Người dùng đăng ký tài khoản
$('#dang-ky').click(function(e) {
	e.preventDefault();
	hoTen            = $('#ho-ten').val();
	gioiTinh         = $('#gioi-tinh').val();
	diaChi           = $('#dia-chi').val();
	sdt              = $('#sdt').val();
	email            = $('#email').val();
	matKhau          = $('#mat-khau').val();
	matKhauConfirmed = $('#matkhau-confirmed').val();

	$.ajax({
		dataType: 'json',
		url: baseUrl + 'dangky',
		type: 'post',
		data: {
			'hoTen': hoTen,
			'gioiTinh': gioiTinh,
			'diaChi': diaChi,
			'sdt': sdt,
			'email': email,
			'matKhau': matKhau,
			'matKhauConfirmed': matKhauConfirmed,
		},
		success: function(data) {
			if(data.error) {
				$('#modal-success').remove();
				$('#modal-errors').hide();
				$('#modal-errors').removeAttr('style');
				$('#modal-errors').find('ul').html('<li><b>' + data.message + '</b></li>');
			} else {
				$('#modal-success').remove();
				$('#modal-errors').hide();
				var s = '<div class="alert alert-success" id="modal-success"><span>Bạn đã đăng ký <b>thành công !</b></span></div>';
				$('.modal-header').after(s);
				refreshModal();	
			}
		},
		error: function(data) {
			$('#modal-success').remove();
			$('#modal-errors').hide();
			var errors = data.responseJSON.errors;
			printModalErrors(errors);	
		}
	});
	
});

// Làm mới #Modal
function refreshModal() {
	$('#ho-ten').val('');
	$('#gioi-tinh').val(1);
	$('#dia-chi').val('');
	$('#sdt').val('');
	$('#email').val('');
	$('#mat-khau').val('');
	$('#matkhau-confirmed').val('');
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
		// $('#modal-errors').fadeTo(5000, 500).slideUp(500, function(){
		// 	$('#modal-errors').slideUp(500);
		// });
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