<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];

$sqlInstallDatabase .= "CREATE TABLE `zalo_oas` (
	`id` INT NOT NULL AUTO_INCREMENT , 
	`id_oa` VARCHAR(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL , 
	`id_app` VARCHAR(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL , 
	`secret_key` VARCHAR(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL , 
	`oauth_code` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL, 
	`access_token` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL, 
	`refresh_token` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL, 
	`deadline` INT NULL, 
	PRIMARY KEY (`id`)
) ENGINE = InnoDB; ";

$sqlInstallDatabase .= "INSERT INTO `options` (`id`, `key_word`, `value`, `version`) VALUES (NULL, 'money_zalo_zns', '0', NULL);";


$sqlDeleteDatabase .= "DROP TABLE zalo_oas; ";

$sqlDeleteDatabase .= "DELETE FROM `options` WHERE `key_word`='money_zalo_zns'; ";

// Bang zalo_oas
$sqlUpdateDatabase['zalo_oas']['id_oa'] = "ALTER TABLE `zalo_oas` ADD `id_oa` VARCHAR(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['zalo_oas']['id_app'] = "ALTER TABLE `zalo_oas` ADD `id_app` VARCHAR(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['zalo_oas']['secret_key'] = "ALTER TABLE `zalo_oas` ADD `secret_key` VARCHAR(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['zalo_oas']['oauth_code'] = "ALTER TABLE `zalo_oas` ADD `oauth_code` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL; ";
$sqlUpdateDatabase['zalo_oas']['access_token'] = "ALTER TABLE `zalo_oas` ADD `access_token` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['zalo_oas']['refresh_token'] = "ALTER TABLE `zalo_oas` ADD `refresh_token` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['zalo_oas']['deadline'] = "ALTER TABLE `zalo_oas` ADD `deadline` INT NULL; ";
?>