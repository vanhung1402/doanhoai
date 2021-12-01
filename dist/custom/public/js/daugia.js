$(document).ready(function() {
	let activeIndex = 0;
	let maxIndex = $('.carousel-item').length - 1;

	const setActiveItem = (index) => {
		$('.carousel-indicators li').removeClass('active');
		$(`.carousel-indicators li:eq(${index})`).addClass('active');
		$('.carousel-inner .carousel-item').removeClass('active');
		$(`.carousel-inner .carousel-item:eq(${index})`).addClass('active');
		activeIndex = index;
	}

	$('.carousel-control-prev').click(function (e) {
		e.preventDefault();
		activeIndex = (activeIndex == 0) ? maxIndex : (activeIndex - 1);
		setActiveItem(activeIndex);
	});
	$('.carousel-control-next').click(function (e) {
		e.preventDefault();
		activeIndex = (activeIndex == maxIndex) ? 0 : (activeIndex + 1);
		setActiveItem(activeIndex);
	});
	$('.index-carousel').click(function (e) {
		e.preventDefault();
		let index = $(this).data('slide-to');
		setActiveItem(index);
	});
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

	const addHistory = (result) => {
		const currentWin = $('#lich-su tr').first().data('id');
		if (currentWin != `${result.iMataikhoan}-${result.iMucgiadau}`) {
			let newHtml = `
			<tr data-id="${result.iMataikhoan}-${result.iMucgiadau}">
				<td>${result.tThoigian}</td>
				<td>${result.sTennguoidung}</td>
				<td><span class="format-number">${numeral(result.iMucgiadau).format('0,0')}</span> VNĐ</td>
			</tr>
			`;
			$('#lich-su').prepend($(newHtml));
		}
	}

	const setBidWin = (result) => {
		$('#price-win').text(numeral(result.iMucgiadau).format('0,0'));
		$('#bider-win').text(result.sTennguoidung);
		const buocGia = Number($('#btn-tang-gia').val());
		const currentPrice = Number($('#current-price').text().trim().replaceAll(',', ''));
		if (currentPrice < Number(result.iMucgiadau) + buocGia) {
			$('#current-price').text(numeral(Number(result.iMucgiadau) + buocGia).format('0,0'));
		}
		addHistory(result);
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

	const waitingBid = () => {
		$('#waiting').removeClass('hidden');
		$('#bid-action').remove();	
	}

	const setTimer = () => {
		let seconds = Math.floor((timer / 1000) - (current / 1000));
		let days = seconds > 86400 ? Math.floor(seconds / 86400) : 0;
		days = days < 10 ? `0${days}` : days;
		seconds %= 86400;
		let hours = seconds > 3600 ? Math.floor(seconds / 3600) : 0;
		hours = hours < 10 ? `0${hours}` : hours;
		seconds %= 3600;
		let minutes = seconds > 60 ? Math.floor(seconds / 60) : 0;
		minutes = minutes < 10 ? `0${minutes}` : minutes;
		seconds %= 60;
		seconds = seconds < 10 ? `0${seconds}` : seconds;

		days = Number(days);
		$('#hours').text(hours + (days > 0 ? days * 24 : ''));
		$('#minutes').text(minutes);
		$('#seconds').text(seconds);
	}

	const startCount = () => {
		if (current >= timer) {
			if (tt == 2) window.location.reload(); 
			clearTimeout(timeout);
			finishBid();
			return false;
		}

		if (tt == 2) {
			waitingBid();
			setTimer();
		} else {
			getCurrentBidResult();
			setTimer();
		}

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