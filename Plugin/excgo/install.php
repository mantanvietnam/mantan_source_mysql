<?php
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];

$sqlInstallDatabase .= 'CREATE TABLE `bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `posted_by` int(11) NOT NULL,
  `received_by` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `start_time` datetime DEFAULT NULL,
  `finish_time` datetime DEFAULT NULL,
  `departure` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `destination` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departure_province_id` int(11) NOT NULL,
  `destination_province_id` int(11) DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `introduce_fee` int(11) NOT NULL,
  `deposit` INT NOT NULL DEFAULT 0 COMMENT "Tiền cọc",
  `price` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp on update current_timestamp() NOT NULL DEFAULT current_timestamp(),
  `received_at` timestamp NULL DEFAULT NULL,
  `completed_at` TIMESTAMP NULL DEFAULT NULL,
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
  `parent_id` INT NOT NULL DEFAULT 0,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gps` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bsx` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `point` int(11) NOT NULL DEFAULT 0,
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
  `deposit` INT NOT NULL DEFAULT 0 COMMENT "Tiền cọc"
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
    `status` tinyint NOT NULL default 0,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
    `updated_at` timestamp on update current_timestamp() NOT NULL DEFAULT current_timestamp(),
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `excgo_app`.`notifications` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `request_id` INT NULL,
    `booking_id` INT NULL,
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

$sqlInstallDatabase .= 'CREATE TABLE `excgo_app`.`booking_deals` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `booking_id` INT NOT NULL , 
    `user_id` INT NOT NULL , 
    `price` INT NOT NULL , 
    `introduce_fee` INT NOT NULL , 
    `status` TINYINT NOT NULL COMMENT "1: mới, 2: đã nhận" , 
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    PRIMARY KEY (`id`), 
    INDEX `booking_id_index` (`booking_id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `excgo_app`.`canceled_booking_requests` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `booking_id` INT NOT NULL , 
    `user_id` INT NOT NULL ,
    `request_id` INT NULL ,
    `status` TINYINT NOT NULL DEFAULT 0 , 
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    PRIMARY KEY (`id`), 
    INDEX `booking_id_index` (`booking_id`) ,
    INDEX `user_id_index` (`user_id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `excgo_app` . `bookmarks` (
    `id` BIGINT NOT NULL AUTO_INCREMENT , 
    `user_id` INT NOT NULL , 
    `province_id` INT NOT NULL , 
    `created_at` TIMESTAMP NULL default NULL , 
    `updated_at` TIMESTAMP NULL default NULL , 
    PRIMARY KEY(`id`), 
    INDEX `user_id_index` (`user_id`), 
    INDEX `provincec_id_index` (`province_id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `excgo_app`.`block_user_provinces` (
    `id` INT NULL ,
    `user_id` INT NOT NULL ,
    `province_id` INT NOT NULL , 
    PRIMARY KEY (`id`))
     ENGINE = InnoDB;';

$sqlInstallDatabase .='CREATE TABLE `rewards` ( 
    `id` INT NOT NULL AUTO_INCREMENT ,
    `name` VARCHAR(255) NULL , 
    `start_date` TIMESTAMP NOT NULL , 
    `end_date` TIMESTAMP NOT NULL , 
    `created_at` TIMESTAMP NOT NULL , 
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `quantity_booking` INT NOT NULL , 
    `money` INT NOT NULL , 
    `status` TINYINT NOT NULL DEFAULT '0' , 
    `note` TEXT NULL DEFAULT NULL ,
    `user_id` TEXT NULL DEFAULT NULL ,
     PRIMARY KEY (`id`)) ENGINE = InnoDB;';

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
$sqlDeleteDatabase .= 'DROP TABLE IF EXISTS `booking_deals`;';
$sqlDeleteDatabase .= 'DROP TABLE IF EXISTS `canceled_booking_requests`;';
$sqlDeleteDatabase .= 'DROP TABLE IF EXISTS `block_user_provinces`;';
$sqlDeleteDatabase .= 'DROP TABLE IF EXISTS `rewards`;';

