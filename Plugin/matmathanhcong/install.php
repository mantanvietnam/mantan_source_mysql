    <?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';

$sqlInstallDatabase .= "CREATE TABLE `request_exports` ( `id` INT NOT NULL AUTO_INCREMENT , `avatar` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `birthday` VARCHAR(255) NOT NULL , `phone` VARCHAR(15) NOT NULL , `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL , `address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL , `affiliate_phone` VARCHAR(15) NULL , `link_download` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL , `status_pay` VARCHAR(255) NOT NULL DEFAULT 'wait', PRIMARY KEY (`id`)) ENGINE = InnoDB; ";

$sqlDeleteDatabase .= "DROP TABLE request_exports; ";

/*
$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='category_product'; ";
$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='manufacturer_product'; ";
*/
?>