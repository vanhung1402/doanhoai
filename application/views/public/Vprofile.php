<style type="text/css">
	#myTabContent {
		padding: 20px;
		border: 1px solid #ccc;
		border-top: none;
	}
	.panel {
		margin-bottom: 10px;
	}
	.panel-heading {
		border-bottom: 1px solid #ccc;
	}
	.panel-body {
		padding: 10px 5px;
	}
	.shop-logo {
		width: 10vw;
		height: 10vw;
		object-fit: cover;
		border: 1px solid #ccc;
		border-radius: 50%;
		display: inline-flex;
		justify-content: center;
		overflow: hidden;
		margin-right: 15px;
	}
	.shop-logo img {
		height: 100%;
	}
	.mv-120 {
		min-width: 120px;
	}
	.mv-80 {
		min-width: 80px;
	}
	.logo-info {
		display: flex;
		align-items: center;
	}
	.file-input {
		display: flex;
		align-items: center;
		height: calc(1.5em + .75rem + 12px);;
	}
	.btn-save {
		background: #1bb1dc;
	    border: 0;
	    border-radius: 3px;
	    padding: 8px 30px;
	    color: #fff;
	    transition: 0.3s;
	}
	.btn-save:hover {
		background: #0a98c0;
	    cursor: pointer
	}
	.text-bold {
		font-weight: bold;
	}
	table.table tr th {
		text-align: center;
	}
	table.table tr th:last-child {
		text-align: right;
	}
	table.table tr th, table.table tr td {
		vertical-align: middle;
	}
	@media only screen and (max-width: 756px) {
		.logo-info {
			flex-direction: column;
		}
		.shop-logo {
			width: 55vw;
			height: 55vw;
			margin-right: 0;
			margin-bottom: 15px;
		}
		.content-info {
			width: 100%;
		}
	}
</style>

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active"><a href="{$url}">Home</a></li>
		<li class="breadcrumb-item" aria-current="page">Profile</li>
	</ol>
