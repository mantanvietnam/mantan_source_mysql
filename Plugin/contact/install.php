<?php
global $sqlInstallDatabase;
global $sqlDeleteDatabase;

$tableName = "Contact";

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';

$sqlInstallDatabase .= "
CREATE TABLE IF NOT EXISTS $tableName (
  id            INT NOT NULL AUTO_INCREMENT,
  name          VARCHAR(50) NOT NULL,
  email         VARCHAR(50) NOT NULL,
  phone_number  VARCHAR(50),
  subject       TEXT,
  content       TEXT,
  submitted_at  DATETIME,
  PRIMARY KEY (id)
);
";

$sqlDeleteDatabase .= "DROP TABLE $tableName; ";
?>
