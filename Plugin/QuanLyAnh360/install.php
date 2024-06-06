<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];


$sqlInstallDatabase .="CREATE TABLE `info_scenes` ( 
  `id` INT NOT NULL AUTO_INCREMENT ,
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

$sqlInstallDatabase .='CREATE TABLE `plug_points` ( 
  `id` INT NOT NULL AUTO_INCREMENT , 
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

// Bang info_scenes
$sqlUpdateDatabase['info_scenes']['code'] = "ALTER TABLE `info_scenes` ADD `code` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['info_scenes']['title_vi'] = "ALTER TABLE `info_scenes` ADD `title_vi` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['info_scenes']['title_en'] = "ALTER TABLE `info_scenes` ADD `title_en` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['info_scenes']['title_cn'] = "ALTER TABLE `info_scenes` ADD `title_cn` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['info_scenes']['lat'] = "ALTER TABLE `info_scenes` ADD `lat` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['info_scenes']['long'] = "ALTER TABLE `info_scenes` ADD `long` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['info_scenes']['audio_vi'] = "ALTER TABLE `info_scenes` ADD `audio_vi` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['info_scenes']['audio_en'] = "ALTER TABLE `info_scenes` ADD `audio_en` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['info_scenes']['audio_cn'] = "ALTER TABLE `info_scenes` ADD `audio_cn` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['info_scenes']['hlookat'] = "ALTER TABLE `info_scenes` ADD `hlookat` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['info_scenes']['vlookat'] = "ALTER TABLE `info_scenes` ADD `vlookat` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['info_scenes']['fovtype'] = "ALTER TABLE `info_scenes` ADD `fovtype` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['info_scenes']['image'] = "ALTER TABLE `info_scenes` ADD `image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['info_scenes']['fov'] = "ALTER TABLE `info_scenes` ADD `fov`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['info_scenes']['maxpixelzoom'] = "ALTER TABLE `info_scenes` ADD `maxpixelzoom`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['info_scenes']['fovmin'] = "ALTER TABLE `info_scenes` ADD `fovmin`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['info_scenes']['fovmax'] = "ALTER TABLE `info_scenes` ADD `fovmax`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['info_scenes']['status'] = "ALTER TABLE `info_scenes` ADD `status` TINYINT NOT NULL DEFAULT '0'; ";
$sqlUpdateDatabase['info_scenes']['time'] = "ALTER TABLE `info_scenes` ADD `time` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['info_scenes']['info_vn'] = "ALTER TABLE `info_scenes` ADD `info_vn` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['info_scenes']['info_en'] = "ALTER TABLE `info_scenes` ADD `info_en` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['info_scenes']['info_cn'] = "ALTER TABLE `info_scenes` ADD `info_cn` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL; ";

// Bang plug_points
$sqlUpdateDatabase['plug_points']['code'] = "ALTER TABLE `plug_points` ADD `code` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['plug_points']['id_scene'] = "ALTER TABLE `plug_points` ADD `id_scene` INT NOT NULL; ";
$sqlUpdateDatabase['plug_points']['icon'] = "ALTER TABLE `plug_points` ADD `icon` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['plug_points']['hlookat'] = "ALTER TABLE `plug_points` ADD `hlookat` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['plug_points']['vlookat'] = "ALTER TABLE `plug_points` ADD `vlookat` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['plug_points']['status'] = "ALTER TABLE `plug_points` ADD `status` TINYINT NOT NULL DEFAULT '0'; ";
$sqlUpdateDatabase['plug_points']['note'] = "ALTER TABLE `plug_points` ADD `note` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL; ";
