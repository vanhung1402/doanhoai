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
			$temp['template'] 		= 'public/Vhome';
	    	$this->load->view('layout_public/Vcontent', $temp);	
	    }
	}

?>