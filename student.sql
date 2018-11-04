-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2017 at 03:48 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `student`
--

-- --------------------------------------------------------

--
-- Table structure for table `assesment`
--

CREATE TABLE IF NOT EXISTS `assesment` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `ass_name` varchar(200) DEFAULT NULL,
  `facultyName` varchar(200) DEFAULT NULL,
  `batch_number` varchar(100) NOT NULL,
  `sessions` varchar(100) NOT NULL,
  `dates` date DEFAULT NULL,
  `duDate` date DEFAULT NULL,
  `lastSubDate` date DEFAULT NULL,
  `documents` text NOT NULL,
  `departmentName` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `assesment`
--

INSERT INTO `assesment` (`id`, `ass_name`, `facultyName`, `batch_number`, `sessions`, `dates`, `duDate`, `lastSubDate`, `documents`, `departmentName`) VALUES
(19, 'Wright paragraph23', '1', '35', '2017', '2017-03-26', '2017-02-23', '2017-05-19', 'claim_problem/balance.png', '1'),
(20, 'Gaming Football', '2', '35', '2017', '2017-03-14', '2017-04-26', '0000-00-00', 'claim_problem/1555543_569591643145569_4993561905081840144_n.jpg', '2'),
(21, 'Gaming Football', '1', '35', '2017', '2017-03-14', '2017-04-17', '0000-00-00', 'claim_problem/1460405302-porch0516.jpg', '2'),
(22, 'Gaming Football', '1', '35', '2017', '2017-03-14', '2017-04-04', '0000-00-00', 'claim_problem/84020749833147.58bfec86724fe.jpg', '1'),
(23, 'Wright Letter 2', '2', '35', '2017', '2017-03-14', '2017-04-24', '0000-00-00', 'claim_problem/ae009e49608233.58b9fe7153ba5.jpg', '5'),
(24, 'New Assessment', '1', '35', '2017', '2017-03-14', '2017-04-11', '0000-00-00', 'claim_problem/d.png', '1'),
(25, 'dg', '1', 'dg', 'dg', '2017-03-26', '2017-04-11', '0000-00-00', 'claim_problem/banana.png', '1'),
(26, 'Wright paragraph', '3', '35', '2017', '2017-03-26', '2017-04-21', '0000-00-00', 'claim_problem/bamboo.png', '2'),
(27, 'cgg', '2', '34', '4444', '2017-03-26', '2017-05-21', '0000-00-00', 'claim_problem/balance.png', '2');

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE IF NOT EXISTS `assignment` (
  `ass_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `upload_document` text NOT NULL,
  `upload_document2` text NOT NULL,
  `upload_date` varchar(100) NOT NULL,
  `assessment_Id` varchar(100) NOT NULL,
  `student_email` varchar(100) NOT NULL,
  PRIMARY KEY (`ass_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`ass_id`, `title`, `description`, `upload_document`, `upload_document2`, `upload_date`, `assessment_Id`, `student_email`) VALUES
(1, 'dcvdv', 'dvdv', 'submitted_ass_doc/1460405302-porch0516.jpg', '', '2017/03/15', '22', 'shiplu@gmail.com'),
(2, '26', '269', 'submitted_ass_doc/t.png', '', '2017/03/15', '19', 'shiplu@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(100) NOT NULL,
  `facultyID` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `department_name`, `facultyID`) VALUES
