<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';

$sqlInstallDatabase .= CREATE TABLE `historicalsites` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , `address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , `phone` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,`image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , `introductory` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , `latitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL, `longitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , `image360` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , `content` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , `urlSlug` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , `created` INT NULL DEFAULT NULL ,`status` BOOLEAN NULL DEFAULT NULL,`like` INT NULL DEFAULT NULL,`idward` INT NULL DEFAULT NULL   , PRIMARY KEY (`id`)) ENGINE = InnoDB;

$sqlInstallDatabase .= CREATE TABLE `wards` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci  NULL DEFAULT NULL , `urlSlug`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci  NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

$sqlInstallDatabase .= CREATE TABLE `artifacts` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , `material` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , `excavation` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , `period` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , `certification` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , `shape` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , `weight` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , `length` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , `width` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NULL DEFAULT NULL , `height` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , `image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , `imagecon` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , `image360` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , `introductory` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , `idHistoricalsite` INT NULL DEFAULT NULL , `year` INT NULL DEFAULT NULL , `created` INT NULL DEFAULT NULL , `content` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , `status` TINYINT NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;


$sqlDeleteDatabase .= "DROP TABLE historicalsites; ";
$sqlDeleteDatabase .= "DROP TABLE wards; ";
$sqlDeleteDatabase .= "DROP TABLE artifacts; ";


