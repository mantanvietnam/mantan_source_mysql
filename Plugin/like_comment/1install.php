<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';

$sqlInstallDatabase .="CREATE TABLE `likes` ( `id` INT NOT NULL AUTO_INCREMENT , `idcustomer` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , `idobject` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , `tiype` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL,`created` INT NULL DEFAULT NULL, PRIMARY KEY (`id`)) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `comments` ( `id` INT NOT NULL AUTO_INCREMENT , `idcustomer` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , `idobject` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , `tiype` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , `comment` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , `created` INT NULL DEFAULT NULL, PRIMARY KEY (`id`)) ENGINE = InnoDB;";







$sqlDeleteDatabase .= "DROP TABLE likes; ";
$sqlDeleteDatabase .= "DROP TABLE comments; ";

