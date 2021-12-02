<?php

	class Cxemsanpham extends CI_Controller
	{
	    public function __construct()
	    {
	 		parent::__construct();
	 		$this->load->model('public/Mxemsanpham');       
	    }

	    public function index() {
	    	$sp = $this->input->get('sp');
	    	if (!$sp) return redirect(base_url(), 'refresh');

	    	$action = $this->input->post('action');

	    	if ($ma = $this->input->post('an-binh-luan')) {
	    		$this->setTrangThaiBinhLuan($sp, $ma, 2);
	    	} else if ($ma = $this->input->post('hien-binh-luan')) {
	    		$this->setTrangThaiBinhLuan($sp, $ma, 1);
	    	}

	    	switch ($action) {
	    		case 'danh-sach-dau-gia': {
	    			$this->danhSachDauGia();
	    			break;
	    		}
	    		case 'gui-binh-luan':
	    			$this->guiBinhLuan($sp);
	    			break;
	    		default:
	    			// code...
	    			break;
	    	}
	    	$data = [
	    		'sanPham' => $this->Mxemsanpham->getSanPham($sp),
	    		'chiTietSanPham' => $this->Mxemsanpham->getChiTietSanPham($sp),
	    		'hinhAnh' => $this->Mxemsanpham->getHinhAnhSanPham($sp),
	    	];

	    	if (!$data['sanPham']) return redirect('/');
	    	$data['binhLuan'] = $this->Mxemsanpham->getBinhLuan($sp, $data['sanPham']['iNguoithem']);

	    	$mauSac = array_column($data['chiTietSanPham'], 'sTenmausac');
	    	$kichThuoc = array_column($data['chiTietSanPham'], 'sTensize');

	    	$data['mauSac'] = array_unique($mauSac);
	    	$data['kichThuoc'] = array_unique($kichThuoc);

			$temp['data'] 			= $data;
			$temp['template'] 		= 'public/Vxemsanpham';
	    	$this->load->view('layout_public/Vcontent', $temp);	
	    }

	    public function danhSachDauGia() {
	    	$iMasanpham = $this->input->get('sp');
	    	$danhSachDauGiaSanPham = $this->Mxemsanpham->getDanhSachDauGiaSanPham($iMasanpham);
	    	die(json_encode($danhSachDauGiaSanPham));
	    }

	    private function guiBinhLuan($sp)
	    {
	    	$session = $this->session->userdata('user');
	    	$binhLuan = [
	    		'iMataikhoan' => $session['iMataikhoan'],
	    		'iMasanpham' => $sp,
	    		'sNoidungbinhluan' => trim($this->input->post('binh-luan')),
	    		'dThoigianbinhluan' =>  date('Y-m-d H:i:s'),
	    		'iTrangthai' => 1,
	    	];
	    	$result = $this->Mxemsanpham->guiBinhLuan($binhLuan);
	    	if ($result) {
	    		setMessage('success', 'Đã gủi bình luận');
	    	} else {
	    		setMessage('error', 'Không thể gủi bình luận, vui lòng thử lại sau');
	    	}
	    	return redirect(base_url("san-pham?sp=$sp"), 'refresh');
	    }
	    

	    private function setTrangThaiBinhLuan($sp, $ma, $trangThai) {
	    	$result = $this->Mxemsanpham->setTrangThaiBinhLuan($ma, $trangThai);
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