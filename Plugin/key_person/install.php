<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];

$sqlInstallDatabase .= "CREATE TABLE `persons` (
                            `id` INT NOT NULL AUTO_INCREMENT , 
                            `name` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL , 
                            `address` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL , 
                            `phone` VARCHAR(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL , 
                            `email` VARCHAR(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL , 
                            `image` VARCHAR(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL , 
                            `note` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL , 
                            `facebook` VARCHAR(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL , 
                            `zalo` VARCHAR(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL , 
                            `id_category` INT NOT NULL DEFAULT '0' , 
                            PRIMARY KEY (`id`)
                        ) ENGINE = InnoDB; ";

$sqlDeleteDatabase .= "DROP TABLE person; ";

// Bang persons
$sqlUpdateDatabase['persons']['name'] = "ALTER TABLE `persons` ADD `name` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['persons']['address'] = "ALTER TABLE `persons` ADD `address` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL; ";
$sqlUpdateDatabase['persons']['phone'] = "ALTER TABLE `persons` ADD `phone` VARCHAR(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['persons']['email'] = "ALTER TABLE `persons` ADD `email` VARCHAR(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL; ";
$sqlUpdateDatabase['persons']['image'] = "ALTER TABLE `persons` ADD `image` VARCHAR(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['persons']['note'] = "ALTER TABLE `persons` ADD `note` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL; ";
$sqlUpdateDatabase['persons']['name'] = "ALTER TABLE `persons` ADD `facebook` VARCHAR(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL; ";
$sqlUpdateDatabase['persons']['zalo'] = "ALTER TABLE `persons` ADD `zalo` VARCHAR(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL; ";
$sqlUpdateDatabase['persons']['id_category'] = "ALTER TABLE `persons` ADD `id_category` INT NOT NULL DEFAULT '0'; ";