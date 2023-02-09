<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';

$sqlInstallDatabase .= "CREATE TABLE `charities` ( `id` INT NOT NULL AUTO_INCREMENT , `title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `description` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `money_donate` INT NOT NULL , `address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `id_city` INT NOT NULL , `person_donate` INT NOT NULL , `status` VARCHAR(255) NOT NULL , `time_event_start` INT NOT NULL , `time_event_end` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; ";

$sqlInstallDatabase .= "CREATE TABLE `donates` ( `id` INT NOT NULL AUTO_INCREMENT , `id_charity` INT NOT NULL , `coin` INT NOT NULL , `note` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `full_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `phone` VARCHAR(255) NOT NULL , `email` VARCHAR(255) NOT NULL , `id_customer` INT NOT NULL , `avatar` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; ";


$sqlDeleteDatabase .= "DROP TABLE charities; ";
$sqlDeleteDatabase .= "DROP TABLE donates; ";
?>