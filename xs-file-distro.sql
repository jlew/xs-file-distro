-- phpMyAdmin SQL Dump
-- version 3.1.2deb1ubuntu0.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 02, 2009 at 05:36 PM
-- Server version: 5.0.75
-- PHP Version: 5.2.6-3ubuntu4.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: 'xs-file-distro'
--

-- --------------------------------------------------------

--
-- Table structure for table 'file'
--

CREATE TABLE IF NOT EXISTS `file` (
  ID int(11) NOT NULL auto_increment,
  `name` varchar(128) NOT NULL,
  filename varchar(128) NOT NULL,
  `type` varchar(40) NOT NULL,
  `date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  description text NOT NULL,
  size float NOT NULL,
  PRIMARY KEY  (ID)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table 'system'
--

CREATE TABLE IF NOT EXISTS system (
  `key` varchar(40) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY  (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table 'tagmap'
--

CREATE TABLE IF NOT EXISTS tagmap (
  id int(11) NOT NULL auto_increment,
  file_id int(11) NOT NULL,
  tag_id int(11) NOT NULL,
  PRIMARY KEY  (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table 'tags'
--

CREATE TABLE IF NOT EXISTS tags (
  tag_id int(11) NOT NULL auto_increment,
  `name` varchar(40) NOT NULL,
  PRIMARY KEY  (tag_id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;
