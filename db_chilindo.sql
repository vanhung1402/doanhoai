-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 12, 2021 at 12:29 AM
-- Server version: 10.3.31-MariaDB-0ubuntu0.20.04.1
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_chilindo`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_binhluan`
--

CREATE TABLE `tbl_binhluan` (
  `iMabinhluan` int(11) NOT NULL,
  `iMataikhoan` int(11) NOT NULL,
  `iMasanpham` int(11) NOT NULL,
  `sNoidungbinhluan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dThoigianbinhluan` datetime NOT NULL,
  `bTrangthai` bit(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ct_phiendaugia`
--

CREATE TABLE `tbl_ct_phiendaugia` (
  `iMataikhoan` int(11) NOT NULL,
  `iMaphiendaugia` int(11) NOT NULL,
  `dThoigiandaugia` datetime NOT NULL,
  `iMucgiadau` int(11) NOT NULL,
  `iTrangthaidaugia` tinyint(4) NOT NULL,
  `iMadonmua` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_ct_phiendaugia`
--

INSERT INTO `tbl_ct_phiendaugia` (`iMataikhoan`, `iMaphiendaugia`, `dThoigiandaugia`, `iMucgiadau`, `iTrangthaidaugia`, `iMadonmua`) VALUES
(17, 31, '2021-11-10 00:38:35', 160100, 1, NULL),
(17, 31, '2021-11-10 00:38:49', 235100, 1, NULL),
(18, 6, '2021-11-11 00:54:19', 20000, 1, NULL),
(18, 6, '2021-11-11 00:54:22', 25000, 1, NULL),
(18, 30, '2021-11-11 00:54:49', 410000, 1, NULL),
(20, 6, '2021-11-10 00:46:55', 15000, 1, NULL),
(20, 30, '2021-11-10 00:45:17', 310000, 1, NULL),
(20, 31, '2021-11-09 23:36:44', 10100, 1, NULL),
(20, 31, '2021-11-09 23:37:29', 25100, 1, NULL),
(20, 31, '2021-11-09 23:37:30', 40100, 1, NULL),
(20, 31, '2021-11-09 23:37:31', 70100, 1, NULL),
(20, 31, '2021-11-10 00:31:37', 100100, 1, NULL),
(20, 31, '2021-11-10 00:31:52', 130100, 1, NULL),
(20, 31, '2021-11-10 00:38:45', 205100, 1, NULL),
(20, 31, '2021-11-10 00:38:54', 265100, 1, NULL),
(20, 31, '2021-11-10 00:49:51', 370100, 1, NULL),
(20, 31, '2021-11-10 00:50:49', 385100, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ct_sanpham`
--

CREATE TABLE `tbl_ct_sanpham` (
  `iMactsanpham` int(11) NOT NULL,
  `iMasanpham` int(11) NOT NULL,
  `iMasize` int(11) NOT NULL,
  `iMamausac` int(11) NOT NULL,
  `iSoluong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_ct_sanpham`
--

INSERT INTO `tbl_ct_sanpham` (`iMactsanpham`, `iMasanpham`, `iMasize`, `iMamausac`, `iSoluong`) VALUES
(10, 7, 6, 3, 10000),
(11, 7, 5, 5, 50),
(13, 7, 3, 3, 200),
(14, 7, 5, 3, 10091),
(16, 9, 6, 3, 10000),
(17, 10, 3, 5, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_danhmucloaihang`
--

CREATE TABLE `tbl_danhmucloaihang` (
  `iMadanhmuclh` int(11) NOT NULL,
  `sTendanhmuclh` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `iMaloaihang` int(11) NOT NULL,
  `iTrangthai` tinyint(4) NOT NULL,
  `iNguoithem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_danhmucloaihang`
--

INSERT INTO `tbl_danhmucloaihang` (`iMadanhmuclh`, `sTendanhmuclh`, `iMaloaihang`, `iTrangthai`, `iNguoithem`) VALUES
(11, 'Điện thoại', 5, 1, 21),
(12, 'Máy tính', 5, 1, 21),
(13, 'Bếp từ', 6, 1, 21),
(14, 'Vợt cầu lông', 7, 1, 21),
(15, 'Smart TV', 5, 1, 21);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_donmuahang`
--

CREATE TABLE `tbl_donmuahang` (
  `iMadonmua` int(11) NOT NULL,
  `dThoigianlap` datetime NOT NULL,
  `sGhichu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bTrangthai` bit(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hinhanh_sanpham`
--

CREATE TABLE `tbl_hinhanh_sanpham` (
  `iMasanpham` int(11) NOT NULL,
  `sHinhanh` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `iMahinhanh` int(11) NOT NULL,
  `bTrangthaiha` bit(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kichthuoc`
--

CREATE TABLE `tbl_kichthuoc` (
  `iMasize` int(11) NOT NULL,
  `sTensize` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `iNguoithem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_kichthuoc`
--

INSERT INTO `tbl_kichthuoc` (`iMasize`, `sTensize`, `iNguoithem`) VALUES
(3, 'Size M', 21),
(4, 'Size L', 21),
(5, '5 inch', 21),
(6, '5.5 inch', 21),
(7, '21 inch', 21),
(8, '50 inch', 21);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loaihang`
--

CREATE TABLE `tbl_loaihang` (
  `iMaloaihang` int(11) NOT NULL,
  `sTenloaihang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `iTrangthai` tinyint(4) NOT NULL,
  `iNguoithem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_loaihang`
--

INSERT INTO `tbl_loaihang` (`iMaloaihang`, `sTenloaihang`, `iTrangthai`, `iNguoithem`) VALUES
(5, 'Đồ điện tử', 1, 21),
(6, 'Đồ gia dụng', 1, 21),
(7, 'Dụng cụ thể thao', 1, 21);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mausac`
--

CREATE TABLE `tbl_mausac` (
  `iMamausac` int(11) NOT NULL,
  `sTenmausac` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `iNguoithem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_mausac`
--

INSERT INTO `tbl_mausac` (`iMamausac`, `sTenmausac`, `iNguoithem`) VALUES
(3, 'Đen', 21),
(4, 'Đỏ', 21),
(5, 'Trắng', 21);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nguoidung`
--

CREATE TABLE `tbl_nguoidung` (
  `iManguoidung` int(11) NOT NULL,
  `iMataikhoan` int(11) NOT NULL,
  `sTennguoidung` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dNgaysinh` date NOT NULL,
  `bGioitinh` bit(3) NOT NULL,
  `sSodienthoai` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `sDiachi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sEmail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `iSoCCCD` bigint(20) NOT NULL,
  `iPhanloai` tinyint(4) NOT NULL DEFAULT 1,
  `sTenshop` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sMotashop` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sMotahinhanh` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `sGiayphepkinhdoanh` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_nguoidung`
--

INSERT INTO `tbl_nguoidung` (`iManguoidung`, `iMataikhoan`, `sTennguoidung`, `dNgaysinh`, `bGioitinh`, `sSodienthoai`, `sDiachi`, `sEmail`, `iSoCCCD`, `iPhanloai`, `sTenshop`, `sMotashop`, `sMotahinhanh`, `sGiayphepkinhdoanh`) VALUES
(4, 16, 'Bùi Văn Hùng', '2021-09-07', b'111', '0329222617', 'Hoa Binh', 'bacdau0302@gmail.com', 113702072, 1, NULL, NULL, NULL, NULL),
(5, 17, 'Phùng Thị Huyền', '2021-09-14', b'111', '974052772', 'Hoa Binh', 'vanhung14.2.2017@gmail.com', 113702992, 1, 'Shop mun', '', 'e4c0dbffa4c953970ad8.jpg', 'Báo_cáo_tháng_12.jpg'),
(6, 18, 'Bùi Văn Hùngsss', '2021-09-04', b'111', '03292221617', 'Hoa Binh', 'bacdau030s2@gmail.com', 1112121, 2, NULL, NULL, NULL, NULL),
(7, 19, 'Chủ hàng', '2021-09-18', b'111', '03292226172', 'Hoa Binh', 'bacdau030ss2@gmail.com', 222121212, 2, NULL, NULL, NULL, NULL),
(8, 20, 'Bùi Văn Hùng', '2021-09-15', b'111', '03292222617', 'Hoa Binh', 'vanhung14.2.20171@gmail.com', 1212, 2, 'Shop mun', 'Mô tả Chưa xác thựcMô tả Chưa xác thựcMô tả Chưa xác thựcMô tả Chưa xác thựcMô tả Chưa xác thựcMô tả Chưa xác thực', 'anh_the6.jpg', 'Screenshot_from_2021-07-24_21-50-211.png'),
(9, 38, 'Phùng Thị Huyền', '2021-10-16', b'111', '03282632753', 'Hòa Bình', 'huyen@gmail.com', 121313, 2, 'Hoài chó', '(tối đa 2MB)(tối đa 2MB)(tối đa 2MB)(tối đa 2MB)(tối đa 2MB)(tối đa 2MB)(tối đa 2MB)(tối đa 2MB)(tối đa 2MB)(tối đa 2MB)(tối đa 2MB)(tối đa 2MB)(tối đa 2MB)(tối đa 2MB)(tối đa 2MB)(tối đa 2MB)(tối đa 2MB)(tối đa 2MB)(tối đa 2MB)(tối đa 2MB)(tối đa 2MB)(tố', 'anh_the7.jpg', 'Screenshot_from_2021-07-24_22-25-51.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_phiendaugia`
--

CREATE TABLE `tbl_phiendaugia` (
  `iMaphiendaugia` int(11) NOT NULL,
  `dThoigianbatdau` datetime NOT NULL,
  `dThoigianketthuc` datetime NOT NULL,
  `iBuocgia` int(11) NOT NULL,
  `iGiakhoidiem` int(11) NOT NULL,
  `iKetqua` tinyint(4) NOT NULL COMMENT 'Phiên đấu giá chưa diễn ra, sắp diễn ra, đang diễn ra, đã diễn ra(thành công/không thành công)',
  `iMactsanpham` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_phiendaugia`
--

INSERT INTO `tbl_phiendaugia` (`iMaphiendaugia`, `dThoigianbatdau`, `dThoigianketthuc`, `iBuocgia`, `iGiakhoidiem`, `iKetqua`, `iMactsanpham`) VALUES
(1, '2021-10-27 19:24:58', '2021-10-31 19:24:58', 3, 3, 1, 10),
(2, '2021-10-28 20:03:46', '2021-10-31 20:03:46', 10000000, 100000, 1, 10),
(3, '2021-10-29 20:06:48', '2021-10-30 20:06:48', 100100, 10000, 1, 11),
(4, '2021-10-28 20:08:03', '2021-10-29 20:08:03', 10, 5, 1, 11),
(5, '2021-10-27 20:09:03', '2021-10-28 20:08:59', 5, 4, 1, 11),
(6, '2021-11-03 17:05:16', '2021-11-30 17:05:16', 5000, 10000, 1, 16),
(7, '2021-11-03 20:05:16', '2021-11-03 21:05:16', 5000, 12000, 1, 16),
(8, '2021-11-03 20:05:16', '2021-11-03 21:05:16', 5000, 12000, 1, 16),
(9, '2021-11-03 20:05:16', '2021-11-03 21:05:16', 5000, 12000, 1, 16),
(10, '2021-11-03 20:05:16', '2021-11-03 21:05:16', 5000, 12000, 1, 16),
(11, '2021-11-03 20:05:16', '2021-11-03 21:05:16', 5000, 12000, 1, 16),
(12, '2021-11-03 20:05:16', '2021-11-03 21:05:16', 5000, 12000, 1, 16),
(13, '2021-11-03 18:35:52', '2021-11-03 21:05:16', 5000, 12000, 1, 16),
(14, '2021-11-03 18:35:52', '2021-11-03 21:05:16', 5000, 12000, 1, 16),
(15, '2021-11-03 18:35:52', '2021-11-03 21:05:16', 5000, 12000, 1, 16),
(16, '2021-11-03 18:35:52', '2021-11-03 21:05:16', 15000, 12000, 1, 16),
(17, '2021-11-03 18:35:52', '2021-11-03 18:45:52', 5000, 10000, 1, 16),
(18, '2021-11-03 20:18:27', '2021-11-03 20:23:27', 5000, 10000, 1, 11),
(19, '2021-11-03 23:36:07', '2021-11-04 00:36:07', 5000, 10000, 1, 11),
(20, '2021-11-04 01:00:07', '2021-11-05 00:36:07', 5000, 10000, 1, 11),
(21, '2021-11-03 23:39:48', '2021-11-04 23:39:48', 1115000, 12000, 1, 14),
(22, '2021-11-03 23:39:48', '2021-11-04 23:39:48', 1115000, 12000, 1, 14),
(23, '2021-11-03 23:39:48', '2021-11-04 23:39:48', 1115000, 12000, 1, 14),
(24, '2021-11-03 23:39:48', '2021-11-04 23:39:48', 1115000, 12000, 1, 14),
(25, '2021-11-03 23:39:48', '2021-11-04 23:39:48', 1115000, 12000, 1, 14),
(26, '2021-11-03 23:39:48', '2021-11-04 23:39:48', 1115000, 12000, 1, 14),
(27, '2021-11-03 23:39:48', '2021-11-04 23:39:48', 1115000, 12000, 1, 14),
(28, '2021-11-03 23:39:48', '2021-11-04 23:39:48', 1115000, 12000, 1, 14),
(29, '2021-11-03 23:39:48', '2021-11-04 23:39:48', 1115000, 12000, 1, 14),
(30, '2021-11-08 23:36:14', '2021-11-24 23:36:14', 100000, 10000, 1, 17),
(31, '2021-11-09 00:04:33', '2021-11-10 01:00:58', 15000, 10000, 1, 17);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quyen`
--

CREATE TABLE `tbl_quyen` (
  `iMaquyen` int(11) NOT NULL,
  `sTenquyen` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_quyen`
--

INSERT INTO `tbl_quyen` (`iMaquyen`, `sTenquyen`) VALUES
(1, 'Người mua'),
(2, 'Người bán'),
(9, 'Nhân viên quản lý'),
(10, 'Quản trị viên');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quyen_taikhoan`
--

CREATE TABLE `tbl_quyen_taikhoan` (
  `iMaquyen` int(11) NOT NULL,
  `iMataikhoan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_quyen_taikhoan`
--

INSERT INTO `tbl_quyen_taikhoan` (`iMaquyen`, `iMataikhoan`) VALUES
(1, 16),
(1, 18),
(1, 19),
(1, 20),
(1, 38),
(2, 17),
(9, 22),
(9, 30),
(9, 31),
(9, 32),
(9, 33),
(9, 35),
(9, 37),
(10, 21);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sanpham`
--

CREATE TABLE `tbl_sanpham` (
  `iMasanpham` int(11) NOT NULL,
  `iMadanhmuclh` int(11) NOT NULL,
  `sTensanpham` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sVideo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sMota` text COLLATE utf8_unicode_ci NOT NULL,
  `sThuonghieu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sChatlieu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sTinhtrang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `iTrangthai` tinyint(4) NOT NULL,
  `iNguoithem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_sanpham`
--

INSERT INTO `tbl_sanpham` (`iMasanpham`, `iMadanhmuclh`, `sTensanpham`, `sVideo`, `sMota`, `sThuonghieu`, `sChatlieu`, `sTinhtrang`, `iTrangthai`, `iNguoithem`) VALUES
(7, 11, 'iPhone 13', 'uploaded_files/92fa5db43ce0e2384afed7be86f708dc.mp4', 'al;dahlkdj', 'Apple IPhone', 'Kính', 'Nguyên seal', 1, 8),
(9, 11, 'Sony XZ2', 'uploaded_files/98bfb1db70dba87f0abb2747f950dfb7.mp4', '', 'Sony', 'Kính', 'Nguyên seal', 1, 8),
(10, 15, 'Áo khoác Cadigan', '', 'Áo khoác cardigan dành cho con trai', 'Sando', 'Vải coton', 'Mới', 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_taikhoan`
--

CREATE TABLE `tbl_taikhoan` (
  `iMataikhoan` int(11) NOT NULL,
  `sTendangnhap` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sMatkhau` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `iTrangthai` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_taikhoan`
--

INSERT INTO `tbl_taikhoan` (`iMataikhoan`, `sTendangnhap`, `sMatkhau`, `iTrangthai`) VALUES
(16, 'hung.buivan', '356a192b7913b04c54574d18c28d46e6395428ab', 2),
(17, 'hung.buivan1', '356a192b7913b04c54574d18c28d46e6395428ab', 2),
(18, 'bacdau030s2@gmail.com', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 1),
(19, 'bacdau030ss2@gmail.com', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 1),
(20, 'vanhung14.2.20171@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1),
(21, 'admin', '4aa4308c0c9cb7c2a5421d77ee0ba228d11410fe', 1),
(22, 'nhanvien', '356a192b7913b04c54574d18c28d46e6395428ab', 1),
(26, 'hung.buivan2', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 1),
(30, 'hung.buivan111', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 1),
(31, 'hung.buivan12', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 1),
(32, '17A10010043', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 2),
(33, '17A100100431', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 1),
(35, '17A1001004311', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 1),
(37, '17A10010043111', '2ea6201a068c5fa0eea5d81a3863321a87f8d533', 1),
(38, 'huyen@gmail.com', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_binhluan`
--
ALTER TABLE `tbl_binhluan`
  ADD PRIMARY KEY (`iMabinhluan`),
  ADD KEY `iMataikhoan` (`iMataikhoan`),
  ADD KEY `iMasanpham` (`iMasanpham`);

--
-- Indexes for table `tbl_ct_phiendaugia`
--
ALTER TABLE `tbl_ct_phiendaugia`
  ADD PRIMARY KEY (`iMataikhoan`,`iMaphiendaugia`,`dThoigiandaugia`),
  ADD KEY `tbl_ct_phiendaugia_ibfk_2` (`iMaphiendaugia`),
  ADD KEY `iMadonmua` (`iMadonmua`);

--
-- Indexes for table `tbl_ct_sanpham`
--
ALTER TABLE `tbl_ct_sanpham`
  ADD PRIMARY KEY (`iMactsanpham`),
  ADD KEY `iMasanpham` (`iMasanpham`),
  ADD KEY `iMamausac` (`iMamausac`),
  ADD KEY `iMasize` (`iMasize`);

--
-- Indexes for table `tbl_danhmucloaihang`
--
ALTER TABLE `tbl_danhmucloaihang`
  ADD PRIMARY KEY (`iMadanhmuclh`),
  ADD KEY `iMaloaihang` (`iMaloaihang`),
  ADD KEY `iNguoithem` (`iNguoithem`);

--
-- Indexes for table `tbl_donmuahang`
--
ALTER TABLE `tbl_donmuahang`
  ADD PRIMARY KEY (`iMadonmua`);

--
-- Indexes for table `tbl_hinhanh_sanpham`
--
ALTER TABLE `tbl_hinhanh_sanpham`
  ADD PRIMARY KEY (`iMasanpham`,`sHinhanh`);

--
-- Indexes for table `tbl_kichthuoc`
--
ALTER TABLE `tbl_kichthuoc`
  ADD PRIMARY KEY (`iMasize`),
  ADD KEY `iNguoithem` (`iNguoithem`);

--
-- Indexes for table `tbl_loaihang`
--
ALTER TABLE `tbl_loaihang`
  ADD PRIMARY KEY (`iMaloaihang`),
  ADD KEY `tbl_loaihang_ibfk_1` (`iNguoithem`);

--
-- Indexes for table `tbl_mausac`
--
ALTER TABLE `tbl_mausac`
  ADD PRIMARY KEY (`iMamausac`),
  ADD KEY `iNguoithem` (`iNguoithem`);

--
-- Indexes for table `tbl_nguoidung`
--
ALTER TABLE `tbl_nguoidung`
  ADD PRIMARY KEY (`iManguoidung`),
  ADD UNIQUE KEY `sEmail` (`sEmail`),
  ADD UNIQUE KEY `iSoCCCD` (`iSoCCCD`),
  ADD KEY `iMataikhoan` (`iMataikhoan`);

--
-- Indexes for table `tbl_phiendaugia`
--
ALTER TABLE `tbl_phiendaugia`
  ADD PRIMARY KEY (`iMaphiendaugia`),
  ADD KEY `iMactsanpham` (`iMactsanpham`);

--
-- Indexes for table `tbl_quyen`
--
ALTER TABLE `tbl_quyen`
  ADD PRIMARY KEY (`iMaquyen`);

--
-- Indexes for table `tbl_quyen_taikhoan`
--
ALTER TABLE `tbl_quyen_taikhoan`
  ADD PRIMARY KEY (`iMaquyen`,`iMataikhoan`),
  ADD KEY `tbl_quyen_taikhoan_ibfk_2` (`iMataikhoan`);

--
-- Indexes for table `tbl_sanpham`
--
ALTER TABLE `tbl_sanpham`
  ADD PRIMARY KEY (`iMasanpham`),
  ADD KEY `iMadanhmuclh` (`iMadanhmuclh`),
  ADD KEY `tbl_sanpham_ibfk_2` (`iNguoithem`);

--
-- Indexes for table `tbl_taikhoan`
--
ALTER TABLE `tbl_taikhoan`
  ADD PRIMARY KEY (`iMataikhoan`),
  ADD UNIQUE KEY `sTendangnhap` (`sTendangnhap`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_binhluan`
--
ALTER TABLE `tbl_binhluan`
  MODIFY `iMabinhluan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_ct_sanpham`
--
ALTER TABLE `tbl_ct_sanpham`
  MODIFY `iMactsanpham` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_danhmucloaihang`
--
ALTER TABLE `tbl_danhmucloaihang`
  MODIFY `iMadanhmuclh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_donmuahang`
--
ALTER TABLE `tbl_donmuahang`
  MODIFY `iMadonmua` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_kichthuoc`
--
ALTER TABLE `tbl_kichthuoc`
  MODIFY `iMasize` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_loaihang`
--
ALTER TABLE `tbl_loaihang`
  MODIFY `iMaloaihang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_mausac`
--
ALTER TABLE `tbl_mausac`
  MODIFY `iMamausac` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_nguoidung`
--
ALTER TABLE `tbl_nguoidung`
  MODIFY `iManguoidung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_phiendaugia`
--
ALTER TABLE `tbl_phiendaugia`
  MODIFY `iMaphiendaugia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tbl_quyen`
--
ALTER TABLE `tbl_quyen`
  MODIFY `iMaquyen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_sanpham`
--
ALTER TABLE `tbl_sanpham`
  MODIFY `iMasanpham` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_taikhoan`
--
ALTER TABLE `tbl_taikhoan`
  MODIFY `iMataikhoan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_binhluan`
--
ALTER TABLE `tbl_binhluan`
  ADD CONSTRAINT `tbl_binhluan_ibfk_1` FOREIGN KEY (`iMataikhoan`) REFERENCES `tbl_taikhoan` (`iMataikhoan`),
  ADD CONSTRAINT `tbl_binhluan_ibfk_2` FOREIGN KEY (`iMasanpham`) REFERENCES `tbl_sanpham` (`iMasanpham`);

--
-- Constraints for table `tbl_ct_phiendaugia`
--
ALTER TABLE `tbl_ct_phiendaugia`
  ADD CONSTRAINT `tbl_ct_phiendaugia_ibfk_1` FOREIGN KEY (`iMataikhoan`) REFERENCES `tbl_taikhoan` (`iMataikhoan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_ct_phiendaugia_ibfk_2` FOREIGN KEY (`iMaphiendaugia`) REFERENCES `tbl_phiendaugia` (`iMaphiendaugia`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_ct_phiendaugia_ibfk_4` FOREIGN KEY (`iMadonmua`) REFERENCES `tbl_donmuahang` (`iMadonmua`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_ct_sanpham`
--
ALTER TABLE `tbl_ct_sanpham`
  ADD CONSTRAINT `tbl_ct_sanpham_ibfk_1` FOREIGN KEY (`iMasanpham`) REFERENCES `tbl_sanpham` (`iMasanpham`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_ct_sanpham_ibfk_2` FOREIGN KEY (`iMamausac`) REFERENCES `tbl_mausac` (`iMamausac`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_ct_sanpham_ibfk_3` FOREIGN KEY (`iMasize`) REFERENCES `tbl_kichthuoc` (`iMasize`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_danhmucloaihang`
--
ALTER TABLE `tbl_danhmucloaihang`
  ADD CONSTRAINT `tbl_danhmucloaihang_ibfk_1` FOREIGN KEY (`iMaloaihang`) REFERENCES `tbl_loaihang` (`iMaloaihang`),
  ADD CONSTRAINT `tbl_danhmucloaihang_ibfk_2` FOREIGN KEY (`iNguoithem`) REFERENCES `tbl_taikhoan` (`iMataikhoan`);

--
-- Constraints for table `tbl_hinhanh_sanpham`
--
ALTER TABLE `tbl_hinhanh_sanpham`
  ADD CONSTRAINT `tbl_hinhanh_sanpham_ibfk_1` FOREIGN KEY (`iMasanpham`) REFERENCES `tbl_sanpham` (`iMasanpham`);

--
-- Constraints for table `tbl_kichthuoc`
--
ALTER TABLE `tbl_kichthuoc`
  ADD CONSTRAINT `tbl_kichthuoc_ibfk_1` FOREIGN KEY (`iNguoithem`) REFERENCES `tbl_taikhoan` (`iMataikhoan`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_loaihang`
--
ALTER TABLE `tbl_loaihang`
  ADD CONSTRAINT `tbl_loaihang_ibfk_1` FOREIGN KEY (`iNguoithem`) REFERENCES `tbl_taikhoan` (`iMataikhoan`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_mausac`
--
ALTER TABLE `tbl_mausac`
  ADD CONSTRAINT `tbl_mausac_ibfk_1` FOREIGN KEY (`iNguoithem`) REFERENCES `tbl_taikhoan` (`iMataikhoan`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_nguoidung`
--
ALTER TABLE `tbl_nguoidung`
  ADD CONSTRAINT `tbl_nguoidung_ibfk_1` FOREIGN KEY (`iMataikhoan`) REFERENCES `tbl_taikhoan` (`iMataikhoan`);

--
-- Constraints for table `tbl_phiendaugia`
--
ALTER TABLE `tbl_phiendaugia`
  ADD CONSTRAINT `tbl_phiendaugia_ibfk_1` FOREIGN KEY (`iMactsanpham`) REFERENCES `tbl_ct_sanpham` (`iMactsanpham`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_quyen_taikhoan`
--
ALTER TABLE `tbl_quyen_taikhoan`
  ADD CONSTRAINT `tbl_quyen_taikhoan_ibfk_1` FOREIGN KEY (`iMaquyen`) REFERENCES `tbl_quyen` (`iMaquyen`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_quyen_taikhoan_ibfk_2` FOREIGN KEY (`iMataikhoan`) REFERENCES `tbl_taikhoan` (`iMataikhoan`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_sanpham`
--
ALTER TABLE `tbl_sanpham`
  ADD CONSTRAINT `tbl_sanpham_ibfk_1` FOREIGN KEY (`iMadanhmuclh`) REFERENCES `tbl_danhmucloaihang` (`iMadanhmuclh`),
  ADD CONSTRAINT `tbl_sanpham_ibfk_2` FOREIGN KEY (`iNguoithem`) REFERENCES `tbl_nguoidung` (`iManguoidung`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
