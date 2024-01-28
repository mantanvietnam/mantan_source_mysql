<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';

$sqlInstallDatabase .= "CREATE TABLE `lessons` ( `id` INT NOT NULL AUTO_INCREMENT , `title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `content` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `id_course` INT NOT NULL , `image` VARCHAR(255) NOT NULL , `status` VARCHAR(255) NOT NULL , `description` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `slug` VARCHAR(255) NOT NULL , `view` INT NOT NULL DEFAULT '0' , `time_learn` INT NOT NULL , `author` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `youtube_code` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";

$sqlInstallDatabase .= "CREATE TABLE `tests` ( `id` INT NOT NULL AUTO_INCREMENT , `description` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `time_test` INT NOT NULL , `title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `id_lesson` INT NOT NULL , `status` VARCHAR(255) NOT NULL , `slug` VARCHAR(255) NOT NULL , `time_start` INT NOT NULL , `time_end` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";

$sqlInstallDatabase .= "CREATE TABLE `questions` ( `id` INT NOT NULL AUTO_INCREMENT , `question` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `option_a` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `option_b` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `option_c` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `option_d` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `option_true` VARCHAR(255) NOT NULL , `id_test` INT NOT NULL , `status` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";

$sqlInstallDatabase .= "CREATE TABLE `historytests` ( `id` INT NOT NULL AUTO_INCREMENT , `id_customer` INT NOT NULL , `id_test` INT NOT NULL , `point` FLOAT NOT NULL , `total_true` INT NOT NULL , `number_question` INT NOT NULL , `time_start` INT NOT NULL , `time_end` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";

$sqlInstallDatabase .= "CREATE TABLE `courses` ( `id` INT NOT NULL AUTO_INCREMENT , `title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `image` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `description` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `slug` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `view` INT NOT NULL DEFAULT '0' , `youtube_code` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `id_category` INT NOT NULL DEFAULT '0' , `status` VARCHAR(255) NOT NULL, `content` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, PRIMARY KEY (`id`)) ENGINE = InnoDB; ";


$sqlDeleteDatabase .= "DROP TABLE lessons; ";
$sqlDeleteDatabase .= "DROP TABLE historytests; ";
$sqlDeleteDatabase .= "DROP TABLE tests; ";
$sqlDeleteDatabase .= "DROP TABLE questions; ";
$sqlDeleteDatabase .= "DROP TABLE courses; ";

$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='2top_crm_training'; ";
$sqlDeleteDatabase .= "DELETE FROM `options` WHERE `key_word`='settingTraining2TOPCRM'; ";
?>