-- MySQL dump 10.13  Distrib 5.5.25, for osx10.6 (i386)
--
-- Host: localhost    Database: kiosk
-- ------------------------------------------------------
-- Server version	5.5.25

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `lsf3y_assets`
--

DROP TABLE IF EXISTS `lsf3y_assets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_assets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set parent.',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set lft.',
  `rgt` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set rgt.',
  `level` int(10) unsigned NOT NULL COMMENT 'The cached level in the nested tree.',
  `name` varchar(50) NOT NULL COMMENT 'The unique name for the asset.\n',
  `title` varchar(100) NOT NULL COMMENT 'The descriptive title for the asset.',
  `rules` varchar(5120) NOT NULL COMMENT 'JSON encoded access control.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_asset_name` (`name`),
  KEY `idx_lft_rgt` (`lft`,`rgt`),
  KEY `idx_parent_id` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_assets`
--

LOCK TABLES `lsf3y_assets` WRITE;
/*!40000 ALTER TABLE `lsf3y_assets` DISABLE KEYS */;
INSERT INTO `lsf3y_assets` VALUES (1,0,1,61,0,'root.1','Root Asset','{\"core.login.site\":{\"6\":1,\"2\":1},\"core.login.admin\":{\"6\":1},\"core.login.offline\":{\"6\":1},\"core.admin\":{\"8\":1},\"core.manage\":{\"7\":1},\"core.create\":{\"6\":1,\"3\":1},\"core.delete\":{\"6\":1},\"core.edit\":{\"6\":1,\"4\":1},\"core.edit.state\":{\"6\":1,\"5\":1},\"core.edit.own\":{\"6\":1,\"3\":1}}');
INSERT INTO `lsf3y_assets` VALUES (2,1,1,2,1,'com_admin','com_admin','{}');
INSERT INTO `lsf3y_assets` VALUES (3,1,3,6,1,'com_banners','com_banners','{\"core.admin\":{\"7\":1},\"core.manage\":{\"6\":1},\"core.create\":[],\"core.delete\":[],\"core.edit\":[],\"core.edit.state\":[]}');
INSERT INTO `lsf3y_assets` VALUES (4,1,7,8,1,'com_cache','com_cache','{\"core.admin\":{\"7\":1},\"core.manage\":{\"7\":1}}');
INSERT INTO `lsf3y_assets` VALUES (5,1,9,10,1,'com_checkin','com_checkin','{\"core.admin\":{\"7\":1},\"core.manage\":{\"7\":1}}');
INSERT INTO `lsf3y_assets` VALUES (6,1,11,12,1,'com_config','com_config','{}');
INSERT INTO `lsf3y_assets` VALUES (7,1,13,16,1,'com_contact','com_contact','{\"core.admin\":{\"7\":1},\"core.manage\":{\"6\":1},\"core.create\":[],\"core.delete\":[],\"core.edit\":[],\"core.edit.state\":[],\"core.edit.own\":[]}');
INSERT INTO `lsf3y_assets` VALUES (8,1,17,20,1,'com_content','com_content','{\"core.admin\":{\"7\":0},\"core.manage\":{\"6\":1,\"7\":0},\"core.create\":{\"7\":0,\"3\":1},\"core.delete\":{\"7\":0},\"core.edit\":{\"7\":0,\"4\":1},\"core.edit.state\":{\"7\":0,\"5\":1},\"core.edit.own\":{\"7\":0}}');
INSERT INTO `lsf3y_assets` VALUES (9,1,21,22,1,'com_cpanel','com_cpanel','{}');
INSERT INTO `lsf3y_assets` VALUES (10,1,23,24,1,'com_installer','com_installer','{\"core.admin\":[],\"core.manage\":{\"7\":0},\"core.delete\":{\"7\":0},\"core.edit.state\":{\"7\":0}}');
INSERT INTO `lsf3y_assets` VALUES (11,1,25,26,1,'com_languages','com_languages','{\"core.admin\":{\"7\":0},\"core.manage\":{\"7\":0},\"core.create\":{\"7\":0},\"core.delete\":{\"7\":0},\"core.edit\":{\"7\":0},\"core.edit.state\":{\"7\":0}}');
INSERT INTO `lsf3y_assets` VALUES (12,1,27,28,1,'com_login','com_login','{}');
INSERT INTO `lsf3y_assets` VALUES (13,1,29,30,1,'com_mailto','com_mailto','{}');
INSERT INTO `lsf3y_assets` VALUES (14,1,31,32,1,'com_massmail','com_massmail','{}');
INSERT INTO `lsf3y_assets` VALUES (15,1,33,34,1,'com_media','com_media','{\"core.admin\":{\"7\":1},\"core.manage\":{\"6\":1},\"core.create\":{\"3\":1},\"core.delete\":{\"5\":1}}');
INSERT INTO `lsf3y_assets` VALUES (16,1,35,36,1,'com_menus','com_menus','{\"core.admin\":{\"7\":1},\"core.manage\":[],\"core.create\":[],\"core.delete\":[],\"core.edit\":[],\"core.edit.state\":[]}');
INSERT INTO `lsf3y_assets` VALUES (17,1,37,38,1,'com_messages','com_messages','{\"core.admin\":{\"7\":0},\"core.manage\":{\"7\":0},\"core.create\":{\"7\":0},\"core.delete\":{\"7\":0},\"core.edit.state\":{\"7\":0}}');
INSERT INTO `lsf3y_assets` VALUES (18,1,39,40,1,'com_modules','com_modules','{\"core.admin\":{\"7\":0},\"core.manage\":{\"7\":0},\"core.create\":{\"7\":0},\"core.delete\":{\"7\":0},\"core.edit\":{\"7\":0},\"core.edit.state\":{\"7\":0}}');
INSERT INTO `lsf3y_assets` VALUES (20,1,41,42,1,'com_plugins','com_plugins','{\"core.admin\":{\"7\":0},\"core.manage\":{\"7\":0},\"core.edit\":{\"7\":0},\"core.edit.state\":{\"7\":0}}');
INSERT INTO `lsf3y_assets` VALUES (21,1,43,44,1,'com_redirect','com_redirect','{\"core.admin\":{\"7\":0},\"core.manage\":{\"7\":0},\"core.create\":{\"7\":0},\"core.delete\":{\"7\":0},\"core.edit\":{\"7\":0},\"core.edit.state\":{\"7\":0}}');
INSERT INTO `lsf3y_assets` VALUES (22,1,45,46,1,'com_search','com_search','{\"core.admin\":{\"7\":0},\"core.manage\":{\"6\":1,\"7\":0},\"core.edit.state\":{\"7\":0}}');
INSERT INTO `lsf3y_assets` VALUES (23,1,47,48,1,'com_templates','com_templates','{\"core.admin\":{\"7\":0},\"core.manage\":{\"7\":0},\"core.create\":{\"7\":0},\"core.delete\":{\"7\":0},\"core.edit\":{\"7\":0},\"core.edit.state\":{\"7\":0}}');
INSERT INTO `lsf3y_assets` VALUES (24,1,49,52,1,'com_users','com_users','{\"core.admin\":{\"7\":0},\"core.manage\":{\"7\":0},\"core.create\":{\"7\":0},\"core.delete\":{\"7\":0},\"core.edit\":{\"7\":0},\"core.edit.state\":{\"7\":0}}');
INSERT INTO `lsf3y_assets` VALUES (26,1,53,54,1,'com_wrapper','com_wrapper','{}');
INSERT INTO `lsf3y_assets` VALUES (27,8,18,19,2,'com_content.category.2','Uncategorised','{\"core.create\":[],\"core.delete\":[],\"core.edit\":[],\"core.edit.state\":[],\"core.edit.own\":[]}');
INSERT INTO `lsf3y_assets` VALUES (28,3,4,5,2,'com_banners.category.3','Uncategorised','{\"core.create\":[],\"core.delete\":[],\"core.edit\":[],\"core.edit.state\":[]}');
INSERT INTO `lsf3y_assets` VALUES (29,7,14,15,2,'com_contact.category.4','Uncategorised','{\"core.create\":[],\"core.delete\":[],\"core.edit\":[],\"core.edit.state\":[],\"core.edit.own\":[]}');
INSERT INTO `lsf3y_assets` VALUES (32,24,50,51,1,'com_users.category.7','Uncategorised','{\"core.create\":[],\"core.delete\":[],\"core.edit\":[],\"core.edit.state\":[]}');
INSERT INTO `lsf3y_assets` VALUES (34,1,55,56,1,'com_joomlaupdate','com_joomlaupdate','{\"core.admin\":[],\"core.manage\":[],\"core.delete\":[],\"core.edit.state\":[]}');
INSERT INTO `lsf3y_assets` VALUES (35,1,57,58,1,'com_mediamanager','mediamanager','{}');
INSERT INTO `lsf3y_assets` VALUES (38,1,59,60,1,'com_scout','scout','{}');
/*!40000 ALTER TABLE `lsf3y_assets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_associations`
--

DROP TABLE IF EXISTS `lsf3y_associations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_associations` (
  `id` varchar(50) NOT NULL COMMENT 'A reference to the associated item.',
  `context` varchar(50) NOT NULL COMMENT 'The context of the associated item.',
  `key` char(32) NOT NULL COMMENT 'The key for the association computed from an md5 on associated ids.',
  PRIMARY KEY (`context`,`id`),
  KEY `idx_key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_associations`
--

LOCK TABLES `lsf3y_associations` WRITE;
/*!40000 ALTER TABLE `lsf3y_associations` DISABLE KEYS */;
/*!40000 ALTER TABLE `lsf3y_associations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_banner_clients`
--

DROP TABLE IF EXISTS `lsf3y_banner_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_banner_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `contact` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `extrainfo` text NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `metakey` text NOT NULL,
  `own_prefix` tinyint(4) NOT NULL DEFAULT '0',
  `metakey_prefix` varchar(255) NOT NULL DEFAULT '',
  `purchase_type` tinyint(4) NOT NULL DEFAULT '-1',
  `track_clicks` tinyint(4) NOT NULL DEFAULT '-1',
  `track_impressions` tinyint(4) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`id`),
  KEY `idx_own_prefix` (`own_prefix`),
  KEY `idx_metakey_prefix` (`metakey_prefix`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_banner_clients`
--

LOCK TABLES `lsf3y_banner_clients` WRITE;
/*!40000 ALTER TABLE `lsf3y_banner_clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `lsf3y_banner_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_banner_tracks`
--

DROP TABLE IF EXISTS `lsf3y_banner_tracks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_banner_tracks` (
  `track_date` datetime NOT NULL,
  `track_type` int(10) unsigned NOT NULL,
  `banner_id` int(10) unsigned NOT NULL,
  `count` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`track_date`,`track_type`,`banner_id`),
  KEY `idx_track_date` (`track_date`),
  KEY `idx_track_type` (`track_type`),
  KEY `idx_banner_id` (`banner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_banner_tracks`
--

LOCK TABLES `lsf3y_banner_tracks` WRITE;
/*!40000 ALTER TABLE `lsf3y_banner_tracks` DISABLE KEYS */;
/*!40000 ALTER TABLE `lsf3y_banner_tracks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_banners`
--

DROP TABLE IF EXISTS `lsf3y_banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `imptotal` int(11) NOT NULL DEFAULT '0',
  `impmade` int(11) NOT NULL DEFAULT '0',
  `clicks` int(11) NOT NULL DEFAULT '0',
  `clickurl` varchar(200) NOT NULL DEFAULT '',
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `custombannercode` varchar(2048) NOT NULL,
  `sticky` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `params` text NOT NULL,
  `own_prefix` tinyint(1) NOT NULL DEFAULT '0',
  `metakey_prefix` varchar(255) NOT NULL DEFAULT '',
  `purchase_type` tinyint(4) NOT NULL DEFAULT '-1',
  `track_clicks` tinyint(4) NOT NULL DEFAULT '-1',
  `track_impressions` tinyint(4) NOT NULL DEFAULT '-1',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `reset` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `language` char(7) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_state` (`state`),
  KEY `idx_own_prefix` (`own_prefix`),
  KEY `idx_metakey_prefix` (`metakey_prefix`),
  KEY `idx_banner_catid` (`catid`),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_banners`
--

LOCK TABLES `lsf3y_banners` WRITE;
/*!40000 ALTER TABLE `lsf3y_banners` DISABLE KEYS */;
/*!40000 ALTER TABLE `lsf3y_banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_categories`
--

DROP TABLE IF EXISTS `lsf3y_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to the #__assets table.',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `lft` int(11) NOT NULL DEFAULT '0',
  `rgt` int(11) NOT NULL DEFAULT '0',
  `level` int(10) unsigned NOT NULL DEFAULT '0',
  `path` varchar(255) NOT NULL DEFAULT '',
  `extension` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `note` varchar(255) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `metadesc` varchar(1024) NOT NULL COMMENT 'The meta description for the page.',
  `metakey` varchar(1024) NOT NULL COMMENT 'The meta keywords for the page.',
  `metadata` varchar(2048) NOT NULL COMMENT 'JSON encoded metadata properties.',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `language` char(7) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cat_idx` (`extension`,`published`,`access`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_path` (`path`),
  KEY `idx_left_right` (`lft`,`rgt`),
  KEY `idx_alias` (`alias`),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_categories`
--

LOCK TABLES `lsf3y_categories` WRITE;
/*!40000 ALTER TABLE `lsf3y_categories` DISABLE KEYS */;
INSERT INTO `lsf3y_categories` VALUES (1,0,0,0,15,0,'','system','ROOT','root','','',1,0,'0000-00-00 00:00:00',1,'{}','','','',0,'2009-10-18 16:07:09',0,'0000-00-00 00:00:00',0,'*');
INSERT INTO `lsf3y_categories` VALUES (2,27,1,1,2,1,'uncategorised','com_content','Uncategorised','uncategorised','','',1,0,'0000-00-00 00:00:00',1,'{\"target\":\"\",\"image\":\"\"}','','','{\"page_title\":\"\",\"author\":\"\",\"robots\":\"\"}',42,'2010-06-28 13:26:37',0,'0000-00-00 00:00:00',0,'*');
INSERT INTO `lsf3y_categories` VALUES (3,28,1,3,4,1,'uncategorised','com_banners','Uncategorised','uncategorised','','',1,0,'0000-00-00 00:00:00',1,'{\"target\":\"\",\"image\":\"\",\"foobar\":\"\"}','','','{\"page_title\":\"\",\"author\":\"\",\"robots\":\"\"}',42,'2010-06-28 13:27:35',0,'0000-00-00 00:00:00',0,'*');
INSERT INTO `lsf3y_categories` VALUES (4,29,1,5,6,1,'uncategorised','com_contact','Uncategorised','uncategorised','','',1,0,'0000-00-00 00:00:00',1,'{\"target\":\"\",\"image\":\"\"}','','','{\"page_title\":\"\",\"author\":\"\",\"robots\":\"\"}',42,'2010-06-28 13:27:57',0,'0000-00-00 00:00:00',0,'*');
INSERT INTO `lsf3y_categories` VALUES (7,32,1,11,12,1,'uncategorised','com_users','Uncategorised','uncategorised','','',1,0,'0000-00-00 00:00:00',1,'{\"target\":\"\",\"image\":\"\"}','','','{\"page_title\":\"\",\"author\":\"\",\"robots\":\"\"}',42,'2010-06-28 13:28:33',0,'0000-00-00 00:00:00',0,'*');
/*!40000 ALTER TABLE `lsf3y_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_contact_details`
--

DROP TABLE IF EXISTS `lsf3y_contact_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_contact_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `con_position` varchar(255) DEFAULT NULL,
  `address` text,
  `suburb` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `postcode` varchar(100) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `misc` mediumtext,
  `image` varchar(255) DEFAULT NULL,
  `imagepos` varchar(20) DEFAULT NULL,
  `email_to` varchar(255) DEFAULT NULL,
  `default_con` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `catid` int(11) NOT NULL DEFAULT '0',
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `mobile` varchar(255) NOT NULL DEFAULT '',
  `webpage` varchar(255) NOT NULL DEFAULT '',
  `sortname1` varchar(255) NOT NULL,
  `sortname2` varchar(255) NOT NULL,
  `sortname3` varchar(255) NOT NULL,
  `language` char(7) NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `metadata` text NOT NULL,
  `featured` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Set if article is featured.',
  `xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`published`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_featured_catid` (`featured`,`catid`),
  KEY `idx_language` (`language`),
  KEY `idx_xreference` (`xreference`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_contact_details`
--

LOCK TABLES `lsf3y_contact_details` WRITE;
/*!40000 ALTER TABLE `lsf3y_contact_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `lsf3y_contact_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_content`
--

DROP TABLE IF EXISTS `lsf3y_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `asset_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to the #__assets table.',
  `title` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `title_alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT 'Deprecated in Joomla! 3.0',
  `introtext` mediumtext NOT NULL,
  `fulltext` mediumtext NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `sectionid` int(10) unsigned NOT NULL DEFAULT '0',
  `mask` int(10) unsigned NOT NULL DEFAULT '0',
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `images` text NOT NULL,
  `urls` text NOT NULL,
  `attribs` varchar(5120) NOT NULL,
  `version` int(10) unsigned NOT NULL DEFAULT '1',
  `parentid` int(10) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `metadata` text NOT NULL,
  `featured` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Set if article is featured.',
  `language` char(7) NOT NULL COMMENT 'The language code for the article.',
  `xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`state`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_featured_catid` (`featured`,`catid`),
  KEY `idx_language` (`language`),
  KEY `idx_xreference` (`xreference`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_content`
--

LOCK TABLES `lsf3y_content` WRITE;
/*!40000 ALTER TABLE `lsf3y_content` DISABLE KEYS */;
/*!40000 ALTER TABLE `lsf3y_content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_content_frontpage`
--

DROP TABLE IF EXISTS `lsf3y_content_frontpage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_content_frontpage` (
  `content_id` int(11) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_content_frontpage`
--

LOCK TABLES `lsf3y_content_frontpage` WRITE;
/*!40000 ALTER TABLE `lsf3y_content_frontpage` DISABLE KEYS */;
/*!40000 ALTER TABLE `lsf3y_content_frontpage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_content_rating`
--

DROP TABLE IF EXISTS `lsf3y_content_rating`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_content_rating` (
  `content_id` int(11) NOT NULL DEFAULT '0',
  `rating_sum` int(10) unsigned NOT NULL DEFAULT '0',
  `rating_count` int(10) unsigned NOT NULL DEFAULT '0',
  `lastip` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_content_rating`
--

LOCK TABLES `lsf3y_content_rating` WRITE;
/*!40000 ALTER TABLE `lsf3y_content_rating` DISABLE KEYS */;
/*!40000 ALTER TABLE `lsf3y_content_rating` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_core_log_searches`
--

DROP TABLE IF EXISTS `lsf3y_core_log_searches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_core_log_searches` (
  `search_term` varchar(128) NOT NULL DEFAULT '',
  `hits` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_core_log_searches`
--

LOCK TABLES `lsf3y_core_log_searches` WRITE;
/*!40000 ALTER TABLE `lsf3y_core_log_searches` DISABLE KEYS */;
/*!40000 ALTER TABLE `lsf3y_core_log_searches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_extensions`
--

DROP TABLE IF EXISTS `lsf3y_extensions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_extensions` (
  `extension_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `element` varchar(100) NOT NULL,
  `folder` varchar(100) NOT NULL,
  `client_id` tinyint(3) NOT NULL,
  `enabled` tinyint(3) NOT NULL DEFAULT '1',
  `access` int(10) unsigned NOT NULL DEFAULT '1',
  `protected` tinyint(3) NOT NULL DEFAULT '0',
  `manifest_cache` text NOT NULL,
  `params` text NOT NULL,
  `custom_data` text NOT NULL,
  `system_data` text NOT NULL,
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) DEFAULT '0',
  `state` int(11) DEFAULT '0',
  PRIMARY KEY (`extension_id`),
  KEY `element_clientid` (`element`,`client_id`),
  KEY `element_folder_clientid` (`element`,`folder`,`client_id`),
  KEY `extension` (`type`,`element`,`folder`,`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10037 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_extensions`
--

LOCK TABLES `lsf3y_extensions` WRITE;
/*!40000 ALTER TABLE `lsf3y_extensions` DISABLE KEYS */;
INSERT INTO `lsf3y_extensions` VALUES (1,'com_mailto','component','com_mailto','',0,1,1,1,'{\"legacy\":false,\"name\":\"com_mailto\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_MAILTO_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (2,'com_wrapper','component','com_wrapper','',0,1,1,1,'{\"legacy\":false,\"name\":\"com_wrapper\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\n\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_WRAPPER_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (3,'com_admin','component','com_admin','',1,1,1,1,'{\"legacy\":false,\"name\":\"com_admin\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\n\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_ADMIN_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (4,'com_banners','component','com_banners','',1,0,1,0,'{\"legacy\":false,\"name\":\"com_banners\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\n\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_BANNERS_XML_DESCRIPTION\",\"group\":\"\"}','{\"purchase_type\":\"3\",\"track_impressions\":\"0\",\"track_clicks\":\"0\",\"metakey_prefix\":\"\"}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (5,'com_cache','component','com_cache','',1,1,1,1,'{\"legacy\":false,\"name\":\"com_cache\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_CACHE_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (6,'com_categories','component','com_categories','',1,1,1,1,'{\"legacy\":false,\"name\":\"com_categories\",\"type\":\"component\",\"creationDate\":\"December 2007\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_CATEGORIES_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (7,'com_checkin','component','com_checkin','',1,1,1,1,'{\"legacy\":false,\"name\":\"com_checkin\",\"type\":\"component\",\"creationDate\":\"Unknown\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2008 Open Source Matters. All rights reserved.\\n\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_CHECKIN_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (8,'com_contact','component','com_contact','',1,0,1,0,'{\"legacy\":false,\"name\":\"com_contact\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\n\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_CONTACT_XML_DESCRIPTION\",\"group\":\"\"}','{\"show_contact_category\":\"hide\",\"show_contact_list\":\"0\",\"presentation_style\":\"sliders\",\"show_name\":\"1\",\"show_position\":\"1\",\"show_email\":\"0\",\"show_street_address\":\"1\",\"show_suburb\":\"1\",\"show_state\":\"1\",\"show_postcode\":\"1\",\"show_country\":\"1\",\"show_telephone\":\"1\",\"show_mobile\":\"1\",\"show_fax\":\"1\",\"show_webpage\":\"1\",\"show_misc\":\"1\",\"show_image\":\"1\",\"image\":\"\",\"allow_vcard\":\"0\",\"show_articles\":\"0\",\"show_profile\":\"0\",\"show_links\":\"0\",\"linka_name\":\"\",\"linkb_name\":\"\",\"linkc_name\":\"\",\"linkd_name\":\"\",\"linke_name\":\"\",\"contact_icons\":\"0\",\"icon_address\":\"\",\"icon_email\":\"\",\"icon_telephone\":\"\",\"icon_mobile\":\"\",\"icon_fax\":\"\",\"icon_misc\":\"\",\"show_headings\":\"1\",\"show_position_headings\":\"1\",\"show_email_headings\":\"0\",\"show_telephone_headings\":\"1\",\"show_mobile_headings\":\"0\",\"show_fax_headings\":\"0\",\"allow_vcard_headings\":\"0\",\"show_suburb_headings\":\"1\",\"show_state_headings\":\"1\",\"show_country_headings\":\"1\",\"show_email_form\":\"1\",\"show_email_copy\":\"1\",\"banned_email\":\"\",\"banned_subject\":\"\",\"banned_text\":\"\",\"validate_session\":\"1\",\"custom_reply\":\"0\",\"redirect\":\"\",\"show_category_crumb\":\"0\",\"metakey\":\"\",\"metadesc\":\"\",\"robots\":\"\",\"author\":\"\",\"rights\":\"\",\"xreference\":\"\"}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (9,'com_cpanel','component','com_cpanel','',1,1,1,1,'{\"legacy\":false,\"name\":\"com_cpanel\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_CPANEL_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (10,'com_installer','component','com_installer','',1,1,1,1,'{\"legacy\":false,\"name\":\"com_installer\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_INSTALLER_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (11,'com_languages','component','com_languages','',1,1,1,1,'{\"legacy\":false,\"name\":\"com_languages\",\"type\":\"component\",\"creationDate\":\"2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\n\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_LANGUAGES_XML_DESCRIPTION\",\"group\":\"\"}','{\"site\":\"en-GB\",\"administrator\":\"en-GB\"}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (12,'com_login','component','com_login','',1,1,1,1,'{\"legacy\":false,\"name\":\"com_login\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_LOGIN_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (13,'com_media','component','com_media','',1,1,0,1,'{\"legacy\":false,\"name\":\"com_media\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_MEDIA_XML_DESCRIPTION\",\"group\":\"\"}','{\"upload_extensions\":\"bmp,csv,doc,gif,ico,jpg,jpeg,odg,odp,ods,odt,pdf,png,ppt,swf,txt,xcf,xls,BMP,CSV,DOC,GIF,ICO,JPG,JPEG,ODG,ODP,ODS,ODT,PDF,PNG,PPT,SWF,TXT,XCF,XLS\",\"upload_maxsize\":\"10\",\"file_path\":\"images\",\"image_path\":\"images\",\"restrict_uploads\":\"1\",\"allowed_media_usergroup\":\"3\",\"check_mime\":\"1\",\"image_extensions\":\"bmp,gif,jpg,png\",\"ignore_extensions\":\"\",\"upload_mime\":\"image\\/jpeg,image\\/gif,image\\/png,image\\/bmp,application\\/x-shockwave-flash,application\\/msword,application\\/excel,application\\/pdf,application\\/powerpoint,text\\/plain,application\\/x-zip\",\"upload_mime_illegal\":\"text\\/html\"}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (14,'com_menus','component','com_menus','',1,1,1,1,'{\"legacy\":false,\"name\":\"com_menus\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_MENUS_XML_DESCRIPTION\",\"group\":\"\"}','{\"page_title\":\"\",\"show_page_heading\":0,\"page_heading\":\"\",\"pageclass_sfx\":\"\"}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (15,'com_messages','component','com_messages','',1,1,1,1,'{\"legacy\":false,\"name\":\"com_messages\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_MESSAGES_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (16,'com_modules','component','com_modules','',1,1,1,1,'{\"legacy\":false,\"name\":\"com_modules\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_MODULES_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (18,'com_plugins','component','com_plugins','',1,1,1,1,'{\"legacy\":false,\"name\":\"com_plugins\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_PLUGINS_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (19,'com_search','component','com_search','',1,1,1,1,'{\"legacy\":false,\"name\":\"com_search\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\n\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_SEARCH_XML_DESCRIPTION\",\"group\":\"\"}','{\"enabled\":\"0\",\"search_areas\":\"1\",\"show_date\":\"1\",\"opensearch_name\":\"\",\"opensearch_description\":\"\"}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (20,'com_templates','component','com_templates','',1,1,1,1,'{\"legacy\":false,\"name\":\"com_templates\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_TEMPLATES_XML_DESCRIPTION\",\"group\":\"\"}','{\"template_positions_display\":\"0\"}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (22,'com_content','component','com_content','',1,1,0,1,'{\"legacy\":false,\"name\":\"com_content\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_CONTENT_XML_DESCRIPTION\",\"group\":\"\"}','{\"article_layout\":\"_:default\",\"show_title\":\"1\",\"link_titles\":\"1\",\"show_intro\":\"1\",\"show_category\":\"1\",\"link_category\":\"1\",\"show_parent_category\":\"0\",\"link_parent_category\":\"0\",\"show_author\":\"1\",\"link_author\":\"0\",\"show_create_date\":\"0\",\"show_modify_date\":\"0\",\"show_publish_date\":\"1\",\"show_item_navigation\":\"1\",\"show_vote\":\"0\",\"show_readmore\":\"1\",\"show_readmore_title\":\"1\",\"readmore_limit\":\"100\",\"show_icons\":\"1\",\"show_print_icon\":\"1\",\"show_email_icon\":\"1\",\"show_hits\":\"1\",\"show_noauth\":\"0\",\"urls_position\":\"0\",\"show_publishing_options\":\"1\",\"show_article_options\":\"1\",\"show_urls_images_frontend\":\"0\",\"show_urls_images_backend\":\"1\",\"targeta\":0,\"targetb\":0,\"targetc\":0,\"float_intro\":\"left\",\"float_fulltext\":\"left\",\"category_layout\":\"_:blog\",\"show_category_heading_title_text\":\"1\",\"show_category_title\":\"0\",\"show_description\":\"0\",\"show_description_image\":\"0\",\"maxLevel\":\"1\",\"show_empty_categories\":\"0\",\"show_no_articles\":\"1\",\"show_subcat_desc\":\"1\",\"show_cat_num_articles\":\"0\",\"show_base_description\":\"1\",\"maxLevelcat\":\"-1\",\"show_empty_categories_cat\":\"0\",\"show_subcat_desc_cat\":\"1\",\"show_cat_num_articles_cat\":\"1\",\"num_leading_articles\":\"1\",\"num_intro_articles\":\"4\",\"num_columns\":\"2\",\"num_links\":\"4\",\"multi_column_order\":\"0\",\"show_subcategory_content\":\"0\",\"show_pagination_limit\":\"1\",\"filter_field\":\"hide\",\"show_headings\":\"1\",\"list_show_date\":\"0\",\"date_format\":\"\",\"list_show_hits\":\"1\",\"list_show_author\":\"1\",\"orderby_pri\":\"order\",\"orderby_sec\":\"rdate\",\"order_date\":\"published\",\"show_pagination\":\"2\",\"show_pagination_results\":\"1\",\"show_feed_link\":\"1\",\"feed_summary\":\"0\",\"feed_show_readmore\":\"0\"}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (23,'com_config','component','com_config','',1,1,0,1,'{\"legacy\":false,\"name\":\"com_config\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_CONFIG_XML_DESCRIPTION\",\"group\":\"\"}','{\"filters\":{\"1\":{\"filter_type\":\"NH\",\"filter_tags\":\"\",\"filter_attributes\":\"\"},\"6\":{\"filter_type\":\"BL\",\"filter_tags\":\"\",\"filter_attributes\":\"\"},\"7\":{\"filter_type\":\"NONE\",\"filter_tags\":\"\",\"filter_attributes\":\"\"},\"2\":{\"filter_type\":\"NH\",\"filter_tags\":\"\",\"filter_attributes\":\"\"},\"3\":{\"filter_type\":\"BL\",\"filter_tags\":\"\",\"filter_attributes\":\"\"},\"4\":{\"filter_type\":\"BL\",\"filter_tags\":\"\",\"filter_attributes\":\"\"},\"5\":{\"filter_type\":\"BL\",\"filter_tags\":\"\",\"filter_attributes\":\"\"},\"8\":{\"filter_type\":\"NONE\",\"filter_tags\":\"\",\"filter_attributes\":\"\"}}}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (24,'com_redirect','component','com_redirect','',1,1,0,1,'{\"legacy\":false,\"name\":\"com_redirect\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_REDIRECT_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (25,'com_users','component','com_users','',1,1,0,1,'{\"legacy\":false,\"name\":\"com_users\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_USERS_XML_DESCRIPTION\",\"group\":\"\"}','{\"allowUserRegistration\":\"1\",\"new_usertype\":\"2\",\"guest_usergroup\":\"1\",\"sendpassword\":\"1\",\"useractivation\":\"1\",\"mail_to_admin\":\"0\",\"captcha\":\"\",\"frontend_userparams\":\"1\",\"site_language\":\"0\",\"change_login_name\":\"0\",\"reset_count\":\"10\",\"reset_time\":\"1\",\"mailSubjectPrefix\":\"\",\"mailBodySuffix\":\"\"}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (28,'com_joomlaupdate','component','com_joomlaupdate','',1,0,0,0,'{\"legacy\":false,\"name\":\"com_joomlaupdate\",\"type\":\"component\",\"creationDate\":\"February 2012\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_JOOMLAUPDATE_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (100,'PHPMailer','library','phpmailer','',0,1,1,1,'{\"legacy\":false,\"name\":\"PHPMailer\",\"type\":\"library\",\"creationDate\":\"2001\",\"author\":\"PHPMailer\",\"copyright\":\"(c) 2001-2003, Brent R. Matzelle, (c) 2004-2009, Andy Prevost. All Rights Reserved., (c) 2010-2011, Jim Jagielski. All Rights Reserved.\",\"authorEmail\":\"jimjag@gmail.com\",\"authorUrl\":\"https:\\/\\/code.google.com\\/a\\/apache-extras.org\\/p\\/phpmailer\\/\",\"version\":\"5.2\",\"description\":\"LIB_PHPMAILER_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (101,'SimplePie','library','simplepie','',0,1,1,1,'{\"legacy\":false,\"name\":\"SimplePie\",\"type\":\"library\",\"creationDate\":\"2004\",\"author\":\"SimplePie\",\"copyright\":\"Copyright (c) 2004-2009, Ryan Parman and Geoffrey Sneddon\",\"authorEmail\":\"\",\"authorUrl\":\"http:\\/\\/simplepie.org\\/\",\"version\":\"1.2\",\"description\":\"LIB_SIMPLEPIE_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (102,'phputf8','library','phputf8','',0,1,1,1,'{\"legacy\":false,\"name\":\"phputf8\",\"type\":\"library\",\"creationDate\":\"2006\",\"author\":\"Harry Fuecks\",\"copyright\":\"Copyright various authors\",\"authorEmail\":\"hfuecks@gmail.com\",\"authorUrl\":\"http:\\/\\/sourceforge.net\\/projects\\/phputf8\",\"version\":\"0.5\",\"description\":\"LIB_PHPUTF8_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (103,'Joomla! Platform','library','joomla','',0,1,1,1,'{\"legacy\":false,\"name\":\"Joomla! Platform\",\"type\":\"library\",\"creationDate\":\"2008\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"http:\\/\\/www.joomla.org\",\"version\":\"11.4\",\"description\":\"LIB_JOOMLA_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (200,'mod_articles_archive','module','mod_articles_archive','',0,1,1,1,'{\"legacy\":false,\"name\":\"mod_articles_archive\",\"type\":\"module\",\"creationDate\":\"July 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters.\\n\\t\\tAll rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_ARTICLES_ARCHIVE_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (201,'mod_articles_latest','module','mod_articles_latest','',0,1,1,1,'{\"legacy\":false,\"name\":\"mod_articles_latest\",\"type\":\"module\",\"creationDate\":\"July 2004\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_LATEST_NEWS_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (203,'mod_banners','module','mod_banners','',0,0,1,0,'{\"legacy\":false,\"name\":\"mod_banners\",\"type\":\"module\",\"creationDate\":\"July 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_BANNERS_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (204,'mod_breadcrumbs','module','mod_breadcrumbs','',0,1,1,1,'{\"legacy\":false,\"name\":\"mod_breadcrumbs\",\"type\":\"module\",\"creationDate\":\"July 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_BREADCRUMBS_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (205,'mod_custom','module','mod_custom','',0,1,1,1,'{\"legacy\":false,\"name\":\"mod_custom\",\"type\":\"module\",\"creationDate\":\"July 2004\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_CUSTOM_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (206,'mod_feed','module','mod_feed','',0,1,1,1,'{\"legacy\":false,\"name\":\"mod_feed\",\"type\":\"module\",\"creationDate\":\"July 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_FEED_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (207,'mod_footer','module','mod_footer','',0,1,1,1,'{\"legacy\":false,\"name\":\"mod_footer\",\"type\":\"module\",\"creationDate\":\"July 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_FOOTER_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (208,'mod_login','module','mod_login','',0,1,1,1,'{\"legacy\":false,\"name\":\"mod_login\",\"type\":\"module\",\"creationDate\":\"July 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_LOGIN_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (209,'mod_menu','module','mod_menu','',0,1,1,1,'{\"legacy\":false,\"name\":\"mod_menu\",\"type\":\"module\",\"creationDate\":\"July 2004\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_MENU_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (210,'mod_articles_news','module','mod_articles_news','',0,0,1,0,'{\"legacy\":false,\"name\":\"mod_articles_news\",\"type\":\"module\",\"creationDate\":\"July 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_ARTICLES_NEWS_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (212,'mod_related_items','module','mod_related_items','',0,0,1,0,'{\"legacy\":false,\"name\":\"mod_related_items\",\"type\":\"module\",\"creationDate\":\"July 2004\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_RELATED_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (215,'mod_syndicate','module','mod_syndicate','',0,1,1,1,'{\"legacy\":false,\"name\":\"mod_syndicate\",\"type\":\"module\",\"creationDate\":\"May 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_SYNDICATE_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (216,'mod_users_latest','module','mod_users_latest','',0,1,1,1,'{\"legacy\":false,\"name\":\"mod_users_latest\",\"type\":\"module\",\"creationDate\":\"December 2009\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_USERS_LATEST_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (220,'mod_articles_category','module','mod_articles_category','',0,1,1,1,'{\"legacy\":false,\"name\":\"mod_articles_category\",\"type\":\"module\",\"creationDate\":\"February 2010\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_ARTICLES_CATEGORY_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (221,'mod_articles_categories','module','mod_articles_categories','',0,1,1,1,'{\"legacy\":false,\"name\":\"mod_articles_categories\",\"type\":\"module\",\"creationDate\":\"February 2010\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_ARTICLES_CATEGORIES_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (222,'mod_languages','module','mod_languages','',0,1,1,1,'{\"legacy\":false,\"name\":\"mod_languages\",\"type\":\"module\",\"creationDate\":\"February 2010\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_LANGUAGES_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (300,'mod_custom','module','mod_custom','',1,1,1,1,'{\"legacy\":false,\"name\":\"mod_custom\",\"type\":\"module\",\"creationDate\":\"July 2004\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_CUSTOM_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (301,'mod_feed','module','mod_feed','',1,0,1,0,'{\"legacy\":false,\"name\":\"mod_feed\",\"type\":\"module\",\"creationDate\":\"July 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_FEED_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (302,'mod_latest','module','mod_latest','',1,0,1,0,'{\"legacy\":false,\"name\":\"mod_latest\",\"type\":\"module\",\"creationDate\":\"July 2004\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_LATEST_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (303,'mod_logged','module','mod_logged','',1,0,1,0,'{\"legacy\":false,\"name\":\"mod_logged\",\"type\":\"module\",\"creationDate\":\"January 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_LOGGED_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (304,'mod_login','module','mod_login','',1,1,1,1,'{\"legacy\":false,\"name\":\"mod_login\",\"type\":\"module\",\"creationDate\":\"March 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_LOGIN_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (305,'mod_menu','module','mod_menu','',1,1,1,0,'{\"legacy\":false,\"name\":\"mod_menu\",\"type\":\"module\",\"creationDate\":\"March 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_MENU_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (308,'mod_quickicon','module','mod_quickicon','',1,1,1,1,'{\"legacy\":false,\"name\":\"mod_quickicon\",\"type\":\"module\",\"creationDate\":\"Nov 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_QUICKICON_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (310,'mod_submenu','module','mod_submenu','',1,1,1,0,'{\"legacy\":false,\"name\":\"mod_submenu\",\"type\":\"module\",\"creationDate\":\"Feb 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_SUBMENU_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (312,'mod_toolbar','module','mod_toolbar','',1,1,1,1,'{\"legacy\":false,\"name\":\"mod_toolbar\",\"type\":\"module\",\"creationDate\":\"Nov 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_TOOLBAR_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (314,'mod_version','module','mod_version','',1,0,1,0,'{\"legacy\":false,\"name\":\"mod_version\",\"type\":\"module\",\"creationDate\":\"January 2012\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_VERSION_XML_DESCRIPTION\",\"group\":\"\"}','{\"format\":\"short\",\"product\":\"1\",\"cache\":\"0\"}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (400,'plg_authentication_gmail','plugin','gmail','authentication',0,0,1,0,'{\"legacy\":false,\"name\":\"plg_authentication_gmail\",\"type\":\"plugin\",\"creationDate\":\"February 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_GMAIL_XML_DESCRIPTION\",\"group\":\"\"}','{\"applysuffix\":\"0\",\"suffix\":\"\",\"verifypeer\":\"1\",\"user_blacklist\":\"\"}','','',0,'0000-00-00 00:00:00',1,0);
INSERT INTO `lsf3y_extensions` VALUES (401,'plg_authentication_joomla','plugin','joomla','authentication',0,1,1,1,'{\"legacy\":false,\"name\":\"plg_authentication_joomla\",\"type\":\"plugin\",\"creationDate\":\"November 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_AUTH_JOOMLA_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (402,'plg_authentication_ldap','plugin','ldap','authentication',0,0,1,0,'{\"legacy\":false,\"name\":\"plg_authentication_ldap\",\"type\":\"plugin\",\"creationDate\":\"November 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_LDAP_XML_DESCRIPTION\",\"group\":\"\"}','{\"host\":\"\",\"port\":\"389\",\"use_ldapV3\":\"0\",\"negotiate_tls\":\"0\",\"no_referrals\":\"0\",\"auth_method\":\"bind\",\"base_dn\":\"\",\"search_string\":\"\",\"users_dn\":\"\",\"username\":\"admin\",\"password\":\"bobby7\",\"ldap_fullname\":\"fullName\",\"ldap_email\":\"mail\",\"ldap_uid\":\"uid\"}','','',0,'0000-00-00 00:00:00',3,0);
INSERT INTO `lsf3y_extensions` VALUES (404,'plg_content_emailcloak','plugin','emailcloak','content',0,0,1,0,'{\"legacy\":false,\"name\":\"plg_content_emailcloak\",\"type\":\"plugin\",\"creationDate\":\"November 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_CONTENT_EMAILCLOAK_XML_DESCRIPTION\",\"group\":\"\"}','{\"mode\":\"1\"}','','',0,'0000-00-00 00:00:00',1,0);
INSERT INTO `lsf3y_extensions` VALUES (405,'plg_content_geshi','plugin','geshi','content',0,0,1,0,'{\"legacy\":false,\"name\":\"plg_content_geshi\",\"type\":\"plugin\",\"creationDate\":\"November 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"\",\"authorUrl\":\"qbnz.com\\/highlighter\",\"version\":\"2.5.0\",\"description\":\"PLG_CONTENT_GESHI_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',2,0);
INSERT INTO `lsf3y_extensions` VALUES (406,'plg_content_loadmodule','plugin','loadmodule','content',0,0,1,0,'{\"legacy\":false,\"name\":\"plg_content_loadmodule\",\"type\":\"plugin\",\"creationDate\":\"November 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_LOADMODULE_XML_DESCRIPTION\",\"group\":\"\"}','{\"style\":\"xhtml\"}','','',0,'2011-09-18 15:22:50',0,0);
INSERT INTO `lsf3y_extensions` VALUES (407,'plg_content_pagebreak','plugin','pagebreak','content',0,1,1,1,'{\"legacy\":false,\"name\":\"plg_content_pagebreak\",\"type\":\"plugin\",\"creationDate\":\"November 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_CONTENT_PAGEBREAK_XML_DESCRIPTION\",\"group\":\"\"}','{\"title\":\"1\",\"multipage_toc\":\"1\",\"showall\":\"1\"}','','',0,'0000-00-00 00:00:00',4,0);
INSERT INTO `lsf3y_extensions` VALUES (408,'plg_content_pagenavigation','plugin','pagenavigation','content',0,1,1,1,'{\"legacy\":false,\"name\":\"plg_content_pagenavigation\",\"type\":\"plugin\",\"creationDate\":\"January 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_PAGENAVIGATION_XML_DESCRIPTION\",\"group\":\"\"}','{\"position\":\"1\"}','','',0,'0000-00-00 00:00:00',5,0);
INSERT INTO `lsf3y_extensions` VALUES (409,'plg_content_vote','plugin','vote','content',0,1,1,1,'{\"legacy\":false,\"name\":\"plg_content_vote\",\"type\":\"plugin\",\"creationDate\":\"November 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_VOTE_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',6,0);
INSERT INTO `lsf3y_extensions` VALUES (410,'plg_editors_codemirror','plugin','codemirror','editors',0,1,1,1,'{\"legacy\":false,\"name\":\"plg_editors_codemirror\",\"type\":\"plugin\",\"creationDate\":\"28 March 2011\",\"author\":\"Marijn Haverbeke\",\"copyright\":\"\",\"authorEmail\":\"N\\/A\",\"authorUrl\":\"\",\"version\":\"1.0\",\"description\":\"PLG_CODEMIRROR_XML_DESCRIPTION\",\"group\":\"\"}','{\"linenumbers\":\"0\",\"tabmode\":\"indent\"}','','',0,'0000-00-00 00:00:00',1,0);
INSERT INTO `lsf3y_extensions` VALUES (411,'plg_editors_none','plugin','none','editors',0,1,1,1,'{\"legacy\":false,\"name\":\"plg_editors_none\",\"type\":\"plugin\",\"creationDate\":\"August 2004\",\"author\":\"Unknown\",\"copyright\":\"\",\"authorEmail\":\"N\\/A\",\"authorUrl\":\"\",\"version\":\"2.5.0\",\"description\":\"PLG_NONE_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',2,0);
INSERT INTO `lsf3y_extensions` VALUES (412,'plg_editors_tinymce','plugin','tinymce','editors',0,1,1,1,'{\"legacy\":false,\"name\":\"plg_editors_tinymce\",\"type\":\"plugin\",\"creationDate\":\"2005-2013\",\"author\":\"Moxiecode Systems AB\",\"copyright\":\"Moxiecode Systems AB\",\"authorEmail\":\"N\\/A\",\"authorUrl\":\"tinymce.moxiecode.com\\/\",\"version\":\"3.5.4.1\",\"description\":\"PLG_TINY_XML_DESCRIPTION\",\"group\":\"\"}','{\"mode\":\"1\",\"skin\":\"0\",\"entity_encoding\":\"raw\",\"lang_mode\":\"0\",\"lang_code\":\"en\",\"text_direction\":\"ltr\",\"content_css\":\"1\",\"content_css_custom\":\"\",\"relative_urls\":\"1\",\"newlines\":\"0\",\"invalid_elements\":\"script,applet,iframe\",\"extended_elements\":\"\",\"toolbar\":\"top\",\"toolbar_align\":\"left\",\"html_height\":\"550\",\"html_width\":\"750\",\"resizing\":\"true\",\"resize_horizontal\":\"false\",\"element_path\":\"1\",\"fonts\":\"1\",\"paste\":\"1\",\"searchreplace\":\"1\",\"insertdate\":\"1\",\"format_date\":\"%Y-%m-%d\",\"inserttime\":\"1\",\"format_time\":\"%H:%M:%S\",\"colors\":\"1\",\"table\":\"1\",\"smilies\":\"1\",\"media\":\"1\",\"hr\":\"1\",\"directionality\":\"1\",\"fullscreen\":\"1\",\"style\":\"1\",\"layer\":\"1\",\"xhtmlxtras\":\"1\",\"visualchars\":\"1\",\"nonbreaking\":\"1\",\"template\":\"1\",\"blockquote\":\"1\",\"wordcount\":\"1\",\"advimage\":\"1\",\"advlink\":\"1\",\"advlist\":\"1\",\"autosave\":\"1\",\"contextmenu\":\"1\",\"inlinepopups\":\"1\",\"custom_plugin\":\"\",\"custom_button\":\"\"}','','',0,'0000-00-00 00:00:00',3,0);
INSERT INTO `lsf3y_extensions` VALUES (413,'plg_editors-xtd_article','plugin','article','editors-xtd',0,1,1,1,'{\"legacy\":false,\"name\":\"plg_editors-xtd_article\",\"type\":\"plugin\",\"creationDate\":\"October 2009\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_ARTICLE_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',1,0);
INSERT INTO `lsf3y_extensions` VALUES (414,'plg_editors-xtd_image','plugin','image','editors-xtd',0,0,1,0,'{\"legacy\":false,\"name\":\"plg_editors-xtd_image\",\"type\":\"plugin\",\"creationDate\":\"August 2004\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_IMAGE_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',2,0);
INSERT INTO `lsf3y_extensions` VALUES (415,'plg_editors-xtd_pagebreak','plugin','pagebreak','editors-xtd',0,0,1,0,'{\"legacy\":false,\"name\":\"plg_editors-xtd_pagebreak\",\"type\":\"plugin\",\"creationDate\":\"August 2004\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_EDITORSXTD_PAGEBREAK_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',3,0);
INSERT INTO `lsf3y_extensions` VALUES (416,'plg_editors-xtd_readmore','plugin','readmore','editors-xtd',0,0,1,0,'{\"legacy\":false,\"name\":\"plg_editors-xtd_readmore\",\"type\":\"plugin\",\"creationDate\":\"March 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_READMORE_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',4,0);
INSERT INTO `lsf3y_extensions` VALUES (422,'plg_system_languagefilter','plugin','languagefilter','system',0,0,1,1,'{\"legacy\":false,\"name\":\"plg_system_languagefilter\",\"type\":\"plugin\",\"creationDate\":\"July 2010\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_SYSTEM_LANGUAGEFILTER_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',1,0);
INSERT INTO `lsf3y_extensions` VALUES (423,'plg_system_p3p','plugin','p3p','system',0,1,1,1,'{\"legacy\":false,\"name\":\"plg_system_p3p\",\"type\":\"plugin\",\"creationDate\":\"September 2010\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_P3P_XML_DESCRIPTION\",\"group\":\"\"}','{\"headers\":\"NOI ADM DEV PSAi COM NAV OUR OTRo STP IND DEM\"}','','',0,'0000-00-00 00:00:00',2,0);
INSERT INTO `lsf3y_extensions` VALUES (424,'plg_system_cache','plugin','cache','system',0,0,1,1,'{\"legacy\":false,\"name\":\"plg_system_cache\",\"type\":\"plugin\",\"creationDate\":\"February 2007\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_CACHE_XML_DESCRIPTION\",\"group\":\"\"}','{\"browsercache\":\"0\",\"cachetime\":\"15\"}','','',0,'0000-00-00 00:00:00',9,0);
INSERT INTO `lsf3y_extensions` VALUES (425,'plg_system_debug','plugin','debug','system',0,1,1,0,'{\"legacy\":false,\"name\":\"plg_system_debug\",\"type\":\"plugin\",\"creationDate\":\"December 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_DEBUG_XML_DESCRIPTION\",\"group\":\"\"}','{\"profile\":\"1\",\"queries\":\"1\",\"memory\":\"1\",\"language_files\":\"1\",\"language_strings\":\"1\",\"strip-first\":\"1\",\"strip-prefix\":\"\",\"strip-suffix\":\"\"}','','',0,'0000-00-00 00:00:00',4,0);
INSERT INTO `lsf3y_extensions` VALUES (426,'plg_system_log','plugin','log','system',0,1,1,1,'{\"legacy\":false,\"name\":\"plg_system_log\",\"type\":\"plugin\",\"creationDate\":\"April 2007\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_LOG_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',5,0);
INSERT INTO `lsf3y_extensions` VALUES (427,'plg_system_redirect','plugin','redirect','system',0,1,1,1,'{\"legacy\":false,\"name\":\"plg_system_redirect\",\"type\":\"plugin\",\"creationDate\":\"April 2009\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_REDIRECT_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',6,0);
INSERT INTO `lsf3y_extensions` VALUES (428,'plg_system_remember','plugin','remember','system',0,1,1,1,'{\"legacy\":false,\"name\":\"plg_system_remember\",\"type\":\"plugin\",\"creationDate\":\"April 2007\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_REMEMBER_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',7,0);
INSERT INTO `lsf3y_extensions` VALUES (429,'plg_system_sef','plugin','sef','system',0,1,1,0,'{\"legacy\":false,\"name\":\"plg_system_sef\",\"type\":\"plugin\",\"creationDate\":\"December 2007\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_SEF_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',8,0);
INSERT INTO `lsf3y_extensions` VALUES (430,'plg_system_logout','plugin','logout','system',0,1,1,1,'{\"legacy\":false,\"name\":\"plg_system_logout\",\"type\":\"plugin\",\"creationDate\":\"April 2009\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_SYSTEM_LOGOUT_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',3,0);
INSERT INTO `lsf3y_extensions` VALUES (431,'plg_user_contactcreator','plugin','contactcreator','user',0,0,1,1,'{\"legacy\":false,\"name\":\"plg_user_contactcreator\",\"type\":\"plugin\",\"creationDate\":\"August 2009\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_CONTACTCREATOR_XML_DESCRIPTION\",\"group\":\"\"}','{\"autowebpage\":\"\",\"category\":\"34\",\"autopublish\":\"0\"}','','',0,'0000-00-00 00:00:00',1,0);
INSERT INTO `lsf3y_extensions` VALUES (432,'plg_user_joomla','plugin','joomla','user',0,1,1,0,'{\"legacy\":false,\"name\":\"plg_user_joomla\",\"type\":\"plugin\",\"creationDate\":\"December 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2009 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_USER_JOOMLA_XML_DESCRIPTION\",\"group\":\"\"}','{\"autoregister\":\"1\"}','','',0,'0000-00-00 00:00:00',2,0);
INSERT INTO `lsf3y_extensions` VALUES (433,'plg_user_profile','plugin','profile','user',0,0,1,1,'{\"legacy\":false,\"name\":\"plg_user_profile\",\"type\":\"plugin\",\"creationDate\":\"January 2008\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_USER_PROFILE_XML_DESCRIPTION\",\"group\":\"\"}','{\"register-require_address1\":\"1\",\"register-require_address2\":\"1\",\"register-require_city\":\"1\",\"register-require_region\":\"1\",\"register-require_country\":\"1\",\"register-require_postal_code\":\"1\",\"register-require_phone\":\"1\",\"register-require_website\":\"1\",\"register-require_favoritebook\":\"1\",\"register-require_aboutme\":\"1\",\"register-require_tos\":\"1\",\"register-require_dob\":\"1\",\"profile-require_address1\":\"1\",\"profile-require_address2\":\"1\",\"profile-require_city\":\"1\",\"profile-require_region\":\"1\",\"profile-require_country\":\"1\",\"profile-require_postal_code\":\"1\",\"profile-require_phone\":\"1\",\"profile-require_website\":\"1\",\"profile-require_favoritebook\":\"1\",\"profile-require_aboutme\":\"1\",\"profile-require_tos\":\"1\",\"profile-require_dob\":\"1\"}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (434,'plg_extension_joomla','plugin','joomla','extension',0,1,1,1,'{\"legacy\":false,\"name\":\"plg_extension_joomla\",\"type\":\"plugin\",\"creationDate\":\"May 2010\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_EXTENSION_JOOMLA_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',1,0);
INSERT INTO `lsf3y_extensions` VALUES (435,'plg_content_joomla','plugin','joomla','content',0,0,1,0,'{\"legacy\":false,\"name\":\"plg_content_joomla\",\"type\":\"plugin\",\"creationDate\":\"November 2010\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_CONTENT_JOOMLA_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (436,'plg_system_languagecode','plugin','languagecode','system',0,0,1,0,'{\"legacy\":false,\"name\":\"plg_system_languagecode\",\"type\":\"plugin\",\"creationDate\":\"November 2011\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_SYSTEM_LANGUAGECODE_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',10,0);
INSERT INTO `lsf3y_extensions` VALUES (437,'plg_quickicon_joomlaupdate','plugin','joomlaupdate','quickicon',0,1,1,1,'{\"legacy\":false,\"name\":\"plg_quickicon_joomlaupdate\",\"type\":\"plugin\",\"creationDate\":\"August 2011\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_QUICKICON_JOOMLAUPDATE_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (438,'plg_quickicon_extensionupdate','plugin','extensionupdate','quickicon',0,1,1,1,'{\"legacy\":false,\"name\":\"plg_quickicon_extensionupdate\",\"type\":\"plugin\",\"creationDate\":\"August 2011\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_QUICKICON_EXTENSIONUPDATE_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (439,'plg_captcha_recaptcha','plugin','recaptcha','captcha',0,0,1,0,'{\"legacy\":false,\"name\":\"plg_captcha_recaptcha\",\"type\":\"plugin\",\"creationDate\":\"December 2011\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_CAPTCHA_RECAPTCHA_XML_DESCRIPTION\",\"group\":\"\"}','{\"public_key\":\"\",\"private_key\":\"\",\"theme\":\"clean\"}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (441,'plg_content_finder','plugin','finder','content',0,0,1,0,'{\"legacy\":false,\"name\":\"plg_content_finder\",\"type\":\"plugin\",\"creationDate\":\"December 2011\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_CONTENT_FINDER_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (500,'atomic','template','atomic','',0,0,1,0,'{\"legacy\":false,\"name\":\"atomic\",\"type\":\"template\",\"creationDate\":\"10\\/10\\/09\",\"author\":\"Ron Severdia\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.\",\"authorEmail\":\"contact@kontentdesign.com\",\"authorUrl\":\"http:\\/\\/www.kontentdesign.com\",\"version\":\"2.5.0\",\"description\":\"TPL_ATOMIC_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (502,'bluestork','template','bluestork','',1,1,1,0,'{\"legacy\":false,\"name\":\"bluestork\",\"type\":\"template\",\"creationDate\":\"07\\/02\\/09\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"TPL_BLUESTORK_XML_DESCRIPTION\",\"group\":\"\"}','{\"useRoundedCorners\":\"1\",\"showSiteName\":\"0\",\"textBig\":\"0\",\"highContrast\":\"0\"}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (503,'beez_20','template','beez_20','',0,0,1,0,'{\"legacy\":false,\"name\":\"beez_20\",\"type\":\"template\",\"creationDate\":\"25 November 2009\",\"author\":\"Angie Radtke\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.\",\"authorEmail\":\"a.radtke@derauftritt.de\",\"authorUrl\":\"http:\\/\\/www.der-auftritt.de\",\"version\":\"2.5.0\",\"description\":\"TPL_BEEZ2_XML_DESCRIPTION\",\"group\":\"\"}','{\"wrapperSmall\":\"53\",\"wrapperLarge\":\"72\",\"sitetitle\":\"\",\"sitedescription\":\"\",\"navposition\":\"center\",\"templatecolor\":\"nature\"}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (504,'hathor','template','hathor','',1,1,1,0,'{\"legacy\":false,\"name\":\"hathor\",\"type\":\"template\",\"creationDate\":\"May 2010\",\"author\":\"Andrea Tarr\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.\",\"authorEmail\":\"hathor@tarrconsulting.com\",\"authorUrl\":\"http:\\/\\/www.tarrconsulting.com\",\"version\":\"2.5.0\",\"description\":\"TPL_HATHOR_XML_DESCRIPTION\",\"group\":\"\"}','{\"showSiteName\":\"0\",\"colourChoice\":\"0\",\"boldText\":\"0\"}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (505,'beez5','template','beez5','',0,0,1,0,'{\"legacy\":false,\"name\":\"beez5\",\"type\":\"template\",\"creationDate\":\"21 May 2010\",\"author\":\"Angie Radtke\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.\",\"authorEmail\":\"a.radtke@derauftritt.de\",\"authorUrl\":\"http:\\/\\/www.der-auftritt.de\",\"version\":\"2.5.0\",\"description\":\"TPL_BEEZ5_XML_DESCRIPTION\",\"group\":\"\"}','{\"wrapperSmall\":\"53\",\"wrapperLarge\":\"72\",\"sitetitle\":\"\",\"sitedescription\":\"\",\"navposition\":\"center\",\"html5\":\"0\"}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (600,'English (United Kingdom)','language','en-GB','',0,1,1,1,'{\"legacy\":false,\"name\":\"English (United Kingdom)\",\"type\":\"language\",\"creationDate\":\"2008-03-15\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.10\",\"description\":\"en-GB site language\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (601,'English (United Kingdom)','language','en-GB','',1,1,1,1,'{\"legacy\":false,\"name\":\"English (United Kingdom)\",\"type\":\"language\",\"creationDate\":\"2008-03-15\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.10\",\"description\":\"en-GB administrator language\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (700,'files_joomla','file','joomla','',0,1,1,1,'{\"legacy\":false,\"name\":\"files_joomla\",\"type\":\"file\",\"creationDate\":\"April 2013\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.11\",\"description\":\"FILES_JOOMLA_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (800,'PKG_JOOMLA','package','pkg_joomla','',0,1,1,1,'{\"legacy\":false,\"name\":\"PKG_JOOMLA\",\"type\":\"package\",\"creationDate\":\"2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"http:\\/\\/www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PKG_JOOMLA_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (10000,'Dioscouri Library','library','dioscouri','',0,1,1,0,'{\"legacy\":false,\"name\":\"Dioscouri Library\",\"type\":\"library\",\"creationDate\":\"June 2012\",\"author\":\"Dioscouri Design\",\"copyright\":\"Copyright (C) 2012 Dioscouri Design. All rights reserved.\",\"authorEmail\":\"info@dioscouri.com\",\"authorUrl\":\"www.dioscouri.com\",\"version\":\"3.8.0\",\"description\":\"\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (10001,'System - Dioscouri','plugin','dioscouri','system',0,1,1,0,'{\"legacy\":false,\"name\":\"System - Dioscouri\",\"type\":\"plugin\",\"creationDate\":\"June 2012\",\"author\":\"Dioscouri Design\",\"copyright\":\"2012 Dioscouri.com\",\"authorEmail\":\"info@dioscouri.com\",\"authorUrl\":\"http:\\/\\/www.dioscouri.com\",\"version\":\"3.8.0\",\"description\":\"Adds the Dioscouri Library to the Autoloader\",\"group\":\"\"}','{\"embedjquery\":\"0\",\"jquerynoconflict\":\"1\",\"embedbootstrap\":\"0\",\"bootstrapversion\":\"default\",\"bootstrapjoomla\":\"0\",\"activeAdmin\":\"1\"}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (10002,'Mediamanager - Categories','module','mod_mediamanager_categories','',0,1,0,0,'{\"legacy\":true,\"name\":\"Mediamanager - Categories\",\"type\":\"module\",\"creationDate\":\"August 2010\",\"author\":\"Dioscouri\",\"copyright\":\"2010 Dioscouri.com\",\"authorEmail\":\"info@dioscouri.com\",\"authorUrl\":\"http:\\/\\/www.dioscouri.com\",\"version\":\"0.1.0\",\"description\":\"Displays category filters for a library\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (10003,'Mediamanager - Media Item','module','mod_mediamanager_media','',0,1,0,0,'{\"legacy\":true,\"name\":\"Mediamanager - Media Item\",\"type\":\"module\",\"creationDate\":\"August 2010\",\"author\":\"Dioscouri\",\"copyright\":\"2010 Dioscouri.com\",\"authorEmail\":\"info@dioscouri.com\",\"authorUrl\":\"http:\\/\\/www.dioscouri.com\",\"version\":\"0.1.0\",\"description\":\"Enables user to display a single media item\",\"group\":\"\"}','{\"owncache\":\"1\",\"cache_time\":\"900\"}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (10004,'Mediamanager - Audio - JWPlayer','plugin','audio_jwplayer','mediamanager',0,0,1,0,'{\"legacy\":true,\"name\":\"Mediamanager - Audio - JWPlayer\",\"type\":\"plugin\",\"creationDate\":\"August 2010\",\"author\":\"Dioscouri Design\",\"copyright\":\"2010 Dioscouri.com\",\"authorEmail\":\"info@dioscouri.com\",\"authorUrl\":\"http:\\/\\/www.dioscouri.com\",\"version\":\"1.0.0\",\"description\":\"JWPlayer Audio handler for MediaManager\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (10005,'MediaManager Content Plugin','plugin','mediamanager','content',0,0,1,0,'{\"legacy\":true,\"name\":\"MediaManager Content Plugin\",\"type\":\"plugin\",\"creationDate\":\"August 2010\",\"author\":\"Dioscouri\",\"copyright\":\"2010 Dioscouri.com\",\"authorEmail\":\"info@dioscouri.com\",\"authorUrl\":\"http:\\/\\/www.dioscouri.com\",\"version\":\"0.7.1\",\"description\":\"Shows a mediamanager item in content. \\n\\tUsage: {mediamanager id=1}\\n\\t\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (10006,'Mediamanager - Video - JPlayer','plugin','video_jplayer','mediamanager',0,0,1,0,'{\"legacy\":true,\"name\":\"Mediamanager - Video - JPlayer\",\"type\":\"plugin\",\"creationDate\":\"August 2010\",\"author\":\"Dioscouri Design\",\"copyright\":\"2010 Dioscouri.com\",\"authorEmail\":\"info@dioscouri.com\",\"authorUrl\":\"http:\\/\\/www.dioscouri.com\",\"version\":\"1.0.0\",\"description\":\"JWPlayer Video handler for MediaManager\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (10007,'Search - Mediamanager','plugin','mediamanager','search',0,0,1,0,'{\"legacy\":true,\"name\":\"Search - Mediamanager\",\"type\":\"plugin\",\"creationDate\":\"August 2011\",\"author\":\"Dioscouri\",\"copyright\":\"2010 Dioscouri.com\",\"authorEmail\":\"info@dioscouri.com\",\"authorUrl\":\"http:\\/\\/www.dioscouri.com\",\"version\":\"0.1.0\",\"description\":\"Enables searching the Mediamanager in core search component\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (10008,'Mediamanager - Slideshow - Default','plugin','slideshow_default','mediamanager',0,1,1,0,'{\"legacy\":true,\"name\":\"Mediamanager - Slideshow - Default\",\"type\":\"plugin\",\"creationDate\":\"August 2010\",\"author\":\"Dioscouri Design\",\"copyright\":\"2010 Dioscouri.com\",\"authorEmail\":\"info@dioscouri.com\",\"authorUrl\":\"http:\\/\\/www.dioscouri.com\",\"version\":\"1.0.0\",\"description\":\"Default slideshow handler for MediaManager\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (10009,'Mediamanager - Slideshow - Pikachoose','plugin','slideshow_pikachoose','mediamanager',0,0,1,0,'{\"legacy\":true,\"name\":\"Mediamanager - Slideshow - Pikachoose\",\"type\":\"plugin\",\"creationDate\":\"August 2010\",\"author\":\"Dioscouri Design\",\"copyright\":\"2010 Dioscouri.com\",\"authorEmail\":\"info@dioscouri.com\",\"authorUrl\":\"http:\\/\\/www.dioscouri.com\",\"version\":\"1.0.0\",\"description\":\"Pikachoose slideshow handler for MediaManager\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (10010,'Mediamanager - Video - JWPlayer','plugin','video_jwplayer','mediamanager',0,0,1,0,'{\"legacy\":true,\"name\":\"Mediamanager - Video - JWPlayer\",\"type\":\"plugin\",\"creationDate\":\"August 2010\",\"author\":\"Dioscouri Design\",\"copyright\":\"2010 Dioscouri.com\",\"authorEmail\":\"info@dioscouri.com\",\"authorUrl\":\"http:\\/\\/www.dioscouri.com\",\"version\":\"1.0.0\",\"description\":\"JWPlayer Video handler for MediaManager\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (10011,'mediamanager','component','com_mediamanager','',1,1,0,0,'{\"legacy\":true,\"name\":\"Mediamanager\",\"type\":\"component\",\"creationDate\":\"November 2011\",\"author\":\"Dioscouri\",\"copyright\":\"2011 Dioscouri.com\",\"authorEmail\":\"info@dioscouri.com\",\"authorUrl\":\"http:\\/\\/www.dioscouri.com\",\"version\":\"1.0\",\"description\":\"A Mediamanager extension for Joomla\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (10012,'audio_jplayer','plugin','audio_jplayer','mediamanager',0,1,1,0,'{\"legacy\":true,\"name\":\"Mediamanager - Audio - JPlayer\",\"type\":\"plugin\",\"creationDate\":\"August 2010\",\"author\":\"Dioscouri Design\",\"copyright\":\"2010 Dioscouri.com\",\"authorEmail\":\"info@dioscouri.com\",\"authorUrl\":\"http:\\/\\/www.dioscouri.com\",\"version\":\"1.0.0\",\"description\":\"JPlayer Audio handler for Mediamanager\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,-1);
INSERT INTO `lsf3y_extensions` VALUES (10013,'Mediamanager - Slideshow - Kiosk','plugin','slideshow_kiosk','mediamanager',0,1,1,0,'{\"legacy\":true,\"name\":\"Mediamanager - Slideshow - Kiosk\",\"type\":\"plugin\",\"creationDate\":\"August 2010\",\"author\":\"Dioscouri Design\",\"copyright\":\"2010 Dioscouri.com\",\"authorEmail\":\"info@dioscouri.com\",\"authorUrl\":\"http:\\/\\/www.dioscouri.com\",\"version\":\"1.0.0\",\"description\":\"Kiosk slideshow handler for MediaManager\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (10014,'Kiosk','template','kiosk','',0,1,1,0,'{\"legacy\":false,\"name\":\"Kiosk\",\"type\":\"template\",\"creationDate\":\"21 March 2012\",\"author\":\"Chris French\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.\",\"authorEmail\":\"chris@ammonitenetworks.com\",\"authorUrl\":\"http:\\/\\/www.ammonitenetworks.com\",\"version\":\"2.5.0\",\"description\":\"Kisok\",\"group\":\"\"}','{\"wrapperSmall\":\"53\",\"wrapperLarge\":\"72\",\"sitetitle\":\"\",\"sitedescription\":\"\",\"navposition\":\"center\",\"html5\":\"0\"}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (10017,'rt_missioncontrol','template','rt_missioncontrol','',1,1,1,0,'{\"legacy\":false,\"name\":\"rt_missioncontrol\",\"type\":\"template\",\"creationDate\":\"April 10, 2012\",\"author\":\"RocketTheme, LLC\",\"copyright\":\"(C) 2005 - 2012 RocketTheme, LLC. All rights reserved.\",\"authorEmail\":\"support@rockettheme.com\",\"authorUrl\":\"http:\\/\\/www.rockettheme.com\",\"version\":\"2.6\",\"description\":\"MC_TEMPLATE_DESC\",\"group\":\"\"}','{\"adminTitle\":\"Joomla Administrator\",\"templateWidth\":\"variable\",\"dashboard\":\"MissionControl is a brand-new take on the Joomla Administrator template.  Primary objectives during development were clean modern design, optimal usability, configurable colors and logo, and enhanced functionality via optimizations and new extensions.\",\"menuwidth\":\"small\",\"extendmenu\":\"off\",\"enableGravatar\":\"1\",\"enableSessionBar\":\"1\",\"enableTransitions\":\"enabled\",\"enableQuickEditor\":\"1\",\"enableViewSite\":\"1\",\"enableQuickCheckin\":\"0\",\"enableQuickCacheClean\":\"1\",\"enableFancyHeaders\":\"fancy\",\"showhelp\":\"1\",\"showhelpbutton\":\"1\",\"showlangmenu\":\"1\",\"body_text_color\":\"#333333\",\"body_link_color\":\"#4486BA\",\"header_bg_color\":\"#333333\",\"header_text_color\":\"#CCCCCC\",\"header_link_color\":\"#FFFFFF\",\"header_shadow_color\":\"#000000\",\"tab_bg_color\":\"#4D4D4D\",\"tab_text_color\":\"#FFFFFF\",\"special_bg_color\":\"#C62D2D\",\"special_text_color\":\"#FFFFFF\",\"active_bg_color\":\"#4F9BD8\",\"active_text_color\":\"#FFFFFF\",\"hover_bg_color\":\"#88B719\",\"hover_text_color\":\"#FFFFFF\"}','{\"last_update\":1368721253}','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (10018,'System - MissionControl Support','plugin','missioncontrol','system',0,1,1,0,'{\"legacy\":false,\"name\":\"System - MissionControl Support\",\"type\":\"plugin\",\"creationDate\":\"April 10, 2012\",\"author\":\"RocketTheme, LLC\",\"copyright\":\"(C) 2005 - 2012 RocketTheme, LLC. All rights reserved.\",\"authorEmail\":\"support@rockettheme.com\",\"authorUrl\":\"http:\\/\\/www.rockettheme.com\",\"version\":\"2.6\",\"description\":\"MissionControl Support Plugin\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',1,0);
INSERT INTO `lsf3y_extensions` VALUES (10019,'System - RokTracking','plugin','roktracking','system',0,1,1,0,'{\"legacy\":false,\"name\":\"System - RokTracking\",\"type\":\"plugin\",\"creationDate\":\"April 10, 2012\",\"author\":\"RocketTheme, LLC\",\"copyright\":\"(C) 2005 - 2012 RocketTheme, LLC. All rights reserved.\",\"authorEmail\":\"support@rockettheme.com\",\"authorUrl\":\"http:\\/\\/www.rockettheme.com\",\"version\":\"2.6\",\"description\":\"User Tracking Plugin\",\"group\":\"\"}','{\"userpurgedays\":\"14\",\"adminpurgedays\":\"14\",\"trackusers\":\"1\",\"trackadmins\":\"1\"}','','',0,'0000-00-00 00:00:00',1,0);
INSERT INTO `lsf3y_extensions` VALUES (10020,'RokQuickLinks','module','mod_rokquicklinks','',1,1,1,0,'{\"legacy\":false,\"name\":\"RokQuickLinks\",\"type\":\"module\",\"creationDate\":\"April 10, 2012\",\"author\":\"RocketTheme, LLC\",\"copyright\":\"(C) 2005 - 2012 RocketTheme, LLC. All rights reserved.\",\"authorEmail\":\"support@rockettheme.com\",\"authorUrl\":\"http:\\/\\/www.rockettheme.com\",\"version\":\"2.6\",\"description\":\"MC_RQL_ROKQUICKLINKS_DESC\",\"group\":\"\"}','{\"iconpath\":\"\\/administrator\\/modules\\/mod_rokquicklinks\\/tmpl\\/icons\\/\",\"quickfields\":\"[{\'icon\':\'newspaper_add.png\',\'target\':\'self\',\'link\':\'index.php?option=com_content&task=article.edit\',\'title\':\'Add Article\'},{\'icon\':\'images.png\',\'target\':\'self\',\'link\':\'index.php?option=com_media\',\'title\':\'Media Manager\'},{\'icon\':\'drawer_open.png\',\'target\':\'self\',\'link\':\'index.php?option=com_categories&section=com_content\',\'title\':\'Category Manager\'},{\'icon\':\'cog.png\',\'target\':\'self\',\'link\':\'index.php?option=com_config\',\'title\':\'Configuration\'},{\'icon\':\'brick.png\',\'target\':\'self\',\'link\':\'index.php?option=com_installer\',\'title\':\'Install New\'},{\'icon\':\'color_management.png\',\'target\':\'self\',\'link\':\'index.php?option=com_templates\',\'title\':\'Templates\'}]\"}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (10021,'RokUserStats','module','mod_rokuserstats','',1,1,1,0,'{\"legacy\":false,\"name\":\"RokUserStats\",\"type\":\"module\",\"creationDate\":\"April 10, 2012\",\"author\":\"RocketTheme, LLC\",\"copyright\":\"(C) 2005 - 2012 RocketTheme, LLC. All rights reserved.\",\"authorEmail\":\"support@rockettheme.com\",\"authorUrl\":\"http:\\/\\/www.rockettheme.com\",\"version\":\"2.6\",\"description\":\"MC_RUS_ROKUSERSTATS_DESC\",\"group\":\"\"}','{\"showstats\":\"1\"}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (10022,'RokStats','module','mod_rokstats','',0,1,1,0,'{\"legacy\":false,\"name\":\"RokStats\",\"type\":\"module\",\"creationDate\":\"April 10, 2012\",\"author\":\"RocketTheme, LLC\",\"copyright\":\"(C) 2005 - 2012 RocketTheme, LLC. All rights reserved.\",\"authorEmail\":\"support@rockettheme.com\",\"authorUrl\":\"http:\\/\\/www.rockettheme.com\",\"version\":\"2.6\",\"description\":\"MC_RS_ROKUSERSTATS_DESC\",\"group\":\"\"}','{\"sessiontime\":\"\",\"showcurrentactiveusers\":\"1\",\"showactiveguests\":\"1\",\"showactiveregistered\":\"1\",\"showregisteredusernames\":\"0\",\"showuniqueviststoday\":\"1\",\"showuniquevistsyesterday\":\"1\",\"showvisitsthisweek\":\"1\",\"showvisitspreviousweek\":\"1\",\"showtotalarticles\":\"0\",\"shownewarticlesthisweek\":\"0\"}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (10023,'RokUserChart','module','mod_rokuserchart','',1,1,1,0,'{\"legacy\":false,\"name\":\"RokUserChart\",\"type\":\"module\",\"creationDate\":\"April 10, 2012\",\"author\":\"RocketTheme, LLC\",\"copyright\":\"(C) 2005 - 2012 RocketTheme, LLC. All rights reserved.\",\"authorEmail\":\"support@rockettheme.com\",\"authorUrl\":\"http:\\/\\/www.rockettheme.com\",\"version\":\"2.6\",\"description\":\"MC_RUC_DESC\",\"group\":\"\"}','{\"extra_class\":\"\",\"history\":\"7\",\"width\":\"285\",\"height\":\"120\"}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (10024,'RokAdminAudit','module','mod_rokadminaudit','',1,1,1,0,'{\"legacy\":false,\"name\":\"RokAdminAudit\",\"type\":\"module\",\"creationDate\":\"April 10, 2012\",\"author\":\"RocketTheme, LLC\",\"copyright\":\"(C) 2005 - 2012 RocketTheme, LLC. All rights reserved.\",\"authorEmail\":\"support@rockettheme.com\",\"authorUrl\":\"http:\\/\\/www.rockettheme.com\",\"version\":\"2.6\",\"description\":\"MC_RAA_ROKADMINAUDIT_DESC\",\"group\":\"\"}','{\"limit\":\"5\",\"detail_filter\":\"low\",\"enableGravatar\":\"1\"}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (10025,'Recent Activity','module','mod_scout_activity','',1,1,2,0,'{\"legacy\":true,\"name\":\"Recent Activity\",\"type\":\"module\",\"creationDate\":\"April 2010\",\"author\":\"Dioscouri.com\",\"copyright\":\"2010 Dioscouri.com\",\"authorEmail\":\"info@dioscouri.com\",\"authorUrl\":\"http:\\/\\/www.dioscouri.com\",\"version\":\"0.6.0\",\"description\":\"Displays recent activity on the site\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (10026,'Scout - Tracking Ambrasubs Activity','plugin','scout','ambrasubs',0,1,1,0,'{\"legacy\":true,\"name\":\"Scout - Tracking Ambrasubs Activity\",\"type\":\"plugin\",\"creationDate\":\"February 2010\",\"author\":\"Dioscouri Design\",\"copyright\":\"2010 Dioscouri.com\",\"authorEmail\":\"info@dioscouri.com\",\"authorUrl\":\"http:\\/\\/www.dioscouri.com\",\"version\":\"0.6.0\",\"description\":\"Enables Scout activity logging for Ambrasubs\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (10027,'Scout - Tracking Billets Activity','plugin','scout','billets',0,1,1,0,'{\"legacy\":true,\"name\":\"Scout - Tracking Billets Activity\",\"type\":\"plugin\",\"creationDate\":\"February 2010\",\"author\":\"Dioscouri Design\",\"copyright\":\"2010 Dioscouri.com\",\"authorEmail\":\"info@dioscouri.com\",\"authorUrl\":\"http:\\/\\/www.dioscouri.com\",\"version\":\"0.6.0\",\"description\":\"Enables Scout activity logging for Billets\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (10028,'Scout - Tracking JomSocial Activity','plugin','scout','community',0,1,1,0,'{\"legacy\":true,\"name\":\"Scout - Tracking JomSocial Activity\",\"type\":\"plugin\",\"creationDate\":\"December 2010\",\"author\":\"Dioscouri Design\",\"copyright\":\"2010 Dioscouri.com\",\"authorEmail\":\"info@dioscouri.com\",\"authorUrl\":\"http:\\/\\/www.dioscouri.com\",\"version\":\"0.6.0\",\"description\":\"Enables Scout activity logging for JomSocial.\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (10029,'Scout - Content','plugin','scout','content',0,1,1,0,'{\"legacy\":true,\"name\":\"Scout - Content\",\"type\":\"plugin\",\"creationDate\":\"February 2010\",\"author\":\"Dioscouri Design\",\"copyright\":\"2008 Dioscouri.com\",\"authorEmail\":\"info@dioscouri.com\",\"authorUrl\":\"http:\\/\\/www.dioscouri.com\",\"version\":\"0.1.0\",\"description\":\"Enables Scout activity logging for the Core Content Manager\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (10030,'Scout - Tracking K2 Activity','plugin','scout','k2',0,1,1,0,'{\"legacy\":true,\"name\":\"Scout - Tracking K2 Activity\",\"type\":\"plugin\",\"creationDate\":\"February 2010\",\"author\":\"Dioscouri Design\",\"copyright\":\"2010 Dioscouri.com\",\"authorEmail\":\"info@dioscouri.com\",\"authorUrl\":\"http:\\/\\/www.dioscouri.com\",\"version\":\"0.6.0\",\"description\":\"Enables Scout activity logging for K2\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (10031,'Koowa - Scout','plugin','scout','koowa',0,1,1,0,'{\"legacy\":true,\"name\":\"Koowa - Scout\",\"type\":\"plugin\",\"creationDate\":\"May 2010\",\"author\":\"Dioscouri Design\",\"copyright\":\"2008 - 2010 Dioscouri.com\",\"authorEmail\":\"\",\"authorUrl\":\"\",\"version\":\"0.6.0\",\"description\":\"Enables Scout activity logging for all Nooku Framework powered extensions\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (10032,'Scout - System','plugin','scout','system',0,1,1,0,'{\"legacy\":true,\"name\":\"Scout - System\",\"type\":\"plugin\",\"creationDate\":\"February 2010\",\"author\":\"Dioscouri Design\",\"copyright\":\"2008 Dioscouri.com\",\"authorEmail\":\"info@dioscouri.com\",\"authorUrl\":\"http:\\/\\/www.dioscouri.com\",\"version\":\"0.6.0\",\"description\":\"Enables Scout activity logging for extensions without plugin events\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (10033,'Scout - Tracking Tienda Activity','plugin','scout','tienda',0,1,1,0,'{\"legacy\":true,\"name\":\"Scout - Tracking Tienda Activity\",\"type\":\"plugin\",\"creationDate\":\"February 2010\",\"author\":\"Dioscouri Design\",\"copyright\":\"2010 Dioscouri.com\",\"authorEmail\":\"info@dioscouri.com\",\"authorUrl\":\"http:\\/\\/www.dioscouri.com\",\"version\":\"0.6.0\",\"description\":\"Enables Scout activity logging for Tienda\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (10034,'Scout - User','plugin','scout','user',0,1,1,0,'{\"legacy\":true,\"name\":\"Scout - User\",\"type\":\"plugin\",\"creationDate\":\"November 2010\",\"author\":\"Dioscouri Design\",\"copyright\":\"2008 Dioscouri.com\",\"authorEmail\":\"info@dioscouri.com\",\"authorUrl\":\"http:\\/\\/www.dioscouri.com\",\"version\":\"0.6.0\",\"description\":\"Enables Scout activity logging for the Core User Manager\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (10035,'scout','component','com_scout','',1,1,0,0,'{\"legacy\":true,\"name\":\"Scout\",\"type\":\"component\",\"creationDate\":\"June 2009\",\"author\":\"Dioscouri.com\",\"copyright\":\"2010 Dioscouri.com\",\"authorEmail\":\"info@dioscouri.com\",\"authorUrl\":\"http:\\/\\/www.dioscouri.com\",\"version\":\"0.1.0\",\"description\":\"An activity monitor for Joomla\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0);
INSERT INTO `lsf3y_extensions` VALUES (10036,'Scout - MediaManager','plugin','scout','mediamanager',0,1,1,0,'{\"legacy\":false,\"name\":\"Scout - MediaManager\",\"type\":\"plugin\",\"creationDate\":\"November 2012\",\"author\":\"Dioscouri Design\",\"copyright\":\"2008 Dioscouri.com\",\"authorEmail\":\"info@dioscouri.com\",\"authorUrl\":\"http:\\/\\/www.dioscouri.com\",\"version\":\"0.6.0\",\"description\":\"Enables Scout activity logging for the Media manager\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0);
/*!40000 ALTER TABLE `lsf3y_extensions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_languages`
--

DROP TABLE IF EXISTS `lsf3y_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_languages` (
  `lang_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lang_code` char(7) NOT NULL,
  `title` varchar(50) NOT NULL,
  `title_native` varchar(50) NOT NULL,
  `sef` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `description` varchar(512) NOT NULL,
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `sitename` varchar(1024) NOT NULL DEFAULT '',
  `published` int(11) NOT NULL DEFAULT '0',
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`lang_id`),
  UNIQUE KEY `idx_sef` (`sef`),
  UNIQUE KEY `idx_image` (`image`),
  UNIQUE KEY `idx_langcode` (`lang_code`),
  KEY `idx_access` (`access`),
  KEY `idx_ordering` (`ordering`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_languages`
--

LOCK TABLES `lsf3y_languages` WRITE;
/*!40000 ALTER TABLE `lsf3y_languages` DISABLE KEYS */;
INSERT INTO `lsf3y_languages` VALUES (1,'en-GB','English (UK)','English (UK)','en','en','','','','',1,0,1);
/*!40000 ALTER TABLE `lsf3y_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_locator_items`
--

DROP TABLE IF EXISTS `lsf3y_locator_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_locator_items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `street2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT '',
  `latitude` float(10,6) NOT NULL,
  `longitude` float(10,6) NOT NULL,
  `datecreated` datetime NOT NULL,
  `datemodified` datetime NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `notes` text,
  PRIMARY KEY (`item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_locator_items`
--

LOCK TABLES `lsf3y_locator_items` WRITE;
/*!40000 ALTER TABLE `lsf3y_locator_items` DISABLE KEYS */;
INSERT INTO `lsf3y_locator_items` VALUES (1,0,0,'STATION  1','','','','123 Fake Street','','Salt Lake City','UT','','USA','801-792-2869','PC',40.750000,-111.883301,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,NULL);
/*!40000 ALTER TABLE `lsf3y_locator_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_mediamanager_advertisers`
--

DROP TABLE IF EXISTS `lsf3y_mediamanager_advertisers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_mediamanager_advertisers` (
  `advertiser_id` int(11) NOT NULL AUTO_INCREMENT,
  `advertiser_name` varchar(255) NOT NULL,
  `advertiser_contact` varchar(255) NOT NULL,
  `advertiser_phone` varchar(255) NOT NULL,
  PRIMARY KEY (`advertiser_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_mediamanager_advertisers`
--

LOCK TABLES `lsf3y_mediamanager_advertisers` WRITE;
/*!40000 ALTER TABLE `lsf3y_mediamanager_advertisers` DISABLE KEYS */;
INSERT INTO `lsf3y_mediamanager_advertisers` VALUES (1,'Crosscliq','Ian Barkely','8015555555');
INSERT INTO `lsf3y_mediamanager_advertisers` VALUES (2,'Whistler Blackcomb','whistlerblackcomb.com','');
INSERT INTO `lsf3y_mediamanager_advertisers` VALUES (3,'Telus','','');
INSERT INTO `lsf3y_mediamanager_advertisers` VALUES (4,'IMI','M Bergsma','4164400310x341');
/*!40000 ALTER TABLE `lsf3y_mediamanager_advertisers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_mediamanager_audio_jwplayer`
--

DROP TABLE IF EXISTS `lsf3y_mediamanager_audio_jwplayer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_mediamanager_audio_jwplayer` (
  `audiojwplayer_id` int(11) NOT NULL AUTO_INCREMENT,
  `media_id` int(11) NOT NULL,
  `mediafile_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `caption` text,
  `url` varchar(255) NOT NULL,
  `url_target` tinyint(1) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `ordering` int(11) NOT NULL,
  PRIMARY KEY (`audiojwplayer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_mediamanager_audio_jwplayer`
--

LOCK TABLES `lsf3y_mediamanager_audio_jwplayer` WRITE;
/*!40000 ALTER TABLE `lsf3y_mediamanager_audio_jwplayer` DISABLE KEYS */;
/*!40000 ALTER TABLE `lsf3y_mediamanager_audio_jwplayer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_mediamanager_categories`
--

DROP TABLE IF EXISTS `lsf3y_mediamanager_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_mediamanager_categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_title` varchar(255) DEFAULT NULL,
  `category_values` text,
  `display_admin` tinyint(1) NOT NULL DEFAULT '0',
  `display_site` tinyint(1) NOT NULL DEFAULT '0',
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `categorytype_id` int(11) NOT NULL,
  PRIMARY KEY (`category_id`),
  KEY `category_title` (`category_title`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_mediamanager_categories`
--

LOCK TABLES `lsf3y_mediamanager_categories` WRITE;
/*!40000 ALTER TABLE `lsf3y_mediamanager_categories` DISABLE KEYS */;
INSERT INTO `lsf3y_mediamanager_categories` VALUES (1,'TMobile Ads',NULL,0,0,NULL,NULL,1);
/*!40000 ALTER TABLE `lsf3y_mediamanager_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_mediamanager_categorytypes`
--

DROP TABLE IF EXISTS `lsf3y_mediamanager_categorytypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_mediamanager_categorytypes` (
  `categorytype_id` int(11) NOT NULL AUTO_INCREMENT,
  `categorytype_title` varchar(255) DEFAULT NULL,
  `categorytype_display_admin` tinyint(1) NOT NULL DEFAULT '0',
  `categorytype_display_site` tinyint(1) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL,
  PRIMARY KEY (`categorytype_id`),
  KEY `category_title` (`categorytype_title`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_mediamanager_categorytypes`
--

LOCK TABLES `lsf3y_mediamanager_categorytypes` WRITE;
/*!40000 ALTER TABLE `lsf3y_mediamanager_categorytypes` DISABLE KEYS */;
INSERT INTO `lsf3y_mediamanager_categorytypes` VALUES (1,'Advertising Kiosk',0,0,1);
/*!40000 ALTER TABLE `lsf3y_mediamanager_categorytypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_mediamanager_config`
--

DROP TABLE IF EXISTS `lsf3y_mediamanager_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_mediamanager_config` (
  `config_id` int(11) NOT NULL AUTO_INCREMENT,
  `config_name` varchar(255) DEFAULT NULL,
  `value` text,
  PRIMARY KEY (`config_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_mediamanager_config`
--

LOCK TABLES `lsf3y_mediamanager_config` WRITE;
/*!40000 ALTER TABLE `lsf3y_mediamanager_config` DISABLE KEYS */;
INSERT INTO `lsf3y_mediamanager_config` VALUES (1,'checkTableExistsAudioJwplayer','1');
INSERT INTO `lsf3y_mediamanager_config` VALUES (2,'checkTableExistsVideoJplayer','1');
INSERT INTO `lsf3y_mediamanager_config` VALUES (3,'checkTableExistsSlideshowDefault','1');
INSERT INTO `lsf3y_mediamanager_config` VALUES (4,'checkPublicationFieldsExistSlideshowDefault','1');
INSERT INTO `lsf3y_mediamanager_config` VALUES (5,'checkTableExistsSlideshowPikachoose','1');
INSERT INTO `lsf3y_mediamanager_config` VALUES (6,'checkPublicationFieldsExistSlideshowPikachoose','1');
INSERT INTO `lsf3y_mediamanager_config` VALUES (7,'checkTableExistsVideoJwplayer','1');
INSERT INTO `lsf3y_mediamanager_config` VALUES (8,'checkTableExistsSlideshowKiosk','1');
INSERT INTO `lsf3y_mediamanager_config` VALUES (9,'checkPublicationFieldsExistSlideshowKiosk','1');
/*!40000 ALTER TABLE `lsf3y_mediamanager_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_mediamanager_files`
--

DROP TABLE IF EXISTS `lsf3y_mediamanager_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_mediamanager_files` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_title` varchar(255) DEFAULT NULL,
  `file_description` mediumtext,
  `file_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `file_params` text,
  `file_name` varchar(255) DEFAULT NULL,
  `file_url` mediumtext,
  `file_path` text,
  `file_extension` varchar(6) DEFAULT NULL,
  `file_mimetype` varchar(64) DEFAULT NULL,
  `is_external` tinyint(1) NOT NULL DEFAULT '0',
  `advertiser_id` int(11) NOT NULL,
  PRIMARY KEY (`file_id`),
  KEY `file_title` (`file_title`),
  KEY `file_name` (`file_name`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_mediamanager_files`
--

LOCK TABLES `lsf3y_mediamanager_files` WRITE;
/*!40000 ALTER TABLE `lsf3y_mediamanager_files` DISABLE KEYS */;
INSERT INTO `lsf3y_mediamanager_files` VALUES (19,NULL,NULL,1,NULL,'background0188.jpg','http://www.designmyprofile.com/images/graphics/backgrounds/background0188.jpg','','jpg',NULL,0,0);
INSERT INTO `lsf3y_mediamanager_files` VALUES (20,NULL,NULL,1,NULL,'free-hd-desktop-wallpaper-background-5.jpg',NULL,'images/com_mediamanager/images/free-hd-desktop-wallpaper-background-5.jpg','jpg',NULL,0,0);
INSERT INTO `lsf3y_mediamanager_files` VALUES (16,NULL,NULL,1,NULL,'Desktop-Backgrounds1.jpg','','images/Desktop-Backgrounds1.jpg','jpg',NULL,0,1);
INSERT INTO `lsf3y_mediamanager_files` VALUES (17,NULL,NULL,1,NULL,'tiffany-diva-twitter-free-cute-twitter-background.jpg','http://www.wallpaperpin.com/webdisk/tiffany-diva-twitter-free-cute-twitter-background.jpg','','jpg',NULL,0,0);
INSERT INTO `lsf3y_mediamanager_files` VALUES (18,NULL,NULL,1,NULL,'joomla_black.gif',NULL,'images/joomla_black.gif','gif',NULL,0,0);
INSERT INTO `lsf3y_mediamanager_files` VALUES (23,'Elephants Video',NULL,1,'a:3:{s:4:\"webm\";s:47:\"http://video.webmfiles.org/elephants-dream.webm\";s:3:\"ogg\";s:0:\"\";s:3:\"mp4\";s:0:\"\";}','elephants-dream.webm','http://video.webmfiles.org/elephants-dream.webm','','webm',NULL,0,1);
INSERT INTO `lsf3y_mediamanager_files` VALUES (22,'Bunny',NULL,1,'a:3:{s:4:\"webm\";s:54:\"http://video.webmfiles.org/big-buck-bunny_trailer.webm\";s:3:\"ogg\";s:0:\"\";s:3:\"mp4\";s:0:\"\";}','big-buck-bunny_trailer.webm','http://video.webmfiles.org/big-buck-bunny_trailer.webm','','webm',NULL,0,0);
INSERT INTO `lsf3y_mediamanager_files` VALUES (25,'some video',NULL,1,'a:3:{s:4:\"webm\";s:52:\"http://techslides.com/demos/sample-videos/small.webm\";s:3:\"ogg\";s:0:\"\";s:3:\"mp4\";s:0:\"\";}','small.webm','http://techslides.com/demos/sample-videos/small.webm','','webm',NULL,0,1);
INSERT INTO `lsf3y_mediamanager_files` VALUES (26,NULL,NULL,1,NULL,'56534.jpg',NULL,'images/56534.jpg','jpg',NULL,0,0);
INSERT INTO `lsf3y_mediamanager_files` VALUES (27,NULL,NULL,1,NULL,'57770.jpg',NULL,'images/57770.jpg','jpg',NULL,0,0);
INSERT INTO `lsf3y_mediamanager_files` VALUES (29,'Cloud Files Stream Testing',NULL,1,'a:3:{s:4:\"webm\";s:91:\"http://be6ebbc57943a712af92-e3d77d0214a368a5cd98e92749508e9f.r99.cf2.rackcdn.com/55714.webm\";s:3:\"ogg\";s:0:\"\";s:3:\"mp4\";s:0:\"\";}','55714.webm','http://be6ebbc57943a712af92-e3d77d0214a368a5cd98e92749508e9f.r99.cf2.rackcdn.com/55714.webm','','webm',NULL,0,2);
INSERT INTO `lsf3y_mediamanager_files` VALUES (31,'Cloud Files Stream Testing MP4',NULL,1,'a:3:{s:4:\"webm\";s:0:\"\";s:3:\"ogg\";s:0:\"\";s:3:\"mp4\";s:90:\"http://be6ebbc57943a712af92-e3d77d0214a368a5cd98e92749508e9f.r99.cf2.rackcdn.com/55715.mp4\";}','55715.mp4','http://be6ebbc57943a712af92-e3d77d0214a368a5cd98e92749508e9f.r99.cf2.rackcdn.com/55715.mp4','','mp4',NULL,0,2);
INSERT INTO `lsf3y_mediamanager_files` VALUES (33,NULL,NULL,1,NULL,'Desktop-Backgrounds1.jpg',NULL,'images/Desktop-Backgrounds1.jpg','jpg',NULL,0,0);
INSERT INTO `lsf3y_mediamanager_files` VALUES (34,NULL,NULL,1,NULL,'powered_by.png',NULL,'images/powered_by.png','png',NULL,0,0);
INSERT INTO `lsf3y_mediamanager_files` VALUES (35,'some video',NULL,1,'a:3:{s:4:\"webm\";s:52:\"http://techslides.com/demos/sample-videos/small.webm\";s:3:\"ogg\";s:0:\"\";s:3:\"mp4\";s:0:\"\";}','small.webm','http://techslides.com/demos/sample-videos/small.webm','','webm',NULL,0,2);
INSERT INTO `lsf3y_mediamanager_files` VALUES (42,'Telus 2',NULL,1,'a:3:{s:4:\"webm\";s:0:\"\";s:3:\"ogg\";s:0:\"\";s:3:\"mp4\";s:54:\"https://s3.amazonaws.com/dantebmedia/conv/55714web.mp4\";}','55714web.mp4','https://s3.amazonaws.com/dantebmedia/conv/55714web.mp4','','mp4',NULL,0,3);
/*!40000 ALTER TABLE `lsf3y_mediamanager_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_mediamanager_libraries`
--

DROP TABLE IF EXISTS `lsf3y_mediamanager_libraries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_mediamanager_libraries` (
  `library_id` int(11) NOT NULL AUTO_INCREMENT,
  `library_title` varchar(255) DEFAULT NULL,
  `library_description` text NOT NULL,
  `library_filters` varchar(50) DEFAULT NULL,
  `library_date_from` datetime DEFAULT NULL,
  `library_date_to` datetime DEFAULT NULL,
  `library_meta` text,
  `library_interface` varchar(255) DEFAULT NULL,
  `library_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `access` tinyint(1) DEFAULT NULL,
  `library_date_added` datetime DEFAULT NULL,
  `library_params` text,
  `library_pagination_limit` int(11) NOT NULL,
  `library_layout` varchar(255) NOT NULL,
  `default_media_id` int(11) NOT NULL,
  `library_groups` text NOT NULL,
  `library_categories` text NOT NULL,
  PRIMARY KEY (`library_id`),
  KEY `library_title` (`library_title`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_mediamanager_libraries`
--

LOCK TABLES `lsf3y_mediamanager_libraries` WRITE;
/*!40000 ALTER TABLE `lsf3y_mediamanager_libraries` DISABLE KEYS */;
INSERT INTO `lsf3y_mediamanager_libraries` VALUES (1,'Station 1','','{}','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,NULL,1,NULL,NULL,'{\"display_filter_dropdowns\":\"0\",\"display_checkboxes\":\"0\",\"channel_type\":null,\"display_items\":\"0\"}',0,'',1,'[\"slideshow\",\"video\",\"audio\"]','[\"1\"]');
/*!40000 ALTER TABLE `lsf3y_mediamanager_libraries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_mediamanager_librarycategories`
--

DROP TABLE IF EXISTS `lsf3y_mediamanager_librarycategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_mediamanager_librarycategories` (
  `librarycategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `library_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`librarycategory_id`),
  KEY `media_id` (`library_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_mediamanager_librarycategories`
--

LOCK TABLES `lsf3y_mediamanager_librarycategories` WRITE;
/*!40000 ALTER TABLE `lsf3y_mediamanager_librarycategories` DISABLE KEYS */;
INSERT INTO `lsf3y_mediamanager_librarycategories` VALUES (1,1,1);
INSERT INTO `lsf3y_mediamanager_librarycategories` VALUES (2,1,1);
INSERT INTO `lsf3y_mediamanager_librarycategories` VALUES (3,1,1);
/*!40000 ALTER TABLE `lsf3y_mediamanager_librarycategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_mediamanager_librarycategorytypes`
--

DROP TABLE IF EXISTS `lsf3y_mediamanager_librarycategorytypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_mediamanager_librarycategorytypes` (
  `librarycategorytype_id` int(11) NOT NULL AUTO_INCREMENT,
  `library_id` int(11) NOT NULL,
  `categorytype_id` int(11) NOT NULL,
  PRIMARY KEY (`librarycategorytype_id`),
  KEY `media_id` (`library_id`),
  KEY `category_id` (`categorytype_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_mediamanager_librarycategorytypes`
--

LOCK TABLES `lsf3y_mediamanager_librarycategorytypes` WRITE;
/*!40000 ALTER TABLE `lsf3y_mediamanager_librarycategorytypes` DISABLE KEYS */;
INSERT INTO `lsf3y_mediamanager_librarycategorytypes` VALUES (1,1,1);
/*!40000 ALTER TABLE `lsf3y_mediamanager_librarycategorytypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_mediamanager_librarytags`
--

DROP TABLE IF EXISTS `lsf3y_mediamanager_librarytags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_mediamanager_librarytags` (
  `librarytag_id` int(11) NOT NULL AUTO_INCREMENT,
  `library_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`librarytag_id`),
  KEY `category_id` (`tag_id`),
  KEY `library_id` (`library_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_mediamanager_librarytags`
--

LOCK TABLES `lsf3y_mediamanager_librarytags` WRITE;
/*!40000 ALTER TABLE `lsf3y_mediamanager_librarytags` DISABLE KEYS */;
/*!40000 ALTER TABLE `lsf3y_mediamanager_librarytags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_mediamanager_media`
--

DROP TABLE IF EXISTS `lsf3y_mediamanager_media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_mediamanager_media` (
  `media_id` int(11) NOT NULL AUTO_INCREMENT,
  `media_title` varchar(255) DEFAULT NULL,
  `media_title_long` varchar(255) NOT NULL,
  `media_description` text,
  `media_description_full` text,
  `media_image` varchar(255) DEFAULT NULL,
  `media_image_remote` mediumtext NOT NULL,
  `media_meta` text,
  `media_categories` text,
  `date_added` datetime DEFAULT NULL,
  `media_type` varchar(255) DEFAULT NULL,
  `media_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `access` int(11) DEFAULT NULL,
  `media_params` text,
  `hits` int(11) NOT NULL,
  `media_group` varchar(255) NOT NULL,
  `datemodified` datetime NOT NULL,
  PRIMARY KEY (`media_id`),
  KEY `media_title` (`media_title`),
  KEY `media_type` (`media_type`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_mediamanager_media`
--

LOCK TABLES `lsf3y_mediamanager_media` WRITE;
/*!40000 ALTER TABLE `lsf3y_mediamanager_media` DISABLE KEYS */;
INSERT INTO `lsf3y_mediamanager_media` VALUES (4,'Testing Kiosk','','','','','',NULL,'[]','2013-05-15 18:27:40','slideshow_kiosk',1,NULL,'{\"slideshowdefault_include_jquery\":\"1\",\"slideshowdefault_show_caption\":\"0\",\"slideshowdefault_autoplay\":\"1\",\"slideshowdefault_auto_play_delay\":\"5000\",\"slideshowdefault_show_controls\":\"0\",\"slideshowdefault_slide_width\":\"640\",\"slideshowdefault_slide_height\":\"640\",\"slideshowdefault_container_width\":\"640\",\"slideshowdefault_container_height\":\"640\",\"slideshowdefault_loop\":\"1\",\"slideshowdefault_speed\":\"1000\"}',0,'slideshow','2013-05-29 13:51:47');
INSERT INTO `lsf3y_mediamanager_media` VALUES (5,'In House Testing Show','',NULL,NULL,'','',NULL,'[]','2013-05-21 22:04:14','slideshow_kiosk',1,NULL,'{\"slideshowdefault_include_jquery\":\"1\",\"slideshowdefault_show_caption\":\"0\",\"slideshowdefault_autoplay\":\"1\",\"slideshowdefault_auto_play_delay\":\"5000\",\"slideshowdefault_show_controls\":\"0\",\"slideshowdefault_slide_width\":\"640\",\"slideshowdefault_slide_height\":\"640\",\"slideshowdefault_container_width\":\"640\",\"slideshowdefault_container_height\":\"640\",\"slideshowdefault_loop\":\"1\",\"slideshowdefault_speed\":\"1000\"}',0,'slideshow','2013-05-23 00:01:53');
INSERT INTO `lsf3y_mediamanager_media` VALUES (6,'New playlist','',NULL,NULL,'','',NULL,'[]','2013-05-22 18:43:09','slideshow_kiosk',1,NULL,'{\"slideshowdefault_include_jquery\":\"1\",\"slideshowdefault_show_caption\":\"0\",\"slideshowdefault_autoplay\":\"1\",\"slideshowdefault_auto_play_delay\":\"5000\",\"slideshowdefault_show_controls\":\"0\",\"slideshowdefault_slide_width\":\"640\",\"slideshowdefault_slide_height\":\"640\",\"slideshowdefault_container_width\":\"640\",\"slideshowdefault_container_height\":\"640\",\"slideshowdefault_loop\":\"1\",\"slideshowdefault_speed\":\"1000\"}',0,'slideshow','2013-05-29 19:43:25');
/*!40000 ALTER TABLE `lsf3y_mediamanager_media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_mediamanager_mediacategories`
--

DROP TABLE IF EXISTS `lsf3y_mediamanager_mediacategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_mediamanager_mediacategories` (
  `mediacategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `media_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`mediacategory_id`),
  KEY `media_id` (`media_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_mediamanager_mediacategories`
--

LOCK TABLES `lsf3y_mediamanager_mediacategories` WRITE;
/*!40000 ALTER TABLE `lsf3y_mediamanager_mediacategories` DISABLE KEYS */;
INSERT INTO `lsf3y_mediamanager_mediacategories` VALUES (1,1,1);
/*!40000 ALTER TABLE `lsf3y_mediamanager_mediacategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_mediamanager_mediafiles`
--

DROP TABLE IF EXISTS `lsf3y_mediamanager_mediafiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_mediamanager_mediafiles` (
  `mediafile_id` int(11) NOT NULL AUTO_INCREMENT,
  `media_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `value` text,
  PRIMARY KEY (`mediafile_id`),
  KEY `media_id` (`media_id`),
  KEY `file_id` (`file_id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_mediamanager_mediafiles`
--

LOCK TABLES `lsf3y_mediamanager_mediafiles` WRITE;
/*!40000 ALTER TABLE `lsf3y_mediamanager_mediafiles` DISABLE KEYS */;
INSERT INTO `lsf3y_mediamanager_mediafiles` VALUES (25,4,20,NULL);
INSERT INTO `lsf3y_mediamanager_mediafiles` VALUES (24,4,19,NULL);
INSERT INTO `lsf3y_mediamanager_mediafiles` VALUES (23,4,18,NULL);
INSERT INTO `lsf3y_mediamanager_mediafiles` VALUES (22,4,17,NULL);
INSERT INTO `lsf3y_mediamanager_mediafiles` VALUES (21,4,16,NULL);
INSERT INTO `lsf3y_mediamanager_mediafiles` VALUES (28,4,23,NULL);
INSERT INTO `lsf3y_mediamanager_mediafiles` VALUES (27,4,22,NULL);
INSERT INTO `lsf3y_mediamanager_mediafiles` VALUES (30,4,25,NULL);
INSERT INTO `lsf3y_mediamanager_mediafiles` VALUES (31,5,26,NULL);
INSERT INTO `lsf3y_mediamanager_mediafiles` VALUES (32,5,27,NULL);
INSERT INTO `lsf3y_mediamanager_mediafiles` VALUES (34,5,29,NULL);
INSERT INTO `lsf3y_mediamanager_mediafiles` VALUES (36,5,31,NULL);
INSERT INTO `lsf3y_mediamanager_mediafiles` VALUES (38,6,33,NULL);
INSERT INTO `lsf3y_mediamanager_mediafiles` VALUES (39,6,34,NULL);
INSERT INTO `lsf3y_mediamanager_mediafiles` VALUES (40,6,35,NULL);
INSERT INTO `lsf3y_mediamanager_mediafiles` VALUES (47,4,42,NULL);
/*!40000 ALTER TABLE `lsf3y_mediamanager_mediafiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_mediamanager_mediatags`
--

DROP TABLE IF EXISTS `lsf3y_mediamanager_mediatags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_mediamanager_mediatags` (
  `mediatag_id` int(11) NOT NULL AUTO_INCREMENT,
  `media_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`mediatag_id`),
  KEY `media_id` (`media_id`),
  KEY `category_id` (`tag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_mediamanager_mediatags`
--

LOCK TABLES `lsf3y_mediamanager_mediatags` WRITE;
/*!40000 ALTER TABLE `lsf3y_mediamanager_mediatags` DISABLE KEYS */;
/*!40000 ALTER TABLE `lsf3y_mediamanager_mediatags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_mediamanager_slideshow_default`
--

DROP TABLE IF EXISTS `lsf3y_mediamanager_slideshow_default`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_mediamanager_slideshow_default` (
  `slideshowdefault_id` int(11) NOT NULL AUTO_INCREMENT,
  `media_id` int(11) NOT NULL,
  `mediafile_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `caption` text,
  `url` varchar(255) NOT NULL,
  `url_target` tinyint(1) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `ordering` int(11) NOT NULL,
  `publish_up` datetime NOT NULL,
  `publish_down` datetime NOT NULL,
  PRIMARY KEY (`slideshowdefault_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_mediamanager_slideshow_default`
--

LOCK TABLES `lsf3y_mediamanager_slideshow_default` WRITE;
/*!40000 ALTER TABLE `lsf3y_mediamanager_slideshow_default` DISABLE KEYS */;
INSERT INTO `lsf3y_mediamanager_slideshow_default` VALUES (7,1,7,'','','',0,1,2,'0000-00-00 00:00:00','0000-00-00 00:00:00');
INSERT INTO `lsf3y_mediamanager_slideshow_default` VALUES (11,2,11,'',NULL,'',0,0,2,'0000-00-00 00:00:00','0000-00-00 00:00:00');
INSERT INTO `lsf3y_mediamanager_slideshow_default` VALUES (10,2,10,'',NULL,'',0,0,3,'0000-00-00 00:00:00','0000-00-00 00:00:00');
INSERT INTO `lsf3y_mediamanager_slideshow_default` VALUES (9,2,9,'',NULL,'',0,1,4,'0000-00-00 00:00:00','0000-00-00 00:00:00');
INSERT INTO `lsf3y_mediamanager_slideshow_default` VALUES (8,2,8,'',NULL,'',0,0,5,'0000-00-00 00:00:00','0000-00-00 00:00:00');
INSERT INTO `lsf3y_mediamanager_slideshow_default` VALUES (6,1,6,'','','',0,1,3,'0000-00-00 00:00:00','0000-00-00 00:00:00');
INSERT INTO `lsf3y_mediamanager_slideshow_default` VALUES (12,1,12,'',NULL,'',0,1,1,'0000-00-00 00:00:00','0000-00-00 00:00:00');
INSERT INTO `lsf3y_mediamanager_slideshow_default` VALUES (13,2,13,'',NULL,'',0,1,1,'0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `lsf3y_mediamanager_slideshow_default` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_mediamanager_slideshow_kiosk`
--

DROP TABLE IF EXISTS `lsf3y_mediamanager_slideshow_kiosk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_mediamanager_slideshow_kiosk` (
  `slideshowkiosk_id` int(11) NOT NULL AUTO_INCREMENT,
  `media_id` int(11) NOT NULL,
  `mediafile_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `caption` text,
  `url` varchar(255) NOT NULL,
  `url_target` tinyint(1) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `ordering` int(11) NOT NULL,
  `publish_up` datetime NOT NULL,
  `publish_down` datetime NOT NULL,
  PRIMARY KEY (`slideshowkiosk_id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_mediamanager_slideshow_kiosk`
--

LOCK TABLES `lsf3y_mediamanager_slideshow_kiosk` WRITE;
/*!40000 ALTER TABLE `lsf3y_mediamanager_slideshow_kiosk` DISABLE KEYS */;
INSERT INTO `lsf3y_mediamanager_slideshow_kiosk` VALUES (11,2,10,'','','',0,1,6,'0000-00-00 00:00:00','0000-00-00 00:00:00');
INSERT INTO `lsf3y_mediamanager_slideshow_kiosk` VALUES (12,2,14,'','','',0,1,2,'0000-00-00 00:00:00','0000-00-00 00:00:00');
INSERT INTO `lsf3y_mediamanager_slideshow_kiosk` VALUES (13,2,15,'','','',0,1,1,'0000-00-00 00:00:00','0000-00-00 00:00:00');
INSERT INTO `lsf3y_mediamanager_slideshow_kiosk` VALUES (14,2,9,'','','',0,1,5,'0000-00-00 00:00:00','0000-00-00 00:00:00');
INSERT INTO `lsf3y_mediamanager_slideshow_kiosk` VALUES (15,2,13,'','','',0,1,3,'0000-00-00 00:00:00','0000-00-00 00:00:00');
INSERT INTO `lsf3y_mediamanager_slideshow_kiosk` VALUES (16,2,8,'','','',0,1,4,'0000-00-00 00:00:00','0000-00-00 00:00:00');
INSERT INTO `lsf3y_mediamanager_slideshow_kiosk` VALUES (17,2,11,'','','',0,1,7,'0000-00-00 00:00:00','0000-00-00 00:00:00');
INSERT INTO `lsf3y_mediamanager_slideshow_kiosk` VALUES (18,3,16,'',NULL,'',0,0,5,'0000-00-00 00:00:00','0000-00-00 00:00:00');
INSERT INTO `lsf3y_mediamanager_slideshow_kiosk` VALUES (19,3,17,'',NULL,'',0,0,4,'0000-00-00 00:00:00','0000-00-00 00:00:00');
INSERT INTO `lsf3y_mediamanager_slideshow_kiosk` VALUES (20,3,18,'',NULL,'',0,0,3,'0000-00-00 00:00:00','0000-00-00 00:00:00');
INSERT INTO `lsf3y_mediamanager_slideshow_kiosk` VALUES (21,3,19,'',NULL,'',0,0,2,'0000-00-00 00:00:00','0000-00-00 00:00:00');
INSERT INTO `lsf3y_mediamanager_slideshow_kiosk` VALUES (22,3,20,'',NULL,'',0,1,1,'0000-00-00 00:00:00','0000-00-00 00:00:00');
INSERT INTO `lsf3y_mediamanager_slideshow_kiosk` VALUES (23,4,21,'','','',0,1,9,'0000-00-00 00:00:00','0000-00-00 00:00:00');
INSERT INTO `lsf3y_mediamanager_slideshow_kiosk` VALUES (24,4,22,'','','',0,1,8,'0000-00-00 00:00:00','0000-00-00 00:00:00');
INSERT INTO `lsf3y_mediamanager_slideshow_kiosk` VALUES (25,4,23,'','','',0,1,7,'0000-00-00 00:00:00','0000-00-00 00:00:00');
INSERT INTO `lsf3y_mediamanager_slideshow_kiosk` VALUES (26,4,24,'','','',0,1,6,'0000-00-00 00:00:00','0000-00-00 00:00:00');
INSERT INTO `lsf3y_mediamanager_slideshow_kiosk` VALUES (27,4,25,'','','',0,1,5,'0000-00-00 00:00:00','0000-00-00 00:00:00');
INSERT INTO `lsf3y_mediamanager_slideshow_kiosk` VALUES (30,4,28,'',NULL,'',0,1,3,'0000-00-00 00:00:00','0000-00-00 00:00:00');
INSERT INTO `lsf3y_mediamanager_slideshow_kiosk` VALUES (29,4,27,'',NULL,'',0,1,4,'0000-00-00 00:00:00','0000-00-00 00:00:00');
INSERT INTO `lsf3y_mediamanager_slideshow_kiosk` VALUES (32,4,30,'',NULL,'',0,1,2,'0000-00-00 00:00:00','0000-00-00 00:00:00');
INSERT INTO `lsf3y_mediamanager_slideshow_kiosk` VALUES (33,5,31,'',NULL,'',0,1,3,'0000-00-00 00:00:00','0000-00-00 00:00:00');
INSERT INTO `lsf3y_mediamanager_slideshow_kiosk` VALUES (34,5,32,'',NULL,'',0,1,1,'0000-00-00 00:00:00','0000-00-00 00:00:00');
INSERT INTO `lsf3y_mediamanager_slideshow_kiosk` VALUES (36,5,34,'',NULL,'',0,1,4,'0000-00-00 00:00:00','0000-00-00 00:00:00');
INSERT INTO `lsf3y_mediamanager_slideshow_kiosk` VALUES (38,5,36,'',NULL,'',0,1,2,'0000-00-00 00:00:00','0000-00-00 00:00:00');
INSERT INTO `lsf3y_mediamanager_slideshow_kiosk` VALUES (40,6,38,'',NULL,'',0,1,3,'0000-00-00 00:00:00','0000-00-00 00:00:00');
INSERT INTO `lsf3y_mediamanager_slideshow_kiosk` VALUES (41,6,39,'',NULL,'',0,1,2,'0000-00-00 00:00:00','0000-00-00 00:00:00');
INSERT INTO `lsf3y_mediamanager_slideshow_kiosk` VALUES (42,6,40,'',NULL,'',0,1,1,'0000-00-00 00:00:00','0000-00-00 00:00:00');
INSERT INTO `lsf3y_mediamanager_slideshow_kiosk` VALUES (49,4,47,'',NULL,'',0,1,1,'0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `lsf3y_mediamanager_slideshow_kiosk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_mediamanager_slideshow_pikachoose`
--

DROP TABLE IF EXISTS `lsf3y_mediamanager_slideshow_pikachoose`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_mediamanager_slideshow_pikachoose` (
  `slideshowpikachoose_id` int(11) NOT NULL AUTO_INCREMENT,
  `media_id` int(11) NOT NULL,
  `mediafile_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `caption` text,
  `url` varchar(255) NOT NULL,
  `url_target` tinyint(1) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `ordering` int(11) NOT NULL,
  `publish_up` datetime NOT NULL,
  `publish_down` datetime NOT NULL,
  PRIMARY KEY (`slideshowpikachoose_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_mediamanager_slideshow_pikachoose`
--

LOCK TABLES `lsf3y_mediamanager_slideshow_pikachoose` WRITE;
/*!40000 ALTER TABLE `lsf3y_mediamanager_slideshow_pikachoose` DISABLE KEYS */;
/*!40000 ALTER TABLE `lsf3y_mediamanager_slideshow_pikachoose` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_mediamanager_stationdata`
--

DROP TABLE IF EXISTS `lsf3y_mediamanager_stationdata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_mediamanager_stationdata` (
  `stationdata_id` int(11) NOT NULL,
  `station_id` int(11) NOT NULL,
  `datecreated` datetime NOT NULL,
  `datemodifited` datetime NOT NULL,
  `connectedtime` datetime NOT NULL,
  `disconnedtime` datetime NOT NULL,
  `phonename` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_mediamanager_stationdata`
--

LOCK TABLES `lsf3y_mediamanager_stationdata` WRITE;
/*!40000 ALTER TABLE `lsf3y_mediamanager_stationdata` DISABLE KEYS */;
/*!40000 ALTER TABLE `lsf3y_mediamanager_stationdata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_mediamanager_stations`
--

DROP TABLE IF EXISTS `lsf3y_mediamanager_stations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_mediamanager_stations` (
  `station_id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `station_name` varchar(255) NOT NULL,
  `station_desc` text NOT NULL,
  `station_notes` text NOT NULL,
  `station_address1` varchar(255) NOT NULL,
  `station_address2` varchar(255) NOT NULL,
  `station_provence` varchar(255) NOT NULL,
  `station_city` varchar(255) NOT NULL,
  `station_country` varchar(255) NOT NULL,
  `station_postalcode` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `station_lat` float(10,6) NOT NULL,
  `station_lng` float(10,6) NOT NULL,
  `stationtype_id` int(11) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `enabled` tinyint(4) NOT NULL,
  `media_id` int(11) NOT NULL,
  `timezone` varchar(255) NOT NULL,
  `data_lastupdated` datetime NOT NULL,
  PRIMARY KEY (`station_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_mediamanager_stations`
--

LOCK TABLES `lsf3y_mediamanager_stations` WRITE;
/*!40000 ALTER TABLE `lsf3y_mediamanager_stations` DISABLE KEYS */;
INSERT INTO `lsf3y_mediamanager_stations` VALUES (1,'123412341234131','Station 1','in a cool place','','123 Fake Street','APT #14','Sandy','Utah','USA','7XC43G','0000-00-00 00:00:00','0000-00-00 00:00:00',0.000000,0.000000,0,'',0,4,'','0000-00-00 00:00:00');
INSERT INTO `lsf3y_mediamanager_stations` VALUES (2,'f0:ae:51:00:04:ef','In House Testing Station','','f0:ae:51:00:04:ef','344 West 400 south','','Utah','Salt lake City','USA','84084','0000-00-00 00:00:00','0000-00-00 00:00:00',0.000000,0.000000,0,'',0,5,'','2013-06-24 17:12:44');
/*!40000 ALTER TABLE `lsf3y_mediamanager_stations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_mediamanager_stationsdata`
--

DROP TABLE IF EXISTS `lsf3y_mediamanager_stationsdata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_mediamanager_stationsdata` (
  `stationdata_id` int(11) NOT NULL,
  `station_id` int(11) NOT NULL,
  `datecreated` datetime NOT NULL,
  `datemodifited` datetime NOT NULL,
  `connectedtime` datetime NOT NULL,
  `disconnedtime` datetime NOT NULL,
  `phonename` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_mediamanager_stationsdata`
--

LOCK TABLES `lsf3y_mediamanager_stationsdata` WRITE;
/*!40000 ALTER TABLE `lsf3y_mediamanager_stationsdata` DISABLE KEYS */;
/*!40000 ALTER TABLE `lsf3y_mediamanager_stationsdata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_mediamanager_stationsrawdata`
--

DROP TABLE IF EXISTS `lsf3y_mediamanager_stationsrawdata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_mediamanager_stationsrawdata` (
  `stationrawdata_id` int(11) NOT NULL AUTO_INCREMENT,
  `station_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `usbport` int(11) NOT NULL,
  `profile` int(11) NOT NULL,
  `charging` tinyint(11) NOT NULL,
  `attached` tinyint(4) NOT NULL,
  `sync` tinyint(4) NOT NULL,
  `states` varchar(11) NOT NULL,
  `dev_id` varchar(255) NOT NULL,
  `dev_id2` varchar(255) NOT NULL,
  PRIMARY KEY (`stationrawdata_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_mediamanager_stationsrawdata`
--

LOCK TABLES `lsf3y_mediamanager_stationsrawdata` WRITE;
/*!40000 ALTER TABLE `lsf3y_mediamanager_stationsrawdata` DISABLE KEYS */;
INSERT INTO `lsf3y_mediamanager_stationsrawdata` VALUES (1,2,'2013-06-24 17:11:46',1,123,1,1,0,' R A C','1234','1234');
INSERT INTO `lsf3y_mediamanager_stationsrawdata` VALUES (2,2,'2013-06-24 17:11:46',1,123,1,1,0,' R A C','1234','1234');
INSERT INTO `lsf3y_mediamanager_stationsrawdata` VALUES (3,2,'2013-06-24 17:11:46',1,123,1,1,0,' R A C','1234','1234');
/*!40000 ALTER TABLE `lsf3y_mediamanager_stationsrawdata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_mediamanager_tags`
--

DROP TABLE IF EXISTS `lsf3y_mediamanager_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_mediamanager_tags` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_title` varchar(255) DEFAULT NULL,
  `admin_only` tinyint(1) NOT NULL,
  PRIMARY KEY (`tag_id`),
  KEY `category_title` (`tag_title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_mediamanager_tags`
--

LOCK TABLES `lsf3y_mediamanager_tags` WRITE;
/*!40000 ALTER TABLE `lsf3y_mediamanager_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `lsf3y_mediamanager_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_mediamanager_video_jplayer`
--

DROP TABLE IF EXISTS `lsf3y_mediamanager_video_jplayer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_mediamanager_video_jplayer` (
  `videojplayer_id` int(11) NOT NULL AUTO_INCREMENT,
  `media_id` int(11) NOT NULL,
  `mediafile_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `caption` text,
  `url` varchar(255) NOT NULL,
  `url_target` tinyint(1) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `ordering` int(11) NOT NULL,
  PRIMARY KEY (`videojplayer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_mediamanager_video_jplayer`
--

LOCK TABLES `lsf3y_mediamanager_video_jplayer` WRITE;
/*!40000 ALTER TABLE `lsf3y_mediamanager_video_jplayer` DISABLE KEYS */;
/*!40000 ALTER TABLE `lsf3y_mediamanager_video_jplayer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_mediamanager_video_jwplayer`
--

DROP TABLE IF EXISTS `lsf3y_mediamanager_video_jwplayer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_mediamanager_video_jwplayer` (
  `videojwplayer_id` int(11) NOT NULL AUTO_INCREMENT,
  `media_id` int(11) NOT NULL,
  `mediafile_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `caption` text,
  `url` varchar(255) NOT NULL,
  `url_target` tinyint(1) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `ordering` int(11) NOT NULL,
  PRIMARY KEY (`videojwplayer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_mediamanager_video_jwplayer`
--

LOCK TABLES `lsf3y_mediamanager_video_jwplayer` WRITE;
/*!40000 ALTER TABLE `lsf3y_mediamanager_video_jwplayer` DISABLE KEYS */;
/*!40000 ALTER TABLE `lsf3y_mediamanager_video_jwplayer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_menu`
--

DROP TABLE IF EXISTS `lsf3y_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menutype` varchar(24) NOT NULL COMMENT 'The type of menu this item belongs to. FK to #__menu_types.menutype',
  `title` varchar(255) NOT NULL COMMENT 'The display title of the menu item.',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'The SEF alias of the menu item.',
  `note` varchar(255) NOT NULL DEFAULT '',
  `path` varchar(1024) NOT NULL COMMENT 'The computed path of the menu item based on the alias field.',
  `link` varchar(1024) NOT NULL COMMENT 'The actually link the menu item refers to.',
  `type` varchar(16) NOT NULL COMMENT 'The type of link: Component, URL, Alias, Separator',
  `published` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'The published state of the menu link.',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '1' COMMENT 'The parent menu item in the menu tree.',
  `level` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'The relative level in the tree.',
  `component_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to #__extensions.id',
  `ordering` int(11) NOT NULL DEFAULT '0' COMMENT 'The relative ordering of the menu item in the tree.',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to #__users.id',
  `checked_out_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'The time the menu item was checked out.',
  `browserNav` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'The click behaviour of the link.',
  `access` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'The access level required to view the menu item.',
  `img` varchar(255) NOT NULL COMMENT 'The image of the menu item.',
  `template_style_id` int(10) unsigned NOT NULL DEFAULT '0',
  `params` text NOT NULL COMMENT 'JSON encoded data for the menu item.',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set lft.',
  `rgt` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set rgt.',
  `home` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Indicates if this menu item is the home or default page.',
  `language` char(7) NOT NULL DEFAULT '',
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_client_id_parent_id_alias_language` (`client_id`,`parent_id`,`alias`,`language`),
  KEY `idx_componentid` (`component_id`,`menutype`,`published`,`access`),
  KEY `idx_menutype` (`menutype`),
  KEY `idx_left_right` (`lft`,`rgt`),
  KEY `idx_alias` (`alias`),
  KEY `idx_path` (`path`(255)),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_menu`
--

LOCK TABLES `lsf3y_menu` WRITE;
/*!40000 ALTER TABLE `lsf3y_menu` DISABLE KEYS */;
INSERT INTO `lsf3y_menu` VALUES (1,'','Menu_Item_Root','root','','','','',1,0,0,0,0,0,'0000-00-00 00:00:00',0,0,'',0,'',0,45,0,'*',0);
INSERT INTO `lsf3y_menu` VALUES (2,'menu','com_banners','Banners','','Banners','index.php?option=com_banners','component',0,1,1,4,0,0,'0000-00-00 00:00:00',0,0,'class:banners',0,'',1,10,0,'*',1);
INSERT INTO `lsf3y_menu` VALUES (3,'menu','com_banners','Banners','','Banners/Banners','index.php?option=com_banners','component',0,2,2,4,0,0,'0000-00-00 00:00:00',0,0,'class:banners',0,'',2,3,0,'*',1);
INSERT INTO `lsf3y_menu` VALUES (4,'menu','com_banners_categories','Categories','','Banners/Categories','index.php?option=com_categories&extension=com_banners','component',0,2,2,6,0,0,'0000-00-00 00:00:00',0,0,'class:banners-cat',0,'',4,5,0,'*',1);
INSERT INTO `lsf3y_menu` VALUES (5,'menu','com_banners_clients','Clients','','Banners/Clients','index.php?option=com_banners&view=clients','component',0,2,2,4,0,0,'0000-00-00 00:00:00',0,0,'class:banners-clients',0,'',6,7,0,'*',1);
INSERT INTO `lsf3y_menu` VALUES (6,'menu','com_banners_tracks','Tracks','','Banners/Tracks','index.php?option=com_banners&view=tracks','component',0,2,2,4,0,0,'0000-00-00 00:00:00',0,0,'class:banners-tracks',0,'',8,9,0,'*',1);
INSERT INTO `lsf3y_menu` VALUES (7,'menu','com_contact','Contacts','','Contacts','index.php?option=com_contact','component',0,1,1,8,0,0,'0000-00-00 00:00:00',0,0,'class:contact',0,'',11,16,0,'*',1);
INSERT INTO `lsf3y_menu` VALUES (8,'menu','com_contact','Contacts','','Contacts/Contacts','index.php?option=com_contact','component',0,7,2,8,0,0,'0000-00-00 00:00:00',0,0,'class:contact',0,'',12,13,0,'*',1);
INSERT INTO `lsf3y_menu` VALUES (9,'menu','com_contact_categories','Categories','','Contacts/Categories','index.php?option=com_categories&extension=com_contact','component',0,7,2,6,0,0,'0000-00-00 00:00:00',0,0,'class:contact-cat',0,'',14,15,0,'*',1);
INSERT INTO `lsf3y_menu` VALUES (10,'menu','com_messages','Messaging','','Messaging','index.php?option=com_messages','component',0,1,1,15,0,0,'0000-00-00 00:00:00',0,0,'class:messages',0,'',17,22,0,'*',1);
INSERT INTO `lsf3y_menu` VALUES (11,'menu','com_messages_add','New Private Message','','Messaging/New Private Message','index.php?option=com_messages&task=message.add','component',0,10,2,15,0,0,'0000-00-00 00:00:00',0,0,'class:messages-add',0,'',18,19,0,'*',1);
INSERT INTO `lsf3y_menu` VALUES (12,'menu','com_messages_read','Read Private Message','','Messaging/Read Private Message','index.php?option=com_messages','component',0,10,2,15,0,0,'0000-00-00 00:00:00',0,0,'class:messages-read',0,'',20,21,0,'*',1);
INSERT INTO `lsf3y_menu` VALUES (16,'menu','com_redirect','Redirect','','Redirect','index.php?option=com_redirect','component',0,1,1,24,0,0,'0000-00-00 00:00:00',0,0,'class:redirect',0,'',29,30,0,'*',1);
INSERT INTO `lsf3y_menu` VALUES (17,'menu','com_search','Basic Search','','Basic Search','index.php?option=com_search','component',0,1,1,19,0,0,'0000-00-00 00:00:00',0,0,'class:search',0,'',25,26,0,'*',1);
INSERT INTO `lsf3y_menu` VALUES (22,'menu','com_joomlaupdate','System Update','','System Update','index.php?option=com_joomlaupdate','component',0,1,1,28,0,0,'0000-00-00 00:00:00',0,0,'class:joomlaupdate',0,'',27,28,0,'*',1);
INSERT INTO `lsf3y_menu` VALUES (101,'mainmenu','Home','home','','home','index.php?option=com_mediamanager&view=station&layout=view&task=view&id=1','component',1,1,1,10011,0,84,'2013-05-17 03:24:43',0,1,'',0,'{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"page_title\":\"\",\"show_page_heading\":1,\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',23,24,1,'*',0);
INSERT INTO `lsf3y_menu` VALUES (102,'main','COM_MEDIAMANAGER','com-mediamanager','','com-mediamanager','index.php?option=com_mediamanager','component',0,1,1,10011,0,0,'0000-00-00 00:00:00',0,1,'../media/com_mediamanager/images/mediamanager_16.png',0,'',31,32,0,'',1);
INSERT INTO `lsf3y_menu` VALUES (103,'mainmenu','Station 1','station-1','','station-1','index.php?option=com_mediamanager&view=libraries&layout=view&task=view&library_id=1','component',1,1,1,10011,0,0,'0000-00-00 00:00:00',0,1,'',0,'{\"reset\":\"1\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"page_title\":\"\",\"show_page_heading\":0,\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',33,34,0,'*',0);
INSERT INTO `lsf3y_menu` VALUES (104,'mainmenu','station 2','station-2','','station-2','index.php?option=com_mediamanager&view=item&layout=view&task=view&id=2','component',1,1,1,10011,0,0,'0000-00-00 00:00:00',0,1,'',0,'{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"page_title\":\"\",\"show_page_heading\":0,\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',35,36,0,'*',0);
INSERT INTO `lsf3y_menu` VALUES (105,'mainmenu','Kiosk','kiosk','','kiosk','index.php?option=com_mediamanager&view=item&layout=view&task=view&id=4','component',1,1,1,10011,0,0,'0000-00-00 00:00:00',0,1,'',0,'{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"page_title\":\"\",\"show_page_heading\":0,\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',37,38,0,'*',0);
INSERT INTO `lsf3y_menu` VALUES (107,'mainmenu','slogs','slogs','','slogs','index.php?option=com_mediamanager&view=station&layout=logs&task=logs','component',1,1,1,10011,0,0,'0000-00-00 00:00:00',0,1,'',0,'{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"page_title\":\"\",\"show_page_heading\":0,\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',39,40,0,'*',0);
INSERT INTO `lsf3y_menu` VALUES (108,'main','Scout','scout','','scout','index.php?option=com_scout','component',0,1,1,10035,0,0,'0000-00-00 00:00:00',0,1,'../media/com_scout/images/scout_16.png',0,'',41,42,0,'',1);
INSERT INTO `lsf3y_menu` VALUES (109,'mainmenu','dl','dl','','dl','index.php?option=com_mediamanager&view=station&layout=displaylogs&task=displaylogs','component',1,1,1,10011,0,0,'0000-00-00 00:00:00',0,1,'',0,'{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"page_title\":\"\",\"show_page_heading\":0,\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',43,44,0,'*',0);
/*!40000 ALTER TABLE `lsf3y_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_menu_types`
--

DROP TABLE IF EXISTS `lsf3y_menu_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_menu_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menutype` varchar(24) NOT NULL,
  `title` varchar(48) NOT NULL,
  `description` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_menutype` (`menutype`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_menu_types`
--

LOCK TABLES `lsf3y_menu_types` WRITE;
/*!40000 ALTER TABLE `lsf3y_menu_types` DISABLE KEYS */;
INSERT INTO `lsf3y_menu_types` VALUES (1,'mainmenu','Main Menu','The main menu for the site');
/*!40000 ALTER TABLE `lsf3y_menu_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_messages`
--

DROP TABLE IF EXISTS `lsf3y_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_messages` (
  `message_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id_from` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id_to` int(10) unsigned NOT NULL DEFAULT '0',
  `folder_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `priority` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `subject` varchar(255) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `useridto_state` (`user_id_to`,`state`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_messages`
--

LOCK TABLES `lsf3y_messages` WRITE;
/*!40000 ALTER TABLE `lsf3y_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `lsf3y_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_messages_cfg`
--

DROP TABLE IF EXISTS `lsf3y_messages_cfg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_messages_cfg` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `cfg_name` varchar(100) NOT NULL DEFAULT '',
  `cfg_value` varchar(255) NOT NULL DEFAULT '',
  UNIQUE KEY `idx_user_var_name` (`user_id`,`cfg_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_messages_cfg`
--

LOCK TABLES `lsf3y_messages_cfg` WRITE;
/*!40000 ALTER TABLE `lsf3y_messages_cfg` DISABLE KEYS */;
/*!40000 ALTER TABLE `lsf3y_messages_cfg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_modules`
--

DROP TABLE IF EXISTS `lsf3y_modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '',
  `note` varchar(255) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `position` varchar(50) NOT NULL DEFAULT '',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `module` varchar(50) DEFAULT NULL,
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `showtitle` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `params` text NOT NULL,
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  `language` char(7) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `published` (`published`,`access`),
  KEY `newsfeeds` (`module`,`published`),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_modules`
--

LOCK TABLES `lsf3y_modules` WRITE;
/*!40000 ALTER TABLE `lsf3y_modules` DISABLE KEYS */;
INSERT INTO `lsf3y_modules` VALUES (1,'Main Menu','','',1,'position-7',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',1,'mod_menu',1,1,'{\"menutype\":\"mainmenu\",\"startLevel\":\"0\",\"endLevel\":\"0\",\"showAllChildren\":\"0\",\"tag_id\":\"\",\"class_sfx\":\"\",\"window_open\":\"\",\"layout\":\"\",\"moduleclass_sfx\":\"_menu\",\"cache\":\"1\",\"cache_time\":\"900\",\"cachemode\":\"itemid\"}',0,'*');
INSERT INTO `lsf3y_modules` VALUES (2,'Login','','',1,'login',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',1,'mod_login',1,1,'',1,'*');
INSERT INTO `lsf3y_modules` VALUES (4,'Recently Added Articles','','',4,'cpanel',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'mod_latest',3,1,'{\"count\":\"5\",\"ordering\":\"c_dsc\",\"catid\":\"\",\"user_id\":\"0\",\"layout\":\"_:default\",\"moduleclass_sfx\":\"\",\"cache\":\"0\",\"automatic_title\":\"1\"}',1,'*');
INSERT INTO `lsf3y_modules` VALUES (8,'Toolbar','','',1,'toolbar',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',1,'mod_toolbar',3,1,'',1,'*');
INSERT INTO `lsf3y_modules` VALUES (9,'Quick Icons','','',1,'icon',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',1,'mod_quickicon',3,1,'',1,'*');
INSERT INTO `lsf3y_modules` VALUES (10,'Logged-in Users','','',2,'cpanel',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',1,'mod_logged',3,1,'{\"count\":\"5\",\"name\":\"1\",\"layout\":\"_:default\",\"moduleclass_sfx\":\"\",\"cache\":\"0\",\"automatic_title\":\"1\"}',1,'*');
INSERT INTO `lsf3y_modules` VALUES (12,'Admin Menu','','',1,'menu',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',1,'mod_menu',3,0,'{\"layout\":\"_:default\",\"moduleclass_sfx\":\"\",\"shownew\":\"1\",\"showhelp\":\"1\",\"forum_url\":\"\",\"cache\":\"0\"}',1,'*');
INSERT INTO `lsf3y_modules` VALUES (13,'Admin Submenu','','',1,'submenu',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',1,'mod_submenu',3,1,'',1,'*');
INSERT INTO `lsf3y_modules` VALUES (16,'Login Form','','',7,'position-7',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',1,'mod_login',1,1,'{\"greeting\":\"1\",\"name\":\"0\"}',0,'*');
INSERT INTO `lsf3y_modules` VALUES (17,'Breadcrumbs','','',1,'position-2',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',1,'mod_breadcrumbs',1,1,'{\"moduleclass_sfx\":\"\",\"showHome\":\"1\",\"homeText\":\"Home\",\"showComponent\":\"1\",\"separator\":\"\",\"cache\":\"1\",\"cache_time\":\"900\",\"cachemode\":\"itemid\"}',0,'*');
INSERT INTO `lsf3y_modules` VALUES (86,'Joomla Version','','',1,'footer',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'mod_version',3,1,'{\"format\":\"short\",\"product\":\"1\",\"layout\":\"_:default\",\"moduleclass_sfx\":\"\",\"cache\":\"0\"}',1,'*');
INSERT INTO `lsf3y_modules` VALUES (87,'Mediamanager - Categories','','',0,'',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'mod_mediamanager_categories',1,1,'',0,'*');
INSERT INTO `lsf3y_modules` VALUES (88,'Mediamanager - Media Item','','',0,'',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'mod_mediamanager_media',1,1,'',0,'*');
INSERT INTO `lsf3y_modules` VALUES (90,'Quick Links','','',1,'dashboard',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',1,'mod_rokquicklinks',1,1,'{\"iconpath\":\"\\/administrator\\/modules\\/mod_rokquicklinks\\/tmpl\\/icons\\/\",\"quickfields\":\"[{\'title\':\'Create A Playlist\',\'link\':\'index.php?option=com_mediamanager&view=media&task=add&handler=slideshow_kiosk\',\'target\':\'self\',\'icon\':\'images.png\'},{\'title\':\'Create a Station\',\'link\':\'index.php?option=com_mediamanager&view=stations&task=edit&id=0\',\'target\':\'self\',\'icon\':\'google_map.png\'},{\'title\':\'Create an Advertiser\',\'link\':\'index.php?option=com_mediamanager&view=advertisers&task=edit&id=0\',\'target\':\'self\',\'icon\':\'hat.png\'}]\"}',1,'en-GB');
INSERT INTO `lsf3y_modules` VALUES (92,'Statistics Overview','','',1,'sidebar',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',1,'mod_rokuserstats',1,1,'{\"purgedays\":\"30\"}',1,'en-GB');
INSERT INTO `lsf3y_modules` VALUES (94,'Site Statistics','','',1,'left',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',1,'mod_rokstats',1,1,'{\"sessiontime\":\"\",\"showcurrentactiveusers\":\"1\",\"showactiveguests\":\"1\",\"showactiveregistered\":\"1\",\"showregisteredusernames\":\"0\",\"showuniqueviststoday\":\"1\",\"showuniquevistsyesterday\":\"1\",\"showvisitsthisweek\":\"1\",\"showvisitspreviousweek\":\"1\",\"showtotalarticles\":\"0\",\"shownewarticlesthisweek\":\"0\"}',0,'en-GB');
INSERT INTO `lsf3y_modules` VALUES (96,'User Activity Chart','','',2,'sidebar',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',1,'mod_rokuserchart',1,1,'{\"extra_class\":\"\",\"history\":\"7\",\"width\":\"285\",\"height\":\"120\"}',1,'en-GB');
INSERT INTO `lsf3y_modules` VALUES (98,'Admin Audit Trail','','',3,'sidebar',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',1,'mod_rokadminaudit',1,1,'{\"userpurgedays\":\"14\",\"adminpurgedays\":\"14\",\"trackusers\":\"1\",\"trackadmins\":\"1\"}',1,'en-GB');
INSERT INTO `lsf3y_modules` VALUES (99,'Recent Activity','','',0,'cpanel',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',1,'mod_scout_activity',1,1,'',1,'*');
/*!40000 ALTER TABLE `lsf3y_modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_modules_menu`
--

DROP TABLE IF EXISTS `lsf3y_modules_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_modules_menu` (
  `moduleid` int(11) NOT NULL DEFAULT '0',
  `menuid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`moduleid`,`menuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_modules_menu`
--

LOCK TABLES `lsf3y_modules_menu` WRITE;
/*!40000 ALTER TABLE `lsf3y_modules_menu` DISABLE KEYS */;
INSERT INTO `lsf3y_modules_menu` VALUES (1,0);
INSERT INTO `lsf3y_modules_menu` VALUES (2,0);
INSERT INTO `lsf3y_modules_menu` VALUES (4,0);
INSERT INTO `lsf3y_modules_menu` VALUES (6,0);
INSERT INTO `lsf3y_modules_menu` VALUES (7,0);
INSERT INTO `lsf3y_modules_menu` VALUES (8,0);
INSERT INTO `lsf3y_modules_menu` VALUES (9,0);
INSERT INTO `lsf3y_modules_menu` VALUES (10,0);
INSERT INTO `lsf3y_modules_menu` VALUES (12,0);
INSERT INTO `lsf3y_modules_menu` VALUES (13,0);
INSERT INTO `lsf3y_modules_menu` VALUES (16,0);
INSERT INTO `lsf3y_modules_menu` VALUES (17,0);
INSERT INTO `lsf3y_modules_menu` VALUES (86,0);
INSERT INTO `lsf3y_modules_menu` VALUES (90,0);
INSERT INTO `lsf3y_modules_menu` VALUES (92,0);
INSERT INTO `lsf3y_modules_menu` VALUES (94,0);
INSERT INTO `lsf3y_modules_menu` VALUES (96,0);
INSERT INTO `lsf3y_modules_menu` VALUES (98,0);
INSERT INTO `lsf3y_modules_menu` VALUES (99,0);
/*!40000 ALTER TABLE `lsf3y_modules_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_overrider`
--

DROP TABLE IF EXISTS `lsf3y_overrider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_overrider` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `constant` varchar(255) NOT NULL,
  `string` text NOT NULL,
  `file` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_overrider`
--

LOCK TABLES `lsf3y_overrider` WRITE;
/*!40000 ALTER TABLE `lsf3y_overrider` DISABLE KEYS */;
/*!40000 ALTER TABLE `lsf3y_overrider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_redirect_links`
--

DROP TABLE IF EXISTS `lsf3y_redirect_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_redirect_links` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `old_url` varchar(255) NOT NULL,
  `new_url` varchar(255) NOT NULL,
  `referer` varchar(150) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `published` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_link_old` (`old_url`),
  KEY `idx_link_modifed` (`modified_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_redirect_links`
--

LOCK TABLES `lsf3y_redirect_links` WRITE;
/*!40000 ALTER TABLE `lsf3y_redirect_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `lsf3y_redirect_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_rokadminaudit`
--

DROP TABLE IF EXISTS `lsf3y_rokadminaudit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_rokadminaudit` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `session_id` varchar(50) DEFAULT NULL,
  `option` varchar(100) DEFAULT NULL,
  `task` varchar(100) DEFAULT NULL,
  `cid` int(50) DEFAULT NULL,
  `page` varchar(255) DEFAULT NULL,
  `referrer` varchar(255) DEFAULT NULL,
  `title` text,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `ip` (`ip`),
  KEY `session_id` (`session_id`),
  KEY `timestamp` (`timestamp`)
) ENGINE=MyISAM AUTO_INCREMENT=2124 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_rokadminaudit`
--

LOCK TABLES `lsf3y_rokadminaudit` WRITE;
/*!40000 ALTER TABLE `lsf3y_rokadminaudit` DISABLE KEYS */;
INSERT INTO `lsf3y_rokadminaudit` VALUES (2123,85,'108.162.242.208','i0tt5h1r5j7dnuubi7k7ree2i5','com_mediamanager','edit',1,'/administrator/index.php?option=com_mediamanager&view=stations&task=edit&id=1','http://watch.2win.co/administrator/index.php?option=com_mediamanager&view=stations','','2013-06-17 15:10:18');
INSERT INTO `lsf3y_rokadminaudit` VALUES (2122,85,'108.162.242.208','i0tt5h1r5j7dnuubi7k7ree2i5','com_mediamanager','',NULL,'/administrator/index.php?option=com_mediamanager&view=stations','http://watch.2win.co/administrator/index.php?option=com_mediamanager&view=media','','2013-06-17 15:10:16');
INSERT INTO `lsf3y_rokadminaudit` VALUES (2121,85,'108.162.242.208','i0tt5h1r5j7dnuubi7k7ree2i5','com_mediamanager','',NULL,'/administrator/index.php?option=com_mediamanager&view=media','http://watch.2win.co/administrator/index.php?option=com_menus&view=menus','','2013-06-17 15:10:12');
INSERT INTO `lsf3y_rokadminaudit` VALUES (2120,85,'108.162.242.208','i0tt5h1r5j7dnuubi7k7ree2i5','com_mediamanager','',NULL,'/administrator/index.php?option=com_mediamanager','http://watch.2win.co/administrator/index.php?option=com_menus&view=menus','','2013-06-17 15:10:12');
INSERT INTO `lsf3y_rokadminaudit` VALUES (2118,85,'108.162.242.208','i0tt5h1r5j7dnuubi7k7ree2i5','com_cpanel','',NULL,'/administrator/index.php','http://watch.2win.co/administrator/','','2013-06-17 15:10:00');
INSERT INTO `lsf3y_rokadminaudit` VALUES (2119,85,'108.162.242.208','i0tt5h1r5j7dnuubi7k7ree2i5','com_menus','',NULL,'/administrator/index.php?option=com_menus&view=menus','http://watch.2win.co/administrator/index.php','','2013-06-17 15:10:09');
INSERT INTO `lsf3y_rokadminaudit` VALUES (2116,0,'108.162.242.208','i0tt5h1r5j7dnuubi7k7ree2i5','com_cpanel','',NULL,'/administrator/','','','2013-06-17 15:09:57');
INSERT INTO `lsf3y_rokadminaudit` VALUES (2117,0,'108.162.242.208','i0tt5h1r5j7dnuubi7k7ree2i5','com_login','login',NULL,'/administrator/index.php','http://watch.2win.co/administrator/','','2013-06-17 15:09:59');
/*!40000 ALTER TABLE `lsf3y_rokadminaudit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_rokuserstats`
--

DROP TABLE IF EXISTS `lsf3y_rokuserstats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_rokuserstats` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `session_id` varchar(50) DEFAULT NULL,
  `page` varchar(255) DEFAULT NULL,
  `referrer` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `ip` (`ip`),
  KEY `session_id` (`session_id`),
  KEY `timestamp` (`timestamp`)
) ENGINE=MyISAM AUTO_INCREMENT=392 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_rokuserstats`
--

LOCK TABLES `lsf3y_rokuserstats` WRITE;
/*!40000 ALTER TABLE `lsf3y_rokuserstats` DISABLE KEYS */;
INSERT INTO `lsf3y_rokuserstats` VALUES (391,0,'141.101.99.109','6889eeaaac9299cdd8addd455b73e2b7','/?uuid=f0:ae:51:00:04:ef','','2013-06-24 20:30:50');
INSERT INTO `lsf3y_rokuserstats` VALUES (390,0,'141.101.99.109','858vj5hsf2qit81ptt51tklbv5','/slogs','','2013-06-24 16:47:07');
INSERT INTO `lsf3y_rokuserstats` VALUES (389,0,'141.101.99.109','th688erjf7epj6abuimd8d3h97','/','','2013-06-24 16:37:03');
INSERT INTO `lsf3y_rokuserstats` VALUES (388,0,'173.245.56.78','0ener7seiqse2bq6j84lg7p056','/','','2013-06-23 12:06:49');
INSERT INTO `lsf3y_rokuserstats` VALUES (386,0,'173.245.56.78','7lukjmple2ueds28dvb63fd1u7','/','','2013-06-23 12:06:48');
INSERT INTO `lsf3y_rokuserstats` VALUES (387,0,'199.27.128.104','mt1q6m98mlt2jf914spjb7ko41','/','','2013-06-23 12:06:49');
INSERT INTO `lsf3y_rokuserstats` VALUES (385,0,'199.27.128.104','g21pmlu7iuqo3b3e4gcopqjdi1','/','','2013-06-23 12:06:47');
INSERT INTO `lsf3y_rokuserstats` VALUES (384,0,'141.101.99.109','7t9ihn5pv9ivptrh1rgh0f2rc7','/index.php?option=com_mediamanager&controller=station&task=displaylog&uuid=f0:ae:51:00:04:ef&mfid=32','http://watch.2win.co/?uuid=f0:ae:51:00:04:ef','2013-06-19 19:44:09');
INSERT INTO `lsf3y_rokuserstats` VALUES (382,0,'141.101.99.109','7t9ihn5pv9ivptrh1rgh0f2rc7','/?uuid=f0:ae:51:00:04:ef','','2013-06-19 19:43:47');
INSERT INTO `lsf3y_rokuserstats` VALUES (383,0,'141.101.99.109','7t9ihn5pv9ivptrh1rgh0f2rc7','/','http://watch.2win.co/?uuid=f0:ae:51:00:04:ef','2013-06-19 19:43:50');
INSERT INTO `lsf3y_rokuserstats` VALUES (380,0,'141.101.99.109','34ejdei63367o7auu2g9dgegh0','/?uuid=f0:ae:51:00:04:ef','','2013-06-19 19:41:51');
INSERT INTO `lsf3y_rokuserstats` VALUES (381,0,'141.101.99.109','34ejdei63367o7auu2g9dgegh0','/index.php?option=com_mediamanager&controller=station&task=displaylog&uuid=f0:ae:51:00:04:ef&mfid=32','http://watch.2win.co/?uuid=f0:ae:51:00:04:ef','2013-06-19 19:42:12');
INSERT INTO `lsf3y_rokuserstats` VALUES (379,0,'141.101.99.109','34ejdei63367o7auu2g9dgegh0','/index.php?option=com_mediamanager&controller=station&task=displaylog&uuid=f0:ae:51:00:04:ef&mfid=32','http://watch.2win.co/?uuid=f0:ae:51:00:04:ef','2013-06-19 19:41:25');
INSERT INTO `lsf3y_rokuserstats` VALUES (378,0,'141.101.99.109','34ejdei63367o7auu2g9dgegh0','/?uuid=f0:ae:51:00:04:ef','','2013-06-19 19:40:58');
INSERT INTO `lsf3y_rokuserstats` VALUES (377,0,'108.162.229.6','sle8fou9oidbic7mtcjb2q7oj4','/index.php?option=com_mediamanager&controller=station&task=displaylog&uuid=f0:ae:51:00:04:ef&mfid=32','http://watch.2win.co/?uuid=f0:ae:51:00:04:ef','2013-06-17 21:19:17');
INSERT INTO `lsf3y_rokuserstats` VALUES (376,0,'108.162.229.6','sle8fou9oidbic7mtcjb2q7oj4','/?uuid=f0:ae:51:00:04:ef','http://webmail.crosscliq.com/src/read_body.php?mailbox=INBOX&passed_id=137&startMessage=46','2013-06-17 21:19:01');
INSERT INTO `lsf3y_rokuserstats` VALUES (375,0,'141.101.98.107','sle8fou9oidbic7mtcjb2q7oj4','/index.php?option=com_mediamanager&controller=station&task=displaylog&uuid=f0:ae:51:00:04:ef&mfid=32','http://watch.2win.co/?uuid=f0:ae:51:00:04:ef','2013-06-17 21:18:54');
INSERT INTO `lsf3y_rokuserstats` VALUES (374,0,'141.101.98.107','sle8fou9oidbic7mtcjb2q7oj4','/?uuid=f0:ae:51:00:04:ef','http://webmail.crosscliq.com/src/read_body.php?mailbox=INBOX&passed_id=137&startMessage=46','2013-06-17 21:18:36');
INSERT INTO `lsf3y_rokuserstats` VALUES (372,0,'108.162.229.6','pkjfp724dvfftf8s8og5nbhur1','/?uuid=f0:ae:51:00:04:ef','','2013-06-17 21:10:10');
INSERT INTO `lsf3y_rokuserstats` VALUES (373,0,'108.162.229.6','pkjfp724dvfftf8s8og5nbhur1','/index.php?option=com_mediamanager&controller=station&task=displaylog&uuid=f0:ae:51:00:04:ef&mfid=32','http://watch.2win.co/?uuid=f0:ae:51:00:04:ef','2013-06-17 21:10:34');
INSERT INTO `lsf3y_rokuserstats` VALUES (371,0,'141.101.98.107','k91e56ua0ebeii8er48jq8uv41','/index.php?option=com_mediamanager&controller=station&task=displaylog&uuid=f0:ae:51:00:04:ef&mfid=32','http://watch.2win.co/?uuid=f0:ae:51:00:04:ef','2013-06-17 20:34:55');
INSERT INTO `lsf3y_rokuserstats` VALUES (369,0,'141.101.98.107','k91e56ua0ebeii8er48jq8uv41','/?uuid=f0:ae:51:00:04:ef','','2013-06-17 20:34:18');
INSERT INTO `lsf3y_rokuserstats` VALUES (370,0,'141.101.98.107','k91e56ua0ebeii8er48jq8uv41','/','http://watch.2win.co/?uuid=f0:ae:51:00:04:ef','2013-06-17 20:34:34');
INSERT INTO `lsf3y_rokuserstats` VALUES (367,0,'141.101.98.107','7je39vei83uevfmm56epes4d16','/?uuid=f0:ae:51:00:04:ef','','2013-06-17 20:32:24');
INSERT INTO `lsf3y_rokuserstats` VALUES (368,0,'141.101.98.107','7je39vei83uevfmm56epes4d16','/index.php?option=com_mediamanager&controller=station&task=displaylog&uuid=f0:ae:51:00:04:ef&mfid=32','http://watch.2win.co/?uuid=f0:ae:51:00:04:ef','2013-06-17 20:32:46');
INSERT INTO `lsf3y_rokuserstats` VALUES (365,0,'141.101.98.107','ermf9cqv6br9gunh0oh12obhh2','/?uuid=f0:ae:51:00:04:ef','','2013-06-17 20:19:48');
INSERT INTO `lsf3y_rokuserstats` VALUES (366,0,'141.101.98.107','ermf9cqv6br9gunh0oh12obhh2','/index.php?option=com_mediamanager&controller=station&task=displaylog&uuid=f0:ae:51:00:04:ef&mfid=32','http://watch.2win.co/?uuid=f0:ae:51:00:04:ef','2013-06-17 20:20:09');
INSERT INTO `lsf3y_rokuserstats` VALUES (362,0,'141.101.98.107','ermf9cqv6br9gunh0oh12obhh2','/','','2013-06-17 20:18:47');
INSERT INTO `lsf3y_rokuserstats` VALUES (363,0,'141.101.98.107','ermf9cqv6br9gunh0oh12obhh2','/','','2013-06-17 20:18:59');
INSERT INTO `lsf3y_rokuserstats` VALUES (364,0,'141.101.98.107','ermf9cqv6br9gunh0oh12obhh2','/','','2013-06-17 20:19:06');
INSERT INTO `lsf3y_rokuserstats` VALUES (360,0,'108.162.242.208','lr2nvmeb7l7dar0dkpjf5v7g35','/?uuid=123412341234131','','2013-06-17 15:11:54');
INSERT INTO `lsf3y_rokuserstats` VALUES (361,0,'173.245.48.29','4j551jglncud1liv00dubrg4c1','/?uuid=123412341234131','','2013-06-17 15:14:26');
INSERT INTO `lsf3y_rokuserstats` VALUES (359,0,'108.162.242.208','lr2nvmeb7l7dar0dkpjf5v7g35','/?uuid=123412341234131','','2013-06-17 15:11:13');
INSERT INTO `lsf3y_rokuserstats` VALUES (357,0,'108.162.242.208','vd6vn32v1islp3ji0mra5730j2','/','http://watch.2win.co/administrator/index.php?option=com_mediamanager&view=stations&task=edit&id=1','2013-06-17 15:10:40');
INSERT INTO `lsf3y_rokuserstats` VALUES (358,0,'108.162.242.208','vd6vn32v1islp3ji0mra5730j2','/?uuid=123412341234131','','2013-06-17 15:10:58');
INSERT INTO `lsf3y_rokuserstats` VALUES (337,0,'199.27.128.104','fkv8tmu8uq1anfsvr2u8op4gl7','/','','2013-06-07 05:38:10');
INSERT INTO `lsf3y_rokuserstats` VALUES (338,0,'173.245.56.78','1crgpcjseabol8j9b52tq9k835','/','','2013-06-07 05:38:11');
INSERT INTO `lsf3y_rokuserstats` VALUES (339,0,'141.101.98.107','5984225o5eimr9lpmmh85h8bc3','/?uuid=f0:ae:51:00:04:ef','http://webmail.crosscliq.com/src/read_body.php?mailbox=INBOX&passed_id=137&startMessage=46','2013-06-10 15:43:36');
INSERT INTO `lsf3y_rokuserstats` VALUES (340,0,'141.101.98.107','5984225o5eimr9lpmmh85h8bc3','/index.php?option=com_mediamanager&controller=station&task=displaylog&uuid=f0:ae:51:00:04:ef&mfid=32','http://watch.2win.co/?uuid=f0:ae:51:00:04:ef','2013-06-10 15:43:55');
INSERT INTO `lsf3y_rokuserstats` VALUES (341,0,'141.101.98.107','emsrhoihkajc40cppka8s533l7','/?uuid=f0:ae:51:00:04:ef','','2013-06-10 15:44:27');
INSERT INTO `lsf3y_rokuserstats` VALUES (342,0,'141.101.98.107','emsrhoihkajc40cppka8s533l7','/index.php?option=com_mediamanager&controller=station&task=displaylog&uuid=f0:ae:51:00:04:ef&mfid=32','http://watch.2win.co/?uuid=f0:ae:51:00:04:ef','2013-06-10 15:44:46');
INSERT INTO `lsf3y_rokuserstats` VALUES (343,0,'141.101.98.107','pdnfdpurfcg1qa22fpkgt47ln2','/?uuid=f0:ae:51:00:04:ef','','2013-06-10 15:55:12');
INSERT INTO `lsf3y_rokuserstats` VALUES (344,0,'141.101.98.107','pdnfdpurfcg1qa22fpkgt47ln2','/index.php?option=com_mediamanager&controller=station&task=displaylog&uuid=f0:ae:51:00:04:ef&mfid=32','http://watch.2win.co/?uuid=f0:ae:51:00:04:ef','2013-06-10 15:55:29');
INSERT INTO `lsf3y_rokuserstats` VALUES (345,0,'141.101.98.107','5984225o5eimr9lpmmh85h8bc3','/?uuid=f0:ae:51:00:04:ef','http://webmail.crosscliq.com/src/read_body.php?mailbox=INBOX&passed_id=137&startMessage=46','2013-06-10 15:55:51');
INSERT INTO `lsf3y_rokuserstats` VALUES (346,0,'141.101.98.107','5984225o5eimr9lpmmh85h8bc3','/index.php?option=com_mediamanager&controller=station&task=displaylog&uuid=f0:ae:51:00:04:ef&mfid=32','http://watch.2win.co/?uuid=f0:ae:51:00:04:ef','2013-06-10 15:56:06');
INSERT INTO `lsf3y_rokuserstats` VALUES (347,0,'141.101.98.107','5984225o5eimr9lpmmh85h8bc3','/index.php?option=com_mediamanager&controller=station&task=displaylog&uuid=f0:ae:51:00:04:ef&mfid=36','http://watch.2win.co/?uuid=f0:ae:51:00:04:ef','2013-06-10 15:58:09');
INSERT INTO `lsf3y_rokuserstats` VALUES (348,0,'141.101.98.107','5984225o5eimr9lpmmh85h8bc3','/index.php?option=com_mediamanager&controller=station&task=displaylog&uuid=f0:ae:51:00:04:ef&mfid=31','http://watch.2win.co/?uuid=f0:ae:51:00:04:ef','2013-06-10 15:58:23');
INSERT INTO `lsf3y_rokuserstats` VALUES (349,0,'141.101.98.107','v9gl5rsp8ljp8kulc673pg5dj5','/?uuid=f0:ae:51:00:04:ef','','2013-06-10 16:47:04');
INSERT INTO `lsf3y_rokuserstats` VALUES (350,0,'141.101.98.107','v9gl5rsp8ljp8kulc673pg5dj5','/index.php?option=com_mediamanager&controller=station&task=displaylog&uuid=f0:ae:51:00:04:ef&mfid=32','http://watch.2win.co/?uuid=f0:ae:51:00:04:ef','2013-06-10 16:47:21');
INSERT INTO `lsf3y_rokuserstats` VALUES (351,0,'141.101.98.107','c6031v3t4pe26uo6iucjtkk4f7','/?uuid=f0:ae:51:00:04:ef','','2013-06-10 16:51:33');
INSERT INTO `lsf3y_rokuserstats` VALUES (352,0,'141.101.98.107','c6031v3t4pe26uo6iucjtkk4f7','/index.php?option=com_mediamanager&controller=station&task=displaylog&uuid=f0:ae:51:00:04:ef&mfid=32','http://watch.2win.co/?uuid=f0:ae:51:00:04:ef','2013-06-10 16:51:50');
INSERT INTO `lsf3y_rokuserstats` VALUES (353,0,'199.27.128.104','4qe9rjfksrkhk1vbroaadooi85','/','','2013-06-15 12:04:08');
INSERT INTO `lsf3y_rokuserstats` VALUES (354,0,'199.27.128.104','j636g52vd7dv43ho472o2ll8q2','/','','2013-06-15 12:04:11');
INSERT INTO `lsf3y_rokuserstats` VALUES (355,0,'173.245.56.78','950bhu8b41k3v47djc5dkjdbf2','/','','2013-06-15 12:04:13');
INSERT INTO `lsf3y_rokuserstats` VALUES (356,0,'173.245.56.78','vnh5e39poarjfb8otlgsmbb075','/','','2013-06-15 12:05:08');
/*!40000 ALTER TABLE `lsf3y_rokuserstats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_schemas`
--

DROP TABLE IF EXISTS `lsf3y_schemas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_schemas` (
  `extension_id` int(11) NOT NULL,
  `version_id` varchar(20) NOT NULL,
  PRIMARY KEY (`extension_id`,`version_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_schemas`
--

LOCK TABLES `lsf3y_schemas` WRITE;
/*!40000 ALTER TABLE `lsf3y_schemas` DISABLE KEYS */;
INSERT INTO `lsf3y_schemas` VALUES (700,'2.5.11');
/*!40000 ALTER TABLE `lsf3y_schemas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_scout_config`
--

DROP TABLE IF EXISTS `lsf3y_scout_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_scout_config` (
  `config_id` int(11) NOT NULL AUTO_INCREMENT,
  `config_name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`config_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_scout_config`
--

LOCK TABLES `lsf3y_scout_config` WRITE;
/*!40000 ALTER TABLE `lsf3y_scout_config` DISABLE KEYS */;
/*!40000 ALTER TABLE `lsf3y_scout_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_scout_logs`
--

DROP TABLE IF EXISTS `lsf3y_scout_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_scout_logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` datetime NOT NULL COMMENT 'Always in GMT',
  `subject_id` int(11) NOT NULL,
  `verb_id` int(11) NOT NULL,
  `object_id` int(11) NOT NULL,
  PRIMARY KEY (`log_id`),
  KEY `subject_id` (`subject_id`),
  KEY `object_id` (`object_id`)
) ENGINE=MyISAM AUTO_INCREMENT=149 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_scout_logs`
--

LOCK TABLES `lsf3y_scout_logs` WRITE;
/*!40000 ALTER TABLE `lsf3y_scout_logs` DISABLE KEYS */;
INSERT INTO `lsf3y_scout_logs` VALUES (1,'2013-05-21 15:15:53',1,1,1);
INSERT INTO `lsf3y_scout_logs` VALUES (2,'2013-05-21 15:36:17',2,2,2);
INSERT INTO `lsf3y_scout_logs` VALUES (3,'2013-05-21 15:57:20',2,2,2);
INSERT INTO `lsf3y_scout_logs` VALUES (4,'2013-05-21 15:57:48',1,1,1);
INSERT INTO `lsf3y_scout_logs` VALUES (5,'2013-05-21 16:51:47',1,1,1);
INSERT INTO `lsf3y_scout_logs` VALUES (6,'2013-05-21 18:24:25',1,1,1);
INSERT INTO `lsf3y_scout_logs` VALUES (7,'2013-05-21 19:57:38',1,1,1);
INSERT INTO `lsf3y_scout_logs` VALUES (8,'2013-05-21 22:35:30',3,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (9,'2013-05-21 22:36:10',3,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (10,'2013-05-21 22:36:21',3,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (11,'2013-05-21 22:36:30',3,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (12,'2013-05-21 22:37:20',3,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (13,'2013-05-21 22:38:09',3,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (14,'2013-05-21 22:38:25',3,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (15,'2013-05-21 22:40:59',3,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (16,'2013-05-21 22:43:39',3,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (17,'2013-05-21 22:44:29',3,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (18,'2013-05-21 22:44:45',3,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (19,'2013-05-21 22:51:18',1,1,1);
INSERT INTO `lsf3y_scout_logs` VALUES (20,'2013-05-21 23:04:31',3,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (21,'2013-05-21 23:04:50',3,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (22,'2013-05-22 16:28:10',1,1,1);
INSERT INTO `lsf3y_scout_logs` VALUES (23,'2013-05-22 17:12:56',1,1,1);
INSERT INTO `lsf3y_scout_logs` VALUES (24,'2013-05-22 17:45:14',3,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (25,'2013-05-22 17:46:55',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (26,'2013-05-22 17:47:25',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (27,'2013-05-22 17:54:35',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (28,'2013-05-22 18:18:42',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (29,'2013-05-22 18:28:32',1,4,1);
INSERT INTO `lsf3y_scout_logs` VALUES (30,'2013-05-22 18:28:36',5,1,4);
INSERT INTO `lsf3y_scout_logs` VALUES (31,'2013-05-22 20:05:12',5,1,4);
INSERT INTO `lsf3y_scout_logs` VALUES (32,'2013-05-22 20:12:20',4,2,5);
INSERT INTO `lsf3y_scout_logs` VALUES (33,'2013-05-22 20:14:54',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (34,'2013-05-22 20:17:44',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (35,'2013-05-22 20:21:12',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (36,'2013-05-22 20:23:16',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (37,'2013-05-22 20:24:03',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (38,'2013-05-22 20:29:01',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (39,'2013-05-22 20:29:22',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (40,'2013-05-22 20:29:24',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (41,'2013-05-22 20:29:32',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (42,'2013-05-22 20:29:37',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (43,'2013-05-22 20:29:48',5,4,4);
INSERT INTO `lsf3y_scout_logs` VALUES (44,'2013-05-22 20:29:58',1,1,1);
INSERT INTO `lsf3y_scout_logs` VALUES (45,'2013-05-22 20:30:11',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (46,'2013-05-22 20:30:37',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (47,'2013-05-22 20:37:05',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (48,'2013-05-22 20:51:52',5,1,4);
INSERT INTO `lsf3y_scout_logs` VALUES (49,'2013-05-22 20:52:21',5,4,4);
INSERT INTO `lsf3y_scout_logs` VALUES (50,'2013-05-22 20:52:26',1,1,1);
INSERT INTO `lsf3y_scout_logs` VALUES (51,'2013-05-22 20:52:55',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (52,'2013-05-22 20:55:00',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (53,'2013-05-22 20:57:16',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (54,'2013-05-22 21:07:37',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (55,'2013-05-22 21:07:39',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (56,'2013-05-23 00:00:41',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (57,'2013-05-23 00:00:54',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (58,'2013-05-23 00:01:26',1,1,1);
INSERT INTO `lsf3y_scout_logs` VALUES (59,'2013-05-23 00:02:01',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (60,'2013-05-23 00:03:39',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (61,'2013-05-23 00:03:39',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (62,'2013-05-23 00:10:39',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (63,'2013-05-23 00:10:54',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (64,'2013-05-23 00:32:05',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (65,'2013-05-23 00:32:09',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (66,'2013-05-23 00:34:09',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (67,'2013-05-23 03:11:33',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (68,'2013-05-23 14:46:16',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (69,'2013-05-23 15:15:35',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (70,'2013-05-23 15:18:58',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (71,'2013-05-23 15:34:13',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (72,'2013-05-23 15:41:48',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (73,'2013-05-23 16:07:36',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (74,'2013-05-23 16:21:57',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (75,'2013-05-23 16:22:38',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (76,'2013-05-23 16:23:10',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (77,'2013-05-23 16:25:42',1,1,1);
INSERT INTO `lsf3y_scout_logs` VALUES (78,'2013-05-23 16:33:10',5,1,4);
INSERT INTO `lsf3y_scout_logs` VALUES (79,'2013-05-23 16:52:17',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (80,'2013-05-23 16:52:36',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (81,'2013-05-23 16:57:44',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (82,'2013-05-23 17:03:43',5,1,4);
INSERT INTO `lsf3y_scout_logs` VALUES (83,'2013-05-23 17:06:41',5,4,4);
INSERT INTO `lsf3y_scout_logs` VALUES (84,'2013-05-23 17:06:47',5,1,4);
INSERT INTO `lsf3y_scout_logs` VALUES (85,'2013-05-23 17:16:17',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (86,'2013-05-23 17:16:40',5,1,4);
INSERT INTO `lsf3y_scout_logs` VALUES (87,'2013-05-23 17:17:10',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (88,'2013-05-23 17:24:40',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (89,'2013-05-23 23:11:41',5,1,4);
INSERT INTO `lsf3y_scout_logs` VALUES (90,'2013-05-24 11:52:51',5,1,4);
INSERT INTO `lsf3y_scout_logs` VALUES (91,'2013-05-28 20:57:54',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (92,'2013-05-28 20:58:59',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (93,'2013-05-29 02:49:34',5,1,4);
INSERT INTO `lsf3y_scout_logs` VALUES (94,'2013-05-29 13:36:51',5,1,4);
INSERT INTO `lsf3y_scout_logs` VALUES (95,'2013-05-29 16:33:30',5,1,4);
INSERT INTO `lsf3y_scout_logs` VALUES (96,'2013-05-29 19:14:54',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (97,'2013-05-29 19:15:01',1,1,1);
INSERT INTO `lsf3y_scout_logs` VALUES (98,'2013-05-29 19:15:09',4,2,5);
INSERT INTO `lsf3y_scout_logs` VALUES (99,'2013-05-29 19:17:11',4,2,6);
INSERT INTO `lsf3y_scout_logs` VALUES (100,'2013-05-29 19:17:26',4,2,7);
INSERT INTO `lsf3y_scout_logs` VALUES (101,'2013-05-29 19:19:32',4,2,8);
INSERT INTO `lsf3y_scout_logs` VALUES (102,'2013-05-29 19:19:47',4,2,5);
INSERT INTO `lsf3y_scout_logs` VALUES (103,'2013-05-29 19:21:49',4,2,6);
INSERT INTO `lsf3y_scout_logs` VALUES (104,'2013-05-29 19:22:04',4,2,7);
INSERT INTO `lsf3y_scout_logs` VALUES (105,'2013-05-29 21:45:10',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (106,'2013-05-29 21:45:25',4,2,5);
INSERT INTO `lsf3y_scout_logs` VALUES (107,'2013-05-29 21:47:27',4,2,6);
INSERT INTO `lsf3y_scout_logs` VALUES (108,'2013-05-29 21:47:42',4,2,7);
INSERT INTO `lsf3y_scout_logs` VALUES (109,'2013-05-29 21:49:48',4,2,8);
INSERT INTO `lsf3y_scout_logs` VALUES (110,'2013-05-29 21:50:03',4,2,5);
INSERT INTO `lsf3y_scout_logs` VALUES (111,'2013-06-10 15:43:37',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (112,'2013-06-10 15:43:55',4,2,5);
INSERT INTO `lsf3y_scout_logs` VALUES (113,'2013-06-10 15:44:28',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (114,'2013-06-10 15:44:46',4,2,5);
INSERT INTO `lsf3y_scout_logs` VALUES (115,'2013-06-10 15:55:12',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (116,'2013-06-10 15:55:29',4,2,5);
INSERT INTO `lsf3y_scout_logs` VALUES (117,'2013-06-10 15:55:51',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (118,'2013-06-10 15:56:06',4,2,5);
INSERT INTO `lsf3y_scout_logs` VALUES (119,'2013-06-10 15:58:09',4,2,6);
INSERT INTO `lsf3y_scout_logs` VALUES (120,'2013-06-10 15:58:23',4,2,7);
INSERT INTO `lsf3y_scout_logs` VALUES (121,'2013-06-10 16:47:04',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (122,'2013-06-10 16:47:21',4,2,5);
INSERT INTO `lsf3y_scout_logs` VALUES (123,'2013-06-10 16:51:33',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (124,'2013-06-10 16:51:50',4,2,5);
INSERT INTO `lsf3y_scout_logs` VALUES (125,'2013-06-17 15:09:59',5,1,4);
INSERT INTO `lsf3y_scout_logs` VALUES (126,'2013-06-17 15:10:59',6,2,2);
INSERT INTO `lsf3y_scout_logs` VALUES (127,'2013-06-17 15:11:13',6,2,2);
INSERT INTO `lsf3y_scout_logs` VALUES (128,'2013-06-17 15:11:54',6,2,2);
INSERT INTO `lsf3y_scout_logs` VALUES (129,'2013-06-17 15:14:26',6,2,2);
INSERT INTO `lsf3y_scout_logs` VALUES (130,'2013-06-17 20:19:48',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (131,'2013-06-17 20:20:09',4,2,5);
INSERT INTO `lsf3y_scout_logs` VALUES (132,'2013-06-17 20:32:24',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (133,'2013-06-17 20:32:46',4,2,5);
INSERT INTO `lsf3y_scout_logs` VALUES (134,'2013-06-17 20:34:18',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (135,'2013-06-17 20:34:56',4,2,5);
INSERT INTO `lsf3y_scout_logs` VALUES (136,'2013-06-17 21:10:10',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (137,'2013-06-17 21:10:34',4,2,5);
INSERT INTO `lsf3y_scout_logs` VALUES (138,'2013-06-17 21:18:36',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (139,'2013-06-17 21:18:54',4,2,5);
INSERT INTO `lsf3y_scout_logs` VALUES (140,'2013-06-17 21:19:01',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (141,'2013-06-17 21:19:17',4,2,5);
INSERT INTO `lsf3y_scout_logs` VALUES (142,'2013-06-19 19:40:59',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (143,'2013-06-19 19:41:25',4,2,5);
INSERT INTO `lsf3y_scout_logs` VALUES (144,'2013-06-19 19:41:51',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (145,'2013-06-19 19:42:12',4,2,5);
INSERT INTO `lsf3y_scout_logs` VALUES (146,'2013-06-19 19:43:48',4,2,3);
INSERT INTO `lsf3y_scout_logs` VALUES (147,'2013-06-19 19:44:09',4,2,5);
INSERT INTO `lsf3y_scout_logs` VALUES (148,'2013-06-24 20:30:51',4,2,3);
/*!40000 ALTER TABLE `lsf3y_scout_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_scout_objects`
--

DROP TABLE IF EXISTS `lsf3y_scout_objects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_scout_objects` (
  `object_id` int(11) NOT NULL AUTO_INCREMENT,
  `object_name` varchar(255) NOT NULL,
  `scope_id` int(11) NOT NULL,
  `object_value` text NOT NULL,
  PRIMARY KEY (`object_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_scout_objects`
--

LOCK TABLES `lsf3y_scout_objects` WRITE;
/*!40000 ALTER TABLE `lsf3y_scout_objects` DISABLE KEYS */;
INSERT INTO `lsf3y_scout_objects` VALUES (1,'Super User',2,'84');
INSERT INTO `lsf3y_scout_objects` VALUES (2,'Testing Kiosk',1,'4');
INSERT INTO `lsf3y_scout_objects` VALUES (3,'In House Testing Show',1,'5');
INSERT INTO `lsf3y_scout_objects` VALUES (4,'Advertising Manager',2,'85');
INSERT INTO `lsf3y_scout_objects` VALUES (5,'57770.jpg',5,'32');
INSERT INTO `lsf3y_scout_objects` VALUES (6,'55715.mp4',5,'36');
INSERT INTO `lsf3y_scout_objects` VALUES (7,'56534.jpg',5,'31');
INSERT INTO `lsf3y_scout_objects` VALUES (8,'55714.webm',5,'34');
/*!40000 ALTER TABLE `lsf3y_scout_objects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_scout_scopes`
--

DROP TABLE IF EXISTS `lsf3y_scout_scopes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_scout_scopes` (
  `scope_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` tinyint(1) NOT NULL COMMENT '0=site, 1=administrator',
  `scope_name` varchar(255) NOT NULL COMMENT 'Plain English name for the scope',
  `scope_identifier` varchar(255) NOT NULL COMMENT 'String unique ID for the scope',
  `scope_url` text NOT NULL,
  PRIMARY KEY (`scope_id`),
  KEY `scope_identifier` (`scope_identifier`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_scout_scopes`
--

LOCK TABLES `lsf3y_scout_scopes` WRITE;
/*!40000 ALTER TABLE `lsf3y_scout_scopes` DISABLE KEYS */;
INSERT INTO `lsf3y_scout_scopes` VALUES (1,0,'Media Station','com_mediamanager.station','index.php?option=com_mediamanager&view=station');
INSERT INTO `lsf3y_scout_scopes` VALUES (2,1,'User Manager','com_user&view=user','index.php?option=com_users&view=user&task=edit&cid[]=');
INSERT INTO `lsf3y_scout_scopes` VALUES (3,0,'File Displayed','com_mediamanager.file','index.php?option=com_mediamanager&view=files&task=edit&id=');
INSERT INTO `lsf3y_scout_scopes` VALUES (4,1,'The Core Content Manager','com_content&view=article','index.php?option=com_content&view=article&task=edit&cid[]=');
INSERT INTO `lsf3y_scout_scopes` VALUES (5,0,'Media File','com_mediamanager.mediafile','');
/*!40000 ALTER TABLE `lsf3y_scout_scopes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_scout_subjects`
--

DROP TABLE IF EXISTS `lsf3y_scout_subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_scout_subjects` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(255) NOT NULL,
  `subjecttype_id` int(11) NOT NULL,
  `subject_value` text NOT NULL,
  PRIMARY KEY (`subject_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_scout_subjects`
--

LOCK TABLES `lsf3y_scout_subjects` WRITE;
/*!40000 ALTER TABLE `lsf3y_scout_subjects` DISABLE KEYS */;
INSERT INTO `lsf3y_scout_subjects` VALUES (1,'Super User',1,'84');
INSERT INTO `lsf3y_scout_subjects` VALUES (2,'Testing Kiosk',4,'4');
INSERT INTO `lsf3y_scout_subjects` VALUES (3,'In House Testing Show',4,'5');
INSERT INTO `lsf3y_scout_subjects` VALUES (4,'In House Testing Station',5,'2');
INSERT INTO `lsf3y_scout_subjects` VALUES (5,'Advertising Manager',1,'85');
INSERT INTO `lsf3y_scout_subjects` VALUES (6,'Station 1',5,'1');
/*!40000 ALTER TABLE `lsf3y_scout_subjects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_scout_subjecttypes`
--

DROP TABLE IF EXISTS `lsf3y_scout_subjecttypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_scout_subjecttypes` (
  `subjecttype_id` int(11) NOT NULL AUTO_INCREMENT,
  `subjecttype_name` varchar(255) NOT NULL,
  `subjecttype_value` text NOT NULL,
  `site_url` text NOT NULL,
  `admin_url` text NOT NULL,
  PRIMARY KEY (`subjecttype_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='Index of subject types, such as user, plugin, cronjob, etc';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_scout_subjecttypes`
--

LOCK TABLES `lsf3y_scout_subjecttypes` WRITE;
/*!40000 ALTER TABLE `lsf3y_scout_subjecttypes` DISABLE KEYS */;
INSERT INTO `lsf3y_scout_subjecttypes` VALUES (1,'A User','user','','index.php?option=com_users&view=user&task=edit&cid[]=');
INSERT INTO `lsf3y_scout_subjecttypes` VALUES (2,'A Plugin','plugin','','');
INSERT INTO `lsf3y_scout_subjecttypes` VALUES (3,'A CronJob','cronjob','','');
INSERT INTO `lsf3y_scout_subjecttypes` VALUES (4,'media','media','','');
INSERT INTO `lsf3y_scout_subjecttypes` VALUES (5,'station','station','','');
/*!40000 ALTER TABLE `lsf3y_scout_subjecttypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_scout_verbs`
--

DROP TABLE IF EXISTS `lsf3y_scout_verbs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_scout_verbs` (
  `verb_id` int(11) NOT NULL AUTO_INCREMENT,
  `verb_name` varchar(255) NOT NULL,
  `verb_value` text NOT NULL,
  PRIMARY KEY (`verb_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_scout_verbs`
--

LOCK TABLES `lsf3y_scout_verbs` WRITE;
/*!40000 ALTER TABLE `lsf3y_scout_verbs` DISABLE KEYS */;
INSERT INTO `lsf3y_scout_verbs` VALUES (1,'Logged In','login');
INSERT INTO `lsf3y_scout_verbs` VALUES (2,'Displayed','displayed');
INSERT INTO `lsf3y_scout_verbs` VALUES (3,'Created','created');
INSERT INTO `lsf3y_scout_verbs` VALUES (4,'Logged Out','logout');
/*!40000 ALTER TABLE `lsf3y_scout_verbs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_session`
--

DROP TABLE IF EXISTS `lsf3y_session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_session` (
  `session_id` varchar(200) NOT NULL DEFAULT '',
  `client_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `guest` tinyint(4) unsigned DEFAULT '1',
  `time` varchar(14) DEFAULT '',
  `data` mediumtext,
  `userid` int(11) DEFAULT '0',
  `username` varchar(150) DEFAULT '',
  `usertype` varchar(50) DEFAULT '',
  PRIMARY KEY (`session_id`),
  KEY `whosonline` (`guest`,`usertype`),
  KEY `userid` (`userid`),
  KEY `time` (`time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_session`
--

LOCK TABLES `lsf3y_session` WRITE;
/*!40000 ALTER TABLE `lsf3y_session` DISABLE KEYS */;
INSERT INTO `lsf3y_session` VALUES ('6889eeaaac9299cdd8addd455b73e2b7',0,1,'1372105851','__default|a:6:{s:24:\"session.client.forwarded\";s:11:\"69.27.7.162\";s:22:\"session.client.browser\";s:120:\"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.116 Safari/537.36\";s:15:\"session.counter\";i:1;s:8:\"registry\";O:9:\"JRegistry\":1:{s:7:\"\0*\0data\";O:8:\"stdClass\":0:{}}s:4:\"user\";O:5:\"JUser\":25:{s:9:\"\0*\0isRoot\";N;s:2:\"id\";i:0;s:4:\"name\";N;s:8:\"username\";N;s:5:\"email\";N;s:8:\"password\";N;s:14:\"password_clear\";s:0:\"\";s:8:\"usertype\";N;s:5:\"block\";N;s:9:\"sendEmail\";i:0;s:12:\"registerDate\";N;s:13:\"lastvisitDate\";N;s:10:\"activation\";N;s:6:\"params\";N;s:6:\"groups\";a:0:{}s:5:\"guest\";i:1;s:13:\"lastResetTime\";N;s:10:\"resetCount\";N;s:10:\"\0*\0_params\";O:9:\"JRegistry\":1:{s:7:\"\0*\0data\";O:8:\"stdClass\":0:{}}s:14:\"\0*\0_authGroups\";N;s:14:\"\0*\0_authLevels\";a:2:{i:0;i:1;i:1;i:1;}s:15:\"\0*\0_authActions\";N;s:12:\"\0*\0_errorMsg\";N;s:10:\"\0*\0_errors\";a:0:{}s:3:\"aid\";i:0;}s:13:\"session.token\";s:32:\"dc8809b96cd61fe0d3bb865de42eea8b\";}',0,'','');
INSERT INTO `lsf3y_session` VALUES ('858vj5hsf2qit81ptt51tklbv5',0,1,'1372092427','__default|a:8:{s:15:\"session.counter\";i:1;s:19:\"session.timer.start\";i:1372092427;s:18:\"session.timer.last\";i:1372092427;s:17:\"session.timer.now\";i:1372092427;s:24:\"session.client.forwarded\";s:11:\"69.27.7.162\";s:22:\"session.client.browser\";s:11:\"curl/7.26.0\";s:8:\"registry\";O:9:\"JRegistry\":1:{s:7:\"\0*\0data\";O:8:\"stdClass\":0:{}}s:4:\"user\";O:5:\"JUser\":25:{s:9:\"\0*\0isRoot\";N;s:2:\"id\";i:0;s:4:\"name\";N;s:8:\"username\";N;s:5:\"email\";N;s:8:\"password\";N;s:14:\"password_clear\";s:0:\"\";s:8:\"usertype\";N;s:5:\"block\";N;s:9:\"sendEmail\";i:0;s:12:\"registerDate\";N;s:13:\"lastvisitDate\";N;s:10:\"activation\";N;s:6:\"params\";N;s:6:\"groups\";a:0:{}s:5:\"guest\";i:1;s:13:\"lastResetTime\";N;s:10:\"resetCount\";N;s:10:\"\0*\0_params\";O:9:\"JRegistry\":1:{s:7:\"\0*\0data\";O:8:\"stdClass\":0:{}}s:14:\"\0*\0_authGroups\";N;s:14:\"\0*\0_authLevels\";a:2:{i:0;i:1;i:1;i:1;}s:15:\"\0*\0_authActions\";N;s:12:\"\0*\0_errorMsg\";N;s:10:\"\0*\0_errors\";a:0:{}s:3:\"aid\";i:0;}}',0,'','');
/*!40000 ALTER TABLE `lsf3y_session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_template_styles`
--

DROP TABLE IF EXISTS `lsf3y_template_styles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_template_styles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `template` varchar(50) NOT NULL DEFAULT '',
  `client_id` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `home` char(7) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_template` (`template`),
  KEY `idx_home` (`home`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_template_styles`
--

LOCK TABLES `lsf3y_template_styles` WRITE;
/*!40000 ALTER TABLE `lsf3y_template_styles` DISABLE KEYS */;
INSERT INTO `lsf3y_template_styles` VALUES (2,'bluestork',1,'0','Bluestork - Default','{\"useRoundedCorners\":\"1\",\"showSiteName\":\"0\"}');
INSERT INTO `lsf3y_template_styles` VALUES (3,'atomic',0,'0','Atomic - Default','{}');
INSERT INTO `lsf3y_template_styles` VALUES (4,'beez_20',0,'0','Beez2 - Default','{\"wrapperSmall\":\"53\",\"wrapperLarge\":\"72\",\"logo\":\"images\\/joomla_black.gif\",\"sitetitle\":\"Joomla!\",\"sitedescription\":\"Open Source Content Management\",\"navposition\":\"left\",\"templatecolor\":\"personal\",\"html5\":\"0\"}');
INSERT INTO `lsf3y_template_styles` VALUES (5,'hathor',1,'0','Hathor - Default','{\"showSiteName\":\"0\",\"colourChoice\":\"\",\"boldText\":\"0\"}');
INSERT INTO `lsf3y_template_styles` VALUES (6,'beez5',0,'0','Beez5 - Default','{\"wrapperSmall\":\"53\",\"wrapperLarge\":\"72\",\"logo\":\"images\\/sampledata\\/fruitshop\\/fruits.gif\",\"sitetitle\":\"Joomla!\",\"sitedescription\":\"Open Source Content Management\",\"navposition\":\"left\",\"html5\":\"0\"}');
INSERT INTO `lsf3y_template_styles` VALUES (7,'kiosk',0,'1','Kiosk - Default','{\"wrapperSmall\":\"53\",\"wrapperLarge\":\"72\",\"sitetitle\":\"\",\"sitedescription\":\"\",\"navposition\":\"center\",\"html5\":\"0\"}');
INSERT INTO `lsf3y_template_styles` VALUES (8,'rt_missioncontrol',1,'1','rt_missioncontrol - Default','{\"adminTitle\":\"CrossCliq Ad Manager\",\"templateWidth\":\"variable\",\"dashboard\":\"Managing Advertisements  in Station\",\"menuwidth\":\"small\",\"extendmenu\":\"off\",\"enableGravatar\":\"1\",\"enableSessionBar\":\"1\",\"enableTransitions\":\"enabled\",\"enableQuickEditor\":\"1\",\"enableViewSite\":\"1\",\"enableQuickCheckin\":\"0\",\"enableQuickCacheClean\":\"1\",\"enableFancyHeaders\":\"fancy\",\"showhelp\":\"1\",\"showhelpbutton\":\"1\",\"showlangmenu\":\"1\",\"body_text_color\":\"#000\",\"body_link_color\":\"#b3035c\",\"header_bg_color\":\"#000\",\"header_text_color\":\"#CCCCCC\",\"header_link_color\":\"#FFFFFF\",\"header_shadow_color\":\"#000000\",\"tab_bg_color\":\"#4D4D4D\",\"tab_text_color\":\"#FFFFFF\",\"special_bg_color\":\"#C62D2D\",\"special_text_color\":\"#FFFFFF\",\"active_bg_color\":\"#b3035c\",\"active_text_color\":\"#FFFFFF\",\"hover_bg_color\":\"#b3035c\",\"hover_text_color\":\"#FFFFFF\",\"blackliststyle\":\"2\"}');
/*!40000 ALTER TABLE `lsf3y_template_styles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_update_categories`
--

DROP TABLE IF EXISTS `lsf3y_update_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_update_categories` (
  `categoryid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT '',
  `description` text NOT NULL,
  `parent` int(11) DEFAULT '0',
  `updatesite` int(11) DEFAULT '0',
  PRIMARY KEY (`categoryid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Update Categories';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_update_categories`
--

LOCK TABLES `lsf3y_update_categories` WRITE;
/*!40000 ALTER TABLE `lsf3y_update_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `lsf3y_update_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_update_sites`
--

DROP TABLE IF EXISTS `lsf3y_update_sites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_update_sites` (
  `update_site_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT '',
  `type` varchar(20) DEFAULT '',
  `location` text NOT NULL,
  `enabled` int(11) DEFAULT '0',
  `last_check_timestamp` bigint(20) DEFAULT '0',
  PRIMARY KEY (`update_site_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='Update Sites';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_update_sites`
--

LOCK TABLES `lsf3y_update_sites` WRITE;
/*!40000 ALTER TABLE `lsf3y_update_sites` DISABLE KEYS */;
INSERT INTO `lsf3y_update_sites` VALUES (1,'Joomla Core','collection','http://update.joomla.org/core/list.xml',1,1368721247);
INSERT INTO `lsf3y_update_sites` VALUES (2,'Joomla Extension Directory','collection','http://update.joomla.org/jed/list.xml',1,1368721247);
INSERT INTO `lsf3y_update_sites` VALUES (3,'Accredited Joomla! Translations','collection','http://update.joomla.org/language/translationlist.xml',1,1368721247);
INSERT INTO `lsf3y_update_sites` VALUES (4,'Dioscouri Library Updates','extension','http://updates.dioscouri.com/library/updates.xml',1,1368721247);
INSERT INTO `lsf3y_update_sites` VALUES (5,'Dioscouri System Plugin Updates','extension','http://updates.dioscouri.com/plg_system_dioscouri/updates.xml',1,1368721247);
INSERT INTO `lsf3y_update_sites` VALUES (6,'Extension Update Site','collection','http://updates.rockettheme.com/joomla16/updates.xml',1,1368721247);
/*!40000 ALTER TABLE `lsf3y_update_sites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_update_sites_extensions`
--

DROP TABLE IF EXISTS `lsf3y_update_sites_extensions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_update_sites_extensions` (
  `update_site_id` int(11) NOT NULL DEFAULT '0',
  `extension_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`update_site_id`,`extension_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Links extensions to update sites';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_update_sites_extensions`
--

LOCK TABLES `lsf3y_update_sites_extensions` WRITE;
/*!40000 ALTER TABLE `lsf3y_update_sites_extensions` DISABLE KEYS */;
INSERT INTO `lsf3y_update_sites_extensions` VALUES (1,700);
INSERT INTO `lsf3y_update_sites_extensions` VALUES (2,700);
INSERT INTO `lsf3y_update_sites_extensions` VALUES (3,600);
INSERT INTO `lsf3y_update_sites_extensions` VALUES (4,10000);
INSERT INTO `lsf3y_update_sites_extensions` VALUES (5,10001);
INSERT INTO `lsf3y_update_sites_extensions` VALUES (6,10017);
/*!40000 ALTER TABLE `lsf3y_update_sites_extensions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_updates`
--

DROP TABLE IF EXISTS `lsf3y_updates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_updates` (
  `update_id` int(11) NOT NULL AUTO_INCREMENT,
  `update_site_id` int(11) DEFAULT '0',
  `extension_id` int(11) DEFAULT '0',
  `categoryid` int(11) DEFAULT '0',
  `name` varchar(100) DEFAULT '',
  `description` text NOT NULL,
  `element` varchar(100) DEFAULT '',
  `type` varchar(20) DEFAULT '',
  `folder` varchar(20) DEFAULT '',
  `client_id` tinyint(3) DEFAULT '0',
  `version` varchar(10) DEFAULT '',
  `data` text NOT NULL,
  `detailsurl` text NOT NULL,
  `infourl` text NOT NULL,
  PRIMARY KEY (`update_id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8 COMMENT='Available Updates';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_updates`
--

LOCK TABLES `lsf3y_updates` WRITE;
/*!40000 ALTER TABLE `lsf3y_updates` DISABLE KEYS */;
INSERT INTO `lsf3y_updates` VALUES (1,3,0,0,'Armenian','','pkg_hy-AM','package','',0,'2.5.8.1','','http://update.joomla.org/language/details/hy-AM_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (2,3,0,0,'Bahasa Indonesia','','pkg_id-ID','package','',0,'2.5.10.1','','http://update.joomla.org/language/details/id-ID_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (3,3,0,0,'Danish','','pkg_da-DK','package','',0,'2.5.11.1','','http://update.joomla.org/language/details/da-DK_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (4,3,0,0,'Khmer','','pkg_km-KH','package','',0,'2.5.7.1','','http://update.joomla.org/language/details/km-KH_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (5,3,0,0,'Swedish','','pkg_sv-SE','package','',0,'2.5.10.1','','http://update.joomla.org/language/details/sv-SE_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (6,3,0,0,'Hungarian','','pkg_hu-HU','package','',0,'2.5.8.1','','http://update.joomla.org/language/details/hu-HU_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (7,3,0,0,'Bulgarian','','pkg_bg-BG','package','',0,'2.5.7.1','','http://update.joomla.org/language/details/bg-BG_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (8,3,0,0,'French','','pkg_fr-FR','package','',0,'2.5.11.1','','http://update.joomla.org/language/details/fr-FR_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (9,3,0,0,'Italian','','pkg_it-IT','package','',0,'2.5.11.1','','http://update.joomla.org/language/details/it-IT_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (10,3,0,0,'Spanish','','pkg_es-ES','package','',0,'2.5.10.1','','http://update.joomla.org/language/details/es-ES_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (11,3,0,0,'Dutch','','pkg_nl-NL','package','',0,'2.5.11.1','','http://update.joomla.org/language/details/nl-NL_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (12,3,0,0,'Turkish','','pkg_tr-TR','package','',0,'2.5.10.1','','http://update.joomla.org/language/details/tr-TR_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (13,3,0,0,'Ukrainian','','pkg_uk-UA','package','',0,'2.5.7.2','','http://update.joomla.org/language/details/uk-UA_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (14,3,0,0,'Slovak','','pkg_sk-SK','package','',0,'2.5.10.1','','http://update.joomla.org/language/details/sk-SK_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (15,3,0,0,'Belarusian','','pkg_be-BY','package','',0,'2.5.8.1','','http://update.joomla.org/language/details/be-BY_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (16,3,0,0,'Latvian','','pkg_lv-LV','package','',0,'2.5.10.1','','http://update.joomla.org/language/details/lv-LV_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (17,3,0,0,'Estonian','','pkg_et-EE','package','',0,'2.5.7.1','','http://update.joomla.org/language/details/et-EE_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (18,3,0,0,'Romanian','','pkg_ro-RO','package','',0,'2.5.11.1','','http://update.joomla.org/language/details/ro-RO_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (19,3,0,0,'Flemish','','pkg_nl-BE','package','',0,'2.5.11.1','','http://update.joomla.org/language/details/nl-BE_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (20,3,0,0,'Macedonian','','pkg_mk-MK','package','',0,'2.5.10.1','','http://update.joomla.org/language/details/mk-MK_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (21,3,0,0,'Japanese','','pkg_ja-JP','package','',0,'2.5.11.1','','http://update.joomla.org/language/details/ja-JP_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (22,3,0,0,'Serbian Latin','','pkg_sr-YU','package','',0,'2.5.10.1','','http://update.joomla.org/language/details/sr-YU_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (23,3,0,0,'Arabic Unitag','','pkg_ar-AA','package','',0,'2.5.11.1','','http://update.joomla.org/language/details/ar-AA_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (24,3,0,0,'German','','pkg_de-DE','package','',0,'2.5.11.1','','http://update.joomla.org/language/details/de-DE_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (25,3,0,0,'Norwegian Bokmal','','pkg_nb-NO','package','',0,'2.5.9.2','','http://update.joomla.org/language/details/nb-NO_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (26,3,0,0,'English AU','','pkg_en-AU','package','',0,'2.5.10.1','','http://update.joomla.org/language/details/en-AU_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (27,3,0,0,'English US','','pkg_en-US','package','',0,'2.5.10.1','','http://update.joomla.org/language/details/en-US_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (28,3,0,0,'Serbian Cyrillic','','pkg_sr-RS','package','',0,'2.5.10.1','','http://update.joomla.org/language/details/sr-RS_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (29,3,0,0,'Lithuanian','','pkg_lt-LT','package','',0,'2.5.7.1','','http://update.joomla.org/language/details/lt-LT_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (30,3,0,0,'Albanian','','pkg_sq-AL','package','',0,'2.5.1.5','','http://update.joomla.org/language/details/sq-AL_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (31,3,0,0,'Persian','','pkg_fa-IR','package','',0,'2.5.11.1','','http://update.joomla.org/language/details/fa-IR_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (32,3,0,0,'Galician','','pkg_gl-ES','package','',0,'2.5.7.4','','http://update.joomla.org/language/details/gl-ES_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (33,3,0,0,'Polish','','pkg_pl-PL','package','',0,'2.5.10.1','','http://update.joomla.org/language/details/pl-PL_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (34,3,0,0,'Syriac','','pkg_sy-IQ','package','',0,'2.5.10.1','','http://update.joomla.org/language/details/sy-IQ_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (35,3,0,0,'Portuguese','','pkg_pt-PT','package','',0,'2.5.8.1','','http://update.joomla.org/language/details/pt-PT_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (36,3,0,0,'Russian','','pkg_ru-RU','package','',0,'2.5.11.1','','http://update.joomla.org/language/details/ru-RU_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (37,3,0,0,'Hebrew','','pkg_he-IL','package','',0,'2.5.7.1','','http://update.joomla.org/language/details/he-IL_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (38,3,0,0,'Catalan','','pkg_ca-ES','package','',0,'2.5.10.1','','http://update.joomla.org/language/details/ca-ES_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (39,3,0,0,'Laotian','','pkg_lo-LA','package','',0,'2.5.6.1','','http://update.joomla.org/language/details/lo-LA_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (40,3,0,0,'Afrikaans','','pkg_af-ZA','package','',0,'2.5.11.1','','http://update.joomla.org/language/details/af-ZA_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (41,3,0,0,'Chinese Simplified','','pkg_zh-CN','package','',0,'2.5.11.1','','http://update.joomla.org/language/details/zh-CN_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (42,3,0,0,'Greek','','pkg_el-GR','package','',0,'2.5.6.1','','http://update.joomla.org/language/details/el-GR_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (43,3,0,0,'Esperanto','','pkg_eo-XX','package','',0,'2.5.6.1','','http://update.joomla.org/language/details/eo-XX_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (44,3,0,0,'Finnish','','pkg_fi-FI','package','',0,'2.5.10.1','','http://update.joomla.org/language/details/fi-FI_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (45,3,0,0,'Portuguese Brazil','','pkg_pt-BR','package','',0,'2.5.9.1','','http://update.joomla.org/language/details/pt-BR_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (46,3,0,0,'Chinese Traditional','','pkg_zh-TW','package','',0,'2.5.10.1','','http://update.joomla.org/language/details/zh-TW_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (47,3,0,0,'Vietnamese','','pkg_vi-VN','package','',0,'2.5.8.1','','http://update.joomla.org/language/details/vi-VN_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (48,3,0,0,'Kurdish Sorani','','pkg_ckb-IQ','package','',0,'2.5.9.1','','http://update.joomla.org/language/details/ckb-IQ_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (49,3,0,0,'Bosnian','','pkg_bs-BA','package','',0,'2.5.10.1','','http://update.joomla.org/language/details/bs-BA_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (50,3,0,0,'Croatian','','pkg_hr-HR','package','',0,'2.5.9.1','','http://update.joomla.org/language/details/hr-HR_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (51,3,0,0,'Azeri','','pkg_az-AZ','package','',0,'2.5.7.1','','http://update.joomla.org/language/details/az-AZ_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (52,3,0,0,'Norwegian Nynorsk','','pkg_nn-NO','package','',0,'2.5.8.1','','http://update.joomla.org/language/details/nn-NO_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (53,3,0,0,'Tamil India','','pkg_ta-IN','package','',0,'2.5.11.1','','http://update.joomla.org/language/details/ta-IN_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (54,3,0,0,'Scottish Gaelic','','pkg_gd-GB','package','',0,'2.5.7.1','','http://update.joomla.org/language/details/gd-GB_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (55,3,0,0,'Thai','','pkg_th-TH','package','',0,'2.5.8.1','','http://update.joomla.org/language/details/th-TH_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (56,3,0,0,'Basque','','pkg_eu-ES','package','',0,'1.7.0.1','','http://update.joomla.org/language/details/eu-ES_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (57,3,0,0,'Uyghur','','pkg_ug-CN','package','',0,'2.5.7.2','','http://update.joomla.org/language/details/ug-CN_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (58,3,0,0,'Korean','','pkg_ko-KR','package','',0,'2.5.10.1','','http://update.joomla.org/language/details/ko-KR_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (59,3,0,0,'Hindi','','pkg_hi-IN','package','',0,'2.5.6.1','','http://update.joomla.org/language/details/hi-IN_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (60,3,0,0,'Welsh','','pkg_cy-GB','package','',0,'2.5.6.1','','http://update.joomla.org/language/details/cy-GB_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (61,3,0,0,'Swahili','','pkg_sw-KE','package','',0,'2.5.10.1','','http://update.joomla.org/language/details/sw-KE_details.xml','');
INSERT INTO `lsf3y_updates` VALUES (62,6,0,0,'MissionControl','','rt_missioncontrol_j16','template','',1,'2.6','','http://updates.rockettheme.com/joomla16/templates/missioncontrol_j16.xml','');
/*!40000 ALTER TABLE `lsf3y_updates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_user_notes`
--

DROP TABLE IF EXISTS `lsf3y_user_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_user_notes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `subject` varchar(100) NOT NULL DEFAULT '',
  `body` text NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_user_id` int(10) unsigned NOT NULL,
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `review_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_category_id` (`catid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_user_notes`
--

LOCK TABLES `lsf3y_user_notes` WRITE;
/*!40000 ALTER TABLE `lsf3y_user_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `lsf3y_user_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_user_profiles`
--

DROP TABLE IF EXISTS `lsf3y_user_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_user_profiles` (
  `user_id` int(11) NOT NULL,
  `profile_key` varchar(100) NOT NULL,
  `profile_value` varchar(255) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `idx_user_id_profile_key` (`user_id`,`profile_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Simple user profile storage table';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_user_profiles`
--

LOCK TABLES `lsf3y_user_profiles` WRITE;
/*!40000 ALTER TABLE `lsf3y_user_profiles` DISABLE KEYS */;
/*!40000 ALTER TABLE `lsf3y_user_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_user_usergroup_map`
--

DROP TABLE IF EXISTS `lsf3y_user_usergroup_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_user_usergroup_map` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Foreign Key to #__users.id',
  `group_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Foreign Key to #__usergroups.id',
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_user_usergroup_map`
--

LOCK TABLES `lsf3y_user_usergroup_map` WRITE;
/*!40000 ALTER TABLE `lsf3y_user_usergroup_map` DISABLE KEYS */;
INSERT INTO `lsf3y_user_usergroup_map` VALUES (84,8);
INSERT INTO `lsf3y_user_usergroup_map` VALUES (85,7);
/*!40000 ALTER TABLE `lsf3y_user_usergroup_map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_usergroups`
--

DROP TABLE IF EXISTS `lsf3y_usergroups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_usergroups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Adjacency List Reference Id',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set lft.',
  `rgt` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set rgt.',
  `title` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_usergroup_parent_title_lookup` (`parent_id`,`title`),
  KEY `idx_usergroup_title_lookup` (`title`),
  KEY `idx_usergroup_adjacency_lookup` (`parent_id`),
  KEY `idx_usergroup_nested_set_lookup` (`lft`,`rgt`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_usergroups`
--

LOCK TABLES `lsf3y_usergroups` WRITE;
/*!40000 ALTER TABLE `lsf3y_usergroups` DISABLE KEYS */;
INSERT INTO `lsf3y_usergroups` VALUES (1,0,1,20,'Public');
INSERT INTO `lsf3y_usergroups` VALUES (2,1,6,17,'Registered');
INSERT INTO `lsf3y_usergroups` VALUES (3,2,7,14,'Author');
INSERT INTO `lsf3y_usergroups` VALUES (4,3,8,11,'Editor');
INSERT INTO `lsf3y_usergroups` VALUES (5,4,9,10,'Publisher');
INSERT INTO `lsf3y_usergroups` VALUES (6,1,2,5,'Manager');
INSERT INTO `lsf3y_usergroups` VALUES (7,6,3,4,'Administrator');
INSERT INTO `lsf3y_usergroups` VALUES (8,1,18,19,'Super Users');
/*!40000 ALTER TABLE `lsf3y_usergroups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_users`
--

DROP TABLE IF EXISTS `lsf3y_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(150) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `usertype` varchar(25) NOT NULL DEFAULT '',
  `block` tinyint(4) NOT NULL DEFAULT '0',
  `sendEmail` tinyint(4) DEFAULT '0',
  `registerDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastvisitDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `activation` varchar(100) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  `lastResetTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Date of last password reset',
  `resetCount` int(11) NOT NULL DEFAULT '0' COMMENT 'Count of password resets since lastResetTime',
  PRIMARY KEY (`id`),
  KEY `usertype` (`usertype`),
  KEY `idx_name` (`name`),
  KEY `idx_block` (`block`),
  KEY `username` (`username`),
  KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_users`
--

LOCK TABLES `lsf3y_users` WRITE;
/*!40000 ALTER TABLE `lsf3y_users` DISABLE KEYS */;
INSERT INTO `lsf3y_users` VALUES (84,'Super User','chris','chris@ammonitenetworks.com','7b440c11c07cee81dacc8bfcf88e6918:8znPOh41BaDayowRZ46vwabgdW8leSZ5','deprecated',0,1,'2013-05-14 16:06:38','2013-05-29 19:15:01','0','','0000-00-00 00:00:00',0);
INSERT INTO `lsf3y_users` VALUES (85,'Advertising Manager','ads','chris@crosscliq.com','bee2ad4a291b5db1d128c04e454a5ea9:CJHXPftP8RfU8LWTUuUfITXNT0xUhf2Z','',0,0,'2013-05-16 16:39:55','2013-06-17 15:09:59','','{\"admin_style\":\"\",\"admin_language\":\"\",\"language\":\"\",\"editor\":\"\",\"helpsite\":\"\",\"timezone\":\"\"}','0000-00-00 00:00:00',0);
/*!40000 ALTER TABLE `lsf3y_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsf3y_viewlevels`
--

DROP TABLE IF EXISTS `lsf3y_viewlevels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lsf3y_viewlevels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `title` varchar(100) NOT NULL DEFAULT '',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `rules` varchar(5120) NOT NULL COMMENT 'JSON encoded access control.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_assetgroup_title_lookup` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsf3y_viewlevels`
--

LOCK TABLES `lsf3y_viewlevels` WRITE;
/*!40000 ALTER TABLE `lsf3y_viewlevels` DISABLE KEYS */;
INSERT INTO `lsf3y_viewlevels` VALUES (1,'Public',0,'[1]');
INSERT INTO `lsf3y_viewlevels` VALUES (2,'Registered',1,'[6,2,8]');
INSERT INTO `lsf3y_viewlevels` VALUES (3,'Special',2,'[6,3,8]');
/*!40000 ALTER TABLE `lsf3y_viewlevels` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-06-24 20:50:30
