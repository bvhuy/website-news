-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th3 24, 2022 lúc 05:49 PM
-- Phiên bản máy phục vụ: 5.7.36
-- Phiên bản PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `lucluongvutrangbrvt`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` text COLLATE utf8mb4_unicode_ci,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `_lft` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `_rgt` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories__lft__rgt_parent_id_index` (`_lft`,`_rgt`,`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `filename`, `thumbnail`, `meta_title`, `meta_description`, `meta_keyword`, `_lft`, `_rgt`, `parent_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(25, 'Cơ Quan Bộ CHQS Tỉnh', 'co-quan-bo-chqs-tinh', '61f0b606dfcf9-1643165190.jpg', 'http://127.0.0.1:8000/storage/thumbnail/danh-muc-bai-viet/61f0b606dfcf9-1643165190.jpg', 'Cơ Quan Bộ CHQS Tỉnh', 'Cơ Quan Bộ CHQS Tỉnh', 'Cơ Quan Bộ CHQS Tỉnh', 11, 26, NULL, 1, '2022-01-10 06:46:01', '2022-01-26 02:46:30', NULL),
(26, 'Bộ Chỉ Huy', 'bo-chi-huy', '61f0b61b1b42f-1643165211.jpg', 'http://127.0.0.1:8000/storage/thumbnail/danh-muc-bai-viet/61f0b61b1b42f-1643165211.jpg', 'Bộ Chỉ Huy', 'Bộ Chỉ Huy', 'Bộ Chỉ Huy', 12, 15, 25, 1, '2022-01-10 06:46:18', '2022-01-26 02:46:51', NULL),
(27, 'Phòng Tham Mưu', 'phong-tham-muu', '61f0b629cbc31-1643165225.jpg', 'http://127.0.0.1:8000/storage/thumbnail/danh-muc-bai-viet/61f0b629cbc31-1643165225.jpg', 'Phòng Tham Mưu', 'Phòng Tham Mưu', 'Phòng Tham Mưu', 16, 17, 25, 1, '2022-01-10 06:46:31', '2022-01-26 02:47:05', NULL),
(28, 'Phòng Chính Trị', 'phong-chinh-tri', '61f0b632be0e9-1643165234.jpg', 'http://127.0.0.1:8000/storage/thumbnail/danh-muc-bai-viet/61f0b632be0e9-1643165234.jpg', 'Phòng Chính Trị', 'Phòng Chính Trị', 'Phòng Chính Trị', 18, 19, 25, 1, '2022-01-10 06:46:43', '2022-01-26 02:47:14', NULL),
(29, 'Phòng Hậu Cần', 'phong-hau-can', '61f0b6389c19d-1643165240.jpg', 'http://127.0.0.1:8000/storage/thumbnail/danh-muc-bai-viet/61f0b6389c19d-1643165240.jpg', 'Phòng Hậu Cần', 'Phòng Hậu Cần', 'Phòng Hậu Cần', 20, 21, 25, 1, '2022-01-10 06:46:54', '2022-01-26 02:47:20', NULL),
(30, 'Phòng Kỹ Thuật', 'phong-ky-thuat', '61f0b6410ffb6-1643165249.jpg', 'http://127.0.0.1:8000/storage/thumbnail/danh-muc-bai-viet/61f0b6410ffb6-1643165249.jpg', 'Phòng Kỹ Thuật', 'Phòng Kỹ Thuật', 'Phòng Kỹ Thuật', 22, 23, 25, 1, '2022-01-10 06:47:06', '2022-01-26 02:47:29', NULL),
(31, 'Văn Phòng', 'van-phong', '61f0b6473b33e-1643165255.jpg', 'http://127.0.0.1:8000/storage/thumbnail/danh-muc-bai-viet/61f0b6473b33e-1643165255.jpg', 'Văn Phòng', 'Văn Phòng', 'Văn Phòng', 24, 25, 25, 1, '2022-01-10 06:47:16', '2022-01-26 02:47:35', NULL),
(32, 'Xuyên Mộc', 'xuyen-moc', '61f0b65250926-1643165266.jpg', 'http://127.0.0.1:8000/storage/thumbnail/danh-muc-bai-viet/61f0b65250926-1643165266.jpg', 'Xuyên Mộc', 'Xuyên Mộc', 'Xuyên Mộc', 27, 28, NULL, 1, '2022-01-10 06:47:27', '2022-01-26 02:47:46', NULL),
(33, 'TX.Phú Mỹ', 'txphu-my', '61f0b65ae5737-1643165274.jpg', 'http://127.0.0.1:8000/storage/thumbnail/danh-muc-bai-viet/61f0b65ae5737-1643165274.jpg', 'TX.Phú Mỹ', 'TX.Phú Mỹ', 'TX.Phú Mỹ', 29, 30, NULL, 1, '2022-01-10 06:47:39', '2022-01-26 02:47:54', NULL),
(34, 'TP.Bà Rịa', 'tpba-ria', '61f0b66043c3f-1643165280.jpg', 'http://127.0.0.1:8000/storage/thumbnail/danh-muc-bai-viet/61f0b66043c3f-1643165280.jpg', 'TP.Bà Rịa', 'TP.Bà Rịa', 'TP.Bà Rịa', 31, 32, NULL, 1, '2022-01-10 06:47:50', '2022-01-26 02:48:00', NULL),
(35, 'TP.Vũng Tàu', 'tpvung-tau', '61f0b66782a26-1643165287.jpeg', 'http://127.0.0.1:8000/storage/thumbnail/danh-muc-bai-viet/61f0b66782a26-1643165287.jpeg', 'TP.Vũng Tàu', 'TP.Vũng Tàu', 'TP.Vũng Tàu', 33, 34, NULL, 1, '2022-01-10 06:48:01', '2022-01-26 02:48:07', NULL),
(36, 'Long Điền', 'long-dien', '61f0b6729b454-1643165298.jpg', 'http://127.0.0.1:8000/storage/thumbnail/danh-muc-bai-viet/61f0b6729b454-1643165298.jpg', 'Long Điền', 'Long Điền', 'Long Điền', 35, 36, NULL, 1, '2022-01-10 06:48:12', '2022-01-26 02:48:18', NULL),
(37, 'Đất Đỏ', 'dat-do', '61f0b6805b21b-1643165312.jpg', 'http://127.0.0.1:8000/storage/thumbnail/danh-muc-bai-viet/61f0b6805b21b-1643165312.jpg', 'Đất Đỏ', 'Đất Đỏ', 'Đất Đỏ', 37, 38, NULL, 1, '2022-01-10 06:48:22', '2022-01-26 02:48:32', NULL),
(38, 'Châu Đức', 'chau-duc', '61f0b696a4821-1643165334.jpg', 'http://127.0.0.1:8000/storage/thumbnail/danh-muc-bai-viet/61f0b696a4821-1643165334.jpg', 'Châu Đức', 'Châu Đức', 'Châu Đức', 39, 40, NULL, 1, '2022-01-10 06:48:33', '2022-01-26 02:48:54', NULL),
(39, 'Côn đảo', 'con-dao', '61f0b69be8b91-1643165339.jpg', 'http://127.0.0.1:8000/storage/thumbnail/danh-muc-bai-viet/61f0b69be8b91-1643165339.jpg', 'Côn đảo', 'Côn đảo', 'Côn đảo', 41, 42, NULL, 1, '2022-01-10 06:48:44', '2022-01-26 02:48:59', NULL),
(40, 'Trung Đoàn Minh Đạm', 'trung-doan-minh-dam', '61f0b6a51ae78-1643165349.jpg', 'http://127.0.0.1:8000/storage/thumbnail/danh-muc-bai-viet/61f0b6a51ae78-1643165349.jpg', 'Trung Đoàn Minh Đạm', 'Trung Đoàn Minh Đạm', 'Trung Đoàn Minh Đạm', 43, 44, NULL, 1, '2022-01-10 06:48:55', '2022-01-26 02:49:09', NULL),
(41, 'Sự kiện lịch sử', 'su-kien-lich-su', '61f0b6ab5709c-1643165355.jpg', 'http://127.0.0.1:8000/storage/thumbnail/danh-muc-bai-viet/61f0b6ab5709c-1643165355.jpg', 'Sự kiện lịch sử', 'Sự kiện lịch sử', 'Sự kiện lịch sử', 45, 46, NULL, 1, '2022-01-10 06:49:08', '2022-01-26 02:49:15', NULL),
(42, 'Quân sự', 'quan-su', '61f0b6232b3ec-1643165219.jpg', 'http://127.0.0.1:8000/storage/thumbnail/danh-muc-bai-viet/61f0b6232b3ec-1643165219.jpg', 'Quân sự', 'Quân sự', 'Quân sự', 13, 14, 26, 1, '2022-01-10 10:49:45', '2022-01-26 02:46:59', NULL),
(43, 'Thời sự tổng hợp', 'thoi-su-tong-hop', '61f0b5e76623c-1643165159.jpg', 'http://127.0.0.1:8000/storage/thumbnail/danh-muc-bai-viet/61f0b5e76623c-1643165159.jpg', 'Thời sự tổng hợp', 'Thời sự tổng hợp', 'Thời sự tổng hợp', 1, 10, NULL, 1, '2022-01-11 03:29:33', '2022-01-26 02:45:59', NULL),
(44, 'Vượt Qua Covid-19', 'vuot-qua-covid-19', '61f0b5ef40e7f-1643165167.jpg', 'http://127.0.0.1:8000/storage/thumbnail/danh-muc-bai-viet/61f0b5ef40e7f-1643165167.jpg', 'Vượt Qua Covid-19', 'Vượt Qua Covid-19', 'Vượt Qua Covid-19', 2, 7, 43, 1, '2022-01-11 12:14:36', '2022-01-26 02:46:07', NULL),
(45, 'Chống Tin Giả', 'chong-tin-gia', '61f0b5fa6bcf0-1643165178.jpg', 'http://127.0.0.1:8000/storage/thumbnail/danh-muc-bai-viet/61f0b5fa6bcf0-1643165178.jpg', 'Chống Tin Giả', 'Chống Tin Giả', 'Chống Tin Giả', 8, 9, 43, 1, '2022-01-11 12:14:53', '2022-01-26 02:46:18', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category_videos`
--

DROP TABLE IF EXISTS `category_videos`;
CREATE TABLE IF NOT EXISTS `category_videos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` text COLLATE utf8mb4_unicode_ci,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `_lft` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `_rgt` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_videos__lft__rgt_parent_id_index` (`_lft`,`_rgt`,`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category_videos`
--

INSERT INTO `category_videos` (`id`, `name`, `slug`, `filename`, `thumbnail`, `meta_title`, `meta_description`, `meta_keyword`, `_lft`, `_rgt`, `parent_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Lời Bác dạy ngày này năm xưa', 'loi-bac-day-ngay-nay-nam-xu', '61f0b55fe439e-1643165023.jpg', 'http://127.0.0.1:8000/storage/thumbnail/danh-muc-video/61f0b55fe439e-1643165023.jpg', 'Lời Bác dạy ngày này năm xưa', 'Lời Bác dạy ngày này năm xưa', 'Lời Bác dạy ngày này năm xưa', 3, 8, NULL, 1, '2022-01-11 10:01:18', '2022-01-26 02:43:43', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `_lft` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `_rgt` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menus__lft__rgt_parent_id_index` (`_lft`,`_rgt`,`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `menus`
--

INSERT INTO `menus` (`id`, `name`, `slug`, `url`, `_lft`, `_rgt`, `parent_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'store', '', NULL, 3, 22, NULL, 1, NULL, '2022-01-10 06:38:46', '2022-01-10 06:38:46'),
(2, 'notebooks', '', NULL, 4, 9, 1, 1, NULL, '2022-01-10 06:38:46', '2022-01-10 06:38:46'),
(3, 'apple', '', NULL, 5, 6, 2, 1, NULL, '2022-01-10 06:38:46', '2022-01-10 06:38:46'),
(4, 'lenovo', '', NULL, 7, 8, 2, 1, NULL, '2022-01-10 06:38:46', '2022-01-10 06:38:46'),
(5, 'mobile', '', NULL, 10, 21, 1, 1, NULL, '2022-01-10 06:38:46', '2022-01-10 06:38:46'),
(6, 'nokia', '', NULL, 11, 12, 5, 1, NULL, '2022-01-10 06:38:46', '2022-01-10 06:38:46'),
(7, 'samsung', '', NULL, 13, 16, 5, 1, NULL, '2022-01-10 06:38:46', '2022-01-10 06:38:46'),
(8, 'galaxy', '', NULL, 14, 15, 7, 1, NULL, '2022-01-10 06:38:46', '2022-01-10 06:38:46'),
(9, 'sony', '', NULL, 17, 18, 5, 1, NULL, '2022-01-10 06:38:46', '2022-01-10 06:38:46'),
(10, 'lenovo', '', NULL, 19, 20, 5, 1, NULL, '2022-01-10 06:38:46', '2022-01-10 06:38:46'),
(11, 'store_2', '', NULL, 1, 2, NULL, 1, NULL, '2022-01-10 06:38:43', '2022-01-10 06:38:43'),
(12, 'Menu', '', NULL, 23, 24, NULL, 0, '2022-01-08 05:40:44', '2022-01-08 05:41:21', '2022-01-08 05:41:21'),
(13, 'Cơ Quan Bộ CHQS Tỉnh', 'co-quan-bo-chqs-tinh', NULL, 25, 40, NULL, 1, '2022-01-10 06:37:31', '2022-01-11 03:27:58', NULL),
(14, 'Xuyên Mộc', 'xuyen-moc', NULL, 41, 42, NULL, 1, '2022-01-10 06:37:39', '2022-01-11 03:28:00', NULL),
(15, 'TX.Phú Mỹ', 'txphu-my', NULL, 43, 44, NULL, 1, '2022-01-10 06:37:45', '2022-01-10 13:45:57', NULL),
(16, 'TP.Bà Rịa', 'tpba-ria', NULL, 45, 46, NULL, 1, '2022-01-10 06:37:52', '2022-01-10 13:45:53', NULL),
(17, 'TP.Vũng Tàu', 'tpvung-tau', NULL, 47, 48, NULL, 1, '2022-01-10 06:37:57', '2022-01-10 13:45:49', NULL),
(18, 'Long Điền', 'long-dien', NULL, 49, 50, NULL, 1, '2022-01-10 06:38:03', '2022-01-10 13:45:45', NULL),
(19, 'Đất Đỏ', 'dat-do', NULL, 51, 52, NULL, 1, '2022-01-10 06:38:09', '2022-01-10 13:45:41', NULL),
(20, 'Châu Đức', 'chau-duc', NULL, 53, 54, NULL, 1, '2022-01-10 06:38:15', '2022-01-10 13:45:37', NULL),
(21, 'Côn đảo', 'con-dao', NULL, 55, 56, NULL, 1, '2022-01-10 06:38:25', '2022-01-10 13:45:33', NULL),
(22, 'Trung Đoàn Minh Đạm', 'trung-doan-minh-dam', NULL, 57, 58, NULL, 1, '2022-01-10 06:38:32', '2022-01-10 13:45:30', NULL),
(23, 'Sự kiện lịch sử', 'su-kien-lich-su', NULL, 59, 60, NULL, 1, '2022-01-10 06:38:38', '2022-01-10 13:45:27', NULL),
(24, 'Bộ Chỉ Huy', 'bo-chi-huy', NULL, 26, 29, 13, 1, '2022-01-10 06:39:14', '2022-01-10 13:44:57', NULL),
(25, 'Phòng Tham Mưu', 'phong-tham-muu', NULL, 30, 31, 13, 1, '2022-01-10 06:39:21', '2022-01-10 13:44:59', NULL),
(26, 'Phòng Chính Trị', 'phong-chinh-tri', NULL, 32, 33, 13, 1, '2022-01-10 06:39:28', '2022-01-10 13:45:12', NULL),
(27, 'Phòng Hậu Cần', 'phong-hau-can', NULL, 34, 35, 13, 1, '2022-01-10 06:39:33', '2022-01-10 13:45:15', NULL),
(28, 'Phòng Kỹ Thuật', 'phong-ky-thuat', NULL, 36, 37, 13, 1, '2022-01-10 06:39:39', '2022-01-10 13:45:18', NULL),
(29, 'Văn Phòng', 'van-phong', NULL, 38, 39, 13, 1, '2022-01-10 06:39:46', '2022-01-10 13:45:21', NULL),
(30, 'Quân sự', 'quan-su', NULL, 27, 28, 24, 1, '2022-01-10 13:46:49', '2022-01-10 13:48:35', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_01_03_030349_create_menus_table', 1),
(7, '2022_01_03_120748_create_categories_table', 1),
(17, '2022_01_03_120723_create_news_table', 2),
(18, '2022_01_05_082900_create_news_to_categories_table', 2),
(19, '2022_01_06_133843_create_settings_table', 3),
(26, '2022_01_07_041624_create_roles_table', 4),
(27, '2022_01_07_041854_create_permissions_table', 4),
(29, '2022_01_07_051739_add_column_users_table', 5),
(30, '2022_01_07_125907_add_column_deleted_at_table', 6),
(32, '2022_01_09_193628_add_column_news_table', 7),
(33, '2022_01_10_203635_add_column_menus_table', 8),
(34, '2022_01_11_163025_create_category_videos_table', 9),
(35, '2022_01_11_163052_create_videos_table', 9),
(36, '2022_01_11_163123_create_video_to_categories_table', 9),
(37, '2022_01_13_134817_create_views_table', 10);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `view` int(11) NOT NULL DEFAULT '0',
  `event` tinyint(1) NOT NULL DEFAULT '0',
  `hot` tinyint(1) NOT NULL DEFAULT '0',
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `news_author_id_foreign` (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `news`
--

INSERT INTO `news` (`id`, `title`, `slug`, `filename`, `thumbnail`, `content`, `description`, `view`, `event`, `hot`, `author_id`, `meta_title`, `meta_description`, `meta_keyword`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(16, 'Bộ CHQS tỉnh Bà Rịa-Vũng Tàu tặng “Nhà đồng đội”', 'bo-chqs-tinh-ba-ria-vung-tau-tang-nha-dong-doi', '61f0b37138f14-1643164529.jpg', 'http://127.0.0.1:8000/storage/thumbnail/bai-viet/61f0b37138f14-1643164529.jpg', '<p style=\"text-align: center;\">Bộ CHQS tỉnh Bà Rịa-Vũng Tàu tặng “Nhà đồng đội”</p>', 'Ngày 7-1, Bộ CHQS tỉnh Bà Rịa-Vũng Tàu bàn giao “Nhà đồng đội” cho gia đình Trung úy Huỳnh Văn Ánh, Đại đội Thông tin, Phòng Tham mưu, Bộ CHQS tỉnh có hoàn cảnh khó khăn về nhà ở', 0, 0, 1, 1, 'Bộ CHQS tỉnh Bà Rịa-Vũng Tàu tặng “Nhà đồng đội”', 'Bộ CHQS tỉnh Bà Rịa-Vũng Tàu tặng “Nhà đồng đội”', 'Bộ CHQS tỉnh Bà Rịa-Vũng Tàu tặng “Nhà đồng đội”', 1, '2022-01-10 06:56:33', '2022-01-26 02:35:29', NULL),
(17, 'Tỉnh BR - VT: Phối hợp bảo đảm an ninh chính trị - trật tự an toàn xã hội', 'tinh-br-vt-phoi-hop-bao-dam-an-ninh-chinh-tri-trat-tu-an-toan-xa-hoi', '61f0b4b9aaad2-1643164857.jpg', 'http://127.0.0.1:8000/storage/thumbnail/bai-viet/61f0b4b9aaad2-1643164857.jpg', '<p style=\"text-align: center;\"><img src=\"../../../storage/61e257dc7ec8e-1642223580.jpg\" width=\"420\" height=\"300\" /><br /><span style=\"font-size: 8pt;\"><em>Đồng ch&iacute; Phạm Viết Thanh, Ủy vi&ecirc;n Trung ương Đảng, B&iacute; thư Tỉnh ủy ph&aacute;t biểu tại hội nghị.</em></span></p>\r\n<p style=\"text-align: left;\">Năm 2021, t&igrave;nh h&igrave;nh QP-AN tr&ecirc;n địa b&agrave;n tỉnh tiếp tục được giữ vững; c&ocirc;ng t&aacute;c phối hợp thực hiện nhiệm vụ bảo đảm QP-AN giữa c&aacute;c lực lượng qu&acirc;n sự, C&ocirc;ng an, Bộ đội Bi&ecirc;n ph&ograve;ng đạt nhiều kết quả thiết thực, g&oacute;p phần giữ vững an ninh ch&iacute;nh trị - trật tự an to&agrave;n x&atilde; hội; c&aacute;c lực lượng tham mưu cho Tỉnh ủy, UBND tỉnh l&atilde;nh, chỉ đạo c&ocirc;ng t&aacute;c ph&ograve;ng chống dịch Covid-19 v&agrave; ngăn ngừa, xử l&yacute; c&aacute;c loại tội phạm, kh&ocirc;ng để xảy ra vụ việc đột xuất, bất ngờ. Cụ thể, c&aacute;c lực lượng phối hợp tổ chức 186.688 lượt tổ tuần tra với sự tham gia của 520.652 lượt người, bắt v&agrave; xử l&yacute; 262 vụ với 367 đối tượng vi phạm ph&aacute;p luật.<br />&nbsp;<br />Chỉ đạo c&ocirc;ng t&aacute;c QP-AN trong thời gian tới, đồng ch&iacute; Phạm Viết Thanh đề nghị lực lượng qu&acirc;n sự, C&ocirc;ng an, Bộ đội Bi&ecirc;n ph&ograve;ng tỉnh tiếp tục phối hợp chặt chẽ với c&aacute;c đơn vị LLVT đứng ch&acirc;n tr&ecirc;n địa b&agrave;n tỉnh l&agrave;m tốt c&ocirc;ng t&aacute;c nắm bắt, dự b&aacute;o s&aacute;t, đ&uacute;ng t&igrave;nh h&igrave;nh tr&ecirc;n kh&ocirc;ng, tr&ecirc;n biển v&agrave; tr&ecirc;n địa b&agrave;n, kh&ocirc;ng để xảy ra bị động, bất ngờ; duy tr&igrave; nghi&ecirc;m chế độ trực sẵn s&agrave;ng chiến đấu bảo vệ c&aacute;c cao điểm, c&aacute;c dịp lễ lớn của tỉnh, của đất nước&hellip;</p>', 'Ngày 6-1, tại Bộ CHQS tỉnh, đồng chí Phạm Viết Thanh, Ủy viên Trung ương Đảng, Bí thư Tỉnh ủy, Chủ tịch HĐND tỉnh Bà Rịa-Vũng Tàu chủ trì Hội nghị giao ban công tác quốc phòng-an ninh (QP-AN) năm 2021 và triển khai nhiệm vụ năm 2022.', 0, 0, 1, 1, 'Tỉnh BR - VT: Phối hợp bảo đảm an ninh chính trị - trật tự an toàn xã hội', 'Tỉnh BR - VT: Phối hợp bảo đảm an ninh chính trị - trật tự an toàn xã hội', 'Tỉnh BR - VT: Phối hợp bảo đảm an ninh chính trị - trật tự an toàn xã hội', 1, '2022-01-10 07:12:30', '2022-01-26 02:40:57', NULL),
(18, 'Thăm, tặng quà thân nhân gia đình cụ Tô Đình Cắm', 'tham-tang-qua-than-nhan-gia-dinh-cu-to-dinh-cam', '61f0b4042401e-1643164676.jpg', 'http://127.0.0.1:8000/storage/thumbnail/bai-viet/61f0b4042401e-1643164676.jpg', '<p style=\"text-align: center;\"><img src=\"../../../storage/61e257896af41-1642223497.jpg\" width=\"449\" height=\"300\" /><br /><span style=\"font-size: 8pt;\"><em>Bộ CHQS tỉnh L&acirc;m Đồng thăm, tặng qu&agrave; cho gia đ&igrave;nh cụ T&ocirc; Đ&igrave;nh Cắm.</em></span></p>\r\n<p>Đại t&aacute; Trần Văn Khương, Ch&iacute;nh ủy Bộ CHQS tỉnh L&acirc;m Đồng &acirc;n cần thăm hỏi, động vi&ecirc;n th&acirc;n nh&acirc;n gia đ&igrave;nh cụ Cắm v&agrave; b&agrave;y tỏ mong muốn con ch&aacute;u gia đ&igrave;nh tiếp tục ph&aacute;t huy truyền thống tốt đẹp của gia đ&igrave;nh, ra sức đ&oacute;ng g&oacute;p x&acirc;y dựng qu&ecirc; hương ng&agrave;y c&agrave;ng gi&agrave;u đẹp.&nbsp;<br />&nbsp;<br />Cụ T&ocirc; Đ&igrave;nh Cắm, sinh ng&agrave;y 16/10/1922 - người d&acirc;n tộc T&agrave;y, l&agrave; một trong 34 chiến sĩ đầu ti&ecirc;n của Đội Việt Nam Tuy&ecirc;n truyền Giải ph&oacute;ng qu&acirc;n (tiền th&acirc;n của Qu&acirc;n đội Nh&acirc;n d&acirc;n Việt Nam). Năm 1992, cụ Cắm đưa vợ v&agrave; 7 người con từ Cao Bằng v&agrave;o huyện Đạ Tẻh sinh sống v&agrave; lập nghiệp.<br />&nbsp;<br />Đ&acirc;y l&agrave; hoạt động thể hiện đạo l&yacute; uống nước nhớ nguồn, thực hiện c&ocirc;ng t&aacute;c &ldquo;Đền ơn đ&aacute;p nghĩa&rdquo; của Bộ Tư lệnh Qu&acirc;n khu 7 d&agrave;nh cho gia đ&igrave;nh ch&iacute;nh s&aacute;ch, gia đ&igrave;nh c&oacute; c&ocirc;ng với c&aacute;ch mạng tại địa phương.</p>', 'Ngày 10-1, thừa ủy quyền của Bộ Tư lệnh Quân khu 7, Đại tá Trần Văn Khương, Chính ủy Bộ CHQS tỉnh Lâm Đồng đến thăm và tặng quà, chúc tết Nhâm Dần năm 2022 gia đình cụ Tô Đình Cắm (huyện Đạ Tẻh).', 0, 1, 1, 1, 'Thăm, tặng quà thân nhân gia đình cụ Tô Đình Cắm', 'Thăm, tặng quà thân nhân gia đình cụ Tô Đình Cắm', 'Thăm, tặng quà thân nhân gia đình cụ Tô Đình Cắm', 1, '2022-01-11 03:39:24', '2022-01-26 02:37:56', NULL),
(19, 'Trung tướng Trần Hoài Trung, Chính ủy Quân khu 7 đến thăm, chúc Tết Tỉnh ủy, UBND tỉnh Lâm Đồng', 'trung-tuong-tran-hoai-trung-chinh-uy-quan-khu-7-den-tham-chuc-tet-tinh-uy-ubnd-tinh-lam-dong', '61f0b38f00fc2-1643164559.jpeg', 'http://127.0.0.1:8000/storage/thumbnail/bai-viet/61f0b38f00fc2-1643164559.jpeg', '<p>Trung tướng Trần Hoài Trung, Chính ủy Quân khu 7 đến thăm, chúc Tết Tỉnh ủy, UBND tỉnh Lâm Đồng</p>', 'Sáng 10/1, Trung tướng Trần Hoài Trung, Chính ủy Quân khu 7 và thủ trưởng các cơ quan Quân khu đến thăm, chúc Tết lãnh đạo Tỉnh ủy, UBND tỉnh Lâm Đồng nhân dịp Xuân Nhâm Dần năm 2022', 0, 1, 1, 1, 'Trung tướng Trần Hoài Trung, Chính ủy Quân khu 7 đến thăm, chúc Tết Tỉnh ủy, UBND tỉnh Lâm Đồng', 'Trung tướng Trần Hoài Trung, Chính ủy Quân khu 7 đến thăm, chúc Tết Tỉnh ủy, UBND tỉnh Lâm Đồng', 'Trung tướng Trần Hoài Trung, Chính ủy Quân khu 7 đến thăm, chúc Tết Tỉnh ủy, UBND tỉnh Lâm Đồng', 1, '2022-01-11 04:08:21', '2022-01-26 02:35:59', NULL),
(20, 'Quân khu 7 đạt 9 Huy chương vàng tại Liên hoan truyền hình toàn quân lần thứ XIII', 'quan-khu-7-dat-9-huy-chuong-vang-tai-lien-hoan-truyen-hinh-toan-quan-lan-thu-xiii', '61f0b35336cce-1643164499.jpg', 'http://127.0.0.1:8000/storage/thumbnail/bai-viet/61f0b35336cce-1643164499.jpg', '<p style=\"text-align: center;\"><em>Quân khu 7 đạt 9 Huy chương vàng tại Liên hoan truyền hình toàn quân lần thứ XIII</em></p>', 'Chiều ngày 10/01/2022, tại điểm cầu Thủ đô Hà Nội và các điểm cầu trực tuyến trong toàn quân, Tổng cục Chính trị tổ chức lễ tổng kết, công bố và trao giải thưởng Liên hoan truyền hình toàn quân lần thứ XIII, năm 2021. Trung tướng Trịnh Văn Quyết, UVTW Đảng, Phó Chủ nhiệm Tổng cục Chính trị, Trưởng ban chỉ đạo Liên hoan chủ trì buổi lễ.', 0, 1, 1, 1, 'Quân khu 7 đạt 9 Huy chương vàng tại Liên hoan truyền hình toàn quân lần thứ XIII', 'Quân khu 7 đạt 9 Huy chương vàng tại Liên hoan truyền hình toàn quân lần thứ XIII', 'Quân khu 7 đạt 9 Huy chương vàng tại Liên hoan truyền hình toàn quân lần thứ XIII', 1, '2022-01-11 04:13:12', '2022-01-26 02:34:59', NULL),
(21, 'Tư lệnh Quân khu chúc tết Công ty Công ty Tây Nam và Công ty Đông Hải', 'tu-lenh-quan-khu-chuc-tet-cong-ty-cong-ty-tay-nam-va-cong-ty-dong-hai', '61f0b3b787330-1643164599.jpg', 'http://127.0.0.1:8000/storage/thumbnail/bai-viet/61f0b3b787330-1643164599.jpg', '<p style=\"text-align: center;\"><img src=\"../../../storage/61e2576f426ab-1642223471.jpg\" width=\"441\" height=\"300\" /><br /><span style=\"font-size: 8pt;\"><em>Đồng ch&iacute; Tư lệnh Qu&acirc;n khu tặng qu&agrave; tết cho C&ocirc;ng ty T&acirc;y Nam</em></span></p>', 'Sáng ngày 10 tháng 1, Đoàn cán bộ Quân khu 7 do Thiếu tướng Nguyễn Trường Thắng, Ủy viên Trung ương Đảng, Tư lệnh Quân khu 7 làm trưởng đoàn đã tới thăm, chúc Tết Công ty Tây Nam và Công ty Đông Hải (Quân khu 7).', 0, 1, 1, 1, 'Tư lệnh Quân khu chúc tết Công ty Công ty Tây Nam và Công ty Đông Hải', 'Tư lệnh Quân khu chúc tết Công ty Công ty Tây Nam và Công ty Đông Hải', 'Tư lệnh Quân khu chúc tết Công ty Công ty Tây Nam và Công ty Đông Hải', 1, '2022-01-11 05:34:39', '2022-01-26 02:36:58', NULL),
(22, 'Tỉnh Bình Thuận: Nhiều giải pháp tăng cường chất lượng tuyển quân năm 2022', 'tinh-binh-thuan-nhieu-giai-phap-tang-cuong-chat-luong-tuyen-quan-nam-2022', '61f0b435a8d9b-1643164725.jpg', 'http://127.0.0.1:8000/storage/thumbnail/bai-viet/61f0b435a8d9b-1643164725.jpg', '<p style=\"text-align: center;\"><img src=\"../../../storage/61e2579c1df20-1642223516.jpg\" width=\"450\" height=\"300\" /><br /><span style=\"font-size: 8pt;\"><em>Chủ tịch UBND tỉnh L&ecirc; Tuấn Phong tặng hoa c&aacute;c t&acirc;n binh l&ecirc;n đường nhập ngũ.</em></span></p>', 'Công tác tuyển chọn, gọi công dân nhập ngũ năm 2022 đang bước vào giai đoạn nước rút. Đây cũng là thời điểm các thế lực thù địch, phản động tăng cường sử dụng mạng xã hội, internet lan truyền những bài viết phản động, bày cách trốn tránh thực hiện quyền nghĩa vụ quân sự. Thực trạng này đã ảnh hưởng không nhỏ đến công tác tuyển quân.', 0, 1, 1, 1, 'Tỉnh Bình Thuận: Nhiều giải pháp tăng cường chất lượng tuyển quân năm 2022', 'Tỉnh Bình Thuận: Nhiều giải pháp tăng cường chất lượng tuyển quân năm 2022', 'Tỉnh Bình Thuận: Nhiều giải pháp tăng cường chất lượng tuyển quân năm 2022', 1, '2022-01-11 05:37:25', '2022-01-26 02:38:45', NULL),
(23, 'Bộ đội Biên phòng Tây Ninh bảo vệ bình yên vùng biên giới', 'bo-doi-bien-phong-tay-ninh-bao-ve-binh-yen-vung-bien-gioi', '61f0b4662b640-1643164774.jpg', 'http://127.0.0.1:8000/storage/thumbnail/bai-viet/61f0b4662b640-1643164774.jpg', '<p style=\"text-align: center;\"><img src=\"../../../storage/bien_phong_2.jpg\" width=\"399\" height=\"300\" /><br /><span style=\"font-size: 8pt;\"><em>Tuần tra bảo vệ bi&ecirc;n giới</em><em>.</em></span></p>', 'Từ tháng 10-2021 đến nay là thời gian cao điểm của các hoạt động xuất nhập cảnh, vận chuyển hàng hoá trái phép qua biên giới. Vì vậy, lực lượng Bộ đội Biên phòng Tây Ninh tăng cường phòng chống xuất nhập cảnh trái phép, ngăn chặn buôn lậu và phòng, chống dịch Covid- 19.', 0, 1, 1, 1, 'Bộ đội Biên phòng Tây Ninh bảo vệ bình yên vùng biên giới', 'Bộ đội Biên phòng Tây Ninh bảo vệ bình yên vùng biên giới', 'Bộ đội Biên phòng Tây Ninh bảo vệ bình yên vùng biên giới', 1, '2022-01-11 05:54:08', '2022-01-26 02:39:34', NULL),
(24, 'Tập đoàn Công nghiệp Cao su Việt Nam nhận Cờ thi đua xuất sắc năm 2021', 'tap-doan-cong-nghiep-cao-su-viet-nam-nhan-co-thi-dua-xuat-sac-nam-2021', '61f0b4e178330-1643164897.jpg', 'http://127.0.0.1:8000/storage/thumbnail/bai-viet/61f0b4e178330-1643164897.jpg', '<p style=\"text-align: left;\">Chiều 11/1, Tập đoàn Công nghiệp Cao su Việt Nam (VRG) tổ chức Hội nghị Tổng kết công tác sản xuất kinh doanh năm 2021; phương hướng nhiệm vụ năm 2022.</p>', 'Chiều 11/1, Tập đoàn Công nghiệp Cao su Việt Nam (VRG) tổ chức Hội nghị Tổng kết công tác sản xuất kinh doanh năm 2021; phương hướng nhiệm vụ năm 2022.', 0, 1, 1, 1, 'Tập đoàn Công nghiệp Cao su Việt Nam nhận Cờ thi đua xuất sắc năm 2021', 'Tập đoàn Công nghiệp Cao su Việt Nam nhận Cờ thi đua xuất sắc năm 2021', 'Tập đoàn Công nghiệp Cao su Việt Nam nhận Cờ thi đua xuất sắc năm 2021', 1, '2022-01-11 07:28:46', '2022-01-26 02:41:37', NULL),
(25, 'Chuẩn bị cho những ngày vui tết', 'chuan-bi-cho-nhung-ngay-vui-tet', '61f0b4929a5a0-1643164818.jpg', 'http://127.0.0.1:8000/storage/thumbnail/bai-viet/61f0b4929a5a0-1643164818.jpg', '<p style=\"text-align: center;\"><img src=\"../../../storage/17.jpg\" width=\"490\" height=\"300\" /><br /><span style=\"font-size: 8pt;\"><em>Chiến sĩ Bộ Tham mưu, Qu&acirc;n đo&agrave;n 4 l&agrave;m đẹp khu&ocirc;n vi&ecirc;n đơn vị chuẩn bị đ&oacute;n xu&acirc;n.</em></span></p>', 'Trước thềm xuân mới Nhân Dần, cùng với các hoạt động học tập, huấn luyện thường xuyên, cán bộ, chiến sĩ các cơ quan, đơn vị Quân đoàn 4 tranh thủ giờ nghỉ, ngày nghỉ chăm sóc vườn hoa, cây cảnh, khuôn viên doanh trại, tăng cường tăng gia sản xuất, để chuẩn bị đón tết vui tươi, lành mạnh, đầm ấm trong điều kiện bình thường mới, thích ứng linh hoạt.', 0, 1, 1, 1, 'Chuẩn bị cho những ngày vui tết', 'Chuẩn bị cho những ngày vui tết', 'Chuẩn bị cho những ngày vui tết', 1, '2022-01-11 07:40:50', '2022-01-26 02:40:18', NULL),
(26, 'Bộ đội Biên phòng Long An đón xuân mới, không quên nhiệm vụ', 'bo-doi-bien-phong-long-an-don-xuan-moi-khong-quen-nhiem-vu', '61f0b4f7d73ea-1643164919.jpg', 'http://127.0.0.1:8000/storage/thumbnail/bai-viet/61f0b4f7d73ea-1643164919.jpg', '<p>Còn chưa đầy 3 tuần nữa là đến Tết Nguyên đán Nhâm Dần năm 2022. Để chuẩn bị đón tết, ngoài bánh, mứt, thực phẩm thì không thể thiếu hoa tết. Với đôi tay khéo léo, tỉ mỉ, những chiến sĩ biên phòng trổ tài trồng hoa tết, tạo nên bức tranh ngày tết thật sống động và rực rỡ.</p>', 'Còn chưa đầy 3 tuần nữa là đến Tết Nguyên đán Nhâm Dần năm 2022. Để chuẩn bị đón tết, ngoài bánh, mứt, thực phẩm thì không thể thiếu hoa tết. Với đôi tay khéo léo, tỉ mỉ, những chiến sĩ biên phòng trổ tài trồng hoa tết, tạo nên bức tranh ngày tết thật sống động và rực rỡ.', 0, 1, 1, 1, 'Bộ đội Biên phòng Long An đón xuân mới, không quên nhiệm vụ', 'Bộ đội Biên phòng Long An đón xuân mới, không quên nhiệm vụ', 'Bộ đội Biên phòng Long An đón xuân mới, không quên nhiệm vụ', 1, '2022-01-11 14:19:09', '2022-01-26 02:41:59', NULL),
(27, 'Lưu luyến thời khắc quân ngũ', 'luu-luyen-thoi-khac-quan-ngu', '61f0b50eed905-1643164942.jpg', 'http://127.0.0.1:8000/storage/thumbnail/bai-viet/61f0b50eed905-1643164942.jpg', '<p>Chỉ còn ít ngày nữa, các chiến sĩ nhập ngũ năm 2020 của Tiểu đoàn 1, Trung đoàn 738, Bộ CHQS tỉnh Long An hoàn thành nghĩa vụ quân sự trở về địa phương.</p>', 'Chỉ còn ít ngày nữa, các chiến sĩ nhập ngũ năm 2020 của Tiểu đoàn 1, Trung đoàn 738, Bộ CHQS tỉnh Long An hoàn thành nghĩa vụ quân sự trở về địa phương.', 0, 1, 1, 1, 'Lưu luyến thời khắc quân ngũ', 'Lưu luyến thời khắc quân ngũ', 'Lưu luyến thời khắc quân ngũ', 1, '2022-01-11 14:38:03', '2022-01-26 02:42:22', NULL),
(28, 'LLVT tỉnh BR – VT bảo đảm tốt công tác hậu cần - kỹ thuật', 'llvt-tinh-br-vt-bao-dam-tot-cong-tac-hau-can-ky-thuat', '61f0b2afc69f3-1643164335.jpg', 'http://127.0.0.1:8000/storage/thumbnail/bai-viet/61f0b2afc69f3-1643164335.jpg', '<p style=\"text-align: center;\"><img src=\"../../../storage/kiem-tra-phao-truoc-khi-thuc-hanh-ban-3.jpg\" alt=\"Kiểm tra ph&aacute;o trước khi thực h&agrave;nh bắn.\" width=\"500\" height=\"237\" /><br /><span style=\"font-size: 8pt;\"><em>Kiểm tra ph&aacute;o trước khi thực h&agrave;nh bắn.</em></span></p>\r\n<p style=\"text-align: left;\"><strong>Quản l&yacute; tốt vũ kh&iacute;, trang bị kỹ thuật</strong><br />Thăm Đại đội Kho K694 (Ph&ograve;ng Kỹ thuật - Bộ CHQS tỉnh), h&igrave;nh ảnh c&aacute;n bộ, nh&acirc;n vi&ecirc;n đang kiểm tra tỉ mỉ, lau ch&ugrave;i từng bộ phận chuyển động của s&uacute;ng, kim hỏa, l&ograve; xo, thước ngắm, c&ograve; v&agrave; băng đạn của c&aacute;c khẩu s&uacute;ng tiểu li&ecirc;n AK một c&aacute;ch nhẹ nh&agrave;ng, thận trọng, tho&aacute;ng ch&uacute;t căng thẳng khiến ch&uacute;ng t&ocirc;i c&agrave;ng thấu hiểu sự y&ecirc;u ng&agrave;nh của c&aacute;c anh.<br />&nbsp;<br />Đại đội kho K694 c&oacute; nhiệm vụ quản l&yacute; số lượng, chất lượng, chủng loại, t&iacute;nh năng, đồng bộ vũ kh&iacute;, trang bị kỹ thuật (VKTBKT) cho c&aacute;c đợt huấn luyện của LLVT tỉnh. X&aacute;c định con người l&agrave; yếu tố quyết định trong c&ocirc;ng t&aacute;c bảo đảm VKTBKT, đơn vị lu&ocirc;n ch&uacute; trọng n&acirc;ng cao nhận thức cho c&aacute;n bộ, chiến sĩ về nhiệm vụ quản l&yacute;, bảo quản, bảo dưỡng VKTBKT theo quy định; tổ chức tiếp nhận, cấp ph&aacute;t kịp thời đ&uacute;ng, đủ số lượng VKTBKT theo mệnh lệnh cấp tr&ecirc;n; duy tr&igrave; nghi&ecirc;m chế độ tuần tra, canh g&aacute;c, bảo vệ tuyệt đối an to&agrave;n kho. &ldquo;Nhờ đ&oacute;, 100% c&aacute;n bộ, nh&acirc;n vi&ecirc;n lu&ocirc;n nỗ lực, đo&agrave;n kết vượt qua kh&oacute; khăn, 100% đạn dược trong kho đều được sắp xếp theo nh&oacute;m an to&agrave;n theo từng chủng loại v&agrave; k&ecirc; k&iacute;ch đ&uacute;ng quy định&rdquo;, Đại &uacute;y Nguyễn Quang L&acirc;m, thủ kho qu&acirc;n khí Đại đội kho K694 n&oacute;i.<br />&nbsp;<br />Tương tự, tại Đại đội ph&aacute;o ph&ograve;ng kh&ocirc;ng 37 (Ban CHQS TP.Vũng T&agrave;u), nơi c&oacute; độ cao hơn 130m so với mực nước biển, để giữ tốt, d&ugrave;ng bền c&aacute;c loại VKTBKT trong m&ocirc;i trường, thời tiết kh&iacute; hậu khắc nghiệt, sau mỗi giờ huấn luyện, c&aacute;n bộ, chiến sĩ đều kiểm tra t&igrave;nh trạng kỹ thuật v&agrave; đồng bộ của vũ kh&iacute;, kh&iacute; t&agrave;i. Định kỳ ng&agrave;y thứ 6 h&agrave;ng tuần, 100% xe ph&aacute;o, đạn được kiểm tra, lau ch&ugrave;i, b&ocirc;i mỡ b&ograve;, tra dầu, điều chỉnh tham số kỹ thuật. Ngo&agrave;i ra, đơn vị thiết kế, gia c&ocirc;ng ho&agrave;n chỉnh nh&agrave; che di động để phủ k&iacute;n xe ph&aacute;o v&agrave;o ban đ&ecirc;m nhằm hạn chế gi&oacute; biển mang muối v&agrave;o l&agrave;m hỏng xe ph&aacute;o, đồng thời thường xuy&ecirc;n ph&aacute;t quang chống ch&aacute;y, ph&ograve;ng, chống mối, mọt xung quanh trận địa ph&aacute;o. Nhờ vậy m&agrave; 100% xe ph&aacute;o, đạn của đơn vị bảo đảm tốt hệ số kỹ thuật, g&oacute;p phần bảo đảm an to&agrave;n tuyệt đối trong huấn luyện.<br />&nbsp;<br />Thực hiện lời dạy của B&aacute;c Hồ: &ldquo;Vũ kh&iacute; l&agrave; mồ h&ocirc;i của đồng b&agrave;o, l&agrave; xương m&aacute;u của bộ đội; v&igrave; vậy phải qu&yacute; trọng n&oacute;, phải tiết kiệm, ngăn nắp, phải sử dụng hợp l&yacute;&rdquo;, thời gian qua, 100% đơn vị LLVT thực hiện nghi&ecirc;m chế độ bảo quản, bảo dưỡng c&aacute;c trang thiết bị; ch&uacute; trọng bồi dưỡng n&acirc;ng cao tr&igrave;nh độ chuy&ecirc;n m&ocirc;n nghiệp vụ cho đội ngũ c&aacute;n bộ, nh&acirc;n vi&ecirc;n kỹ thuật, g&oacute;p phần bảo đảm đ&uacute;ng, đủ, kịp thời VKTBKT cho nhiệm vụ thường xuy&ecirc;n, đột xuất.<br />&nbsp;<br />Ng&agrave;nh Kỹ thuật Bộ CHQS tỉnh cũng thường xuy&ecirc;n cử c&aacute;n bộ xuống c&aacute;c đơn vị theo d&otilde;i, kiểm tra việc duy tr&igrave; giờ kỹ thuật, ng&agrave;y kỹ thuật, chế độ sấy, thử m&aacute;y, t&igrave;nh trạng kỹ thuật xe trực sẵn s&agrave;ng chiến đấu; quy định về vệ sinh an to&agrave;n lao động, vệ sinh c&ocirc;ng nghiệp, bảo dưỡng VKTBKT...</p>\r\n<p style=\"text-align: center;\"><img src=\"../../../storage/thuc-hanh-ban-kiem-tra-phao-85mm.jpg\" alt=\"\" width=\"477\" height=\"300\" /><br /><span style=\"font-size: 8pt;\"><em>Bắn ph&aacute;o kiểm tra sau sửa chữa, bảo dưỡng.</em></span>&nbsp;</p>\r\n<p style=\"text-align: left;\">Bằng những biện ph&aacute;p đồng bộ, hiệu quả trong c&ocirc;ng t&aacute;c hậu cần - kỹ thuật, đến nay LLVT tỉnh đ&atilde; bảo đảm 100% định lượng rau, củ, quả, 86% định lượng thịt, 36% định lượng c&aacute;, đưa v&agrave;o ăn th&ecirc;m thường xuy&ecirc;n 8 ng&agrave;n đồng/người/ng&agrave;y; 100% vũ kh&iacute; bộ binh được sắp xếp trong tủ s&uacute;ng, tr&ecirc;n gi&aacute; s&uacute;ng, tổ chức ni&ecirc;m phong v&agrave; kh&oacute;a tủ s&uacute;ng, kh&oacute;a v&ograve;ng c&ograve; theo quy định; 100% xe, ph&aacute;o được bảo quản trong nh&agrave; xe, tr&aacute;nh được mưa nắng, số km xe hoạt động an to&agrave;n vượt chỉ ti&ecirc;u. Đối với đạn dược trong Kho K694 v&agrave; Kho K899 tại C&ocirc;n Đảo đều được quy hoạch, sắp xếp theo nh&oacute;m an to&agrave;n theo từng chủng loại v&agrave; được k&ecirc; k&iacute;ch theo đ&uacute;ng quy định.<br /><br /><strong>Chăm lo vật chất, tinh thần cho bộ đội</strong><br />Trước đ&acirc;y, khu vườn tăng gia của Trung đo&agrave;n Minh Đạm được trồng v&agrave; chăm s&oacute;c theo phương ph&aacute;p truyền thống n&ecirc;n rau kh&ocirc;ng phong ph&uacute; v&agrave; thường xuy&ecirc;n bị s&acirc;u bệnh. V&agrave;o dịp lễ, Tết hoặc cao điểm m&ugrave;a huấn luyện, đơn vị phải tr&iacute;ch tiền mua rau với gi&aacute; cao, lại kh&ocirc;ng y&ecirc;n t&acirc;m về chất lượng. Đầu năm 2019, Trung đo&agrave;n Minh Đạm chuyển hướng trồng rau ho&agrave;n to&agrave;n theo phương ph&aacute;p mới với 4 nh&agrave; m&agrave;ng c&oacute; diện t&iacute;ch hơn 17.000m2 được đầu tư hệ thống vườn trồng hiện đại, luống phủ nilon, hệ thống quạt gi&oacute;, tưới ti&ecirc;u tự động&hellip; Đồng thời, đa dạng h&oacute;a nhiều loại c&acirc;y trồng, rau, củ, quả. Hiện nay, đơn vị kh&ocirc;ng những tự t&uacute;c 100% nguồn rau xanh, sạch m&agrave; c&ograve;n cung cấp h&agrave;ng tấn rau ra thị trường, tăng nguồn thu cho đơn vị, qu&acirc;n số khỏe lu&ocirc;n đạt tr&ecirc;n 99,2%.</p>\r\n<p style=\"text-align: center;\"><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"../../../storage/nu-quan-nhan-tinh-br-vt-phuc-vu-phien-cho-0-dong-trong-dai-dich-2.jpg\" alt=\"Tặng sản phẩm tăng gia cho người d&acirc;n chống dịch Covid - 19.\" width=\"402\" height=\"300\" /><span style=\"font-size: 8pt;\"><em>Tặng sản phẩm tăng gia cho người d&acirc;n chống dịch Covid - 19.</em></span></p>\r\n<p style=\"text-align: left;\">Cũng như Trung đo&agrave;n Minh Đạm, trước những diễn biến kh&oacute; lường về thi&ecirc;n tai, dịch bệnh, sự biến động của gi&aacute; cả thị trường, LLVT tỉnh chủ động đề ra nhiều giải ph&aacute;p đẩy mạnh TGSX gắn với x&acirc;y dựng doanh trại ch&iacute;nh quy xanh - sạch - đẹp một c&aacute;ch s&acirc;u rộng, hiệu quả. Từ năm 2015 đến nay, c&aacute;c đơn vị, địa phương LLVT tỉnh&nbsp; đầu tư đồng bộ cơ sở vật chất phục vụ TGSX (hệ thống nh&agrave; lưới, nh&agrave; m&agrave;ng, gi&agrave;n leo, chuồng trại v&agrave; c&aacute;c loại dụng cụ k&egrave;m theo) với tổng kinh ph&iacute; 24 tỷ đồng;&nbsp; chủ động phối hợp tham mưu cấp ủy, ch&iacute;nh quyền đầu tư x&acirc;y dựng, n&acirc;ng cấp doanh trại, cảnh quan m&ocirc;i trường với tổng kinh ph&iacute; 735 tỷ đồng, ch&uacute; trọng ph&ograve;ng, chống dịch, chăm s&oacute;c sức khỏe cho bộ đội với phương ch&acirc;m &ldquo;Ăn ngon, mặc đẹp, ngủ ấm, uống sạch&rdquo;.<br />&nbsp;<br />Điển h&igrave;nh, Đại đội Ph&aacute;o binh 9 - Ban CHQS huyện C&ocirc;n Đảo, từ nguồn quỹ thu được từ sản phẩm tăng gia, chăn nu&ocirc;i, đơn vị đ&atilde; triển khai x&acirc;y dựng hệ thống biển, bảng, củng cố cảnh quan m&ocirc;i trường, khu&ocirc;n vi&ecirc;n văn h&oacute;a, tạo động lực gi&uacute;p người chiến sĩ ho&agrave;n th&agrave;nh nhiệm vụ.<br />&nbsp;<br />&ldquo;Thời gian tới, Bộ CHQS tỉnh chỉ đạo c&aacute;c đơn vị ch&uacute; trọng bảo quản, bảo dưỡng, sửa chữa VKTBKT theo ph&acirc;n cấp; huấn luyện c&ocirc;ng t&aacute;c kỹ thuật qu&acirc;n kh&iacute; cho c&aacute;c đối tượng; tiếp nhận, cấp ph&aacute;t VKTBKT đồng bộ, bảo đảm cho c&ocirc;ng t&aacute;c huấn luyện; cải tiến, n&acirc;ng cấp phương tiện vận tải phục vụ cho nhiệm vụ vận tải v&agrave; hoạt động thường xuy&ecirc;n của LLVT tỉnh, bảo quản, bảo dưỡng, sửa chữa 100% vũ kh&iacute; trang thiết bị; phối hợp với c&aacute;c đơn vị địa phương tiếp tục thu gom bom, m&igrave;n, đạn dược, vật liệu nổ c&ograve;n s&oacute;t lại sau chiến tranh theo Nghị định 79 của Ch&iacute;nh phủ. Đồng thời tiếp tục l&agrave;m tốt c&ocirc;ng t&aacute;c chăm lo vật chất, tinh thần cho bộ đội&rdquo;, Đại t&aacute; Trần Thanh Sơn, Ph&oacute; Chỉ huy trưởng Bộ CHQS tỉnh nhấn mạnh.</p>', 'Cùng với việc thực hiện tốt chức năng huấn luyện, sẵn sàng chiến đấu, thời gian qua, LLVT tỉnh BR – VT không ngừng đẩy mạnh tăng gia sản xuất (TGSX) nhằm chăm lo tốt đời sống vật chất, tinh thần bộ đội, đồng thời bảo đảm đầy đủ trang thiết bị, vũ khí cho các hoạt động quân sự - quốc phòng.', 0, 0, 1, 1, 'LLVT tỉnh BR – VT bảo đảm tốt công tác hậu cần - kỹ thuật', 'LLVT tỉnh BR – VT bảo đảm tốt công tác hậu cần - kỹ thuật', 'LLVT tỉnh BR – VT bảo đảm tốt công tác hậu cần - kỹ thuật', 1, '2022-01-15 10:02:06', '2022-01-26 02:33:57', NULL),
(29, 'a', 'a', '61f0b02c98da4-1643163692.jpg', 'http://127.0.0.1:8000/storage/thumbnail/bai-viet/61f0b02c98da4-1643163692.jpg', NULL, NULL, 0, 0, 0, 1, NULL, NULL, NULL, 0, '2022-01-26 02:18:24', '2022-01-26 02:21:45', '2022-01-26 02:21:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news_to_categories`
--

DROP TABLE IF EXISTS `news_to_categories`;
CREATE TABLE IF NOT EXISTS `news_to_categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `news_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `news_to_categories_news_id_foreign` (`news_id`),
  KEY `news_to_categories_category_id_foreign` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=285 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `news_to_categories`
--

INSERT INTO `news_to_categories` (`id`, `news_id`, `category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(30, 17, 34, NULL, NULL, NULL),
(31, 17, 35, NULL, NULL, NULL),
(32, 16, 25, NULL, NULL, NULL),
(33, 16, 26, NULL, NULL, NULL),
(34, 16, 42, NULL, NULL, NULL),
(35, 18, 43, NULL, NULL, NULL),
(36, 19, 43, NULL, NULL, NULL),
(37, 20, 43, NULL, NULL, NULL),
(38, 21, 43, NULL, NULL, NULL),
(39, 22, 43, NULL, NULL, NULL),
(40, 23, 41, NULL, NULL, NULL),
(41, 23, 43, NULL, NULL, NULL),
(42, 24, 41, NULL, NULL, NULL),
(43, 24, 43, NULL, NULL, NULL),
(44, 25, 43, NULL, NULL, NULL),
(45, 24, 25, NULL, NULL, NULL),
(46, 24, 26, NULL, NULL, NULL),
(47, 24, 42, NULL, NULL, NULL),
(48, 24, 27, NULL, NULL, NULL),
(49, 24, 28, NULL, NULL, NULL),
(50, 24, 29, NULL, NULL, NULL),
(51, 24, 30, NULL, NULL, NULL),
(52, 24, 31, NULL, NULL, NULL),
(53, 24, 32, NULL, NULL, NULL),
(54, 24, 33, NULL, NULL, NULL),
(55, 24, 34, NULL, NULL, NULL),
(56, 24, 35, NULL, NULL, NULL),
(57, 24, 36, NULL, NULL, NULL),
(58, 24, 37, NULL, NULL, NULL),
(59, 24, 38, NULL, NULL, NULL),
(60, 24, 39, NULL, NULL, NULL),
(61, 24, 40, NULL, NULL, NULL),
(62, 24, 44, NULL, NULL, NULL),
(63, 24, 45, NULL, NULL, NULL),
(64, 25, 25, NULL, NULL, NULL),
(65, 25, 26, NULL, NULL, NULL),
(66, 25, 42, NULL, NULL, NULL),
(67, 25, 27, NULL, NULL, NULL),
(68, 25, 28, NULL, NULL, NULL),
(69, 25, 29, NULL, NULL, NULL),
(70, 25, 30, NULL, NULL, NULL),
(71, 25, 31, NULL, NULL, NULL),
(72, 25, 32, NULL, NULL, NULL),
(73, 25, 33, NULL, NULL, NULL),
(74, 25, 34, NULL, NULL, NULL),
(75, 25, 35, NULL, NULL, NULL),
(76, 25, 36, NULL, NULL, NULL),
(77, 25, 37, NULL, NULL, NULL),
(78, 25, 38, NULL, NULL, NULL),
(79, 25, 39, NULL, NULL, NULL),
(80, 25, 40, NULL, NULL, NULL),
(81, 25, 41, NULL, NULL, NULL),
(82, 25, 44, NULL, NULL, NULL),
(83, 25, 45, NULL, NULL, NULL),
(84, 23, 25, NULL, NULL, NULL),
(85, 23, 26, NULL, NULL, NULL),
(86, 23, 42, NULL, NULL, NULL),
(87, 23, 27, NULL, NULL, NULL),
(88, 23, 28, NULL, NULL, NULL),
(89, 23, 29, NULL, NULL, NULL),
(90, 23, 30, NULL, NULL, NULL),
(91, 23, 31, NULL, NULL, NULL),
(92, 23, 32, NULL, NULL, NULL),
(93, 23, 33, NULL, NULL, NULL),
(94, 23, 34, NULL, NULL, NULL),
(95, 23, 35, NULL, NULL, NULL),
(96, 23, 36, NULL, NULL, NULL),
(97, 23, 37, NULL, NULL, NULL),
(98, 23, 38, NULL, NULL, NULL),
(99, 23, 39, NULL, NULL, NULL),
(100, 23, 40, NULL, NULL, NULL),
(101, 23, 44, NULL, NULL, NULL),
(102, 23, 45, NULL, NULL, NULL),
(103, 22, 25, NULL, NULL, NULL),
(104, 22, 26, NULL, NULL, NULL),
(105, 22, 42, NULL, NULL, NULL),
(106, 22, 27, NULL, NULL, NULL),
(107, 22, 28, NULL, NULL, NULL),
(108, 22, 29, NULL, NULL, NULL),
(109, 22, 30, NULL, NULL, NULL),
(110, 22, 31, NULL, NULL, NULL),
(111, 22, 32, NULL, NULL, NULL),
(112, 22, 33, NULL, NULL, NULL),
(113, 22, 34, NULL, NULL, NULL),
(114, 22, 35, NULL, NULL, NULL),
(115, 22, 36, NULL, NULL, NULL),
(116, 22, 37, NULL, NULL, NULL),
(117, 22, 38, NULL, NULL, NULL),
(118, 22, 39, NULL, NULL, NULL),
(119, 22, 40, NULL, NULL, NULL),
(120, 22, 41, NULL, NULL, NULL),
(121, 22, 44, NULL, NULL, NULL),
(122, 22, 45, NULL, NULL, NULL),
(123, 16, 27, NULL, NULL, NULL),
(124, 16, 28, NULL, NULL, NULL),
(125, 16, 29, NULL, NULL, NULL),
(126, 16, 30, NULL, NULL, NULL),
(127, 16, 31, NULL, NULL, NULL),
(128, 16, 32, NULL, NULL, NULL),
(129, 16, 33, NULL, NULL, NULL),
(130, 16, 34, NULL, NULL, NULL),
(131, 16, 35, NULL, NULL, NULL),
(132, 16, 36, NULL, NULL, NULL),
(133, 16, 37, NULL, NULL, NULL),
(134, 16, 38, NULL, NULL, NULL),
(135, 16, 39, NULL, NULL, NULL),
(136, 16, 40, NULL, NULL, NULL),
(137, 16, 41, NULL, NULL, NULL),
(138, 16, 43, NULL, NULL, NULL),
(139, 16, 44, NULL, NULL, NULL),
(140, 16, 45, NULL, NULL, NULL),
(141, 18, 25, NULL, NULL, NULL),
(142, 18, 26, NULL, NULL, NULL),
(143, 18, 42, NULL, NULL, NULL),
(144, 18, 27, NULL, NULL, NULL),
(145, 18, 28, NULL, NULL, NULL),
(146, 18, 29, NULL, NULL, NULL),
(147, 18, 30, NULL, NULL, NULL),
(148, 18, 31, NULL, NULL, NULL),
(149, 18, 32, NULL, NULL, NULL),
(150, 18, 33, NULL, NULL, NULL),
(151, 18, 34, NULL, NULL, NULL),
(152, 18, 35, NULL, NULL, NULL),
(153, 18, 36, NULL, NULL, NULL),
(154, 18, 37, NULL, NULL, NULL),
(155, 18, 38, NULL, NULL, NULL),
(156, 18, 39, NULL, NULL, NULL),
(157, 18, 40, NULL, NULL, NULL),
(158, 18, 41, NULL, NULL, NULL),
(159, 18, 44, NULL, NULL, NULL),
(160, 18, 45, NULL, NULL, NULL),
(161, 20, 25, NULL, NULL, NULL),
(162, 20, 26, NULL, NULL, NULL),
(163, 20, 42, NULL, NULL, NULL),
(164, 20, 27, NULL, NULL, NULL),
(165, 20, 28, NULL, NULL, NULL),
(166, 20, 29, NULL, NULL, NULL),
(167, 20, 30, NULL, NULL, NULL),
(168, 20, 31, NULL, NULL, NULL),
(169, 20, 32, NULL, NULL, NULL),
(170, 20, 33, NULL, NULL, NULL),
(171, 20, 34, NULL, NULL, NULL),
(172, 20, 35, NULL, NULL, NULL),
(173, 20, 36, NULL, NULL, NULL),
(174, 20, 37, NULL, NULL, NULL),
(175, 20, 38, NULL, NULL, NULL),
(176, 20, 39, NULL, NULL, NULL),
(177, 20, 40, NULL, NULL, NULL),
(178, 20, 41, NULL, NULL, NULL),
(179, 20, 44, NULL, NULL, NULL),
(180, 20, 45, NULL, NULL, NULL),
(181, 21, 25, NULL, NULL, NULL),
(182, 21, 26, NULL, NULL, NULL),
(183, 21, 42, NULL, NULL, NULL),
(184, 21, 27, NULL, NULL, NULL),
(185, 21, 28, NULL, NULL, NULL),
(186, 21, 29, NULL, NULL, NULL),
(187, 21, 30, NULL, NULL, NULL),
(188, 21, 31, NULL, NULL, NULL),
(189, 21, 32, NULL, NULL, NULL),
(190, 21, 33, NULL, NULL, NULL),
(191, 21, 34, NULL, NULL, NULL),
(192, 21, 35, NULL, NULL, NULL),
(193, 21, 36, NULL, NULL, NULL),
(194, 21, 37, NULL, NULL, NULL),
(195, 21, 38, NULL, NULL, NULL),
(196, 21, 39, NULL, NULL, NULL),
(197, 21, 40, NULL, NULL, NULL),
(198, 21, 41, NULL, NULL, NULL),
(199, 21, 44, NULL, NULL, NULL),
(200, 21, 45, NULL, NULL, NULL),
(201, 26, 25, NULL, NULL, NULL),
(202, 26, 26, NULL, NULL, NULL),
(203, 26, 42, NULL, NULL, NULL),
(204, 26, 27, NULL, NULL, NULL),
(205, 26, 28, NULL, NULL, NULL),
(206, 26, 29, NULL, NULL, NULL),
(207, 26, 30, NULL, NULL, NULL),
(208, 26, 31, NULL, NULL, NULL),
(209, 26, 32, NULL, NULL, NULL),
(210, 26, 33, NULL, NULL, NULL),
(211, 26, 34, NULL, NULL, NULL),
(212, 26, 35, NULL, NULL, NULL),
(213, 26, 36, NULL, NULL, NULL),
(214, 26, 37, NULL, NULL, NULL),
(215, 26, 38, NULL, NULL, NULL),
(216, 26, 39, NULL, NULL, NULL),
(217, 26, 40, NULL, NULL, NULL),
(218, 26, 41, NULL, NULL, NULL),
(219, 26, 43, NULL, NULL, NULL),
(220, 26, 44, NULL, NULL, NULL),
(221, 26, 45, NULL, NULL, NULL),
(222, 17, 25, NULL, NULL, NULL),
(223, 17, 26, NULL, NULL, NULL),
(224, 17, 42, NULL, NULL, NULL),
(225, 17, 27, NULL, NULL, NULL),
(226, 17, 28, NULL, NULL, NULL),
(227, 17, 29, NULL, NULL, NULL),
(228, 17, 30, NULL, NULL, NULL),
(229, 17, 31, NULL, NULL, NULL),
(230, 17, 32, NULL, NULL, NULL),
(231, 17, 33, NULL, NULL, NULL),
(232, 17, 36, NULL, NULL, NULL),
(233, 17, 37, NULL, NULL, NULL),
(234, 17, 38, NULL, NULL, NULL),
(235, 17, 39, NULL, NULL, NULL),
(236, 17, 40, NULL, NULL, NULL),
(237, 17, 41, NULL, NULL, NULL),
(238, 17, 43, NULL, NULL, NULL),
(239, 17, 44, NULL, NULL, NULL),
(240, 17, 45, NULL, NULL, NULL),
(241, 19, 25, NULL, NULL, NULL),
(242, 19, 26, NULL, NULL, NULL),
(243, 19, 42, NULL, NULL, NULL),
(244, 19, 27, NULL, NULL, NULL),
(245, 19, 28, NULL, NULL, NULL),
(246, 19, 29, NULL, NULL, NULL),
(247, 19, 30, NULL, NULL, NULL),
(248, 19, 31, NULL, NULL, NULL),
(249, 19, 32, NULL, NULL, NULL),
(250, 19, 33, NULL, NULL, NULL),
(251, 19, 34, NULL, NULL, NULL),
(252, 19, 35, NULL, NULL, NULL),
(253, 19, 36, NULL, NULL, NULL),
(254, 19, 37, NULL, NULL, NULL),
(255, 19, 38, NULL, NULL, NULL),
(256, 19, 39, NULL, NULL, NULL),
(257, 19, 40, NULL, NULL, NULL),
(258, 19, 41, NULL, NULL, NULL),
(259, 19, 44, NULL, NULL, NULL),
(260, 19, 45, NULL, NULL, NULL),
(261, 27, 25, NULL, NULL, NULL),
(262, 27, 26, NULL, NULL, NULL),
(263, 27, 42, NULL, NULL, NULL),
(264, 27, 27, NULL, NULL, NULL),
(265, 27, 28, NULL, NULL, NULL),
(266, 27, 29, NULL, NULL, NULL),
(267, 27, 30, NULL, NULL, NULL),
(268, 27, 31, NULL, NULL, NULL),
(269, 27, 32, NULL, NULL, NULL),
(270, 27, 33, NULL, NULL, NULL),
(271, 27, 34, NULL, NULL, NULL),
(272, 27, 35, NULL, NULL, NULL),
(273, 27, 36, NULL, NULL, NULL),
(274, 27, 37, NULL, NULL, NULL),
(275, 27, 38, NULL, NULL, NULL),
(276, 27, 39, NULL, NULL, NULL),
(277, 27, 40, NULL, NULL, NULL),
(278, 27, 41, NULL, NULL, NULL),
(279, 27, 43, NULL, NULL, NULL),
(280, 27, 44, NULL, NULL, NULL),
(281, 27, 45, NULL, NULL, NULL),
(282, 28, 34, NULL, NULL, NULL),
(283, 28, 35, NULL, NULL, NULL),
(284, 29, 25, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `permission` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permissions_role_id_foreign` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=640 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `permissions`
--

INSERT INTO `permissions` (`id`, `role_id`, `permission`, `created_at`, `updated_at`) VALUES
(625, 2, 'admin.file.image.index', '2022-01-15 07:13:40', '2022-01-15 07:13:40'),
(626, 2, 'admin.index', '2022-01-15 07:13:40', '2022-01-15 07:13:40'),
(627, 2, 'admin.news.index', '2022-01-15 07:13:40', '2022-01-15 07:13:40'),
(628, 2, 'admin.news.create', '2022-01-15 07:13:40', '2022-01-15 07:13:40'),
(629, 2, 'admin.news.edit', '2022-01-15 07:13:40', '2022-01-15 07:13:40'),
(630, 2, 'admin.news.disable', '2022-01-15 07:13:40', '2022-01-15 07:13:40'),
(631, 2, 'admin.news.enable', '2022-01-15 07:13:40', '2022-01-15 07:13:40'),
(632, 2, 'admin.news.destroy', '2022-01-15 07:13:40', '2022-01-15 07:13:40'),
(633, 2, 'admin.category.index', '2022-01-15 07:13:40', '2022-01-15 07:13:40'),
(634, 2, 'admin.category.create', '2022-01-15 07:13:40', '2022-01-15 07:13:40'),
(635, 2, 'admin.category.edit', '2022-01-15 07:13:40', '2022-01-15 07:13:40'),
(636, 2, 'admin.category.sort', '2022-01-15 07:13:40', '2022-01-15 07:13:40'),
(637, 2, 'admin.category.disable', '2022-01-15 07:13:40', '2022-01-15 07:13:40'),
(638, 2, 'admin.category.enable', '2022-01-15 07:13:40', '2022-01-15 07:13:40'),
(639, 2, 'admin.category.destroy', '2022-01-15 07:13:40', '2022-01-15 07:13:40');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', '*', '2022-01-07 05:33:42', '2022-01-07 05:33:42', NULL),
(2, 'Viết bài', 'option', '2022-01-07 01:26:15', '2022-01-07 06:09:17', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(12, 'website-name', '\"L\\u1ef1c L\\u01b0\\u1ee3ng V\\u0169 Trang BRVT\"', '2022-01-06 08:46:41', '2022-01-06 08:46:41'),
(13, 'website-email', '\"llvtbrvt@gmail.com\"', '2022-01-06 08:46:41', '2022-01-09 15:48:14'),
(14, 'website-phone', '\"123456\"', '2022-01-06 08:46:41', '2022-01-06 08:46:41'),
(15, 'website-address', '\"1279A, H\\u00f9ng V\\u01b0\\u01a1ng, \\u1ea5p B\\u1eafc 3, x\\u00e3 Ho\\u00e0 Long, TP.B\\u00e0 R\\u1ecba, t\\u1ec9nh B\\u00e0 R\\u1ecba - V\\u0169ng T\\u00e0u\"', '2022-01-06 08:46:41', '2022-01-09 15:47:34'),
(16, 'home-title', '\"L\\u1ef1c L\\u01b0\\u1ee3ng V\\u0169 Trang BRVT\"', '2022-01-06 08:46:41', '2022-01-06 08:54:19'),
(17, 'home-description', '\"L\\u1ef1c L\\u01b0\\u1ee3ng V\\u0169 Trang BRVT\"', '2022-01-06 08:46:41', '2022-01-06 08:54:19'),
(18, 'home-keyword', '\"L\\u1ef1c L\\u01b0\\u1ee3ng V\\u0169 Trang BRVT\"', '2022-01-06 08:46:41', '2022-01-06 08:54:19'),
(19, 'logo', '\"http:\\/\\/127.0.0.1:8000\\/storage\\/setting\\/logo\\/61f0b743cefb8-1643165507.png\"', '2022-01-06 08:47:07', '2022-01-26 02:51:47'),
(20, 'logo-filename', '\"61f0b743cefb8-1643165507.png\"', '2022-01-06 08:47:07', '2022-01-26 02:51:47'),
(21, 'default-thumbnail', '\"http:\\/\\/127.0.0.1:8000\\/storage\\/setting\\/thumbnail\\/61f0b743d3b22-1643165507.jpg\"', '2022-01-06 08:47:08', '2022-01-26 02:51:47'),
(22, 'default-thumbnail-filename', '\"61f0b743d3b22-1643165507.jpg\"', '2022-01-06 08:47:08', '2022-01-26 02:51:47'),
(23, 'social-facebook', '\"https:\\/\\/www.facebook.com\\/vietnamtoquoctoiyeu\"', '2022-01-09 14:26:19', '2022-01-09 14:33:04'),
(24, 'social-youtube', '\"https:\\/\\/www.youtube.com\\/channel\\/UC72J4ahElUrxR-GK4G_Kiag\"', '2022-01-09 14:26:19', '2022-01-09 14:33:53'),
(25, 'social-zalo', '\"https:\\/\\/www.zalo.me\\/vietnamtoquoctoiyeu\"', '2022-01-09 14:26:19', '2022-01-09 14:34:06'),
(26, 'website-url', '\"www.lucluongvutrangbrvt.vn\"', '2022-01-12 08:49:36', '2022-01-12 08:49:36'),
(27, 'website-about', '\"L\\u1ef1c L\\u01b0\\u1ee3ng V\\u0169 Trang BRVT\"', '2022-01-12 08:49:36', '2022-01-12 08:49:36'),
(28, 'facebook-app-id', '\"308414234659955\"', '2022-01-12 09:26:26', '2022-03-14 04:50:20'),
(29, 'favicon', '\"https:\\/\\/lucluongvutrangbrvt.s3.amazonaws.com\\/setting\\/favicon\\/61f0b76d49414-1643165549.ico\"', '2022-01-12 11:02:14', '2022-01-26 02:52:29'),
(30, 'favicon-filename', '\"61f0b76d49414-1643165549.ico\"', '2022-01-12 11:02:14', '2022-01-26 02:52:29'),
(31, 'search-title', '\"L\\u1ef1c L\\u01b0\\u1ee3ng V\\u0169 Trang BRVT\"', '2022-01-13 03:01:19', '2022-01-13 03:01:19'),
(32, 'search-description', '\"L\\u1ef1c L\\u01b0\\u1ee3ng V\\u0169 Trang BRVT\"', '2022-01-13 03:01:19', '2022-01-13 03:01:19'),
(33, 'search-keyword', '\"L\\u1ef1c L\\u01b0\\u1ee3ng V\\u0169 Trang BRVT\"', '2022-01-13 03:01:19', '2022-01-13 03:02:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `api_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `last_name`, `first_name`, `role_id`, `api_token`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Amiya Veum', 'ernest.russel@example.com', '2022-01-04 21:37:14', '$2y$10$dYpJhf3jC0Dl4RWTsiNzTuRrdKhtOYQ6lFumEIrZ2GMCxNGmaU91a', 'aEa5wl0YRbYlk1ZIjvof5GaYYxSZyf0oo4zRvxHrWjDTWIIeooYwLcw1BLkW', NULL, NULL, 1, NULL, 1, '2022-01-04 21:37:14', '2022-01-07 03:49:28', NULL),
(2, 'Janiya Cole', 'kertzmann.melany@example.org', '2022-01-04 21:37:14', '$2y$10$dYpJhf3jC0Dl4RWTsiNzTuRrdKhtOYQ6lFumEIrZ2GMCxNGmaU91a', '4NxPQVibbF', NULL, NULL, 1, NULL, 0, '2022-01-04 21:37:14', '2022-01-04 21:37:14', NULL),
(3, 'Breanne Bahringer III', 'lessie19@example.net', '2022-01-04 21:37:14', '$2y$10$dYpJhf3jC0Dl4RWTsiNzTuRrdKhtOYQ6lFumEIrZ2GMCxNGmaU91a', 'iLpFifgjxK', NULL, NULL, 1, NULL, 0, '2022-01-04 21:37:14', '2022-01-04 21:37:14', NULL),
(4, 'Dr. Elbert Leuschke', 'nschaden@example.com', '2022-01-04 21:37:14', '$2y$10$dYpJhf3jC0Dl4RWTsiNzTuRrdKhtOYQ6lFumEIrZ2GMCxNGmaU91a', 'jKjimqg9o0', NULL, NULL, 1, NULL, 0, '2022-01-04 21:37:14', '2022-01-04 21:37:14', NULL),
(5, 'Mr. Terrell Koepp I', 'rowe.hanna@example.com', '2022-01-04 21:37:14', '$2y$10$dYpJhf3jC0Dl4RWTsiNzTuRrdKhtOYQ6lFumEIrZ2GMCxNGmaU91a', 'LqcaGe1vfA', NULL, NULL, 1, NULL, 0, '2022-01-04 21:37:14', '2022-01-07 03:24:41', NULL),
(6, 'Berta Koch I', 'koepp.estelle@example.net', '2022-01-04 21:37:14', '$2y$10$dYpJhf3jC0Dl4RWTsiNzTuRrdKhtOYQ6lFumEIrZ2GMCxNGmaU91a', 'EMF6mLfnVe', NULL, NULL, 1, NULL, 0, '2022-01-04 21:37:14', '2022-01-04 21:37:14', NULL),
(7, 'Earl Mann', 'xleffler@example.org', '2022-01-04 21:37:14', '$2y$10$dYpJhf3jC0Dl4RWTsiNzTuRrdKhtOYQ6lFumEIrZ2GMCxNGmaU91a', '5Z58eYlG3y', NULL, NULL, 1, NULL, 0, '2022-01-04 21:37:14', '2022-01-04 21:37:14', NULL),
(8, 'Miss Burdette Schroeder', 'abbott.opal@example.com', '2022-01-04 21:37:14', '$2y$10$dYpJhf3jC0Dl4RWTsiNzTuRrdKhtOYQ6lFumEIrZ2GMCxNGmaU91a', 'cX87wPs23y', NULL, NULL, 1, NULL, 0, '2022-01-04 21:37:14', '2022-01-08 01:47:33', '2022-01-08 01:47:33'),
(9, 'Ally Botsford', 'henri65@example.net', '2022-01-04 21:37:14', '$2y$10$dYpJhf3jC0Dl4RWTsiNzTuRrdKhtOYQ6lFumEIrZ2GMCxNGmaU91a', 'ta0UbLGYAX', NULL, NULL, 1, NULL, 0, '2022-01-04 21:37:14', '2022-01-04 21:37:14', NULL),
(10, 'Mrs. Meggie McClure III', 'andreanne64@example.org', '2022-01-04 21:37:14', '$2y$10$dYpJhf3jC0Dl4RWTsiNzTuRrdKhtOYQ6lFumEIrZ2GMCxNGmaU91a', 'z3wtmF51Q1', NULL, NULL, 1, NULL, 0, '2022-01-04 21:37:14', '2022-01-04 21:37:14', NULL),
(11, 'Thanh Tùng', 'vttung@gmail.com', NULL, '$2y$10$x4xEeTakXiZZKjdLhijeqed/86VpVkxrtFas5Xv4pOunXF2heW5QW', NULL, NULL, NULL, 1, NULL, 0, '2022-01-06 23:25:27', '2022-01-06 23:50:08', NULL),
(12, 'Văn Hoàng', 'dvhoang@gmail.com', NULL, '$2y$10$wUI247E8TSkaRlf2bJjSae/g9V7pyTL8tB0/rd66picsvFJlZ5rq6', NULL, 'Đỗ Văn', 'Hoàng', 2, NULL, 0, '2022-01-07 02:57:10', '2022-01-11 09:25:21', NULL),
(13, 'Tuấn Văn', 'ttvan@gmail.com', NULL, '$2y$10$rdNAKmnJHcKehtXT0blZce.6aKjf.3KwpKE5rwalqS7sl0H1RfLDG', NULL, NULL, NULL, 1, NULL, 0, '2022-01-07 05:30:06', '2022-01-07 05:30:06', NULL),
(14, 'Tuấn Kiệt', 'dtkiet@gmail.com', '2022-01-08 01:56:48', '$2y$10$DbRri91JqV3RaE1pNEmMmOt.B26zdKcpv3K9SpBy9TONLuxKRDujm', NULL, 'Đinh Tuấn', 'Kiệt', 2, 'zLZSUKIeYDiB6c5OuJL65h7zx14WuaCLXotq9eTGjqqiOKgwPPO9ZowJN4N7', 0, '2022-01-07 20:16:16', '2022-01-11 09:25:20', NULL),
(15, 'Trương Toàn', 'btchuybui@gmail.com', '2022-01-08 01:56:48', '$2y$10$0RgSlC9lg3npXfE7flZ.peZ.cdmjH2m4buIHvKVakam/rW09Gsm9q', NULL, 'Trương Văn', 'Toàn', 1, 'cw3m2l2q4kDU6iibsRXp9PtByEPSQBYbvc5H6FBS5uXjz4rJmE96xYJnXnBS', 1, '2022-01-07 22:32:28', '2022-01-08 01:56:48', NULL),
(16, 'Phong Vũ', 'hv281100@gmail.com', '2022-01-08 06:26:52', '$2y$10$QLfjmF3eHfLSR9.vxgVPLuvJ4PCOaSIsDxPA5k9QpaS7ePSRe0uNG', NULL, 'Lê Phong', 'Vũ', 2, 'jYlmrKLUz5M6GaBOmYRjGgQa2jCNWKwnaM97e6kEUmMSDGpmbbFig5oDv9eF', 1, '2022-01-08 06:25:43', '2022-01-15 06:50:48', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `videos`
--

DROP TABLE IF EXISTS `videos`;
CREATE TABLE IF NOT EXISTS `videos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` text COLLATE utf8mb4_unicode_ci,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `videos_author_id_foreign` (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `videos`
--

INSERT INTO `videos` (`id`, `title`, `slug`, `url`, `filename`, `thumbnail`, `content`, `description`, `author_id`, `meta_title`, `meta_description`, `meta_keyword`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Lời Bác dạy ngày này năm xưa ngày 27 tháng 7', 'loi-bac-day-ngay-nay-nam-xua-ngay-27-thang-7', 'https://www.youtube.com/watch?v=Mrn6Hitwaeo', '61f0b529d0de5-1643164969.jpg', 'http://127.0.0.1:8000/storage/thumbnail/video/61f0b529d0de5-1643164969.jpg', NULL, NULL, 1, 'Lời Bác dạy ngày này năm xưa ngày 27 tháng 7', 'Lời Bác dạy ngày này năm xưa ngày 27 tháng 7', 'Lời Bác dạy ngày này năm xưa ngày 27 tháng 7', 1, '2022-01-11 10:41:39', '2022-01-26 02:42:49', NULL),
(2, 'Lời Bác dạy ngày này năm xưa ngày 28 tháng 7', 'loi-bac-day-ngay-nay-nam-xua-ngay-28-thang-7', 'https://www.youtube.com/watch?v=OjMTsePwwVM', '61f0b557729ee-1643165015.jpg', 'http://127.0.0.1:8000/storage/thumbnail/video/61f0b557729ee-1643165015.jpg', NULL, NULL, 1, 'Lời Bác dạy ngày này năm xưa ngày 28 tháng 7', 'Lời Bác dạy ngày này năm xưa ngày 28 tháng 7', 'Lời Bác dạy ngày này năm xưa ngày 28 tháng 7', 1, '2022-01-11 11:32:39', '2022-01-26 02:43:35', NULL),
(3, 'Lời Bác dạy ngày này năm xưa ngày 22 tháng 7', 'loi-bac-day-ngay-nay-nam-xua-ngay-22-thang-7', 'https://www.youtube.com/watch?v=n7Q1DbPZN8w', '61f0b531b5be2-1643164977.jpg', 'http://127.0.0.1:8000/storage/thumbnail/video/61f0b531b5be2-1643164977.jpg', NULL, NULL, 1, 'Lời Bác dạy ngày này năm xưa ngày 22 tháng 7', 'Lời Bác dạy ngày này năm xưa ngày 22 tháng 7', 'Lời Bác dạy ngày này năm xưa ngày 22 tháng 7', 1, '2022-01-11 11:34:51', '2022-01-26 02:42:57', NULL),
(4, 'Lời Bác dạy ngày này năm xưa ngày 19 tháng 7', 'loi-bac-day-ngay-nay-nam-xua-ngay-19-thang-7', 'https://www.youtube.com/watch?v=KXk0xSyF958', '61f0b539968c8-1643164985.jpg', 'http://127.0.0.1:8000/storage/thumbnail/video/61f0b539968c8-1643164985.jpg', NULL, NULL, 1, 'Lời Bác dạy ngày này năm xưa ngày 19 tháng 7', 'Lời Bác dạy ngày này năm xưa ngày 19 tháng 7', 'Lời Bác dạy ngày này năm xưa ngày 19 tháng 7', 1, '2022-01-11 11:35:27', '2022-01-26 02:43:05', NULL),
(5, 'Lời Bác dạy ngày này năm xưa ngày 13 tháng 7', 'loi-bac-day-ngay-nay-nam-xua-ngay-13-thang-7', 'https://www.youtube.com/watch?v=UNEVRmj4bfc&t=87s', '61f0b54db2cab-1643165005.jpg', 'http://127.0.0.1:8000/storage/thumbnail/video/61f0b54db2cab-1643165005.jpg', NULL, NULL, 1, 'Lời Bác dạy ngày này năm xưa ngày 13 tháng 7', 'Lời Bác dạy ngày này năm xưa ngày 13 tháng 7', 'Lời Bác dạy ngày này năm xưa ngày 13 tháng 7', 1, '2022-01-11 11:36:46', '2022-01-26 02:43:25', NULL),
(6, 'Lời Bác dạy ngày này năm xưa ngày 07 tháng 7', 'loi-bac-day-ngay-nay-nam-xua-ngay-07-thang-7', 'https://www.youtube.com/watch?v=viHDKNtvdqM', '61f0b5454f3d6-1643164997.jpg', 'http://127.0.0.1:8000/storage/thumbnail/video/61f0b5454f3d6-1643164997.jpg', NULL, NULL, 1, 'Lời Bác dạy ngày này năm xưa ngày 07 tháng 7', 'Lời Bác dạy ngày này năm xưa ngày 07 tháng 7', 'Lời Bác dạy ngày này năm xưa ngày 07 tháng 7', 1, '2022-01-11 11:37:35', '2022-01-26 02:43:17', NULL),
(7, 'a', 'a', NULL, NULL, NULL, NULL, NULL, 1, 'a', 'a', 'a', 0, '2022-01-11 11:38:03', '2022-01-11 11:38:16', '2022-01-11 11:38:16');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `video_to_categories`
--

DROP TABLE IF EXISTS `video_to_categories`;
CREATE TABLE IF NOT EXISTS `video_to_categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `video_id` bigint(20) UNSIGNED NOT NULL,
  `category_video_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `video_to_categories_video_id_foreign` (`video_id`),
  KEY `video_to_categories_category_video_id_foreign` (`category_video_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `video_to_categories`
--

INSERT INTO `video_to_categories` (`id`, `video_id`, `category_video_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, NULL, NULL, NULL),
(2, 2, 1, NULL, NULL, NULL),
(3, 3, 1, NULL, NULL, NULL),
(4, 4, 1, NULL, NULL, NULL),
(5, 5, 1, NULL, NULL, NULL),
(6, 6, 1, NULL, NULL, NULL),
(7, 7, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `views`
--

DROP TABLE IF EXISTS `views`;
CREATE TABLE IF NOT EXISTS `views` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `viewable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `viewable_id` bigint(20) UNSIGNED NOT NULL,
  `visitor` text COLLATE utf8mb4_unicode_ci,
  `collection` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `viewed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `views_viewable_type_viewable_id_index` (`viewable_type`,`viewable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `views`
--

INSERT INTO `views` (`id`, `viewable_type`, `viewable_id`, `visitor`, `collection`, `viewed_at`) VALUES
(24, 'App\\Models\\News', 16, 'IVYEiAe7fo5Qx71z7NVBuzTU8blnxEhX8b5hNi4l002U7YWvMiOoIUY7VjWy9OIrExw9exQNAVZTVRK9', NULL, '2022-01-13 07:27:55'),
(25, 'App\\Models\\News', 17, 'IVYEiAe7fo5Qx71z7NVBuzTU8blnxEhX8b5hNi4l002U7YWvMiOoIUY7VjWy9OIrExw9exQNAVZTVRK9', NULL, '2022-01-13 07:28:07'),
(26, 'App\\Models\\News', 26, 'IVYEiAe7fo5Qx71z7NVBuzTU8blnxEhX8b5hNi4l002U7YWvMiOoIUY7VjWy9OIrExw9exQNAVZTVRK9', NULL, '2022-01-13 07:35:18'),
(27, 'App\\Models\\News', 24, 'IVYEiAe7fo5Qx71z7NVBuzTU8blnxEhX8b5hNi4l002U7YWvMiOoIUY7VjWy9OIrExw9exQNAVZTVRK9', NULL, '2022-01-13 07:36:46'),
(28, 'App\\Models\\News', 19, 'IVYEiAe7fo5Qx71z7NVBuzTU8blnxEhX8b5hNi4l002U7YWvMiOoIUY7VjWy9OIrExw9exQNAVZTVRK9', NULL, '2022-01-13 07:40:23'),
(29, 'App\\Models\\News', 20, 'IVYEiAe7fo5Qx71z7NVBuzTU8blnxEhX8b5hNi4l002U7YWvMiOoIUY7VjWy9OIrExw9exQNAVZTVRK9', NULL, '2022-01-13 07:44:38'),
(30, 'App\\Models\\News', 18, 'IVYEiAe7fo5Qx71z7NVBuzTU8blnxEhX8b5hNi4l002U7YWvMiOoIUY7VjWy9OIrExw9exQNAVZTVRK9', NULL, '2022-01-15 04:49:38'),
(31, 'App\\Models\\News', 17, 'IVYEiAe7fo5Qx71z7NVBuzTU8blnxEhX8b5hNi4l002U7YWvMiOoIUY7VjWy9OIrExw9exQNAVZTVRK9', NULL, '2022-01-15 05:34:04'),
(32, 'App\\Models\\News', 16, 'IVYEiAe7fo5Qx71z7NVBuzTU8blnxEhX8b5hNi4l002U7YWvMiOoIUY7VjWy9OIrExw9exQNAVZTVRK9', NULL, '2022-01-15 05:34:11'),
(33, 'App\\Models\\News', 25, 'IVYEiAe7fo5Qx71z7NVBuzTU8blnxEhX8b5hNi4l002U7YWvMiOoIUY7VjWy9OIrExw9exQNAVZTVRK9', NULL, '2022-01-15 05:45:41'),
(34, 'App\\Models\\News', 20, 'IVYEiAe7fo5Qx71z7NVBuzTU8blnxEhX8b5hNi4l002U7YWvMiOoIUY7VjWy9OIrExw9exQNAVZTVRK9', NULL, '2022-01-15 05:47:06'),
(35, 'App\\Models\\News', 27, 'IVYEiAe7fo5Qx71z7NVBuzTU8blnxEhX8b5hNi4l002U7YWvMiOoIUY7VjWy9OIrExw9exQNAVZTVRK9', NULL, '2022-01-15 05:47:56'),
(36, 'App\\Models\\News', 22, 'IVYEiAe7fo5Qx71z7NVBuzTU8blnxEhX8b5hNi4l002U7YWvMiOoIUY7VjWy9OIrExw9exQNAVZTVRK9', NULL, '2022-01-15 06:18:46'),
(37, 'App\\Models\\News', 16, 'IVYEiAe7fo5Qx71z7NVBuzTU8blnxEhX8b5hNi4l002U7YWvMiOoIUY7VjWy9OIrExw9exQNAVZTVRK9', NULL, '2022-01-15 08:27:42'),
(38, 'App\\Models\\News', 17, 'IVYEiAe7fo5Qx71z7NVBuzTU8blnxEhX8b5hNi4l002U7YWvMiOoIUY7VjWy9OIrExw9exQNAVZTVRK9', NULL, '2022-01-15 08:30:59'),
(39, 'App\\Models\\News', 20, 'IVYEiAe7fo5Qx71z7NVBuzTU8blnxEhX8b5hNi4l002U7YWvMiOoIUY7VjWy9OIrExw9exQNAVZTVRK9', NULL, '2022-01-15 08:31:09'),
(40, 'App\\Models\\News', 26, 'IVYEiAe7fo5Qx71z7NVBuzTU8blnxEhX8b5hNi4l002U7YWvMiOoIUY7VjWy9OIrExw9exQNAVZTVRK9', NULL, '2022-01-15 08:43:30'),
(41, 'App\\Models\\News', 24, 'IVYEiAe7fo5Qx71z7NVBuzTU8blnxEhX8b5hNi4l002U7YWvMiOoIUY7VjWy9OIrExw9exQNAVZTVRK9', NULL, '2022-01-15 08:45:56'),
(42, 'App\\Models\\News', 25, 'IVYEiAe7fo5Qx71z7NVBuzTU8blnxEhX8b5hNi4l002U7YWvMiOoIUY7VjWy9OIrExw9exQNAVZTVRK9', NULL, '2022-01-15 08:45:59'),
(43, 'App\\Models\\News', 22, 'IVYEiAe7fo5Qx71z7NVBuzTU8blnxEhX8b5hNi4l002U7YWvMiOoIUY7VjWy9OIrExw9exQNAVZTVRK9', NULL, '2022-01-15 08:46:05'),
(44, 'App\\Models\\News', 28, 'IVYEiAe7fo5Qx71z7NVBuzTU8blnxEhX8b5hNi4l002U7YWvMiOoIUY7VjWy9OIrExw9exQNAVZTVRK9', NULL, '2022-01-15 10:02:23'),
(45, 'App\\Models\\News', 28, 'IVYEiAe7fo5Qx71z7NVBuzTU8blnxEhX8b5hNi4l002U7YWvMiOoIUY7VjWy9OIrExw9exQNAVZTVRK9', NULL, '2022-01-15 12:40:51'),
(46, 'App\\Models\\News', 16, 'IVYEiAe7fo5Qx71z7NVBuzTU8blnxEhX8b5hNi4l002U7YWvMiOoIUY7VjWy9OIrExw9exQNAVZTVRK9', NULL, '2022-01-15 12:57:09'),
(47, 'App\\Models\\News', 18, 'IVYEiAe7fo5Qx71z7NVBuzTU8blnxEhX8b5hNi4l002U7YWvMiOoIUY7VjWy9OIrExw9exQNAVZTVRK9', NULL, '2022-01-15 12:57:11'),
(48, 'App\\Models\\News', 16, 'IVYEiAe7fo5Qx71z7NVBuzTU8blnxEhX8b5hNi4l002U7YWvMiOoIUY7VjWy9OIrExw9exQNAVZTVRK9', NULL, '2022-01-26 02:30:29'),
(49, 'App\\Models\\News', 20, 'IVYEiAe7fo5Qx71z7NVBuzTU8blnxEhX8b5hNi4l002U7YWvMiOoIUY7VjWy9OIrExw9exQNAVZTVRK9', NULL, '2022-01-26 02:30:34'),
(50, 'App\\Models\\News', 17, 'IVYEiAe7fo5Qx71z7NVBuzTU8blnxEhX8b5hNi4l002U7YWvMiOoIUY7VjWy9OIrExw9exQNAVZTVRK9', NULL, '2022-01-26 02:30:45'),
(51, 'App\\Models\\News', 18, 'IVYEiAe7fo5Qx71z7NVBuzTU8blnxEhX8b5hNi4l002U7YWvMiOoIUY7VjWy9OIrExw9exQNAVZTVRK9', NULL, '2022-01-26 02:31:03'),
(52, 'App\\Models\\News', 28, 'IVYEiAe7fo5Qx71z7NVBuzTU8blnxEhX8b5hNi4l002U7YWvMiOoIUY7VjWy9OIrExw9exQNAVZTVRK9', NULL, '2022-01-26 02:32:19'),
(53, 'App\\Models\\News', 19, 'IVYEiAe7fo5Qx71z7NVBuzTU8blnxEhX8b5hNi4l002U7YWvMiOoIUY7VjWy9OIrExw9exQNAVZTVRK9', NULL, '2022-01-26 02:35:39'),
(54, 'App\\Models\\News', 21, 'IVYEiAe7fo5Qx71z7NVBuzTU8blnxEhX8b5hNi4l002U7YWvMiOoIUY7VjWy9OIrExw9exQNAVZTVRK9', NULL, '2022-01-26 02:36:25'),
(55, 'App\\Models\\News', 22, 'IVYEiAe7fo5Qx71z7NVBuzTU8blnxEhX8b5hNi4l002U7YWvMiOoIUY7VjWy9OIrExw9exQNAVZTVRK9', NULL, '2022-01-26 02:38:10'),
(56, 'App\\Models\\News', 23, 'IVYEiAe7fo5Qx71z7NVBuzTU8blnxEhX8b5hNi4l002U7YWvMiOoIUY7VjWy9OIrExw9exQNAVZTVRK9', NULL, '2022-01-26 02:39:02'),
(57, 'App\\Models\\News', 25, 'IVYEiAe7fo5Qx71z7NVBuzTU8blnxEhX8b5hNi4l002U7YWvMiOoIUY7VjWy9OIrExw9exQNAVZTVRK9', NULL, '2022-01-26 02:39:46'),
(58, 'App\\Models\\News', 24, 'IVYEiAe7fo5Qx71z7NVBuzTU8blnxEhX8b5hNi4l002U7YWvMiOoIUY7VjWy9OIrExw9exQNAVZTVRK9', NULL, '2022-01-26 02:41:27'),
(59, 'App\\Models\\News', 26, 'IVYEiAe7fo5Qx71z7NVBuzTU8blnxEhX8b5hNi4l002U7YWvMiOoIUY7VjWy9OIrExw9exQNAVZTVRK9', NULL, '2022-01-26 02:41:51'),
(60, 'App\\Models\\News', 27, 'IVYEiAe7fo5Qx71z7NVBuzTU8blnxEhX8b5hNi4l002U7YWvMiOoIUY7VjWy9OIrExw9exQNAVZTVRK9', NULL, '2022-01-26 02:42:14'),
(61, 'App\\Models\\News', 19, 'g8iOEvX6ry1aUmuWKsFMUS39gIouqZG8TP3jG9IyRmUB27VLWpLr3UiLrmWKqWVec7Bom0rcQk5AsZkd', NULL, '2022-03-14 04:50:45'),
(62, 'App\\Models\\News', 18, 'g8iOEvX6ry1aUmuWKsFMUS39gIouqZG8TP3jG9IyRmUB27VLWpLr3UiLrmWKqWVec7Bom0rcQk5AsZkd', NULL, '2022-03-14 04:50:48'),
(63, 'App\\Models\\News', 25, 'g8iOEvX6ry1aUmuWKsFMUS39gIouqZG8TP3jG9IyRmUB27VLWpLr3UiLrmWKqWVec7Bom0rcQk5AsZkd', NULL, '2022-03-14 04:50:51'),
(64, 'App\\Models\\News', 26, 'g8iOEvX6ry1aUmuWKsFMUS39gIouqZG8TP3jG9IyRmUB27VLWpLr3UiLrmWKqWVec7Bom0rcQk5AsZkd', NULL, '2022-03-14 04:51:16'),
(65, 'App\\Models\\News', 23, 'g8iOEvX6ry1aUmuWKsFMUS39gIouqZG8TP3jG9IyRmUB27VLWpLr3UiLrmWKqWVec7Bom0rcQk5AsZkd', NULL, '2022-03-14 04:51:21'),
(66, 'App\\Models\\News', 17, 'g8iOEvX6ry1aUmuWKsFMUS39gIouqZG8TP3jG9IyRmUB27VLWpLr3UiLrmWKqWVec7Bom0rcQk5AsZkd', NULL, '2022-03-18 14:20:27'),
(67, 'App\\Models\\News', 21, 'g8iOEvX6ry1aUmuWKsFMUS39gIouqZG8TP3jG9IyRmUB27VLWpLr3UiLrmWKqWVec7Bom0rcQk5AsZkd', NULL, '2022-03-18 14:20:32'),
(68, 'App\\Models\\News', 20, 'g8iOEvX6ry1aUmuWKsFMUS39gIouqZG8TP3jG9IyRmUB27VLWpLr3UiLrmWKqWVec7Bom0rcQk5AsZkd', NULL, '2022-03-18 14:20:45'),
(69, 'App\\Models\\News', 27, 'g8iOEvX6ry1aUmuWKsFMUS39gIouqZG8TP3jG9IyRmUB27VLWpLr3UiLrmWKqWVec7Bom0rcQk5AsZkd', NULL, '2022-03-18 14:20:47'),
(70, 'App\\Models\\News', 18, 'g8iOEvX6ry1aUmuWKsFMUS39gIouqZG8TP3jG9IyRmUB27VLWpLr3UiLrmWKqWVec7Bom0rcQk5AsZkd', NULL, '2022-03-18 14:22:30'),
(71, 'App\\Models\\News', 16, 'g8iOEvX6ry1aUmuWKsFMUS39gIouqZG8TP3jG9IyRmUB27VLWpLr3UiLrmWKqWVec7Bom0rcQk5AsZkd', NULL, '2022-03-18 14:22:35'),
(72, 'App\\Models\\News', 23, 'g8iOEvX6ry1aUmuWKsFMUS39gIouqZG8TP3jG9IyRmUB27VLWpLr3UiLrmWKqWVec7Bom0rcQk5AsZkd', NULL, '2022-03-18 14:22:48');

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `news_to_categories`
--
ALTER TABLE `news_to_categories`
  ADD CONSTRAINT `news_to_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `news_to_categories_news_id_foreign` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `video_to_categories`
--
ALTER TABLE `video_to_categories`
  ADD CONSTRAINT `video_to_categories_category_video_id_foreign` FOREIGN KEY (`category_video_id`) REFERENCES `category_videos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `video_to_categories_video_id_foreign` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
