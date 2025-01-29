<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = '';

$sqlInstallDatabase .= "CREATE TABLE `request_datacrms` (
    `id` INT NOT NULL AUTO_INCREMENT , 
    `status` VARCHAR(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'new' , 
    `system_name` VARCHAR(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL , 
    `system_slug` VARCHAR(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
    `system_logo` VARCHAR(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL , 
    `boss_name` VARCHAR(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL , 
    `boss_phone` VARCHAR(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL , 
    `boss_email` VARCHAR(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL , 
    `boss_avatar` VARCHAR(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
    `boss_id_messenger` VARCHAR(100) CHARACTER SET utf32 COLLATE utf32_unicode_ci NULL,
    `domain` VARCHAR(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
    `create_at` INT NOT NULL DEFAULT '0',
    `deadline` INT NOT NULL DEFAULT '0',
    `last_login` INT NOT NULL DEFAULT '0',
    `user_db` VARCHAR(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
    `pass_db` VARCHAR(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
    `password` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
    `status_boos` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
    PRIMARY KEY (`id`)) ENGINE = InnoDB;
";

$sqlDeleteDatabase .= "DROP TABLE request_datacrms; ";

//$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='system_sales'; ";
//$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='system_positions'; ";