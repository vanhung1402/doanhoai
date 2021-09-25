<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] 	= 'Chome';
$route['404_override'] 			= '';
$route['translate_uri_dashes'] 	= FALSE;

// Public
$route['signup'] 				= 'public/Chethong/signup';
$route['login'] 				= 'public/Chethong/login';
$route['logout'] 				= 'public/Chethong/logout';
$route['profile'] 				= 'public/Cprofile';

// Admin
$route['admin'] 				= 'admin/Chome';
