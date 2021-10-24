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
	    			'title' 		=> 'tbl_loaihang',
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

	    public function danhMucLoaiHang()
	    {
	    	
	    	$data = [
	    		'route' => [
	    			'title' 		=> 'Danh mục loại hàng',
	    		]
	    	];
	    	$action = $this->input->post('action');
	    	switch ($action) {
	    		case 'them-loai-hang':
	    			$this->themDanhMucLoaiHang();
	    			break;
	    		case 'cap-nhap-loai-hang':
	    			$this->capNhapDanhMucLoaiHang();
	    			break;
	    		case 'xoa-loai-hang':
	    			$this->xoaDanhMucLoaiHang();
	    			break;
	    		
	    		default:
	    			break;
	    	}
	    	if ($iMaloaihang = $this->input->get('id')) {
	    		$data['sua'] = $this->Mloaihang->layDanhMucLoaiHang($iMaloaihang);
	    	}
	    	$data['danhSachLoaiHang'] 	= $this->Mloaihang->danhSachLoaiHang();
	    	$data['danhMucLoaiHang'] 	= $this->Mloaihang->danhMucLoaiHang();
			$temp['data'] 				= $data;
			$temp['template'] 			= 'admin/danhmuc/Vdanhmucloaihang';
	    	$this->load->view('layout_admin/Vcontent', $temp);	
	    }

	    private function themDanhMucLoaiHang()
	    {
	    	$tenLoaiHang = trim($this->input->post('ten-loai-hang'));
	    	$loaiHang = $this->input->post('loai-hang');
	    	$kiemTra = $this->Mloaihang->kiemTraTenDanhMuc($tenLoaiHang, $loaiHang);
	    	if ($kiemTra) {
	    		setMessage('error', 'Tên danh mục loại hàng này đã tồn tại, vui lòng kiểm tra lại');
	    	} else {
	    		$resultCreate = $this->Mloaihang->themDanhMucLoaiHang($tenLoaiHang, $loaiHang);
	    		if ($resultCreate) {
	    			setMessage('success', 'Thêm danh mục loại hàng thành công');
	    		} else {
	    			setMessage('error', 'Không có thay đổi nào được ghi nhận, vui lòng kiểm tra lại');
	    		}
	    	}
	    	return redirect(base_url('admin/danh-muc-loai-hang'), 'refresh');
	    }

	    private function xoaDanhMucLoaiHang()
	    {
	    	$iMaloaihang = $this->input->post('id-xoa');
	    	$resultRemove = $this->Mloaihang->xoaDanhMucLoaiHang($iMaloaihang);
	    	if ($resultRemove) {
    			setMessage('success', 'Xóa danh mục loại hàng thành công');
    		} else {
    			setMessage('error', 'Không có thay đổi nào được ghi nhận, vui lòng kiểm tra lại');
    		}
	    	return redirect(base_url('admin/danh-muc-loai-hang'), 'refresh');
	    }

	    private function capNhapDanhMucLoaiHang()
	    {
	    	$iMaloaihang = $this->input->get('id');
	    	$tenLoaiHang = trim($this->input->post('ten-loai-hang'));
	    	$loaiHang = $this->input->post('loai-hang');
	    	$kiemTra = $this->Mloaihang->kiemTraTen($tenLoaiHang, $loaiHang, $iMaloaihang);
	    	if ($kiemTra) {
	    		setMessage('error', 'Tên danh mục loại hàng không được trùng, vui lòng kiểm tra lại');
	    	} else {
	    		$resultUpdate = $this->Mloaihang->capNhapDanhMucLoaiHang($tenLoaiHang, $loaiHang, $iMaloaihang);
	    		if ($resultUpdate) {
	    			setMessage('success', 'Cập nhập danh mục loại hàng thành công');
	    		} else {
	    			setMessage('error', 'Không có thay đổi nào được ghi nhận, vui lòng kiểm tra lại');
	    		}
	    	}
	    	return redirect(base_url('admin/danh-muc-loai-hang?id=' . $iMaloaihang), 'refresh');
	    }
	}

?>