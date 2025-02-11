<?php 

$sqlInstallDatabase .= "CREATE TABLE `collaborators` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `slug` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sqlInstallDatabase .= "CREATE TABLE `customers`(
  `id` INT AUTO_INCREMENT PRIMARY KEY,
     `full_name` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
     `birth_date` DATE NOT NULL,
     `birth_time` TIME NOT NULL,
     `timezone` VARCHAR(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'GMT+7',
     `gender` ENUM('Nam', 'Nữ') COLLATE utf8mb4_unicode_ci NOT NULL,
     `view_year` INT NOT NULL,
     `view_month` INT NOT NULL,
     `calendar_type` ENUM('Dương', 'Âm') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Dương',
     `email` VARCHAR(255) COLLATE utf8mb4_unicode_ci UNIQUE NOT NULL,
     `phone_number` VARCHAR(15) COLLATE utf8mb4_unicode_ci UNIQUE NOT NULL,
     `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
 

$sqlDeleteDatabase .= "DROP TABLE collaborators; ";
$sqlDeleteDatabase .= "DROP TABLE customers; ";

// $sqlUpdateDatabase['users']['full_name'] = "ALTER TABLE `users` ADD `full_name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";

