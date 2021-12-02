<?php

	class Mmausac extends CI_Model
	{
	    public function __construct()
	    {
	        parent::__construct();
	    }

	    public function kiemTraTen($tenMauSac, $iMamausac = null)
	    {
	    	if ($iMamausac) {
	    		$this->db->where('iMamausac !=', $iMamausac);
	    	}
	    	$this->db->where('sTenmausac', $tenMauSac);
	    	return $this->db->get('tbl_mausac')->row_array();
	    }

	    public function themMauSac($tenMauSac)
	    {
	    	$session = $this->session->userdata('user_admin');
	    	$this->db->insert('tbl_mausac', [
	    		'sTenmausac' => $tenMauSac,
	    		'iNguoithem' => $session['iMataikhoan']
	    	]);
	    	return $this->db->affected_rows();
	    }

	    public function capNhapMauSac($tenMauSac, $iMamausac)
	    {
	    	$session = $this->session->userdata('user_admin');
	    	$this->db->where('iMamausac', $iMamausac);
	    	$this->db->update('tbl_mausac', [
	    		'sTenmausac' => $tenMauSac, 
	    		'iNguoithem' => $session['iMataikhoan']
	    	]);
	    	return $this->db->affected_rows();
	    }

	    public function danhSachMauSac()
	    {
	    	$this->db->select('ms.*, iMactsanpham');
	    	$this->db->from('tbl_mausac ms');
	    	$this->db->join('tbl_ct_sanpham ctsp', 'ms.iMamausac = ctsp.iMamausac', 'left');
	    	$this->db->group_by('ms.iMamausac');
	    	return $this->db->get('tbl_mausac')->result_array();
	    }

	    public function layMauSac($iMamausac)
	    {
	    	$this->db->where('iMamausac', $iMamausac);
	    	return $this->db->get('tbl_mausac')->row_array();
	    }

	    public function xoaMauSac($iMamausac)
	    {
	    	$this->db->where('iMamausac', $iMamausac);
	    	$this->db->delete('tbl_mausac');
	    	return $this->db->affected_rows();
	    }
	}

?>