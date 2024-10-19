<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;
global $sqlFixDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];
$sqlFixDatabase = '';

$sqlInstallDatabase .= "CREATE TABLE `events` ( 
  `id` INT NOT NULL AUTO_INCREMENT , 
  `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
  `address` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
  `banner` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
  `time_start` INT NOT NULL , 
  `id_member` INT NOT NULL , 
  `slug` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
  `info` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT 'thông tin chi tiết' , 
  `rule` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT 'quy định' , 
  `plan` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT 'lịch trình' , 
  `outfits` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT 'trang phục' , 
  `status` VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'lock',
  PRIMARY KEY (`id`)) ENGINE = InnoDB;
";

$sqlInstallDatabase .= "CREATE TABLE `members` ( 
  `id` INT NOT NULL AUTO_INCREMENT , 
  `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
  `phone` VARCHAR(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
  `email` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL , 
  `address` VARCHAR(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL , 
  `pass` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
  `otp` VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL , 
  `status` VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active' , 
  `facebook` VARCHAR(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL , 
  `avatar` VARCHAR(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
  `created_at` INT NOT NULL,
  `last_login` INT NULL,
  PRIMARY KEY (`id`)) ENGINE = InnoDB;
";


$sqlDeleteDatabase .= "DROP TABLE events; ";
$sqlDeleteDatabase .= "DROP TABLE members; ";

//$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='system_sales'; ";

// sửa lỗi
/*
$sqlFixDatabase .= "ALTER TABLE `products` CHANGE `info` `info` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL;";
$sqlFixDatabase .= "ALTER TABLE `products` CHANGE `description` `description` VARCHAR(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL;";
$sqlFixDatabase .= "ALTER TABLE `customers` CHANGE `full_name` `full_name` VARCHAR(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL;";
$sqlFixDatabase .= "ALTER TABLE `customers` CHANGE `phone` `phone` VARCHAR(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL;";
$sqlFixDatabase .= "ALTER TABLE `products` CHANGE `title` `title` VARCHAR(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL;";


$sqlFixDatabase .= "UPDATE `options` SET `value` = '[\"hethongdaily\",\"order_system\",\"order_customer\",\"zalo_zns\",\"training\",\"customer\",\"campaign\",\"clone_web\",\"affiliate\",\"document\",\"cashBook\",\"affiliater\"]' WHERE `options`.`key_word` = 'crm_module'; ";

//$sqlFixDatabase .= "UPDATE `options` SET `value` = '{\"userAPI\":\"admin\",\"passAPI\":\"Mmtc123!\",\"maxExport\":3,\"numberExport\":0,\"price\":0,\"note_pay\":\"\",\"number_bank\":\"\",\"account_bank\":\"\",\"key_bank\":\"\",\"idBot\":\"\",\"tokenBot\":\"\",\"idBlockConfirm\":\"\",\"idBlockDownload\":\"\"}' WHERE `options`.`key_word` = 'settingMMTCAPI'; ";
*/
// update
$sqlUpdateDatabase['events']['name'] = "ALTER TABLE `events` ADD `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";
$sqlUpdateDatabase['events']['address'] = "ALTER TABLE `events` ADD `address` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";
$sqlUpdateDatabase['events']['banner'] = "ALTER TABLE `events` ADD `banner` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";
$sqlUpdateDatabase['events']['time_start'] = "ALTER TABLE `events` ADD `time_start` INT NOT NULL;";
$sqlUpdateDatabase['events']['id_member'] = "ALTER TABLE `events` ADD `id_member` INT NOT NULL;";
$sqlUpdateDatabase['events']['slug'] = "ALTER TABLE `events` ADD `slug` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";
$sqlUpdateDatabase['events']['info'] = "ALTER TABLE `events` ADD `info` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT 'thông tin chi tiết';";
$sqlUpdateDatabase['events']['rule'] = "ALTER TABLE `events` ADD `rule` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT 'quy định';";
$sqlUpdateDatabase['events']['plan'] = "ALTER TABLE `events` ADD `plan` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT 'lịch trình';";
$sqlUpdateDatabase['events']['outfits'] = "ALTER TABLE `events` ADD `outfits` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT 'trang phục';";
$sqlUpdateDatabase['events']['status'] = "ALTER TABLE `events` ADD `status` VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'lock';";


$sqlUpdateDatabase['members']['name'] = "ALTER TABLE `members` ADD `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";
$sqlUpdateDatabase['members']['phone'] = "ALTER TABLE `members` ADD `phone` VARCHAR(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";
$sqlUpdateDatabase['members']['email'] = "ALTER TABLE `members` ADD `email` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;";
$sqlUpdateDatabase['members']['address'] = "ALTER TABLE `members` ADD `address` VARCHAR(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;";
$sqlUpdateDatabase['members']['pass'] = "ALTER TABLE `members` ADD `pass` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";
$sqlUpdateDatabase['members']['otp'] = "ALTER TABLE `members` ADD `otp` VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;";
$sqlUpdateDatabase['members']['status'] = "ALTER TABLE `members` ADD `status` VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active';";
$sqlUpdateDatabase['members']['facebook'] = "ALTER TABLE `members` ADD `facebook` VARCHAR(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;";
$sqlUpdateDatabase['members']['avatar'] = "ALTER TABLE `members` ADD `avatar` VARCHAR(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";
$sqlUpdateDatabase['members']['created_at'] = "ALTER TABLE `members` ADD `created_at` INT NOT NULL;";
$sqlUpdateDatabase['members']['last_login'] = "ALTER TABLE `members` ADD `last_login` INT NULL;";


?>