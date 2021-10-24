                
                <div class="modal fade text-left" id="doi-mat-khau" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel2" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <form method="post" id="form-doi-mat-khau" action="{$url}admin/change-password">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel2">Đổi mật khẩu</h5>
                                    <button type="button" class="close rounded-pill"
                                        data-bs-dismiss="modal" aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="change_password">Mật khẩu mới</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="password" id="change_password" class="form-control" name="change_password" minlength="6" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="re_change_password">Nhập lại mật khẩu mới</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="password" id="re_change_password" class="form-control" name="re_change_password" minlength="6" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn" data-bs-dismiss="modal">
                                        <i data-feather="x"></i>&emsp;Đóng
                                    </button>
                                    <button type=" button" class="btn btn-primary ml-1" id="btn-doi-mat-khau">
                                        <i data-feather="user-plus"></i>&emsp;Đổi mật khẩu
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; Chilindo</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class='text-danger'><i data-feather="heart"></i></span> by <a href="/">Nguyen Thi Hoai</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{$url}dist/templates/admin/assets/js/feather-icons/feather.min.js"></script>
    <script src="{$url}dist/templates/admin/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="{$url}dist/templates/admin/assets/js/app.js"></script>
    <script src="{$url}dist/templates/public/libs/toast-master/js/jquery.toast.js"></script>

    <script src="{$url}dist/templates/admin/assets/js/main.js"></script>
    <script src="{$url}dist/custom/admin/js/main.js"></script>
    {if !empty($message)}
    <script type="text/javascript">
        $(document).ready(function() {
            showMessage('{$message.type}', '{$message.msg}');
        });
    </script>
    {/if}
</body>

</html>
