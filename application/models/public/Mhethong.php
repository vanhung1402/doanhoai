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
	    	return $this->db->insert_id();	
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
				'bTrangthai' => $thongTinTaiKhoan['bTrangthai'],
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
	    	return $this->db->get('tbl_quyen_taikhoan')->row_array();
	    }
	}

?>