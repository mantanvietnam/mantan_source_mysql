<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;
global $sqlFixDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];
$sqlFixDatabase = '';



$sqlInstallDatabase .= "CREATE TABLE `members` ( 
  `id` INT NOT NULL AUTO_INCREMENT , 
  `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
  `phone` VARCHAR(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
  `email` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL , 
  `address` VARCHAR(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL , 
  `pass` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
  `otp` VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL , 
  `status` VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active' , 
  `type` VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'staff' , 
  `avatar` VARCHAR(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
  `created_at` INT NOT NULL,
  `last_login` INT NULL,
  `coin` INT NOT NULL DEFAULT '0',
  `id_permission` INT NOT NULL DEFAULT '0',
  `id_position` INT NOT NULL DEFAULT '0',
  `permission` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '[]',
  PRIMARY KEY (`id`)) ENGINE = InnoDB;
";

$sqlInstallDatabase .="CREATE TABLE `permissions` ( 
`id` INT NOT NULL AUTO_INCREMENT,
`name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`created_at` INT NOT NULL ,
`permission` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '[]' ,
 PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `activity_historys` ( 
`id` INT NOT NULL AUTO_INCREMENT,
`note` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`time` INT NOT NULL DEFAULT 0,
`id_member` INT NULL DEFAULT 0,
`id_key` INT NOT NULL DEFAULT 0,
`type` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`keyword` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `books` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `quantity` int(10) DEFAULT NULL,
  `id_category` int(11) DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(10) DEFAULT NULL,
  `book_code` int(10) DEFAULT NULL,
  `published_date` int(10) DEFAULT NULL,
  `id_publisher` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sqlInstallDatabase .="CREATE TABLE `buildings` ( `id` INT NOT NULL AUTO_INCREMENT ,
`name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`phone` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`address` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`created_at` INT NULL DEFAULT NULL ,
`description` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `historybook` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_book` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `number` int(10) DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";


$sqlInstallDatabase .="CREATE TABLE `customers` (
  `id` int(11) NOT NULL  AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'active',
  `created_at` int(11) NOT NULL
PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `floors` ( 
`id` INT NOT NULL AUTO_INCREMENT , 
`name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
`id_building` INT NULL DEFAULT '0' , 
`created_at` INT NULL DEFAULT NULL , 
`description` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `rooms` ( 
`id` INT NOT NULL AUTO_INCREMENT , 
`name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
`id_building` INT NULL DEFAULT 0 , 
`id_floor` INT NULL DEFAULT 0 , 
`created_at` INT NULL DEFAULT NULL , 
`description` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `shelfs` ( 
`id` INT NOT NULL AUTO_INCREMENT , 
`name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
`id_building` INT NULL DEFAULT 0 , 
`id_floor` INT NULL DEFAULT 0 , 
 `id_room` INT NULL DEFAULT 0 , 
`created_at` INT NULL DEFAULT NULL , 
`description` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `warehouse` ( 
`id` INT NOT NULL AUTO_INCREMENT , 
`id_building` INT NOT NULL DEFAULT '0' , 
`id_floor` INT NOT NULL DEFAULT '0' , 
`id_room` INT NOT NULL DEFAULT '0' , 
`id_shelf` INT NOT NULL DEFAULT '0' , 
`id_book` INT NULL DEFAULT '0' , 
`quantity` INT NOT NULL DEFAULT '0' , 
`quantity_borrow` INT NULL DEFAULT '0' , 
`created_at` INT NOT NULL DEFAULT '0' , 
`updated_at` INT NULL DEFAULT NULL , 
`note` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
`status` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `orders` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `order_id` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `member_id` INT NOT NULL,
    `customer_id` INT NOT NULL,
    `shelf_id` INT NOT NULL,
    `status` INT NOT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME ON UPDATE CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `orderdetails` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `order_id` INT NOT NULL,
  `book_id` INT NOT NULL,
  `quantity` INT NOT NULL,
  `shelf_id` INT NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `warehouse_historys` ( 
`id` INT NOT NULL AUTO_INCREMENT , 
`id_book` INT NOT NULL DEFAULT 0 , 
`id_warehouse` INT NOT NULL DEFAULT 0 , 
`id_member` INT NOT NULL DEFAULT 0 , 
`quantity` INT NULL DEFAULT 0 , 
`type` VARCHAR(100) NULL DEFAULT NULL , 
`created_at` INT NOT NULL DEFAULT 0 , 
`note` VARCHAR(255) NULL DEFAULT NULL , 
`id_building` INT NULL DEFAULT 0 , 
PRIMARY KEY (`id`)
 ) ENGINE = InnoDB;";


$sqlDeleteDatabase .= "DROP TABLE members; ";
$sqlDeleteDatabase .= "DROP TABLE permissions; ";
$sqlDeleteDatabase .= "DROP TABLE books; ";
$sqlDeleteDatabase .= "DROP TABLE buildings; ";
$sqlDeleteDatabase .= "DROP TABLE customers; ";

$sqlDeleteDatabase .= "DROP TABLE floors; ";
$sqlDeleteDatabase .= "DROP TABLE rooms; ";
$sqlDeleteDatabase .= "DROP TABLE shelfs; ";

$sqlDeleteDatabase .= "DROP TABLE orders; ";
$sqlDeleteDatabase .= "DROP TABLE orderdetails; ";
$sqlDeleteDatabase .= "DROP TABLE warehouse; ";
$sqlDeleteDatabase .= "DROP TABLE warehouse_historys; ";




$sqlUpdateDatabase['members']['name'] = "ALTER TABLE `members` ADD `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";
$sqlUpdateDatabase['members']['phone'] = "ALTER TABLE `members` ADD `phone` VARCHAR(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";
$sqlUpdateDatabase['members']['email'] = "ALTER TABLE `members` ADD `email` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;";
$sqlUpdateDatabase['members']['address'] = "ALTER TABLE `members` ADD `address` VARCHAR(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;";
$sqlUpdateDatabase['members']['pass'] = "ALTER TABLE `members` ADD `pass` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";
$sqlUpdateDatabase['members']['otp'] = "ALTER TABLE `members` ADD `otp` VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;";
$sqlUpdateDatabase['members']['status'] = "ALTER TABLE `members` ADD `status` VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active';";
$sqlUpdateDatabase['members']['type'] = "ALTER TABLE `members` ADD `type` VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'staff';";
$sqlUpdateDatabase['members']['avatar'] = "ALTER TABLE `members` ADD `avatar` VARCHAR(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";
$sqlUpdateDatabase['members']['created_at'] = "ALTER TABLE `members` ADD `created_at` INT NOT NULL;";
$sqlUpdateDatabase['members']['last_login'] = "ALTER TABLE `members` ADD `last_login` INT NULL;";
$sqlUpdateDatabase['members']['coin'] = "ALTER TABLE `members` ADD `coin` INT NOT NULL DEFAULT '0';";
$sqlUpdateDatabase['members']['id_permission'] = "ALTER TABLE `members` ADD `id_permission` INT NOT NULL DEFAULT '0';";
$sqlUpdateDatabase['members']['id_position'] = "ALTER TABLE `members` ADD `id_position` INT NOT NULL DEFAULT '0';";
$sqlUpdateDatabase['members']['permission'] = "ALTER TABLE `members` ADD `permission` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '[]';";

$sqlUpdateDatabase['permissions']['name'] = "ALTER TABLE `permissions` ADD `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['permissions']['created_at'] = "ALTER TABLE `permissions` ADD `created_at` INT NOT NULL;";
$sqlUpdateDatabase['permissions']['id_member'] = "ALTER TABLE `permissions` ADD `id_member` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['permissions']['permission'] = "ALTER TABLE `permissions` ADD `permission` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '[]';";

$sqlUpdateDatabase['activity_historys']['note'] = "ALTER TABLE `activity_historys` ADD `note` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['activity_historys']['time'] = "ALTER TABLE `activity_historys` ADD `time` INT NOT NULL DEFAULT 0;";
$sqlUpdateDatabase['activity_historys']['id_member'] = "ALTER TABLE `activity_historys` ADD `id_member` INT NULL DEFAULT 0;";
$sqlUpdateDatabase['activity_historys']['id_key'] = "ALTER TABLE `activity_historys` ADD `id_key` INT NOT NULL DEFAULT 0;";
$sqlUpdateDatabase['activity_historys']['type'] = "ALTER TABLE `activity_historys` ADD `type` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['activity_historys']['keyword'] = "ALTER TABLE `activity_historys` ADD `keyword` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";


$sqlUpdateDatabase['books']['name'] = "ALTER TABLE `books` ADD `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['books']['author'] = "ALTER TABLE `books` ADD `author` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";
$sqlUpdateDatabase['books']['description'] = "ALTER TABLE `books` ADD `description` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;";
$sqlUpdateDatabase['books']['quantity'] = "ALTER TABLE `books` ADD `quantity` INT NOT NULL DEFAULT 0;";
$sqlUpdateDatabase['books']['price'] = "ALTER TABLE `books` ADD `price` INT NOT NULL DEFAULT 0;";
$sqlUpdateDatabase['books']['slug'] = "ALTER TABLE `books` ADD `slug` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['books']['published_date'] = "ALTER TABLE `books` ADD `published_date` INT NOT NULL DEFAULT 0;";
$sqlUpdateDatabase['books']['id_publisher'] = "ALTER TABLE `books` ADD `id_publisher` INT NOT NULL DEFAULT 0;";
$sqlUpdateDatabase['books']['id_category'] = "ALTER TABLE `books` ADD `id_category` INT NOT NULL DEFAULT 0;";
$sqlUpdateDatabase['books']['book_code'] = "ALTER TABLE `books` ADD `book_code` INT NOT NULL DEFAULT 0;";

$sqlUpdateDatabase['buildings']['name'] = "ALTER TABLE `buildings` ADD `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['buildings']['phone'] = "ALTER TABLE `buildings` ADD `phone` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['buildings']['address'] = "ALTER TABLE `buildings` ADD `address` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['buildings']['created_at'] = "ALTER TABLE `buildings` ADD `created_at` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['buildings']['description'] = "ALTER TABLE `buildings` ADD `description` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";


$sqlUpdateDatabase['historybook']['number'] = "ALTER TABLE `historybook` ADD `number` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['historybook']['id_book'] = "ALTER TABLE `historybook` ADD `id_book` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['historybook']['day'] = "ALTER TABLE `historybook` ADD `day` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['historybook']['type'] = "ALTER TABLE `historybook` ADD `type` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";

$sqlUpdateDatabase['floors']['name'] = "ALTER TABLE `floors` ADD `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ;";
$sqlUpdateDatabase['floors']['id_building'] = "ALTER TABLE `floors` ADD `id_building` INT NULL DEFAULT '0' ;";
$sqlUpdateDatabase['floors']['created_at'] = "ALTER TABLE `floors` ADD `created_at` INT NULL DEFAULT NULL ;";
$sqlUpdateDatabase['floors']['description'] = "ALTER TABLE `floors` ADD `description` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";


$sqlUpdateDatabase['rooms']['name'] = "ALTER TABLE `rooms` ADD `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ;";
$sqlUpdateDatabase['rooms']['id_building'] = "ALTER TABLE `rooms` ADD `id_building` INT NULL DEFAULT 0 ;";
$sqlUpdateDatabase['rooms']['id_floor'] = "ALTER TABLE `rooms` ADD `id_floor` INT NULL DEFAULT 0 ;";
$sqlUpdateDatabase['rooms']['created_at'] = "ALTER TABLE `rooms` ADD `created_at` INT NULL DEFAULT NULL ;";
$sqlUpdateDatabase['rooms']['description'] = "ALTER TABLE `rooms` ADD `description` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";


$sqlUpdateDatabase['shelfs']['name'] = "ALTER TABLE `shelfs` ADD `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ;";
$sqlUpdateDatabase['shelfs']['id_building'] = "ALTER TABLE `shelfs` ADD `id_building` INT NULL DEFAULT 0 ;";
$sqlUpdateDatabase['shelfs']['id_floor'] = "ALTER TABLE `shelfs` ADD `id_floor` INT NULL DEFAULT 0 ;";
$sqlUpdateDatabase['shelfs']['id_room'] = "ALTER TABLE `shelfs` ADD `id_room` INT NULL DEFAULT 0 ;";
$sqlUpdateDatabase['shelfs']['created_at'] = "ALTER TABLE `shelfs` ADD `created_at` INT NULL DEFAULT NULL ;";
$sqlUpdateDatabase['shelfs']['description'] = "ALTER TABLE `shelfs` ADD `description` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";

$sqlUpdateDatabase['warehouses']['id_building'] = "ALTER TABLE `warehouses` ADD `id_building` INT NOT NULL DEFAULT '0';";
$sqlUpdateDatabase['warehouses']['id_floor'] = "ALTER TABLE `warehouses` ADD `id_floor` INT NOT NULL DEFAULT '0';";
$sqlUpdateDatabase['warehouses']['id_room'] = "ALTER TABLE `warehouses` ADD `id_room` INT NOT NULL DEFAULT '0';";
$sqlUpdateDatabase['warehouses']['id_shelf'] = "ALTER TABLE `warehouses` ADD `id_shelf` INT NOT NULL DEFAULT '0;"; 
$sqlUpdateDatabase['warehouses']['id_book'] = "ALTER TABLE `warehouses` ADD `id_book` INT NULL DEFAULT '0';";
$sqlUpdateDatabase['warehouses']['quantity'] = "ALTER TABLE `warehouses` ADD `quantity` INT NOT NULL DEFAULT '0';";
$sqlUpdateDatabase['warehouses']['quantity_borrow'] = "ALTER TABLE `warehouses` ADD `quantity_borrow` INT NULL DEFAULT '0';";
$sqlUpdateDatabase['warehouses']['created_at'] = "ALTER TABLE `warehouses` ADD `created_at` INT NOT NULL DEFAULT '0';";
$sqlUpdateDatabase['warehouses']['updated_at'] = "ALTER TABLE `warehouses` ADD `updated_at` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['warehouses']['note'] = "ALTER TABLE `warehouses` ADD `note` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['warehouses']['status'] = "ALTER TABLE `warehouses` ADD `status` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";

$sqlUpdateDatabase['customers']['name'] = "ALTER TABLE `customers` CHANGE `name` `name` VARCHAR(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL;";
$sqlUpdateDatabase['customers']['address'] = "ALTER TABLE `customers` CHANGE `address` `address` VARCHAR(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL;";
$sqlUpdateDatabase['customers']['email'] = "ALTER TABLE `customers` CHANGE `email` `email` VARCHAR(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL;";

$sqlUpdateDatabase['orders']['shelf_id'] = "ALTER TABLE `orders` DROP COLUMN `shelf_id`;";
$sqlUpdateDatabase['orders']['order_id'] = "ALTER TABLE `orders` DROP COLUMN `order_id`;";
$sqlUpdateDatabase['orders']['building_id'] = "ALTER TABLE `orders` ADD COLUMN `building_id` INT NOT NULL AFTER `customer_id`;";

$sqlUpdateDatabase['warehouse_historys']['id_book'] = "ALTER TABLE `warehouse_historys` ADD `id_book` INT NOT NULL DEFAULT '0';";
$sqlUpdateDatabase['warehouse_historys']['id_warehouse'] = "ALTER TABLE `warehouse_historys` ADD `id_warehouse` INT NOT NULL DEFAULT '0';";
$sqlUpdateDatabase['warehouse_historys']['id_member'] = "ALTER TABLE `warehouse_historys` ADD `id_member` INT NOT NULL DEFAULT '0';";
$sqlUpdateDatabase['warehouse_historys']['quantity'] = "ALTER TABLE `warehouse_historys` ADD `quantity` INT NULL DEFAULT '0';";
$sqlUpdateDatabase['warehouse_historys']['type'] = "ALTER TABLE `warehouse_historys` ADD `type` VARCHAR(100) NULL DEFAULT NULL;";
$sqlUpdateDatabase['warehouse_historys']['created_at'] = "ALTER TABLE `warehouse_historys` ADD `created_at` INT NOT NULL DEFAULT '0';";
$sqlUpdateDatabase['warehouse_historys']['note'] = "ALTER TABLE `warehouse_historys` ADD `note` VARCHAR(255) NULL DEFAULT NULL;";
$sqlUpdateDatabase['warehouse_historys']['id_building'] = "ALTER TABLE `warehouse_historys` ADD `id_building` INT NULL DEFAULT '0';";
?>