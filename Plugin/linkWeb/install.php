<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];

$sqlInstallDatabase .= "CREATE TABLE  `linkwebcategorys` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	PRIMARY KEY (`id`)
) ENGINE = InnoDB;";


$sqlInstallDatabase .= "CREATE TABLE  `linkwebs` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL, 
	`link` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL,
	`image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL, 
	`idCategory` INT NULL DEFAULT NULL , 
	PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlDeleteDatabase .= "DROP TABLE linkwebcategorys; ";
$sqlDeleteDatabase .= "DROP TABLE linkwebs; ";

// Bang linkwebcategorys
$sqlUpdateDatabase['linkwebcategorys']['name'] = "ALTER TABLE `linkwebcategorys` ADD `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";

// Bang linkwebs
$sqlUpdateDatabase['linkwebs']['name'] = "ALTER TABLE `linkwebs` ADD `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['linkwebs']['link'] = "ALTER TABLE `linkwebs` ADD `link` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['linkwebs']['image'] = "ALTER TABLE `linkwebs` ADD `image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['linkwebs']['idCategory'] = "ALTER TABLE `linkwebs` ADD `idCategory` INT NULL DEFAULT NULL; ";