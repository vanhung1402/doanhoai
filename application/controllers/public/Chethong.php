<?php

	class Chethong extends CI_Controller
	{
		private $__user;
	    public function __construct()
	    {
	 		parent::__construct();
	 		$this->load->model('public/Mhethong');
	 		$this->__user = $this->session->userdata('user');
	    }

	    public function index()
	    {
	    	$action = $this->input->post('action');
	    	switch ($action) {
	    		case 'check-email':
	    			$this->checkExistEmail();
	    			break;
	    		case 'check-dien-thoai':
	    			$this->checkExistPhone();
	    			break;
	    		case 'check-cmnd':
	    			$this->checkExistCMND();
	    			break;
	    		
	    		default:
	    			echo json_encode(false);
	    			break;
	    	}
	    	exit();
	    }

	    public function checkExistCMND()
	    {
	    	$cmnd = $this->input->post('cmnd');
	    	$cmndCheck = $this->Mhethong->checkExistCMND($cmnd, $this->__user);
	    	echo json_encode(!!$cmndCheck);
	    }

	    public function checkExistPhone()
	    {
	    	$dienThoai = $this->input->post('dienthoai');
	    	$dienThoaiCheck = $this->Mhethong->checkExistPhone($dienThoai, $this->__user);
	    	echo json_encode(!!$dienThoaiCheck);
	    }

	    public function checkExistEmail()
	    {
	    	$email = $this->input->post('email');
	    	$emailCheck = $this->Mhethong->checkExistEmail($email, $this->__user);
	    	echo json_encode(!!$emailCheck);
	    }

	    public function login()
	    {
	    	if (!$this->input->post('islogin')) return redirect(base_url(), 'refresh');
	    	$taiKhoan = [
	    		'sTendangnhap' => $this->input->post('username'),
	    		'sMatkhau' => sha1($this->input->post('password')),
	    	];

	    	$nguoiDung = $this->Mhethong->dangNhap($taiKhoan);
	    	$back = $this->input->post('current_url');
	    	$back = $back ? $back : base_url();

	    	if ($nguoiDung) {
	    		$this->session->set_userdata('user', $nguoiDung);
	    	} else {
	    		setMessage('error', 'Tài khoản/mật khẩu không chính xác');
	    		return redirect($back, 'refresh');
	    	}
	    	setMessage('success', 'Đăng nhập thành công');
	    	return redirect($back, 'refresh');
	    }

	    public function signup()
	    {
	    	if (!$this->input->post('signup')) return redirect(base_url(), 'refresh');
	    	$taiKhoan = [
	    		'sTendangnhap' => $this->input->post('signup_email'),
	    		'sMatkhau' => sha1($this->input->post('signup_password')),
	    		'iTrangthai' => 3,
	    	];
	    	$resultTaiKhoan = $this->Mhethong->taoTaiKhoan($taiKhoan);
	    	if (!$resultTaiKhoan) {
	    		setMessage('error', 'Đã có lỗi xảy ra, vui lòng thử lại sau');
	    		return redirect(base_url(), 'refresh');
	    	}

	    	$quyenTaiKhoan = [
	    		'iMaquyen' => 2,
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
	    		'iPhanloai' => 2,
	    	];

	    	$resultNguoiDung = $this->Mhethong->taoNguoiDung($nguoiDung);
	    	setMessage('success', 'Đăng ký thành công');
	    	$this->session->set_flashdata('signup_success', true);
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
	    	$back = $this->input->get('back') ? $this->input->get('back') : base_url();
	    	$this->session->unset_userdata('user');
	    	setMessage('success', 'Đăng xuất thành công');
			return redirect($back, 'refresh');
			exit();
	    }
	}

?>