<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Đấu giá online Chilin</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicons -->
    <link href="{$url}dist/templates/public/img/favicon.png" rel="icon">
    <link href="{$url}dist/templates/public/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,500,600,700,700i|Montserrat:300,400,500,600,700"
        rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="{$url}dist/templates/public/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="{$url}dist/templates/public/libs/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="{$url}dist/templates/public/libs/animate/animate.min.css" rel="stylesheet">
    <link href="{$url}dist/templates/public/libs/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="{$url}dist/templates/public/libs/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="{$url}dist/templates/public/libs/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="{$url}dist/templates/public/libs/toast-master/css/jquery.toast.css" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="{$url}dist/templates/public/css/style.css" rel="stylesheet">
    <!-- Custom Stylesheet File -->
    <link href="{$url}dist/custom/public/css/main.css" rel="stylesheet">
    <link href="{$url}dist/custom/public/css/login.css" rel="stylesheet">
    <link href="{$url}dist/custom/public/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
    <base href="{$url}">
    <script src="{$url}dist/custom/admin/js/jquery-3.6.0.min.js"></script>
</head>

<body>
    <header id="header">
        <div id="topbar">
            <div class="container">
                <div class="social-links">
                    <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                    <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                    <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
                    <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="logo float-left">
                <!-- Uncomment below if you prefer to use an image logo -->
                <h1 class="text-light"><a href="{$url}" class="scrollto"><span>Chilin</span></a></h1>
                <!-- <a href="#header" class="scrollto"><img src="img/logo.png" alt="" class="img-fluid"></a> -->
            </div>

            <nav class="main-nav float-right d-none d-lg-block">
                <ul>
                    <li class="active"><a href="{$url}"><i class="fa fa-home"></i>&nbsp; Trang chủ</a></li>
                    {if empty($user)}
                    <li>
                        <a class="open-modal-account" id="open-login"><i class="fa fa-sign-in"></i>&nbsp; Đăng nhập</a>
                    </li>
                    {else}
                    <li>
                        <a href="{$url}gio-hang"><i class="fa fa-shopping-cart"></i>&nbsp; Giỏ hàng (<span id="total-uncheck">0</span>)</a>
                    </li>
                    <li class="drop-down"><a href="{$url}profile"><i class="fa fa-cog"></i>&nbsp; Xin chào, {$user.sTennguoidung}</a>
                        <ul>
                            <li><a href="{$url}profile">Thông tin tài khoản</a></li>
                            <li><a href="{$url}chu-hang/san-pham">Thêm sản phẩm</a></li>
                            <li><a href="{$url}chu-hang/danh-sach-san-pham">Danh sách sản phẩm</a></li>
                            <!-- <li><a href="{$url}">Danh sách phiên đấu giá</a></li> -->
                            <li><a href="{$url}doi-mat-khau">Đổi mật khẩu</a></li>
                            <li><a id="logout" href="{$url}logout">Đăng xuất</a></li>
                        </ul>
                    </li>
                    {/if}
                </ul>
            </nav><!-- .main-nav -->

            <div class="cd-user-modal">
                <!-- this is the entire modal form, including the background -->
                <div class="cd-user-modal-container">
                    <!-- this is the container wrapper -->
                    <ul class="cd-switcher">
                        <li><a>Đăng nhập</a></li>
                        <li><a>Đăng ký</a></li>
                    </ul>

                    <div id="cd-login">
                        <!-- log in form -->
                        <form method="post" action="{$url}login" class="cd-form">
                            <p class="fieldset">
                                <label class="image-replace cd-email" for="signin-email">Username / E-mail</label>
                                <input class="full-width has-padding has-border" id="signin-email" name="username" type="text"
                                    placeholder="Username / E-mail">
                                <span class="cd-error-message">Không được bỏ trống!</span>
                            </p>

                            <p class="fieldset">
                                <label class="image-replace cd-password" for="signin-password">Password</label>
                                <input class="full-width has-padding has-border" id="signin-password" type="text" placeholder="Password" name="password">
                                <a class="hide-password">Hide</a>
                                <span class="cd-error-message">Không được bỏ trống!</span>
                            </p>

                            <p class="fieldset">
                                <input name="login" class="full-width" type="submit" value="ĐĂNG NHẬP">
                                <input name="islogin" type="hidden" value="login">
                            </p>
                            <input type="text" class="hidden" id="current_url" name="current_url">
                        </form>

                        <p class="cd-form-bottom-message"><a href="#0">Forgot your password?</a></p>
                        <!-- <a href="#0" class="cd-close-form">Close</a> -->
                    </div> <!-- cd-login -->

                    <div id="cd-signup">
                        <!-- sign up form -->
                        <form method="post" action="{$url}signup" class="cd-form" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <label for="hoten">Họ và tên <span class="text-danger">*</span></label>
                                        <input type="text" name="hoten" autofocus id="hoten" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="ngaysinh">Ngày sinh <span class="text-danger">*</span></label>
                                        <input type="text" name="ngaysinh" id="ngaysinh" class="form-control datepicker" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group form-gioitinh">
                                        <label for="gioitinh_nam">Giới tính <span class="text-danger">*</span></label>
                                        <div><input type="radio" name="gioitinh" id="gioitinh_nam" value="1" checked required><label for="gioitinh_nam">&emsp;Nam</label></div>
                                        <div><input type="radio" name="gioitinh" id="gioitinh_nu" value="0" required><label for="gioitinh_nu">&emsp;Nữ</label></div>
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <label for="signup_email">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="signup_email" id="signup_email" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="dienthoai">Điện thoại <span class="text-danger">*</span></label>
                                        <input type="text" name="dienthoai" id="dienthoai" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="diachi">Địa chỉ</label>
                                        <input type="text" name="diachi" id="diachi" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <label for="cmnd">Số CCCD <span class="text-danger">*</span></label>
                                        <input type="number" name="cmnd" id="cmnd" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="signup_password">Password <span class="text-danger">*</span></label>
                                        <input type="password" name="signup_password" id="signup_password" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-sm-12 flex align-middle justify-content-between border-top pt-3 mb-2 form-phanloai">
                                    <label for="nguoiban">Đăng ký với tư cách:&emsp;</label>
                                    <div><input type="radio" name="phanloai" id="nguoimua" value="1" required checked>&emsp;<label for="nguoimua">Người mua</label></div>
                                    <div><input type="radio" name="phanloai" id="nguoiban" value="2" required>&emsp;<label for="nguoiban">Người bán</label></div>
                                </div>
                                <div class="col-sm-12">
                                    <p class="fieldset">
                                        <input name="btn-signup" class="full-width" type="submit" value="ĐĂNG KÝ">
                                        <input type="text" name="signup" value="signup" class="hidden">
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div> <!-- cd-signup -->

                    <div id="cd-reset-password">
                        <!-- reset password form -->
                        <p class="cd-form-message">Lost your password? Please enter your email address. You will receive a link
                            to create a new password.</p>

                        <form class="cd-form">
                            <p class="fieldset">
                                <label class="image-replace cd-email" for="reset-email">E-mail</label>
                                <input class="full-width has-padding has-border" id="reset-email" type="email"
                                    placeholder="E-mail">
                                <span class="cd-error-message">Error message here!</span>
                            </p>

                            <p class="fieldset">
                                <input class="full-width has-padding" type="submit" value="Reset password">
                            </p>
                        </form>

                        <p class="cd-form-bottom-message"><a href="#0">Back to log-in</a></p>
                    </div> <!-- cd-reset-password -->
                    <a class="cd-close-form">Close</a>
                </div> <!-- cd-user-modal-container -->
            </div> <!-- cd-user-modal -->
        </div>
    </header><!-- #header -->
    <main id="main">