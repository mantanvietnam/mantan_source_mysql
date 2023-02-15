<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';

$sqlInstallDatabase .= "CREATE TABLE `lessons` ( `id` INT NOT NULL AUTO_INCREMENT , `title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `content` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `id_category` INT NOT NULL , `image` VARCHAR(255) NOT NULL , `status` VARCHAR(255) NOT NULL , `description` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `slug` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";

$sqlInstallDatabase .= "CREATE TABLE `tests` ( `id` INT NOT NULL AUTO_INCREMENT , `description` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `time_test` INT NOT NULL , `title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `id_lesson` INT NOT NULL , `status` VARCHAR(255) NOT NULL , `slug` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";

$sqlInstallDatabase .= "CREATE TABLE `questions` ( `id` INT NOT NULL AUTO_INCREMENT , `question` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `option_a` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `option_b` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `option_c` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `option_d` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `option_true` VARCHAR(255) NOT NULL , `id_test` INT NOT NULL , `status` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";


$sqlDeleteDatabase .= "DROP TABLE lessons; ";
$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='2top_crm_training'; ";
$sqlDeleteDatabase .= "DELETE FROM `options` WHERE `key_word`='settingTraining2TOPCRM'; ";
?>