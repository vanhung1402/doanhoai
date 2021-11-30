<link rel="stylesheet" href="{$url}dist/templates/admin/assets/vendors/simple-datatables/style.css">
<div class="row">
    {if $user.iMaquyen != 10}
    <div class="col-sm-4">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">{if isset($sua)}Cập nhập kích thước{else}Thêm kích thước{/if}</h5>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <label for="ten-kich-thuoc">Tên kích thước <span class="text-danger">*</span></label>
                            <input type="text" name="ten-kich-thuoc" id="ten-kich-thuoc" class="form-control" required {if isset($sua)}value="{$sua.sTensize}"{/if}>
                        </div>
                        <div class="form-group text-center">
                            {if isset($sua)}
                            <input class="hidden" type="text" name="action" value="cap-nhap-kich-thuoc">
                            <button type="submit" class="btn btn-info"><i data-feather="save"></i>&emsp;Cập nhập</button>
                            {else}
                            <input class="hidden" type="text" name="action" value="them-kich-thuoc">
                            <button type="submit" class="btn btn-success"><i data-feather="plus"></i>&emsp;Thêm</button>
                            {/if}
                        </div>
                    </form>
                </div>
            </div>
        </section>  
    </div>
    {/if}
    <div class="col-sm-{if $user.iMaquyen != 10}8{else}12{/if}">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">Danh mục kích thước</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên kích thước</th>
                                {if $user.iMaquyen != 10}
                                <th>Tác vụ</th>
                                {/if}
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $danhSachKichThuoc as $key => $kichThuoc}
                            <tr>
                                <td class="text-center">{$key + 1}</td>
                                <td>{$kichThuoc.sTensize}</td>
                                {if $user.iMaquyen != 10}
                                <td class="text-center">
                                    <form method="post">
                                        <a class="btn btn-outline-primary btn-sm btn-xs" href="{$url}admin/kich-thuoc?id={$kichThuoc.iMasize}" title="Sửa kích thước">
                                            <i data-feather="edit"></i>
                                        </a>
                                        <input class="hidden" type="text" name="action" value="xoa-kich-thuoc">
                                        <button class="btn btn-outline-danger btn-sm btn-xs" name="id-xoa" value="{$kichThuoc.iMasize}" onclick="return confirm('Xác nhận thực hiện thao tác')" title="Xóa kích thước">
                                            <i data-feather="trash"></i>
                                        </button>
                                    </form>
                                </td>
                                {/if}
                            </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </div>
            </div>
        </section>  
    </div>
</div>
<script src="{$url}dist/templates/admin/assets/vendors/simple-datatables/simple-datatables.js"></script>