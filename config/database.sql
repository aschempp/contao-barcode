-- **********************************************************
-- *                                                        *
-- * IMPORTANT NOTE                                         *
-- *                                                        *
-- * Do not import this file manually but use the TYPOlight *
-- * install tool to create and maintain database tables!   *
-- *                                                        *
-- **********************************************************

-- 
-- Table `tl_barcode`
-- 

CREATE TABLE `tl_barcode` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `tstamp` int(10) unsigned NOT NULL default '0',
  `type` varchar(32) NOT NULL default '',
  `name` varchar(255) NOT NULL default '',
  `qr_data` varchar(255) NOT NULL default '',
  `qr_level` char(1) NOT NULL default '',
  `qr_version` int(2) NOT NULL default '0',
  `ms_token` varchar(36) NOT NULL default '',
  `ms_category` varchar(255) NOT NULL default '',
  `ms_title` varchar(255) NOT NULL default '',
  `ms_note` text NULL,
  `ms_company` varchar(255) NOT NULL default '',
  `ms_firstname` varchar(255) NOT NULL default '',
  `ms_lastname` varchar(255) NOT NULL default '',
  `ms_street` varchar(255) NOT NULL default '',
  `ms_zip` varchar(255) NOT NULL default '',
  `ms_city` varchar(255) NOT NULL default '',
  `ms_country` varchar(255) NOT NULL default '',
  `ms_phone` varchar(255) NOT NULL default '',
  `ms_mobile` varchar(255) NOT NULL default '',
  `ms_email` varchar(255) NOT NULL default '',
  `ms_uri` varchar(255) NOT NULL default '',
  `ms_text` text NULL,
  `ms_password` varchar(255) NOT NULL default '',
  `ms_image` varchar(5) NOT NULL default '',
  `ms_decoration` varchar(32) NOT NULL default '',
  `ms_size` decimal(3,2) NOT NULL default '0.00',
  `ms_blackAndWhite` char(1) NOT NULL default '',
  PRIMARY KEY  (`id`),
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- 
-- Table `tl_module`
-- 

CREATE TABLE `tl_module` (
  `barcode` int(10) unsigned NOT NULL default '0',
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- 
-- Table `tl_content`
-- 

CREATE TABLE `tl_content` (
  `barcode` int(10) unsigned NOT NULL default '0',
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

