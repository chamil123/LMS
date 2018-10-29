-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 29, 2018 at 03:23 PM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

DROP TABLE IF EXISTS `application`;
CREATE TABLE IF NOT EXISTS `application` (
  `application_id` int(11) NOT NULL AUTO_INCREMENT,
  `application_lamount` double DEFAULT NULL,
  `application_lperiod` int(11) DEFAULT NULL,
  `application_month` int(11) DEFAULT NULL,
  `application_lamountWithInt` double DEFAULT NULL,
  `application_availableAmount` double DEFAULT NULL,
  `application_irate` double DEFAULT NULL,
  `application_ldue` double DEFAULT NULL,
  `application_lterm` int(11) DEFAULT NULL,
  `application_rentalf` varchar(45) DEFAULT NULL,
  `application_intCal` varchar(45) DEFAULT NULL,
  `application_date` date DEFAULT NULL,
  `application_status` varchar(45) DEFAULT NULL,
  `application_activateDate` date DEFAULT NULL,
  `member_id` int(11) NOT NULL,
  PRIMARY KEY (`application_id`,`member_id`),
  KEY `fk_Application_Member1_idx` (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`application_id`, `application_lamount`, `application_lperiod`, `application_month`, `application_lamountWithInt`, `application_availableAmount`, `application_irate`, `application_ldue`, `application_lterm`, `application_rentalf`, `application_intCal`, `application_date`, `application_status`, `application_activateDate`, `member_id`) VALUES
(1, 10000, 13, 3, 13000, NULL, 10, 1000, 3, 'Weekly', 'Monthly', '2017-08-16', NULL, NULL, 3),
(2, 14000, 14, 3, 18200, NULL, 10, 1300, 3, 'Weekly', 'Monthly', '0000-00-00', 'closed', '2018-01-18', 4),
(3, 15000, 15, 3, 19500, NULL, 10, 1300, 3, 'Monthly', 'Monthly', '0000-00-00', NULL, NULL, 8),
(4, 16000, 16, 3, 20800, NULL, 10, 1300, 6, 'Weekly', 'Monthly', '0000-00-00', NULL, NULL, 9),
(5, 20000, 20, 3, 26000, NULL, 10, 1300, 1, 'Weekly', 'Monthly', '0000-00-00', NULL, NULL, 10),
(6, 25000, 25, 3, 32500, NULL, 10, 1300, 1, 'Weekly', 'Monthly', '2017-08-16', NULL, NULL, 6),
(7, 30000, 30, 3, 39000, NULL, 10, 1300, 3, 'Weekly', 'Monthly', '2017-08-16', NULL, NULL, 5),
(8, 60000, 30, 3, 78000, NULL, 10, 2600, 2, 'Weekly', 'Monthly', '2017-08-16', NULL, NULL, 4),
(9, 15000, 3, 3, 1950, NULL, 10, 650, 3, 'Monthly', 'Monthly', '2017-08-16', NULL, NULL, 5),
(10, 40000, 40, 3, 52000, NULL, 10, 1300, 3, 'Monthly', 'Monthly', '2017-08-16', NULL, NULL, 5),
(11, 50000, 10, 3, 65000, NULL, 10, 6500, 3, 'Monthly', 'Monthly', '2017-08-16', NULL, NULL, 8),
(12, 45000, 10, 3, 58500, NULL, 10, 5850, 3, 'Weekly', 'Monthly', '2017-08-16', NULL, NULL, 3),
(13, 3500, 4, 3, 4550, NULL, 10, 1137.5, 3, 'Weekly', 'Monthly', '2017-08-17', NULL, NULL, 4),
(14, 2500, 10, 3, 3250, NULL, 10, 325, 3, 'Weekly', 'Monthly', '2017-08-17', NULL, NULL, 4),
(16, 3500, 10, 3, 4550, NULL, 10, 455, 3, 'Weekly', 'Monthly', '2017-08-24', NULL, NULL, 10),
(17, 6500, 10, 3, 8450, NULL, 10, 845, 3, 'Weekly', 'Monthly', '2017-08-25', NULL, NULL, 14),
(18, 3500, 35, 3, 4550, NULL, 10, 130, 3, 'Weekly', 'Monthly', '2017-08-25', NULL, NULL, 16),
(19, 4500, 35, 3, 5850, NULL, 10, 130, 3, 'Weekly', 'Monthly', '2017-08-26', NULL, NULL, 3),
(20, 15000, 15, 3, 19500, NULL, 10, 1300, 3, 'Weekly', 'Monthly', '2017-08-26', NULL, NULL, 8),
(21, 8500, 10, 3, 11050, NULL, 10, 845, 3, 'Weekly', 'Monthly', '2017-08-26', NULL, NULL, 9),
(22, 6500, 10, 3, 8450, NULL, 10, 845, 3, 'Weekly', 'Monthly', '2017-08-28', NULL, NULL, 4),
(23, 6500, 10, 3, 8450, NULL, 10, 845, 4, 'Weekly', 'Monthly', '2017-08-28', NULL, NULL, 11),
(24, 9900, 10, 3, 12870, NULL, 10, 1287, 4, 'Weekly', 'Monthly', '2017-08-28', NULL, NULL, 16),
(25, 1500, 3, 3, 1950, NULL, 10, 650, 5, 'Monthly', 'Monthly', '2017-08-29', NULL, NULL, 4),
(26, 15000, 13, 3, 19500, NULL, 10, 1500, 6, 'Weekly', 'Monthly', '2017-12-18', 'closed', '2018-01-17', 4),
(27, 13000, 13, 3, 16900, NULL, 10, 1300, 0, 'Monthly', 'Monthly', '2017-12-18', 'activated', '2018-01-17', 13),
(28, 18000, 18, 3, 23400, 23400, 10, 1300, 4, 'Weekly', 'Monthly', '2017-12-19', 'activated', '2018-01-30', 3),
(29, 15000, 15, 3, 19500, 19500, 10, 1300, 7, 'Weekly', 'Monthly', '2017-12-22', 'activated', '2018-01-17', 4),
(30, 21000, 21, 3, 27300, 27300, 10, 1300, 8, 'Weekly', 'Monthly', '2017-12-22', 'pending', '2018-01-16', 4),
(31, 6500, 10, 3, 8450, 8450, 10, 845, 0, 'Weekly', 'Monthly', '2017-12-22', 'activated', '2017-12-22', 17),
(32, 65000, 10, 3, 84500, 84500, 10, 8450, 0, 'Weekly', 'Monthly', '2017-12-22', 'activated', '2018-01-17', 19),
(33, 11000, 10, 3, 14300, 14300, 10, 1430, 1, 'Weekly', 'Monthly', '2018-01-20', 'pending', NULL, 19),
(34, 18000, 13, 3, 23400, 23400, 10, 1800, 0, 'Weekly', 'Monthly', '2018-01-01', 'activated', '2018-01-04', 20),
(35, 11000, 10, 3, 14300, 14300, 10, 1430, 2, 'Weekly', 'Monthly', '2018-01-30', 'activated', '2018-01-30', 10),
(36, 11000, 10, 3, 14300, 14300, 10, 1430, 1, 'Weekly', 'Monthly', '2018-01-30', 'pending', NULL, 20),
(37, 31000, 13, 3, 40300, 40300, 10, 3100, 0, 'Weekly', 'Monthly', '2018-01-30', 'activated', '2018-01-30', 24);

-- --------------------------------------------------------

--
-- Table structure for table `application_has_member`
--

DROP TABLE IF EXISTS `application_has_member`;
CREATE TABLE IF NOT EXISTS `application_has_member` (
  `application_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  PRIMARY KEY (`application_id`,`member_id`),
  KEY `fk_Application_has_Member_Member1_idx` (`member_id`),
  KEY `fk_Application_has_Member_Application1_idx` (`application_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

DROP TABLE IF EXISTS `branch`;
CREATE TABLE IF NOT EXISTS `branch` (
  `branch_id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_code` varchar(45) DEFAULT NULL,
  `branch_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `branch_code`, `branch_name`) VALUES
(1, '01', 'Eheliyagoda'),
(2, '02', 'Rathnapura');

-- --------------------------------------------------------

--
-- Table structure for table `center`
--

DROP TABLE IF EXISTS `center`;
CREATE TABLE IF NOT EXISTS `center` (
  `center_id` int(11) NOT NULL AUTO_INCREMENT,
  `center_code` varchar(45) DEFAULT NULL,
  `center_name` varchar(45) DEFAULT NULL,
  `center_date` varchar(45) DEFAULT NULL,
  `center_status` int(11) NOT NULL COMMENT '0=Active, 1= delete',
  `branch_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`center_id`,`branch_id`,`user_id`),
  KEY `fk_Center_Branch1_idx` (`branch_id`),
  KEY `fk_center_user1_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `center`
--

INSERT INTO `center` (`center_id`, `center_code`, `center_name`, `center_date`, `center_status`, `branch_id`, `user_id`) VALUES
(1, '001', 'dandeniya', 'Sunday', 0, 2, 5),
(2, '002', 'Paleegala', 'Sunday', 0, 2, 4),
(3, '001', 'Alapathaa', 'Tuesday', 0, 1, 15);

-- --------------------------------------------------------

--
-- Table structure for table `charges`
--

DROP TABLE IF EXISTS `charges`;
CREATE TABLE IF NOT EXISTS `charges` (
  `charges_id` int(11) NOT NULL AUTO_INCREMENT,
  `charges_documentCharges` double DEFAULT NULL,
  `charges_memberFee` double DEFAULT NULL,
  `application_id` int(11) NOT NULL,
  PRIMARY KEY (`charges_id`,`application_id`),
  KEY `fk_Charges_application1_idx` (`application_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `charges`
--

INSERT INTO `charges` (`charges_id`, `charges_documentCharges`, `charges_memberFee`, `application_id`) VALUES
(1, 150, 300, 28),
(2, 450, 70, 28),
(3, 4500, 1500, 35),
(4, 500, 153, 37);

-- --------------------------------------------------------

--
-- Table structure for table `dailycollection`
--

DROP TABLE IF EXISTS `dailycollection`;
CREATE TABLE IF NOT EXISTS `dailycollection` (
  `dailycollection_id` int(11) NOT NULL AUTO_INCREMENT,
  `dailycollection_date` date DEFAULT NULL,
  `dailycollection_amount_paid` double DEFAULT NULL,
  `application_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  PRIMARY KEY (`dailycollection_id`,`application_id`,`member_id`),
  KEY `fk_DailyCollection_Member1_idx` (`member_id`),
  KEY `fk_DailyCollection_Application1_idx` (`application_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `guranter`
--

DROP TABLE IF EXISTS `guranter`;
CREATE TABLE IF NOT EXISTS `guranter` (
  `guranter_id` int(11) NOT NULL AUTO_INCREMENT,
  `guranter_surName` varchar(45) DEFAULT NULL,
  `guranter_initialInFulWithoutSurname` varchar(45) DEFAULT NULL,
  `guranter_initial` varchar(45) DEFAULT NULL,
  `guranter_NIC` varchar(45) DEFAULT NULL,
  `guranter_dateOfBirth` date DEFAULT NULL,
  `guranter_contact` varchar(45) DEFAULT NULL,
  `guranter_AddressLine1` varchar(45) DEFAULT NULL,
  `guranter_AddressLine2` varchar(45) DEFAULT NULL,
  `guranter_AddressLine3` varchar(45) DEFAULT NULL,
  `guranter_AddressLine4` varchar(45) DEFAULT NULL,
  `guranter_status` tinyint(4) DEFAULT NULL COMMENT '0=Active,1=delete',
  `member_id` int(11) NOT NULL,
  PRIMARY KEY (`guranter_id`,`member_id`),
  KEY `fk_Guranter_Member1_idx` (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `guranter`
--

INSERT INTO `guranter` (`guranter_id`, `guranter_surName`, `guranter_initialInFulWithoutSurname`, `guranter_initial`, `guranter_NIC`, `guranter_dateOfBirth`, `guranter_contact`, `guranter_AddressLine1`, `guranter_AddressLine2`, `guranter_AddressLine3`, `guranter_AddressLine4`, `guranter_status`, `member_id`) VALUES
(1, 'Uduweriya', 'Bandara', 'B', '763043829V', '1976-06-08', '+94716890550', '5/A', 'nadurana road', 'dandeniya', 'eheliyagoda', 0, 27);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `login_id` int(11) NOT NULL AUTO_INCREMENT,
  `login_userName` varchar(45) DEFAULT NULL,
  `login_password` varchar(45) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`login_id`,`user_id`),
  KEY `fk_Login_User1_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `login_userName`, `login_password`, `user_id`) VALUES
(1, 'dumith', '123', 12),
(2, 'sachitha', '123', 13),
(3, 'nisa', '123', 14),
(4, 'prasa', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 15),
(5, 'hema', '123', 16),
(6, 'thara', '123', 17),
(7, 'nuwan', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 18),
(8, 'tharu', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 19),
(9, 'chamil', '123', 20);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE IF NOT EXISTS `member` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_number` varchar(45) DEFAULT NULL,
  `member_NIC` varchar(45) DEFAULT NULL,
  `member_surNmae` varchar(45) DEFAULT NULL,
  `member_initialInFulWithoutSurname` varchar(45) DEFAULT NULL,
  `member_inital` varchar(45) DEFAULT NULL,
  `member_dateOfBirth` date DEFAULT NULL,
  `member_maritalStatus` varchar(45) DEFAULT NULL,
  `member_gender` varchar(45) DEFAULT NULL,
  `member_nationality` varchar(45) DEFAULT NULL,
  `member_group` varchar(45) DEFAULT NULL,
  `member_mobileNumber` varchar(45) DEFAULT NULL,
  `member_homeNumber` varchar(45) DEFAULT NULL,
  `member_branchNumber` varchar(45) DEFAULT NULL,
  `member_status` varchar(45) DEFAULT NULL,
  `member_AddressLine1` varchar(45) DEFAULT NULL,
  `member_AddressLine2` varchar(45) DEFAULT NULL,
  `member_AddressLine3` varchar(45) DEFAULT NULL,
  `member_AddressLine4` varchar(45) DEFAULT NULL,
  `member_code` varchar(45) DEFAULT NULL,
  `center_id` int(11) NOT NULL,
  PRIMARY KEY (`member_id`,`center_id`),
  KEY `fk_Member_Center1_idx` (`center_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_id`, `member_number`, `member_NIC`, `member_surNmae`, `member_initialInFulWithoutSurname`, `member_inital`, `member_dateOfBirth`, `member_maritalStatus`, `member_gender`, `member_nationality`, `member_group`, `member_mobileNumber`, `member_homeNumber`, `member_branchNumber`, `member_status`, `member_AddressLine1`, `member_AddressLine2`, `member_AddressLine3`, `member_AddressLine4`, `member_code`, `center_id`) VALUES
(25, 'SR01/003/001', '882073428V', 'Pathirana ss', 'Jayashantha', 'K.P.C.J', '1988-10-04', '----------please select an option---------', 'male', 'Sinhala', '008', '+94716460440', '0362258580', '', 'Active', '5/A', 'dalugama', 'kelaniya', '', '0000000001', 3),
(27, 'SR01/001/99', '882073428V', 'Pathirana', 'Chamil', 'C', '1988-01-04', 'Married', 'male', 'Christian', '88', '+94716860550', '0362258590', '01', 'Active', '5/A', 'dippitigoda', 'dalugama', 'kelaniya', '0000000026', 1);

-- --------------------------------------------------------

--
-- Table structure for table `member_group`
--

DROP TABLE IF EXISTS `member_group`;
CREATE TABLE IF NOT EXISTS `member_group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_number` varchar(45) DEFAULT NULL,
  `group_status` tinyint(4) DEFAULT NULL,
  `center_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`group_id`,`center_id`,`branch_id`),
  KEY `fk_group_center1_idx` (`center_id`),
  KEY `fk_group_branch1_idx` (`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member_group`
--

INSERT INTO `member_group` (`group_id`, `group_number`, `group_status`, `center_id`, `branch_id`) VALUES
(1, '88', 0, 1, 1),
(2, '89', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

DROP TABLE IF EXISTS `module`;
CREATE TABLE IF NOT EXISTS `module` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`module_id`, `module_name`) VALUES
(1, 'Center management'),
(2, 'Member Management'),
(3, 'Application Management'),
(4, 'Contract Inquery'),
(7, 'User Management'),
(8, 'Report Management');

-- --------------------------------------------------------

--
-- Table structure for table `rights`
--

DROP TABLE IF EXISTS `rights`;
CREATE TABLE IF NOT EXISTS `rights` (
  `rights_id` int(11) NOT NULL AUTO_INCREMENT,
  `rights_name` varchar(200) DEFAULT NULL,
  `module_id` int(11) NOT NULL,
  PRIMARY KEY (`rights_id`,`module_id`),
  KEY `fk_Rights_Module1_idx` (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rights`
--

INSERT INTO `rights` (`rights_id`, `rights_name`, `module_id`) VALUES
(1, 'Add Centers', 1),
(2, 'View Centers', 1),
(3, 'Update center', 1),
(4, 'Delete center', 1),
(5, 'Add member', 2),
(6, 'View member', 2),
(7, 'Update member', 2),
(8, 'Delete member', 2),
(9, 'Add application', 3),
(10, 'View application', 3),
(11, 'Update application', 3),
(12, 'Delete application', 3),
(13, 'Add Contract Inquery', 4),
(14, 'View Contract Inquery', 4),
(15, 'Update Contract Inquery', 4),
(16, 'Delete Contract Inquery', 4),
(17, 'Add user', 7),
(18, 'View User', 7),
(19, 'Update User', 7),
(20, 'Delete User', 7),
(21, 'Arrears Report', 8),
(22, 'Detail of loan issed', 8),
(23, 'Loan outstanding', 8),
(24, 'Ledger report', 8),
(25, 'Repayment sheet', 8);

-- --------------------------------------------------------

--
-- Table structure for table `rights_has_user`
--

DROP TABLE IF EXISTS `rights_has_user`;
CREATE TABLE IF NOT EXISTS `rights_has_user` (
  `rights_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`rights_id`,`user_id`),
  KEY `fk_Rights_has_User_User1_idx` (`user_id`),
  KEY `fk_Rights_has_User_Rights1_idx` (`rights_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rights_has_user`
--

INSERT INTO `rights_has_user` (`rights_id`, `user_id`) VALUES
(1, 10),
(8, 10),
(9, 10),
(16, 10),
(1, 11),
(8, 11),
(12, 11),
(14, 11),
(1, 12),
(5, 12),
(12, 12),
(16, 12),
(2, 13),
(6, 13),
(10, 13),
(14, 13),
(3, 14),
(7, 14),
(8, 14),
(11, 14),
(16, 14),
(1, 15),
(3, 15),
(4, 15),
(6, 15),
(7, 15),
(8, 15),
(9, 15),
(10, 15),
(11, 15),
(12, 15),
(15, 15),
(16, 15),
(1, 16),
(3, 16),
(7, 16),
(9, 16),
(11, 16),
(12, 16),
(13, 16),
(14, 16),
(16, 16),
(1, 17),
(3, 17),
(4, 17),
(5, 17),
(7, 17),
(8, 17),
(9, 17),
(11, 17),
(12, 17),
(14, 17),
(15, 17),
(1, 18),
(3, 18),
(4, 18),
(5, 18),
(7, 18),
(9, 18),
(11, 18),
(12, 18),
(13, 18),
(15, 18),
(1, 19),
(2, 19),
(3, 19),
(4, 19),
(5, 19),
(6, 19),
(7, 19),
(8, 19),
(9, 19),
(10, 19),
(11, 19),
(12, 19),
(13, 19),
(14, 19),
(15, 19),
(16, 19),
(17, 19),
(18, 19),
(19, 19),
(20, 19),
(21, 19),
(22, 19),
(23, 19),
(24, 19),
(25, 19),
(1, 20),
(2, 20),
(3, 20),
(4, 20),
(5, 20),
(6, 20),
(7, 20),
(8, 20),
(9, 20),
(10, 20),
(11, 20),
(12, 20),
(13, 20),
(14, 20),
(15, 20),
(16, 20),
(17, 20),
(18, 20),
(19, 20),
(20, 20),
(21, 20),
(22, 20),
(23, 20),
(24, 20),
(25, 20);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_firstName` varchar(45) DEFAULT NULL,
  `user_lastName` varchar(45) DEFAULT NULL,
  `user_email` varchar(45) DEFAULT NULL,
  `user_status` varchar(45) DEFAULT NULL,
  `user_NIC_number` varchar(45) DEFAULT NULL,
  `user_DOB` date DEFAULT NULL,
  `user_phoneNumber` varchar(45) DEFAULT NULL,
  `user_gender` varchar(45) DEFAULT NULL,
  `user_address` varchar(200) DEFAULT NULL,
  `user_image` varchar(200) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `fk_User_Role1_idx` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_firstName`, `user_lastName`, `user_email`, `user_status`, `user_NIC_number`, `user_DOB`, `user_phoneNumber`, `user_gender`, `user_address`, `user_image`, `role_id`) VALUES
(4, 'chamil', 'Ranjith', 'chamiljay88@gmail.com', 'active', '892073428V', '1978-12-06', '0716460440', 'male', 'asdasdasd', '../uploads/25498023_10213998265024399_5497061', 1),
(5, 'nimal', 'Gayantha', 'chamiljay88@gmail.com', 'active', '892073428V', '1978-12-06', '0716460440', 'male', 'asdasdasda', '../../uploads/25552364_2549277271964478_41649', 1),
(6, 'Dumith', 'Gayantha', 'charukaroxx@gmail.com', 'active', '892073428V', '1978-12-06', '0716460440', 'female', 'asdasdasd', '../../uploads/25498023_10213998265024399_5497', 2),
(7, 'Mervyn', 'Priyanth', 'charukaroxx@gmail.com', 'active', '892073428V', '1978-12-06', '0716460440', 'female', 'asdasdasd', '../../uploads/17241206115725552364_2549277271', 2),
(8, 'Jayantha', 'Priyanth', 'charukaroxx@gmail.com', 'active', '892073428V', '1978-12-06', '0716460440', 'female', 'asdsd', '../../uploads/httpsgoo.glZixCy3 (1).png', 1),
(9, 'Madushan', 'Gayantha', 'charukaroxx@gmail.com', 'active', '892073428V', '1978-12-06', '0716460440', 'male', 'dsadasd', '../../uploads/17241206164725498023_1021399826', 1),
(10, 'Dumith', 'Gayantha', 'charukaroxx@gmail.com', 'active', '892073428V', '1978-12-06', '0716460440', 'male', 'asdsdad', '../../uploads/172412062114httpsgoo.glZixCy3 (', 2),
(11, 'Mervyn', 'Priyanth', 'charukaroxx@gmail.com', 'active', '892073428V', '1978-12-06', '0716460440', 'male', 'sdasdasd', '../../uploads/172412062318httpsgoo.glZixCy3 (', 1),
(12, 'Jayantha', 'Ranjith', 'chamiljay88@gmail.com', 'active', '892073428V', '1978-12-06', '0716460440', 'male', 'asdasdasd', '../../uploads/172412063721httpsgoo.glZixCy3 (', 2),
(13, 'sachitha', 'arachci', 'chamiljay88@gmail.com', 'active', '892073428V', '1993-12-16', '0716460440', 'male', 'dsdsdasdd sdfsdf', '../../uploads/17251205385425552364_2549277271', 2),
(14, 'nisansala', 'sandamali', 'chamiljay88@gmail.com', 'active', '903072458V', '1988-01-17', '0716564085', 'female', 'kalagedihena, nittambuwa', '../../uploads/10516777_10204324782303551_1190', 2),
(15, 'prasanna', 'siriwardhanas', 'charukaroxx@gmail.com', 'active', '903072458V', '1984-01-17', '0716564085', 'male', 'sadadasd', '../../images/blank_user_icon.png', 2),
(16, 'hemantha', 'danawardhana', 'charukaroxx@gmail.com', 'active', '892073428V', '1987-01-05', '0716460440', 'male', 'asdasda', '../uploads/Transparent_Gold_Cup_Trophy_PNG_Pi', 2),
(17, 'tharanga', 'weerasingha', 'charukaroxx@gmail.com', 'active', '903072458V', '1988-01-06', '0716460440', 'male', 'asasdas', '../../uploads/13883647_1129548333772606_1007861601_n.jpg', 2),
(18, 'nuwan', 'chamara', 'chamiljay88@gmail.com', 'active', '892073428V', '1988-04-05', '0716460440', 'male', 'asdasd', '../../images/blank_user_icon.png', 2),
(19, 'Tharnidus', 'Dilshan', 'manuja@gmail.com', 'active', '953843528V', '1995-05-03', '0767655246', 'male', 'No:130 B, Dandeniya, Eheliyagoda', '../../images/blank_user_icon.png', 2),
(20, 'chamil', 'pathirana', 'chamil@ceylonlinux.lk', 'active', '882073428V', '1988-07-25', '0716460440', 'male', 'sdsds', '../../uploads/11699014_698649596905952_4259172463469917221_o.png', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `application_has_member`
--
ALTER TABLE `application_has_member`
  ADD CONSTRAINT `fk_Application_has_Member_Application1` FOREIGN KEY (`application_id`) REFERENCES `application` (`application_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Application_has_Member_Member1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `center`
--
ALTER TABLE `center`
  ADD CONSTRAINT `fk_Center_Branch1` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_center_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `charges`
--
ALTER TABLE `charges`
  ADD CONSTRAINT `fk_Charges_application1` FOREIGN KEY (`application_id`) REFERENCES `application` (`application_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `dailycollection`
--
ALTER TABLE `dailycollection`
  ADD CONSTRAINT `fk_DailyCollection_Application1` FOREIGN KEY (`application_id`) REFERENCES `application` (`application_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_DailyCollection_Member1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `guranter`
--
ALTER TABLE `guranter`
  ADD CONSTRAINT `fk_Guranter_Member1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `fk_Login_User1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `member_group`
--
ALTER TABLE `member_group`
  ADD CONSTRAINT `fk_group_branch1` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_group_center1` FOREIGN KEY (`center_id`) REFERENCES `center` (`center_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rights`
--
ALTER TABLE `rights`
  ADD CONSTRAINT `fk_Rights_Module1` FOREIGN KEY (`module_id`) REFERENCES `module` (`module_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rights_has_user`
--
ALTER TABLE `rights_has_user`
  ADD CONSTRAINT `fk_Rights_has_User_Rights1` FOREIGN KEY (`rights_id`) REFERENCES `rights` (`rights_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Rights_has_User_User1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_User_Role1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
