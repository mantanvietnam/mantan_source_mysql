<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';

$sqlInstallDatabase .= CREATE TABLE `historicalsites` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `phone` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `seo` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `introductory` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `keyMetadata` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `notmetadata` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `latitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `longitude` VARCHAR(255) CHARACTER SET utf32 COLLATE utf32_vietnamese_ci NOT NULL , `image360` VARCHAR(255) CHARACTER SET utf32 COLLATE utf32_vietnamese_ci NOT NULL , `cassavaorder` INT(255) NOT NULL , `content` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `author` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `urlSlug` VARCHAR(255) CHARACTER SET utf32 COLLATE utf32_vietnamese_ci NOT NULL , `created` DATE NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;


$sqlDeleteDatabase .= "DROP TABLE historicalsites; ";