<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';

$sqlInstallDatabase .= "CREATE TABLE `lessons` ( `id` INT NOT NULL AUTO_INCREMENT , `title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `content` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `id_category` INT NOT NULL , `image` VARCHAR(255) NOT NULL , `status` VARCHAR(255) NOT NULL , `description` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `slug` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;  ";


$sqlDeleteDatabase .= "DROP TABLE lessons; ";
?>