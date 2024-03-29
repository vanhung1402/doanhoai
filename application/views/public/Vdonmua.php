<link href="{$url}dist/custom/public/css/donmua.css" rel="stylesheet">

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active"><a href="{$url}">Home</a></li>
		<li class="breadcrumb-item" aria-current="page">Đơn mua</li>
	</ol>
</nav>

<div id="don-mua" class="container pt-3 pb-3">
	<ul class="nav nav-tabs" id="don-hang-tabs-header" role="tablist">
		{foreach $trangThaiDonHang as $k => $tt}
		<li class="nav-item">
			<a class="nav-link {if $k == 0}active{/if}" id="tab-{$k}" data-toggle="tab" data-tab="tab-{$k}-content" href="{$url}don-mua#tab-{$k}-content" role="tab" aria-controls="tab-{$k}" aria-selected="false">{$tt}</a>
		</li>
		{/foreach}
	</ul>
	<div class="tab-content" id="don-hang-tabs">
		{foreach $trangThaiDonHang as $k => $tt}
		<div class="tab-pane fade {if $k == 0}show active{/if} " id="tab-{$k}-content" role="tabpanel" aria-labelledby="tab-{$k}-content">
		{foreach $donHang as $dh}
		{if $k==0 || $k == $dh.0.iTrangthai}
			<div class="don-hang mb-4 mt-4">
				<div class="don-hang-header">
					<span>Ngày đặt: {$dh.0.tThoigianlap}</span>
					<span class="text-main">{$trangThaiDonHang[$dh.0.iTrangthai]}</span>
				</div>
				<div class="don-hang-body">
					{foreach $dh as $don}
		 			<div class="item-container">
		 				<div class="row">
		 					<div class="col-md-3">
		 						<div class="item-thumb">
		 							{if empty($don.hinhAnh)}
		 							<img src="{$url}files/red.png" alt="{$don.sTensanpham}">
		 							{else}
		 							<img src="{$url_file}{$don.hinhAnh.0.sHinhanh}" alt="{$don.sTensanpham}">
		 							{/if}
		 						</div>
		 					</div>

		 					<div class="col-md-9">
		 						<div class="item-detail">
		 							<h5>{$don.sTensanpham}</h5>
		 							<p><b>Màu: </b>{$don.sTenmausac} - <b>Size: </b>{$don.sTensize}</p>
		 							<p><b>Shop: </b>{$don.sTenshop}</p>
		 							<p class="price text-right pr-2 font-weight-bold">1 <i class="fa fa-times"></i> <span class="format-number">{$don.iMucgiadau}</span> VNĐ</p>
		 						</div>
		 					</div>
		 				</div>
		 			</div>
		 			{/foreach}
				</div>
				<div class="don-hang-footer">
					{if $dh.0.iTrangthai < 4}
					<button class="huy-don-hang btn btn-md btn-secondary" value="{$don.iMadonmua}">
						<i class="fa fa-times"></i> Hủy đơn hàng
					</button>
					{else if $dh.0.iTrangthai == 4}
					<button class="chuyen-trang-thai btn btn-md btn-success" data-trang-thai="6" value="{$don.iMadonmua}">
						<i class="fa fa-check-circle-o"></i> Xác nhận đã nhận hàng
					</button>
					{else if $dh.0.sNguoimuahuy || $dh.0.sNguoibanhuy}
					<div>
						{if $dh.0.sNguoimuahuy}
						<b>Người mua hủy: </b>{$dh.0.sNguoimuahuy}
						{else}
						<b>Người bán hủy: </b>{$dh.0.sNguoibanhuy}
						{/if}	
					</div>
					{else}
					<div>&nbsp;</div>
					{/if}
					<div>
						Tổng số tiền: <b class="text-main"><span class="format-number">{array_sum(array_column($dh, 'iMucgiadau'))}</span> VNĐ</b>
					</div>
				</div>
			</div>
		{/if}
		{/foreach}
		</div>
		{/foreach}
	</div>
</div>

<script src="{$url}dist/custom/public/js/donmua.js"></script>
