<?php

global $sqlInstallDatabase;
global $sqlDeleteDatabase;

$sqlInstallDatabase .= 'CREATE TABLE `godraw_home`.`products` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL ,
    `category_id` INT NOT NULL , `description` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NULL DEFAULT NULL , 
    `image` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL , 
    `price` INT NOT NULL , 
    `vote` INT NOT NULL DEFAULT 0 , 
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
    `type` TINYINT NOT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
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

$sqlDeleteDatabase .= 'DROP TABLE `godraw_home`.`products`;';
