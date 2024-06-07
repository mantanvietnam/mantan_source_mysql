<?php

global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];

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
    `deleted_at` TIMESTAMP NULL DEFAULT NULL , 
    PRIMARY KEY (`id`)
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
    `deleted_at` TIMESTAMP NULL DEFAULT NULL ,
    `verified` INT NOT NULL DEFAULT "0",
    `otp` INT NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `agency_accounts` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `agency_id` INT NOT NULL ,
    `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL , 
    `password` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL , 
    `type` TINYINT(4) NOT NULL COMMENT "1 là chủ, 2 là nhân viên" , 
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `status` VARCHAR(255) NOT NULL DEFAULT "active",
    `last_login` TIMESTAMP NULL,
    `code_pin` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `deleted_at` TIMESTAMP NULL DEFAULT NULL , 
    PRIMARY KEY (`id`)
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
    `deleted_at` TIMESTAMP NULL DEFAULT NULL , 
    PRIMARY KEY (`id`)
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
    `deleted_at` TIMESTAMP NULL DEFAULT NULL , 
    PRIMARY KEY (`id`)
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

$sqlInstallDatabase .= 'CREATE TABLE `agency_order_histories` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `agency_id` INT NOT NULL , 
    `order_id` INT NOT NULL , 
    `note` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL , 
    `created_at` TIMESTAMP NOT NULL , 
    `status` INT NULL, 
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `user_combo_orders` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `user_id` INT NOT NULL , 
    `agency_id` INT NOT NULL , 
    `total_price` INT NOT NULL , 
    `status` INT NOT NULL DEFAULT "0" COMMENT "0: đơn hàng mới, 2: đã thanh toán, 3: hủy bỏ " , 
    `created_at` TIMESTAMP NOT NULL , 
    `updated_at` TIMESTAMP NOT NULL , 
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `user_combo_order_details` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `order_combo_id` INT NOT NULL , 
    `combo_id` INT NOT NULL , 
    `price` INT NOT NULL , 
    `amount` INT NOT NULL , 
    `created_at` TIMESTAMP NOT NULL , 
    `updated_at` TIMESTAMP NOT NULL , 
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `user_order_combo_histories` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `agency_id` INT NOT NULL , 
    `order_combo_id` INT NOT NULL , 
    `note` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL , 
    `status` INT NULL DEFAULT 0 , 
    `created_at` TIMESTAMP NOT NULL , 
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `user_order_histories` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `agency_id` INT NOT NULL , 
    `order_id` INT NOT NULL , 
    `note` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
    `status` INT NOT NULL , 
    `created_at` TIMESTAMP NOT NULL , 
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `godraw_home`.`agency_order_products` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `order_detail_id` INT NOT NULL , 
    `product_id` INT NOT NULL , 
    `amount_sold` INT NOT NULL , 
    `unit_price` INT NOT NULL , 
    `amount_received` INT NOT NULL , 
    `paid_price` INT NOT NULL , 
    `status` TINYINT NOT NULL , 
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    `paid_at` TIMESTAMP NULL DEFAULT NULL , 
    PRIMARY KEY (`id`), INDEX `order_detail_id_index` (`order_detail_id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `agency_order_back_stores` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `agency_id` INT NOT NULL , 
    `total_price` INT NOT NULL , 
    `status` INT NOT NULL COMMENT "0: yêu cầu mới, 2: đã xử lý, 3: hủy bỏ" , 
    `note` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL, 
    `created_at` TIMESTAMP NOT NULL , 
    `updated_at` TIMESTAMP NOT NULL , 
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `agency_order_back_store_details` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `order_id` INT NOT NULL , 
    `product_id` INT NOT NULL , 
    `price` INT NOT NULL , 
    `amount` INT NOT NULL , 
    `created_at` TIMESTAMP NOT NULL , 
    `updated_at` TIMESTAMP NOT NULL , 
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `agency_order_back_store_histories` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `agency_id` INT NOT NULL , 
    `order_id` INT NOT NULL , 
    `note` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
    `status` INT NOT NULL , 
    `created_at` TIMESTAMP NOT NULL , 
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `agency_order_products` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `agency_id` INT NOT NULL , 
    `total_price` INT NOT NULL , 
    `status` INT NOT NULL , 
    `created_at` TIMESTAMP NOT NULL , 
    `updated_at` TIMESTAMP NOT NULL , 
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `agency_order_product_details` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `order_id` INT NOT NULL , 
    `product_id` INT NOT NULL , 
    `price` INT NOT NULL , 
    `amount` INT NOT NULL , 
    `created_at` TIMESTAMP NOT NULL , 
    `updated_at` TIMESTAMP NOT NULL , 
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `agency_order_product_histories` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `agency_id` INT NOT NULL , 
    `order_id` INT NOT NULL , 
    `note` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
    `status` INT NOT NULL , 
    `created_at` TIMESTAMP NOT NULL , 
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `warehouse_histories` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `product_id` INT NOT NULL , 
    `amount` INT NOT NULL , 
    `total_price` INT NOT NULL , 
    `price_average` FLOAT NOT NULL COMMENT "giá nhập trung bình" , 
    `note` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
    `updated_at` TIMESTAMP NOT NULL , 
    `type` VARCHAR(255) NOT NULL COMMENT "minus: trừ hàng, plus: cộng hàng", 
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;';

