<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];

$sqlInstallDatabase .= "CREATE TABLE `feedbacks` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`full_name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
	`avatar` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
	`position` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
	`link` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
	`content` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
	PRIMARY KEY (`id`)) ENGINE = InnoDB;";

$sqlDeleteDatabase .= "DROP TABLE feedbacks; ";

// Bang feedbacks
$sqlUpdateDatabase['feedbacks']['id'] = "ALTER TABLE `feedbacks` ADD `id` INT NOT NULL AUTO_INCREMENT ; ";
$sqlUpdateDatabase['feedbacks']['full_name'] = "ALTER TABLE `feedbacks` ADD `full_name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ; ";
$sqlUpdateDatabase['feedbacks']['avatar'] = "ALTER TABLE `feedbacks` ADD `avatar` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['feedbacks']['position'] = "ALTER TABLE `feedbacks` ADD `position` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ; ";
$sqlUpdateDatabase['feedbacks']['link'] = "ALTER TABLE `feedbacks` ADD `link` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ; ";
$sqlUpdateDatabase['feedbacks']['content'] = "ALTER TABLE `feedbacks` ADD `content` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ; ";