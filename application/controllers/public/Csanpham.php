<?php

	class Csanpham extends CI_Controller
	{
	    public function __construct()
	    {
	 		parent::__construct();
	 		$this->load->model('public/Msanpham');       
	    }

	    public function index() {
	    	$sp = $this->input->get('sp');
	    	if (!$sp) return redirect('/');

	    	$action = $this->input->post('action');
	    	switch ($action) {
	    		case 'set-dau-gia':
	    			$this->setDauGia();
	    			break;
	    		
	    		default:
	    			// code...
	    			break;
	    	}

	    	$data = [
	    		'sanPham' => $this->Msanpham->getSanPham($sp),
	    		'chiTietSanPham' => $this->Msanpham->getChiTietSanPham($sp),
	    	];

	    	if (!$data['sanPham']) return redirect('/');

	    	$mauSac = array_column($data['chiTietSanPham'], 'sTenmausac');
	    	$kichThuoc = array_column($data['chiTietSanPham'], 'sTensize');

	    	$data['mauSac'] = array_unique($mauSac);
	    	$data['kichThuoc'] = array_unique($kichThuoc);

			$temp['data'] 			= $data;
			$temp['template'] 		= 'public/Vsanpham';
	    	$this->load->view('layout_public/Vcontent', $temp);	
	    }
	    public function setDauGia() {
	    	$dauGia = $this->input->post('dauGia');
	    	$result = $this->Msanpham->setDauGia($dauGia);
	    	die(json_encode($result));
	    }
	}

?>