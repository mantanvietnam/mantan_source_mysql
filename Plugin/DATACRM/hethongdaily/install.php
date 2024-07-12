<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;
global $sqlFixDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];
$sqlFixDatabase = '';

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
  `instagram` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `token_device` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `token` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_login` INT NOT NULL DEFAULT '0',
  `portrait` VARCHAR(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL COMMENT 'ảnh chân dung',
  `create_order_agency` BOOLEAN NOT NULL DEFAULT FALSE COMMENT '1: được phép tạo đơn đại lý tuyến dưới, 0: không được phép tạo',
  `img_card_member` VARCHAR(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL,
  `img_logo` VARCHAR(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL,
  `noti_new_order` BOOLEAN NOT NULL DEFAULT TRUE,
  `noti_new_customer` BOOLEAN NOT NULL DEFAULT TRUE,
  `noti_checkin_campaign` BOOLEAN NOT NULL DEFAULT TRUE,
  `noti_reg_campaign` BOOLEAN NOT NULL DEFAULT TRUE,
  `noti_product_warehouse` BOOLEAN NOT NULL DEFAULT TRUE,
  `display_info` TINYINT NOT NULL DEFAULT '1',
  `image_qr_pay`text CHARACTER SET utf8 COLLATE utf8_unicode_ci  NULL,
  `bank_name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `bank_number` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `bank_code` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `list_theme_info` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  NOT NULL DEFAULT '1',
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

$sqlInstallDatabase .= "CREATE TABLE `transaction_histories` ( 
  `id` INT NOT NULL AUTO_INCREMENT , 
  `id_member` INT NOT NULL , 
  `coin` INT NOT NULL , 
  `type` VARCHAR(255) NOT NULL , 
  `note` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `create_at` INT NOT NULL , 
  `id_system` INT NOT NULL, 
  PRIMARY KEY (`id`)
) ENGINE = InnoDB; ";

