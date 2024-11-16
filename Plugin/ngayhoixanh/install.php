<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];

$sqlInstallDatabase .= "CREATE TABLE `locations` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , `image` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , `description` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , `id_city` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";

$sqlInstallDatabase .= "CREATE TABLE `trees` ( `id` INT NOT NULL AUTO_INCREMENT , `id_location` INT NOT NULL DEFAULT '0' , `name_tree` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , `name_program` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , `number_tree` VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' , `choose_1` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , `choose_2` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; ";

$sqlInstallDatabase .= "CREATE TABLE `image_trees` ( `id` INT NOT NULL AUTO_INCREMENT , `id_tree` INT NOT NULL , `link` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; ";

$sqlDeleteDatabase .= "DROP TABLE locations; ";
$sqlDeleteDatabase .= "DROP TABLE trees; ";
$sqlDeleteDatabase .= "DROP TABLE image_trees; ";

// Bang donates
//$sqlUpdateDatabase['donates']['name'] = "ALTER TABLE `donates` ADD `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";