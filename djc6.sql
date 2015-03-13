-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2015 at 11:19 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `djc6`
--
CREATE DATABASE IF NOT EXISTS `djc6` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `djc6`;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `msgid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `message` varchar(500) NOT NULL,
  `created` date NOT NULL,
  PRIMARY KEY (`msgid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msgid`, `uid`, `title`, `message`, `created`) VALUES
(1, 1, 'Hello World!', 'This is a test entry to see if my system works.', '2015-02-22'),
(2, 1, 'Hello World 2, Electric Boogaloo', 'Here''s another test message!', '2015-02-22'),
(3, 2, 'Another Test Entry', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut nisl nec lectus tempus rhoncus. Integer vel metus placerat, pellentesque dolor in, finibus tortor. Praesent vel risus elit. Ut malesuada, erat non egestas pulvinar, augue lorem maximus nulla, non vehicula dui ligula sit amet erat. Praesent quis accumsan magna. Nullam posuere eu quam ultrices efficitur. Nam et turpis felis. Etiam egestas mi erat, at vestibulum dui molestie vitae.', '2015-02-23'),
(4, 2, 'Test Post', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut nisl nec lectus tempus rhoncus. Integer vel metus placerat, pellentesque dolor in, finibus tortor. \n\nPraesent vel risus elit. Ut malesuada, erat non egestas pulvinar, augue lorem maximus nulla, non vehicula dui ligula sit amet erat. Praesent quis accumsan magna. Nullam posuere eu quam ultrices efficitur. \n\nNam et turpis felis. Etiam egestas mi erat, at vestibulum dui molestie vitae. Mauris ut ullamcorper lectus, nec rutrum nunc.', '2015-02-23'),
(5, 4, 'I am so glad this all works!', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec in placerat enim. Duis a blandit nisi, non sollicitudin nisl. Mauris sit amet fermentum neque. Sed ullamcorper tellus eget sapien dignissim finibus. \n\nEtiam mauris magna, suscipit ac est at, vestibulum volutpat erat. Curabitur et dictum ex. Vivamus id mauris sagittis libero convallis posuere eget a lorem. Ut eu neque iaculis, rutrum lectus quis, tempus dolor.', '2015-02-23'),
(6, 1, 'What a nice placeholder!', 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec ut erat id nibh molestie lacinia sit amet vitae libero. Pellentesque sem leo, consequat nec pellentesque et, mattis a erat. Pellentesque habitant.', '2015-02-23'),
(7, 1, 'The Aventure Continues!', 'Nam ac porta metus. Donec in dolor efficitur, malesuada mauris in, laoreet turpis. Integer consequat ultricies feugiat. Sed elementum porta pharetra. Nunc rutrum lorem vitae massa lacinia ullamcorper. Morbi porttitor leo vel nulla congue, eu efficitur tellus condimentum. Maecenas in quam non tortor placerat mollis quis nec odio.', '2015-02-23'),
(8, 1, 'Another New Entry', 'Sed molestie elit at tincidunt fringilla. Suspendisse ut sodales metus, eu fermentum risus. Phasellus at ipsum velit. Curabitur quis tincidunt felis. Phasellus a elit eu augue vulputate sodales sed vel est. Nulla hendrerit vel velit in feugiat.', '2015-02-23'),
(9, 1, 'Some more Lorem Ipsum', 'Proin eu dapibus urna. Fusce vulputate imperdiet vehicula. Ut vel egestas lectus. Cras elementum tristique risus in laoreet. Pellentesque ac risus vitae orci egestas sodales. Nam vehicula dignissim malesuada. Donec pretium condimentum mattis. Aenean id ex nibh.', '2015-02-23'),
(10, 1, 'A Song of Ice and Fire', 'Duis nec lectus quis sapien condimentum ultricies. Cras id faucibus nulla. Vivamus quis elementum eros. Fusce nisi elit, iaculis tincidunt fringilla egestas, luctus sed nisl. In at nisl quam. \n\nAenean velit mi, rutrum et sodales at, dignissim a nunc. Ut aliquet quis nisi ut aliquet. Duis bibendum ultrices dolor eu mattis.', '2015-02-23'),
(11, 1, 'A Storm of Swords', 'Donec eget urna dignissim arcu laoreet molestie at eu est. Maecenas vehicula lorem quis sapien sagittis faucibus. Vivamus ac laoreet felis. Duis malesuada ligula a aliquet scelerisque. Curabitur viverra quam ut interdum varius. Nunc id lorem mollis, tempor odio sed, lobortis mauris. Nunc iaculis odio vitae mi facilisis elementum.', '2015-02-23'),
(12, 2, 'So Many Test Posts!', 'Nulla tortor nisi, consectetur vitae mauris egestas, rhoncus finibus mauris. Curabitur in ex at massa pretium faucibus. Sed ut urna eget arcu molestie interdum. Sed eget orci facilisis, sodales enim eu, mattis lectus. Suspendisse aliquam diam eu ligula sagittis volutpat. Morbi nec dolor quis velit rutrum tincidunt viverra quis enim. Phasellus rutrum dolor vel ex tristique vulputate. Etiam lobortis sagittis massa non condimentum.', '2015-02-23'),
(13, 4, 'A Game of Thrones', 'Duis sagittis faucibus urna quis mattis. Integer pharetra, felis sit amet ullamcorper cursus, erat orci lobortis nibh, sed porttitor augue neque euismod arcu. Donec nisl magna, gravida ac lobortis a, egestas eget justo. Vestibulum id fringilla est. Phasellus pellentesque diam id est congue, sit amet laoreet mi interdum. Duis sit amet mattis lectus, et placerat urna. Vestibulum at nulla nisi. Cras quis egestas augue, venenatis convallis mauris.', '2015-02-23'),
(14, 4, 'A Storm of Swords', 'Nunc at ipsum sit amet tellus finibus feugiat a at sem. Fusce vel sagittis lorem. Vivamus quis sapien volutpat, congue massa eget, cursus ex. Nullam ut magna vel justo condimentum condimentum. Integer euismod pulvinar erat at faucibus. Aliquam finibus dignissim purus sit amet mattis. Quisque eget dapibus lacus, at fermentum orci.', '2015-02-23'),
(15, 4, 'A Clash of Kings', 'Fusce eget orci tristique, rutrum est eu, imperdiet purus. Morbi blandit imperdiet lectus non pellentesque. Donec volutpat nunc quis enim euismod, id egestas tortor gravida. Aliquam bibendum pharetra lacus vel malesuada.\n\nInteger rutrum eros massa, sed malesuada enim mollis a. Sed id erat et risus feugiat varius vitae non diam. Nullam erat nunc, suscipit non ligula vel, dapibus volutpat nibh. Morbi lobortis urna a nulla mollis, ac sagittis justo suscipit.', '2015-02-23'),
(16, 4, 'A Feast for Crows', 'Sed viverra laoreet odio. Morbi in placerat ipsum, vel gravida dolor. Morbi euismod dui nec risus bibendum posuere. In lobortis lacinia tortor sed aliquet. Cras placerat nibh feugiat, consequat arcu ac, euismod neque. Suspendisse potenti. Donec cursus, sem et lobortis tincidunt, mi est semper nunc, non faucibus felis nisi nec velit. Etiam sagittis arcu ipsum, nec porta felis congue quis.', '2015-02-23'),
(17, 4, 'A Dance with Dragons', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ac vestibulum nisi. Pellentesque at orci non mi faucibus posuere sed id orci. Morbi sed imperdiet diam. Nullam vestibulum auctor est, varius finibus libero cursus et. In lorem nisi, vestibulum sed magna ac, dapibus elementum mauris. Sed luctus rutrum massa, vitae dignissim lorem iaculis at.', '2015-02-23'),
(18, 4, 'The Winds of Winter', 'Donec in ultricies ante. Donec lectus orci, volutpat ac ultricies eget, aliquet sed justo. Etiam elementum tellus eget arcu fermentum fermentum. Donec eu lacus viverra, tempor enim id, molestie ligula. Duis ligula odio, malesuada vitae molestie non, mollis dictum eros. Vivamus faucibus mattis nulla, fringilla feugiat nibh sagittis at. In hac habitasse platea dictumst. Sed placerat nulla id metus aliquam rhoncus.', '2015-02-23'),
(19, 4, 'A Dream of Spring', 'Sed at ex enim. Maecenas dignissim arcu ac eros mattis euismod. Proin non felis eu justo vestibulum fringilla. Vestibulum aliquam nisi eu laoreet vestibulum. Aenean ut efficitur tellus, ut elementum purus. Donec rhoncus hendrerit odio, et consequat lacus dapibus non. Quisque varius justo nec ornare malesuada.', '2015-02-23'),
(20, 3, 'I Love Doughnuts', 'Phasellus ac ipsum sed neque aliquet tristique. Etiam eu dui massa. Nulla volutpat sit amet sapien vitae sodales. Vivamus fermentum pharetra nulla quis elementum. Vestibulum nec tellus fermentum, fermentum purus quis, varius nunc. Maecenas fermentum dapibus elit et imperdiet. Maecenas nulla tellus, vestibulum nec lacinia ut, posuere ac ante. Nunc non justo a dolor vehicula dictum vel eget erat.', '2015-02-23'),
(21, 3, 'My Neighbour, Ned Flanders', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a purus pharetra, volutpat quam et, commodo quam. Donec quis mauris suscipit, facilisis justo sit amet, varius turpis. Aenean et lacus feugiat, posuere augue vel, blandit tortor. Etiam efficitur lobortis porttitor. Suspendisse molestie, nibh at ullamcorper tempus, est magna blandit orci.', '2015-02-23'),
(22, 3, 'Remembering Frank Grimes', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In gravida risus facilisis nibh eleifend ornare. Integer rhoncus viverra sem, sit amet convallis lacus. Sed tempus velit eu fringilla porttitor. Aenean pulvinar, magna eu fermentum ultricies, ex nibh egestas ipsum, eget auctor quam dolor sed lorem. Donec non risus quis arcu.', '2015-02-23'),
(23, 5, 'My Tinfoil Hat is Watching Me', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In gravida risus facilisis nibh eleifend ornare. Integer rhoncus viverra sem, sit amet convallis lacus. Sed tempus velit eu fringilla porttitor. Aenean pulvinar, magna eu fermentum ultricies, ex nibh egestas ipsum, eget auctor quam dolor sed lorem. Donec non risus quis arcu.', '2015-02-23'),
(24, 5, 'How to Choose the Best Pocket Sand', 'Aliquam a tincidunt magna, vitae aliquam velit. Etiam efficitur, odio sit amet volutpat egestas, dui lorem accumsan eros, vel laoreet neque dolor ac ex. Aliquam posuere facilisis odio, et eleifend ipsum fringilla et. Aliquam egestas arcu id massa dignissim dapibus. Praesent eu neque ac quam sodales efficitur eu vel nisl.', '2015-02-23'),
(25, 5, 'How to Stay Undercover', 'Vivamus id efficitur massa. Donec dui quam, pretium eget pellentesque non, pellentesque at nisl. Ut dignissim convallis rhoncus. Donec eget tincidunt nunc. Fusce porta ultrices eros, eget ullamcorper sapien sollicitudin sit amet. Suspendisse vel nulla justo. Ut blandit non diam eu consequat. Duis ornare tortor efficitur interdum rutrum. Donec ut.', '2015-02-23'),
(26, 6, 'I want to cast MAGIC MISSILE', 'Vivamus id efficitur massa. Donec dui quam, pretium eget pellentesque non, pellentesque at nisl. Ut dignissim convallis rhoncus. Donec eget tincidunt nunc. Fusce porta ultrices eros, eget ullamcorper sapien sollicitudin sit amet. Suspendisse vel nulla justo. Ut blandit non diam eu consequat. Duis ornare tortor efficitur interdum rutrum. Donec ut.', '2015-02-23'),
(27, 6, 'How to win as a Mech Mage', 'Ut non mi id felis elementum porta. Praesent ac magna ante. Vestibulum elementum mollis suscipit. Aliquam sed ligula ut elit pulvinar mollis at luctus purus. Mauris mollis tellus sit amet fringilla venenatis. Aliquam vitae condimentum neque. Sed facilisis, risus eget sodales porta, risus sapien finibus erat, et viverra lorem ante.', '2015-02-23'),
(28, 6, 'The time I took a pyroblast to the face', 'Sed scelerisque tortor non porttitor vulputate. Phasellus luctus euismod feugiat. Nulla facilisi. Phasellus pharetra, ligula eget efficitur sollicitudin, leo massa congue arcu, quis dignissim felis ipsum vitae lectus. Duis non viverra mauris, id rhoncus metus. Ut eu urna in nisl dictum dignissim. Duis egestas enim diam, sed hendrerit urna imperdiet.', '2015-02-23'),
(29, 7, 'How to own n00bs', 'Proin a urna sed ante mollis congue non quis mauris. Praesent sed justo id diam tristique vestibulum nec sed nibh. Suspendisse imperdiet tortor et sapien dapibus, eget euismod arcu efficitur. Vestibulum sagittis nisi at tincidunt vestibulum. Sed nec eros aliquam, feugiat leo et, tempus nibh. Vestibulum accumsan nunc hendrerit arcu.', '2015-02-23'),
(30, 7, 'Total Ownage', 'Fusce at cursus ligula. Integer id ullamcorper elit. In quam risus, fringilla eget scelerisque id, scelerisque vel justo. Quisque laoreet, sapien sit amet consequat gravida, ex libero vehicula turpis, a ultricies quam metus sit amet odio. Donec at ex a dui dapibus commodo. Etiam sollicitudin iaculis orci, eu facilisis mauris.', '2015-02-23'),
(31, 7, 'Sick Nar Brah', 'Fusce tincidunt arcu et ex egestas, a rutrum mauris sollicitudin. Aenean a tellus congue, tempor augue nec, facilisis magna. Cras id dolor bibendum, gravida augue ac, commodo risus. Aliquam turpis purus, porttitor a malesuada eu, dapibus a lorem. Curabitur efficitur nibh eget augue ultricies, quis fringilla lorem volutpat. Aenean tellus.', '2015-02-23'),
(32, 8, 'Why is Propane Superior?', 'Quisque vehicula mollis felis, non vestibulum eros sollicitudin id. Fusce et efficitur ex, a ultrices eros. Ut elementum ullamcorper justo, at tincidunt orci fringilla a. Quisque vitae metus eget tortor tincidunt eleifend lobortis ac nisl. In luctus, nisi vel malesuada viverra, lorem augue aliquam arcu, in mollis ex urna sit.', '2015-02-23'),
(33, 8, 'That boy aint right!', 'Morbi ut dignissim lacus. Curabitur porta tellus eu purus euismod, in consectetur felis hendrerit. Nam volutpat lorem non leo egestas, a vehicula nibh convallis. Sed turpis justo, aliquet eget convallis sed, accumsan ac lorem. Proin sit amet molestie erat, scelerisque tincidunt ex. Suspendisse magna risus, viverra fermentum maximus ac, mollis.', '2015-02-23'),
(34, 8, 'Where to buy propane and propane accessories', 'Mauris aliquet laoreet luctus. Quisque at ipsum dictum, sagittis mauris eu, blandit tortor. Etiam gravida dictum mollis. Fusce eu viverra elit. Praesent faucibus laoreet magna, in ultricies lectus rutrum nec. Praesent egestas augue nisl, ut aliquam tellus fermentum eu. Sed quis elit felis. Integer facilisis nisi aliquet dolor ultricies, et.', '2015-02-23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `experience` varchar(50) NOT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `email`, `password`, `experience`, `created`) VALUES
(1, 'djc6@sfu.ca', 'djc6@sfu.ca', '$2a$10$33d44059dbd9568d74fdauBaJY9Ula5Qh2BAenUVOoh42v.Ev47lq', 'Intermediate', '2015-02-23 07:47:01'),
(2, 'TestUser', '123@456.com', '$2a$10$4ca27e4214cbc0f1cdf63uPwc1ESJC5chxpWfTr7Zb5mvR/WZQ.bO', 'Beginnner', '2015-02-23 08:26:35'),
(3, 'HomerSimpson', 'chunky53@aol.com', '$2a$10$dac8bea77cb762ec763dbuEPliD/BnY7tTFi3v0mWrFhGMAo6RTRW', 'Expert', '2015-02-23 09:00:35'),
(4, 'Devin', 'thisis@test.com', '$2a$10$963ca63d0ec69bfb64b95uTsep.e5vvAJr6oneMp7L5LTuZBO1Vbm', 'Intermediate', '2015-02-23 09:09:47'),
(5, 'Rusty', 'shackleford@example.com', '$2a$10$d462c1c1b8f35af75f207uLKTsYbRNZ2a7FguBDIPx7RtLf6v7x4G', 'Beginnner', '2015-02-23 10:05:04'),
(6, 'Jaina', 'proudmoore@mail.com', '$2a$10$b8445c6fa9635a65a1220uhVoF/xfYlXjyIgXksUzvFX//MZLYsnO', 'Expert', '2015-02-23 10:09:03'),
(7, 'NoobieStomper', 'noobstomper@mail.com', '$2a$10$82a155ba23f00518e9026uB9c2TLKJm4i2dS58TIO.eUY/kNXCc0O', 'Expert', '2015-02-23 10:12:26'),
(8, 'HankHill', 'propane@email.com', '$2a$10$5f754644be7b5302a56c7OzcTPFBHT2GamXC.KpVWm6JBMeXGZP4C', 'Beginnner', '2015-02-23 10:14:19');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
