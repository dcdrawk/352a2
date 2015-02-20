-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2015 at 06:14 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `msgid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL,
  `message` varchar(200) NOT NULL,
  `created` date NOT NULL,
  PRIMARY KEY (`msgid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msgid`, `uid`, `message`, `created`) VALUES
(1, 2, '', '2015-02-19'),
(2, 2, '', '2015-02-19'),
(3, 2, 'test', '2015-02-19'),
(4, 2, 'test', '2015-02-19'),
(5, 2, 'testasdfdas', '2015-02-19'),
(6, 2, 'testing this out', '2015-02-19'),
(7, 1, 'testing for user test', '2015-02-19'),
(8, 1, 'this is a message', '2015-02-19'),
(9, 1, 'testetsts', '2015-02-19'),
(10, 1, 'this is s atest', '2015-02-19'),
(11, 1, 'asd', '2015-02-19'),
(12, 1, 'asd', '2015-02-19'),
(13, 1, 'asd', '2015-02-19'),
(14, 1, '123', '2015-02-19'),
(15, 1, '1231231312313', '2015-02-19'),
(16, 1, 'this is a test', '2015-02-19'),
(17, 1, '1231', '2015-02-19'),
(18, 2, 'dsadsada', '2015-02-19'),
(19, 2, 'dsadsadadsadada', '2015-02-19'),
(20, 1, 'testing', '2015-02-19'),
(21, 1, 'testing', '2015-02-19'),
(22, 1, 'testing', '2015-02-19'),
(23, 1, 'testingdwadwa', '2015-02-19'),
(24, 2, 'this a test now!', '2015-02-19'),
(25, 2, 'this a test now!', '2015-02-19'),
(26, 2, 'this a test now!s', '2015-02-19'),
(27, 2, 'this a test now!s', '2015-02-19'),
(28, 2, 'dwa', '2015-02-19'),
(29, 2, 'yes', '2015-02-19'),
(30, 2, 'this is a message', '2015-02-19'),
(31, 2, 'this is a message', '2015-02-19'),
(32, 2, 'this is a message', '2015-02-19'),
(33, 2, 'ww', '2015-02-19'),
(34, 2, 'wat', '2015-02-19'),
(35, 2, 'wattes', '2015-02-19'),
(36, 2, 'test', '2015-02-19'),
(37, 2, 'testing!', '2015-02-19'),
(38, 1, 'what is this?', '2015-02-19'),
(39, 1, 'a center for ants?', '2015-02-19'),
(40, 2, 'this is so cool', '2015-02-19'),
(41, 2, 'HOLY SHIT', '2015-02-19'),
(42, 2, 'test', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `experience` varchar(50) NOT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `email`, `password`, `experience`, `created`) VALUES
(1, 'test', 'test@test.ca', '$2a$10$112427703b4b96262b086umJ.U9Qxll0L0Iol1JvVpyy8zG9fCgIm', '', '2015-02-19 20:46:34'),
(2, 'Dev', 'Dev@dev', '$2a$10$4dc409e0f86ffbf9da0b4er7AHWtKQGf2DNs89kA8y13pvFGwCO66', '', '2015-02-19 22:11:28'),
(3, 'tester man', 'test2@test.ca', '$2a$10$b2e88ec045844bffbc857eWksN3X7s/mxnGvbC81xe4894Qddf./.', '', '2015-02-19 22:13:06');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
