DROP TABLE `tbl_hinhanh_sanpham`;
CREATE TABLE `db_chilindo`.`tbl_hinhanh_sanpham` ( `iMahinhanh` INT NOT NULL AUTO_INCREMENT , `iMasanpham` INT NOT NULL , `sHinhanh` TEXT NOT NULL , `iTrangthai` TINYINT NOT NULL , PRIMARY KEY (`iMahinhanh`)) ENGINE = InnoDB;
ALTER TABLE `tbl_hinhanh_sanpham` ADD FOREIGN KEY (`iMasanpham`) REFERENCES `tbl_sanpham`(`iMasanpham`) ON DELETE RESTRICT ON UPDATE RESTRICT; 
