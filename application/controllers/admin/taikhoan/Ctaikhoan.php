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
	    	$phanLoai = $this->input->get('phan-loai');
	    	$trangThai = $this->input->get('trang-thai');

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

	    	$danhSachTaiKhoan 		= $this->Mtaikhoan->getAllTaiKhoan($trangThai, $phanLoai);
	    	$trangThaiTaiKhoan 		= [
	    		1 => 'Đang mở',
	    		2 => 'Đang khóa',
	    		3 => 'Chưa xác thực',
	    	];
			$temp['data'] 			= [
				'phanLoai' 			=> $phanLoai,
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
	    		'iNguoithem' => $this->__session['iMataikhoan'],
	    	];

	    	$resultCreate = $this->Mtaikhoan->taoTaiKhoan($taiKhoan);

	    	if ($resultCreate) {
	    		setMessage('success', 'Cấp tài khoản thành công');
	    	} else {
	    		setMessage('error', 'Cấp tài khoản nào được ghi nhận');
	    	}
	    	return redirect(base_url('admin/tai-khoan'), 'refresh');
	    }

	    public function thongTinShop($shopId = null)
	    {
	    	if (!$shopId) {
	    		return redirect(base_url('admin/tai-khoan'));
	    	}
	    	$action = $this->input->post('action');
	    	switch ($action) {
	    		case 'duyet':
	    			$resutlAction = $this->Mtaikhoan->setTrangThaiTaiKhoan($shopId, 1);
	    			if ($resutlAction) {
	    				setMessage('success', 'Duyệt thành công');
	    				return redirect(base_url('admin/tai-khoan?phan-loai=2&trang-thai=1'), 'refresh');
	    			} else {
	    				setMessage('error', 'Đã có lỗi xảy ra, vui lòng thử lại sau');
	    				return redirect(base_url('admin/shop/' . $shopId), 'refresh');
	    			}
	    			break;
	    		
	    		default:
	    			// code...
	    			break;
	    	}
	    	$temp['data']['shop']	= $this->Mtaikhoan->getTaiKhoanKhachHang($shopId);
			$temp['template'] 		= 'admin/taikhoan/Vshop';
	    	$this->load->view('layout_admin/Vcontent', $temp);	
	    }
	}

?>