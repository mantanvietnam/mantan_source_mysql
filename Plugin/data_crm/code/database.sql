-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th7 31, 2024 lúc 10:44 PM
-- Phiên bản máy phục vụ: 10.6.12-MariaDB
-- Phiên bản PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `datacrm_demo`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `address_name` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `id_customer` int(11) NOT NULL DEFAULT 0,
  `address_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `user` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `fullName` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `permission` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'staff'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `admins`
--

INSERT INTO `admins` (`id`, `user`, `password`, `fullName`, `email`, `permission`, `type`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'Trần Mạnh', 'tranmanhbk179@gmail.com', '[]', 'boss');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `affiliaters`
--

CREATE TABLE `affiliaters` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `id_father` int(11) NOT NULL DEFAULT 0 COMMENT 'id người giới thiệu',
  `id_customer` int(11) NOT NULL DEFAULT 0,
  `id_member` int(11) NOT NULL DEFAULT 0,
  `avatar` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `id_system` int(11) NOT NULL DEFAULT 0,
  `password` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `view` int(11) NOT NULL DEFAULT 0,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `linkedin` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `web` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `instagram` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `zalo` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `facebook` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `twitter` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tiktok` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `youtube` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `last_login` int(11) NOT NULL DEFAULT 0,
  `portrait` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `albuminfos`
--