</nav>
<div class="profile container">

	<ul class="nav nav-tabs" id="myTab" role="tablist">
		<li class="nav-item" role="presentation">
			<a class="nav-link" id="home-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile</a>
		</li>
		{if $user.iPhanloai == 2}
		<li class="nav-item" role="presentation">
			<a class="nav-link" id="change-profile-tab" data-toggle="tab" href="#change-profile" role="tab" aria-controls="change-profile" aria-selected="true">Cập nhập thông tin</a>
		</li>
		{/if}
		<li class="nav-item" role="presentation">
			<a class="nav-link" id="changepassword-tab" data-toggle="tab" href="#changepassword" role="tab" aria-controls="changepassword" aria-selected="true">Đổi mật khẩu</a>
		</li>
		<li class="nav-item active" role="presentation">
			<a class="nav-link active" id="products-tab" data-toggle="tab" href="#products" role="tab" aria-controls="products" aria-selected="false">Sản phẩm</a>
		</li>
		<li class="nav-item" role="presentation">
			<a class="nav-link" id="products-list-tab" data-toggle="tab" href="#products-list" role="tab" aria-controls="products-list" aria-selected="false">Danh sách sản phẩm</a>
		</li>
	</ul>
	<div class="tab-content" id="myTabContent">
		<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="home-tab">
			<div class="row">
				<div class="col">
					<div class="panel">
						<div class="panel-heading">
							<h3>Thông tin tài khoản</h3>
						</div>
						<div class="panel-body">
							<div><label class="mv-120">Họ và tên:</label>&emsp;{$user.sTennguoidung}</div>
							<div><label class="mv-120">Tên đăng nhập:</label>&emsp;{$user.sTendangnhap}</div>
							{if $user.iPhanloai == 1}
							<div><label class="mv-120">Trạng thái:</label>&emsp;{$tttk[$nguoiBan.iTrangthai]}</div>
							{/if}
						</div>
					</div>	
				</div>
				{if $user.iPhanloai == 2}
				<div class="col">
					<div class="panel">
						<div class="panel-heading">
							<h3>Thông tin chủ hàng</h3>
						</div>
						<div class="panel-body">
							<div class="logo-info">
								<div class="shop-logo">
									{if ($nguoiBan.sMotahinhanh)}
									<img src="{$url}files/shop/logo/{$nguoiBan.sMotahinhanh}" alt="Logo {$nguoiBan.sTenshop}">
									{else}
									<img src="{$url}dist/templates/public/img/no-image.png" alt="No image">
									{/if}
								</div>
								<div class="content-info">
									<div><label class="mv-80">Tên shop:</label>&emsp;{$nguoiBan.sTenshop}</div>
									<div><label class="mv-80">Trạng thái:</label>&emsp;{$tttk[$nguoiBan.iTrangthai]}</div>
								</div>
							</div>
							<div class="text-justify mt-3"><label class="mv-80">Mô tả:</label>&emsp;{$nguoiBan.sMotashop}</div>
						</div>
					</div>	
				</div>
				{/if}
			</div>
		</div>
		{if $user.iPhanloai == 2}
		<div class="tab-pane fade" id="change-profile" role="tabpanel" aria-labelledby="change-profile-tab">
			<div class="panel">
				<div class="panel-heading">
					<h3>Thông tin chủ hàng</h3>
				</div>
				<div class="panel-body">
					<div><label>Trạng thái:</label>&emsp;{$tttk[$nguoiBan.iTrangthai]}</div>
					<form method="post" class="form" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-7">
                                <div class="form-group">
                                    <label for="tenshop">Tên shop <span class="text-danger">*</span></label>
                                    <input type="text" name="tenshop" id="tenshop" class="form-control" value="{$nguoiBan.sTenshop}" required>
                                </div>
                                <div class="form-group">
                                    <label for="logoshop">Ảnh logo (tối đa 2MB) {if empty($nguoiBan.sMotahinhanh)}<span class="text-danger">*</span>{/if}</label>
                                    <input type="file" accept=".jpg, .ijge, .png" name="logoshop" id="logoshop" class="form-control" {if empty($nguoiBan.sMotahinhanh)}required{/if}>
                                </div>
                                <div class="form-group">
                                    <label for="giayphep">Giấy phép kinh doanh (tối đa 2MB)</label>
                                    <input type="file" accept=".jpg, .ijge, .png" name="giayphep" id="giayphep" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="mota">Giới thiệu shop (tối thiểu 150, tối đa 500 ký tự) <span class="text-danger">*</span></label>
                                    <textarea name="mota" minlength="150" maxlength="500" id="mota" cols="30" rows="8" class="form-control" required>{$nguoiBan.sMotashop}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-12 text-center">
                                <button class="btn btn-success" type="submit" name="action" value="cap-nhap-shop"><i class="fa fa-save" aria-hidden="true"></i>&emsp;Cập nhập</button>
                            </div>
						</div>
					</form>
				</div>
			</div>
		</div>
		{/if}
		<div class="tab-pane fade" id="changepassword" role="tabpanel" aria-labelledby="changepassword-tab">
			<div class="panel">
				<div class="panel-heading">
					<h3>Đổi mật khẩu</h3>
				</div>
				<div class="panel-body">
					<form method="post" id="form-change-pasword">
						<div class="row">
							<div class="col-sm-3">
								<div class="form-group">
	                                <label for="new_password">Nhập mật khẩu mới</label>
	                                <input type="password" name="new_password" id="new_password" class="form-control" minlength="6" required>
	                            </div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
	                                <label for="re_new_password">Nhập lại mật khẩu mới</label>
	                                <input type="password" name="re_new_password" id="re_new_password" class="form-control" minlength="6" required>
	                            </div>
							</div>

							<div class="col-sm-3">
								<label>&nbsp;</label>
								<div class="form-group">
                                	<input type="text" class="hidden form-control" name="action" value="doi-mat-khau">
                                	<button class="btn btn-success" type="submit" id="doi-mat-khau"><i class="fa fa-save" aria-hidden="true"></i>&emsp;Cập nhập</button>
	                            </div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="tab-pane fade show active" id="products" role="tabpanel" aria-labelledby="products-tab">
			<div class="panel">
				<div class="panel-heading">
					<h3 class="text-center text-bold text-uppercase">Thêm sản phẩm</h3>
				</div>
				<div class="panel-body">
					<div class="row" id="form-san-pham">
						<div class="col-sm-12">
                            <div class="form-group">
                                <label for="ten-san-pham">Tên sản phẩm <span class="text-danger">*</span></label>
                                <input type="text" name="ten-san-pham" class="form-control" id="ten-san-pham" placeholder="VD: điện thoại, giày, dép..." value="{if !empty($sua)}{$sua.sanPham.sTensanpham}{/if}" required>
                            </div>
						</div>
						<div class="col-sm-4">
                            <div class="form-group">
                                <label for="thuong-hieu">Thương hiệu <span class="text-danger">*</span></label>
                                <input type="text" name="thuong-hieu" class="form-control" id="thuong-hieu" required placeholder="VD: Apple, Samsung, Xiaomi..." value="{if !empty($sua)}{$sua.sanPham.sThuonghieu}{/if}">
                            </div>
						</div>
						<div class="col-sm-4">
                            <div class="form-group">
                                <label for="chat-lieu">Chất liệu <span class="text-danger">*</span></label>
                                <input type="text" name="chat-lieu" class="form-control" id="chat-lieu" required placeholder="Gốm, kính, nhựa..." value="{if !empty($sua)}{$sua.sanPham.sChatlieu}{/if}">
                            </div>
						</div>
						<div class="col-sm-4">
                            <div class="form-group">
                                <label for="tinh-trang">Tình trạng <span class="text-danger">*</span></label>
                                <input type="text" name="tinh-trang" class="form-control" id="tinh-trang" required placeholder="VD: nguyên chiếc, 99%, like new..." value="{if !empty($sua)}{$sua.sanPham.sTinhtrang}{/if}">
                            </div>
						</div>
						<div class="col-sm-4">
                            <div class="form-group">
                                <label for="loai-hang">Loại hàng <span class="text-danger">*</span></label>
                                <select name="loai-hang" id="loai-hang" class="form-control select2">
                                	{foreach $danhMucLoaiHang as $loaiHang}
                                	<option {if !empty($sua) && $sua.sanPham.iMadanhmuclh == $loaiHang.iMadanhmuclh}selected{/if} value="{$loaiHang.iMadanhmuclh}">{$loaiHang.sTendanhmuclh}</option>
                                	{/foreach}
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="video">Video</label>
                                <input type="file" accept="video/*" name="video" class="form-control file-input" id="video">
                            </div>
						</div>
						<div class="col-sm-8">
                            <div class="form-group">
                                <label for="tinh-trang">Mô tả</label>
                                <textarea name="mo-ta" id="mo-ta" cols="30" rows="5" class="form-control">{if !empty($sua)}{$sua.sanPham.sMota}{/if}</textarea>
                            </div>
						</div>
						<div class="col-sm-12">
							<table id="list-chi-tiet" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>Màu sắc</th>
										<th>Kích thước</th>
										<th>Số lượng</th>
										<th>Tác vụ</th>
									</tr>
								</thead>
								<tbody>
									<tr id="chi-tiet-root" class="chi-tiet" data-id="0">
										<td>
											<select class="mau-sac form-control" name="mau-sac">
												{foreach $danhSachMauSac as $mauSac}
												<option value="{$mauSac.iMamausac}">{$mauSac.sTenmausac}</option>
												{/foreach}
											</select>
										</td>
										<td>
											<select class="kich-thuoc form-control" name="kich-thuoc">
												{foreach $danhSachKichThuoc as $kichThuoc}
												<option value="{$kichThuoc.iMasize}">{$kichThuoc.sTensize}</option>
												{/foreach}
											</select>
										</td>
										<td>
											<input type="number" name="so-luong" class="form-control so-luong" min="1" placeholder="VD: 1, 2, 5, 10, 50, ...">
										</td>
										<td class="text-right">
											<button class="btn btn-sm btn-danger btn-xoa-chi-tiet"><i class="fa fa-times"></i></button>
										</td>
									</tr>	
								</tbody>
								<tfoot>
									<tr>
										<th colspan="4" class="text-right">
											<button id="them-chi-tiet" class="btn btn-sm btn-info"><i class="fa fa-plus"></i>&emsp;Thêm chi tiết mới</button>
										</th>
									</tr>
								</tfoot>
							</table>
						</div>
						<div class="col-sm-12 mt-3 text-center">
							<button id="btn-save" class="btn-get-started btn-save text-bold">
								<i class="fa fa-save" aria-hidden="true"></i>&emsp;Lưu
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane fade" id="products-list" role="tabpanel" aria-labelledby="products-list-tab">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th>Mã sản phẩm</th>
						<th>Tên sản phẩm</th>
						<th>Danh mục</th>
						<th>Thương hiệu</th>
						<th>Chất liệu</th>
						<th>Tình trạng</th>
						<th>Số chi tiết</th>
						<th>Tác vụ</th>
					</tr>
				</thead>
				<tbody>
					{foreach $danhSachSanPham as $key => $sp}
					<tr>
						<td class="text-center">{$key + 1}</td>
						<td class="text-center">{$sp.iMasanpham}</td>
						<td>{$sp.sTensanpham}</td>
						<td>{$sp.sTendanhmuclh}</td>
						<td>{$sp.sThuonghieu}</td>
						<td>{$sp.sChatlieu}</td>
						<td>{$sp.sTinhtrang}</td>
						<td class="text-center">{$sp.soChiTiet}</td>
						<td class="text-right">
							<form method="post">
								<a href="{$url}profile?sp={$sp.iMasanpham}" class="btn btn-sm btn-info">
									<i class="fa fa-edit"></i>
								</a>
								<input type="hidden" name="san-pham" value="{$sp.iMasanpham}">
								{if !$sp.soChiTiet}
								<button class="btn btn-danger btn-sm" name="action" value="xoa-san-pham" onclick="return confirm('Xác nhận thao tác này?');">
									<i class="fa fa-trash"></i>
								</button>
							</form>
							{/if}
						</td>
					</tr>
					{/foreach}
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript" src="{$url}dist/custom/public/js/profile.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		const themChiTiet = (chiTietValue) => {
			const newChiTiet = $(chiTiet);
			newChiTiet.data('id', chiTietValue.iMactsanpham);
			newChiTiet.find('.mau-sac').first().val(chiTietValue.iMamausac);
			newChiTiet.find('.kich-thuoc').first().val(chiTietValue.iMasize);
			newChiTiet.find('.so-luong').first().val(chiTietValue.iSoluong);
			if (chiTietValue.iMaphiendaugia) {
				newChiTiet.find('.btn-xoa-chi-tiet').first().remove();
			}
			$('#list-chi-tiet tbody').append(newChiTiet);
		}
	{if !empty($sua)}
		$('#chi-tiet-root').remove();
		{foreach $sua.chiTiet as $ct}
		themChiTiet(JSON.parse(`{json_encode($ct)}`));
		{/foreach}
	{/if}
	});
</script>