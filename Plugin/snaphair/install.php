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

$sqlDeleteDatabase .= "DROP TABLE users; ";

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
