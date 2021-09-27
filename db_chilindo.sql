-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 27, 2021 at 11:16 PM
-- Server version: 10.3.31-MariaDB-0ubuntu0.20.04.1
-- PHP Version: 7.4.23

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
  `iMactsanpham` int(11) NOT NULL,
  `iMaphiendaugia` int(11) NOT NULL,
  `dThoigiandaugia` datetime NOT NULL,
  `fMucgiadau` int(11) NOT NULL,
  `bTrangthaidaugia` bit(2) NOT NULL,
  `iMadonmua` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_danhmucloaihang`
--

CREATE TABLE `tbl_danhmucloaihang` (
  `iMadanhmuclh` int(11) NOT NULL,
  `sTendanhmuclh` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `iMaloaihang` int(11) NOT NULL,
  `bTrangthai` bit(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `sTensize` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_kichthuoc`
--

INSERT INTO `tbl_kichthuoc` (`iMasize`, `sTensize`) VALUES
(1, 'Size M'),
(2, 'Size L');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loaihang`
--

CREATE TABLE `tbl_loaihang` (
  `iMaloaihang` int(11) NOT NULL,
  `sTenloaihang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `iTrangthai` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_loaihang`
--

INSERT INTO `tbl_loaihang` (`iMaloaihang`, `sTenloaihang`, `iTrangthai`) VALUES
(2, 'Giày dép 1', 1),
(3, 'Đồ gia dụng', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mausac`
--

CREATE TABLE `tbl_mausac` (
  `iMamausac` int(11) NOT NULL,
  `sTenmausac` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_mausac`
--

INSERT INTO `tbl_mausac` (`iMamausac`, `sTenmausac`) VALUES
(2, 'Trắng');

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
(8, 20, 'Bùi Văn Hùng', '2021-09-15', b'111', '03292222617', 'Hoa Binh', 'vanhung14.2.20171@gmail.com', 1212, 2, 'Shop mun', 'Mô tả', NULL, NULL);

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
  `bTrangthaiphiendaugia` bit(4) NOT NULL COMMENT 'Phiên đấu giá chưa diễn ra, sắp diễn ra, đang diễn ra, đã diễn ra(thành công/không thành công)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `bTrangthai` bit(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(20, 'vanhung14.2.20171@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 3),
(21, 'admin', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 1),
(22, 'nhanvien', '356a192b7913b04c54574d18c28d46e6395428ab', 1),
(26, 'hung.buivan2', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 1),
(30, 'hung.buivan111', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 1),
(31, 'hung.buivan12', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 1),
(32, '17A10010043', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 2),
(33, '17A100100431', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 1),
(35, '17A1001004311', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 1),
(37, '17A10010043111', '2ea6201a068c5fa0eea5d81a3863321a87f8d533', 1);

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
  ADD PRIMARY KEY (`iMataikhoan`,`iMaphiendaugia`),
  ADD KEY `tbl_ct_phiendaugia_ibfk_2` (`iMaphiendaugia`),
  ADD KEY `tbl_ct_phiendaugia_ibfk_3` (`iMactsanpham`),
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
  ADD KEY `iMaloaihang` (`iMaloaihang`);

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
  ADD PRIMARY KEY (`iMasize`);

--
-- Indexes for table `tbl_loaihang`
--
ALTER TABLE `tbl_loaihang`
  ADD PRIMARY KEY (`iMaloaihang`);

--
-- Indexes for table `tbl_mausac`
--
ALTER TABLE `tbl_mausac`
  ADD PRIMARY KEY (`iMamausac`);

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
  ADD PRIMARY KEY (`iMaphiendaugia`);

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
  ADD KEY `iMadanhmuclh` (`iMadanhmuclh`);

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
  MODIFY `iMactsanpham` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_danhmucloaihang`
--
ALTER TABLE `tbl_danhmucloaihang`
  MODIFY `iMadanhmuclh` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_donmuahang`
--
ALTER TABLE `tbl_donmuahang`
  MODIFY `iMadonmua` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_kichthuoc`
--
ALTER TABLE `tbl_kichthuoc`
  MODIFY `iMasize` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_loaihang`
--
ALTER TABLE `tbl_loaihang`
  MODIFY `iMaloaihang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_mausac`
--
ALTER TABLE `tbl_mausac`
  MODIFY `iMamausac` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_nguoidung`
--
ALTER TABLE `tbl_nguoidung`
  MODIFY `iManguoidung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_phiendaugia`
--
ALTER TABLE `tbl_phiendaugia`
  MODIFY `iMaphiendaugia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_quyen`
--
ALTER TABLE `tbl_quyen`
  MODIFY `iMaquyen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_sanpham`
--
ALTER TABLE `tbl_sanpham`
  MODIFY `iMasanpham` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_taikhoan`
--
ALTER TABLE `tbl_taikhoan`
  MODIFY `iMataikhoan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

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
  ADD CONSTRAINT `tbl_ct_phiendaugia_ibfk_3` FOREIGN KEY (`iMactsanpham`) REFERENCES `tbl_ct_sanpham` (`iMactsanpham`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_ct_phiendaugia_ibfk_4` FOREIGN KEY (`iMadonmua`) REFERENCES `tbl_donmuahang` (`iMadonmua`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_ct_sanpham`
--
ALTER TABLE `tbl_ct_sanpham`
  ADD CONSTRAINT `tbl_ct_sanpham_ibfk_1` FOREIGN KEY (`iMasanpham`) REFERENCES `tbl_sanpham` (`iMasanpham`),
  ADD CONSTRAINT `tbl_ct_sanpham_ibfk_2` FOREIGN KEY (`iMamausac`) REFERENCES `tbl_mausac` (`iMamausac`),
  ADD CONSTRAINT `tbl_ct_sanpham_ibfk_3` FOREIGN KEY (`iMasize`) REFERENCES `tbl_kichthuoc` (`iMasize`);

--
-- Constraints for table `tbl_danhmucloaihang`
--
ALTER TABLE `tbl_danhmucloaihang`
  ADD CONSTRAINT `tbl_danhmucloaihang_ibfk_1` FOREIGN KEY (`iMaloaihang`) REFERENCES `tbl_loaihang` (`iMaloaihang`);

--
-- Constraints for table `tbl_hinhanh_sanpham`
--
ALTER TABLE `tbl_hinhanh_sanpham`
  ADD CONSTRAINT `tbl_hinhanh_sanpham_ibfk_1` FOREIGN KEY (`iMasanpham`) REFERENCES `tbl_sanpham` (`iMasanpham`);

--
-- Constraints for table `tbl_nguoidung`
--
ALTER TABLE `tbl_nguoidung`
  ADD CONSTRAINT `tbl_nguoidung_ibfk_1` FOREIGN KEY (`iMataikhoan`) REFERENCES `tbl_taikhoan` (`iMataikhoan`);

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
  ADD CONSTRAINT `tbl_sanpham_ibfk_1` FOREIGN KEY (`iMadanhmuclh`) REFERENCES `tbl_danhmucloaihang` (`iMadanhmuclh`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
