<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] 		= 'Chome';
$route['404_override'] 				= '';
$route['translate_uri_dashes'] 		= FALSE;

// Public
$route['signup'] 					= 'public/Chethong/signup';
$route['login'] 					= 'public/Chethong/login';
$route['logout'] 					= 'public/Chethong/logout';
$route['hethong'] 					= 'public/Chethong';
$route['profile'] 					= 'public/Cprofile';
$route['dau-gia/san-pham'] 			= 'public/Csanpham';

// Admin
$route['admin/login'] 				= 'admin/Clogin';
$route['admin/logout'] 				= 'admin/Clogin/logout';
$route['admin/change-password'] 	= 'admin/Clogin/changePassword';
$route['admin'] 					= 'admin/Chome';

$route['admin/tai-khoan'] 			= 'admin/taikhoan/Ctaikhoan';
$route['admin/shop/(:any)'] 		= 'admin/taikhoan/Ctaikhoan/thongTinShop/$1';

// Danh mục
$route['admin/loai-hang'] 			= 'admin/danhmuc/Cloaihang';
$route['admin/danh-muc-loai-hang']	= 'admin/danhmuc/Cloaihang/danhMucLoaiHang';
$route['admin/mau-sac'] 			= 'admin/danhmuc/Cmausac';
$route['admin/kich-thuoc'] 			= 'admin/danhmuc/Ckichthuoc';