$sqlInstallDatabase .= 'CREATE TABLE `user_likes` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `picture_id` INT NOT NULL , 
    `user_id` INT NOT NULL , 
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;';

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

// Bang products
$sqlUpdateDatabase['products']['name'] = "ALTER TABLE `products` ADD `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['products']['category_id'] = "ALTER TABLE `products` ADD `category_id` INT NOT NULL , `description` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['products']['image'] = "ALTER TABLE `products` ADD `image` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['products']['price'] = "ALTER TABLE `products` ADD `price` INT NOT NULL; ";
$sqlUpdateDatabase['products']['status'] = "ALTER TABLE `products` ADD `status` INT NOT NULL; ";
$sqlUpdateDatabase['products']['amount_in_stock'] = "ALTER TABLE `products` ADD `amount_in_stock` INT NOT NULL DEFAULT 0; ";
$sqlUpdateDatabase['products']['amount_sold'] = "ALTER TABLE `products` ADD `amount_sold` INT NOT NULL DEFAULT 0; ";
$sqlUpdateDatabase['products']['type'] = "ALTER TABLE `products` ADD `type` TINYINT(4) NOT NULL DEFAULT "2" COMMENT "1 là tái sử dụng, 2 là tiêu hao"; ";
$sqlUpdateDatabase['products']['created_at'] = "ALTER TABLE `products` ADD `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP; ";
$sqlUpdateDatabase['products']['updated_at'] = "ALTER TABLE `products` ADD `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP; ";
$sqlUpdateDatabase['products']['deleted_at'] = "ALTER TABLE `products` ADD `deleted_at` TIMESTAMP NULL DEFAULT NULL; ";

// Bang users
$sqlUpdateDatabase['users']['username'] = "ALTER TABLE `users` ADD `username` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['users']['name'] = "ALTER TABLE `users` ADD `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['users']['password'] = "ALTER TABLE `users` ADD `password` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['users']['email'] = "ALTER TABLE `users` ADD `email` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['users']['avatar'] = "ALTER TABLE `users` ADD `avatar` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci; ";
$sqlUpdateDatabase['users']['phone'] = "ALTER TABLE `users` ADD `phone` VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['users']['total_coin'] = "ALTER TABLE `users` ADD `total_coin` INT NOT NULL DEFAULT 0; ";
$sqlUpdateDatabase['users']['status'] = "ALTER TABLE `users` ADD `status` TINYINT(1) NOT NULL DEFAULT 1; ";
$sqlUpdateDatabase['users']['nickname'] = "ALTER TABLE `users` ADD `nickname` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['users']['created_at'] = "ALTER TABLE `users` ADD `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP; ";
$sqlUpdateDatabase['users']['updated_at'] = "ALTER TABLE `users` ADD `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP; ";
$sqlUpdateDatabase['users']['deleted_at'] = "ALTER TABLE `users` ADD `deleted_at` TIMESTAMP NULL DEFAULT NULL; ";
$sqlUpdateDatabase['users']['verified'] = "ALTER TABLE `users` ADD `verified` INT NOT NULL DEFAULT "0"; ";
$sqlUpdateDatabase['users']['otp'] = "ALTER TABLE `users` ADD `otp` INT NULL DEFAULT NULL; ";