// Bang bookings
$sqlUpdateDatabase['bookings']['name'] = "ALTER TABLE `bookings` ADD `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['bookings']['posted_by'] = "ALTER TABLE `bookings` ADD `posted_by` int(11) NOT NULL; ";
$sqlUpdateDatabase['bookings']['received_by'] = "ALTER TABLE `bookings` ADD `received_by` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['bookings']['status'] = "ALTER TABLE `bookings` ADD `status` tinyint(4) NOT NULL DEFAULT 0; ";
$sqlUpdateDatabase['bookings']['start_time'] = "ALTER TABLE `bookings` ADD `start_time` datetime DEFAULT NULL; ";
$sqlUpdateDatabase['bookings']['finish_time'] = "ALTER TABLE `bookings` ADD `finish_time` datetime DEFAULT NULL; ";
$sqlUpdateDatabase['bookings']['departure'] = "ALTER TABLE `bookings` ADD `departure` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['bookings']['destination'] = "ALTER TABLE `bookings` ADD `destination` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['bookings']['departure_province_id'] = "ALTER TABLE `bookings` ADD `departure_province_id` int(11) NOT NULL; ";
$sqlUpdateDatabase['bookings']['destination_province_id'] = "ALTER TABLE `bookings` ADD `destination_province_id` int(11) DEFAULT NULL; ";
$sqlUpdateDatabase['bookings']['description'] = "ALTER TABLE `bookings` ADD `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['bookings']['introduce_fee'] = "ALTER TABLE `bookings` ADD `introduce_fee` int(11) NOT NULL; ";
$sqlUpdateDatabase['bookings']['deposit'] = "ALTER TABLE `bookings` ADD `deposit` INT NOT NULL DEFAULT 0 COMMENT "Tiền cọc"; ";
$sqlUpdateDatabase['bookings']['price'] = "ALTER TABLE `bookings` ADD `price` int(11) NOT NULL; ";
$sqlUpdateDatabase['bookings']['created_at'] = "ALTER TABLE `bookings` ADD `created_at` timestamp NOT NULL DEFAULT current_timestamp(); ";
$sqlUpdateDatabase['bookings']['updated_at'] = "ALTER TABLE `bookings` ADD `updated_at` timestamp on update current_timestamp() NOT NULL DEFAULT current_timestamp(); ";
$sqlUpdateDatabase['bookings']['received_at'] = "ALTER TABLE `bookings` ADD `received_at` timestamp NULL DEFAULT NULL; ";
$sqlUpdateDatabase['bookings']['completed_at'] = "ALTER TABLE `bookings` ADD `completed_at` TIMESTAMP NULL DEFAULT NULL; ";
$sqlUpdateDatabase['bookings']['canceled_at'] = "ALTER TABLE `bookings` ADD `canceled_at` timestamp NULL DEFAULT NULL; ";

// Bang images
$sqlUpdateDatabase['images']['path'] = "ALTER TABLE `images` ADD `path` varchar(255) NOT NULL; ";
$sqlUpdateDatabase['images']['type'] = "ALTER TABLE `images` ADD `type` tinyint(4) NOT NULL; ";
$sqlUpdateDatabase['images']['owner_id'] = "ALTER TABLE `images` ADD `owner_id` int(11) NOT NULL; ";
$sqlUpdateDatabase['images']['created_at'] = "ALTER TABLE `images` ADD `created_at` timestamp NOT NULL DEFAULT current_timestamp(); ";

// Bang provinces
$sqlUpdateDatabase['provinces']['parent_id'] = "ALTER TABLE `provinces` ADD `parent_id` INT NOT NULL DEFAULT 0; ";
$sqlUpdateDatabase['provinces']['name'] = "ALTER TABLE `provinces` ADD `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['provinces']['gps'] = "ALTER TABLE `provinces` ADD `gps` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['provinces']['bsx'] = "ALTER TABLE `provinces` ADD `bsx` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['provinces']['status'] = "ALTER TABLE `provinces` ADD `status` tinyint(1) NOT NULL DEFAULT 0; ";

// Bang transactions
$sqlUpdateDatabase['transactions']['driver_id'] = "ALTER TABLE `transactions` ADD `driver_id` int(11) NOT NULL; ";
$sqlUpdateDatabase['transactions']['name'] = "ALTER TABLE `transactions` ADD `name` varchar(255) NOT NULL; ";
$sqlUpdateDatabase['transactions']['amount'] = "ALTER TABLE `transactions` ADD `amount` int(11) NOT NULL DEFAULT 0; ";
$sqlUpdateDatabase['transactions']['description'] = "ALTER TABLE `transactions` ADD `description` text DEFAULT NULL; ";
$sqlUpdateDatabase['transactions']['status'] = "ALTER TABLE `transactions` ADD `status` tinyint(4) NOT NULL DEFAULT 1; ";
$sqlUpdateDatabase['transactions']['type'] = "ALTER TABLE `transactions` ADD `type` tinyint(4) NOT NULL; ";
$sqlUpdateDatabase['transactions']['created_at'] = "ALTER TABLE `transactions` ADD `created_at` timestamp NOT NULL DEFAULT current_timestamp(); ";
$sqlUpdateDatabase['transactions']['updated_at'] = "ALTER TABLE `transactions` ADD `updated_at` timestamp on update current_timestamp() NOT NULL DEFAULT current_timestamp(); ";

