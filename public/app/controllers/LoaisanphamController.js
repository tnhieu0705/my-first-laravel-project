var baseUrl  = 'http://localhost:1000/www/my-project/public/quantri/';
var title    = 'loại sản phẩm';
var ten      = '';
var dienGiai = '';
var status   = 'Đã thêm';

$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

/*
Xử lý sự kiên #thêm mới loại sản phẩm
*/
$('#them-moi').click(function(e) {
	e.preventDefault();
	$('#modal-errors').hide();
	ten 	  = $('#ten').val();
	dienGiai  = $('#dien-giai').val();
	var chuDe = $('#chu-de').val();
	
	$.ajax({
		dataType: 'json',
		url: baseUrl + 'loaisanpham',
		type: 'post',
		data: {
			'ten': ten,
			'dienGiai': dienGiai,
			'chuDe': chuDe
		},
		success: function(response) {
			console.log(response);
			if(response.error) {
				var errors = response.message;
				printModalErrors(errors);
			} else {
				$('#modal-errors').hide();
				printModalSuccess(status);
				refreshModal();	
			}
		},
		error: function(response) {
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
$('.get-modalEdit').click(function(e) {
	e.preventDefault();
	var id = $(this).parent('td').data('id');
	$('.modal-title').html('Chỉnh sửa loại sản phẩm');
	var bts = '';
	bts += '<button type="button" class="btn btn-default" data-dismiss="modal" id="huy">Hủy</button>';
	bts += '<button type="button" class="btn btn-primary chinh-sua" id="chinh-sua">Lưu</button>';
	$('.modal-footer').html(bts);

	$.ajax({
		dataType: 'json',
		url: baseUrl + 'loaisanpham/' + id,
		type: 'get',
		data: {},
		success: function(response) {
			console.log('Lấy dữ liệu thành công: ' + response);
			$('#ten').val(response.l_ten);
			$('#dien-giai').val(response.l_dienGiai);
			$('#chu-de').val(response.cd_ma);
		},
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
			$('#modal-errors').hide();
			ten 	  = $('#ten').val();
			dienGiai  = $('#dien-giai').val();
			var chuDe = $('#chu-de').val();

			$.ajax({
				dataType: 'json',
				url: baseUrl + 'loaisanpham/' + id,
				type: 'patch',
				data: {
					'ten': ten,
					'dienGiai': dienGiai,
					'chuDe': chuDe
				},
				success: function(response) {
					console.log(response);
					if(response.error) {
						var errors = response.message;
						printModalErrors(errors);
					} else {
						$('#modal-errors').hide();
						status = 'Đã cập nhật';
						printModalSuccess(status);
						refreshModal();	
					}
				},
				error: function(response) {
					var errors = data.responseJSON.errors;
					printModalErrors(errors);
				}
			});
		});
	});
});

/*
Xử lý sự kiện #xóa loại sản phẩm
*/
$('.xoa').click(function(e) {
	e.preventDefault();
	var id  = $(this).parent('td').data('id');
	var del = confirm("Bạn chắc chắn muốn xóa ?");
	if(del) {
		$.ajax({
			dataType: 'json',
			url: baseUrl + 'loaisanpham/' + id,
			type: 'delete',
			success: function (data) {
				console.log(data);
				if(data.error) {
					$('#modal-dialog').modal('show');
					$('.modal-title').append('Xóa loại sản phẩm');
					$('#message').attr('class', 'alert alert-danger');
					var message = '';
					message = message + '<span>';
					message = message + '<i class="fa fa-fw fa-times"></i> ';
					message = message + ' ' + data.message;
					message = message + '</span>';
					$('#message').append(message);
					$('.close').on('click', function() {
						window.location.reload();
					});
				} else {
					$('#modal-dialog').modal('show');
					$('.modal-title').append('Xóa loại sản phẩm');
					$('#message').attr('class', 'alert alert-success');
					var message = '';
					message = message + '<span>';
					message = message + '<i class="fa fa-fw fa-check"></i> ';
					message = message + ' Xóa <b>thành công</b> '+ title + ' ' + '<b>' + data.loaisanpham + '</b>' ;
					message = message + '</span>';
					$('#message').append(message);
					$('.close').on('click', function() {
						window.location.reload();
					});
				}
			}
		});
	}
	else return false;
});

// Làm mới #Modal
function refreshModal() {
	$('#ten').val('');
	$('#dien-giai').val('');
	$('#chu-de').val('');
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
	message = message + ' ' + status + ' <b>thành công</b> ' + title + ' ' + '<b>' + ten + '</b>' ;
	message = message + '</span>';
	message = message + '</div>';
	$('.modal-header').after(message);
	$('#modal-success').fadeTo(5000, 500).slideUp(500, function(){
		$('#modal-success').remove();
	});		
}