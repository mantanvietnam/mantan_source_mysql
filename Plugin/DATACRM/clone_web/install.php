<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];

$sqlInstallDatabase .= "CREATE TABLE `member_webs` (`id` INT NOT NULL AUTO_INCREMENT , 
                            `domain` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
                            `id_member` INT NOT NULL DEFAULT '0' , 
                            `theme` VARCHAR(100) NOT NULL , 
                            `view` INT NOT NULL DEFAULT '0' , 
                            `status` VARCHAR(100) NOT NULL DEFAULT 'active',
                            `type` VARCHAR(100) NOT NULL DEFAULT 'member' COMMENT 'member hoặc affiliate',
                            PRIMARY KEY (`id`)
                        ) ENGINE = InnoDB; ";


$sqlDeleteDatabase .= "DROP TABLE member_webs; ";

//$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='2top_crm_training'; ";

// Bang member_webs
$sqlUpdateDatabase['member_webs']['domain'] = "ALTER TABLE `member_webs` ADD `domain` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ; ";
$sqlUpdateDatabase['member_webs']['id_member'] = "ALTER TABLE `member_webs` ADD `id_member` INT NOT NULL DEFAULT '0' ; ";
$sqlUpdateDatabase['member_webs']['theme'] = "ALTER TABLE `member_webs` ADD `theme` VARCHAR(100) NOT NULL ; ";
$sqlUpdateDatabase['member_webs']['view'] = "ALTER TABLE `member_webs` ADD `view` INT NOT NULL DEFAULT '0' ; ";
$sqlUpdateDatabase['member_webs']['status'] = "ALTER TABLE `member_webs` ADD `status` VARCHAR(100) NOT NULL DEFAULT 'active'; ";
$sqlUpdateDatabase['member_webs']['type'] = "ALTER TABLE `member_webs` ADD `type` VARCHAR(100) NOT NULL DEFAULT 'member' COMMENT 'member hoặc affiliate'; ";
?>