// Bang users
$sqlUpdateDatabase['users']['name'] = "ALTER TABLE `users` ADD `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['users']['phone_number'] = "ALTER TABLE `users` ADD `phone_number` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['users']['password'] = "ALTER TABLE `users` ADD `password` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['users']['is_verified'] = "ALTER TABLE `users` ADD `is_verified` tinyint(1) NOT NULL DEFAULT 0; ";
$sqlUpdateDatabase['users']['email'] = "ALTER TABLE `users` ADD `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['users']['avatar'] = "ALTER TABLE `users` ADD `avatar` varchar(255) DEFAULT NULL; ";
$sqlUpdateDatabase['users']['birthday'] = "ALTER TABLE `users` ADD `birthday` date DEFAULT NULL; ";
$sqlUpdateDatabase['users']['address'] = "ALTER TABLE `users` ADD `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['users']['type'] = "ALTER TABLE `users` ADD `type` tinyint(1) NOT NULL DEFAULT 0; ";
$sqlUpdateDatabase['users']['point'] = "ALTER TABLE `users` ADD `point` int(11) NOT NULL DEFAULT 0; ";
$sqlUpdateDatabase['users']['bank_account'] = "ALTER TABLE `users` ADD `bank_account` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['users']['account_number'] = "ALTER TABLE `users` ADD `account_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['users']['total_coin'] = "ALTER TABLE `users` ADD `total_coin` int(11) NOT NULL DEFAULT 0; ";
$sqlUpdateDatabase['users']['created_at'] = "ALTER TABLE `users` ADD `created_at` timestamp NOT NULL DEFAULT current_timestamp(); ";
$sqlUpdateDatabase['users']['updated_at'] = "ALTER TABLE `users` ADD `updated_at` timestamp on update current_timestamp() NOT NULL DEFAULT current_timestamp(); ";
$sqlUpdateDatabase['users']['last_login'] = "ALTER TABLE `users` ADD `last_login` timestamp NULL DEFAULT NULL; ";
$sqlUpdateDatabase['users']['status'] = "ALTER TABLE `users` ADD `status` tinyint(1) NOT NULL DEFAULT 1; ";
$sqlUpdateDatabase['users']['access_token'] = "ALTER TABLE `users` ADD `access_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['users']['device_token'] = "ALTER TABLE `users` ADD `device_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['users']['facebook_id'] = "ALTER TABLE `users` ADD `facebook_id` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['users']['google_id'] = "ALTER TABLE `users` ADD `google_id` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['users']['apple_id'] = "ALTER TABLE `users` ADD `apple_id` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['users']['reset_password_code'] = "ALTER TABLE `users` ADD `reset_password_code` VARCHAR(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['users']['deleted_at'] = "ALTER TABLE `users` ADD `deleted_at` timestamp NULL DEFAULT NULL; ";

// Bang pinned_provinces
$sqlUpdateDatabase['pinned_provinces']['user_id'] = "ALTER TABLE `pinned_provinces` ADD `user_id` int NOT NULL; ";
$sqlUpdateDatabase['pinned_provinces']['province_id'] = "ALTER TABLE `pinned_provinces` ADD `province_id` int NOT NULL; ";
$sqlUpdateDatabase['pinned_provinces']['created_at'] = "ALTER TABLE `pinned_provinces` ADD `created_at` timestamp NOT NULL DEFAULT current_timestamp(); ";

