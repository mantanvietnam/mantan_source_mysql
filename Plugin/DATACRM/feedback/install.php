<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];

$sqlInstallDatabase .= "CREATE TABLE `feedbacks` ( `id` INT NOT NULL AUTO_INCREMENT , 
`feedback` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
`id_customer` INT NOT NULL DEFAULT 0 , 
`created_at` INT NOT NULL DEFAULT 0 , 
`status` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
`star` INT NOT NULL DEFAULT 0,
`image` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlDeleteDatabase .= "DROP TABLE feedbacks; ";

// Bang feedbacks
$sqlUpdateDatabase['feedbacks']['feedback'] = "ALTER TABLE `feedbacks` ADD `feedback` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";
$sqlUpdateDatabase['feedbacks']['id_customer'] = "ALTER TABLE `feedbacks` ADD `id_customer` INT NOT NULL DEFAULT '0';";
$sqlUpdateDatabase['feedbacks']['created_at'] = "ALTER TABLE `feedbacks` ADD `created_at` INT NOT NULL DEFAULT '0';";
$sqlUpdateDatabase['feedbacks']['status'] = "ALTER TABLE `feedbacks` ADD `status` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";
$sqlUpdateDatabase['feedbacks']['star'] = "ALTER TABLE `feedbacks` ADD `star` INT NOT NULL DEFAULT '0';";
$sqlUpdateDatabase['feedbacks']['image'] = "ALTER TABLE `feedbacks` ADD `image` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";