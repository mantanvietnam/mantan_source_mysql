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
 
$sqlInstallDatabase .= "CREATE TABLE `horoscopes` (
  `id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `gender` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) NOT NULL,
  `overview` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `direction` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `five_elements` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mascot` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_by_age` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sqlDeleteDatabase .= "DROP TABLE collaborators; ";
$sqlDeleteDatabase .= "DROP TABLE customers; ";
$sqlDeleteDatabase .= "DROP TABLE horoscopes; ";

$sqlUpdateDatabase['collaborators']['id'] = "ALTER TABLE `collaborators` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id`);";
$sqlUpdateDatabase['horoscopes']['slug'] = "ALTER TABLE `horoscopes` ADD `slug` VARCHAR(255) NOT NULL AFTER `name_by_age`;";
$sqlUpdateDatabase['horoscopes']['price'] = "ALTER TABLE `horoscopes` ADD `price` INT NOT NULL AFTER `image`;";
