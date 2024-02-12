<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';

$sqlInstallDatabase .= "CREATE TABLE `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `avatar` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) NOT NULL,
  `id_father` int(11) NOT NULL COMMENT 'id member cha',
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `id_system` int(11) NOT NULL,
  `otp` int(11) DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `deadline` int(11) NOT NULL,
  `verify` varchar(255) NOT NULL DEFAULT 'lock',
  `birthday` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_position` int(11) NOT NULL DEFAULT 0,
  `create_agency` VARCHAR(255) NOT NULL DEFAULT 'active',
  `coin` INT NOT NULL DEFAULT '0',
  `twitter` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci  NULL,
  `tiktok` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci  NULL,
  `youtube` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci  NULL,
  `web` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci  NULL,
  `linkedin` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci  NULL,
  `description` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci  NULL,
  `zalo` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci  NULL,
  `view` INT NOT NULL DEFAULT '0',
  `banner` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";




$sqlInstallDatabase .= "CREATE TABLE `zalos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_oa` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id_app` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `secret_key` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `oauth_code` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `access_token` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `refresh_token` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `deadline` int(11) DEFAULT NULL,
  `id_system` int(11) NOT NULL,
  `template_otp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sqlInstallDatabase .= "CREATE TABLE `transaction_histories` ( `id` INT NOT NULL AUTO_INCREMENT , `id_member` INT NOT NULL , `coin` INT NOT NULL , `type` VARCHAR(255) NOT NULL , `note` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `create_at` INT NOT NULL , `id_system` INT NOT NULL, PRIMARY KEY (`id`)) ENGINE = InnoDB; ";

$sqlDeleteDatabase .= "DROP TABLE members; ";
$sqlDeleteDatabase .= "DROP TABLE zalos; ";
$sqlDeleteDatabase .= "DROP TABLE transaction_histories; ";

$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='system_sales'; ";
$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='system_positions'; ";
