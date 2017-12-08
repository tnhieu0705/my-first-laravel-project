$(document).ready(function() {
	var baseUrl = 'http://localhost:1000/www/my-project/public/';

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	// Xử lý đăng nhập
	$('#dang-nhap').click(function(e) {
		e.preventDefault();
		var email   = $('#email').val();
		var matKhau = $('#mat-khau').val();

		$.ajax({
			url: baseUrl + 'dangnhap',
			type: 'post',
			data: {
				'email': email,
				'matKhau': matKhau,
			},
			success: function(response) {
				console.log(response);
				if(response.error) {
					$('#login-errors').removeAttr('style');
					$('#login-errors').html(response.message);
					$('#login-errors').fadeTo(3000, 500).slideUp(500, function(){
						$('#login-errors').slideUp(500);
					});
				} else {
					if(response.role == 'nhanvien') {
						location.href = baseUrl + 'quantri/tongquan';
					} else {
						location.href = baseUrl;
					}
				}
			},
			error: function(response) {
				console.log(response);
			}
		});
	});

	// Xử lý đăng xuất
	$('#dang-xuat').click(function(e) {
		e.preventDefault();

		$.ajax({
			url: baseUrl + 'dangxuat',
			type: 'post',
			data: {},
			success: function(response) {
				console.log(response);
				location.href = baseUrl;
			}
		});
	});
});