-- Adminer 4.6.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE DATABASE `ci2` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ci2`;

DELIMITER ;;

DROP FUNCTION IF EXISTS `char_number`;;
CREATE FUNCTION `char_number`(`number` int, `digit` tinyint, `prefix` varchar(32)) RETURNS varchar(48) CHARSET latin1
    DETERMINISTIC
BEGIN
  DECLARE vreturn varchar(48);
  DECLARE i int(11);
  SET i = LENGTH(number);
  SET vreturn = "";
  WHILE i < digit DO
    SET vreturn = CONCAT("0", vreturn);
    SET i = i+1;
  END WHILE;
  SET vreturn = CONCAT(vreturn, number, prefix);
RETURN vreturn;
END;;

DELIMITER ;

DROP TABLE IF EXISTS `admin_groups`;
CREATE TABLE `admin_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `tag_name` varchar(64) NOT NULL,
  `description` varchar(100) NOT NULL,
  `layer_class` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `admin_groups` (`id`, `name`, `tag_name`, `description`, `layer_class`) VALUES
(1,	'webmaster',	'Webmaster Panel',	'Webmaster',	'skin-blue'),
(2,	'admin',	'Administrator Panel',	'Administrator',	'skin-blue'),
(3,	'manager',	'Manager Panel',	'Manager',	'skin-blue'),
(4,	'staff',	'Staff Panel',	'Staff',	'skin-blue');

DROP TABLE IF EXISTS `admin_groups_modules`;
CREATE TABLE `admin_groups_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` mediumint(8) unsigned NOT NULL,
  `module_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ug_id` (`group_id`),
  KEY `um_id` (`module_id`),
  CONSTRAINT `admin_groups_modules_ibfk_3` FOREIGN KEY (`group_id`) REFERENCES `admin_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `admin_groups_modules_ibfk_4` FOREIGN KEY (`module_id`) REFERENCES `admin_modules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `admin_groups_modules` (`id`, `group_id`, `module_id`) VALUES
(66,	1,	10),
(67,	1,	11),
(70,	1,	7),
(71,	1,	6),
(72,	1,	8),
(73,	1,	3),
(74,	1,	9),
(75,	1,	12),
(78,	1,	13),
(79,	1,	15),
(80,	1,	16),
(81,	1,	14),
(83,	1,	110),
(84,	1,	112),
(85,	1,	114),
(86,	1,	115),
(87,	1,	116),
(88,	1,	117);

