<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';

$sqlInstallDatabase .= "CREATE TABLE `product_projects` ( 
  `id` int(12) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id_kind` int(11) NOT NULL,
  `address` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(225) NOT NULL,
  `status` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `images` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `info` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
  `map` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acreage` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subdivision` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `premises` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `landscape` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
  PRIMARY KEY (`id`)
) ENGINE = InnoDB; ";

$sqlDeleteDatabase .= "DROP TABLE product_projects; ";

?>