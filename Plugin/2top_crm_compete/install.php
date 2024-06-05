<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];

$sqlInstallDatabase .= "CREATE TABLE `competes` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
	`description` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
	`date_start` INT NOT NULL , 
	`date_end` INT NOT NULL , 
	`slug` VARCHAR(255) NOT NULL , 
	`image` VARCHAR(255) NOT NULL , 
	`status` VARCHAR(255) NOT NULL , 
	PRIMARY KEY (`id`)) ENGINE = InnoDB; ";

$sqlInstallDatabase .= "CREATE TABLE `targets` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
	`description` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
	`point` INT NOT NULL , 
	`id_compete` INT NOT NULL , 
	`status` VARCHAR(255) NOT NULL , 
	`type` VARCHAR(255) NOT NULL , 
	PRIMARY KEY (`id`)) ENGINE = InnoDB; ";

$sqlInstallDatabase .= "CREATE TABLE `reports` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`id_customer` INT NOT NULL , 
	`id_target` INT NOT NULL , 
	`image` VARCHAR(255) NOT NULL , 
	`note` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
	`time_report` INT NOT NULL , 
	`point` INT NOT NULL , 
	`id_compete` INT NOT NULL , 
	PRIMARY KEY (`id`)) ENGINE = InnoDB; ; ";


$sqlDeleteDatabase .= "DROP TABLE competes; ";
$sqlDeleteDatabase .= "DROP TABLE targets; ";
$sqlDeleteDatabase .= "DROP TABLE reports; ";

// Bang competes
$sqlUpdateDatabase['competes']['title'] = "ALTER TABLE `competes` ADD `title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['competes']['description'] = "ALTER TABLE `competes` ADD `description` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['competes']['date_start'] = "ALTER TABLE `competes` ADD `date_start` INT NOT NULL; ";
$sqlUpdateDatabase['competes']['date_end'] = "ALTER TABLE `competes` ADD `date_end` INT NOT NULL; ";
$sqlUpdateDatabase['competes']['slug'] = "ALTER TABLE `competes` ADD `slug` VARCHAR(255) NOT NULL; ";
$sqlUpdateDatabase['competes']['image'] = "ALTER TABLE `competes` ADD `image` VARCHAR(255) NOT NULL; ";
$sqlUpdateDatabase['competes']['status'] = "ALTER TABLE `competes` ADD `status` VARCHAR(255) NOT NULL; ";

// Bang targets
$sqlUpdateDatabase['targets']['title'] = "ALTER TABLE `targets` ADD `title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['targets']['description'] = "ALTER TABLE `targets` ADD `description` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['targets']['point'] = "ALTER TABLE `targets` ADD `point` INT NOT NULL; ";
$sqlUpdateDatabase['targets']['id_compete'] = "ALTER TABLE `targets` ADD `id_compete` INT NOT NULL; ";
$sqlUpdateDatabase['targets']['status'] = "ALTER TABLE `targets` ADD `status` VARCHAR(255) NOT NULL; ";
$sqlUpdateDatabase['targets']['type'] = "ALTER TABLE `targets` ADD `type` VARCHAR(255) NOT NULL; ";

// Bang reports
$sqlUpdateDatabase['reports']['id_customer'] = "ALTER TABLE `reports` ADD `id_customer` INT NOT NULL; ";
$sqlUpdateDatabase['reports']['id_target'] = "ALTER TABLE `reports` ADD `id_target` INT NOT NULL; ";
$sqlUpdateDatabase['reports']['image'] = "ALTER TABLE `reports` ADD `image` VARCHAR(255) NOT NULL; ";
$sqlUpdateDatabase['reports']['note'] = "ALTER TABLE `reports` ADD `note` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['reports']['time_report'] = "ALTER TABLE `reports` ADD `time_report` INT NOT NULL; ";
$sqlUpdateDatabase['reports']['point'] = "ALTER TABLE `reports` ADD `point` INT NOT NULL; ";
$sqlUpdateDatabase['reports']['id_compete'] = "ALTER TABLE `reports` ADD `id_compete` INT NOT NULL; ";
?>