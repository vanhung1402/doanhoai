<?php

	class Clogin extends CI_Controller
	{
		private $__user;
	    public function __construct()
	    {
	        parent::__construct();
	        $this->load->model('admin/Mhethong');
	 		$this->__user = $this->session->userdata('user_admin');
	    }

	    public function index()
	    {
	    	$action = $this->input->post('action');
	    	switch ($action) {
	    		case 'login':
	    			$this->login();
	    			break;
	    		
	    		default:
	    			// code...
	    			break;
	    	}

			$data['message']  			= getMessage();
			$data['url']  				= base_url();
	    	$this->parser->parse('admin/Vlogin', $data);
	    }

	    private function login()
	    {
	    	$taiKhoan = [
	    		'sTendangnhap' => $this->input->post('username'),
	    		'sMatkhau' => sha1($this->input->post('password')),
	    		'iTrangthai' => 1,
	    	];

	    	$quanTri = $this->Mhethong->dangNhap($taiKhoan);
	    	if ($quanTri) {
	    		$this->session->set_userdata('user_admin', $quanTri);
	    	} else {
	    		setMessage('error', 'Tài khoản/mật khẩu không chính xác');
	    		return redirect(base_url('admin/login'), 'refresh');
	    	}
	    	return redirect(base_url('admin'), 'refresh');
	    }

	    public function changePassword()
	    {
	    	$matKhauMoi = sha1($this->input->post('change_password'));
	    	$resultUpdate = $this->Mhethong->doiMatKhau($matKhauMoi, $this->__user['iMataikhoan']);
	    	if ($resultUpdate) {
	    		setMessage('success', 'Cập nhập thành công');
	    	} else {
	    		setMessage('error', 'Không có cập nhập nào được ghi nhận');
	    	}
	    	return redirect(base_url('admin'), 'refresh');
	    }

	    public function logout()
	    {
	    	$this->session->unset_userdata('user_admin');
			return redirect(base_url(), 'refresh');
			exit();
	    }
	}

?>