<?php

	class Mtaikhoan extends CI_Model
	{
	    public function __construct()
	    {
	        parent::__construct();
	    }

	    public function getAllTaiKhoan()
	    {
			$userAdmin = $this->session->userdata('user_admin');

			$this->db->select('tk.*, nd.iManguoidung, nd.sTennguoidung, dNgaysinh, bGioitinh, sSodienthoai, sDiachi, sEmail, iSoCCCD, iPhanloai, q.sTenquyen');
	    	$this->db->from('tbl_taikhoan tk');
	    	$this->db->join('tbl_quyen_taikhoan q_tk', 'tk.iMataikhoan = q_tk.iMataikhoan', 'inner');
	    	$this->db->join('tbl_quyen q', 'q_tk.iMaquyen = q.iMaquyen', 'inner');
	    	$this->db->join('tbl_nguoidung nd', 'tk.iMataikhoan = nd.iMataikhoan', 'left');
	    	$this->db->where('q_tk.iMaquyen <', $userAdmin['iMaquyen']);
	    	return $this->db->get()->result_array();
	    }

	    public function setTrangThaiTaiKhoan($iMataikhoan, $trangThai)
	    {
	    	$this->db->where('iMataikhoan', $iMataikhoan);
	    	$this->db->update('tbl_taikhoan', ['iTrangthai' => $trangThai]);
	    	return $this->db->affected_rows();
	    }

	    public function taoTaiKhoan($taiKhoan, $iMaquyen = 9)
	    {
	    	$this->db->insert('tbl_taikhoan', $taiKhoan);
	    	$iMataikhoan = $this->db->insert_id();

	    	$quyenTaiKhoan = [
	    		'iMaquyen' => $iMaquyen,
	    		'iMataikhoan' => $iMataikhoan
	    	];
	    	$resultPhanQuyen = $this->phanQuyenTaiKhoan($quyenTaiKhoan);

	    	return !!$resultPhanQuyen && !! $iMataikhoan;
	    }

	    public function phanQuyenTaiKhoan($quyenTaiKhoan)
	    {
	    	$this->db->insert('tbl_quyen_taikhoan', $quyenTaiKhoan);
	    	return $this->db->affected_rows();
	    }

	    public function checkTaiKhoan($taiKhoan)
	    {
	    	$this->db->where($taiKhoan);
	    	return $this->db->get('tbl_taikhoan')->row_array();
	    }

	}

?>