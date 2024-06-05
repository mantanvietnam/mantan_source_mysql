<?php
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];

$sqlInstallDatabase .= "
  CREATE TABLE IF NOT EXISTS contacts (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `email` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `phone_number` VARCHAR(50),
    `subject` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `content` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `submitted_at`INT NOT NULL,
    PRIMARY KEY (id)
  );
";

$sqlDeleteDatabase .= "DROP TABLE contacts; ";

// Bang contacts
$sqlUpdateDatabase['contacts']['name'] = "ALTER TABLE `contacts` ADD `name` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['contacts']['email'] = "ALTER TABLE `contacts` ADD `email` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['contacts']['phone_number'] = "ALTER TABLE `contacts` ADD `phone_number` VARCHAR(50); ";
$sqlUpdateDatabase['contacts']['subject'] = "ALTER TABLE `contacts` ADD `subject` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['contacts']['content'] = "ALTER TABLE `contacts` ADD `content` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ";
$sqlUpdateDatabase['contacts']['submitted_at'] = "ALTER TABLE `contacts` ADD `submitted_at`INT NOT NULL; ";
?>
