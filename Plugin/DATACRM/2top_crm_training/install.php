<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];

$sqlInstallDatabase .= "CREATE TABLE `lessons` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
	`content` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
	`id_course` INT NOT NULL , 
	`image` VARCHAR(255) NOT NULL , 
	`status` VARCHAR(255) NOT NULL , 
	`description` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
	`slug` VARCHAR(255) NOT NULL , 
	`view` INT NOT NULL DEFAULT '0' , 
	`time_learn` INT NOT NULL , 
	`author` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
	`youtube_code` VARCHAR(255) NOT NULL , 
	PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .= "CREATE TABLE `tests` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`description` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
	`time_test` INT NOT NULL , 
	`title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
	`id_lesson` INT NOT NULL , 
	`status` VARCHAR(255) NOT NULL , 
	`slug` VARCHAR(255) NOT NULL , 
	`time_start` INT NOT NULL , 
	`time_end` INT NOT NULL , 
	`id_course` INT NULL, 
	`point_min` FLOAT NOT NULL DEFAULT '10', 
	PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .= "CREATE TABLE `questions` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`question` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
	`option_a` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
	`option_b` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
	`option_c` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
	`option_d` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
	`option_true` VARCHAR(255) NOT NULL , 
	`id_test` INT NOT NULL , 
	`status` VARCHAR(255) NOT NULL , 
	PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .= "CREATE TABLE `historytests` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`id_customer` INT NOT NULL , 
	`id_test` INT NOT NULL , 
	`point` FLOAT NOT NULL , 
	`total_true` INT NOT NULL , 
	`number_question` INT NOT NULL , 
	`time_start` INT NOT NULL , 
	`time_end` INT NOT NULL , 
	`status` VARCHAR(255) NOT NULL, 
	PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .= "CREATE TABLE `courses` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
	`image` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
	`description` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
	`slug` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
	`view` INT NOT NULL DEFAULT '0' , 
	`youtube_code` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
	`id_category` INT NOT NULL DEFAULT '0' , 
	`status` VARCHAR(255) NOT NULL, 
	`content` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, 
	`public` BOOLEAN NOT NULL DEFAULT FALSE,
	PRIMARY KEY (`id`)
) ENGINE = InnoDB; ";


$sqlDeleteDatabase .= "DROP TABLE lessons; ";
$sqlDeleteDatabase .= "DROP TABLE historytests; ";
$sqlDeleteDatabase .= "DROP TABLE tests; ";
$sqlDeleteDatabase .= "DROP TABLE questions; ";
$sqlDeleteDatabase .= "DROP TABLE courses; ";

$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='2top_crm_training'; ";
$sqlDeleteDatabase .= "DELETE FROM `options` WHERE `key_word`='settingTraining2TOPCRM'; ";

// bảng lessons
$sqlUpdateDatabase['lessons']['title'] = "ALTER TABLE `lessons` ADD `title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL;";
$sqlUpdateDatabase['lessons']['content'] = "ALTER TABLE `lessons` ADD `content` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL;";
$sqlUpdateDatabase['lessons']['id_course'] = "ALTER TABLE `lessons` ADD `id_course` INT NOT NULL;";
$sqlUpdateDatabase['lessons']['image'] = "ALTER TABLE `lessons` ADD `image` VARCHAR(255) NOT NULL;";
$sqlUpdateDatabase['lessons']['status'] = "ALTER TABLE `lessons` ADD `status` VARCHAR(255) NOT NULL;";
$sqlUpdateDatabase['lessons']['description'] = "ALTER TABLE `lessons` ADD `description` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL;";
$sqlUpdateDatabase['lessons']['slug'] = "ALTER TABLE `lessons` ADD `slug` VARCHAR(255) NOT NULL;";
$sqlUpdateDatabase['lessons']['view'] = "ALTER TABLE `lessons` ADD `view` INT NOT NULL DEFAULT '0';";
$sqlUpdateDatabase['lessons']['time_learn'] = "ALTER TABLE `lessons` ADD `time_learn` INT NOT NULL;";
$sqlUpdateDatabase['lessons']['author'] = "ALTER TABLE `lessons` ADD `author` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL;";
$sqlUpdateDatabase['lessons']['youtube_code'] = "ALTER TABLE `lessons` ADD `youtube_code` VARCHAR(255) NOT NULL;";

