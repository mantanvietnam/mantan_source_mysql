<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];

$sqlInstallDatabase .= "CREATE TABLE `campaigns` (
                                `id` INT NOT NULL AUTO_INCREMENT , 
                                `name` VARCHAR(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL , 
                                `name_show` VARCHAR(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL , 
                                `text_welcome` VARCHAR(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL , 
                                `codeSecurity` VARCHAR(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL , 
                                `codePersonWin` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL , 
                                `noteCheckin` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL , 
                                `colorText` VARCHAR(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '#000000' , 
                                `status` VARCHAR(30) NOT NULL DEFAULT 'active' , 
                                `img_background` VARCHAR(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL , 
                                `id_member` INT NOT NULL , 
                                `location` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL , 
                                `img_logo` VARCHAR(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL , 
                                `team` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL,
                                `ticket` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL,
                                `create_at` INT NOT NULL , 
                                `image` VARCHAR(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL,
                                `description` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL;
                                `id_drive` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
                                `id_ai_event` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
                                `link_drive` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
                                `id_album` INT NOT NULL DEFAULT '0';
                                PRIMARY KEY (`id`)
                            ) ENGINE = InnoDB; ";

$sqlInstallDatabase .= "CREATE TABLE `campaign_customers` (
                                `id` INT NOT NULL AUTO_INCREMENT , 
                                `id_member` INT NOT NULL , 
                                `id_customer` INT NOT NULL , 
                                `id_campaign` INT NOT NULL , 
                                `id_location` INT NOT NULL DEFAULT '0' , 
                                `id_team` INT NOT NULL DEFAULT '0' , 
                                `note` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL,
                                `time_checkin` INT NOT NULL DEFAULT '0',
                                `id_ticket` INT NOT NULL DEFAULT '0',
                                `create_at` INT NOT NULL DEFAULT '0',
                                PRIMARY KEY (`id`)
                            ) ENGINE = InnoDB; ";

$sqlDeleteDatabase .= "DROP TABLE campaigns; ";
$sqlDeleteDatabase .= "DROP TABLE campaign_customers; ";

// bảng campaigns
$sqlUpdateDatabase['campaigns']['name'] = "ALTER TABLE `campaigns` ADD `name` VARCHAR(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['campaigns']['name_show'] = "ALTER TABLE `campaigns` ADD `name_show` VARCHAR(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL; ";
$sqlUpdateDatabase['campaigns']['text_welcome'] = "ALTER TABLE `campaigns` ADD `text_welcome` VARCHAR(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL; ";
$sqlUpdateDatabase['campaigns']['codeSecurity'] = "ALTER TABLE `campaigns` ADD `codeSecurity` VARCHAR(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL ; ";
$sqlUpdateDatabase['campaigns']['codePersonWin'] = "ALTER TABLE `campaigns` ADD `codePersonWin` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL ; ";
$sqlUpdateDatabase['campaigns']['noteCheckin'] = "ALTER TABLE `campaigns` ADD `noteCheckin` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL ; ";
$sqlUpdateDatabase['campaigns']['colorText'] = "ALTER TABLE `campaigns` ADD `colorText` VARCHAR(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '#000000'  ; ";
$sqlUpdateDatabase['campaigns']['status'] = "ALTER TABLE `campaigns` ADD `status` VARCHAR(30) NOT NULL DEFAULT 'active' ; ";
$sqlUpdateDatabase['campaigns']['img_background'] = "ALTER TABLE `campaigns` ADD `img_background` VARCHAR(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL ; ";
$sqlUpdateDatabase['campaigns']['id_member'] = "ALTER TABLE `campaigns` ADD `id_member` INT NOT NULL ; ";
$sqlUpdateDatabase['campaigns']['location'] = "ALTER TABLE `campaigns` ADD `location` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL ; ";
$sqlUpdateDatabase['campaigns']['img_logo'] = "ALTER TABLE `campaigns` ADD `img_logo` VARCHAR(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL ; ";
$sqlUpdateDatabase['campaigns']['image'] = "ALTER TABLE `campaigns` ADD `image` VARCHAR(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL ; ";
$sqlUpdateDatabase['campaigns']['description'] = "ALTER TABLE `campaigns` ADD `description` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL ; ";
$sqlUpdateDatabase['campaigns']['team'] = "ALTER TABLE `campaigns` ADD `team` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL; ";
$sqlUpdateDatabase['campaigns']['ticket'] = "ALTER TABLE `campaigns` ADD `ticket` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL; ";
$sqlUpdateDatabase['campaigns']['create_at'] = "ALTER TABLE `campaigns` ADD `create_at` INT NOT NULL ; ";

$sqlUpdateDatabase['campaigns']['id_drive'] = "ALTER TABLE `campaigns` ADD `id_drive` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['campaigns']['id_ai_event'] = "ALTER TABLE `campaigns` ADD `id_ai_event` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,;";
$sqlUpdateDatabase['campaigns']['link_drive'] = "ALTER TABLE `campaigns` ADD `link_drive` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['campaigns']['id_album'] = "ALTER TABLE `campaigns` ADD `id_album` INT NOT NULL DEFAULT '0';";

// Bang campaign_customers
$sqlUpdateDatabase['campaign_customers']['id'] = "ALTER TABLE `campaign_customers` ADD  `id` INT NOT NULL AUTO_INCREMENT; ";
$sqlUpdateDatabase['campaign_customers']['id_member'] = "ALTER TABLE `campaign_customers` ADD  `id_member` INT NOT NULL ; ";
$sqlUpdateDatabase['campaign_customers']['id_customer'] = "ALTER TABLE `campaign_customers` ADD  `id_customer` INT NOT NULL ; ";
$sqlUpdateDatabase['campaign_customers']['id_campaign'] = "ALTER TABLE `campaign_customers` ADD  `id_campaign` INT NOT NULL ; ";
$sqlUpdateDatabase['campaign_customers']['id_location'] = "ALTER TABLE `campaign_customers` ADD  `id_location` INT NOT NULL DEFAULT '0' ; ";
$sqlUpdateDatabase['campaign_customers']['id_team'] = "ALTER TABLE `campaign_customers` ADD  `id_team` INT NOT NULL DEFAULT '0' ; ";
$sqlUpdateDatabase['campaign_customers']['note'] = "ALTER TABLE `campaign_customers` ADD  `note` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL; ";
$sqlUpdateDatabase['campaign_customers']['time_checkin'] = "ALTER TABLE `campaign_customers` ADD  `time_checkin` INT NOT NULL DEFAULT '0'; ";
$sqlUpdateDatabase['campaign_customers']['id_ticket'] = "ALTER TABLE `campaign_customers` ADD  `id_ticket` INT NOT NULL DEFAULT '0'; ";
$sqlUpdateDatabase['campaign_customers']['create_at'] = "ALTER TABLE `campaign_customers` ADD  `create_at` INT NOT NULL DEFAULT '0'; ";

?>