// Bang agency_accounts
$sqlUpdateDatabase['agency_accounts']['agency_id'] = "ALTER TABLE `agency_accounts` ADD `agency_id` INT NOT NULL; ";
$sqlUpdateDatabase['agency_accounts']['name'] = "ALTER TABLE `agency_accounts` ADD `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['agency_accounts']['password'] = "ALTER TABLE `agency_accounts` ADD `password` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['agency_accounts']['type'] = "ALTER TABLE `agency_accounts` ADD `type` TINYINT(4) NOT NULL COMMENT "1 là chủ, 2 là nhân viên"; ";
$sqlUpdateDatabase['agency_accounts']['created_at'] = "ALTER TABLE `agency_accounts` ADD `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP; ";
$sqlUpdateDatabase['agency_accounts']['status'] = "ALTER TABLE `agency_accounts` ADD `status` VARCHAR(255) NOT NULL DEFAULT "active"; ";
$sqlUpdateDatabase['agency_accounts']['last_login'] = "ALTER TABLE `agency_accounts` ADD `last_login` TIMESTAMP NULL; ";
$sqlUpdateDatabase['agency_accounts']['code_pin'] = "ALTER TABLE `agency_accounts` ADD `code_pin` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['agency_accounts']['updated_at'] = "ALTER TABLE `agency_accounts` ADD `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP; ";
$sqlUpdateDatabase['agency_accounts']['deleted_at'] = "ALTER TABLE `agency_accounts` ADD `deleted_at` TIMESTAMP NULL DEFAULT NULL; ";

// Bang agencies
$sqlUpdateDatabase['agencies']['name'] = "ALTER TABLE `agencies` ADD `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['agencies']['address'] = "ALTER TABLE `agencies` ADD `address` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['agencies']['phone'] = "ALTER TABLE `agencies` ADD `phone` VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['agencies']['coordinates'] = "ALTER TABLE `agencies` ADD `coordinates` POINT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['agencies']['status'] = "ALTER TABLE `agencies` ADD `status` TINYINT NOT NULL DEFAULT 1; ";
$sqlUpdateDatabase['agencies']['image'] = "ALTER TABLE `agencies` ADD `image` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['agencies']['email'] = "ALTER TABLE `agencies` ADD `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['agencies']['lat_gps'] = "ALTER TABLE `agencies` ADD `lat_gps` VARCHAR(255) NOT NULL; ";
$sqlUpdateDatabase['agencies']['long_gps'] = "ALTER TABLE `agencies` ADD `long_gps` VARCHAR(255) NOT NULL; ";
$sqlUpdateDatabase['agencies']['province_id'] = "ALTER TABLE `agencies` ADD `province_id` INT NOT NULL DEFAULT "0"; ";
$sqlUpdateDatabase['agencies']['district_id'] = "ALTER TABLE `agencies` ADD `district_id` INT NOT NULL DEFAULT "0"; ";
$sqlUpdateDatabase['agencies']['ward_id'] = "ALTER TABLE `agencies` ADD `ward_id` INT NOT NULL DEFAULT "0"; ";
$sqlUpdateDatabase['agencies']['created_at'] = "ALTER TABLE `agencies` ADD `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP; ";
$sqlUpdateDatabase['agencies']['updated_at'] = "ALTER TABLE `agencies` ADD `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP; ";
$sqlUpdateDatabase['agencies']['deleted_at'] = "ALTER TABLE `agencies` ADD `deleted_at` TIMESTAMP NULL DEFAULT NULL; ";

// Bang combos
$sqlUpdateDatabase['combos']['name'] = "ALTER TABLE `combos` ADD `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['combos']['code'] = "ALTER TABLE `combos` ADD `code` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL; ";
$sqlUpdateDatabase['combos']['price'] = "ALTER TABLE `combos` ADD `price` INT NOT NULL; ";
$sqlUpdateDatabase['combos']['image'] = "ALTER TABLE `combos` ADD `image` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['combos']['status'] = "ALTER TABLE `combos` ADD `status` TINYINT NOT NULL DEFAULT 1; ";
$sqlUpdateDatabase['combos']['created_at'] = "ALTER TABLE `combos` ADD `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP; ";
$sqlUpdateDatabase['combos']['updated_at'] = "ALTER TABLE `combos` ADD `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP; ";
$sqlUpdateDatabase['combos']['slug'] = "ALTER TABLE `combos` ADD `slug` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['combos']['description'] = "ALTER TABLE `combos` ADD `description` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['combos']['deleted_at'] = "ALTER TABLE `combos` ADD `deleted_at` TIMESTAMP NULL DEFAULT NULL; ";

