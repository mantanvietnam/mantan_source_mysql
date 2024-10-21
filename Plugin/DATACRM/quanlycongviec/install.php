<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;
global $sqlFixDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];
$sqlFixDatabase = '';

$sqlInstallDatabase .="CREATE TABLE `projects` (
 `id` INT NOT NULL AUTO_INCREMENT , 
  `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
  `start_date` INT NULL DEFAULT NULL , 
  `end_date` INT NULL DEFAULT NULL , 
  `id_messenger` INT NULL DEFAULT NULL , 
  `id_staff` INT NULL DEFAULT NULL , 
  `conntent` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
  `status` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
   PRIMARY KEY (`id`))
ENGINE = InnoDB;";

$sqlDeleteDatabase .= "DROP TABLE projects; ";

$sqlUpdateDatabase['projects']['name'] = "ALTER TABLE `projects` ADD `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ;";
$sqlUpdateDatabase['projects']['start_date'] = "ALTER TABLE `projects` ADD `start_date` INT NULL DEFAULT NULL ;";
$sqlUpdateDatabase['projects']['end_date'] = "ALTER TABLE `projects` ADD `end_date` INT NULL DEFAULT NULL ;";
$sqlUpdateDatabase['projects']['id_messenger'] = "ALTER TABLE `projects` ADD `id_messenger` INT NULL DEFAULT NULL ;";
$sqlUpdateDatabase['projects']['conntent'] = "ALTER TABLE `projects` ADD `conntent` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ;";
$sqlUpdateDatabase['projects']['status'] = "ALTER TABLE `projects` ADD `status` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";


?>