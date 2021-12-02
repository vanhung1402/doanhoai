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
	    	if (!$sp) return redirect(base_url(), 'refresh');

	    	if ($ma = $this->input->post('an-binh-luan')) {
	    		$this->setTrangThaiBinhLuan($sp, $ma, 2);
	    	} else if ($ma = $this->input->post('hien-binh-luan')) {
	    		$this->setTrangThaiBinhLuan($sp, $ma, 1);
	    	}

	    	$action = $this->input->post('action');
	    	switch ($action) {
	    		case 'set-dau-gia':
	    			$this->setDauGia();
	    			break;
	    		case 'update-dau-gia':
	    			$this->updateDauGia();
	    			break;
	    		case 'danh-sach-dau-gia': {
	    			$this->danhSachDauGia();
	    			break;
	    		}
	    		case 'check-trung-thoi-gian':
	    			$this->checkTrungGio();
	    			break;
	    		default:
	    			// code...
	    			break;
	    	}

	    	$data = [
	    		'sanPham' => $this->Msanpham->getSanPham($sp),
	    		'chiTietSanPham' => $this->Msanpham->getChiTietSanPham($sp),
	    		'hinhAnh' => $this->Msanpham->getHinhAnhSanPham($sp),
	    		'binhLuan' => $this->Msanpham->getBinhLuan($sp),
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
	    private function checkTrungGio()
	    {
	    	$start = $this->input->post('start');
	    	$end = $this->input->post('end');
	    	$chiTiet = $this->input->post('chiTiet');
	    	$result = $this->Msanpham->checkTrungGio($start, $end, $chiTiet);
	    	die(json_encode($result));
	    }
	    public function setDauGia() {
	    	$dauGia = $this->input->post('dauGia');
	    	$result = $this->Msanpham->setDauGia($dauGia);
	    	die(json_encode($result));
	    }

	    public function updateDauGia() {
	    	$dauGia = $this->input->post('dauGia');
	    	$maPhien = $dauGia['iMaphiendaugia'];
	    	unset($dauGia['iMaphiendaugia']);
	    	$result = $this->Msanpham->updateDauGia($dauGia, $maPhien);
	    	die(json_encode($result));
	    }

	    public function danhSachDauGia() {
	    	$iMasanpham = $this->input->get('sp');
	    	$danhSachDauGiaSanPham = $this->Msanpham->getDanhSachDauGiaSanPham($iMasanpham);
	    	die(json_encode($danhSachDauGiaSanPham));
	    }

	    private function setTrangThaiBinhLuan($sp, $ma, $trangThai) {
	    	$result = $this->Msanpham->setTrangThaiBinhLuan($ma, $trangThai);
	    	$action = $trangThai == 1 ? 'Hiện' : 'Ẩn';
	    	if ($result) {
	    		setMessage('success', $action . ' bình luận thanh công.');
	    	} else {
	    		setMessage('error', $action . ' bình luận thanh công.');
	    	}
	    	return redirect(base_url("dau-gia/san-pham?sp=$sp"), 'refresh');
	    }
	}

?>