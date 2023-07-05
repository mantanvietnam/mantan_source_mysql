<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;

$sqlInstallDatabase = 'CREATE TABLE `quayso_spa`.`members` ( `id` INT NOT NULL AUTO_INCREMENT , `name` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , `avatar` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , `phone` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , `email` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , `password` TEXT NULL , `status` INT NOT NULL , `type` INT NOT NULL , `id_member` INT NULL DEFAULT NULL , `created_at` DATETIME NULL DEFAULT NULL , `updated_at` DATETIME NULL DEFAULT NULL , `last_login` DATETIME NULL DEFAULT NULL , `dateline_at` DATETIME NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;';
$sqlDeleteDatabase = '';

$sqlInstallDatabase .= "";

$sqlInstallDatabase .= "";

$sqlInstallDatabase .= "";

$sqlInstallDatabase .= "";

/*
$sqlDeleteDatabase .= "DROP TABLE lessons; ";
$sqlDeleteDatabase .= "DROP TABLE historytests; ";
$sqlDeleteDatabase .= "DROP TABLE tests; ";
$sqlDeleteDatabase .= "DROP TABLE questions; ";

$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='2top_crm_training'; ";
$sqlDeleteDatabase .= "DELETE FROM `options` WHERE `key_word`='settingTraining2TOPCRM'; ";
*/
?>