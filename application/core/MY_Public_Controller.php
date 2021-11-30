<?php

	defined('BASEPATH') OR exit('No direct script access allowed');
	class MY_Public_Controller extends CI_Controller {
		protected $__session;

		public function __construct(){
			parent::__construct();
	 		$this->load->model('public/Mhethong');	
		}
	}
