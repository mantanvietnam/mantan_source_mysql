<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';

$sqlInstallDatabase .= "CREATE TABLE `managers` ( `id` INT NOT NULL AUTO_INCREMENT , `fullname` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `phone` VARCHAR(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `password` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `coin` INT NOT NULL , `modified` INT NOT NULL , `created` INT NOT NULL , `lastLogin` INT NOT NULL , `avatar` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; ";

$sqlInstallDatabase .= "CREATE TABLE `histories` ( `id` INT NOT NULL AUTO_INCREMENT , `time` INT NOT NULL , `idManager` INT NOT NULL , `numberCoin` INT NOT NULL , `numberCoinManager` INT NOT NULL , `type` VARCHAR(255) NOT NULL , `note` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `type_note` VARCHAR(255) NOT NULL , `modified` INT NOT NULL , `created` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; ";

$sqlInstallDatabase .= "CREATE TABLE `links` ( `id` INT NOT NULL AUTO_INCREMENT , `code` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `url` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `idManager` INT NOT NULL , `timeBuy` INT NOT NULL , `goto` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `idOrder` INT NOT NULL , `modified` INT NOT NULL , `created` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; ";

$sqlInstallDatabase .= "CREATE TABLE `orders` ( `id` INT NOT NULL AUTO_INCREMENT , `numberHour` INT NOT NULL , `dateStart` INT NOT NULL , `dateEnd` INT NOT NULL , `price` INT NOT NULL , `idManager` INT NOT NULL , `idZoom` INT NOT NULL , `type` INT NOT NULL , `extend_time_use` INT NOT NULL , `modified` INT NOT NULL , `created` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; ";

$sqlInstallDatabase .= "CREATE TABLE `zooms` ( `id` INT NOT NULL AUTO_INCREMENT , `user` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `pass` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `key_host` VARCHAR(255) NOT NULL , `type` INT NOT NULL , `status` VARCHAR(255) NOT NULL , `idOrder` INT(11) NULL DEFAULT '0' , `modified` INT NOT NULL , `created` INT NOT NULL , `client_id` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `client_secret` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `account_id` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; ";

$sqlInstallDatabase .= "CREATE TABLE `prices` ( `id` INT NOT NULL AUTO_INCREMENT , `price` INT NOT NULL , `type` INT NOT NULL , `hour` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; ";



$sqlDeleteDatabase .= "DROP TABLE managers; ";
$sqlDeleteDatabase .= "DROP TABLE histories; ";
$sqlDeleteDatabase .= "DROP TABLE links; ";
$sqlDeleteDatabase .= "DROP TABLE orders; ";
$sqlDeleteDatabase .= "DROP TABLE zooms; ";
$sqlDeleteDatabase .= "DROP TABLE prices; ";

/*
$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='category_product'; ";
*/
?>