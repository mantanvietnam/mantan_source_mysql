<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = '';

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

$sqlUpdateDatabase .= "ALTER TABLE `member_webs` ADD `type` VARCHAR(100) NOT NULL DEFAULT 'member' COMMENT 'member hoặc affiliate' AFTER `status`; ";
?>