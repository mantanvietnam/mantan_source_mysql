<?php 
global $sqlInstallDatabase;
global $sqlDeleteDatabase;
global $sqlUpdateDatabase;

$sqlInstallDatabase = '';
$sqlDeleteDatabase = '';
$sqlUpdateDatabase = [];





$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='category_product'; ";
$sqlDeleteDatabase .= "DELETE FROM `categories` WHERE `type`='manufacturer_product'; ";

