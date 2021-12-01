<?php

	class Cchuhangphien extends CI_Controller
	{
		private $__user;
	    public function __construct()
	    {
	        
			parent::__construct();
			$this->__user = $this->session->userdata('user');
			if (!$this->__user || $this->__user['iTrangthai'] == 0) {
				return redirect(base_url(), 'refresh');
			}
			$this->load->model('public/Mchuhangdaugia');
	    }

	    public function index()
	    {
	    	$action = $this->input->post('action');
	    	switch ($action) {
	    		case 'get-auctua':
	    			$start = $this->input->post('start');
	    			$end = $this->input->post('end');
	    			$limit = $this->input->post('limit');
	    			$result = $this->Mchuhangdaugia->getAuctua($start, $end, $limit);
	    			die(json_encode($result));

	    		default:
	    			break;
	    	}
	    	$data['sapDienRa'] 		= $this->Mchuhangdaugia->sapDienRa();
	    	$data['daDienRa'] 		= $this->Mchuhangdaugia->daDienRa();
	    	$data['trangThai'] 		= ['Đang diễn ra', 'Sắp diễn ra', 'Đã diễn ra'];
			$temp['data'] 			= $data;
			$temp['template'] 		= 'public/Vchuhangphien';
	    	$this->load->view('layout_public/Vcontent', $temp);	
	    }
	}

?>