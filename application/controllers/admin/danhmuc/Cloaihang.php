<?php

	class Cloaihang extends MY_Controller
	{
	    public function __construct()
	    {
	        parent::__construct();
	        $this->load->model('admin/danhmuc/Mloaihang');
	    }

	    public function index() {
	    	$data = [
	    		'route' => [
	    			'title' 		=> 'Quản lý loại hàng',
	    		]
	    	];
	    	$action = $this->input->post('action');
	    	switch ($action) {
	    		case 'them-loai-hang':
	    			$this->themLoaiHang();
	    			break;
	    		case 'cap-nhap-loai-hang':
	    			$this->capNhapLoaiHang();
	    			break;
	    		case 'xoa-loai-hang':
	    			$this->xoaLoaiHang();
	    			break;
	    		
	    		default:
	    			// code...
	    			break;
	    	}
	    	if ($iMaloaihang = $this->input->get('id')) {
	    		$data['sua'] = $this->Mloaihang->layLoaiHang($iMaloaihang);
	    	}
	    	$data['danhSachLoaiHang'] = $this->Mloaihang->danhSachLoaiHang();
			$temp['data'] 			= $data;
			$temp['template'] 		= 'admin/danhmuc/Vloaihang';
	    	$this->load->view('layout_admin/Vcontent', $temp);	
	    }

	    private function themLoaiHang()
	    {
	    	$tenLoaiHang = trim($this->input->post('ten-loai-hang'));
	    	$kiemTra = $this->Mloaihang->kiemTraTen($tenLoaiHang);
	    	if ($kiemTra) {
	    		setMessage('error', 'Tên loại hàng này đã tồn tại, vui lòng kiểm tra lại');
	    	} else {
	    		$resultCreate = $this->Mloaihang->themLoaiHang($tenLoaiHang);
	    		if ($resultCreate) {
	    			setMessage('success', 'Thêm loại hàng thành công');
	    		} else {
	    			setMessage('error', 'Không có thay đổi nào được ghi nhận, vui lòng kiểm tra lại');
	    		}
	    	}
	    	return redirect(base_url('admin/loai-hang'), 'refresh');
	    }

	    private function capNhapLoaiHang()
	    {
	    	$iMaloaihang = $this->input->get('id');
	    	$tenLoaiHang = trim($this->input->post('ten-loai-hang'));
	    	$kiemTra = $this->Mloaihang->kiemTraTen($tenLoaiHang, $iMaloaihang);
	    	if ($kiemTra) {
	    		setMessage('error', 'Tên loại hàng không được trùng, vui lòng kiểm tra lại');
	    	} else {
	    		$resultUpdate = $this->Mloaihang->capNhapLoaiHang($tenLoaiHang, $iMaloaihang);
	    		if ($resultUpdate) {
	    			setMessage('success', 'Cập nhập loại hàng thành công');
	    		} else {
	    			setMessage('error', 'Không có thay đổi nào được ghi nhận, vui lòng kiểm tra lại');
	    		}
	    	}
	    	return redirect(base_url('admin/loai-hang?id=' . $iMaloaihang), 'refresh');
	    }

	    private function xoaLoaiHang()
	    {
	    	$iMaloaihang = $this->input->post('id-xoa');
	    	$resultRemove = $this->Mloaihang->xoaLoaiHang($iMaloaihang);
	    	if ($resultRemove) {
    			setMessage('success', 'Xóa loại hàng thành công');
    		} else {
    			setMessage('error', 'Không có thay đổi nào được ghi nhận, vui lòng kiểm tra lại');
    		}
	    	return redirect(base_url('admin/loai-hang'), 'refresh');
	    }
	}

?>