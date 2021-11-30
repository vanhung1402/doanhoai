$(document).ready(function() {
	const getTotalPrice = () => {
		let total = 0;
		$.each($('.check-items'), function(index, val) {
			const checked = $(this).is(":checked");
			const price = Number($(this).data('gia'));
			total += checked ? price : 0;
		});
		$('#thanh-tien').text(numeral(total).format('0,0'));
		$('#tong-tien').text(numeral(total + 49000).format('0,0'));

		(!total) ? $('#thanh-toan').addClass('hidden') : $('#thanh-toan').removeClass('hidden');
	}

	const submitPay = (donHang, chiTiet) => {
		$.ajax({
			url: window.location.href,
			type: 'POST',
			dataType: 'JSON',
			data: {
				action: 'submit-pay',
				donHang,
				chiTiet
			},
		})
		.done(function(res) {
			window.location.href = `${url}don-mua`;
		})
		.fail(function(err) {
			console.log("Error: ", err);
		});
		
	}

	const handlePay = () => {
		const chiTietPhienIds = [];
		$.each($('.check-items'), function(index, val) {
			if ($(this).is(':checked')) chiTietPhienIds.push({
				'iMaphiendaugia': $(this).val(),
				'iMucgiadau': $(this).data('gia'),
			});
		});

		const donHang = {
			dThoigianlap: new Date(),
			sDiachi: $('#address').val().trim(),
			sSodienthoai: $('#phone').val().trim(),
			sGhichu: $('#note').val().trim(),
			iTrangthai: 1,
		};
		submitPay(donHang, chiTietPhienIds);
	}

	$('.check-items').change(function(event) {
		getTotalPrice();
	});

	$('.check-shop').change(function (e) {
		const checked = $(this).is(":checked");
		$itemChecks = $(this).closest('.shop-container').find('.check-items');
		checked ? $itemChecks.prop('checked', true) : $itemChecks.prop('checked', false);
		$itemChecks.change();
	});

	$('#thanh-toan').click(function (e) {
		e.preventDefault();
		$('#pay').removeClass('hidden');
		$('#fullname').focus();
	});

	$('#dat-hang').click(function(event) {
		if (!$('#fullname').val().trim()) {
			$('#fullname').focus();
			showMessage('error', 'Vui lòng họ tên người nhận.');
			return;
		}
		if (!$('#phone').val().trim()) {
			$('#phone').focus();
			showMessage('error', 'Vui lòng nhập số điện thoại người nhận');
			return;
		}
		const regPhone = new RegExp('^[0-9]+$');
		if (!regPhone.test($('#phone').val().trim())) {
			$('#phone').focus();
			showMessage('error', 'Số điện thoại không đúng định dạng.');
			return;
		}
		if (!$('#address').val().trim()) {
			$('#address').focus();
			showMessage('error', 'Vui lòng nhập địa chỉ');
			return;
		}
		handlePay();
	});
});