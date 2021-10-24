const url = document.getElementsByTagName('base')[0].getAttribute('href');
var currentUrl = window.location.href
var urlObj = new URL(currentUrl);

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
	$('.datepicker').datepicker({
	    format: 'dd/mm/yyyy',
	    weekStart: '1',
	    autoclose: true,
	    todayHighlight: true,
	});
});