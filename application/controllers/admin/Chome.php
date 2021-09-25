<?php

	class Chome extends CI_Controller
	{
	    public function __construct()
	    {
	        parent::__construct();
	    }

	    public function index()
	    {

			$temp['data'] 			= [];
			$temp['template'] 		= 'admin/Vhome';
	    	$this->load->view('layout_admin/Vcontent', $temp);	
	    }
	}

?>