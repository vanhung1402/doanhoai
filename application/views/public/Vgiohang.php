<link href="{$url}dist/custom/public/css/giohang.css" rel="stylesheet">

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active"><a href="{$url}">Home</a></li>
		<li class="breadcrumb-item" aria-current="page">Giỏ hàng</li>
	</ol>
</nav>
<div class="container pt-3 pb-3">
	<div class="row">
	 	<div class="col-sm-8">
	 		<div class="cart-items">
	 			{if empty($gio_hang)}
	 			<div class="alert alert-warning text-center" id="thanh-toan-warning">
	 				<b>Không có sản phầm nào trong giỏ hàng</b>
	 			</div>
	 			{else}
	 			{foreach $gio_hang_map as $shop_id => $shop}
	 			<div class="shop-container">
	 				<div class="header-shop">
	 					<h4><input type="checkbox" class="check-shop" value="{$shop_id}" id="shop-{$shop_id}" checked><label for="shop-{$shop_id}">{$shop.0.sTenshop}</label></h4>
	 				</div>
	 				<div class="shop-items">
	 					{foreach $shop as $item}
			 			<div class="item-container">
			 				<div class="row">
			 					<div class="col-sm-3">
			 						<div class="item-thumb">
			 							<img src="{$url}files/red.png" alt="ten_san_pham">
			 						</div>
			 					</div>

			 					<div class="col-sm-9">
			 						<div class="item-detail">
			 							<h5>{$item.sTensanpham}</h5>
			 							<p><b>Màu: </b>{$item.sTenmausac} - <b>Size: </b>{$item.sTensize}</p>
			 							<p><b>Số lượng: </b>1</p>
			 							<p class="text-right pr-2 font-weight-bold"><span class="format-number">{$item.iMucgiadau}</span> VNĐ</p>
			 						</div>
			 					</div>
			 				</div>
			 				<input type="checkbox" class="check-items" value="{$item.iMaphiendaugia}" data-gia="{$item.iMucgiadau}" checked>
			 			</div>
			 			{/foreach}
	 				</div>
	 			</div>
	 			{/foreach}
	 			{/if}
	 		</div>
	 	</div>
	 	<div class="col-sm-4" id="thanh-toan-container">
	 		<div class="total">
	 			<h3 class="text-center font-weight-bold">THANH TOÁN</h3>
	 			<p>
	 				<span>Thành tiền</span>
	 				<span class="float-right font-weight-bold">
	 					<span class="format-number" id="thanh-tien">{array_sum(array_column($gio_hang, 'iMucgiadau'))}</span> VNĐ
	 				</span>
	 			</p>
	 			<p>
	 				<span>Phí ship</span>
	 				<span class="float-right font-weight-bold">
	 					<span class="format-number">49000</span> VNĐ
	 				</span>
	 			</p>
	 			<h3 class="text-center">TỔNG TIỀN</h3>
	 			<h4 class="text-center font-weight-bold">
	 				<span class="format-number" id="tong-tien">{array_sum(array_column($gio_hang, 'iMucgiadau')) + 49000}</span> VNĐ
	 			</h4>
		 		<div class="action text-center">
		 			<button class="btn-checkout" id="thanh-toan">
		 				Đặt hàng ngay
		 			</button>
		 		</div>
	 		</div>
	 	</div>
	</div>
</div>

<script src="{$url}dist/custom/public/js/giohang.js"></script>
<script type="text/javascript">
	let total = Number({array_sum(array_column($gio_hang, 'iMucgiadau'))});
</script>