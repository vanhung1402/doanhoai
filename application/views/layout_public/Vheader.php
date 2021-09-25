<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Đấu giá online Chilin</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicons -->
    <link href="dist/templates/public/img/favicon.png" rel="icon">
    <link href="dist/templates/public/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,500,600,700,700i|Montserrat:300,400,500,600,700"
        rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="dist/templates/public/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="dist/templates/public/libs/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="dist/templates/public/libs/animate/animate.min.css" rel="stylesheet">
    <link href="dist/templates/public/libs/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="dist/templates/public/libs/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="dist/templates/public/libs/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="dist/templates/public/libs/toast-master/css/jquery.toast.css" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="dist/templates/public/css/style.css" rel="stylesheet">
    <!-- Custom Stylesheet File -->
    <link href="dist/custom/public/css/main.css" rel="stylesheet">
    <link href="dist/custom/public/css/login.css" rel="stylesheet">
    <link href="dist/custom/public/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
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
                    <li class="active"><a href="{$url}">Home</a></li>
                    {if empty($user)}
                    <li>
                        <a class="open-modal-account" href="#0">Đăng nhập</a>
                    </li>
                    {else}
                    <li><a href="{$url}profile">{$user.sTennguoidung}</a></li>
                    <li><a href="{$url}logout" title="Đăng xuất"><i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
                    {/if}
                </ul>
            </nav><!-- .main-nav -->

            <div class="cd-user-modal">
                <!-- this is the entire modal form, including the background -->
                <div class="cd-user-modal-container">
                    <!-- this is the container wrapper -->
                    <ul class="cd-switcher">
                        <li><a href="#0">Sign in</a></li>
                        <li><a href="#0">New account</a></li>
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
                                <a href="#0" class="hide-password">Hide</a>
                                <span class="cd-error-message">Không được bỏ trống!</span>
                            </p>

                            <p class="fieldset flex align-middle">
                                <input type="checkbox" id="remember-me" checked>
                                <label class="m-0" for="remember-me">&emsp; Remember me</label>
                            </p>

                            <p class="fieldset">
                                <input name="login" class="full-width" type="submit" value="Login">
                                <input name="islogin" type="hidden" value="login">
                            </p>
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
                                        <input type="text" name="cmnd" id="cmnd" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="signup_password">Password <span class="text-danger">*</span></label>
                                        <input type="password" name="signup_password" id="signup_password" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-sm-12 flex align-middle border-top pt-2">
                                    <div class="form-group">
                                        <input type="checkbox" name="nguoiban" id="nguoiban">
                                        <label for="nguoiban">&emsp;Đăng ký bán hàng</label>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="row nguoiban hidden">
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label for="tenshop">Tên shop <span class="text-danger">*</span></label>
                                                <input type="text" name="tenshop" id="tenshop" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="logoshop">Ảnh logo <span class="text-danger">*</span></label>
                                                <input type="file" name="logoshop" id="logoshop" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="giayphep">Giấy phép kinh doanh <span class="text-danger">*</span></label>
                                                <input type="file" name="giayphep" id="giayphep" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="mota">Giới thiệu shop</label>
                                                <textarea name="mota" id="mota" cols="30" rows="8" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <p class="fieldset">
                                        <input name="signup" class="full-width" type="submit" value="Signup">
                                    </p>
                                </div>
                            </div>
                        </form>

                        <!-- <a href="#0" class="cd-close-form">Close</a> -->
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
                    <a href="#0" class="cd-close-form">Close</a>
                </div> <!-- cd-user-modal-container -->
            </div> <!-- cd-user-modal -->
        </div>
    </header><!-- #header -->
    <main id="main">