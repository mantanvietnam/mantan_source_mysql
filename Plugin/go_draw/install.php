<?php

global $sqlInstallDatabase;
global $sqlDeleteDatabase;

$sqlInstallDatabase .= 'CREATE TABLE `products` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL ,
    `category_id` INT NOT NULL , `description` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NULL DEFAULT NULL , 
    `image` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL , 
    `price` INT NOT NULL , 
    `status` INT NOT NULL , 
    `amount_in_stock` INT NOT NULL DEFAULT 0 , 
    `amount_sold` INT NOT NULL DEFAULT 0 , 
    `type` TINYINT(4) NOT NULL DEFAULT "2" COMMENT "1 là tái sử dụng, 2 là tiêu hao" , 
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `deleted_at` TIMESTAMP NULL DEFAULT NULL , PRIMARY KEY (`id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `users` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `username` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL , 
    `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL , 
    `password` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL , 
    `email` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL ,
    `avatar` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci ,  
    `phone` VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL , 
    `total_coin` INT NOT NULL DEFAULT 0 , 
    `status` TINYINT(1) NOT NULL DEFAULT 1 ,
    `nickname` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `deleted_at` TIMESTAMP NULL DEFAULT NULL , PRIMARY KEY (`id`),
    `verified` INT NOT NULL DEFAULT "0",
    `otp` INT NULL DEFAULT NULL,
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `agency_accounts` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `agency_id` INT NOT NULL ,
    `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL , 
    `password` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL , 
    `type` TINYINT(4) NOT NULL COMMENT "1 là chủ, 2 là nhân viên" , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `status` VARCHAR(255) NOT NULL DEFAULT "active",
    `last_login` TIMESTAMP NULL,
    `code_pin` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `deleted_at` TIMESTAMP NULL DEFAULT NULL , PRIMARY KEY (`id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `agencies` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL , 
    `address` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL , 
    `phone` VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL , 
    `coordinates` POINT NULL DEFAULT NULL , 
    `status` TINYINT NOT NULL DEFAULT 1 ,
    `image` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `lat_gps` VARCHAR(255) NOT NULL,
    `long_gps` VARCHAR(255) NOT NULL,
    `province_id` INT NOT NULL DEFAULT "0" ,
    `district_id` INT NOT NULL DEFAULT "0",
    `ward_id` INT NOT NULL DEFAULT "0",
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `deleted_at` TIMESTAMP NULL DEFAULT NULL , PRIMARY KEY (`id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `combos` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL , 
    `code` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL , 
    `price` INT NOT NULL , 
    `image` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NULL DEFAULT NULL , 
    `status` TINYINT NOT NULL DEFAULT 1 ,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `slug` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `description` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL , PRIMARY KEY (`id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `combo_products` ( 
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

$sqlInstallDatabase .= 'CREATE TABLE `agency_combos` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `agency_id` INT NOT NULL , 
    `combo_id` INT NOT NULL , 
    `amount` INT NOT NULL , 
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `price` INT NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`), 
    INDEX `agency_id_index` (`agency_id`), 
    INDEX `combo_id_index` (`combo_id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `agency_products` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `agency_id` INT NOT NULL , 
    `product_id` INT NOT NULL , 
    `price` INT NOT NULL , 
    `amount` INT NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    PRIMARY KEY (`id`), 
    INDEX `agency_id_index` (`agency_id`), 
    INDEX `combo_id_index` (`product_id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `agency_orders` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `agency_id` INT NOT NULL , 
    `total_price` INT NOT NULL , 
    `status` TINYINT(4) NOT NULL DEFAULT "0" COMMENT "0: đơn hàng mới, 1: đã duyệt xuất kho, 2: đã nhập kho, 3: đã thanh toán, 4: hủy bỏ" , 
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    PRIMARY KEY (`id`), 
    INDEX `agency_id_index` (`agency_id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `agency_order_details` ( 
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

$sqlInstallDatabase .= 'CREATE TABLE `user_orders` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `user_id` INT NOT NULL , 
    `agency_id` INT NOT NULL , 
    `total_price` INT NOT NULL , 
    `status` TINYINT NOT NULL DEFAULT 0 , 
    `combo_id` INT NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    PRIMARY KEY (`id`), 
    INDEX `user_id_index` (`user_id`), 
    INDEX `agency_id_index` (`agency_id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `user_order_details` ( 
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

$sqlInstallDatabase .= 'CREATE TABLE `user_pictures` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `description` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `image` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `vote` INT NOT NULL DEFAULT 0 , 
    `user_id` INT NOT NULL , 
    `order_id` INT NOT NULL DEFAULT "0",
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    PRIMARY KEY (`id`), 
    INDEX `user_id_index` (`user_id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `agency_order_histories` ( `id` INT NOT NULL AUTO_INCREMENT , `agency_id` INT NOT NULL , `order_id` INT NOT NULL , `note` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL , `created_at` TIMESTAMP NOT NULL , `status` INT NULL, PRIMARY KEY (`id`)) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `user_combo_orders` ( `id` INT NOT NULL AUTO_INCREMENT , `user_id` INT NOT NULL , `agency_id` INT NOT NULL , `total_price` INT NOT NULL , `status` INT NOT NULL DEFAULT "0" COMMENT "0: đơn hàng mới, 2: đã thanh toán, 3: hủy bỏ " , `created_at` TIMESTAMP NOT NULL , `updated_at` TIMESTAMP NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `user_combo_order_details` ( `id` INT NOT NULL AUTO_INCREMENT , `order_combo_id` INT NOT NULL , `combo_id` INT NOT NULL , `price` INT NOT NULL , `amount` INT NOT NULL , `created_at` TIMESTAMP NOT NULL , `updated_at` TIMESTAMP NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `user_order_combo_histories` ( `id` INT NOT NULL AUTO_INCREMENT , `agency_id` INT NOT NULL , `order_combo_id` INT NOT NULL , `note` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL , `status` INT NULL DEFAULT 0 , `created_at` TIMESTAMP NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `user_order_histories` ( `id` INT NOT NULL AUTO_INCREMENT , `agency_id` INT NOT NULL , `order_id` INT NOT NULL , `note` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `status` INT NOT NULL , `created_at` TIMESTAMP NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `godraw_home`.`agency_order_products` ( `id` INT NOT NULL AUTO_INCREMENT , `order_detail_id` INT NOT NULL , `product_id` INT NOT NULL , `amount_sold` INT NOT NULL , `unit_price` INT NOT NULL , `amount_received` INT NOT NULL , `paid_price` INT NOT NULL , `status` TINYINT NOT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, `paid_at` TIMESTAMP NULL DEFAULT NULL , PRIMARY KEY (`id`), INDEX `order_detail_id_index` (`order_detail_id`)) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `agency_order_back_stores` ( `id` INT NOT NULL AUTO_INCREMENT , `agency_id` INT NOT NULL , `total_price` INT NOT NULL , `status` INT NOT NULL COMMENT "0: yêu cầu mới, 2: đã xử lý, 3: hủy bỏ" , `note` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL, `created_at` TIMESTAMP NOT NULL , `updated_at` TIMESTAMP NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `agency_order_back_store_details` ( `id` INT NOT NULL AUTO_INCREMENT , `order_id` INT NOT NULL , `product_id` INT NOT NULL , `price` INT NOT NULL , `amount` INT NOT NULL , `created_at` TIMESTAMP NOT NULL , `updated_at` TIMESTAMP NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `agency_order_back_store_histories` ( `id` INT NOT NULL AUTO_INCREMENT , `agency_id` INT NOT NULL , `order_id` INT NOT NULL , `note` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `status` INT NOT NULL , `created_at` TIMESTAMP NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `agency_order_products` ( `id` INT NOT NULL AUTO_INCREMENT , `agency_id` INT NOT NULL , `total_price` INT NOT NULL , `status` INT NOT NULL , `created_at` TIMESTAMP NOT NULL , `updated_at` TIMESTAMP NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `agency_order_product_details` ( `id` INT NOT NULL AUTO_INCREMENT , `order_id` INT NOT NULL , `product_id` INT NOT NULL , `price` INT NOT NULL , `amount` INT NOT NULL , `created_at` TIMESTAMP NOT NULL , `updated_at` TIMESTAMP NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `agency_order_product_histories` ( `id` INT NOT NULL AUTO_INCREMENT , `agency_id` INT NOT NULL , `order_id` INT NOT NULL , `note` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `status` INT NOT NULL , `created_at` TIMESTAMP NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `warehouse_histories` ( `id` INT NOT NULL AUTO_INCREMENT , `product_id` INT NOT NULL , `amount` INT NOT NULL , `total_price` INT NOT NULL , `price_average` FLOAT NOT NULL COMMENT "giá nhập trung bình" , `note` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `updated_at` TIMESTAMP NOT NULL , `type` VARCHAR(255) NOT NULL COMMENT "minus: trừ hàng, plus: cộng hàng", PRIMARY KEY (`id`)) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `user_likes` ( `id` INT NOT NULL AUTO_INCREMENT , `picture_id` INT NOT NULL , `user_id` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;';

$sqlDeleteDatabase .= 'DROP TABLE `products`;';
$sqlDeleteDatabase .= 'DROP TABLE `users`;';
$sqlDeleteDatabase .= 'DROP TABLE `agency_accounts`;';
$sqlDeleteDatabase .= 'DROP TABLE `combos`;';
$sqlDeleteDatabase .= 'DROP TABLE `combo_products`;';
$sqlDeleteDatabase .= 'DROP TABLE `agency_combos`;';
$sqlDeleteDatabase .= 'DROP TABLE `agency_products`;';
$sqlDeleteDatabase .= 'DROP TABLE `agency_orders`;';
$sqlDeleteDatabase .= 'DROP TABLE `agency_order_details`;';
$sqlDeleteDatabase .= 'DROP TABLE `user_orders`;';
$sqlDeleteDatabase .= 'DROP TABLE `user_order_details`;';
$sqlDeleteDatabase .= 'DROP TABLE `agency_order_histories`;';
$sqlDeleteDatabase .= 'DROP TABLE `user_combo_orders`;';
$sqlDeleteDatabase .= 'DROP TABLE `user_combo_order_details`;';
$sqlDeleteDatabase .= 'DROP TABLE `user_order_combo_histories`;';
$sqlDeleteDatabase .= 'DROP TABLE `user_order_histories`;';
$sqlDeleteDatabase .= 'DROP TABLE `agency_order_products`;';
$sqlDeleteDatabase .= 'DROP TABLE `agency_order_back_stores`;';
$sqlDeleteDatabase .= 'DROP TABLE `agency_order_back_store_details`;';
$sqlDeleteDatabase .= 'DROP TABLE `agency_order_back_store_histories`;';
$sqlDeleteDatabase .= 'DROP TABLE `agency_order_products`;';
$sqlDeleteDatabase .= 'DROP TABLE `agency_order_product_details`;';
$sqlDeleteDatabase .= 'DROP TABLE `agency_order_product_histories`;';
$sqlDeleteDatabase .= 'DROP TABLE `warehouse_histories`;';
$sqlDeleteDatabase .= 'DROP TABLE `user_likes`;';

