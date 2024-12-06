<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];

$sqlInstallDatabase .="CREATE TABLE `historicalsites` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`phone` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image2` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image3` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image4` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image5` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image6` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image7` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image8` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image9` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image10` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`introductory` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`latitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL, 
	`longitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`image360` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`content` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`urlSlug` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`created` INT NULL DEFAULT NULL ,
	`status` BOOLEAN NULL DEFAULT NULL,
	`like` INT NULL DEFAULT NULL  , 
	PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `governanceagencys` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`phone` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image2` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image3` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image4` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image5` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image6` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image7` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image8` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image9` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image10` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`introductory` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`latitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL, 
	`longitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`image360` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`content` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`urlSlug` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`created` INT NULL DEFAULT NULL, 
	`status` BOOLEAN NULL DEFAULT NULL,
	`like` INT NULL DEFAULT NULL  , 
	PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `festivals` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`phone` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image2` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image3` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image4` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image5` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image6` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image7` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image8` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image9` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image10` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`introductory` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`latitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL, 
	`longitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`image360` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`content` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`urlSlug` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`created` INT NULL DEFAULT NULL, 
	`status` BOOLEAN NULL DEFAULT NULL, 
	`like` INT NULL DEFAULT NULL  ,
	`headcommittee` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`organizationlevel` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`holdtime` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,  
	PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `tours` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`phone` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image2` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image3` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image4` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image5` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image6` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image7` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image8` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image9` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image10` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`introductory` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`latitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL, 
	`longitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`image360` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`content` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`created` INT NULL DEFAULT NULL, 
	`datestart` INT NULL DEFAULT NULL,
	`price` INT NULL DEFAULT NULL, 
	`urlSlug` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`timetravel` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`status` BOOLEAN NULL DEFAULT NULL, 
	`like` INT NULL DEFAULT NULL  , 
	PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `craftvillages` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`phone` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image2` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image3` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image4` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image5` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image6` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image7` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image8` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image9` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image10` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`introductory` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`latitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL, 
	`longitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`image360` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`content` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`urlSlug` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`created` INT NULL DEFAULT NULL, 
	`status` BOOLEAN NULL DEFAULT NULL, 
	`like` INT NULL DEFAULT NULL  , 
	PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `restaurants` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`phone` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image2` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image3` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image4` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image5` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image6` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image7` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image8` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image9` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image10` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`introductory` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`latitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL, 
	`longitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`image360` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`content` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`urlSlug` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`created` INT NULL DEFAULT NULL, 
	`status` BOOLEAN NULL DEFAULT NULL, 
	`like` INT NULL DEFAULT NULL  , 
	PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `hotels` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`phone` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image2` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image3` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image4` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image5` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image6` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image7` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image8` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image9` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image10` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`introductory` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`latitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL, 
	`longitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`image360` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`content` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`urlSlug` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`created` INT NULL DEFAULT NULL, 
	`status` BOOLEAN NULL DEFAULT NULL, 
	`like` INT NULL DEFAULT NULL, 
	`priceday` FLOAT  NULL DEFAULT NULL,
	`pricehour` FLOAT NULL DEFAULT NULL, 
	`pricenight` FLOAT  NULL DEFAULT NULL,  
	PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `images` ( 
	`id` INT NOT NULL AUTO_INCREMENT ,
	`name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image2` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image3` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image4` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image5` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image6` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image7` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image8` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image9` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image10` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`introductory` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,  
	`image360` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`urlSlug` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`created` INT NULL DEFAULT NULL, 
	`status` BOOLEAN NULL DEFAULT NULL, 
	`like` INT NULL DEFAULT NULL,   
	PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `events` ( 
	`id` INT NOT NULL AUTO_INCREMENT ,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci DEFAULT NULL,
  `image2` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci DEFAULT NULL,
  `image3` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci DEFAULT NULL,
  `image4` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci DEFAULT NULL,
  `image5` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci DEFAULT NULL,
  `image6` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci DEFAULT NULL,
  `image7` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci DEFAULT NULL,
  `image8` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci DEFAULT NULL,
  `image9` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci DEFAULT NULL,
  `image10` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci DEFAULT NULL,
  `introductory` text CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci DEFAULT NULL,
  `image360` text CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci DEFAULT NULL,
  `urlSlug` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `datestart` int(11) DEFAULT NULL,
  `latitude` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci DEFAULT NULL,
  `longitude` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci DEFAULT NULL,
  `dateend` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `takesplace` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci DEFAULT NULL,
  `outstanding` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `like` int(11) DEFAULT NULL,
  `headcommittee` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci DEFAULT NULL,
  `organizationlevel` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci DEFAULT NULL,
  `pin` int(11) DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `places` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`phone` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image2` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image3` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image4` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image5` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image6` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image7` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image8` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image9` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image10` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`introductory` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`latitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL, 
	`longitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`image360` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`rating` INT NULL DEFAULT NULL, 
	`content` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`urlSlug` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`created` INT NULL DEFAULT NULL, 
	`status` BOOLEAN NULL DEFAULT NULL, 
	`like` INT NULL DEFAULT NULL  , 
	PRIMARY KEY (`id`)
) ENGINE = InnoDB;";




