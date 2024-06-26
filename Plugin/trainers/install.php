<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];

$sqlInstallDatabase .= "CREATE TABLE `trainers` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
    `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL ,
    `address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
    `phone_number` VARCHAR(11) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
    `introduce` TEXT NOT NULL ,    
    PRIMARY KEY (`id`)
) ENGINE = InnoDB; ";

$sqlDeleteDatabase .= "DROP TABLE trainers; ";

// Bảng trainers
$sqlUpdateDatabase['trainers']['name'] = "ALTER TABLE `trainers` ADD `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['trainers']['email'] = "ALTER TABLE `trainers` ADD `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['trainers']['address'] = "ALTER TABLE `trainers` ADD `address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['trainers']['phone_number'] = "ALTER TABLE `trainers` ADD `phone_number` VARCHAR(11) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['trainers']['introduce'] = "ALTER TABLE `trainers` ADD `introduce` TEXT NOT NULL; ";
?>