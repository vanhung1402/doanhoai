<?php

	class Cdonhang extends CI_Controller
	{
	    public function __construct()
	    {
	        parent::__construct();
			$this->__user = $this->session->userdata('user');
			if (!$this->__user || $this->__user['iTrangthai'] == 0) {
				return redirect(base_url(), 'refresh');
			}   
			$this->load->model('public/Mdaugia');
	    }

	    public function index()
	    {
	    	$action = $this->input->post('action');
	    	switch ($action) {
	    		case 'huy-don-hang':
	    			$this->huyDonHang();
	    			break;
	    		case 'doi-trang-thai':
	    			$this->doiTrangThai();
	    			break;
	    		default:
	    			// code...
	    			break;
	    	}
	    	$data = [];
	    	$data['donHang'] 		= $this->Mdaugia->getAllDonHang($this->__user['iManguoidung']);
	        $temp['data'] 			= $data;
			$temp['template'] 		= 'public/Vdonhang';
	    	$this->load->view('layout_public/Vcontent', $temp);	
	    }

	    private function huyDonHang()
	    {
	    	$maDonMua = $this->input->post('maDonMua');
	    	$lyDo = $this->input->post('lyDo');
	    	$result = $this->Mdaugia->huyDonHang($maDonMua, $lyDo, $this->__user['iMataikhoan']);
	    	die(json_encode($result));
	    }

	    private function doiTrangThai()
	    {
	    	$maDonMua = $this->input->post('maDonMua');
	    	$trangThai = $this->input->post('trangThai');
	    	$result = $this->Mdaugia->doiTrangThai($maDonMua, $trangThai);
	    	die(json_encode($result));	
	    }
	}

?>