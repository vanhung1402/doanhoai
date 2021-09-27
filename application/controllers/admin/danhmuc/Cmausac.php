<?php

	class CMausac extends MY_Controller
	{
	    public function __construct()
	    {
	        parent::__construct();
	        $this->load->model('admin/danhmuc/Mmausac');
	    }

	    public function index() {
	    	$data = [
	    		'route' => [
	    			'title' 		=> 'Quản lý màu sắc',
	    		]
	    	];
	    	$action = $this->input->post('action');
	    	switch ($action) {
	    		case 'them-mau-sac':
	    			$this->themMauSac();
	    			break;
	    		case 'cap-nhap-mau-sac':
	    			$this->capNhapMauSac();
	    			break;
	    		case 'xoa-mau-sac':
	    			$this->xoaMauSac();
	    			break;
	    		
	    		default:
	    			// code...
	    			break;
	    	}
	    	if ($iMamausac = $this->input->get('id')) {
	    		$data['sua'] = $this->Mmausac->layMauSac($iMamausac);
	    	}
	    	$data['danhSachMauSac'] = $this->Mmausac->danhSachMauSac();
			$temp['data'] 			= $data;
			$temp['template'] 		= 'admin/danhmuc/Vmausac';
	    	$this->load->view('layout_admin/Vcontent', $temp);	
	    }

	    private function themMauSac()
	    {
	    	$tenMauSac = trim($this->input->post('ten-mau-sac'));
	    	$kiemTra = $this->Mmausac->kiemTraTen($tenMauSac);
	    	if ($kiemTra) {
	    		setMessage('error', 'Tên màu sắc này đã tồn tại, vui lòng kiểm tra lại');
	    	} else {
	    		$resultCreate = $this->Mmausac->themMauSac($tenMauSac);
	    		if ($resultCreate) {
	    			setMessage('success', 'Thêm màu sắc thành công');
	    		} else {
	    			setMessage('error', 'Không có thay đổi nào được ghi nhận, vui lòng kiểm tra lại');
	    		}
	    	}
	    	return redirect(base_url('admin/mau-sac'), 'refresh');
	    }

	    private function capNhapMauSac()
	    {
	    	$iMamausac = $this->input->get('id');
	    	$tenMauSac = trim($this->input->post('ten-mau-sac'));
	    	$kiemTra = $this->Mmausac->kiemTraTen($tenMauSac, $iMamausac);
	    	if ($kiemTra) {
	    		setMessage('error', 'Tên màu sắc không được trùng, vui lòng kiểm tra lại');
	    	} else {
	    		$resultUpdate = $this->Mmausac->capNhapMauSac($tenMauSac, $iMamausac);
	    		if ($resultUpdate) {
	    			setMessage('success', 'Cập nhập màu sắc thành công');
	    		} else {
	    			setMessage('error', 'Không có thay đổi nào được ghi nhận, vui lòng kiểm tra lại');
	    		}
	    	}
	    	return redirect(base_url('admin/mau-sac?id=' . $iMamausac), 'refresh');
	    }

	    private function xoaMauSac()
	    {
	    	$iMamausac = $this->input->post('id-xoa');
	    	$resultRemove = $this->Mmausac->xoaMauSac($iMamausac);
	    	if ($resultRemove) {
    			setMessage('success', 'Xóa màu sắc thành công');
    		} else {
    			setMessage('error', 'Không có thay đổi nào được ghi nhận, vui lòng kiểm tra lại');
    		}
	    	return redirect(base_url('admin/mau-sac'), 'refresh');
	    }
	}

?>