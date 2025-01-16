<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];

$sqlInstallDatabase .= "CREATE TABLE `appkeys` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`value` VARCHAR(255) NOT NULL , 
	`id_category` INT NOT NULL , 
	`status` VARCHAR(255) NOT NULL , 
	`used` INT NOT NULL , 
	`month` INT NOT NULL, 
	`user` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, 
	`pass` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, 
	`create_at` INT NOT NULL DEFAULT '0', 
	`deadline` INT NOT NULL DEFAULT '0', 
	PRIMARY KEY (`id`)
) ENGINE = InnoDB; ";


$sqlDeleteDatabase .= "DROP TABLE appkeys; ";
$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='application_key'; ";

// Bang appkeys
$sqlUpdateDatabase['appkeys']['value'] = "ALTER TABLE `appkeys` ADD `value` VARCHAR(255) NOT NULL; ";
$sqlUpdateDatabase['appkeys']['id_category'] = "ALTER TABLE `appkeys` ADD `id_category` INT NOT NULL; ";
$sqlUpdateDatabase['appkeys']['status'] = "ALTER TABLE `appkeys` ADD `status` VARCHAR(255) NOT NULL; ";
$sqlUpdateDatabase['appkeys']['used'] = "ALTER TABLE `appkeys` ADD `used` INT NOT NULL; ";
$sqlUpdateDatabase['appkeys']['month'] = "ALTER TABLE `appkeys` ADD `month` INT NOT NULL; ";
$sqlUpdateDatabase['appkeys']['user'] = "ALTER TABLE `appkeys` ADD `user` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['appkeys']['pass'] = "ALTER TABLE `appkeys` ADD `pass` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['appkeys']['create_at'] = "ALTER TABLE `appkeys` ADD `create_at` INT NOT NULL DEFAULT '0'; ";
$sqlUpdateDatabase['appkeys']['deadline'] = "ALTER TABLE `appkeys` ADD `deadline` INT NOT NULL DEFAULT '0'; ";
?>