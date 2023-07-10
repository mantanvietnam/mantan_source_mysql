<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;

$sqlInstallDatabase = 'CREATE TABLE `quayso_spa`.`members` ( `id` INT NOT NULL AUTO_INCREMENT , `name` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , `avatar` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , `phone` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , `email` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , `password` TEXT NULL , `status` INT NOT NULL , `type` INT NOT NULL , `id_member` INT NULL DEFAULT NULL , `created_at` DATETIME NULL DEFAULT NULL , `updated_at` DATETIME NULL DEFAULT NULL , `last_login` DATETIME NULL DEFAULT NULL , `dateline_at` DATETIME NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;';

$sqlInstallDatabase .= "CREATE TABLE `products` ( `id` INT NOT NULL AUTO_INCREMENT , `name` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `id_category` INT NOT NULL , `hot` BOOLEAN NOT NULL , `description` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `keyword` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `info` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `code` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `price` INT NOT NULL , `price_old` INT NOT NULL , `quantity` INT NOT NULL , `id_manufacturer` INT NOT NULL , `status` VARCHAR(255) NOT NULL , `slug` VARCHAR(255) NOT NULL , `view` INT NOT NULL DEFAULT '0' , PRIMARY KEY (`id`)) ENGINE = InnoDB; ";
$sqlDeleteDatabase = '';

$sqlInstallDatabase .= "CREATE TABLE `spas` ( `id` INT NOT NULL AUTO_INCREMENT , `name` TEXT NOT NULL , `phone` TEXT NULL DEFAULT NULL , `email` TEXT NULL DEFAULT NULL , `id_member` INT NOT NULL , `address` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , `note` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , `image` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , `slug` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , `created_at` DATETIME NOT NULL , `updated_at` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `trademarks` ( `id` INT NOT NULL AUTO_INCREMENT , `name` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , `description` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , `created_at` DATETIME NULL DEFAULT NULL , `updated_at` DATETIME NULL DEFAULT NULL , `id_member` INT NOT NULL , `image` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , `slug` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";

$sqlInstallDatabase .= "";

$sqlInstallDatabase .= "";

$sqlInstallDatabase .= "";

/*
$sqlDeleteDatabase .= "DROP TABLE lessons; ";
$sqlDeleteDatabase .= "DROP TABLE historytests; ";
$sqlDeleteDatabase .= "DROP TABLE tests; ";
$sqlDeleteDatabase .= "DROP TABLE questions; ";

$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='2top_crm_training'; ";
$sqlDeleteDatabase .= "DELETE FROM `options` WHERE `key_word`='settingTraining2TOPCRM'; ";
*/
?>