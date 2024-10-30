<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;
global $sqlFixDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];
$sqlFixDatabase = '';

$sqlInstallDatabase .= "CREATE TABLE `uplike_histories` ( 
  `id` INT NOT NULL AUTO_INCREMENT , 
  `id_member` INT NOT NULL , 
  `id_page` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
  `type_page` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
  `money` INT NOT NULL DEFAULT '0' , 
  `number_up` INT NOT NULL DEFAULT '0' , 
  `create_at` INT NOT NULL , 
  `status` VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new' , 
  PRIMARY KEY (`id`)) ENGINE = InnoDB; ";


$sqlDeleteDatabase .= "DROP TABLE uplike_histories; ";

// update
$sqlUpdateDatabase['uplike_histories']['id_member'] = "ALTER TABLE `uplike_histories` ADD `id_member` INT NOT NULL;";
$sqlUpdateDatabase['uplike_histories']['id_page'] = "ALTER TABLE `uplike_histories` ADD `id_page` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";
$sqlUpdateDatabase['uplike_histories']['type_page'] = "ALTER TABLE `uplike_histories` ADD `type_page` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";
$sqlUpdateDatabase['uplike_histories']['money'] = "ALTER TABLE `uplike_histories` ADD `money` INT NOT NULL DEFAULT '0';";
$sqlUpdateDatabase['uplike_histories']['number_up'] = "ALTER TABLE `uplike_histories` ADD `number_up` INT NOT NULL DEFAULT '0';";
$sqlUpdateDatabase['uplike_histories']['create_at'] = "ALTER TABLE `uplike_histories` ADD `create_at` INT NOT NULL;";
$sqlUpdateDatabase['uplike_histories']['status'] = "ALTER TABLE `uplike_histories` ADD `status` VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new';";

