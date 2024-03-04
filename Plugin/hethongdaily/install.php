<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';

$sqlInstallDatabase .= "CREATE TABLE `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `avatar` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) NOT NULL,
  `id_father` int(11) NOT NULL COMMENT 'id member cha',
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `id_system` int(11) NOT NULL,
  `otp` int(11) DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `deadline` int(11) NOT NULL,
  `verify` varchar(255) NOT NULL DEFAULT 'lock',
  `birthday` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_position` int(11) NOT NULL DEFAULT 0,
  `create_agency` VARCHAR(255) NOT NULL DEFAULT 'active',
  `coin` INT NOT NULL DEFAULT '0',
  `twitter` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci  NULL,
  `tiktok` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci  NULL,
  `youtube` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci  NULL,
  `web` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci  NULL,
  `linkedin` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci  NULL,
  `description` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci  NULL,
  `zalo` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci  NULL,
  `view` INT NOT NULL DEFAULT '0',
  `banner` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";




$sqlInstallDatabase .= "CREATE TABLE `zalos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_oa` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id_app` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `secret_key` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `oauth_code` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `access_token` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `refresh_token` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `deadline` int(11) DEFAULT NULL,
  `id_system` int(11) NOT NULL,
  `template_otp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sqlInstallDatabase .= "CREATE TABLE `transaction_histories` ( `id` INT NOT NULL AUTO_INCREMENT , `id_member` INT NOT NULL , `coin` INT NOT NULL , `type` VARCHAR(255) NOT NULL , `note` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `create_at` INT NOT NULL , `id_system` INT NOT NULL, PRIMARY KEY (`id`)) ENGINE = InnoDB; ";

$sqlInstallDatabase .= "CREATE TABLE `customers` ( 
  `id` INT NOT NULL AUTO_INCREMENT , 
  `full_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
  `phone` VARCHAR(255) NOT NULL , 
  `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
  `address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
  `sex` BOOLEAN NOT NULL , 
  `id_city` TINYINT NOT NULL , 
  `id_messenger` VARCHAR(255) NOT NULL, 
  `avatar` TEXT NOT NULL, 
  `status` VARCHAR(255) NOT NULL , 
  `pass` VARCHAR(255) NOT NULL , 
  `id_parent` INT(11) NOT NULL DEFAULT '0' COMMENT 'id member đại lý',
  `id_level` INT NOT NULL DEFAULT '0' , 
  `birthday_date` INT NOT NULL , 
  `birthday_month` INT NOT NULL , 
  `birthday_year` INT NOT NULL , 
  `id_aff` INT NOT NULL DEFAULT '0' COMMENT 'id người tiếp thị liên kết',
  PRIMARY KEY (`id`)
) ENGINE = InnoDB; ";

$sqlInstallDatabase .= "CREATE TABLE `customer_histories` ( 
  `id` INT NOT NULL AUTO_INCREMENT , 
  `id_customer` INT NOT NULL , 
  `time_now` INT NOT NULL , 
  `note_now` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
  `action_now` VARCHAR(255) NOT NULL , 
  `id_staff_now` INT NOT NULL , 
  `status` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'new',
  PRIMARY KEY (`id`)
) ENGINE = InnoDB; ";

$sqlInstallDatabase .= "CREATE TABLE `order_members` (
  `id` INT NOT NULL AUTO_INCREMENT , 
  `id_member_sell` INT NOT NULL COMMENT 'id đại lý tuyến trên' , 
  `id_member_buy` INT NOT NULL COMMENT 'id đại lý tuyến dưới đặt mua' , 
  `note_sell` VARCHAR(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL COMMENT 'ghi chú người bán' , 
  `note_buy` VARCHAR(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL COMMENT 'ghi chú người mua' , 
  `status` VARCHAR(100) NOT NULL DEFAULT 'new' , 
  `create_at` INT NOT NULL , 
  `money` INT NOT NULL DEFAULT '0' COMMENT 'tổng tiền gốc đơn hàng' , 
  `total` INT NOT NULL DEFAULT '0' COMMENT 'tổng tiền sau chiết khấu' , 
  `status_pay` VARCHAR(100) NOT NULL DEFAULT 'wait' COMMENT 'trạng thái thanh toán' , 
  `discount` DOUBLE NOT NULL DEFAULT '0' COMMENT 'phần trăm chiết khấu',
  PRIMARY KEY (`id`)
) ENGINE = InnoDB; ";

$sqlInstallDatabase .= "CREATE TABLE `order_member_details` (
  `id` INT NOT NULL AUTO_INCREMENT , 
  `id_product` INT NOT NULL , 
  `id_order_member` INT NOT NULL , 
  `quantity` INT NOT NULL , 
  `price` INT NOT NULL , 
  PRIMARY KEY (`id`)
) ENGINE = InnoDB; ";

$sqlInstallDatabase .= "CREATE TABLE `warehouse_products` (
  `id` INT NOT NULL AUTO_INCREMENT , 
  `id_member` INT NOT NULL , 
  `id_product` INT NOT NULL , 
  `quantity` INT NOT NULL DEFAULT '0' , 
  PRIMARY KEY (`id`)
) ENGINE = InnoDB; ";

$sqlInstallDatabase .= "CREATE TABLE `warehouse_histories` (
  `id` INT NOT NULL AUTO_INCREMENT , 
  `id_member` INT NOT NULL , 
  `id_product` INT NOT NULL , 
  `note` VARCHAR(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL , 
  `quantity` INT NOT NULL DEFAULT '0' , 
  `create_at` INT NOT NULL , 
  `type` VARCHAR(20) NOT NULL COMMENT 'plus hoặc minus' , 
  `id_order_member` INT NOT NULL DEFAULT '0',
  `id_order` INT NOT NULL DEFAULT '0' COMMENT 'id đơn hàng khách lẻ',
  PRIMARY KEY (`id`)
) ENGINE = InnoDB; ";

$sqlDeleteDatabase .= "DROP TABLE members; ";
$sqlDeleteDatabase .= "DROP TABLE zalos; ";
$sqlDeleteDatabase .= "DROP TABLE transaction_histories; ";
$sqlDeleteDatabase .= "DROP TABLE customers; ";
$sqlDeleteDatabase .= "DROP TABLE customer_histories; ";
$sqlDeleteDatabase .= "DROP TABLE order_members; ";
$sqlDeleteDatabase .= "DROP TABLE order_member_details; ";
$sqlDeleteDatabase .= "DROP TABLE warehouse_products; ";
$sqlDeleteDatabase .= "DROP TABLE warehouse_histories; ";

$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='system_sales'; ";
$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='system_positions'; ";
