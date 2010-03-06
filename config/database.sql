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
  `type` varchar(10) NOT NULL default '',
  `name` varchar(255) NOT NULL default '',
  `qr_data` varchar(255) NOT NULL default '',
  `qr_level` char(1) NOT NULL default '',
  `qr_version` int(2) NOT NULL default '0',
  `ms_token` varchar(36) NOT NULL default '',
  `ms_category` varchar(255) NOT NULL default '',
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