(1, 'BBA', 1),
(2, 'ETE', 4),
(3, 'IT', 4),
(4, 'English', 2),
(5, 'Law', 3),
(6, 'Political Science', 2),
(7, 'Match', 4),
(8, 'Accounting', 1),
(9, 'Management', 1),
(10, 'Marketing', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ecclaim`
--

CREATE TABLE IF NOT EXISTS `ecclaim` (
  `ec_id` int(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `upload_document` varchar(500) DEFAULT NULL,
  `upload_document2` varchar(500) DEFAULT NULL,
  `upload_document3` varchar(500) DEFAULT NULL,
  `upload_document4` varchar(500) DEFAULT NULL,
  `upload_date` date DEFAULT NULL,
  `assessment_Id` int(20) NOT NULL,
  `claimStatus` varchar(500) DEFAULT NULL,
  `processing_status` varchar(100) NOT NULL,
  `student_email` varchar(100) NOT NULL,
  PRIMARY KEY (`ec_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `ecclaim`
--

INSERT INTO `ecclaim` (`ec_id`, `title`, `description`, `upload_document`, `upload_document2`, `upload_document3`, `upload_document4`, `upload_date`, `assessment_Id`, `claimStatus`, `processing_status`, `student_email`) VALUES
(22, 'I Can Not Submit My assessment///////////', 'dvdv', 'claim_doc/1460405302-porch0516.jpg', NULL, NULL, NULL, '2017-03-15', 19, 'Complete', 'Approved', 'developer.tarikul711@gmail.com'),
(23, 'I Can Not Submit My assessment 3', 'sc', '', NULL, NULL, NULL, '2017-03-15', 19, 'Incomplete', '', 'shiplu@gmail.com'),
(24, 'xsx', 'xs', 'claim_doc/1555543_569591643145569_4993561905081840144_n.jpg', NULL, NULL, NULL, '2017-02-15', 22, 'Complete', 'Rejected', 'shiplu@gmail.com'),
(25, 'gaming tarikul', 'dcdcd tarikul ', 'claim_doc/balance.png', NULL, NULL, NULL, '2017-03-26', 22, 'Complete', 'Approved', 'shiplu@gmail.com'),
(26, 'football 2', 'dvdcvdcd', 'claim_doc/1460405302-porch0516.jpg', NULL, NULL, NULL, '2017-03-26', 22, 'Complete', 'Rejected', 'shiplu@gmail.com'),
(27, 'football', ' fvdfvf 2', 'claim_doc/1555543_569591643145569_4993561905081840144_n.jpg', NULL, NULL, NULL, '2017-03-26', 22, 'Complete', '', 'shiplu@gmail.com'),
(28, 'Hello Bangladesh', 'vfvf', '', NULL, NULL, NULL, '2017-03-15', 22, 'Incomplete', '', 'shiplu@gmail.com'),
(29, 'dcdc', 'dcdcd', 'claim_doc/0364af49500211.58b6f73190592.jpg', NULL, NULL, NULL, '2017-03-15', 22, 'Complete', 'Approved', 'shiplu@gmail.com'),
(30, 'dcdc', 'dcdcd', 'claim_doc/0364af49500211.58b6f73190592.jpg', NULL, NULL, NULL, '2017-03-15', 22, 'Complete', '', 'shiplu@gmail.com'),
(31, 'Hello UK', 'dvcdv', 'claim_doc/1460405302-porch0516.jpg', NULL, NULL, NULL, '2017-03-15', 22, 'Complete', '', 'shiplu@gmail.com'),
(32, 'Hello Pakistan ', 'dcdcv', '', NULL, NULL, NULL, '2017-03-15', 22, 'Incomplete', '', 'shiplu@gmail.com'),
(33, 'Hello USA', 'dvdvd', 'claim_doc/CW_COMP1649_1558_ma3821t_000913086_20160428_230820_1516.PDF', NULL, NULL, NULL, '2017-03-23', 24, 'Complete', '', 'shiplu@gmail.com'),
(34, 'Hello USA', 'scdcdc', 'claim_doc/bamboo.png', NULL, NULL, NULL, '2017-03-26', 24, 'Complete', '', 'shiplu@gmail.com'),
(35, 'Hello USA', 'scdcdc', 'claim_doc/bamboo.png', NULL, NULL, NULL, '2017-03-26', 24, 'Complete', '', 'shiplu@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE IF NOT EXISTS `faculty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facultyName` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `facultyName`) VALUES
(1, 'Business'),
(2, 'Arts'),
(3, 'Humanities '),
(4, 'Science');

-- --------------------------------------------------------

--
-- Table structure for table `managementinfo`
--

CREATE TABLE IF NOT EXISTS `managementinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `facultyName` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `managementinfo`
--

INSERT INTO `managementinfo` (`id`, `email`, `password`, `role`, `facultyName`) VALUES
(1, 'tar711@gmail.com', '123', 'ec_manager', ''),
(2, 'tarikul711@gmail.com', '123', 'ec_coordinator', '1'),
(3, 'torikul711@gmail.com', '123', 'admin', '');

-- --------------------------------------------------------

--
-- Table structure for table `password_retrieve`
--

CREATE TABLE IF NOT EXISTS `password_retrieve` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `confirmation` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `password_retrieve`
--

INSERT INTO `password_retrieve` (`id`, `name`, `email`, `confirmation`) VALUES
(1, '', 'tarikul711@gmail.com', 'Password Send'),
(2, '', 'tarikul711@gmail.com', 'Password Send'),
(3, '', 'tarikul711@gmail.com', 'Password Send'),
(4, '', 'tarikul711@gmail.com', 'Password Send'),
(5, 'Md Tarikul Islam', 'tarikul@gmail.com', 'Password Send');

-- --------------------------------------------------------

--
-- Table structure for table `studentinformation`
--

CREATE TABLE IF NOT EXISTS `studentinformation` (
  `st_id` int(20) NOT NULL AUTO_INCREMENT,
  `st_FirstName` varchar(100) DEFAULT NULL,
  `st_Lastname` varchar(100) DEFAULT NULL,
  `st_dob` varchar(50) DEFAULT NULL,
  `st_email` varchar(100) DEFAULT NULL,
  `st_phon` varchar(30) DEFAULT NULL,
  `st_address` varchar(200) DEFAULT NULL,
  `st_photo` varchar(200) DEFAULT NULL,
  `st_password` varchar(30) DEFAULT NULL,
  `batchNo` varchar(30) DEFAULT NULL,
  `session` varchar(100) DEFAULT NULL,
  `Faculty` varchar(100) DEFAULT NULL,
  `department` varchar(100) NOT NULL,
  PRIMARY KEY (`st_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `studentinformation`
--

INSERT INTO `studentinformation` (`st_id`, `st_FirstName`, `st_Lastname`, `st_dob`, `st_email`, `st_phon`, `st_address`, `st_photo`, `st_password`, `batchNo`, `session`, `Faculty`, `department`) VALUES
(1, 'Md', 'Shiplu', '12/12/1997', 'shiplu@gmail.com ', '01924477558', 'mirpur 10,dhaka', NULL, '123', '35', '2017', '1', '1'),
(2, 'Md', 'Rumi', '1/9/1998', 'rumi@gmail.com', '01923388775', 'mohammadpur,dhaka', NULL, '333', '35', 'jun', 'CSE', ''),
(3, 'md', 'nazmul', '3/4/1997', 'nazmul@gmail.com', '0198445567', 'jatrabre,dhaka', NULL, '6666', '33', 'December', 'IT', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