$sqlInstallDatabase .="CREATE TABLE `services` ( `id` INT NOT NULL AUTO_INCREMENT , 
                                                `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
                                                `address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
                                                `phone` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
                                                `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
                                                `image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
                                                `image2` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
                                                `image3` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
                                                `image4` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
                                                `image5` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
                                                `image6` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
                                                `image7` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
                                                `image8` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
                                                `image9` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
                                                `image10` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
                                                `image11` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
                                                `image12` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
                                                `image13` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
                                                `image14` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
                                                `image15` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
                                                `image16` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
                                                `image17` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
                                                `image18` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
                                                `image19` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
                                                `image20` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
                                                `introductory` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
                                                `latitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL, 
                                                `longitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
                                                `image360` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
                                                `content` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
                                                `urlSlug` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
                                                `created` INT NULL DEFAULT NULL,
                                                `idcategory` INT NULL DEFAULT NULL, 
                                                `status` BOOLEAN NULL DEFAULT NULL,
                                                `like` INT NULL DEFAULT NULL  , 
                                                PRIMARY KEY (`id`)
                                            ) ENGINE = InnoDB;";



$sqlInstallDatabase .="CREATE TABLE `eventcenters` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`phone` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image2` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image3` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image4` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image5` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image6` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image7` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image8` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image9` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`image10` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`introductory` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`latitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL, 
	`longitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`image360` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`content` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`urlSlug` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`created` INT NULL DEFAULT NULL, 
	`status` BOOLEAN NULL DEFAULT NULL,
	`like` INT NULL DEFAULT NULL  , 
	PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `booktables` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`idcustomer` INT NULL DEFAULT NULL , 
	`idrestaurant` INT NULL DEFAULT NULL , 
	`timebook` INT NULL DEFAULT NULL , 
	`name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`phone` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`created` INT NULL DEFAULT NULL , 
	`not` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`status` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`numberpeople` INT NULL DEFAULT NULL , 
	PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `booktours` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`idcustomer` INT NULL DEFAULT NULL , 
	`idtour` INT NULL DEFAULT NULL , 
	`name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`phone` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`created` INT NULL DEFAULT NULL , 
	`not` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`status` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`numberpeople` INT NULL DEFAULT NULL , 
	PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `bookhotels` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`idcustomer` INT NULL DEFAULT NULL , 
	`idhotel` INT NULL DEFAULT NULL , 
	`name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`phone` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`created` INT NULL DEFAULT NULL , 
	`not` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`status` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`numberpeople` INT NULL DEFAULT NULL , 
	`date_end` INT NULL DEFAULT NULL , 
	`date_start` INT NULL DEFAULT NULL , 
	`number_room` INT NULL DEFAULT NULL ,
	`type_register` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`pricePay` INT NULL DEFAULT NULL , 
	PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `reports` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`time` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`introductory` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`date` INT NULL DEFAULT NULL , 
	`idtour` INT NOT NULL , 
	`status` TINYINT NOT NULL , 
	PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .="CREATE TABLE `token_apis` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`user` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
	`pass` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
	`token` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
	`deadline` INT NOT NULL , 
	PRIMARY KEY (`id`)
) ENGINE = InnoDB; ";


$sqlDeleteDatabase .= "DROP TABLE historicalsites; ";
$sqlDeleteDatabase .= "DROP TABLE governanceAgencys; ";
$sqlDeleteDatabase .= "DROP TABLE festival; ";
$sqlDeleteDatabase .= "DROP TABLE tours; ";
$sqlDeleteDatabase .= "DROP TABLE craftvillages; ";
$sqlDeleteDatabase .= "DROP TABLE restaurants; ";
$sqlDeleteDatabase .= "DROP TABLE hotels; ";
$sqlDeleteDatabase .= "DROP TABLE images; ";
$sqlDeleteDatabase .= "DROP TABLE events; ";
$sqlDeleteDatabase .= "DROP TABLE likes; ";
$sqlDeleteDatabase .= "DROP TABLE places; ";
$sqlDeleteDatabase .= "DROP TABLE services; ";
$sqlDeleteDatabase .= "DROP TABLE eventcenters; ";
$sqlDeleteDatabase .= "DROP TABLE booktables; ";
$sqlDeleteDatabase .= "DROP TABLE booktours; ";
$sqlDeleteDatabase .= "DROP TABLE bookhotels; ";
$sqlDeleteDatabase .= "DROP TABLE reports; ";
$sqlDeleteDatabase .= "DROP TABLE token_apis; ";

