var baseUrl  = 'http://localhost:1000/www/my-project/public/quantri/';
var title    = 'chủ đề';
var ten      = '';
var dienGiai = '';
var status   = 'Đã thêm';

$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

/*
Xử lý sự kiện #thêm chủ đề mới
*/
$('#them-moi').click(function(e) {
	e.preventDefault();
	$('#modal-errors').hide();
	ten      = $('#ten').val();
	dienGiai = $('#dien-giai').val();

	$.ajax({
		dataType: 'json',
		url: baseUrl + 'chude',
		type: 'post',
		data: {
			'ten': ten,
			'dienGiai': dienGiai
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
Lấy thông tin #chude cho modal Edit
*/
function getEdit(id) {
	$('.modal-title').html('Chỉnh sửa chủ đề');
	var bts = '';
	bts += '<button type="button" class="btn btn-default" data-dismiss="modal" id="huy">Hủy</button>';
	bts += '<button type="button" class="btn btn-primary chinh-sua" id="chinh-sua">Lưu</button>';
	$('.modal-footer').html(bts);

	$.ajax({
		dataType: 'json',
		url: baseUrl + 'chude/' + id,
		type: 'get',
		data: {},
		success: function(response) {
			console.log(response);
			$('#ten').val(response.cd_ten);
			$('#dien-giai').val(response.cd_dienGiai);
		}
	}).done(function() {
		$('.close').on('click', function() {
			window.location.reload();
		});

		$('#huy').on('click', function() {
			window.location.reload();
		});

		// Xử lý sự kiện cập nhật chủ đề #id
		$('#chinh-sua').on('click', function(e) {
			e.preventDefault();
			status = 'Đã cập nhật';
			ten = $('#ten').val();
			dienGiai = $('#dien-giai').val();

			$.ajax({
				dataType: 'json',
				url: baseUrl + 'chude/' + id,
				type: 'patch',
				data: {
					'ten': ten,
					'dienGiai': dienGiai
				},
				success: function(response) {
					console.log(response);
					if(response.error) {
						var errors = response.message;
						printModalErrors(errors);
					} else {
						printModalSuccess(status);
					}
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
Xử lý sự kiện #xóa chủ đề
*/
function deleteChude(id) {
	var del = confirm("Bạn chắc chắn muốn xóa ?");
	if(del) {
		$.ajax({
			dataType: 'json',
			url: baseUrl + 'chude/' + id,
			type: 'delete',
			success: function (data) {
				console.log(data);
				if(data.error) {
					$('#modal-dialog').modal('show');
					$('.modal-title').append('Xóa chủ đề');
					$('#message').attr('class', 'alert alert-danger');
					var message = '';
					message = message + '<span>';
					message = message + '<i class="fa fa-fw fa-check"></i> ';
					message = message + ' ' + data.message;
					message = message + '</span>';
					$('#message').append(message);
					$('.close').on('click', function() {
						window.location.reload();
					});
				} else {
					$('#modal-dialog').modal('show');
					$('.modal-title').append('Xóa chủ đề');
					$('#message').attr('class', 'alert alert-success');
					var message = '';
					message = message + '<span>';
					message = message + '<i class="fa fa-fw fa-check"></i> ';
					message = message + ' Xóa <b>thành công</b> '+ title + ' ' + '<b>' + data.chude + '</b>' ;
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
}

// Làm mới #Modal
function refreshModal() {
	$('#ten').val('');
	$('#dien-giai').val('');
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