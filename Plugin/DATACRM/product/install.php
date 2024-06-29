<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];

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
    `unit` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
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
    `status_pay` VARCHAR(100) NOT NULL DEFAULT 'wait' COMMENT 'trạng thái thanh toán' , 
    PRIMARY KEY (`id`)) ENGINE = InnoDB; ";

$sqlInstallDatabase .= "CREATE TABLE `order_details` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `id_product` INT NOT NULL , 
    `id_order` INT NOT NULL , 
    `quantity` INT NOT NULL , 
    `price` INT NOT NULL DEFAULT '0',
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

$sqlInstallDatabase .="CREATE TABLE `question_products` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `question` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `answer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `id_product` int(11) NOT NULL, 
    PRIMARY KEY (`id`) ) ENGINE=InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `evaluates` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `full_name` VARCHAR(155) NULL DEFAULT NULL , 
    `avatar` VARCHAR(255) NULL DEFAULT NULL , 
    `id_product` INT NOT NULL , 
    `content` TEXT NULL DEFAULT NULL , 
    `image` TEXT NULL DEFAULT NULL , 
    `point` FLOAT NULL DEFAULT NULL,
    `image_video`  varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL, 
    `video`  varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL , 
    PRIMARY KEY (`id`)) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `views` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `id_customer` INT NOT NULL , 
    `id_product` INT NOT NULL , 
    PRIMARY KEY (`id`)) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `reviews` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `id_user` INT NOT NULL , 
    `id_product` INT  NULL DEFAULT NULL ,
    `status`  varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL , 
    `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL , 
    PRIMARY KEY (`id`)) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `categorie_products` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `id_category` INT NOT NULL , 
    `id_product` INT NOT NULL , 
    PRIMARY KEY (`id`)) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `address` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `address_name` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
    `id_customer` INT NOT NULL DEFAULT '0' , 
    `address_type` INT NOT NULL , 
    PRIMARY KEY (`id`)) ENGINE = InnoDB; ";


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

// Bang products
$sqlUpdateDatabase['products']['title'] = "ALTER TABLE `products` ADD `title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL ; ";
$sqlUpdateDatabase['products']['id_category'] = "ALTER TABLE `products` ADD `id_category` INT NOT NULL ; ";
$sqlUpdateDatabase['products']['hot'] = "ALTER TABLE `products` ADD `hot` BOOLEAN NOT NULL; ";
$sqlUpdateDatabase['products']['description'] = "ALTER TABLE `products` ADD `description` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL ; ";
$sqlUpdateDatabase['products']['keyword'] = "ALTER TABLE `products` ADD `keyword` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL ; ";
$sqlUpdateDatabase['products']['info'] = "ALTER TABLE `products` ADD `info` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['products']['image'] = "ALTER TABLE `products` ADD `image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['products']['code'] = "ALTER TABLE `products` ADD `code` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['products']['price'] = "ALTER TABLE `products` ADD `price` INT NOT NULL; ";
$sqlUpdateDatabase['products']['price_old'] = "ALTER TABLE `products` ADD `price_old` INT NOT NULL; ";
$sqlUpdateDatabase['products']['quantity'] = "ALTER TABLE `products` ADD `quantity` INT NOT NULL ; ";
$sqlUpdateDatabase['products']['id_manufacturer'] = "ALTER TABLE `products` ADD `id_manufacturer` INT NOT NULL ; ";
$sqlUpdateDatabase['products']['status'] = "ALTER TABLE `products` ADD `status` VARCHAR(255) NOT NULL ; ";
$sqlUpdateDatabase['products']['slug'] = "ALTER TABLE `products` ADD `slug` VARCHAR(255) NOT NULL ; ";
$sqlUpdateDatabase['products']['view'] = "ALTER TABLE `products` ADD `view` INT NOT NULL DEFAULT '0' ; ";
$sqlUpdateDatabase['products']['images'] = "ALTER TABLE `products` ADD `images` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL ; ";
$sqlUpdateDatabase['products']['rule'] = "ALTER TABLE `products` ADD `rule` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['products']['id_product'] = "ALTER TABLE `products` ADD `id_product` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ; ";
$sqlUpdateDatabase['products']['specification'] = "ALTER TABLE `products` ADD `specification` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ; ";
$sqlUpdateDatabase['products']['idpro_discount'] = "ALTER TABLE `products` ADD `idpro_discount`  VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['products']['pricepro_discount'] = "ALTER TABLE `products` ADD `pricepro_discount` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['products']['evaluate'] = "ALTER TABLE `products` ADD `evaluate` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['products']['price_fash'] = "ALTER TABLE `products` ADD `price_fash` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['products']['unit'] = "ALTER TABLE `products` ADD `unit` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL

// Bang orders
$sqlUpdateDatabase['orders']['id_user'] = "ALTER TABLE `orders` ADD `id_user` INT NULL DEFAULT '0' ; ";
$sqlUpdateDatabase['orders']['full_name'] = "ALTER TABLE `orders` ADD `full_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['orders']['email'] = "ALTER TABLE `orders` ADD `email` VARCHAR(255) NULL ; ";
$sqlUpdateDatabase['orders']['phone'] = "ALTER TABLE `orders` ADD `phone` VARCHAR(255) NOT NULL; ";
$sqlUpdateDatabase['orders']['address'] = "ALTER TABLE `orders` ADD `address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['orders']['note_user'] = "ALTER TABLE `orders` ADD `note_user` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['orders']['note_admin'] = "ALTER TABLE `orders` ADD `note_admin` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL ; ";
$sqlUpdateDatabase['orders']['status'] = "ALTER TABLE `orders` ADD `status` VARCHAR(255) NOT NULL; ";
$sqlUpdateDatabase['orders']['create_at'] = "ALTER TABLE `orders` ADD `create_at` INT NOT NULL; ";
$sqlUpdateDatabase['orders']['money'] = "ALTER TABLE `orders` ADD `money` INT NOT NULL; ";
$sqlUpdateDatabase['orders']['total'] = "ALTER TABLE `orders` ADD `total` INT NULL ; ";
$sqlUpdateDatabase['orders']['payment'] = "ALTER TABLE `orders` ADD `payment` INT NULL; ";
$sqlUpdateDatabase['orders']['discount'] = "ALTER TABLE `orders` ADD `discount` VARCHAR(255) NULL; ";
$sqlUpdateDatabase['orders']['id_discount'] = "ALTER TABLE `orders` ADD `id_discount` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['orders']['id_agency'] = "ALTER TABLE `orders` ADD `id_agency` INT NOT NULL DEFAULT '0'; ";
$sqlUpdateDatabase['orders']['id_aff'] = "ALTER TABLE `orders` ADD `id_aff` INT NULL DEFAULT '0'; ";
$sqlUpdateDatabase['orders']['status_pay'] = "ALTER TABLE `orders` ADD `status_pay` VARCHAR(100) NOT NULL DEFAULT 'wait' COMMENT 'trạng thái thanh toán';";
$sqlUpdateDatabase['orders']['promotion'] = "ALTER TABLE `orders` ADD `promotion` INT NOT NULL DEFAULT '0' COMMENT 'Phần trăm giảm giá'; ";

