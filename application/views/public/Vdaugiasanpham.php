<link href="{$url}dist/custom/public/css/daugia.css" rel="stylesheet">

<br>
<div class="container pt-3 pb-3">
	<div class="product-info row">
		<div class="col-sm-4">
			<div id="carousel-images" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					{foreach $sanpham.hinhAnh as $index => $anh}
					<li data-target="#carousel-images" data-slide-to="{$index}" class="index-carousel {if $index == 0}active{/if}"></li>
					{/foreach}
					{if $sanpham.sVideo}
					<li data-target="#carousel-images" data-slide-to="{sizeof($sanpham.hinhAnh)}" class="index-carousel"></li>
					{/if}
				</ol>
				<div class="carousel-inner">
					{foreach $sanpham.hinhAnh as $index => $anh}
					<div class="carousel-item {if $index == 0}active{/if}">
						<img class="d-block w-100" src="{$url_file}{$anh.sHinhanh}" alt="First slide">
					</div>
					{/foreach}

					{if $sanpham.sVideo}
					<div class="carousel-item">
						<div class="video-carousel">
							<video controls>
								<source src="http://localhost/upload-file-service/{$sanpham.sVideo}" type="video/mp4">
									Your browser does not support HTML video.
							</video>
						</div>
					</div>
					{/if}
				</div>
			</div>
		</div>
		<div class="col-sm-8">
			<div class="san-pham-info">
				<h1 class="ten-san-pham">{$sanpham.sTensanpham}</h1>
				<p><b>Kích thước:</b> {$sanpham.sTensize}<b> &emsp; Màu sắc:</b> {$sanpham.sTenmausac}</p>

				<div class="times">
					<span class="waiting">Chờ</span>
					<span class="waiting">-</span>
					<span id="hours">00</span>
					<span>:</span>
					<span id="minutes">00</span>
					<span>:</span>
					<span id="seconds">00</span>
				</div>
				<div class="dau-gia row">
					<div class="col-sm-4">
						<p>Giá hiện tại</p>
						<p><i class="fa fa-money"></i> <span id="price-win" class="format-number">{$phien.iGiakhoidiem}</span></p>
					</div>
					<div class="col-sm-8">
						<p>Người thắng hiện tại</p>
						<p><i class="fa fa-bolt"></i> <span id="bider-win">Chưa có người đấu giá</span></p>
					</div>
				</div>
				{if $sanpham.iNguoithem !== $user.iManguoidung}
				<div class="action flex align-middle" id="bid-action">
					<button id="btn-giam-gia" type="button" class="btn-doi-gia" value="-{$phien.iBuocgia}">
						<i class="fa fa-minus"></i>
					</button>
					<span id="current-price" type="button" class="format-number">{$phien.iGiakhoidiem}</span>
					<button id="btn-tang-gia" class="btn-doi-gia" value="{$phien.iBuocgia}">
						<i class="fa fa-plus"></i>
					</button>
					<button id="btn-place-bid" type="button">
						<i class="fa fa-gavel"></i>&emsp;Place Bid
					</button>
				</div>
				{else}
				<div id="owner" class="alert alert-warning text-center">
					Bạn không thể tham gia phiên đấu giá của chính bạn
				</div>
				{/if}
				<div id="waiting" class="hidden alert alert-warning text-center">
					Phiên đấu giá đã chưa bắt đầu!
				</div>
				<div id="finished" class="hidden alert alert-warning text-center">
					Phiên đấu giá đã kết thúc!
				</div>
			</div>
		</div>
	</div>
	<br><br>
	<div class="product-detail">
		<div class="row">
			<div class="col-sm-3"><b>Cửa hàng: </b><a href="{$url}shop/dau-gia?id={$sanpham.iNguoithem}">{$sanpham.sTenshop}</a></div>
			<div class="col-sm-3"><b>Thương hiệu: </b>{$sanpham.sThuonghieu}</div>
			<div class="col-sm-3"><b>Chất liệu: </b>{$sanpham.sChatlieu}</div>
			<div class="col-sm-3"><b>Tình trạng: </b>{$sanpham.sTinhtrang}</div>
		</div>
		<br>
		<p><b>Mô tả: </b>{$sanpham.sMota}</p>
	</div>
</div>

<br>

<div class="container pt-3 pb-3">
	<h4 class="text-center">Lịch sử đấu giá</h4>
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>Thời gian đấu giá</th>
				<th>Người đấu giá</th>
				<th>Mức giá</th>
			</tr>
		</thead>
		<tbody id="lich-su">
			{foreach $lichSu as $key => $ls}
			<tr data-id="{$ls.iMataikhoan}-{$ls.iMucgiadau}">
				<td>{$ls.tThoigian}</td>
				<td>{$ls.sTennguoidung}</td>
				<td><span class="format-number">{$ls.iMucgiadau}</span> VNĐ</td>
			</tr>
			{/foreach}
		</tbody>
	</table>
</div>

<script src="{$url}dist/custom/public/js/daugia.js"></script>
<script type="text/javascript">
	let timer = new Date('{$phien.dThoigianketthuc}').getTime();
	let timeStart = new Date('{$phien.dThoigianbatdau}').getTime();
	let current  = new Date().getTime();
	let tt = 1;
	if (current < timeStart) {
		timer = timeStart;
		tt = 2;
	}
</script>
