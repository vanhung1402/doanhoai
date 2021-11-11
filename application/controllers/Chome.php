<?php

	class Chome extends CI_Controller
	{
	    public function __construct()
	    {
	        parent::__construct();
	        $this->load->model('public/Mdaugia');
	    }

	    public function index()
	    {
	    	$action = $this->input->post('action');
	    	switch ($action) {
	    		case 'get-auctua':
	    			$start = $this->input->post('start');
	    			$end = $this->input->post('end');
	    			$limit = $this->input->post('limit');
	    			$result = $this->Mdaugia->getAuctua($start, $end, $limit);
	    			die(json_encode($result));
	    		case 'get-cart':
	    			$this->getCart();
	    			break;
	    		default:
	    			break;
	    	}
			$temp['template'] 		= 'public/Vhome';
	    	$this->load->view('layout_public/Vcontent', $temp);	
	    }

	    private function getCart()
	    {
	    	$session = $this->session->userdata('user');
	    	if (!$session) die(json_encode(null));
	    	$uncheck = $this->Mdaugia->getCartUser($session['iMataikhoan']);
	    	die(json_encode($uncheck));
	    }
	}

?>