DROP TABLE IF EXISTS `admin_login_attempts`;
CREATE TABLE `admin_login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `admin_modules`;
CREATE TABLE `admin_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(32) CHARACTER SET latin1 NOT NULL,
  `name` varchar(32) CHARACTER SET latin1 NOT NULL,
  `class` varchar(16) CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1 NOT NULL,
  `relation` int(3) NOT NULL DEFAULT '1',
  `col_order` int(11) NOT NULL DEFAULT '0',
  `stat_v` tinyint(1) NOT NULL DEFAULT '1',
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `admin_modules` (`id`, `url`, `name`, `class`, `description`, `relation`, `col_order`, `stat_v`, `required`, `status`) VALUES
(1,	'main',	'main',	'',	'',	1,	0,	1,	0,	0),
(2,	'logout',	'Keluar',	'fa-sign-out',	'',	2,	999,	1,	1,	1),
(3,	'profile/me',	'Profil',	'fa-lock',	'',	3,	998,	1,	0,	0),
(4,	'#',	'Settings',	'fa-gears',	'Menu untuk pengaturan\r\n',	4,	997,	1,	0,	1),
(5,	'#',	'Users',	'fa-users',	'Head of menu user',	4,	0,	1,	0,	1),
(6,	'settings/admin/users',	'List User',	'',	'',	5,	0,	1,	0,	1),
(7,	'settings/admin/users/create',	'Add User',	'fa-user-plus',	'',	5,	1,	1,	0,	1),
(8,	'settings/admin/users/read',	'View User',	'',	'',	5,	2,	0,	0,	1),
(9,	'settings/admin/users/edit',	'Manage User',	'',	'',	5,	3,	0,	0,	1),
(10,	'settings/admin/groups',	'Groups',	'',	'',	4,	1,	1,	0,	1),
(11,	'settings/admin/groups/add',	'Add Group',	'',	'',	10,	0,	0,	0,	1),
(12,	'settings/admin/groups/edit',	'Edit Group',	'',	'',	10,	1,	0,	0,	1),
(13,	'settings/admin/groups/delete',	'Delete Group',	'',	'',	10,	2,	0,	0,	1),
(14,	'settings/admin/modules',	'Modules',	'',	'Menu pengaturan hak akses group level terhadap module yang diakses',	4,	2,	1,	0,	1),
(15,	'settings/admin/modules/edit',	'Edit Module',	'',	'',	14,	1,	0,	0,	1),
(16,	'settings/admin/modules/add',	'Add Module',	'',	'',	14,	0,	0,	0,	1),
(76,	'#',	'Bank',	'fa-bank',	'',	76,	996,	1,	0,	1),
(78,	'bank/history',	'Transactions',	'',	'',	76,	0,	1,	0,	1),
(90,	'#',	'Settings',	'',	'Setting untuk Bank',	76,	99,	1,	0,	1),
(91,	'bank/setup/group_lists',	'Daftar Grup Transaksi',	'',	'',	90,	1,	1,	0,	1),
(92,	'bank/setup/groups/edit',	'Edit Grup Transaksi',	'',	'',	90,	3,	0,	0,	1),
(93,	'bank/setup/groups/add',	'Tambah Grup Transaksi',	'',	'',	90,	2,	0,	0,	1),
(94,	'bank/groups_history',	'Laporan Grup Transaksi',	'',	'',	90,	0,	1,	0,	1),
(109,	'settings/modules/delete',	'Delete Module',	'',	'',	14,	2,	1,	0,	0),
(110,	'test_hier/one',	'Question One',	'',	'',	111,	0,	1,	0,	1),
(111,	'#',	'Test PT Hier',	'',	'',	111,	0,	1,	0,	1),
(112,	'test_hier/two',	'Question Two',	'',	'',	111,	1,	1,	0,	1),
(113,	'test_hier/three',	'Question Three',	'',	'',	111,	2,	1,	0,	1),
(114,	'test_hier/three/topup',	'Topup',	'',	'',	113,	21,	1,	0,	1),
(115,	'test_hier/three/withdraw',	'Withdraw',	'',	'',	113,	22,	1,	0,	1),
(116,	'test_hier/three/transfer',	'Transfer',	'',	'',	113,	23,	1,	0,	1),
(117,	'test_hier/three/history',	'History',	'',	'',	113,	24,	1,	0,	1);

DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `admin_users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`) VALUES
(1,	'127.0.0.1',	'webmaster',	'$2y$08$JxSKAos7WKQ/Gi.k71P0yOo5sHmB4kuVvlS8tEWSiml.80QhjYdmy',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1451900190,	1548865325,	1,	'Webmaster',	''),
(2,	'127.0.0.1',	'admin',	'$2y$08$JIS.jMMDRVHQT7YYOS3EX.D/LoovZdDRWFFeVI7blKw/fKTt592R2',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1451900228,	1548001238,	1,	'Admin',	NULL),
(3,	'127.0.0.1',	'manager',	'$2y$08$snzIJdFXvg/rSHe0SndIAuvZyjktkjUxBXkrrGdkPy1K6r5r/dMLa',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1451900430,	1548123094,	1,	'Manager',	''),
(4,	'127.0.0.1',	'staff',	'$2y$08$NigAXjN23CRKllqe3KmjYuWXD5iSRPY812SijlhGeKfkrMKde9da6',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1451900439,	1548080541,	1,	'Staff',	''),
(5,	'127.0.0.1',	'instamaxv',	'$2y$08$.2u379m5O6eQaAnQR8AeVelhgehChh.b00yIQv5oWRAaoF4WQZzuO',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1547997063,	NULL,	1,	'insta',	'max');

