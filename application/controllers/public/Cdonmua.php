<?php

	class Cdonmua extends CI_Controller
	{
	    public function __construct()
	    {
	        parent::__construct();
			$this->__user = $this->session->userdata('user');
			if (!$this->__user || $this->__user['iTrangthai'] == 0) {
				return redirect(base_url(), 'refresh');
			}   
			$this->load->model('public/Mdaugia');
	    }

	    public function index()
	    {
	    	$data = [];
	        $temp['data'] 			= $data;
			$temp['template'] 		= 'public/Vdonmua';
	    	$this->load->view('layout_public/Vcontent', $temp);	
	    }
	}

?>