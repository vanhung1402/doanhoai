<link rel="stylesheet" href="{$url}dist/templates/admin/assets/vendors/simple-datatables/style.css">
<link rel="stylesheet" href="{$url}dist/templates/admin/assets/vendors/choices.js/choices.min.css" />
<div class="row">
    <div class="col-sm-4">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">{if isset($sua)}Cập nhập danh mục loại hàng{else}Thêm danh mục loại hàng{/if}</h5>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <label for="ten-loai-hang">Tên danh mục loại hàng <span class="text-danger">*</span></label>
                            <input type="text" name="ten-loai-hang" id="ten-loai-hang" class="form-control" required {if isset($sua)}value="{$sua.sTendanhmuclh}"{/if}>
                        </div>
                        <div class="form-group">
                            <label for="loai-hang">Loại hàng <span class="text-danger">*</span></label>
                            <select name="loai-hang" id="loai-hang" class="choices form-select" required>
                                {foreach $danhSachLoaiHang as $loaiHang}
                                <option value="{$loaiHang.iMaloaihang}" {if (isset($sua) && $sua.iMaloaihang == $loaiHang.iMaloaihang)}selected{/if}>{$loaiHang.sTenloaihang}</option>
                                {/foreach}
                            </select>
                        </div>
                        <div class="form-group text-center">
                            {if isset($sua)}
                            <input class="hidden" type="text" name="action" value="cap-nhap-loai-hang">
                            <button type="submit" class="btn btn-info"><i data-feather="save"></i>&emsp;Cập nhập</button>
                            {else}
                            <input class="hidden" type="text" name="action" value="them-loai-hang">
                            <button type="submit" class="btn btn-success"><i data-feather="plus"></i>&emsp;Thêm</button>
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
                    <h5 class="text-center">Danh mục loại hàng</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên danh mục loại hàng</th>
                                <th>Loại hàng</th>
                                <th>Trạng thái</th>
                                <th>Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $danhMucLoaiHang as $key => $loaiHang}
                            <tr>
                                <td class="text-center">{$key + 1}</td>
                                <td>{$loaiHang.sTendanhmuclh}</td>
                                <td>{$loaiHang.sTenloaihang}</td>
                                <td>{$loaiHang.iTrangthai}</td>
                                <td class="text-center">
                                    {if $user.iMaquyen != 10}
                                    <form method="post">
                                        <a class="btn btn-outline-primary btn-sm btn-xs" href="{$url}admin/danh-muc-loai-hang?id={$loaiHang.iMadanhmuclh}" title="Sửa danh mục loại hàng">
                                            <i data-feather="edit"></i>
                                        </a>
                                        {if !$loaiHang.sanPham}
                                        <input class="hidden" type="text" name="action" value="xoa-loai-hang">
                                        <button class="btn btn-outline-danger btn-sm btn-xs" name="id-xoa" value="{$loaiHang.iMadanhmuclh}" onclick="return confirm('Xác nhận thực hiện thao tác')" title="Xóa danh mục loại hàng">
                                            <i data-feather="trash"></i>
                                        </button>
                                        {/if}
                                    </form>
                                    {/if}
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
<script src="{$url}dist/templates/admin/assets/vendors/choices.js/choices.min.js"></script>
<script src="{$url}dist/templates/admin/assets/vendors/simple-datatables/simple-datatables.js"></script>