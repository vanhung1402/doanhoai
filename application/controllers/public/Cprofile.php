<?php

	class Cprofile extends CI_Controller
	{
	    public function __construct()
	    {
			parent::__construct();
			$user = $this->session->userdata('user');
			if (!$user || $user['bTrangthai'] == 0) {
				return redirect(base_url(), 'refresh');
			}
	    }

	    public function index()
	    {
			$temp['data'] 			= [];
			$temp['template'] 		= 'public/Vprofile';
	    	$this->load->view('layout_public/Vcontent', $temp);	
	    }
	}

?>