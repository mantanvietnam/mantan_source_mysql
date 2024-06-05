<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];

$sqlInstallDatabase .= "CREATE TABLE `charities` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
	`description` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
	`money_donate` INT NOT NULL , 
	`address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
	`id_city` INT NOT NULL , 
	`person_donate` INT NOT NULL , 
	`status` VARCHAR(255) NOT NULL , 
	`time_event_start` INT NOT NULL , 
	`time_event_end` INT NOT NULL , 
	`slug` VARCHAR(255) NOT NULL , 
	PRIMARY KEY (`id`)) ENGINE = InnoDB; ";

$sqlInstallDatabase .= "CREATE TABLE `donates` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`id_charity` INT NOT NULL , 
	`coin` INT NOT NULL , 
	`note` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
	`full_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
	`phone` VARCHAR(255) NOT NULL , 
	`email` VARCHAR(255) NOT NULL , 
	`id_customer` INT NOT NULL , 
	`avatar` VARCHAR(255) NOT NULL , 
	`image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
	PRIMARY KEY (`id`)) ENGINE = InnoDB; ";


$sqlDeleteDatabase .= "DROP TABLE charities; ";
$sqlDeleteDatabase .= "DROP TABLE donates; ";

// Bang charities
$sqlUpdateDatabase['charities']['title'] = "ALTER TABLE `charities` ADD `title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['charities']['description'] = "ALTER TABLE `charities` ADD `description` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['charities']['money_donate'] = "ALTER TABLE `charities` ADD `money_donate` INT NOT NULL; ";
$sqlUpdateDatabase['charities']['address'] = "ALTER TABLE `charities` ADD `address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['charities']['id_city'] = "ALTER TABLE `charities` ADD `id_city` INT NOT NULL; ";
$sqlUpdateDatabase['charities']['person_donate'] = "ALTER TABLE `charities` ADD `person_donate` INT NOT NULL; ";
$sqlUpdateDatabase['charities']['status'] = "ALTER TABLE `charities` ADD `status` VARCHAR(255) NOT NULL; ";
$sqlUpdateDatabase['charities']['time_event_start'] = "ALTER TABLE `charities` ADD `time_event_start` INT NOT NULL; ";
$sqlUpdateDatabase['charities']['time_event_end'] = "ALTER TABLE `charities` ADD `time_event_end` INT NOT NULL; ";
$sqlUpdateDatabase['charities']['slug'] = "ALTER TABLE `charities` ADD `slug` VARCHAR(255) NOT NULL; ";

// Bang donates
$sqlUpdateDatabase['donates']['id_charity'] = "ALTER TABLE `charities` ADD `id_charity` INT NOT NULL; ";
$sqlUpdateDatabase['donates']['coin'] = "ALTER TABLE `charities` ADD `coin` INT NOT NULL; ";
$sqlUpdateDatabase['donates']['note'] = "ALTER TABLE `charities` ADD `note` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['donates']['full_name'] = "ALTER TABLE `charities` ADD `full_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['donates']['phone'] = "ALTER TABLE `charities` ADD `phone` VARCHAR(255) NOT NULL; ";
$sqlUpdateDatabase['donates']['email'] = "ALTER TABLE `charities` ADD `email` VARCHAR(255) NOT NULL; ";
$sqlUpdateDatabase['donates']['id_customer'] = "ALTER TABLE `charities` ADD `id_customer` INT NOT NULL; ";
$sqlUpdateDatabase['donates']['avatar'] = "ALTER TABLE `charities` ADD `avatar` VARCHAR(255) NOT NULL; ";
$sqlUpdateDatabase['donates']['image'] = "ALTER TABLE `charities` ADD `image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
?>