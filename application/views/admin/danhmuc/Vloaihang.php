<link rel="stylesheet" href="{$url}dist/templates/admin/assets/vendors/simple-datatables/style.css">
<div class="row">
    <div class="col-sm-4">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">{if isset($sua)}Cập nhập loại hàng{else}Thêm loại hàng{/if}</h5>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <label for="ten-loai-hang">Tên loại hàng <span class="text-danger">*</span></label>
                            <input type="text" name="ten-loai-hang" id="ten-loai-hang" class="form-control" required {if isset($sua)}value="{$sua.sTenloaihang}"{/if}>
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
                                <th>Tên loại hàng</th>
                                <th>Trạng thái</th>
                                <th>Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $danhSachLoaiHang as $key => $loaiHang}
                            <tr>
                                <td class="text-center">{$key + 1}</td>
                                <td>{$loaiHang.sTenloaihang}</td>
                                <td>{$loaiHang.iTrangthai}</td>
                                <td class="text-center">
                                    <form method="post">
                                        <a class="btn btn-outline-primary btn-sm btn-xs" href="{$url}admin/loai-hang?id={$loaiHang.iMaloaihang}" title="Sửa loại hàng">
                                            <i data-feather="edit"></i>
                                        </a>
                                        <input class="hidden" type="text" name="action" value="xoa-loai-hang">
                                        <button class="btn btn-outline-danger btn-sm btn-xs" name="id-xoa" value="{$loaiHang.iMaloaihang}" onclick="return confirm('Xác nhận thực hiện thao tác')" title="Xóa loại hàng">
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