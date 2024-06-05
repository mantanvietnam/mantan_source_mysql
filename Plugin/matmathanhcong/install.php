<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];

$sqlInstallDatabase .= "CREATE TABLE `request_exports` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `avatar` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
    `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
    `birthday` VARCHAR(255) NOT NULL , 
    `phone` VARCHAR(15) NOT NULL , 
    `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL , 
    `address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL , 
    `affiliate_phone` VARCHAR(15) NULL , 
    `link_download` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL , 
    `status_pay` VARCHAR(255) NOT NULL DEFAULT 'wait', 
    `idMessenger` VARCHAR(255) NULL, `idZalo` VARCHAR(100) NULL, 
    PRIMARY KEY (`id`)
) ENGINE = InnoDB; ";

$sqlDeleteDatabase .= "DROP TABLE request_exports; ";

// Bang request_exports
$sqlUpdateDatabase['request_exports']['avatar'] = "ALTER TABLE `request_exports` ADD `avatar` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['request_exports']['name'] = "ALTER TABLE `request_exports` ADD `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['request_exports']['birthday'] = "ALTER TABLE `request_exports` ADD `birthday` VARCHAR(255) NOT NULL; ";
$sqlUpdateDatabase['request_exports']['phone'] = "ALTER TABLE `request_exports` ADD `phone` VARCHAR(15) NOT NULL; ";
$sqlUpdateDatabase['request_exports']['email'] = "ALTER TABLE `request_exports` ADD `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['request_exports']['address'] = "ALTER TABLE `request_exports` ADD `address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['request_exports']['affiliate_phone'] = "ALTER TABLE `request_exports` ADD `affiliate_phone` VARCHAR(15) NULL; ";
$sqlUpdateDatabase['request_exports']['link_download'] = "ALTER TABLE `request_exports` ADD `link_download` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['request_exports']['status_pay'] = "ALTER TABLE `request_exports` ADD `status_pay` VARCHAR(255) NOT NULL DEFAULT 'wait'; ";
$sqlUpdateDatabase['request_exports']['idMessenger'] = "ALTER TABLE `request_exports` ADD `idMessenger` VARCHAR(255) NULL, `idZalo` VARCHAR(100) NULL; ";
?>