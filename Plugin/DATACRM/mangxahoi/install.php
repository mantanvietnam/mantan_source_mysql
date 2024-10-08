<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;
global $sqlFixDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];
$sqlFixDatabase = '';

$sqlInstallDatabase .="CREATE TABLE `comments` ( 
  `id` INT NOT NULL AUTO_INCREMENT , 
  `id_customer` INT NULL DEFAULT NULL , 
  `id_object` INT NULL DEFAULT NULL , 
  `id_father` INT NULL DEFAULT NULL , 
  `keyword` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL , 
  `comment` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL , 
  `created_at` INT NULL DEFAULT NULL, 
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;"

$sqlInstallDatabase .="CREATE TABLE `likes` ( 
  `id` INT NOT NULL AUTO_INCREMENT , 
  `id_customer` INT NULL DEFAULT NULL , 
  `id_object` INT NULL DEFAULT NULL , 
  `keyword` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL , 
  `type` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL,
  `created_at` INT NULL DEFAULT NULL, 
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;";


$sqlDeleteDatabase .= "DROP TABLE comments; ";
$sqlDeleteDatabase .= "DROP TABLE likes; ";

$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='system_sales'; ";
$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='system_positions'; ";



$sqlUpdateDatabase['comments']['id_customer'] = "ALTER TABLE `comments` ADD `id_customer` INT NULL DEFAULT NULL ;";
$sqlUpdateDatabase['comments']['id_object'] = "ALTER TABLE `comments` ADD `id_object` INT NULL DEFAULT NULL ;";
$sqlUpdateDatabase['comments']['id_father'] = "ALTER TABLE `comments` ADD `id_father` INT NULL DEFAULT NULL ;";
$sqlUpdateDatabase['comments']['keyword'] = "ALTER TABLE `comments` ADD `keyword` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL ;";
$sqlUpdateDatabase['comments']['comment'] = "ALTER TABLE `comments` ADD `comment` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL ;";
$sqlUpdateDatabase['comments']['created_at'] = "ALTER TABLE `comments` ADD `created_at` INT NULL DEFAULT NULL;";

$sqlUpdateDatabase['likes']['id_customer'] = "ALTER TABLE `likes` ADD `id_customer` INT NULL DEFAULT NULL ;";
$sqlUpdateDatabase['likes']['id_object'] = "ALTER TABLE `likes` ADD `id_object` INT NULL DEFAULT NULL ;";
$sqlUpdateDatabase['likes']['keyword'] = "ALTER TABLE `likes` ADD `keyword` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL ;";
$sqlUpdateDatabase['likes']['type'] = "ALTER TABLE `likes` ADD `type` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['likes']['created_at'] = "ALTER TABLE `likes` ADD `created_at` INT NULL DEFAULT NULL;";
?>