<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];

$sqlInstallDatabase .= "CREATE TABLE `forms` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
    `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL ,
    `address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
    `phone_number` VARCHAR(11) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
    `note` TEXT NOT NULL ,    
    PRIMARY KEY (`id`)
) ENGINE = InnoDB; ";

$sqlDeleteDatabase .= "DROP TABLE forms; ";

// Bảng forms
$sqlUpdateDatabase['forms']['name'] = "ALTER TABLE `forms` ADD `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['forms']['email'] = "ALTER TABLE `forms` ADD `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['forms']['address'] = "ALTER TABLE `forms` ADD `address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['forms']['phone_number'] = "ALTER TABLE `forms` ADD `phone_number` VARCHAR(11) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['forms']['note'] = "ALTER TABLE `forms` ADD `note` TEXT NOT NULL; ";
?>