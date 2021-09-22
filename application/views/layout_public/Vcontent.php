<?php 
	$user 						= $this->session->userdata('user');
	// $quyen 						= $user['quyen'];
	// $data['quyen'] 				= $user['quyen'];
	// $data['username']			= $user['username'];
	
	$data_header 				= array(
		'title' 	=> isset($data['title']) ? $data['title'] : 'Đấu giá Chilin',
		'url' 		=> base_url(),
		'user' 		=> $user,
		// 'quyen' 	=> $quyen,
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