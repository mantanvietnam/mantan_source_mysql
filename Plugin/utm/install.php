<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];

$sqlInstallDatabase .="CREATE TABLE `utms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utm_source` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `utm_medium` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `utm_campaign` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `utm_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `utm_term` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `utm_content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `utm_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)) ENGINE=InnoDB;";

$sqlDeleteDatabase .= "DROP TABLE utms; ";

// Bang utms
$sqlUpdateDatabase['utms']['utm_source'] = "ALTER TABLE `utms` ADD `utm_source` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['utms']['utm_medium'] = "ALTER TABLE `utms` ADD `utm_medium` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['utms']['utm_campaign'] = "ALTER TABLE `utms` ADD `utm_campaign` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['utms']['utm_id'] = "ALTER TABLE `utms` ADD `utm_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['utms']['utm_term'] = "ALTER TABLE `utms` ADD `utm_term` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['utms']['utm_content'] = "ALTER TABLE `utms` ADD `utm_content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['utms']['utm_name'] = "ALTER TABLE `utms` ADD `utm_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['utms']['created_at'] = "ALTER TABLE `utms` ADD `created_at` timestamp NULL DEFAULT NULL; ";