DROP TABLE `tbl_hinhanh_sanpham`;
CREATE TABLE `db_chilindo`.`tbl_hinhanh_sanpham` ( `iMahinhanh` INT NOT NULL AUTO_INCREMENT , `iMasanpham` INT NOT NULL , `sHinhanh` TEXT NOT NULL , `iTrangthai` TINYINT NOT NULL , PRIMARY KEY (`iMahinhanh`)) ENGINE = InnoDB;
ALTER TABLE `tbl_hinhanh_sanpham` ADD FOREIGN KEY (`iMasanpham`) REFERENCES `tbl_sanpham`(`iMasanpham`) ON DELETE RESTRICT ON UPDATE RESTRICT; 

ALTER TABLE `tbl_donmuahang` ADD `sDiachi` TEXT NOT NULL AFTER `dThoigianlap`, ADD `sSodienthoai` VARCHAR(20) NOT NULL AFTER `sDiachi`; 
ALTER TABLE `tbl_donmuahang` CHANGE `bTrangthai` `iTrangthai` TINYINT NOT NULL; 

ALTER TABLE `tbl_donmuahang` ADD `sNguoimuahuy` TEXT NULL AFTER `iTrangthai`, ADD `sNguoibanhuy` TEXT NULL AFTER `sNguoimuahuy`; 


### 01.12.2021
ALTER TABLE `tbl_taikhoan` ADD `iNguoithem` INT NULL AFTER `iTrangthai`; 

### 02.12.2021
ALTER TABLE `tbl_binhluan` CHANGE `bTrangthai` `iTrangthai` TINYINT(3) NULL; 