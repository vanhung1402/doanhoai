<?php

	class Ctaikhoan extends MY_Controller
	{
	    public function __construct()
	    {
	        parent::__construct();
	        $this->load->model('admin/taikhoan/Mtaikhoan');
	    }

	    public function index()
	    {
	    	if ($iMataikhoan = $this->input->post('mokhoa')) {
	    		$resutlAction = $this->Mtaikhoan->setTrangThaiTaiKhoan($iMataikhoan, 1);
	    		$resutlAction ? setMessage('success', 'Mở khóa thành công') : setMessage('error', 'Đã có lỗi xảy ra, vui lòng thử lại sau');
	    		return redirect(base_url('admin/tai-khoan'), 'refresh');
	    	} else if ($iMataikhoan = $this->input->post('khoa')) {
	    		$resutlAction = $this->Mtaikhoan->setTrangThaiTaiKhoan($iMataikhoan, 2);
	    		$resutlAction ? setMessage('success', 'Khóa thành công') : setMessage('error', 'Đã có lỗi xảy ra, vui lòng thử lại sau');
	    		return redirect(base_url('admin/tai-khoan'), 'refresh');
	    	} else if ($iMataikhoan = $this->input->post('duyet')) {
	    		$resutlAction = $this->Mtaikhoan->setTrangThaiTaiKhoan($iMataikhoan, 1);
	    		$resutlAction ? setMessage('success', 'Duyệt thành công') : setMessage('error', 'Đã có lỗi xảy ra, vui lòng thử lại sau');
	    		return redirect(base_url('admin/tai-khoan'), 'refresh');
	    	}

	    	$action = $this->input->post('action');
	    	switch ($action) {
	    		case 'check-tai-khoan':
	    			$this->checkTaiKhoan();
	    			break;
	    		
	    		case 'cap-tai-khoan':
	    			$this->capTaiKhoan();
	    			break;
	    		
	    		default:
	    			// code...
	    			break;
	    	}

	    	$danhSachTaiKhoan 		= $this->Mtaikhoan->getAllTaiKhoan();
	    	$trangThaiTaiKhoan 		= [
	    		1 => 'Đang mở',
	    		2 => 'Đang khóa',
	    		3 => 'Chưa xác thực',
	    	];
			$temp['data'] 			= [
				'danhSachTaiKhoan' 	=> $danhSachTaiKhoan,
				'trangThaiTaiKhoan' => $trangThaiTaiKhoan,
				'route' 			=> [
					'title' 		=> 'Quản lý tài khoản',
				]
			];
			$temp['template'] 		= 'admin/taikhoan/Vtaikhoan';
	    	$this->load->view('layout_admin/Vcontent', $temp);	
	    }

	    private function checkTaiKhoan()
	    {
	    	$taiKhoan = [
	    		'sTendangnhap' => $this->input->post('username'),
	    	];

	    	$resutlCheck = $this->Mtaikhoan->checkTaiKhoan($taiKhoan);
	    	echo json_encode(!!$resutlCheck);
	    	exit();
	    }

	    private function capTaiKhoan()
	    {
	    	$taiKhoan = [
	    		'sTendangnhap' => $this->input->post('username'),
	    		'sMatkhau' => sha1($this->input->post('password')),
	    		'iTrangthai' => 1,
	    	];

	    	$resultCreate = $this->Mtaikhoan->taoTaiKhoan($taiKhoan);

	    	if ($resultCreate) {
	    		setMessage('success', 'Cấp tài khoản thành công');
	    	} else {
	    		setMessage('error', 'Cấp tài khoản nào được ghi nhận');
	    	}
	    	return redirect(base_url('admin/tai-khoan'), 'refresh');
	    }
	}

?>