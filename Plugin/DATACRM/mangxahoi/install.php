<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;
global $sqlFixDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];
$sqlFixDatabase = '';

$sqlInstallDatabase .="CREATE TABLE `comments` ( 
  `id` INT NOT NULL AUTO_INCREMENT , 
  `id_customer` INT NULL DEFAULT NULL , 
  `id_object` INT NULL DEFAULT NULL , 
  `id_father` INT NULL DEFAULT NULL , 
  `keyword` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL , 
  `comment` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL , 
  `created_at` INT NULL DEFAULT NULL, 
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;"

$sqlInstallDatabase .="CREATE TABLE `likes` ( 
  `id` INT NOT NULL AUTO_INCREMENT , 
  `id_customer` INT NULL DEFAULT NULL , 
  `id_object` INT NULL DEFAULT NULL , 
  `keyword` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL , 
  `type` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL,
  `created_at` INT NULL DEFAULT NULL, 
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `social_networks` ( 
`id` INT NOT NULL AUTO_INCREMENT ,
`id_customer` INT NOT NULL ,
`connent` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`image` TEXT NULL DEFAULT '[]' ,
`created_at` INT NULL DEFAULT NULL ,
`public` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `make_friends` ( 
`id` INT NOT NULL AUTO_INCREMENT , 
`id_customer_request` INT NOT NULL , 
`id_customer_confirm` INT NOT NULL , 
`status` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
`created_at` INT NOT NULL , 
`updated_at` INT NOT NULL , 
PRIMARY KEY (`id`)
) ENGINE = InnoDB;";


$sqlDeleteDatabase .= "DROP TABLE comments; ";
$sqlDeleteDatabase .= "DROP TABLE likes; ";
$sqlDeleteDatabase .= "DROP TABLE social_networks; ";
$sqlDeleteDatabase .= "DROP TABLE make_friends; ";





$sqlUpdateDatabase['comments']['id_customer'] = "ALTER TABLE `comments` ADD `id_customer` INT NULL DEFAULT NULL ;";
$sqlUpdateDatabase['comments']['id_object'] = "ALTER TABLE `comments` ADD `id_object` INT NULL DEFAULT NULL ;";
$sqlUpdateDatabase['comments']['id_father'] = "ALTER TABLE `comments` ADD `id_father` INT NULL DEFAULT NULL ;";
$sqlUpdateDatabase['comments']['keyword'] = "ALTER TABLE `comments` ADD `keyword` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL ;";
$sqlUpdateDatabase['comments']['comment'] = "ALTER TABLE `comments` ADD `comment` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL ;";
$sqlUpdateDatabase['comments']['created_at'] = "ALTER TABLE `comments` ADD `created_at` INT NULL DEFAULT NULL;";

$sqlUpdateDatabase['likes']['id_customer'] = "ALTER TABLE `likes` ADD `id_customer` INT NULL DEFAULT NULL ;";
$sqlUpdateDatabase['likes']['id_object'] = "ALTER TABLE `likes` ADD `id_object` INT NULL DEFAULT NULL ;";
$sqlUpdateDatabase['likes']['keyword'] = "ALTER TABLE `likes` ADD `keyword` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL ;";
$sqlUpdateDatabase['likes']['type'] = "ALTER TABLE `likes` ADD `type` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['likes']['created_at'] = "ALTER TABLE `likes` ADD `created_at` INT NULL DEFAULT NULL;";

$sqlUpdateDatabase['social_networks']['id_customer'] = "ALTER TABLE `social_networks` ADD `id_customer` INT NOT NULL;";
$sqlUpdateDatabase['social_networks']['connent'] = "ALTER TABLE `social_networks` ADD `connent` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['social_networks']['image'] = "ALTER TABLE `social_networks` ADD `image` TEXT NULL DEFAULT '[]';";
$sqlUpdateDatabase['social_networks']['created_at'] = "ALTER TABLE `social_networks` ADD `created_at` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['social_networks']['public'] = "ALTER TABLE `social_networks` ADD `public` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;";

$sqlUpdateDatabase['make_friends']['id_customer_request'] = "ALTER TABLE `make_friends` ADD `id_customer_request` INT NOT NULL;";
$sqlUpdateDatabase['make_friends']['id_customer_confirm'] = "ALTER TABLE `make_friends` ADD `id_customer_confirm` INT NOT NULL;";
$sqlUpdateDatabase['make_friends']['status'] = "ALTER TABLE `make_friends` ADD `status` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['make_friends']['created_at'] = "ALTER TABLE `make_friends` ADD `created_at` INT NOT NULL;";
$sqlUpdateDatabase['make_friends']['updated_at'] = "ALTER TABLE `make_friends` ADD `updated_at` INT NOT NULL;";
?>