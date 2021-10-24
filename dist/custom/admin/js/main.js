const url = document.getElementsByTagName('base')[0].getAttribute('href');
const pathName = window.location.pathname.replace('doanhoai/', '');

let table = document.querySelector('#datatable');
let dataTable = table && new simpleDatatables.DataTable(table);

function showMessage(type, msg){
    (type === 'success') ? type = 'info' : '';
    const title_msg = {
        'success': 'Thành công',
        'warning': 'Cảnh báo',
        'info': 'Thông báo',
        'error': 'Lỗi',
    };

    $.toast({
        heading: title_msg[type],
        text: msg,
        position: 'top-right',
        loaderBg: '#ff6849',
        icon: type,
        hideAfter: 2000,
        stack: 6
    });
}


$(document).ready(function() {
	$('#custom-sidebar .sidebar-item').removeClass('active');

	$.each($('#custom-sidebar .sidebar-item'), function() {
		if ($(this).find('a.sidebar-link').first().attr('href').replace(url, '/').trim() == pathName.trim()) {
			$(this).addClass('active');
		}
	});

	$('#btn-doi-mat-khau').click(async function(event) {
		event.preventDefault();
		if ($('#change_password').val().trim() === '') {
			showMessage('warning', 'Không được bỏ trống mật khẩu');
			$('#change_password').focus();
			return false;
		}
		if ($('#re_change_password').val().trim() === '') {
			showMessage('warning', 'Không được bỏ trống xác nhận mật khẩu');
			$('#re_change_password').focus();
			return false;
		}
		if ($('#change_password').val().trim() !== $('#re_change_password').val().trim()) {
			showMessage('warning', 'Mật khẩu không khớp');
			return false;
		}

		$('#form-doi-mat-khau').submit();
	});
});