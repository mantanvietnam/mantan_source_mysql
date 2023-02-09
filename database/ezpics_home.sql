-- Adminer 4.8.1 MySQL 5.5.5-10.5.11-MariaDB dump

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
  `parent` int(11) NOT NULL DEFAULT 0,
  `image` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `keyword` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `slug` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `categories` (`id`, `name`, `parent`, `image`, `keyword`, `description`, `type`, `slug`) VALUES
(2,	'Tin tức',	0,	'https://quayso.xyz/app/webroot/upload/admin/images/huong-dan-su-dung-phan-mem-quay-so-trung-thuong.jpg',	'ứng dụng chỉnh sửa ảnh',	'Website tổng hợp nhà cho thuê với đầy đủ thông tin và được cập nhập liên tục mỗi ngày',	'post',	''),
(4,	'Hoạt động chung',	0,	'',	'',	'',	'album',	''),
(5,	'Ngoại khóa',	0,	'',	'',	'',	'video',	''),
(16,	'Ảnh đại diện',	0,	'',	'',	'',	'ezpics',	'anh-dai-dien'),
(17,	'Ảnh bìa trang cá nhân',	0,	'',	'',	'',	'ezpics',	'anh-bia-trang-ca-nhan'),
(18,	'Banner Livestream',	0,	'',	'',	'',	'ezpics',	'banner-livestream'),
(19,	'Thư mời',	0,	'',	'',	'',	'ezpics',	'thu-moi'),
(20,	'Banner chào đón',	0,	'',	'',	'',	'ezpics',	'banner-chao-don');

DROP TABLE IF EXISTS `options`;
CREATE TABLE `options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key_word` varchar(255) NOT NULL,
  `value` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `version` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `options` (`id`, `key_word`, `value`, `version`) VALUES
(2,	'seo_site',	'{\"title\":\"Ezpics\",\"keyword\":\"\\u1ee9ng d\\u1ee5ng ch\\u1ec9nh s\\u1eeda \\u1ea3nh\",\"description\":\"\\u1ee8ng d\\u1ee5ng ch\\u1ec9nh s\\u1eeda \\u1ea3nh d\\u1ec5 d\\u00e0ng\",\"number_post\":\"11\",\"code_script\":\"<script>\\r\\n\\t\\t(function (i, s, o, g, r, a, m) {\\r\\n\\t\\t\\ti[\'GoogleAnalyticsObject\'] = r;\\r\\n\\t\\t\\ti[r] = i[r] || function () {\\r\\n\\t\\t\\t\\t(i[r].q = i[r].q || []).push(arguments)\\r\\n\\t\\t\\t}, i[r].l = 1 * new Date();\\r\\n\\t\\t\\ta = s.createElement(o),\\r\\n\\t\\t\\tm = s.getElementsByTagName(o)[0];\\r\\n\\t\\t\\ta.async = 1;\\r\\n\\t\\t\\ta.src = g;\\r\\n\\t\\t\\tm.parentNode.insertBefore(a, m)\\r\\n\\t\\t})(window, document, \'script\', \'https:\\/\\/www.google-analytics.com\\/analytics.js\', \'ga\');\\r\\n\\r\\n\\t\\tga(\'create\', \'UA-53034625-11\', \'auto\');\\r\\n\\t\\tga(\'send\', \'pageview\');\\r\\n\\r\\n\\t<\\/script>\"}',	NULL),
(3,	'contact_site',	'{\"phone\":\"0816560000\",\"email\":\"tranmanhbk179@gmail.com\",\"address\":\"46 ng\\u00f5 7 Th\\u00e1i H\\u00e0, \\u0110\\u1ed1ng \\u0110a, H\\u00e0 N\\u1ed9i\"}',	NULL),
(4,	'smtp_site',	'{\"email\":\"mantanhost@gmail.com\",\"pass\":\"tranngocmanh\",\"display_name\":\"Ezpics\",\"server\":\"ssl:\\/\\/smtp.gmail.com\",\"port\":\"465\"}',	NULL),
(5,	'plugins_site',	'[\"ezpics\"]',	NULL),
(6,	'theme_active_site',	'ezpics_mobile',	NULL),
(7,	'plugin_installed',	'[\"ezpics\"]',	NULL),
(8,	'theme_installed',	'[\"ezpics\"]',	NULL);

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
  `view` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 2022-08-29 14:42:22
