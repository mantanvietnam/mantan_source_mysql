<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';

$sqlInstallDatabase .= "CREATE TABLE `feedbacks` ( `id` INT NOT NULL AUTO_INCREMENT , `id_product` INT NOT NULL , `id_customer` INT NOT NULL , `note` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `time_create` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; ";

$sqlInstallDatabase .= "CREATE TABLE `feedbackinfos` ( `id` INT NOT NULL AUTO_INCREMENT , `id_criteria` INT NOT NULL , `point` INT NOT NULL , `id_feedback` INT NOT NULL , `id_customer` INT NOT NULL , `id_product` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; ";


$sqlDeleteDatabase .= "DROP TABLE feedbacks; ";
$sqlDeleteDatabase .= "DROP TABLE feedbackinfos; ";
$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='criteria_feedback'; ";
?>