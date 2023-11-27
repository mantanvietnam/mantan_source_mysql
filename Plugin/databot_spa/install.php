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
  `id_customer` int(11) NOT NULL,
  `id_service` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `time_book` INT(11) NOT NULL COMMENT 'thời gian đặt lịch hẹn',
  `time_book_end` INT NOT NULL,
  `id_staff` int(11) DEFAULT NULL,
  `status` int(4) DEFAULT NULL COMMENT '0: Chưa xác nhận, 1: Xác nhận, 2:Không đến,  3:Hủy, 4:Đã đến , 5:Đặt online.',
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apt_step` int(11) DEFAULT NULL,
  `apt_times` int(11) DEFAULT NULL,
  `id_spa` int(11) DEFAULT NULL,
  `type1` BOOLEAN NOT NULL DEFAULT FALSE COMMENT 'Lịch tư vấn',
  `type2` BOOLEAN NOT NULL DEFAULT FALSE COMMENT 'Lịch chăm sóc',
  `type3` BOOLEAN NOT NULL DEFAULT FALSE COMMENT 'Lịch liệu trình',
  `type4` BOOLEAN NOT NULL DEFAULT FALSE COMMENT 'Lịch điều trị',
  `repeat_book` BOOLEAN NOT NULL DEFAULT FALSE
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
  `id` int(11) NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_spa` int(11) NOT NULL,
  `phone` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `sex` tinyint(4) NOT NULL,
  `avatar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cmnd` VARCHAR(255) NULL DEFAULT NULL,
  `link_facebook` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `referral_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_staff` int(11) DEFAULT NULL,
  `source` INT NULL DEFAULT '0' COMMENT 'Nguồn khách hàng'
  `id_group` int(11) DEFAULT NULL,
  `id_service` int(11) DEFAULT NULL,
  `medical_history` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `drug_allergy_history` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `request_current` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `advisory` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `advise_towards` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `id_product` INT NULL,
  `point` INT NOT NULL DEFAULT '0',
  `id_customer_aff` INT NOT NULL DEFAULT '0'
) ENGINE=InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
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
  `code_otp` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permission` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `coin` INT NOT NULL DEFAULT '0',
  `module` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '[\"customer\"]',
  `access_token_zalo` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `id_app_zalo` VARCHAR(255) NULL,
  `secret_app_zalo` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `id_oa_zalo` VARCHAR(255) NULL,
  `refresh_token_zalo_oa` VARCHAR(500) NULL,
  `code_zalo_oa` VARCHAR(500) NULL, 
  `deadline_token_zalo_oa` INT NULL,
  `access_token_zalo_oa` VARCHAR(500) NULL,
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
  `id` int(11) NOT NULL,
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

$sqlInstallDatabase .="CREATE TABLE `bills` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `id_member` INT(11) NOT NULL COMMENT 'ID chủ spa',
  `full_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_spa` INT NULL DEFAULT NULL ,
  `id_staff` INT(11) NOT NULL COMMENT 'ID nhân viên thực hiện thu tiền' ,
  `total` INT(11) NOT NULL DEFAULT '0' COMMENT 'số tiền thu chi' ,
  `note` TEXT NULL DEFAULT NULL ,
  `type` INT NOT NULL COMMENT '0: Thu, 1: chi, ' ,
  `created_at` DATETIME NULL DEFAULT NULL ,
  `updated_at` DATETIME NULL DEFAULT NULL , 
  `type_collection_bill` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT 'Hình thức thanh toán', 
  `id_customer` INT NULL DEFAULT NULL , 
  `id_warehouse_product` INT NULL DEFAULT NULL , 
  `id_debt` INT NOT NULL ,
  `time` INT NOT NULL DEFAULT '0'
) ENGINE = InnoDB;"

$sqlInstallDatabase .="CREATE TABLE `debts` ( 
  `id` INT NOT NULL , 
  `id_member` INT NOT NULL COMMENT 'ID chủ spa' ,
  `id_spa` INT NOT NULL , 
  `id_staff` INT NOT NULL COMMENT 'ID nhân viên thực hiện thu tiền ' ,
  `total` INT NOT NULL COMMENT 'số tiền nợ' ,
  `total_payment` INT NULL DEFAULT '0' COMMENT 'số tiền trả' ,
  `number_payment` INT NULL DEFAULT '0' COMMENT 'số lần trả ' ,
  `full_name` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
  `id_customer` INT NOT NULL , `time` INT NULL DEFAULT NULL , 
  `type` INT NOT NULL COMMENT '0: Nợ phải thu, 1: Nợ Phải trả,' , 
  `status` INT NULL DEFAULT NULL COMMENT '0 : chưa trả ,1 đã trả ' , 
  `note` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
  `created_at` DATETIME NULL DEFAULT NULL , 
  `updated_at` DATETIME NULL DEFAULT NULL 
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `partners` ( 
  `id` INT NOT NULL ,
  `name` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
  `phone` TEXT NOT NULL ,
  `email` INT NULL DEFAULT NULL ,
  `address` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
  `note` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
  `id_member` INT NOT NULL , 
  `created_at` DATETIME NOT NULL , 
  `updated_at` DATETIME NOT NULL 
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `warehouse_products` ( 
  `id` INT NOT NULL ,
  `id_member` INT NOT NULL COMMENT 'ID ' , 
  `id_spa` INT NOT NULL , 
  `id_staff` INT NULL DEFAULT NULL COMMENT 'ID nhân viên thực hiện' , 
  `id_warehouse` INT NOT NULL COMMENT 'ID kho' , 
  `impor_ price` INT NOT NULL COMMENT 'giá nhập' , 
  `quantity` INT NULL DEFAULT NULL COMMENT 'số lượng ban đâu' , 
  `inventory_quantity` INT NULL DEFAULT NULL COMMENT 'số lượng tồn kho' , 
  `deadline` INT NULL DEFAULT NULL , 
  `created_at` INT NOT NULL , 
  `id_partner` INT NULL DEFAULT NULL 
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `warehouse_product_details` ( 
  `id` INT NOT NULL AUTO_INCREMENT , 
  `id_member` INT NOT NULL , 
  `id_warehouse_product` INT NOT NULL , 
  `id_product` INT NOT NULL , 
  `impor_ price` INT NULL DEFAULT NULL , 
  `quantity` INT NOT NULL , 
  `inventory_quantity` INT NULL DEFAULT NULL , 
  `created_at` DATETIME NOT NULL , 
 ) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `orders` ( 
  `id` INT NOT NULL AUTO_INCREMENT , 
  `id_member` INT NOT NULL , 
  `id_spa` INT NOT NULL , 
  `id_staff` INT NOT NULL , 
  `id_customer` INT NULL DEFAULT NULL , 
  `full_name` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
  `id_bed` INT NULL DEFAULT NULL , 
  `note` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
  `time` INT NOT NULL , 
  `created_at` DATETIME NOT NULL , 
  `updated_at` DATETIME NOT NULL , 
  `status` TINYINT NOT NULL ,
  `total` INT NOT NULL ,
  `promotion` INT NULL DEFAULT NULL ,
  `totalPay` INT NULL DEFAULT NULL ,
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `order_details` ( 
  `id` INT NOT NULL AUTO_INCREMENT , 
  `id_member` INT NOT NULL , 
  `id_order` INT NOT NULL , 
  `id_product` INT NOT NULL , 
  `type` VARCHAR(225) NOT NULL , 
  `price` INT NULL DEFAULT NULL , 
  `quantity` INT NULL DEFAULT NULL , 
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `campain_customers` ( `id` INT NOT NULL AUTO_INCREMENT , `id_campain` INT NOT NULL , `id_customer` INT NOT NULL , `create_at` INT NOT NULL , `code` INT NOT NULL , `note` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL, PRIMARY KEY (`id`)) ENGINE = InnoDB; ";


$sqlInstallDatabase .="CREATE TABLE `campains` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `slug` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `codeSecurity` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `numberPersonWinSpin` INT NOT NULL , `typeUserWin` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `note` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `noteCheckin` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `status` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `nameTicket` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `priceTicket` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `nameLocation` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `smsRegister` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `sendSMS` INT NOT NULL , `idMember` INT NOT NULL , `idBotBanking` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `tokenBotBanking` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `idBlockSuccessfulTransaction` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `codeUser` INT NOT NULL DEFAULT '999' , `backgroundSpin` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `logoSpin` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `colorTextSpin` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `idSpa` INT NOT NULL, `created_at` INT NOT NULL, PRIMARY KEY (`id`)) ENGINE = InnoDB; ";

$sqlInstallDatabase .="CREATE TABLE `customer_prepaycards` ( `id` INT NOT NULL AUTO_INCREMENT , `id_customer` INT NOT NULL , `id_member` INT NOT NULL , `id_spa` INT NULL DEFAULT NULL ,`id_bill` INT NULL DEFAULT NULL, `total` INT NULL DEFAULT NULL , `status` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL , `id_prepaycard` INT NULL , `created_at` TIMESTAMP NULL DEFAULT NULL , `updated_at` TIMESTAMP NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `treatment_historys` ( `id` INT NOT NULL AUTO_INCREMENT , `id_orders` INT NOT NULL , `id_customer` INT NULL DEFAULT NULL , `id_services` INT NULL DEFAULT NULL , `status` VARCHAR(255) NULL DEFAULT NULL , `quantity` INT NOT NULL , `created_at` TIMESTAMP NULL DEFAULT NULL , `id_spa` INT NOT NULL , `id_member` INT NOT NULL , `id_bed` INT NOT NULL , `note` TEXT NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `transaction_histories` ( `id` INT NOT NULL AUTO_INCREMENT , `id_member` INT NOT NULL , `coin` INT NOT NULL , `type` VARCHAR(255) NOT NULL , `note` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `create_at` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; ";

$sqlDeleteDatabase .="CREATE TABLE `agencys` ( `id` INT NOT NULL AUTO_INCREMENT , `id_member` INT NOT NULL , `id_spa` INT NOT NULL , `id_staff` INT NOT NULL , `id_service` INT NOT NULL , `money` INT NULL DEFAULT NULL , `created_at` TIMESTAMP NULL DEFAULT NULL , `note` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , `id_order_detail` INT NULL DEFAULT NULL , `status` INT NULL DEFAULT NULL ,`id_order` INT NULL DEFAULT NULL AFTER `status`, `type` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,`id_user_service` INT  NULL DEFAULT NULL, PRIMARY KEY (`id`)) ENGINE = InnoDB;";

$sqlDeleteDatabase .="CREATE TABLE `zalo_templates` ( `id` INT NOT NULL AUTO_INCREMENT , `id_member` INT NOT NULL , `id_zns` INT NOT NULL , `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `content` JSON NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; ";
 
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
$sqlDeleteDatabase .= "DROP TABLE bills; ";
$sqlDeleteDatabase .= "DROP TABLE debts; ";
$sqlDeleteDatabase .= "DROP TABLE partners; ";
$sqlDeleteDatabase .= "DROP TABLE warehouse_products; ";
$sqlDeleteDatabase .= "DROP TABLE warehouse_product_details; ";
$sqlDeleteDatabase .= "DROP TABLE orders; ";
$sqlDeleteDatabase .= "DROP TABLE order_details; ";
$sqlDeleteDatabase .= "DROP TABLE campains; ";
$sqlDeleteDatabase .= "DROP TABLE customer_prepaycards; ";
$sqlDeleteDatabase .= "DROP TABLE campain_customers; ";
$sqlDeleteDatabase .= "DROP TABLE treatment_historys; ";
$sqlDeleteDatabase .= "DROP TABLE transaction_histories; ";
$sqlDeleteDatabase .= "DROP TABLE agencys; ";
$sqlDeleteDatabase .= "DROP TABLE zalo_templates; ";


$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='category_customer'; ";
$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='category_source_customer'; ";

//$sqlDeleteDatabase .= "DELETE FROM `options` WHERE `key_word`='settingTraining2TOPCRM'; ";

?>