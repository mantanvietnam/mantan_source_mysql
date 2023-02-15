<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';

$sqlInstallDatabase .= "CREATE TABLE `competes` ( `id` INT NOT NULL AUTO_INCREMENT , `title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `description` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `date_start` INT NOT NULL , `date_end` INT NOT NULL , `slug` VARCHAR(255) NOT NULL , `image` VARCHAR(255) NOT NULL , `status` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; ";

$sqlInstallDatabase .= "CREATE TABLE `targets` ( `id` INT NOT NULL AUTO_INCREMENT , `title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `description` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `point` INT NOT NULL , `id_compete` INT NOT NULL , `status` VARCHAR(255) NOT NULL , `type` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; ";

$sqlInstallDatabase .= "CREATE TABLE `reports` ( `id` INT NOT NULL AUTO_INCREMENT , `id_customer` INT NOT NULL , `id_target` INT NOT NULL , `image` VARCHAR(255) NOT NULL , `note` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `time_report` INT NOT NULL , `point` INT NOT NULL , `id_compete` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; ; ";


$sqlDeleteDatabase .= "DROP TABLE competes; ";
$sqlDeleteDatabase .= "DROP TABLE targets; ";
$sqlDeleteDatabase .= "DROP TABLE reports; ";
?>