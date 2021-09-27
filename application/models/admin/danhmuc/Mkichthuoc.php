<?php

	class Mkichthuoc extends CI_Model
	{
	    public function __construct()
	    {
	        parent::__construct();
	    }

	    public function kiemTraTen($tenSize, $iMasize = null)
	    {
	    	if ($iMasize) {
	    		$this->db->where('iMasize !=', $iMasize);
	    	}
	    	$this->db->where('sTensize', $tenSize);
	    	return $this->db->get('tbl_kichthuoc')->row_array();
	    }

	    public function themKichThuoc($tenSize)
	    {
	    	$this->db->insert('tbl_kichthuoc', [
	    		'sTensize' => $tenSize,
	    	]);
	    	return $this->db->affected_rows();
	    }

	    public function capNhapKichThuoc($tenSize, $iMasize)
	    {
	    	$this->db->where('iMasize', $iMasize);
	    	$this->db->update('tbl_kichthuoc', ['sTensize' => $tenSize]);
	    	return $this->db->affected_rows();
	    }

	    public function danhSachKichThuoc()
	    {
	    	return $this->db->get('tbl_kichthuoc')->result_array();
	    }

	    public function layKichThuoc($iMasize)
	    {
	    	$this->db->where('iMasize', $iMasize);
	    	return $this->db->get('tbl_kichthuoc')->row_array();
	    }

	    public function xoaKichThuoc($iMasize)
	    {
	    	$this->db->where('iMasize', $iMasize);
	    	$this->db->delete('tbl_kichthuoc');
	    	return $this->db->affected_rows();
	    }
	}

?>