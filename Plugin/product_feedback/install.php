<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];

$sqlInstallDatabase .= "CREATE TABLE `feedbacks` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`id_product` INT NOT NULL , 
	`id_customer` INT NOT NULL , 
	`note` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
	`time_create` INT NOT NULL , 
	PRIMARY KEY (`id`)
) ENGINE = InnoDB; ";

$sqlInstallDatabase .= "CREATE TABLE `feedbackinfos` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`id_criteria` INT NOT NULL , 
	`point` INT NOT NULL , 
	`id_feedback` INT NOT NULL , 
	`id_customer` INT NOT NULL , 
	`id_product` INT NOT NULL , 
	PRIMARY KEY (`id`)
) ENGINE = InnoDB; ";


$sqlDeleteDatabase .= "DROP TABLE feedbacks; ";
$sqlDeleteDatabase .= "DROP TABLE feedbackinfos; ";
$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='criteria_feedback'; ";

// Bang feedbacks
$sqlUpdateDatabase['feedbacks']['id_product'] = "ALTER TABLE `feedbacks` ADD `id_product` INT NOT NULL; ";
$sqlUpdateDatabase['feedbacks']['id_customer'] = "ALTER TABLE `feedbacks` ADD `id_customer` INT NOT NULL; ";
$sqlUpdateDatabase['feedbacks']['note'] = "ALTER TABLE `feedbacks` ADD `note` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['feedbacks']['time_create'] = "ALTER TABLE `feedbacks` ADD `time_create` INT NOT NULL; ";

// Bang feedbackinfos
$sqlUpdateDatabase['feedbackinfos']['id_criteria'] = "ALTER TABLE `feedbackinfos` ADD `id_criteria` INT NOT NULL; ";
$sqlUpdateDatabase['feedbackinfos']['point'] = "ALTER TABLE `feedbackinfos` ADD `point` INT NOT NULL; ";
$sqlUpdateDatabase['feedbackinfos']['id_feedback'] = "ALTER TABLE `feedbackinfos` ADD `id_feedback` INT NOT NULL; ";
$sqlUpdateDatabase['feedbackinfos']['id_customer'] = "ALTER TABLE `feedbackinfos` ADD `id_customer` INT NOT NULL; ";
$sqlUpdateDatabase['feedbackinfos']['id_product'] = "ALTER TABLE `feedbackinfos` ADD `id_product` INT NOT NULL; ";
?>