// Bang combo_products
$sqlUpdateDatabase['combo_products']['combo_id'] = "ALTER TABLE `combo_products` ADD `combo_id` INT NOT NULL; ";
$sqlUpdateDatabase['combo_products']['product_id'] = "ALTER TABLE `combo_products` ADD `product_id` INT NOT NULL; ";
$sqlUpdateDatabase['combo_products']['amount'] = "ALTER TABLE `combo_products` ADD `amount` INT NOT NULL; ";
$sqlUpdateDatabase['combo_products']['created_at'] = "ALTER TABLE `combo_products` ADD `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP; ";
$sqlUpdateDatabase['combo_products']['updated_at'] = "ALTER TABLE `combo_products` ADD `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP; ";

// Bang agency_combos
$sqlUpdateDatabase['agency_combos']['agency_id'] = "ALTER TABLE `agency_combos` ADD `agency_id` INT NOT NULL; ";
$sqlUpdateDatabase['agency_combos']['combo_id'] = "ALTER TABLE `agency_combos` ADD `combo_id` INT NOT NULL; ";
$sqlUpdateDatabase['agency_combos']['amount'] = "ALTER TABLE `agency_combos` ADD `amount` INT NOT NULL; ";
$sqlUpdateDatabase['agency_combos']['created_at'] = "ALTER TABLE `agency_combos` ADD `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP; ";
$sqlUpdateDatabase['agency_combos']['updated_at'] = "ALTER TABLE `agency_combos` ADD `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP; ";
$sqlUpdateDatabase['agency_combos']['price'] = "ALTER TABLE `agency_combos` ADD `price` INT NOT NULL DEFAULT 0; ";

// Bang agency_products
$sqlUpdateDatabase['agency_products']['agency_id'] = "ALTER TABLE `agency_products` ADD `agency_id` INT NOT NULL; ";
$sqlUpdateDatabase['agency_products']['product_id'] = "ALTER TABLE `agency_products` ADD `product_id` INT NOT NULL; ";
$sqlUpdateDatabase['agency_products']['price'] = "ALTER TABLE `agency_products` ADD `price` INT NOT NULL; ";
$sqlUpdateDatabase['agency_products']['amount'] = "ALTER TABLE `agency_products` ADD `amount` INT NOT NULL DEFAULT 0; ";
$sqlUpdateDatabase['agency_products']['created_at'] = "ALTER TABLE `agency_products` ADD `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP; ";
$sqlUpdateDatabase['agency_products']['updated_at'] = "ALTER TABLE `agency_products` ADD `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP; ";

// Bang agency_orders
$sqlUpdateDatabase['agency_orders']['agency_id'] = "ALTER TABLE `agency_orders` ADD `agency_id` INT NOT NULL; ";
$sqlUpdateDatabase['agency_orders']['total_price'] = "ALTER TABLE `agency_orders` ADD `total_price` INT NOT NULL; ";
$sqlUpdateDatabase['agency_orders']['status'] = "ALTER TABLE `agency_orders` ADD `status` TINYINT(4) NOT NULL DEFAULT "0" COMMENT "0: đơn hàng mới, 1: đã duyệt xuất kho, 2: đã nhập kho, 3: đã thanh toán, 4: hủy bỏ"; ";
$sqlUpdateDatabase['agency_orders']['created_at'] = "ALTER TABLE `agency_orders` ADD `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP; ";
$sqlUpdateDatabase['agency_orders']['updated_at'] = "ALTER TABLE `agency_orders` ADD `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP; ";

// Bang agency_order_details
$sqlUpdateDatabase['agency_order_details']['order_id'] = "ALTER TABLE `agency_order_details` ADD `order_id` INT NOT NULL; ";
$sqlUpdateDatabase['agency_order_details']['combo_id'] = "ALTER TABLE `agency_order_details` ADD `combo_id` INT NOT NULL; ";
$sqlUpdateDatabase['agency_order_details']['amount'] = "ALTER TABLE `agency_order_details` ADD `amount` INT NOT NULL; ";
$sqlUpdateDatabase['agency_order_details']['unit_price'] = "ALTER TABLE `agency_order_details` ADD `unit_price` INT NOT NULL; ";
$sqlUpdateDatabase['agency_order_details']['created_at'] = "ALTER TABLE `agency_order_details` ADD `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP; ";
$sqlUpdateDatabase['agency_order_details']['updated_at'] = "ALTER TABLE `agency_order_details` ADD `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP; ";

