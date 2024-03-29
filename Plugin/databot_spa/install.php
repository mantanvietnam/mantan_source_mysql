<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';

$sqlInstallDatabase .= 'CREATE TABLE `agencys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_member` int(11) NOT NULL,
  `id_spa` int(11) NOT NULL,
  `id_staff` int(11) NOT NULL,
  `id_service` int(11) NOT NULL,
  `money` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_order_detail` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `id_order` int(11) DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_user_service` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;';

$sqlInstallDatabase .= "CREATE TABLE `beds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_spa` int(11) NOT NULL,
  `id_room` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sqlInstallDatabase .= "CREATE TABLE `bills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_member` int(11) NOT NULL COMMENT 'ID chủ spa',
  `id_spa` int(11) DEFAULT NULL,
  `id_staff` int(11) NOT NULL COMMENT 'ID nhân viên thực hiện thu tiền',
  `total` int(11) NOT NULL DEFAULT 0 COMMENT 'số tiền thu chi',
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int(11) NOT NULL COMMENT '0: Thu, 1: chi, ',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `type_collection_bill` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Hình thức thanh toán',
  `id_customer` int(11) DEFAULT NULL,
  `full_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` int(11) NOT NULL DEFAULT 0,
  `id_debt` int(11) DEFAULT NULL,
  `id_warehouse_product` int(11) DEFAULT NULL,
  `id_order` int(11) DEFAULT NULL,
  `moneyCustomerPay` int(11) DEFAULT NULL,
  `type_card` int(11) DEFAULT NULL COMMENT '0: tiền thật, 1 tiền thẻ trả trước',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sqlInstallDatabase .="CREATE TABLE `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_member` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_service` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `time_book` int(11) NOT NULL COMMENT 'thời gian đặt lịch hẹn',
  `id_staff` int(11) DEFAULT NULL,
  `status` INT(4) NOT NULL DEFAULT '0' COMMENT '0: Chưa xác nhận, 1: Xác nhận, 2:Không đến, 3:Đã đến, 4:Hủy , 5:Đặt online.',
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apt_step` int(11) DEFAULT NULL,
  `apt_times` int(11) DEFAULT NULL,
  `id_spa` int(11) DEFAULT NULL,
  `type1` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Lịch tư vấn',
  `type2` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Lịch chăm sóc',
  `type3` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Lịch liệu trình',
  `type4` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Lịch điều trị',
  `repeat_book` tinyint(1) NOT NULL DEFAULT 0,
  `time_book_end` int(11) NOT NULL,
  `id_bed` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sqlInstallDatabase .="CREATE TABLE `campains` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `codeSecurity` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `numberPersonWinSpin` int(11) NOT NULL,
  `typeUserWin` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `note` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `noteCheckin` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nameTicket` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `priceTicket` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nameLocation` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `smsRegister` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sendSMS` int(11) NOT NULL,
  `idMember` int(11) NOT NULL,
  `idBotBanking` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tokenBotBanking` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `idBlockSuccessfulTransaction` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `codeUser` int(11) NOT NULL DEFAULT 999,
  `backgroundSpin` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `logoSpin` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `colorTextSpin` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `idSpa` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sqlInstallDatabase .="CREATE TABLE `campain_customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_campain` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `create_at` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `note` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sqlInstallDatabase .="CREATE TABLE `combos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `service` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `id_member` int(11) NOT NULL,
  `id_spa` int(11) NOT NULL,
  `commission_staff_fix` int(11) NOT NULL DEFAULT 0,
  `commission_staff_percent` int(11) NOT NULL DEFAULT 0,
  `use_time` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sqlInstallDatabase .="CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `cmnd` varchar(255) DEFAULT NULL,
  `link_facebook` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `referral_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'số điện thoại người giới thiệu',
  `id_staff` int(11) DEFAULT NULL,
  `source` int(11) DEFAULT 0 COMMENT 'Nguồn khách hàng',
  `id_group` int(11) DEFAULT NULL,
  `id_service` int(11) DEFAULT NULL,
  `medical_history` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `drug_allergy_history` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `request_current` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `advisory` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `advise_towards` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_product` int(11) DEFAULT NULL,
  `point` int(11) NOT NULL DEFAULT 0,
  `id_customer_aff` int(11) NOT NULL DEFAULT 0 COMMENT 'id người giới thiệu',
  `idTelegram` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sqlInstallDatabase .="CREATE TABLE `customer_prepaycards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_customer` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_spa` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_prepaycard` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_bill` int(11) DEFAULT NULL,
  `price_sell` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sqlInstallDatabase .="CREATE TABLE `debts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_member` int(11) NOT NULL COMMENT 'ID chủ spa',
  `id_spa` int(11) NOT NULL,
  `id_staff` int(11) NOT NULL COMMENT 'ID nhân viên thực hiện ',
  `total` int(11) NOT NULL COMMENT 'số tiền nợ',
  `total_payment` int(11) DEFAULT 0 COMMENT 'số tiền trả',
  `number_payment` int(11) DEFAULT 0 COMMENT 'số lần trả ',
  `full_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_customer` int(11) NOT NULL,
  `time` int(11) DEFAULT NULL,
  `type` int(11) NOT NULL COMMENT '0: Nợ phải thu, 1: Nợ Phải trả,',
  `status` int(11) DEFAULT NULL COMMENT '0 : chưa trả ,1 đã trả  hết',
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `id_warehouse_product` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sqlInstallDatabase .="CREATE TABLE `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1 : members, 0: nhân viên ',
  `id_member` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `dateline_at` datetime DEFAULT NULL,
  `number_spa` int(11) DEFAULT NULL,
  `birthday` varchar(255) DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_otp` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_group` int(11) DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `coin` int(11) NOT NULL DEFAULT 0,
  `permission` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `module` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '[\"customer\"]',
  `access_token_zalo` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_app_zalo` varchar(255) DEFAULT NULL,
  `secret_app_zalo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_oa_zalo` varchar(255) DEFAULT NULL,
  `refresh_token_zalo_oa` varchar(500) DEFAULT NULL,
  `code_zalo_oa` varchar(500) DEFAULT NULL,
  `deadline_token_zalo_oa` int(11) DEFAULT NULL,
  `access_token_zalo_oa` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sqlInstallDatabase .="CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_member` int(11) NOT NULL,
  `id_spa` int(11) NOT NULL,
  `id_staff` int(11) NOT NULL,
  `id_customer` int(11) DEFAULT NULL,
  `full_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_bed` int(11) DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` tinyint(4) NOT NULL,
  `total` int(11) DEFAULT NULL,
  `promotion` int(11) DEFAULT NULL,
  `total_pay` int(11) DEFAULT NULL,
  `type_order` tinyint(4) DEFAULT NULL COMMENT 'kiểu đặt ',
  `check_in` int(11) DEFAULT NULL,
  `check_out` int(11) DEFAULT NULL,
  `id_warehouse` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sqlInstallDatabase .="CREATE TABLE `order_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_member` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `type` varchar(225) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `number_uses` int(11) DEFAULT 0 COMMENT 'số lần sử dụng',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sqlInstallDatabase .="CREATE TABLE `partners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` text NOT NULL,
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_member` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sqlInstallDatabase .="CREATE TABLE `prepay_cards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `price_sell` int(11) NOT NULL DEFAULT 0,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `use_time` int(11) DEFAULT NULL,
  `id_member` int(11) NOT NULL,
  `id_spa` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `commission_staff_fix` int(11) NOT NULL DEFAULT 0,
  `commission_staff_percent` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sqlInstallDatabase .="CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_category` int(11) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `info` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `id_trademark` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `view` int(11) DEFAULT NULL,
  `id_member` int(11) NOT NULL,
  `id_spa` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `commission_staff_fix` int(11) NOT NULL DEFAULT 0,
  `commission_staff_percent` int(11) NOT NULL DEFAULT 0,
  `commission_affiliate_fix` int(11) NOT NULL DEFAULT 0,
  `commission_affiliate_percent` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sqlInstallDatabase .="CREATE TABLE `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `id_member` int(11) NOT NULL,
  `id_spa` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sqlInstallDatabase .="CREATE TABLE `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `commission_staff_fix` int(11) NOT NULL DEFAULT 0,
  `commission_staff_percent` int(11) NOT NULL DEFAULT 0,
  `commission_affiliate_fix` int(11) NOT NULL DEFAULT 0,
  `commission_affiliate_percent` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sqlInstallDatabase .="CREATE TABLE `spas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `facebook` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `zalo` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sqlInstallDatabase .="CREATE TABLE `trademarks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `id_member` int(11) NOT NULL,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sqlInstallDatabase .="CREATE TABLE `transaction_histories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_member` int(11) NOT NULL,
  `coin` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `note` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `create_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sqlInstallDatabase .="CREATE TABLE `userservice_histories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_member` int(11) NOT NULL,
  `id_order_details` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_spa` int(11) DEFAULT NULL,
  `id_services` int(11) NOT NULL,
  `id_staff` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `note` text DEFAULT NULL,
  `id_bed` int(11) DEFAULT NULL,
  `id_customer` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sqlInstallDatabase .="CREATE TABLE `warehouses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `credit` int(11) DEFAULT NULL COMMENT '1 cho bán âm, 0 không cho bán âm',
  `id_member` int(11) NOT NULL,
  `id_spa` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sqlInstallDatabase .="CREATE TABLE `warehouse_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_member` int(11) NOT NULL COMMENT 'ID ',
  `id_spa` int(11) NOT NULL,
  `id_staff` int(11) DEFAULT NULL COMMENT 'ID nhân viên thực hiện',
  `id_warehouse` int(11) NOT NULL COMMENT 'ID kho',
  `created_at` datetime DEFAULT NULL,
  `id_partner` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sqlInstallDatabase .="CREATE TABLE `warehouse_product_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_member` int(11) NOT NULL,
  `id_warehouse_product` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `impor_price` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `inventory_quantity` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `id_warehouse` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sqlInstallDatabase .="CREATE TABLE `zalo_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_member` int(11) NOT NULL,
  `id_zns` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`content`)),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sqlInstallDatabase .="ALTER TABLE `categories` ADD `id_member` INT NULL; ";


$sqlInstallDatabase .="CREATE TABLE `medical_histories` ( `id` INT NOT NULL AUTO_INCREMENT , `id_customer` INT NOT NULL , `id_member` INT NOT NULL , `id_spa` INT NOT NULL , `created_at` DATETIME NULL DEFAULT NULL , `updated_at` DATETIME NULL DEFAULT NULL , `title` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , `note` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , `id_order` INT NULL DEFAULT NULL , `result` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , `treatment_plan` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";


 
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
$sqlDeleteDatabase .= "DROP TABLE userservice_histories; ";
$sqlDeleteDatabase .= "DROP TABLE medical_histories; ";


$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='category_customer'; ";
$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='category_source_customer'; ";

//$sqlDeleteDatabase .= "DELETE FROM `options` WHERE `key_word`='settingTraining2TOPCRM'; ";

?>