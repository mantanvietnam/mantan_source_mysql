<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];

$sqlInstallDatabase .= "CREATE TABLE `customers` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`full_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
	`phone` VARCHAR(255) NOT NULL , 
	`email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
	`address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
	`sex` BOOLEAN NOT NULL , 
	`id_city` TINYINT NOT NULL , 
	`id_messenger` VARCHAR(255) NOT NULL, 
	`avatar` TEXT NOT NULL, 
	`status` VARCHAR(255) NOT NULL , 
	`pass` VARCHAR(255) NOT NULL , 
	`id_parent` INT NOT NULL DEFAULT '0' , 
	`id_level` INT NOT NULL DEFAULT '0' , 
	`birthday_date` INT NOT NULL , 
	`birthday_month` INT NOT NULL , 
	`birthday_year` INT NOT NULL , 
	`token` VARCHAR(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL,
	PRIMARY KEY (`id`)) ENGINE = InnoDB; ";


$sqlDeleteDatabase .= "DROP TABLE customers; ";

// Bang customers
$sqlUpdateDatabase['customers']['full_name'] = "ALTER TABLE `customers` ADD  `full_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['customers']['phone'] = "ALTER TABLE `customers` ADD `phone` VARCHAR(255) NOT NULL ; ";
$sqlUpdateDatabase['customers']['email'] = "ALTER TABLE `customers` ADD `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL ; ";
$sqlUpdateDatabase['customers']['address'] = "ALTER TABLE `customers` ADD `address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL ; ";
$sqlUpdateDatabase['customers']['sex'] = "ALTER TABLE `customers` ADD `sex` BOOLEAN NOT NULL; ";
$sqlUpdateDatabase['customers']['id_city'] = "ALTER TABLE `customers` ADD `id_city` TINYINT NOT NULL; ";
$sqlUpdateDatabase['customers']['id_messenger'] = "ALTER TABLE `customers` ADD `id_messenger` VARCHAR(255) NOT NULL; ";
$sqlUpdateDatabase['customers']['avatar'] = "ALTER TABLE `customers` ADD `avatar` TEXT NOT NULL; ";
$sqlUpdateDatabase['customers']['status'] = "ALTER TABLE `customers` ADD `status` VARCHAR(255) NOT NULL; ";
$sqlUpdateDatabase['customers']['pass'] = "ALTER TABLE `customers` ADD `pass` VARCHAR(255) NOT NULL; ";
$sqlUpdateDatabase['customers']['id_parent'] = "ALTER TABLE `customers` ADD `id_parent` INT NOT NULL DEFAULT '0'; ";
$sqlUpdateDatabase['customers']['id_level'] = "ALTER TABLE `customers` ADD `id_level` INT NOT NULL DEFAULT '0'; ";
$sqlUpdateDatabase['customers']['birthday_date'] = "ALTER TABLE `customers` ADD `birthday_date` INT NOT NULL; ";
$sqlUpdateDatabase['customers']['birthday_month'] = "ALTER TABLE `customers` ADD `birthday_month` INT NOT NULL; ";
$sqlUpdateDatabase['customers']['birthday_year'] = "ALTER TABLE `customers` ADD `birthday_year` INT NOT NULL; ";
$sqlUpdateDatabase['customers']['token'] = "ALTER TABLE `customers` ADD `token` VARCHAR(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL; ";
?>