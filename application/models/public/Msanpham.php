<?php

	class Msanpham extends CI_Model
	{
	    public function __construct()
	    {
	        parent::__construct();
	    }

	    public function getSanPham($sp)
	    {
	    	$session = $this->session->userdata('user');
	    	$this->db->from('tbl_sanpham sp');
	    	$this->db->join('tbl_danhmucloaihang dmlh', 'sp.iMadanhmuclh = dmlh.iMadanhmuclh', 'inner');
	    	$this->db->where('iMasanpham', $sp);
	    	$this->db->where('sp.iNguoithem', $session['iManguoidung']);
	    	return $this->db->get()->row_array();
	    }

	    public function getChiTietSanPham($sp)
	    {
	    	$this->db->select('ctsp.*, sTenmausac, sTensize');
	    	$this->db->from('tbl_ct_sanpham ctsp');
	    	$this->db->join('tbl_mausac ms', 'ctsp.iMamausac = ms.iMamausac', 'inner');
	    	$this->db->join('tbl_kichthuoc kt', 'ctsp.iMasize = kt.iMasize', 'inner');
	    	$this->db->where('iMasanpham', $sp);
	    	return $this->db->get()->result_array();
	    }

	    public function setDauGia($dauGia)
	    {
	    	$this->db->insert('tbl_phiendaugia', $dauGia);
	    	return $this->db->affected_rows();
	    }

	    public function updateDauGia($dauGia, $maPhien)
	    {
	    	$this->db->where('iMaphiendaugia', $maPhien);
	    	$this->db->update('tbl_phiendaugia', $dauGia);
	    	return $this->db->affected_rows();
	    }

	    public function getDanhSachDauGiaSanPham($iMasanpham)
	    {	
	    	$this->db->select('*, DATE_FORMAT(dThoigianbatdau, "%H:%i %d/%m/%Y") as batDau, DATE_FORMAT(dThoigianketthuc, "%H:%i %d/%m/%Y") as ketThuc, iMadonmua, iKetqua, DATE_FORMAT(dThoigianketthuc, "%Y/%m/%d %H:%i:%s") as end');
	    	$this->db->from('tbl_ct_sanpham ctsp');
	    	$this->db->join('tbl_phiendaugia pdg', 'ctsp.iMactsanpham = pdg.iMactsanpham', 'inner');
	    	$this->db->join('tbl_mausac ms', 'ctsp.iMamausac = ms.iMamausac', 'inner');
	    	$this->db->join('tbl_kichthuoc kt', 'ctsp.iMasize = kt.iMasize', 'inner');
	    	$this->db->join('tbl_ct_phiendaugia ctp', 'pdg.iMaphiendaugia = ctp.iMaphiendaugia', 'left');
	    	$this->db->group_by('pdg.iMaphiendaugia');
	    	$this->db->order_by('ctp.iMadonmua', 'desc');
	    	$this->db->where('ctsp.iMasanpham', $iMasanpham);
	    	$result = $this->db->get()->result_array();
	    	$current = date('Y/m/d H:i:s');
	    	foreach ($result as $value) {
	    		if ($value['end'] < $current) {
	    			$this->setDauGiaResult($value);
	    		}
	    	}
	    	return $result;
	    }

	    public function setDauGiaResult($dg) {
	    	$this->db->where([
	    		'pdg.iMaphiendaugia' => $dg['iMaphiendaugia'],
	    		'iKetqua' => 1,
	    	]);
	    	$this->db->from('tbl_phiendaugia pdg');
	    	$this->db->join('tbl_ct_phiendaugia ctp', 'pdg.iMaphiendaugia = ctp.iMaphiendaugia', 'left');
	    	$this->db->order_by('ctp.iMadonmua', 'desc');
	    	$has = $this->db->get()->row_array();

	    	if ($has) {
	    		$this->db->where([
		    		'iMaphiendaugia' => $dg['iMaphiendaugia']
		    	]);
	    		if ($has['iMadonmua']) {
	    			$this->db->update('tbl_phiendaugia', ['iKetqua' => 2]);

	    			$this->db->where('iMactsanpham', $dg['iMactsanpham']);
	    			$this->db->update('tbl_ct_sanpham', ['iSoluong' => ($dg['iSoluong'] - 1)]);
	    		} else {
	    			$this->db->update('tbl_phiendaugia', ['iKetqua' => 3]);
	    		};
	    	}
	    }

	    public function getHinhAnhSanPham($iMasanpham) {
	    	$this->db->where([
	    		'iMasanpham' => $iMasanpham,
	    		'iTrangthai' => 1,
	    	]);
	    	return $this->db->get('tbl_hinhanh_sanpham')->result_array();
	    }
	}

?>