// Bang user_orders
$sqlUpdateDatabase['user_orders']['user_id'] = "ALTER TABLE `user_orders` ADD `user_id` INT NOT NULL; ";
$sqlUpdateDatabase['user_orders']['agency_id'] = "ALTER TABLE `user_orders` ADD `agency_id` INT NOT NULL; ";
$sqlUpdateDatabase['user_orders']['total_price'] = "ALTER TABLE `user_orders` ADD `total_price` INT NOT NULL; ";
$sqlUpdateDatabase['user_orders']['status'] = "ALTER TABLE `user_orders` ADD `status` TINYINT NOT NULL DEFAULT 0; ";
$sqlUpdateDatabase['user_orders']['combo_id'] = "ALTER TABLE `user_orders` ADD `combo_id` INT NOT NULL DEFAULT 0; ";
$sqlUpdateDatabase['user_orders']['created_at'] = "ALTER TABLE `user_orders` ADD `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP; ";
$sqlUpdateDatabase['user_orders']['updated_at'] = "ALTER TABLE `user_orders` ADD `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP; ";

// Bang user_order_details
$sqlUpdateDatabase['user_order_details']['order_id'] = "ALTER TABLE `user_order_details` ADD `order_id` INT NOT NULL; ";
$sqlUpdateDatabase['user_order_details']['product_id'] = "ALTER TABLE `user_order_details` ADD `product_id` INT NOT NULL; ";
$sqlUpdateDatabase['user_order_details']['unit_price'] = "ALTER TABLE `user_order_details` ADD `unit_price` INT NOT NULL; ";
$sqlUpdateDatabase['user_order_details']['amount'] = "ALTER TABLE `user_order_details` ADD `amount` INT NOT NULL; ";
$sqlUpdateDatabase['user_order_details']['created_at'] = "ALTER TABLE `user_order_details` ADD `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP; ";
$sqlUpdateDatabase['user_order_details']['updated_at'] = "ALTER TABLE `user_order_details` ADD `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP; ";

// Bang user_pictures
$sqlUpdateDatabase['user_pictures']['name'] = "ALTER TABLE `user_pictures` ADD `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['user_pictures']['description'] = "ALTER TABLE `user_pictures` ADD `description` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['user_pictures']['image'] = "ALTER TABLE `user_pictures` ADD `image` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['user_pictures']['vote'] = "ALTER TABLE `user_pictures` ADD `vote` INT NOT NULL DEFAULT 0; ";
$sqlUpdateDatabase['user_pictures']['user_id'] = "ALTER TABLE `user_pictures` ADD `user_id` INT NOT NULL; ";
$sqlUpdateDatabase['user_pictures']['order_id'] = "ALTER TABLE `user_pictures` ADD `order_id` INT NOT NULL DEFAULT "0"; ";
$sqlUpdateDatabase['user_pictures']['created_at'] = "ALTER TABLE `user_pictures` ADD `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP; ";
$sqlUpdateDatabase['user_pictures']['updated_at'] = "ALTER TABLE `user_pictures` ADD `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ; ";

// Bang agency_order_histories
$sqlUpdateDatabase['agency_order_histories']['agency_id'] = "ALTER TABLE `agency_order_histories` ADD `agency_id` INT NOT NULL; ";
$sqlUpdateDatabase['agency_order_histories']['order_id'] = "ALTER TABLE `agency_order_histories` ADD  `order_id` INT NOT NULL; ";
$sqlUpdateDatabase['agency_order_histories']['note'] = "ALTER TABLE `agency_order_histories` ADD `note` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['agency_order_histories']['created_at'] = "ALTER TABLE `agency_order_histories` ADD `created_at` TIMESTAMP NOT NULL; ";
$sqlUpdateDatabase['agency_order_histories']['status'] = "ALTER TABLE `agency_order_histories` ADD `status` INT NULL; ";

