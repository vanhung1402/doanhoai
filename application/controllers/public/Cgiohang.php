<?php

	class Cgiohang extends CI_Controller
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
	    	$session = $this->session->userdata('user');
	    	$data = [];
	    	$data['gio_hang'] 		= $this->Mdaugia->getCartUser($session['iMataikhoan']);
	    	$data['gio_hang_map'] 	= handingArrayToMap($data['gio_hang'], 'iManguoidung');
			$temp['data'] 			= $data;
			$temp['template'] 		= 'public/Vgiohang';
	    	$this->load->view('layout_public/Vcontent', $temp);	
	    }
	}

?>