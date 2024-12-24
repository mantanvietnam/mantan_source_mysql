<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];
/*
$sqlInstallDatabase .= "CREATE TABLE `historicalsites` ( 
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
	`introductory` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`latitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL, 
	`longitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`image360` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`content` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`urlSlug` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`created` INT NULL DEFAULT NULL ,
	`status` BOOLEAN NULL DEFAULT NULL,
	`like` INT NULL DEFAULT NULL,
	`rating` INT NULL DEFAULT NULL,
	`idward` INT NULL DEFAULT NULL, 
	PRIMARY KEY (`id`)
) ENGINE = InnoDB;";
*/
$sqlInstallDatabase .= "CREATE TABLE `wards` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci  NULL DEFAULT NULL , 
	`urlSlug`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci  NULL DEFAULT NULL , 
	PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .=" CREATE TABLE `categoryartifacts` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci  NULL DEFAULT NULL , 
	`urlSlug`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci  NULL DEFAULT NULL , 
	PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

$sqlInstallDatabase .= "CREATE TABLE `artifacts` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`material` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`excavation` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`period` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`weight` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`size` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
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
	`image360` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`introductory` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`idHistoricalsite` INT NULL DEFAULT NULL , 
	`idcategory` INT NULL DEFAULT NULL , 
	`registrationdate` INT NULL DEFAULT NULL , 
	`year` INT NULL DEFAULT NULL , 
	`number` INT NULL DEFAULT NULL ,
	`quantity` INT NULL DEFAULT NULL ,
	`address`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`file`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`current`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`certification`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`shape`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`source`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`color`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`classify`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`location`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`voter`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`technique`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`century`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`sign`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`content` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`exposure`  VARCHAR(255)  CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`intensity`  VARCHAR(255)  CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`softness`  VARCHAR(255)  CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`counterclockwise`  VARCHAR(255)  CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`clockwiselimit`  VARCHAR(255)  CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`topdownlimit`  VARCHAR(255)  CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`bottomuplimit`  VARCHAR(255)  CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`doctitle`  VARCHAR(255)  CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`docauthor` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`doclink` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`docdate` INT NULL DEFAULT NULL , 
	`docifile` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`docdescribe` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`videotitle`  VARCHAR(255)  CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`videoauthor` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`videolink` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`videofile` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`videodescribe` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`presenttitle`  VARCHAR(255)  CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`presentauthor` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`presentlink` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`presentfile` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`presentdescribe` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ,
	`present` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`doctype` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`videotype` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`presenttype` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`environmentimage` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`backgroundcolor` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`filegle` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`fileusdz` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`urlSlug` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL , 
	`status` TINYINT NULL DEFAULT NULL , PRIMARY KEY (`id`)
) ENGINE = InnoDB;";

//$sqlDeleteDatabase .= "DROP TABLE historicalsites; ";
$sqlDeleteDatabase .= "DROP TABLE wards; ";
$sqlDeleteDatabase .= "DROP TABLE artifacts; ";

// Bang historicalsites
$sqlUpdateDatabase['historicalsites']['name'] = "ALTER TABLE `historicalsites` ADD `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL ; ";
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
$sqlUpdateDatabase['historicalsites']['introductory'] = "ALTER TABLE `historicalsites` ADD `introductory` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['historicalsites']['latitude'] = "ALTER TABLE `historicalsites` ADD `latitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['historicalsites']['longitude'] = "ALTER TABLE `historicalsites` ADD `longitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['historicalsites']['image360'] = "ALTER TABLE `historicalsites` ADD `image360` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['historicalsites']['content'] = "ALTER TABLE `historicalsites` ADD `content` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['historicalsites']['urlSlug'] = "ALTER TABLE `historicalsites` ADD `urlSlug` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['historicalsites']['created'] = "ALTER TABLE `historicalsites` ADD `created` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['historicalsites']['status'] = "ALTER TABLE `historicalsites` ADD `status` BOOLEAN NULL DEFAULT NULL; ";
$sqlUpdateDatabase['historicalsites']['like'] = "ALTER TABLE `historicalsites` ADD `like` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['historicalsites']['rating'] = "ALTER TABLE `historicalsites` ADD `rating` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['historicalsites']['idward'] = "ALTER TABLE `historicalsites` ADD`idward` int(11) DEFAULT NULL; ";

// Bang wards
$sqlUpdateDatabase['wards']['name'] = "ALTER TABLE `wards` ADD `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci  NULL DEFAULT NULL; ";
$sqlUpdateDatabase['wards']['urlSlug'] = "ALTER TABLE `wards` ADD `urlSlug`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci  NULL DEFAULT NULL; ";

// Bang categoryartifacts
$sqlUpdateDatabase['categoryartifacts']['name'] = "ALTER TABLE `categoryartifacts` ADD `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci  NULL DEFAULT NULL; ";
$sqlUpdateDatabase['categoryartifacts']['urlSlug'] = "ALTER TABLE `categoryartifacts` ADD `urlSlug`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci  NULL DEFAULT NULL; ";

