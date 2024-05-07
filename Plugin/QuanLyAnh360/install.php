<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';


$sqlInstallDatabase .="CREATE TABLE `info_scenes` ( `id` INT NOT NULL AUTO_INCREMENT ,
  `code` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
  `title_vi` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL ,
  `title_en` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL ,
  `title_cn` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL , 
  `lat` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL , 
  `long` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL , 
  `audio_vi` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL , 
  `audio_en` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL , 
  `audio_cn` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL , 
  `hlookat` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL , 
  `vlookat` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL , 
  `fovtype` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL , 
  `image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL ,
  `fov`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL, 
  `maxpixelzoom`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL, 
  `fovmin`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL, 
  `fovmax`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL, 
  `status` TINYINT NOT NULL DEFAULT '0' , 
  `time` INT NULL DEFAULT NULL , 
  `info_vn` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL , 
  `info_en` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL , 
  `info_cn` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL , 
  PRIMARY KEY (`id`)) ENGINE = InnoDB;";

$sqlInstallDatabase .='CREATE TABLE `plug_points` ( `id` INT NOT NULL AUTO_INCREMENT , 
`code` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
`id_scene` INT NOT NULL , 
`icon` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL , 
`hlookat` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL ,
`vlookat` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL , 
`status` TINYINT NOT NULL DEFAULT '0',
`note` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL , 
PRIMARY KEY (`id`)) ENGINE = InnoDB;';

$sqlDeleteDatabase .= "DROP TABLE info_scenes; ";
$sqlDeleteDatabase .= "DROP TABLE plug_points; ";
