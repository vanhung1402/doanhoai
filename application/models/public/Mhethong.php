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
	    	return $this->db->affected_rows();
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
				'iTrangthai' => $thongTinTaiKhoan['iTrangthai'],
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
	    	$this->db->where('iMaquyen <=', 5);
	    	return $this->db->get('tbl_quyen_taikhoan')->row_array();
	    }

	    public function checkExistEmail($email, $user)
	    {
	    	if ($user) {
	    		$this->db->where('iMataikhoan !=', $user['iMataikhoan']);
	    	}
	    	$this->db->where('sEmail', $email);
	    	return $this->db->get('tbl_nguoidung')->row_array();	
	    }

	    public function checkExistPhone($dienThoai, $user)
	    {
	    	if ($user) {
	    		$this->db->where('iMataikhoan !=', $user['iMataikhoan']);
	    	}
	    	$this->db->where('sSodienthoai', $dienThoai);
	    	return $this->db->get('tbl_nguoidung')->row_array();	
	    }

	    public function checkExistCMND($cmnd, $user)
	    {
	    	if ($user) {
	    		$this->db->where('iMataikhoan !=', $user['iMataikhoan']);
	    	}
	    	$this->db->where('iSoCCCD', $cmnd);
	    	return $this->db->get('tbl_nguoidung')->row_array();	
	    }

	    public function capNhapNguoiDung($nguoiDung, $iManguoidung)
	    {
	    	$this->db->where('iManguoidung', $iManguoidung);
	    	$this->db->update('tbl_nguoidung', $nguoiDung);
	    	return $this->db->affected_rows();
	    }

	    public function doiMatKhau($matKhauMoi, $iMataikhoan)
	    {
	    	$this->db->where('iMataikhoan', $iMataikhoan);
	    	$this->db->update('tbl_taikhoan', ['sMatkhau' => $matKhauMoi]);
	    	return $this->db->affected_rows();
	    }
	}

?>