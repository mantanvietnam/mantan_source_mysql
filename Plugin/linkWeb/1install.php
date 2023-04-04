<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';

$sqlInstallDatabase .= CREATE TABLE  `linkwebcategorys` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;


$sqlInstallDatabase .= CREATE TABLE  `linkwebs` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL, `link` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL,`image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL, `idCategory` INT NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;





$sqlDeleteDatabase .= "DROP TABLE linkwebcategorys; ";
$sqlDeleteDatabase .= "DROP TABLE linkwebs; ";

