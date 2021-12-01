<link href="{$url}dist/custom/public/css/chuhangphien.css" rel="stylesheet">

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active"><a href="{$url}">Home</a></li>
		<li class="breadcrumb-item" aria-current="page">Danh sách phiên đấu giá</li>
	</ol>
</nav>

<div id="don-mua" class="container pt-3 pb-3">
	<ul class="nav nav-tabs" id="don-hang-tabs-header" role="tablist">
		{foreach $trangThai as $k => $tt}
		<li class="nav-item">
			<a class="nav-link {if $k == 0}active{/if}" id="tab-{$k}" data-toggle="tab" data-tab="tab-{$k}-content" href="{$url}chu-hang/phien-dau-gia#tab-{$k}-content" role="tab" aria-controls="tab-{$k}" aria-selected="false">{$tt}</a>
		</li>
		{/foreach}
	</ul>
	<br>
	<div class="tab-content" id="don-hang-tabs">
		<div class="tab-pane fade show active current" id="tab-0-content" role="tabpanel" aria-labelledby="tab-0-content">
			<div id="current-auction" class="wow bounceInUp" data-wow-delay="0.2s" data-wow-duration="1.4s">
	            <div class="list row services">
	                
	            </div>
	            <div class="view-more" id="view-more-current">
	                <span>Xem thêm..</span>    
	            </div>
	        </div>
		</div>

		<div class="tab-pane fade current" id="tab-1-content" role="tabpanel" aria-labelledby="tab-1-content">
			<div id="commingsoon-auction" class="wow bounceInUp" data-wow-delay="0.2s" data-wow-duration="1.4s">
	            <div class="list row services">
	                {foreach $sapDienRa.listPhien as $dg}
	                <div class="col-md-6 col-lg-4" id="phien-{$dg.iMaphiendaugia}" data-phien="{$dg.iMaphiendaugia}">
		                <div class="box auction-box">
		                    <div class="image-thumbnail">
		                    	{if $sapDienRa.hinhAnh[$dg.iMasanpham]}
		                    	<img src="{$url_file}{$sapDienRa.hinhAnh[$dg.iMasanpham].0.sHinhanh}" alt="{$dg.sTensanpham}" />
		                    	{else}
		                    	<img src="{$url_file}uploaded_files/red.png" alt="{$dg.sTensanpham}">
		                    	{/if}
		                    </div>
		                    <div class="auction-info">
			                    <h4 class="title"><a href="{$url}dau-gia-san-pham?phien={$dg.iMaphiendaugia}">{$dg.sTensanpham}</a></h4>
			                    <div class="chi-tiet">
			                    	<b>Màu: </b>{$dg.sTenmausac} - <b>Size: </b>{$dg.sTensize}
			                    </div>
			                    <div class="trang-thai">
			                    	<span class="timer">{$dg.tThoigian}</span>
			                    	<span class="current-costs"><i class="fa fa-gavel"></i> <span class="format-number">{$dg.iGiakhoidiem}</span> VNĐ</span>
			                    </div>
		                    </div>
		                </div>
		            </div>
	                {/foreach}
	            </div>
	        </div>
		</div>

		<div class="tab-pane fade current" id="tab-2-content" role="tabpanel" aria-labelledby="tab-2-content">
			<div id="finished-auction" class="wow bounceInUp" data-wow-delay="0.2s" data-wow-duration="1.4s">
	            <div class="list row services">
	                {foreach $daDienRa.listPhien as $dg}
	                <div class="col-md-6 col-lg-4" id="phien-{$dg.iMaphiendaugia}" data-phien="{$dg.iMaphiendaugia}">
		                <div class="box auction-box">
		                    <div class="image-thumbnail">
		                    	{if $daDienRa.hinhAnh[$dg.iMasanpham]}
		                    	<img src="{$url_file}{$daDienRa.hinhAnh[$dg.iMasanpham].0.sHinhanh}" alt="{$dg.sTensanpham}" />
		                    	{else}
		                    	<img src="{$url_file}uploaded_files/red.png" alt="{$dg.sTensanpham}">
		                    	{/if}
		                    </div>
		                    <div class="auction-info">
			                    <h4 class="title"><a href="{$url}dau-gia-san-pham?phien={$dg.iMaphiendaugia}">{$dg.sTensanpham}</a></h4>
			                    <div class="chi-tiet">
			                    	<b>Màu: </b>{$dg.sTenmausac} - <b>Size: </b>{$dg.sTensize}
			                    </div>
			                    <div class="trang-thai">
			                    	<span class="timer">{$dg.tThoigian}</span>
			                    	<span class="current-costs"><i class="fa fa-gavel"></i> <span class="format-number">{$dg.iGiakhoidiem}</span> VNĐ</span>
			                    </div>
		                    </div>
		                </div>
		            </div>
	                {/foreach}
	            </div>
	        </div>
		</div>
	</div>
</div>

<script src="dist/custom/public/libs/moment.js/moment.min.js"></script>
<script src="{$url}dist/custom/public/js/chuhangphien.js"></script>
