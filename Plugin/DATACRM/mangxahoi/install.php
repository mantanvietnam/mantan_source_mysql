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
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `likes` ( 
  `id` INT NOT NULL AUTO_INCREMENT , 
  `id_customer` INT NULL DEFAULT NULL , 
  `id_object` INT NULL DEFAULT NULL , 
  `keyword` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL , 
  `type` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL,
  `created_at` INT NULL DEFAULT NULL, 
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `wall_posts` ( 
`id` INT NOT NULL AUTO_INCREMENT ,
`id_customer` INT NOT NULL ,
`connent` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`created_at` INT NULL DEFAULT NULL ,
`updated_at` INT NULL DEFAULT NULL,
`public` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL ,
`pin` INT NOT NULL DEFAULT 0,
`link_share` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
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

$sqlInstallDatabase .="CREATE TABLE `image_customers` ( 
`id` INT NOT NULL AUTO_INCREMENT , 
`id_customer` INT NULL DEFAULT NULL , 
`id_post` INT NULL DEFAULT NULL , 
`image` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
`public` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
`link_local` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`type` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT 'image',
`video` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`code_youtube` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`created_at` INT NULL DEFAULT NULL , 
PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `report_wall_posts` ( `id` INT NOT NULL AUTO_INCREMENT ,
  `id_customer` INT NOT NULL , 
  `created_at` INT NOT NULL , 
  `id_post` INT NOT NULL , 
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `keywords` ( 
`id` INT NOT NULL AUTO_INCREMENT , 
`keyword` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
`replacement` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL , 
PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `notifications` (
 `id` INT NOT NULL AUTO_INCREMENT ,
 `id_user` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
 `title` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
 `created_at` INT NULL DEFAULT NULL ,
 `action` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
 `content` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
 `id_object` INT NULL DEFAULT NULL,
 `type` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT 'customer',
 PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `verify_accounts` ( 
`id` INT NOT NULL AUTO_INCREMENT,
`id_customer` INT NOT NULL,
`image_face` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`image_card_before` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`image_card_after` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`link_news` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`created_at` INT NULL DEFAULT NULL,
`updated_at` INT NULL DEFAULT NULL,
`image_license_before` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`image_license_after` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`status` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlDeleteDatabase .= "DROP TABLE comments; ";
$sqlDeleteDatabase .= "DROP TABLE likes; ";
$sqlDeleteDatabase .= "DROP TABLE social_networks; ";
$sqlDeleteDatabase .= "DROP TABLE make_friends; ";
$sqlDeleteDatabase .= "DROP TABLE report_wall_posts; ";
$sqlDeleteDatabase .= "DROP TABLE notifications; ";
$sqlDeleteDatabase .= "DROP TABLE keywords; ";





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

$sqlUpdateDatabase['wall_posts']['id_customer'] = "ALTER TABLE `wall_posts` ADD `id_customer` INT NOT NULL;";
$sqlUpdateDatabase['wall_posts']['connent'] = "ALTER TABLE `wall_posts` ADD `connent` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['wall_posts']['created_at'] = "ALTER TABLE `wall_posts` ADD `created_at` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['wall_posts']['updated_at'] = "ALTER TABLE `wall_posts` ADD `updated_at` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['wall_posts']['public'] = "ALTER TABLE `wall_posts` ADD `public` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['wall_posts']['pin'] = "ALTER TABLE `wall_posts` ADD `pin` INT NOT NULL DEFAULT '0';";
$sqlUpdateDatabase['wall_posts']['link_share'] = "ALTER TABLE `wall_posts` ADD `link_share` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";

$sqlUpdateDatabase['make_friends']['id_customer_request'] = "ALTER TABLE `make_friends` ADD `id_customer_request` INT NOT NULL;";
$sqlUpdateDatabase['make_friends']['id_customer_confirm'] = "ALTER TABLE `make_friends` ADD `id_customer_confirm` INT NOT NULL;";
$sqlUpdateDatabase['make_friends']['status'] = "ALTER TABLE `make_friends` ADD `status` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['make_friends']['created_at'] = "ALTER TABLE `make_friends` ADD `created_at` INT NOT NULL;";
$sqlUpdateDatabase['make_friends']['updated_at'] = "ALTER TABLE `make_friends` ADD `updated_at` INT NOT NULL;";


$sqlUpdateDatabase['image_customers']['id_customer'] = "ALTER TABLE `image_customers` ADD `id_customer` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['image_customers']['id_post'] = "ALTER TABLE `image_customers` ADD `id_post` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['image_customers']['image'] = "ALTER TABLE `image_customers` ADD `image` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['image_customers']['public'] = "ALTER TABLE `image_customers` ADD `public` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['image_customers']['created_at'] = "ALTER TABLE `image_customers` ADD `created_at` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['image_customers']['link_local'] = "ALTER TABLE `image_customers` ADD `link_local` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['image_customers']['type'] = "ALTER TABLE `image_customers` ADD `type` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT 'image';";
$sqlUpdateDatabase['image_customers']['video'] = "ALTER TABLE `image_customers` ADD `video` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['image_customers']['code_youtube'] = "ALTER TABLE `image_customers` ADD `code_youtube` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";

$sqlUpdateDatabase['report_wall_posts']['id_customer'] = "ALTER TABLE `report_wall_posts` ADD `id_customer` INT NOT NULL;";
$sqlUpdateDatabase['report_wall_posts']['created_at'] = "ALTER TABLE `report_wall_posts` ADD `created_at` INT NOT NULL;";
$sqlUpdateDatabase['report_wall_posts']['id_post'] = "ALTER TABLE `report_wall_posts` ADD `id_post` INT NOT NULL;";

$sqlUpdateDatabase['keywords']['keyword'] = "ALTER TABLE `keywords` ADD `keyword` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ;";
$sqlUpdateDatabase['keywords']['replacement'] = "ALTER TABLE `keywords` ADD `replacement` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ;";

$sqlUpdateDatabase['notifications']['id_user'] = "ALTER TABLE `notifications` ADD `id_user` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['notifications']['title'] = "ALTER TABLE `notifications` ADD `title` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['notifications']['created_at'] = "ALTER TABLE `notifications` ADD `created_at` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['notifications']['action'] = "ALTER TABLE `notifications` ADD `action` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['notifications']['content'] = "ALTER TABLE `notifications` ADD `content` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['notifications']['id_object'] = "ALTER TABLE `notifications` ADD `id_object` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['notifications']['type'] = "ALTER TABLE `notifications` ADD `type` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT 'customer';";

$sqlUpdateDatabase['verify_accounts']['id_customer'] = "ALTER TABLE `verify_accounts` ADD `id_customer` INT NOT NULL;";
$sqlUpdateDatabase['verify_accounts']['image_face'] = "ALTER TABLE `verify_accounts` ADD `image_face` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['verify_accounts']['image_card_before'] = "ALTER TABLE `verify_accounts` ADD `image_card_before` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['verify_accounts']['image_card_after'] = "ALTER TABLE `verify_accounts` ADD `image_card_after` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['verify_accounts']['link_news'] = "ALTER TABLE `verify_accounts` ADD `link_news` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['verify_accounts']['created_at'] = "ALTER TABLE `verify_accounts` ADD `created_at` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['verify_accounts']['updated_at'] = "ALTER TABLE `verify_accounts` ADD `updated_at` INT NULL DEFAULT NULL;";
$sqlUpdateDatabase['verify_accounts']['image_license_before'] = "ALTER TABLE `verify_accounts` ADD `image_license_before` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['verify_accounts']['image_license_after'] = "ALTER TABLE `verify_accounts` ADD `image_license_after` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;";
$sqlUpdateDatabase['verify_accounts']['status'] = "ALTER TABLE `verify_accounts` ADD `status` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new';";
?>