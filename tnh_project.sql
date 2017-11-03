-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 02, 2017 lúc 01:13 PM
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
  `dh_trangThai` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Trạng thái đơn hàng: 1-nhận đơn, 2-xử lý đơn, 3-giao hàng, 4-hoàn tất, 5-đổi trả, 6-hủy',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `kh_diaChi` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'NULL' COMMENT 'Địa chỉ khách hàng',
  `kh_dienThoai` varchar(12) COLLATE utf8_unicode_ci DEFAULT 'NULL' COMMENT 'Số điện thoại khách hàng',
  `kh_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Email khách hàng',
  `kh_matKhau` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Mật khẩu',
  `kh_nhom` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Nhóm khách hàng: 1-thường, 2-thân thiết',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `ncc_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Email nhà cung cấp',
  `ncc_trangThai` tinyint(4) NOT NULL DEFAULT '2' COMMENT 'Trạng thái nhà cung cấp: 1-khóa, 2-khả dụng',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(2, 'Trần Ngọc Hiếu', 1, '1991-05-07 00:00:00', 'Ninh Kiều, Cần Thơ', '01234192290', 'hieuc1500109@student.ctu.edu.vn', '$2y$10$.fT6bSiJlzX.2Qsrd8dumuXq/xb9DHOwHJYscxhizZGNOYUmnNfM.', '2017-10-26 06:29:01', '2017-10-26 08:10:45', 2);

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
(9, 'Nước rửa chén Sunlight chanh 100 dạng chai 750g (Vàng)', 20000, 22800, NULL, 0, 'Việt Nam', NULL, 2, '2017-11-02 03:02:17', '2017-11-02 03:02:17', 2),
(10, 'Nước rửa chén Sunlight chanh 100 dạng túi 1.4kg', 29000, 32500, NULL, 0, 'Việt Nam', NULL, 2, '2017-11-02 03:04:24', '2017-11-02 03:04:24', 2),
(11, 'Nước rửa chén Suzy 4kg (Xanh lá cây)', 119000, 126000, NULL, 0, 'Việt Nam', NULL, 2, '2017-11-02 03:05:52', '2017-11-02 03:05:52', 2),
(12, 'Nước rửa chén Sunlight thiên nhiên dạng can 3,8kg', 100000, 112000, NULL, 0, 'Việt Nam', NULL, 2, '2017-11-02 03:07:27', '2017-11-02 03:07:27', 2),
(13, 'Bánh quy Mcvitie\'s Digestive Orginal (250g)', 35000, 41000, NULL, 0, 'Anh', NULL, 2, '2017-11-02 03:13:23', '2017-11-02 03:13:23', 3),
(14, 'Bánh Quy Bơ Pháp Lu - Kinh Đô (726g)', 179000, 200000, NULL, 0, 'Việt Nam', NULL, 2, '2017-11-02 03:15:13', '2017-11-02 03:15:13', 3),
(15, 'Kẹo sữa caramen Alpenliebe gói (1kg)', 69000, 75000, NULL, 0, 'Việt Nam', NULL, 2, '2017-11-02 03:17:30', '2017-11-02 03:17:30', 3),
(16, 'Thùng 30 gói mì Hảo Hảo vị tôm chua cay', 86000, 96000, NULL, 0, 'Việt Nam', NULL, 2, '2017-11-02 03:18:49', '2017-11-02 03:18:49', 4),
(17, 'Thùng 30 gói mì Gấu Đỏ tôm chua cay', 60000, 70000, NULL, 0, 'Việt Nam', NULL, 2, '2017-11-02 03:19:16', '2017-11-02 03:19:16', 4),
(18, 'Mực rim sa tế ăn liền đặc sản Phan Thiết (150g)', 68000, 78000, NULL, 0, 'Việt Nam', NULL, 2, '2017-11-02 03:21:07', '2017-11-02 03:21:07', 11),
(19, 'Mắm Tôm Chà BÀ HAI GÒ CÔNG (250g)', 86000, 95000, NULL, 0, 'Việt Nam', NULL, 2, '2017-11-02 03:21:32', '2017-11-02 03:21:32', 11),
(20, 'Lốc 24 Chai Nước Giải Khát Có Gas Coca-Cola (390ml / Chai)', 158000, 160000, NULL, 0, 'Việt Nam', NULL, 2, '2017-11-02 03:23:08', '2017-11-02 03:23:08', 8),
(21, 'Lốc 24 Chai Nước Tăng Lực Samurai Vàng (390ml / Chai)', 180000, 195000, NULL, 0, 'Việt Nam', NULL, 2, '2017-11-02 03:23:43', '2017-11-02 03:23:43', 8),
(22, 'Sữa tươi tiệt trùng tách béo có đường (180ml x 4 hộp)', 20000, 28000, NULL, 0, 'Việt Nam', NULL, 2, '2017-11-02 03:26:19', '2017-11-02 03:26:19', 12),
(23, 'Sữa tươi tiệt trùng Twin Cows không đường (1lit)', 25000, 30000, NULL, 0, 'Việt Nam', NULL, 2, '2017-11-02 03:26:53', '2017-11-02 03:26:53', 12),
(24, 'JEAN WASH - JEAN9172', 150000, 185000, NULL, 0, 'Việt Nam', NULL, 2, '2017-11-02 03:28:23', '2017-11-02 03:28:23', 13),
(25, 'JEAN NAM CAO CẤP - JEAN78991', 300000, 398000, NULL, 0, 'Việt Nam', NULL, 2, '2017-11-02 03:29:15', '2017-11-02 03:29:15', 13),
(26, 'Quần jean xám lưng cao 4 nút ống loe - QD254', 289000, 340000, NULL, 0, 'Việt Nam', NULL, 2, '2017-11-02 03:30:35', '2017-11-02 03:30:35', 14),
(27, 'Quần jean lưng cao ống loe cao cấp - VQ155', 289000, 340000, NULL, 0, 'Việt Nam', NULL, 2, '2017-11-02 03:31:08', '2017-11-02 03:31:08', 14),
(28, 'Giày Sneaker Nam - 278 - SP 278 B', 299000, 360000, NULL, 0, 'Việt Nam', NULL, 2, '2017-11-02 03:35:30', '2017-11-02 03:35:30', 15),
(29, 'GIÀY THỂ THAO NAM SP-09 HOT 2017 - SP -09', 299000, 380000, NULL, 0, 'Việt Nam', NULL, 2, '2017-11-02 03:35:45', '2017-11-02 03:35:45', 15),
(30, 'Giày cao gót ánh kim cao cấp CK285 - CK285', 500000, 660000, NULL, 0, 'Việt Nam', NULL, 2, '2017-11-02 03:36:26', '2017-11-02 03:36:26', 16),
(31, 'Giày cao gót nữ khoét eo hậu - LN1310 - LN1310', 385500, 500000, NULL, 0, 'Việt Nam', NULL, 2, '2017-11-02 03:37:25', '2017-11-02 03:37:25', 16),
(32, 'Áo sơ mi xanh da trời - XMXDT', 150000, 250000, NULL, 0, 'Việt Nam', NULL, 2, '2017-11-02 03:38:15', '2017-11-02 03:38:15', 17),
(33, 'Áo da nam siêu đẹp - AKD219', 700000, 900000, NULL, 0, 'Việt Nam', NULL, 2, '2017-11-02 03:40:15', '2017-11-02 03:40:15', 13),
(34, 'Sơ mi tay dơi - Hàng nhập cao cấp - JSA015', 150000, 275000, NULL, 0, 'Việt Nam', NULL, 2, '2017-11-02 03:41:16', '2017-11-02 03:41:16', 18),
(35, 'Hàng nhập Cao cấp - Đầm Maxi voan lụa Trang Nhã - DM091 - DM091', 250000, 390000, NULL, 0, 'Việt Nam', NULL, 2, '2017-11-02 03:41:35', '2017-11-02 03:41:35', 18),
(36, 'Dưỡng thể Vaseline (725ml)', 120000, 145000, NULL, 0, 'Việt Nam', NULL, 2, '2017-11-02 11:35:34', '2017-11-02 11:35:34', 7),
(37, 'Nước hoa nữ Avon Little Red Dress (50ml)', 200000, 239000, NULL, 0, 'Thailand', NULL, 2, '2017-11-02 11:37:15', '2017-11-02 11:37:15', 5),
(38, 'Nước hoa nữ Jolie Dion Charm Eau de Parfum (60ml)', 329000, 499000, NULL, 0, 'Singapore', NULL, 2, '2017-11-02 11:38:23', '2017-11-02 11:38:23', 5),
(39, 'Kem Dưỡng Trắng Da Tinh Chất Collagen 3W Clinic Collagen Whitening Cream (60ml)', 300000, 410000, NULL, 0, 'Korea', NULL, 2, '2017-11-02 11:40:23', '2017-11-02 11:40:23', 6),
(40, 'Lego xếp hình to 1000 chi tiết', 180000, 225000, NULL, 0, 'Việt Nam', NULL, 2, '2017-11-02 11:41:54', '2017-11-02 11:41:54', 19),
(41, 'LEGO XE QUÂN ĐỘI K - COUNTER ATTACK 165 PCS', 200000, 275000, NULL, 0, 'Việt Nam', NULL, 2, '2017-11-02 11:42:14', '2017-11-02 11:42:14', 19),
(42, 'Bé Tập Tô Màu (Tập 1) - 3 Đến 6 Tuổi', 18000, 24000, NULL, 0, 'Việt Nam', NULL, 2, '2017-11-02 11:44:25', '2017-11-02 11:44:25', 22),
(43, 'Bé Tập Tô Màu (Tập 3) - 3 Đến 6 Tuổi', 18000, 24000, NULL, 0, 'Việt Nam', NULL, 2, '2017-11-02 11:44:45', '2017-11-02 11:44:45', 22),
(44, 'Macbook Air 13 256GB MQD42SA/A', 20000000, 28990000, NULL, 0, 'Trung Quốc', NULL, 2, '2017-11-02 11:47:12', '2017-11-02 11:47:12', 20),
(45, 'Dell Vostro V5568/i5-7200U/Win10', 13000000, 16890000, NULL, 0, 'Trung Quốc', NULL, 2, '2017-11-02 11:47:58', '2017-11-02 11:47:58', 20),
(46, 'Apple iPhone X 256GB', 39990000, 49990000, NULL, 0, 'Mỹ', NULL, 2, '2017-11-02 11:50:14', '2017-11-02 11:50:14', 23),
(47, 'Apple iPhone X 64GB', 30990000, 40990000, NULL, 0, 'Mỹ', NULL, 2, '2017-11-02 11:50:43', '2017-11-02 11:50:43', 23);

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
  ADD UNIQUE KEY `nhanvien_nv_email_nv_dienthoai_unique` (`nv_email`,`nv_dienThoai`);

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
  MODIFY `dh_ma` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã đơn hàng';
--
-- AUTO_INCREMENT cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `hd_ma` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã hóa đơn';
--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `kh_ma` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã khách hàng';
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
  MODIFY `ncc_ma` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã nhà cung cấp';
--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `nv_ma` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã nhân viên', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT cho bảng `phieunhap`
--
ALTER TABLE `phieunhap`
  MODIFY `pn_ma` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã phiếu nhập';
--
-- AUTO_INCREMENT cho bảng `quyen`
--
ALTER TABLE `quyen`
  MODIFY `q_ma` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã quyền';
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
