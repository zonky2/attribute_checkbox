-- **********************************************************
-- *                                                        *
-- * IMPORTANT NOTE                                         *
-- *                                                        *
-- * Do not import this file manually but use the Contao    *
-- * install tool to create and maintain database tables!   *
-- *                                                        *
-- **********************************************************

--
-- Table `tl_metamodel_attribute`
--

CREATE TABLE `tl_metamodel_attribute` (
  `check_publish` char(1) NOT NULL default '',
  `check_listview` char(1) NOT NULL default '',
  `check_inverse` char(1) NOT NULL default '',
  `check_listviewicon` blob NULL,
  `check_listviewicondisabled` blob NULL,
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Table `tl_metamodel_filtersetting`
--

CREATE TABLE `tl_metamodel_filtersetting` (
  `check_ignorepublished` char(1) NOT NULL default '',
  `check_allowpreview` char(1) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