// Bang historicalsites
$sqlUpdateDatabase['historicalsites']['name'] = "ALTER TABLE `historicalsites` ADD `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['historicalsites']['address'] = "ALTER TABLE `historicalsites` ADD `address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['historicalsites']['phone'] = "ALTER TABLE `historicalsites` ADD `phone` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['historicalsites']['email'] = "ALTER TABLE `historicalsites` ADD `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['historicalsites']['image'] = "ALTER TABLE `historicalsites` ADD `image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['historicalsites']['image2'] = "ALTER TABLE `historicalsites` ADD `image2` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['historicalsites']['image3'] = "ALTER TABLE `historicalsites` ADD `image3` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['historicalsites']['image4'] = "ALTER TABLE `historicalsites` ADD `image4` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['historicalsites']['image5'] = "ALTER TABLE `historicalsites` ADD `image5` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['historicalsites']['image6'] = "ALTER TABLE `historicalsites` ADD `image6` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['historicalsites']['image7'] = "ALTER TABLE `historicalsites` ADD `image7` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['historicalsites']['image8'] = "ALTER TABLE `historicalsites` ADD `image8` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['historicalsites']['image9'] = "ALTER TABLE `historicalsites` ADD `image9` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['historicalsites']['image10'] = "ALTER TABLE `historicalsites` ADD `image10` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['historicalsites']['introductory'] = "ALTER TABLE `historicalsites` ADD `introductory` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['historicalsites']['latitude'] = "ALTER TABLE `historicalsites` ADD `latitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['historicalsites']['longitude'] = "ALTER TABLE `historicalsites` ADD `longitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['historicalsites']['image360'] = "ALTER TABLE `historicalsites` ADD `image360` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['historicalsites']['content'] = "ALTER TABLE `historicalsites` ADD `content` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['historicalsites']['urlSlug'] = "ALTER TABLE `historicalsites` ADD `urlSlug` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['historicalsites']['created'] = "ALTER TABLE `historicalsites` ADD `created` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['historicalsites']['status'] = "ALTER TABLE `historicalsites` ADD `status` BOOLEAN NULL DEFAULT NULL; ";
$sqlUpdateDatabase['historicalsites']['like'] = "ALTER TABLE `historicalsites` ADD `like` INT NULL DEFAULT NULL; ";

// Bang governanceagencys
$sqlUpdateDatabase['governanceagencys']['name'] = "ALTER TABLE `governanceagencys` ADD `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['governanceagencys']['address'] = "ALTER TABLE `governanceagencys` ADD `address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['governanceagencys']['phone'] = "ALTER TABLE `governanceagencys` ADD `phone` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['governanceagencys']['email'] = "ALTER TABLE `governanceagencys` ADD `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['governanceagencys']['image'] = "ALTER TABLE `governanceagencys` ADD `image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['governanceagencys']['image'] = "ALTER TABLE `governanceagencys` ADD `image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['governanceagencys']['image2'] = "ALTER TABLE `governanceagencys` ADD `image2` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['governanceagencys']['image3'] = "ALTER TABLE `governanceagencys` ADD `image3` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['governanceagencys']['image4'] = "ALTER TABLE `governanceagencys` ADD `image4` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['governanceagencys']['image5'] = "ALTER TABLE `governanceagencys` ADD `image5` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['governanceagencys']['image6'] = "ALTER TABLE `governanceagencys` ADD `image6` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['governanceagencys']['image7'] = "ALTER TABLE `governanceagencys` ADD `image7` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['governanceagencys']['image8'] = "ALTER TABLE `governanceagencys` ADD `image8` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['governanceagencys']['image9'] = "ALTER TABLE `governanceagencys` ADD `image9` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['governanceagencys']['image10'] = "ALTER TABLE `governanceagencys` ADD `image10` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['governanceagencys']['introductory'] = "ALTER TABLE `governanceagencys` ADD `introductory` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['governanceagencys']['latitude'] = "ALTER TABLE `governanceagencys` ADD `latitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['governanceagencys']['longitude'] = "ALTER TABLE `governanceagencys` ADD `longitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['governanceagencys']['image360'] = "ALTER TABLE `governanceagencys` ADD `image360` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['governanceagencys']['content'] = "ALTER TABLE `governanceagencys` ADD `content` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['governanceagencys']['urlSlug'] = "ALTER TABLE `governanceagencys` ADD `urlSlug` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['governanceagencys']['created'] = "ALTER TABLE `governanceagencys` ADD `created` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['governanceagencys']['status'] = "ALTER TABLE `governanceagencys` ADD `status` BOOLEAN NULL DEFAULT NULL; ";
$sqlUpdateDatabase['governanceagencys']['like'] = "ALTER TABLE `governanceagencys` ADD `like` INT NULL DEFAULT NULL; ";

