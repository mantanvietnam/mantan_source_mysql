<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];

$sqlInstallDatabase .= "CREATE TABLE `classes` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
	`id_year` INT NOT NULL , 
	`info` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL , 
	`image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
	`images` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL , 
	`status` VARCHAR(255) NOT NULL , 
	`video` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL , 
	`slug` VARCHAR(255) NOT NULL , 
	`des_image` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL, 
	`audio_image` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL, 
	`user` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL, 
	`pass` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL, 
	`note_admin` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL, 
	`image_label` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'https://phongtruyenthong.thptchuyenlaocai.edu.vn/plugins/phongtruyenthong/view/home/assets/img/class.jpg', 
	PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .= "CREATE TABLE `donates` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
	`id_class` INT NULL , 
	`id_year` INT NULL , 
	`phone` VARCHAR(255) NULL , 
	`email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL , 
	`avatar` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
	`job` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL , 
	`donate` INT NOT NULL DEFAULT '0' , 
	PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .= "CREATE TABLE `teachers` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
	`position` INT NOT NULL , 
	`introduce` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
	`avatar` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
	PRIMARY KEY (`id`)
) ENGINE = InnoDB;";


$sqlDeleteDatabase .= "DROP TABLE classes; ";
$sqlDeleteDatabase .= "DROP TABLE donates; ";
$sqlDeleteDatabase .= "DROP TABLE teachers; ";

$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='school_year'; ";
$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='positionTeacher'; ";

// Bang classes
$sqlUpdateDatabase['classes']['name'] = "ALTER TABLE `classes` ADD `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['classes']['id_year'] = "ALTER TABLE `classes` ADD `id_year` INT NOT NULL; ";
$sqlUpdateDatabase['classes']['info'] = "ALTER TABLE `classes` ADD `info` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['classes']['image'] = "ALTER TABLE `classes` ADD `image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['classes']['images'] = "ALTER TABLE `classes` ADD `images` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['classes']['status'] = "ALTER TABLE `classes` ADD `status` VARCHAR(255) NOT NULL; ";
$sqlUpdateDatabase['classes']['video'] = "ALTER TABLE `classes` ADD `video` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['classes']['slug'] = "ALTER TABLE `classes` ADD `slug` VARCHAR(255) NOT NULL; ";
$sqlUpdateDatabase['classes']['des_image'] = "ALTER TABLE `classes` ADD `des_image` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['classes']['audio_image'] = "ALTER TABLE `classes` ADD `audio_image` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['classes']['user'] = "ALTER TABLE `classes` ADD `user` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['classes']['pass'] = "ALTER TABLE `classes` ADD `pass` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['classes']['note_admin'] = "ALTER TABLE `classes` ADD `note_admin` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['classes']['image_label'] = "ALTER TABLE `classes` ADD `image_label` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'https://phongtruyenthong.thptchuyenlaocai.edu.vn/plugins/phongtruyenthong/view/home/assets/img/class.jpg'; ";

// Bang donates
$sqlUpdateDatabase['donates']['name'] = "ALTER TABLE `donates` ADD `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['donates']['id_class'] = "ALTER TABLE `donates` ADD `id_class` INT NULL; ";
$sqlUpdateDatabase['donates']['id_year'] = "ALTER TABLE `donates` ADD `id_year` INT NULL; ";
$sqlUpdateDatabase['donates']['phone'] = "ALTER TABLE `donates` ADD `phone` VARCHAR(255) NULL; ";
$sqlUpdateDatabase['donates']['email'] = "ALTER TABLE `donates` ADD `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['donates']['avatar'] = "ALTER TABLE `donates` ADD `avatar` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['donates']['job'] = "ALTER TABLE `donates` ADD `job` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL ; ";
$sqlUpdateDatabase['donates']['donate'] = "ALTER TABLE `donates` ADD `donate` INT NOT NULL DEFAULT '0'; ";

// Bang teachers
$sqlUpdateDatabase['donates']['name'] = "ALTER TABLE `donates` ADD `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['donates']['position'] = "ALTER TABLE `donates` ADD `position` INT NOT NULL; ";
$sqlUpdateDatabase['donates']['introduce'] = "ALTER TABLE `donates` ADD `introduce` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['donates']['avatar'] = "ALTER TABLE `donates` ADD `avatar` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";