<?php 

$sqlInstallDatabase .= "CREATE TABLE `users` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`full_name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
	`phone` VARCHAR(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
	`email` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
	`password` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
	`coin` INT NOT NULL , 
	`modified` INT NOT NULL , 
	`created_at` INT NOT NULL , 
	`id_affsource` INT NULL DEFAULT NULL , 
	`last_login` INT NOT NULL , 
	`avatar` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
	`otp` INT NOT NULL DEFAULT NULL, 
	`access_token` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
	`address` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
	`device_token` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
	`status` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'lock',
	`sex` INT NOT NULL DEFAULT 1,
	PRIMARY KEY (`id`)
) ENGINE = InnoDB; ";


$sqlInstallDatabase .="CREATE TABLE `transaction_historys` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`id_user` INT NOT NULL , 
	`total` INT NOT NULL ,
	`coin_user` INT NULL DEFAULT NULL,
	`type` VARCHAR(255)  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  NULL DEFAULT NULL, 
	`note` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  NULL DEFAULT NULL, 
	`type_note` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  NULL DEFAULT NULL ,  
	`created` INT NOT NULL , 
	PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `image_users` ( 
`id` INT NOT NULL AUTO_INCREMENT,
`id_user` INT NOT NULL ,
`image` VARCHAR(2255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`base` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`type` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`created_at` INT NULL DEFAULT NULL ,
`status` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`note` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
) ENGINE = InnoDB;";


$sqlInstallDatabase .="CREATE TABLE `sample_category` (
	`id` int(11) NOT NULL,
	`name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
  

$sqlDeleteDatabase .= "DROP TABLE users; ";
$sqlDeleteDatabase .= "DROP TABLE transaction_historys; ";
$sqlDeleteDatabase .= "DROP TABLE image_users; ";

// Bang users
$sqlUpdateDatabase['users']['full_name'] = "ALTER TABLE `users` ADD `full_name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";
$sqlUpdateDatabase['users']['phone'] = "ALTER TABLE `users` ADD `phone` VARCHAR(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";
$sqlUpdateDatabase['users']['email'] = "ALTER TABLE `users` ADD `email` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";
$sqlUpdateDatabase['users']['password'] = "ALTER TABLE `users` ADD `password` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";
$sqlUpdateDatabase['users']['coin'] = "ALTER TABLE `users` ADD `coin` INT NOT NULL;";
$sqlUpdateDatabase['users']['modified'] = "ALTER TABLE `users` ADD `modified` INT NOT NULL;";
$sqlUpdateDatabase['users']['id_affsource'] = "ALTER TABLE `users` ADD `id_affsource` NULL DEFAULT NULL;";
$sqlUpdateDatabase['users']['created_at'] = "ALTER TABLE `users` ADD `created_at` INT NOT NULL;";
$sqlUpdateDatabase['users']['last_login'] = "ALTER TABLE `users` ADD `last_login` INT NOT NULL;";
$sqlUpdateDatabase['users']['avatar'] = "ALTER TABLE `users` ADD `avatar` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";
$sqlUpdateDatabase['users']['otp'] = "ALTER TABLE `users` ADD `otp` INT NOT NULL DEFAULT NULL;";
$sqlUpdateDatabase['users']['access_token'] = "ALTER TABLE `users` ADD `access_token` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['users']['address'] = "ALTER TABLE `users` ADD `address` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['users']['device_token'] = "ALTER TABLE `users` ADD `device_token` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['users']['status'] = "ALTER TABLE `users` ADD `status` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'lock';";
$sqlUpdateDatabase['users']['sex'] = "ALTER TABLE `users` ADD `sex` INT NOT NULL DEFAULT '1';";

$sqlUpdateDatabase['transaction_historys']['id_user'] = "ALTER TABLE `transaction_historys` ADD `id_user` INT NOT NULL ;";
$sqlUpdateDatabase['transaction_historys']['total'] = "ALTER TABLE `transaction_historys` ADD `total` INT NOT NULL ;";
$sqlUpdateDatabase['transaction_historys']['type'] = "ALTER TABLE `transaction_historys` ADD `type` VARCHAR(255)  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  NULL DEFAULT NULL;";
$sqlUpdateDatabase['transaction_historys']['note'] = "ALTER TABLE `transaction_historys` ADD `note` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  NULL DEFAULT NULL;";
$sqlUpdateDatabase['transaction_historys']['type_note'] = "ALTER TABLE `transaction_historys` ADD `type_note` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  NULL DEFAULT NULL ;";
$sqlUpdateDatabase['transaction_historys']['created'] = "ALTER TABLE `transaction_historys` ADD `created` INT NOT NULL;";
$sqlUpdateDatabase['transaction_historys']['coin_user'] = "ALTER TABLE `transaction_historys` ADD `coin_user` INT NULL DEFAULT NULL;";

$sqlUpdateDatabase['image_users']['id_user'] = "ALTER TABLE `image_users` ADD `id_user` INT NOT NULL;";
$sqlUpdateDatabase['image_users']['image'] = "ALTER TABLE `image_users` ADD `image` VARCHAR(2255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['image_users']['base'] = "ALTER TABLE `image_users` ADD `base` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['image_users']['type'] = "ALTER TABLE `image_users` ADD `type` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['image_users']['created_at'] = "ALTER TABLE `image_users` ADD `created_at` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['image_users']['status'] = "ALTER TABLE `image_users` ADD `status` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['image_users']['name'] = "ALTER TABLE `image_users` ADD `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['image_users']['note'] = "ALTER TABLE `image_users` ADD `note` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";