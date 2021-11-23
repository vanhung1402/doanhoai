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
    <div class="product-images">
      <div id="img-thumbnail">
        <img src="{$url_file}{$hinhAnh.0.sHinhanh}" alt="{$sanPham.sTensanpham}">
      </div>
      <div id="video-thumbnail" class="hidden">
        <div class="video-carousel">
          <video controls>
            <source src="http://localhost/upload-file-service/{$sanPham.sVideo}" type="video/mp4">
            Your browser does not support HTML video.
          </video>
        </div>
      </div>
      <div class="img-thumbs">
        {foreach $hinhAnh as $index => $anh}
        <div class="img-thumb">
          <img src="{$url_file}{$anh.sHinhanh}" alt="{$sanPham.sTensanpham}">
        </div>
        {/foreach}
        {if $sanPham.sVideo}
        <div class="video-thumb">
          <div class="video-carousel">
            <video controls>
              <source src="http://localhost/upload-file-service/{$sanPham.sVideo}" type="video/mp4">
              Your browser does not support HTML video.
            </video>
          </div>
        </div>
        {/if}
      </div>
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

<script type="text/javascript" src="{$url}dist/custom/public/js/sanpham.js"></script>