DROP TABLE IF EXISTS `admin_users_groups`;
CREATE TABLE `admin_users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `group_id` (`group_id`),
  CONSTRAINT `admin_users_groups_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `admin_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `admin_users_groups_ibfk_5` FOREIGN KEY (`group_id`) REFERENCES `admin_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `admin_users_groups` (`id`, `user_id`, `group_id`) VALUES
(1,	1,	1),
(2,	2,	2),
(3,	3,	3),
(4,	4,	4),
(5,	5,	2);

DROP TABLE IF EXISTS `api_access`;
CREATE TABLE `api_access` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(40) NOT NULL DEFAULT '',
  `controller` varchar(50) NOT NULL DEFAULT '',
  `date_created` datetime DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `api_keys`;
CREATE TABLE `api_keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `is_private_key` tinyint(1) NOT NULL DEFAULT '0',
  `ip_addresses` text,
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `api_keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1,	0,	'anonymous',	1,	1,	0,	NULL,	1463388382);

DROP TABLE IF EXISTS `api_limits`;
CREATE TABLE `api_limits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uri` varchar(255) NOT NULL,
  `count` int(10) NOT NULL,
  `hour_started` int(11) NOT NULL,
  `api_key` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `api_logs`;
CREATE TABLE `api_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uri` varchar(255) NOT NULL,
  `method` varchar(6) NOT NULL,
  `params` text,
  `api_key` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` int(11) NOT NULL,
  `rtime` float DEFAULT NULL,
  `authorized` varchar(1) NOT NULL,
  `response_code` smallint(3) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `bank_logs`;
CREATE TABLE `bank_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bl_trxid` varchar(32) NOT NULL,
  `bl_bank` varchar(16) NOT NULL,
  `bl_norek` varchar(16) NOT NULL,
  `bl_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `bl_desc` text NOT NULL,
  `bl_debit` double(16,2) NOT NULL,
  `bl_credit` double(16,2) NOT NULL,
  PRIMARY KEY (`bl_trxid`),
  KEY `bl_trxid` (`bl_trxid`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `bank_logs` (`id`, `bl_trxid`, `bl_bank`, `bl_norek`, `bl_date`, `bl_desc`, `bl_debit`, `bl_credit`) VALUES
(19631,	'43211809300001',	'bni',	'987654321',	'2018-09-30 08:00:00',	'JASA GIRO/BUNGA',	0.00,	4486561.00),
(19632,	'43211809300002',	'bni',	'987654321',	'2018-09-30 08:00:00',	'PPH',	897313.00,	0.00),
(19633,	'43211809300003',	'bni',	'987654321',	'2018-09-30 08:00:00',	'BIAYA ADM REK',	25000.00,	0.00),
(20170,	'43211901300005',	'bni',	'987654321',	'2019-01-30 23:17:01',	'tes transfer',	0.00,	1000.00),
(20028,	'67891901030001',	'bri',	'123456789',	'2019-01-03 09:00:12',	'iBBIZ DAVEST IN TO MITRA',	0.00,	415000000.00),
(20029,	'67891901030002',	'bri',	'123456789',	'2019-01-03 09:00:12',	'iBBIZ MITRA AD TO GERBANG ',	415000000.00,	0.00),
(20030,	'67891901030003',	'bri',	'123456789',	'2019-01-03 09:00:12',	'iBBIZ DAVEST IN TO MITRA',	0.00,	170000000.00),
(20031,	'67891901030004',	'bri',	'123456789',	'2019-01-03 09:00:12',	'iBBIZ MITRA AD TO GERBANG ',	170000000.00,	0.00),
(20032,	'67891901030005',	'bri',	'123456789',	'2019-01-03 09:00:12',	'iBBIZ DAVEST IN TO MITRA',	0.00,	185000000.00),
(20165,	'67891901300001',	'bri',	'123456789',	'2019-01-30 09:00:12',	'iBBIZ MITRA AD TO GERBANG ',	170000000.00,	0.00),
(20166,	'67891901300002',	'bri',	'123456789',	'2019-01-30 23:02:10',	'tes',	0.00,	1234.00),
(20167,	'67891901300003',	'bri',	'123456789',	'2019-01-30 23:06:16',	'test',	0.00,	1000.00),
(20168,	'67891901300004',	'bri',	'123456789',	'2019-01-30 23:10:37',	'tes w',	1000.00,	0.00),
(20169,	'67891901300005',	'bri',	'123456789',	'2019-01-30 23:17:01',	'tes transfer',	1000.00,	0.00),
(19634,	'91231809300001',	'bni',	'456789123',	'2018-09-30 08:00:00',	'JASA GIRO/BUNGA',	0.00,	2485613.00),
(19635,	'91231809300002',	'bni',	'456789123',	'2018-09-30 08:00:00',	'PPH',	497123.00,	0.00),
(19636,	'91231809300003',	'bni',	'456789123',	'2018-09-30 08:00:00',	'BIAYA ADM REK',	25000.00,	0.00);

DROP TABLE IF EXISTS `blog_categories`;
CREATE TABLE `blog_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pos` int(11) NOT NULL DEFAULT '0',
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `blog_categories` (`id`, `pos`, `title`) VALUES
(1,	1,	'Category 1'),
(2,	2,	'Category 2'),
(3,	3,	'Category 3');

DROP TABLE IF EXISTS `blog_posts`;
CREATE TABLE `blog_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL DEFAULT '1',
  `author_id` int(11) NOT NULL,
  `title` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `image_url` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `content_brief` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `publish_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('draft','active','hidden') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'draft',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `blog_posts` (`id`, `category_id`, `author_id`, `title`, `image_url`, `content_brief`, `content`, `publish_time`, `status`) VALUES
(1,	1,	2,	'Blog Post 1',	'',	'<p>\r\n	Blog Post 1 Content Brief</p>\r\n',	'<p>\r\n	Blog Post 1 Content</p>\r\n',	'2015-09-25 17:00:00',	'active');

DROP TABLE IF EXISTS `blog_posts_tags`;
CREATE TABLE `blog_posts_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `blog_posts_tags` (`id`, `post_id`, `tag_id`) VALUES
(1,	1,	2),
(2,	1,	1),
(3,	1,	3);

DROP TABLE IF EXISTS `blog_tags`;
CREATE TABLE `blog_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `blog_tags` (`id`, `title`) VALUES
(1,	'Tag 1'),
(2,	'Tag 2'),
(3,	'Tag 3');

DROP TABLE IF EXISTS `cover_photos`;
CREATE TABLE `cover_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pos` int(11) NOT NULL DEFAULT '0',
  `image_url` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('active','hidden') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `cover_photos` (`id`, `pos`, `image_url`, `status`) VALUES
(1,	2,	'45296-2.jpg',	'active'),
(2,	1,	'2934f-1.jpg',	'active'),
(3,	3,	'3717d-3.jpg',	'active');

DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1,	'members',	'General User');

DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `about` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `about`) VALUES
(1,	'127.0.0.1',	'member',	'$2y$08$kkqUE2hrqAJtg.pPnAhvL.1iE7LIujK5LZ61arONLpaBBWh/ek61G',	NULL,	'member@member.com',	NULL,	NULL,	NULL,	NULL,	1451903855,	1451905011,	1,	'Member',	'One',	'test',	NULL,	NULL);

DROP TABLE IF EXISTS `users_groups`;
CREATE TABLE `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1,	1,	1),
(2,	2,	1);

-- 2019-01-30 16:22:32
