$(document).ready(function() {
	const emptyTrangThaiDon = `
	<div class="empty-don-mua don-hang mb-4 mt-4">
		<div><i class="fa fa-folder-o"></i></div>
		Không có đơn hàng
	</div>
	`;
	$('#don-hang-tabs-header .nav-item').click(function(event) {
		$('#don-hang-tabs-header .nav-item .nav-link').removeClass('active');
		$(this).find('.nav-link').addClass('active');
		const tab = $(this).find('.nav-link').data('tab');
		console.log(tab)
		$('#don-hang-tabs .tab-pane').removeClass('active show');
		$(`#don-hang-tabs .tab-pane#${tab}`).addClass('active show');
	});

	$.each($('#don-hang-tabs .tab-pane'), function(index, val) {
		if ($(this).html().trim() == '') {
			$(this).html(emptyTrangThaiDon);
		}
	});

	const huyDonHang = (maDonMua, lyDo) => {
		$.ajax({
			url: window.location.href,
			type: 'POST',
			dataType: 'JSON',
			data: {
				action: 'huy-don-hang',
				maDonMua,
				lyDo
			},
		})
		.done(function(res) {
			console.log("Success: ", res);
			res ? showMessage('success', 'Hủy đơn hàng thành công') : showMessage('error', 'Hủy đơn hàng không thành công');
		})
		.fail(function(err) {
			console.log("Error: ", err);
			showMessage('error', 'Đã có lỗi xảy ra, vui lòng thử lại sau.');
		})
		.always(function() {
			setTimeout(() => {
				window.location.reload();
			}, 1000);
		});
		
	}

	$('.huy-don-hang').click(function (e) {
		e.preventDefault();
		const $this = $(this);
		const maDonMua = $(this).val();
		$(this).attr('disabled', true);

		Swal.fire({
		  title: 'Nhập lý do hủy đơn hàng',
		  input: 'text',
		  inputAttributes: {
		    autocapitalize: 'off',
		    required: true,
		  },
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'Giữ lại',
		  confirmButtonText: 'Xác nhận hủy',
		}).then((result) => {
		  if (result.isConfirmed) {
		  	result.isConfirmed ? huyDonHang(maDonMua, result.value.trim()) : $this.removeAttr('disabled');
		  }
		})
	});

	const doiTrangThai = (maDonMua, trangThai) => {
		$.ajax({
			url: window.location.href,
			type: 'POST',
			dataType: 'JSON',
			data: {
				action: 'doi-trang-thai',
				maDonMua,
				trangThai
			},
		})
		.done(function(res) {
			console.log("Success: ", res);
			res ? showMessage('success', 'Thay đổi trạng thái đơn hàng thành công') : showMessage('error', 'Thay đổi trạng thái đơn hàng không thành công');
		})
		.fail(function(err) {
			console.log("Error: ", err);
			showMessage('error', 'Đã có lỗi xảy ra, vui lòng thử lại sau.');
		})
		.always(function() {
			setTimeout(() => {
				window.location.reload();
			}, 1000);
		});
		
	}

	$('.chuyen-trang-thai').click(function(event) {
		const maDonMua = $(this).val();
		const trangThai = $(this).data('trang-thai');
		const $this = $(this);
		$(this).attr('disabled', true);

		Swal.fire({
		  title: 'Bạn chắc chắn muốn thay đổi trạng thái đơn hàng này?',
		  text: "Xác nhận thay đổi, không thể hoàn lại trạng thái hiện tại của đơn hàng!",
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'Giữ lại',
		  confirmButtonText: 'Đồng ý!'
		}).then((result) => {
		  	result.isConfirmed ? doiTrangThai(maDonMua, trangThai) : $this.removeAttr('disabled');
		})
	});
});