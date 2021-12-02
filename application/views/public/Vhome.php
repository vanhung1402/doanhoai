<link href="{$url}dist/custom/public/css/home.css" rel="stylesheet">
<section id="intro" class="clearfix">
    <div class="container d-flex h-100">
        <div class="row justify-content-center align-self-center">
            <div class="col-md-6 intro-info order-md-first order-last">
                <h2>Website đấu giá<br>trực tuyến <span>Chilin!</span></h2>
                <form action="{$url}" method="get">
                    <div class="form-search">
                        <input type="text" name="keyword" value="{$keyword}" required placeholder="Nhập tên sản phẩm để tìm kiếm...">
                        <button class="btn-search" type="submit" action="search" value="search">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            <div class="col-md-6 intro-img order-md-last order-first">
                <img src="dist/templates/public/img/intro-img.svg" alt="" class="img-fluid">
            </div>
        </div>

    </div>
</section>
{if $keyword}
<br><br>
<section>
    <div class="container" id="search-keyword">
        Kết quả tìm kiếm phiên đấu giá với từ khóa: <b><i>{$keyword}</i></b>
    </div>
</section>
{/if}

<section id="services" class="section-bg">
    <div class="container" id="don-mua">
        <ul class="nav nav-tabs" id="don-hang-tabs-header" role="tablist">
            {foreach $trangThai as $k => $tt}
            <li class="nav-item">
                <a class="nav-link {if $k == 0}active{/if}" id="tab-{$k}" data-toggle="tab" data-tab="tab-{$k}-content" href="{$url}?keyword={$keyword}#tab-{$k}-content" role="tab" aria-controls="tab-{$k}" aria-selected="false">{$tt}</a>
            </li>
            {/foreach}
        </ul>

        <div class="tab-pane fade current show active" id="tab-0-content" role="tabpanel" aria-labelledby="tab-0-content">
            <div id="current-auction-warraper" class="wow bounceInUp" data-wow-delay="0.2s" data-wow-duration="1.4s">
                <div class="list services">
                    <div id="current-auction" class="wow bounceInUp" data-wow-delay="0.2s" data-wow-duration="1.4s">
                        <div class="list row">
                            
                        </div>
                        <div class="view-more" id="view-more-current">
                            <span>Xem thêm..</span>    
                        </div>
                        <div class="empty-don-mua don-hang mb-4 mt-4 hidden">
                            <div><i class="fa fa-folder-o"></i></div>
                            Danh sách phiên đấu giá trống
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade hidden" id="tab-1-content" role="tabpanel" aria-labelledby="tab-1-content">
            <div id="waiting-auction-wrapper" class="wow bounceInUp" data-wow-delay="0.2s" data-wow-duration="1.4s">
                <div class="list ervices">
                    <div id="waiting-auction" class="wow bounceInUp" data-wow-delay="0.2s" data-wow-duration="1.4s">
                        <div class="list row">
                            
                        </div>
                        <div class="view-more text-center" id="view-more-waiting">
                            <span>Xem thêm..</span>    
                        </div>

                        <div class="empty-don-mua don-hang mb-4 mt-4 hidden">
                            <div><i class="fa fa-folder-o"></i></div>
                            Danh sách phiên đấu giá trống
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section><!-- #services -->

<script src="dist/custom/public/libs/moment.js/moment.min.js"></script>
<script src="{$url}dist/custom/public/js/home.js"></script>