// Bang festivals
$sqlUpdateDatabase['festivals']['name'] = "ALTER TABLE `festivals` ADD `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['festivals']['address'] = "ALTER TABLE `festivals` ADD `address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['festivals']['phone'] = "ALTER TABLE `festivals` ADD `phone` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['festivals']['email'] = "ALTER TABLE `festivals` ADD `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['festivals']['image'] = "ALTER TABLE `festivals` ADD `image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['festivals']['image'] = "ALTER TABLE `festivals` ADD `image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['festivals']['image2'] = "ALTER TABLE `festivals` ADD `image2` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['festivals']['image3'] = "ALTER TABLE `festivals` ADD `image3` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['festivals']['image4'] = "ALTER TABLE `festivals` ADD `image4` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['festivals']['image5'] = "ALTER TABLE `festivals` ADD `image5` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['festivals']['image6'] = "ALTER TABLE `festivals` ADD `image6` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['festivals']['image7'] = "ALTER TABLE `festivals` ADD `image7` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['festivals']['image8'] = "ALTER TABLE `festivals` ADD `image8` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['festivals']['image9'] = "ALTER TABLE `festivals` ADD `image9` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['festivals']['image10'] = "ALTER TABLE `festivals` ADD `image10` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['festivals']['introductory'] = "ALTER TABLE `festivals` ADD `introductory` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['festivals']['latitude'] = "ALTER TABLE `festivals` ADD `latitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['festivals']['longitude'] = "ALTER TABLE `festivals` ADD `longitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['festivals']['image360'] = "ALTER TABLE `festivals` ADD `image360` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['festivals']['content'] = "ALTER TABLE `festivals` ADD `content` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['festivals']['urlSlug'] = "ALTER TABLE `festivals` ADD `urlSlug` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['festivals']['created'] = "ALTER TABLE `festivals` ADD `created` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['festivals']['status'] = "ALTER TABLE `festivals` ADD `status` BOOLEAN NULL DEFAULT NULL; ";
$sqlUpdateDatabase['festivals']['like'] = "ALTER TABLE `festivals` ADD `like` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['festivals']['headcommittee'] = "ALTER TABLE `festivals` ADD `headcommittee` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['festivals']['organizationlevel'] = "ALTER TABLE `festivals` ADD `organizationlevel` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['festivals']['holdtime'] = "ALTER TABLE `festivals` ADD `holdtime` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";

// Bang tours
$sqlUpdateDatabase['tours']['name'] = "ALTER TABLE `tours` ADD `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['tours']['address'] = "ALTER TABLE `tours` ADD `address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['tours']['phone'] = "ALTER TABLE `tours` ADD `phone` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['tours']['email'] = "ALTER TABLE `tours` ADD `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['tours']['image'] = "ALTER TABLE `tours` ADD `image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['tours']['image'] = "ALTER TABLE `tours` ADD `image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['tours']['image2'] = "ALTER TABLE `tours` ADD `image2` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['tours']['image3'] = "ALTER TABLE `tours` ADD `image3` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['tours']['image4'] = "ALTER TABLE `tours` ADD `image4` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['tours']['image5'] = "ALTER TABLE `tours` ADD `image5` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['tours']['image6'] = "ALTER TABLE `tours` ADD `image6` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['tours']['image7'] = "ALTER TABLE `tours` ADD `image7` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['tours']['image8'] = "ALTER TABLE `tours` ADD `image8` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['tours']['image9'] = "ALTER TABLE `tours` ADD `image9` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['tours']['image10'] = "ALTER TABLE `tours` ADD `image10` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['tours']['introductory'] = "ALTER TABLE `tours` ADD `introductory` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['tours']['latitude'] = "ALTER TABLE `tours` ADD `latitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['tours']['longitude'] = "ALTER TABLE `tours` ADD `longitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['tours']['image360'] = "ALTER TABLE `tours` ADD `image360` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['tours']['content'] = "ALTER TABLE `tours` ADD `content` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['tours']['created'] = "ALTER TABLE `tours` ADD `created` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['tours']['datestart'] = "ALTER TABLE `tours` ADD `datestart` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['tours']['price'] = "ALTER TABLE `tours` ADD `price` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['tours']['urlSlug'] = "ALTER TABLE `tours` ADD `urlSlug` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['tours']['timetravel'] = "ALTER TABLE `tours` ADD `timetravel` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['tours']['status'] = "ALTER TABLE `tours` ADD `status` BOOLEAN NULL DEFAULT NULL; ";
$sqlUpdateDatabase['tours']['like'] = "ALTER TABLE `tours` ADD `like` INT NULL DEFAULT NULL; ";

// Bang craftvillages
$sqlUpdateDatabase['craftvillages']['name'] = "ALTER TABLE `craftvillages` ADD `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['craftvillages']['address'] = "ALTER TABLE `craftvillages` ADD `address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['craftvillages']['phone'] = "ALTER TABLE `craftvillages` ADD `phone` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['craftvillages']['email'] = "ALTER TABLE `craftvillages` ADD `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['craftvillages']['image'] = "ALTER TABLE `craftvillages` ADD `image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['craftvillages']['image2'] = "ALTER TABLE `craftvillages` ADD `image2` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['craftvillages']['image3'] = "ALTER TABLE `craftvillages` ADD `image3` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['craftvillages']['image4'] = "ALTER TABLE `craftvillages` ADD `image4` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['craftvillages']['image5'] = "ALTER TABLE `craftvillages` ADD `image5` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['craftvillages']['image6'] = "ALTER TABLE `craftvillages` ADD `image6` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['craftvillages']['image7'] = "ALTER TABLE `craftvillages` ADD `image7` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['craftvillages']['image8'] = "ALTER TABLE `craftvillages` ADD `image8` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['craftvillages']['image9'] = "ALTER TABLE `craftvillages` ADD `image9` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['craftvillages']['image10'] = "ALTER TABLE `craftvillages` ADD `image10` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['craftvillages']['introductory'] = "ALTER TABLE `craftvillages` ADD `introductory` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['craftvillages']['latitude'] = "ALTER TABLE `craftvillages` ADD `latitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['craftvillages']['longitude'] = "ALTER TABLE `craftvillages` ADD `longitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['craftvillages']['image360'] = "ALTER TABLE `craftvillages` ADD `image360` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['craftvillages']['content'] = "ALTER TABLE `craftvillages` ADD `content` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['craftvillages']['urlSlug'] = "ALTER TABLE `craftvillages` ADD `urlSlug` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['craftvillages']['created'] = "ALTER TABLE `craftvillages` ADD `created` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['craftvillages']['status'] = "ALTER TABLE `craftvillages` ADD `status` BOOLEAN NULL DEFAULT NULL; ";
$sqlUpdateDatabase['craftvillages']['like'] = "ALTER TABLE `craftvillages` ADD `like` INT NULL DEFAULT NULL; ";

