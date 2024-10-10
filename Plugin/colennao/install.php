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
`address` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`birthday` INT NULL DEFAULT NULL ,
`avatar` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
`type` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
`created_at` INT NOT NULL ,
`updated_at` INT NOT NULL ,
`password` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
`status` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT "active" ,
`token` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`device_token` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`google_id` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
`facebook_id` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL, 
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
`id_affsource` INT NULL DEFAULT 0 COMMENT "id người giới thiệu  " , 
`id_workout` INT NULL DEFAULT 0 , 
`id_mealplan` INT NULL DEFAULT 0 , 
`id_unit` INT NULL DEFAULT 1 , 
`id_package` INT NOT NULL DEFAULT 0,
`status_pay_package` INT NULL DEFAULT 0 COMMENT "0 chưa thanh toán , 1 dã thanh toán",
`id_group_user` INT NOT NULL DEFAULT 0,
PRIMARY KEY (`id`)
) ENGINE = InnoDB;';
$sqlInstallDatabase .="CREATE TABLE `coach` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ifcontact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sqlInstallDatabase .="CREATE TABLE `tests` (
  `id` int(11) NOT NULL  AUTO_INCREMENT,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `status` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `id_course` int(11) DEFAULT NULL,
  `point_min` float NOT NULL DEFAULT 10
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
	$sqlInstallDatabase .= 'CREATE TABLE `contacts`(
		`id` INT(11) NOT NULL AUTO_INCREMENT,
		`name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
		`email` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
		`phone_number` VARCHAR(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
		`object` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
		`message` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
		PRIMARY KEY(`id`)
	) ENGINE = InnoDB;';
$sqlInstallDatabase .="CREATE TABLE `questions` (
  `id` int(11) NOT NULL  AUTO_INCREMENT,
  `question` text CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `option_a` text CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `option_b` text CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `option_c` text CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `option_d` text CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `option_true` varchar(255) NOT NULL,
  `id_test` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `lessons` (
  `id` int(11) NOT NULL  AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `content` text CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `id_course` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `slug` varchar(255) NOT NULL,
  `view` int(11) NOT NULL DEFAULT 0,
  `youtube_code` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sqlInstallDatabase .="CREATE TABLE `courses` (
  `id` int(11) NOT NULL  AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `image` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `view` int(11) NOT NULL DEFAULT 0,
  `youtube_code` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` varchar(255) NOT NULL,
  `content` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `public` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `historytests` (
  `id` int(11) NOT NULL  AUTO_INCREMENT,
  `id_customer` int(11) NOT NULL,
  `id_test` int(11) NOT NULL,
  `point` float NOT NULL,
  `total_true` int(11) NOT NULL,
  `number_question` int(11) NOT NULL,
  `time_start` int(11) NOT NULL,
  `time_end` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .= "CREATE TABLE `fasting` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_star` int(11) NOT NULL,
  `tiem_end` int(11) NOT NULL,
  `complete` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `price_lists` ( 
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
  `price` INT NULL DEFAULT NULL , 
  `price_old` INT NULL DEFAULT NULL ,
  `days` INT NULL DEFAULT NULL ,
  `status` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active' ,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `challenges` ( 
`id` INT NOT NULL AUTO_INCREMENT, 
`title` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL , 
`day` INT NOT NULL , 
`status` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active' , 
`price` INT NOT NULL ,
`time_trial` INT NULL DEFAULT NULL, 
`price_trial` INT NULL DEFAULT NULL , 
`image` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
`description` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`created_at` INT(11) NULL DEFAULT NULL,
`title_en` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`description_en` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`id_coach` INT NULL DEFAULT NULL,
 PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `feedback_challenges` ( 
`id` INT NOT NULL AUTO_INCREMENT , 
`id_challenge` INT NOT NULL , 
`full_name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
`weight` INT NULL DEFAULT NULL , 
`image` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
`feedback` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`feedback_en` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
 PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `result_challenges` ( 
`id` INT NOT NULL AUTO_INCREMENT , 
`title` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
`image` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
`description` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
`title_en` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
`description_en` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
`id_challenge` INT NOT NULL , 
PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `tip_challenges` ( 
`id` INT NOT NULL AUTO_INCREMENT ,
`tip` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`tip_en` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`id_challenge` INT NOT NULL ,
`day` INT NULL DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `transactions` ( 
`id` INT NOT NULL AUTO_INCREMENT ,
`id_user` INT NOT NULL ,
`name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`name_en` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;
`total` INT NULL DEFAULT 0 ,
`id_course` INT NOT NULL DEFAULT '0' COMMENT 'id khoa học' ,
`id_challenge` INT NOT NULL DEFAULT '0' COMMENT 'id thử thách' ,
`note` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`status` INT NOT NULL DEFAULT '1' COMMENT ' 1: chưa xử lý, 2 đã xử lý' ,
`type` INT NULL DEFAULT '1' COMMENT '1: khóa học , 2 thử thách, 3 gói luyên tập' ,
`created_at` INT NULL DEFAULT NULL ,
`updated_at` INT NULL DEFAULT NULL ,
`code` VARCHAR(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`type_use` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`id_package` INT NOT NULL DEFAULT 0,
`id_price` INT NULL DEFAULT 0,
 PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `user_challenges` ( 
`id` INT NOT NULL AUTO_INCREMENT ,
`id_user` INT NOT NULL ,
`name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`name_en` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`id_challenge` INT NOT NULL ,
`tip` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '[]' ,
`totalDay` INT NOT NULL ,
`status` INT NOT NULL DEFAULT '1' COMMENT '0, mời ,1 dang chạy thử thách , 2 đã hoàng thành' ,
`date_start` INT NULL DEFAULT NULL ,
`created_at` INT NULL DEFAULT NULL ,
`id_transaction` INT NULL DEFAULT NULL ,
`note` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
`deadline` INT NOT NULL DEFAULT 0, 
PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `user_courses` ( `id` INT NOT NULL ,
`id_user` INT NOT NULL AUTO_INCREMENT,
`name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`name_en` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`id_course` INT NOT NULL ,
`status_lesson` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '[]' ,
`created_at` INT NULL DEFAULT NULL ,
`id_transaction` INT NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `workouts` ( 
`id` INT NOT NULL AUTO_INCREMENT , 
`title` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
`title_en` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
`status` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
`description` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
`description_en` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
`image` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
`youtube_code` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
`created_at` INT NULL DEFAULT NULL , 
`id_package` INT NULL DEFAULT NULL , 
`search` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '[]',
PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `exercise_workouts` ( 
`id` INT NOT NULL AUTO_INCREMENT ,
`title` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`image` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`level` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`status` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`youtube_code` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`created_at` INT NULL DEFAULT NULL ,
`id_workout` INT NULL DEFAULT NULL ,
`time` INT NULL DEFAULT NULL ,
`kcal` INT NULL DEFAULT NULL ,
`area` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '[]' ,
`device` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '[]' ,
`group` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '[]' ,
`description` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `child_exercise_workouts` ( 
`id` INT NOT NULL AUTO_INCREMENT ,
`title` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`title_en` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`image` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`group` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`time` INT NULL DEFAULT NULL ,
`device` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '[]' ,
`description` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`description_en` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`content` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`content_en` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`id_exercise` INT NULL DEFAULT NULL,
`id_group` INT NULL DEFAULT NULL,
`youtube_code` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `devices` ( 
`id` INT NOT NULL AUTO_INCREMENT ,
`name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`name_en` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`image` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`link` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`created_at` INT NULL DEFAULT NULL ,
`description` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`description_en` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `areas` ( 
`id` INT NOT NULL AUTO_INCREMENT ,
`name_en  ` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`image` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`created_at` INT NULL DEFAULT NULL ,
`description` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`description_en ` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE = InnoDB;";



$sqlInstallDatabase .="CREATE TABLE `package_workouts` ( 
`id` INT NOT NULL AUTO_INCREMENT ,
`title` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`title_en` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`price_package` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '[]' ,
`image` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
`status` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`created_at` INT NULL DEFAULT NULL ,
`description` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`description_en` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`content` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`content_en` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
PRIMARY KEY (`id`)) ENGINE = InnoDB;";


$sqlInstallDatabase .="CREATE TABLE `interme_package_workouts` ( 
`id` INT NOT NULL AUTO_INCREMENT ,
`id_package` INT NOT NULL ,
`id_workout` INT NOT NULL , 
PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `user_packages` ( 
`id` INT NOT NULL AUTO_INCREMENT ,
`id_user` INT NULL DEFAULT NULL ,
`name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`name_en` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`date_start` INT NULL DEFAULT NULL ,
`deadline` INT NULL DEFAULT NULL ,
`id_transaction` INT NULL DEFAULT NULL ,
`id_package` INT NULL DEFAULT NULL,
`note` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`created_at` INT NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `toptopweb_colennao`.`notifications` ( `id` INT NOT NULL AUTO_INCREMENT , 
`id_user` INT NOT NULL DEFAULT '0' , 
`title` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
`created_at` INT NULL DEFAULT NULL , 
`action` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
`content` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
`is_viewed` INT NULL DEFAULT 0,
PRIMARY KEY (`id`)
) ENGINE = InnoDB;";


$sqlDeleteDatabase .= 'DROP TABLE IF EXISTS `users`;';
$sqlDeleteDatabase .= 'DROP TABLE IF EXISTS `tests`;';
$sqlDeleteDatabase .= 'DROP TABLE IF EXISTS `questions`;';
$sqlDeleteDatabase .= 'DROP TABLE IF EXISTS `lessons`;';
$sqlDeleteDatabase .= 'DROP TABLE IF EXISTS `courses`;';
$sqlDeleteDatabase .= 'DROP TABLE IF EXISTS `historytests`;';
$sqlDeleteDatabase .= 'DROP TABLE IF EXISTS `fasting`;';
$sqlDeleteDatabase .= 'DROP TABLE IF EXISTS `challenges`;';
$sqlDeleteDatabase .= 'DROP TABLE IF EXISTS `feedback_challenges`;';
$sqlDeleteDatabase .= 'DROP TABLE IF EXISTS `result_challenges`;';
$sqlDeleteDatabase .= 'DROP TABLE IF EXISTS `tip_challenges`;';
$sqlDeleteDatabase .= 'DROP TABLE IF EXISTS `transactions`;';
$sqlDeleteDatabase .= 'DROP TABLE IF EXISTS `user_challenges`;';
$sqlDeleteDatabase .= 'DROP TABLE IF EXISTS `user_courses`;';
$sqlDeleteDatabase .= 'DROP TABLE IF EXISTS `workouts`;';
$sqlDeleteDatabase .= 'DROP TABLE IF EXISTS `exercise_workouts`;';
$sqlDeleteDatabase .= 'DROP TABLE IF EXISTS `child_exercise_workouts`;';
$sqlDeleteDatabase .= 'DROP TABLE IF EXISTS `devices`;';
$sqlDeleteDatabase .= 'DROP TABLE IF EXISTS `package_workouts`;';
$sqlDeleteDatabase .= 'DROP TABLE IF EXISTS `interme_package_workouts`;';
$sqlDeleteDatabase .= 'DROP TABLE IF EXISTS `user_packages`;';


$sqlUpdateDatabase['users']['full_name'] = "ALTER TABLE `users` ADD `full_name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;";
$sqlUpdateDatabase['users']['phone'] = "ALTER TABLE `users` ADD `phone` VARCHAR(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['users']['email'] = "ALTER TABLE `users` ADD `email` VARCHAR(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['users']['address'] = "ALTER TABLE `users` ADD `address` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['users']['birthday'] = "ALTER TABLE `users` ADD `birthday` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['users']['avatar'] = "ALTER TABLE `users` ADD `avatar` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['users']['type'] = "ALTER TABLE `users` ADD `type` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ;";
$sqlUpdateDatabase['users']['created_at'] = "ALTER TABLE `users` ADD `created_at` INT NOT NULL;";
$sqlUpdateDatabase['users']['updated_at'] = "ALTER TABLE `users` ADD `updated_at` INT NOT NULL;";
$sqlUpdateDatabase['users']['password'] = "ALTER TABLE `users` ADD `password` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";
$sqlUpdateDatabase['users']['status'] = "ALTER TABLE `users` ADD `status` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active';";
$sqlUpdateDatabase['users']['token'] = "ALTER TABLE `users` ADD `token` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ;";
$sqlUpdateDatabase['users']['device_token'] = "ALTER TABLE `users` ADD `device_token` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ;";
$sqlUpdateDatabase['users']['google_id'] = "ALTER TABLE `users` ADD `google_id` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ;";
$sqlUpdateDatabase['users']['apple_id'] = "ALTER TABLE `users` ADD `apple_id` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ;";
$sqlUpdateDatabase['users']['facebook_id'] = "ALTER TABLE `users` ADD `facebook_id` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['users']['info'] = "ALTER TABLE `users` ADD `info` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ;";
$sqlUpdateDatabase['users']['last_login'] = "ALTER TABLE `users` ADD `last_login` INT NULL DEFAULT NULL ;";
$sqlUpdateDatabase['users']['total_coin'] = "ALTER TABLE `users` ADD `total_coin` INT NULL DEFAULT ;";
$sqlUpdateDatabase['users']['current_weight'] = "ALTER TABLE `users` ADD `current_weight` INT NULL DEFAULT NULL ;"; 
$sqlUpdateDatabase['users']['target_weight'] = "ALTER TABLE `users` ADD `target_weight` INT NULL DEFAULT NULL ;";
$sqlUpdateDatabase['users']['height'] = "ALTER TABLE `users` ADD `height` INT NULL DEFAULT NULL ;"; 
$sqlUpdateDatabase['users']['deadline'] = "ALTER TABLE `users` ADD `deadline` INT NULL DEFAULT NULL ;";
$sqlUpdateDatabase['users']['reset_password_code'] = "ALTER TABLE `users` ADD `reset_password_code` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ;"; 
$sqlUpdateDatabase['users']['sex'] = "ALTER TABLE `users` ADD `sex` INT NULL DEFAULT '1' COMMENT '1 nam, 2 nu ' ;";
$sqlUpdateDatabase['users']['id_affsource'] = "ALTER TABLE `users` ADD `id_affsource` INT NULL DEFAULT 0 COMMENT 'id người giới thiệu';";
$sqlUpdateDatabase['users']['id_workout'] = "ALTER TABLE `users` ADD `id_workout` INT NULL DEFAULT '0';";
$sqlUpdateDatabase['users']['id_mealplan'] = "ALTER TABLE `users` ADD `id_mealplan` INT NULL DEFAULT '0';";
$sqlUpdateDatabase['users']['id_unit'] = "ALTER TABLE `users` ADD `id_unit` INT NULL DEFAULT '1';";
$sqlUpdateDatabase['users']['id_package'] = "ALTER TABLE `users` ADD `id_package` INT NOT NULL DEFAULT '0';";
$sqlUpdateDatabase['users']['status_pay_package'] = "ALTER TABLE `users` ADD `status_pay_package` INT NULL DEFAULT '0' COMMENT '0 chưa thanh toán , 1 dã thanh toán'";
$sqlUpdateDatabase['users']['id_group_user'] = "ALTER TABLE `users` ADD `id_group_user` INT NOT NULL DEFAULT '0';";

 $sqlUpdateDatabase['price_lists']['name'] = "ALTER TABLE `price_lists` ADD `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
 $sqlUpdateDatabase['price_lists']['price'] = "ALTER TABLE `price_lists` ADD `price` INT NULL DEFAULT NULL;";
 $sqlUpdateDatabase['price_lists']['price_old'] = "ALTER TABLE `price_lists` ADD `price_old` INT NULL DEFAULT NULL;";
 $sqlUpdateDatabase['price_lists']['days'] = "ALTER TABLE `price_lists` ADD `days` INT NULL DEFAULT NULL;";
 $sqlUpdateDatabase['price_lists']['status'] = "ALTER TABLE `price_lists` ADD `status` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active';";

 $sqlUpdateDatabase['challenges']['title'] = "ALTER TABLE `challenges` ADD `title` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;";
 $sqlUpdateDatabase['challenges']['day'] = "ALTER TABLE `challenges` ADD `day` INT NOT NULL;";
 $sqlUpdateDatabase['challenges']['status'] = "ALTER TABLE `challenges` ADD `status` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active';";
 $sqlUpdateDatabase['challenges']['price'] = "ALTER TABLE `challenges` ADD `price` INT NOT NULL;";
 $sqlUpdateDatabase['challenges']['price_trial'] = "ALTER TABLE `challenges` ADD `price_trial` INT NULL DEFAULT NULL;";
 $sqlUpdateDatabase['challenges']['time_trial'] = "ALTER TABLE `challenges` ADD `time_trial` INT NULL DEFAULT NULL;";
 $sqlUpdateDatabase['challenges']['image'] = "ALTER TABLE `challenges` ADD `image` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
 $sqlUpdateDatabase['challenges']['description'] = "ALTER TABLE `challenges` ADD `description` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
 $sqlUpdateDatabase['challenges']['created_at'] = "ALTER TABLE `challenges` ADD `created_at` INT(11)  NULL DEFAULT NULL;";
 $sqlUpdateDatabase['challenges']['id_coach'] = "ALTER TABLE `challenges` ADD `id_coach` INT NULL DEFAULT NULL;";
 $sqlUpdateDatabase['challenges']['title_en'] = "ALTER TABLE `challenges` ADD `title_en` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
 $sqlUpdateDatabase['challenges']['description_en'] = "ALTER TABLE `challenges` ADD `description_en` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";

 $sqlUpdateDatabase['feedback_challenges']['id_challenge'] = "ALTER TABLE `feedback_challenges` ADD `id_challenge` INT NOT NULL ;";
 $sqlUpdateDatabase['feedback_challenges']['full_name'] = "ALTER TABLE `feedback_challenges` ADD `full_name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ;";
 $sqlUpdateDatabase['feedback_challenges']['weight'] = "ALTER TABLE `feedback_challenges` ADD `weight` INT NULL DEFAULT NULL ;";
 $sqlUpdateDatabase['feedback_challenges']['image'] = "ALTER TABLE `feedback_challenges` ADD `image` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ;";
 $sqlUpdateDatabase['feedback_challenges']['feedback'] = "ALTER TABLE `feedback_challenges` ADD `feedback` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
 $sqlUpdateDatabase['feedback_challenges']['feedback_en'] = "ALTER TABLE `feedback_challenges` ADD `feedback_en` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";

 $sqlUpdateDatabase['result_challenges']['title'] = "ALTER TABLE `result_challenges` ADD `title` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
 $sqlUpdateDatabase['result_challenges']['title_en'] = "ALTER TABLE `result_challenges` ADD `title_en` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
 $sqlUpdateDatabase['result_challenges']['image'] = "ALTER TABLE `result_challenges` ADD `image` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
 $sqlUpdateDatabase['result_challenges']['description'] = "ALTER TABLE `result_challenges` ADD `description` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
 $sqlUpdateDatabase['result_challenges']['id_challenge'] = "ALTER TABLE `result_challenges` ADD `id_challenge` INT NOT NULL;";

 $sqlUpdateDatabase['result_challenges']['title_en'] = "ALTER TABLE `result_challenges` ADD `title_en` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
 $sqlUpdateDatabase['result_challenges']['description_en'] = "ALTER TABLE `result_challenges` ADD `description_en` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";



 $sqlUpdateDatabase['tip_challenges']['tip'] = "ALTER TABLE `tip_challenges` ADD  `tip` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ;";
 $sqlUpdateDatabase['tip_challenges']['tip_en'] = "ALTER TABLE `tip_challenges` ADD  `tip_en` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ;";
 $sqlUpdateDatabase['tip_challenges']['id_challenge'] = "ALTER TABLE `tip_challenges` ADD `id_challenge` INT NOT NULL ;";
 $sqlUpdateDatabase['tip_challenges']['day'] = "ALTER TABLE `tip_challenges` ADD `day` INT NULL DEFAULT NULL;";

$sqlUpdateDatabase['transactions']['id_user'] = "ALTER TABLE `transactions` ADD `id_user` INT NOT NULL;";
$sqlUpdateDatabase['transactions']['name'] = "ALTER TABLE `transactions` ADD `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['transactions']['name_en'] = "ALTER TABLE `transactions` ADD `name_en` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['transactions']['total'] = "ALTER TABLE `transactions` ADD `total` INT NULL DEFAULT '0';";
$sqlUpdateDatabase['transactions']['id_course'] = "ALTER TABLE `transactions` ADD `id_course` INT NOT NULL DEFAULT '0' COMMENT 'id khoa học';";
$sqlUpdateDatabase['transactions']['id_challenge'] = "ALTER TABLE `transactions` ADD `id_challenge` INT NOT NULL DEFAULT '0' COMMENT 'id thử thách';";
$sqlUpdateDatabase['transactions']['note'] = "ALTER TABLE `transactions` ADD `note` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['transactions']['status'] = "ALTER TABLE `transactions` ADD `status` INT NOT NULL DEFAULT '1' COMMENT ' 1: chưa xử lý, 2 đã xử lý';";
$sqlUpdateDatabase['transactions']['type'] = "ALTER TABLE `transactions` ADD `type` INT NULL DEFAULT '1' COMMENT '1: khóa học , 2 thử thách';";
$sqlUpdateDatabase['transactions']['created_at'] = "ALTER TABLE `transactions` ADD `created_at` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['transactions']['updated_at'] = "ALTER TABLE `transactions` ADD `updated_at` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['transactions']['code'] = "ALTER TABLE `transactions` ADD `code` VARCHAR(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['transactions']['type_use'] = "ALTER TABLE `transactions` ADD `type_use` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['transactions']['id_package'] = "ALTER TABLE `transactions` ADD `id_package` INT NOT NULL DEFAULT '0';";
$sqlUpdateDatabase['transactions']['id_price'] = "ALTER TABLE `transactions` ADD `id_price` INT NULL DEFAULT '0';";

$sqlUpdateDatabase['user_challenges']['id_user'] = "ALTER TABLE `user_challenges` ADD `id_user` INT NOT NULL;";
$sqlUpdateDatabase['user_challenges']['name'] = "ALTER TABLE `user_challenges` ADD `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['user_challenges']['name_en'] = "ALTER TABLE `user_challenges` ADD `name_en` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['user_challenges']['id_challenge'] = "ALTER TABLE `user_challenges` ADD `id_challenge` INT NOT NULL;";
$sqlUpdateDatabase['user_challenges']['tip'] = "ALTER TABLE `user_challenges` ADD `tip` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '[]';";
$sqlUpdateDatabase['user_challenges']['totalDay'] = "ALTER TABLE `user_challenges` ADD `totalDay` INT NOT NULL;";
$sqlUpdateDatabase['user_challenges']['status'] = "ALTER TABLE `user_challenges` ADD `status` INT NOT NULL DEFAULT '1' COMMENT '0, mời ,1 dang chạy thử thách , 2 đã hoàng thành';";
$sqlUpdateDatabase['user_challenges']['date_start'] = "ALTER TABLE `user_challenges` ADD `date_start` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['user_challenges']['created_at'] = "ALTER TABLE `user_challenges` ADD `created_at` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['user_challenges']['id_transaction'] = "ALTER TABLE `user_challenges` ADD `id_transaction` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['user_challenges']['note'] = "ALTER TABLE `user_challenges` ADD `note` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ;";
$sqlUpdateDatabase['user_challenges']['deadline'] = "ALTER TABLE `user_challenges` ADD `deadline` INT NOT NULL DEFAULT '0';";

$sqlUpdateDatabase['user_courses']['name'] = "ALTER TABLE `user_courses` ADD `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['user_courses']['name_en'] = "ALTER TABLE `user_courses` ADD `name_en` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['user_courses']['id_course'] = "ALTER TABLE `user_courses` ADD `id_course` INT NOT NULL;";
$sqlUpdateDatabase['user_courses']['status_lesson'] = "ALTER TABLE `user_courses` ADD `status_lesson` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '[]';";
$sqlUpdateDatabase['user_courses']['created_at'] = "ALTER TABLE `user_courses` ADD `created_at` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['user_courses']['id_transaction'] = "ALTER TABLE `user_courses` ADD `id_transaction` INT NULL DEFAULT NULL;";

$sqlUpdateDatabase['workouts']['title'] = "ALTER TABLE `workouts` ADD `title` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";
$sqlUpdateDatabase['workouts']['title_en'] = "ALTER TABLE `workouts` ADD `title_en` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";
$sqlUpdateDatabase['workouts']['status'] = "ALTER TABLE `workouts` ADD `status` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['workouts']['description'] = "ALTER TABLE `workouts` ADD `description` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['workouts']['description_en'] = "ALTER TABLE `workouts` ADD `description_en` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['workouts']['image'] = "ALTER TABLE `workouts` ADD `image` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['workouts']['youtube_code'] = "ALTER TABLE `workouts` ADD `youtube_code` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['workouts']['created_at'] = "ALTER TABLE `workouts` ADD `created_at` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['workouts']['id_package'] = "ALTER TABLE `workouts` ADD `id_package` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['workouts']['search'] = "ALTER TABLE `workouts` ADD `search` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '[]';";
$sqlUpdateDatabase['exercise_workouts']['title'] = "ALTER TABLE `exercise_workouts` ADD `title` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['exercise_workouts']['title_en'] = "ALTER TABLE `exercise_workouts` ADD `title_en` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['exercise_workouts']['image'] = "ALTER TABLE `exercise_workouts` ADD `image` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['exercise_workouts']['level'] = "ALTER TABLE `exercise_workouts` ADD `level` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['exercise_workouts']['status'] = "ALTER TABLE `exercise_workouts` ADD `status` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['exercise_workouts']['youtube_code'] = "ALTER TABLE `exercise_workouts` ADD `youtube_code` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['exercise_workouts']['created_at'] = "ALTER TABLE `exercise_workouts` ADD `created_at` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['exercise_workouts']['id_workout'] = "ALTER TABLE `exercise_workouts` ADD `id_workout` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['exercise_workouts']['time'] = "ALTER TABLE `exercise_workouts` ADD `time` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['exercise_workouts']['kcal'] = "ALTER TABLE `exercise_workouts` ADD `kcal` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['exercise_workouts']['area'] = "ALTER TABLE `exercise_workouts` ADD `area` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '[]';";
$sqlUpdateDatabase['exercise_workouts']['device'] = "ALTER TABLE `exercise_workouts` ADD `device` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '[]';";
$sqlUpdateDatabase['exercise_workouts']['group'] = "ALTER TABLE `exercise_workouts` ADD `group` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '[]';";
$sqlUpdateDatabase['exercise_workouts']['description'] = "ALTER TABLE `exercise_workouts` ADD `description` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['exercise_workouts']['description_en'] = "ALTER TABLE `exercise_workouts` ADD `description_en` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";

$sqlUpdateDatabase['child_exercise_workouts']['title'] = "ALTER TABLE `child_exercise_workouts` ADD `title` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['child_exercise_workouts']['title_en'] = "ALTER TABLE `child_exercise_workouts` ADD `title_en` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['child_exercise_workouts']['image'] = "ALTER TABLE `child_exercise_workouts` ADD `image` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['child_exercise_workouts']['group'] = "ALTER TABLE `child_exercise_workouts` ADD `group` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['child_exercise_workouts']['time'] = "ALTER TABLE `child_exercise_workouts` ADD `time` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['child_exercise_workouts']['device'] = "ALTER TABLE `child_exercise_workouts` ADD `device` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '[]';";
$sqlUpdateDatabase['child_exercise_workouts']['description'] = "ALTER TABLE `child_exercise_workouts` ADD `description` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['child_exercise_workouts']['description_en'] = "ALTER TABLE `child_exercise_workouts` ADD `description_en` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['child_exercise_workouts']['content'] = "ALTER TABLE `child_exercise_workouts` ADD `content` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['child_exercise_workouts']['content_en'] = "ALTER TABLE `child_exercise_workouts` ADD `content_en` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['child_exercise_workouts']['youtube_code'] = "ALTER TABLE `child_exercise_workouts` ADD `youtube_code` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['child_exercise_workouts']['id_exercise'] = "ALTER TABLE `child_exercise_workouts` ADD `id_exercise` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['child_exercise_workouts']['id_group'] = "ALTER TABLE `child_exercise_workouts` ADD `id_group` INT NULL DEFAULT NULL;";

$sqlUpdateDatabase['devices']['name'] = "ALTER TABLE `devices` ADD `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['devices']['name_en'] = "ALTER TABLE `devices` ADD `name_en` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['devices']['image'] = "ALTER TABLE `devices` ADD `image` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['devices']['link'] = "ALTER TABLE `devices` ADD `link` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['devices']['created_at'] = "ALTER TABLE `devices` ADD `created_at` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['devices']['description'] = "ALTER TABLE `devices` ADD `description` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NUL;";
$sqlUpdateDatabase['devices']['description_en'] = "ALTER TABLE `devices` ADD `description_en` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NUL;";

$sqlUpdateDatabase['package_workouts']['title'] = "ALTER TABLE `package_workouts` ADD `title` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['package_workouts']['title_en'] = "ALTER TABLE `package_workouts` ADD `title_en` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['package_workouts']['price_package'] = "ALTER TABLE `package_workouts` ADD `price_package` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '[]';";
$sqlUpdateDatabase['package_workouts']['image'] = "ALTER TABLE `package_workouts` ADD `image` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";
$sqlUpdateDatabase['package_workouts']['status'] = "ALTER TABLE `package_workouts` ADD `status` VARCHAR(255) NULL DEFAULT NULL;";
$sqlUpdateDatabase['package_workouts']['created_at'] = "ALTER TABLE `package_workouts` ADD `created_at` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['package_workouts']['description'] = "ALTER TABLE `package_workouts` ADD `description` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['package_workouts']['description_en'] = "ALTER TABLE `package_workouts` ADD `description_en` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['package_workouts']['content'] = "ALTER TABLE `package_workouts` ADD `content` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['package_workouts']['content_en'] = "ALTER TABLE `package_workouts` ADD `content_en` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";

$sqlUpdateDatabase['interme_package_workouts']['id_package'] = "ALTER TABLE `interme_package_workouts` ADD `id_package` INT NOT NULL;";
$sqlUpdateDatabase['interme_package_workouts']['id_workout'] = "ALTER TABLE `interme_package_workouts` ADD `id_workout` INT NOT NULL;";

$sqlUpdateDatabase['user_packages']['id_user'] = "ALTER TABLE `user_packages` ADD `id_user` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['user_packages']['name'] = "ALTER TABLE `user_packages` ADD `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['user_packages']['name_en'] = "ALTER TABLE `user_packages` ADD `name_en` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['user_packages']['date_start'] = "ALTER TABLE `user_packages` ADD `date_start` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['user_packages']['deadline'] = "ALTER TABLE `user_packages` ADD `deadline` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['user_packages']['id_transaction'] = "ALTER TABLE `user_packages` ADD `id_transaction` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['user_packages']['note'] = "ALTER TABLE `user_packages` ADD `note` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['user_packages']['created_at'] = "ALTER TABLE `user_packages` ADD `created_at` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['user_packages']['id_package'] = "ALTER TABLE `user_packages` ADD `id_package` INT NULL DEFAULT NULL;";

$sqlUpdateDatabase['areas']['name'] = "ALTER TABLE `areas` ADD `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ;";
$sqlUpdateDatabase['areas']['name_en'] = "ALTER TABLE `areas` ADD `name_en` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ;";
$sqlUpdateDatabase['areas']['image'] = "ALTER TABLE `areas` ADD `image` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ;";
$sqlUpdateDatabase['areas']['created_at'] = "ALTER TABLE `areas` ADD `created_at` INT NULL DEFAULT NULL ;";
$sqlUpdateDatabase['areas']['description'] = "ALTER TABLE `areas` ADD `description` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['areas']['description_en'] = "ALTER TABLE `areas` ADD `description_en` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";

$sqlUpdateDatabase['notifications']['id_user'] = "ALTER TABLE `notifications` ADD `id_user` INT NOT NULL DEFAULT '0';";
$sqlUpdateDatabase['notifications']['title'] = "ALTER TABLE `notifications` ADD `title` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['notifications']['created_at'] = "ALTER TABLE `notifications` ADD `created_at` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['notifications']['action'] = "ALTER TABLE `notifications` ADD `action` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['notifications']['content'] = "ALTER TABLE `notifications` ADD `content` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['notifications']['is_viewed'] = "ALTER TABLE `notifications` ADD `is_viewed` INT NULL DEFAULT '0';";
?>