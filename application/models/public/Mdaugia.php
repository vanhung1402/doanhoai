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
	}

?>