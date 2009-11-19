-- phpMyAdmin SQL Dump
-- version 3.2.2.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 15, 2009 at 04:59 PM
-- Server version: 5.1.37
-- PHP Version: 5.2.10-2ubuntu6.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: 'xs-file-distro'
--

-- --------------------------------------------------------

--
-- Table structure for table 'admins'
--

CREATE TABLE admins (
      id int(11) NOT NULL AUTO_INCREMENT,
      username varchar(40) NOT NULL,
      `password` char(32) NOT NULL,
      PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table 'file'
--

CREATE TABLE `file` (
      id int(11) NOT NULL AUTO_INCREMENT,
      `name` varchar(128) NOT NULL,
      filename varchar(128) NOT NULL,
      `type` varchar(40) NOT NULL,
      `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
      description text NOT NULL,
      size float NOT NULL,
      PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table 'tagmap'
--

CREATE TABLE tagmap (
      id int(11) NOT NULL AUTO_INCREMENT,
      file_id int(11) NOT NULL,
      tag_id int(11) NOT NULL,
      PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table 'tags'
--

CREATE TABLE tags (
      tag_id int(11) NOT NULL AUTO_INCREMENT,
      `name` varchar(40) NOT NULL,
      PRIMARY KEY (tag_id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

