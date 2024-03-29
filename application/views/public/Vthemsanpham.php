<link href="{$url}dist/custom/public/css/themsanpham.css" rel="stylesheet">

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active"><a href="{$url}">Home</a></li>
		<li class="breadcrumb-item" aria-current="page">Profile</li>
	</ol>
</nav>
<div class="profile container border pt-3">
	<div id="products" role="tabpanel" aria-labelledby="products-tab">
		<div class="panel">
			<div class="panel-heading">
				<h3 class="text-center text-bold text-uppercase">Thêm sản phẩm</h3>
			</div>
			<div class="panel-body">
				<form method="POST" enctype="multipart/form-data">
					<div class="row" id="form-san-pham">
						<div class="col-sm-12">
                            <div class="form-group">
                                <label for="ten-san-pham">Tên sản phẩm <span class="text-danger">*</span></label>
                                <input type="text" name="ten-san-pham" class="form-control" id="ten-san-pham" placeholder="VD: Quần âu nam kẻ" value="{if !empty($sua)}{$sua.sanPham.sTensanpham}{/if}" required>
                            </div>
						</div>
						<div class="col-sm-4">
                            <div class="form-group">
                                <label for="thuong-hieu">Thương hiệu <span class="text-danger">*</span></label>
                                <input type="text" name="thuong-hieu" class="form-control" id="thuong-hieu" required placeholder="VD: Việt Nam..." value="{if !empty($sua)}{$sua.sanPham.sThuonghieu}{/if}">
                            </div>
						</div>
						<div class="col-sm-4">
                            <div class="form-group">
                                <label for="chat-lieu">Chất liệu <span class="text-danger">*</span></label>
                                <input type="text" name="chat-lieu" class="form-control" id="chat-lieu" required placeholder="VD: 100% cotton" value="{if !empty($sua)}{$sua.sanPham.sChatlieu}{/if}">
                            </div>
						</div>
						<div class="col-sm-4">
                            <div class="form-group">
                                <label for="tinh-trang">Tình trạng <span class="text-danger">*</span></label>
                                <input type="text" name="tinh-trang" class="form-control" id="tinh-trang" required placeholder="VD: Mới" value="{if !empty($sua)}{$sua.sanPham.sTinhtrang}{/if}">
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

                            <div class="form-group" id="input-anh">
                                <label for="anh">Ảnh <span class="text-danger {if !empty($sua)}hidden{/if}" id="input-anh-danger">*</span></label>
                                <input type="file" accept="image/*" name="anh" class="form-control file-input" multiple="true" id="anh" {if empty($sua)}required{/if}>
                                {if !empty($sua)}
                                <div class="img-thumbs">
                                	{foreach $sua.hinhAnh as $index => $anh}
							        <div class="img-thumb">
							          <img src="{$url_file}{$anh.sHinhanh}" alt="Thumbnail {$index}">
							          <button class="btn-remove-img" value="{$anh.iMahinhanh}" type="button">
							          	<i class="fa fa-times"></i>
							          </button>
							        </div>
							        {/foreach}
                                </div>	
                                {/if}
                            </div>

                            <div class="form-group">
                                <label for="video">Video</label>
                                <input type="file" accept="video/*" name="video" class="form-control file-input" id="video">
                            </div>
						</div>
						<div class="col-sm-8">
                            <div class="form-group">
                                <label for="tinh-trang">Mô tả</label>
                                <textarea name="mo-ta" id="mo-ta" cols="30" rows="9" class="form-control">{if !empty($sua)}{$sua.sanPham.sMota}{/if}</textarea>
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
										<th colspan="4">
											<div class="action-wrapper">
												<div class="add">
													<button id="them-mau-sac" type="button" class="btn btn-sm btn-warning"><i class="fa fa-plus"></i>&emsp;Thêm màu sắc mới</button>
													<button id="them-kich-thuoc" type="button" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>&emsp;Thêm kích thước mới</button>		
												</div>
												<button id="them-chi-tiet" type="button" class="btn btn-sm btn-info"><i class="fa fa-plus"></i>&emsp;Thêm chi tiết mới</button>
											</div>
										</th>
									</tr>
								</tfoot>
							</table>
						</div>
						<div class="col-sm-12 mt-3 text-center">
							<button type="button" id="btn-save" class="btn-get-started btn-save text-bold">
								<i class="fa fa-save" aria-hidden="true"></i>&emsp;Lưu
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="{$url}dist/custom/public/js/themsanpham.js"></script>
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
	{if !empty($sua)}
	let maxHinhAnh = 3 - {sizeof($sua.hinhAnh)};
	{else}
	let maxHinhAnh = 3;
	{/if}
</script>