<?php 

$sqlInstallDatabase .= "CREATE TABLE `users` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`full_name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
	`phone` VARCHAR(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
	`email` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
	`password` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
	`coin` INT NOT NULL , 
	`modified` INT NOT NULL , 
	`created` INT NOT NULL , 
	`lastLogin` INT NOT NULL , 
	`avatar` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
	`otp` INT NOT NULL DEFAULT '0' , 
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
$sqlUpdateDatabase['users']['created'] = "ALTER TABLE `users` ADD `created` INT NOT NULL;";
$sqlUpdateDatabase['users']['lastLogin'] = "ALTER TABLE `users` ADD `lastLogin` INT NOT NULL;";
$sqlUpdateDatabase['users']['avatar'] = "ALTER TABLE `users` ADD `avatar` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";
$sqlUpdateDatabase['users']['otp'] = "ALTER TABLE `users` ADD `otp` INT NOT NULL DEFAULT '0';";

 ?>