// Bang booking_fees
$sqlUpdateDatabase['booking_fees']['received_fee'] = "ALTER TABLE `booking_fees` ADD `received_fee` int NOT NULL; ";
$sqlUpdateDatabase['booking_fees']['service_fee'] = "ALTER TABLE `booking_fees` ADD `service_fee` int NOT NULL; ";
$sqlUpdateDatabase['booking_fees']['deposit'] = "ALTER TABLE `booking_fees` ADD `deposit` INT NOT NULL DEFAULT 0 COMMENT "Tiền cọc"; ";
$sqlUpdateDatabase['booking_fees']['booking_id'] = "ALTER TABLE `booking_fees` ADD `booking_id` int NOT NULL; ";
$sqlUpdateDatabase['booking_fees']['created_at'] = "ALTER TABLE `booking_fees` ADD `created_at` timestamp NOT NULL DEFAULT current_timestamp(); ";
$sqlUpdateDatabase['booking_fees']['updated_at'] = "ALTER TABLE `booking_fees` ADD `updated_at` timestamp on update current_timestamp() NOT NULL DEFAULT current_timestamp(); ";
$sqlUpdateDatabase['booking_fees']['deleted_at'] = "ALTER TABLE `booking_fees` ADD `deleted_at` timestamp NULL DEFAULT NULL; ";

// Bang driver_requests
$sqlUpdateDatabase['driver_requests']['user_id'] = "ALTER TABLE `driver_requests` ADD `user_id` int NOT NULL; ";
$sqlUpdateDatabase['driver_requests']['status'] = "ALTER TABLE `driver_requests` ADD `status` tinyint(1) NOT NULL DEFAULT 0; ";
$sqlUpdateDatabase['driver_requests']['handled_by'] = "ALTER TABLE `driver_requests` ADD `handled_by` int DEFAULT NULL; ";
$sqlUpdateDatabase['driver_requests']['created_at'] = "ALTER TABLE `driver_requests` ADD `created_at` timestamp NOT NULL DEFAULT current_timestamp(); ";
$sqlUpdateDatabase['driver_requests']['updated_at'] = "ALTER TABLE `driver_requests` ADD `updated_at` timestamp on update current_timestamp() NOT NULL DEFAULT current_timestamp(); ";

// Bang withdraw_requests
$sqlUpdateDatabase['withdraw_requests']['user_id'] = "ALTER TABLE `withdraw_requests` ADD `user_id` int NOT NULL; ";
$sqlUpdateDatabase['withdraw_requests']['amount'] = "ALTER TABLE `withdraw_requests` ADD `amount` int NOT NULL; ";
$sqlUpdateDatabase['withdraw_requests']['status'] = "ALTER TABLE `withdraw_requests` ADD `status` tinyint(4) NOT NULL DEFAULT 0; ";
$sqlUpdateDatabase['withdraw_requests']['created_at'] = "ALTER TABLE `withdraw_requests` ADD `created_at` timestamp NOT NULL DEFAULT current_timestamp(); ";
$sqlUpdateDatabase['withdraw_requests']['updated_at'] = "ALTER TABLE `withdraw_requests` ADD `updated_at` timestamp on update current_timestamp() NOT NULL DEFAULT current_timestamp(); ";

// Bang transactions
$sqlUpdateDatabase['transactions']['user_id'] = "ALTER TABLE `transactions` ADD `user_id` int NOT NULL; ";
$sqlUpdateDatabase['transactions']['booking_id'] = "ALTER TABLE `transactions` ADD `booking_id` int DEFAULT NULL; ";
$sqlUpdateDatabase['transactions']['name'] = "ALTER TABLE `transactions` ADD `name` varchar(255) NOT NULL; ";
$sqlUpdateDatabase['transactions']['amount'] = "ALTER TABLE `transactions` ADD `amount` int NOT NULL DEFAULT 0; ";
$sqlUpdateDatabase['transactions']['description'] = "ALTER TABLE `transactions` ADD `description` text DEFAULT NULL; ";
$sqlUpdateDatabase['transactions']['status'] = "ALTER TABLE `transactions` ADD `status` tinyint(4) NOT NULL DEFAULT 1; ";
$sqlUpdateDatabase['transactions']['type'] = "ALTER TABLE `transactions` ADD `type` tinyint(4) NOT NULL; ";
$sqlUpdateDatabase['transactions']['created_at'] = "ALTER TABLE `transactions` ADD `created_at` timestamp NOT NULL DEFAULT current_timestamp(); ";
$sqlUpdateDatabase['transactions']['updated_at'] = "ALTER TABLE `transactions` ADD `updated_at` timestamp on update current_timestamp() NOT NULL DEFAULT current_timestamp(); ";

