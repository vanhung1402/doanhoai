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
			<div class="don-hang mb-4 mt-4">
				<div class="don-hang-header">
					<span>Ngày đặt: 11/11/2021</span>
					<span class="text-main">Chờ xác nhận</span>
				</div>
				<div class="don-hang-body">
		 			<div class="item-container mb-3">
		 				<div class="row">
		 					<div class="col-md-3">
		 						<div class="item-thumb">
		 							<img src="{$url}files/red.png" alt="ten_san_pham">
		 						</div>
		 					</div>

		 					<div class="col-md-9">
		 						<div class="item-detail">
		 							<h5>Tên sản phẩm</h5>
		 							<p><b>Màu: </b>Đen - <b>Size: </b>M</p>
		 							<p><b>Số lượng: </b>1</p>
		 							<p class="price text-right pr-2 font-weight-bold"><span class="format-number">{$item.iMucgiadau}</span> VNĐ</p>
		 						</div>
		 					</div>
		 				</div>
		 			</div>
				</div>
				<div class="don-hang-footer">
					<button class="huy-don-hang btn btn-md btn-secondary" value="">
						<i class="fa fa-times"></i> Hủy đơn hàng
					</button>
					<div>
						Tổng số tiền: <b class="text-main"><span class="format-number">1000000</span> VNĐ</b>
					</div>
				</div>
			</div>
		</div>
		{/foreach}
	</div>
</div>

<script src="{$url}dist/custom/public/js/donmua.js"></script>
