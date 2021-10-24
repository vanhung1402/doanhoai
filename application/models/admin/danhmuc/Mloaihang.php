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

	    public function kiemTraTenDanhMuc($tenLoaiHang, $loaiHang, $iMadanhmuclh = null)
	    {
	    	if ($iMadanhmuclh) {
	    		$this->db->where('iMadanhmuclh !=', $iMadanhmuclh);
	    	}
	    	$this->db->where('sTendanhmuclh', $tenLoaiHang);
	    	$this->db->where('iMaloaihang', $loaiHang);
	    	return $this->db->get('tbl_danhmucloaihang')->row_array();
	    }

	    public function themLoaiHang($tenLoaiHang)
	    {
	    	$session = $this->session->userdata('user_admin');
	    	$this->db->insert('tbl_loaihang', [
	    		'sTenloaihang' => $tenLoaiHang,
	    		'iTrangthai' => 1,
	    		'iNguoithem' => $session['iMataikhoan']
	    	]);
	    	return $this->db->affected_rows();
	    }

	    public function themDanhMucLoaiHang($tenLoaiHang, $loaiHang)
	    {
	    	$session = $this->session->userdata('user_admin');
	    	$this->db->insert('tbl_danhmucloaihang', [
	    		'sTendanhmuclh' => $tenLoaiHang,
	    		'iMaloaihang' => $loaiHang,
	    		'iTrangthai' => 1,
	    		'iNguoithem' => $session['iMataikhoan']
	    	]);
	    	return $this->db->affected_rows();
	    }

	    public function capNhapLoaiHang($tenLoaiHang, $iMaloaihang)
	    {
	    	$session = $this->session->userdata('user_admin');
	    	$this->db->where('iMaloaihang', $iMaloaihang);
	    	$this->db->update('tbl_loaihang', [
	    		'sTenloaihang' => $tenLoaiHang, 
	    		'iNguoithem' => $session['iMataikhoan']
	    	]);
	    	return $this->db->affected_rows();
	    }

	    public function capNhapDanhMucLoaiHang($tenLoaiHang, $loaiHang, $iMaloaihang)
	    {
	    	$session = $this->session->userdata('user_admin');
	    	$this->db->where('iMadanhmuclh', $iMaloaihang);
	    	$this->db->update('tbl_danhmucloaihang', [
	    		'sTendanhmuclh' => $tenLoaiHang,
	    		'iMaloaihang' => $loaiHang,
	    		'iNguoithem' => $session['iMataikhoan']
	    	]);
	    	return $this->db->affected_rows();
	    }

	    public function danhSachLoaiHang()
	    {
	    	$this->db->select('lh.*, dmlh.iMadanhmuclh');
	    	$this->db->from('tbl_loaihang lh');
	    	$this->db->join('tbl_danhmucloaihang dmlh', 'lh.iMaloaihang = dmlh.iMaloaihang', 'left');
	    	$this->db->group_by('lh.iMaloaihang');
	    	return $this->db->get()->result_array();
	    }

	    public function danhMucLoaiHang()
	    {
	    	$this->db->select('dmlh.*, lh.*, sp.iMadanhmuclh as sanPham');
	    	$this->db->from('tbl_danhmucloaihang dmlh');
	    	$this->db->join('tbl_loaihang lh', 'dmlh.iMaloaihang = lh.iMaloaihang', 'inner');
	    	$this->db->join('tbl_sanpham sp', 'dmlh.iMadanhmuclh = sp.iMadanhmuclh', 'left');
	    	$this->db->group_by('dmlh.iMadanhmuclh');
	    	return $this->db->get()->result_array();
	    }

	    public function layLoaiHang($iMaloaihang)
	    {
	    	$this->db->where('iMaloaihang', $iMaloaihang);
	    	return $this->db->get('tbl_loaihang')->row_array();
	    }

	    public function layDanhMucLoaiHang($iMaloaihang)
	    {
	    	$this->db->where('iMadanhmuclh', $iMaloaihang);
	    	return $this->db->get('tbl_danhmucloaihang')->row_array();
	    }

	    public function xoaLoaiHang($iMaloaihang)
	    {
	    	$this->db->where('iMaloaihang', $iMaloaihang);
	    	$this->db->delete('tbl_loaihang');
	    	return $this->db->affected_rows();
	    }

	    public function xoaDanhMucLoaiHang($iMaloaihang)
	    {
	    	$this->db->where('iMadanhmuclh', $iMaloaihang);
	    	$this->db->delete('tbl_danhmucloaihang');
	    	return $this->db->affected_rows();
	    }
	}

?>