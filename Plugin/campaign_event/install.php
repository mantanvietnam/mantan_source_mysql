<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = '';

$sqlInstallDatabase .= "CREATE TABLE `campaigns` (
                                `id` INT NOT NULL AUTO_INCREMENT , 
                                `name` VARCHAR(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL , 
                                `name_show` VARCHAR(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL , 
                                `text_welcome` VARCHAR(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL , 
                                `codeSecurity` VARCHAR(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL , 
                                `codePersonWin` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL , 
                                `noteCheckin` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL , 
                                `colorText` VARCHAR(10) NOT NULL DEFAULT '#000000' , 
                                `status` VARCHAR(30) NOT NULL DEFAULT 'active' , 
                                `img_background` VARCHAR(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL , 
                                `id_member` INT NOT NULL , 
                                `location` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL , 
                                `img_logo` VARCHAR(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL , 
                                `create_at` INT NOT NULL , 
                                PRIMARY KEY (`id`)
                            ) ENGINE = InnoDB; ";

$sqlDeleteDatabase .= "DROP TABLE campaigns; ";

$sqlUpdateDatabase .= "";
?>