// bảng tests
$sqlUpdateDatabase['tests']['description'] = "ALTER TABLE `tests` ADD `description` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL;";
$sqlUpdateDatabase['tests']['time_test'] = "ALTER TABLE `tests` ADD `time_test` INT NOT NULL;";
$sqlUpdateDatabase['tests']['title'] = "ALTER TABLE `tests` ADD `title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL;";
$sqlUpdateDatabase['tests']['id_lesson'] = "ALTER TABLE `tests` ADD `id_lesson` INT NOT NULL ;";
$sqlUpdateDatabase['tests']['status'] = "ALTER TABLE `tests` ADD `status` VARCHAR(255) NOT NULL;";
$sqlUpdateDatabase['tests']['slug'] = "ALTER TABLE `tests` ADD `slug` VARCHAR(255) NOT NULL;";
$sqlUpdateDatabase['tests']['time_start'] = "ALTER TABLE `tests` ADD `time_start` INT NOT NULL;";
$sqlUpdateDatabase['tests']['time_end'] = "ALTER TABLE `tests` ADD `time_end` INT NOT NULL;";
$sqlUpdateDatabase['tests']['id_course'] = "ALTER TABLE `tests` ADD `id_course` INT NULL;";
$sqlUpdateDatabase['tests']['point_min'] = "ALTER TABLE `tests` ADD `point_min` FLOAT NOT NULL DEFAULT '10';";

// bảng questions
$sqlUpdateDatabase['questions']['question'] = "ALTER TABLE `questions` ADD `question` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL;";
$sqlUpdateDatabase['questions']['option_a'] = "ALTER TABLE `questions` ADD `option_a` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL;";
$sqlUpdateDatabase['questions']['option_b'] = "ALTER TABLE `questions` ADD `option_b` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL;";
$sqlUpdateDatabase['questions']['option_c'] = "ALTER TABLE `questions` ADD `option_c` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL;";
$sqlUpdateDatabase['questions']['option_d'] = "ALTER TABLE `questions` ADD `option_d` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL;";
$sqlUpdateDatabase['questions']['option_true'] = "ALTER TABLE `questions` ADD `option_true` VARCHAR(255) NOT NULL;";
$sqlUpdateDatabase['questions']['id_test'] = "ALTER TABLE `questions` ADD `id_test` INT NOT NULL;";
$sqlUpdateDatabase['questions']['status'] = "ALTER TABLE `questions` ADD `status` VARCHAR(255) NOT NULL;";

// bảng historytests
$sqlUpdateDatabase['historytests']['id_customer'] = "ALTER TABLE `historytests` ADD `id_customer` INT NOT NULL;";
$sqlUpdateDatabase['historytests']['id_test'] = "ALTER TABLE `historytests` ADD `id_test` INT NOT NULL;";
$sqlUpdateDatabase['historytests']['point'] = "ALTER TABLE `historytests` ADD `point` FLOAT NOT NULL;";
$sqlUpdateDatabase['historytests']['total_true'] = "ALTER TABLE `historytests` ADD `total_true` INT NOT NULL;";
$sqlUpdateDatabase['historytests']['number_question'] = "ALTER TABLE `historytests` ADD `number_question` INT NOT NULL;";
$sqlUpdateDatabase['historytests']['time_start'] = "ALTER TABLE `historytests` ADD `time_start` INT NOT NULL;";
$sqlUpdateDatabase['historytests']['time_end'] = "ALTER TABLE `historytests` ADD `time_end` INT NOT NULL;";
$sqlUpdateDatabase['historytests']['status'] = "ALTER TABLE `historytests` ADD `status` VARCHAR(255) NOT NULL;";

// bảng courses
$sqlUpdateDatabase['courses']['title'] = "ALTER TABLE `courses` ADD `title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;";
$sqlUpdateDatabase['courses']['image'] = "ALTER TABLE `courses` ADD `image` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;";
$sqlUpdateDatabase['courses']['description'] = "ALTER TABLE `courses` ADD `description` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;";
$sqlUpdateDatabase['courses']['slug'] = "ALTER TABLE `courses` ADD `slug` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;";
$sqlUpdateDatabase['courses']['view'] = "ALTER TABLE `courses` ADD `view` INT NOT NULL DEFAULT '0';";
$sqlUpdateDatabase['courses']['youtube_code'] = "ALTER TABLE `courses` ADD `youtube_code` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;";
$sqlUpdateDatabase['courses']['id_category'] = "ALTER TABLE `courses` ADD `id_category` INT NOT NULL DEFAULT '0';";
$sqlUpdateDatabase['courses']['status'] = "ALTER TABLE `courses` ADD `status` VARCHAR(255) NOT NULL;";
$sqlUpdateDatabase['courses']['content'] = "ALTER TABLE `courses` ADD `content` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;";
$sqlUpdateDatabase['courses']['public'] = "ALTER TABLE `courses` ADD `public` BOOLEAN NOT NULL DEFAULT FALSE;";
?>