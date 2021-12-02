let pageSize = 6;
let currentAuctionItem = pageSize;
let waitingAuctionItem = pageSize;
$(document).ready(function() {

	$('#don-hang-tabs-header .nav-item').click(function(event) {
		$('#don-hang-tabs-header .nav-item .nav-link').removeClass('active');
		$(this).find('.nav-link').addClass('active');
		const tab = $(this).find('.nav-link').data('tab');

		$('#don-mua .tab-pane').removeClass('active show');
		$('#don-mua .tab-pane').addClass('hidden');
		$(`#don-mua .tab-pane#${tab}`).removeClass('hidden');
		$(`#don-mua .tab-pane#${tab}`).addClass('active show');
	});

	const getAuction = async (start, end, limit) => {
		return $.ajax({
			url: window.location.href,
			type: 'POST',
			dataType: 'JSON',
			data: {
				action: 'get-auctua',
				start,
				end,
				limit,
			},
		})
	}

	const getWaitingAuction = async (limit) => {
		return $.ajax({
			url: window.location.href,
			type: 'POST',
			dataType: 'JSON',
			data: {
				action: 'get-waiting-auctua',
				limit,
			},
		})
	}

	const renderCurrentAuction = async (limit, type = null) => {
		let current = new Date();
		let start = moment(current).format('YYYY-MM-DD HH:mm:ss');

		const listDauGia = await getAuction(start, start, limit);

		switch (type) {
			case 'reload':
				reRenderCurrentAuction(listDauGia, current);
				break;
			default:
				renderNewCurrentAuction(listDauGia, current);
				break;
		}
	}

	const renderWaitingAuction = async (limit, type = null) => {
		let current = new Date();

		const listDauGia = await getWaitingAuction(limit);

		switch (type) {
			case 'reload':
				reRenderWaitingAuction(listDauGia, current);
				break;
			default:
				renderNewWaitingAuction(listDauGia, current);
				break;
		}
	}

	const reRenderCurrentAuction = (listDauGia, current) => {
		listDauGia.listPhien.forEach( function(dg) {
			let timeend = new Date(dg.dThoigianketthuc);
			if (timeend.getTime() < current.getTime()) {
				$(`#phien-${dg.iMaphiendaugia}`).remove();
			} else {
				$(`#phien-${dg.iMaphiendaugia} .timer`).text(subTime(timeend, current));
				$(`#phien-${dg.iMaphiendaugia} .current-costs`).html(`<i class="fa fa-gavel"></i> ${numeral(dg.giaHientai || dg.iGiakhoidiem).format('0,0')} VNĐ`);
			}
		});
	};

	const reRenderWaitingAuction = (listDauGia, current) => {
		listDauGia.listPhien.forEach( function(dg) {
			let timeend = new Date(dg.dThoigianbatdau);
			if (timeend.getTime() < current.getTime()) {
				$(`#phien-${dg.iMaphiendaugia}`).remove();
			} else {
				$(`#phien-${dg.iMaphiendaugia} .timer`).text(`Chờ ${subTime(timeend, current)}`);
				$(`#phien-${dg.iMaphiendaugia} .current-costs`).html(`<i class="fa fa-gavel"></i> ${numeral(dg.giaHientai || dg.iGiakhoidiem).format('0,0')} VNĐ`);
			}
		});
	};

	const renderNewCurrentAuction = (listDauGia, current) => {
		const newCurrentHTML = listDauGia.listPhien.map((dg) => {
			let timeend = new Date(dg.dThoigianketthuc);
			const hinhAnh = listDauGia.hinhAnh[Number(dg.iMasanpham)];
			return `
			<div class="col-md-6 col-lg-4" id="phien-${dg.iMaphiendaugia}" data-phien="${dg.iMaphiendaugia}">
                <div class="box auction-box">
                    <div class="image-thumbnail">
                    	<img src="${url_file}${hinhAnh ? hinhAnh[0].sHinhanh : 'uploaded_files/red.png'}" alt="${dg.sTensanpham}" />
                    </div>
                    <div class="auction-info">
	                    <h4 class="title"><a href="${url}dau-gia-san-pham?phien=${dg.iMaphiendaugia}">${dg.sTensanpham}</a></h4>
	                    <div class="chi-tiet">
	                    	<b>Màu: </b>${dg.sTenmausac} - <b>Size: </b>${dg.sTensize}
	                    </div>
	                    <div class="trang-thai">
	                    	<span class="timer">${subTime(timeend, current)}</span>
	                    	<span class="current-costs"><i class="fa fa-gavel"></i> ${numeral(dg.giaHientai || dg.iGiakhoidiem).format('0,0')} VNĐ</span>
	                    </div>
                    </div>
                </div>
            </div>`;
		});
		if (listDauGia.tongPhien.tongPhien == 0) {
			$('#view-more-current').addClass('hidden');
			$('#current-auction .empty-don-mua').removeClass('hidden');
			return;
		}

		(listDauGia.tongPhien.tongPhien <= currentAuctionItem) ? $('#view-more-current').addClass('hidden') : $('#view-more-current').removeClass('hidden');
		$('#current-auction .list').html(newCurrentHTML);
	}

	const renderNewWaitingAuction = (listDauGia, current) => {
		const newCurrentHTML = listDauGia.listPhien.map((dg) => {
			let timeend = new Date(dg.dThoigianbatdau);
			const hinhAnh = listDauGia.hinhAnh[Number(dg.iMasanpham)];
			return `
			<div class="col-md-6 col-lg-4" id="phien-${dg.iMaphiendaugia}" data-phien="${dg.iMaphiendaugia}">
                <div class="box auction-box">
                    <div class="image-thumbnail">
                    	<img src="${url_file}${hinhAnh ? hinhAnh[0].sHinhanh : 'uploaded_files/red.png'}" alt="${dg.sTensanpham}" />
                    </div>
                    <div class="auction-info">
	                    <h4 class="title"><a href="${url}dau-gia-san-pham?phien=${dg.iMaphiendaugia}">${dg.sTensanpham}</a></h4>
	                    <div class="chi-tiet">
	                    	<b>Màu: </b>${dg.sTenmausac} - <b>Size: </b>${dg.sTensize}
	                    </div>
	                    <div class="trang-thai">
	                    	<span class="timer">Chờ ${subTime(timeend, current)}</span>
	                    	<span class="current-costs"><i class="fa fa-gavel"></i> ${numeral(dg.giaHientai || dg.iGiakhoidiem).format('0,0')} VNĐ</span>
	                    </div>
                    </div>
                </div>
            </div>`;
		});
		if (listDauGia.tongPhien.tongPhien == 0) {
			$('#view-more-waiting').addClass('hidden');
			$('#waiting-auction .empty-don-mua').removeClass('hidden');
			return;
		}
		(listDauGia.tongPhien.tongPhien <= waitingAuctionItem) ? $('#view-more-waiting').addClass('hidden') : $('#view-more-waiting').removeClass('hidden');
		$('#waiting-auction .list').html(newCurrentHTML);
	}

	const subTime = (timeFirst, timeSecond) => {
		let seconds = Math.floor((timeFirst.getTime() / 1000) - (timeSecond.getTime() / 1000));
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
		return `${days !== '00' ? `${days}d - ` : ''}${hours}:${minutes}:${seconds}`;
	}

	$('#view-more-current').click(function(event) {
		currentAuctionItem += pageSize;
		renderCurrentAuction(currentAuctionItem);
	});

	$('#view-more-waiting').click(function(event) {
		waitingAuctionItem += pageSize;
		renderWaitingAuction(waitingAuctionItem);
	});

	const useEffect = () => {
		renderCurrentAuction(currentAuctionItem);
		renderWaitingAuction(waitingAuctionItem);
	}

	var functionLop = () => {
		renderCurrentAuction(currentAuctionItem, 'reload');
		renderWaitingAuction(currentAuctionItem, 'reload');
	}

	setInterval(functionLop, 1000);

	useEffect();
});