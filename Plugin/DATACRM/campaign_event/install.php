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
$sqlUpdateDatabase['campaigns']['name'] = "ALTER TABLE `campaign_customers` ADD `name` VARCHAR(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['campaigns']['name_show'] = "ALTER TABLE `campaign_customers` ADD `name_show` VARCHAR(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL; ";
?>