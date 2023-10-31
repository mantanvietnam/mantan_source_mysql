<?php
global $sqlInstallDatabase;
global $sqlDeleteDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';

$sqlInstallDatabase .= 'CREATE TABLE `bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `posted_by` int(11) NOT NULL,
  `received_by` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `start_time` datetime DEFAULT NULL,
  `finish_time` datetime DEFAULT NULL,
  `departure` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `departure_province_id` int(11) NOT NULL,
  `destination_province_id` int(11) NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `introduce_fee` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp on update current_timestamp() NOT NULL DEFAULT current_timestamp(),
  `received_at` timestamp NULL DEFAULT NULL,
  `canceled_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `provinces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gps` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bsx` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `driver_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `type` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp on update current_timestamp() NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `bank_account` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_coin` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp on update current_timestamp() NOT NULL DEFAULT current_timestamp(),
  `last_login` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `access_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_id` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_id` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apple_id` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reset_password_code` VARCHAR(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `excgo_app`.`pinned_provinces` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `province_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `excgo_app`.`booking_fees` (
  `id` int NOT NULL AUTO_INCREMENT,
  `received_fee` int NOT NULL,
  `service_fee` int NOT NULL,
  `booking_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp on update current_timestamp() NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `excgo_app`.`driver_requests` (
    `id` int NOT NULL AUTO_INCREMENT,
    `user_id` int NOT NULL,
    `status` tinyint(1) NOT NULL DEFAULT 0,
    `handled_by` int DEFAULT NULL,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
    `updated_at` timestamp on update current_timestamp() NOT NULL DEFAULT current_timestamp(),
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `excgo_app`.`withdraw_requests` (
    `id` int NOT NULL AUTO_INCREMENT,
    `user_id` int NOT NULL,
    `amount` int NOT NULL,
    `status` tinyint(4) NOT NULL DEFAULT 0,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
    `updated_at` timestamp on update current_timestamp() NOT NULL DEFAULT current_timestamp(),
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `excgo_app`.`transactions` (
    `id` int NOT NULL AUTO_INCREMENT,
    `user_id` int NOT NULL,
    `booking_id` int DEFAULT NULL,
    `name` varchar(255) NOT NULL,
    `amount` int NOT NULL DEFAULT 0,
    `description` text DEFAULT NULL,
    `status` tinyint(4) NOT NULL DEFAULT 1,
    `type` tinyint(4) NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
    `updated_at` timestamp on update current_timestamp() NOT NULL DEFAULT current_timestamp(),
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `excgo_app`.`complaints` (
    `id` int NOT NULL AUTO_INCREMENT,
    `posted_by` int NOT NULL,
    `booking_id` int NOT NULL,
    `complained_driver_id` int NOT NULL,
    `content` text NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
    `updated_at` timestamp on update current_timestamp() NOT NULL DEFAULT current_timestamp(),
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `excgo_app`.`notifications` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `content` VARCHAR CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `is_viewed` TINYINT(1) NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`), 
    INDEX `user_id_index` (`user_id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `excgo_app`.`user_bookings` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `user_id` INT NOT NULL , 
    `booking_id` INT NOT NULL , 
    `type` TINYINT(4) NOT NULL COMMENT "1: Cuốc đăng, 2: Cuốc nhận",
    `status` TINYINT(4) NOT NULL COMMENT "	0: Chưa được nhận, 1: Đã nhận, 2: Hủy, 3: Hoàn thành, 4: Đã thanh toán", 
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `canceled_at` TIMESTAMP NULL DEFAULT NULL , 
    `received_at` TIMESTAMP NULL DEFAULT NULL , 
    PRIMARY KEY (`id`), 
    INDEX `user_id_index` (`user_id`), 
    INDEX `booking_id_index` (`booking_id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `excgo_app`.`support_requests` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `user_id` INT NOT NULL , 
    `content` TEXT NOT NULL , 
    `status` TINYINT(4) NOT NULL DEFAULT 0 COMMENT "0: Chưa xử lý; 1: Đã xử lý" ,
     `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
     `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
     PRIMARY KEY (`id`), 
     INDEX `user_id_index` (`user_id`)
) ENGINE = InnoDB;';

$sqlDeleteDatabase .= 'DROP TABLE IF EXISTS `bookings`;';
$sqlDeleteDatabase .= 'DROP TABLE IF EXISTS `images`;';
$sqlDeleteDatabase .= 'DROP TABLE IF EXISTS `provinces`;';
$sqlDeleteDatabase .= 'DROP TABLE IF EXISTS `transactions`;';
$sqlDeleteDatabase .= 'DROP TABLE IF EXISTS `users`;';
$sqlDeleteDatabase .= 'DROP TABLE IF EXISTS `pinned_provinces`;';
$sqlDeleteDatabase .= 'DROP TABLE IF EXISTS `booking_fees`;';
$sqlDeleteDatabase .= 'DROP TABLE IF EXISTS `driver_requests`;';
$sqlDeleteDatabase .= 'DROP TABLE IF EXISTS `withdraw_requests`;';
$sqlDeleteDatabase .= 'DROP TABLE IF EXISTS `transactions`;';
$sqlDeleteDatabase .= 'DROP TABLE IF EXISTS `complaints`;';
$sqlDeleteDatabase .= 'DROP TABLE IF EXISTS `notifications`;';
$sqlDeleteDatabase .= 'DROP TABLE IF EXISTS `user_bookings`;';
$sqlDeleteDatabase .= 'DROP TABLE IF EXISTS `support_requests`;';
?>
