-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 27, 2017 lúc 09:09 AM
-- Phiên bản máy phục vụ: 10.1.25-MariaDB
-- Phiên bản PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `tnh_project`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiet_donhang`
--

CREATE TABLE `chitiet_donhang` (
  `dh_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'Mã đơn hàng',
  `sp_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'Mã sản phẩm',
  `ctdh_soLuong` smallint(5) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Số lượng sản phẩm đặt mua',
  `ctdh_donGia` int(10) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Giá bán'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chitiet_donhang`
--

INSERT INTO `chitiet_donhang` (`dh_ma`, `sp_ma`, `ctdh_soLuong`, `ctdh_donGia`) VALUES
(1, 47, 1, 40990000),
(2, 36, 1, 145000),
(2, 39, 1, 410000),
(3, 43, 18, 24000),
(4, 35, 1, 390000),
(5, 33, 1, 900000),
(6, 45, 1, 16890000),
(7, 25, 1, 398000),
(7, 28, 1, 360000),
(8, 46, 1, 49990000),
(9, 15, 1, 75000),
(9, 20, 1, 160000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiet_phieunhap`
--

CREATE TABLE `chitiet_phieunhap` (
  `pn_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'Mã phiếu nhập',
  `sp_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'Mã sản phẩm',
  `ctn_soLuong` smallint(5) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Số lượng sản phẩm nhập kho',
  `ctn_donGia` int(10) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Giá nhập kho của sản phẩm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chude`
--

CREATE TABLE `chude` (
  `cd_ma` tinyint(3) UNSIGNED NOT NULL COMMENT 'Mã chủ đề',
  `cd_ten` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên chủ đề',
  `cd_dienGiai` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Diễn giải chủ đề sản phẩm',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chude`
--

INSERT INTO `chude` (`cd_ma`, `cd_ten`, `cd_dienGiai`, `created_at`, `updated_at`) VALUES
(1, 'Tiêu dùng', 'Các mặt hàng tiêu dùng: bột giặt, nước rửa chén, thuốc tẩy,...', '2017-10-28 12:48:36', '2017-10-28 12:48:36'),
(2, 'Thực phẩm', 'Đồ hộp, đồ ăn liền, bánh kẹo, gạo,...', '2017-10-28 13:10:26', '2017-10-29 03:26:14'),
(3, 'Đồ uống', 'Nước ngọt, nước có gas, cafe, bia rượu, sữa,...', '2017-10-28 13:11:08', '2017-10-28 13:11:08'),
(4, 'Thời trang', 'Tất cả mặt hàng quần áo, giày dép, túi xách,...', '2017-10-28 13:12:40', '2017-10-28 13:12:40'),
(6, 'Mỹ phẩm', 'Nước hoa, kem dưỡng da, bột tắm trắng,...', '2017-10-28 13:14:43', '2017-10-28 13:14:43'),
(7, 'Đồ chơi - quà tặng', 'Đồ chơi trẻ em, đồ chơi công nghệ, đồ handmade, quà tặng các loại,...', '2017-10-28 13:18:09', '2017-10-28 13:18:09'),
(8, 'Điện tử - tin học', 'Máy tính (desktop & laptop), linh kiện máy vi tính,...', '2017-10-28 13:20:01', '2017-10-28 13:20:01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `dh_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'Mã đơn hàng',
  `kh_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'Mã khách hàng',
  `dh_thoiGianDatHang` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Thời điểm đặt hàng',
  `dh_thoiGianNhanHang` datetime NOT NULL COMMENT 'Thời điểm giao hàng theo yêu cầu của khách hàng',
  `dh_diaChi` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Địa chỉ người nhận',
  `dh_dienThoai` varchar(12) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Số điện thoại người nhận',
  `nv_xuLy` smallint(5) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Mã nhân viên (người xử lý đơn hàng)',
  `dh_trangThai` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Trạng thái đơn hàng: 1-nhận đơn, 2-xử lý đơn',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`dh_ma`, `kh_ma`, `dh_thoiGianDatHang`, `dh_thoiGianNhanHang`, `dh_diaChi`, `dh_dienThoai`, `nv_xuLy`, `dh_trangThai`, `created_at`, `updated_at`) VALUES
(1, 1, '2017-11-27 14:31:55', '2017-11-27 14:31:55', 'Sóc Trăng', '01234192291', 1, 1, '2017-11-27 07:31:55', '2017-11-27 07:31:55'),
(2, 1, '2017-11-27 14:32:53', '2017-11-27 14:32:53', 'Sóc Trăng', '01234192291', 1, 1, '2017-11-27 07:32:53', '2017-11-27 07:32:53'),
(3, 1, '2017-11-27 14:33:50', '2017-11-27 14:33:50', 'Sóc Trăng', '01234192291', 1, 1, '2017-11-27 07:33:50', '2017-11-27 07:33:50'),
(4, 1, '2017-11-27 14:37:01', '2017-11-27 14:37:01', 'Sóc Trăng', '01234192291', 1, 1, '2017-11-27 07:37:01', '2017-11-27 07:37:01'),
(5, 2, '2017-11-27 14:40:35', '2017-11-27 14:40:35', 'Đà Nẵng', '0966789987', 1, 1, '2017-11-27 07:40:35', '2017-11-27 07:40:35'),
(6, 2, '2017-11-27 14:41:22', '2017-11-27 14:41:22', 'Đà Nẵng', '0966789987', 1, 1, '2017-11-27 07:41:22', '2017-11-27 07:41:22'),
(7, 2, '2017-11-27 14:42:36', '2017-11-27 14:42:36', 'Đà Nẵng', '0966789987', 1, 1, '2017-11-27 07:42:36', '2017-11-27 07:42:36'),
(8, 2, '2017-11-27 14:43:00', '2017-11-27 14:43:00', 'Đà Nẵng', '0966789987', 1, 1, '2017-11-27 07:43:00', '2017-11-27 07:43:00'),
(9, 2, '2017-11-27 14:44:48', '2017-11-27 14:44:48', 'Đà Nẵng', '0966789987', 1, 1, '2017-11-27 07:44:48', '2017-11-27 07:44:48');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hinhanh`
--

CREATE TABLE `hinhanh` (
  `ha_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'Mã hình ảnh',
  `sp_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'Mã sản phẩm',
  `ha_stt` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Số thứ tự hình ảnh của mỗi sản phẩm',
  `ha_ten` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên hình ảnh (không bao gồm đường dẫn)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hinhanh`
--

INSERT INTO `hinhanh` (`ha_ma`, `sp_ma`, `ha_stt`, `ha_ten`) VALUES
(1, 47, 1, '47_1_913201720152AM_635_iphone_x.jpeg'),
(2, 47, 2, '47_2_2a64489aacd05da56e2e63656b6f4199.png'),
(3, 47, 3, '47_3_iphone-x-silver-space-gray.jpg'),
(4, 46, 1, '46_1_913201720152AM_635_iphone_x.jpeg'),
(5, 45, 1, '45_1_636352845663072547_Dell-Vostro-V5568-1.png'),
(6, 45, 2, '45_2_636187232422703663_dell-vostro-v5568i5-7200uwin10-2.jpg'),
(10, 45, 3, '45_3_product_s5747.jpg'),
(11, 46, 2, '46_2_iphone-x-silver-space-gray.jpg'),
(12, 44, 1, '44_1_apple-macbook-air-mqd42sa-a-i5-5350u-8gb-256gb-bac.jpg'),
(13, 44, 2, '44_2_macbook-air-13-256gb-5.jpg'),
(14, 44, 3, '44_3_og.png'),
(20, 43, 1, '43_1_tap-3_2.jpg'),
(21, 42, 1, '42_1_tap-1_2__1_1.jpg'),
(22, 41, 1, '41_1_14472378905158.jpg'),
(23, 40, 1, '40_1_bo-xep-hinhlego1000-chi-tiet.jpg'),
(24, 39, 1, '39_1_kem-duong-trang-da-3W-Clinic-Collagen-khuyen-mai (4).jpg'),
(25, 39, 2, '39_2_kem-trang-3w.jpg'),
(26, 38, 1, '38_1_nuoc-hoa-nu-jolie-dion-charm-eau-de-parfum-60ml.jpg'),
(27, 37, 1, '37_1_little-red-dress.jpg'),
(28, 36, 1, '36_1_duong-the-vaseline.jpg'),
(32, 35, 1, '35_1_hang-nhap-cao-cap-dam-maxi.jpg'),
(36, 35, 2, '35_2_hang-nhap-cao-cap-dam-maxi.jpg'),
(37, 34, 1, '34_1_so-mi-tay-doi-hang-nhap-cao-cap.jpg'),
(38, 34, 2, '34_2_so-mi-tay-doi-hang-nhap-cao-cap.jpg'),
(39, 33, 1, '33_1_cea4ae8720db301e.jpg'),
(40, 33, 2, '33_2_ao-khoac-da-33.jpg'),
(41, 32, 1, '32_1_ao-so-mi-nam.jpg'),
(42, 31, 1, '31_1_giay-cao-got-nu-khoet-eo-hau.jpg'),
(43, 30, 1, '30_1_giay-cao-got-anh-kim-cao-cap.jpg'),
(44, 29, 1, '29_1_zRWqrJ_simg_b5529c_250x250_maxb.jpg'),
(45, 28, 1, '28_1_giay-sneaker-nam-278-1m4G3-HsM6V4.png'),
(46, 27, 1, '27_1_quan-jean-lung-cao-rach-1-nut-ong-suong-vq147-v160-1.jpg'),
(47, 26, 1, '26_1_qd254-1m4G3-Rna8yh_simg_d0daf0_800x1200_max.jpg'),
(48, 25, 1, '25_1_jean-nam-cao-cap-1m4G3-SHTNUO.jpg'),
(49, 24, 1, '24_1_jean-wash-gia-si-119k-124k-zalo-xem-them-mau-0981483633-1m4G3-GDNaEB.jpg'),
(50, 23, 1, '23_1_2_540-min_grande.jpg'),
(51, 22, 1, '22_1_Sữa-tươi-tiệt-trùng-tách-béo-Vinamilk-có-đường-lốc-4-hộp-x-180ml-1.jpg'),
(52, 21, 1, '21_1_nuoc-tang-luc-samurai-390ml-x-6-700x467-2.jpg'),
(53, 20, 1, '20_1_coca390-2460.jpg'),
(54, 20, 2, '20_2_sanpham310.png'),
(55, 19, 1, '19_1_321f81707cd2f166dc94a67dec3af964.jpg'),
(56, 18, 1, '18_1_bo-02-hop-muc-rim-sa-te-an-lien-dac-san-phan-thiet-150g-1502062225-7793467-ba6d02edcf3dbdfb2e0f0dbaa66f4c45-product.jpg'),
(57, 17, 1, '17_1_mi-gau-do-tom-chua-cay-65g-thung-30-goi-1-700x467-1.jpg'),
(58, 16, 1, '16_1_mi-hao-hao-xao-kho-tom-hanh-75g-thung-30-goi-1.jpg'),
(59, 15, 1, '15_1_1487665567998_5321079.jpg'),
(60, 14, 1, '14_1_1497417594253_6473135.jpg'),
(61, 13, 1, '13_1_banh-quy-lua-my-mcvities-digestive-socola-sua-200g-p257.jpg'),
(62, 12, 1, '12_1_1474017406641_1572320.jpg'),
(63, 11, 1, '11_1_150149651184_3099957.jpg'),
(64, 10, 1, '10_1_pouch_1.jpg'),
(65, 9, 1, '9_1_n1wnt5old415k.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadon`
--

CREATE TABLE `hoadon` (
  `hd_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'Mã hóa đơn',
  `nv_lapHoaDon` smallint(5) UNSIGNED NOT NULL COMMENT 'Mã nhân viên (người lập hóa đơn)',
  `hd_ngayXuatHoaDon` datetime NOT NULL COMMENT 'Thời điểm xuất hóa đơn',
  `dh_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'Mã đơn hàng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `kh_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'Mã khách hàng',
  `kh_hoTen` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Họ tên khách hàng',
  `kh_gioiTinh` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Giới tính: 1-Nam, 2-Nữ',
  `kh_diaChi` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NULL' COMMENT 'Địa chỉ khách hàng',
  `kh_dienThoai` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NULL' COMMENT 'Số điện thoại khách hàng',
  `kh_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Email khách hàng',
  `kh_matKhau` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Mật khẩu',
  `kh_nhom` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Nhóm khách hàng: 1-thường, 2-đại lý',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`kh_ma`, `kh_hoTen`, `kh_gioiTinh`, `kh_diaChi`, `kh_dienThoai`, `kh_email`, `kh_matKhau`, `kh_nhom`, `created_at`, `updated_at`) VALUES
(1, 'Đoàn Thanh Tiền', 2, 'Sóc Trăng', '01234192291', 'dttien@gmail.com', '$2y$10$kjPeJ.hOK35us7YE2PdBFu0tgDHrwJIJPD4RVj3FnlFCmJZcDfJt2', 1, '2017-11-08 00:45:48', '2017-11-08 00:45:48'),
(2, 'Nguyễn Văn Tuấn Phong', 1, 'Đà Nẵng', '0966789987', 'nvtphong@yahoo.com', '$2y$10$Duy8fn9fjVf7hSNyg2CK0O4GpfeW5R9mIdlu1cMqyFf.0.sMeT38.', 1, '2017-11-08 00:48:55', '2017-11-08 00:48:55');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuyenmai`
--

CREATE TABLE `khuyenmai` (
  `km_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'Mã chương trình khuyến mãi',
  `km_ten` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên chương trình khuyến mãi',
  `km_noiDung` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Nội dung chi tiết chương trình khuyến mãi',
  `km_batDau` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Thời điểm lập kế hoạch khuyến mãi',
  `km_ketThuc` datetime DEFAULT NULL COMMENT 'Thời điểm kết thúc khuyến mãi',
  `km_trangThai` tinyint(3) UNSIGNED NOT NULL DEFAULT '2' COMMENT 'Trạng thái chương trình khuyến mãi: 1-ngưng khuyến mãi, 2-lập kế hoạch, 3-duyệt kế hoạch',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuyenmai_sanpham`
--

CREATE TABLE `khuyenmai_sanpham` (
  `km_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'Chương trình # km_ma # km_ten # Mã chương trình khuyến mãi',
  `sp_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'Mã sản phẩm',
  `kmsp_giaTri` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '10' COMMENT 'Giá trị khuyến mãi: giảm % tiền trên giá sản phẩm (mặc định 10%)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaisanpham`
--

CREATE TABLE `loaisanpham` (
  `l_ma` tinyint(3) UNSIGNED NOT NULL COMMENT 'Mã loại sản phẩm',
  `l_ten` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên loại sản phẩm',
  `l_dienGiai` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Diễn giải về loại sản phẩm',
  `l_trangThai` tinyint(4) NOT NULL DEFAULT '2' COMMENT 'Trạng thái loại sản phẩm: 1-khóa, 2-khả dụng',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cd_ma` tinyint(3) UNSIGNED NOT NULL COMMENT 'Mã chủ đề'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loaisanpham`
--

INSERT INTO `loaisanpham` (`l_ma`, `l_ten`, `l_dienGiai`, `l_trangThai`, `created_at`, `updated_at`, `cd_ma`) VALUES
(1, 'Bột giặt', 'Bột giặt, nước giặt, nước xả vải,...', 2, '2017-10-30 03:07:00', '2017-10-30 03:07:00', 1),
(2, 'Nước rửa chén', NULL, 2, '2017-10-30 03:14:13', '2017-10-30 03:14:13', 1),
(3, 'Bánh kẹo', 'Bánh kẹo các loại', 2, '2017-10-30 03:15:40', '2017-10-30 03:15:40', 2),
(4, 'Mì ăn liền', 'Mì gói các loại', 2, '2017-10-30 03:18:10', '2017-10-30 03:18:10', 2),
(5, 'Nước hoa', 'Nước hoa, dầu thơm,...', 2, '2017-10-30 03:19:00', '2017-10-30 03:19:00', 6),
(6, 'Kem dưỡng da', NULL, 2, '2017-10-30 03:19:15', '2017-10-30 03:19:15', 6),
(7, 'Sữa tắm', NULL, 2, '2017-10-30 03:20:10', '2017-10-30 03:20:10', 6),
(8, 'Nước ngọt có gas', 'Nước trái cây, nước ngọt có gas', 2, '2017-10-30 03:23:42', '2017-10-30 03:42:47', 3),
(9, 'Rượu', NULL, 2, '2017-10-30 03:23:52', '2017-10-30 03:23:52', 3),
(10, 'Bia', NULL, 2, '2017-10-30 03:23:57', '2017-10-30 03:41:16', 3),
(11, 'Đồ hộp', NULL, 2, '2017-10-30 13:10:56', '2017-10-30 13:10:56', 2),
(12, 'Sữa', 'Sữa tươi, sữa có đường, sữa không đường,...', 2, '2017-10-30 13:12:02', '2017-10-30 13:12:02', 3),
(13, 'Quần jeans nam', NULL, 2, '2017-10-30 13:15:07', '2017-10-30 13:15:07', 4),
(14, 'Quần jeans nữ', NULL, 2, '2017-10-30 13:15:18', '2017-10-30 13:15:18', 4),
(15, 'Giày nam', 'Giày, dép, giày sneaker, giày công sở,...', 2, '2017-10-30 13:17:20', '2017-10-30 13:17:20', 4),
(16, 'Giày nữ', 'Giày, dép, giày sneaker nữ, giày cao gót,...', 2, '2017-10-30 13:18:14', '2017-10-30 13:18:14', 4),
(17, 'Áo nam', 'Áo thun, áo sơ mi, áo khoác nam,...', 2, '2017-10-30 13:18:48', '2017-10-30 13:18:48', 4),
(18, 'Áo nữ', 'Áo thun, áo sơ mi, áo khoác, áo len nữ,...', 2, '2017-10-30 13:19:40', '2017-10-30 13:19:40', 4),
(19, 'Lego', NULL, 2, '2017-10-30 13:24:07', '2017-10-30 13:24:07', 7),
(20, 'Laptop', NULL, 2, '2017-10-30 13:26:54', '2017-10-30 13:26:54', 8),
(22, 'Sách tô màu', NULL, 2, '2017-10-30 13:38:30', '2017-10-30 13:38:30', 7),
(23, 'Điện thoại', NULL, 2, '2017-10-30 13:41:37', '2017-10-30 13:41:37', 8);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2017_10_20_140906_create_quyen_table', 1),
(2, '2017_10_21_024915_create_nhanvien_table', 1),
(3, '2017_10_21_025404_create_chude_table', 1),
(4, '2017_10_21_025420_create_loaisanpham_table', 1),
(5, '2017_10_21_025435_create_sanpham_table', 1),
(6, '2017_10_21_105831_create_hinhanh_table', 1),
(7, '2017_10_21_110138_create_nhacungcap_table', 1),
(8, '2017_10_21_110501_create_khachhang_table', 1),
(9, '2017_10_21_133510_create_khuyenmai_table', 1),
(10, '2017_10_21_140503_create_khuyenmai_sanpham_table', 1),
(11, '2017_10_22_061313_create_donhang_table', 1),
(12, '2017_10_22_062600_create_chitiet_donhang_table', 1),
(13, '2017_10_22_063423_create_hoadon_table', 1),
(14, '2017_10_22_063458_create_phieunhap_table', 1),
(15, '2017_10_22_063527_create_chitiet_phieunhap_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhacungcap`
--

CREATE TABLE `nhacungcap` (
  `ncc_ma` smallint(5) UNSIGNED NOT NULL COMMENT 'Mã nhà cung cấp',
  `ncc_ten` varchar(150) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên nhà cung cấp',
  `ncc_daiDien` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Người đại diện',
  `ncc_diaChi` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Địa chỉ nhà cung cấp',
  `ncc_dienThoai` varchar(12) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Điện thoại',
  `ncc_email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Email nhà cung cấp',
  `ncc_trangThai` tinyint(4) NOT NULL DEFAULT '2' COMMENT 'Trạng thái nhà cung cấp: 1-khóa, 2-khả dụng',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhacungcap`
--

INSERT INTO `nhacungcap` (`ncc_ma`, `ncc_ten`, `ncc_daiDien`, `ncc_diaChi`, `ncc_dienThoai`, `ncc_email`, `ncc_trangThai`, `created_at`, `updated_at`) VALUES
(1, 'CÔNG TY CỔ PHẦN DƯỢC PHẨM VÀ THIẾT BỊ Y TẾ TÂM SEN (TAMSENPHARMA.,JSC)', 'Mr. Lộc', '1/23/165, Thái Hà, Q. Đống Đa, TP. Hà Nội', '0934812865', 'tamsenpharma@gmail.com', 2, '2017-11-06 13:13:02', '2017-11-06 13:13:02'),
(2, 'Công ty Cổ phần Hàng tiêu dùng Đất Việt', 'Mr. Lĩnh', 'Số 2 Ngõ 269/1 Giáp Bát - Hoàng Mai - Hà Nội', '0943540540', 'nguyenlinh.datviet@gmail.com', 2, '2017-11-06 13:20:24', '2017-11-06 13:20:24'),
(3, 'Chi Nhánh phía Bắc - Tổng công ty May Nhà Bè', 'Nguyễn Anh Vũ', 'Số 2, ngách 61/4 Lạc Trung, Phường Vĩnh Tuy, Quận Hai Bà Trưng, Hà Nội', '01243298999', 'anhvu@mattana.com.vn', 2, '2017-11-06 13:23:15', '2017-11-06 13:23:15'),
(4, 'Công ty TNHH Thời trang Lamer', 'Mr. Phong', '157 Hoàng Văn Thái - Thanh Xuân - Hà Nội', '0979666099', NULL, 2, '2017-11-06 13:25:18', '2017-11-06 13:25:18'),
(5, 'CÔNG TY CỔ PHẦN ĐẦU TƯ EXP VIỆT NAM', 'Mrs. Luận', 'Nhà D21, dãy D, khu TT sư đoàn 361, P. Xuân Đỉnh. Q. Bắc Từ Liêm, TP. Hà Nộ', '0981122755', 'thucphamexp@gmail.com', 2, '2017-11-06 13:34:54', '2017-11-06 13:34:54');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `nv_ma` smallint(5) UNSIGNED NOT NULL COMMENT 'Mã nhân viên',
  `nv_hoTen` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Họ tên nhân viên',
  `nv_gioiTinh` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Giới tính: 1-Nam, 2-Nữ',
  `nv_ngaySinh` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày sinh nhân viên',
  `nv_diaChi` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Địa chỉ nhân viên',
  `nv_dienThoai` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Số điện thoại nhân viên',
  `nv_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Email nhân viên',
  `nv_matKhau` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Mật khẩu nhân viên',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `q_ma` tinyint(3) UNSIGNED DEFAULT NULL COMMENT 'Mã quyền: 1-thường, 2-quản trị'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`nv_ma`, `nv_hoTen`, `nv_gioiTinh`, `nv_ngaySinh`, `nv_diaChi`, `nv_dienThoai`, `nv_email`, `nv_matKhau`, `created_at`, `updated_at`, `q_ma`) VALUES
(1, 'Chưa phân công', 1, '2017-10-26 00:00:00', NULL, NULL, 'unknow@laravel.demo', '$2y$10$fqD7OLyCLoQiLHv/RHOdIeQIp6Zlskq9t8t7pUPWyzczGmolD8j0K', '2017-10-26 06:27:58', '2017-10-26 06:27:58', 1),
(2, 'Trần Ngọc Hiếu', 1, '1991-05-07 00:00:00', 'Ninh Kiều, Cần Thơ', '01234192290', 'hieuc1500109@student.ctu.edu.vn', '$2y$10$.fT6bSiJlzX.2Qsrd8dumuXq/xb9DHOwHJYscxhizZGNOYUmnNfM.', '2017-10-26 06:29:01', '2017-10-26 08:10:45', 2),
(3, 'Nguyễn Văn Nhân', 1, '1994-11-11 00:00:00', 'Cần Thơ', '01234569877', 'nvnhan@gmail.com', '$2y$10$ktpdaGBsaiIO6hmHEvyw0u32Uq5dCA1Uz3jXfrKOCnGSntSzmVRze', '2017-11-04 06:22:53', '2017-11-04 06:22:53', 1),
(4, 'Lê Vũ Hoài Lễ', 1, '1997-02-22 00:00:00', 'Sóc Trăng', '01334578991', 'lvhle@gmail.com', '$2y$10$9DRMeM0fFcPSbYe8bIDeVuJ7X13TPKs9uJEmZKnGBgEi8hhAWPqOa', '2017-11-04 06:23:54', '2017-11-04 06:23:54', 1),
(5, 'Phan Quốc Nghĩa', 1, '1993-10-18 00:00:00', 'Cà Mau', '01288794588', 'pqnghia@gmail.com', '$2y$10$7Rjep4jq2761fPx0zX6T0u52vLI9zNUpFo6I3sCX/RnCCTJt7ZAwa', '2017-11-04 06:25:11', '2017-11-04 06:25:11', 1),
(6, 'Lý Nguyễn Ngọc Trí', 2, '1990-12-19 00:00:00', 'Sóc Trăng', '01667899871', 'lnntri@gmail.com', '$2y$10$Bhh/lkhHSz99JeMB1E1Ba.uTi7tJt.MAjve/XNxupX5n8abK.cxRS', '2017-11-04 06:26:17', '2017-11-04 06:26:17', 2),
(7, 'Tiêu Hoàng Tín', 1, '1991-08-27 00:00:00', 'Đồng Tháp', '09668787898', 'thtin@gmail.com', '$2y$10$kzwuIOWvy471JkJpoa6s.efKEbxC/2iJUsJFIIXGQ92zfVkt3QzNu', '2017-11-04 06:28:09', '2017-11-04 06:28:09', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieunhap`
--

CREATE TABLE `phieunhap` (
  `pn_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'Mã phiếu nhập',
  `nv_nguoiLapPhieu` smallint(5) UNSIGNED NOT NULL COMMENT 'Mã nhân viên (người lập phiếu nhập)',
  `pn_ngayLapPhieu` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'hời điểm lập phiếu nhập kho',
  `ncc_ma` smallint(5) UNSIGNED NOT NULL COMMENT 'Nhà cung cấp # ncc_ma # ncc_ten # Mã nhà cung cấp',
  `pn_trangThai` tinyint(4) NOT NULL DEFAULT '2' COMMENT 'Trạng thái phiếu nhập sản phẩm: 1-khóa, 2-lập phiếu, 3-thanh toán',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quyen`
--

CREATE TABLE `quyen` (
  `q_ma` tinyint(3) UNSIGNED NOT NULL COMMENT 'Mã quyền',
  `q_ten` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên quyền',
  `q_dienGiai` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Diễn giải về quyền',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `quyen`
--

INSERT INTO `quyen` (`q_ma`, `q_ten`, `q_dienGiai`, `created_at`, `updated_at`) VALUES
(1, 'Bình thường', 'Chỉ xem thông tin cá nhân.', '2017-11-16 17:00:00', '2017-11-16 17:00:00'),
(2, 'Quản trị', 'Toàn quyền sử dụng các chức năng.', '2017-11-16 17:00:00', '2017-11-16 17:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `sp_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'Mã sản phẩm',
  `sp_ten` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên sản phẩm # Tên sản phẩm',
  `sp_giaGoc` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Giá gốc của sản phẩm',
  `sp_giaBan` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Giá bán hiện tại của sản phẩm',
  `sp_thongTin` text COLLATE utf8_unicode_ci COMMENT 'Thông tin về sản phẩm',
  `sp_soLuong` smallint(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Số lượng sản phẩm tồn kho',
  `sp_xuatXu` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Xuất xứ của sản phẩm',
  `sp_hinh` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Hình đại diện của sản phẩm',
  `sp_trangThai` tinyint(4) NOT NULL DEFAULT '2' COMMENT 'Trạng thái sản phẩm: 1-khóa, 2-khả dụng',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `l_ma` tinyint(3) UNSIGNED NOT NULL COMMENT 'Mã loại sản phẩm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`sp_ma`, `sp_ten`, `sp_giaGoc`, `sp_giaBan`, `sp_thongTin`, `sp_soLuong`, `sp_xuatXu`, `sp_hinh`, `sp_trangThai`, `created_at`, `updated_at`, `l_ma`) VALUES
(1, 'Bột giặt OMO (400g)', 15000, 17500, NULL, 0, 'Việt Nam', NULL, 2, '2017-11-01 14:23:34', '2017-11-01 14:23:34', 1),
(2, 'Bột giặt OMO (800g)', 32000, 34999, NULL, 0, 'Việt Nam', NULL, 2, '2017-11-01 14:24:24', '2017-11-01 14:24:24', 1),
(3, 'Bột giặt OMO sạch cực nhanh (3kg)', 120000, 125000, NULL, 0, 'Việt Nam', NULL, 2, '2017-11-01 14:25:29', '2017-11-01 14:25:29', 1),
(5, 'Bột giặt OMO Matic (4,5kg)', 180000, 204000, NULL, 0, 'Việt Nam', NULL, 2, '2017-11-01 14:26:41', '2017-11-01 14:26:41', 1),
(6, 'Bột giặt ABA sạch tinh tươm (4,5kg)', 220000, 264000, NULL, 0, 'Việt Nam', NULL, 2, '2017-11-01 14:29:32', '2017-11-01 14:29:32', 1),
(7, 'Bột giặt VISO chanh (3kg)', 75000, 85000, NULL, 0, 'Việt Nam', NULL, 2, '2017-11-01 14:30:26', '2017-11-01 14:30:26', 1),
(8, 'Bột giặt VISO chanh (6kg)', 99000, 117000, NULL, 0, 'Việt Nam', NULL, 2, '2017-11-01 14:30:53', '2017-11-01 14:30:53', 1),
(9, 'Nước rửa chén Sunlight chanh 100 dạng chai 750g (Vàng)', 20000, 22800, NULL, 0, 'Việt Nam', '9_1_n1wnt5old415k.jpg', 2, '2017-11-02 03:02:17', '2017-11-04 08:27:39', 2),
(10, 'Nước rửa chén Sunlight chanh 100 dạng túi 1.4kg', 29000, 32500, NULL, 0, 'Việt Nam', '10_1_pouch_1.jpg', 2, '2017-11-02 03:04:24', '2017-11-04 08:27:03', 2),
(11, 'Nước rửa chén Suzy 4kg (Xanh lá cây)', 119000, 126000, NULL, 0, 'Việt Nam', '11_1_150149651184_3099957.jpg', 2, '2017-11-02 03:05:52', '2017-11-04 08:26:38', 2),
(12, 'Nước rửa chén Sunlight thiên nhiên dạng can 3,8kg', 100000, 112000, NULL, 0, 'Việt Nam', '12_1_1474017406641_1572320.jpg', 2, '2017-11-02 03:07:27', '2017-11-04 08:26:18', 2),
(13, 'Bánh quy Mcvitie\'s Digestive Orginal (250g)', 35000, 41000, NULL, 0, 'Anh', '13_1_banh-quy-lua-my-mcvities-digestive-socola-sua-200g-p257.jpg', 2, '2017-11-02 03:13:23', '2017-11-04 08:25:31', 3),
(14, 'Bánh Quy Bơ Pháp Lu - Kinh Đô (726g)', 179000, 200000, NULL, 0, 'Việt Nam', '14_1_1497417594253_6473135.jpg', 2, '2017-11-02 03:15:13', '2017-11-04 08:25:06', 3),
(15, 'Kẹo sữa caramen Alpenliebe gói (1kg)', 69000, 75000, NULL, 0, 'Việt Nam', '15_1_1487665567998_5321079.jpg', 2, '2017-11-02 03:17:30', '2017-11-04 08:24:38', 3),
(16, 'Thùng 30 gói mì Hảo Hảo vị tôm chua cay', 86000, 96000, NULL, 0, 'Việt Nam', '16_1_mi-hao-hao-xao-kho-tom-hanh-75g-thung-30-goi-1.jpg', 2, '2017-11-02 03:18:49', '2017-11-04 08:24:17', 4),
(17, 'Thùng 30 gói mì Gấu Đỏ tôm chua cay', 60000, 70000, NULL, 0, 'Việt Nam', '17_1_mi-gau-do-tom-chua-cay-65g-thung-30-goi-1-700x467-1.jpg', 2, '2017-11-02 03:19:16', '2017-11-04 08:23:56', 4),
(18, 'Mực rim sa tế ăn liền đặc sản Phan Thiết (150g)', 68000, 78000, NULL, 0, 'Việt Nam', '18_1_bo-02-hop-muc-rim-sa-te-an-lien-dac-san-phan-thiet-150g-1502062225-7793467-ba6d02edcf3dbdfb2e0f0dbaa66f4c45-product.jpg', 2, '2017-11-02 03:21:07', '2017-11-04 08:23:36', 11),
(19, 'Mắm Tôm Chà BÀ HAI GÒ CÔNG (250g)', 86000, 95000, NULL, 0, 'Việt Nam', '19_1_321f81707cd2f166dc94a67dec3af964.jpg', 2, '2017-11-02 03:21:32', '2017-11-04 08:23:17', 11),
(20, 'Lốc 24 Chai Nước Giải Khát Có Gas Coca-Cola (390ml / Chai)', 158000, 160000, NULL, 0, 'Việt Nam', '20_2_sanpham310.png', 2, '2017-11-02 03:23:08', '2017-11-04 08:22:53', 8),
(21, 'Lốc 24 Chai Nước Tăng Lực Samurai Vàng (390ml / Chai)', 180000, 195000, NULL, 0, 'Việt Nam', '21_1_nuoc-tang-luc-samurai-390ml-x-6-700x467-2.jpg', 2, '2017-11-02 03:23:43', '2017-11-04 08:22:00', 8),
(22, 'Sữa tươi tiệt trùng tách béo có đường (180ml x 4 hộp)', 20000, 28000, NULL, 0, 'Việt Nam', '22_1_Sữa-tươi-tiệt-trùng-tách-béo-Vinamilk-có-đường-lốc-4-hộp-x-180ml-1.jpg', 2, '2017-11-02 03:26:19', '2017-11-04 08:21:34', 12),
(23, 'Sữa tươi tiệt trùng Twin Cows không đường (1lit)', 25000, 30000, NULL, 0, 'Việt Nam', '23_1_2_540-min_grande.jpg', 2, '2017-11-02 03:26:53', '2017-11-04 08:21:11', 12),
(24, 'JEAN WASH - JEAN9172', 150000, 185000, NULL, 0, 'Việt Nam', '24_1_jean-wash-gia-si-119k-124k-zalo-xem-them-mau-0981483633-1m4G3-GDNaEB.jpg', 2, '2017-11-02 03:28:23', '2017-11-04 08:20:51', 13),
(25, 'JEAN NAM CAO CẤP - JEAN78991', 300000, 398000, NULL, 0, 'Việt Nam', '25_1_jean-nam-cao-cap-1m4G3-SHTNUO.jpg', 2, '2017-11-02 03:29:15', '2017-11-04 08:20:20', 13),
(26, 'Quần jean xám lưng cao 4 nút ống loe - QD254', 289000, 340000, NULL, 0, 'Việt Nam', '26_1_qd254-1m4G3-Rna8yh_simg_d0daf0_800x1200_max.jpg', 2, '2017-11-02 03:30:35', '2017-11-04 08:19:39', 14),
(27, 'Quần jean lưng cao ống loe cao cấp - VQ155', 289000, 340000, NULL, 0, 'Việt Nam', '27_1_quan-jean-lung-cao-rach-1-nut-ong-suong-vq147-v160-1.jpg', 2, '2017-11-02 03:31:08', '2017-11-04 08:19:07', 14),
(28, 'Giày Sneaker Nam - 278 - SP 278 B', 300000, 360000, NULL, 0, 'Việt Nam', '28_1_giay-sneaker-nam-278-1m4G3-HsM6V4.png', 2, '2017-11-02 03:35:30', '2017-11-04 08:33:06', 15),
(29, 'GIÀY THỂ THAO NAM SP-09 HOT 2017 - SP -09', 299000, 380000, NULL, 0, 'Việt Nam', '29_1_zRWqrJ_simg_b5529c_250x250_maxb.jpg', 2, '2017-11-02 03:35:45', '2017-11-04 08:18:09', 15),
(30, 'Giày cao gót ánh kim cao cấp CK285 - CK285', 500000, 660000, NULL, 0, 'Việt Nam', '30_1_giay-cao-got-anh-kim-cao-cap.jpg', 2, '2017-11-02 03:36:26', '2017-11-04 08:17:45', 16),
(31, 'Giày cao gót nữ khoét eo hậu - LN1310 - LN1310', 385500, 500000, NULL, 0, 'Việt Nam', '31_1_giay-cao-got-nu-khoet-eo-hau.jpg', 2, '2017-11-02 03:37:25', '2017-11-04 08:17:12', 16),
(32, 'Áo sơ mi xanh da trời - XMXDT', 150000, 250000, NULL, 0, 'Việt Nam', '32_1_ao-so-mi-nam.jpg', 2, '2017-11-02 03:38:15', '2017-11-04 08:16:38', 17),
(33, 'Áo da nam siêu đẹp - AKD219', 700000, 900000, NULL, 0, 'Việt Nam', '33_2_ao-khoac-da-33.jpg', 2, '2017-11-02 03:40:15', '2017-11-04 08:16:07', 13),
(34, 'Sơ mi tay dơi - Hàng nhập cao cấp - JSA015', 150000, 275000, NULL, 0, 'Việt Nam', '34_2_so-mi-tay-doi-hang-nhap-cao-cap.jpg', 2, '2017-11-02 03:41:16', '2017-11-04 08:14:14', 18),
(35, 'Hàng nhập Cao cấp - Đầm Maxi voan lụa Trang Nhã - DM091 - DM091', 250000, 390000, NULL, 0, 'Việt Nam', '35_2_hang-nhap-cao-cap-dam-maxi.jpg', 2, '2017-11-02 03:41:35', '2017-11-04 08:13:10', 18),
(36, 'Dưỡng thể Vaseline (725ml)', 120000, 145000, NULL, 0, 'Việt Nam', '36_1_duong-the-vaseline.jpg', 2, '2017-11-02 11:35:34', '2017-11-04 08:09:21', 7),
(37, 'Nước hoa nữ Avon Little Red Dress (50ml)', 200000, 239000, NULL, 0, 'Thailand', '37_1_little-red-dress.jpg', 2, '2017-11-02 11:37:15', '2017-11-04 08:08:17', 5),
(38, 'Nước hoa nữ Jolie Dion Charm Eau de Parfum (60ml)', 329000, 499000, NULL, 0, 'Singapore', '38_1_nuoc-hoa-nu-jolie-dion-charm-eau-de-parfum-60ml.jpg', 2, '2017-11-02 11:38:23', '2017-11-04 07:49:33', 5),
(39, 'Kem Dưỡng Trắng Da Tinh Chất Collagen 3W Clinic Collagen Whitening Cream (60ml)', 300000, 410000, NULL, 0, 'Korea', '39_2_kem-trang-3w.jpg', 2, '2017-11-02 11:40:23', '2017-11-04 07:48:24', 6),
(40, 'Lego xếp hình to 1000 chi tiết', 180000, 225000, NULL, 0, 'Việt Nam', '40_1_bo-xep-hinhlego1000-chi-tiet.jpg', 2, '2017-11-02 11:41:54', '2017-11-04 07:47:22', 19),
(41, 'LEGO XE QUÂN ĐỘI K - COUNTER ATTACK 165 PCS', 200000, 275000, NULL, 0, 'Việt Nam', '41_1_14472378905158.jpg', 2, '2017-11-02 11:42:14', '2017-11-04 07:46:43', 19),
(42, 'Bé Tập Tô Màu (Tập 1) - 3 Đến 6 Tuổi', 18000, 24000, NULL, 0, 'Việt Nam', '42_1_tap-1_2__1_1.jpg', 2, '2017-11-02 11:44:25', '2017-11-04 07:44:57', 22),
(43, 'Bé Tập Tô Màu (Tập 3) - 3 Đến 6 Tuổi', 18000, 24000, NULL, 0, 'Việt Nam', '43_1_tap-3_2.jpg', 2, '2017-11-02 11:44:45', '2017-11-04 07:44:47', 22),
(44, 'Macbook Air 13 256GB MQD42SA/A', 20000000, 28990000, NULL, 0, 'Trung Quốc', '44_3_og.png', 2, '2017-11-02 11:47:12', '2017-11-04 06:55:26', 20),
(45, 'Dell Vostro V5568/i5-7200U/Win10', 13000000, 16890000, NULL, 0, 'Trung Quốc', '45_3_product_s5747.jpg', 2, '2017-11-02 11:47:58', '2017-11-03 14:34:20', 20),
(46, 'Apple iPhone X 256GB', 39990000, 49990000, NULL, 0, 'Mỹ', '46_2_iphone-x-silver-space-gray.jpg', 2, '2017-11-02 11:50:14', '2017-11-03 14:46:32', 23),
(47, 'Apple iPhone X 64GB', 32990000, 40990000, NULL, 0, 'Mỹ', '47_3_iphone-x-silver-space-gray.jpg', 2, '2017-11-02 11:50:43', '2017-11-03 14:28:59', 23);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitiet_donhang`
--
ALTER TABLE `chitiet_donhang`
  ADD PRIMARY KEY (`dh_ma`,`sp_ma`),
  ADD KEY `chitiet_donhang_sp_ma_foreign` (`sp_ma`);

--
-- Chỉ mục cho bảng `chitiet_phieunhap`
--
ALTER TABLE `chitiet_phieunhap`
  ADD PRIMARY KEY (`pn_ma`,`sp_ma`),
  ADD KEY `chitiet_phieunhap_sp_ma_foreign` (`sp_ma`);

--
-- Chỉ mục cho bảng `chude`
--
ALTER TABLE `chude`
  ADD PRIMARY KEY (`cd_ma`),
  ADD UNIQUE KEY `chude_cd_ten_unique` (`cd_ten`);

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`dh_ma`),
  ADD KEY `donhang_kh_ma_foreign` (`kh_ma`),
  ADD KEY `donhang_nv_xuly_foreign` (`nv_xuLy`);

--
-- Chỉ mục cho bảng `hinhanh`
--
ALTER TABLE `hinhanh`
  ADD PRIMARY KEY (`ha_ma`),
  ADD KEY `hinhanh_sp_ma_foreign` (`sp_ma`);

--
-- Chỉ mục cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`hd_ma`),
  ADD KEY `hoadon_dh_ma_foreign` (`dh_ma`),
  ADD KEY `hoadon_nv_laphoadon_foreign` (`nv_lapHoaDon`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`kh_ma`),
  ADD UNIQUE KEY `khachhang_kh_email_kh_dienthoai_unique` (`kh_email`,`kh_dienThoai`);

--
-- Chỉ mục cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  ADD PRIMARY KEY (`km_ma`),
  ADD UNIQUE KEY `khuyenmai_km_ten_unique` (`km_ten`);

--
-- Chỉ mục cho bảng `khuyenmai_sanpham`
--
ALTER TABLE `khuyenmai_sanpham`
  ADD PRIMARY KEY (`km_ma`,`sp_ma`),
  ADD KEY `khuyenmai_sanpham_sp_ma_foreign` (`sp_ma`);

--
-- Chỉ mục cho bảng `loaisanpham`
--
ALTER TABLE `loaisanpham`
  ADD PRIMARY KEY (`l_ma`),
  ADD UNIQUE KEY `loaisanpham_l_ten_unique` (`l_ten`),
  ADD KEY `loaisanpham_cd_ma_foreign` (`cd_ma`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `nhacungcap`
--
ALTER TABLE `nhacungcap`
  ADD PRIMARY KEY (`ncc_ma`),
  ADD UNIQUE KEY `nhacungcap_ncc_ten_ncc_dienthoai_ncc_email_unique` (`ncc_ten`,`ncc_dienThoai`,`ncc_email`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`nv_ma`),
  ADD UNIQUE KEY `nhanvien_nv_email_nv_dienthoai_unique` (`nv_email`,`nv_dienThoai`),
  ADD KEY `q_ma` (`q_ma`);

--
-- Chỉ mục cho bảng `phieunhap`
--
ALTER TABLE `phieunhap`
  ADD PRIMARY KEY (`pn_ma`),
  ADD KEY `phieunhap_nv_nguoilapphieu_foreign` (`nv_nguoiLapPhieu`),
  ADD KEY `phieunhap_ncc_ma_foreign` (`ncc_ma`);

--
-- Chỉ mục cho bảng `quyen`
--
ALTER TABLE `quyen`
  ADD PRIMARY KEY (`q_ma`),
  ADD UNIQUE KEY `quyen_q_ten_unique` (`q_ten`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`sp_ma`),
  ADD UNIQUE KEY `sanpham_sp_ten_unique` (`sp_ten`),
  ADD KEY `sanpham_l_ma_foreign` (`l_ma`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chude`
--
ALTER TABLE `chude`
  MODIFY `cd_ma` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã chủ đề', AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `dh_ma` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã đơn hàng', AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT cho bảng `hinhanh`
--
ALTER TABLE `hinhanh`
  MODIFY `ha_ma` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã hình ảnh', AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `hd_ma` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã hóa đơn';
--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `kh_ma` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã khách hàng', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  MODIFY `km_ma` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã chương trình khuyến mãi';
--
-- AUTO_INCREMENT cho bảng `loaisanpham`
--
ALTER TABLE `loaisanpham`
  MODIFY `l_ma` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã loại sản phẩm', AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT cho bảng `nhacungcap`
--
ALTER TABLE `nhacungcap`
  MODIFY `ncc_ma` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã nhà cung cấp', AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `nv_ma` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã nhân viên', AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT cho bảng `phieunhap`
--
ALTER TABLE `phieunhap`
  MODIFY `pn_ma` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã phiếu nhập';
--
-- AUTO_INCREMENT cho bảng `quyen`
--
ALTER TABLE `quyen`
  MODIFY `q_ma` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã quyền', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `sp_ma` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã sản phẩm', AUTO_INCREMENT=49;
--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitiet_donhang`
--
ALTER TABLE `chitiet_donhang`
  ADD CONSTRAINT `chitiet_donhang_dh_ma_foreign` FOREIGN KEY (`dh_ma`) REFERENCES `donhang` (`dh_ma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chitiet_donhang_sp_ma_foreign` FOREIGN KEY (`sp_ma`) REFERENCES `sanpham` (`sp_ma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `chitiet_phieunhap`
--
ALTER TABLE `chitiet_phieunhap`
  ADD CONSTRAINT `chitiet_phieunhap_pn_ma_foreign` FOREIGN KEY (`pn_ma`) REFERENCES `phieunhap` (`pn_ma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chitiet_phieunhap_sp_ma_foreign` FOREIGN KEY (`sp_ma`) REFERENCES `sanpham` (`sp_ma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `donhang_kh_ma_foreign` FOREIGN KEY (`kh_ma`) REFERENCES `khachhang` (`kh_ma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `donhang_nv_xuly_foreign` FOREIGN KEY (`nv_xuLy`) REFERENCES `nhanvien` (`nv_ma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `hinhanh`
--
ALTER TABLE `hinhanh`
  ADD CONSTRAINT `hinhanh_sp_ma_foreign` FOREIGN KEY (`sp_ma`) REFERENCES `sanpham` (`sp_ma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `hoadon_dh_ma_foreign` FOREIGN KEY (`dh_ma`) REFERENCES `donhang` (`dh_ma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hoadon_nv_laphoadon_foreign` FOREIGN KEY (`nv_lapHoaDon`) REFERENCES `nhanvien` (`nv_ma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `khuyenmai_sanpham`
--
ALTER TABLE `khuyenmai_sanpham`
  ADD CONSTRAINT `khuyenmai_sanpham_km_ma_foreign` FOREIGN KEY (`km_ma`) REFERENCES `khuyenmai` (`km_ma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `khuyenmai_sanpham_sp_ma_foreign` FOREIGN KEY (`sp_ma`) REFERENCES `sanpham` (`sp_ma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `loaisanpham`
--
ALTER TABLE `loaisanpham`
  ADD CONSTRAINT `loaisanpham_cd_ma_foreign` FOREIGN KEY (`cd_ma`) REFERENCES `chude` (`cd_ma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `nhanvien_ibfk_1` FOREIGN KEY (`q_ma`) REFERENCES `quyen` (`q_ma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `phieunhap`
--
ALTER TABLE `phieunhap`
  ADD CONSTRAINT `phieunhap_ncc_ma_foreign` FOREIGN KEY (`ncc_ma`) REFERENCES `nhacungcap` (`ncc_ma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `phieunhap_nv_nguoilapphieu_foreign` FOREIGN KEY (`nv_nguoiLapPhieu`) REFERENCES `nhanvien` (`nv_ma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_l_ma_foreign` FOREIGN KEY (`l_ma`) REFERENCES `loaisanpham` (`l_ma`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
