<?php 
	$user 						= $this->session->userdata('user_admin');
	// $quyen 						= $user['quyen'];
	// $data['quyen'] 				= $user['quyen'];
	// $data['username']			= $user['username'];
	$trangThaiTaiKhoan 		= [
		1 => ['title' => 'Đang mở', 'color' => 'success'],
		2 => ['title' => 'Đang khóa', 'color' => 'light'],
		3 => ['title' => 'Chưa xác thực', 'color' => 'warning'],
	];
	
	$data_header 				= array(
		'title' 	=> isset($data['title']) ? $data['title'] : 'Đấu giá Chilin',
		'url' 		=> base_url(),
		'user' 		=> $user,
		// 'route' 	=> $data['route'],
		'tttk' 		=> $trangThaiTaiKhoan,
	);

	$data_footer 				= array(
		'url' 		=> base_url(),
		'message' 	=> getMessage(),
	);

	$data['url']  				= base_url();
	$this->parser->parse('layout_admin/Vheader', $data_header);
	$this->parser->parse($template, $data);
	$this->parser->parse('layout_admin/Vfooter', $data_footer);

?>