$sqlInstallDatabase .= "CREATE TABLE `customers` ( 
  `id` INT NOT NULL AUTO_INCREMENT , 
  `full_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
  `phone` VARCHAR(255) NOT NULL , 
  `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
  `address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
  `sex` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '0: Nữ, 1: Nam' , 
  `id_city` TINYINT(4) NOT NULL DEFAULT '0' , 
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
  `created_at` INT NOT NULL,
  `id_group` INT NOT NULL DEFAULT '0',
  `facebook` VARCHAR(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL,
  `id_zalo` VARCHAR(100) NULL,
  `token_device` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `token` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `reset_password_code`INT NULL DEFAULT NULL,
  `link_download_mmtc` VARCHAR(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NULL,
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
  `money` BIGINT(11) NOT NULL DEFAULT '0' COMMENT 'tổng tiền gốc đơn hàng',
  `total` BIGINT(11) NOT NULL DEFAULT '0' COMMENT 'tổng tiền sau chiết khấu',
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
  `discount` INT NOT NULL DEFAULT '0' COMMENT 'phần trăm chiết khấu',
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

$sqlInstallDatabase .="CREATE TABLE `zalo_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_system` int(11) NOT NULL,
  `id_zns` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`content`)),
  `content_example` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sqlInstallDatabase .= "CREATE TABLE `token_devices` (
  `id` INT NOT NULL AUTO_INCREMENT , 
  `token_device` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL , 
  `id_member` INT NOT NULL DEFAULT '0' , 
  `id_customer` INT NOT NULL DEFAULT '0' , 
  PRIMARY KEY (`id`)
) ENGINE = InnoDB; ";

$sqlInstallDatabase .="CREATE TABLE `documents` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
  `type` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
  `image` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
  `id_parent` INT NOT NULL , 
  `status` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
  `content` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
  `slug` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
  `description` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
  `public` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT DEFAULT 'public' , 
  `created_at` INT NOT NULL ,
   PRIMARY KEY (`id`)
 ) ENGINE = InnoDB;";

 $sqlInstallDatabase .="CREATE TABLE `documentinfos` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
  `file` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
  `status` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
  `description` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
  `slug` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
  `id_document` INT NOT NULL , 
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `bills` (
  `id` INT NOT NULL AUTO_INCREMENT , 
  `id_member_sell` INT NOT NULL , 
  `id_member_buy` INT NOT NULL DEFAULT '0' , 
  `total` INT NOT NULL DEFAULT '0' , 
  `id_order` INT NOT NULL DEFAULT '0' , 
  `type` INT NOT NULL COMMENT '1: phiếu thu, 2 phiếu chi' , 
  `type_order` INT NULL DEFAULT '0' COMMENT '3: tự tạo, 1: đại lý, 2: khách hàng' , 
  `created_at` INT NULL DEFAULT NULL , 
  `updated_at` INT NULL DEFAULT NULL ,
  `type_collection_bill` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
  `id_customer` INT NOT NULL DEFAULT '0' , 
  `id_debt` INT NOT NULL DEFAULT '0' , 
  `note` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
   PRIMARY KEY (`id`)
 ) ENGINE = InnoDB;";

 $sqlInstallDatabase .="CREATE TABLE `debts` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `id_member_sell` INT NOT NULL ,
  `id_member_buy` INT NOT NULL DEFAULT '0' ,
  `total` INT NOT NULL DEFAULT '0' ,
  `total_payment` INT NOT NULL DEFAULT '0' ,
  `number_payment` INT NOT NULL DEFAULT '0' ,
  `type` INT NOT NULL DEFAULT '0' COMMENT '1: Nợ phải thu, 2: Nợ Phải trả, ' ,
  `status` INT NOT NULL COMMENT '0 : chưa trả ,1 đã trả hết' ,
  `type_order` INT NOT NULL COMMENT '3: tự tạo, 1: đại lý, 2: khách hàng' ,
  `id_customer` INT NOT NULL DEFAULT '0' ,
  `note` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
  `created_at` INT NULL DEFAULT NULL ,
  `updated_at` INT NULL DEFAULT NULL ,
  `id_order` INT NOT NULL DEFAULT '0' ,
   PRIMARY KEY (`id`)
 ) ENGINE = InnoDB;";
 
$sqlInstallDatabase .="CREATE TABLE `discount_product_agencys` (
`id` INT NOT NULL AUTO_INCREMENT ,
`id_product` INT NOT NULL ,
`id_member_sell` INT NOT NULL COMMENT 'id đại lý tuyến trên' , 
`id_member_buy` INT NOT NULL COMMENT 'id đại lý tuyến dưới đặt mua' , 
`discount` INT NOT NULL DEFAULT '0' ,
 PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `seting_theme_infos` (
`id` INT NOT NULL AUTO_INCREMENT ,
`id_member` INT NOT NULL ,
`id_theme` INT NOT NULL ,
`config` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
 PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `link_infos` (
`id` INT NOT NULL AUTO_INCREMENT ,
`id_member` INT NOT NULL ,
`type` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`link` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`description` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`namelink` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
 PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlDeleteDatabase .= "DROP TABLE members; ";
$sqlDeleteDatabase .= "DROP TABLE zalos; ";
$sqlDeleteDatabase .= "DROP TABLE transaction_histories; ";
$sqlDeleteDatabase .= "DROP TABLE customers; ";
$sqlDeleteDatabase .= "DROP TABLE customer_histories; ";
$sqlDeleteDatabase .= "DROP TABLE order_members; ";
$sqlDeleteDatabase .= "DROP TABLE order_member_details; ";
$sqlDeleteDatabase .= "DROP TABLE warehouse_products; ";
$sqlDeleteDatabase .= "DROP TABLE warehouse_histories; ";
$sqlDeleteDatabase .= "DROP TABLE token_devices; ";
$sqlDeleteDatabase .= "DROP TABLE zalo_templates; ";
$sqlDeleteDatabase .= "DROP TABLE documents; ";
$sqlDeleteDatabase .= "DROP TABLE documentinfos; ";
$sqlDeleteDatabase .= "DROP TABLE debts; ";
$sqlDeleteDatabase .= "DROP TABLE bills; ";
$sqlDeleteDatabase .= "DROP TABLE discount_product_agencys; ";
$sqlDeleteDatabase .= "DROP TABLE seting_theme_infos; ";
$sqlDeleteDatabase .= "DROP TABLE link_infos; ";

$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='system_sales'; ";
$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='system_positions'; ";

// sửa lỗi
//$sqlFixDatabase .= "ALTER TABLE `order_members` CHANGE `money` `money` BIGINT(11) NOT NULL DEFAULT '0' COMMENT 'tổng tiền gốc đơn hàng'; ";
//$sqlFixDatabase .= "ALTER TABLE `order_members` CHANGE `total` `total` BIGINT(11) NOT NULL DEFAULT '0' COMMENT 'tổng tiền sau chiết khấu'; ";
//$sqlFixDatabase .= "UPDATE `options` SET `value` = '[\"hethongdaily\",\"order_system\",\"order_customer\",\"zalo_zns\",\"training\",\"customer\",\"campaign\",\"clone_web\",\"affiliate\",\"document\",\"cashBook\"]' WHERE `options`.`key_word` = 'crm_module'; ";
//$sqlFixDatabase .= "UPDATE `options` SET `value` = '{\"userAPI\":\"admin\",\"passAPI\":\"Mmtc123!\",\"maxExport\":3,\"numberExport\":0,\"price\":0,\"note_pay\":\"\",\"number_bank\":\"\",\"account_bank\":\"\",\"key_bank\":\"\",\"idBot\":\"\",\"tokenBot\":\"\",\"idBlockConfirm\":\"\",\"idBlockDownload\":\"\"}' WHERE `options`.`key_word` = 'settingMMTCAPI'; ";

// update
$sqlUpdateDatabase['members']['name'] = "ALTER TABLE `members` ADD `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ;";
$sqlUpdateDatabase['members']['avatar'] = "ALTER TABLE `members` ADD `avatar` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;";
$sqlUpdateDatabase['members']['phone'] = "ALTER TABLE `members` ADD `phone` varchar(15) NOT NULL;";
$sqlUpdateDatabase['members']['id_father'] = "ALTER TABLE `members` ADD `id_father` int(11) NOT NULL COMMENT 'id member cha';";
$sqlUpdateDatabase['members']['email'] = "ALTER TABLE `members` ADD `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;";
$sqlUpdateDatabase['members']['password'] = "ALTER TABLE `members` ADD `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;";
$sqlUpdateDatabase['members']['status'] = "ALTER TABLE `members` ADD `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;";
$sqlUpdateDatabase['members']['created_at'] = "ALTER TABLE `members` ADD `created_at` int(11) NOT NULL;";
$sqlUpdateDatabase['members']['id_system'] = "ALTER TABLE `members` ADD `id_system` int(11) NOT NULL;";
$sqlUpdateDatabase['members']['otp'] = "ALTER TABLE `members` ADD `otp` int(11) DEFAULT NULL;";
$sqlUpdateDatabase['members']['address'] = "ALTER TABLE `members` ADD `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;";
$sqlUpdateDatabase['members']['deadline'] = "ALTER TABLE `members` ADD `deadline` int(11) NOT NULL;";
$sqlUpdateDatabase['members']['verify'] = "ALTER TABLE `members` ADD `verify` varchar(255) NOT NULL DEFAULT 'lock';";
$sqlUpdateDatabase['members']['birthday'] = "ALTER TABLE `members` ADD `birthday` varchar(255) DEFAULT NULL;";
$sqlUpdateDatabase['members']['facebook'] = "ALTER TABLE `members` ADD `facebook` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL;";
$sqlUpdateDatabase['members']['id_position'] = "ALTER TABLE `members` ADD `id_position` int(11) NOT NULL DEFAULT 0;";
$sqlUpdateDatabase['members']['create_agency'] = "ALTER TABLE `members` ADD `create_agency` VARCHAR(255) NOT NULL DEFAULT 'active';";
$sqlUpdateDatabase['members']['coin'] = "ALTER TABLE `members` ADD `coin` INT NOT NULL DEFAULT '0';";
$sqlUpdateDatabase['members']['twitter'] = "ALTER TABLE `members` ADD `twitter` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci  NULL;";
$sqlUpdateDatabase['members']['tiktok'] = "ALTER TABLE `members` ADD `tiktok` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci  NULL;";
$sqlUpdateDatabase['members']['youtube'] = "ALTER TABLE `members` ADD `youtube` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci  NULL;";
$sqlUpdateDatabase['members']['web'] = "ALTER TABLE `members` ADD `web` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci  NULL;";
$sqlUpdateDatabase['members']['linkedin'] = "ALTER TABLE `members` ADD `linkedin` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci  NULL;";
$sqlUpdateDatabase['members']['description'] = "ALTER TABLE `members` ADD `description` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci  NULL;";
$sqlUpdateDatabase['members']['zalo'] = "ALTER TABLE `members` ADD `zalo` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci  NULL;";
$sqlUpdateDatabase['members']['view'] = "ALTER TABLE `members` ADD `view` INT NOT NULL DEFAULT '0';";
$sqlUpdateDatabase['members']['banner'] = "ALTER TABLE `members` ADD `banner` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL;";
$sqlUpdateDatabase['members']['instagram'] = "ALTER TABLE `members` ADD `instagram` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL;";
$sqlUpdateDatabase['members']['token_device'] = "ALTER TABLE `members` ADD `token_device` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;";
$sqlUpdateDatabase['members']['token'] = "ALTER TABLE `members` ADD `token` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;";
$sqlUpdateDatabase['members']['last_login'] = "ALTER TABLE `members` ADD `last_login` INT NOT NULL DEFAULT '0';";
$sqlUpdateDatabase['members']['portrait'] = "ALTER TABLE `members` ADD `portrait` VARCHAR(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL COMMENT 'ảnh chân dung';";
$sqlUpdateDatabase['members']['create_order_agency'] = "ALTER TABLE `members` ADD `create_order_agency` BOOLEAN NOT NULL DEFAULT FALSE COMMENT '1: được phép tạo đơn đại lý tuyến dưới, 0: không được phép tạo';";
$sqlUpdateDatabase['members']['img_card_member'] = "ALTER TABLE `members` ADD `img_card_member` VARCHAR(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL;";
$sqlUpdateDatabase['members']['img_logo'] = "ALTER TABLE `members` ADD `img_logo` VARCHAR(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL;";
$sqlUpdateDatabase['members']['noti_new_order'] = "ALTER TABLE `members` ADD `noti_new_order` BOOLEAN NOT NULL DEFAULT TRUE;";
$sqlUpdateDatabase['members']['noti_new_customer'] = "ALTER TABLE `members` ADD `noti_new_customer` BOOLEAN NOT NULL DEFAULT TRUE;";
$sqlUpdateDatabase['members']['noti_checkin_campaign'] = "ALTER TABLE `members` ADD `noti_checkin_campaign` BOOLEAN NOT NULL DEFAULT TRUE;";
$sqlUpdateDatabase['members']['noti_reg_campaign'] = "ALTER TABLE `members` ADD `noti_reg_campaign` BOOLEAN NOT NULL DEFAULT TRUE;";
$sqlUpdateDatabase['members']['noti_product_warehouse'] = "ALTER TABLE `members` ADD `noti_product_warehouse` BOOLEAN NOT NULL DEFAULT TRUE;";
$sqlUpdateDatabase['members']['display_info'] = "ALTER TABLE `members` ADD `display_info` TINYINT NOT NULL DEFAULT '1';";
$sqlUpdateDatabase['members']['image_qr_pay'] = "ALTER TABLE `members` ADD `image_qr_pay` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ;";
$sqlUpdateDatabase['members']['bank_name'] = "ALTER TABLE `members` ADD `bank_name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;";
$sqlUpdateDatabase['members']['bank_number'] = "ALTER TABLE `members` ADD `bank_number` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['members']['bank_code'] = "ALTER TABLE `members` ADD `bank_code` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;";
$sqlUpdateDatabase['members']['list_theme_info'] = "ALTER TABLE `members` ADD `list_theme_info` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  NOT NULL DEFAULT '1';";

