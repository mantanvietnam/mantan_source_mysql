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
  `id_member` INT NULL DEFAULT NULL , 
  `id_staff` INT NULL DEFAULT NULL , 
  `created_at` INT NULL DEFAULT NULL ,
  `content` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
  `status` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
  `state` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `list_staff` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  NULL DEFAULT '[]',
   PRIMARY KEY (`id`))
ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `staff_projects` ( 
 `id` INT NOT NULL AUTO_INCREMENT ,
 `id_staff` INT NULL DEFAULT NULL ,
 `id_project` INT NULL DEFAULT NULL ,
 `status` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
 `created_at` INT NULL DEFAULT NULL ,
 PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `tasks` ( `id` INT NOT NULL AUTO_INCREMENT ,
`name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
`start_date` INT NULL DEFAULT NULL ,
`end_date` INT NULL DEFAULT NULL ,
`id_member` INT NULL DEFAULT NULL ,
`id_staff` INT NULL ,
`content` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`id_project` INT NULL DEFAULT NULL ,
`status` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`level` INT NULL DEFAULT NULL,
 PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlDeleteDatabase .= "DROP TABLE projects; ";

$sqlUpdateDatabase['projects']['name'] = "ALTER TABLE `projects` ADD `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ;";
$sqlUpdateDatabase['projects']['start_date'] = "ALTER TABLE `projects` ADD `start_date` INT NULL DEFAULT NULL ;";
$sqlUpdateDatabase['projects']['end_date'] = "ALTER TABLE `projects` ADD `end_date` INT NULL DEFAULT NULL ;";
$sqlUpdateDatabase['projects']['id_member'] = "ALTER TABLE `projects` ADD `id_member` INT NULL DEFAULT NULL ;";
$sqlUpdateDatabase['projects']['content'] = "ALTER TABLE `projects` ADD `content` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ;";
$sqlUpdateDatabase['projects']['created_at'] = "ALTER TABLE `projects` ADD `created_at` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['projects']['status'] = "ALTER TABLE `projects` ADD `status` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['projects']['state'] = "ALTER TABLE `projects` ADD `state` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['projects']['list_staff'] = "ALTER TABLE `projects` ADD `list_staff` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  NULL DEFAULT '[]' ;";

$sqlUpdateDatabase['staff_projects']['id_staff'] = "ALTER TABLE `staff_projects` ADD `id_staff` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['staff_projects']['id_project'] = "ALTER TABLE `staff_projects` ADD `id_project` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['staff_projects']['status'] = "ALTER TABLE `staff_projects` ADD `status` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['staff_projects']['created_at'] = "ALTER TABLE `staff_projects` ADD `created_at` INT NULL DEFAULT NULL;";

$sqlUpdateDatabase['tasks']['name'] = "ALTER TABLE `tasks` ADD `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";
$sqlUpdateDatabase['tasks']['start_date'] = "ALTER TABLE `tasks` ADD `start_date` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['tasks']['end_date'] = "ALTER TABLE `tasks` ADD `end_date` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['tasks']['id_member'] = "ALTER TABLE `tasks` ADD `id_member` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['tasks']['id_staff'] = "ALTER TABLE `tasks` ADD `id_staff` INT NULL;";
$sqlUpdateDatabase['tasks']['content'] = "ALTER TABLE `tasks` ADD `content` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['tasks']['id_project'] = "ALTER TABLE `tasks` ADD `id_project` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['tasks']['status'] = "ALTER TABLE `tasks` ADD `status` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['tasks']['level'] = "ALTER TABLE `tasks` ADD `level` INT NULL DEFAULT NULL;";
?>