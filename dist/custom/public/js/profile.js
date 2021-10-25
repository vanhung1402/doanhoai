const chiTiet = document.getElementById('chi-tiet-root').outerHTML.replace('id="chi-tiet-root"', '');
$(document).ready(function() {
	let chiTietBiXoa = [];

	$('#doi-mat-khau').click(function(event) {
		event.preventDefault();
		if ($('#new_password').val().trim() !== $('#re_new_password').val().trim()) {
			showMessage('warning', 'Mật khẩu không khớp');
		} else {
			$('#form-change-pasword').submit();
		}
	});

	$(document).on('click', '.btn-xoa-chi-tiet', function(event) {
		event.preventDefault();
		const cf = confirm('Xác định thực hiện thao tác này');
		if (cf) {
			const idXoa = $(this).closest('tr').data('id');
			if (idXoa) chiTietBiXoa.push(idXoa);
			$(this).closest('tr').remove();
		}
	});

	$('#them-chi-tiet').click(function(event) {
		const newChiTiet = $(chiTiet);
		$('#list-chi-tiet tbody').append(newChiTiet);
	});

	$('#btn-save').click(function(event) {
		const check = checkRequired();
		if (check) {
			const sanPham = {
				iMadanhmuclh: $('#loai-hang').val(),
				sTensanpham: $('#ten-san-pham').val(),
				sVideo: '',
				sMota: $('#mo-ta').val(),
				sThuonghieu: $('#thuong-hieu').val(),
				sChatlieu: $('#chat-lieu').val(),
				sTinhtrang: $('#tinh-trang').val(),
				iTrangthai: 1,
			}

			const chiTietThemMoi = [];
			const chiTietSuaDoi = [];

			$.each($('.chi-tiet'), function() {
				$this = $(this);
				const mauSac = $this.find('.mau-sac').first().val();
				const kichThuoc = $this.find('.kich-thuoc').first().val();
				const soLuong = $this.find('.so-luong').first().val();
				const dataId = $this.data('id');
				let chiTiet = {
					iMasize: kichThuoc,
					iMamausac: mauSac,
					iSoluong: Number(soLuong)
				};

				if (dataId) {
					chiTiet.iMactsanpham = dataId;
					chiTietSuaDoi.push(chiTiet);
				} else {
					if (soLuong) {
						chiTietThemMoi.push(chiTiet);
					}
				}
			});

			const chiTietConLai = [...chiTietThemMoi, ...chiTietSuaDoi];
			const mapCheck = {};

			chiTietConLai.forEach( function(el) {
				mapCheck[`${el.iMamausac}${el.iMasize}`] = true;
			});

			if (Object.keys(mapCheck).length !== chiTietConLai.length) {
				showMessage('error', 'Chi tiết sản phẩm không được trùng màu sắc và kích thước');
				return;
			}
			console.log(sanPham);
			if (urlObj.searchParams.get('sp')) {
				suaSanPham(sanPham, chiTietThemMoi, chiTietSuaDoi);
			} else {
				themSanPham(sanPham, chiTietThemMoi);
			}
		}
	});

	const suaSanPham = (sanPham, chiTietThemMoi, chiTietSuaDoi) => {
		$.ajax({
			url: window.location.href,
			type: 'POST',
			dataType: 'JSON',
			data: {
				action: 'sua-san-pham',
				sanPham,
				chiTietThemMoi,
				chiTietSuaDoi,
				chiTietBiXoa
			},
		})
		.done(function(res) {
			console.log(res);
			if (res) {
				// window.location.reload();
			}
		})
		.fail(function(err) {
			console.log("Error: ", err);
			showMessage('error', 'Đã có lỗi xảy ra, vui lòng kiểm tra lại')
		});
		
	}

	const themSanPham = (sanPham, chiTiet) => {
		$.ajax({
			url: window.location.href,
			type: 'POST',
			dataType: 'JSON',
			data: {
				action: 'them-san-pham',
				sanPham,
				chiTiet
			},
		})
		.done(function(res) {
			console.log(res);
			if (res) {
				window.location.reload();
			}
		})
		.fail(function(err) {
			console.log("Error: ", err);
			showMessage('error', 'Đã có lỗi xảy ra, vui lòng kiểm tra lại')
		});
		
	}

	const checkRequired = () => {
		let isValid = true;
		$.each($('#form-san-pham .form-group'), function() {
			if ($(this).find('label span.text-danger').length) {
				const valueObj = $(this).find('input, select, textarea').first();
				if (isValid && !valueObj.val().trim()) {
					valueObj.focus();
					showMessage('warning', 'Vui lòng không bỏ trống trường này!');
					isValid = false;
				}
			}
		});

		return isValid;
	}
});