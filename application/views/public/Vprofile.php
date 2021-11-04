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
<div class="profile container border pt-3">
	<div id="profile" role="tabpanel" aria-labelledby="home-tab">
		<div class="row">
			<div class="col">
				<div class="panel">
					<div class="panel-heading">
						<h3 class="text-center text-bold text-uppercase">Thông tin tài khoản</h3>
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
						<h3 class="text-center text-bold text-uppercase">Thông tin chủ hàng</h3>
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
	<div id="change-profile" role="tabpanel" aria-labelledby="change-profile-tab">
		<div class="panel">
			<div class="panel-heading">
				<h3 class="text-center text-bold text-uppercase">Cập nhập thông tin chủ hàng</h3>
			</div>
			<div class="panel-body">
				<div><label>Trạng thái:</label>&emsp;{$tttk[$nguoiBan.iTrangthai]}</div>
				<form method="post" class="form" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-7">
                            <div class="form-group">
                                <label for="tenshop">Tên shop <span class="text-danger">*</span></label>
                                <input type="text" name="tenshop" id="tenshop" class="form-control" value="{$nguoiBan.sTenshop}" required autofocus>
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