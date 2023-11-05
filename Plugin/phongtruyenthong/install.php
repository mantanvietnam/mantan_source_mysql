<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';

$sqlInstallDatabase .= "CREATE TABLE `classes` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `id_year` INT NOT NULL , `info` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL , `image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `images` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL , `status` VARCHAR(255) NOT NULL , `video` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL , `slug` VARCHAR(255) NOT NULL , `des_image` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL, `audio_image` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL, `user` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL, `pass` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL, `note_admin` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL, `image_label` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'https://phongtruyenthong.thptchuyenlaocai.edu.vn/plugins/phongtruyenthong/view/home/assets/img/class.jpg', PRIMARY KEY (`id`)) ENGINE = InnoDB;";

$sqlInstallDatabase .= "CREATE TABLE `donates` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `id_class` INT NULL , `id_year` INT NULL , `phone` VARCHAR(255) NULL , `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL , `avatar` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `job` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL , `donate` INT NOT NULL DEFAULT '0' , PRIMARY KEY (`id`)) ENGINE = InnoDB;";


$sqlDeleteDatabase .= "DROP TABLE classes; ";
$sqlDeleteDatabase .= "DROP TABLE donates; ";

$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='school_year'; ";