let chiTiet = document.getElementById('chi-tiet-root').outerHTML.replace('id="chi-tiet-root"', '');
$(document).ready(function() {
	let chiTietBiXoa = [];
	let anhBiXoa = [];

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
			let errorSoLuong = null;

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
				if (chiTiet.iSoluong < 1) errorSoLuong = $this;

				if (dataId) {
					chiTiet.iMactsanpham = dataId;
					chiTietSuaDoi.push(chiTiet);
				} else {
					if (soLuong) {
						chiTietThemMoi.push(chiTiet);
					}
				}
			});

			if (errorSoLuong) {
				showMessage('error', 'Số lượng sản phẩm không được nhỏ hơn 1.');
				errorSoLuong.find('.so-luong').focus();
				return;
			}

			const chiTietConLai = [...chiTietThemMoi, ...chiTietSuaDoi];
			const mapCheck = {};

			chiTietConLai.forEach( function(el) {
				mapCheck[`${el.iMamausac}${el.iMasize}`] = true;
			});

			if (Object.keys(mapCheck).length !== chiTietConLai.length) {
				showMessage('error', 'Chi tiết sản phẩm không được trùng màu sắc và kích thước');
				return;
			}
			if ($('#anh').attr('required') && !$('#anh').prop('files')[0]) {
				showMessage('error', 'Vui lòng chọn ảnh cho sản phẩm');
				return;
			}
			if ($('#anh').prop('files').length + (3 - maxHinhAnh) < 2) {
				showMessage('error', 'Cần chọn ít nhất 2 ảnh.');
				return;
			}
			if (maxHinhAnh === 0 && $('#anh').prop('files').length) {
				showMessage('error', `Vui lòng xóa 1 hình ảnh đã có để upload hình ảnh mới`);
				return;
			}
			if ($('#anh').prop('files').length > maxHinhAnh) {
				showMessage('error', `Chỉ được chọn nhiều nhất ${maxHinhAnh} ảnh`);
				return;
			}
			if (urlObj.searchParams.get('sp')) {
				suaSanPham(sanPham, chiTietThemMoi, chiTietSuaDoi);
			} else {
				themSanPham(sanPham, chiTietThemMoi);
			}
		}
	});

	const suaSanPham = async (sanPham, chiTietThemMoi, chiTietSuaDoi) => {
		const fileObj = $('#video');
		const fileUpload = fileObj.prop('files')[0] ? await uploadFile(fileObj) : '';
		const newSanPham = { ...sanPham, sVideo: fileUpload };

		const fileAnhObj = $('#anh');
		const hinhAnh = [];
		for (const [key, file] of Object.entries(fileAnhObj.prop('files'))) {
			const resultUpload = await uploadFileAjax(file);
			if (!resultUpload) return;
			hinhAnh.push({
				sHinhanh: resultUpload,
				iTrangthai: 1,
			});
		}

		$.ajax({
			url: window.location.href,
			type: 'POST',
			dataType: 'JSON',
			data: {
				action: 'sua-san-pham',
				sanPham: newSanPham,
				chiTietThemMoi,
				chiTietSuaDoi,
				chiTietBiXoa,
				hinhAnh,
				anhBiXoa,
			},
		})
		.done(function(res) {
			window.location.reload();
		})
		.fail(function(err) {
			console.log("Error: ", err);
			showMessage('error', 'Đã có lỗi xảy ra, vui lòng kiểm tra lại')
		});
		
	}

	const uploadFile = async ($objectFile) => {
		var form = new FormData();
		form.append("uploadedFile", $objectFile.prop('files')[0]);

		const uploadResult = await $.ajax({
            type: "POST",
            url: "http://localhost/upload-file-service/upload.php",
            mimeType: "multipart/form-data",
            processData: false,
            contentType: false,
            data: form,
            error: function (e) {
                console.log(e);
            }
        });
        const uploadResultJson = JSON.parse(uploadResult);
        return (uploadResultJson.status) ? uploadResultJson.path.replace('./', '') : '';
	}

	const uploadFileAjax = async ($objectFile) => {
		if ($objectFile.size > maxPostFileSize) {
			showMessage('error', 'Chỉ được chọn file < 2MB');
			return false;
		}
		var form = new FormData();
		form.append("uploadedFile", $objectFile);

		const uploadResult = await $.ajax({
            type: "POST",
            url: "http://localhost/upload-file-service/upload.php",
            mimeType: "multipart/form-data",
            processData: false,
            contentType: false,
            data: form,
            error: function (e) {
                console.log(e);
            }
        });
        const uploadResultJson = JSON.parse(uploadResult);
        console.log(uploadResultJson);
        return (uploadResultJson.status) ? uploadResultJson.path.replace('./', '') : '';
	}

	const themSanPham = async (sanPham, chiTiet) => {
		const fileVideoObj = $('#video');
		const fileAnhObj = $('#anh');
		const hinhAnh = [];
		for (const [key, file] of Object.entries(fileAnhObj.prop('files'))) {
			const resultUpload = await uploadFileAjax(file);
			if (!resultUpload) return;
			hinhAnh.push({
				sHinhanh: resultUpload,
				iTrangthai: 1,
			});
		}
		const fileUpload = fileVideoObj.prop('files')[0] ? await uploadFile(fileVideoObj) : '';
		const newSanPham = { ...sanPham, sVideo: fileUpload };

		$.ajax({
			url: window.location.href,
			type: 'POST',
			dataType: 'JSON',
            mimeType: 'multipart/form-data',
			data: {
				action: 'them-san-pham',
				sanPham: newSanPham,
				hinhAnh,
				chiTiet,
			},
		})
		.done(function(res) {
			window.location.reload();
		})
		.fail(function(err) {
			console.log("Error: ", err);
			showMessage('error', 'Đã có lỗi xảy ra, vui lòng kiểm tra lại')
		});
	}

	const checkRequired = () => {
		let isValid = true;
		$.each($('#form-san-pham .form-group'), function() {
			if ($(this).find('label span.text-danger').length && !$(this).find('label span.text-danger.hidden').length) {
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

	$('.btn-remove-img').click(function (e) {
		e.preventDefault();
		let confirmAnh = confirm('Bạn có thực sự muốn xóa hình ảnh này?');
		if (!confirmAnh) return;
		let iMahinhanh = $(this).val();
		anhBiXoa.push(iMahinhanh);
		maxHinhAnh++;
		$(this).closest('.img-thumb').remove();
		if (!$('.btn-remove-img').length) {
			$('#anh').attr('required', true);
			$('#input-anh-danger').removeClass('hidden');
		}
	});

	$('#them-mau-sac').click(async () => {
		const { value: mau } = await Swal.fire({
		  title: 'Thêm màu sắc mới',
		  input: 'text',
		  inputLabel: 'Tên màu',
		  inputPlaceholder: 'Tên màu...',
		  confirmButtonText: 'Lưu',
		})

		if (mau && mau.trim()) {
			themMau(mau.trim());
		}
	})

	$('#them-kich-thuoc').click(async () => {
		const { value: size } = await Swal.fire({
		  title: 'Thêm kích thước mới',
		  input: 'text',
		  inputLabel: 'Kích thước',
		  inputPlaceholder: 'Tên kích thước...',
		  confirmButtonText: 'Lưu',
		})

		if (size && size.trim()) {
			themSize(size.trim());
		}
	})

	const themMau = (mau) => {
		$.ajax({
			url: window.location.href,
			type: 'POST',
			dataType: 'JSON',
			data: {
				action: 'them-mau',
				mau,
			},
		})
		.done(function(res) {
			if (res) {
				const newMau = {
					iMamausac: res,
					sTenmausac: mau
				};
				renderMau(newMau);
			}
		})
		.fail(function(err) {
			console.log("Error: ", err);
		});
	}

	const themSize = (size) => {
		$.ajax({
			url: window.location.href,
			type: 'POST',
			dataType: 'JSON',
			data: {
				action: 'them-size',
				size,
			},
		})
		.done(function(res) {
			console.log(res);
			if (res) {
				const newSize = {
					iMasize: res,
					sTensize: size
				};
				renderSize(newSize);
			}
		})
		.fail(function(err) {
			console.log("Error: ", err);
		});
	}

	const renderMau = (mau) => {
		const html = `<option value="${mau.iMamausac}">${mau.sTenmausac}</option>`;
		let newChiTiet = $(chiTiet);
		chiTiet = newChiTiet;
		newChiTiet.find('.mau-sac').append($(html));
		$.each($(document).find('.mau-sac'), function(index, val) {
			const htmlThis = $(this).html() + html;
			$(this).html(htmlThis);
		});
	}

	const renderSize = (size) => {
		const html = `<option value="${size.iMasize}">${size.sTensize}</option>`;
		let newChiTiet = $(chiTiet);
		newChiTiet.find('.kich-thuoc').append($(html));
		chiTiet = newChiTiet;
		$.each($(document).find('.kich-thuoc'), function(index, val) {
			const htmlThis = $(this).html() + html;
			$(this).html(htmlThis);
		});
	}
});