/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50525
Source Host           : localhost:3306
Source Database       : mysite

Target Server Type    : MYSQL
Target Server Version : 50525
File Encoding         : 65001

Date: 2017-07-15 13:33:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for account
-- ----------------------------
DROP TABLE IF EXISTS `account`;
CREATE TABLE `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `properties` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of account
-- ----------------------------

-- ----------------------------
-- Table structure for accountings
-- ----------------------------
DROP TABLE IF EXISTS `accountings`;
CREATE TABLE `accountings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT 'รายการ',
  `type_id` int(11) DEFAULT NULL COMMENT 'ประเภท',
  `customer_id` int(11) DEFAULT NULL COMMENT 'ลูกค้า',
  `amount` double DEFAULT NULL COMMENT 'ยอดเงิน',
  `pay` double DEFAULT NULL COMMENT 'ยอดชำระ',
  `ac_id` enum('i','o') DEFAULT NULL COMMENT 'ชนิด',
  `ac_date` date DEFAULT NULL COMMENT 'รอบทำบัญชี',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of accountings
-- ----------------------------

-- ----------------------------
-- Table structure for acdetail
-- ----------------------------
DROP TABLE IF EXISTS `acdetail`;
CREATE TABLE `acdetail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acmain_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL COMMENT 'ลูกค้า',
  `actype_id` int(11) DEFAULT NULL COMMENT 'รายการ/ประเภท',
  `inventory` varchar(255) DEFAULT NULL COMMENT 'ได้/เสีย',
  `amount` double(11,2) DEFAULT NULL COMMENT 'ยอดเงิน',
  `pay` double(11,2) DEFAULT NULL COMMENT 'ยอดชำระ',
  `amount_arrear` double(11,2) DEFAULT NULL COMMENT 'ยอดเงินรวมค้าง',
  `arrear` decimal(11,2) DEFAULT NULL COMMENT 'ค้างชำระ',
  `total_arrear` double(11,2) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL COMMENT 'หมายเหตุ',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of acdetail
-- ----------------------------

-- ----------------------------
-- Table structure for acmain
-- ----------------------------
DROP TABLE IF EXISTS `acmain`;
CREATE TABLE `acmain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `actype_id` int(11) DEFAULT NULL COMMENT 'รายการ/ประเภท',
  `ac_date` date DEFAULT NULL COMMENT 'รอบบัญชี',
  `user_id` int(11) DEFAULT NULL COMMENT 'ผู้บันทึก',
  `create_at` date DEFAULT NULL COMMENT 'วันที่บันทึก',
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of acmain
-- ----------------------------

-- ----------------------------
-- Table structure for banks
-- ----------------------------
DROP TABLE IF EXISTS `banks`;
CREATE TABLE `banks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT 'ธนาคาร',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of banks
-- ----------------------------
INSERT INTO `banks` VALUES ('1', 'กรุงไทย');
INSERT INTO `banks` VALUES ('2', 'กสิกร');

-- ----------------------------
-- Table structure for customers
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT 'ชื่อ-สกุล',
  `tel` varchar(255) DEFAULT NULL COMMENT 'เบอร์โทร',
  `addr` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ที่อยู่',
  `blank` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ธนาคาร',
  `book_no` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'เลขี่บัญชี',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES ('1', 'ไอน้ำ', '0913638928', 'บึงกาฬ', 'กรุงไทย', '12345678');
INSERT INTO `customers` VALUES ('2', 'สุภาพร', '0831234567', 'บึงกาฬ', 'กสิกร', '12345679');
INSERT INTO `customers` VALUES ('3', 'เด็กดอย', '0821112222', 'บึงกาฬ', 'กรุงไทย', '12345679');
INSERT INTO `customers` VALUES ('4', 'เด็กท้ายรถ', '0882323333', 'อุดรธานี', 'กสิกร', '222-333-555');

-- ----------------------------
-- Table structure for migration
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of migration
-- ----------------------------
INSERT INTO `migration` VALUES ('m000000_000000_base', '1489220821');
INSERT INTO `migration` VALUES ('m140209_132017_init', '1489220834');

-- ----------------------------
-- Table structure for profile
-- ----------------------------
DROP TABLE IF EXISTS `profile`;
CREATE TABLE `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `public_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of profile
-- ----------------------------
INSERT INTO `profile` VALUES ('1', null, null, null, null, null, null, null);
INSERT INTO `profile` VALUES ('2', null, null, null, null, null, null, null);

-- ----------------------------
-- Table structure for social_account
-- ----------------------------
DROP TABLE IF EXISTS `social_account`;
CREATE TABLE `social_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `data` text,
  `code` varchar(32) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_unique` (`provider`,`client_id`) USING BTREE,
  UNIQUE KEY `account_unique_code` (`code`) USING BTREE,
  KEY `fk_user_account` (`user_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of social_account
-- ----------------------------

-- ----------------------------
-- Table structure for token
-- ----------------------------
DROP TABLE IF EXISTS `token`;
CREATE TABLE `token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL,
  UNIQUE KEY `token_unique` (`user_id`,`code`,`type`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of token
-- ----------------------------
INSERT INTO `token` VALUES ('1', '1sWgFsExINpP4BqY1FxZvXk1cPABfFQa', '1489222102', '0');
INSERT INTO `token` VALUES ('2', 'LRyeXlfAtILVx5_UqvzqSIkOX82utdom', '1489378143', '0');

-- ----------------------------
-- Table structure for types
-- ----------------------------
DROP TABLE IF EXISTS `types`;
CREATE TABLE `types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT 'ประเภทรายการ',
  `detail` varchar(255) DEFAULT NULL COMMENT 'รายละเอียด',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of types
-- ----------------------------
INSERT INTO `types` VALUES ('1', 'ไก่ชน', 'การละเล่นพื้นเมือง');
INSERT INTO `types` VALUES ('2', 'ลีค-ใต้60', 'บอลลีคใต้ฤดูกาล2560');
INSERT INTO `types` VALUES ('3', 'ลีค-โตโยต้า60', 'บอลลีคโตโยต้าฤดูกาล2560');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `confirmation_token` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `confirmation_sent_at` int(11) DEFAULT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `recovery_token` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `recovery_sent_at` int(11) DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registered_from` int(11) DEFAULT NULL,
  `logged_in_from` int(11) DEFAULT NULL,
  `logged_in_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `last_login_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_unique_username` (`username`),
  UNIQUE KEY `user_unique_email` (`email`),
  UNIQUE KEY `user_confirmation` (`id`,`confirmation_token`),
  UNIQUE KEY `user_recovery` (`id`,`recovery_token`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', 'admin@localhost.com', '$2y$12$NxizgN9bsJhBmyI7LXKafuo7qjWL5hIKbmd2uq7EEuobvytxfue6S', 'rUvltpRC5INBJmyW9i6yQWPIHUlp-uod', null, null, null, null, null, null, null, '::1', null, null, null, '1489222102', '1489222102', '1492139617');
INSERT INTO `user` VALUES ('2', 'user', 'user@localhost.com', '$2y$12$M4GH.WtMBJSQqRkb.57ZnOvzAO2F.4FOTZ/VkrB368DXEfe5JZJaa', 'tw6jw4dnerxy0-Nc5VjaCvMbEjLWowFF', null, null, null, null, null, null, null, '::1', null, null, null, '1489378143', '1489378143', '1489378167');