// Bang restaurants
$sqlUpdateDatabase['restaurants']['name'] = "ALTER TABLE `restaurants` ADD `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['restaurants']['address'] = "ALTER TABLE `restaurants` ADD `address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['restaurants']['phone'] = "ALTER TABLE `restaurants` ADD `phone` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['restaurants']['email'] = "ALTER TABLE `restaurants` ADD `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['restaurants']['image'] = "ALTER TABLE `restaurants` ADD `image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['restaurants']['image2'] = "ALTER TABLE `restaurants` ADD `image2` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['restaurants']['image3'] = "ALTER TABLE `restaurants` ADD `image3` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['restaurants']['image4'] = "ALTER TABLE `restaurants` ADD `image4` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['restaurants']['image5'] = "ALTER TABLE `restaurants` ADD `image5` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['restaurants']['image6'] = "ALTER TABLE `restaurants` ADD `image6` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['restaurants']['image7'] = "ALTER TABLE `restaurants` ADD `image7` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['restaurants']['image8'] = "ALTER TABLE `restaurants` ADD `image8` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['restaurants']['image9'] = "ALTER TABLE `restaurants` ADD `image9` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['restaurants']['image10'] = "ALTER TABLE `restaurants` ADD `image10` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['restaurants']['introductory'] = "ALTER TABLE `restaurants` ADD `introductory` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['restaurants']['latitude'] = "ALTER TABLE `restaurants` ADD `latitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['restaurants']['longitude'] = "ALTER TABLE `restaurants` ADD `longitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['restaurants']['image360'] = "ALTER TABLE `restaurants` ADD `image360` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['restaurants']['content'] = "ALTER TABLE `restaurants` ADD `content` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['restaurants']['urlSlug'] = "ALTER TABLE `restaurants` ADD `urlSlug` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['restaurants']['created'] = "ALTER TABLE `restaurants` ADD `created` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['restaurants']['status'] = "ALTER TABLE `restaurants` ADD `status` BOOLEAN NULL DEFAULT NULL; ";
$sqlUpdateDatabase['restaurants']['like'] = "ALTER TABLE `restaurants` ADD `like` INT NULL DEFAULT NULL; ";

// Bang hotels
$sqlUpdateDatabase['hotels']['name'] = "ALTER TABLE `hotels` ADD `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['hotels']['address'] = "ALTER TABLE `hotels` ADD `address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['hotels']['phone'] = "ALTER TABLE `hotels` ADD `phone` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['hotels']['email'] = "ALTER TABLE `hotels` ADD `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['hotels']['image'] = "ALTER TABLE `hotels` ADD `image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['hotels']['image2'] = "ALTER TABLE `hotels` ADD `image2` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['hotels']['image3'] = "ALTER TABLE `hotels` ADD `image3` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['hotels']['image4'] = "ALTER TABLE `hotels` ADD `image4` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['hotels']['image5'] = "ALTER TABLE `hotels` ADD `image5` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['hotels']['image6'] = "ALTER TABLE `hotels` ADD `image6` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['hotels']['image7'] = "ALTER TABLE `hotels` ADD `image7` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['hotels']['image8'] = "ALTER TABLE `hotels` ADD `image8` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['hotels']['image9'] = "ALTER TABLE `hotels` ADD `image9` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['hotels']['image10'] = "ALTER TABLE `hotels` ADD `image10` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['hotels']['introductory'] = "ALTER TABLE `hotels` ADD `introductory` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['hotels']['latitude'] = "ALTER TABLE `hotels` ADD `latitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['hotels']['longitude'] = "ALTER TABLE `hotels` ADD `longitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['hotels']['image360'] = "ALTER TABLE `hotels` ADD `image360` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['hotels']['content'] = "ALTER TABLE `hotels` ADD `content` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['hotels']['urlSlug'] = "ALTER TABLE `hotels` ADD `urlSlug` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['hotels']['created'] = "ALTER TABLE `hotels` ADD `created` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['hotels']['status'] = "ALTER TABLE `hotels` ADD `status` BOOLEAN NULL DEFAULT NULL; ";
$sqlUpdateDatabase['hotels']['like'] = "ALTER TABLE `hotels` ADD `like` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['hotels']['priceday'] = "ALTER TABLE `hotels` ADD `priceday` FLOAT  NULL DEFAULT NULL; ";
$sqlUpdateDatabase['hotels']['pricehour'] = "ALTER TABLE `hotels` ADD `pricehour` FLOAT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['hotels']['pricenight'] = "ALTER TABLE `hotels` ADD `pricenight` FLOAT  NULL DEFAULT NULL; ";

