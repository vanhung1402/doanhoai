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

	    public function getHinhAnhSanPham($arrayMaSanPham) {
	    	if (!$arrayMaSanPham) return null;
	    	$this->db->where([
	    		'iTrangthai' => 1,
	    	]);
	    	$this->db->where_in('iMasanpham', $arrayMaSanPham);
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
	    	$this->db->select('sp.iMasanpham, sTenmausac, sTensize, sTensanpham, sMota, sChatlieu, sTinhtrang, sVideo, sTendanhmuclh, sp.iNguoithem');
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
	    	$this->db->select('iMucgiadau, sTennguoidung');
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
	    	if ($bidsWin) {
		    	foreach ($bidsWin as $bid) {
		    		if ($userBidsNull[$bid['iMaphiendaugia']]['iMucgiadau'] != $bid['iGiathang']) {
		    			unset($userBidsNull[$bid['iMaphiendaugia']]);
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
	    	$this->db->where('iMadonmua', NULL);
	    	$this->db->group_by('ctp.iMaphiendaugia');
	    	return $this->db->get()->result_array();
	    }

	    public function getUserBidsNull($taiKhoan) {
	    	$this->db->select('sTenmausac, sTensize, sTensanpham, ctp.iMaphiendaugia, MAX(iMucgiadau) iMucgiadau, nd.iManguoidung, sTenshop');
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
	}

?>