<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';

$sqlInstallDatabase .= "CREATE TABLE `smartqrs` ( `id` INT NOT NULL AUTO_INCREMENT , `title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `code` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `link_web` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `link_ios` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `link_android` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `type` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `status` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `logo` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `id_member` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; ";

$sqlInstallDatabase .= "CREATE TABLE `historyscanqrs` ( `id` INT NOT NULL AUTO_INCREMENT , `id_qr` INT NOT NULL , `time_scan` INT NOT NULL , `device_type` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `device_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `system` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `browser` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; ";

$sqlInstallDatabase .= "CREATE TABLE `members` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `avatar` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `phone` VARCHAR(255) NOT NULL , `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `password` VARCHAR(255) NOT NULL , `status` VARCHAR(255) NOT NULL , `created_at` INT NOT NULL , `last_login` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";


$sqlDeleteDatabase .= "DROP TABLE smartqrs; ";
$sqlDeleteDatabase .= "DROP TABLE historyscanqrs; ";
$sqlDeleteDatabase .= "DROP TABLE members; ";
?>