// Bang order_details
$sqlUpdateDatabase['order_details']['id_product'] = "ALTER TABLE `order_details` ADD `id_product` INT NOT NULL ; ";
$sqlUpdateDatabase['order_details']['id_order'] = "ALTER TABLE `order_details` ADD `id_order` INT NOT NULL ; ";
$sqlUpdateDatabase['order_details']['quantity'] = "ALTER TABLE `order_details` ADD `quantity` INT NOT NULL; ";
$sqlUpdateDatabase['order_details']['price'] = "ALTER TABLE `order_details` ADD `price` INT NOT NULL DEFAULT '0'; ";

// Bang discount_codes
$sqlUpdateDatabase['discount_codes']['name'] = "ALTER TABLE `discount_codes` ADD `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['discount_codes']['code'] = "ALTER TABLE `discount_codes` ADD `code` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ; ";
$sqlUpdateDatabase['discount_codes']['discount'] = "ALTER TABLE `discount_codes` ADD `discount` FLOAT(11) NULL DEFAULT '0'; ";
$sqlUpdateDatabase['discount_codes']['note'] = "ALTER TABLE `discount_codes` ADD `note` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['discount_codes']['created_at'] = "ALTER TABLE `discount_codes` ADD `created_at` TIMESTAMP NULL DEFAULT NULL; ";
$sqlUpdateDatabase['discount_codes']['deadline_at'] = "ALTER TABLE `discount_codes` ADD `deadline_at` TIMESTAMP NULL DEFAULT NULL; ";
$sqlUpdateDatabase['discount_codes']['number_user'] = "ALTER TABLE `discount_codes` ADD `number_user` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['discount_codes']['applicable_price'] = "ALTER TABLE `discount_codes` ADD `applicable_price` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['discount_codes']['status'] = "ALTER TABLE `discount_codes` ADD `status` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['discount_codes']['maximum_price_reduction'] = "ALTER TABLE `discount_codes` ADD `maximum_price_reduction` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['discount_codes']['category'] = "ALTER TABLE `discount_codes` ADD `category` INT(11) NULL DEFAULT NULL; ";
$sqlUpdateDatabase['discount_codes']['id_customers'] = "ALTER TABLE `discount_codes` ADD `id_customers` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['discount_codes']['id_products'] = "ALTER TABLE `discount_codes` ADD `id_products` TEXT NULL; ";

