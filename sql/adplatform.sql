-- phpMyAdmin SQL Dump
-- version 2.11.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 01, 2011 at 03:19 AM
-- Server version: 5.0.45
-- PHP Version: 5.2.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `adplatform`
--

-- --------------------------------------------------------

--
-- Table structure for table `be_acl_actions`
--

CREATE TABLE IF NOT EXISTS `be_acl_actions` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(254) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `be_acl_actions`
--


-- --------------------------------------------------------

--
-- Table structure for table `be_acl_groups`
--

CREATE TABLE IF NOT EXISTS `be_acl_groups` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `lft` int(10) unsigned NOT NULL default '0',
  `rgt` int(10) unsigned NOT NULL default '0',
  `name` varchar(254) NOT NULL,
  `link` int(10) unsigned default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `lft` (`lft`),
  KEY `rgt` (`rgt`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `be_acl_groups`
--

INSERT INTO `be_acl_groups` (`id`, `lft`, `rgt`, `name`, `link`) VALUES
(1, 1, 4, 'Member', NULL),
(2, 2, 3, 'Administrator', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `be_acl_permissions`
--

CREATE TABLE IF NOT EXISTS `be_acl_permissions` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `aro_id` int(10) unsigned NOT NULL default '0',
  `aco_id` int(10) unsigned NOT NULL default '0',
  `allow` char(1) default NULL,
  PRIMARY KEY  (`id`),
  KEY `aro_id` (`aro_id`),
  KEY `aco_id` (`aco_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `be_acl_permissions`
--

INSERT INTO `be_acl_permissions` (`id`, `aro_id`, `aco_id`, `allow`) VALUES
(1, 2, 1, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `be_acl_permission_actions`
--

CREATE TABLE IF NOT EXISTS `be_acl_permission_actions` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `access_id` int(10) unsigned NOT NULL default '0',
  `axo_id` int(10) unsigned NOT NULL default '0',
  `allow` char(1) default NULL,
  PRIMARY KEY  (`id`),
  KEY `access_id` (`access_id`),
  KEY `axo_id` (`axo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `be_acl_permission_actions`
--


-- --------------------------------------------------------

--
-- Table structure for table `be_acl_resources`
--

CREATE TABLE IF NOT EXISTS `be_acl_resources` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `lft` int(10) unsigned NOT NULL default '0',
  `rgt` int(10) unsigned NOT NULL default '0',
  `name` varchar(254) NOT NULL,
  `link` int(10) unsigned default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `lft` (`lft`),
  KEY `rgt` (`rgt`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `be_acl_resources`
--

INSERT INTO `be_acl_resources` (`id`, `lft`, `rgt`, `name`, `link`) VALUES
(1, 1, 22, 'Site', NULL),
(2, 2, 21, 'Control Panel', NULL),
(3, 3, 20, 'System', NULL),
(4, 14, 15, 'Members', NULL),
(5, 4, 13, 'Access Control', NULL),
(6, 16, 17, 'Settings', NULL),
(7, 18, 19, 'Utilities', NULL),
(8, 11, 12, 'Permissions', NULL),
(9, 9, 10, 'Groups', NULL),
(10, 7, 8, 'Resources', NULL),
(11, 5, 6, 'Actions', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `be_ad_session`
--

CREATE TABLE IF NOT EXISTS `be_ad_session` (
  `id` bigint(20) NOT NULL auto_increment,
  `adsessid` varchar(40) NOT NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `cpn_id` bigint(20) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `landing_uri` varchar(255) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `position` varchar(70) NOT NULL,
  `device` varchar(45) NOT NULL default 'generic',
  `user_agent` varchar(255) NOT NULL,
  `ua_width` int(11) NOT NULL,
  `ua_height` int(11) NOT NULL,
  `req_width` int(11) NOT NULL,
  `req_height` int(11) NOT NULL,
  `msisdn` varchar(35) NOT NULL,
  `clicked` tinyint(2) NOT NULL,
  `click_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `be_ad_session`
--

INSERT INTO `be_ad_session` (`id`, `adsessid`, `timestamp`, `cpn_id`, `image_name`, `landing_uri`, `user_id`, `position`, `device`, `user_agent`, `ua_width`, `ua_height`, `req_width`, `req_height`, `msisdn`, `clicked`, `click_time`) VALUES
(1, 'HZOEf', '2011-06-15 15:39:49', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', '', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.100 Safari/534.30', 0, 0, 0, 0, '', 0, '0000-00-00 00:00:00'),
(2, '75Ps8', '2011-06-15 15:45:29', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', '', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.100 Safari/534.30', 0, 0, 0, 0, '', 0, '0000-00-00 00:00:00'),
(3, 'z8Xau', '2011-06-15 15:45:39', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', '', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.100 Safari/534.30', 0, 0, 0, 0, '', 0, '0000-00-00 00:00:00'),
(4, 'EUFRl', '2011-06-15 15:58:08', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', '', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.100 Safari/534.30', 0, 0, 0, 0, '', 1, '0000-00-00 00:00:00'),
(5, 'WPvNR', '2011-06-15 16:04:02', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', '', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.100 Safari/534.30', 0, 0, 0, 0, '', 0, '0000-00-00 00:00:00'),
(6, '6JHX6', '2011-06-15 16:05:09', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', '', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.100 Safari/534.30', 0, 0, 0, 0, '', 1, '0000-00-00 00:00:00'),
(7, 'URAOw', '2011-06-15 16:05:15', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', '', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.100 Safari/534.30', 0, 0, 0, 0, '', 1, '0000-00-00 00:00:00'),
(8, 'NKRsr', '2011-06-15 16:06:01', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', '', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.100 Safari/534.30', 0, 0, 0, 0, '', 1, '0000-00-00 00:00:00'),
(9, 'F88NM', '2011-06-15 16:10:21', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', '', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.100 Safari/534.30', 0, 0, 0, 0, '', 1, '0000-00-00 00:00:00'),
(10, 'sHOV9', '2011-06-15 16:10:28', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', '', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.100 Safari/534.30', 0, 0, 0, 0, '', 1, '0000-00-00 00:00:00'),
(11, 'vNhf3', '2011-06-15 16:17:29', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', '', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.100 Safari/534.30', 0, 0, 0, 0, '', 0, '0000-00-00 00:00:00'),
(12, 'ID6gT', '2011-06-15 16:19:06', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', '', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.100 Safari/534.30', 0, 0, 0, 0, '', 0, '0000-00-00 00:00:00'),
(13, 'cbGKE', '2011-06-15 16:19:17', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', '', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.100 Safari/534.30', 0, 0, 0, 0, '', 0, '0000-00-00 00:00:00'),
(14, 'BLwFc', '2011-06-15 16:19:30', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', '', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.100 Safari/534.30', 0, 0, 0, 0, '', 1, '0000-00-00 00:00:00'),
(15, 'iMeLC', '2011-06-15 16:20:00', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', '', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.100 Safari/534.30', 0, 0, 0, 0, '', 0, '0000-00-00 00:00:00'),
(16, 'o4Mrv', '2011-06-15 21:58:31', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', '', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.100 Safari/534.30', 0, 0, 0, 0, '', 0, '0000-00-00 00:00:00'),
(17, 'o4Mrv', '2011-06-15 21:59:07', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', '', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.100 Safari/534.30', 0, 0, 0, 0, '', 0, '0000-00-00 00:00:00'),
(18, 'o4Mrv', '2011-06-15 21:59:10', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', '', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.100 Safari/534.30', 0, 0, 0, 0, '', 0, '0000-00-00 00:00:00'),
(19, 'o4Mrv', '2011-06-15 21:59:14', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', '', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.100 Safari/534.30', 0, 0, 0, 0, '', 0, '0000-00-00 00:00:00'),
(20, 'ZtCae', '2011-06-27 12:54:18', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', 'generic', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0', 0, 0, 0, 0, '', 0, '0000-00-00 00:00:00'),
(21, 'cEkJO', '2011-06-27 12:56:01', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', 'generic', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0', 0, 0, 0, 0, '', 0, '0000-00-00 00:00:00'),
(22, 'Jhjsr', '2011-06-27 12:56:26', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', 'generic', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0', 0, 0, 0, 0, '', 0, '0000-00-00 00:00:00'),
(23, 'nhmrS', '2011-06-27 12:57:35', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', 'generic', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0', 0, 0, 0, 0, '', 0, '0000-00-00 00:00:00'),
(24, '67Ckr', '2011-06-29 22:48:01', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', 'generic', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0', 0, 0, 0, 0, '', 0, '0000-00-00 00:00:00'),
(25, 'h57YJ', '2011-06-29 22:52:40', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', 'generic', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0', 0, 0, 0, 0, '', 0, '0000-00-00 00:00:00'),
(26, 'A3OnW', '2011-06-29 22:54:13', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', 'generic', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0', 0, 0, 0, 0, '', 0, '0000-00-00 00:00:00'),
(27, 'U37Kj', '2011-06-29 22:55:07', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', 'generic', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0', 0, 0, 0, 0, '', 0, '0000-00-00 00:00:00'),
(28, 'HEfrF', '2011-06-29 22:55:45', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', 'generic', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0', 0, 0, 0, 0, '', 0, '0000-00-00 00:00:00'),
(29, 'payC6', '2011-06-29 23:03:30', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', 'generic', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0', 0, 0, 0, 0, '', 0, '0000-00-00 00:00:00'),
(30, 'oxcT9', '2011-06-29 23:05:46', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', 'generic', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0', 0, 0, 0, 0, '', 0, '0000-00-00 00:00:00'),
(31, 'eQuXb', '2011-06-29 23:10:01', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', 'generic', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0', 0, 0, 0, 0, '', 0, '0000-00-00 00:00:00'),
(32, 'lFnze', '2011-06-29 23:11:39', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', 'generic', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0', 0, 0, 0, 0, '', 0, '0000-00-00 00:00:00'),
(33, 'clvNL', '2011-06-29 23:12:57', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', 'generic', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0', 0, 0, 0, 0, '', 0, '0000-00-00 00:00:00'),
(34, 'VwxCj', '2011-06-29 23:18:51', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', 'generic', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0', 0, 0, 0, 0, '', 0, '0000-00-00 00:00:00'),
(35, 'LIkEF', '2011-06-29 23:19:54', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', 'generic', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0', 0, 0, 0, 0, '', 0, '0000-00-00 00:00:00'),
(36, 'cHCcl', '2011-06-29 23:20:33', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', 'generic', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0', 0, 0, 0, 0, '', 0, '0000-00-00 00:00:00'),
(37, 'cYzJq', '2011-06-29 23:26:02', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', 'generic', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0', 0, 0, 0, 0, '', 0, '0000-00-00 00:00:00'),
(38, 'zhMbb', '2011-06-29 23:27:23', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', 'generic', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0', 0, 0, 0, 0, '', 0, '0000-00-00 00:00:00'),
(39, 'yAMr2', '2011-06-29 23:38:29', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', 'generic', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0', 0, 0, 0, 0, '', 0, '0000-00-00 00:00:00'),
(40, '3zv8Y', '2011-06-29 23:41:33', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', 'generic', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0', 0, 0, 0, 0, '', 0, '0000-00-00 00:00:00'),
(41, 'wgPx8', '2011-06-30 00:14:30', 1, 'default_banner.jpg', 'http://www.bigjava.com', 2, 'top', 'generic', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0', 0, 0, 0, 0, '', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `be_banners`
--

CREATE TABLE IF NOT EXISTS `be_banners` (
  `id` bigint(20) NOT NULL auto_increment,
  `filename` varchar(128) NOT NULL,
  `filetype` varchar(128) NOT NULL,
  `campaign_id` bigint(20) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `be_banners`
--

INSERT INTO `be_banners` (`id`, `filename`, `filetype`, `campaign_id`, `width`, `height`) VALUES
(1, '1_112_20.jpg', '.jpg', 1, 112, 20),
(2, '1_167_30.jpg', '.jpg', 1, 167, 30),
(3, '1_215_34.jpg', '.jpg', 1, 215, 34),
(4, '1_305_84.jpg', '.jpg', 1, 305, 84),
(5, '1_215_34.jpg', '.jpg', 1, 215, 34),
(6, '9_112_20.jpg', '.jpg', 9, 112, 20),
(7, '9_215_34.jpg', '.jpg', 9, 215, 34),
(8, '10_112_20.jpg', '.jpg', 10, 112, 20),
(9, '10_167_30.jpg', '.jpg', 10, 167, 30),
(10, '10_215_34.jpg', '.jpg', 10, 215, 34),
(11, '10_305_84.jpg', '.jpg', 10, 305, 84);

-- --------------------------------------------------------

--
-- Table structure for table `be_banner_sizes`
--

CREATE TABLE IF NOT EXISTS `be_banner_sizes` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `is_default` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `be_banner_sizes`
--

INSERT INTO `be_banner_sizes` (`id`, `name`, `width`, `height`, `created`, `modified`, `is_default`) VALUES
(1, 'Extra Small', 112, 20, '2011-06-13 11:09:17', '0000-00-00 00:00:00', 1),
(2, 'Small', 167, 30, '2011-06-13 11:09:17', '0000-00-00 00:00:00', 0),
(3, 'Medium', 215, 34, '2011-06-13 11:09:17', '0000-00-00 00:00:00', 0),
(4, 'Large', 305, 84, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `be_campaign`
--

CREATE TABLE IF NOT EXISTS `be_campaign` (
  `id` bigint(20) NOT NULL auto_increment,
  `company_id` varchar(255) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `cpn_name` varchar(255) NOT NULL,
  `cpn_start` date NOT NULL,
  `cpn_end` date NOT NULL,
  `cpn_time_start` time NOT NULL,
  `cpn_time_end` time NOT NULL,
  `allday` tinyint(4) NOT NULL,
  `cpn_landing_uri` varchar(255) NOT NULL,
  `campaign_id` varchar(40) NOT NULL,
  `color` varchar(15) NOT NULL default 'orange',
  `datecreated` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `active` tinyint(1) NOT NULL default '1',
  `domain` varchar(25) NOT NULL default 'all',
  `top_url` text NOT NULL,
  `url_exclude` text NOT NULL,
  `url_include` text NOT NULL,
  `url_specific` text NOT NULL,
  `browser` varchar(25) NOT NULL default 'all',
  `browser_exclude` text NOT NULL,
  `browser_include` text NOT NULL,
  `browser_specific` text NOT NULL,
  `order_impression` double NOT NULL,
  `order_click` double NOT NULL,
  `actual_impression` double NOT NULL,
  `actual_click` double NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `be_campaign`
--

INSERT INTO `be_campaign` (`id`, `company_id`, `user_id`, `cpn_name`, `cpn_start`, `cpn_end`, `cpn_time_start`, `cpn_time_end`, `allday`, `cpn_landing_uri`, `campaign_id`, `color`, `datecreated`, `modified`, `active`, `domain`, `top_url`, `url_exclude`, `url_include`, `url_specific`, `browser`, `browser_exclude`, `browser_include`, `browser_specific`, `order_impression`, `order_click`, `actual_impression`, `actual_click`) VALUES
(1, '', 2, 'Not A Coffin Campaign', '2011-06-18', '2011-06-30', '00:00:00', '00:00:00', 0, '0', '00012345', '#fff100', '2011-06-08 00:00:00', '2011-06-22 00:15:29', 0, 'specific', '', 'kominfo.go.id', 'www.google.com', '', 'specific', 'IE', 'Android,iphone', '', 12000, 10200, 30, 3),
(2, '', 2, 'Test Campaign', '2011-06-11', '2011-06-30', '06:00:00', '19:00:00', 0, '0', 'g1234677', '#fff100', '2011-06-09 11:51:57', '2011-06-22 00:25:13', 0, '1', '', '', '', '', '', '', '', '', 0, 0, 0, 0),
(4, '', 2, 'Test Campaign Lagi', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00', 0, 'http://www.google.com/dddd', '1312431231', '0', '2011-06-09 12:13:37', '2011-06-13 13:19:19', 0, '1', '', '', '', '', '', '', '', '', 0, 0, 0, 0),
(5, '', 2, 'Pake Warna', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00', 0, 'http://www.google.com', '213214124', '#778899', '2011-06-09 13:57:31', '0000-00-00 00:00:00', 1, '1', '', '', '', '', '', '', '', '', 0, 0, 0, 0),
(6, '', 2, 'New Campaign', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00', 0, 'http://www.bigjava.com', '08089797969', 'orange', '2011-06-13 13:46:24', '2011-06-13 13:58:51', 1, '1', '', '', '', '', '', '', '', '', 0, 0, 0, 0),
(7, '', 2, 'c1234', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00', 0, 'http://www.bigjava.com', '256788', 'orange', '2011-06-13 14:21:49', '0000-00-00 00:00:00', 1, '1', '', '', '', '', '', '', '', '', 0, 0, 0, 0),
(8, '', 1, 'FirstCampaign', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00', 0, 'http://www.google.com', '097867867', 'orange', '2011-06-14 10:54:14', '2011-06-14 10:58:28', 1, '1', '', '', '', '', '', '', '', '', 0, 0, 0, 0),
(9, '', 2, 'Hello Campaign', '2011-06-16', '2011-06-03', '03:00:00', '09:00:00', 0, '0', '79878678', '#707070', '2011-06-21 14:03:41', '2011-06-21 19:17:23', 0, 'all', '', '', '', '', 'all', '', '', '', 0, 0, 0, 0),
(10, '', 2, 'New Campaign on Oreo', '2011-06-01', '2011-06-11', '00:00:00', '03:00:00', 0, '0', '12313213', '#9d0a0f', '2011-06-21 23:55:04', '2011-06-22 16:15:43', 0, 'all', '', '', '', '', 'all', '', '', '', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `be_campaign_schedules`
--

CREATE TABLE IF NOT EXISTS `be_campaign_schedules` (
  `id` bigint(20) NOT NULL auto_increment,
  `sch_id` bigint(20) NOT NULL,
  `campaign_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `company_id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `color` varchar(35) NOT NULL,
  `cpn_id` varchar(128) NOT NULL,
  `cpn_start` date NOT NULL,
  `cpn_end` date NOT NULL,
  `cpn_time_start` time NOT NULL,
  `cpn_time_end` time NOT NULL,
  `allday` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `be_campaign_schedules`
--

INSERT INTO `be_campaign_schedules` (`id`, `sch_id`, `campaign_id`, `user_id`, `company_id`, `title`, `color`, `cpn_id`, `cpn_start`, `cpn_end`, `cpn_time_start`, `cpn_time_end`, `allday`) VALUES
(1, 0, 10, 2, 0, 'New Campaign on Oreo', '#6ccff7', '12313213', '2011-06-01', '2011-06-04', '06:00:00', '13:00:00', 0),
(2, 0, 10, 2, 0, 'New Campaign on Oreo', '#6ccff7', '12313213', '2011-06-24', '2011-06-26', '06:00:00', '13:00:00', 1),
(3, 0, 10, 2, 0, 'New Campaign on Oreo', '#ee1d24', '12313213', '2011-06-24', '2011-06-26', '11:00:00', '19:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `be_company`
--

CREATE TABLE IF NOT EXISTS `be_company` (
  `id` bigint(20) NOT NULL auto_increment,
  `company_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(40) NOT NULL,
  `fax` varchar(40) NOT NULL,
  `zip` varchar(25) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `be_company`
--

INSERT INTO `be_company` (`id`, `company_name`, `address`, `phone`, `fax`, `zip`, `city`, `country`) VALUES
(1, 'BigJava', 'Cikajang', '6221123566789', '6221123566789', '1280808', 'Jakarta', 'Indonesia');

-- --------------------------------------------------------

--
-- Table structure for table `be_domain_pos`
--

CREATE TABLE IF NOT EXISTS `be_domain_pos` (
  `id` bigint(20) NOT NULL auto_increment,
  `toplevelhost` varchar(255) NOT NULL,
  `pos` varchar(10) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `be_domain_pos`
--

INSERT INTO `be_domain_pos` (`id`, `toplevelhost`, `pos`, `created`, `modified`) VALUES
(1, 'google.com', 'none', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'yahoo.com', 'top', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'bigjava.com', 'bottom', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'google.co.id', 'both', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `be_groups`
--

CREATE TABLE IF NOT EXISTS `be_groups` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `locked` tinyint(1) unsigned NOT NULL default '0',
  `disabled` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `be_groups`
--

INSERT INTO `be_groups` (`id`, `locked`, `disabled`) VALUES
(1, 1, 0),
(2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `be_preferences`
--

CREATE TABLE IF NOT EXISTS `be_preferences` (
  `name` varchar(254) character set latin1 NOT NULL,
  `value` text character set latin1 NOT NULL,
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `be_preferences`
--

INSERT INTO `be_preferences` (`name`, `value`) VALUES
('default_user_group', '1'),
('smtp_host', ''),
('keep_error_logs_for', '30'),
('email_protocol', 'sendmail'),
('use_registration_captcha', '0'),
('page_debug', '0'),
('automated_from_name', 'BackendPro'),
('allow_user_registration', '1'),
('use_login_captcha', '0'),
('site_name', 'BigJava Ad Platform'),
('automated_from_email', 'noreply@backendpro.co.uk'),
('account_activation_time', '7'),
('allow_user_profiles', '1'),
('activation_method', 'none'),
('autologin_period', '30'),
('min_password_length', '8'),
('smtp_user', ''),
('smtp_pass', ''),
('email_mailpath', '/usr/sbin/sendmail'),
('smtp_port', '25'),
('smtp_timeout', '5'),
('email_wordwrap', '1'),
('email_wrapchars', '76'),
('email_mailtype', 'text'),
('email_charset', 'utf-8'),
('bcc_batch_mode', '0'),
('bcc_batch_size', '200'),
('login_field', 'username');

-- --------------------------------------------------------

--
-- Table structure for table `be_resources`
--

CREATE TABLE IF NOT EXISTS `be_resources` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `locked` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `be_resources`
--

INSERT INTO `be_resources` (`id`, `locked`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `be_top_domain`
--

CREATE TABLE IF NOT EXISTS `be_top_domain` (
  `id` bigint(20) NOT NULL auto_increment,
  `domain` text NOT NULL,
  `created` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `be_top_domain`
--

INSERT INTO `be_top_domain` (`id`, `domain`, `created`, `modified`) VALUES
(1, 'http://www.google.com', '2011-06-15 01:15:45', '0000-00-00 00:00:00'),
(2, 'http://www.yahoo.com', '2011-06-15 01:15:45', '2011-07-01 02:01:36'),
(3, 'http://www.microsoft.com', '2011-06-15 01:15:45', '0000-00-00 00:00:00'),
(4, 'http://www.telkomsel.com', '2011-06-15 01:15:45', '0000-00-00 00:00:00'),
(5, 'http://www.gmail.com', '2011-06-15 01:15:45', '0000-00-00 00:00:00'),
(6, 'http://www.bigjava.com', '2011-06-15 01:15:45', '2011-07-01 02:01:52');

-- --------------------------------------------------------

--
-- Table structure for table `be_ua_log`
--

CREATE TABLE IF NOT EXISTS `be_ua_log` (
  `id` bigint(20) NOT NULL auto_increment,
  `http_referer` text NOT NULL,
  `ua_text` text NOT NULL,
  `created` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `be_ua_log`
--

INSERT INTO `be_ua_log` (`id`, `http_referer`, `ua_text`, `created`) VALUES
(1, 'http://www.ipa.or.id/', 'REDIRECT_UNIQUE_ID:CxAb9ArTNwIAAAaIv@EAAAAJ\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:CxAb9ArTNwIAAAaIv@EAAAAJ\r\nHTTP_HOST:localhost\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.ipa.or.id/\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.91 Safari/534.30\r\nHTTP_ACCEPT:*/*\r\nHTTP_ACCEPT_ENCODING:gzip,deflate,sdch\r\nHTTP_ACCEPT_LANGUAGE:en-US,en;q=0.8\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.3\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:60865\r\nREDIRECT_URL:/adplatform/ad/img/EiwK9\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/EiwK9\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/EiwK9\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/EiwK9\r\nPHP_SELF:/adplatform/index.php/ad/img/EiwK9\r\nREQUEST_TIME:1308122669', '2011-06-15 14:24:35'),
(2, 'http://googleads.g.doubleclick.net/pagead/ads?client=ca-pub-5545093415782783&output=html&h=600&slotname=4136143203&w=160&lmt=1301096129&flash=10.3.181&url=http%3A%2F%2Fgreasyspoon.sourceforge.net%2Fsample_js.html&dt=1308122765896&bpp=49&shv=r20110608&jsv=r20110607&correlator=1308122766365&frm=4&adk=3885105070&ga_vid=993970324.1308122766&ga_sid=1308122766&ga_hid=1541294636&ga_fc=0&u_tz=420&u_his=17&u_java=1&u_h=800&u_w=1280&u_ah=740&u_aw=1280&u_cd=24&u_nplug=14&u_nmime=146&biw=1249&bih=599&eid=36813005&ref=http%3A%2F%2Fgreasyspoon.sourceforge.net%2Fsamples.html&fu=0&ifi=1&dtd=619&xpc=uIfU0Lj2W1&p=http%3A//greasyspoon.sourceforge.net', 'REDIRECT_UNIQUE_ID:EOt1EgrTNwIAAAIF@ecAAAAG\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:EOt1EgrTNwIAAAIF@ecAAAAG\r\nHTTP_HOST:localhost\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://googleads.g.doubleclick.net/pagead/ads?client=ca-pub-5545093415782783&output=html&h=600&slotname=4136143203&w=160&lmt=1301096129&flash=10.3.181&url=http%3A%2F%2Fgreasyspoon.sourceforge.net%2Fsample_js.html&dt=1308122765896&bpp=49&shv=r20110608&jsv=r20110607&correlator=1308122766365&frm=4&adk=3885105070&ga_vid=993970324.1308122766&ga_sid=1308122766&ga_hid=1541294636&ga_fc=0&u_tz=420&u_his=17&u_java=1&u_h=800&u_w=1280&u_ah=740&u_aw=1280&u_cd=24&u_nplug=14&u_nmime=146&biw=1249&bih=599&eid=36813005&ref=http%3A%2F%2Fgreasyspoon.sourceforge.net%2Fsamples.html&fu=0&ifi=1&dtd=619&xpc=uIfU0Lj2W1&p=http%3A//greasyspoon.sourceforge.net\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.91 Safari/534.30\r\nHTTP_ACCEPT:*/*\r\nHTTP_ACCEPT_ENCODING:gzip,deflate,sdch\r\nHTTP_ACCEPT_LANGUAGE:en-US,en;q=0.8\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.3\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:60931\r\nREDIRECT_URL:/adplatform/ad/img/XgU6b\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/XgU6b\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/XgU6b\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/XgU6b\r\nPHP_SELF:/adplatform/index.php/ad/img/XgU6b\r\nREQUEST_TIME:1308122768', '2011-06-15 14:26:10'),
(3, 'http://greasyspoon.sourceforge.net/scripts_intro.html', 'REDIRECT_UNIQUE_ID:KxGzxwrTNwIAAAaBuT0AAAAH\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:KxGzxwrTNwIAAAaBuT0AAAAH\r\nHTTP_HOST:localhost\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://greasyspoon.sourceforge.net/scripts_intro.html\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.91 Safari/534.30\r\nHTTP_ACCEPT:*/*\r\nHTTP_ACCEPT_ENCODING:gzip,deflate,sdch\r\nHTTP_ACCEPT_LANGUAGE:en-US,en;q=0.8\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.3\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:61066\r\nREDIRECT_URL:/adplatform/ad/img\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img\r\nPHP_SELF:/adplatform/index.php/ad/img\r\nREQUEST_TIME:1308123206', '2011-06-15 14:33:30'),
(4, 'http://greasyspoon.sourceforge.net/scripts_control_header.html', 'REDIRECT_UNIQUE_ID:K9fguwrTNwIAAAaj4pcAAAAI\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:K9fguwrTNwIAAAaj4pcAAAAI\r\nHTTP_HOST:localhost\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://greasyspoon.sourceforge.net/scripts_control_header.html\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.91 Safari/534.30\r\nHTTP_ACCEPT:*/*\r\nHTTP_ACCEPT_ENCODING:gzip,deflate,sdch\r\nHTTP_ACCEPT_LANGUAGE:en-US,en;q=0.8\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.3\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:61071\r\nREDIRECT_URL:/adplatform/ad/img\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img\r\nPHP_SELF:/adplatform/index.php/ad/img\r\nREQUEST_TIME:1308123219', '2011-06-15 14:33:41'),
(5, 'http://www.ipa.or.id/', 'REDIRECT_UNIQUE_ID:h5P-DQrTNwIAAAaBuVQAAAAH\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:h5P-DQrTNwIAAAaBuVQAAAAH\r\nHTTP_HOST:localhost\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.ipa.or.id/\r\nHTTP_CACHE_CONTROL:max-age=0\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.91 Safari/534.30\r\nHTTP_ACCEPT:*/*\r\nHTTP_ACCEPT_ENCODING:gzip,deflate,sdch\r\nHTTP_ACCEPT_LANGUAGE:en-US,en;q=0.8\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.3\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:61510\r\nREDIRECT_URL:/adplatform/ad/img/b2mEX/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/b2mEX/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/b2mEX/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/b2mEX/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/b2mEX/generic\r\nREQUEST_TIME:1308124758', '2011-06-15 14:59:23'),
(6, 'http://www.ipa.or.id/', 'REDIRECT_UNIQUE_ID:lST1fArTNwIAAAIC98gAAAAE\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:lST1fArTNwIAAAIC98gAAAAE\r\nHTTP_HOST:localhost\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.ipa.or.id/\r\nHTTP_CACHE_CONTROL:max-age=0\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.91 Safari/534.30\r\nHTTP_ACCEPT:*/*\r\nHTTP_ACCEPT_ENCODING:gzip,deflate,sdch\r\nHTTP_ACCEPT_LANGUAGE:en-US,en;q=0.8\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.3\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:61633\r\nREDIRECT_URL:/adplatform/ad/img/hY6yV/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/hY6yV/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/hY6yV/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/hY6yV/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/hY6yV/generic\r\nREQUEST_TIME:1308124986', '2011-06-15 15:03:07'),
(7, 'http://www.google.co.id/', 'REDIRECT_UNIQUE_ID:D5s1pMCoAYQAAAHzFBgAAAAA\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:D5s1pMCoAYQAAAHzFBgAAAAA\r\nHTTP_HOST:localhost\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.google.co.id/\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.100 Safari/534.30\r\nHTTP_ACCEPT:*/*\r\nHTTP_ACCEPT_ENCODING:gzip,deflate,sdch\r\nHTTP_ACCEPT_LANGUAGE:en-US,en;q=0.8\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.3\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:49277\r\nREDIRECT_URL:/adplatform/ad/img/nJYOi/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/nJYOi/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/nJYOi/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/nJYOi/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/nJYOi/generic\r\nREQUEST_TIME:1308127041', '2011-06-15 15:37:22'),
(8, 'http://www.google.co.id/', 'REDIRECT_UNIQUE_ID:GGzlKcCoAYQAAAHzFBwAAAAA\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:GGzlKcCoAYQAAAHzFBwAAAAA\r\nHTTP_HOST:localhost\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.google.co.id/\r\nHTTP_CACHE_CONTROL:max-age=0\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.100 Safari/534.30\r\nHTTP_ACCEPT:*/*\r\nHTTP_ACCEPT_ENCODING:gzip,deflate,sdch\r\nHTTP_ACCEPT_LANGUAGE:en-US,en;q=0.8\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.3\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:49333\r\nREDIRECT_URL:/adplatform/ad/img/HZOEf/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/HZOEf/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/HZOEf/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/HZOEf/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/HZOEf/generic\r\nREQUEST_TIME:1308127189', '2011-06-15 15:39:49'),
(9, 'http://www.google.co.id/', 'REDIRECT_UNIQUE_ID:LK09KsCoAYQAAAH4F4YAAAAF\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:LK09KsCoAYQAAAH4F4YAAAAF\r\nHTTP_HOST:localhost\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.google.co.id/\r\nHTTP_CACHE_CONTROL:max-age=0\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.100 Safari/534.30\r\nHTTP_ACCEPT:*/*\r\nHTTP_ACCEPT_ENCODING:gzip,deflate,sdch\r\nHTTP_ACCEPT_LANGUAGE:en-US,en;q=0.8\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.3\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:49406\r\nREDIRECT_URL:/adplatform/ad/img/75Ps8/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/75Ps8/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/75Ps8/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/75Ps8/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/75Ps8/generic\r\nREQUEST_TIME:1308127528', '2011-06-15 15:45:29'),
(10, 'http://www.bigjava.com/', 'REDIRECT_UNIQUE_ID:LU7SacCoAYQAAAIAGfgAAAAI\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:LU7SacCoAYQAAAIAGfgAAAAI\r\nHTTP_HOST:localhost\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.bigjava.com/\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.100 Safari/534.30\r\nHTTP_ACCEPT:*/*\r\nHTTP_ACCEPT_ENCODING:gzip,deflate,sdch\r\nHTTP_ACCEPT_LANGUAGE:en-US,en;q=0.8\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.3\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:49488\r\nREDIRECT_URL:/adplatform/ad/img/z8Xau/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/z8Xau/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/z8Xau/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/z8Xau/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/z8Xau/generic\r\nREQUEST_TIME:1308127539', '2011-06-15 15:45:39'),
(11, 'http://www.google.co.id/', 'REDIRECT_UNIQUE_ID:WegT8cCoAYQAAAH6F4QAAAAH\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:WegT8cCoAYQAAAH6F4QAAAAH\r\nHTTP_HOST:localhost\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.google.co.id/\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.100 Safari/534.30\r\nHTTP_ACCEPT:*/*\r\nHTTP_ACCEPT_ENCODING:gzip,deflate,sdch\r\nHTTP_ACCEPT_LANGUAGE:en-US,en;q=0.8\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.3\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:49644\r\nREDIRECT_URL:/adplatform/ad/img/EUFRl/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/EUFRl/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/EUFRl/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/EUFRl/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/EUFRl/generic\r\nREQUEST_TIME:1308128287', '2011-06-15 15:58:08'),
(12, 'http://www.bigjava.com/', 'REDIRECT_UNIQUE_ID:bwyggMCoAYQAAAIAGfoAAAAI\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:bwyggMCoAYQAAAIAGfoAAAAI\r\nHTTP_HOST:localhost\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.bigjava.com/\r\nHTTP_CACHE_CONTROL:max-age=0\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.100 Safari/534.30\r\nHTTP_ACCEPT:*/*\r\nHTTP_ACCEPT_ENCODING:gzip,deflate,sdch\r\nHTTP_ACCEPT_LANGUAGE:en-US,en;q=0.8\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.3\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:49784\r\nREDIRECT_URL:/adplatform/ad/img/WPvNR/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/WPvNR/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/WPvNR/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/WPvNR/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/WPvNR/generic\r\nREQUEST_TIME:1308128642', '2011-06-15 16:04:02'),
(13, 'http://www.google.co.id/', 'REDIRECT_UNIQUE_ID:cwnITsCoAYQAAAH4F4gAAAAF\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:cwnITsCoAYQAAAH4F4gAAAAF\r\nHTTP_HOST:localhost\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.google.co.id/\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.100 Safari/534.30\r\nHTTP_ACCEPT:*/*\r\nHTTP_ACCEPT_ENCODING:gzip,deflate,sdch\r\nHTTP_ACCEPT_LANGUAGE:en-US,en;q=0.8\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.3\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:49951\r\nREDIRECT_URL:/adplatform/ad/img/6JHX6/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/6JHX6/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/6JHX6/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/6JHX6/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/6JHX6/generic\r\nREQUEST_TIME:1308128709', '2011-06-15 16:05:09'),
(14, 'http://www.bigjava.com/', 'REDIRECT_UNIQUE_ID:c2s7eMCoAYQAAAH4F4oAAAAF\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:c2s7eMCoAYQAAAH4F4oAAAAF\r\nHTTP_HOST:localhost\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.bigjava.com/\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.100 Safari/534.30\r\nHTTP_ACCEPT:*/*\r\nHTTP_ACCEPT_ENCODING:gzip,deflate,sdch\r\nHTTP_ACCEPT_LANGUAGE:en-US,en;q=0.8\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.3\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:49951\r\nREDIRECT_URL:/adplatform/ad/img/URAOw/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/URAOw/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/URAOw/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/URAOw/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/URAOw/generic\r\nREQUEST_TIME:1308128715', '2011-06-15 16:05:15'),
(15, 'http://www.bigjava.com/', 'REDIRECT_UNIQUE_ID:dh-1J8CoAYQAAAI5Z-gAAAAJ\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:dh-1J8CoAYQAAAI5Z-gAAAAJ\r\nHTTP_HOST:localhost\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.bigjava.com/\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.100 Safari/534.30\r\nHTTP_ACCEPT:*/*\r\nHTTP_ACCEPT_ENCODING:gzip,deflate,sdch\r\nHTTP_ACCEPT_LANGUAGE:en-US,en;q=0.8\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.3\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:49978\r\nREDIRECT_URL:/adplatform/ad/img/NKRsr/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/NKRsr/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/NKRsr/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/NKRsr/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/NKRsr/generic\r\nREQUEST_TIME:1308128761', '2011-06-15 16:06:01'),
(16, 'http://www.bigjava.com/', 'REDIRECT_UNIQUE_ID:haDlyMCoAYQAAAHzFCEAAAAA\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:haDlyMCoAYQAAAHzFCEAAAAA\r\nHTTP_HOST:localhost\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.bigjava.com/\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.100 Safari/534.30\r\nHTTP_ACCEPT:*/*\r\nHTTP_ACCEPT_ENCODING:gzip,deflate,sdch\r\nHTTP_ACCEPT_LANGUAGE:en-US,en;q=0.8\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.3\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:50010\r\nREDIRECT_URL:/adplatform/ad/img/F88NM/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/F88NM/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/F88NM/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/F88NM/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/F88NM/generic\r\nREQUEST_TIME:1308129021', '2011-06-15 16:10:21'),
(17, 'http://www.bigjava.com/', 'REDIRECT_UNIQUE_ID:hhTK7cCoAYQAAAHzFCMAAAAA\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:hhTK7cCoAYQAAAHzFCMAAAAA\r\nHTTP_HOST:localhost\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.bigjava.com/\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.100 Safari/534.30\r\nHTTP_ACCEPT:*/*\r\nHTTP_ACCEPT_ENCODING:gzip,deflate,sdch\r\nHTTP_ACCEPT_LANGUAGE:en-US,en;q=0.8\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.3\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:50193\r\nREDIRECT_URL:/adplatform/ad/img/sHOV9/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/sHOV9/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/sHOV9/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/sHOV9/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/sHOV9/generic\r\nREQUEST_TIME:1308129028', '2011-06-15 16:10:28'),
(18, 'http://www.bigjava.com/', 'REDIRECT_UNIQUE_ID:nyazZMCoAYQAAAH4F4wAAAAF\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:nyazZMCoAYQAAAH4F4wAAAAF\r\nHTTP_HOST:localhost\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.bigjava.com/\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.100 Safari/534.30\r\nHTTP_ACCEPT:*/*\r\nHTTP_ACCEPT_ENCODING:gzip,deflate,sdch\r\nHTTP_ACCEPT_LANGUAGE:en-US,en;q=0.8\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.3\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:50219\r\nREDIRECT_URL:/adplatform/ad/img/vNhf3/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/vNhf3/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/vNhf3/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/vNhf3/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/vNhf3/generic\r\nREQUEST_TIME:1308129449', '2011-06-15 16:17:29'),
(19, 'http://www.bigjava.com/', 'REDIRECT_UNIQUE_ID:pO9bf8CoAYQAAAH2FW0AAAAD\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:pO9bf8CoAYQAAAH2FW0AAAAD\r\nHTTP_HOST:localhost\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.bigjava.com/\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.100 Safari/534.30\r\nHTTP_ACCEPT:*/*\r\nHTTP_ACCEPT_ENCODING:gzip,deflate,sdch\r\nHTTP_ACCEPT_LANGUAGE:en-US,en;q=0.8\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.3\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:50232\r\nREDIRECT_URL:/adplatform/ad/img/ID6gT/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/ID6gT/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/ID6gT/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/ID6gT/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/ID6gT/generic\r\nREQUEST_TIME:1308129546', '2011-06-15 16:19:06'),
(20, 'http://www.bigjava.com/', 'REDIRECT_UNIQUE_ID:pY4@3sCoAYQAAAI4ZiIAAAAG\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:pY4@3sCoAYQAAAI4ZiIAAAAG\r\nHTTP_HOST:localhost\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.bigjava.com/\r\nHTTP_CACHE_CONTROL:max-age=0\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.100 Safari/534.30\r\nHTTP_ACCEPT:*/*\r\nHTTP_ACCEPT_ENCODING:gzip,deflate,sdch\r\nHTTP_ACCEPT_LANGUAGE:en-US,en;q=0.8\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.3\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:50416\r\nREDIRECT_URL:/adplatform/ad/img/cbGKE/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/cbGKE/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/cbGKE/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/cbGKE/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/cbGKE/generic\r\nREQUEST_TIME:1308129556', '2011-06-15 16:19:17'),
(21, 'http://www.bigjava.com/', 'REDIRECT_UNIQUE_ID:pmNVRcCoAYQAAAI5Z-kAAAAJ\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:pmNVRcCoAYQAAAI5Z-kAAAAJ\r\nHTTP_HOST:localhost\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.bigjava.com/\r\nHTTP_CACHE_CONTROL:max-age=0\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.100 Safari/534.30\r\nHTTP_ACCEPT:*/*\r\nHTTP_ACCEPT_ENCODING:gzip,deflate,sdch\r\nHTTP_ACCEPT_LANGUAGE:en-US,en;q=0.8\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.3\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:50588\r\nREDIRECT_URL:/adplatform/ad/img/BLwFc/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/BLwFc/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/BLwFc/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/BLwFc/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/BLwFc/generic\r\nREQUEST_TIME:1308129570', '2011-06-15 16:19:30'),
(22, 'http://www.bigjava.com/', 'REDIRECT_UNIQUE_ID:qCCtmcCoAYQAAAIvYwoAAAAB\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:qCCtmcCoAYQAAAIvYwoAAAAB\r\nHTTP_HOST:localhost\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.bigjava.com/\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.100 Safari/534.30\r\nHTTP_ACCEPT:*/*\r\nHTTP_ACCEPT_ENCODING:gzip,deflate,sdch\r\nHTTP_ACCEPT_LANGUAGE:en-US,en;q=0.8\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.3\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:50769\r\nREDIRECT_URL:/adplatform/ad/img/iMeLC/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/iMeLC/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/iMeLC/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/iMeLC/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/iMeLC/generic\r\nREQUEST_TIME:1308129599', '2011-06-15 16:20:00'),
(23, 'http://mailchimp.com/', 'REDIRECT_UNIQUE_ID:YsKaX8CoAYQAAAI5Z-oAAAAJ\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:YsKaX8CoAYQAAAI5Z-oAAAAJ\r\nHTTP_HOST:localhost\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://mailchimp.com/\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.100 Safari/534.30\r\nHTTP_ACCEPT:*/*\r\nHTTP_ACCEPT_ENCODING:gzip,deflate,sdch\r\nHTTP_ACCEPT_LANGUAGE:en-US,en;q=0.8\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.3\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:50816\r\nREDIRECT_URL:/adplatform/ad/img/o4Mrv/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/o4Mrv/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/o4Mrv/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/o4Mrv/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/o4Mrv/generic\r\nREQUEST_TIME:1308149911', '2011-06-15 21:58:31'),
(24, 'http://mailchimp.com/', 'REDIRECT_UNIQUE_ID:ZOgX28CoAYQAAAH3FgwAAAAE\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:ZOgX28CoAYQAAAH3FgwAAAAE\r\nHTTP_HOST:localhost\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://mailchimp.com/\r\nHTTP_CACHE_CONTROL:max-age=0\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.100 Safari/534.30\r\nHTTP_ACCEPT:*/*\r\nHTTP_ACCEPT_ENCODING:gzip,deflate,sdch\r\nHTTP_ACCEPT_LANGUAGE:en-US,en;q=0.8\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.3\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:50892\r\nREDIRECT_URL:/adplatform/ad/img/o4Mrv/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/o4Mrv/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/o4Mrv/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/o4Mrv/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/o4Mrv/generic\r\nREQUEST_TIME:1308149947', '2011-06-15 21:59:07'),
(25, 'http://mailchimp.com/', 'REDIRECT_UNIQUE_ID:ZR6SuMCoAYQAAAH3Fg0AAAAE\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:ZR6SuMCoAYQAAAH3Fg0AAAAE\r\nHTTP_HOST:localhost\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://mailchimp.com/\r\nHTTP_CACHE_CONTROL:max-age=0\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.100 Safari/534.30\r\nHTTP_ACCEPT:*/*\r\nHTTP_ACCEPT_ENCODING:gzip,deflate,sdch\r\nHTTP_ACCEPT_LANGUAGE:en-US,en;q=0.8\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.3\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:50892\r\nREDIRECT_URL:/adplatform/ad/img/o4Mrv/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/o4Mrv/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/o4Mrv/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/o4Mrv/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/o4Mrv/generic\r\nREQUEST_TIME:1308149950', '2011-06-15 21:59:10'),
(26, 'http://mailchimp.com/', 'REDIRECT_UNIQUE_ID:ZVoqysCoAYQAAAH3Fg4AAAAE\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:ZVoqysCoAYQAAAH3Fg4AAAAE\r\nHTTP_HOST:localhost\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://mailchimp.com/\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.100 Safari/534.30\r\nHTTP_ACCEPT:*/*\r\nHTTP_ACCEPT_ENCODING:gzip,deflate,sdch\r\nHTTP_ACCEPT_LANGUAGE:en-US,en;q=0.8\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.3\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:50892\r\nREDIRECT_URL:/adplatform/ad/img/o4Mrv/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/o4Mrv/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/o4Mrv/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/o4Mrv/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/o4Mrv/generic\r\nREQUEST_TIME:1308149954', '2011-06-15 21:59:14'),
(27, 'http://www.google.com/', 'REDIRECT_UNIQUE_ID:LpTfMsCoAYQAAAG5k-0AAAAF\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:LpTfMsCoAYQAAAG5k-0AAAAF\r\nHTTP_HOST:localhost\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0\r\nHTTP_ACCEPT:image/png,image/*;q=0.8,*/*;q=0.5\r\nHTTP_ACCEPT_LANGUAGE:en-us,en;q=0.5\r\nHTTP_ACCEPT_ENCODING:gzip, deflate\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.7\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.google.com/\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:49809\r\nREDIRECT_URL:/adplatform/ad/img/ZtCae/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/ZtCae/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/ZtCae/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/ZtCae/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/ZtCae/generic\r\nREQUEST_TIME:1309154057', '2011-06-27 12:54:18'),
(28, 'http://www.google.com/', 'REDIRECT_UNIQUE_ID:NMKLwsCoAYQAAAG@lbIAAAAK\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:NMKLwsCoAYQAAAG@lbIAAAAK\r\nHTTP_HOST:localhost\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0\r\nHTTP_ACCEPT:image/png,image/*;q=0.8,*/*;q=0.5\r\nHTTP_ACCEPT_LANGUAGE:en-us,en;q=0.5\r\nHTTP_ACCEPT_ENCODING:gzip, deflate\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.7\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.google.com/\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:50032\r\nREDIRECT_URL:/adplatform/ad/img/cEkJO/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/cEkJO/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/cEkJO/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/cEkJO/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/cEkJO/generic\r\nREQUEST_TIME:1309154161', '2011-06-27 12:56:01'),
(29, 'http://www.google.com/', 'REDIRECT_UNIQUE_ID:NjjC3MCoAYQAAAG7lRgAAAAH\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:NjjC3MCoAYQAAAG7lRgAAAAH\r\nHTTP_HOST:localhost\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0\r\nHTTP_ACCEPT:image/png,image/*;q=0.8,*/*;q=0.5\r\nHTTP_ACCEPT_LANGUAGE:en-us,en;q=0.5\r\nHTTP_ACCEPT_ENCODING:gzip, deflate\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.7\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.google.com/\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:50069\r\nREDIRECT_URL:/adplatform/ad/img/Jhjsr/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/Jhjsr/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/Jhjsr/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/Jhjsr/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/Jhjsr/generic\r\nREQUEST_TIME:1309154186', '2011-06-27 12:56:26'),
(30, 'http://www.google.com/', 'REDIRECT_UNIQUE_ID:OlxrCcCoAYQAAAKPGeYAAAAE\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:OlxrCcCoAYQAAAKPGeYAAAAE\r\nHTTP_HOST:localhost\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0\r\nHTTP_ACCEPT:image/png,image/*;q=0.8,*/*;q=0.5\r\nHTTP_ACCEPT_LANGUAGE:en-us,en;q=0.5\r\nHTTP_ACCEPT_ENCODING:gzip, deflate\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.7\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.google.com/\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:50094\r\nREDIRECT_URL:/adplatform/ad/img/nhmrS/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/nhmrS/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/nhmrS/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/nhmrS/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/nhmrS/generic\r\nREQUEST_TIME:1309154255', '2011-06-27 12:57:35'),
(31, 'http://www.bigjava.com/', 'REDIRECT_UNIQUE_ID:tZdv1QrTNwIAACKdArMAAAAB\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:tZdv1QrTNwIAACKdArMAAAAB\r\nHTTP_HOST:localhost\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0\r\nHTTP_ACCEPT:image/png,image/*;q=0.8,*/*;q=0.5\r\nHTTP_ACCEPT_LANGUAGE:en-us,en;q=0.5\r\nHTTP_ACCEPT_ENCODING:gzip, deflate\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.7\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.bigjava.com/\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:53726\r\nREDIRECT_URL:/adplatform/ad/img/67Ckr/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/67Ckr/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/67Ckr/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/67Ckr/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/67Ckr/generic\r\nREQUEST_TIME:1309362481', '2011-06-29 22:48:01'),
(32, 'http://www.bigjava.com/', 'REDIRECT_UNIQUE_ID:xjDTyArTNwIAACKgA-kAAAAE\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:xjDTyArTNwIAACKgA-kAAAAE\r\nHTTP_HOST:localhost\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0\r\nHTTP_ACCEPT:image/png,image/*;q=0.8,*/*;q=0.5\r\nHTTP_ACCEPT_LANGUAGE:en-us,en;q=0.5\r\nHTTP_ACCEPT_ENCODING:gzip, deflate\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.7\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.bigjava.com/\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:53828\r\nREDIRECT_URL:/adplatform/ad/img/h57YJ/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/h57YJ/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/h57YJ/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/h57YJ/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/h57YJ/generic\r\nREQUEST_TIME:1309362759', '2011-06-29 22:52:40'),
(33, 'http://www.bigjava.com/', 'REDIRECT_UNIQUE_ID:y72MXwrTNwIAACKdArQAAAAB\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:y72MXwrTNwIAACKdArQAAAAB\r\nHTTP_HOST:localhost\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0\r\nHTTP_ACCEPT:image/png,image/*;q=0.8,*/*;q=0.5\r\nHTTP_ACCEPT_LANGUAGE:en-us,en;q=0.5\r\nHTTP_ACCEPT_ENCODING:gzip, deflate\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.7\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.bigjava.com/\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:54023\r\nREDIRECT_URL:/adplatform/ad/img/A3OnW/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/A3OnW/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/A3OnW/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/A3OnW/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/A3OnW/generic\r\nREQUEST_TIME:1309362853', '2011-06-29 22:54:13'),
(34, 'http://www.bigjava.com/', 'REDIRECT_UNIQUE_ID:zv7OPgrTNwIAACKfA34AAAAD\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:zv7OPgrTNwIAACKfA34AAAAD\r\nHTTP_HOST:localhost\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0\r\nHTTP_ACCEPT:image/png,image/*;q=0.8,*/*;q=0.5\r\nHTTP_ACCEPT_LANGUAGE:en-us,en;q=0.5\r\nHTTP_ACCEPT_ENCODING:gzip, deflate\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.7\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.bigjava.com/\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:54211\r\nREDIRECT_URL:/adplatform/ad/img/U37Kj/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/U37Kj/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/U37Kj/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/U37Kj/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/U37Kj/generic\r\nREQUEST_TIME:1309362907', '2011-06-29 22:55:07'),
(35, 'http://www.bigjava.com/', 'REDIRECT_UNIQUE_ID:0T65ZQrTNwIAACKkBXkAAAAH\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:0T65ZQrTNwIAACKkBXkAAAAH\r\nHTTP_HOST:localhost\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0\r\nHTTP_ACCEPT:image/png,image/*;q=0.8,*/*;q=0.5\r\nHTTP_ACCEPT_LANGUAGE:en-us,en;q=0.5\r\nHTTP_ACCEPT_ENCODING:gzip, deflate\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.7\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.bigjava.com/\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:54415\r\nREDIRECT_URL:/adplatform/ad/img/HEfrF/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/HEfrF/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/HEfrF/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/HEfrF/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/HEfrF/generic\r\nREQUEST_TIME:1309362945', '2011-06-29 22:55:45');
INSERT INTO `be_ua_log` (`id`, `http_referer`, `ua_text`, `created`) VALUES
(36, 'http://www.bigjava.com/', 'REDIRECT_UNIQUE_ID:7PbQpQrTNwIAACKfA38AAAAD\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:7PbQpQrTNwIAACKfA38AAAAD\r\nHTTP_HOST:localhost\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0\r\nHTTP_ACCEPT:image/png,image/*;q=0.8,*/*;q=0.5\r\nHTTP_ACCEPT_LANGUAGE:en-us,en;q=0.5\r\nHTTP_ACCEPT_ENCODING:gzip, deflate\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.7\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.bigjava.com/\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:54772\r\nREDIRECT_URL:/adplatform/ad/img/payC6/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/payC6/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/payC6/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/payC6/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/payC6/generic\r\nREQUEST_TIME:1309363410', '2011-06-29 23:03:30'),
(37, 'http://www.bigjava.com/', 'REDIRECT_UNIQUE_ID:9RfGGArTNwIAACKkBXoAAAAH\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:9RfGGArTNwIAACKkBXoAAAAH\r\nHTTP_HOST:localhost\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0\r\nHTTP_ACCEPT:image/png,image/*;q=0.8,*/*;q=0.5\r\nHTTP_ACCEPT_LANGUAGE:en-us,en;q=0.5\r\nHTTP_ACCEPT_ENCODING:gzip, deflate\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.7\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.bigjava.com/\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:54982\r\nREDIRECT_URL:/adplatform/ad/img/oxcT9/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/oxcT9/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/oxcT9/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/oxcT9/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/oxcT9/generic\r\nREQUEST_TIME:1309363546', '2011-06-29 23:05:46'),
(38, 'http://www.bigjava.com/', 'REDIRECT_UNIQUE_ID:BERRsQrTNwIAACKkBXsAAAAH\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:BERRsQrTNwIAACKkBXsAAAAH\r\nHTTP_HOST:localhost\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0\r\nHTTP_ACCEPT:image/png,image/*;q=0.8,*/*;q=0.5\r\nHTTP_ACCEPT_LANGUAGE:en-us,en;q=0.5\r\nHTTP_ACCEPT_ENCODING:gzip, deflate\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.7\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.bigjava.com/\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:55556\r\nREDIRECT_URL:/adplatform/ad/img/eQuXb/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/eQuXb/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/eQuXb/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/eQuXb/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/eQuXb/generic\r\nREQUEST_TIME:1309363801', '2011-06-29 23:10:01'),
(39, 'http://www.bigjava.com/', 'REDIRECT_UNIQUE_ID:ChvavQrTNwIAACKdArcAAAAB\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:ChvavQrTNwIAACKdArcAAAAB\r\nHTTP_HOST:localhost\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0\r\nHTTP_ACCEPT:image/png,image/*;q=0.8,*/*;q=0.5\r\nHTTP_ACCEPT_LANGUAGE:en-us,en;q=0.5\r\nHTTP_ACCEPT_ENCODING:gzip, deflate\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.7\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.bigjava.com/\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:55747\r\nREDIRECT_URL:/adplatform/ad/img/lFnze/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/lFnze/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/lFnze/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/lFnze/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/lFnze/generic\r\nREQUEST_TIME:1309363899', '2011-06-29 23:11:39'),
(40, 'http://www.bigjava.com/', 'REDIRECT_UNIQUE_ID:Dr34zwrTNwIAACKcAfkAAAAA\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:Dr34zwrTNwIAACKcAfkAAAAA\r\nHTTP_HOST:localhost\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0\r\nHTTP_ACCEPT:image/png,image/*;q=0.8,*/*;q=0.5\r\nHTTP_ACCEPT_LANGUAGE:en-us,en;q=0.5\r\nHTTP_ACCEPT_ENCODING:gzip, deflate\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.7\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.bigjava.com/\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:55933\r\nREDIRECT_URL:/adplatform/ad/img/clvNL/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/clvNL/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/clvNL/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/clvNL/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/clvNL/generic\r\nREQUEST_TIME:1309363977', '2011-06-29 23:12:57'),
(41, 'http://www.bigjava.com/', 'REDIRECT_UNIQUE_ID:I9KpZgrTNwIAACKeAxkAAAAC\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:I9KpZgrTNwIAACKeAxkAAAAC\r\nHTTP_HOST:localhost\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0\r\nHTTP_ACCEPT:image/png,image/*;q=0.8,*/*;q=0.5\r\nHTTP_ACCEPT_LANGUAGE:en-us,en;q=0.5\r\nHTTP_ACCEPT_ENCODING:gzip, deflate\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.7\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.bigjava.com/\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:56694\r\nREDIRECT_URL:/adplatform/ad/img/VwxCj/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/VwxCj/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/VwxCj/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/VwxCj/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/VwxCj/generic\r\nREQUEST_TIME:1309364330', '2011-06-29 23:18:50'),
(42, 'http://www.bigjava.com/', 'REDIRECT_UNIQUE_ID:J6JaZgrTNwIAACKiA6QAAAAF\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:J6JaZgrTNwIAACKiA6QAAAAF\r\nHTTP_HOST:localhost\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0\r\nHTTP_ACCEPT:image/png,image/*;q=0.8,*/*;q=0.5\r\nHTTP_ACCEPT_LANGUAGE:en-us,en;q=0.5\r\nHTTP_ACCEPT_ENCODING:gzip, deflate\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.7\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.bigjava.com/\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:56880\r\nREDIRECT_URL:/adplatform/ad/img/LIkEF/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/LIkEF/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/LIkEF/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/LIkEF/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/LIkEF/generic\r\nREQUEST_TIME:1309364394', '2011-06-29 23:19:54'),
(43, 'http://www.bigjava.com/', 'REDIRECT_UNIQUE_ID:KfFo8ArTNwIAACKkBX4AAAAH\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:KfFo8ArTNwIAACKkBX4AAAAH\r\nHTTP_HOST:localhost\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0\r\nHTTP_ACCEPT:image/png,image/*;q=0.8,*/*;q=0.5\r\nHTTP_ACCEPT_LANGUAGE:en-us,en;q=0.5\r\nHTTP_ACCEPT_ENCODING:gzip, deflate\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.7\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.bigjava.com/\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:57066\r\nREDIRECT_URL:/adplatform/ad/img/cHCcl/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/cHCcl/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/cHCcl/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/cHCcl/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/cHCcl/generic\r\nREQUEST_TIME:1309364433', '2011-06-29 23:20:33'),
(44, 'http://www.bigjava.com/', 'REDIRECT_UNIQUE_ID:PY9NYgrTNwIAACKiA6UAAAAF\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:PY9NYgrTNwIAACKiA6UAAAAF\r\nHTTP_HOST:localhost\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0\r\nHTTP_ACCEPT:image/png,image/*;q=0.8,*/*;q=0.5\r\nHTTP_ACCEPT_LANGUAGE:en-us,en;q=0.5\r\nHTTP_ACCEPT_ENCODING:gzip, deflate\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.7\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.bigjava.com/\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:57292\r\nREDIRECT_URL:/adplatform/ad/img/cYzJq/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/cYzJq/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/cYzJq/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/cYzJq/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/cYzJq/generic\r\nREQUEST_TIME:1309364762', '2011-06-29 23:26:02'),
(45, 'http://www.bigjava.com/', 'REDIRECT_UNIQUE_ID:QlgpzwrTNwIAACKkBX8AAAAH\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:QlgpzwrTNwIAACKkBX8AAAAH\r\nHTTP_HOST:localhost\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0\r\nHTTP_ACCEPT:image/png,image/*;q=0.8,*/*;q=0.5\r\nHTTP_ACCEPT_LANGUAGE:en-us,en;q=0.5\r\nHTTP_ACCEPT_ENCODING:gzip, deflate\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.7\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.bigjava.com/\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:57486\r\nREDIRECT_URL:/adplatform/ad/img/zhMbb/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/zhMbb/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/zhMbb/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/zhMbb/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/zhMbb/generic\r\nREQUEST_TIME:1309364842', '2011-06-29 23:27:23'),
(46, 'http://www.bigjava.com/', 'REDIRECT_UNIQUE_ID:ahEuYgrTNwIAACKjBfEAAAAG\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:ahEuYgrTNwIAACKjBfEAAAAG\r\nHTTP_HOST:localhost\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0\r\nHTTP_ACCEPT:image/png,image/*;q=0.8,*/*;q=0.5\r\nHTTP_ACCEPT_LANGUAGE:en-us,en;q=0.5\r\nHTTP_ACCEPT_ENCODING:gzip, deflate\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.7\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.bigjava.com/\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:57762\r\nREDIRECT_URL:/adplatform/ad/img/yAMr2/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/yAMr2/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/yAMr2/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/yAMr2/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/yAMr2/generic\r\nREQUEST_TIME:1309365509', '2011-06-29 23:38:29'),
(47, 'http://www.bigjava.com/', 'REDIRECT_UNIQUE_ID:dQvs8QrTNwIAACKeAx0AAAAC\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:dQvs8QrTNwIAACKeAx0AAAAC\r\nHTTP_HOST:localhost\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0\r\nHTTP_ACCEPT:image/png,image/*;q=0.8,*/*;q=0.5\r\nHTTP_ACCEPT_LANGUAGE:en-us,en;q=0.5\r\nHTTP_ACCEPT_ENCODING:gzip, deflate\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.7\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.bigjava.com/\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:57831\r\nREDIRECT_URL:/adplatform/ad/img/3zv8Y/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/3zv8Y/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/3zv8Y/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/3zv8Y/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/3zv8Y/generic\r\nREQUEST_TIME:1309365693', '2011-06-29 23:41:33'),
(48, 'http://www.google.com/search?q=javascript+XMLHTTPrequest+&ie=utf-8&oe=utf-8&aq=t&rls=org.mozilla:en-US:official&client=firefox-a', 'REDIRECT_UNIQUE_ID:6tdyfwrTNwIAACKfA4YAAAAD\r\nREDIRECT_STATUS:200\r\nUNIQUE_ID:6tdyfwrTNwIAACKfA4YAAAAD\r\nHTTP_HOST:localhost\r\nHTTP_USER_AGENT:Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.0) Gecko/20100101 Firefox/5.0\r\nHTTP_ACCEPT:image/png,image/*;q=0.8,*/*;q=0.5\r\nHTTP_ACCEPT_LANGUAGE:en-us,en;q=0.5\r\nHTTP_ACCEPT_ENCODING:gzip, deflate\r\nHTTP_ACCEPT_CHARSET:ISO-8859-1,utf-8;q=0.7,*;q=0.7\r\nHTTP_CONNECTION:keep-alive\r\nHTTP_REFERER:http://www.google.com/search?q=javascript+XMLHTTPrequest+&ie=utf-8&oe=utf-8&aq=t&rls=org.mozilla:en-US:official&client=firefox-a\r\nPATH:/usr/bin:/bin:/usr/sbin:/sbin\r\nSERVER_SIGNATURE:\r\nSERVER_SOFTWARE:Apache/2.2.6 (Unix) mod_ssl/2.2.6 OpenSSL/0.9.8e DAV/2 PHP/5.2.4\r\nSERVER_NAME:localhost\r\nSERVER_ADDR:::1\r\nSERVER_PORT:80\r\nREMOTE_ADDR:::1\r\nDOCUMENT_ROOT:/Applications/xampp/xamppfiles/htdocs\r\nSERVER_ADMIN:you@example.com\r\nSCRIPT_FILENAME:/Applications/xampp/xamppfiles/htdocs/adplatform/index.php\r\nREMOTE_PORT:60127\r\nREDIRECT_URL:/adplatform/ad/img/wgPx8/generic\r\nGATEWAY_INTERFACE:CGI/1.1\r\nSERVER_PROTOCOL:HTTP/1.1\r\nREQUEST_METHOD:GET\r\nQUERY_STRING:\r\nREQUEST_URI:/adplatform/ad/img/wgPx8/generic\r\nSCRIPT_NAME:/adplatform/index.php\r\nPATH_INFO:/ad/img/wgPx8/generic\r\nPATH_TRANSLATED:/Applications/xampp/xamppfiles/htdocs/ad/img/wgPx8/generic\r\nPHP_SELF:/adplatform/index.php/ad/img/wgPx8/generic\r\nREQUEST_TIME:1309367669', '2011-06-30 00:14:30');

-- --------------------------------------------------------

--
-- Table structure for table `be_users`
--

CREATE TABLE IF NOT EXISTS `be_users` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `username` varchar(32) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(254) NOT NULL,
  `active` tinyint(1) unsigned NOT NULL default '0',
  `group` int(10) unsigned default NULL,
  `activation_key` varchar(32) default NULL,
  `last_visit` datetime default NULL,
  `created` datetime NOT NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `password` (`password`),
  KEY `group` (`group`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `be_users`
--

INSERT INTO `be_users` (`id`, `username`, `password`, `email`, `active`, `group`, `activation_key`, `last_visit`, `created`, `modified`) VALUES
(1, 'Administrator', '5f659c9faab42bd4b18f9c50a1bd476f378f827f', 'andy.awidarto@gmail.com', 1, 2, NULL, '2011-07-01 00:28:58', '2011-06-05 21:49:52', NULL),
(2, 'advertiser', '5f659c9faab42bd4b18f9c50a1bd476f378f827f', 'ad@vertiser.com', 1, 1, NULL, '2011-06-27 11:57:33', '2011-06-07 11:12:01', NULL),
(3, 'testuser01', '5f659c9faab42bd4b18f9c50a1bd476f378f827f', 'test@sinaptix.com', 1, 1, NULL, '2011-06-08 23:08:54', '2011-06-08 22:52:34', NULL),
(4, 'testuser02', '5f659c9faab42bd4b18f9c50a1bd476f378f827f', 'test@user.com', 1, 1, NULL, NULL, '2011-06-08 23:21:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `be_user_profiles`
--

CREATE TABLE IF NOT EXISTS `be_user_profiles` (
  `user_id` int(10) unsigned NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(128) NOT NULL,
  `zip` varchar(30) NOT NULL,
  `country` varchar(128) NOT NULL,
  `phone` varchar(128) NOT NULL,
  `mobile` varchar(128) NOT NULL,
  `fax` varchar(128) NOT NULL,
  PRIMARY KEY  (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `be_user_profiles`
--

INSERT INTO `be_user_profiles` (`user_id`, `fullname`, `company`, `address`, `city`, `zip`, `country`, `phone`, `mobile`, `fax`) VALUES
(1, '', '0', '', '', '', '', '', '', ''),
(2, 'Ad Vertiser', 'PT Yang Pasang Iklan', '', '', '', '', '', '', ''),
(3, '', '', '', '', '', '', '', '', ''),
(4, 'test@user.com', 'Jula Juli', 'DImana aja ada', 'Jakarta', '1200100', 'Indonesia', '8689689', '68896896', '797907907');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) character set latin1 NOT NULL default '0',
  `ip_address` varchar(16) character set latin1 NOT NULL default '0',
  `user_agent` varchar(50) character set latin1 NOT NULL,
  `user_data` text NOT NULL,
  `last_activity` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `user_data`, `last_activity`) VALUES
('55f0527941e0942ac1fd27eaa2f9ae25', '127.0.0.1', 'Java/1.6.0_15', '', 1309364700),
('8a4169888e3c8517e8e4cc50c5adb30e', '127.0.0.1', 'Java/1.6.0_15', '', 1309364754),
('b1165620a5f3fefc613b5c6e0abbe268', '127.0.0.1', 'Java/1.6.0_15', '', 1309364762),
('f62a0242a7a4cac08f9ba0fa48320783', '127.0.0.1', 'Java/1.6.0_15', '', 1309364319),
('27ad57a20d37eca62d153d9328d525f4', '127.0.0.1', 'Java/1.6.0_15', '', 1309364330),
('14724ad12518819470ba0194c5a5cf40', '127.0.0.1', 'Java/1.6.0_15', '', 1309364384),
('aca5bdf0d655a229eb8dee98a5b248c2', '127.0.0.1', 'Java/1.6.0_15', '', 1309364394),
('8cc9f6b1c2498a84c98ebc0dffd05c95', '127.0.0.1', 'Java/1.6.0_15', '', 1309364403),
('293e9ec556055e684ed2d23b9452fea5', '127.0.0.1', 'Java/1.6.0_15', '', 1309364422),
('9d2899f04438210fead719e27977d0f8', '127.0.0.1', 'Java/1.6.0_15', '', 1309364433),
('1e583c8b0babe6d04c0273538b61ddef', '127.0.0.1', 'Java/1.6.0_15', '', 1309364227),
('e8c58420bbbf84cef2fbf1a67f26be35', '127.0.0.1', 'Java/1.6.0_15', '', 1309364241),
('14d4b8926e511a5de52f67023c6c58d3', '127.0.0.1', 'Java/1.6.0_15', '', 1309364273),
('176087769ed807d93558ca41d733024b', '127.0.0.1', 'Java/1.6.0_15', '', 1309364281),
('1c733ec2c44421e1dddfe73a99a05a44', '127.0.0.1', 'Java/1.6.0_15', '', 1309363804),
('4038beb3094de1fe05631dd122a0193d', '127.0.0.1', 'Java/1.6.0_15', '', 1309363893),
('8ad4752be3c9075274d62462422679fb', '127.0.0.1', 'Java/1.6.0_15', '', 1309363899),
('18a9365e76fc6c2b18fd1c87226bda51', '127.0.0.1', 'Java/1.6.0_15', '', 1309363966),
('e8a802add80b03f64996c02d0b4d4118', '127.0.0.1', 'Java/1.6.0_15', '', 1309363977),
('8212849b3ad5034c8e51be2e48fd3f0c', '127.0.0.1', 'Java/1.6.0_15', '', 1309364028),
('757a136f23df5ae69d943ce05f0f1740', '127.0.0.1', 'Java/1.6.0_15', '', 1309364041),
('bac746bc746cb13756cf1c6030d1ca1f', '127.0.0.1', 'Java/1.6.0_15', '', 1309364103),
('47c57217384fcddd9e23417b64db8541', '127.0.0.1', 'Java/1.6.0_15', '', 1309362759),
('ad16ab7da3f2fce91ff5251317dbf7c9', '127.0.0.1', 'Java/1.6.0_15', '', 1309362804),
('b3a516e7094bd4c58c6eadb319827968', '127.0.0.1', 'Java/1.6.0_15', '', 1309362852),
('82e37af38e12228563d361ff4070bac4', '127.0.0.1', 'Java/1.6.0_15', '', 1309362902),
('4713fce7ea353e52a51f4b9f85d4cb92', '127.0.0.1', 'Java/1.6.0_15', '', 1309362906),
('da943d30f51d4fd8d55c83bb557ed24e', '127.0.0.1', 'Java/1.6.0_15', '', 1309362937),
('d04a2ad9982ac08f27b3ce0e590ed089', '127.0.0.1', 'Java/1.6.0_15', '', 1309362945),
('f649d32809bf6fa6f99ad16acbc27937', '127.0.0.1', 'Java/1.6.0_15', '', 1309363204),
('f104fc90da312741a3a6ee3cdffa2195', '127.0.0.1', 'Java/1.6.0_15', '', 1309363402),
('1e6de276d9d833c0ab2c5f2bcf5739f2', '127.0.0.1', 'Java/1.6.0_15', '', 1309363410),
('c76190ae5fdb635436ef98e844e925ae', '127.0.0.1', 'Java/1.6.0_15', '', 1309363503),
('a3927a58e3050160ddb606ffba79e42d', '127.0.0.1', 'Java/1.6.0_15', '', 1309363546),
('48c1e4e1f2dcaff8494c2e7a83fec9b6', '127.0.0.1', 'Java/1.6.0_15', '', 1309363625),
('8fb3d344984eaf4af80de2ac72f202d0', '127.0.0.1', 'Java/1.6.0_15', '', 1309363631),
('beb46428b68465538521c876a880abff', '127.0.0.1', 'Java/1.6.0_15', '', 1309363695),
('bf00327933f4fbffbf8f94ff550df987', '127.0.0.1', 'Java/1.6.0_15', '', 1309363704),
('0cfb1734a0537a922c35cf307dbcaf57', '127.0.0.1', 'Java/1.6.0_15', '', 1309363793),
('94404a11f42c8dccaeff0a7076bd3ac1', '0.0.0.0', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) App', 'a:19:{s:2:"id";s:1:"2";s:8:"username";s:10:"advertiser";s:5:"email";s:15:"ad@vertiser.com";s:8:"password";s:40:"5f659c9faab42bd4b18f9c50a1bd476f378f827f";s:6:"active";s:1:"1";s:10:"last_visit";s:19:"2011-06-21 23:52:21";s:7:"created";s:19:"2011-06-07 11:12:01";s:8:"modified";s:0:"";s:5:"group";s:6:"Member";s:8:"group_id";s:1:"1";s:8:"fullname";s:11:"Ad Vertiser";s:7:"company";s:20:"PT Yang Pasang Iklan";s:7:"address";s:0:"";s:4:"city";s:0:"";s:3:"zip";s:0:"";s:7:"country";s:0:"";s:5:"phone";s:0:"";s:6:"mobile";s:0:"";s:3:"fax";s:0:"";}', 1308719690),
('c17b3d424ee9479c5ec4c0bb583790a9', '0.0.0.0', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) App', 'a:19:{s:2:"id";s:1:"2";s:8:"username";s:10:"advertiser";s:5:"email";s:15:"ad@vertiser.com";s:8:"password";s:40:"5f659c9faab42bd4b18f9c50a1bd476f378f827f";s:6:"active";s:1:"1";s:10:"last_visit";s:19:"2011-06-22 10:54:53";s:7:"created";s:19:"2011-06-07 11:12:01";s:8:"modified";s:0:"";s:5:"group";s:6:"Member";s:8:"group_id";s:1:"1";s:8:"fullname";s:11:"Ad Vertiser";s:7:"company";s:20:"PT Yang Pasang Iklan";s:7:"address";s:0:"";s:4:"city";s:0:"";s:3:"zip";s:0:"";s:7:"country";s:0:"";s:5:"phone";s:0:"";s:6:"mobile";s:0:"";s:3:"fax";s:0:"";}', 1308719999),
('71c27de5216aa7df7f511f0cb5257a05', '0.0.0.0', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) App', 'a:19:{s:2:"id";s:1:"2";s:8:"username";s:10:"advertiser";s:5:"email";s:15:"ad@vertiser.com";s:8:"password";s:40:"5f659c9faab42bd4b18f9c50a1bd476f378f827f";s:6:"active";s:1:"1";s:10:"last_visit";s:19:"2011-06-22 12:18:53";s:7:"created";s:19:"2011-06-07 11:12:01";s:8:"modified";s:0:"";s:5:"group";s:6:"Member";s:8:"group_id";s:1:"1";s:8:"fullname";s:11:"Ad Vertiser";s:7:"company";s:20:"PT Yang Pasang Iklan";s:7:"address";s:0:"";s:4:"city";s:0:"";s:3:"zip";s:0:"";s:7:"country";s:0:"";s:5:"phone";s:0:"";s:6:"mobile";s:0:"";s:3:"fax";s:0:"";}', 1308724756),
('c0136c00d6d96e24725a10e79b7f0aa0', '0.0.0.0', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) App', 'a:19:{s:2:"id";s:1:"2";s:8:"username";s:10:"advertiser";s:5:"email";s:15:"ad@vertiser.com";s:8:"password";s:40:"5f659c9faab42bd4b18f9c50a1bd476f378f827f";s:6:"active";s:1:"1";s:10:"last_visit";s:19:"2011-06-22 12:41:46";s:7:"created";s:19:"2011-06-07 11:12:01";s:8:"modified";s:0:"";s:5:"group";s:6:"Member";s:8:"group_id";s:1:"1";s:8:"fullname";s:11:"Ad Vertiser";s:7:"company";s:20:"PT Yang Pasang Iklan";s:7:"address";s:0:"";s:4:"city";s:0:"";s:3:"zip";s:0:"";s:7:"country";s:0:"";s:5:"phone";s:0:"";s:6:"mobile";s:0:"";s:3:"fax";s:0:"";}', 1308725310),
('47332d81fd90e62a549f0b1f3f8c1f7c', '0.0.0.0', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) App', 'a:19:{s:2:"id";s:1:"2";s:8:"username";s:10:"advertiser";s:5:"email";s:15:"ad@vertiser.com";s:8:"password";s:40:"5f659c9faab42bd4b18f9c50a1bd476f378f827f";s:6:"active";s:1:"1";s:10:"last_visit";s:19:"2011-06-22 13:41:12";s:7:"created";s:19:"2011-06-07 11:12:01";s:8:"modified";s:0:"";s:5:"group";s:6:"Member";s:8:"group_id";s:1:"1";s:8:"fullname";s:11:"Ad Vertiser";s:7:"company";s:20:"PT Yang Pasang Iklan";s:7:"address";s:0:"";s:4:"city";s:0:"";s:3:"zip";s:0:"";s:7:"country";s:0:"";s:5:"phone";s:0:"";s:6:"mobile";s:0:"";s:3:"fax";s:0:"";}', 1308731589),
('42427176de4f886b8efb445ee21de80a', '0.0.0.0', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) App', 'a:19:{s:2:"id";s:1:"2";s:8:"username";s:10:"advertiser";s:5:"email";s:15:"ad@vertiser.com";s:8:"password";s:40:"5f659c9faab42bd4b18f9c50a1bd476f378f827f";s:6:"active";s:1:"1";s:10:"last_visit";s:19:"2011-06-22 13:50:11";s:7:"created";s:19:"2011-06-07 11:12:01";s:8:"modified";s:0:"";s:5:"group";s:6:"Member";s:8:"group_id";s:1:"1";s:8:"fullname";s:11:"Ad Vertiser";s:7:"company";s:20:"PT Yang Pasang Iklan";s:7:"address";s:0:"";s:4:"city";s:0:"";s:3:"zip";s:0:"";s:7:"country";s:0:"";s:5:"phone";s:0:"";s:6:"mobile";s:0:"";s:3:"fax";s:0:"";}', 1308734617),
('35aa4f797ecae65311475d3c5eba5bd1', '0.0.0.0', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) App', 'a:19:{s:2:"id";s:1:"2";s:8:"username";s:10:"advertiser";s:5:"email";s:15:"ad@vertiser.com";s:8:"password";s:40:"5f659c9faab42bd4b18f9c50a1bd476f378f827f";s:6:"active";s:1:"1";s:10:"last_visit";s:19:"2011-06-22 15:38:56";s:7:"created";s:19:"2011-06-07 11:12:01";s:8:"modified";s:0:"";s:5:"group";s:6:"Member";s:8:"group_id";s:1:"1";s:8:"fullname";s:11:"Ad Vertiser";s:7:"company";s:20:"PT Yang Pasang Iklan";s:7:"address";s:0:"";s:4:"city";s:0:"";s:3:"zip";s:0:"";s:7:"country";s:0:"";s:5:"phone";s:0:"";s:6:"mobile";s:0:"";s:3:"fax";s:0:"";}', 1308735584),
('0b012aaba1fb76394a8faf0b0de4f8b8', '0.0.0.0', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) App', '', 1308806697),
('1b6506cb286d777ac5cdb6ef7d601f4d', '127.0.0.1', 'Java/1.6.0_15', '', 1309363801),
('4ff44e132450744aabc490e281e3d539', '127.0.0.1', 'Java/1.6.0_15', '', 1309362750),
('df74a276b20832a35186f982cdd43408', '127.0.0.1', 'Java/1.6.0_15', '', 1309362335),
('9e1b1d1c22743e72f3e9f11085762ef5', '127.0.0.1', 'Java/1.6.0_15', '', 1309362341),
('32304c02897f3f87ee08d25b6938c3ea', '0.0.0.0', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:5.', '', 1309367670),
('815b25aef1b09a00b2a82a6bb12ae32e', '127.0.0.1', 'Java/1.6.0_15', '', 1309362341),
('45cc8ddc24a253b727f424f3b757d0ef', '127.0.0.1', 'Java/1.6.0_15', '', 1309362392),
('3107387f56bab70ef05157ce31531217', '127.0.0.1', 'Java/1.6.0_15', '', 1309362472),
('bed0d406cbd9a9b48321d61acc21d95e', '127.0.0.1', 'Java/1.6.0_15', '', 1309362481),
('993fc959ea83d9b013b6ffab9cfe4032', '127.0.0.1', 'Java/1.6.0_15', '', 1309362602),
('14b0298f3a5242ff072d6a533ac5bb8b', '0.0.0.0', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_7) App', 'a:19:{s:2:"id";s:1:"1";s:8:"username";s:13:"Administrator";s:5:"email";s:23:"andy.awidarto@gmail.com";s:8:"password";s:40:"5f659c9faab42bd4b18f9c50a1bd476f378f827f";s:6:"active";s:1:"1";s:10:"last_visit";s:19:"2011-06-30 22:59:47";s:7:"created";s:19:"2011-06-05 21:49:52";s:8:"modified";s:0:"";s:5:"group";s:13:"Administrator";s:8:"group_id";s:1:"2";s:8:"fullname";s:0:"";s:7:"company";s:1:"0";s:7:"address";s:0:"";s:4:"city";s:0:"";s:3:"zip";s:0:"";s:7:"country";s:0:"";s:5:"phone";s:0:"";s:6:"mobile";s:0:"";s:3:"fax";s:0:"";}', 1309464506),
('4b5ab9f100fa05a1c8cf52bd74465a64', '127.0.0.1', 'Java/1.6.0_15', '', 1309362210),
('bb1ba4cff2d4ecf4eca5efe3099df2ee', '127.0.0.1', 'Java/1.6.0_15', '', 1309364835),
('8afda12326ba9633c712c68eafd1c7ae', '127.0.0.1', 'Java/1.6.0_15', '', 1309364842),
('e46eb40416ef58c1e1a081cc123b317a', '127.0.0.1', 'Java/1.6.0_15', '', 1309365290),
('1b68441de7bcbca31a03b8f2e50e1b0a', '127.0.0.1', 'Java/1.6.0_15', '', 1309365500),
('68f10ca525d42e53c6a1871f725bab5f', '127.0.0.1', 'Java/1.6.0_15', '', 1309365509),
('0aff36784007c8dcc3edf22808dfd20c', '127.0.0.1', 'Java/1.6.0_15', '', 1309365687),
('3483fae2a33c85d4908964df30584c3d', '127.0.0.1', 'Java/1.6.0_15', '', 1309365693),
('65284b859533aee4876bad2460c21137', '127.0.0.1', 'Java/1.6.0_15', '', 1309367668),
('d516114d597704d24ace9db3b60e236d', '127.0.0.1', 'Java/1.6.0_15', '', 1309367683),
('eb8b60d9915b377653e605e61592e76c', '127.0.0.1', 'Java/1.6.0_15', '', 1309367685);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `be_acl_permissions`
--
ALTER TABLE `be_acl_permissions`
  ADD CONSTRAINT `be_acl_permissions_ibfk_1` FOREIGN KEY (`aro_id`) REFERENCES `be_acl_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `be_acl_permissions_ibfk_2` FOREIGN KEY (`aco_id`) REFERENCES `be_acl_resources` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `be_acl_permission_actions`
--
ALTER TABLE `be_acl_permission_actions`
  ADD CONSTRAINT `be_acl_permission_actions_ibfk_1` FOREIGN KEY (`access_id`) REFERENCES `be_acl_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `be_acl_permission_actions_ibfk_2` FOREIGN KEY (`axo_id`) REFERENCES `be_acl_actions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `be_groups`
--
ALTER TABLE `be_groups`
  ADD CONSTRAINT `be_groups_ibfk_1` FOREIGN KEY (`id`) REFERENCES `be_acl_groups` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `be_resources`
--
ALTER TABLE `be_resources`
  ADD CONSTRAINT `be_resources_ibfk_1` FOREIGN KEY (`id`) REFERENCES `be_acl_resources` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `be_users`
--
ALTER TABLE `be_users`
  ADD CONSTRAINT `be_users_ibfk_1` FOREIGN KEY (`group`) REFERENCES `be_acl_groups` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `be_user_profiles`
--
ALTER TABLE `be_user_profiles`
  ADD CONSTRAINT `be_user_profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `be_users` (`id`) ON DELETE CASCADE;
