<link href="{$url}dist/custom/public/css/sanpham.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
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
        <td>{$ct.iSoluong}</td>
        <td class="text-center">
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
                <input type="number" min="1" id="gia-khoi-diem" class="form-control">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="buoc-gia">Bước giá (VNĐ)</label>
                <input type="number" min="1" id="buoc-gia" class="form-control">
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
{literal}
<script type="text/javascript">
  let chiTietDauGia = 0;
  let timeStartValue = null;
  let timeEndValue = null;

  $(document).ready(function() {
    $('.btn-dau-gia').click(function(event) {
      let sp = $(this).val();
      chiTietDauGia = sp;
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
      $.ajax({
        url: window.location.href,
        type: 'POST',
        dataType: 'JSON',
        data: {
          action: 'set-dau-gia',
          dauGia
        },
      })
      .done(function(res) {
        console.log("Success: ", res);
      })
      .fail(function(err) {
        console.log("Error: ", err);
      });
      
    }

    const getDauGiaInput = () => {
      let check = true;
      const dauGia = {
        dThoigianbatdau: timeStartValue,
        dThoigianketthuc: timeEndValue,
        iBuocgia: $('#buoc-gia').val(),
        iGiakhoidiem: $('#gia-khoi-diem').val(),
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
      return check ? dauGia : false;
    }

    const getDanhSachDauGia = () => {
      
    }
  });
</script>
{/literal}