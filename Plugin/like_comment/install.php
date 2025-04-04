<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];

$sqlInstallDatabase .="CREATE TABLE `likes` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`idcustomer` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`idobject` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`type` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL,
	`created` INT NULL DEFAULT NULL, 
	PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `comments` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`idcustomer` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`idobject` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`type` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`comment` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`created` INT NULL DEFAULT NULL, 
	`status` VARCHAR(100) NOT NULL DEFAULT 'active',
	PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlDeleteDatabase .= "DROP TABLE likes; ";
$sqlDeleteDatabase .= "DROP TABLE comments; ";

// Bang likes
$sqlUpdateDatabase['likes']['idcustomer'] = "ALTER TABLE `likes` ADD `idcustomer` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['likes']['idobject'] = "ALTER TABLE `likes` ADD `idobject` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['likes']['type'] = "ALTER TABLE `likes` ADD `type` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['likes']['created'] = "ALTER TABLE `likes` ADD `created` INT NULL DEFAULT NULL; ";

// Bang comments
$sqlUpdateDatabase['comments']['idcustomer'] = "ALTER TABLE `comments` ADD `idcustomer` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['comments']['idobject'] = "ALTER TABLE `comments` ADD `idobject` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['comments']['type'] = "ALTER TABLE `comments` ADD `type` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['comments']['comment'] = "ALTER TABLE `comments` ADD `comment` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['comments']['created'] = "ALTER TABLE `comments` ADD `created` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['comments']['status'] = "ALTER TABLE `comments` ADD `status` VARCHAR(100) NOT NULL DEFAULT 'active'; ";