// Bang question_products
$sqlUpdateDatabase['question_products']['question'] = "ALTER TABLE `question_products` ADD `question` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['question_products']['answer'] = "ALTER TABLE `question_products` ADD `answer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['question_products']['id_product'] = "ALTER TABLE `question_products` ADD `id_product` int(11) NOT NULL; ";

// Bang evaluates
$sqlUpdateDatabase['evaluates']['full_name'] = "ALTER TABLE `evaluates` ADD `full_name` VARCHAR(155) NULL DEFAULT NULL; ";
$sqlUpdateDatabase['evaluates']['avatar'] = "ALTER TABLE `evaluates` ADD `avatar` VARCHAR(255) NULL DEFAULT NULL; ";
$sqlUpdateDatabase['evaluates']['id_product'] = "ALTER TABLE `evaluates` ADD `id_product` INT NOT NULL; ";
$sqlUpdateDatabase['evaluates']['content'] = "ALTER TABLE `evaluates` ADD `content` TEXT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['evaluates']['image'] = "ALTER TABLE `evaluates` ADD `image` TEXT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['evaluates']['point'] = "ALTER TABLE `evaluates` ADD `point` FLOAT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['evaluates']['image_video'] = "ALTER TABLE `evaluates` ADD `image_video`  varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";
$sqlUpdateDatabase['evaluates']['video'] = "ALTER TABLE `evaluates` ADD `video`  varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL; ";

// Bang views
$sqlUpdateDatabase['views']['id_customer'] = "ALTER TABLE `views` ADD `id_customer` INT NOT NULL; ";
$sqlUpdateDatabase['views']['id_product'] = "ALTER TABLE `views` ADD `id_product` INT NOT NULL; ";

// Bang reviews
$sqlUpdateDatabase['reviews']['id_customer'] = "ALTER TABLE `reviews` ADD `id_customer` INT NOT NULL; ";
$sqlUpdateDatabase['reviews']['id_product'] = "ALTER TABLE `reviews` ADD `id_product` INT NOT NULL; ";

// Bang categorie_products
$sqlUpdateDatabase['categorie_products']['id_category'] = "ALTER TABLE `categorie_products` ADD `id_category` INT NOT NULL; ";
$sqlUpdateDatabase['categorie_products']['id_product'] = "ALTER TABLE `categorie_products` ADD `id_product` INT NOT NULL; ";

// Bang address
$sqlUpdateDatabase['address']['address_name'] = "ALTER TABLE `address` ADD `address_name` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['address']['id_customer'] = "ALTER TABLE `address` ADD `id_customer` INT NOT NULL DEFAULT '0'; ";
$sqlUpdateDatabase['address']['address_type'] = "ALTER TABLE `address` ADD `address_type` INT NOT NULL; ";
?>