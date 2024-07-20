<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];

$sqlInstallDatabase .= "CREATE TABLE `affiliaters` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
    `phone` VARCHAR(15) NOT NULL , 
    `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL , 
    `address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL , 
    `id_father` INT NOT NULL DEFAULT '0' COMMENT 'id người giới thiệu' , 
    `id_customer` INT NOT NULL DEFAULT '0' , 
    `id_member` INT NOT NULL DEFAULT '0' , 
    `avatar` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `id_system` INT NOT NULL DEFAULT '0',
    `password` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
    `created_at` INT NOT NULL,
    `view` INT NOT NULL DEFAULT '0',
    `description` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
    `linkedin` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
    `web` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
    `instagram` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
    `zalo` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
    `facebook` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
    `twitter` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
    `tiktok` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
    `youtube` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
    `last_login` INT NOT NULL DEFAULT '0',
    `portrait` VARCHAR(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB; ";

$sqlInstallDatabase .= "CREATE TABLE `transaction_affiliate_histories` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `id_affiliater` INT NOT NULL , 
    `money_total` INT NOT NULL , 
    `money_back` INT NOT NULL , 
    `percent` FLOAT NOT NULL , 
    `id_member` INT NOT NULL DEFAULT '0',
    `id_order` INT NOT NULL , 
    `create_at` INT NOT NULL , 
    `status` VARCHAR(20) NOT NULL DEFAULT 'new' , 
    PRIMARY KEY (`id`)
) ENGINE = InnoDB; ";

$sqlDeleteDatabase .= "DROP TABLE affiliaters; ";
$sqlDeleteDatabase .= "DROP TABLE transaction_affiliate_histories; ";

// bảng affiliaters
$sqlUpdateDatabase['affiliaters']['name'] = "ALTER TABLE `affiliaters` ADD `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['affiliaters']['phone'] = "ALTER TABLE `affiliaters` ADD `phone` VARCHAR(15) NOT NULL; ";
$sqlUpdateDatabase['affiliaters']['email'] = "ALTER TABLE `affiliaters` ADD `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['affiliaters']['address'] = "ALTER TABLE `affiliaters` ADD `address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['affiliaters']['id_father'] = "ALTER TABLE `affiliaters` ADD `id_father` INT NOT NULL DEFAULT '0' COMMENT 'id người giới thiệu'; ";
$sqlUpdateDatabase['affiliaters']['id_customer'] = "ALTER TABLE `affiliaters` ADD `id_customer` INT NOT NULL DEFAULT '0'; ";
$sqlUpdateDatabase['affiliaters']['id_member'] = "ALTER TABLE `affiliaters` ADD `id_member` INT NOT NULL DEFAULT '0'; ";
$sqlUpdateDatabase['affiliaters']['avatar'] = "ALTER TABLE `affiliaters` ADD `avatar` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['affiliaters']['id_system'] = "ALTER TABLE `affiliaters` ADD `id_system` INT NOT NULL DEFAULT '0'; ";
$sqlUpdateDatabase['affiliaters']['password'] = "ALTER TABLE `affiliaters` ADD `password` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['affiliaters']['created_at'] = "ALTER TABLE `affiliaters` ADD `created_at` INT NOT NULL; ";
$sqlUpdateDatabase['affiliaters']['view'] = "ALTER TABLE `affiliaters` ADD `view` INT NOT NULL DEFAULT '0'; ";
$sqlUpdateDatabase['affiliaters']['description'] = "ALTER TABLE `affiliaters` ADD `description` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['affiliaters']['linkedin'] = "ALTER TABLE `affiliaters` ADD `linkedin` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['affiliaters']['web'] = "ALTER TABLE `affiliaters` ADD `web` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['affiliaters']['instagram'] = "ALTER TABLE `affiliaters` ADD `instagram` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['affiliaters']['zalo'] = "ALTER TABLE `affiliaters` ADD `zalo` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['affiliaters']['facebook'] = "ALTER TABLE `affiliaters` ADD `facebook` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['affiliaters']['twitter'] = "ALTER TABLE `affiliaters` ADD `twitter` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['affiliaters']['tiktok'] = "ALTER TABLE `affiliaters` ADD `tiktok` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['affiliaters']['youtube'] = "ALTER TABLE `affiliaters` ADD `youtube` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['affiliaters']['last_login'] = "ALTER TABLE `affiliaters` ADD `last_login` INT NOT NULL DEFAULT '0'; ";
$sqlUpdateDatabase['affiliaters']['portrait'] = "ALTER TABLE `affiliaters` ADD `portrait` VARCHAR(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL; ";

// bảng transaction_affiliate_histories
$sqlUpdateDatabase['transaction_affiliate_histories']['id_affiliater'] = "ALTER TABLE `transaction_affiliate_histories` ADD `id_affiliater` INT NOT NULL; ";
$sqlUpdateDatabase['transaction_affiliate_histories']['money_total'] = "ALTER TABLE `transaction_affiliate_histories` ADD `money_total` INT NOT NULL; ";
$sqlUpdateDatabase['transaction_affiliate_histories']['money_back'] = "ALTER TABLE `transaction_affiliate_histories` ADD `money_back` INT NOT NULL; ";
$sqlUpdateDatabase['transaction_affiliate_histories']['percent'] = "ALTER TABLE `transaction_affiliate_histories` ADD `percent` FLOAT NOT NULL; ";
$sqlUpdateDatabase['transaction_affiliate_histories']['id_order'] = "ALTER TABLE `transaction_affiliate_histories` ADD `id_order` INT NOT NULL; ";
$sqlUpdateDatabase['transaction_affiliate_histories']['create_at'] = "ALTER TABLE `transaction_affiliate_histories` ADD `create_at` INT NOT NULL; ";
$sqlUpdateDatabase['transaction_affiliate_histories']['status'] = "ALTER TABLE `transaction_affiliate_histories` ADD `status` VARCHAR(20) NOT NULL DEFAULT 'new'; ";
$sqlUpdateDatabase['transaction_affiliate_histories']['id_member'] = "ALTER TABLE `transaction_affiliate_histories` ADD `id_member` INT NOT NULL DEFAULT '0';";
?>