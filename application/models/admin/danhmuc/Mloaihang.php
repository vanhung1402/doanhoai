<?php

	class Mloaihang extends CI_Model
	{
	    public function __construct()
	    {
	        parent::__construct();
	    }

	    public function kiemTraTen($tenLoaiHang, $iMaloaihang = null)
	    {
	    	if ($iMaloaihang) {
	    		$this->db->where('iMaloaihang !=', $iMaloaihang);
	    	}
	    	$this->db->where('sTenloaihang', $tenLoaiHang);
	    	return $this->db->get('tbl_loaihang')->row_array();
	    }

	    public function themLoaiHang($tenLoaiHang)
	    {
	    	$this->db->insert('tbl_loaihang', [
	    		'sTenloaihang' => $tenLoaiHang,
	    		'iTrangthai' => 1,
	    	]);
	    	return $this->db->affected_rows();
	    }

	    public function capNhapLoaiHang($tenLoaiHang, $iMaloaihang)
	    {
	    	$this->db->where('iMaloaihang', $iMaloaihang);
	    	$this->db->update('tbl_loaihang', ['sTenloaihang' => $tenLoaiHang]);
	    	return $this->db->affected_rows();
	    }

	    public function danhSachLoaiHang()
	    {
	    	return $this->db->get('tbl_loaihang')->result_array();
	    }

	    public function layLoaiHang($iMaloaihang)
	    {
	    	$this->db->where('iMaloaihang', $iMaloaihang);
	    	return $this->db->get('tbl_loaihang')->row_array();
	    }

	    public function xoaLoaiHang($iMaloaihang)
	    {
	    	$this->db->where('iMaloaihang', $iMaloaihang);
	    	$this->db->delete('tbl_loaihang');
	    	return $this->db->affected_rows();
	    }
	}

?>