<?php

	class Ckichthuoc extends MY_Controller
	{
	    public function __construct()
	    {
	        parent::__construct();
	        $this->load->model('admin/danhmuc/Mkichthuoc');
	    }

	    public function index() {
	    	$data = [
	    		'route' => [
	    			'title' 		=> 'Quản lý kích thước',
	    		]
	    	];
	    	$action = $this->input->post('action');
	    	switch ($action) {
	    		case 'them-kich-thuoc':
	    			$this->themKichThuoc();
	    			break;
	    		case 'cap-nhap-kich-thuoc':
	    			$this->capNhapKichThuoc();
	    			break;
	    		case 'xoa-kich-thuoc':
	    			$this->xoaKichThuoc();
	    			break;
	    		
	    		default:
	    			// code...
	    			break;
	    	}
	    	if ($iMasize = $this->input->get('id')) {
	    		$data['sua'] = $this->Mkichthuoc->layKichThuoc($iMasize);
	    	}
	    	$data['danhSachKichThuoc'] = $this->Mkichthuoc->danhSachKichThuoc();
			$temp['data'] 			= $data;
			$temp['template'] 		= 'admin/danhmuc/Vkichthuoc';
	    	$this->load->view('layout_admin/Vcontent', $temp);	
	    }

	    private function themKichThuoc()
	    {
	    	$tenSize = trim($this->input->post('ten-kich-thuoc'));
	    	$kiemTra = $this->Mkichthuoc->kiemTraTen($tenSize);
	    	if ($kiemTra) {
	    		setMessage('error', 'Tên kích thước này đã tồn tại, vui lòng kiểm tra lại');
	    	} else {
	    		$resultCreate = $this->Mkichthuoc->themKichThuoc($tenSize);
	    		if ($resultCreate) {
	    			setMessage('success', 'Thêm kích thước thành công');
	    		} else {
	    			setMessage('error', 'Không có thay đổi nào được ghi nhận, vui lòng kiểm tra lại');
	    		}
	    	}
	    	return redirect(base_url('admin/kich-thuoc'), 'refresh');
	    }

	    private function capNhapKichThuoc()
	    {
	    	$iMasize = $this->input->get('id');
	    	$tenSize = trim($this->input->post('ten-kich-thuoc'));
	    	$kiemTra = $this->Mkichthuoc->kiemTraTen($tenSize, $iMasize);
	    	if ($kiemTra) {
	    		setMessage('error', 'Tên kích thước không được trùng, vui lòng kiểm tra lại');
	    	} else {
	    		$resultUpdate = $this->Mkichthuoc->capNhapKichThuoc($tenSize, $iMasize);
	    		if ($resultUpdate) {
	    			setMessage('success', 'Cập nhập kích thước thành công');
	    		} else {
	    			setMessage('error', 'Không có thay đổi nào được ghi nhận, vui lòng kiểm tra lại');
	    		}
	    	}
	    	return redirect(base_url('admin/kich-thuoc?id=' . $iMasize), 'refresh');
	    }

	    private function xoaKichThuoc()
	    {
	    	$iMasize = $this->input->post('id-xoa');
	    	$resultRemove = $this->Mkichthuoc->xoaKichThuoc($iMasize);
	    	if ($resultRemove) {
    			setMessage('success', 'Xóa kích thước thành công');
    		} else {
    			setMessage('error', 'Không có thay đổi nào được ghi nhận, vui lòng kiểm tra lại');
    		}
	    	return redirect(base_url('admin/kich-thuoc'), 'refresh');
	    }
	}

?>