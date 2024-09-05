<?php
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];

$sqlInstallDatabase .= 'CREATE TABLE `users` ( 
`id` INT NOT NULL AUTO_INCREMENT , 
`full_name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL ,
`phone` VARCHAR(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`email` VARCHAR(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`address` VARCHAR(255) NOT NULL ,
`birthday` INT NOT NULL ,
`avatar` VARCHAR(255) NOT NULL , 
`type` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
`created_at` INT NOT NULL ,
`updated_at` INT NOT NULL ,
`password` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
`status` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT "active" ,
`token` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`device_token` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`google_id` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
`apple_id` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`info` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
`last_login` INT NULL DEFAULT NULL , 
`total_coin` INT NULL DEFAULT 0,
`current_weight` INT NULL DEFAULT NULL , 
`target_weight` INT NULL DEFAULT NULL ,
`height` INT NULL DEFAULT NULL , 
`deadline` INT NULL DEFAULT NULL ,
`reset_password_code` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
`sex` INT NULL DEFAULT 1 COMMENT "1 nam, 2 nu" , 
PRIMARY KEY (`id`)
) ENGINE = InnoDB;';
$sqlInstallDatabase .="CREATE TABLE `tests` (
  `id` int(11) NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `status` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `id_course` int(11) DEFAULT NULL,
  `point_min` float NOT NULL DEFAULT 10
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sqlDeleteDatabase .="CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` text CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `option_a` text CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `option_b` text CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `option_c` text CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `option_d` text CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `option_true` varchar(255) NOT NULL,
  `id_test` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
$sqlDeleteDatabase .="CREATE TABLE `lessons` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `content` text CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `id_course` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `slug` varchar(255) NOT NULL,
  `view` int(11) NOT NULL DEFAULT 0,
  `youtube_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sqlDeleteDatabase .="CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `image` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `view` int(11) NOT NULL DEFAULT 0,
  `youtube_code` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` varchar(255) NOT NULL,
  `content` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `public` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
$sqlDeleteDatabase .="CREATE TABLE `historytests` (
  `id` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_test` int(11) NOT NULL,
  `point` float NOT NULL,
  `total_true` int(11) NOT NULL,
  `number_question` int(11) NOT NULL,
  `time_start` int(11) NOT NULL,
  `time_end` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
$sqlDeleteDatabase .= 'DROP TABLE IF EXISTS `users`;';


$sqlUpdateDatabase['users']['full_name'] = "ALTER TABLE `users` ADD `full_name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;";
$sqlUpdateDatabase['users']['phone'] = "ALTER TABLE `users` ADD `phone` VARCHAR(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['users']['email'] = "ALTER TABLE `users` ADD `email` VARCHAR(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['users']['address'] = "ALTER TABLE `users` ADD `address` VARCHAR(255) NOT NULL;";
$sqlUpdateDatabase['users']['birthday'] = "ALTER TABLE `users` ADD `birthday` INT NOT NULL;";
$sqlUpdateDatabase['users']['avatar'] = "ALTER TABLE `users` ADD `avatar` VARCHAR(255) NOT NULL;";
$sqlUpdateDatabase['users']['type'] = "ALTER TABLE `users` ADD `type` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ;";
$sqlUpdateDatabase['users']['created_at'] = "ALTER TABLE `users` ADD `created_at` INT NOT NULL;";
$sqlUpdateDatabase['users']['updated_at'] = "ALTER TABLE `users` ADD `updated_at` INT NOT NULL;";
$sqlUpdateDatabase['users']['password'] = "ALTER TABLE `users` ADD `password` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";
$sqlUpdateDatabase['users']['status'] = "ALTER TABLE `users` ADD `status` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active';";
$sqlUpdateDatabase['users']['token'] = "ALTER TABLE `users` ADD `token` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ;";
$sqlUpdateDatabase['users']['device_token'] = "ALTER TABLE `users` ADD `device_token` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ;";
$sqlUpdateDatabase['users']['google_id'] = "ALTER TABLE `users` ADD `google_id` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ;";
$sqlUpdateDatabase['users']['apple_id'] = "ALTER TABLE `users` ADD `apple_id` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ;";
$sqlUpdateDatabase['users']['info'] = "ALTER TABLE `users` ADD `info` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ;";
$sqlUpdateDatabase['users']['last_login'] = "ALTER TABLE `users` ADD `last_login` INT NULL DEFAULT NULL ;";
$sqlUpdateDatabase['users']['total_coin'] = "ALTER TABLE `users` ADD `total_coin` INT NULL DEFAULT ;";
$sqlUpdateDatabase['users']['current_weight'] = "ALTER TABLE `users` ADD `current_weight` INT NULL DEFAULT NULL ;"; 
$sqlUpdateDatabase['users']['target_weight'] = "ALTER TABLE `users` ADD `target_weight` INT NULL DEFAULT NULL ;";
$sqlUpdateDatabase['users']['height'] = "ALTER TABLE `users` ADD `height` INT NULL DEFAULT NULL ;"; 
$sqlUpdateDatabase['users']['deadline'] = "ALTER TABLE `users` ADD `deadline` INT NULL DEFAULT NULL ;";
$sqlUpdateDatabase['users']['reset_password_code'] = "ALTER TABLE `users` ADD `reset_password_code` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ;"; 
$sqlUpdateDatabase['users']['sex'] = "ALTER TABLE `users` ADD `sex` INT NULL DEFAULT '1' COMMENT '1 nam, 2 nu ' ;";


?>