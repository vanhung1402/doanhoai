<?php

	class Mdaugia extends CI_Model
	{
	    /**
	     * summary
	     */
	    public function __construct()
	    {
	        parent::__construct();
	    }

	    public function getAuctua($start, $end, $limit) {
	    	$this->db->limit($limit);
	    	$this->db->select('pdg.iMaphiendaugia, sTensanpham, sTenmausac, sTensize, dThoigianketthuc, iGiakhoidiem, max(iMucgiadau) as giaHientai');
	    	$this->db->from('tbl_phiendaugia pdg');
	    	$this->db->join('tbl_ct_sanpham ctsp', 'pdg.iMactsanpham = ctsp.iMactsanpham', 'inner');
	    	$this->db->join('tbl_sanpham sp', 'ctsp.iMasanpham = sp.iMasanpham', 'inner');
	    	$this->db->join('tbl_mausac ms', 'ctsp.iMamausac = ms.iMamausac', 'inner');
	    	$this->db->join('tbl_kichthuoc kt', 'ctsp.iMasize = kt.iMasize', 'inner');
	    	$this->db->join('tbl_ct_phiendaugia ctp', 'pdg.iMaphiendaugia = ctp.iMaphiendaugia', 'left');
	    	$this->db->where('dThoigianbatdau <=', $start);
	    	$this->db->where('dThoigianketthuc >=', $end);
	    	$this->db->order_by('dThoigianketthuc');
	    	$this->db->group_by('pdg.iMaphiendaugia');
	    	return [
	    		'listPhien' => $this->db->get()->result_array(),
	    		'tongPhien' => $this->getSoPhien($start, $end),
	    	];
	    }

	    public function getSoPhien($start, $end) {
			$this->db->select('count(iMaphiendaugia) as tongPhien');
	    	$this->db->from('tbl_phiendaugia pdg');
	    	$this->db->where('dThoigianbatdau <=', $start);
	    	$this->db->where('dThoigianketthuc >=', $end);
	    	return $this->db->get()->row_array();
	    }

	    public function getChiTietSanPham($ctsp)
	    {
	    	$this->db->select('sTenmausac, sTensize, sTensanpham, sMota, sChatlieu, sTinhtrang, sVideo, sTendanhmuclh, sp.iNguoithem');
	    	$this->db->from('tbl_ct_sanpham ctsp');
	    	$this->db->join('tbl_sanpham sp', 'ctsp.iMasanpham = sp.iMasanpham', 'inner');
	    	$this->db->join('tbl_danhmucloaihang dmlh', 'sp.iMadanhmuclh = dmlh.iMadanhmuclh', 'inner');
	    	$this->db->join('tbl_mausac ms', 'ctsp.iMamausac = ms.iMamausac', 'inner');
	    	$this->db->join('tbl_kichthuoc kt', 'ctsp.iMasize = kt.iMasize', 'inner');
	    	$this->db->where('iMactsanpham', $ctsp);
	    	return $this->db->get()->row_array();
	    }

	    public function getPhien($maPhien)
	    {
	    	$this->db->from('tbl_phiendaugia');
	    	$this->db->where('iMaphiendaugia', $maPhien);
	    	return $this->db->get()->row_array();
	    }

	    public function getThongTinPhienHienTai($maPhien) {
	    	$this->db->limit(1);
	    	$this->db->select('iMucgiadau, sTennguoidung');
	    	$this->db->from('tbl_ct_phiendaugia ctp');
	    	$this->db->join('tbl_nguoidung nd', 'ctp.iMataikhoan = nd.iMataikhoan', 'inner');
	    	$this->db->where('ctp.iMaphiendaugia', $maPhien);
	    	$this->db->order_by('iMucgiadau', 'desc');
	    	return $this->db->get()->row_array();
	    }

	    public function submitPhien($chiTiet)
	    {
	    	$this->db->insert('tbl_ct_phiendaugia', $chiTiet);
	    	return $this->db->affected_rows();
	    }

	    public function getCartUser($taiKhoan)
	    {
	    	$this->db->select('iMaphiendaugia, iMucgiadau');
	    	$this->db->where('iMadonmua', NULL);
	    	$this->db->where('iMataikhoan', $taiKhoan);
	    	$this->db->having('iMucgiadau = MAX(iMucgiadau)');
	    	$this->db->group_by('iMaphiendaugia');
	    	return $this->db->get('tbl_ct_phiendaugia')->result_array();
	    }
	}

?>