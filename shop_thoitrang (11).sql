-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 02, 2025 lúc 05:32 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

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
('1', 'Mùa hè', 'mua_he.jpg'),
('2', 'Mùa đông\r\n', 'mua_dong.jpg'),
('3', 'Mùa xuân', 'mua_xuan.jpg'),
('4', 'Mùa Thu', 'mua_thu.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bo_suu_tap_md`
--

CREATE TABLE `bo_suu_tap_md` (
  `san_pham_id` varchar(50) NOT NULL,
  `anh` varchar(50) NOT NULL,
  `gia_san_pham_md` int(11) NOT NULL,
  `ten_san_pham` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `bo_suu_tap_md`
--

INSERT INTO `bo_suu_tap_md` (`san_pham_id`, `anh`, `gia_san_pham_md`, `ten_san_pham`) VALUES
('AO002', 'imagin\\ao18.jpg', 450000, 'áo thun'),
('AO004', 'imagin\\ao4.jpg', 600000, 'áo GILE'),
('AO006', 'imagin\\ao6.jpg', 350000, 'áo thun đỏ'),
('QU002', 'imagin\\quan2.jpg', 500000, 'quần short'),
('QU004', 'imagin\\quan4.jpg', 205000, 'quần jean'),
('QU005', 'imagin\\quan5.jpg', 370000, 'quần short');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bo_suu_tap_mh`
--

CREATE TABLE `bo_suu_tap_mh` (
  `san_pham_id` varchar(11) NOT NULL,
  `hinh_anh` varchar(40) NOT NULL,
  `gia_san_pham_mh` int(11) NOT NULL,
  `ten_san_pham` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `bo_suu_tap_mh`
--

INSERT INTO `bo_suu_tap_mh` (`san_pham_id`, `hinh_anh`, `gia_san_pham_mh`, `ten_san_pham`) VALUES
('AO001', 'imagin\\ao1.jpg', 300000, 'áo thun'),
('AO003', 'imagin\\ao3.jpg', 400000, 'áo khoác blazer nữ'),
('AO005', 'imagin\\ao5.jpg', 350000, 'áo khoác'),
('QU001', 'imagin\\quan1.jpg', 150000, 'quần jean'),
('QU003', 'imagin\\quan3.jpg', 350000, 'quần tây'),
('QU005', 'imagin\\quan5.jpg', 150000, 'váy skort cơ bản 2 túi');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bo_suu_tap_mt`
--

CREATE TABLE `bo_suu_tap_mt` (
  `san_pham_id` varchar(50) NOT NULL,
  `anh` varchar(50) NOT NULL,
  `gia_san_pham_mt` int(11) NOT NULL,
  `ten_san_pham` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `bo_suu_tap_mt`
--

INSERT INTO `bo_suu_tap_mt` (`san_pham_id`, `anh`, `gia_san_pham_mt`, `ten_san_pham`) VALUES
('AO011', 'imagin\\ao11.jpg', 630000, 'áo giữ nhiệt nữ'),
('AO012', 'imagin\\ao12.jpg', 480000, 'áo vest'),
('QU011', 'imagin\\quan11.jpg', 330000, 'quần short'),
('QU012', 'imagin\\quan12.jpg', 270000, 'quần đùi đen');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bo_suu_tap_mx`
--

CREATE TABLE `bo_suu_tap_mx` (
  `san_pham_id` varchar(50) NOT NULL,
  `anh` varchar(50) NOT NULL,
  `gia_san_pham_mx` int(11) NOT NULL,
  `ten_san_pham` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `bo_suu_tap_mx`
--

INSERT INTO `bo_suu_tap_mx` (`san_pham_id`, `anh`, `gia_san_pham_mx`, `ten_san_pham`) VALUES
('AO001', 'imagin\\ao1.jpg', 300000, 'áo thun'),
('AO007', 'imagin\\ao7.jpg', 500000, 'áo 3 lỗ'),
('AO008', 'imagin\\ao8.jpg', 350000, 'áo phong đen'),
('AO009', 'imagin\\ao9.jpg', 250000, 'áo thun đen'),
('QU007', 'imagin\\quan7.jpg', 250000, 'quần đùi hồng'),
('QU008', 'imagin\\quan8.jpg', 580000, 'quần short'),
('QU009', 'imagin\\quan9.jpg', 360000, 'quần đùi nam'),
('QU010', 'imagin\\quan10.jpg', 260000, 'quần thun đen dài');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_gio_hang`
--

CREATE TABLE `chi_tiet_gio_hang` (
  `chi_tiet_id` int(11) NOT NULL,
  `gio_hang_id` int(11) NOT NULL,
  `san_pham_id` varchar(20) NOT NULL,
  `so_luong` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_gio_hang`
--

INSERT INTO `chi_tiet_gio_hang` (`chi_tiet_id`, `gio_hang_id`, `san_pham_id`, `so_luong`) VALUES
(40, 67, 'AO0011', 1);

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
(2, 'AO0012', 'thảo', 'chuồng heo', '099999', 'bang19112005@gmail.com', 'áo đỏ', '2025-05-27 15:37:59'),
(3, 'AO001', 'lap', 'quy nhon', '012234', 'khaclap58@gmail.com', '', '2025-06-02 21:32:17');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gio_hang`
--

CREATE TABLE `gio_hang` (
  `gio_hang_id` int(11) NOT NULL,
  `phien_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `gio_hang`
--

INSERT INTO `gio_hang` (`gio_hang_id`, `phien_id`) VALUES
(1, '6835787125c7a'),
(67, '6835c949cf20a'),
(145, '6835e6702ce34'),
(285, '683653c697f26'),
(297, '68366014eebc3'),
(299, '683dab6e723c4'),
(301, '683db3a0ef223');

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
  `ngay_ket_thuc` date DEFAULT NULL,
  `san_pham_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khuyen_mai`
--

INSERT INTO `khuyen_mai` (`id`, `ten_san_pham`, `hinh_anh`, `gia_cu`, `gia_moi`, `ngay_bat_dau`, `ngay_ket_thuc`, `san_pham_id`) VALUES
(1, 'Áo sơ mi nam công sở', 'imagin/ao1.jpg', 450000, 350000, '2025-05-01', '2025-05-10', 'AO001'),
(2, 'Váy dạ hội nữ', 'imagin/vay1.jpg', 1200000, 950000, '2025-05-05', '2025-05-20', 'DA001'),
(3, 'Giày thể thao unisex', 'imagin/giay1.jpg', 800000, 600000, '2025-05-01', '2025-05-31', 'GI001'),
(4, 'Túi xách nữ thời trang', 'imagin/tui.jpg', 650000, 480000, '2025-05-10', '2025-06-05', 'TS002'),
(5, 'Quần short nam mùa hè', 'imagin/quan5.jpg', 300000, 220000, '2025-05-03', '2025-05-18', 'QU005'),
(6, 'Áo khoác jean unisex', 'imagin/ao13.jpg', 900000, 720000, '2025-05-08', '2025-05-25', 'AO13');

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
('AO001', 300000, 'áo thun', 'imagin/ao1.jpg'),
('AO0017', 500000, 'áo ba lỗ', 'imagin/ao2.jpg'),
('AO002', 450000, 'áo thun Việt Nam', 'imagin/ao18.jpg'),
('AO003', 400000, 'áo khoác blazer nữ', 'imagin/ao3.jpg'),
('AO004', 600000, 'áo GILE', 'imagin/ao4.jpg'),
('AO005', 350000, 'áo khoác', 'imagin/ao5.jpg'),
('AO006', 350000, 'áo thun đỏ', 'imagin/ao6.jpg'),
('AO007', 500000, 'áo 3 lỗ', 'imagin/ao7.jpg'),
('AO008', 350000, 'áo phong đen', 'imagin/ao8.jpg'),
('AO009', 250000, 'áo thun đen', 'imagin/ao9.jpg'),
('AO011', 630000, 'áo giữ nhiệt nữ', 'imagin/ao11.jpg'),
('AO012', 480000, 'áo vest', 'imagin/ao12.jpg'),
('AO13', 250000, 'áo evisu', 'imagin/ao13.jpg'),
('DA001', 250000, 'váy hồng', 'imagin/vay1.jpg'),
('DA002', 250000, 'đầm đỏ', 'imagin/dam1.jpg'),
('DA003', 380000, 'đầm tím xanh', 'imagin/dam3.jpg'),
('DA004', 279000, 'váy đen', 'imagin/dam4.jpg'),
('GI001', 500000, 'giày thời trang xám', 'imagin/giay1.jpg'),
('GI003', 400000, 'giày thời trang trắng', 'imagin/giay3.jpg'),
('GI004', 500000, 'giày thể thao', 'imagin/giay4.jpg'),
('GI005', 500000, 'giày thời trang đen', 'imagin/giay5.jpg'),
('QU001', 150000, 'Quần jean', 'imagin/quan1.jpg'),
('QU002', 500000, 'quần short', 'imagin/quan2.jpg'),
('QU003', 350000, 'Quần tây', 'imagin/quan3.jpg'),
('QU004', 205000, 'quần jean', 'imagin/quan4.jpg'),
('QU005', 150000, 'Quần thể thao', 'imagin/quan5.jpg'),
('QU006', 150000, 'Quần short', 'imagin/quan6.jpg'),
('QU007', 250000, 'quần đùi hồng', 'imagin/quan7.jpg'),
('QU008', 580000, 'Quần Jean ngắn', 'imagin/quan8.jpg'),
('QU009', 360000, 'Quần đùi nam', 'imagin/quan9.jpg'),
('QU010', 260000, 'Quần short', 'imagin/quan10.jpg'),
('QU012', 270000, 'Quần đùi đen', 'imagin/quan12.jpg'),
('TS00', 1000000, 'vòng tay', 'imagin/vongtay5.jpg'),
('TS001', 1500000, 'đồng hồ', 'imagin/dongho5.jpg'),
('TS002', 4800000, 'Túi xách nữ thời trang', 'imagin/tui2.jpg'),
('TS003', 1000000, 'nhẫn', 'imagin/nhan1.jpg'),
('TS004', 1500000, 'hột soàn', 'imagin/hot_soan.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created_at`) VALUES
(1, 'admin', '$2y$10$2N/102tapT07MzSGpeNVieTzaKD1wwTLazOxv3rJ8jHyHWm0DvzWS', 'khaclap58@gmail.com', '2025-06-02 21:31:33'),
(2, 'admin1', '$2y$10$PG.N9zhHA2xdqMrNGVKJe.FOeKQnkKrhbaBZoGy0bHqpmPyEUjY7C', 'phanthinh.2550@gmail.com', '2025-06-02 21:32:03');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bo_suu_tap`
--
ALTER TABLE `bo_suu_tap`
  ADD PRIMARY KEY (`bo_suu_tap_id`);

--
-- Chỉ mục cho bảng `bo_suu_tap_md`
--
ALTER TABLE `bo_suu_tap_md`
  ADD PRIMARY KEY (`san_pham_id`);

--
-- Chỉ mục cho bảng `bo_suu_tap_mh`
--
ALTER TABLE `bo_suu_tap_mh`
  ADD PRIMARY KEY (`san_pham_id`);

--
-- Chỉ mục cho bảng `bo_suu_tap_mt`
--
ALTER TABLE `bo_suu_tap_mt`
  ADD PRIMARY KEY (`san_pham_id`);

--
-- Chỉ mục cho bảng `bo_suu_tap_mx`
--
ALTER TABLE `bo_suu_tap_mx`
  ADD PRIMARY KEY (`san_pham_id`);

--
-- Chỉ mục cho bảng `chi_tiet_gio_hang`
--
ALTER TABLE `chi_tiet_gio_hang`
  ADD PRIMARY KEY (`chi_tiet_id`),
  ADD KEY `gio_hang_id` (`gio_hang_id`),
  ADD KEY `san_pham_id` (`san_pham_id`);

--
-- Chỉ mục cho bảng `don_hang`
--
ALTER TABLE `don_hang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD PRIMARY KEY (`gio_hang_id`),
  ADD UNIQUE KEY `phien_id` (`phien_id`);

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
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chi_tiet_gio_hang`
--
ALTER TABLE `chi_tiet_gio_hang`
  MODIFY `chi_tiet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT cho bảng `don_hang`
--
ALTER TABLE `don_hang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `gio_hang`
--
ALTER TABLE `gio_hang`
  MODIFY `gio_hang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=324;

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

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
