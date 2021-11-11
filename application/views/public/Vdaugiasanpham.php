<link href="{$url}dist/custom/public/css/daugia.css" rel="stylesheet">

<div class="container pt-3">
	<div class="product-info row">
		<div class="col-sm-4">
			<div id="carousel-images" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<li data-target="#carousel-images" data-slide-to="0" class="active"></li>
					<li data-target="#carousel-images" data-slide-to="1"></li>
					<li data-target="#carousel-images" data-slide-to="2"></li>
				</ol>
				<div class="carousel-inner">
					<div class="carousel-item active">
						<img class="d-block w-100" src="{$url}files/red.png" alt="First slide">
					</div>
					<div class="carousel-item">
						<img class="d-block w-100" src="{$url}files/red.png" alt="Second slide">
					</div>
					<div class="carousel-item">
						<img class="d-block w-100" src="{$url}files/red.png" alt="Third slide">
					</div>
				</div>
				<a class="carousel-control-prev" href="#carousel-images" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carousel-images" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>
		<div class="col-sm-8">
			<div class="san-pham-info">
				<h1 class="ten-san-pham">{$sanpham.sTensanpham}</h1>
				<p><b>Kích thước:</b> {$sanpham.sTensize}<b> &emsp; Màu sắc:</b> {$sanpham.sTenmausac}</p>

				<div class="times">
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
					<button id="btn-giam-gia" class="btn-doi-gia" value="-{$phien.iBuocgia}">
						<i class="fa fa-minus"></i>
					</button>
					<span id="current-price" class="format-number">{$phien.iGiakhoidiem}</span>
					<button id="btn-tang-gia" class="btn-doi-gia" value="{$phien.iBuocgia}">
						<i class="fa fa-plus"></i>
					</button>
					<button id="btn-place-bid">
						<i class="fa fa-gavel"></i>&emsp;Place Bid
					</button>
				</div>
				{else}
				<div id="owner" class="alert alert-warning text-center">
					Bạn không thể tham gia phiên đấu giá của chính bạn
				</div>
				{/if}
				<div id="finished" class="hidden alert alert-warning text-center">
					Phiên đấu giá đã kết thúc!
				</div>
			</div>
		</div>
	</div>
</div>

<script src="{$url}dist/custom/public/js/daugia.js"></script>
<script type="text/javascript">
	let timer = new Date('{$phien.dThoigianketthuc}').getTime();
	let current  = new Date().getTime();
</script>