// Bang complaints
$sqlUpdateDatabase['complaints']['posted_by'] = "ALTER TABLE `complaints` ADD `posted_by` int NOT NULL; ";
$sqlUpdateDatabase['complaints']['booking_id'] = "ALTER TABLE `complaints` ADD `booking_id` int NOT NULL; ";
$sqlUpdateDatabase['complaints']['complained_driver_id'] = "ALTER TABLE `complaints` ADD `complained_driver_id` int NOT NULL; ";
$sqlUpdateDatabase['complaints']['content'] = "ALTER TABLE `complaints` ADD `content` text NOT NULL; ";
$sqlUpdateDatabase['complaints']['status'] = "ALTER TABLE `complaints` ADD `status` tinyint NOT NULL default 0; ";
$sqlUpdateDatabase['complaints']['created_at'] = "ALTER TABLE `complaints` ADD `created_at` timestamp NOT NULL DEFAULT current_timestamp(); ";
$sqlUpdateDatabase['complaints']['updated_at'] = "ALTER TABLE `complaints` ADD `updated_at` timestamp on update current_timestamp() NOT NULL DEFAULT current_timestamp(); ";

// Bang notifications
$sqlUpdateDatabase['notifications']['user_id'] = "ALTER TABLE `notifications` ADD `user_id` INT NOT NULL; ";
$sqlUpdateDatabase['notifications']['request_id'] = "ALTER TABLE `notifications` ADD `request_id` INT NULL; ";
$sqlUpdateDatabase['notifications']['booking_id'] = "ALTER TABLE `notifications` ADD `booking_id` INT NULL; ";
$sqlUpdateDatabase['notifications']['content'] = "ALTER TABLE `notifications` ADD `content` VARCHAR CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['notifications']['is_viewed'] = "ALTER TABLE `notifications` ADD `is_viewed` TINYINT(1) NOT NULL DEFAULT 0; ";
$sqlUpdateDatabase['notifications']['created_at'] = "ALTER TABLE `notifications` ADD `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP; ";
$sqlUpdateDatabase['notifications']['updated_at'] = "ALTER TABLE `notifications` ADD `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP; ";

// Bang user_bookings
$sqlUpdateDatabase['user_bookings']['user_id'] = "ALTER TABLE `user_bookings` ADD `user_id` INT NOT NULL; ";
$sqlUpdateDatabase['user_bookings']['booking_id'] = "ALTER TABLE `user_bookings` ADD `booking_id` INT NOT NULL; ";
$sqlUpdateDatabase['user_bookings']['type'] = "ALTER TABLE `user_bookings` ADD `type` TINYINT(4) NOT NULL COMMENT "1: Cuốc đăng, 2: Cuốc nhận"; ";
$sqlUpdateDatabase['user_bookings']['status'] = "ALTER TABLE `user_bookings` ADD `status` TINYINT(4) NOT NULL COMMENT " 0: Chưa được nhận, 1: Đã nhận, 2: Hủy, 3: Hoàn thành, 4: Đã thanh toán"; ";
$sqlUpdateDatabase['user_bookings']['created_at'] = "ALTER TABLE `user_bookings` ADD `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP; ";
$sqlUpdateDatabase['user_bookings']['canceled_at'] = "ALTER TABLE `user_bookings` ADD `canceled_at` TIMESTAMP NULL DEFAULT NULL; ";
$sqlUpdateDatabase['user_bookings']['received_at'] = "ALTER TABLE `user_bookings` ADD `received_at` TIMESTAMP NULL DEFAULT NULL; ";

// Bang support_requests
$sqlUpdateDatabase['support_requests']['user_id'] = "ALTER TABLE `support_requests` ADD `user_id` INT NOT NULL; ";
$sqlUpdateDatabase['support_requests']['content'] = "ALTER TABLE `support_requests` ADD `content` TEXT NOT NULL; ";
$sqlUpdateDatabase['support_requests']['status'] = "ALTER TABLE `support_requests` ADD `status` TINYINT(4) NOT NULL DEFAULT 0 COMMENT "0: Chưa xử lý; 1: Đã xử lý"; ";
$sqlUpdateDatabase['support_requests']['created_at'] = "ALTER TABLE `support_requests` ADD `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP; ";
$sqlUpdateDatabase['support_requests']['updated_at'] = "ALTER TABLE `support_requests` ADD `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP; ";

