<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';

$sqlInstallDatabase .= "CREATE TABLE `users` ( `id` INT NOT NULL AUTO_INCREMENT , `full_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `phone` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `pass` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `slugSearch` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL, `avatar` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; ";

$sqlInstallDatabase .= "CREATE TABLE `templates` ( `id` INT NOT NULL AUTO_INCREMENT , `status` VARCHAR(255) NOT NULL DEFAULT 'draf' , `name` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `price` INT NOT NULL DEFAULT '0' , `numberBuy` INT NOT NULL DEFAULT '0' , `layouts` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL DEFAULT '[]' , `idUser` INT NOT NULL , `idCategory` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;  ";

$sqlDeleteDatabase .= "DROP TABLE users; ";
$sqlDeleteDatabase .= "DROP TABLE templates; ";
$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='ezpics'; ";
?>