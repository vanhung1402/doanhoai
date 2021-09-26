<?php

	class Cprofile extends CI_Controller
	{
		private $__user;
	    public function __construct()
	    {
			parent::__construct();
			$this->__user = $this->session->userdata('user');
			if (!$this->__user || $this->__user['iTrangthai'] == 0) {
				return redirect(base_url(), 'refresh');
			}
			$this->load->model('public/Mhethong');
	    }

	    public function index()
	    {
	    	$action = $this->input->post('action');
	    	switch ($action) {
	    		case 'cap-nhap-shop':
	    			$this->capNhapShop();
	    			break;
	    		
	    		case 'doi-mat-khau':
	    			$this->doiMatKhau();
	    			break;
	    		
	    		default:
	    			// code...
	    			break;
	    	}
	    	$data = [];
	    	if ($this->__user['iPhanloai'] == 2) {
	    		$taiKhoan = [
		    		'sTendangnhap' => $this->__user['sTendangnhap'],
		    	];
	    		$data['nguoiBan'] 	= $this->Mhethong->dangNhap($taiKhoan);
	    	}
			$temp['data'] 			= $data;
			$temp['template'] 		= 'public/Vprofile';
	    	$this->load->view('layout_public/Vcontent', $temp);	
	    }

	    public function doiMatKhau()
	    {
	    	$matKhauMoi = sha1($this->input->post('new_password'));
	    	$resultUpdate = $this->Mhethong->doiMatKhau($matKhauMoi, $this->__user['iMataikhoan']);
	    	if ($resultUpdate) {
	    		setMessage('success', 'Cập nhập thành công');
	    	} else {
	    		setMessage('error', 'Không có cập nhập nào được ghi nhận');
	    	}
	    	return redirect(base_url('profile'), 'refresh');
	    }

	    public function capNhapShop()
	    {
	    	if ($this->input->post('logoshop')) {
		    	$fileLogo = $this->uploadFile('logoshop', 'shop/logo/');
		    	if (isset($fileLogo['error'])) {
		    		setMessage('error', 'File logo shop có vấn đề, vui lòng thử lại');
		    		return redirect(base_url('profile'), 'refresh');
		    	}	
	    	} else {
	    		$fileLogo['success']['filename'] = null;
	    	}
	    	if ($this->input->post('giayphep')) {
	    	
	    	$fileGiayPhep = $this->uploadFile('giayphep', 'shop/giayphep/');
		    	if (isset($fileGiayPhep['error'])) {
		    		setMessage('error', 'File giấy phép có vấn đề, vui lòng thử lại');
		    		return redirect(base_url('profile'), 'refresh');
		    	}
	    	} else {
	    		$fileGiayPhep['success']['filename'] = null;
	    	}

	    	$shop = [
	    		'sTenshop' => $this->input->post('tenshop'),
	    		'sMotashop' => $this->input->post('mota'),
	    		'sMotahinhanh' => $fileLogo['success']['filename'],
	    		'sGiayphepkinhdoanh' => $fileGiayPhep['success']['filename'],
	    	];

	    	$resultUpdate = $this->Mhethong->capNhapNguoiDung($shop, $this->__user['iManguoidung']);
	    	if ($resultUpdate) {
	    		setMessage('success', 'Cập nhập thành công');
	    	} else {
	    		setMessage('error', 'Không có cập nhập nào được ghi nhận');
	    	}
	    	return redirect(base_url('profile'), 'refresh');
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
	}

?>