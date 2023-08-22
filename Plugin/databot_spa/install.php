<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';

$sqlInstallDatabase .= 'CREATE TABLE `beds` (
  `id` int(11) NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_spa` int(11) NOT NULL,
  `id_room` int(11) NOT NULL
) ENGINE=InnoDB;';

$sqlInstallDatabase .= "CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_member` int(11) NOT NULL,
  `id_group` int(11) DEFAULT NULL,
  `id_customers` int(11) NOT NULL,
  `id_service` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `created_book` int(11) NOT NULL,
  `id_staff` int(11) DEFAULT NULL,
  `type` text DEFAULT NULL COMMENT 'kiểu đặt (0 Mặc định, 1  Lịch chăm sóc, 2 Lịch liệu trình,  3Lịch điều trị)',
  `status` int(4) DEFAULT NULL COMMENT '0: Chưa xác nhận, 1: Xác nhận, 2:Không đến,  3:Hủy, 4:Đã đến , 5:Đặt online.',
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apt_step` int(11) DEFAULT NULL,
  `apt_times` int(11) DEFAULT NULL,
  `id_spa` int(11) DEFAULT NULL
) ENGINE=InnoDB; ";

$sqlInstallDatabase .= "CREATE TABLE `combos` (
  `id` int(11) NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `service` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` VARCHAR(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `id_member` int(11) NOT NULL,
  `id_spa` int(11) NOT NULL,
  `commission_staff_fix` INT NOT NULL DEFAULT '0',
  `commission_staff_percent` INT NOT NULL DEFAULT '0',
  `use_time` INT NOT NULL DEFAULT '0',
  `image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `customers` (
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_spa` int(11) NOT NULL,
  `phone` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `sex` tinyint(4) NOT NULL,
  `id` int(11) NOT NULL,
  `avatar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cmnd` int(12) DEFAULT NULL,
  `link_facebook` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_staff` int(11) DEFAULT NULL,
  `source` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Nguồn khách hàng',
  `id_group` int(11) DEFAULT NULL,
  `id_service` int(11) DEFAULT NULL,
  `medical_history` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `drug_allergy_history` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `request_current` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `advisory` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `advise_towards` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `customer_groups` (
  `id` int(11) NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_member` int(11) NOT NULL
) ENGINE=InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1 : members, 0: nhân viên ',
  `id_group` int(11) DEFAULT NULL,
  `id_member` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `dateline_at` datetime DEFAULT NULL,
  `number_spa` int(11) DEFAULT NULL,
  `birthday` varchar(255) DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_otp` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB;";

$sqlInstallDatabase .= "CREATE TABLE `prepay_cards` (
  `id` int(11) NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` INT(11) NOT NULL DEFAULT '0',
  `price_sell` INT(11) NOT NULL DEFAULT '0',
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `use_time` int(11) DEFAULT NULL,
  `id_member` int(11) NOT NULL,
  `id_spa` int(11) NOT NULL,
  `status` VARCHAR(20) NOT NULL,
  `commission_staff_fix` INT NOT NULL DEFAULT '0',
  `commission_staff_percent` INT NOT NULL DEFAULT '0',
) ENGINE=InnoDB;";

$sqlInstallDatabase .= "CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_category` int(11) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `info` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `quantity` INT NOT NULL DEFAULT '0',
  `id_trademark` int(11) NOT NULL,
  `status` VARCHAR(20) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `view` int(11) DEFAULT NULL,
  `id_member` int(11) NOT NULL,
  `id_spa` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `commission_staff_fix` INT NOT NULL DEFAULT '0',
  `commission_staff_percent` INT NOT NULL DEFAULT '0',
  `commission_affiliate_fix` INT NOT NULL DEFAULT '0',
  `commission_affiliate_percent` INT NOT NULL DEFAULT '0'
) ENGINE=InnoDB;";

$sqlInstallDatabase .= "CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `id_member` int(11) NOT NULL,
  `id_spa` int(11) NOT NULL
) ENGINE=InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `services` (
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_category` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_spa` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `duration` int(11) DEFAULT NULL COMMENT 'thời lương ',
  `slug` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id` int(11) NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `commission_staff_fix` INT NOT NULL DEFAULT '0',
  `commission_staff_percent` INT NOT NULL DEFAULT '0',
  `commission_affiliate_fix` INT NOT NULL DEFAULT '0',
  `commission_affiliate_percent` INT NOT NULL DEFAULT '0'
) ENGINE=InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `spas` (
  `id` int(11) NOT NULL,
  `name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id_member` int(11) NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `facebook` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `website` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `zalo` VARCHAR(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NULL
) ENGINE=InnoDB;
";

$sqlInstallDatabase .="CREATE TABLE `trademarks` (
  `id` int(11) NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `id_member` int(11) NOT NULL,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `warehouses` (
  `id` int(11) NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `credit` int(11) DEFAULT NULL,
  `id_member` int(11) NOT NULL,
  `id_spa` int(11) NOT NULL
) ENGINE=InnoDB;";



$sqlDeleteDatabase .= "DROP TABLE beds; ";
$sqlDeleteDatabase .= "DROP TABLE books; ";
$sqlDeleteDatabase .= "DROP TABLE combos; ";
$sqlDeleteDatabase .= "DROP TABLE customers; ";
$sqlDeleteDatabase .= "DROP TABLE customer_groups; ";
$sqlDeleteDatabase .= "DROP TABLE members; ";
$sqlDeleteDatabase .= "DROP TABLE prepay_cards; ";
$sqlDeleteDatabase .= "DROP TABLE products; ";
$sqlDeleteDatabase .= "DROP TABLE rooms; ";
$sqlDeleteDatabase .= "DROP TABLE services; ";
$sqlDeleteDatabase .= "DROP TABLE spas; ";
$sqlDeleteDatabase .= "DROP TABLE trademarks; ";
$sqlDeleteDatabase .= "DROP TABLE warehouses; ";

$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='category_customer'; ";
$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='category_source_customer'; ";

//$sqlDeleteDatabase .= "DELETE FROM `options` WHERE `key_word`='settingTraining2TOPCRM'; ";

?>