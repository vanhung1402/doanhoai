$(document).ready(function() {
	$('.btn-doi-gia').click(function(event) {
		const buocGia = Number($(this).val());
		const currentPrice = Number($('#current-price').text().trim().replaceAll(',', ''));
		const winPrice = Number($('#price-win').text().trim().replaceAll(',', ''));
		const giaDau = numeral(buocGia + currentPrice).format('0,0');
		if (buocGia + currentPrice > winPrice) {
			$('#current-price').text(giaDau);
		}
	});

	const submitBid = (price) => {
		$.ajax({
			url: window.location.href,
			type: 'POST',
			dataType: 'JSON',
			data: {
				action: 'submit-bid',
				price
			},
		})
		.done(function(res) {
			if (res === 'no_login') {
				$('#open-login').click();
			}
		})
		.fail(function(err) {
			console.log("Error: ", err);
		});
		
	}

	$('#btn-place-bid').click(function(event) {
		const currentPrice = Number($('#current-price').text().trim().replaceAll(',', ''));
		submitBid(currentPrice);
	});

	const setBidWin = (result) => {
		$('#price-win').text(numeral(result.iMucgiadau).format('0,0'));
		$('#bider-win').text(result.sTennguoidung);
		const buocGia = Number($('#btn-tang-gia').val());
		const currentPrice = Number($('#current-price').text().trim().replaceAll(',', ''));
		if (currentPrice < Number(result.iMucgiadau) + buocGia) {
			$('#current-price').text(numeral(Number(result.iMucgiadau) + buocGia).format('0,0'));
		}
	}

	const getCurrentBidResult = () => {
		$.ajax({
			url: window.location.href,
			type: 'POST',
			dataType: 'JSON',
			data: {
				action: 'get-current-bid'
			},
		})
		.done(function(res) {
			if (res) setBidWin(res);
		})
		.fail(function(err) {
			console.log("Error: ", err);
		});
	}

	const finishBid = () => {
		$('#finished').removeClass('hidden');
		$('#bid-action').remove();
	}

	const setTimer = () => {
		const subTimer = timer - current;
		const toDateTime = new Date(subTimer);

		let sds = Math.floor(subTimer / 1000);
		let days = sds > 86400 ? Math.floor(sds / 86400) : 0;

		let hours = toDateTime.getHours();
		let minutes = toDateTime.getMinutes();
		let seconds = toDateTime.getSeconds();
		hours = hours < 10 ? `0${hours}` : hours;
		minutes = minutes < 10 ? `0${minutes}` : minutes;
		seconds = seconds < 10 ? `0${seconds}` : seconds;
		$('#hours').text(hours);
		$('#minutes').text(minutes);
		$('#seconds').text(seconds);
	}

	const startCount = () => {
		if (current >= timer) {
			clearTimeout(timeout);
			finishBid();
			return false;
		}

		getCurrentBidResult();
		setTimer();

		timeout = setTimeout(function(){
			current += 1000;
	        startCount();
	    }, 1000);
	}

	if (current >= timer) {
		getCurrentBidResult();
		finishBid();
	} else {
		startCount();		
	}
});