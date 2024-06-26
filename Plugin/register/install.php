<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];

$sqlInstallDatabase .= "CREATE TABLE `register` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
    `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
    `phone_number` VARCHAR(11) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
    `course` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
    `address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
    `centre` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL ,  
    PRIMARY KEY (`id`)) ENGINE = InnoDB; ";

$sqlDeleteDatabase .= "DROP TABLE register; ";

// Bảng register
$sqlUpdateDatabase['register']['name'] = "ALTER TABLE `register` ADD `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['register']['email'] = "ALTER TABLE `register` ADD `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['register']['phone_number'] = "ALTER TABLE `register` ADD `phone_number` VARCHAR(11) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['register']['course'] = "ALTER TABLE `register` ADD `course` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['register']['address'] = "ALTER TABLE `register` ADD `address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['register']['centre'] = "ALTER TABLE `register` ADD `centre` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
?>