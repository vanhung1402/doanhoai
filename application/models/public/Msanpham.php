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
	    	$this->db->select('*, DATE_FORMAT(dThoigianbatdau, "%H:%i %d/%m/%Y") as batDau, DATE_FORMAT(dThoigianketthuc, "%H:%i %d/%m/%Y") as ketThuc');
	    	$this->db->from('tbl_ct_sanpham ctsp');
	    	$this->db->join('tbl_phiendaugia pdg', 'ctsp.iMactsanpham = pdg.iMactsanpham', 'inner');
	    	$this->db->join('tbl_mausac ms', 'ctsp.iMamausac = ms.iMamausac', 'inner');
	    	$this->db->join('tbl_kichthuoc kt', 'ctsp.iMasize = kt.iMasize', 'inner');
	    	$this->db->where('ctsp.iMasanpham', $iMasanpham);
	    	return $this->db->get()->result_array();	
	    }
	}

?>