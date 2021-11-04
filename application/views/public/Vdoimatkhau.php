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
	<div id="changepassword" role="tabpanel" aria-labelledby="changepassword-tab">
		<div class="panel">
			<div class="panel-heading">
				<h3 class="text-center text-bold text-uppercase">Đổi mật khẩu</h3>
			</div>
			<div class="panel-body">
				<form method="post" id="form-change-pasword">
					<div class="row">
						<div class="col-sm-3">
							&nbsp;
						</div>
						<div class="col-sm-6">
							<div class="form-group">
                                <label for="new_password">Nhập mật khẩu mới</label>
                                <input type="password" name="new_password" id="new_password" class="form-control" minlength="6" required>
                            </div>
							<div class="form-group">
                                <label for="re_new_password">Nhập lại mật khẩu mới</label>
                                <input type="password" name="re_new_password" id="re_new_password" class="form-control" minlength="6" required>
                            </div>
							<div class="form-group text-center">
                            	<input type="text" class="hidden form-control" name="action" value="doi-mat-khau">
                            	<button class="btn btn-success" type="submit" id="doi-mat-khau"><i class="fa fa-save" aria-hidden="true"></i>&emsp;Cập nhập</button>
                            </div>
						</div>
					</div>
				</form>
			</div>
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