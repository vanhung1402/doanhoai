const url = document.getElementsByTagName('base')[0].getAttribute('href');
const url_files = 'http://localhost/upload-file-service/uploaded_files/';
const url_file = 'http://localhost/upload-file-service/';
var currentUrl = window.location.href
var urlObj = new URL(currentUrl);

const maxPostFileSize = 2048000;

let getCart;

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
        hideAfter: 3000,
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

    $.each($('.format-number'), function() {
        const thisValue = $(this).text();
        $(this).text(numeral(thisValue).format('0,0'));
    });

    $(document).on('keyup', '.input-format-number', function(event) {
        event.preventDefault();
        const thisValue = $(this).val();
        $(this).val(numeral(thisValue).format('0,0'));
    });

    getCart = () => {
        $.ajax({
            url,
            type: 'POST',
            dataType: 'JSON',
            data: {
                action: 'get-cart'
            },
        })
        .done(function(res) {
            $('#total-uncheck').text(Object.keys(res).length);
        })
        .fail(function(err) {
            console.log("Error: ", err);
        });
    }

    getCart();

    $('#current_url').val(encodeURI(window.location.href));
    $('#logout').attr('href', `${url}logout?back=${window.location.href}`);
});
