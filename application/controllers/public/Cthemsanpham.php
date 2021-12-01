<?php

	class Cthemsanpham extends CI_Controller
	{
		private $__user;
	    public function __construct()
	    {
			parent::__construct();
			$this->__user = $this->session->userdata('user');
			if (!$this->__user || $this->__user['iTrangthai'] == 0) {
				return redirect(base_url(), 'refresh');
			}
			$this->load->model('public/Mhethong');
	    }

	    public function index()
	    {
	    	$data = [];

	    	$sp = $this->input->get('sp');
	    	if ($sp) {
	    		$data['sua'] = $this->Mhethong->laySanPham($sp);
	    	}

	    	$action = $this->input->post('action');

	    	switch ($action) {
	    		case 'cap-nhap-shop':
	    			$this->capNhapShop();
	    			break;
	    		
	    		case 'doi-mat-khau':
	    			$this->doiMatKhau();
	    			break;

	    		case 'them-san-pham':
	    			$this->themSanPham();
	    			break;

	    		case 'sua-san-pham':
	    			$this->suaSanPham($sp, $data['sua']);
	    			break;

	    		case 'xoa-san-pham':
	    			$this->xoaSanPham();
	    			break;

	    		case 'them-mau':
	    			$this->themMauSac();
	    			break;
	    		
	    		case 'them-size':
	    			$this->themKichThuoc();
	    			break;
	    		
	    		default:
	    			// code...
	    			break;
	    	}
	    	if ($this->__user['iPhanloai'] == 2) {
	    		$taiKhoan = [
		    		'sTendangnhap' => $this->__user['sTendangnhap'],
		    	];
	    		$data['nguoiBan'] 	= $this->Mhethong->dangNhap($taiKhoan);
	    	}

	    	$whereDanhSachSanPham = [
	    		'sp.iNguoithem' => $this->__user['iManguoidung'],
	    	];

	    	$data['danhMucLoaiHang'] 	= $this->Mhethong->danhMucLoaiHang();
	    	$data['danhSachMauSac'] 	= $this->Mhethong->danhSachMauSac();
	    	$data['danhSachKichThuoc'] 	= $this->Mhethong->danhSachKichThuoc();
	    	$data['danhSachSanPham'] 	= $this->Mhethong->danhSachSanPham($whereDanhSachSanPham);
			$temp['data'] 			= $data;
			$temp['template'] 		= 'public/Vthemsanpham';
	    	$this->load->view('layout_public/Vcontent', $temp);	
	    }

	    private function themMauSac()
	    {
	    	$mau = $this->input->post('mau');
	    	$result = $this->Mhethong->themMauSac($mau);
	    	die(json_encode($result));
	    }

	    private function themKichThuoc()
	    {
	    	$size = $this->input->post('size');
	    	$result = $this->Mhethong->themKichThuoc($size);
	    	die(json_encode($result));
	    }

	    private function xoaSanPham()
	    {
	    	$sanPham = $this->input->post('san-pham');
	    	$result = $this->Mhethong->xoaSanPham($sanPham);
	    	if ($result) {
	    		setMessage('success', 'Xóa sản phẩm thành công!');
	    	} else {
	    		setMessage('error', 'Xóa sản phẩm không thành công!');
	    	}
	    	return redirect('profile', 'refresh');
	    }

	    private function themSanPham()
	    {
	    	$sanPham = $this->input->post('sanPham');
	    	$chiTiet = $this->input->post('chiTiet');
	    	$hinhAnh = $this->input->post('hinhAnh');

	    	$result = $this->Mhethong->themSanPham($sanPham, $chiTiet);
	    	
	    	if ($result && $hinhAnh) {	    		
		    	foreach ($hinhAnh as $index => $anh) {
		    		$hinhAnh[$index]['iMasanpham'] = $result;
		    	}
		    	$resultHinhAnh = $this->Mhethong->themHinhAnh($hinhAnh);
	    	}

    		if ($result) {
    			setMessage('success', 'Thêm sản phẩm thành công');
    		}
	    	die(json_encode($result));
	    }

	    private function suaSanPham($maSanPham, $sanPham)
	    {
	    	if (empty($sanPham)) {
	    		setMessage('error', 'Không thể xóa sản phẩm này!');
	    		die(json_encode(false));
	    	} else {
	    		$sanPhamSua = $this->input->post('sanPham');
	    		$hinhAnh = $this->input->post('hinhAnh');

	    		$moi = $this->input->post('chiTietThemMoi');
	    		$chiTietThemMoi = [];
	    		foreach ($moi as $sp) {
	    			$sp['iMasanpham'] = $maSanPham;
	    			$chiTietThemMoi[] = $sp;
	    		}

	    		$sua = $this->input->post('chiTietSuaDoi');
	    		$chiTietSuaDoi = [];
	    		foreach ($sua as $sp) {
	    			$sp['iMasanpham'] = $maSanPham;
	    			$chiTietSuaDoi[] = $sp;
	    		}

	    		$chiTietBiXoa = $this->input->post('chiTietBiXoa');
	    		$anhBiXoa = $this->input->post('anhBiXoa');

		    	if ($hinhAnh) {	    		
			    	foreach ($hinhAnh as $index => $anh) {
			    		$hinhAnh[$index]['iMasanpham'] = $maSanPham;
			    	}
			    	$resultHinhAnh = $this->Mhethong->themHinhAnh($hinhAnh);
		    	}

	    		$result = $this->Mhethong->suaSanPham($maSanPham, $sanPhamSua, $chiTietThemMoi, $chiTietSuaDoi, $chiTietBiXoa, $anhBiXoa);
	    		if ($result) {
	    			setMessage('success', 'Cập nhập thông tin sản phẩm thành công');
	    		}
	    		die(json_encode($result));
	    	}
	    }

	    public function doiMatKhau()
	    {
	    	$matKhauMoi = sha1($this->input->post('new_password'));
	    	$resultUpdate = $this->Mhethong->doiMatKhau($matKhauMoi, $this->__user['iMataikhoan']);
	    	if ($resultUpdate) {
	    		setMessage('success', 'Cập nhập thành công');
	    	} else {
	    		setMessage('error', 'Không có cập nhập nào được ghi nhận');
	    	}
	    	return redirect(base_url('profile'), 'refresh');
	    }

	    public function capNhapShop()
	    {
	    	$logo = $_FILES['logoshop'];
	    	$giayPhep = $_FILES['giayphep'];

	    	$shop = [
	    		'sTenshop' => $this->input->post('tenshop'),
	    		'sMotashop' => $this->input->post('mota'),
	    	];

	    	if (file_exists($logo['tmp_name']) && $logo['size']) {
		    	$fileLogo = $this->uploadFile('logoshop', 'shop/logo/');
		    	if (isset($fileLogo['error'])) {
		    		setMessage('error', 'File logo shop có vấn đề, vui lòng thử lại');
		    		return redirect(base_url('profile'), 'refresh');
		    	}
		    	$shop['sMotahinhanh'] = $fileLogo['success']['file_name'];
	    	}
	    	if (file_exists($giayPhep['tmp_name']) && $giayPhep['size']) {
	    		$fileGiayPhep = $this->uploadFile('giayphep', 'shop/giayphep/');
		    	if (isset($fileGiayPhep['error'])) {
		    		setMessage('error', 'File giấy phép có vấn đề, vui lòng thử lại');
		    		return redirect(base_url('profile'), 'refresh');
		    	}
		    	$shop['sGiayphepkinhdoanh'] = $fileGiayPhep['success']['file_name'];
	    	}

	    	$resultUpdate = $this->Mhethong->capNhapNguoiDung($shop, $this->__user['iManguoidung']);
	    	if ($resultUpdate) {
	    		setMessage('success', 'Cập nhập thành công');
	    	} else {
	    		setMessage('error', 'Không có cập nhập nào được ghi nhận');
	    	}
	    	return redirect(base_url('profile'), 'refresh');
	    }

	    public function uploadFile($inputName, $folder) {
	    	$config['upload_path'] = './files/' . $folder;
	        $config['allowed_types'] = 'gif|jpg|png|pdf';
	        $config['max_size'] = 3000;

	        $this->load->library('upload', $config);

	        if (!$this->upload->do_upload($inputName)) {
	            return ['error' => $this->upload->display_errors()];
	        } else {
	            return ['success' => $this->upload->data()];
	        }
	    }
	}

?>