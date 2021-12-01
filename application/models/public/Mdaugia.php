<?php

	class Mdaugia extends CI_Model
	{
	    /**
	     * summary
	     */
	    public function __construct()
	    {
	        parent::__construct();
	    }

	    public function getAuctua($start, $end, $limit) {
	    	$this->db->limit($limit);
	    	$this->db->select('pdg.iMaphiendaugia, sp.iMasanpham, sTensanpham, sTenmausac, sTensize, dThoigianketthuc, iGiakhoidiem, max(iMucgiadau) as giaHientai');
	    	$this->db->from('tbl_phiendaugia pdg');
	    	$this->db->join('tbl_ct_sanpham ctsp', 'pdg.iMactsanpham = ctsp.iMactsanpham', 'inner');
	    	$this->db->join('tbl_sanpham sp', 'ctsp.iMasanpham = sp.iMasanpham', 'inner');
	    	$this->db->join('tbl_mausac ms', 'ctsp.iMamausac = ms.iMamausac', 'inner');
	    	$this->db->join('tbl_kichthuoc kt', 'ctsp.iMasize = kt.iMasize', 'inner');
	    	$this->db->join('tbl_ct_phiendaugia ctp', 'pdg.iMaphiendaugia = ctp.iMaphiendaugia', 'left');
	    	$this->db->where('dThoigianbatdau <=', $start);
	    	$this->db->where('dThoigianketthuc >=', $end);
	    	$this->db->order_by('dThoigianketthuc');
	    	$this->db->group_by('pdg.iMaphiendaugia');
	    	$phien = $this->db->get()->result_array();
	    	$arrayMaSanPham = array_column($phien, 'iMasanpham');

	    	return [
	    		'listPhien' => $phien,
	    		'tongPhien' => $this->getSoPhien($start, $end),
	    		'hinhAnh' 	=> $this->getHinhAnhSanPham($arrayMaSanPham),
	    	];
	    }

	    public function lichSu($maPhien)
	    {
	    	$this->db->select('ctp.*, sTennguoidung, DATE_FORMAT(dThoigiandaugia, "%H:%i:%s %d/%m/%Y") as tThoigian');
	    	$this->db->from('tbl_ct_phiendaugia ctp');
	    	$this->db->join('tbl_nguoidung nd', 'ctp.iMataikhoan = nd.iMataikhoan', 'inner');
	    	$this->db->where('iMaphiendaugia', $maPhien);
	    	$this->db->order_by('dThoigiandaugia', 'desc');
	    	return $this->db->get()->result_array();
	    }

	    public function getHinhAnhSanPham($arrayMaSanPham) {
	    	if (!$arrayMaSanPham) return null;
	    	$this->db->where([
	    		'iTrangthai' => 1,
	    	]);
	    	$this->db->where_in('iMasanpham', $arrayMaSanPham);
	    	$this->db->order_by('iMahinhanh');
		    $arrayResult = $this->db->get('tbl_hinhanh_sanpham')->result_array();
		    $anhSanPham = [];
		    foreach ($arrayResult as $anh) {
		    	if (!isset($anhSanPham[$anh['iMasanpham']])) $anhSanPham[$anh['iMasanpham']] = [];
		    	$anhSanPham[$anh['iMasanpham']][] = $anh;
		    }
		    return $anhSanPham;
	    }

	    public function getSoPhien($start, $end) {
			$this->db->select('count(iMaphiendaugia) as tongPhien');
	    	$this->db->from('tbl_phiendaugia pdg');
	    	$this->db->where('dThoigianbatdau <=', $start);
	    	$this->db->where('dThoigianketthuc >=', $end);
	    	return $this->db->get()->row_array();
	    }

	    public function getChiTietSanPham($ctsp)
	    {
	    	$this->db->select('sp.iMasanpham, sTenmausac, sTensize, sTensanpham, sMota, sChatlieu, sTinhtrang, sVideo, sTendanhmuclh, sp.iNguoithem, sTenshop, sTenthuonghieu');
	    	$this->db->from('tbl_ct_sanpham ctsp');
	    	$this->db->join('tbl_sanpham sp', 'ctsp.iMasanpham = sp.iMasanpham', 'inner');
	    	$this->db->join('tbl_danhmucloaihang dmlh', 'sp.iMadanhmuclh = dmlh.iMadanhmuclh', 'inner');
	    	$this->db->join('tbl_mausac ms', 'ctsp.iMamausac = ms.iMamausac', 'inner');
	    	$this->db->join('tbl_kichthuoc kt', 'ctsp.iMasize = kt.iMasize', 'inner');
	    	$this->db->where('iMactsanpham', $ctsp);
	    	$sanpham = $this->db->get()->row_array();
	    	if (!$sanpham) return null;
	    	$hinhAnh = $this->getHinhAnhSanPham($sanpham['iMasanpham']);
	    	$sanpham['hinhAnh'] = $hinhAnh[$sanpham['iMasanpham']];
	    	return $sanpham;
	    }

	    public function getPhien($maPhien)
	    {
	    	$this->db->from('tbl_phiendaugia');
	    	$this->db->where('iMaphiendaugia', $maPhien);
	    	return $this->db->get()->row_array();
	    }

	    public function getThongTinPhienHienTai($maPhien) {
	    	$this->db->limit(1);
	    	$this->db->select('iMucgiadau, sTennguoidung, ctp.iMataikhoan, DATE_FORMAT(dThoigiandaugia, "%H:%i:%s %d/%m/%Y") as tThoigian');
	    	$this->db->from('tbl_ct_phiendaugia ctp');
	    	$this->db->join('tbl_nguoidung nd', 'ctp.iMataikhoan = nd.iMataikhoan', 'inner');
	    	$this->db->where('ctp.iMaphiendaugia', $maPhien);
	    	$this->db->order_by('iMucgiadau', 'desc');
	    	return $this->db->get()->row_array();
	    }

	    public function submitPhien($chiTiet)
	    {
	    	$this->db->insert('tbl_ct_phiendaugia', $chiTiet);
	    	return $this->db->affected_rows();
	    }

	    public function getCartUser($taiKhoan)
	    {
	    	$temp = $this->getUserBidsNull($taiKhoan);
	    	$userBidsNull = [];
	    	$bidIds = [];
	    	foreach ($temp as $bid) {
	    		$bidIds[] = $bid['iMaphiendaugia'];
	    		$userBidsNull[$bid['iMaphiendaugia']] = $bid;
	    	}

	    	$bidsWin = $this->getBidsWin($bidIds);
	    	$arrayMaSanPham = array_column($userBidsNull, 'iMasanpham');
	    	$hinhAnh = $this->getHinhAnhSanPham($arrayMaSanPham);
	    	if ($bidsWin) {
		    	foreach ($bidsWin as $bid) {
		    		if ($userBidsNull[$bid['iMaphiendaugia']]['iMucgiadau'] != $bid['iGiathang']) {
		    			unset($userBidsNull[$bid['iMaphiendaugia']]);
		    		} else {
		    			$anh = isset($hinhAnh[$userBidsNull[$bid['iMaphiendaugia']]['iMasanpham']]) ? $hinhAnh[$userBidsNull[$bid['iMaphiendaugia']]['iMasanpham']] : [];
		    			$userBidsNull[$bid['iMaphiendaugia']]['hinhAnh'] = $anh;
		    		}
		    	}
	    	}
	    	return $userBidsNull;
	    }

	    public function getBidsWin($bidIds)
	    {
	    	if (!$bidIds) return null;
	    	$this->db->select('ctp.iMaphiendaugia, MAX(iMucgiadau) iGiathang');
	    	$this->db->from('tbl_ct_phiendaugia ctp');
	    	$this->db->join('tbl_phiendaugia pdg', 'ctp.iMaphiendaugia = pdg.iMaphiendaugia', 'inner');
	    	$this->db->where_in('ctp.iMaphiendaugia', $bidIds);
	    	$this->db->where('dThoigianketthuc < NOW()');
	    	$this->db->group_by('ctp.iMaphiendaugia');
	    	return $this->db->get()->result_array();
	    }

	    public function getUserBidsNull($taiKhoan) {
	    	$this->db->select('sp.iMasanpham, sTenmausac, sTensize, sTensanpham, ctp.iMaphiendaugia, MAX(iMucgiadau) iMucgiadau, nd.iManguoidung, sTenshop');
	    	$this->db->from('tbl_ct_phiendaugia ctp');
	    	$this->db->join('tbl_phiendaugia pdg', 'ctp.iMaphiendaugia = pdg.iMaphiendaugia', 'inner');
	    	$this->db->join('tbl_ct_sanpham ctsp', 'pdg.iMactsanpham = ctsp.iMactsanpham', 'inner');
	    	$this->db->join('tbl_sanpham sp', 'ctsp.iMasanpham = sp.iMasanpham', 'inner');
	    	$this->db->join('tbl_nguoidung nd', 'sp.iNguoithem = nd.iManguoidung', 'left');
	    	$this->db->join('tbl_danhmucloaihang dmlh', 'sp.iMadanhmuclh = dmlh.iMadanhmuclh', 'inner');
	    	$this->db->join('tbl_mausac ms', 'ctsp.iMamausac = ms.iMamausac', 'inner');
	    	$this->db->join('tbl_kichthuoc kt', 'ctsp.iMasize = kt.iMasize', 'inner');
	    	$this->db->where('iMadonmua', NULL);
	    	$this->db->where('ctp.iMataikhoan', $taiKhoan);
	    	$this->db->where('dThoigianketthuc < NOW()');
	    	$this->db->order_by('iMucgiadau', 'desc');
	    	$this->db->group_by('ctp.iMaphiendaugia');
	    	return $this->db->get()->result_array();
	    }

	    public function taoDonHang($donHang, $chiTiet)
	    {
	    	$this->db->insert('tbl_donmuahang', $donHang);
	    	$id = $this->db->insert_id();
	    	if ($id) {
	    		$session = $this->session->userdata('user');
	    		$affected_rows = 0;
	    		foreach ($chiTiet as $ct) {
	    			$chiTietDon = [
	    				'iMataikhoan' => $session['iMataikhoan'],
	    				'iMaphiendaugia' => $ct['iMaphiendaugia'],
	    				'iMucgiadau' => $ct['iMucgiadau'],
	    			];
	    			$affected_rows += $this->setChiTietDon($chiTietDon, $id);
	    		}
	    		return $affected_rows;
	    	}
	    	return $id;
	    }

	    public function setChiTietDon($chiTiet, $donHangId)
	    {
			$this->db->where($chiTiet);
			$this->db->update('tbl_ct_phiendaugia', ['iMadonmua' => $donHangId]);
			return $this->db->affected_rows();
	    }

	    public function getAllDonMua($iMataikhoan)
	    {
	    	$where = [
	    		'ctp.iMataikhoan' => $iMataikhoan,
	    	];
	    	$this->db->select('ctp.*, dmh.*, sp.iMasanpham, sTenmausac, sTensanpham, sTensize, DATE_FORMAT(dThoigianlap, "%H:%i %d/%m/%Y") as tThoigianlap, sNguoimuahuy, sNguoibanhuy, sTenshop');
	    	$this->db->from('tbl_ct_phiendaugia ctp');
	    	$this->db->join('tbl_donmuahang dmh', 'ctp.iMadonmua = dmh.iMadonmua', 'inner');
	    	$this->db->join('tbl_phiendaugia pdg', 'ctp.iMaphiendaugia = pdg.iMaphiendaugia', 'inner');
	    	$this->db->join('tbl_ct_sanpham ctsp', 'pdg.iMactsanpham = ctsp.iMactsanpham', 'inner');
	    	$this->db->join('tbl_sanpham sp', 'ctsp.iMasanpham = sp.iMasanpham', 'inner');
	    	$this->db->join('tbl_mausac ms', 'ctsp.iMamausac = ms.iMamausac', 'inner');
	    	$this->db->join('tbl_kichthuoc kt', 'ctsp.iMasize = kt.iMasize', 'inner');
	    	$this->db->join('tbl_nguoidung nd', 'sp.iNguoithem = nd.iManguoidung', 'inner');
	    	$this->db->where($where);
	    	$this->db->where('ctp.iMadonmua IS NOT NULL');
	    	$this->db->order_by('dThoigianlap', 'desc');
	    	$donHang = $this->db->get()->result_array();
	    	if (!$donHang) return null;
	    	$arrayMaSanPham = array_column($donHang, 'iMasanpham');
	    	$getHinhAnhSanPham = $this->getHinhAnhSanPham($arrayMaSanPham);

	    	foreach ($donHang as $key => $dh) {
	    		$donHang[$key]['hinhAnh'] = $getHinhAnhSanPham[$dh['iMasanpham']];
	    	}

	    	$mapDonHang = handingArrayToMap($donHang, 'iMadonmua');
	    	return $mapDonHang;
	    }

	    public function getAllDonHang($iManguoidung)
	    {
	    	$where = [
	    		'sp.iNguoithem' => $iManguoidung,
	    	];
	    	$this->db->select('ctp.*, dmh.*, sp.iMasanpham, sTenmausac, sTensanpham, sTensize, DATE_FORMAT(dThoigianlap, "%H:%i %d/%m/%Y") as tThoigianlap, sTennguoidung as nguoiMua, sNguoimuahuy, sNguoibanhuy');
	    	$this->db->from('tbl_ct_phiendaugia ctp');
	    	$this->db->join('tbl_donmuahang dmh', 'ctp.iMadonmua = dmh.iMadonmua', 'inner');
	    	$this->db->join('tbl_phiendaugia pdg', 'ctp.iMaphiendaugia = pdg.iMaphiendaugia', 'inner');
	    	$this->db->join('tbl_ct_sanpham ctsp', 'pdg.iMactsanpham = ctsp.iMactsanpham', 'inner');
	    	$this->db->join('tbl_sanpham sp', 'ctsp.iMasanpham = sp.iMasanpham', 'inner');
	    	$this->db->join('tbl_mausac ms', 'ctsp.iMamausac = ms.iMamausac', 'inner');
	    	$this->db->join('tbl_kichthuoc kt', 'ctsp.iMasize = kt.iMasize', 'inner');
	    	$this->db->join('tbl_nguoidung nd', 'ctp.iMataikhoan = nd.iMataikhoan', 'inner');
	    	$this->db->where($where);
	    	$this->db->where('ctp.iMadonmua IS NOT NULL');
	    	$this->db->order_by('dThoigianlap', 'desc');
	    	$donHang = $this->db->get()->result_array();
	    	if (!$donHang) return null;
	    	$arrayMaSanPham = array_column($donHang, 'iMasanpham');
	    	$getHinhAnhSanPham = $this->getHinhAnhSanPham($arrayMaSanPham);

	    	foreach ($donHang as $key => $dh) {
	    		$donHang[$key]['hinhAnh'] = $getHinhAnhSanPham[$dh['iMasanpham']];
	    	}

	    	$mapDonHang = handingArrayToMap($donHang, 'iMadonmua');
	    	return $mapDonHang;
	    }

	    public function huyDonMua($maDonMua, $lyDo, $iMataikhoan)
	    {
	    	$this->db->select('ctp.iMadonmua');
	    	$this->db->from('tbl_donmuahang dmh');
	    	$this->db->join('tbl_ct_phiendaugia ctp', 'dmh.iMadonmua = ctp.iMadonmua', 'inner');
	    	$this->db->where([
	    		'ctp.iMadonmua' => $maDonMua,
	    		'ctp.iMataikhoan' => $iMataikhoan
	    	]);
	    	$donMua = $this->db->get()->row_array();
	    	if (!$donMua) return null;
	    	$this->db->where('iMadonmua', $maDonMua);
	    	$this->db->update('tbl_donmuahang', [
	    		'iTrangthai' => 5,
	    		'sNguoimuahuy' => $lyDo,
	    	]);
	    	return $this->db->affected_rows();
	    }


	    public function huyDonHang($maDonMua, $lyDo, $iMataikhoan)
	    {
	    	$this->db->where('iMadonmua', $maDonMua);
	    	$this->db->update('tbl_donmuahang', [
	    		'iTrangthai' => 5,
	    		'sNguoibanhuy' => $lyDo,
	    	]);
	    	return $this->db->affected_rows();
	    }

	    public function doiTrangThai($maDonMua, $trangThai)
	    {
	    	$this->db->where([
	    		'iMadonmua' => $maDonMua,
	    		'iTrangthai !=' => 5,
	    	]);
	    	$this->db->update('tbl_donmuahang', [
	    		'iTrangthai' => $trangThai
	    	]);
	    	return $this->db->affected_rows();
	    }
	}

?>