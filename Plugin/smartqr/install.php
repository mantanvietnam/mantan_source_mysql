<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];

$sqlInstallDatabase .= "CREATE TABLE `smartqrs` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
	`code` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
	`link_web` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
	`link_ios` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
	`link_android` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
	`type` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
	`status` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
	`logo` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
	`id_member` INT NOT NULL , 
	`color_foreground` VARCHAR(255) NOT NULL DEFAULT '0,0,0', 
	`color_background` VARCHAR(255) NOT NULL DEFAULT '255,255,255', 
	PRIMARY KEY (`id`)
) ENGINE = InnoDB; ";

$sqlInstallDatabase .= "CREATE TABLE `historyscanqrs` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`id_qr` INT NOT NULL , 
	`time_scan` INT NOT NULL , 
	`device_type` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
	`device_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
	`system` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
	`browser` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
	PRIMARY KEY (`id`)
) ENGINE = InnoDB; ";

$sqlInstallDatabase .= "CREATE TABLE `members` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
	`avatar` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
	`phone` VARCHAR(255) NOT NULL , 
	`email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
	`password` VARCHAR(255) NOT NULL , 
	`status` VARCHAR(255) NOT NULL , 
	`created_at` INT NOT NULL , 
	`last_login` INT NOT NULL , 
	PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlDeleteDatabase .= "DROP TABLE smartqrs; ";
$sqlDeleteDatabase .= "DROP TABLE historyscanqrs; ";
$sqlDeleteDatabase .= "DROP TABLE members; ";

// Bang smartqrs
$sqlUpdateDatabase['smartqrs']['title'] = "ALTER TABLE `smartqrs` ADD `title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['smartqrs']['code'] = "ALTER TABLE `smartqrs` ADD `code` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['smartqrs']['link_web'] = "ALTER TABLE `smartqrs` ADD `link_web` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['smartqrs']['link_ios'] = "ALTER TABLE `smartqrs` ADD `link_ios` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['smartqrs']['link_android'] = "ALTER TABLE `smartqrs` ADD `link_android` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['smartqrs']['type'] = "ALTER TABLE `smartqrs` ADD `type` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['smartqrs']['status'] = "ALTER TABLE `smartqrs` ADD `status` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['smartqrs']['logo'] = "ALTER TABLE `smartqrs` ADD `logo` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['smartqrs']['id_member'] = "ALTER TABLE `smartqrs` ADD `id_member` INT NOT NULL; ";
$sqlUpdateDatabase['smartqrs']['color_foreground'] = "ALTER TABLE `smartqrs` ADD `color_foreground` VARCHAR(255) NOT NULL DEFAULT '0,0,0'; ";
$sqlUpdateDatabase['smartqrs']['color_background'] = "ALTER TABLE `smartqrs` ADD `color_background` VARCHAR(255) NOT NULL DEFAULT '255,255,255'; ";

// Bang historyscanqrs
$sqlUpdateDatabase['historyscanqrs']['id_qr'] = "ALTER TABLE `historyscanqrs` ADD `id_qr` INT NOT NULL; ";
$sqlUpdateDatabase['historyscanqrs']['time_scan'] = "ALTER TABLE `historyscanqrs` ADD `time_scan` INT NOT NULL; ";
$sqlUpdateDatabase['historyscanqrs']['device_type'] = "ALTER TABLE `historyscanqrs` ADD `device_type` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['historyscanqrs']['device_name'] = "ALTER TABLE `historyscanqrs` ADD `device_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['historyscanqrs']['system'] = "ALTER TABLE `historyscanqrs` ADD `system` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['historyscanqrs']['browser'] = "ALTER TABLE `historyscanqrs` ADD `browser` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";

// Bang members
$sqlUpdateDatabase['members']['name'] = "ALTER TABLE `members` ADD `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['members']['avatar'] = "ALTER TABLE `members` ADD `avatar` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['members']['phone'] = "ALTER TABLE `members` ADD `phone` VARCHAR(255) NOT NULL; ";
$sqlUpdateDatabase['members']['email'] = "ALTER TABLE `members` ADD `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['members']['password'] = "ALTER TABLE `members` ADD `password` VARCHAR(255) NOT NULL; ";
$sqlUpdateDatabase['members']['status'] = "ALTER TABLE `members` ADD `status` VARCHAR(255) NOT NULL; ";
$sqlUpdateDatabase['members']['created_at'] = "ALTER TABLE `members` ADD `created_at` INT NOT NULL; ";
$sqlUpdateDatabase['members']['last_login'] = "ALTER TABLE `members` ADD `last_login` INT NOT NULL; ";
?>