<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';

$sqlInstallDatabase .= "CREATE TABLE `locations` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `link360` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `slug` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; ";

$sqlDeleteDatabase .= "DROP TABLE locations; ";

$sqlDeleteDatabase .= "DELETE FROM `options` WHERE `key_word`='generalDescriptionAI'; ";
?>