// bảng zalos 
$sqlUpdateDatabase['zalos']['id_oa'] = "ALTER TABLE `zalos` ADD `id_oa` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;";
$sqlUpdateDatabase['zalos']['id_app'] = "ALTER TABLE `zalos` ADD `id_app` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;";
$sqlUpdateDatabase['zalos']['secret_key'] = "ALTER TABLE `zalos` ADD `secret_key` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;";
$sqlUpdateDatabase['zalos']['oauth_code'] = "ALTER TABLE `zalos` ADD `oauth_code` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL;";
$sqlUpdateDatabase['zalos']['access_token'] = "ALTER TABLE `zalos` ADD `access_token` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL;";
$sqlUpdateDatabase['zalos']['refresh_token'] = "ALTER TABLE `zalos` ADD `refresh_token` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL;";
$sqlUpdateDatabase['zalos']['deadline'] = "ALTER TABLE `zalos` ADD `deadline` int(11) DEFAULT NULL;";
$sqlUpdateDatabase['zalos']['id_system'] = "ALTER TABLE `zalos` ADD `id_system` int(11) NOT NULL;";
$sqlUpdateDatabase['zalos']['template_otp'] = "ALTER TABLE `zalos` ADD `template_otp` int(11) NOT NULL;";

// bảng transaction_histories
$sqlUpdateDatabase['transaction_histories']['id_member'] = "ALTER TABLE `transaction_histories` ADD `id_member` INT NOT NULL;";
$sqlUpdateDatabase['transaction_histories']['coin'] = "ALTER TABLE `transaction_histories` ADD `coin` INT NOT NULL;";
$sqlUpdateDatabase['transaction_histories']['type'] = "ALTER TABLE `transaction_histories` ADD `type` VARCHAR(255) NOT NULL;";
$sqlUpdateDatabase['transaction_histories']['note'] = "ALTER TABLE `transaction_histories` ADD `note` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;";
$sqlUpdateDatabase['transaction_histories']['create_at'] = "ALTER TABLE `transaction_histories` ADD `create_at` INT NOT NULL;";
$sqlUpdateDatabase['transaction_histories']['id_system'] = "ALTER TABLE `transaction_histories` ADD `id_system` INT NOT NULL;";

