<link rel="stylesheet" href="{$url}dist/templates/admin/assets/vendors/simple-datatables/style.css">

<section class="section">
    <div class="card">
        <div class="card-header">
        	<h5 class="text-center">Danh sách tài khoản {if empty($phanLoai)}nhân viên hệ thống{else if ($phanLoai == 1)}khách hàng{else}chủ hàng{/if}</h5>
        </div>
        <div class="card-body">
			<div id="taikhoan">
				<div class="table-container">
					{if empty($phanLoai)}
					<div class="action form-group">
						<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cap-tai-khoan"><i data-feather="user-plus"></i>&emsp; Cấp tài khoản</button>
					</div>
					{/if}
					<table class="table table-bordered" id="datatable">
						<thead>
							<tr>
								<th>#</th>
								<th>Tài khoản</th>
								{if !empty($phanLoai)}
								<th>Người dùng</th>
								{/if}
								<th>Trạng thái</th>
                                {if $user.iMaquyen != 10 || empty($phanLoai)}
								<th>Tác vụ</th>
								{/if}
							</tr>
						</thead>
						<tbody>
							{foreach $danhSachTaiKhoan as $key => $taiKhoan}
							<tr>
								<td class="text-center">{$key + 1}</td>
								<td>{$taiKhoan.sTendangnhap}</td>
								{if !empty($phanLoai)}
								<td>{$taiKhoan.sTennguoidung}</td>
								{/if}
								<td class="text-center"><span class="badge bg-{$tttk[$taiKhoan.iTrangthai].color}">{$tttk[$taiKhoan.iTrangthai].title}</span></td>
                                {if $user.iMaquyen != 10 || empty($phanLoai)}
								<td class="text-center">
									<form method="post">
										{if $taiKhoan.iTrangthai == 1}
										<button name="khoa" onclick="return confirm('Xác nhận thực hiện thao tác')" value="{$taiKhoan.iMataikhoan}" class="btn btn-outline-warning btn-sm btn-xs" type="submit" title="Khóa quyền truy cập tài khoản"><i data-feather="lock"></i></button>
										{/if}
										{if $taiKhoan.iTrangthai == 2}
										<button name="mokhoa" onclick="return confirm('Xác nhận thực hiện thao tác')" value="{$taiKhoan.iMataikhoan}" class="btn btn-outline-light btn-sm btn-xs" type="submit" title="Mở khóa tài khoản"><i data-feather="unlock"></i></button>
										{/if}
										{if $taiKhoan.iTrangthai == 3}
										<a href="{$url}admin/shop/{$taiKhoan.iMataikhoan}" class="btn btn-outline-success btn-sm btn-xs"><i data-feather="check-square"></i></a>
										{/if}
									</form>
								</td>
								{/if}
							</tr>
							{/foreach}
						</tbody>
					</table>
				</div>
				<!--Basic Modal -->
			    <div class="modal fade text-left" id="cap-tai-khoan" tabindex="-1" role="dialog"
			        aria-labelledby="myModalLabel1" aria-hidden="true">
			        <div class="modal-dialog modal-dialog-scrollable" role="document">
			            <div class="modal-content">
			            	<form method="post" id="form-cap-tai-khoan">
			            		<div class="modal-header">
			                    	<h5 class="modal-title" id="myModalLabel1">Cấp tài khoản cho nhân viên</h5>
				                    <button type="button" class="close rounded-pill"
				                        data-bs-dismiss="modal" aria-label="Close">
				                        <i data-feather="x"></i>
				                    </button>
				                </div>
				                <div class="modal-body">
				                    <div class="form-body">
				                        <div class="row">
					                        <div class="col-md-4">
					                            <label for="username">Tên đăng nhập</label>
					                        </div>
					                        <div class="col-md-8 form-group">
					                            <input type="text" id="username" class="form-control" name="username" required>
					                        </div>
					                        <div class="col-md-4">
					                            <label for="password">Mật khẩu</label>
					                        </div>
					                        <div class="col-md-8 form-group">
					                            <input type="password" id="password" class="form-control" name="password" minlength="6" required>
					                        </div>
					                        <div class="col-md-4">
					                            <label for="re_password">Nhập lại mật khẩu</label>
					                        </div>
					                        <div class="col-md-8 form-group">
					                            <input type="password" id="re_password" class="form-control" name="re_password" minlength="6" required>
					                        </div>
					                        <input type="text" class="hidden" name="action" value="cap-tai-khoan" >
				                        </div>
				                    </div>
				                </div>
				                <div class="modal-footer">
				                    <button type="button" class="btn" data-bs-dismiss="modal">
				                        <i data-feather="x"></i>&emsp;Đóng
				                    </button>
				                    <button type="button" class="btn btn-primary ml-1" id="btn-cap-tai-khoan">
				                        <i data-feather="user-plus"></i>&emsp;Cấp tài khoản
				                    </button>
				                </div>
			            	</form>
			            </div>
			        </div>
			    </div>
			</div>
        </div>
    </div>
</section>
<script src="{$url}dist/templates/admin/assets/vendors/simple-datatables/simple-datatables.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#btn-cap-tai-khoan').click(async function(event) {
			event.preventDefault();
			if ($('#password').val().trim() === '') {
				showMessage('warning', 'Không được bỏ trống mật khẩu');
				$('#password').focus();
				return false;
			}
			if ($('#re_password').val().trim() === '') {
				showMessage('warning', 'Không được bỏ trống xác nhận mật khẩu');
				$('#re_password').focus();
				return false;
			}
			if ($('#password').val().trim() !== $('#re_password').val().trim()) {
				showMessage('warning', 'Mật khẩu không khớp');
				return false;
			}

			let username = $('#username').val();
	        if (await checkUsername(username)) {
	            showMessage('error', 'Tên tài khoản đã được sử dụng, vui lòng kiểm tra lại');
	            $('#username').focus();
	            return false;      
	        }

			$('#form-cap-tai-khoan').submit();
		});

		const checkUsername = async (username) => {
	        const responseCheck = await $.ajax({
	            url: location.href,
	            type: 'POST',
	            dataType: 'JSON',
	            data: {
	                action: 'check-tai-khoan',
	                username
	            },
	        });
	        return responseCheck;
	    }
	});
</script>