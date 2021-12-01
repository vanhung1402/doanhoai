let chiTietDauGia = 0;
let timeStartValue = null;
let timeEndValue = null;
let mapDauGiaList = [];
let trangThai = 1;
let maPhienEdit = 0;
$(document).ready(function() {
    $('.btn-dau-gia').click(function(event) {
        let sp = $(this).val();
        chiTietDauGia = sp;
        trangThai = 1;
    });
    var timeStart = $('#time-start').datetimepicker({
        useCurrent: true,
        minDate: moment().toDate(),
    });
    var timeEnd = $('#time-end').datetimepicker({
        useCurrent: false,
        minDate: moment().toDate(),
    });
    $("#time-start").on("dp.change", function(e) {
        timeStartValue = e.date.format(e.date._f);
        $('#time-end').data("DateTimePicker").minDate(e.date);
    });
    $("#time-end").on("dp.change", function(e) {
        timeEndValue = e.date.format(e.date._f);
        $('#time-start').data("DateTimePicker").maxDate(e.date);
    });
    $('#luu-dau-gia').click(function(event) {
        const dauGia = getDauGiaInput();
        if (dauGia) setDauGia(dauGia);
    });
    const setDauGia = (dauGia) => {
        const action = trangThai === 1 ? 'set-dau-gia' : 'update-dau-gia';
        $.ajax({
            url: window.location.href,
            type: 'POST',
            dataType: 'JSON',
            data: {
                action,
                dauGia
            },
        }).done(function(res) {
            if (res) getDanhSachDauGia();
            $('#exampleModal').modal('hide');
        }).fail(function(err) {
            console.log("Error: ", err);
        });
    }
    const renderDauGia = (listDauGia) => {
        mapDauGiaList = listDauGia;
        let dauGiaHtml = listDauGia.map(function(ct, index) {
            return `<tr>
          <td class="text-center">${index + 1}</td>
          <td>
            <p><b>Màu:</b> ${ct.sTenmausac}</p>
            <p><b>Kích thước:</b> ${ct.sTensize}</p>
          </td>
          <td>
            <p><b>Bắt đầu:</b> ${ct.batDau}</p>
            <p><b>Kết thúc:</b> ${ct.ketThuc}</p>
          </td>
          <td class="text-right">${numeral(ct.iGiakhoidiem).format('0,0')} VNĐ</td>
          <td class="text-right">${numeral(ct.iBuocgia).format('0,0')} VNĐ</td>
          <td class="text-right">${getTrangThaiPhien(ct)}</td>
          <td class="text-right">${getKetQua(ct)}</td>
          <td class="text-right">
            ${getButtonPhienDauGia(ct)}
          </td>
        </tr>`;
        });
        $('#list-dau-gia').html(dauGiaHtml);
    }

    const getKetQua = (phien) => {
        const thoiGianKetThuc = new Date(phien.dThoigianketthuc).getTime();
        const timestamps = new Date().getTime();
        if (timestamps < thoiGianKetThuc) return '';
        return phien.iMadonmua ? '<span class="badge badge-success">Thành công</span>' : '<span class="badge badge-warning">Không thành công<span>';
    }

    const getTrangThaiPhien = (phien) => {
        const thoiGianBatDau = new Date(phien.dThoigianbatdau).getTime();
        const thoiGianKetThuc = new Date(phien.dThoigianketthuc).getTime();
        const timestamps = new Date().getTime();
        if ((timestamps + 7200000) < thoiGianBatDau) return '<span class="badge badge-primary">Chưa diễn ra</span>';
        if (timestamps < thoiGianBatDau) return '<span class="badge badge-warning">Chuẩn bị diễn ra</span>';
        if (timestamps >= thoiGianBatDau && timestamps <= thoiGianKetThuc) return '<span class="badge-success badge">Đang diễn ra</span>';
        return '<span class="badge badge-info">Đã kết thúc</span>';
    }
    const getButtonPhienDauGia = (phien) => {
        const thoiGianBatDau = new Date(phien.dThoigianbatdau).getTime();
        const thoiGianKetThuc = new Date(phien.dThoigianketthuc).getTime();
        const timestamps = new Date().getTime();
        const editAvailable = (timestamps < thoiGianBatDau) || (timestamps > thoiGianKetThuc && !phien.iKetqua);
        const btnEdit = editAvailable ? `<button type="button" class="btn btn-xs btn-info edit-phien" value="${phien.iMaphiendaugia}">
          <i class="fa fa-edit"></i>
        </button>` : ``;
        const btnView = `<a type="button" class="btn btn-xs btn-primary" href="${url}dau-gia-san-pham?phien=${phien.iMaphiendaugia}">
          <i class="fa fa-eye"></i>
        </a>`;
        return `${btnEdit}${btnView}`;
    }
    const getDauGiaInput = () => {
        let check = true;
        const dauGia = {
            dThoigianbatdau: timeStartValue,
            dThoigianketthuc: timeEndValue,
            iBuocgia: $('#buoc-gia').val().replaceAll(',', ''),
            iGiakhoidiem: $('#gia-khoi-diem').val().replaceAll(',', ''),
            iMactsanpham: chiTietDauGia,
            iKetqua: 1,
        };
        for (const [key, value] of Object.entries(dauGia)) {
            if (!value) {
                showMessage('error', `Vui lòng không bỏ trống dữ liệu ${key}`);
                check = false;
                return;
            }
        }
        if (trangThai === 2) dauGia.iMaphiendaugia = maPhienEdit;
        return check ? dauGia : false;
    }
    const getDanhSachDauGia = () => {
        $.ajax({
            url: window.location.href,
            type: 'POST',
            dataType: 'JSON',
            data: {
                action: 'danh-sach-dau-gia',
            },
        }).done(function(res) {
            console.table(res)
            renderDauGia(res);
        }).fail(function(err) {
            console.log("Error: ", err);
        });
    };
    getDanhSachDauGia();
    $(document).on('click', '.edit-phien', function(event) {
        event.preventDefault();
        maPhienEdit = $(this).val();
        const phien = mapDauGiaList.find((phien) => phien.iMaphiendaugia == maPhienEdit);
        if (!phien) return;
        trangThai = 2;
        chiTietDauGia = phien.iMactsanpham;
        $('#exampleModal').modal();
        $('#buoc-gia').val(numeral(phien.iBuocgia).format('0,0'));
        $('#gia-khoi-diem').val(numeral(phien.iGiakhoidiem).format('0,0'));
        $('#time-start').data("DateTimePicker").date(new Date(phien.dThoigianbatdau));
        $('#time-end').data("DateTimePicker").date(new Date(phien.dThoigianketthuc));
    });

    $('.img-thumb').click(function (e) {
        e.preventDefault();

        $('#img-thumbnail').removeClass('hidden');
        $('#video-thumbnail').addClass('hidden');

        $('.img-thumb').removeClass('active');
        $('.video-thumb').removeClass('active');
        $(this).addClass('active');


        const urlImage = $(this).find('img').first().attr('src');
        console.log(urlImage)
        $('#img-thumbnail img').attr('src', urlImage);
    });

    $('.video-thumb').click(function (e) {
        e.preventDefault();

        $('#video-thumbnail').removeClass('hidden');
        $('#img-thumbnail').addClass('hidden');

        $('.img-thumb').removeClass('active');
        $('.video-thumb').addClass('active');
    });

    $('.img-thumb').first().click();
});