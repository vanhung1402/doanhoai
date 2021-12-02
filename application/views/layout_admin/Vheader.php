<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{$title}</title>
    <link href="{$url}dist/templates/admin/assets/css/bootstrap.css" rel="stylesheet">
    <link href="{$url}dist/templates/admin/assets/vendors/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet">
    <link href="{$url}dist/templates/admin/assets/css/app.css?ver=1.0.01" rel="stylesheet">
    <link href="{$url}dist/templates/admin/assets/images/favicon.svg" rel="shortcut icon" type="image/x-icon">
    <link href="{$url}dist/templates/public/libs/toast-master/css/jquery.toast.css" rel="stylesheet">
    <link href="{$url}dist/custom/admin/css/app.css" rel="stylesheet">
    <base href="{$url}">
    <script src="{$url}dist/custom/admin/js/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div id="app">
        <div class="active" id="sidebar">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <img alt="" src="{$url}files/logo.jpg" srcset="">
                    </img>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu" id="custom-sidebar">
                        <li class="sidebar-title">
                            Menu
                        </li>
                        <li class="sidebar-item active ">
                            <a class="sidebar-link" href="{$url}admin">
                                <i data-feather="home" width="20">
                                </i>
                                <span>Trang chủ</span>
                            </a>
                        </li>
                        <li class="sidebar-item has-sub">
                            <a class="sidebar-link" href="#">
                                <i data-feather="user" width="20">
                                </i>
                                <span>Quản lý tài khoản</span>
                            </a>
                            <ul class="submenu ">
                                {if $user.iMaquyen == 10}
                                <li><a href="{$url}admin/tai-khoan">Tài khoản nhân viên HT</a></li>
                                {/if}
                                <li><a href="{$url}admin/tai-khoan?phan-loai=1">Tài khoản khách hàng</a></li>
                                <li><a href="{$url}admin/tai-khoan?phan-loai=2">Tài khoản chủ hàng</a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item has-sub">
                            <a class="sidebar-link" href="#">
                                <i data-feather="triangle" width="20">
                                </i>
                                <span>Quản lý sản phẩm</span>
                            </a>
                            <ul class="submenu ">
                                <li><a href="admin/loai-hang">Loại hàng</a></li>
                                <li><a href="admin/danh-muc-loai-hang">Danh mục loại hàng</a></li>
                                <li><a href="admin/mau-sac">Danh mục màu sắc</a></li>
                                <li><a href="admin/kich-thuoc">Danh mục kích thước</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <button class="sidebar-toggler btn x">
                    <i data-feather="x">
                    </i>
                </button>
            </div>
        </div>
        <div id="main">
            <nav class="navbar navbar-header navbar-expand navbar-light">
                <a class="sidebar-toggler cursor-pointer">
                    <span class="navbar-toggler-icon">
                    </span>
                </a>
                <button aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="btn navbar-toggler" data-bs-target="#navbarSupportedContent" data-bs-toggle="collapse" type="button">
                    <span class="navbar-toggler-icon">
                    </span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
                        <li class="dropdown">
                            <a class="nav-link dropdown-toggle nav-link-lg nav-link-user" data-bs-toggle="dropdown" href="#">
                                <div class="avatar me-1">
                                    <img alt="" src="{$url}dist/templates/admin/assets/images/avatar/avatar-s-1.png" srcset="">
                                    </img>
                                </div>
                                <div class="d-none d-md-block d-lg-inline-block">
                                    Hi, {$user.sTendangnhap}
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">
                                    <i data-feather="user">
                                    </i>
                                    Account
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i data-feather="settings">
                                    </i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#doi-mat-khau">
                                    <i data-feather="key">
                                    </i>
                                    Change password
                                </a>
                                <div class="dropdown-divider">
                                </div>
                                <a class="dropdown-item" href="{$url}admin/logout">
                                    <i data-feather="log-out">
                                    </i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="main-content container-fluid">
                {if !empty($route)}
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3 class="text-uppercase">{$route.title}</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{$url}admin">Trang chủ</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{$route.title}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                {/if}