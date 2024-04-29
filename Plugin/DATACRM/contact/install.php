<?php
global $sqlInstallDatabase;
global $sqlDeleteDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';

$sqlInstallDatabase .= "
  CREATE TABLE IF NOT EXISTS contacts (
    id            INT NOT NULL AUTO_INCREMENT,
    name          VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    email         VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    phone_number  VARCHAR(50),
    subject       TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    content       TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    submitted_at  INT NOT NULL,
    PRIMARY KEY (id)
  );
";

$sqlDeleteDatabase .= "DROP TABLE contacts; ";
?>
