<?php

global $sqlInstallDatabase;
global $sqlDeleteDatabase;

$sqlInstallDatabase .= 'CREATE TABLE `godraw_home`.`products` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL ,
    `category_id` INT NOT NULL , `description` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NULL DEFAULT NULL , 
    `image` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL , 
    `price` INT NOT NULL , 
    `status` INT NOT NULL , 
    `amount_in_stock` INT NOT NULL DEFAULT 0 , 
    `amount_sold` INT NOT NULL DEFAULT 0 , 
    `type` TINYINT NOT NULL , 
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `deleted_at` TIMESTAMP NULL DEFAULT NULL , PRIMARY KEY (`id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `godraw_home`.`users` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `username` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL , 
    `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL , 
    `password` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL , 
    `email` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL ,
    `avatar` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci ,  
    `phone` VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL , 
    `total_coin` INT NOT NULL DEFAULT 0 , 
    `status` TINYINT(1) NOT NULL DEFAULT 1 ,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `deleted_at` TIMESTAMP NULL DEFAULT NULL , PRIMARY KEY (`id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `godraw_home`.`agency_accounts` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `agency_id` INT NOT NULL ,
    `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL , 
    `password` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL , 
    `type` TINYINT(4) NOT NULL COMMENT "1 là chủ, 2 là nhân viên" , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `deleted_at` TIMESTAMP NULL DEFAULT NULL , PRIMARY KEY (`id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `godraw_home`.`agencies` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL , 
    `address` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL , 
    `phone` VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL , 
    `coordinates` POINT NULL DEFAULT NULL , 
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `deleted_at` TIMESTAMP NULL DEFAULT NULL , PRIMARY KEY (`id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `godraw_home`.`combos` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL , 
    `code` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL , 
    `price` INT NOT NULL , 
    `status` TINYINT NOT NULL DEFAULT 1 ,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `deleted_at` TIMESTAMP NULL DEFAULT NULL , PRIMARY KEY (`id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `godraw_home`.`combo_products` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `combo_id` INT NOT NULL , 
    `product_id` INT NOT NULL , 
    `amount` INT NOT NULL , 
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`id`),
    INDEX `combo_id_index` (`combo_id`), 
    INDEX `product_id_index` (`product_id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `godraw_home`.`agency_combos` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `agency_id` INT NOT NULL , 
    `combo_id` INT NOT NULL , 
    `amount` INT NOT NULL , 
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    PRIMARY KEY (`id`), 
    INDEX `agency_id_index` (`agency_id`), 
    INDEX `combo_id_index` (`combo_id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `godraw_home`.`agency_products` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `agency_id` INT NOT NULL , 
    `product_id` INT NOT NULL , 
    `price` INT NOT NULL , 
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    PRIMARY KEY (`id`), 
    INDEX `agency_id_index` (`agency_id`), 
    INDEX `combo_id_index` (`product_id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `godraw_home`.`agency_orders` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `agency_id` INT NOT NULL , 
    `total_price` INT NOT NULL , 
    `status` TINYINT NOT NULL DEFAULT 0 , 
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    PRIMARY KEY (`id`), 
    INDEX `agency_id_index` (`agency_id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `godraw_home`.`agency_order_details` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `order_id` INT NOT NULL , 
    `combo_id` INT NOT NULL , 
    `amount` INT NOT NULL , 
    `unit_price` INT NOT NULL , 
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    PRIMARY KEY (`id`),
    INDEX `order_id_index` (`order_id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `godraw_home`.`user_orders` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `user_id` INT NOT NULL , 
    `agency_id` INT NOT NULL , 
    `total_price` INT NOT NULL , 
    `status` TINYINT NOT NULL DEFAULT 0 , 
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    PRIMARY KEY (`id`), 
    INDEX `user_id_index` (`user_id`), 
    INDEX `agency_id_index` (`agency_id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `godraw_home`.`user_order_details` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `order_id` INT NOT NULL , 
    `product_id` INT NOT NULL , 
    `unit_price` INT NOT NULL , 
    `amount` INT NOT NULL , 
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    PRIMARY KEY (`id`), 
    INDEX `order_id_index` (`order_id`), 
    INDEX `product_id_index` (`product_id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'ALTER TABLE `categories` ADD `deleted_at` TIMESTAMP NULL DEFAULT NULL AFTER `slug`;';

$sqlDeleteDatabase .= 'DROP TABLE `godraw_home`.`products`;';
