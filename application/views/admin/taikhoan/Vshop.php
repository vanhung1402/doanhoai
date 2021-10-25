<style type="text/css">
    .logo-container {
        width: 15vw;
        height: 15vw;
        border: 1px solid #ccc;
        border-radius: 50%;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;   
    }
    .logo-container img {
        width: 100%;
    }
    .flex.center {
        display: flex;
        justify-content: center;
    }
    .flex.align-middle {
        display: flex;
        align-items: center;   
    }
    .mv-80 {
        min-width: 80px;
    }
    .shop-info {
        margin-top: 15px;
        text-align: justify;
    }
    .shop-info>div {
        margin: 5px 0;
    }
    .shop-info label {
        font-weight: bold;
    }
    .giay-phep {
        border: 1px solid #ccc;
        padding: 1px;
    }
    .giay-phep img {
        width: 100%;
    }
</style>
<section class="section">
    <div class="card">
        <div class="card-header">
        	<h5 class="text-center">Thông tin shop của tài khoản {$shop.sTennguoidung}</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <div class="flex center">
                        <div class="logo-container">
                            {if ($shop.sMotahinhanh)}
                            <img src="{$url}files/shop/logo/{$shop.sMotahinhanh}" alt="Logo {$shop.sTenshop}">
                            {else}
                            <img src="{$url}dist/templates/public/img/no-image.png" alt="No image">
                            {/if}
                        </div>
                    </div>
                    <div class="shop-info">
                        <div><label class="mv-80">Tên shop:</label>&emsp;{$shop.sTenshop}</div>
                        <div><label class="mv-80">Trạng thái:</label>&emsp;<span class="badge bg-{$tttk[$shop.iTrangthai].color}">{$tttk[$shop.iTrangthai].title}</span></div>
                        <div><label class="mv-80">Mô tả:</label>&emsp;{$shop.sMotashop}</div>
                    </div>               
                </div>
                <div class="col-sm-8">
                    <p class="flex align-middle"><i data-feather="file-text" width="20"></i>Giấy phép</p>
                    <div class="giay-phep">
                        {if ($shop.sGiayphepkinhdoanh)}
                        <img src="{$url}files/shop/giayphep/{$shop.sGiayphepkinhdoanh}" alt="Giấy phép {$shop.sTenshop}">
                        {else}
                        <img src="{$url}dist/templates/public/img/no-image.png" alt="No image">
                        {/if}
                    </div>
                </div>
                {if ($shop.iTrangthai == 3)}
                <form method="post">
                    <div class="col-sm-12 text-center mt-5">
                        <button type="submit" name="action" value="duyet" class="btn btn-success" onclick="return confirm('Xác nhận duyệt hồ sơ này?');"><i data-feather="check"></i>&emsp; Duyệt</button>
                    </div>
                </form>
                {/if}
            </div>
        </div>
    </div>
</section>