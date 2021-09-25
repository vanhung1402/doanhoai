<?php

	class Chethong extends CI_Controller
	{
	    public function __construct()
	    {
	 		parent::__construct();
	 		$this->load->model('public/Mhethong');    
	    }

	    public function login()
	    {
	    	if (!$this->input->post('islogin')) return redirect(base_url(), 'refresh');
	    	$taiKhoan = [
	    		'sTendangnhap' => $this->input->post('username'),
	    		'sMatkhau' => sha1($this->input->post('password')),
	    	];

	    	$nguoiDung = $this->Mhethong->dangNhap($taiKhoan);
	    	if ($nguoiDung) {
	    		$this->session->set_userdata('user', $nguoiDung);
	    	} else {
	    		setMessage('error', 'Tài khoản/mật khẩu không chính xác');
	    		return redirect(base_url(), 'refresh');
	    	}
	    	return redirect(base_url(), 'refresh');
	    }

	    public function signup()
	    {
	    	if (!$this->input->post('signup')) return redirect(base_url(), 'refresh');
	    	$taiKhoan = [
	    		'sTendangnhap' => $this->input->post('signup_email'),
	    		'sMatkhau' => sha1($this->input->post('signup_password')),
	    		'bTrangthai' => 1,
	    	];
	    	$resultTaiKhoan = $this->Mhethong->taoTaiKhoan($taiKhoan);
	    	if (!$resultTaiKhoan) {
	    		setMessage('error', 'Đã có lỗi xảy ra, vui lòng thử lại sau');
	    		return redirect(base_url(), 'refresh');
	    	}

	    	$quyenTaiKhoan = [
	    		'iMaquyen' => 1,
	    		'iMataikhoan' => $resultTaiKhoan,
	    	];
	    	$resultQuyenTaiKhoan = $this->Mhethong->phanQuyenTaiKhoan($quyenTaiKhoan);

	    	$ngaySinh = $this->input->post('ngaysinh');
    		$ngaySinh = implode('-', array_reverse(explode('/', $ngaySinh)));

	    	$nguoiDung = [
	    		'iMataikhoan' => $resultTaiKhoan,
	    		'sTennguoidung' => $this->input->post('hoten'),
	    		'dNgaysinh' => $ngaySinh,
	    		'bGioitinh' => $this->input->post('gioitinh'),
	    		'sSodienthoai' => $this->input->post('dienthoai'),
	    		'sDiachi' => $this->input->post('diachi'),
	    		'sEmail' => $this->input->post('signup_email'),
	    		'iSoCCCD' => $this->input->post('cmnd'),
	    		'bPhanloai' => $this->input->post('nguoiban') ? 2 : 1,
	    	];

	    	$resultNguoiDung = $this->Mhethong->taoNguoiDung($nguoiDung);
	    	return redirect(base_url(), 'refresh');
	    }

	    public function uploadFile($inputName, $folder) {
	    	$config['upload_path'] = './files/' . $folder;
	        $config['allowed_types'] = 'gif|jpg|png|pdf';
	        $config['max_size'] = 2000;

	        $this->load->library('upload', $config);

	        if (!$this->upload->do_upload($inputName)) {
	            return ['error' => $this->upload->display_errors()];
	        } else {
	            return ['success' => $this->upload->data()];
	        }
	    }

	    public function logout()
	    {
	    	$this->session->sess_destroy();
			return redirect(base_url(), 'refresh');
			exit();
	    }
	}

?>