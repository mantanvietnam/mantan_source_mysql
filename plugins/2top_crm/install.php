<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';

$sqlInstallDatabase .= "CREATE TABLE `customers` ( `id` INT NOT NULL AUTO_INCREMENT , `full_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `phone` VARCHAR(255) NOT NULL , `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `sex` BOOLEAN NOT NULL , `id_city` TINYINT NOT NULL , `id_messenger` VARCHAR(255) NOT NULL, `avatar` TEXT NOT NULL, `status` VARCHAR(255) NOT NULL , `pass` VARCHAR(255) NOT NULL , `id_parent` INT NOT NULL DEFAULT '0' , `id_level` INT NOT NULL DEFAULT '0' , `birthday_date` INT NOT NULL , `birthday_month` INT NOT NULL , `birthday_year` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; ";


$sqlDeleteDatabase .= "DROP TABLE customers; ";
?>