// Bang images
$sqlUpdateDatabase['images']['name'] = "ALTER TABLE `images` ADD `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['images']['address'] = "ALTER TABLE `images` ADD `address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['images']['phone'] = "ALTER TABLE `images` ADD `phone` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['images']['email'] = "ALTER TABLE `images` ADD `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['images']['image'] = "ALTER TABLE `images` ADD `image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['images']['image2'] = "ALTER TABLE `images` ADD `image2` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['images']['image3'] = "ALTER TABLE `images` ADD `image3` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['images']['image4'] = "ALTER TABLE `images` ADD `image4` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['images']['image5'] = "ALTER TABLE `images` ADD `image5` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['images']['image6'] = "ALTER TABLE `images` ADD `image6` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['images']['image7'] = "ALTER TABLE `images` ADD `image7` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['images']['image8'] = "ALTER TABLE `images` ADD `image8` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['images']['image9'] = "ALTER TABLE `images` ADD `image9` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['images']['image10'] = "ALTER TABLE `images` ADD `image10` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['images']['introductory'] = "ALTER TABLE `images` ADD `introductory` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['images']['latitude'] = "ALTER TABLE `images` ADD `latitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['images']['longitude'] = "ALTER TABLE `images` ADD `longitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['images']['image360'] = "ALTER TABLE `images` ADD `image360` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['images']['content'] = "ALTER TABLE `images` ADD `content` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['images']['urlSlug'] = "ALTER TABLE `images` ADD `urlSlug` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['images']['created'] = "ALTER TABLE `images` ADD `created` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['images']['status'] = "ALTER TABLE `images` ADD `status` BOOLEAN NULL DEFAULT NULL; ";
$sqlUpdateDatabase['images']['like'] = "ALTER TABLE `images` ADD `like` INT NULL DEFAULT NULL; ";

// Bang events
$sqlUpdateDatabase['events']['name'] = "ALTER TABLE `events` ADD `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['events']['address'] = "ALTER TABLE `events` ADD `address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['events']['phone'] = "ALTER TABLE `events` ADD `phone` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['events']['email'] = "ALTER TABLE `events` ADD `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['events']['image'] = "ALTER TABLE `events` ADD `image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['events']['image2'] = "ALTER TABLE `events` ADD `image2` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['events']['image3'] = "ALTER TABLE `events` ADD `image3` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['events']['image4'] = "ALTER TABLE `events` ADD `image4` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['events']['image5'] = "ALTER TABLE `events` ADD `image5` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['events']['image6'] = "ALTER TABLE `events` ADD `image6` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['events']['image7'] = "ALTER TABLE `events` ADD `image7` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['events']['image8'] = "ALTER TABLE `events` ADD `image8` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['events']['image9'] = "ALTER TABLE `events` ADD `image9` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['events']['image10'] = "ALTER TABLE `events` ADD `image10` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['events']['introductory'] = "ALTER TABLE `events` ADD `introductory` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['events']['phone'] = "ALTER TABLE `events` ADD `phone` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULLL; ";
$sqlUpdateDatabase['events']['image360'] = "ALTER TABLE `events` ADD `image360` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['events']['urlSlug'] = "ALTER TABLE `events` ADD `urlSlug` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['events']['created'] = "ALTER TABLE `events` ADD `created` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['events']['datestart'] = "ALTER TABLE `events` ADD `datestart` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['events']['latitude'] = "ALTER TABLE `events` ADD `latitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['events']['longitude'] = "ALTER TABLE `events` ADD `longitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['events']['dateEnd'] = "ALTER TABLE `events` ADD `dateEnd` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['events']['month'] = "ALTER TABLE `events` ADD `month` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['events']['year'] = "ALTER TABLE `events` ADD `year` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['events']['takesplace'] = "ALTER TABLE `events` ADD `takesplace` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['events']['outstanding'] = "ALTER TABLE `events` ADD `outstanding` BOOLEAN NULL DEFAULT NULL; ";
$sqlUpdateDatabase['events']['status'] = "ALTER TABLE `events` ADD `status` BOOLEAN NULL DEFAULT NULL; ";
$sqlUpdateDatabase['events']['like'] = "ALTER TABLE `events` ADD `like` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['events']['headcommittee'] = "ALTER TABLE `events` ADD `headcommittee` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['events']['organizationlevel'] = "ALTER TABLE `events` ADD `organizationlevel` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";

// Bang places
$sqlUpdateDatabase['places']['name'] = "ALTER TABLE `places` ADD `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['places']['address'] = "ALTER TABLE `places` ADD `address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['places']['phone'] = "ALTER TABLE `places` ADD `phone` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['places']['email'] = "ALTER TABLE `places` ADD `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['places']['image'] = "ALTER TABLE `places` ADD `image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['places']['image2'] = "ALTER TABLE `places` ADD `image2` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['places']['image3'] = "ALTER TABLE `places` ADD `image3` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['places']['image4'] = "ALTER TABLE `places` ADD `image4` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['places']['image5'] = "ALTER TABLE `places` ADD `image5` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['places']['image6'] = "ALTER TABLE `places` ADD `image6` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['places']['image7'] = "ALTER TABLE `places` ADD `image7` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['places']['image8'] = "ALTER TABLE `places` ADD `image8` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['places']['image9'] = "ALTER TABLE `places` ADD `image9` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['places']['image10'] = "ALTER TABLE `places` ADD `image10` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['places']['introductory'] = "ALTER TABLE `places` ADD `introductory` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['places']['latitude'] = "ALTER TABLE `places` ADD `latitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['places']['longitude'] = "ALTER TABLE `places` ADD `longitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['places']['image360'] = "ALTER TABLE `places` ADD `image360` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['places']['rating'] = "ALTER TABLE `places` ADD `rating` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['places']['content'] = "ALTER TABLE `places` ADD `content` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['places']['urlSlug'] = "ALTER TABLE `places` ADD `urlSlug` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['places']['created'] = "ALTER TABLE `places` ADD `created` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['places']['status'] = "ALTER TABLE `places` ADD `status` BOOLEAN NULL DEFAULT NULL; ";
$sqlUpdateDatabase['places']['like'] = "ALTER TABLE `places` ADD `like` INT NULL DEFAULT NULL; ";

