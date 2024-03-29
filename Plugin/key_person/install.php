<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';

$sqlInstallDatabase .= "CREATE TABLE `persons` (`id` INT NOT NULL AUTO_INCREMENT , 
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
