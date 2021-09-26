<?php

	defined('BASEPATH') OR exit('No direct script access allowed');
	class MY_Controller extends CI_Controller {
		protected $__session;

		public function __construct(){
			parent::__construct();
			$this->__session = $this->session->userdata('user_admin');
			if (!$this->__session) {
				return redirect(base_url('admin/login'), 'refresh');
			}
		}
	}
