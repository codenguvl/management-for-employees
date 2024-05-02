-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 02, 2024 at 02:12 AM
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
(67, 70, 1, 1, '22.000'),
(68, 71, 1, 1, '22.000'),
(69, 72, 1, 1, '22.000'),
(70, 72, 3, 1, '111.000'),
(71, 73, 3, 1, '111.000'),
(73, 77, 3, 2, '111.000'),
(74, 77, 1, 1, '22.000'),
(75, 78, 3, 2, '111.000'),
(76, 78, 1, 1, '22.000'),
(77, 79, 1, 1, '22.000');

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
  `trang_thai` varchar(50) DEFAULT NULL,
  `id_khuyen_mai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `donhang`
--

INSERT INTO `donhang` (`ma_don_hang`, `ma_khach_hang`, `ma_nhan_vien`, `ngay_dat_hang`, `tong_tien`, `trang_thai`, `id_khuyen_mai`) VALUES
(70, 1, 3, '2024-05-04', '22.000', 'Đang Xử Lý', NULL),
(71, 1, 3, '2024-05-04', '22.000', 'Đang Xử Lý', NULL),
(72, 1, 3, '2024-05-10', '133.000', 'Đang Xử Lý', NULL),
(73, 1, 3, '2024-05-11', '86.000', 'Đang Xử Lý', 2),
(77, 1, 3, '2024-05-03', '222.000', 'Đang Xử Lý', 6),
(78, 1, 3, '2024-05-03', '222.000', 'Đang Xử Lý', 6),
(79, 1, 3, '2024-05-31', '22.000', 'Đang Xử Lý', NULL);

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
(2, 'Khuyến Mãi 30/44', '2024-04-06', '2024-04-30', '25.000'),
(5, 'Khuyến Mãi 30/4 - 1/5', '2024-04-30', '2024-05-02', '22.000'),
(6, 'Demo 1', '2024-05-01', '2024-05-04', '22.000'),
(7, 'Demo 2', '2024-04-29', '2024-04-30', '22.000'),
(8, 'Khuyến Mãi 30/44', '2024-05-01', '2024-05-02', '22.000');

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
(1, 'DEMI TEE 30', 'uploads/ao-thun-basic-local-brand-demi-4-6c09c3f9-9522-4af4-9909-0b87d7482979.png', 'Áo thun local brand giá rẻ chưa tới 200 cành thì có ai nghĩ nó tốt không. Nhưng khi đến với DEMI thì bạn sẽ được trải nghiệm những mẫu áo thun có chất lượng hoàn thiện tốt và có thiết hợp xu hướng. Có rất nhiều khách hàng đã đến với DEMI và có những trải nghiệm cực kì tốt về chất lượng áo thun nên bạn cứ tự tin đến và trải nghiệm.  ', '22.00', 3),
(3, 'ÁO KHOÁC LOCAL BRAND GIÁ RẺ DE-AK78', 'uploads/ao-khoac-local-brand-chinh-hang-demi-4-180edb2b-7e97-4b14-98e6-fa2d4bb79d6d.png', 'Áo khoác dù có thể thích nghi với nhiều phong cách và xu hướng thời trang. Đặc biệt, hiện nay có nhiều mẫu áo khoác dù có thiết kế đẹp có thể thu hút sự chú ý của các bạn trẻ thời hiện đại, vừa dễ dàng mua được ở mức giá phải chăng. DEMI xin giới thiệu mẫu áo khoác local brand giá rẻ chắc chắn tạo ấn tượng tốt trong lòng các cậu.', '111.00', 11);

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
  ADD KEY `ma_nhan_vien` (`ma_nhan_vien`),
  ADD KEY `fk_id_khuyen_mai` (`id_khuyen_mai`);

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
  MODIFY `ma_chi_tiet_don_hang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT for table `danhgia`
--
ALTER TABLE `danhgia`
  MODIFY `ma_danh_gia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `donhang`
--
ALTER TABLE `donhang`
  MODIFY `ma_don_hang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
--
-- AUTO_INCREMENT for table `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `ma_khach_hang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `khuyenmai`
--
ALTER TABLE `khuyenmai`
  MODIFY `ma_khuyen_mai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `ma_nhan_vien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `ma_san_pham` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
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
  ADD CONSTRAINT `donhang_ibfk_2` FOREIGN KEY (`ma_nhan_vien`) REFERENCES `nhanvien` (`ma_nhan_vien`),
  ADD CONSTRAINT `fk_id_khuyen_mai` FOREIGN KEY (`id_khuyen_mai`) REFERENCES `khuyenmai` (`ma_khuyen_mai`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
