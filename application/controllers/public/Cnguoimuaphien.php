<?php

	class Cnguoimuaphien extends CI_Controller
	{
		private $__user;
	    public function __construct()
	    {
	        
			parent::__construct();
			$this->__user = $this->session->userdata('user');
			if (!$this->__user || $this->__user['iTrangthai'] == 0) {
				return redirect(base_url(), 'refresh');
			}
			$this->load->model('public/Mnguoimuadaugia');
	    }

	    public function index()
	    {
	    	$action = $this->input->post('action');
	    	switch ($action) {
	    		case 'get-auctua':
	    			$start = $this->input->post('start');
	    			$end = $this->input->post('end');
	    			$limit = $this->input->post('limit');
	    			$result = $this->Mnguoimuadaugia->getAuctua($start, $end, $limit);
	    			die(json_encode($result));

	    		default:
	    			break;
	    	}
	    	$data['daDienRa'] 		= $this->Mnguoimuadaugia->daDienRa();
	    	$data['trangThai'] 		= ['Đang diễn ra', 'Đã diễn ra'];
			$temp['data'] 			= $data;
			$temp['template'] 		= 'public/Vnguoimuaphien';
	    	$this->load->view('layout_public/Vcontent', $temp);	
	    }
	}

?>