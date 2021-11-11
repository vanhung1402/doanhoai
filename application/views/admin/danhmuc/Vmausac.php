<link rel="stylesheet" href="{$url}dist/templates/admin/assets/vendors/simple-datatables/style.css">
<div class="row">
    <div class="col-sm-4">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">{if isset($sua)}Cập nhập màu sắc{else}Thêm màu sắc{/if}</h5>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <label for="ten-mau-sac">Tên màu sắc <span class="text-danger">*</span></label>
                            <input type="text" name="ten-mau-sac" id="ten-mau-sac" class="form-control" required {if isset($sua)}value="{$sua.sTenmausac}"{/if}>
                        </div>
                        <div class="form-group text-center">
                            {if $user.iMaquyen != 10}
                            {if isset($sua)}
                            <input class="hidden" type="text" name="action" value="cap-nhap-mau-sac">
                            <button type="submit" class="btn btn-info"><i data-feather="save"></i>&emsp;Cập nhập</button>
                            {else}
                            <input class="hidden" type="text" name="action" value="them-mau-sac">
                            <button type="submit" class="btn btn-success"><i data-feather="plus"></i>&emsp;Thêm</button>
                            {/if}
                            {/if}
                        </div>
                    </form>
                </div>
            </div>
        </section>  
    </div>
    <div class="col-sm-8">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">Danh mục màu sắc</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên màu sắc</th>
                                <th>Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $danhSachMauSac as $key => $mauSac}
                            <tr>
                                <td class="text-center">{$key + 1}</td>
                                <td>{$mauSac.sTenmausac}</td>
                                <td class="text-center">
                                    <form method="post">
                                        <a class="btn btn-outline-primary btn-sm btn-xs" href="{$url}admin/mau-sac?id={$mauSac.iMamausac}" title="Sửa màu sắc">
                                            <i data-feather="edit"></i>
                                        </a>
                                        <input class="hidden" type="text" name="action" value="xoa-mau-sac">
                                        <button class="btn btn-outline-danger btn-sm btn-xs" name="id-xoa" value="{$mauSac.iMamausac}" onclick="return confirm('Xác nhận thực hiện thao tác')" title="Xóa màu sắc">
                                            <i data-feather="trash"></i>
                                        </button>
                                    </form>
                                </td>
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