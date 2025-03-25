<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];

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
  `created_at` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_spa` int(11) NOT NULL,
  `id_room` int(11) NOT NULL,
  `id_order` INT NULL DEFAULT NULL,
  `id_staff` INT NULL DEFAULT NULL,
  `id_customer` INT NULL DEFAULT NULL,
  `time_checkin` INT NULL DEFAULT NULL,
  `id_userservice` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
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
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `type_collection_bill` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Hình thức thanh toán',
  `id_customer` int(11) DEFAULT NULL,
  `full_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` int(11) NOT NULL DEFAULT 0,
  `id_debt` int(11) DEFAULT NULL,
  `id_warehouse_product` int(11) DEFAULT NULL,
  `id_order` int(11) DEFAULT NULL,
  `id_payroll` INT NULL DEFAULT 0,
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
  `created_at` int(11) NOT NULL,
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
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
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
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `sex` tinyint(4) NOT NULL,
  `avatar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cmnd` varchar(255) DEFAULT NULL,
  `link_facebook` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
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
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
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
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `last_login` int(11) DEFAULT NULL,
  `dateline_at` int(11) DEFAULT NULL,
  `id_card`  varchar(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
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
  `fixed_salary` INT NULL DEFAULT NULL,
  `insurance` INT NULL DEFAULT NULL,
  `allowance` INT NULL DEFAULT NULL,
  `account_bank` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL, 
  `code_bank` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `id_spa` INT NOT NULL DEFAULT 0;
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
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
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
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
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
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `commission_staff_fix` int(11) NOT NULL DEFAULT 0,
  `commission_staff_percent` int(11) NOT NULL DEFAULT 0,
  `commission_affiliate_fix` int(11) NOT NULL DEFAULT 0,
  `commission_affiliate_percent` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sqlInstallDatabase .="CREATE TABLE `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
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
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
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
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `facebook` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `zalo` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sqlInstallDatabase .="CREATE TABLE `trademarks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `id_member` int(11) NOT NULL,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `created_at` INT NULL DEFAULT NULL,
  `check_out` INT NULL DEFAULT NULL,
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
  `created_at` int(11) DEFAULT NULL,
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
  `created_at` int(11) DEFAULT NULL,
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
  `created_at` int(11) NOT NULL,
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


$sqlInstallDatabase .="CREATE TABLE `medical_histories` ( 
            `id` INT NOT NULL AUTO_INCREMENT , 
            `id_customer` INT NOT NULL , 
            `id_member` INT NOT NULL , 
            `id_spa` INT NOT NULL , 
            `created_at` int(11) NULL DEFAULT NULL , 
            `updated_at` int(11) NULL DEFAULT NULL , 
            `title` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
            `note` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
            `id_order` INT NULL DEFAULT NULL , 
            `result` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
            `treatment_plan` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
            `image` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
            PRIMARY KEY (`id`)
          ) ENGINE = InnoDB;";

$sqlInstallDatabase ."CREATE TABLE `token_devices` (
  `id` INT NOT NULL AUTO_INCREMENT , 
  `token_device` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL , 
  `id_member` INT NOT NULL DEFAULT '0' , 
  `token` VARCHAR(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `type` VARCHAR(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB; ";

$sqlInstallDatabase ."CREATE TABLE `staff_bonus` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_staff` INT NULL DEFAULT NULL,
  `id_member` INT NULL DEFAULT NULL,
  `note` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` INT NULL DEFAULT NULL,
  `type` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` INT NULL DEFAULT NULL,
  `updated_at` INT NULL DEFAULT NULL,
  `money` INT NULL DEFAULT '0',
  `id_spa` INT NULL DEFAULT NULL,
   PRIMARY KEY (`id`)) ENGINE = InnoDB;";


$sqlInstallDatabase .= "CREATE TABLE `transaction_histories` ( 
  `id` INT NOT NULL AUTO_INCREMENT , 
  `id_member` INT NOT NULL , 
  `coin` INT NOT NULL , 
  `type` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
  `note` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `create_at` INT NOT NULL , 
  `meta_payment` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `payment_type` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'payQrcode',
  PRIMARY KEY (`id`)
) ENGINE = InnoDB; ";