CREATE TABLE `albuminfos` (
  `id` int(11) NOT NULL,
  `id_album` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `link` varchar(255) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `albums`
--

CREATE TABLE `albums` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `id_category` int(11) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `time_create` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `author` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bills`
--

CREATE TABLE `bills` (
  `id` int(11) NOT NULL,
  `id_member_sell` int(11) NOT NULL,
  `id_member_buy` int(11) NOT NULL DEFAULT 0,
  `total` int(11) NOT NULL DEFAULT 0,
  `id_order` int(11) NOT NULL DEFAULT 0,
  `type` int(11) NOT NULL COMMENT '1: phiếu thu, 2 phiếu chi',
  `type_order` int(11) DEFAULT 3 COMMENT '0: tự tạo, 1: đại lý, 2: khách hàng',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `type_collection_bill` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_customer` int(11) NOT NULL DEFAULT 0,
  `id_debt` int(11) NOT NULL DEFAULT 0,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `campaigns`
--

CREATE TABLE `campaigns` (
  `id` int(11) NOT NULL,
  `name` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `name_show` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `text_welcome` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `codeSecurity` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `codePersonWin` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `noteCheckin` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `colorText` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '#000000',
  `status` varchar(30) NOT NULL DEFAULT 'active',
  `img_background` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `id_member` int(11) NOT NULL,
  `location` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `img_logo` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `team` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ticket` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `create_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `campaign_customers`
--

CREATE TABLE `campaign_customers` (
  `id` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_campaign` int(11) NOT NULL,
  `id_location` int(11) NOT NULL DEFAULT 0,
  `id_team` int(11) NOT NULL DEFAULT 0,
  `note` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `time_checkin` int(11) NOT NULL DEFAULT 0,
  `id_ticket` int(11) NOT NULL DEFAULT 0,
  `create_at` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL DEFAULT 0,
  `image` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `keyword` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `slug` text NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `weighty` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categorie_products`
--

CREATE TABLE `categorie_products` (
  `id` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `id_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category_connects`
--

CREATE TABLE `category_connects` (
  `id` int(11) NOT NULL,
  `keyword` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `id_parent` int(11) NOT NULL,
  `id_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `image` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `view` int(11) NOT NULL DEFAULT 0,
  `youtube_code` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `id_category` int(11) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL,
  `content` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `public` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `sex` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: Nữ, 1: Nam',
  `id_city` tinyint(4) NOT NULL DEFAULT 0,
  `id_messenger` varchar(255) NOT NULL,
  `avatar` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `id_parent` int(11) NOT NULL DEFAULT 0 COMMENT 'id member đại lý',
  `id_level` int(11) NOT NULL DEFAULT 0,
  `birthday_date` int(11) NOT NULL,
  `birthday_month` int(11) NOT NULL,
  `birthday_year` int(11) NOT NULL,
  `id_aff` int(11) NOT NULL DEFAULT 0 COMMENT 'id người tiếp thị liên kết',
  `created_at` int(11) NOT NULL,
  `id_group` int(11) NOT NULL DEFAULT 0,
  `facebook` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `id_zalo` varchar(100) DEFAULT NULL,
  `token_device` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reset_password_code` int(11) DEFAULT NULL,
  `link_download_mmtc` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer_histories`
--

CREATE TABLE `customer_histories` (
  `id` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `time_now` int(11) NOT NULL,
  `note_now` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `action_now` varchar(255) NOT NULL,
  `id_staff_now` int(11) NOT NULL,
  `status` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'new'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `debts`
--

CREATE TABLE `debts` (
  `id` int(11) NOT NULL,
  `id_member_sell` int(11) NOT NULL,
  `id_member_buy` int(11) NOT NULL DEFAULT 0,
  `total` int(11) NOT NULL DEFAULT 0,
  `total_payment` int(11) NOT NULL DEFAULT 0,
  `number_payment` int(11) NOT NULL DEFAULT 0,
  `type` int(11) NOT NULL DEFAULT 0 COMMENT '1: Nợ phải thu, 2: Nợ Phải trả, ',
  `status` int(11) NOT NULL COMMENT '0 : chưa trả ,1 đã trả hết',
  `type_order` int(11) NOT NULL COMMENT '3: tự tạo, 1: đại lý, 2: khách hàng',
  `id_customer` int(11) NOT NULL DEFAULT 0,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `id_order` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `discount_codes`
--

CREATE TABLE `discount_codes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` float DEFAULT 0,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deadline_at` timestamp NULL DEFAULT NULL,
  `number_user` int(11) DEFAULT NULL,
  `applicable_price` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `maximum_price_reduction` int(11) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `id_customers` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_products` text DEFAULT NULL,
  `id_member` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `discount_product_agencys`
--

CREATE TABLE `discount_product_agencys` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_member_sell` int(11) NOT NULL COMMENT 'id đại lý tuyến trên',
  `id_member_buy` int(11) NOT NULL COMMENT 'id đại lý tuyến dưới đặt mua',
  `discount` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `documentinfos`
--

CREATE TABLE `documentinfos` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_document` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_parent` int(11) NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `public` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `evaluates`
--

CREATE TABLE `evaluates` (
  `id` int(11) NOT NULL,
  `full_name` varchar(155) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `id_product` int(11) NOT NULL,
  `content` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `point` float DEFAULT NULL,
  `image_video` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `historytests`
--

CREATE TABLE `historytests` (
  `id` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_test` int(11) NOT NULL,
  `point` float NOT NULL,
  `total_true` int(11) NOT NULL,
  `number_question` int(11) NOT NULL,
  `time_start` int(11) NOT NULL,
  `time_end` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lessons`
--

CREATE TABLE `lessons` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `content` text CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `id_course` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `slug` varchar(255) NOT NULL,
  `view` int(11) NOT NULL DEFAULT 0,
  `time_learn` int(11) NOT NULL,
  `author` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `youtube_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `link_infos`
--

CREATE TABLE `link_infos` (
  `id` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `namelink` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `avatar` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `phone` varchar(15) NOT NULL,
  `id_father` int(11) NOT NULL COMMENT 'id member cha',
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `id_system` int(11) NOT NULL,
  `otp` int(11) DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `deadline` int(11) NOT NULL,
  `verify` varchar(255) NOT NULL DEFAULT 'lock',
  `birthday` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `id_position` int(11) NOT NULL DEFAULT 0,
  `create_agency` varchar(255) NOT NULL DEFAULT 'active',
  `coin` int(11) NOT NULL DEFAULT 0,
  `twitter` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tiktok` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `web` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `zalo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `view` int(11) NOT NULL DEFAULT 0,
  `banner` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `token_device` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login` int(11) NOT NULL DEFAULT 0,
  `portrait` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL COMMENT 'ảnh chân dung',
  `create_order_agency` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1: được phép tạo đơn đại lý tuyến dưới, 0: không được phép tạo',
  `img_card_member` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `img_logo` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `noti_new_order` tinyint(1) NOT NULL DEFAULT 1,
  `noti_new_customer` tinyint(1) NOT NULL DEFAULT 1,
  `noti_checkin_campaign` tinyint(1) NOT NULL DEFAULT 1,
  `noti_reg_campaign` tinyint(1) NOT NULL DEFAULT 1,
  `noti_product_warehouse` tinyint(1) NOT NULL DEFAULT 1,
  `display_info` tinyint(4) NOT NULL DEFAULT 1,
  `image_qr_pay` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `list_theme_info` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `member_webs`
--

CREATE TABLE `member_webs` (
  `id` int(11) NOT NULL,
  `domain` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_member` int(11) NOT NULL DEFAULT 0,
  `theme` varchar(100) NOT NULL,
  `view` int(11) NOT NULL DEFAULT 0,
  `status` varchar(100) NOT NULL DEFAULT 'active',
  `type` varchar(100) NOT NULL DEFAULT 'member' COMMENT 'member hoặc affiliate'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `id_parent` int(11) NOT NULL,
  `weighty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `key_word` varchar(255) NOT NULL,
  `value` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `version` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `options`
--

INSERT INTO `options` (`id`, `key_word`, `value`, `version`) VALUES
(2, 'seo_site', '{\"title\":\"ICHAM CRM - PH\\u1ea6N M\\u1ec0M CH\\u0102M S\\u00d3C KH\\u00c1CH H\\u00c0NG\",\"keyword\":\"\",\"description\":\"ICHAM CRM kh\\u00f4ng ch\\u1ec9 l\\u00e0 m\\u1ed9t ph\\u1ea7n m\\u1ec1m qu\\u1ea3n l\\u00fd m\\u1ed1i quan h\\u1ec7 kh\\u00e1ch h\\u00e0ng th\\u00f4ng th\\u01b0\\u1eddng, m\\u00e0 n\\u00f3 c\\u00f2n l\\u00e0 m\\u1ed9t h\\u1ec7 th\\u1ed1ng t\\u1ed5ng th\\u1ec3 gi\\u00fap t\\u1ed1i \\u01b0u h\\u00f3a c\\u00e1c ho\\u1ea1t \\u0111\\u1ed9ng kinh doanh t\\u1eeb \\u0111\\u1ea1i l\\u00fd, \\u0111\\u01a1n h\\u00e0ng, kh\\u00e1ch h\\u00e0ng, t\\u1ed3n kho \\u0111\\u1ebfn c\\u1ed9ng t\\u00e1c vi\\u00ean\",\"number_post\":\"10\",\"code_script\":\"\",\"logo\":\"\",\"image_share\":\"\",\"favicon\":\"\"}', NULL),
(3, 'contact_site', '{\"phone\":\"0816560000\",\"email\":\"tranmanhbk179@gmail.com\",\"address\":\"18 Thanh B\\u00ecnh, M\\u1ed7 Lao, H\\u00e0 \\u0110\\u00f4ng, H\\u00e0 N\\u1ed9i\"}', NULL),
(4, 'smtp_site', '{\"email\":\"ezpicsvn@gmail.com\",\"pass\":\"xutxevlnfjmmsngi\",\"display_name\":\"ICHAM CRM\",\"server\":\"ssl:\\/\\/smtp.gmail.com\",\"port\":\"465\"}', NULL),
(5, 'plugins_site', '[\"hethongdaily\",\"product\",\"2top_crm_training\",\"affiliate\",\"campaign_event\",\"matmathanhcong\",\"clone_web\",\"post_api\"]', NULL),
(6, 'theme_active_site', 'loginAdmin', NULL),
(7, 'plugin_installed', '[\"hethongdaily\",\"product\",\"2top_crm_training\",\"affiliate\",\"campaign_event\",\"matmathanhcong\",\"clone_web\",\"post_api\"]', NULL),
(8, 'theme_installed', '[\"toptop\",\"loginAdmin\"]', NULL),
(9, 'crm_module', '[\"hethongdaily\",\"order_system\",\"order_customer\",\"zalo_zns\",\"training\",\"customer\",\"campaign\",\"clone_web\",\"affiliate\",\"document\",\"cashBook\"]', NULL),
(10, 'settingMMTCAPI', '{\"userAPI\":\"admin\",\"passAPI\":\"Mmtc123!\",\"maxExport\":3,\"numberExport\":0,\"price\":0,\"note_pay\":\"\",\"number_bank\":\"\",\"account_bank\":\"\",\"key_bank\":\"\",\"idBot\":\"\",\"tokenBot\":\"\",\"idBlockConfirm\":\"\",\"idBlockDownload\":\"\"}', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT 0,
  `full_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `note_user` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `note_admin` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `create_at` int(11) NOT NULL,
  `money` int(11) NOT NULL,
  `total` int(11) DEFAULT NULL,
  `payment` int(11) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `id_discount` int(11) DEFAULT NULL,
  `id_agency` int(11) NOT NULL DEFAULT 0,
  `id_aff` int(11) DEFAULT 0,
  `promotion` int(11) NOT NULL DEFAULT 0 COMMENT 'Phần trăm giảm giá',
  `status_pay` varchar(100) NOT NULL DEFAULT 'wait' COMMENT 'trạng thái thanh toán',
  `costsIncurred` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_costsIncurred` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `discount` int(11) NOT NULL DEFAULT 0 COMMENT 'phần trăm chiết khấu',
  `id_unit` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_members`
--

CREATE TABLE `order_members` (
  `id` int(11) NOT NULL,
  `id_member_sell` int(11) NOT NULL COMMENT 'id đại lý tuyến trên',
  `id_member_buy` int(11) NOT NULL COMMENT 'id đại lý tuyến dưới đặt mua',
  `note_sell` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL COMMENT 'ghi chú người bán',
  `note_buy` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL COMMENT 'ghi chú người mua',
  `status` varchar(100) NOT NULL DEFAULT 'new',
  `create_at` int(11) NOT NULL,
  `money` bigint(11) NOT NULL DEFAULT 0 COMMENT 'tổng tiền gốc đơn hàng',
  `total` bigint(11) NOT NULL DEFAULT 0 COMMENT 'tổng tiền sau chiết khấu',
  `status_pay` varchar(100) NOT NULL DEFAULT 'wait' COMMENT 'trạng thái thanh toán',
  `discount` double NOT NULL DEFAULT 0 COMMENT 'phần trăm chiết khấu',
  `costsIncurred` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_costsIncurred` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_member_details`
--

CREATE TABLE `order_member_details` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_order_member` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) NOT NULL DEFAULT 0 COMMENT 'phần trăm chiết khấu',
  `id_unit` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `keyword` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `pin` tinyint(1) NOT NULL,
  `author` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `image` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `idCategory` int(11) NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `slug` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `view` int(11) NOT NULL DEFAULT 0,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `id_category` int(11) NOT NULL,
  `hot` tinyint(1) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `keyword` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `info` text CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `price` int(11) NOT NULL,
  `price_old` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `id_manufacturer` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `view` int(11) NOT NULL DEFAULT 0,
  `images` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `rule` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `id_product` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specification` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idpro_discount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pricepro_discount` int(11) DEFAULT NULL,
  `evaluate` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `price_fash` int(11) DEFAULT NULL,
  `unit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` text CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `option_a` text CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `option_b` text CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `option_c` text CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `option_d` text CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `option_true` varchar(255) NOT NULL,
  `id_test` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `question_products`
--

CREATE TABLE `question_products` (
  `id` int(11) NOT NULL,
  `question` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `answer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `request_exports`
--

CREATE TABLE `request_exports` (
  `id` int(11) NOT NULL,
  `avatar` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `birthday` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `affiliate_phone` varchar(15) DEFAULT NULL,
  `link_download` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `status_pay` varchar(255) NOT NULL DEFAULT 'wait',
  `idMessenger` varchar(255) DEFAULT NULL,
  `idZalo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_customer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `seting_theme_infos`
--

CREATE TABLE `seting_theme_infos` (
  `id` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_theme` int(11) NOT NULL,
  `config` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slugs`
--

CREATE TABLE `slugs` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `controller` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tests`
--

CREATE TABLE `tests` (
  `id` int(11) NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `time_test` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `id_lesson` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `time_start` int(11) NOT NULL,
  `time_end` int(11) NOT NULL,
  `id_course` int(11) DEFAULT NULL,
  `point_min` float NOT NULL DEFAULT 10
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `token_devices`
--

CREATE TABLE `token_devices` (
  `id` int(11) NOT NULL,
  `token_device` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `id_member` int(11) NOT NULL DEFAULT 0,
  `id_customer` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `transaction_affiliate_histories`
--

CREATE TABLE `transaction_affiliate_histories` (
  `id` int(11) NOT NULL,
  `id_affiliater` int(11) NOT NULL,
  `money_total` int(11) NOT NULL,
  `money_back` int(11) NOT NULL,
  `percent` float NOT NULL,
  `id_order` int(11) NOT NULL,
  `create_at` int(11) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'new',
  `id_member` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `transaction_histories`
--

CREATE TABLE `transaction_histories` (
  `id` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `coin` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `note` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `create_at` int(11) NOT NULL,
  `id_system` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `unit_conversions`
--

CREATE TABLE `unit_conversions` (
  `id` int(11) NOT NULL,
  `unit` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `id_product` int(11) NOT NULL DEFAULT 0,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `price` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `id_category` int(11) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `time_create` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `author` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `youtube_code` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `views`
--

CREATE TABLE `views` (
  `id` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `warehouse_histories`
--

CREATE TABLE `warehouse_histories` (
  `id` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `note` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `create_at` int(11) NOT NULL,
  `type` varchar(20) NOT NULL COMMENT 'plus hoặc minus',
  `id_order_member` int(11) NOT NULL DEFAULT 0,
  `id_order` int(11) NOT NULL DEFAULT 0 COMMENT 'id đơn hàng khách lẻ'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `warehouse_products`
--

CREATE TABLE `warehouse_products` (
  `id` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `zalos`
--

CREATE TABLE `zalos` (
  `id` int(11) NOT NULL,
  `id_oa` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `id_app` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `secret_key` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `oauth_code` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `access_token` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `refresh_token` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `deadline` int(11) DEFAULT NULL,
  `id_system` int(11) NOT NULL,
  `template_otp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `zalo_templates`
--

CREATE TABLE `zalo_templates` (
  `id` int(11) NOT NULL,
  `id_system` int(11) NOT NULL,
  `id_zns` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`content`)),
  `content_example` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `affiliaters`
--
ALTER TABLE `affiliaters`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `albuminfos`
--
ALTER TABLE `albuminfos`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `campaign_customers`
--
ALTER TABLE `campaign_customers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categorie_products`
--
ALTER TABLE `categorie_products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category_connects`
--
ALTER TABLE `category_connects`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `customer_histories`
--
ALTER TABLE `customer_histories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `debts`
--
ALTER TABLE `debts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `discount_codes`
--
ALTER TABLE `discount_codes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `discount_product_agencys`
--
ALTER TABLE `discount_product_agencys`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `documentinfos`
--
ALTER TABLE `documentinfos`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `evaluates`
--
ALTER TABLE `evaluates`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `historytests`
--
ALTER TABLE `historytests`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `link_infos`
--
ALTER TABLE `link_infos`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `member_webs`
--
ALTER TABLE `member_webs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_members`
--
ALTER TABLE `order_members`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_member_details`
--
ALTER TABLE `order_member_details`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `question_products`
--
ALTER TABLE `question_products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `request_exports`
--
ALTER TABLE `request_exports`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `seting_theme_infos`
--
ALTER TABLE `seting_theme_infos`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `slugs`
--
ALTER TABLE `slugs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `token_devices`
--
ALTER TABLE `token_devices`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `transaction_affiliate_histories`
--
ALTER TABLE `transaction_affiliate_histories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `transaction_histories`
--
ALTER TABLE `transaction_histories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `unit_conversions`
--
ALTER TABLE `unit_conversions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `warehouse_histories`
--
ALTER TABLE `warehouse_histories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `warehouse_products`
--
ALTER TABLE `warehouse_products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `zalos`
--
ALTER TABLE `zalos`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `zalo_templates`
--
ALTER TABLE `zalo_templates`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `affiliaters`
--
ALTER TABLE `affiliaters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `albuminfos`
--
ALTER TABLE `albuminfos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `campaign_customers`
--
ALTER TABLE `campaign_customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `categorie_products`
--
ALTER TABLE `categorie_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `category_connects`
--
ALTER TABLE `category_connects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `customer_histories`
--
ALTER TABLE `customer_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `debts`
--
ALTER TABLE `debts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `discount_codes`
--
ALTER TABLE `discount_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `discount_product_agencys`
--
ALTER TABLE `discount_product_agencys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `documentinfos`
--
ALTER TABLE `documentinfos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `evaluates`
--
ALTER TABLE `evaluates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `historytests`
--
ALTER TABLE `historytests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `link_infos`
--
ALTER TABLE `link_infos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `member_webs`
--
ALTER TABLE `member_webs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `order_members`
--
ALTER TABLE `order_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `order_member_details`
--
ALTER TABLE `order_member_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `question_products`
--
ALTER TABLE `question_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `request_exports`
--
ALTER TABLE `request_exports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `seting_theme_infos`
--
ALTER TABLE `seting_theme_infos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `slugs`
--
ALTER TABLE `slugs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `token_devices`
--
ALTER TABLE `token_devices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `transaction_affiliate_histories`
--
ALTER TABLE `transaction_affiliate_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `transaction_histories`
--
ALTER TABLE `transaction_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `unit_conversions`
--
ALTER TABLE `unit_conversions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `views`
--
ALTER TABLE `views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `warehouse_histories`
--
ALTER TABLE `warehouse_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `warehouse_products`
--
ALTER TABLE `warehouse_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `zalos`
--
ALTER TABLE `zalos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `zalo_templates`
--
ALTER TABLE `zalo_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
