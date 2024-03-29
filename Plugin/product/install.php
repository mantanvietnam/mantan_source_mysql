<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = '';

$sqlInstallDatabase .= "CREATE TABLE `products` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
    `id_category` INT NOT NULL , 
    `hot` BOOLEAN NOT NULL , 
    `description` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
    `keyword` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
    `info` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
    `image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
    `code` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , 
    `price` INT NOT NULL , 
    `price_old` INT NOT NULL , 
    `quantity` INT NOT NULL , 
    `id_manufacturer` INT NOT NULL , 
    `status` VARCHAR(255) NOT NULL , 
    `slug` VARCHAR(255) NOT NULL , 
    `view` INT NOT NULL DEFAULT '0' , 
    `images` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL , 
    `rule` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL, 
    `id_product` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
    `specification` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
    `idpro_discount`  VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
    `pricepro_discount` INT NULL DEFAULT NULL,
    `evaluate` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL, 
    `price_fash` INT NULL DEFAULT NULL, 
    PRIMARY KEY (`id`)) ENGINE = InnoDB; ";

$sqlInstallDatabase .= "CREATE TABLE `orders` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `id_user` INT NULL DEFAULT '0' , 
    `full_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
    `email` VARCHAR(255) NULL , 
    `phone` VARCHAR(255) NOT NULL , 
    `address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
    `note_user` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL , 
    `note_admin` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL , 
    `status` VARCHAR(255) NOT NULL , 
    `create_at` INT NOT NULL , 
    `money` INT NOT NULL ,
    `total` INT NULL ,
    `payment` INT NULL ,
    `discount` VARCHAR(255) NULL , 
    `id_discount` INT NULL DEFAULT NULL, 
    `id_agency` INT NOT NULL DEFAULT '0', 
    `id_aff` INT NULL DEFAULT '0',
    `promotion` INT NOT NULL DEFAULT '0' COMMENT 'Phần trăm giảm giá',
    PRIMARY KEY (`id`)) ENGINE = InnoDB; ";

$sqlInstallDatabase .= "CREATE TABLE `order_details` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `id_product` INT NOT NULL , 
    `id_order` INT NOT NULL , 
    `quantity` INT NOT NULL , 
    PRIMARY KEY (`id`)) ENGINE = InnoDB; ";

$sqlInstallDatabase .="CREATE TABLE `discount_codes` ( 
    `id`  INT NOT NULL AUTO_INCREMENT , 
    `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
    `code` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
    `discount` FLOAT(11) NULL DEFAULT '0' , 
    `note` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
    `created_at` TIMESTAMP NULL DEFAULT NULL , 
    `deadline_at` TIMESTAMP NULL DEFAULT NULL , 
    `number_user` INT NULL DEFAULT NULL , 
    `applicable_price` INT NULL DEFAULT NULL , 
    `status` INT NULL DEFAULT NULL ,
    `maximum_price_reduction` INT NULL DEFAULT NULL,
    `category` INT(11) NULL DEFAULT NULL,
    `id_customers` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL, 
    `id_products` TEXT NULL,
    PRIMARY KEY (`id`)) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `question_products` (`id` int(11) NOT NULL AUTO_INCREMENT,`question` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,`answer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,`id_product` int(11) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `evaluates` ( `id` INT NOT NULL AUTO_INCREMENT , `full_name` VARCHAR(155) NULL DEFAULT NULL , `avatar` VARCHAR(255) NULL DEFAULT NULL , `id_product` INT NOT NULL , `content` TEXT NULL DEFAULT NULL , `image` TEXT NULL DEFAULT NULL , `point` FLOAT NULL DEFAULT NULL,`image_video`  varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL, `video`  varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `views` ( `id` INT NOT NULL AUTO_INCREMENT , `id_customer` INT NOT NULL , `id_product` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `reviews` ( `id` INT NOT NULL AUTO_INCREMENT , `id_user` INT NOT NULL , `id_product` INT  NULL DEFAULT NULL ,`status`  varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL , `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `categorie_products` ( `id` INT NOT NULL AUTO_INCREMENT , `id_category` INT NOT NULL , `id_product` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `address` ( `id` INT NOT NULL AUTO_INCREMENT , `address_name` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `id_customer` INT NOT NULL DEFAULT '0' , `address_type` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; ";


$sqlDeleteDatabase .= "DROP TABLE products; ";
$sqlDeleteDatabase .= "DROP TABLE orders; ";
$sqlDeleteDatabase .= "DROP TABLE order_details; ";
$sqlDeleteDatabase .= "DROP TABLE question_products; ";
$sqlDeleteDatabase .= "DROP TABLE evaluates; ";
$sqlDeleteDatabase .= "DROP TABLE views; ";
$sqlDeleteDatabase .= "DROP TABLE reviews; ";
$sqlDeleteDatabase .= "DROP TABLE categorie_products; ";
$sqlDeleteDatabase .= "DROP TABLE address; ";

$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='category_product'; ";
$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='manufacturer_product'; ";

// 2.0
$sqlUpdateDatabase .= "ALTER TABLE `orders` ADD `promotion` INT NOT NULL DEFAULT '0' COMMENT 'Phần trăm giảm giá' AFTER `id_aff`; ";
?>