// Bang booking_deals
$sqlUpdateDatabase['booking_deals']['booking_id'] = "ALTER TABLE `booking_deals` ADD `booking_id` INT NOT NULL; ";
$sqlUpdateDatabase['booking_deals']['user_id'] = "ALTER TABLE `booking_deals` ADD `user_id` INT NOT NULL; ";
$sqlUpdateDatabase['booking_deals']['price'] = "ALTER TABLE `booking_deals` ADD `price` INT NOT NULL; ";
$sqlUpdateDatabase['booking_deals']['introduce_fee'] = "ALTER TABLE `booking_deals` ADD `introduce_fee` INT NOT NULL; ";
$sqlUpdateDatabase['booking_deals']['status'] = "ALTER TABLE `booking_deals` ADD `status` TINYINT NOT NULL COMMENT "1: mới, 2: đã nhận"; ";
$sqlUpdateDatabase['booking_deals']['created_at'] = "ALTER TABLE `booking_deals` ADD `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP; ";
$sqlUpdateDatabase['booking_deals']['updated_at'] = "ALTER TABLE `booking_deals` ADD `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP; ";

// Bang canceled_booking_requests
$sqlUpdateDatabase['canceled_booking_requests']['booking_id'] = "ALTER TABLE `canceled_booking_requests` ADD `booking_id` INT NOT NULL; ";
$sqlUpdateDatabase['canceled_booking_requests']['user_id'] = "ALTER TABLE `canceled_booking_requests` ADD `user_id` INT NOT NULL; ";
$sqlUpdateDatabase['canceled_booking_requests']['request_id'] = "ALTER TABLE `canceled_booking_requests` ADD `request_id` INT NULL; ";
$sqlUpdateDatabase['canceled_booking_requests']['status'] = "ALTER TABLE `canceled_booking_requests` ADD `status` TINYINT NOT NULL DEFAULT 0; ";
$sqlUpdateDatabase['canceled_booking_requests']['created_at'] = "ALTER TABLE `canceled_booking_requests` ADD `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP; ";
$sqlUpdateDatabase['canceled_booking_requests']['updated_at'] = "ALTER TABLE `canceled_booking_requests` ADD `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP; ";

// Bang bookmarks
$sqlUpdateDatabase['bookmarks']['user_id'] = "ALTER TABLE `bookmarks` ADD `user_id` INT NOT NULL; ";
$sqlUpdateDatabase['bookmarks']['province_id'] = "ALTER TABLE `bookmarks` ADD `province_id` INT NOT NULL; ";
$sqlUpdateDatabase['bookmarks']['created_at'] = "ALTER TABLE `bookmarks` ADD `created_at` TIMESTAMP NULL default NULL; ";
$sqlUpdateDatabase['bookmarks']['updated_at'] = "ALTER TABLE `bookmarks` ADD `updated_at` TIMESTAMP NULL default NULL; ";

// Bang block_user_provinces
$sqlUpdateDatabase['block_user_provinces']['user_id'] = "ALTER TABLE `block_user_provinces` ADD `user_id` INT NOT NULL; ";
$sqlUpdateDatabase['block_user_provinces']['province_id'] = "ALTER TABLE `block_user_provinces` ADD `province_id` INT NOT NULL; ";

// Bang rewards
$sqlUpdateDatabase['rewards']['name'] = "ALTER TABLE `rewards` ADD `name` VARCHAR(255) NULL; ";
$sqlUpdateDatabase['rewards']['start_date'] = "ALTER TABLE `rewards` ADD `start_date` TIMESTAMP NOT NULL; ";
$sqlUpdateDatabase['rewards']['end_date'] = "ALTER TABLE `rewards` ADD `end_date` TIMESTAMP NOT NULL; ";
$sqlUpdateDatabase['rewards']['created_at'] = "ALTER TABLE `rewards` ADD `created_at` TIMESTAMP NOT NULL; ";
$sqlUpdateDatabase['rewards']['updated_at'] = "ALTER TABLE `rewards` ADD `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP; ";
$sqlUpdateDatabase['rewards']['quantity_booking'] = "ALTER TABLE `rewards` ADD `quantity_booking` INT NOT NULL; ";
$sqlUpdateDatabase['rewards']['money'] = "ALTER TABLE `rewards` ADD `money` INT NOT NULL; ";
$sqlUpdateDatabase['rewards']['status'] = "ALTER TABLE `rewards` ADD `status` TINYINT NOT NULL DEFAULT '0'; ";
$sqlUpdateDatabase['rewards']['note'] = "ALTER TABLE `rewards` ADD `note` TEXT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['rewards']['user_id'] = "ALTER TABLE `rewards` ADD `user_id` TEXT NULL DEFAULT NULL; ";
?>