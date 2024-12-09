<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;
global $sqlFixDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];
$sqlFixDatabase = '';



$sqlInstallDatabase .= "CREATE TABLE `members` ( 
  `id` INT NOT NULL AUTO_INCREMENT , 
  `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
  `phone` VARCHAR(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
  `email` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL , 
  `address` VARCHAR(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL , 
  `pass` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
  `otp` VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL , 
  `status` VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active' , 
  `type` VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'staff' , 
  `avatar` VARCHAR(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
  `created_at` INT NOT NULL,
  `last_login` INT NULL,
  `coin` INT NOT NULL DEFAULT '0',
  `id_permission` INT NOT NULL DEFAULT '0',
  `id_position` INT NOT NULL DEFAULT '0',
  `permission` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '[]',
  PRIMARY KEY (`id`)) ENGINE = InnoDB;
";

$sqlInstallDatabase .="CREATE TABLE `permissions` ( 
`id` INT NOT NULL AUTO_INCREMENT,
`name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`created_at` INT NOT NULL ,
`permission` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '[]' ,
 PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `activity_historys` ( 
`id` INT NOT NULL AUTO_INCREMENT,
`note` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`time` INT NOT NULL DEFAULT 0,
`id_member` INT NULL DEFAULT 0,
`id_key` INT NOT NULL DEFAULT 0,
`type` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`keyword` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `books` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `quantity` int(10) DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(10) DEFAULT NULL,
  `published_date` int(10) DEFAULT NULL,
  `publisher_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sqlInstallDatabase .="CREATE TABLE `buildings` ( `id` INT NOT NULL AUTO_INCREMENT ,
`name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`phone` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`address` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`created_at` INT NULL DEFAULT NULL ,
`description` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
) ENGINE = InnoDB;";


$sqlDeleteDatabase .= "DROP TABLE members; ";
$sqlDeleteDatabase .= "DROP TABLE permissions; ";
$sqlDeleteDatabase .= "DROP TABLE books; ";
$sqlDeleteDatabase .= "DROP TABLE buildings; ";




$sqlUpdateDatabase['members']['name'] = "ALTER TABLE `members` ADD `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";
$sqlUpdateDatabase['members']['phone'] = "ALTER TABLE `members` ADD `phone` VARCHAR(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";
$sqlUpdateDatabase['members']['email'] = "ALTER TABLE `members` ADD `email` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;";
$sqlUpdateDatabase['members']['address'] = "ALTER TABLE `members` ADD `address` VARCHAR(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;";
$sqlUpdateDatabase['members']['pass'] = "ALTER TABLE `members` ADD `pass` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";
$sqlUpdateDatabase['members']['otp'] = "ALTER TABLE `members` ADD `otp` VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;";
$sqlUpdateDatabase['members']['status'] = "ALTER TABLE `members` ADD `status` VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active';";
$sqlUpdateDatabase['members']['type'] = "ALTER TABLE `members` ADD `type` VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'staff';";
$sqlUpdateDatabase['members']['avatar'] = "ALTER TABLE `members` ADD `avatar` VARCHAR(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";
$sqlUpdateDatabase['members']['created_at'] = "ALTER TABLE `members` ADD `created_at` INT NOT NULL;";
$sqlUpdateDatabase['members']['last_login'] = "ALTER TABLE `members` ADD `last_login` INT NULL;";
$sqlUpdateDatabase['members']['coin'] = "ALTER TABLE `members` ADD `coin` INT NOT NULL DEFAULT '0';";
$sqlUpdateDatabase['members']['id_permission'] = "ALTER TABLE `members` ADD `id_permission` INT NOT NULL DEFAULT '0';";
$sqlUpdateDatabase['members']['id_position'] = "ALTER TABLE `members` ADD `id_position` INT NOT NULL DEFAULT '0';";
$sqlUpdateDatabase['members']['permission'] = "ALTER TABLE `members` ADD `permission` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '[]';";

$sqlUpdateDatabase['permissions']['name'] = "ALTER TABLE `permissions` ADD `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['permissions']['created_at'] = "ALTER TABLE `permissions` ADD `created_at` INT NOT NULL;";
$sqlUpdateDatabase['permissions']['id_member'] = "ALTER TABLE `permissions` ADD `id_member` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['permissions']['permission'] = "ALTER TABLE `permissions` ADD `permission` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '[]';";

$sqlUpdateDatabase['activity_historys']['note'] = "ALTER TABLE `activity_historys` ADD `note` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['activity_historys']['time'] = "ALTER TABLE `activity_historys` ADD `time` INT NOT NULL DEFAULT 0;";
$sqlUpdateDatabase['activity_historys']['id_member'] = "ALTER TABLE `activity_historys` ADD `id_member` INT NULL DEFAULT 0;";
$sqlUpdateDatabase['activity_historys']['id_key'] = "ALTER TABLE `activity_historys` ADD `id_key` INT NOT NULL DEFAULT 0;";
$sqlUpdateDatabase['activity_historys']['type'] = "ALTER TABLE `activity_historys` ADD `type` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['activity_historys']['keyword'] = "ALTER TABLE `activity_historys` ADD `keyword` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";


$sqlUpdateDatabase['books']['name'] = "ALTER TABLE `books` ADD `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['books']['author'] = "ALTER TABLE `books` ADD `author` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";
$sqlUpdateDatabase['books']['description'] = "ALTER TABLE `books` ADD `description` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";
$sqlUpdateDatabase['books']['quantity'] = "ALTER TABLE `books` ADD `quantity` INT NOT NULL DEFAULT 0;";
$sqlUpdateDatabase['books']['price'] = "ALTER TABLE `books` ADD `price` INT NOT NULL DEFAULT 0;";
$sqlUpdateDatabase['books']['slug'] = "ALTER TABLE `books` ADD `slug` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['books']['published_date'] = "ALTER TABLE `books` ADD `published_date` INT NOT NULL DEFAULT 0;";
$sqlUpdateDatabase['books']['publisher_id'] = "ALTER TABLE `books` ADD `publisher_id` INT NOT NULL DEFAULT 0;";

$sqlUpdateDatabase['buildings']['name'] = "ALTER TABLE `buildings` ADD `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['buildings']['phone'] = "ALTER TABLE `buildings` ADD `phone` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['buildings']['address'] = "ALTER TABLE `buildings` ADD `address` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['buildings']['created_at'] = "ALTER TABLE `buildings` ADD `created_at` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['buildings']['description'] = "ALTER TABLE `buildings` ADD `description` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";

?>