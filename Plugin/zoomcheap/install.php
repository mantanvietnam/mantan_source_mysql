<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];

$sqlInstallDatabase .= "CREATE TABLE `managers` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`fullname` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
	`phone` VARCHAR(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
	`email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
	`password` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
	`coin` INT NOT NULL , 
	`modified` INT NOT NULL , 
	`created` INT NOT NULL , 
	`lastLogin` INT NOT NULL , 
	`avatar` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
	`otp` INT NOT NULL DEFAULT '0' , 
	PRIMARY KEY (`id`)
) ENGINE = InnoDB; ";

$sqlInstallDatabase .= "CREATE TABLE `histories` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`time` INT NOT NULL , 
	`idManager` INT NOT NULL , 
	`numberCoin` INT NOT NULL , 
	`numberCoinManager` INT NOT NULL , 
	`type` VARCHAR(255) NOT NULL , 
	`note` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
	`type_note` VARCHAR(255) NOT NULL , 
	`modified` INT NOT NULL , 
	`created` INT NOT NULL , 
	PRIMARY KEY (`id`)
) ENGINE = InnoDB; ";

$sqlInstallDatabase .= "CREATE TABLE `links` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
	`code` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
	`idManager` INT NOT NULL , 
	`goto` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL , 
	`idOrder` INT NOT NULL , 
	`modified` INT NOT NULL , 
	`created` INT NOT NULL , 
	PRIMARY KEY (`id`)
) ENGINE = InnoDB; ";

$sqlInstallDatabase .= "CREATE TABLE `orders` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`numberHour` INT NOT NULL , 
	`dateStart` INT NOT NULL , 
	`dateEnd` INT NOT NULL , 
	`price` INT NOT NULL , 
	`idManager` INT NOT NULL , 
	`idZoom` INT NOT NULL , 
	`type` INT NOT NULL , 
	`extend_time_use` INT NOT NULL , 
	`modified` INT NOT NULL , 
	`created` INT NOT NULL , 
	`idRoom` INT NOT NULL DEFAULT '0' , 
	PRIMARY KEY (`id`)
) ENGINE = InnoDB; ";

$sqlInstallDatabase .= "CREATE TABLE `zooms` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`user` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
	`pass` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
	`key_host` VARCHAR(255) NOT NULL , 
	`type` INT NOT NULL , 
	`status` VARCHAR(255) NOT NULL , 
	`idOrder` INT(11) NULL DEFAULT '0' , 
	`modified` INT NOT NULL , 
	`created` INT NOT NULL , 
	`client_id` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
	`client_secret` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
	`account_id` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
	`deadline` INT NOT NULL DEFAULT '0' , 
	`link` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL , 
	PRIMARY KEY (`id`)
) ENGINE = InnoDB; ";

$sqlInstallDatabase .= "CREATE TABLE `prices` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`price` INT NOT NULL , 
	`type` INT NOT NULL , 
	`hour` INT NOT NULL , 
	PRIMARY KEY (`id`)
) ENGINE = InnoDB; ";

$sqlInstallDatabase .= "CREATE TABLE `rooms` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`idManager` INT NOT NULL , 
	`id_order` INT NOT NULL , 
	`id_zoom` INT NOT NULL , 
	`info` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
	PRIMARY KEY (`id`)
) ENGINE = InnoDB; ";



$sqlDeleteDatabase .= "DROP TABLE managers; ";
$sqlDeleteDatabase .= "DROP TABLE histories; ";
$sqlDeleteDatabase .= "DROP TABLE links; ";
$sqlDeleteDatabase .= "DROP TABLE orders; ";
$sqlDeleteDatabase .= "DROP TABLE zooms; ";
$sqlDeleteDatabase .= "DROP TABLE prices; ";
$sqlDeleteDatabase .= "DROP TABLE rooms; ";

// Bang managers
$sqlUpdateDatabase['managers']['fullname'] = "ALTER TABLE `managers` ADD `fullname` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;";
$sqlUpdateDatabase['managers']['phone'] = "ALTER TABLE `managers` ADD `phone` VARCHAR(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;";
$sqlUpdateDatabase['managers']['email'] = "ALTER TABLE `managers` ADD `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;";
$sqlUpdateDatabase['managers']['password'] = "ALTER TABLE `managers` ADD `password` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;";
$sqlUpdateDatabase['managers']['coin'] = "ALTER TABLE `managers` ADD `coin` INT NOT NULL;";
$sqlUpdateDatabase['managers']['modified'] = "ALTER TABLE `managers` ADD `modified` INT NOT NULL;";
$sqlUpdateDatabase['managers']['created'] = "ALTER TABLE `managers` ADD `created` INT NOT NULL;";
$sqlUpdateDatabase['managers']['lastLogin'] = "ALTER TABLE `managers` ADD `lastLogin` INT NOT NULL;";
$sqlUpdateDatabase['managers']['avatar'] = "ALTER TABLE `managers` ADD `avatar` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;";
$sqlUpdateDatabase['managers']['otp'] = "ALTER TABLE `managers` ADD `otp` INT NOT NULL DEFAULT '0';";

// Bang histories
$sqlUpdateDatabase['histories']['time'] = "ALTER TABLE `histories` ADD `time` INT NOT NULL;";
$sqlUpdateDatabase['histories']['idManager'] = "ALTER TABLE `histories` ADD `idManager` INT NOT NULL;";
$sqlUpdateDatabase['histories']['numberCoin'] = "ALTER TABLE `histories` ADD `numberCoin` INT NOT NULL;";
$sqlUpdateDatabase['histories']['numberCoinManager'] = "ALTER TABLE `histories` ADD `numberCoinManager` INT NOT NULL;";
$sqlUpdateDatabase['histories']['type'] = "ALTER TABLE `histories` ADD `type` VARCHAR(255) NOT NULL;";
$sqlUpdateDatabase['histories']['note'] = "ALTER TABLE `histories` ADD `note` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;";
$sqlUpdateDatabase['histories']['type_note'] = "ALTER TABLE `histories` ADD `type_note` VARCHAR(255) NOT NULL;";
$sqlUpdateDatabase['histories']['modified'] = "ALTER TABLE `histories` ADD `modified` INT NOT NULL;";
$sqlUpdateDatabase['histories']['created'] = "ALTER TABLE `histories` ADD `created` INT NOT NULL;";

// Bang links
$sqlUpdateDatabase['links']['title'] = "ALTER TABLE `links` ADD `title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;";
$sqlUpdateDatabase['links']['code'] = "ALTER TABLE `links` ADD `code` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;";
$sqlUpdateDatabase['links']['idManager'] = "ALTER TABLE `links` ADD `idManager` INT NOT NULL;";
$sqlUpdateDatabase['links']['goto'] = "ALTER TABLE `links` ADD `goto` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL;";
$sqlUpdateDatabase['links']['idOrder'] = "ALTER TABLE `links` ADD `idOrder` INT NOT NULL;";
$sqlUpdateDatabase['links']['modified'] = "ALTER TABLE `links` ADD `modified` INT NOT NULL;";
$sqlUpdateDatabase['links']['created'] = "ALTER TABLE `links` ADD `created` INT NOT NULL;";

// Bang orders
$sqlUpdateDatabase['orders']['numberHour'] = "ALTER TABLE `orders` ADD `numberHour` INT NOT NULL;";
$sqlUpdateDatabase['orders']['dateStart'] = "ALTER TABLE `orders` ADD `dateStart` INT NOT NULL;";
$sqlUpdateDatabase['orders']['dateEnd'] = "ALTER TABLE `orders` ADD `dateEnd` INT NOT NULL;";
$sqlUpdateDatabase['orders']['price'] = "ALTER TABLE `orders` ADD `price` INT NOT NULL;";
$sqlUpdateDatabase['orders']['idManager'] = "ALTER TABLE `orders` ADD `idManager` INT NOT NULL;";
$sqlUpdateDatabase['orders']['idZoom'] = "ALTER TABLE `orders` ADD `idZoom` INT NOT NULL;";
$sqlUpdateDatabase['orders']['type'] = "ALTER TABLE `orders` ADD `type` INT NOT NULL;";
$sqlUpdateDatabase['orders']['extend_time_use'] = "ALTER TABLE `orders` ADD `extend_time_use` INT NOT NULL;";
$sqlUpdateDatabase['orders']['modified'] = "ALTER TABLE `orders` ADD `modified` INT NOT NULL;";
$sqlUpdateDatabase['orders']['created'] = "ALTER TABLE `orders` ADD `created` INT NOT NULL;";
$sqlUpdateDatabase['orders']['idRoom'] = "ALTER TABLE `orders` ADD `idRoom` INT NOT NULL DEFAULT '0';";

// Bang zooms
$sqlUpdateDatabase['zooms']['user'] = "ALTER TABLE `zooms` ADD `user` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;";
$sqlUpdateDatabase['zooms']['pass'] = "ALTER TABLE `zooms` ADD `pass` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;";
$sqlUpdateDatabase['zooms']['key_host'] = "ALTER TABLE `zooms` ADD `key_host` VARCHAR(255) NOT NULL;";
$sqlUpdateDatabase['zooms']['type'] = "ALTER TABLE `zooms` ADD `type` INT NOT NULL;";
$sqlUpdateDatabase['zooms']['status'] = "ALTER TABLE `zooms` ADD `status` VARCHAR(255) NOT NULL;";
$sqlUpdateDatabase['zooms']['idOrder'] = "ALTER TABLE `zooms` ADD `idOrder` INT(11) NULL DEFAULT '0';";
$sqlUpdateDatabase['zooms']['modified'] = "ALTER TABLE `zooms` ADD `modified` INT NOT NULL;";
$sqlUpdateDatabase['zooms']['created'] = "ALTER TABLE `zooms` ADD `created` INT NOT NULL;";
$sqlUpdateDatabase['zooms']['client_id'] = "ALTER TABLE `zooms` ADD `client_id` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;";
$sqlUpdateDatabase['zooms']['client_secret'] = "ALTER TABLE `zooms` ADD `client_secret` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;";
$sqlUpdateDatabase['zooms']['account_id'] = "ALTER TABLE `zooms` ADD `account_id` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;";
$sqlUpdateDatabase['zooms']['deadline'] = "ALTER TABLE `zooms` ADD `deadline` INT NOT NULL DEFAULT '0';";
$sqlUpdateDatabase['zooms']['link'] = "ALTER TABLE `zooms` ADD `link` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL;";

// Bang prices
$sqlUpdateDatabase['prices']['price'] = "ALTER TABLE `prices` ADD `price` INT NOT NULL;";
$sqlUpdateDatabase['prices']['type'] = "ALTER TABLE `prices` ADD `type` INT NOT NULL;";
$sqlUpdateDatabase['prices']['hour'] = "ALTER TABLE `prices` ADD `hour` INT NOT NULL;";

// Bang rooms
$sqlUpdateDatabase['rooms']['idManager'] = "ALTER TABLE `rooms` ADD `idManager` INT NOT NULL;";
$sqlUpdateDatabase['rooms']['id_order'] = "ALTER TABLE `rooms` ADD `id_order` INT NOT NULL;";
$sqlUpdateDatabase['rooms']['id_zoom'] = "ALTER TABLE `rooms` ADD `id_zoom` INT NOT NULL;";
$sqlUpdateDatabase['rooms']['info'] = "ALTER TABLE `rooms` ADD `info` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;";
?>