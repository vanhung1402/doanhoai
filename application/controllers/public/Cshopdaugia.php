<?php

	class Cshopdaugia extends CI_Controller
	{
		private $__user;
	    public function __construct()
	    {
	        
			parent::__construct();
			$this->__user = $this->session->userdata('user');
			if (!$this->__user || $this->__user['iTrangthai'] == 0) {
				return redirect(base_url(), 'refresh');
			}
			$this->load->model('public/Mshopdaugia');
	    }

	    public function index()
	    {
	    	$action = $this->input->post('action');
	    	$shop = $this->input->get('id');
	    	switch ($action) {
	    		case 'get-auctua':
	    			$start = $this->input->post('start');
	    			$end = $this->input->post('end');
	    			$limit = $this->input->post('limit');
	    			$result = $this->Mshopdaugia->getAuctua($start, $end, $limit, $shop);
	    			die(json_encode($result));

	    		default:
	    			break;
	    	}
	    	$data['sapDienRa'] 		= $this->Mshopdaugia->sapDienRa($shop);
	    	$data['daDienRa'] 		= $this->Mshopdaugia->daDienRa($shop);
	    	$data['id'] 			= $shop;
	    	$data['shop'] 			= $this->Mshopdaugia->getShop($shop);
	    	if (!$data['shop']) return redirect(base_url(), 'refresh');
	    	$data['trangThai'] 		= ['Đang diễn ra', 'Sắp diễn ra', 'Đã diễn ra'];
			$temp['data'] 			= $data;
			$temp['template'] 		= 'public/Vshopphien';
	    	$this->load->view('layout_public/Vcontent', $temp);	
	    }
	}

?>