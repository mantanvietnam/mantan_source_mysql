<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = '';

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
    `id_order` INT NOT NULL , 
    `create_at` INT NOT NULL , 
    `status` VARCHAR(20) NOT NULL DEFAULT 'new' , 
    PRIMARY KEY (`id`)
) ENGINE = InnoDB; ";

$sqlDeleteDatabase .= "DROP TABLE affiliaters; ";
$sqlDeleteDatabase .= "DROP TABLE transaction_affiliate_histories; ";

$sqlUpdateDatabase .= "ALTER TABLE `affiliaters` ADD `last_login` INT NOT NULL DEFAULT '0' AFTER `youtube`, ADD `portrait` VARCHAR(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL AFTER `last_login`; ";
?>