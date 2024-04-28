-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 28, 2024 at 03:23 AM
-- Server version: 5.7.17-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quanli`
--

-- --------------------------------------------------------

--
-- Table structure for table `chitietdonhang`
--

CREATE TABLE `chitietdonhang` (
  `ma_chi_tiet_don_hang` int(11) NOT NULL,
  `ma_don_hang` int(11) DEFAULT NULL,
  `ma_san_pham` int(11) DEFAULT NULL,
  `so_luong` int(11) DEFAULT NULL,
  `gia` decimal(10,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chitietdonhang`
--

INSERT INTO `chitietdonhang` (`ma_chi_tiet_don_hang`, `ma_don_hang`, `ma_san_pham`, `so_luong`, `gia`) VALUES
(51, 50, 1, 1, '22.000'),
(52, 51, 1, 3, '22.000'),
(53, 53, 1, 1, '22.000'),
(54, 53, 3, 1, '111.000'),
(55, 54, 1, 1, '22.000'),
(56, 54, 3, 1, '111.000');

-- --------------------------------------------------------

--
-- Table structure for table `danhgia`
--

CREATE TABLE `danhgia` (
  `ma_danh_gia` int(11) NOT NULL,
  `ma_san_pham` int(11) DEFAULT NULL,
  `ma_khach_hang` int(11) DEFAULT NULL,
  `ngay_danh_gia` date DEFAULT NULL,
  `danh_gia` int(11) DEFAULT NULL,
  `binh_luan` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `danhgia`
--

INSERT INTO `danhgia` (`ma_danh_gia`, `ma_san_pham`, `ma_khach_hang`, `ngay_danh_gia`, `danh_gia`, `binh_luan`) VALUES
(21, 1, 1, '2024-04-30', 1, 'Sản phẩm rất tốt, tôi rất hài lòng.'),
(22, 1, 1, '2024-05-01', 1, 'Chất lượng sản phẩm khá ổn định.'),
(23, 1, 1, '2024-05-02', 1, 'Sản phẩm không đáp ứng hết mong đợi.'),
(24, 1, 1, '2024-05-03', 1, 'Hài lòng với chất lượng sản phẩm.'),
(25, 1, 1, '2024-05-04', 1, 'Giá cả phải chăng, sản phẩm chất lượng.'),
(26, 1, 1, '2024-05-05', 1, 'Sản phẩm không như mong đợi.'),
(27, 1, 1, '2024-05-06', 1, 'Dịch vụ khá tốt, sản phẩm cũng ổn.'),
(29, 1, 1, '2024-05-08', 1, 'Sản phẩm đáng giá tiền.'),
(32, 1, 1, '2024-05-11', 1, 'Rất hài lòng với sản phẩm và dịch vụ.'),
(34, 1, 1, '2024-05-13', 1, 'Sản phẩm không đáp ứng mong đợi.'),
(35, 1, 1, '2024-05-14', 1, 'Sản phẩm khá ổn định.'),
(36, 1, 1, '2024-05-15', 1, 'Chất lượng sản phẩm tốt, hài lòng.'),
(37, 1, 1, '2024-05-16', 1, 'Giá cả phù hợp với chất lượng.');

-- --------------------------------------------------------

--
-- Table structure for table `donhang`
--

CREATE TABLE `donhang` (
  `ma_don_hang` int(11) NOT NULL,
  `ma_khach_hang` int(11) DEFAULT NULL,
  `ma_nhan_vien` int(11) DEFAULT NULL,
  `ngay_dat_hang` date DEFAULT NULL,
  `tong_tien` decimal(10,3) DEFAULT NULL,
  `trang_thai` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `donhang`
--

INSERT INTO `donhang` (`ma_don_hang`, `ma_khach_hang`, `ma_nhan_vien`, `ngay_dat_hang`, `tong_tien`, `trang_thai`) VALUES
(50, 1, 1, '2024-04-27', '22.000', 'Đang Xử Lý'),
(51, 1, 2, '2024-04-27', '66.000', 'Đang Xử Lý'),
(53, 1, 3, '2024-04-28', '133.000', 'Đang Xử Lý'),
(54, 1, 3, '2024-04-28', '133.000', 'Đang Xử Lý');

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `ma_khach_hang` int(11) NOT NULL,
  `ten_khach_hang` varchar(100) DEFAULT NULL,
  `email_khach_hang` varchar(100) DEFAULT NULL,
  `so_dien_thoai_khach_hang` varchar(20) DEFAULT NULL,
  `dia_chi` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`ma_khach_hang`, `ten_khach_hang`, `email_khach_hang`, `so_dien_thoai_khach_hang`, `dia_chi`) VALUES
(1, 'Ngô Thanh Vân', 'ngothanhtan@gmail.com', '0999999999', 'Cần Thơ'),
(4, 'Ngô Thanh Tân', 'ngothanhtan3@gmail.com', '0999999994', 'Hà Nội');

-- --------------------------------------------------------

--
-- Table structure for table `khuyenmai`
--

CREATE TABLE `khuyenmai` (
  `ma_khuyen_mai` int(11) NOT NULL,
  `ten_khuyen_mai` varchar(100) DEFAULT NULL,
  `ngay_bat_dau` date DEFAULT NULL,
  `ngay_ket_thuc` date DEFAULT NULL,
  `gia_tri` decimal(10,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `khuyenmai`
--

INSERT INTO `khuyenmai` (`ma_khuyen_mai`, `ten_khuyen_mai`, `ngay_bat_dau`, `ngay_ket_thuc`, `gia_tri`) VALUES
(2, 'Khuyến Mãi 30/4', '2024-04-06', '2024-05-04', '25.000');

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `ma_nhan_vien` int(11) NOT NULL,
  `ten_nhan_vien` varchar(100) DEFAULT NULL,
  `email_nhan_vien` varchar(100) DEFAULT NULL,
  `mat_khau_nhan_vien` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`ma_nhan_vien`, `ten_nhan_vien`, `email_nhan_vien`, `mat_khau_nhan_vien`) VALUES
(1, 'Nguyen Van A', 'nguyenvana@example.com', 'password123'),
(2, 'Tran Thi B', 'tranthib@example.com', 'securepass456'),
(3, 'Le Van C', 'nhanvien@gmail.com', 'nhanvien');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `ma_san_pham` int(11) NOT NULL,
  `ten_san_pham` varchar(100) DEFAULT NULL,
  `hinh_anh` varchar(255) DEFAULT NULL,
  `mo_ta` text,
  `gia` decimal(10,2) DEFAULT NULL,
  `so_luong_ton_kho` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`ma_san_pham`, `ten_san_pham`, `hinh_anh`, `mo_ta`, `gia`, `so_luong_ton_kho`) VALUES
(1, 'Áo thun lá', 'uploads/package.png', 'Demo', '22.00', 3),
(3, 'Áo Sơ Mii', 'uploads/package.png', 'Demo', '111.00', 11),
(5, 'Áo Tshirt', 'uploads/package.png', 'Demo', '22.00', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD PRIMARY KEY (`ma_chi_tiet_don_hang`),
  ADD KEY `ma_don_hang` (`ma_don_hang`),
  ADD KEY `ma_san_pham` (`ma_san_pham`);

--
-- Indexes for table `danhgia`
--
ALTER TABLE `danhgia`
  ADD PRIMARY KEY (`ma_danh_gia`),
  ADD KEY `ma_san_pham` (`ma_san_pham`),
  ADD KEY `ma_khach_hang` (`ma_khach_hang`);

--
-- Indexes for table `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`ma_don_hang`),
  ADD KEY `ma_khach_hang` (`ma_khach_hang`),
  ADD KEY `ma_nhan_vien` (`ma_nhan_vien`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`ma_khach_hang`);

--
-- Indexes for table `khuyenmai`
--
ALTER TABLE `khuyenmai`
  ADD PRIMARY KEY (`ma_khuyen_mai`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`ma_nhan_vien`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`ma_san_pham`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  MODIFY `ma_chi_tiet_don_hang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `danhgia`
--
ALTER TABLE `danhgia`
  MODIFY `ma_danh_gia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `donhang`
--
ALTER TABLE `donhang`
  MODIFY `ma_don_hang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `ma_khach_hang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `khuyenmai`
--
ALTER TABLE `khuyenmai`
  MODIFY `ma_khuyen_mai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `ma_nhan_vien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `ma_san_pham` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD CONSTRAINT `chitietdonhang_ibfk_1` FOREIGN KEY (`ma_don_hang`) REFERENCES `donhang` (`ma_don_hang`),
  ADD CONSTRAINT `chitietdonhang_ibfk_2` FOREIGN KEY (`ma_san_pham`) REFERENCES `sanpham` (`ma_san_pham`);

--
-- Constraints for table `danhgia`
--
ALTER TABLE `danhgia`
  ADD CONSTRAINT `danhgia_ibfk_1` FOREIGN KEY (`ma_san_pham`) REFERENCES `sanpham` (`ma_san_pham`),
  ADD CONSTRAINT `danhgia_ibfk_2` FOREIGN KEY (`ma_khach_hang`) REFERENCES `khachhang` (`ma_khach_hang`);

--
-- Constraints for table `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `donhang_ibfk_1` FOREIGN KEY (`ma_khach_hang`) REFERENCES `khachhang` (`ma_khach_hang`),
  ADD CONSTRAINT `donhang_ibfk_2` FOREIGN KEY (`ma_nhan_vien`) REFERENCES `nhanvien` (`ma_nhan_vien`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