$sqlInstallDatabase .="CREATE TABLE `staff_timekeepers` ( 
`id` INT NOT NULL AUTO_INCREMENT ,
`day` INT NULL DEFAULT NULL ,
`shift` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`note` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`id_staff` INT NULL DEFAULT NULL ,
`id_member` INT NULL DEFAULT NULL ,
`id_spa` INT NULL DEFAULT NULL ,
`check_in` INT NULL DEFAULT NULL ,
`created_at` INT NULL DEFAULT NULL ,
 PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `payrolls` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `salary` INT NULL DEFAULT NULL ,
  `work` INT NULL DEFAULT NULL ,
  `fixed_salary` INT NULL DEFAULT NULL ,
  `working_day` FLOAT NULL DEFAULT NULL ,
  `commission` INT NULL DEFAULT NULL ,
  `bonus` INT NULL DEFAULT NULL ,
  `allowance` INT NULL DEFAULT NULL ,
  `fine` INT NULL DEFAULT NULL ,
  `insurance` INT NULL DEFAULT NULL ,
  `advance` INT NULL DEFAULT NULL ,
  `status` VARCHAR(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
  `note` VARCHAR(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
  `month` INT NULL DEFAULT NULL ,
  `yer` INT NULL DEFAULT NULL ,
  `id_member` INT NULL DEFAULT NULL ,
  `id_staff` INT NULL DEFAULT NULL ,
  `created_at` INT NULL DEFAULT NULL ,
  `updated_at` INT NULL DEFAULT NULL ,
  `payment_date` INT NULL DEFAULT NULL,
  `note_boss` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`)) ENGINE = InnoDB;";
 
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
$sqlDeleteDatabase .= "DROP TABLE token_devices; ";
$sqlDeleteDatabase .= "DROP TABLE staff_bonus; ";
$sqlDeleteDatabase .= "DROP TABLE staff_timekeepers; ";
$sqlDeleteDatabase .= "DROP TABLE payrolls; ";


$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='category_customer'; ";
$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='category_source_customer'; ";

//$sqlDeleteDatabase .= "DELETE FROM `options` WHERE `key_word`='settingTraining2TOPCRM'; ";

// Bang agencys
$sqlUpdateDatabase['agencys']['id_member'] = "ALTER TABLE `agencys` ADD `id_member` int(11) NOT NULL; ";
$sqlUpdateDatabase['agencys']['id_spa'] = "ALTER TABLE `agencys` ADD `id_spa` int(11) NOT NULL; ";
$sqlUpdateDatabase['agencys']['id_staff'] = "ALTER TABLE `agencys` ADD `id_staff` int(11) NOT NULL; ";
$sqlUpdateDatabase['agencys']['id_service'] = "ALTER TABLE `agencys` ADD `id_service` int(11) NOT NULL; ";
$sqlUpdateDatabase['agencys']['money'] = "ALTER TABLE `agencys` ADD `money` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['agencys']['created_at'] = "ALTER TABLE `agencys` ADD `created_at` timestamp NULL DEFAULT NULL; ";
$sqlUpdateDatabase['agencys']['note'] = "ALTER TABLE `agencys` ADD `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['agencys']['id_order_detail'] = "ALTER TABLE `agencys` ADD `id_order_detail` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['agencys']['status'] = "ALTER TABLE `agencys` ADD `status` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['agencys']['id_order'] = "ALTER TABLE `agencys` ADD `id_order` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['agencys']['type'] = "ALTER TABLE `agencys` ADD `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['agencys']['id_user_service'] = "ALTER TABLE `agencys` ADD `id_user_service` int(11) NOT NULL DEFAULT 0; ";

// Bang beds
$sqlUpdateDatabase['beds']['name'] = "ALTER TABLE `beds` ADD `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['beds']['created_at'] = "ALTER TABLE `beds` ADD `created_at` int(11) NOT NULL; ";
$sqlUpdateDatabase['beds']['status'] = "ALTER TABLE `beds` ADD `status` int(11) NOT NULL; ";
$sqlUpdateDatabase['beds']['id_member'] = "ALTER TABLE `beds` ADD `id_member` int(11) NOT NULL; ";
$sqlUpdateDatabase['beds']['id_spa'] = "ALTER TABLE `beds` ADD `id_spa` int(11) NOT NULL; ";
$sqlUpdateDatabase['beds']['id_room'] = "ALTER TABLE `beds` ADD `id_room` int(11) NOT NULL; ";
$sqlUpdateDatabase['beds']['id_order'] = "ALTER TABLE `beds` ADD `id_order` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['beds']['id_staff'] = "ALTER TABLE `beds` ADD `id_staff` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['beds']['id_customer'] = "ALTER TABLE `beds` ADD `id_customer` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['beds']['id_userservice'] = "ALTER TABLE `beds` ADD `id_userservice` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['beds']['time_checkin'] = "ALTER TABLE `beds` ADD `time_checkin` INT NULL DEFAULT NULL;";

// Bang bills 
$sqlUpdateDatabase['bills']['id_member'] = "ALTER TABLE `bills` ADD `id_member` int(11) NOT NULL COMMENT 'ID chủ spa'; ";
$sqlUpdateDatabase['bills']['id_spa'] = "ALTER TABLE `bills` ADD `id_spa` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['bills']['id_staff'] = "ALTER TABLE `bills` ADD `id_staff` int(11) NOT NULL COMMENT 'ID nhân viên thực hiện thu tiền'; ";
$sqlUpdateDatabase['bills']['total'] = "ALTER TABLE `bills` ADD `total` int(11) NOT NULL DEFAULT 0 COMMENT 'số tiền thu chi'; ";
$sqlUpdateDatabase['bills']['note'] = "ALTER TABLE `bills` ADD `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['bills']['type'] = "ALTER TABLE `bills` ADD `type` int(11) NOT NULL COMMENT '0: Thu, 1: chi, '; ";
$sqlUpdateDatabase['bills']['created_at'] = "ALTER TABLE `bills` ADD `created_at` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['bills']['updated_at'] = "ALTER TABLE `bills` ADD `updated_at` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['bills']['type_collection_bill'] = "ALTER TABLE `bills` ADD `type_collection_bill` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Hình thức thanh toán'; ";
$sqlUpdateDatabase['bills']['id_customer'] = "ALTER TABLE `bills` ADD `id_customer` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['bills']['full_name'] = "ALTER TABLE `bills` ADD `full_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['bills']['time'] = "ALTER TABLE `bills` ADD `time` int(11) NOT NULL DEFAULT 0; ";
$sqlUpdateDatabase['bills']['id_payroll'] = "ALTER TABLE `bills` ADD `id_payroll` int(11) NOT NULL DEFAULT 0; ";
$sqlUpdateDatabase['bills']['id_debt'] = "ALTER TABLE `bills` ADD `id_debt` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['bills']['id_warehouse_product'] = "ALTER TABLE `bills` ADD `id_warehouse_product` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['bills']['id_order'] = "ALTER TABLE `bills` ADD `id_order` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['bills']['moneyCustomerPay'] = "ALTER TABLE `bills` ADD `moneyCustomerPay` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['bills']['type_card'] = "ALTER TABLE `bills` ADD `type_card` int(11) DEFAULT NULL COMMENT '0: tiền thật, 1 tiền thẻ trả trước'; ";
 

// Bang books
$sqlUpdateDatabase['books']['name'] = "ALTER TABLE `books` ADD `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['books']['phone'] = "ALTER TABLE `books` ADD `phone` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['books']['email'] = "ALTER TABLE `books` ADD `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['books']['id_member'] = "ALTER TABLE `books` ADD `id_member` int(11) NOT NULL; ";
$sqlUpdateDatabase['books']['id_customer'] = "ALTER TABLE `books` ADD `id_customer` int(11) NOT NULL; ";
$sqlUpdateDatabase['books']['id_service'] = "ALTER TABLE `books` ADD `id_service` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['books']['created_at'] = "ALTER TABLE `books` ADD `created_at` int(11) NOT NULL; ";
$sqlUpdateDatabase['books']['time_book'] = "ALTER TABLE `books` ADD `time_book` int(11) NOT NULL COMMENT 'thời gian đặt lịch hẹn'; ";
$sqlUpdateDatabase['books']['id_staff'] = "ALTER TABLE `books` ADD `id_staff` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['books']['status'] = "ALTER TABLE `books` ADD `status` INT(4) NOT NULL DEFAULT '0' COMMENT '0: Chưa xác nhận, 1: Xác nhận, 2:Không đến, 3:Đã đến, 4:Hủy , 5:Đặt online.'; ";
$sqlUpdateDatabase['books']['note'] = "ALTER TABLE `books` ADD `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['books']['apt_step'] = "ALTER TABLE `books` ADD `apt_step` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['books']['apt_times'] = "ALTER TABLE `books` ADD `apt_times` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['books']['id_spa'] = "ALTER TABLE `books` ADD `id_spa` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['books']['type1'] = "ALTER TABLE `books` ADD `type1` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Lịch tư vấn'; ";
$sqlUpdateDatabase['books']['type2'] = "ALTER TABLE `books` ADD `type2` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Lịch chăm sóc'; ";
$sqlUpdateDatabase['books']['type3'] = "ALTER TABLE `books` ADD `type3` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Lịch liệu trình'; ";
$sqlUpdateDatabase['books']['type4'] = "ALTER TABLE `books` ADD `type4` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Lịch điều trị'; ";
$sqlUpdateDatabase['books']['repeat_book'] = "ALTER TABLE `books` ADD `repeat_book` tinyint(1) NOT NULL DEFAULT 0; ";
$sqlUpdateDatabase['books']['time_book_end'] = "ALTER TABLE `books` ADD `time_book_end` int(11) NOT NULL; ";
$sqlUpdateDatabase['books']['id_bed'] = "ALTER TABLE `books` ADD `id_bed` int(11) DEFAULT NULL; ";

// Bang campains
$sqlUpdateDatabase['campains']['name'] = "ALTER TABLE `campains` ADD `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['campains']['slug'] = "ALTER TABLE `campains` ADD `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['campains']['codeSecurity'] = "ALTER TABLE `campains` ADD `codeSecurity` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['campains']['numberPersonWinSpin'] = "ALTER TABLE `campains` ADD `numberPersonWinSpin` int(11) NOT NULL; ";
$sqlUpdateDatabase['campains']['typeUserWin'] = "ALTER TABLE `campains` ADD `typeUserWin` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['campains']['note'] = "ALTER TABLE `campains` ADD `note` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['campains']['noteCheckin'] = "ALTER TABLE `campains` ADD `noteCheckin` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['campains']['status'] = "ALTER TABLE `campains` ADD `status` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['campains']['nameTicket'] = "ALTER TABLE `campains` ADD `nameTicket` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['campains']['priceTicket'] = "ALTER TABLE `campains` ADD `priceTicket` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['campains']['nameLocation'] = "ALTER TABLE `campains` ADD `nameLocation` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['campains']['smsRegister'] = "ALTER TABLE `campains` ADD `smsRegister` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['campains']['sendSMS'] = "ALTER TABLE `campains` ADD `sendSMS` int(11) NOT NULL; ";
$sqlUpdateDatabase['campains']['idMember'] = "ALTER TABLE `campains` ADD `idMember` int(11) NOT NULL; ";
$sqlUpdateDatabase['campains']['idBotBanking'] = "ALTER TABLE `campains` ADD `idBotBanking` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['campains']['tokenBotBanking'] = "ALTER TABLE `campains` ADD `tokenBotBanking` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['campains']['idBlockSuccessfulTransaction'] = "ALTER TABLE `campains` ADD `idBlockSuccessfulTransaction` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['campains']['codeUser'] = "ALTER TABLE `campains` ADD `codeUser` int(11) NOT NULL DEFAULT 999; ";
$sqlUpdateDatabase['campains']['backgroundSpin'] = "ALTER TABLE `campains` ADD `backgroundSpin` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['campains']['logoSpin'] = "ALTER TABLE `campains` ADD `logoSpin` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['campains']['colorTextSpin'] = "ALTER TABLE `campains` ADD `colorTextSpin` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['campains']['idSpa'] = "ALTER TABLE `campains` ADD `idSpa` int(11) NOT NULL; ";
$sqlUpdateDatabase['campains']['created_at'] = "ALTER TABLE `campains` ADD `created_at` int(11) NOT NULL; ";

// Bang campain_customers
$sqlUpdateDatabase['campain_customers']['id_campain'] = "ALTER TABLE `campain_customers` ADD `id_campain` int(11) NOT NULL; ";
$sqlUpdateDatabase['campain_customers']['id_customer'] = "ALTER TABLE `campain_customers` ADD `id_customer` int(11) NOT NULL; ";
$sqlUpdateDatabase['campain_customers']['create_at'] = "ALTER TABLE `campain_customers` ADD `create_at` int(11) NOT NULL; ";
$sqlUpdateDatabase['campain_customers']['code'] = "ALTER TABLE `campain_customers` ADD `code` int(11) NOT NULL; ";
$sqlUpdateDatabase['campain_customers']['note'] = "ALTER TABLE `campain_customers` ADD `note` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL; ";

// Bang combos
$sqlUpdateDatabase['combos']['name'] = "ALTER TABLE `combos` ADD `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['combos']['service'] = "ALTER TABLE `combos` ADD `service` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['combos']['product'] = "ALTER TABLE `combos` ADD `product` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['combos']['price'] = "ALTER TABLE `combos` ADD `price` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['combos']['description'] = "ALTER TABLE `combos` ADD `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['combos']['status'] = "ALTER TABLE `combos` ADD `status` varchar(20) NOT NULL; ";
$sqlUpdateDatabase['combos']['created_at'] = "ALTER TABLE `combos` ADD `created_at` int(11) NOT NULL; ";
$sqlUpdateDatabase['combos']['updated_at'] = "ALTER TABLE `combos` ADD `updated_at` int(11) NOT NULL; ";
$sqlUpdateDatabase['combos']['quantity'] = "ALTER TABLE `combos` ADD `quantity` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['combos']['id_member'] = "ALTER TABLE `combos` ADD `id_member` int(11) NOT NULL; ";
$sqlUpdateDatabase['combos']['id_spa'] = "ALTER TABLE `combos` ADD `id_spa` int(11) NOT NULL; ";
$sqlUpdateDatabase['combos']['commission_staff_fix'] = "ALTER TABLE `combos` ADD `commission_staff_fix` int(11) NOT NULL DEFAULT 0; ";
$sqlUpdateDatabase['combos']['commission_staff_percent'] = "ALTER TABLE `combos` ADD `commission_staff_percent` int(11) NOT NULL DEFAULT 0; ";
$sqlUpdateDatabase['combos']['use_time'] = "ALTER TABLE `combos` ADD `use_time` int(11) NOT NULL DEFAULT 0; ";
$sqlUpdateDatabase['combos']['image'] = "ALTER TABLE `combos` ADD `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";

// Bang customers
$sqlUpdateDatabase['customers']['name'] = "ALTER TABLE `customers` ADD `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['customers']['id_member'] = "ALTER TABLE `customers` ADD `id_member` int(11) NOT NULL; ";
$sqlUpdateDatabase['customers']['id_spa'] = "ALTER TABLE `customers` ADD `id_spa` int(11) NOT NULL; ";
$sqlUpdateDatabase['customers']['phone'] = "ALTER TABLE `customers` ADD `phone` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['customers']['email'] = "ALTER TABLE `customers` ADD `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['customers']['address'] = "ALTER TABLE `customers` ADD `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['customers']['created_at'] = "ALTER TABLE `customers` ADD `created_at` int(11) NOT NULL; ";
$sqlUpdateDatabase['customers']['updated_at'] = "ALTER TABLE `customers` ADD `updated_at` int(11) NOT NULL; ";
$sqlUpdateDatabase['customers']['sex'] = "ALTER TABLE `customers` ADD `sex` tinyint(4) NOT NULL; ";
$sqlUpdateDatabase['customers']['avatar'] = "ALTER TABLE `customers` ADD `avatar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['customers']['birthday'] = "ALTER TABLE `customers` ADD `birthday` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['customers']['cmnd'] = "ALTER TABLE `customers` ADD `cmnd` varchar(255) DEFAULT NULL; ";
$sqlUpdateDatabase['customers']['link_facebook'] = "ALTER TABLE `customers` ADD `link_facebook` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['customers']['referral_code'] = "ALTER TABLE `customers` ADD `referral_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'số điện thoại người giới thiệu'; ";
$sqlUpdateDatabase['customers']['id_staff'] = "ALTER TABLE `customers` ADD `id_staff` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['customers']['source'] = "ALTER TABLE `customers` ADD `source` int(11) DEFAULT 0 COMMENT 'Nguồn khách hàng'; ";
$sqlUpdateDatabase['customers']['id_group'] = "ALTER TABLE `customers` ADD `id_group` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['customers']['id_service'] = "ALTER TABLE `customers` ADD `id_service` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['customers']['medical_history'] = "ALTER TABLE `customers` ADD `medical_history` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['customers']['drug_allergy_history'] = "ALTER TABLE `customers` ADD `drug_allergy_history` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['customers']['request_current'] = "ALTER TABLE `customers` ADD `request_current` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['customers']['advisory'] = "ALTER TABLE `customers` ADD `advisory` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['customers']['advise_towards'] = "ALTER TABLE `customers` ADD `advise_towards` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['customers']['note'] = "ALTER TABLE `customers` ADD `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['customers']['job'] = "ALTER TABLE `customers` ADD `job` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['customers']['id_product'] = "ALTER TABLE `customers` ADD `id_product` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['customers']['point'] = "ALTER TABLE `customers` ADD `point` int(11) NOT NULL DEFAULT 0; ";
$sqlUpdateDatabase['customers']['id_customer_aff'] = "ALTER TABLE `customers` ADD `id_customer_aff` int(11) NOT NULL DEFAULT 0 COMMENT 'id người giới thiệu'; ";
$sqlUpdateDatabase['customers']['idTelegram'] = "ALTER TABLE `customers` ADD `idTelegram` varchar(255) DEFAULT NULL; ";

// Bang customer_prepaycards
$sqlUpdateDatabase['customer_prepaycards']['id_customer'] = "ALTER TABLE `customer_prepaycards` ADD `id_customer` int(11) NOT NULL; ";
$sqlUpdateDatabase['customer_prepaycards']['id_member'] = "ALTER TABLE `customer_prepaycards` ADD `id_member` int(11) NOT NULL; ";
$sqlUpdateDatabase['customer_prepaycards']['id_spa'] = "ALTER TABLE `customer_prepaycards` ADD `id_spa` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['customer_prepaycards']['total'] = "ALTER TABLE `customer_prepaycards` ADD `total` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['customer_prepaycards']['status'] = "ALTER TABLE `customer_prepaycards` ADD `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['customer_prepaycards']['id_prepaycard'] = "ALTER TABLE `customer_prepaycards` ADD `id_prepaycard` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['customer_prepaycards']['created_at'] = "ALTER TABLE `customer_prepaycards` ADD `created_at` timestamp NULL DEFAULT NULL; ";
$sqlUpdateDatabase['customer_prepaycards']['updated_at'] = "ALTER TABLE `customer_prepaycards` ADD `updated_at` timestamp NULL DEFAULT NULL; ";
$sqlUpdateDatabase['customer_prepaycards']['id_bill'] = "ALTER TABLE `customer_prepaycards` ADD `id_bill` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['customer_prepaycards']['price_sell'] = "ALTER TABLE `customer_prepaycards` ADD `price_sell` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['customer_prepaycards']['price'] = "ALTER TABLE `customer_prepaycards` ADD `price` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['customer_prepaycards']['quantity'] = "ALTER TABLE `customer_prepaycards` ADD `quantity` int(11) DEFAULT NULL; ";

// Bang debts
$sqlUpdateDatabase['debts']['id_member'] = "ALTER TABLE `debts` ADD `id_member` int(11) NOT NULL COMMENT 'ID chủ spa'; ";
$sqlUpdateDatabase['debts']['id_spa'] = "ALTER TABLE `debts` ADD `id_spa` int(11) NOT NULL; ";
$sqlUpdateDatabase['debts']['id_staff'] = "ALTER TABLE `debts` ADD `id_staff` int(11) NOT NULL COMMENT 'ID nhân viên thực hiện '; ";
$sqlUpdateDatabase['debts']['total'] = "ALTER TABLE `debts` ADD `total` int(11) NOT NULL COMMENT 'số tiền nợ'; ";
$sqlUpdateDatabase['debts']['total_payment'] = "ALTER TABLE `debts` ADD `total_payment` int(11) DEFAULT 0 COMMENT 'số tiền trả'; ";
$sqlUpdateDatabase['debts']['number_payment'] = "ALTER TABLE `debts` ADD `number_payment` int(11) DEFAULT 0 COMMENT 'số lần trả '; ";
$sqlUpdateDatabase['debts']['full_name'] = "ALTER TABLE `debts` ADD `full_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['debts']['id_customer'] = "ALTER TABLE `debts` ADD `id_customer` int(11) NOT NULL; ";
$sqlUpdateDatabase['debts']['time'] = "ALTER TABLE `debts` ADD `time` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['debts']['type'] = "ALTER TABLE `debts` ADD `type` int(11) NOT NULL COMMENT '0: Nợ phải thu, 1: Nợ Phải trả,'; ";
$sqlUpdateDatabase['debts']['status'] = "ALTER TABLE `debts` ADD `status` int(11) DEFAULT NULL COMMENT '0 : chưa trả ,1 đã trả  hết'; ";
$sqlUpdateDatabase['debts']['note'] = "ALTER TABLE `debts` ADD `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['debts']['created_at'] = "ALTER TABLE `debts` ADD `created_at` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['debts']['updated_at'] = "ALTER TABLE `debts` ADD `updated_at` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['debts']['id_warehouse_product'] = "ALTER TABLE `debts` ADD `id_warehouse_product` int(11) DEFAULT NULL; ";

// Bang members
$sqlUpdateDatabase['members']['name'] = "ALTER TABLE `members` ADD `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['members']['avatar'] = "ALTER TABLE `members` ADD `avatar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['members']['phone'] = "ALTER TABLE `members` ADD `phone` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['members']['email'] = "ALTER TABLE `members` ADD `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['members']['status'] = "ALTER TABLE `members` ADD `status` int(11) NOT NULL; ";
$sqlUpdateDatabase['members']['type'] = "ALTER TABLE `members` ADD `type` int(11) NOT NULL COMMENT '1 : members, 0: nhân viên '; ";
$sqlUpdateDatabase['members']['id_member'] = "ALTER TABLE `members` ADD `id_member` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['members']['created_at'] = "ALTER TABLE `members` ADD `created_at` int(11) NOT NULL; ";
$sqlUpdateDatabase['members']['updated_at'] = "ALTER TABLE `members` ADD `updated_at` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['members']['last_login'] = "ALTER TABLE `members` ADD `last_login` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['members']['dateline_at'] = "ALTER TABLE `members` ADD `dateline_at` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['members']['number_spa'] = "ALTER TABLE `members` ADD `number_spa` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['members']['birthday'] = "ALTER TABLE `members` ADD `birthday` varchar(255) DEFAULT NULL; ";
$sqlUpdateDatabase['members']['address'] = "ALTER TABLE `members` ADD `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['members']['code_otp'] = "ALTER TABLE `members` ADD `code_otp` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['members']['id_group'] = "ALTER TABLE `members` ADD `id_group` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['members']['password'] = "ALTER TABLE `members` ADD `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['members']['coin'] = "ALTER TABLE `members` ADD `coin` int(11) NOT NULL DEFAULT 0; ";
$sqlUpdateDatabase['members']['permission'] = "ALTER TABLE `members` ADD `permission` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['members']['module'] = "ALTER TABLE `members` ADD `module` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '[\"customer\"]'; ";
$sqlUpdateDatabase['members']['access_token_zalo'] = "ALTER TABLE `members` ADD `access_token_zalo` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['members']['id_app_zalo'] = "ALTER TABLE `members` ADD `id_app_zalo` varchar(255) DEFAULT NULL; ";
$sqlUpdateDatabase['members']['secret_app_zalo'] = "ALTER TABLE `members` ADD `secret_app_zalo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['members']['id_oa_zalo'] = "ALTER TABLE `members` ADD `id_oa_zalo` varchar(255) DEFAULT NULL; ";
$sqlUpdateDatabase['members']['refresh_token_zalo_oa'] = "ALTER TABLE `members` ADD `refresh_token_zalo_oa` varchar(500) DEFAULT NULL; ";
$sqlUpdateDatabase['members']['code_zalo_oa'] = "ALTER TABLE `members` ADD `code_zalo_oa` varchar(500) DEFAULT NULL; ";
$sqlUpdateDatabase['members']['deadline_token_zalo_oa'] = "ALTER TABLE `members` ADD `deadline_token_zalo_oa` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['members']['access_token_zalo_oa'] = "ALTER TABLE `members` ADD `access_token_zalo_oa` varchar(500) DEFAULT NULL; ";
$sqlUpdateDatabase['members']['id_spa'] = "ALTER TABLE `members` ADD `id_spa` INT NOT NULL DEFAULT '0';";
$sqlUpdateDatabase['members']['fixed_salary'] = "ALTER TABLE `members` ADD `fixed_salary` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['members']['insurance'] = "ALTER TABLE `members` ADD `insurance` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['members']['allowance'] = "ALTER TABLE `members` ADD `allowance` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['members']['account_bank'] = "ALTER TABLE `members` ADD `account_bank` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['members']['code_bank'] = "ALTER TABLE `members` ADD `code_bank` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['members']['id_card'] = "ALTER TABLE `members` ADD `id_card`  varchar(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;";
// Bang orders
$sqlUpdateDatabase['orders']['id_member'] = "ALTER TABLE `orders` ADD `id_member` int(11) NOT NULL; ";
$sqlUpdateDatabase['orders']['id_spa'] = "ALTER TABLE `orders` ADD `id_spa` int(11) NOT NULL; ";
$sqlUpdateDatabase['orders']['id_staff'] = "ALTER TABLE `orders` ADD `id_staff` int(11) NOT NULL; ";
$sqlUpdateDatabase['orders']['id_customer'] = "ALTER TABLE `orders` ADD `id_customer` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['orders']['full_name'] = "ALTER TABLE `orders` ADD `full_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['orders']['id_bed'] = "ALTER TABLE `orders` ADD `id_bed` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['orders']['note'] = "ALTER TABLE `orders` ADD `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['orders']['time'] = "ALTER TABLE `orders` ADD `time` int(11) NOT NULL; ";
$sqlUpdateDatabase['orders']['created_at'] = "ALTER TABLE `orders` ADD `created_at` int(11) NOT NULL; ";
$sqlUpdateDatabase['orders']['updated_at'] = "ALTER TABLE `orders` ADD `updated_at` int(11) NOT NULL; ";
$sqlUpdateDatabase['orders']['status'] = "ALTER TABLE `orders` ADD `status` tinyint(4) NOT NULL; ";
$sqlUpdateDatabase['orders']['total'] = "ALTER TABLE `orders` ADD `total` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['orders']['promotion'] = "ALTER TABLE `orders` ADD `promotion` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['orders']['total_pay'] = "ALTER TABLE `orders` ADD `total_pay` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['orders']['type_order'] = "ALTER TABLE `orders` ADD `type_order` tinyint(4) DEFAULT NULL COMMENT 'kiểu đặt '; ";
$sqlUpdateDatabase['orders']['check_in'] = "ALTER TABLE `orders` ADD `check_in` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['orders']['check_out'] = "ALTER TABLE `orders` ADD `check_out` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['orders']['id_warehouse'] = "ALTER TABLE `orders` ADD `id_warehouse` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['orders']['type'] = "ALTER TABLE `orders` ADD `type` varchar(255) DEFAULT NULL; ";

// Bang order_details
$sqlUpdateDatabase['order_details']['id_member'] = "ALTER TABLE `order_details` ADD `id_member` int(11) NOT NULL; ";
$sqlUpdateDatabase['order_details']['id_order'] = "ALTER TABLE `order_details` ADD `id_order` int(11) NOT NULL; ";
$sqlUpdateDatabase['order_details']['id_product'] = "ALTER TABLE `order_details` ADD `id_product` int(11) NOT NULL; ";
$sqlUpdateDatabase['order_details']['type'] = "ALTER TABLE `order_details` ADD `type` varchar(225) NOT NULL; ";
$sqlUpdateDatabase['order_details']['price'] = "ALTER TABLE `order_details` ADD `price` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['order_details']['quantity'] = "ALTER TABLE `order_details` ADD `quantity` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['order_details']['number_uses'] = "ALTER TABLE `order_details` ADD `number_uses` int(11) DEFAULT 0 COMMENT 'số lần sử dụng'; ";

// Bang partners
$sqlUpdateDatabase['partners']['name'] = "ALTER TABLE `partners` ADD `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['partners']['phone'] = "ALTER TABLE `partners` ADD `phone` text NOT NULL; ";
$sqlUpdateDatabase['partners']['email'] = "ALTER TABLE `partners` ADD `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['partners']['address'] = "ALTER TABLE `partners` ADD `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['partners']['note'] = "ALTER TABLE `partners` ADD `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['partners']['id_member'] = "ALTER TABLE `partners` ADD `id_member` int(11) NOT NULL; ";
$sqlUpdateDatabase['partners']['created_at'] = "ALTER TABLE `partners` ADD `created_at` int  DEFAULT NULL; ";
$sqlUpdateDatabase['partners']['updated_at'] = "ALTER TABLE `partners` ADD `updated_at`  int DEFAULT NULL; ";

// Bang prepay_cards
$sqlUpdateDatabase['prepay_cards']['name'] = "ALTER TABLE `prepay_cards` ADD `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['prepay_cards']['price'] = "ALTER TABLE `prepay_cards` ADD `price` int(11) NOT NULL DEFAULT 0; ";
$sqlUpdateDatabase['prepay_cards']['price_sell'] = "ALTER TABLE `prepay_cards` ADD `price_sell` int(11) NOT NULL DEFAULT 0; ";
$sqlUpdateDatabase['prepay_cards']['note'] = "ALTER TABLE `prepay_cards` ADD `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['prepay_cards']['use_time'] = "ALTER TABLE `prepay_cards` ADD `use_time` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['prepay_cards']['id_member'] = "ALTER TABLE `prepay_cards` ADD `id_member` int(11) NOT NULL; ";
$sqlUpdateDatabase['prepay_cards']['id_spa'] = "ALTER TABLE `prepay_cards` ADD `id_spa` int(11) NOT NULL; ";
$sqlUpdateDatabase['prepay_cards']['status'] = "ALTER TABLE `prepay_cards` ADD `status` varchar(20) NOT NULL; ";
$sqlUpdateDatabase['prepay_cards']['commission_staff_fix'] = "ALTER TABLE `prepay_cards` ADD `commission_staff_fix` int(11) NOT NULL DEFAULT 0; ";
$sqlUpdateDatabase['prepay_cards']['commission_staff_percent'] = "ALTER TABLE `prepay_cards` ADD `commission_staff_percent` int(11) NOT NULL DEFAULT 0; ";

// Bang products
$sqlUpdateDatabase['products']['name'] = "ALTER TABLE `products` ADD `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['products']['id_category'] = "ALTER TABLE `products` ADD `id_category` int(11) NOT NULL; ";
$sqlUpdateDatabase['products']['description'] = "ALTER TABLE `products` ADD `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['products']['info'] = "ALTER TABLE `products` ADD `info` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['products']['image'] = "ALTER TABLE `products` ADD `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['products']['code'] = "ALTER TABLE `products` ADD `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['products']['price'] = "ALTER TABLE `products` ADD `price` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['products']['quantity'] = "ALTER TABLE `products` ADD `quantity` int(11) NOT NULL DEFAULT 0; ";
$sqlUpdateDatabase['products']['id_trademark'] = "ALTER TABLE `products` ADD `id_trademark` int(11) NOT NULL; ";
$sqlUpdateDatabase['products']['status'] = "ALTER TABLE `products` ADD `status` varchar(20) NOT NULL; ";
$sqlUpdateDatabase['products']['slug'] = "ALTER TABLE `products` ADD `slug` varchar(255) NOT NULL; ";
$sqlUpdateDatabase['products']['view'] = "ALTER TABLE `products` ADD `view` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['products']['id_member'] = "ALTER TABLE `products` ADD `id_member` int(11) NOT NULL; ";
$sqlUpdateDatabase['products']['id_spa'] = "ALTER TABLE `products` ADD `id_spa` int(11) NOT NULL; ";
$sqlUpdateDatabase['products']['created_at'] = "ALTER TABLE `products` ADD `created_at` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['products']['updated_at'] = "ALTER TABLE `products` ADD `updated_at` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['products']['commission_staff_fix'] = "ALTER TABLE `products` ADD `commission_staff_fix` int(11) NOT NULL DEFAULT 0; ";
$sqlUpdateDatabase['products']['commission_staff_percent'] = "ALTER TABLE `products` ADD `commission_staff_percent` int(11) NOT NULL DEFAULT 0; ";
$sqlUpdateDatabase['products']['commission_affiliate_fix'] = "ALTER TABLE `products` ADD `commission_affiliate_fix` int(11) NOT NULL DEFAULT 0; ";
$sqlUpdateDatabase['products']['commission_affiliate_percent'] = "ALTER TABLE `products` ADD `commission_affiliate_percent` int(11) NOT NULL DEFAULT 0; ";

// Bang rooms
$sqlUpdateDatabase['rooms']['name'] = "ALTER TABLE `rooms` ADD `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['rooms']['created_at'] = "ALTER TABLE `rooms` ADD `created_at` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['rooms']['status'] = "ALTER TABLE `rooms` ADD `status` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['rooms']['id_member'] = "ALTER TABLE `rooms` ADD `id_member` int(11) NOT NULL; ";
$sqlUpdateDatabase['rooms']['id_spa'] = "ALTER TABLE `rooms` ADD `id_spa` int(11) NOT NULL; ";

// Bang services
$sqlUpdateDatabase['services']['name'] = "ALTER TABLE `services` ADD `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['services']['code'] = "ALTER TABLE `services` ADD `code` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['services']['id_category'] = "ALTER TABLE `services` ADD `id_category` int(11) NOT NULL; ";
$sqlUpdateDatabase['services']['id_member'] = "ALTER TABLE `services` ADD `id_member` int(11) NOT NULL; ";
$sqlUpdateDatabase['services']['id_spa'] = "ALTER TABLE `services` ADD `id_spa` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['services']['price'] = "ALTER TABLE `services` ADD `price` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['services']['image'] = "ALTER TABLE `services` ADD `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['services']['description'] = "ALTER TABLE `services` ADD `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['services']['created_at'] = "ALTER TABLE `services` ADD `created_at` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['services']['updated_at'] = "ALTER TABLE `services` ADD `updated_at` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['services']['duration'] = "ALTER TABLE `services` ADD `duration` int(11) DEFAULT NULL COMMENT 'thời lương'; ";
$sqlUpdateDatabase['services']['slug'] = "ALTER TABLE `services` ADD `slug` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['services']['status'] = "ALTER TABLE `services` ADD `status` tinyint(4) DEFAULT NULL; ";
$sqlUpdateDatabase['services']['commission_staff_fix'] = "ALTER TABLE `services` ADD `commission_staff_fix` int(11) NOT NULL DEFAULT 0; ";
$sqlUpdateDatabase['services']['commission_staff_percent'] = "ALTER TABLE `services` ADD `commission_staff_percent` int(11) NOT NULL DEFAULT 0; ";
$sqlUpdateDatabase['services']['commission_affiliate_fix'] = "ALTER TABLE `services` ADD `commission_affiliate_fix` int(11) NOT NULL DEFAULT 0; ";
$sqlUpdateDatabase['services']['commission_affiliate_percent'] = "ALTER TABLE `services` ADD `commission_affiliate_percent` int(11) NOT NULL DEFAULT 0; ";

// Bang spas
$sqlUpdateDatabase['spas']['name'] = "ALTER TABLE `spas` ADD `name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['spas']['phone'] = "ALTER TABLE `spas` ADD `phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['spas']['email'] = "ALTER TABLE `spas` ADD `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['spas']['id_member'] = "ALTER TABLE `spas` ADD `id_member` int(11) NOT NULL; ";
$sqlUpdateDatabase['spas']['address'] = "ALTER TABLE `spas` ADD `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['spas']['note'] = "ALTER TABLE `spas` ADD `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['spas']['image'] = "ALTER TABLE `spas` ADD `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['spas']['slug'] = "ALTER TABLE `spas` ADD `slug` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['spas']['created_at'] = "ALTER TABLE `spas` ADD `created_at` int(11) NOT NULL; ";
$sqlUpdateDatabase['spas']['updated_at'] = "ALTER TABLE `spas` ADD `updated_at` int(11) NOT NULL; ";
$sqlUpdateDatabase['spas']['facebook'] = "ALTER TABLE `spas` ADD `facebook` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['spas']['website'] = "ALTER TABLE `spas` ADD `website` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['spas']['zalo'] = "ALTER TABLE `spas` ADD `zalo` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci DEFAULT NULL; ";

// Bang trademarks
$sqlUpdateDatabase['trademarks']['name'] = "ALTER TABLE `trademarks` ADD `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['trademarks']['description'] = "ALTER TABLE `trademarks` ADD `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['trademarks']['created_at'] = "ALTER TABLE `trademarks` ADD `created_at` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['trademarks']['id_member'] = "ALTER TABLE `trademarks` ADD `id_member` int(11) NOT NULL; ";
$sqlUpdateDatabase['trademarks']['image'] = "ALTER TABLE `trademarks` ADD `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['trademarks']['slug'] = "ALTER TABLE `trademarks` ADD `slug` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";

// Bang userservice_histories
$sqlUpdateDatabase['userservice_histories']['id_member'] = "ALTER TABLE `userservice_histories` ADD `id_member` int(11) NOT NULL; ";
$sqlUpdateDatabase['userservice_histories']['id_order_details'] = "ALTER TABLE `userservice_histories` ADD `id_order_details` int(11) NOT NULL; ";
$sqlUpdateDatabase['userservice_histories']['id_order'] = "ALTER TABLE `userservice_histories` ADD `id_order` int(11) NOT NULL; ";
$sqlUpdateDatabase['userservice_histories']['id_spa'] = "ALTER TABLE `userservice_histories` ADD `id_spa` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['userservice_histories']['id_services'] = "ALTER TABLE `userservice_histories` ADD `id_services` int(11) NOT NULL; ";
$sqlUpdateDatabase['userservice_histories']['id_staff'] = "ALTER TABLE `userservice_histories` ADD `id_staff` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['userservice_histories']['created_at'] = "ALTER TABLE `userservice_histories` ADD `created_at` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['userservice_histories']['note'] = "ALTER TABLE `userservice_histories` ADD `note` text DEFAULT NULL; ";
$sqlUpdateDatabase['userservice_histories']['id_bed'] = "ALTER TABLE `userservice_histories` ADD `id_bed` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['userservice_histories']['id_customer'] = "ALTER TABLE `userservice_histories` ADD `id_customer` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['userservice_histories']['status'] = "ALTER TABLE `userservice_histories` ADD `status` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['userservice_histories']['check_out'] = "ALTER TABLE `userservice_histories` ADD `check_out` INT NULL DEFAULT NULL;";

// Bang warehouses
$sqlUpdateDatabase['warehouses']['name'] = "ALTER TABLE `warehouses` ADD `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['warehouses']['description'] = "ALTER TABLE `warehouses` ADD `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['warehouses']['created_at'] = "ALTER TABLE `warehouses` ADD `created_at` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['warehouses']['credit'] = "ALTER TABLE `warehouses` ADD `credit` int(11) DEFAULT NULL COMMENT '1 cho bán âm, 0 không cho bán âm'; ";
$sqlUpdateDatabase['warehouses']['id_member'] = "ALTER TABLE `warehouses` ADD `id_member` int(11) NOT NULL; ";
$sqlUpdateDatabase['warehouses']['id_spa'] = "ALTER TABLE `warehouses` ADD `id_spa` int(11) NOT NULL; ";

// Bang warehouse_products
$sqlUpdateDatabase['warehouse_products']['id_member'] = "ALTER TABLE `warehouse_products` ADD `id_member` int(11) NOT NULL COMMENT 'ID '; ";
$sqlUpdateDatabase['warehouse_products']['id_spa'] = "ALTER TABLE `warehouse_products` ADD `id_spa` int(11) NOT NULL; ";
$sqlUpdateDatabase['warehouse_products']['id_staff'] = "ALTER TABLE `warehouse_products` ADD `id_staff` int(11) DEFAULT NULL COMMENT 'ID nhân viên thực hiện'; ";
$sqlUpdateDatabase['warehouse_products']['id_warehouse'] = "ALTER TABLE `warehouse_products` ADD `id_warehouse` int(11) NOT NULL COMMENT 'ID kho'; ";
$sqlUpdateDatabase['warehouse_products']['created_at'] = "ALTER TABLE `warehouse_products` ADD `created_at` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['warehouse_products']['id_partner'] = "ALTER TABLE `warehouse_products` ADD `id_partner` int(11) DEFAULT NULL; ";

// Bang warehouse_product_details
$sqlUpdateDatabase['warehouse_product_details']['id_member'] = "ALTER TABLE `warehouse_product_details` ADD `id_member` int(11) NOT NULL; ";
$sqlUpdateDatabase['warehouse_product_details']['id_warehouse_product'] = "ALTER TABLE `warehouse_product_details` ADD `id_warehouse_product` int(11) NOT NULL; ";
$sqlUpdateDatabase['warehouse_product_details']['id_product'] = "ALTER TABLE `warehouse_product_details` ADD `id_product` int(11) NOT NULL; ";
$sqlUpdateDatabase['warehouse_product_details']['impor_price'] = "ALTER TABLE `warehouse_product_details` ADD `impor_price` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['warehouse_product_details']['quantity'] = "ALTER TABLE `warehouse_product_details` ADD `quantity` int(11) NOT NULL; ";
$sqlUpdateDatabase['warehouse_product_details']['inventory_quantity'] = "ALTER TABLE `warehouse_product_details` ADD `inventory_quantity` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['warehouse_product_details']['created_at'] = "ALTER TABLE `warehouse_product_details` ADD `created_at` int(11) NOT NULL; ";
$sqlUpdateDatabase['warehouse_product_details']['id_warehouse'] = "ALTER TABLE `warehouse_product_details` ADD `id_warehouse` int(11) NOT NULL; ";

// Bang zalo_templates
$sqlUpdateDatabase['zalo_templates']['id_member'] = "ALTER TABLE `zalo_templates` ADD `id_member` int(11) NOT NULL; ";
$sqlUpdateDatabase['zalo_templates']['id_zns'] = "ALTER TABLE `zalo_templates` ADD `id_zns` int(11) NOT NULL; ";
$sqlUpdateDatabase['zalo_templates']['name'] = "ALTER TABLE `zalo_templates` ADD `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['zalo_templates']['content'] = "ALTER TABLE `zalo_templates` ADD `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`content`)); ";

$sqlUpdateDatabase['token_devices']['token_device'] = "ALTER TABLE `token_devices` ADD `token_device` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL ;";
$sqlUpdateDatabase['token_devices']['id_member'] = "ALTER TABLE `token_devices` ADD `id_member` INT NOT NULL DEFAULT '0' ;";
$sqlUpdateDatabase['token_devices']['token'] = "ALTER TABLE `token_devices` ADD `token` VARCHAR(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['token_devices']['type'] = "ALTER TABLE `token_devices` ADD `type` VARCHAR(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL;";

$sqlUpdateDatabase['staff_bonus']['id_staff'] = "ALTER TABLE `staff_bonus` ADD `id_staff` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['staff_bonus']['id_member'] = "ALTER TABLE `staff_bonus` ADD `id_member` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['staff_bonus']['note'] = "ALTER TABLE `staff_bonus` ADD `note` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['staff_bonus']['status'] = "ALTER TABLE `staff_bonus` ADD `status` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['staff_bonus']['type'] = "ALTER TABLE `staff_bonus` ADD `type` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['staff_bonus']['created_at'] = "ALTER TABLE `staff_bonus` ADD `created_at` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['staff_bonus']['updated_at'] = "ALTER TABLE `staff_bonus` ADD `updated_at` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['staff_bonus']['money'] = "ALTER TABLE `staff_bonus` ADD `money` INT NULL DEFAULT '0';";
$sqlUpdateDatabase['staff_bonus']['id_spa'] = "ALTER TABLE `staff_bonus` ADD `id_spa` INT NULL DEFAULT NULL;";

// bảng transaction_histories
$sqlUpdateDatabase['transaction_histories']['id_member'] = "ALTER TABLE `transaction_histories` ADD `id_member` INT NOT NULL;";
$sqlUpdateDatabase['transaction_histories']['coin'] = "ALTER TABLE `transaction_histories` ADD `coin` INT NOT NULL;";
$sqlUpdateDatabase['transaction_histories']['type'] = "ALTER TABLE `transaction_histories` ADD `type` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['transaction_histories']['note'] = "ALTER TABLE `transaction_histories` ADD `note` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;";
$sqlUpdateDatabase['transaction_histories']['create_at'] = "ALTER TABLE `transaction_histories` ADD `create_at` INT NOT NULL;";
$sqlUpdateDatabase['transaction_histories']['meta_payment'] = "ALTER TABLE `transaction_histories` ADD `meta_payment` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['transaction_histories']['payment_type'] = "ALTER TABLE `transaction_histories` ADD `payment_type` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'payQrcode';";

$sqlUpdateDatabase['staff_timekeepers']['day'] = "ALTER TABLE `staff_timekeepers` ADD `day` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['staff_timekeepers']['shift'] = "ALTER TABLE `staff_timekeepers` ADD `shift` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['staff_timekeepers']['note'] = "ALTER TABLE `staff_timekeepers` ADD `note` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['staff_timekeepers']['id_staff'] = "ALTER TABLE `staff_timekeepers` ADD `id_staff` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['staff_timekeepers']['id_member'] = "ALTER TABLE `staff_timekeepers` ADD `id_member` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['staff_timekeepers']['id_spa'] = "ALTER TABLE `staff_timekeepers` ADD `id_spa` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['staff_timekeepers']['check_in'] = "ALTER TABLE `staff_timekeepers` ADD `check_in` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['staff_timekeepers']['created_at'] = "ALTER TABLE `staff_timekeepers` ADD `created_at` INT NULL DEFAULT NUL;";

$sqlUpdateDatabase['payrolls']['salary'] = "ALTER TABLE `payrolls` ADD `salary` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['payrolls']['work'] = "ALTER TABLE `payrolls` ADD `work` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['payrolls']['working_day'] = "ALTER TABLE `payrolls` ADD `working_day` FLOAT NULL DEFAULT NULL;";
$sqlUpdateDatabase['payrolls']['commission'] = "ALTER TABLE `payrolls` ADD `commission` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['payrolls']['bonus'] = "ALTER TABLE `payrolls` ADD `bonus` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['payrolls']['allowance'] = "ALTER TABLE `payrolls` ADD `allowance` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['payrolls']['fine'] = "ALTER TABLE `payrolls` ADD `fine` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['payrolls']['insurance'] = "ALTER TABLE `payrolls` ADD `insurance` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['payrolls']['advance'] = "ALTER TABLE `payrolls` ADD `advance` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['payrolls']['status'] = "ALTER TABLE `payrolls` ADD `status` VARCHAR(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['payrolls']['note'] = "ALTER TABLE `payrolls` ADD `note` VARCHAR(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['payrolls']['month'] = "ALTER TABLE `payrolls` ADD `month` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['payrolls']['yer'] = "ALTER TABLE `payrolls` ADD `yer` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['payrolls']['fixed_salary'] = "ALTER TABLE `payrolls` ADD `fixed_salary` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['payrolls']['id_member'] = "ALTER TABLE `payrolls` ADD `id_member` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['payrolls']['id_staff'] = "ALTER TABLE `payrolls` ADD `id_staff` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['payrolls']['created_at'] = "ALTER TABLE `payrolls` ADD `created_at` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['payrolls']['updated_at'] = "ALTER TABLE `payrolls` ADD `updated_at` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['payrolls']['payment_date'] = "ALTER TABLE `payrolls` ADD `payment_date` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['payrolls']['note_boss'] = "ALTER TABLE `payrolls` ADD `note_boss` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
/*-- Bước 1: Thêm cột tạm kiểu INT 
ALTER TABLE userservice_histories ADD COLUMN temp_int INT;

-- Bước 2: Chuyển dữ liệu từ int(11) sang INT
UPDATE userservice_histories SET temp_int = UNIX_TIMESTAMP(created_at);

-- Bước 3: Xóa cột int(11) cũ
ALTER TABLE userservice_histories DROP COLUMN created_at;

-- Bước 4: Đổi tên cột tạm thành tên cột ban đầu
ALTER TABLE userservice_histories CHANGE COLUMN temp_int created_at INT;
*/
?>