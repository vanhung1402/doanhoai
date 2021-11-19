<link href="{$url}dist/custom/public/css/sanpham.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="dist/custom/public/libs/moment.js/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">

<section id="san-pham" class="container">
  <!-- Left Column / Headphones Image -->
  <div class="left-column">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="10000">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img data-image="red" class="active" src="{$url}files/red.png" alt="">
        </div>
        {if $sanPham.sVideo}
        <div class="carousel-item">
          <div class="video-carousel">
            <video controls>
              <source src="http://localhost/upload-file-service/{$sanPham.sVideo}" type="video/mp4">
              Your browser does not support HTML video.
            </video>
          </div>
        </div>
        {/if}
      </div>
      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>


  <!-- Right Column -->
  <div class="right-column">

    <!-- Product Description -->
    <div class="product-description">
      <span>{$sanPham.sTendanhmuclh}</span>
      <h1>{$sanPham.sTensanpham}</h1>
      <p>{$sanPham.sMota}</p>
    </div>

    <!-- Product Configuration -->
    <div class="product-configuration">

      <!-- Product Color -->
      <div class="product-color">
        <span>Màu sắc</span>

        <div class="cable-choose">
          {foreach $mauSac as $ms}
          <button>{$ms}</button>
          {/foreach}
        </div>

      </div>

      <!-- Cable Configuration -->
      <div class="cable-config">
        <span>Kích thước</span>

        <div class="cable-choose">
          {foreach $kichThuoc as $kt}
          <button>{$kt}</button>
          {/foreach}
        </div>
      </div>
      <div class="product-color">
        <p>Chất liệu: {$sanPham.sChatlieu}</p>
        <p>Tình trạng: {$sanPham.sTinhtrang}</p>
      </div>
    </div>
  </div>
</section>
<section id="chi-tiet" class="container">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th colspan="5">Danh sách chi tiết sản phẩm</th>
      </tr>
      <tr>
        <th>#</th>
        <th>Màu sắc</th>
        <th>Kích thước</th>
        <th>Số lượng tồn</th>
        <th>Tác vụ</th>
      </tr>
    </thead>
    <tbody>
      {foreach $chiTietSanPham as $k => $ct}
      <tr>
        <td class="text-center">{$k + 1}</td>
        <td>{$ct.sTenmausac}</td>
        <td>{$ct.sTensize}</td>
        <td class="text-right format-number">{$ct.iSoluong}</td>
        <td class="text-right">
          {if $ct.iSoluong}
          <button value="{$ct.iMactsanpham}" type="button" class="btn btn-sm btn-primary btn-dau-gia" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-gavel"></i> &nbsp; Mở phiên đấu giá</button>
          {/if}
        </td>
      </tr>
      {/foreach}
    </tbody>
  </table>

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="dau-gia-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="dau-gia-modal">Thiết lập thông tin đấu giá</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="time-start">Thời gian bắt đầu</label>
                <div class="form-group">
                    <div class="input-group date" id="time-start">
                      <input type="text" class="form-control" />
                      <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                    </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="time-end">Thời gian kết thúc</label>
                <div class="form-group">
                    <div class="input-group date" id="time-end">
                      <input type="text" class="form-control" />
                      <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                    </div>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="gia-khoi-diem">Giá khởi điểm (VNĐ)</label>
                <input type="text" min="1" id="gia-khoi-diem" class="form-control input-format-number">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="buoc-gia">Bước giá (VNĐ)</label>
                <input type="text" min="1" id="buoc-gia" class="form-control input-format-number">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
          <button type="button" id="luu-dau-gia" class="btn btn-primary">Lưu</button>
        </div>
      </div>
    </div>
  </div>
</section>
<section id="dau-gia" class="container">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th colspan="8">Danh sách phiên đấu giá</th>
      </tr>
      <tr>
        <th>#</th>
        <th>Chi tiết sản phẩm</th>
        <th>Thời gian</th>
        <th>Giá khởi điểm</th>
        <th>Bước giá</th>
        <th>Trạng thái</th>
        <th>Kết quả</th>
        <th>Tác vụ</th>
      </tr>
    </thead>
    <tbody id="list-dau-gia">
      
    </tbody>
  </table>
</section>
{literal}
<script type="text/javascript">
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
    $("#time-start").on("dp.change", function (e) {
      timeStartValue = e.date.format(e.date._f);
      $('#time-end').data("DateTimePicker").minDate(e.date);
    });
    $("#time-end").on("dp.change", function (e) {
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
      })
      .done(function(res) {
        if (res) getDanhSachDauGia();
        $('#exampleModal').modal('hide');
      })
      .fail(function(err) {
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
          <td></td>
          <td class="text-right">
            ${getButtonPhienDauGia(ct)}
          </td>
        </tr>`;
      });

      $('#list-dau-gia').html(dauGiaHtml);
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
      return `${btnEdit}`;
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
      })
      .done(function(res) {
        console.table(res)
        renderDauGia(res);
      })
      .fail(function(err) {
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
  });
</script>
{/literal}