// Bang services
$sqlUpdateDatabase['services']['name'] = "ALTER TABLE `services` ADD `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['services']['address'] = "ALTER TABLE `services` ADD `address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['services']['phone'] = "ALTER TABLE `services` ADD `phone` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['services']['email'] = "ALTER TABLE `services` ADD `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['services']['image'] = "ALTER TABLE `services` ADD `image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['services']['image2'] = "ALTER TABLE `services` ADD `image2` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['services']['image3'] = "ALTER TABLE `services` ADD `image3` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['services']['image4'] = "ALTER TABLE `services` ADD `image4` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['services']['image5'] = "ALTER TABLE `services` ADD `image5` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['services']['image6'] = "ALTER TABLE `services` ADD `image6` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['services']['image7'] = "ALTER TABLE `services` ADD `image7` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['services']['image8'] = "ALTER TABLE `services` ADD `image8` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['services']['image9'] = "ALTER TABLE `services` ADD `image9` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['services']['image10'] = "ALTER TABLE `services` ADD `image10` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['services']['image11'] = "ALTER TABLE `services` ADD `image11` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['services']['image12'] = "ALTER TABLE `services` ADD `image12` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['services']['image13'] = "ALTER TABLE `services` ADD `image13` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['services']['image14'] = "ALTER TABLE `services` ADD `image14` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['services']['image15'] = "ALTER TABLE `services` ADD `image15` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['services']['image16'] = "ALTER TABLE `services` ADD `image16` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['services']['image17'] = "ALTER TABLE `services` ADD `image17` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['services']['image18'] = "ALTER TABLE `services` ADD `image18` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['services']['image19'] = "ALTER TABLE `services` ADD `image19` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['services']['image20'] = "ALTER TABLE `services` ADD `image20` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ";
$sqlUpdateDatabase['services']['introductory'] = "ALTER TABLE `services` ADD `introductory` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['services']['latitude'] = "ALTER TABLE `services` ADD `latitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['services']['longitude'] = "ALTER TABLE `services` ADD `longitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['services']['image360'] = "ALTER TABLE `services` ADD `image360` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['services']['content'] = "ALTER TABLE `services` ADD `content` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['services']['urlSlug'] = "ALTER TABLE `services` ADD `urlSlug` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['services']['created'] = "ALTER TABLE `services` ADD `created` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['services']['idcategory'] = "ALTER TABLE `services` ADD `idcategory` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['services']['status'] = "ALTER TABLE `services` ADD `status` BOOLEAN NULL DEFAULT NULL; ";
$sqlUpdateDatabase['services']['like'] = "ALTER TABLE `services` ADD `like` INT NULL DEFAULT NULL; ";

// Bang eventcenters
$sqlUpdateDatabase['eventcenters']['name'] = "ALTER TABLE `eventcenters` ADD `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['eventcenters']['address'] = "ALTER TABLE `eventcenters` ADD `address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['eventcenters']['phone'] = "ALTER TABLE `eventcenters` ADD `phone` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['eventcenters']['email'] = "ALTER TABLE `eventcenters` ADD `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['eventcenters']['image'] = "ALTER TABLE `eventcenters` ADD `image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['eventcenters']['image'] = "ALTER TABLE `eventcenters` ADD `image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['eventcenters']['image2'] = "ALTER TABLE `eventcenters` ADD `image2` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['eventcenters']['image3'] = "ALTER TABLE `eventcenters` ADD `image3` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['eventcenters']['image4'] = "ALTER TABLE `eventcenters` ADD `image4` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['eventcenters']['image5'] = "ALTER TABLE `eventcenters` ADD `image5` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['eventcenters']['image6'] = "ALTER TABLE `eventcenters` ADD `image6` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['eventcenters']['image7'] = "ALTER TABLE `eventcenters` ADD `image7` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['eventcenters']['image8'] = "ALTER TABLE `eventcenters` ADD `image8` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['eventcenters']['image9'] = "ALTER TABLE `eventcenters` ADD `image9` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['eventcenters']['image10'] = "ALTER TABLE `eventcenters` ADD `image10` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['eventcenters']['introductory'] = "ALTER TABLE `eventcenters` ADD `introductory` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['eventcenters']['latitude'] = "ALTER TABLE `eventcenters` ADD `latitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['eventcenters']['longitude'] = "ALTER TABLE `eventcenters` ADD `longitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['eventcenters']['image360'] = "ALTER TABLE `eventcenters` ADD `image360` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['eventcenters']['content'] = "ALTER TABLE `eventcenters` ADD `content` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['eventcenters']['urlSlug'] = "ALTER TABLE `eventcenters` ADD `urlSlug` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['eventcenters']['created'] = "ALTER TABLE `eventcenters` ADD `created` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['eventcenters']['status'] = "ALTER TABLE `eventcenters` ADD `status` BOOLEAN NULL DEFAULT NULL; ";
$sqlUpdateDatabase['eventcenters']['like'] = "ALTER TABLE `eventcenters` ADD `like` INT NULL DEFAULT NULL; ";

