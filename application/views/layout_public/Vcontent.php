<?php 
	$user 						= $this->session->userdata('user');
	// pr($user);
	$trangThaiTaiKhoan 		= [
		1 => 'Đã duyệt',
		2 => 'Đang khóa',
		3 => 'Chưa xác thực',
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

	$data['url']  				= base_url();
	$data['url_file']  			= 'http://localhost/upload-file-service/';
	$this->parser->parse('layout_public/Vheader', $data_header);
	$this->parser->parse($template, $data);
	$this->parser->parse('layout_public/Vfooter', $data_footer);

?>