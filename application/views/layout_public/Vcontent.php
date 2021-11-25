<?php 
	$user 						= $this->session->userdata('user');
	// pr($user);
	$trangThaiTaiKhoan 		= [
		1 => 'Đã duyệt',
		2 => 'Đang khóa',
		3 => 'Chưa xác thực',
	];
	$trangThaiDonHang = [
		0 => 'Tất cả',
		1 => 'Chờ xác nhận',
		2 => 'Chờ lấy hàng',
		3 => 'Đang giao',
		4 => 'Đã giao',
		5 => 'Đã hủy',
		6 => 'Đã nhận hàng',
	];
	$data_header 				= array(
		'title' 	=> isset($data['title']) ? $data['title'] : 'Đấu giá Chilin',
		'url' 		=> base_url(),
		'user' 		=> $user,
		'tttk' 		=> $trangThaiTaiKhoan,
		'url_file' 	=> 'http://localhost/upload-file-service/',
	);

	$data_footer 				= array(
		'url' 		=> base_url(),
		'url_file' 	=> 'http://localhost/upload-file-service/',
		'message' 	=> getMessage(),
		'signup' 	=> $this->session->flashdata('signup_success'),
	);

	$data['trangThaiDonHang'] 	= $trangThaiDonHang;
	$data['url']  				= base_url();
	$data['url_file']  			= 'http://localhost/upload-file-service/';
	$this->parser->parse('layout_public/Vheader', $data_header);
	$this->parser->parse($template, $data);
	$this->parser->parse('layout_public/Vfooter', $data_footer);

?>