// Bang booktables
$sqlUpdateDatabase['booktables']['idcustomer'] = "ALTER TABLE `booktables` ADD `idcustomer` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['booktables']['idrestaurant'] = "ALTER TABLE `booktables` ADD `idrestaurant` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['booktables']['timebook'] = "ALTER TABLE `booktables` ADD `timebook` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['booktables']['name'] = "ALTER TABLE `booktables` ADD `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['booktables']['phone'] = "ALTER TABLE `booktables` ADD `phone` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['booktables']['email'] = "ALTER TABLE `booktables` ADD `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['booktables']['created'] = "ALTER TABLE `booktables` ADD `created` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['booktables']['not'] = "ALTER TABLE `booktables` ADD `not` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['booktables']['status'] = "ALTER TABLE `booktables` ADD `status` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['booktables']['numberpeople'] = "ALTER TABLE `booktables` ADD `numberpeople` INT NULL DEFAULT NULL; ";

// Bang booktours
$sqlUpdateDatabase['booktours']['idcustomer'] = "ALTER TABLE `booktours` ADD `idcustomer` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['booktours']['idtour'] = "ALTER TABLE `booktours` ADD `idtour` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['booktours']['name'] = "ALTER TABLE `booktours` ADD `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['booktours']['phone'] = "ALTER TABLE `booktours` ADD `phone` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['booktours']['email'] = "ALTER TABLE `booktours` ADD `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['booktours']['created'] = "ALTER TABLE `booktours` ADD `created` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['booktours']['not'] = "ALTER TABLE `booktours` ADD `not` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['booktours']['status'] = "ALTER TABLE `booktours` ADD `status` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['booktours']['numberpeople'] = "ALTER TABLE `booktours` ADD `numberpeople` INT NULL DEFAULT NULL; ";

// Bang bookhotels
$sqlUpdateDatabase['bookhotels']['idcustomer'] = "ALTER TABLE `bookhotels` ADD `idcustomer` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['bookhotels']['idhotel'] = "ALTER TABLE `bookhotels` ADD `idhotel` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['bookhotels']['name'] = "ALTER TABLE `bookhotels` ADD `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['bookhotels']['phone'] = "ALTER TABLE `bookhotels` ADD `phone` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['bookhotels']['email'] = "ALTER TABLE `bookhotels` ADD `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['bookhotels']['created'] = "ALTER TABLE `bookhotels` ADD `created` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['bookhotels']['not'] = "ALTER TABLE `bookhotels` ADD `not` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['bookhotels']['status'] = "ALTER TABLE `bookhotels` ADD `status` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['bookhotels']['numberpeople'] = "ALTER TABLE `bookhotels` ADD `numberpeople` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['bookhotels']['date_end'] = "ALTER TABLE `bookhotels` ADD `date_end` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['bookhotels']['date_start'] = "ALTER TABLE `bookhotels` ADD `date_start` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['bookhotels']['number_room'] = "ALTER TABLE `bookhotels` ADD `number_room` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['bookhotels']['type_register'] = "ALTER TABLE `bookhotels` ADD `type_register` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['bookhotels']['pricePay'] = "ALTER TABLE `bookhotels` ADD `pricePay` INT NULL DEFAULT NULL; ";

// Bang reports
$sqlUpdateDatabase['reports']['name'] = "ALTER TABLE `reports` ADD `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['reports']['time'] = "ALTER TABLE `reports` ADD `time` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['reports']['image'] = "ALTER TABLE `reports` ADD `image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['reports']['introductory'] = "ALTER TABLE `reports` ADD `introductory` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['reports']['date'] = "ALTER TABLE `reports` ADD `date` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['reports']['idtour'] = "ALTER TABLE `reports` ADD `idtour` INT NOT NULL; ";
$sqlUpdateDatabase['reports']['status'] = "ALTER TABLE `reports` ADD `status` TINYINT NOT NULL; ";

// Bang token_apis
$sqlUpdateDatabase['token_apis']['user'] = "ALTER TABLE `token_apis` ADD `user` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['token_apis']['pass'] = "ALTER TABLE `token_apis` ADD `pass` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['token_apis']['token'] = "ALTER TABLE `token_apis` ADD `token` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['token_apis']['deadline'] = "ALTER TABLE `token_apis` ADD `deadline` INT NOT NULL; ";