// Bang user_combo_orders
$sqlUpdateDatabase['user_combo_orders']['user_id'] = "ALTER TABLE `user_combo_orders` ADD 'user_id' INT NOT NULL; ";
$sqlUpdateDatabase['user_combo_orders']['agency_id'] = "ALTER TABLE `user_combo_orders` ADD 'agency_id' INT NOT NULL; ";
$sqlUpdateDatabase['user_combo_orders']['total_price'] = "ALTER TABLE `user_combo_orders` ADD 'total_price' INT NOT NULL; ";
$sqlUpdateDatabase['user_combo_orders']['status'] = "ALTER TABLE `user_combo_orders` ADD 'status' INT NOT NULL DEFAULT "0" COMMENT "0: đơn hàng mới, 2: đã thanh toán, 3: hủy bỏ "; ";
$sqlUpdateDatabase['user_combo_orders']['created_at'] = "ALTER TABLE `user_combo_orders` ADD 'created_at' TIMESTAMP NOT NULL; ";
$sqlUpdateDatabase['user_combo_orders']['updated_at'] = "ALTER TABLE `user_combo_orders` ADD 'updated_at' TIMESTAMP NOT NULL; ";

// Bang user_combo_order_details
$sqlUpdateDatabase['user_combo_order_details']['order_combo_id'] = "ALTER TABLE `user_combo_order_details` ADD `order_combo_id` INT NOT NULL; ";
$sqlUpdateDatabase['user_combo_order_details']['combo_id'] = "ALTER TABLE `user_combo_order_details` ADD `combo_id` INT NOT NULL; ";
$sqlUpdateDatabase['user_combo_order_details']['price'] = "ALTER TABLE `user_combo_order_details` ADD `price` INT NOT NULL; ";
$sqlUpdateDatabase['user_combo_order_details']['amount'] = "ALTER TABLE `user_combo_order_details` ADD `amount` INT NOT NULL; ";
$sqlUpdateDatabase['user_combo_order_details']['created_at'] = "ALTER TABLE `user_combo_order_details` ADD `created_at` TIMESTAMP NOT NULL; ";
$sqlUpdateDatabase['user_combo_order_details']['updated_at'] = "ALTER TABLE `user_combo_order_details` ADD `updated_at` TIMESTAMP NOT NULL; ";

// Bang user_order_combo_histories
$sqlUpdateDatabase['user_order_combo_histories']['agency_id'] = "ALTER TABLE `user_order_combo_histories` ADD `agency_id` INT NOT NULL; ";
$sqlUpdateDatabase['user_order_combo_histories']['order_combo_id'] = "ALTER TABLE `user_order_combo_histories` ADD `order_combo_id` INT NOT NULL; ";
$sqlUpdateDatabase['user_order_combo_histories']['note'] = "ALTER TABLE `user_order_combo_histories` ADD `note` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['user_order_combo_histories']['status'] = "ALTER TABLE `user_order_combo_histories` ADD `status` INT NULL DEFAULT 0; ";
$sqlUpdateDatabase['user_order_combo_histories']['created_at'] = "ALTER TABLE `user_order_combo_histories` ADD `created_at` TIMESTAMP NOT NULL; ";

// Bang user_order_histories
$sqlUpdateDatabase['user_order_histories']['agency_id'] = "ALTER TABLE `user_order_histories` ADD `agency_id` INT NOT NULL; ";
$sqlUpdateDatabase['user_order_histories']['order_id'] = "ALTER TABLE `user_order_histories` ADD `order_id` INT NOT NULL; ";
$sqlUpdateDatabase['user_order_histories']['note'] = "ALTER TABLE `user_order_histories` ADD `note` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['user_order_histories']['status'] = "ALTER TABLE `user_order_histories` ADD `status` INT NOT NULL; ";
$sqlUpdateDatabase['user_order_histories']['created_at'] = "ALTER TABLE `user_order_histories` ADD `created_at` TIMESTAMP NOT NULL; ";

