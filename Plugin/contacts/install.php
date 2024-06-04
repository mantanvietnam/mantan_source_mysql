<?php
	global $sqlInstallDatabase;
	global $sqlDeleteDatabase;

	$sqlInstallDatabase .= 'CREATE TABLE `contacts`(
		`id` INT(11) NOT NULL AUTO_INCREMENT,
		`name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
		`email` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
		`phone_number` VARCHAR(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
		`object` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
		`message` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
		PRIMARY KEY(`id`)
	) ENGINE = InnoDB;';
?>