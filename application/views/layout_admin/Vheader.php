<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{$title}</title>
    <link href="dist/templates/admin/assets/css/bootstrap.css" rel="stylesheet">
    <link href="dist/templates/admin/assets/vendors/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet">
    <link href="dist/templates/admin/assets/css/app.css?ver=1.0.01" rel="stylesheet">
    <link href="dist/templates/admin/assets/images/favicon.svg" rel="shortcut icon" type="image/x-icon">
    <link href="dist/custom/admin/css/app.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div class="active" id="sidebar">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <img alt="" src="dist/templates/admin/assets/images/logo.svg" srcset="">
                    </img>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">
                            Menu
                        </li>
                        <li class="sidebar-item active ">
                            <a class="sidebar-link" href="index.html">
                                <i data-feather="home" width="20">
                                </i>
                                <span>Trang chủ</span>
                            </a>
                        </li>
                        <li class="sidebar-item has-sub">
                            <a class="sidebar-link" href="#">
                                <i data-feather="triangle" width="20">
                                </i>
                                <span>Quản lý sản phẩm</span>
                            </a>
                            <ul class="submenu ">
                                <li>
                                    <a href="admin/them-san-pham">Thêm sản phẩm</a>
                                </li>
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
                <a class="sidebar-toggler" href="#">
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
                                    <img alt="" src="dist/templates/admin/assets/images/avatar/avatar-s-1.png" srcset="">
                                    </img>
                                </div>
                                <div class="d-none d-md-block d-lg-inline-block">
                                    Hi, Saugi
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
                                <div class="dropdown-divider">
                                </div>
                                <a class="dropdown-item" href="#">
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