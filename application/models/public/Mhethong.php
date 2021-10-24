<?php 

	class Mhethong extends CI_Model
	{
	    public function __construct()
	    {
			parent::__construct();	        
	    }

	    public function taoTaiKhoan($taiKhoan)
	    {
	    	$this->db->insert('tbl_taikhoan', $taiKhoan);
	    	return $this->db->insert_id();
	    }

	    public function taoNguoiDung($nguoiDung)
	    {
	    	$this->db->insert('tbl_nguoidung', $nguoiDung);
	    	return $this->db->insert_id();	
	    }

	    public function phanQuyenTaiKhoan($quyenTaiKhoan)
	    {
	    	$this->db->insert('tbl_quyen_taikhoan', $quyenTaiKhoan);
	    	return $this->db->affected_rows();
	    }

	    public function dangNhap($taiKhoan)
	    {
	    	$thongTinTaiKhoan = $this->checkTaiKhoan($taiKhoan);
	    	if (!$thongTinTaiKhoan) return false;

	    	$quyenTaiKhoan = $this->checkQuyenTaiKhoan($thongTinTaiKhoan['iMataikhoan']);
			if (!$quyenTaiKhoan) return false;	    	

			$nguoiDung = $this->layThongTinNguoiDung(['iMataikhoan' => $thongTinTaiKhoan['iMataikhoan']]);

			return array_merge($nguoiDung, [
				'sTendangnhap' => $thongTinTaiKhoan['sTendangnhap'],
				'iTrangthai' => $thongTinTaiKhoan['iTrangthai'],
				'iMaquyen' => $quyenTaiKhoan['iMaquyen'],
			]);
	    }

	    public function layThongTinNguoiDung($where)
	    {
	    	$this->db->where($where);
	    	return $this->db->get('tbl_nguoidung')->row_array();
	    }

	    public function checkTaiKhoan($taiKhoan)
	    {
	    	$this->db->where($taiKhoan);
	    	return $this->db->get('tbl_taikhoan')->row_array();
	    }

	    public function checkQuyenTaiKhoan($maTaiKhoan)
	    {
	    	$this->db->where('iMataikhoan', $maTaiKhoan);
	    	$this->db->where('iMaquyen <=', 5);
	    	return $this->db->get('tbl_quyen_taikhoan')->row_array();
	    }

	    public function checkExistEmail($email, $user)
	    {
	    	if ($user) {
	    		$this->db->where('iMataikhoan !=', $user['iMataikhoan']);
	    	}
	    	$this->db->where('sEmail', $email);
	    	return $this->db->get('tbl_nguoidung')->row_array();	
	    }

	    public function checkExistPhone($dienThoai, $user)
	    {
	    	if ($user) {
	    		$this->db->where('iMataikhoan !=', $user['iMataikhoan']);
	    	}
	    	$this->db->where('sSodienthoai', $dienThoai);
	    	return $this->db->get('tbl_nguoidung')->row_array();	
	    }

	    public function checkExistCMND($cmnd, $user)
	    {
	    	if ($user) {
	    		$this->db->where('iMataikhoan !=', $user['iMataikhoan']);
	    	}
	    	$this->db->where('iSoCCCD', $cmnd);
	    	return $this->db->get('tbl_nguoidung')->row_array();	
	    }

	    public function capNhapNguoiDung($nguoiDung, $iManguoidung)
	    {
	    	$this->db->where('iManguoidung', $iManguoidung);
	    	$this->db->update('tbl_nguoidung', $nguoiDung);
	    	return $this->db->affected_rows();
	    }

	    public function doiMatKhau($matKhauMoi, $iMataikhoan)
	    {
	    	$this->db->where('iMataikhoan', $iMataikhoan);
	    	$this->db->update('tbl_taikhoan', ['sMatkhau' => $matKhauMoi]);
	    	return $this->db->affected_rows();
	    }


	    public function danhMucLoaiHang()
	    {
	    	$this->db->select('dmlh.*, lh.*');
	    	$this->db->from('tbl_danhmucloaihang dmlh');
	    	$this->db->join('tbl_loaihang lh', 'dmlh.iMaloaihang = lh.iMaloaihang', 'inner');
	    	$this->db->group_by('dmlh.iMadanhmuclh');
	    	return $this->db->get()->result_array();
	    }

	    public function danhSachMauSac()
	    {
	    	return $this->db->get('tbl_mausac')->result_array();
	    }
	    
	    public function danhSachKichThuoc()
	    {
	    	return $this->db->get('tbl_kichthuoc')->result_array();
	    }

	    public function themSanPham($sanPham, $chiTiet)
	    {
	    	$session = $this->session->userdata('user');
	    	$sanPham['iNguoithem'] = $session['iManguoidung'];
	    	$this->db->insert('tbl_sanpham', $sanPham);
	    	$maSanPham = $this->db->insert_id();

	    	if ($maSanPham && sizeof($chiTiet) > 0) {
	    		$chiTietSanPham = [];
	    		foreach ($chiTiet as $ct) {
	    			$ct['iMasanpham'] = $maSanPham;
	    			$chiTietSanPham[] = $ct;
	    		}
	    		$resultChiTiet = $this->db->insert_batch('tbl_ct_sanpham', $chiTietSanPham);
	    		return $resultChiTiet;
	    	}

	    	return $resultSanPham;
	    }

	    public function danhSachSanPham($where)
	    {
	    	$this->db->select('sp.*, sTendanhmuclh, count(ct.iMasanpham) as soChiTiet');
	    	$this->db->from('tbl_sanpham sp');
	    	$this->db->join('tbl_danhmucloaihang dm', 'sp.iMadanhmuclh = dm.iMadanhmuclh', 'inner');
	    	$this->db->join('tbl_ct_sanpham ct', 'sp.iMasanpham = ct.iMasanpham', 'left');
	    	$this->db->group_by('sp.iMasanpham');
	    	return $this->db->get()->result_array();
	    }

	    public function xoaSanPham($maSanPham)
	    {
	    	$this->db->where('iMasanpham', $maSanPham);
	    	$this->db->delete('tbl_sanpham');
	    	return $this->db->affected_rows();
	    }

	    public function laySanPham($maSanPham)
	    {
	    	$session = $this->session->userdata('user');
	    	$this->db->where('iMasanpham', $maSanPham);
	    	$this->db->where('iNguoithem', $session['iManguoidung']);
	    	$sanPham = $this->db->get('tbl_sanpham')->row_array();

	    	$this->db->select('ctsp.*, iMaphiendaugia');
	    	$this->db->from('tbl_ct_sanpham ctsp');
	    	$this->db->join('tbl_ct_phiendaugia ctp', 'ctsp.iMactsanpham = ctp.iMactsanpham', 'left');
	    	$this->db->where('iMasanpham', $maSanPham);
	    	$this->db->group_by('iMactsanpham');
	    	$chiTiet = $this->db->get()->result_array();

	    	return [
	    		'sanPham' => $sanPham,
	    		'chiTiet' => $chiTiet,
	    	];
	    }

	    public function suaSanPham($maSanPham, $sanPhamSua, $chiTietThemMoi, $chiTietSuaDoi, $chiTietBiXoa)
	    {
	    	$this->db->where('iMasanpham', $maSanPham);
	    	$this->db->update('tbl_sanpham', $sanPhamSua);
	    	$count = 0;

	    	if ($chiTietBiXoa) {
		    	$this->db->where_in('iMactsanpham', $chiTietBiXoa);
		    	$this->db->delete('tbl_ct_sanpham');	
		    	$count += $this->db->affected_rows();
	    	}

	    	if ($chiTietThemMoi) {
	    		$this->db->insert_batch('tbl_ct_sanpham', $chiTietThemMoi);	
		    	$count += $this->db->affected_rows();
	    	}
	    	if ($chiTietSuaDoi) {
	    		$this->db->update_batch('tbl_ct_sanpham', $chiTietSuaDoi, 'iMactsanpham');	
		    	$count += $this->db->affected_rows();
	    	}

	    	return $count;
	    }
	}

?>