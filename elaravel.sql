-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 22, 2021 lúc 04:50 AM
-- Phiên bản máy phục vụ: 10.4.18-MariaDB
-- Phiên bản PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `elaravel`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(10) UNSIGNED NOT NULL,
  `admin_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_email`, `admin_password`, `admin_name`, `admin_image`, `admin_phone`, `admin_status`, `created_at`, `updated_at`) VALUES
(3, 'thuongtran2062000@gmail.com', '84bbde58f1dc2e1152bc584b8503d802', 'Hoài Thương', 'd866fbb97329a8e45f0f05340d36eaac65.jpg', '0967738407', 0, NULL, NULL),
(4, 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'admin', '5bab48eecbd6b5aa9c6311ed5b4a66da2.jpg', '0395700403', 0, NULL, NULL),
(5, 'anhthi1711@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Anh Thi1', 'logo184.png', '0923243317', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brand_id` int(10) UNSIGNED NOT NULL,
  `brand_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_brand`
--

INSERT INTO `tbl_brand` (`brand_id`, `brand_name`, `brand_slug`, `brand_desc`, `brand_status`, `created_at`, `updated_at`) VALUES
(1, 'MSI', 'MSI', 'MSI', 0, NULL, NULL),
(2, 'Acer', 'Acer', 'Acer', 0, NULL, NULL),
(3, 'Asus', 'Asus', 'Asus', 0, NULL, NULL),
(4, 'Lenovo ', 'Lenovo ', 'Lenovo ', 0, NULL, NULL),
(5, 'HP', 'HP', 'HP', 0, NULL, NULL),
(6, 'DELL', 'DELL', 'DELL', 0, NULL, NULL),
(7, 'Apple', 'Apple', 'Apple', 0, NULL, NULL),
(8, 'Khác', 'Khác', 'Khác', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category_product`
--

CREATE TABLE `tbl_category_product` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug_category_product` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_category_product`
--

INSERT INTO `tbl_category_product` (`category_id`, `meta_keywords`, `category_name`, `slug_category_product`, `category_desc`, `category_status`, `created_at`, `updated_at`) VALUES
(11, 'Phụ kiện', 'Phụ kiện', 'Phụ-kiện', 'Phụ kiện', 0, NULL, NULL),
(12, 'Thiết bị mạng', 'Thiết bị mạng', 'Thiết bị mạng', 'Thiết bị mạng', 0, NULL, NULL),
(13, 'Thiết bị văn phòng', 'Thiết bị văn phòng', 'Thiết bị văn phòng', 'Thiết bị văn phòng', 0, NULL, NULL),
(14, 'Thiết bị Audio', 'Thiết bị Audio', 'Thiết bị Audio', 'Thiết bị Audio', 0, NULL, NULL),
(15, 'Tai nghe Gaming', 'Tai nghe Gaming', 'Tai nghe Gaming', 'Tai nghe Gaming', 0, NULL, NULL),
(16, 'Chuột + Lót chuột', 'Chuột + Lót chuột', 'Chuột + Lót chuột', 'Chuột + Lót chuột', 0, NULL, NULL),
(17, 'Bàn phím', 'Bàn phím', 'Bàn phím', 'Bàn phím', 0, NULL, NULL),
(18, 'Màn Hình', 'Màn Hình', 'Màn Hình', 'Màn Hình', 0, NULL, NULL),
(19, 'Linh kiện PC', 'Linh kiện PC', 'Linh kiện PC', 'Linh kiện PC', 0, NULL, NULL),
(20, 'PC Gaming', 'PC Gaming', 'PC Gaming', 'PC Gaming', 0, NULL, NULL),
(21, 'Laptop', 'Laptop', 'lap-top', 'Laptop', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_coupon`
--

CREATE TABLE `tbl_coupon` (
  `coupon_id` int(11) NOT NULL,
  `coupon_name` varchar(150) NOT NULL,
  `coupon_time` int(50) NOT NULL,
  `coupon_condition` int(11) NOT NULL,
  `coupon_number` int(11) NOT NULL,
  `coupon_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_coupon`
--

INSERT INTO `tbl_coupon` (`coupon_id`, `coupon_name`, `coupon_time`, `coupon_condition`, `coupon_number`, `coupon_code`) VALUES
(1, 'Giảm giá 30/4', 10, 1, 10, 'HDH375Y'),
(4, 'Giảm giá Covid', 0, 2, 100000, 'COVID99'),
(8, 'dễ thương', 47, 1, 20, 'THUONG1'),
(11, 'dễ thương', 50, 2, 10000, 'THUONG3'),
(12, 'THY', 0, 1, 10, 'THY9');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_customers`
--

CREATE TABLE `tbl_customers` (
  `customer_id` int(10) UNSIGNED NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_customers`
--

INSERT INTO `tbl_customers` (`customer_id`, `customer_name`, `customer_email`, `customer_password`, `customer_phone`, `created_at`, `updated_at`) VALUES
(8, 'Trần Nguyễn Anh Thi', 'trannguyenanhthi1711@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0923243319', NULL, NULL),
(9, 'Trần Nguyễn Anh Thy', 'trannhi17676@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '092411689', NULL, NULL),
(10, 'HoaiThuong123', 'thuongtran2062000@gmail.com', 'ea5a486c712a91e48443cd802642223d', '0395700403', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `shipping_id` int(11) NOT NULL,
  `order_status` int(20) NOT NULL,
  `order_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `customer_id`, `shipping_id`, `order_status`, `order_code`, `order_date`, `created_at`, `updated_at`) VALUES
(60, 10, 79, 2, 'ed232', '2021-05-14', '2021-05-14 06:24:35', NULL),
(61, 10, 80, 2, '5b328', '2021-05-14', '2021-05-14 06:26:34', NULL),
(62, 10, 81, 2, '0ffb9', '2021-05-14', '2021-05-14 06:56:30', NULL),
(63, 10, 82, 2, '5effb', '2021-05-16', '2021-05-16 14:34:06', NULL),
(64, 10, 83, 2, 'a7591', '2021-05-16', '2021-05-16 14:42:39', NULL),
(65, 10, 84, 2, 'fdaa1', '2021-05-16', '2021-05-16 14:49:31', NULL),
(66, 10, 85, 2, '933eb', '2021-05-16', '2021-05-16 16:37:19', NULL),
(67, 10, 86, 2, '07a65', '2021-05-18', '2021-05-18 12:32:54', NULL),
(68, 10, 87, 1, '0112d', '2021-05-18', '2021-05-18 16:50:45', NULL),
(69, 10, 88, 2, '9ae27', '2021-05-18', '2021-05-18 16:55:19', NULL),
(70, 10, 89, 1, 'b0bd3', '2021-05-18', '2021-05-18 16:57:04', NULL),
(85, 10, 104, 1, '8b194', '2021-05-20', '2021-05-19 20:13:30', NULL),
(86, 10, 105, 1, '59bbe', '2021-05-20', '2021-05-19 20:14:47', NULL),
(87, 10, 106, 1, 'c4a5e', '2021-05-27', '2021-05-27 11:40:30', NULL),
(88, 10, 107, 2, '7ab90', '2021-05-27', '2021-05-27 11:53:57', NULL),
(89, 10, 108, 1, '54232', '2021-05-27', '2021-05-27 11:58:40', NULL),
(90, 10, 109, 1, 'b7863', '2021-05-27', '2021-05-27 12:03:02', NULL),
(91, 10, 110, 1, 'c08b5', '2021-05-27', '2021-05-27 12:05:53', NULL),
(92, 10, 111, 2, '20acd', '2021-05-27', '2021-05-27 12:12:26', NULL),
(93, 10, 112, 2, '18b81', '2021-05-27', '2021-05-27 12:15:03', NULL),
(94, 10, 113, 2, 'e7ade', '2021-05-27', '2021-05-27 12:23:19', NULL),
(95, 10, 114, 2, '36a87', '2021-05-27', '2021-05-27 12:25:18', NULL),
(96, 10, 115, 1, '27c57', '2021-05-27', '2021-05-27 12:27:50', NULL),
(97, 10, 116, 1, '96ca0', '2021-05-27', '2021-05-27 12:29:58', NULL),
(98, 10, 117, 1, '271f4', '2021-05-27', '2021-05-27 12:31:17', NULL),
(99, 10, 118, 2, 'e7f23', '2021-05-27', '2021-05-27 12:36:35', NULL),
(100, 10, 119, 2, 'cba93', '2021-05-27', '2021-05-27 12:37:40', NULL),
(101, 10, 120, 2, '52ea9', '2021-05-27', '2021-05-27 12:51:57', NULL),
(102, 10, 121, 1, '4729d', '2021-05-27', '2021-05-27 13:18:01', NULL),
(103, 10, 122, 1, '86141', '2021-05-28', '2021-05-28 06:08:03', NULL),
(104, 10, 123, 2, 'fef57', '2021-05-28', '2021-05-28 06:12:04', NULL),
(105, 10, 124, 2, '520e5', '2021-05-28', '2021-05-28 06:19:12', NULL),
(106, 10, 125, 2, 'a12b6', '2021-05-30', '2021-05-30 12:22:51', NULL),
(107, 10, 126, 2, '49951', '2021-05-30', '2021-05-30 12:38:16', NULL),
(108, 10, 127, 2, 'f8f34', '2021-05-30', '2021-05-30 12:51:58', NULL),
(109, 10, 128, 2, '369e3', '2021-05-30', '2021-05-30 12:53:14', NULL),
(110, 10, 129, 2, '120a8', '2021-05-30', '2021-05-30 12:55:55', NULL),
(111, 10, 130, 2, '97853', '2021-06-04', '2021-06-04 15:20:13', NULL),
(112, 10, 131, 2, 'd760f', '2021-06-04', '2021-06-04 15:41:34', NULL),
(113, 10, 132, 2, '45e80', '2021-06-04', '2021-06-04 15:49:08', NULL),
(114, 10, 133, 2, '57b37', '2021-06-04', '2021-06-04 15:54:12', NULL),
(115, 10, 134, 2, '2c74e', '2021-06-05', '2021-06-05 13:52:15', NULL),
(116, 10, 135, 2, '8ad1e', '2021-06-05', '2021-06-05 16:27:14', NULL),
(117, 10, 136, 2, 'c4448', '2021-06-05', '2021-06-05 16:34:40', NULL),
(118, 10, 137, 2, 'ddb1e', '2021-06-05', '2021-06-05 16:35:56', NULL),
(119, 10, 138, 2, '591db', '2021-06-05', '2021-06-05 16:47:59', NULL),
(120, 10, 139, 2, '2f5f0', '2021-06-08', '2021-06-08 07:46:24', NULL),
(121, 10, 140, 1, 'ec408', '2021-06-08', '2021-06-08 08:25:15', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order_details`
--

CREATE TABLE `tbl_order_details` (
  `order_details_id` bigint(20) UNSIGNED NOT NULL,
  `order_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_sales_quantity` int(11) NOT NULL,
  `product_coupon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_order_details`
--

INSERT INTO `tbl_order_details` (`order_details_id`, `order_code`, `product_id`, `product_name`, `product_price`, `product_sales_quantity`, `product_coupon`, `created_at`, `updated_at`) VALUES
(16, '3790e', 11, 'Tay cầm chơi game PS4 màu trắng', '500000', 2, 'COVID99', NULL, NULL),
(17, '3790e', 10, 'Tay cầm chơi game PS4 màu đỏ', '60000', 2, 'COVID99', NULL, NULL),
(18, '3790e', 9, 'Máy PS4 màu đỏ', '5000000', 1, 'COVID99', NULL, NULL),
(19, '3790e', 7, 'Tay cầm chơi game PS4 màu đỏ', '60000', 2, 'COVID99', NULL, NULL),
(20, '3790e', 8, 'Tay cầm chơi game PS4 màu trắng', '500000', 2, 'COVID99', NULL, NULL),
(21, '699d7', 11, 'Tay cầm chơi game PS4 màu trắng', '500000', 2, 'COVID99', NULL, NULL),
(22, '699d7', 10, 'Tay cầm chơi game PS4 màu đỏ', '60000', 6, 'COVID99', NULL, NULL),
(23, '699d7', 9, 'Máy PS4 màu đỏ', '5000000', 4, 'COVID99', NULL, NULL),
(24, '699d7', 7, 'Tay cầm chơi game PS4 màu đỏ', '60000', 3, 'COVID99', NULL, NULL),
(25, '699d7', 8, 'Tay cầm chơi game PS4 màu trắng', '500000', 2, 'COVID99', NULL, NULL),
(26, '346b1', 11, 'Tay cầm chơi game PS4 màu trắng', '500000', 1, 'HDH375Y', NULL, NULL),
(27, '346b1', 12, 'Máy PS4 màu đỏ', '5000000', 1, 'HDH375Y', NULL, NULL),
(28, 'b0374', 11, 'Tay cầm chơi game PS4 màu trắng', '500000', 1, 'THUONG1', NULL, NULL),
(29, 'b0374', 10, 'Tay cầm chơi game PS4 màu đỏ', '60000', 1, 'THUONG1', NULL, NULL),
(30, '2c7fc', 11, 'Tay cầm chơi game PS4 màu trắng', '500000', 1, 'THUONG1', NULL, NULL),
(31, 'baca3', 11, 'Tay cầm chơi game PS4 màu trắng', '500000', 1, 'THUONG1', NULL, NULL),
(32, 'baca3', 12, 'Máy PS4 màu đỏ', '5000000', 1, 'THUONG1', NULL, NULL),
(33, 'a094f', 10, 'Tay cầm chơi game PS4 màu đỏ', '60000', 1, 'THUONG1', NULL, NULL),
(34, 'a094f', 8, 'Tay cầm chơi game PS4 màu trắng', '500000', 1, 'THUONG1', NULL, NULL),
(35, '168cf', 14, 'Xbox 11233', '1500000', 1, 'COVID99', NULL, NULL),
(36, '168cf', 12, 'Máy PS4 màu đỏ', '5000000', 1, 'COVID99', NULL, NULL),
(37, '168cf', 11, 'Tay cầm chơi game PS4 màu trắng', '500000', 1, 'COVID99', NULL, NULL),
(38, 'd8ba7', 2, 'Tay cầm chơi game PS4 màu trắng', '500000', 10, 'COVID99', NULL, NULL),
(39, 'd8ba7', 11, 'Tay cầm chơi game PS4 màu trắng', '500000', 3, 'COVID99', NULL, NULL),
(40, 'd8ba7', 14, 'Xbox 11233', '1500000', 5, 'COVID99', NULL, NULL),
(41, 'd8ba7', 7, 'Tay cầm chơi game PS4 màu đỏ', '60000', 4, 'COVID99', NULL, NULL),
(42, 'd8ba7', 9, 'Máy PS4 màu đỏ', '5006000', 8, 'COVID99', NULL, NULL),
(43, '9681f', 2, 'Tay cầm chơi game PS4 màu trắng', '500000', 6, 'HDH375Y', NULL, NULL),
(44, '9681f', 1, 'Tay cầm chơi game PS4 màu đỏ', '60000', 5, 'HDH375Y', NULL, NULL),
(45, '9681f', 7, 'Tay cầm chơi game PS4 màu đỏ', '60000', 10, 'HDH375Y', NULL, NULL),
(46, '9681f', 5, 'Tay cầm chơi game PS4 màu trắng', '500000', 5, 'HDH375Y', NULL, NULL),
(47, '52e30', 10, 'Tay cầm chơi game PS4 màu đỏ', '60000', 14, 'COVID99', NULL, NULL),
(48, '745e6', 2, 'Tay cầm chơi game PS4 màu trắng', '500000', 6, 'COVID99', NULL, NULL),
(49, '564ea', 2, 'Tay cầm chơi game PS4 màu trắng', '500000', 10, 'COVID99', NULL, NULL),
(50, '3dfcb', 7, 'Tay cầm chơi game PS4 màu đỏ', '60000', 1, 'THY9', NULL, NULL),
(51, 'b23e4', 1, 'Tay cầm chơi game PS4 màu đỏ', '60000', 1, 'THY9', NULL, NULL),
(52, 'e2444', 1, 'Tay cầm chơi game PS4 màu đỏ', '60000', 1, 'THY9', NULL, NULL),
(53, '01670', 5, 'Tay cầm chơi game PS4 màu trắng', '500000', 6, 'THY9', NULL, NULL),
(54, '01670', 12, 'Máy PS4 màu đỏ', '5000000', 1, 'THY9', NULL, NULL),
(55, '01670', 4, 'Tay cầm chơi game PS4 màu đỏ', '60000', 1, 'THY9', NULL, NULL),
(56, '56e45', 2, 'Tay cầm chơi game PS4 màu trắng', '500000', 7, 'THY9', NULL, NULL),
(57, '56e45', 4, 'Tay cầm chơi game PS4 màu đỏ', '60000', 5, 'THY9', NULL, NULL),
(58, 'a06b9', 9, 'Máy PS4 màu đỏ', '5006000', 1, 'THY9', NULL, NULL),
(59, 'a06b9', 2, 'Tay cầm chơi game PS4 màu trắng', '500000', 1, 'THY9', NULL, NULL),
(60, 'ee27d', 11, 'Tay cầm chơi game PS4 màu trắng', '500000', 1, 'THY9', NULL, NULL),
(61, 'afd95', 7, 'Tay cầm chơi game PS4 màu đỏ', '60000', 1, 'THY9', NULL, NULL),
(62, 'afd95', 3, 'Máy PS4 màu đỏ', '3500000', 1, 'THY9', NULL, NULL),
(63, '5c803', 2, 'Tay cầm chơi game PS4 màu trắng', '500000', 2, 'THY9', NULL, NULL),
(64, '2c1e0', 11, 'Tay cầm chơi game PS4 màu trắng', '500000', 1, 'THY9', NULL, NULL),
(65, '01346', 3, 'Máy PS4 màu đỏ', '3500000', 3, 'THY9', NULL, NULL),
(66, 'af1c5', 12, 'Máy PS4 màu đỏ', '5000000', 1, 'THY9', NULL, NULL),
(67, 'af1c5', 8, 'Tay cầm chơi game PS4 màu trắng', '500000', 1, 'THY9', NULL, NULL),
(68, 'af1c5', 3, 'Máy PS4 màu đỏ', '3500000', 1, 'THY9', NULL, NULL),
(69, 'af1c5', 4, 'Tay cầm chơi game PS4 màu đỏ', '60000', 1, 'THY9', NULL, NULL),
(70, 'a207d', 12, 'Máy PS4 màu đỏ', '5000000', 1, 'THY9', NULL, NULL),
(71, '61d14', 6, 'Máy PS4 màu đỏ', '5600000', 1, 'THY9', NULL, NULL),
(72, '00e06', 6, 'Máy PS4 màu đỏ', '5600000', 1, 'THY9', NULL, NULL),
(73, '0e8e7', 12, 'Máy PS4 màu đỏ', '5000000', 1, 'THY9', NULL, NULL),
(74, '47702', 3, 'Máy PS4 màu đỏ', '3500000', 1, 'THY9', NULL, NULL),
(75, '6db8d', 3, 'Máy PS4 màu đỏ', '3500000', 1, 'THY9', NULL, NULL),
(76, 'ab369', 6, 'Máy PS4 màu đỏ', '5600000', 1, 'THY9', NULL, NULL),
(77, '988ac', 6, 'Máy PS4 màu đỏ', '5600000', 1, 'THY9', NULL, NULL),
(78, '0cae9', 3, 'Máy PS4 màu đỏ', '3500000', 2, 'THY9', NULL, NULL),
(79, '42dab', 9, 'Máy PS4 màu đỏ', '5006000', 2, 'THY9', NULL, NULL),
(80, 'feffe', 3, 'Máy PS4 màu đỏ', '3500000', 1, 'THY9', NULL, NULL),
(81, 'd3eb8', 6, 'Máy PS4 màu đỏ', '5600000', 1, 'THY9', NULL, NULL),
(82, 'fbbfb', 9, 'Máy PS4 màu đỏ', '5006000', 1, 'THY9', NULL, NULL),
(83, 'fbbfb', 6, 'Máy PS4 màu đỏ', '5600000', 1, 'THY9', NULL, NULL),
(84, '1e8fd', 3, 'Máy PS4 màu đỏ', '3500000', 1, 'THY9', NULL, NULL),
(85, '1e8fd', 12, 'Máy PS4 màu đỏ', '5000000', 1, 'THY9', NULL, NULL),
(86, '65f45', 9, 'Máy PS4 màu đỏ', '5006000', 1, 'no', NULL, NULL),
(87, '7c1a7', 9, 'Máy PS4 màu đỏ', '5006000', 1, 'THY9', NULL, NULL),
(88, '7a858', 5, 'Tay cầm chơi game PS4 màu trắng', '500000', 1, 'THY9', NULL, NULL),
(89, '3ef41', 2, 'Tay cầm chơi game PS4 màu trắng', '500000', 1, 'THY9', NULL, NULL),
(90, '3ef41', 4, 'Tay cầm chơi game PS4 màu đỏ', '60000', 1, 'THY9', NULL, NULL),
(91, 'dec3b', 2, 'Tay cầm chơi game PS4 màu trắng', '500000', 1, 'THY9', NULL, NULL),
(92, 'b2c79', 28, 'HoaiThuongheo', '5000000', 6, 'THY9', NULL, NULL),
(93, '8419f', 2, 'Tay cầm chơi game PS4 màu trắng', '500000', 1, 'THUONG1', NULL, NULL),
(94, '887fe', 3, 'Máy PS4 màu đỏ', '3500000', 4, 'THUONG1', NULL, NULL),
(95, '0345c', 3, 'Máy PS4 màu đỏ', '3500000', 1, 'THUONG1', NULL, NULL),
(96, '11676', 6, 'Máy PS4 màu đỏ', '5600000', 1, 'THUONG1', NULL, NULL),
(97, 'ed232', 3, 'Máy PS4 màu đỏ', '3500000', 2, 'COVID99', NULL, NULL),
(98, '5b328', 2, 'Tay cầm chơi game PS4 màu trắng', '500000', 4, 'THUONG1', NULL, NULL),
(99, '0ffb9', 5, 'Tay cầm chơi game PS4 màu trắng', '500000', 1, 'no', NULL, NULL),
(100, '5effb', 2, 'Tay cầm chơi game PS4 màu trắng h', '500000', 1, 'COVID99', NULL, NULL),
(101, 'a7591', 5, 'Tay cầm chơi game PS4 màu trắng', '500000', 1, 'COVID99', NULL, NULL),
(102, 'a7591', 29, 'HoaiThuong112', '5000000', 1, 'COVID99', NULL, NULL),
(103, 'fdaa1', 29, 'HoaiThuong112', '5000000', 1, 'THY9', NULL, NULL),
(104, '933eb', 2, 'Tay cầm chơi game PS4 màu trắng h', '500000', 1, 'no', NULL, NULL),
(105, '07a65', 35, 'MSI GF69 Thin', '21990000', 1, 'THY9', NULL, NULL),
(106, '07a65', 31, 'Acer Nitro 5', '18990000', 1, 'THY9', NULL, NULL),
(107, '0112d', 47, 'Macbook Pro 13\" 2020', '36390000', 1, 'THY9', NULL, NULL),
(108, '9ae27', 50, 'GHOST S', '26490000', 1, 'THY9', NULL, NULL),
(109, '9ae27', 48, 'Macbook Pro 13 2020', '30890000', 1, 'THY9', NULL, NULL),
(110, 'b0bd3', 43, 'Lenovo Ideapad Slim', '18990000', 1, 'THY9', NULL, NULL),
(111, '54a08', 34, 'MSI GE66 Raider', '22190000', 1, 'COVID99', NULL, NULL),
(112, '54a08', 62, 'Máy in Brother', '4890000', 1, 'COVID99', NULL, NULL),
(113, '54a08', 31, 'Acer Nitro 5', '18990000', 1, 'COVID99', NULL, NULL),
(114, 'fd064', 31, 'Acer Nitro 5', '18990000', 1, 'no', NULL, NULL),
(115, '6ab34', 51, 'Intel Core i5 10400F', '4390000', 1, 'no', NULL, NULL),
(116, '8322b', 65, 'Micro Kingston HyperX', '8000000', 1, 'no', NULL, NULL),
(117, '06a35', 65, 'Micro Kingston HyperX', '8000000', 1, 'no', NULL, NULL),
(118, '2b24b', 65, 'Micro Kingston HyperX', '8000000', 1, 'no', NULL, NULL),
(119, '80808', 65, 'Micro Kingston HyperX', '8000000', 1, 'no', NULL, NULL),
(120, '94bc3', 51, 'Intel Core i5 10400F', '4390000', 1, 'no', NULL, NULL),
(121, 'd005e', 47, 'Macbook Pro 13\" 2020', '36390000', 1, 'no', NULL, NULL),
(122, '1d1eb', 51, 'Intel Core i5 10400F', '4390000', 1, 'no', NULL, NULL),
(123, '78147', 47, 'Macbook Pro 13\" 2020', '36390000', 1, 'COVID99', NULL, NULL),
(124, '4a448', 51, 'Intel Core i5 10400F', '4390000', 1, 'no', NULL, NULL),
(125, '4b121', 47, 'Macbook Pro 13\" 2020', '36390000', 1, 'COVID99', NULL, NULL),
(126, '79128', 47, 'Macbook Pro 13\" 2020', '36390000', 1, 'COVID99', NULL, NULL),
(127, '8b194', 65, 'Micro Kingston HyperX', '8000000', 1, 'no', NULL, NULL),
(128, '59bbe', 48, 'Macbook Pro 13 2020', '30890000', 1, 'COVID99', NULL, NULL),
(129, 'c4a5e', 31, 'Acer Nitro 5', '18990000', 1, 'no', NULL, NULL),
(130, '7ab90', 65, 'Micro Kingston HyperX', '8000000', 1, 'no', NULL, NULL),
(131, '7ab90', 63, 'ASUS RT-AX82U', '7390000', 1, 'no', NULL, NULL),
(132, '54232', 62, 'Máy in Brother', '4890000', 1, 'no', NULL, NULL),
(133, 'b7863', 31, 'Acer Nitro 5', '18990000', 1, 'no', NULL, NULL),
(134, '20acd', 68, 'HyperX cloud II RED', '18990000', 1, 'no', NULL, NULL),
(135, '18b81', 68, 'HyperX cloud II RED', '18990000', 1, 'no', NULL, NULL),
(136, 'e7ade', 60, 'Loa JBL Quantum DUO', '3490000', 1, 'no', NULL, NULL),
(137, '36a87', 59, 'Chuột Razer DeathAdder V2', '1790000', 1, 'no', NULL, NULL),
(138, '27c57', 68, 'HyperX cloud II RED', '18990000', 1, 'no', NULL, NULL),
(139, '96ca0', 49, 'TITAN 10M', '11990000', 1, 'no', NULL, NULL),
(140, '271f4', 63, 'ASUS RT-AX82U', '7390000', 1, 'no', NULL, NULL),
(141, 'e7f23', 63, 'ASUS RT-AX82U', '7390000', 1, 'no', NULL, NULL),
(142, 'cba93', 47, 'Macbook Pro 13\" 2020', '36390000', 1, 'no', NULL, NULL),
(143, '52ea9', 47, 'Macbook Pro 13\" 2020', '36390000', 1, 'no', NULL, NULL),
(144, '52ea9', 63, 'ASUS RT-AX82U', '7390000', 1, 'no', NULL, NULL),
(145, '4729d', 31, 'Acer Nitro 5', '18990000', 1, 'no', NULL, NULL),
(146, '4729d', 58, 'Logitach G Pro Wireless', '2590000', 1, 'no', NULL, NULL),
(147, '86141', 34, 'MSI GE66 Raider', '22190000', 1, 'no', NULL, NULL),
(148, 'fef57', 56, 'Bàn phím cơ Razer', '3190000', 1, 'no', NULL, NULL),
(149, '520e5', 58, 'Logitach G Pro Wireless', '2590000', 1, 'no', NULL, NULL),
(150, 'a12b6', 34, 'MSI GE66 Raider', '22190000', 1, 'THUONG1', NULL, NULL),
(151, '49951', 58, 'Logitach G Pro Wireless', '2590000', 1, 'THUONG1', NULL, NULL),
(152, 'f8f34', 60, 'Loa JBL Quantum DUO', '3490000', 1, 'THUONG1', NULL, NULL),
(153, 'f8f34', 31, 'Acer Nitro 5', '18990000', 1, 'THUONG1', NULL, NULL),
(154, '369e3', 62, 'Máy in Brother', '4890000', 1, 'no', NULL, NULL),
(155, '120a8', 62, 'Máy in Brother', '4890000', 1, 'no', NULL, NULL),
(156, '97853', 34, 'MSI GE66 Raider', '22190000', 1, 'no', NULL, NULL),
(157, '97853', 35, 'MSI GF69 Thin', '21990000', 1, 'no', NULL, NULL),
(158, 'd760f', 37, 'ASUS Zenbook Duo 14', '22990000', 1, 'no', NULL, NULL),
(159, 'd760f', 36, 'MSI GE75 Raider', '18790000', 1, 'no', NULL, NULL),
(160, 'd760f', 35, 'MSI GF69 Thin', '21990000', 1, 'no', NULL, NULL),
(161, '45e80', 31, 'Acer Nitro 5', '18990000', 1, 'no', NULL, NULL),
(162, '57b37', 31, 'Acer Nitro 5', '18990000', 1, 'no', NULL, NULL),
(163, '2c74e', 31, 'Acer Nitro 5', '18990000', 1, 'no', NULL, NULL),
(164, '2c74e', 32, 'MSI GF 63 Thin 10SC', '18790000', 1, 'no', NULL, NULL),
(165, '8ad1e', 31, 'Acer Nitro 5', '18990000', 2, 'no', NULL, NULL),
(166, '8ad1e', 60, 'Loa JBL Quantum DUO', '3490000', 1, 'no', NULL, NULL),
(167, 'c4448', 31, 'Acer Nitro 5', '18990000', 1, 'no', NULL, NULL),
(168, 'ddb1e', 31, 'Acer Nitro 5', '18990000', 1, 'no', NULL, NULL),
(169, '591db', 35, 'MSI GF69 Thin', '21990000', 2, 'no', NULL, NULL),
(170, '2f5f0', 55, 'Màn hình cong Samsung LC27', '7890000', 1, 'no', NULL, NULL),
(171, 'ec408', 31, 'Acer Nitro 5', '18990000', 3, 'no', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_quantity` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_sold` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `product_name`, `product_quantity`, `product_sold`, `category_id`, `brand_id`, `product_desc`, `product_content`, `product_price`, `product_image`, `product_status`, `created_at`, `updated_at`) VALUES
(31, 'Acer Nitro 5', '1', 7, 21, 2, 'Nhà sản xuất : ACER\r\n\r\nXuất xứ : Chính hãng\r\n\r\nBảo hành : 12 Tháng\r\n\r\nTình trạng : Mới 100%', 'Nhà sản xuất : ACER\r\n\r\nXuất xứ : Chính hãng\r\n\r\nBảo hành : 12 Tháng\r\n\r\nTình trạng : Mới 100%', '18990000', '187.png', 0, NULL, NULL),
(32, 'MSI GF 63 Thin 10SC', '49', 1, 21, 1, 'Nhà sản xuất : MSI\r\n\r\nXuất xứ : Chính hãng\r\n\r\nBảo hành : 12 Tháng\r\n\r\nTình trạng : Mới 100%', 'Nhà sản xuất : MSI\r\n\r\nXuất xứ : Chính hãng\r\n\r\nBảo hành : 12 Tháng\r\n\r\nTình trạng : Mới 100%', '18790000', '256.png', 0, NULL, NULL),
(33, 'ROG Strix G G512', '50', 0, 21, 3, 'Nhà sản xuất : Asus\r\n\r\nXuất xứ : Chính hãng\r\n\r\nBảo hành : 24 Tháng\r\n\r\nTình trạng : Mới 100%\r\n\r\nMàu sắc: Black', 'Nhà sản xuất : Asus\r\n\r\nXuất xứ : Chính hãng\r\n\r\nBảo hành : 24 Tháng\r\n\r\nTình trạng : Mới 100%\r\n\r\nMàu sắc: Black', '19890000', '350.jpg', 0, NULL, NULL),
(34, 'MSI GE66 Raider', '48', 2, 21, 1, 'Nhà sản xuất : MSI\r\n\r\nXuất xứ : Chính hãng\r\n\r\nBảo hành : 24 Tháng\r\n\r\nTình trạng : Mới 100%\r\n\r\nMàu sắc: Black', 'Nhà sản xuất : MSI\r\n\r\nXuất xứ : Chính hãng\r\n\r\nBảo hành : 24 Tháng\r\n\r\nTình trạng : Mới 100%\r\n\r\nMàu sắc: Black', '22190000', '457.png', 0, NULL, NULL),
(35, 'MSI GF69 Thin', '46', 4, 21, 1, 'Nhà sản xuất : MSI Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', 'Nhà sản xuất : MSI Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', '21990000', '577.png', 0, NULL, NULL),
(36, 'MSI GE75 Raider', '50', 0, 21, 1, 'Nhà sản xuất : MSI Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', 'Nhà sản xuất : MSI Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', '18790000', '682.jpg', 0, NULL, NULL),
(37, 'ASUS Zenbook Duo 14', '50', 0, 21, 3, 'Nhà sản xuất : ASUS Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', 'Nhà sản xuất : ASUS Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', '22990000', '739.jpg', 0, NULL, NULL),
(38, 'ROG Zephyrus M', '50', 0, 21, 3, 'Nhà sản xuất : ASUS Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', 'Nhà sản xuất : ASUS Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', '18990000', '842.jpg', 0, NULL, NULL),
(39, 'ASUS Vivobook M513UA', '50', 0, 21, 3, 'Nhà sản xuất : ASUS Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', 'Nhà sản xuất : ASUS Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', '23000000', '959.jpg', 0, NULL, NULL),
(40, 'ROG Zephyrus G15', '50', 0, 21, 3, 'Nhà sản xuất : ASUS Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', 'Nhà sản xuất : ASUS Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', '27890000', '1071.png', 0, NULL, NULL),
(41, 'Acer Nitro 5 AN5', '50', 0, 21, 2, 'Nhà sản xuất : Acer Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', 'Nhà sản xuất : Acer Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', '21780000', '1151.png', 0, NULL, NULL),
(42, 'Acer Predator Helios', '50', 0, 21, 2, 'Nhà sản xuất : Acer Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', 'Nhà sản xuất : Acer Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', '19890000', '1255.png', 0, NULL, NULL),
(43, 'Lenovo Ideapad Slim', '50', 0, 21, 4, 'Nhà sản xuất : Lenovo Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', 'Nhà sản xuất : Lenovo  Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', '18990000', '1411.jpg', 0, NULL, NULL),
(44, 'HP 15S FQ2027TU', '50', 0, 21, 5, 'Nhà sản xuất : HP Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', 'Nhà sản xuất : HP Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', '22190000', '1615.jpg', 0, NULL, NULL),
(45, 'DELL G3 3000', '50', 0, 21, 6, 'Nhà sản xuất : DELL Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', 'Nhà sản xuất : DELL Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', '22389000', '1729.png', 0, NULL, NULL),
(46, 'DELL Inspiron 15', '50', 0, 21, 6, 'Nhà sản xuất : DELL Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', 'Nhà sản xuất : DELL Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', '22190000', '1894.jpg', 0, NULL, NULL),
(47, 'Macbook Pro 13\" 2020', '48', 2, 21, 7, 'Nhà sản xuất : Apple Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', 'Nhà sản xuất : Apple Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', '36390000', '1915.jpg', 0, NULL, NULL),
(48, 'Macbook Pro 13 2020', '49', 1, 21, 7, 'Nhà sản xuất : Apple Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', 'Nhà sản xuất : Apple Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', '30890000', '2099.jpg', 0, NULL, NULL),
(49, 'TITAN 10M', '50', 0, 20, 3, 'Nhà sản xuất : ASUS Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', 'Nhà sản xuất : ASUS Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', '11990000', '2412.jpg', 0, NULL, NULL),
(50, 'GHOST S', '49', 1, 20, 7, 'Nhà sản xuất : ACER Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', 'Nhà sản xuất : ACER Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', '26490000', '2516.jpg', 0, NULL, NULL),
(51, 'Intel Core i5 10400F', '50', 0, 19, 8, 'Thông tin chung:\r\n\r\nHãng sản xuất: Intel\r\nTình trạng: Mới\r\nBảo hành: 36 Tháng', 'Thông tin chung:\r\n\r\nHãng sản xuất: Intel\r\nTình trạng: Mới\r\nBảo hành: 36 Tháng', '4390000', 'CPU13.jpg', 0, NULL, NULL),
(52, 'GIGABYTE Z490 VISION D', '50', 0, 19, 8, 'Hãng sản xuất: GIGABYTE\r\n\r\nTình trạng: Mới 100%\r\n\r\nBảo hành: 36 tháng', 'Hãng sản xuất: GIGABYTE\r\n\r\nTình trạng: Mới 100%\r\n\r\nBảo hành: 36 tháng', '7990000', 'mainboard92.png', 0, NULL, NULL),
(53, 'GIGABYTE GeForce RTX™', '50', 0, 19, 8, 'Thông tin chung:\r\n\r\nHãng sản xuất: Gigabyte \r\nTình trạng: Mới\r\nBảo hành: 36 Tháng', 'Thông tin chung:\r\n\r\nHãng sản xuất: Gigabyte \r\nTình trạng: Mới\r\nBảo hành: 36 Tháng', '28890000', 'VGA73.png', 0, NULL, NULL),
(54, 'Corsair Dominator Platinum RGB', '50', 0, 19, 8, '- Nhà sản xuất: CORSAIR\r\n- Loại RAM: DDR4\r\n- Dung lượng: 16GB \r\n- Số lượng: 2 thanh\r\n- Bus: 3200MHz\r\n- Tản nhiệt: Có\r\n- Màu: Đen\r\n- Bảo Hành: 36 Tháng', '- Nhà sản xuất: CORSAIR\r\n- Loại RAM: DDR4\r\n- Dung lượng: 16GB \r\n- Số lượng: 2 thanh\r\n- Bus: 3200MHz\r\n- Tản nhiệt: Có\r\n- Màu: Đen\r\n- Bảo Hành: 36 Tháng', '4090000', 'RAM10.png', 0, NULL, NULL),
(55, 'Màn hình cong Samsung LC27', '49', 1, 18, 8, '-Nhà sản xuất : SAMSUNG\r\n\r\n-Bảo hành : 24 tháng tại SamSung\r\n\r\n-Mã màn hình: LC27RG50FQE', '-Nhà sản xuất : SAMSUNG\r\n\r\n-Bảo hành : 24 tháng tại SamSung\r\n\r\n-Mã màn hình: LC27RG50FQE', '7890000', '2351.jpg', 0, NULL, NULL),
(56, 'Bàn phím cơ Razer', '49', 1, 17, 8, 'Thông tin chung:\r\n\r\nHãng sản xuất: Razer \r\nTình trạng: Mới\r\nBảo hành: 24 Tháng\r\nSwitch: Razer Opto Switch Clicky/ Linear', 'Thông tin chung:\r\n\r\nHãng sản xuất: Razer \r\nTình trạng: Mới\r\nBảo hành: 24 Tháng\r\nSwitch: Razer Opto Switch Clicky/ Linear', '3190000', '261.jpg', 0, NULL, NULL),
(57, 'Bàn phím Corsair K70 RGB', '50', 0, 17, 8, 'Bàn phím Corsair K70 RGB', 'Bàn phím Corsair K70 RGB', '3590000', '2734.png', 0, NULL, NULL),
(58, 'Logitach G Pro Wireless', '50', 0, 16, 8, 'Nhà sản xuất : logitech Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', 'Nhà sản xuất : logitech Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', '2590000', 'Logitech G pro Wireless52.png', 0, NULL, NULL),
(59, 'Chuột Razer DeathAdder V2', '49', 1, 16, 8, 'Nhà sản xuất : razer Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', 'Nhà sản xuất : razer Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', '1790000', 'Chuột Razer DeathAdder V29.jpg', 0, NULL, NULL),
(60, 'Loa JBL Quantum DUO', '49', 1, 14, 8, 'Nhà sản xuất : JBL Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', 'Nhà sản xuất : JBL Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', '3490000', 'JBL Quantum DUO23.jpg', 0, NULL, NULL),
(61, 'Loa Razer Leviathan 5.1', '50', 0, 14, 8, 'Nhà sản xuất : JBL Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', 'Nhà sản xuất : JBL Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', '3990000', 'Razer Leviathan 59.jpg', 0, NULL, NULL),
(62, 'Máy in Brother', '49', 1, 13, 8, 'Nhà sản xuất : JBL Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', 'Nhà sản xuất : JBL Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', '4890000', 'máy in brother15.jpg', 0, NULL, NULL),
(63, 'ASUS RT-AX82U', '47', 3, 12, 3, 'Nhà sản xuất : ASUS Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', 'Nhà sản xuất : ASUS Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', '7390000', 'Asus RT-AX82U12.jpg', 0, NULL, NULL),
(64, 'ASUS RT-AX86U', '50', 0, 12, 8, 'Nhà sản xuất : ASUS Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', 'Nhà sản xuất : ASUS Xuất xứ : Chính hãng Bảo hành : 12 Tháng Tình trạng : Mới 100%', '7890000', 'Asus RT-AX86U53.jpg', 0, NULL, NULL),
(65, 'Micro Kingston HyperX', '49', 1, 11, 8, 'Micro Kingston HyperX', 'Micro Kingston HyperX', '8000000', 'Micro Kingston HyperX67.jpg', 0, NULL, NULL),
(66, 'Cáp Lightning Mophie 1M', '50', 0, 11, 8, 'Cáp Lightning Mophie 1M', 'Cáp Lightning Mophie 1M', '520000', 'Cáp Lightning Mophie 1M55.jpg', 0, NULL, NULL),
(67, 'Webcam Logitech M', '50', 0, 11, 8, 'webcam logitech', 'webcam logitech', '4590000', 'webcam logitech92.jpg', 0, NULL, NULL),
(68, 'HyperX cloud II RED', '48', 2, 15, 8, 'HyperX cloud II RED', 'HyperX cloud II RED', '18990000', 'HyperX cloud II RED88.jpg', 0, NULL, NULL),
(69, 'Logitech G Pro X', '50', 0, 15, 8, 'Logitech G Pro X', 'Logitech G Pro X', '3890000', 'Logitach G Pro X40.png', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_shipping`
--

CREATE TABLE `tbl_shipping` (
  `shipping_id` int(10) UNSIGNED NOT NULL,
  `shipping_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_notes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_method` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_shipping`
--

INSERT INTO `tbl_shipping` (`shipping_id`, `shipping_name`, `shipping_address`, `shipping_phone`, `shipping_email`, `shipping_notes`, `shipping_method`, `created_at`, `updated_at`) VALUES
(17, 'Hieu Tấn', '245 Nguyễn Văn Khạ, Tân An Hội .Thị trấn Củ Chi,TPHCM', '0932023992', 'Hieu dep giai', 'Nhanh nha mày', 1, NULL, NULL),
(18, 'Trần Nguyễn Anh Thi', '41 Đặng Thùy Trâm', '0923243319', 'trannguyenanhthi1711@gmail.com', 'aaaa', 1, NULL, NULL),
(19, 'Trần Nguyễn Anh Thi', '41 Đặng Thùy Trâm', '0923243319', 'trannhi17676@gmail.com', 'aaaa', 1, NULL, NULL),
(20, 'Trần Nguyễn Anh Thi', '41 Đặng Thùy Trâm', '0923243319', 'trannguyenanhthi1711@gmail.com', 'aaaaaaaaaaa', 1, NULL, NULL),
(21, 'Trần Nguyễn Anh Thi', '41 Đặng Thùy Trâm', '0923243319', 'trannguyenanhthi1711@gmail.com', 'zzzzzzzzzzzz', 1, NULL, NULL),
(22, 'Trần Nguyễn Anh Thi', '41 Đặng Thùy Trâm', '0923243319', 'trannguyenanhthi1711@gmail.com', 'sssssss', 1, NULL, NULL),
(23, 'Trần Nguyễn Anh Thi', '41 Đặng Thùy Trâm', '0923243319', 'trannguyenanhthi1711@gmail.com', 'aaaaaaaa', 1, NULL, NULL),
(24, 'Trần Nguyễn Anh Thi', '41 Đặng Thùy Trâm', '0923243319', 'trannguyenanhthi1711@gmail.com', 'Aaaaaa', 1, NULL, NULL),
(25, 'Thương', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 'aaaaaaa', 1, NULL, NULL),
(26, 'ThươngHoai', '103 Khuông Việt, Tân Phú, Phú Trung,HCM', '09677384047', 'thuong@gmail.com', 'hang de vo', 1, NULL, NULL),
(27, 'ThươngHoai', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 'âaaaaaaa', 1, NULL, NULL),
(28, 'ThươngHoai', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 'h', 1, NULL, NULL),
(29, 'ThươngHoai', '200 Khuông Việt, Tân Phú, Phú Trung,HCM', '09677384089', 'thuong@gmail.com', 'jj', 1, NULL, NULL),
(30, 'Thuan', '500 Khuông Việt, Tân Phú, Phú Trung,HCM', '09677384089', 'thuonahsag@gmail.com', 'kkk', 1, NULL, NULL),
(31, 'Thuan', '500 Khuông Việt, Tân Phú, Phú Trung,HCM', '09677384089', 'thuonahsag@gmail.com', 'âsas', 1, NULL, NULL),
(32, 'Thuan', '500 Khuông Việt, Tân Phú, Phú Trung,HCM', '09677384089', 'thuong123@gmail.com', 'lplp', 1, NULL, NULL),
(33, 'Thuan', '200 Khuông Việt, Tân Phú, Phú Trung,HCM', '09677384089', 'thuong@gmail.com', 'kkk', 1, NULL, NULL),
(34, 'Thuan', '103 Khuông Việt, Tân Phú, Phú Trung,HCM', '09677384089', 'thuonahsag@gmail.com', 'kkk', 1, NULL, NULL),
(35, 'ThươngHoai', '500 Khuông Việt, Tân Phú, Phú Trung,HCM', '09677384089', 'thuong@gmail.com', 'aaaaaa', 1, NULL, NULL),
(36, 'Thương', '200 Khuông Việt, Tân Phú, Phú Trung,HCM', '09677384047', 'thuong@gmail.com', 'haha', 1, NULL, NULL),
(37, 'ThươngHoai', '103 Khuông Việt, Tân Phú, Phú Trung,HCM', '09677384089', 'thuong@gmail.com', 'hhh', 1, NULL, NULL),
(38, 'ThươngHoai', '103 Khuông Việt, Tân Phú, Phú Trung,HCM', '09677384089', 'thuonahsag@gmail.com', 'aaaa', 1, NULL, NULL),
(39, 'Thương', '200 Khuông Việt, Tân Phú, Phú Trung,HCM', '09677384047', 'thuong@gmail.com', 'jj', 1, NULL, NULL),
(40, 'Thương', '200 Khuông Việt, Tân Phú, Phú Trung,HCM', '09677384047', 'thuonahsag@gmail.com', 'hh', 1, NULL, NULL),
(41, 'ThươngHoai', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384089', 'thuonahsag@gmail.com', 'dđ', 1, NULL, NULL),
(42, 'Thương', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 'kknkn', 1, NULL, NULL),
(43, 'Thương', 'hhaajhaashjahsj', '09677384089', 'thuong@gmail.com', 'kkkkkk', 1, NULL, NULL),
(44, 'ThươngHoai', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 'dd', 1, NULL, NULL),
(45, 'ThươngHoai', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 'dd', 1, NULL, NULL),
(46, 'ThươngHoai', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 'dd', 1, NULL, NULL),
(47, 'ThươngHoai', '500 Khuông Việt, Tân Phú, Phú Trung,HCM', '09677384089', 'thuong@gmail.com', 'haha', 1, NULL, NULL),
(48, 'ThươngHoai', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384089', 'thuong@gmail.com', 'zzzzzzzzzzzzzz', 1, NULL, NULL),
(49, 'Thương', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 'kk', 1, NULL, NULL),
(50, 'ThươngHoai', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 'kk', 1, NULL, NULL),
(51, 'ThươngHoai', 'hhaajhaashjahsj', '09677384047', 'thuonahsag@gmail.com', 'nknk', 1, NULL, NULL),
(52, 'ThươngHoai', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384089', 'thuong@gmail.com', 'hhhh', 1, NULL, NULL),
(53, 'Thương', 'hhaajhaashjahsj', '09677384089', 'thuonahsag@gmail.com', 'lklk', 1, NULL, NULL),
(54, 'Thương', 'hhaajhaashjahsj', '09677384047', 'thuong@gmail.com', 'nnnn', 1, NULL, NULL),
(55, 'Thương', 'nhà ngõ', '09677384047', 'thuong@gmail.com', 'khoi giao cung dc', 1, NULL, NULL),
(56, 'Thương', 'hhaajhaashjahsj', '09677384047', 'thuong@gmail.com', 'd', 1, NULL, NULL),
(57, 'ThươngHoai', '200 Khuông Việt, Tân Phú, Phú Trung,HCM', '09677384089', 'thuonahsag@gmail.com', 'zzzzzzzzz', 1, NULL, NULL),
(58, 'Thuan', 'hhaajhaashjahsj', '09677384047', 'thuong@gmail.com', 'tesst', 1, NULL, NULL),
(59, 'Thương', 'nhà ngõ', '09677384047', 'thuong@gmail.com', 'hehe', 1, NULL, NULL),
(60, 'Thương', 'hhaajhaashjahsj', '09677384047', 'thuong@gmail.com', 's', 1, NULL, NULL),
(61, 'Thương', 'hhaajhaashjahsj', '09677384047', 'thuong@gmail.com', 'hahaha', 1, NULL, NULL),
(62, 'Thương', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384089', 'thuong@gmail.com', 'haha', 1, NULL, NULL),
(63, 'ThươngHoai', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong123@gmail.com', 'hahahaha', 1, NULL, NULL),
(64, 'ThươngHoai', 'hhaajhaashjahsj', '09677384047', 'thuong@gmail.com', 'hehe', 1, NULL, NULL),
(65, 'Thương', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 'hehehehe', 1, NULL, NULL),
(66, 'Thương', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 'nnjn', 1, NULL, NULL),
(67, 'ThươngThuan', 'Binh Chanh', '09677384876', 'thuong@gmail.com', 'hang nhe', 1, NULL, NULL),
(68, 'ThươngHoai', '200 Khuông Việt, Tân Phú, Phú Trung,HCM', '09677384047', 'thuong@gmail.com', 'giao nhanh', 1, NULL, NULL),
(69, 'ThươngHoai', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuonahsag@gmail.com', 'hhh', 1, NULL, NULL),
(70, 'Thương', 'hhaajhaashjahsj', '09677384047', 'thuong@gmail.com', 'jjj', 1, NULL, NULL),
(71, 'Thương', 'hhaajhaashjahsj', '09677384047', 'thuong@gmail.com', 'qa', 1, NULL, NULL),
(72, 'Thương', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 'hahaa', 1, NULL, NULL),
(73, 'ThươngHoai', '103 Khuông Việt, Tân Phú, Phú Trung,HCM', '09677384089', 'thuong@gmail.com', 'hàng dễ vỡ', 1, NULL, NULL),
(74, 'ThươngHoai', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384876', 'thuong@gmail.com', 'hhhhhhh', 1, NULL, NULL),
(75, 'Thương', 'hhaajhaashjahsj', '09677384047', 'thuonahsag@gmail.com', 'ffffff', 1, NULL, NULL),
(76, 'ThươngHoai', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 'xxxxxx', 1, NULL, NULL),
(77, 'ThươngHoai', '200 Khuông Việt, Tân Phú, Phú Trung,HCM', '09677384047', 'thuonahsag@gmail.com', 'aaaa', 1, NULL, NULL),
(78, 'Thương', '103 Khuông Việt, Tân Phú, Phú Trung,HCM', '09677384089', 'thuong@gmail.com', 'aaa', 1, NULL, NULL),
(79, 'Thương', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 'hàng dễ vỡ', 1, NULL, NULL),
(80, 'ThươngThuan', '200 Khuông Việt, Tân Phú, Phú Trung,HCM', '09677384047', 'thuong123@gmail.com', 'giao nhanh', 1, NULL, NULL),
(81, 'ThươngHoai', '200 Khuông Việt, Tân Phú, Phú Trung,HCM', '09677384047', 'thuong@gmail.com', 'haha', 1, NULL, NULL),
(82, 'ThươngHoai', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 'hàng dễ vỡ', 0, NULL, NULL),
(83, 'ThươngThuan', '500 Khuông Việt, Tân Phú, Phú Trung,HCM', '09677384047', 'thuong@gmail.com', 'không', 0, NULL, NULL),
(84, 'Thy', '200 Khuông Việt, Tân Phú, Phú Trung,HCM', '09677384047', 'thuong@gmail.com', 'không', 1, NULL, NULL),
(85, 'Thuận', '500 Khuông Việt, Tân Phú, Phú Trung,HCM', '09677384876', 'thuong@gmail.com', 'không', 0, NULL, NULL),
(86, 'Thương', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384089', 'thuong123@gmail.com', 'Không', 1, NULL, NULL),
(87, 'Thuận', '103 Khuông Việt, Tân Phú, Phú Trung,HCM', '09677384089', 'thuong123@gmail.com', 'không', 1, NULL, NULL),
(88, 'Thương', 'nhà ngõ', '09677384047', 'thuong@gmail.com', 'khong', 1, NULL, NULL),
(89, 'Thương', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 'không', 1, NULL, NULL),
(90, 'Thương', '200 Khuông Việt, Tân Phú, Phú Trung,HCM', '09677384047', 'thuong@gmail.com', 'a', 1, NULL, NULL),
(91, 'Thương', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 'g', 1, NULL, NULL),
(92, 'Thương', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 'gg', 1, NULL, NULL),
(93, 'Thương', 'hhaajhaashjahsj', '09677384047', 'thuong@gmail.com', 's', 1, NULL, NULL),
(94, 'Thương', 'hhaajhaashjahsj', '09677384047', 'thuong@gmail.com', 's', 1, NULL, NULL),
(95, 'Thương', 'hhaajhaashjahsj', '09677384047', 'thuong@gmail.com', 'g', 1, NULL, NULL),
(96, 'ThươngHoai', '200 Khuông Việt, Tân Phú, Phú Trung,HCM', '09677384047', 'thuong@gmail.com', 'k', 1, NULL, NULL),
(97, 'Thương', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384089', 'thuong@gmail.com', 'kk', 1, NULL, NULL),
(98, 'Thương', 'hhaajhaashjahsj', '09677384089', 'thuonahsag@gmail.com', 'g', 1, NULL, NULL),
(99, 'Thương', 'hhaajhaashjahsj', '09677384089', 'thuong@gmail.com', 't', 1, NULL, NULL),
(100, 'ThươngHoai', 'hhaajhaashjahsj', '09677384047', 'thuong@gmail.com', 'g', 1, NULL, NULL),
(101, 'Thương', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 'k', 1, NULL, NULL),
(102, 'Thương', 'hhaajhaashjahsj', '09677384047', 'thuong@gmail.com', 'k', 1, NULL, NULL),
(103, 'Thương', 'hhaajhaashjahsj', '09677384089', 'thuong@gmail.com', 'l', 1, NULL, NULL),
(104, 'Thy', '500 Khuông Việt, Tân Phú, Phú Trung,HCM', '09677384047', 'thuong@gmail.com', 'không', 1, NULL, NULL),
(105, 'Thương', 'nhà ngõ', '09677384047', 'thuong@gmail.com', 'không', 1, NULL, NULL),
(106, 'Thương', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384089', 'thuong@gmail.com', 'không', 1, NULL, NULL),
(107, 'Thương', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 'kkkk', 1, NULL, NULL),
(108, 'ThươngHoai', '200 Khuông Việt, Tân Phú, Phú Trung,HCM', '09677384047', 'thuong@gmail.com', 'không', 1, NULL, NULL),
(109, 'ThươngHoai', 'nhà ngõ', '09677384047', 'thuong@gmail.com', 'kh', 1, NULL, NULL),
(110, 'Thương', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 'hh', 1, NULL, NULL),
(111, 'ThươngHoai', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 'hh', 1, NULL, NULL),
(112, 'Thương', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 'k', 1, NULL, NULL),
(113, 'Thương', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 'a', 1, NULL, NULL),
(114, 'Thương', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 't', 0, NULL, NULL),
(115, 'Thương', '200 Khuông Việt, Tân Phú, Phú Trung,HCM', '09677384047', 'thuong123@gmail.com', 'th', 1, NULL, NULL),
(116, 'Thương', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuongHoai@gmail.com', 'ad', 1, NULL, NULL),
(117, 'Thương123', 'nhà ngõ', '09677384047', 'thuong@gmail.com', 'hehe', 1, NULL, NULL),
(118, 'hasaki', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 'kkkk', 1, NULL, NULL),
(119, 'ThươngThuan123', 'nhà ngõ', '09677384047', 'thuong@gmail.com', 'hihi', 1, NULL, NULL),
(120, 'Thương', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 'li', 1, NULL, NULL),
(121, 'Thương', 'nhà ngõ', '09677384047', 'thuong@gmail.com', 'ko', 1, NULL, NULL),
(122, 'Thương', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 'hihi', 1, NULL, NULL),
(123, 'Thương', 'hhaajhaashjahsj', '09677384047', 'thuong@gmail.com', 'heo', 1, NULL, NULL),
(124, 'Thương', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 'huhu', 1, NULL, NULL),
(125, 'Thương123', '200 Khuông Việt, Tân Phú, Phú Trung,HCM', '09677384089', 'thuong@gmail.com', 'không', 1, NULL, NULL),
(126, 'Thương', '500 Khuông Việt, Tân Phú, Phú Trung,HCM', '09677384047', 'thuong@gmail.com', 'z', 1, NULL, NULL),
(127, 'Thương', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 'f', 1, NULL, NULL),
(128, 'Thương', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 'hong', 1, NULL, NULL),
(129, 'Thương', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 'khong', 1, NULL, NULL),
(130, 'Thương', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 'khii', 1, NULL, NULL),
(131, 'Thương', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 'h', 1, NULL, NULL),
(132, 'Thương', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 'hh', 1, NULL, NULL),
(133, 'Thương', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuonahsag@gmail.com', 'khong', 1, NULL, NULL),
(134, 'Thương', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 'hong', 1, NULL, NULL),
(135, 'Thuan', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 'không', 1, NULL, NULL),
(136, 'Thương', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 'không', 1, NULL, NULL),
(137, 'Thương', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 'không', 1, NULL, NULL),
(138, 'Thương', '200 Khuông Việt, Tân Phú, Phú Trung,HCM', '09677384047', 'thuong@gmail.com', 'không', 1, NULL, NULL),
(139, 'Thương', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 'khong', 1, NULL, NULL),
(140, 'Thương', '103 Khuông Việt, Tân Phú, Phú Trung', '09677384047', 'thuong@gmail.com', 'khong', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_slider`
--

CREATE TABLE `tbl_slider` (
  `slider_id` int(11) NOT NULL,
  `slider_name` varchar(255) NOT NULL,
  `slider_status` int(11) NOT NULL,
  `slider_image` varchar(100) NOT NULL,
  `slider_desc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_slider`
--

INSERT INTO `tbl_slider` (`slider_id`, `slider_name`, `slider_status`, `slider_image`, `slider_desc`) VALUES
(6, 'SliderS', 1, 'slider16.jpg', 'Sắm Laptop ASUS'),
(10, 'siêu sale', 1, '46_0909_pcgm_tin_tuc46.jpg', 'sale'),
(11, 'sale tháng 5', 1, '148_0908_pcgm_asus_tang_bh_tintuc5.png', 'từ ngày 1-5-2021 đến 30-5-2021'),
(12, 'PMG', 1, 'PC-GAMING-5TR-152.jpg', 'PC Gaming 5tr');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_statistical`
--

CREATE TABLE `tbl_statistical` (
  `id_statistical` int(11) NOT NULL,
  `order_date` varchar(100) NOT NULL,
  `sales` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_statistical`
--

INSERT INTO `tbl_statistical` (`id_statistical`, `order_date`, `sales`, `quantity`, `total_order`) VALUES
(1, '2020-11-08', '0', 0, 0),
(2, '2020-11-07', '68000000', 60, 8),
(3, '2020-11-06', '0', 0, 0),
(4, '2020-11-05', '45000000', 30, 9),
(5, '2020-11-04', '30000000', 15, 12),
(6, '2020-11-03', '8000000', 65, 30),
(7, '2020-11-02', '28000000', 32, 20),
(8, '2020-11-01', '25000000', 7, 6),
(9, '2020-10-31', '36000000', 40, 15),
(10, '2020-10-30', '50000000', 89, 19),
(11, '2020-10-29', '20000000', 63, 11),
(12, '2020-10-28', '25000000', 94, 14),
(13, '2020-10-27', '32000000', 16, 10),
(14, '2020-10-26', '33000000', 14, 5),
(15, '2020-10-25', '36000000', 22, 12),
(16, '2020-10-24', '34000000', 33, 20),
(17, '2020-10-23', '25000000', 94, 14),
(18, '2020-10-22', '12000000', 16, 10),
(19, '2020-10-21', '63000000', 14, 5),
(20, '2020-10-20', '66000000', 22, 12),
(21, '2020-10-19', '74000000', 33, 20),
(22, '2020-10-18', '63000000', 14, 5),
(23, '2020-10-17', '66000000', 23, 12),
(24, '2020-10-16', '74000000', 32, 20),
(25, '2020-10-15', '63000000', 14, 5),
(26, '2020-10-14', '66000000', 3, 12),
(27, '2020-10-13', '74000000', 33, 20),
(28, '2020-10-12', '66000000', 23, 12),
(69, '2020-09-01', '74000000', 32, 20),
(70, '2021-04-14', '18200000', 4, 4),
(71, '2021-04-13', '0', 0, 0),
(72, '2020-08-11', '10000000', 2, 2),
(73, '2021-04-15', '500000', 1, 1),
(74, '2021-05-10', '31060000', 9, 4),
(75, '2021-05-14', '13500000', 9, 5),
(76, '2021-05-16', '11500000', 5, 5),
(77, '2021-05-18', '98360000', 4, 4),
(78, '2021-05-27', '146210000', 10, 10),
(79, '2021-06-04', '82160000', 4, 4),
(80, '2021-06-05', '81760000', 4, 3),
(81, '2021-05-30', '27080000', 2, 2),
(82, '2021-06-08', '64860000', 4, 2),
(83, '2021-05-28', '3190000', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Chỉ mục cho bảng `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Chỉ mục cho bảng `tbl_category_product`
--
ALTER TABLE `tbl_category_product`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `tbl_coupon`
--
ALTER TABLE `tbl_coupon`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Chỉ mục cho bảng `tbl_customers`
--
ALTER TABLE `tbl_customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `customer_email` (`customer_email`);

--
-- Chỉ mục cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Chỉ mục cho bảng `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  ADD PRIMARY KEY (`order_details_id`);

--
-- Chỉ mục cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Chỉ mục cho bảng `tbl_shipping`
--
ALTER TABLE `tbl_shipping`
  ADD PRIMARY KEY (`shipping_id`);

--
-- Chỉ mục cho bảng `tbl_slider`
--
ALTER TABLE `tbl_slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- Chỉ mục cho bảng `tbl_statistical`
--
ALTER TABLE `tbl_statistical`
  ADD PRIMARY KEY (`id_statistical`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brand_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `tbl_category_product`
--
ALTER TABLE `tbl_category_product`
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `tbl_coupon`
--
ALTER TABLE `tbl_coupon`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `tbl_customers`
--
ALTER TABLE `tbl_customers`
  MODIFY `customer_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT cho bảng `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  MODIFY `order_details_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT cho bảng `tbl_shipping`
--
ALTER TABLE `tbl_shipping`
  MODIFY `shipping_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT cho bảng `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `tbl_statistical`
--
ALTER TABLE `tbl_statistical`
  MODIFY `id_statistical` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
