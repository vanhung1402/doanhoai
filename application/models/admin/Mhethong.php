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

	    public function phanQuyenTaiKhoan($quyenTaiKhoan)
	    {
	    	$this->db->insert('tbl_quyen_taikhoan', $quyenTaiKhoan);
	    	return $this->db->insert_id();	
	    }

	    public function dangNhap($taiKhoan)
	    {
	    	$thongTinTaiKhoan = $this->checkTaiKhoan($taiKhoan);
	    	if (!$thongTinTaiKhoan) return false;

	    	$quyenTaiKhoan = $this->checkQuyenTaiKhoan($thongTinTaiKhoan['iMataikhoan']);
			if (!$quyenTaiKhoan) return false;	    	

			$thongTinTaiKhoan['iMaquyen'] = $quyenTaiKhoan['iMaquyen'];
			return $thongTinTaiKhoan;
	    }

	    public function checkTaiKhoan($taiKhoan)
	    {
	    	$this->db->where($taiKhoan);
	    	return $this->db->get('tbl_taikhoan')->row_array();
	    }

	    public function checkQuyenTaiKhoan($maTaiKhoan)
	    {
	    	$this->db->where('iMataikhoan', $maTaiKhoan);
	    	$this->db->where('iMaquyen >', 5);
	    	return $this->db->get('tbl_quyen_taikhoan')->row_array();
	    }

	    public function doiMatKhau($matKhauMoi, $iMataikhoan)
	    {
	    	$this->db->where('iMataikhoan', $iMataikhoan);
	    	$this->db->update('tbl_taikhoan', ['sMatkhau' => $matKhauMoi]);
	    	return $this->db->affected_rows();
	    }
	}

?>