// Bang agency_order_products
$sqlUpdateDatabase['agency_order_products']['order_detail_id'] = "ALTER TABLE `agency_order_products` ADD `order_detail_id` INT NOT NULL; ";
$sqlUpdateDatabase['agency_order_products']['product_id'] = "ALTER TABLE `agency_order_products` ADD `product_id` INT NOT NULL; ";
$sqlUpdateDatabase['agency_order_products']['amount_sold'] = "ALTER TABLE `agency_order_products` ADD `amount_sold` INT NOT NULL; ";
$sqlUpdateDatabase['agency_order_products']['unit_price'] = "ALTER TABLE `agency_order_products` ADD `unit_price` INT NOT NULL; ";
$sqlUpdateDatabase['agency_order_products']['amount_received'] = "ALTER TABLE `agency_order_products` ADD `amount_received` INT NOT NULL; ";
$sqlUpdateDatabase['agency_order_products']['paid_price'] = "ALTER TABLE `agency_order_products` ADD `paid_price` INT NOT NULL; ";
$sqlUpdateDatabase['agency_order_products']['status'] = "ALTER TABLE `agency_order_products` ADD `status` TINYINT NOT NULL; ";
$sqlUpdateDatabase['agency_order_products']['created_at'] = "ALTER TABLE `agency_order_products` ADD `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP; ";
$sqlUpdateDatabase['agency_order_products']['paid_at'] = "ALTER TABLE `agency_order_products` ADD `paid_at` TIMESTAMP NULL DEFAULT NULL; ";

// Bang agency_order_back_stores
$sqlUpdateDatabase['agency_order_back_stores']['agency_id'] = "ALTER TABLE `agency_order_back_stores` ADD `agency_id` INT NOT NULL; ";
$sqlUpdateDatabase['agency_order_back_stores']['total_price'] = "ALTER TABLE `agency_order_back_stores` ADD `total_price` INT NOT NULL; ";
$sqlUpdateDatabase['agency_order_back_stores']['status'] = "ALTER TABLE `agency_order_back_stores` ADD `status` INT NOT NULL COMMENT "0: yêu cầu mới, 2: đã xử lý, 3: hủy bỏ"; ";
$sqlUpdateDatabase['agency_order_back_stores']['note'] = "ALTER TABLE `agency_order_back_stores` ADD `note` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['agency_order_back_stores']['created_at'] = "ALTER TABLE `agency_order_back_stores` ADD `created_at` TIMESTAMP NOT NULL; ";
$sqlUpdateDatabase['agency_order_back_stores']['updated_at'] = "ALTER TABLE `agency_order_back_stores` ADD `updated_at` TIMESTAMP NOT NULL; ";

// Bang agency_order_back_store_details
$sqlUpdateDatabase['agency_order_back_store_details']['order_id'] = "ALTER TABLE `agency_order_back_store_details` ADD `order_id` INT NOT NULL; ";
$sqlUpdateDatabase['agency_order_back_store_details']['product_id'] = "ALTER TABLE `agency_order_back_store_details` ADD `product_id` INT NOT NULL; ";
$sqlUpdateDatabase['agency_order_back_store_details']['price'] = "ALTER TABLE `agency_order_back_store_details` ADD `price` INT NOT NULL; ";
$sqlUpdateDatabase['agency_order_back_store_details']['amount'] = "ALTER TABLE `agency_order_back_store_details` ADD `amount` INT NOT NULL; ";
$sqlUpdateDatabase['agency_order_back_store_details']['created_at'] = "ALTER TABLE `agency_order_back_store_details` ADD `created_at` TIMESTAMP NOT NULL; ";
$sqlUpdateDatabase['agency_order_back_store_details']['updated_at'] = "ALTER TABLE `agency_order_back_store_details` ADD `updated_at` TIMESTAMP NOT NULL; ";

// Bang agency_order_back_store_histories
$sqlUpdateDatabase['agency_order_back_store_histories']['agency_id'] = "ALTER TABLE `agency_order_back_store_histories` ADD `agency_id` INT NOT NULL; ";
$sqlUpdateDatabase['agency_order_back_store_histories']['order_id'] = "ALTER TABLE `agency_order_back_store_histories` ADD `order_id` INT NOT NULL; ";
$sqlUpdateDatabase['agency_order_back_store_histories']['note'] = "ALTER TABLE `agency_order_back_store_histories` ADD `note` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['agency_order_back_store_histories']['status'] = "ALTER TABLE `agency_order_back_store_histories` ADD `status` INT NOT NULL; ";
$sqlUpdateDatabase['agency_order_back_store_histories']['created_at'] = "ALTER TABLE `agency_order_back_store_histories` ADD `created_at` TIMESTAMP NOT NULL; ";

