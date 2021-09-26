<?php 
	$user 						= $this->session->userdata('user');
	// pr($user);
	$trangThaiTaiKhoan 		= [
		1 => 'Đang mở',
		2 => 'Đang khóa',
		3 => 'Chưa xác thực',
	];
	
	$data_header 				= array(
		'title' 	=> isset($data['title']) ? $data['title'] : 'Đấu giá Chilin',
		'url' 		=> base_url(),
		'user' 		=> $user,
		'tttk' 		=> $trangThaiTaiKhoan,
	);

	$data_footer 				= array(
		'url' 		=> base_url(),
		'message' 	=> getMessage(),
	);

	$data['url']  				= base_url();
	$this->parser->parse('layout_public/Vheader', $data_header);
	$this->parser->parse($template, $data);
	$this->parser->parse('layout_public/Vfooter', $data_footer);

?>