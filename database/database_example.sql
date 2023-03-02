-- Adminer 4.8.1 MySQL 5.7.34 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `fullName` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `admins` (`id`, `user`, `password`, `fullName`, `email`) VALUES
(1,	'admin',	'0192023a7bbd73250516f069df18b500',	'Trần Mạnh',	'tranmanhbk179@gmail.com');

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `image` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci,
  `keyword` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci,
  `description` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci,
  `type` varchar(255) NOT NULL,
  `slug` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `link` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `id_parent` int(11) NOT NULL,
  `weighty` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `options`;
CREATE TABLE `options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key_word` varchar(255) NOT NULL,
  `value` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `version` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `options` (`id`, `key_word`, `value`, `version`) VALUES
(2,	'seo_site',	'{\"title\":\"Mantan Source\",\"keyword\":\"\",\"description\":\"\",\"number_post\":\"10\",\"code_script\":\"\"}',	NULL),
(3,	'contact_site',	'{\"phone\":\"0816560000\",\"email\":\"tranmanhbk179@gmail.com\",\"address\":\"\"}',	NULL),
(4,	'smtp_site',	'{\"email\":\"mantansource@gmail.com\",\"pass\":\"mantansource\",\"display_name\":\"Mantan Source\",\"server\":\"ssl:\\/\\/smtp.gmail.com\",\"port\":\"465\"}',	NULL),
(5,	'plugins_site',	'[]',	NULL),
(6,	'theme_active_site',	'toptop',	NULL),
(7,	'plugin_installed',	'[]',	NULL),
(8,	'theme_installed',	'[\"toptop\"]',	NULL);

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `keyword` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `pin` tinyint(1) NOT NULL,
  `author` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `image` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `idCategory` int(11) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `slug` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `view` int(11) NOT NULL DEFAULT '0',
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `slugs`;
CREATE TABLE `slugs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) NOT NULL,
  `controller` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- 2023-02-25 17:27:06