// Bang agency_order_products
$sqlUpdateDatabase['agency_order_products']['agency_id'] = "ALTER TABLE `agency_order_products` ADD `agency_id` INT NOT NULL; ";
$sqlUpdateDatabase['agency_order_products']['total_price'] = "ALTER TABLE `agency_order_products` ADD `total_price` INT NOT NULL; ";
$sqlUpdateDatabase['agency_order_products']['status'] = "ALTER TABLE `agency_order_products` ADD `status` INT NOT NULL; ";
$sqlUpdateDatabase['agency_order_products']['created_at'] = "ALTER TABLE `agency_order_products` ADD `created_at` TIMESTAMP NOT NULL; ";
$sqlUpdateDatabase['agency_order_products']['updated_at'] = "ALTER TABLE `agency_order_products` ADD `updated_at` TIMESTAMP NOT NULL; ";

// Bang agency_order_product_details
$sqlUpdateDatabase['agency_order_product_details']['order_id'] = "ALTER TABLE `agency_order_product_details` ADD `order_id` INT NOT NULL; ";
$sqlUpdateDatabase['agency_order_product_details']['product_id'] = "ALTER TABLE `agency_order_product_details` ADD `product_id` INT NOT NULL; ";
$sqlUpdateDatabase['agency_order_product_details']['price'] = "ALTER TABLE `agency_order_product_details` ADD `price` INT NOT NULL; ";
$sqlUpdateDatabase['agency_order_product_details']['amount'] = "ALTER TABLE `agency_order_product_details` ADD `amount` INT NOT NULL; ";
$sqlUpdateDatabase['agency_order_product_details']['created_at'] = "ALTER TABLE `agency_order_product_details` ADD `created_at` TIMESTAMP NOT NULL; ";
$sqlUpdateDatabase['agency_order_product_details']['updated_at'] = "ALTER TABLE `agency_order_product_details` ADD `updated_at` TIMESTAMP NOT NULL; ";

// Bang agency_order_product_histories
$sqlUpdateDatabase['agency_order_product_histories']['agency_id'] = "ALTER TABLE `agency_order_product_histories` ADD `agency_id` INT NOT NULL; ";
$sqlUpdateDatabase['agency_order_product_histories']['order_id'] = "ALTER TABLE `agency_order_product_histories` ADD `order_id` INT NOT NULL; ";
$sqlUpdateDatabase['agency_order_product_histories']['note'] = "ALTER TABLE `agency_order_product_histories` ADD `note` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['agency_order_product_histories']['status'] = "ALTER TABLE `agency_order_product_histories` ADD `status` INT NOT NULL; ";
$sqlUpdateDatabase['agency_order_product_histories']['created_at'] = "ALTER TABLE `agency_order_product_histories` ADD `created_at` TIMESTAMP NOT NULL; ";

// Bang warehouse_histories
$sqlUpdateDatabase['warehouse_histories']['product_id'] = "ALTER TABLE `warehouse_histories` ADD `product_id` INT NOT NULL; ";
$sqlUpdateDatabase['warehouse_histories']['amount'] = "ALTER TABLE `warehouse_histories` ADD `amount` INT NOT NULL; ";
$sqlUpdateDatabase['warehouse_histories']['total_price'] = "ALTER TABLE `warehouse_histories` ADD `total_price` INT NOT NULL; ";
$sqlUpdateDatabase['warehouse_histories']['price_average'] = "ALTER TABLE `warehouse_histories` ADD `price_average` FLOAT NOT NULL COMMENT "giá nhập trung bình"; ";
$sqlUpdateDatabase['warehouse_histories']['note'] = "ALTER TABLE `warehouse_histories` ADD `note` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['warehouse_histories']['updated_at'] = "ALTER TABLE `warehouse_histories` ADD `updated_at` TIMESTAMP NOT NULL; ";
$sqlUpdateDatabase['warehouse_histories']['type'] = "ALTER TABLE `warehouse_histories` ADD `type` VARCHAR(255) NOT NULL COMMENT "minus: trừ hàng, plus: cộng hàng"; ";

// Bang user_likes
$sqlUpdateDatabase['user_likes']['picture_id'] = "ALTER TABLE `user_likes` ADD `picture_id` INT NOT NULL; ";
$sqlUpdateDatabase['user_likes']['user_id'] = "ALTER TABLE `user_likes` ADD `user_id` INT NOT NULL; ";