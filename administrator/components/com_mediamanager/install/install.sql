-- --------------------------------------------------------

--
-- Table structure for table `#__mediamanager_config`
--

CREATE TABLE IF NOT EXISTS `#__mediamanager_config` (
  `config_id` int(11) NOT NULL AUTO_INCREMENT,
  `config_name` varchar(255) DEFAULT NULL,
  `value` text,
  PRIMARY KEY (`config_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__mediamanager_categories`
--

CREATE TABLE IF NOT EXISTS `#__mediamanager_categories` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__mediamanager_categorytypes`
--

CREATE TABLE IF NOT EXISTS `#__mediamanager_categorytypes` (
  `categorytype_id` int(11) NOT NULL AUTO_INCREMENT,
  `categorytype_title` varchar(255) DEFAULT NULL,
  `categorytype_display_admin` tinyint(1) NOT NULL DEFAULT '0',
  `categorytype_display_site` tinyint(1) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL,
  PRIMARY KEY (`categorytype_id`),
  KEY `category_title` (`categorytype_title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__mediamanager_files`
--

CREATE TABLE IF NOT EXISTS `#__mediamanager_files` (
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
  PRIMARY KEY (`file_id`),
  KEY `file_title` (`file_title`),
  KEY `file_name` (`file_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__mediamanager_libraries`
--

CREATE TABLE IF NOT EXISTS `#__mediamanager_libraries` (
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
  PRIMARY KEY (`library_id`),
  KEY `library_title` (`library_title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__mediamanager_librarycategories`
--

CREATE TABLE IF NOT EXISTS `#__mediamanager_librarycategories` (
  `librarycategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `library_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`librarycategory_id`),
  KEY `media_id` (`library_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__mediamanager_librarycategorytypes`
--

CREATE TABLE IF NOT EXISTS `#__mediamanager_librarycategorytypes` (
  `librarycategorytype_id` int(11) NOT NULL AUTO_INCREMENT,
  `library_id` int(11) NOT NULL,
  `categorytype_id` int(11) NOT NULL,
  PRIMARY KEY (`librarycategorytype_id`),
  KEY `media_id` (`library_id`),
  KEY `category_id` (`categorytype_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__mediamanager_librarytags`
--

CREATE TABLE IF NOT EXISTS `#__mediamanager_librarytags` (
  `librarytag_id` int(11) NOT NULL AUTO_INCREMENT,
  `library_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`librarytag_id`),
  KEY `category_id` (`tag_id`),
  KEY `library_id` (`library_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__mediamanager_media`
--

CREATE TABLE IF NOT EXISTS `#__mediamanager_media` (
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
  PRIMARY KEY (`media_id`),
  KEY `media_title` (`media_title`),
  KEY `media_type` (`media_type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__mediamanager_mediacategories`
--

CREATE TABLE IF NOT EXISTS `#__mediamanager_mediacategories` (
  `mediacategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `media_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`mediacategory_id`),
  KEY `media_id` (`media_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__mediamanager_mediafiles`
--

CREATE TABLE IF NOT EXISTS `#__mediamanager_mediafiles` (
  `mediafile_id` int(11) NOT NULL AUTO_INCREMENT,
  `media_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `value` text,
  PRIMARY KEY (`mediafile_id`),
  KEY `media_id` (`media_id`),
  KEY `file_id` (`file_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__mediamanager_mediatags`
--

CREATE TABLE IF NOT EXISTS `#__mediamanager_mediatags` (
  `mediatag_id` int(11) NOT NULL AUTO_INCREMENT,
  `media_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`mediatag_id`),
  KEY `media_id` (`media_id`),
  KEY `category_id` (`tag_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__mediamanager_tags`
--

CREATE TABLE IF NOT EXISTS `#__mediamanager_tags` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_title` varchar(255) DEFAULT NULL,
  `admin_only` tinyint(1) NOT NULL,
  PRIMARY KEY (`tag_id`),
  KEY `category_title` (`tag_title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


--
-- Table structure for table `#__mediamanager_station`
--

CREATE TABLE IF NOT EXISTS `#__mediamanager_station` (
  `station_id` int(11) NOT NULL AUTO_INCREMENT,
  `station_title` varchar(255) DEFAULT NULL,
  `station_title_long` varchar(255) NOT NULL,
  `station_description` text,
  `station_description_full` text,
  `station_image` varchar(255) DEFAULT NULL,
  `station_image_remote` mediumtext NOT NULL,
  `station_meta` text,
  `station_categories` text,
  `latitude` float(10,6) NOT NULL,
  `longitude` float(10,6) NOT NULL,
  `access` int(11) DEFAULT NULL,
  `station_params` text,
  `hits` int(11) NOT NULL,
  `station_group` varchar(255) NOT NULL,
  PRIMARY KEY (`station_id`),
  KEY `station_title` (`station_title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
