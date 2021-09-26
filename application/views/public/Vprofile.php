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
</style>

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active"><a href="{$url}">Home</a></li>
		<li class="breadcrumb-item" aria-current="page">Profile</li>
	</ol>
</nav>
<div class="profile container">

	<ul class="nav nav-tabs" id="myTab" role="tablist">
		<li class="nav-item active" role="presentation">
			<a class="nav-link active" id="home-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile</a>
		</li>
		<li class="nav-item" role="presentation">
			<a class="nav-link" id="changepassword-tab" data-toggle="tab" href="#changepassword" role="tab" aria-controls="changepassword" aria-selected="true">Đổi mật khẩu</a>
		</li>
		<li class="nav-item" role="presentation">
			<a class="nav-link" id="products-tab" data-toggle="tab" href="#products" role="tab" aria-controls="products" aria-selected="false">Danh sách sản phẩm</a>
		</li>
	</ul>
	<div class="tab-content" id="myTabContent">
		<div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="home-tab">
			<div class="panel">
				<div class="panel-heading">
					<h3>Thông tin tài khoản</h3>
				</div>
				<div class="panel-body">
					<div><label>Họ và tên:</label>&emsp;{$user.sTennguoidung}</div>
					<div><label>Tên đăng nhập:</label>&emsp;{$user.sTendangnhap}</div>
					{if $user.iPhanloai == 1}
					<div><label>Trạng thái:</label>&emsp;{$tttk[$user.iTrangthai]}</div>
					{/if}
				</div>
			</div>
			{if $user.iPhanloai == 2}
			<div class="panel">
				<div class="panel-heading">
					<h3>Thông tin chủ hàng</h3>
				</div>
				<div class="panel-body">
					<div><label>Trạng thái:</label>&emsp;{$tttk[$user.iTrangthai]}</div>
					<form method="post" class="form" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-7">
                                <div class="form-group">
                                    <label for="tenshop">Tên shop <span class="text-danger">*</span></label>
                                    <input type="text" name="tenshop" id="tenshop" class="form-control" value="{$nguoiBan.sTenshop}" required>
                                </div>
                                <div class="form-group">
                                    <label for="logoshop">Ảnh logo</label>
                                    <input type="file" name="logoshop" id="logoshop" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="giayphep">Giấy phép kinh doanh</label>
                                    <input type="file" name="giayphep" id="giayphep" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="mota">Giới thiệu shop</label>
                                    <textarea name="mota" id="mota" cols="30" rows="8" class="form-control">{$nguoiBan.sMotashop}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-12 text-center">
                                <button class="btn btn-success" type="submit" name="action" value="cap-nhap-shop"><i class="fa fa-save" aria-hidden="true"></i>&emsp;Cập nhập</button>
                            </div>
						</div>
					</form>
				</div>
			</div>
			{/if}
		</div>
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
		<div class="tab-pane fade" id="products" role="tabpanel" aria-labelledby="products-tab">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th>Mã sản phẩm</th>
						<th>Tên sản phẩm</th>
						<th>Danh mục</th>
						<th>Thương hiệu</th>
						<th>Tình trạng</th>
						<th>Tác vụ</th>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#doi-mat-khau').click(function(event) {
			event.preventDefault();
			if ($('#new_password').val().trim() !== $('#re_new_password').val().trim()) {
				showMessage('warning', 'Mật khẩu không khớp');
			} else {
				$('#form-change-pasword').submit();
			}
		});
	});
</script>