// bảng customers
$sqlUpdateDatabase['customers']['full_name'] = "ALTER TABLE `customers` ADD `full_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL;";
$sqlUpdateDatabase['customers']['phone'] = "ALTER TABLE `customers` ADD `phone` VARCHAR(255) NOT NULL;";
$sqlUpdateDatabase['customers']['email'] = "ALTER TABLE `customers` ADD `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL;";
$sqlUpdateDatabase['customers']['address'] = "ALTER TABLE `customers` ADD `address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL;";
$sqlUpdateDatabase['customers']['sex'] = "ALTER TABLE `customers` ADD `sex` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '0: Nữ, 1: Nam';";
$sqlUpdateDatabase['customers']['id_city'] = "ALTER TABLE `customers` ADD `id_city` TINYINT(4) NOT NULL DEFAULT '0';";
$sqlUpdateDatabase['customers']['id_messenger'] = "ALTER TABLE `customers` ADD `id_messenger` VARCHAR(255) NOT NULL;";
$sqlUpdateDatabase['customers']['avatar'] = "ALTER TABLE `customers` ADD `avatar` TEXT NOT NULL;";
$sqlUpdateDatabase['customers']['status'] = "ALTER TABLE `customers` ADD `status` VARCHAR(255) NOT NULL;";
$sqlUpdateDatabase['customers']['pass'] = "ALTER TABLE `customers` ADD `pass` VARCHAR(255) NOT NULL;";
$sqlUpdateDatabase['customers']['id_parent'] = "ALTER TABLE `customers` ADD `id_parent` INT(11) NOT NULL DEFAULT '0' COMMENT 'id member đại lý';";
$sqlUpdateDatabase['customers']['id_level'] = "ALTER TABLE `customers` ADD `id_level` INT NOT NULL DEFAULT '0';";
$sqlUpdateDatabase['customers']['birthday_date'] = "ALTER TABLE `customers` ADD `birthday_date` INT NOT NULL;";
$sqlUpdateDatabase['customers']['birthday_month'] = "ALTER TABLE `customers` ADD `birthday_month` INT NOT NULL;";
$sqlUpdateDatabase['customers']['birthday_year'] = "ALTER TABLE `customers` ADD `birthday_year` INT NOT NULL;";
$sqlUpdateDatabase['customers']['id_aff'] = "ALTER TABLE `customers` ADD `id_aff` INT NOT NULL DEFAULT '0' COMMENT 'id người tiếp thị liên kết';";
$sqlUpdateDatabase['customers']['created_at'] = "ALTER TABLE `customers` ADD `created_at` INT NOT NULL;";
$sqlUpdateDatabase['customers']['id_group'] = "ALTER TABLE `customers` ADD `id_group` INT NOT NULL DEFAULT '0';";
$sqlUpdateDatabase['customers']['facebook'] = "ALTER TABLE `customers` ADD `facebook` VARCHAR(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL;";
$sqlUpdateDatabase['customers']['id_zalo'] = "ALTER TABLE `customers` ADD `id_zalo` VARCHAR(100) NULL;";
$sqlUpdateDatabase['customers']['token_device'] = "ALTER TABLE `customers` ADD `token_device` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['customers']['token'] = "ALTER TABLE `customers` ADD `token` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['customers']['reset_password_code'] = "ALTER TABLE `customers` ADD `reset_password_code`INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['customers']['link_download_mmtc'] = "ALTER TABLE `customers` ADD `link_download_mmtc` VARCHAR(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NULL;";

// bảng customer_histories
$sqlUpdateDatabase['customer_histories']['id_customer'] = "ALTER TABLE `customer_histories` ADD `id_customer` INT NOT NULL;";
$sqlUpdateDatabase['customer_histories']['time_now'] = "ALTER TABLE `customer_histories` ADD `time_now` INT NOT NULL;";
$sqlUpdateDatabase['customer_histories']['note_now'] = "ALTER TABLE `customer_histories` ADD `note_now` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;";
$sqlUpdateDatabase['customer_histories']['action_now'] = "ALTER TABLE `customer_histories` ADD `action_now` VARCHAR(255) NOT NULL;";
$sqlUpdateDatabase['customer_histories']['id_staff_now'] = "ALTER TABLE `customer_histories` ADD `id_staff_now` INT NOT NULL;";
$sqlUpdateDatabase['customer_histories']['status'] = "ALTER TABLE `customer_histories` ADD `status` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'new';";

// bảng order_members
$sqlUpdateDatabase['order_members']['id_member_sell'] = "ALTER TABLE `order_members` ADD `id_member_sell` INT NOT NULL COMMENT 'id đại lý tuyến trên';";
$sqlUpdateDatabase['order_members']['id_member_buy'] = "ALTER TABLE `order_members` ADD `id_member_buy` INT NOT NULL COMMENT 'id đại lý tuyến dưới đặt mua' ;";
$sqlUpdateDatabase['order_members']['note_sell'] = "ALTER TABLE `order_members` ADD `note_sell` VARCHAR(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL COMMENT 'ghi chú người bán';";
$sqlUpdateDatabase['order_members']['note_buy'] = "ALTER TABLE `order_members` ADD `note_buy` VARCHAR(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL COMMENT 'ghi chú người mua' ;";
$sqlUpdateDatabase['order_members']['status'] = "ALTER TABLE `order_members` ADD `status` VARCHAR(100) NOT NULL DEFAULT 'new' ;";
$sqlUpdateDatabase['order_members']['create_at'] = "ALTER TABLE `order_members` ADD `create_at` INT NOT NULL;";
$sqlUpdateDatabase['order_members']['money'] = "ALTER TABLE `order_members` ADD `money` BIGINT(11) NOT NULL DEFAULT '0' COMMENT 'tổng tiền gốc đơn hàng';";
$sqlUpdateDatabase['order_members']['total'] = "ALTER TABLE `order_members` ADD `total` BIGINT(11) NOT NULL DEFAULT '0' COMMENT 'tổng tiền sau chiết khấu';";
$sqlUpdateDatabase['order_members']['status_pay'] = "ALTER TABLE `order_members` ADD `status_pay` VARCHAR(100) NOT NULL DEFAULT 'wait' COMMENT 'trạng thái thanh toán';";
$sqlUpdateDatabase['order_members']['discount'] = "ALTER TABLE `order_members` ADD `discount` DOUBLE NOT NULL DEFAULT '0' COMMENT 'phần trăm chiết khấu';";

// bảng order_member_details
$sqlUpdateDatabase['order_member_details']['id_product'] = "ALTER TABLE `order_member_details` ADD `id_product` INT NOT NULL;";
$sqlUpdateDatabase['order_member_details']['id_order_member'] = "ALTER TABLE `order_member_details` ADD `id_order_member` INT NOT NULL;";
$sqlUpdateDatabase['order_member_details']['quantity'] = "ALTER TABLE `order_member_details` ADD `quantity` INT NOT NULL;";
$sqlUpdateDatabase['order_member_details']['price'] = "ALTER TABLE `order_member_details` ADD `price` INT NOT NULL;";
$sqlUpdateDatabase['order_member_details']['discount'] = "ALTER TABLE `order_member_details` ADD `discount` INT NOT NULL DEFAULT '0' COMMENT 'phần trăm chiết khấu';";

// bảng warehouse_products
$sqlUpdateDatabase['warehouse_products']['id_member'] = "ALTER TABLE `warehouse_products` ADD `id_member` INT NOT NULL;";
$sqlUpdateDatabase['warehouse_products']['id_product'] = "ALTER TABLE `warehouse_products` ADD `id_product` INT NOT NULL;";
$sqlUpdateDatabase['warehouse_products']['quantity'] = "ALTER TABLE `warehouse_products` ADD `quantity` INT NOT NULL DEFAULT '0';";

// bảng warehouse_histories
$sqlUpdateDatabase['warehouse_histories']['id_member'] = "ALTER TABLE `warehouse_histories` ADD `id_member` INT NOT NULL;";
$sqlUpdateDatabase['warehouse_histories']['id_product'] = "ALTER TABLE `warehouse_histories` ADD `id_product` INT NOT NULL;";
$sqlUpdateDatabase['warehouse_histories']['note'] = "ALTER TABLE `warehouse_histories` ADD `note` VARCHAR(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL;";
$sqlUpdateDatabase['warehouse_histories']['quantity'] = "ALTER TABLE `warehouse_histories` ADD `quantity` INT NOT NULL DEFAULT '0';";
$sqlUpdateDatabase['warehouse_histories']['create_at'] = "ALTER TABLE `warehouse_histories` ADD `create_at` INT NOT NULL;";
$sqlUpdateDatabase['warehouse_histories']['type'] = "ALTER TABLE `warehouse_histories` ADD `type` VARCHAR(20) NOT NULL COMMENT 'plus hoặc minus';";
$sqlUpdateDatabase['warehouse_histories']['id_order_member'] = "ALTER TABLE `warehouse_histories` ADD `id_order_member` INT NOT NULL DEFAULT '0';";
$sqlUpdateDatabase['warehouse_histories']['id_order'] = "ALTER TABLE `warehouse_histories` ADD `id_order` INT NOT NULL DEFAULT '0' COMMENT 'id đơn hàng khách lẻ';";

// bảng zalo_templates
$sqlUpdateDatabase['zalo_templates']['id_system'] = "ALTER TABLE `zalo_templates` ADD `id_system` int(11) NOT NULL;";
$sqlUpdateDatabase['zalo_templates']['id_zns'] = "ALTER TABLE `zalo_templates` ADD `id_zns` int(11) NOT NULL;";
$sqlUpdateDatabase['zalo_templates']['name'] = "ALTER TABLE `zalo_templates` ADD `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;";
$sqlUpdateDatabase['zalo_templates']['content'] = "ALTER TABLE `zalo_templates` ADD `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`content`));";
$sqlUpdateDatabase['zalo_templates']['content_example'] = "ALTER TABLE `zalo_templates` ADD `content_example` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL;";

// bảng token_devices
$sqlUpdateDatabase['token_devices']['token_device'] = "ALTER TABLE `token_devices` ADD `token_device` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL;";
$sqlUpdateDatabase['token_devices']['id_member'] = "ALTER TABLE `token_devices` ADD `id_member` INT NOT NULL DEFAULT '0';";

$sqlUpdateDatabase['token_devices']['id_customer'] = "ALTER TABLE `token_devices` ADD `id_customer` INT NOT NULL DEFAULT '0';";

// bảng 
$sqlUpdateDatabase['documents']['title'] = "ALTER TABLE `documents` ADD `title` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;"; 
$sqlUpdateDatabase['documents']['type'] = "ALTER TABLE `documents` ADD `type` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;"; 
$sqlUpdateDatabase['documents']['image'] = "ALTER TABLE `documents` ADD `image` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;"; 
$sqlUpdateDatabase['documents']['id_parent'] = "ALTER TABLE `documents` ADD `id_parent` INT NOT NULL;"; 
$sqlUpdateDatabase['documents']['status'] = "ALTER TABLE `documents` ADD `status` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;"; 
$sqlUpdateDatabase['documents']['content'] = "ALTER TABLE `documents` ADD `content` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;"; 
$sqlUpdateDatabase['documents']['slug'] = "ALTER TABLE `documents` ADD `slug` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;"; 
$sqlUpdateDatabase['documents']['description'] = "ALTER TABLE `documents` ADD `description` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;"; 
$sqlUpdateDatabase['documents']['created_at'] = "ALTER TABLE `documents` ADD `created_at` INT NOT NULL";
$sqlUpdateDatabase['documents']['public']= "ALTER TABLE `documents` ADD `public` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public'";

$sqlUpdateDatabase['documentinfos']['title'] = "ALTER TABLE `documentinfos` ADD  `title` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL";
$sqlUpdateDatabase['documentinfos']['file'] = "ALTER TABLE `documentinfos` ADD  `file` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL";
$sqlUpdateDatabase['documentinfos']['status'] = "ALTER TABLE `documentinfos` ADD  `status` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL";
$sqlUpdateDatabase['documentinfos']['description'] = "ALTER TABLE `documentinfos` ADD  `description` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL";
$sqlUpdateDatabase['documentinfos']['slug'] = "ALTER TABLE `documentinfos` ADD  `slug` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL";
$sqlUpdateDatabase['documentinfos']['id_document'] = "ALTER TABLE `documentinfos` ADD  `id_document` INT NOT NULL";


//  phiếu thu chi
$sqlUpdateDatabase['bills']['id_member_sell'] = "ALTER TABLE `bills` ADD `id_member_sell` INT NOT NULL";
$sqlUpdateDatabase['bills']['id_member_buy'] = "ALTER TABLE `bills` ADD `id_member_buy` INT NOT NULL DEFAULT '0'";
$sqlUpdateDatabase['bills']['total'] = "ALTER TABLE `bills` ADD `total` INT NOT NULL DEFAULT '0'";
$sqlUpdateDatabase['bills']['id_order'] = "ALTER TABLE `bills` ADD `id_order` INT NOT NULL DEFAULT '0'";
$sqlUpdateDatabase['bills']['type'] = "ALTER TABLE `bills` ADD `type` INT NOT NULL COMMENT '1: phiếu thu, 2 phiếu chi'";
$sqlUpdateDatabase['bills']['type_order'] = "ALTER TABLE `bills` ADD `type_order` INT NULL DEFAULT '3' COMMENT '0: tự tạo, 1: đại lý, 2: khách hàng'";
$sqlUpdateDatabase['bills']['created_at'] = "ALTER TABLE `bills` ADD `created_at` INT NULL DEFAULT NULL";
$sqlUpdateDatabase['bills']['updated_at'] = "ALTER TABLE `bills` ADD `updated_at` INT NULL DEFAULT NULL";
$sqlUpdateDatabase['bills']['type_collection_bill'] = "ALTER TABLE `bills` ADD `type_collection_bill` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL";
$sqlUpdateDatabase['bills']['id_customer'] = "ALTER TABLE `bills` ADD `id_customer` INT NOT NULL DEFAULT '0'";
$sqlUpdateDatabase['bills']['id_debt'] = "ALTER TABLE `bills` ADD `id_debt` INT NOT NULL DEFAULT '0'";
$sqlUpdateDatabase['bills']['note'] = "ALTER TABLE `bills` ADD `note` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";

// chi
$sqlUpdateDatabase['debts']['id_member_sell'] = "ALTER TABLE `debts` ADD `id_member_sell` INT NOT NULL";
$sqlUpdateDatabase['debts']['id_member_buy'] = "ALTER TABLE `debts` ADD `id_member_buy` INT NOT NULL DEFAULT '0'";
$sqlUpdateDatabase['debts']['total'] = "ALTER TABLE `debts` ADD `total` INT NOT NULL DEFAULT '0'";
$sqlUpdateDatabase['debts']['total_payment'] = "ALTER TABLE `debts` ADD `total_payment` INT NOT NULL DEFAULT '0'";
$sqlUpdateDatabase['debts']['number_payment'] = "ALTER TABLE `debts` ADD `number_payment` INT NOT NULL DEFAULT '0'";
$sqlUpdateDatabase['debts']['type'] = "ALTER TABLE `debts` ADD `type` INT NOT NULL DEFAULT '0' COMMENT '1: Nợ phải thu, 2: Nợ Phải trả, '";
$sqlUpdateDatabase['debts']['status'] = "ALTER TABLE `debts` ADD `status` INT NOT NULL COMMENT '0 : chưa trả ,1 đã trả hết'";
$sqlUpdateDatabase['debts']['type_order'] = "ALTER TABLE `debts` ADD `type_order` INT NOT NULL COMMENT '3: tự tạo, 1: đại lý, 2: khách hàng'";
$sqlUpdateDatabase['debts']['id_customer'] = "ALTER TABLE `debts` ADD `id_customer` INT NOT NULL DEFAULT '0'";
$sqlUpdateDatabase['debts']['note'] = "ALTER TABLE `debts` ADD `note` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL";
$sqlUpdateDatabase['debts']['created_at'] = "ALTER TABLE `debts` ADD `created_at` INT NULL DEFAULT NULL";
$sqlUpdateDatabase['debts']['updated_at'] = "ALTER TABLE `debts` ADD `updated_at` INT NULL DEFAULT NULL";
$sqlUpdateDatabase['debts']['id_order'] = "ALTER TABLE `debts` ADD `id_order` INT NOT NULL DEFAULT '0'";

$sqlUpdateDatabase['discount_product_agencys']['id_product'] = "ALTER TABLE `discount_product_agencys` ADD `id_product` INT NOT NULL";
$sqlUpdateDatabase['discount_product_agencys']['id_member_sell'] = "ALTER TABLE `discount_product_agencys` ADD `id_member_sell` INT NOT NULL COMMENT 'id đại lý tuyến trên'"; 
$sqlUpdateDatabase['discount_product_agencys']['id_member_buy'] = "ALTER TABLE `discount_product_agencys` ADD `id_member_buy` INT NOT NULL COMMENT 'id đại lý tuyến dưới đặt mua'";
$sqlUpdateDatabase['discount_product_agencys']['discount'] = "ALTER TABLE `discount_product_agencys` ADD `discount` INT NOT NULL DEFAULT '0'";

$sqlUpdateDatabase['seting_theme_infos']['id_member'] = "ALTER TABLE `seting_theme_infos` ADD `id_member` INT NOT NULL";
$sqlUpdateDatabase['seting_theme_infos']['id_theme'] = "ALTER TABLE `seting_theme_infos` ADD `id_theme` INT NOT NULL";
$sqlUpdateDatabase['seting_theme_infos']['config'] = "ALTER TABLE `seting_theme_infos` ADD `config` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL";

$sqlUpdateDatabase['link_infos']['id_member'] = "ALTER TABLE `link_infos` ADD `id_member` INT NOT NULL";
$sqlUpdateDatabase['link_infos']['type'] = "ALTER TABLE `link_infos` ADD `type` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL";
$sqlUpdateDatabase['link_infos']['link'] = "ALTER TABLE `link_infos` ADD `link` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL";
$sqlUpdateDatabase['link_infos']['description'] = "ALTER TABLE `link_infos` ADD `description` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL";
$sqlUpdateDatabase['link_infos']['namelink'] = "ALTER TABLE `link_infos` ADD `namelink` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL";