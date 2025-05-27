-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 27, 2025 lúc 11:00 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shop_thoitrang`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bo_suu_tap`
--

CREATE TABLE `bo_suu_tap` (
  `bo_suu_tap_id` varchar(30) NOT NULL,
  `ten_bo_suu_tap` varchar(100) NOT NULL,
  `hinh_anh` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `bo_suu_tap`
--

INSERT INTO `bo_suu_tap` (`bo_suu_tap_id`, `ten_bo_suu_tap`, `hinh_anh`) VALUES
('1', 'BST_MH', 'mua_he.jpg'),
('2', 'BST_MD', 'mua_dong.jpg'),
('3', 'BST_MX', 'mua_xuan.jpg'),
('4', 'BST_MT', 'mua_thu.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bo_suu_tap_md`
--

CREATE TABLE `bo_suu_tap_md` (
  `san_pham_id` varchar(50) NOT NULL,
  `anh` varchar(50) NOT NULL,
  `gia_san_pham_md` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `bo_suu_tap_md`
--

INSERT INTO `bo_suu_tap_md` (`san_pham_id`, `anh`, `gia_san_pham_md`) VALUES
('AO002', 'imagin\\ao2.jpg', 450000),
('AO004', 'imagin\\ao4.jpg', 600000),
('AO006', 'imagin\\ao6.jpg', 350000),
('QU002', 'imagin\\quan2.jpg', 500000),
('QU004', 'imagin\\quan4.jpg', 2050000),
('QU006', 'imagin\\quan6.jpg', 370000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bo_suu_tap_mh`
--

CREATE TABLE `bo_suu_tap_mh` (
  `san_pham_id` varchar(11) NOT NULL,
  `hinh_anh` varchar(40) NOT NULL,
  `gia_san_pham_mh` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `bo_suu_tap_mh`
--

INSERT INTO `bo_suu_tap_mh` (`san_pham_id`, `hinh_anh`, `gia_san_pham_mh`) VALUES
('AO001', 'imagin\\ao1.jpg', 300000),
('AO003', 'imagin\\ao3.jpg', 400000),
('AO005', 'imagin\\ao5.jpg', 350000),
('QU001', 'imagin\\quan1.jpg', 150000),
('QU003', 'imagin\\quan3.jpg', 2500000),
('QU005', 'imagin\\quan5.jpg', 640000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bo_suu_tap_mt`
--

CREATE TABLE `bo_suu_tap_mt` (
  `san_pham_id` varchar(50) NOT NULL,
  `anh` varchar(50) NOT NULL,
  `gia_san_pham_mt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `bo_suu_tap_mt`
--

INSERT INTO `bo_suu_tap_mt` (`san_pham_id`, `anh`, `gia_san_pham_mt`) VALUES
('AO0011', 'imagin\\ao11.jpg', 630000),
('AO0012', 'imagin\\ao12.jpg', 480000),
('QU0011', 'imagin\\quan11.jpg', 330000),
('QU0012', 'imagin\\quan12.jpg', 270000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bo_suu_tap_mx`
--

CREATE TABLE `bo_suu_tap_mx` (
  `san_pham_id` varchar(50) NOT NULL,
  `anh` varchar(50) NOT NULL,
  `gia_san_pham_mx` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `bo_suu_tap_mx`
--

INSERT INTO `bo_suu_tap_mx` (`san_pham_id`, `anh`, `gia_san_pham_mx`) VALUES
('AO001', 'imagin\\ao1.jpg', 400000),
('AO007', 'imagin\\ao7.jpg', 300000),
('AO008', 'imagin\\ao8.jpg', 350000),
('AO009', 'imagin\\ao9.jpg', 2500000),
('QU0010', 'imagin\\quan10.jpg', 260000),
('QU007', 'imagin\\quan7.jpg', 500000),
('QU008', 'imagin\\quan8.jpg', 580000),
('QU009', 'imagin\\quan7.jpg', 360000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `don_hang`
--

CREATE TABLE `don_hang` (
  `id` int(11) NOT NULL,
  `san_pham_id` varchar(50) NOT NULL,
  `ho_ten` varchar(100) NOT NULL,
  `dia_chi` varchar(255) NOT NULL,
  `sdt` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `ghi_chu` text DEFAULT NULL,
  `ngay_dat` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `don_hang`
--

INSERT INTO `don_hang` (`id`, `san_pham_id`, `ho_ten`, `dia_chi`, `sdt`, `email`, `ghi_chu`, `ngay_dat`) VALUES
(2, 'AO0012', 'thảo', 'chuồng heo', '099999', 'bang19112005@gmail.com', 'áo đỏ', '2025-05-27 15:37:59');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuyen_mai`
--

CREATE TABLE `khuyen_mai` (
  `id` int(11) NOT NULL,
  `ten_san_pham` varchar(255) NOT NULL,
  `hinh_anh` varchar(255) NOT NULL,
  `gia_cu` int(11) NOT NULL,
  `gia_moi` int(11) NOT NULL,
  `ngay_bat_dau` date DEFAULT NULL,
  `ngay_ket_thuc` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khuyen_mai`
--

INSERT INTO `khuyen_mai` (`id`, `ten_san_pham`, `hinh_anh`, `gia_cu`, `gia_moi`, `ngay_bat_dau`, `ngay_ket_thuc`) VALUES
(1, 'Áo sơ mi nam công sở', 'imagin/ao1.jpg', 450000, 350000, '2025-05-01', '2025-05-10'),
(2, 'Váy dạ hội nữ', 'imagin/vay1.jpg', 1200000, 950000, '2025-05-05', '2025-05-20'),
(3, 'Giày thể thao unisex', 'imagin/giay1.jpg', 800000, 600000, '2025-05-01', '2025-05-31'),
(4, 'Túi xách nữ thời trang', 'imagin/tui.jpg', 650000, 480000, '2025-05-10', '2025-06-05'),
(5, 'Quần short nam mùa hè', 'imagin/quan5.jpg', 300000, 220000, '2025-05-03', '2025-05-18'),
(6, 'Áo khoác jean unisex', 'imagin/ao13.jpg', 900000, 720000, '2025-05-08', '2025-05-25'),
(7, 'Set phụ kiện nữ', 'imagin/day_chuyen.jpg', 350000, 250000, '2025-05-15', '2025-06-01'),
(8, 'Mũ lưỡi trai unisex', 'imagin/mu1.jpg', 200000, 150000, '2025-05-01', '2025-05-31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lien_he`
--

CREATE TABLE `lien_he` (
  `lien_he_id` int(11) NOT NULL,
  `lien_he_ho_ten` varchar(100) NOT NULL,
  `lien_he_email` varchar(100) NOT NULL,
  `lien_he_sdt` varchar(20) DEFAULT NULL,
  `lien_he_noi_dung` text NOT NULL,
  `lien_he_ngay_gui` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lien_he`
--

INSERT INTO `lien_he` (`lien_he_id`, `lien_he_ho_ten`, `lien_he_email`, `lien_he_sdt`, `lien_he_noi_dung`, `lien_he_ngay_gui`) VALUES
(1, 'lap', 'khaclap58@gmail.com', '012234', 'bán hàng quá rẻ', '2025-05-27 10:48:39'),
(2, 'ltao', 'khaclap58@gmail.com', '012234', 'bán hàng quá rẻ', '2025-05-27 10:51:33');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `san_pham`
--

CREATE TABLE `san_pham` (
  `san_pham_id` varchar(20) NOT NULL,
  `gia_san_pham` int(20) NOT NULL,
  `san_pham` varchar(30) NOT NULL,
  `hinh_anh` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `san_pham`
--

INSERT INTO `san_pham` (`san_pham_id`, `gia_san_pham`, `san_pham`, `hinh_anh`) VALUES
('AO001', 200, 'áo thun', 'imagin/ao1.jpg'),
('AO0011', 630000, 'áo giữ nhiệt nữ', 'imagin/ao11.jpg'),
('AO0012', 350, 'áo vest', 'imagin/ao12.jpg'),
('AO0017', 300, 'áo ba lỗ', 'imagin/ao2.jpg'),
('AO002', 450000, 'áo thun', 'imagin/ao2.jpg'),
('AO005', 200, 'áo khoác', 'imagin/ao5.jpg'),
('AO007', 500000, 'áo 3 lỗ', 'imagin/ao7.jpg'),
('AO008', 350000, 'áo phong đen', 'imagin/ao8.jpg'),
('AO009', 2500000, 'áo thun đen', 'imagin/ao9.jpg'),
('DA001', 250, 'váy hồng', 'imagin/vay1.jpg'),
('DA002', 250, 'đầm đỏ', 'imagin/dam1.jpg'),
('DA003', 380, 'đầm tím xanh', 'imagin/dam3.jpg'),
('DA004', 279, 'váy đen', 'imagin/dam4.jpg'),
('GI001', 500, 'giày thời trang xám', 'imagin/giay1.jpg'),
('GI003', 400, 'giày thời trang trắng', 'imagin/giay3.jpg'),
('GI004', 500, 'giày thể thao', 'imagin/giay4.jpg'),
('GI005', 500, 'giày thời trang đen', 'imagin/giay5.jpg'),
('QU001', 1500, 'Quần jean', 'imagin/quan1.jpg'),
('QU0010', 260000, 'Quần short', 'imagin/quan10.jpg'),
('QU003', 350, 'Quần tây', 'imagin/quan3.jpg'),
('QU005', 150, 'Quần thể thao', 'imagin/quan5.jpg'),
('QU006', 150, 'Quần short', 'imagin/quan6.jpg'),
('TS00', 1000, 'vòng tay', 'imagin/vong_tay.jpg'),
('TS001', 1500, 'đồng hồ', 'imagin/dong_ho1.jpg'),
('TS003', 1000, 'nhẫn', 'imagin/nhan1.jpg'),
('TS004', 1500, 'hột soàn', 'imagin/hot_soan.jpg');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bo_suu_tap_mx`
--
ALTER TABLE `bo_suu_tap_mx`
  ADD PRIMARY KEY (`san_pham_id`);

--
-- Chỉ mục cho bảng `don_hang`
--
ALTER TABLE `don_hang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `khuyen_mai`
--
ALTER TABLE `khuyen_mai`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `lien_he`
--
ALTER TABLE `lien_he`
  ADD PRIMARY KEY (`lien_he_id`);

--
-- Chỉ mục cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  ADD PRIMARY KEY (`san_pham_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `don_hang`
--
ALTER TABLE `don_hang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `khuyen_mai`
--
ALTER TABLE `khuyen_mai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `lien_he`
--
ALTER TABLE `lien_he`
  MODIFY `lien_he_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
