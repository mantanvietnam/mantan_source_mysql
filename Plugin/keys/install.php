<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';

$sqlInstallDatabase .= "CREATE TABLE `appkeys` ( `id` INT NOT NULL AUTO_INCREMENT , `value` VARCHAR(255) NOT NULL , `id_category` INT NOT NULL , `status` VARCHAR(255) NOT NULL , `used` INT NOT NULL , `month` INT NOT NULL, `user` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `pass` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; ";


$sqlDeleteDatabase .= "DROP TABLE appkeys; ";
$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='application_key'; ";
?>