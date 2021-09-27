<?php 
	$user 						= $this->session->userdata('user_admin');
	// $quyen 						= $user['quyen'];
	// $data['quyen'] 				= $user['quyen'];
	// $data['username']			= $user['username'];
	
	$data_header 				= array(
		'title' 	=> isset($data['title']) ? $data['title'] : 'Đấu giá Chilin',
		'url' 		=> base_url(),
		'user' 		=> $user,
		'route' 	=> $data['route'],
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