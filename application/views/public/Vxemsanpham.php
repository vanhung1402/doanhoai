<link href="{$url}dist/custom/public/css/sanpham.css" rel="stylesheet">

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="dist/custom/public/libs/moment.js/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script> 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.11.3/datatables.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.11.3/datatables.min.css"/>
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
      </tr>
    </thead>
    <tbody>
      {foreach $chiTietSanPham as $k => $ct}
      <tr>
        <td class="text-center">{$k + 1}</td>
        <td>{$ct.sTenmausac}</td>
        <td>{$ct.sTensize}</td>
        <td class="text-right format-number">{$ct.iSoluong}</td>
      </tr>
      {/foreach}
    </tbody>
  </table>
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
<br>
<section class="container pb-5" id="binh-luan">
  <h3><span class="title">Người dùng bình luận</span></h3>
  <form method="post">
    <div class="list-binh-luan">
      {if empty($binhLuan)}
      <p class="empty-comment">Chưa có bình luận</p>
      {else}
      {foreach $binhLuan as $bl}
      <div class="binh-luan-container">
        <p><b>{$bl.sTennguoidung}</b> <small><i>{$bl.thoiGian}</i></small></p>
        <p><i>{$bl.sNoidungbinhluan}</i></p>
        {if $user.iManguoidung == $sanPham.iNguoithem}
        {if $bl.iTrangthai == 1}
        <button class="btn btn-xs btn-warning btn-an" value="{$bl.iMabinhluan}" name="an-binh-luan"><i class="fa fa-eye-slash"></i> Ẩn bình luận</button>
        {else}
        <button class="btn btn-xs btn-info btn-an" value="{$bl.iMabinhluan}" name="hien-binh-luan"><i class="fa fa-eye"></i> Hiện bình luận</button>
        {/if}
        {/if}
      </div>
      {/foreach}
      {/if}
    </div>
  </form>
  <br>
  {if $user}
  <div class="form-binh-luạn">
    <form method="post">
      <div class="form-group">
        <textarea name="binh-luan" required id="binh-luan" cols="30" rows="3" class="form-control"></textarea>
      </div>
      <div class="form-group text-right">
        <button name="action" value="gui-binh-luan" type="submit" class="btn btn-info">Gửi bình luận</button>
      </div>
    </form>
  </div>
  {else}
  <div class="alert alert-info">
    Đăng nhập để bình luận
  </div>
  {/if}
</section>

<script type="text/javascript" src="{$url}dist/custom/public/js/xemsanpham.js"></script>