// Bang artifacts
$sqlUpdateDatabase['artifacts']['name'] = "ALTER TABLE `artifacts` ADD `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['material'] = "ALTER TABLE `artifacts` ADD `material` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['excavation'] = "ALTER TABLE `artifacts` ADD `excavation` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['period'] = "ALTER TABLE `artifacts` ADD `period` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['weight'] = "ALTER TABLE `artifacts` ADD `weight` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['size'] = "ALTER TABLE `artifacts` ADD `size` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['image'] = "ALTER TABLE `artifacts` ADD `image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['image2'] = "ALTER TABLE `artifacts` ADD `image2` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['image3'] = "ALTER TABLE `artifacts` ADD `image3` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['image4'] = "ALTER TABLE `artifacts` ADD `image4` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['image5'] = "ALTER TABLE `artifacts` ADD `image5` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['image6'] = "ALTER TABLE `artifacts` ADD `image6` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['image7'] = "ALTER TABLE `artifacts` ADD `image7` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['image8'] = "ALTER TABLE `artifacts` ADD `image8` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['image9'] = "ALTER TABLE `artifacts` ADD `image9` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['image10'] = "ALTER TABLE `artifacts` ADD `image10` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['image360'] = "ALTER TABLE `artifacts` ADD `image360` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['introductory'] = "ALTER TABLE `artifacts` ADD `introductory` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['idHistoricalsite'] = "ALTER TABLE `artifacts` ADD `idHistoricalsite` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['idcategory'] = "ALTER TABLE `artifacts` ADD `idcategory` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['registrationdate'] = "ALTER TABLE `artifacts` ADD `registrationdate` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['year'] = "ALTER TABLE `artifacts` ADD `year` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['number'] = "ALTER TABLE `artifacts` ADD `number` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['quantity'] = "ALTER TABLE `artifacts` ADD `quantity` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['address'] = "ALTER TABLE `artifacts` ADD `address`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['file'] = "ALTER TABLE `artifacts` ADD `file`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['current'] = "ALTER TABLE `artifacts` ADD `current`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['certification'] = "ALTER TABLE `artifacts` ADD `certification`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['shape'] = "ALTER TABLE `artifacts` ADD `shape`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['source'] = "ALTER TABLE `artifacts` ADD `source`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['color'] = "ALTER TABLE `artifacts` ADD `color`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['classify'] = "ALTER TABLE `artifacts` ADD `classify`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['location'] = "ALTER TABLE `artifacts` ADD `location`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['voter'] = "ALTER TABLE `artifacts` ADD `voter`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['technique'] = "ALTER TABLE `artifacts` ADD `technique`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['century'] = "ALTER TABLE `artifacts` ADD `century`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['sign'] = "ALTER TABLE `artifacts` ADD `sign`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['content'] = "ALTER TABLE `artifacts` ADD `content` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['exposure'] = "ALTER TABLE `artifacts` ADD `exposure`  VARCHAR(255)  CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['intensity'] = "ALTER TABLE `artifacts` ADD `intensity`  VARCHAR(255)  CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['softness'] = "ALTER TABLE `artifacts` ADD `softness`  VARCHAR(255)  CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['counterclockwise'] = "ALTER TABLE `artifacts` ADD `counterclockwise`  VARCHAR(255)  CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['clockwiselimit'] = "ALTER TABLE `artifacts` ADD `clockwiselimit`  VARCHAR(255)  CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['topdownlimit'] = "ALTER TABLE `artifacts` ADD `topdownlimit`  VARCHAR(255)  CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['bottomuplimit'] = "ALTER TABLE `artifacts` ADD `bottomuplimit`  VARCHAR(255)  CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['doctitle'] = "ALTER TABLE `artifacts` ADD `doctitle`  VARCHAR(255)  CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['docauthor'] = "ALTER TABLE `artifacts` ADD `docauthor` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['doclink'] = "ALTER TABLE `artifacts` ADD `doclink` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['docdate'] = "ALTER TABLE `artifacts` ADD `docdate` INT NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['docifile'] = "ALTER TABLE `artifacts` ADD `docifile` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['docdescribe'] = "ALTER TABLE `artifacts` ADD `docdescribe` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['videotitle'] = "ALTER TABLE `artifacts` ADD `videotitle`  VARCHAR(255)  CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['videoauthor'] = "ALTER TABLE `artifacts` ADD `videoauthor` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['videolink'] = "ALTER TABLE `artifacts` ADD `videolink` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['videofile'] = "ALTER TABLE `artifacts` ADD `videofile` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['videodescribe'] = "ALTER TABLE `artifacts` ADD `videodescribe` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['presenttitle'] = "ALTER TABLE `artifacts` ADD `presenttitle`  VARCHAR(255)  CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['presentauthor'] = "ALTER TABLE `artifacts` ADD `presentauthor` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['presentlink'] = "ALTER TABLE `artifacts` ADD `presentlink` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['presentfile'] = "ALTER TABLE `artifacts` ADD `presentfile` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['presentdescribe'] = "ALTER TABLE `artifacts` ADD `presentdescribe` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['present'] = "ALTER TABLE `artifacts` ADD `present` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['doctype'] = "ALTER TABLE `artifacts` ADD `doctype` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['videotype'] = "ALTER TABLE `artifacts` ADD `videotype` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['presenttype'] = "ALTER TABLE `artifacts` ADD `presenttype` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['environmentimage'] = "ALTER TABLE `artifacts` ADD `environmentimage` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['backgroundcolor'] = "ALTER TABLE `artifacts` ADD `backgroundcolor` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['filegle'] = "ALTER TABLE `artifacts` ADD `filegle` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['fileusdz'] = "ALTER TABLE `artifacts` ADD `fileusdz` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['urlSlug'] = "ALTER TABLE `artifacts` ADD `urlSlug` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL; ";
$sqlUpdateDatabase['artifacts']['status'] = "ALTER TABLE `artifacts` ADD `status` TINYINT NULL DEFAULT NULL; ";