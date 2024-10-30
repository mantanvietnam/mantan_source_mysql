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
  `facebook` VARCHAR(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL , 
  `avatar` VARCHAR(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
  `created_at` INT NOT NULL,
  `last_login` INT NULL,
  `coin` INT NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)) ENGINE = InnoDB;
";

$sqlInstallDatabase .= "CREATE TABLE `data_ais` ( 
  `id` INT NOT NULL AUTO_INCREMENT , 
  `id_member` INT NOT NULL , 
  `data` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
  `create_ai` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
  `link_ai` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL , 
  `embed_code_ai` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  NULL , 
  `id_ai_dify` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL , 
  PRIMARY KEY (`id`)) ENGINE = InnoDB;
";

$sqlInstallDatabase .= "CREATE TABLE `search_image_events` ( 
  `id` INT NOT NULL AUTO_INCREMENT , 
  `id_member` INT NOT NULL , 
  `id_drive` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
  `name` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
  `slug` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
  `view` INT NOT NULL DEFAULT '0' , 
  `create_at` INT NOT NULL , 
  `status` VARCHAR(10) NOT NULL DEFAULT 'active',
  `collection_ai` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  PRIMARY KEY (`id`)) ENGINE = InnoDB;
";


$sqlDeleteDatabase .= "DROP TABLE members; ";
$sqlDeleteDatabase .= "DROP TABLE data_ais; ";

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
$sqlUpdateDatabase['members']['coin'] = "ALTER TABLE `members` ADD `coin` INT NOT NULL DEFAULT '0';";

$sqlUpdateDatabase['data_ais']['id_member'] = "ALTER TABLE `data_ais` ADD `id_member` INT NOT NULL;";
$sqlUpdateDatabase['data_ais']['data'] = "ALTER TABLE `data_ais` ADD `data` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";
$sqlUpdateDatabase['data_ais']['create_ai'] = "ALTER TABLE `data_ais` ADD `create_ai` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";
$sqlUpdateDatabase['data_ais']['link_ai'] = "ALTER TABLE `data_ais` ADD `link_ai` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;";
$sqlUpdateDatabase['data_ais']['embed_code_ai'] = "ALTER TABLE `data_ais` ADD `embed_code_ai` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  NULL;";
$sqlUpdateDatabase['data_ais']['id_ai_dify'] = "ALTER TABLE `data_ais` ADD `id_ai_dify` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;";


?>