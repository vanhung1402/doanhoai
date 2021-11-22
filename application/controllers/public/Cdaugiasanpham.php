<?php

	class Cdaugiasanpham extends CI_Controller
	{
	    public function __construct()
	    {
	 		parent::__construct();
	 		$this->load->model('public/Mdaugia');
	    }

	 	public function index() {
	 		$maPhien = $this->input->get('phien');
	 		$data = [];
	 		$data['phien'] = $this->Mdaugia->getPhien($maPhien);
	 		if (!$data['phien']) return redirect(base_url(), 'refresh');

	 		$action = $this->input->post('action');
	 		switch ($action) {
	 			case 'get-current-bid':
	 				$this->getCurrentBid($maPhien);
	 				break;
	 			case 'submit-bid':
	 				$this->submitBid($maPhien);
	 				break;
	 			default:
	 				// code...
	 				break;
	 		}

	 		$data['sanpham'] 		= $this->Mdaugia->getChiTietSanPham($data['phien']['iMactsanpham']);
	 		// pr($data['sanpham']);
			$temp['data'] 			= $data;
			$temp['template'] 		= 'public/Vdaugiasanpham';
	    	$this->load->view('layout_public/Vcontent', $temp);	
	 	}   

	 	private function getCurrentBid($maPhien)
	 	{
	 		$thongTinPhien = $this->Mdaugia->getThongTinPhienHienTai($maPhien);
	 		die(json_encode($thongTinPhien));
	 	}

	 	private function submitBid($maPhien)
	 	{
	    	$session = $this->session->userdata('user');
	    	if (!$session) die(json_encode('no_login'));
	    	$chiTiet = [
	    		'iMataikhoan' => $session['iMataikhoan'],
	    		'iMaphiendaugia' => $maPhien,
	    		'dThoigiandaugia' => date('Y-m-d H:i:s'),
	    		'iMucgiadau' => $this->input->post('price'),
	    		'iTrangthaidaugia' => 1,
	    	];
	 		$result = $this->Mdaugia->submitPhien($chiTiet);
	 		die(json_encode($result));
	 	}
	}

?>