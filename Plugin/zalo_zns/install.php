<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';

$sqlInstallDatabase .= "CREATE TABLE `zalo_oas` (`id` INT NOT NULL AUTO_INCREMENT , `id_oa` VARCHAR(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL , `id_app` VARCHAR(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL , `secret_key` VARCHAR(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL , `oauth_code` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL, `access_token` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL, `refresh_token` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL, `deadline` INT NULL, PRIMARY KEY (`id`)) ENGINE = InnoDB; ";


$sqlDeleteDatabase .= "DROP TABLE zalo_oas; ";

//$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='application_key'; ";
?>