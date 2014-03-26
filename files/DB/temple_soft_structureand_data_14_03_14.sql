-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 14, 2014 at 05:05 AM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `temple_soft`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `getSubSubledger`(id INT) RETURNS text CHARSET latin1
    DETERMINISTIC
BEGIN
    DECLARE NAME TEXT DEFAULT NULL;
    SELECT GROUP_CONCAT(ledger_sub_name) INTO NAME FROM ledger_sub WHERE parent_sub_ledger_id = id;
    RETURN  NAME;
  END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `account_master`
--

CREATE TABLE IF NOT EXISTS `account_master` (
  `account_id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher_number` varchar(11) NOT NULL,
  `voucher_type_id` int(11) NOT NULL,
  `fy_id` int(11) NOT NULL,
  `reference_number` varchar(125) NOT NULL,
  `account_from` int(11) NOT NULL,
  `account_to` int(11) NOT NULL,
  `account_debit` double(25,2) NOT NULL,
  `account_credit` double(25,2) NOT NULL,
  `date` date NOT NULL,
  `narration` text NOT NULL,
  `ref_ledger` int(11) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '1' COMMENT '2 for deleted,1 not deleted',
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

--
-- Dumping data for table `account_master`
--

INSERT INTO `account_master` (`account_id`, `voucher_number`, `voucher_type_id`, `fy_id`, `reference_number`, `account_from`, `account_to`, `account_debit`, `account_credit`, `date`, `narration`, `ref_ledger`, `deleted`) VALUES
(1, '', -1, -1, '', 0, 0, 150.00, 0.00, '2014-03-13', '', 0, 1),
(2, '', -1, -1, '', 0, 0, 0.00, 150.00, '2014-03-13', '', 0, 1),
(3, '', -1, -1, '', 0, 0, 40.00, 0.00, '2014-03-13', '', 0, 1),
(4, '', -1, -1, '', 0, 0, 0.00, 40.00, '2014-03-13', '', 0, 1),
(5, '', -1, -1, '', 0, 0, 10.00, 0.00, '2014-03-13', '', 0, 1),
(6, '', -1, -1, '', 0, 0, 0.00, 10.00, '2014-03-13', '', 0, 1),
(7, '', -1, -1, '', 0, 0, 120.00, 0.00, '2014-03-13', '', 0, 1),
(8, '', -1, -1, '', 0, 0, 0.00, 120.00, '2014-03-13', '', 0, 1),
(9, '001', 1, 1, '', 1, 12, 10.00, 0.00, '2014-03-13', '', 1, 1),
(10, '001', 1, 1, '', 1, 12, 0.00, 10.00, '2014-03-13', '', 12, 1),
(11, '002', 1, 1, '', 1, 12, 40.00, 0.00, '2014-03-13', '', 1, 1),
(12, '002', 1, 1, '', 1, 12, 0.00, 40.00, '2014-03-13', '', 12, 1),
(13, '003', 1, 1, '', 1, 12, 60.00, 0.00, '2014-03-13', '', 1, 1),
(14, '003', 1, 1, '', 1, 12, 0.00, 60.00, '2014-03-13', '', 12, 1),
(15, '004', 1, 1, '', 1, 12, 400.00, 0.00, '2014-03-13', '', 1, 1),
(16, '004', 1, 1, '', 1, 12, 0.00, 400.00, '2014-03-13', '', 12, 1),
(17, '005', 1, 1, '', 1, 12, 2000.00, 0.00, '2014-03-13', '', 1, 1),
(18, '005', 1, 1, '', 1, 12, 0.00, 2000.00, '2014-03-13', '', 12, 1),
(19, '006', 1, 1, '', 1, 12, 12.00, 0.00, '2014-03-13', '', 1, 1),
(20, '006', 1, 1, '', 1, 12, 0.00, 12.00, '2014-03-13', '', 12, 1),
(21, '007', 1, 1, '', 1, 12, 50.00, 0.00, '2014-03-13', '', 1, 1),
(22, '007', 1, 1, '', 1, 12, 0.00, 50.00, '2014-03-13', '', 12, 1),
(23, '008', 1, 1, '', 1, 12, 30.00, 0.00, '2014-03-13', '', 1, 1),
(24, '008', 1, 1, '', 1, 12, 0.00, 30.00, '2014-03-13', '', 12, 1),
(25, '009', 1, 1, '', 1, 12, 100.00, 0.00, '2014-03-13', '', 1, 1),
(26, '009', 1, 1, '', 1, 12, 0.00, 100.00, '2014-03-13', '', 12, 1),
(27, '010', 1, 1, '', 1, 12, 500.00, 0.00, '2014-03-13', '', 1, 1),
(28, '010', 1, 1, '', 1, 12, 0.00, 500.00, '2014-03-13', '', 12, 1),
(29, '001', 2, 1, '', 3, 12, 555.00, 0.00, '2014-03-13', '', 3, 1),
(30, '001', 2, 1, '', 3, 12, 0.00, 555.00, '2014-03-13', '', 12, 1),
(31, '002', 2, 1, '', 4, 12, 400.00, 0.00, '2014-03-13', '', 4, 1),
(32, '002', 2, 1, '', 4, 12, 0.00, 400.00, '2014-03-13', '', 12, 1),
(33, '003', 2, 1, '', 5, 12, 435.00, 0.00, '2014-03-13', '', 5, 1),
(34, '003', 2, 1, '', 5, 12, 0.00, 435.00, '2014-03-13', '', 12, 1),
(35, '004', 2, 1, '', 6, 12, 325.00, 0.00, '2014-03-13', '', 6, 1),
(36, '004', 2, 1, '', 6, 12, 0.00, 325.00, '2014-03-13', '', 12, 1),
(37, '005', 2, 1, '', 7, 12, 518.00, 0.00, '2014-03-13', '', 7, 1),
(38, '005', 2, 1, '', 7, 12, 0.00, 518.00, '2014-03-13', '', 12, 1),
(39, '006', 2, 1, '', 8, 12, 1160.00, 0.00, '2014-03-13', '', 8, 1),
(40, '006', 2, 1, '', 8, 12, 0.00, 1160.00, '2014-03-13', '', 12, 1),
(41, '007', 2, 1, '', 9, 12, 22500.00, 0.00, '2014-03-13', '', 9, 1),
(42, '007', 2, 1, '', 9, 12, 0.00, 22500.00, '2014-03-13', '', 12, 1),
(43, '008', 2, 1, '', 10, 12, 455.00, 0.00, '2014-03-13', '', 10, 1),
(44, '008', 2, 1, '', 10, 12, 0.00, 455.00, '2014-03-13', '', 12, 1),
(45, '009', 2, 1, '', 11, 12, 1500.00, 0.00, '2014-03-13', '', 11, 1),
(46, '009', 2, 1, '', 11, 12, 0.00, 1500.00, '2014-03-13', '', 12, 1),
(47, '001', 4, 1, '', 12, 13, 2500.00, 0.00, '2014-03-13', '', 12, 1),
(48, '001', 4, 1, '', 12, 13, 0.00, 2500.00, '2014-03-13', '', 13, 1),
(49, '002', 4, 1, '', 12, 14, 1000.00, 0.00, '2014-03-13', '', 12, 1),
(50, '002', 4, 1, '', 12, 14, 0.00, 1000.00, '2014-03-13', '', 14, 1),
(51, '003', 4, 1, '', 12, 15, 750.00, 0.00, '2014-03-13', '', 12, 1),
(52, '003', 4, 1, '', 12, 15, 0.00, 750.00, '2014-03-13', '', 15, 1),
(53, '004', 4, 1, '', 12, 17, 200.00, 0.00, '2014-03-13', '', 12, 1),
(54, '004', 4, 1, '', 12, 17, 0.00, 200.00, '2014-03-13', '', 17, 1),
(55, '005', 4, 1, '', 12, 18, 1500.00, 0.00, '2014-03-13', '', 12, 1),
(56, '005', 4, 1, '', 12, 18, 0.00, 1500.00, '2014-03-13', '', 18, 1),
(57, '006', 4, 1, '', 12, 19, 60000.00, 0.00, '2014-03-13', '', 12, 1),
(58, '006', 4, 1, '', 12, 19, 0.00, 60000.00, '2014-03-13', '', 19, 1),
(59, '007', 4, 1, '', 12, 20, 312.00, 0.00, '2014-03-13', '', 12, 1),
(60, '007', 4, 1, '', 12, 20, 0.00, 312.00, '2014-03-13', '', 20, 1),
(61, '008', 4, 1, '', 12, 21, 415.00, 0.00, '2014-03-13', '', 12, 1),
(62, '008', 4, 1, '', 12, 21, 0.00, 415.00, '2014-03-13', '', 21, 1),
(63, '010', 2, 1, '', 16, 12, 500.00, 0.00, '2014-03-13', '', 16, 1),
(64, '010', 2, 1, '', 16, 12, 0.00, 500.00, '2014-03-13', '', 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `account_settings`
--

CREATE TABLE IF NOT EXISTS `account_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `current_fy_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `account_settings`
--

INSERT INTO `account_settings` (`id`, `current_fy_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ac_books`
--

CREATE TABLE IF NOT EXISTS `ac_books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(125) NOT NULL,
  `ledgers` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE IF NOT EXISTS `administrators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emailid` text COLLATE utf8_unicode_ci,
  `registrationdate` datetime DEFAULT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `image` text COLLATE utf8_unicode_ci,
  `securityquestion_id` int(11) DEFAULT NULL,
  `answer` text COLLATE utf8_unicode_ci,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `record_user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `securityquestion_id` (`securityquestion_id`),
  KEY `record_user_id` (`record_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`id`, `username`, `password`, `emailid`, `registrationdate`, `lastlogin`, `image`, `securityquestion_id`, `answer`, `created`, `updated`, `record_user_id`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'rosy.swapna@acube.co', NULL, '2014-03-14 09:52:35', NULL, NULL, NULL, '2013-04-22 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(250) NOT NULL,
  `customer_address` text NOT NULL,
  `customer_phone` varchar(15) NOT NULL,
  `customer_mobile` varchar(15) NOT NULL,
  `customer_fax` varchar(15) NOT NULL,
  `customer_email` varchar(50) NOT NULL,
  `customer_cst_number` varchar(50) NOT NULL,
  `customer_tin_number` varchar(50) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '1' COMMENT '2 for deleted,1 not deleted',
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `form_type`
--

CREATE TABLE IF NOT EXISTS `form_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `form_type`
--

INSERT INTO `form_type` (`id`, `value`) VALUES
(1, 'F8'),
(2, 'F8B');

-- --------------------------------------------------------

--
-- Table structure for table `fy_master`
--

CREATE TABLE IF NOT EXISTS `fy_master` (
  `fy_id` int(11) NOT NULL AUTO_INCREMENT,
  `fy_name` varchar(125) NOT NULL,
  `fy_start` date NOT NULL,
  `fy_end` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1for open and 0 for closed',
  PRIMARY KEY (`fy_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `fy_master`
--

INSERT INTO `fy_master` (`fy_id`, `fy_name`, `fy_start`, `fy_end`, `status`) VALUES
(1, '2013', '2013-01-01', '2013-12-31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ledger_master`
--

CREATE TABLE IF NOT EXISTS `ledger_master` (
  `ledger_id` int(11) NOT NULL AUTO_INCREMENT,
  `ledger_name` varchar(100) NOT NULL,
  PRIMARY KEY (`ledger_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=95 ;

--
-- Dumping data for table `ledger_master`
--

INSERT INTO `ledger_master` (`ledger_id`, `ledger_name`) VALUES
(1, 'Bank Accounts'),
(2, 'Bank OCC A/C'),
(3, 'Bank OD A/C'),
(4, 'Branch/ Divisions'),
(5, 'Capital Account'),
(6, 'Cash-In-Hand'),
(7, 'Current Assets'),
(8, 'Current Liabilities'),
(9, 'Deposits (Asset)'),
(10, 'Direct Expenses'),
(11, 'Direct Incomes'),
(12, 'Duties & Taxes'),
(13, 'Expenses (Direct)'),
(14, 'Expenses (Indirect)'),
(15, 'Fixed Assets'),
(16, 'Income (Direct)'),
(17, 'Income (Indirect)'),
(18, 'Indirect Incomes'),
(19, 'Indirect Expenses'),
(20, 'Investments'),
(21, 'Loans and Advances (Asset)'),
(22, 'Loans (Liability)'),
(23, 'Misc Expense (Asset)'),
(24, 'Provisions'),
(25, 'Purchase Accounts'),
(26, 'Reserve And Surplus'),
(27, 'Retained Earinies'),
(28, 'Sales Accounts'),
(29, 'Secured Loans'),
(30, 'Stock-In-Hand'),
(31, 'Sundry Creditors'),
(32, 'Sundry Debtors'),
(33, 'Suspense Account'),
(34, 'Un-Secured Loans');

-- --------------------------------------------------------

--
-- Table structure for table `ledger_sub`
--

CREATE TABLE IF NOT EXISTS `ledger_sub` (
  `ledger_sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `ledger_sub_name` text NOT NULL,
  `ledger_id` int(11) NOT NULL DEFAULT '0',
  `parent_sub_ledger_id` int(11) DEFAULT NULL,
  `fy_id` int(11) NOT NULL,
  PRIMARY KEY (`ledger_sub_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `ledger_sub`
--

INSERT INTO `ledger_sub` (`ledger_sub_id`, `ledger_sub_name`, `ledger_id`, `parent_sub_ledger_id`, `fy_id`) VALUES
(1, 'à´µà´´à´¿à´ªà´¾à´Ÿàµ', 11, -1, 1),
(2, 'à´µà´¿à´±àµà´±àµâ€Œà´µà´°à´µàµ', 28, -1, 1),
(3, 'à´ªà´¨à´¿à´¨àµ€à´°àµâ€', 11, -1, 1),
(4, 'à´•à´°àµâ€à´ªàµà´ªàµ‚à´°à´‚', 11, -1, 1),
(5, 'à´­à´¸àµà´®à´‚', 11, -1, 1),
(6, 'à´®à´žàµà´žà´³àµâ€à´ªàµà´ªàµŠà´Ÿà´¿', 11, -1, 1),
(7, 'à´šà´¨àµà´¦à´¨à´¤àµà´¤à´¿à´°à´¿', 11, -1, 1),
(8, 'à´µà´¾à´Ÿà´•', 11, -1, 1),
(9, 'à´Šà´Ÿàµà´Ÿàµà´ªàµà´°', 11, -1, 1),
(10, 'à´¸à´‚à´­à´¾à´µà´¨', 11, -1, 1),
(11, 'à´…à´‚à´—àµà´µà´¤àµà´µ à´«àµ€à´¸àµâ€Œ', 18, -1, 1),
(12, 'Cash', 6, -1, 1),
(13, 'à´¶à´®àµà´ªà´³à´‚', 10, -1, 1),
(14, 'à´¸àµ†à´•àµà´¯àµ‚à´°à´¿à´±àµà´±à´¿ à´¶à´®àµà´ªà´³à´‚', 10, -1, 1),
(15, 'à´°àµ‡à´ªàµˆà´°àµâ€ à´†à´¨àµâ€à´¡àµâ€Œ à´®àµˆà´¨àµà´±àµ†à´¨à´¨àµâ€à´¸àµ', 10, -1, 1),
(16, 'à´ªà´¾à´šà´• à´•àµ‚à´²à´¿', 10, -1, 1),
(17, 'à´¦à´•àµà´·à´¿à´£', 10, -1, 1),
(18, 'à´•à´¾à´°àµâ€ à´µà´¾à´Ÿà´•', 10, -1, 1),
(19, 'à´•àµ†à´Ÿàµà´Ÿà´¿à´Ÿ à´¨à´¿à´°àµâ€à´®à´¾à´£à´‚', 10, -1, 1),
(20, 'à´Ÿàµ†à´²à´¿à´«àµ‹à´£àµâ€ à´šà´¾à´°àµâ€à´œàµ', 10, -1, 1),
(21, 'à´¨à´¿à´•àµà´¤à´¿', 12, -1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pooja`
--

CREATE TABLE IF NOT EXISTS `pooja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `rate` double NOT NULL,
  `status_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `pooja`
--

INSERT INTO `pooja` (`id`, `name`, `rate`, `status_id`) VALUES
(1, 'à´ªàµà´·àµà´ªà´¾à´žàµà´œà´²à´¿', 5, 0),
(2, 'à´—àµà´°àµà´¤à´¿ à´ªàµà´·àµà´ªà´¾à´žàµà´œà´²à´¿', 10, 1),
(3, 'à´¶à´¤àµà´°àµ à´¸à´‚à´¹à´¾à´° à´ªàµà´·àµà´ªà´¾à´žàµà´œà´²à´¿', 20, 0),
(4, 'à´®àµƒà´¤àµà´¯àµà´žàµà´œà´¯ à´ªàµà´·àµà´ªà´¾à´žàµà´œà´²à´¿', 20, 0),
(5, 'à´­à´¾à´—àµà´¯à´¸àµ‚à´•àµà´¤ à´ªàµà´·àµà´ªà´¾à´žàµà´œà´²à´¿', 20, 0),
(6, 'à´¸àµà´ªàµ†à´·àµà´¯à´²àµâ€ à´ªàµà´·àµà´ªà´¾à´žàµà´œà´²à´¿', 20, 0),
(7, 'à´—àµà´°àµà´¤à´¿', 5, 0),
(8, 'à´µàµ†à´³àµà´³à´¨àµ‡à´¦àµà´¯à´‚', 10, 0),
(9, 'à´•àµ‚à´Ÿàµà´Ÿàµà´ªà´¾à´¯à´¸à´‚', 40, 0),
(10, 'à´•à´Ÿàµà´‚à´ªà´¾à´¯à´¸à´‚', 50, 0),
(11, 'à´¨àµ†à´¯àµà´ªà´¾à´¯à´¸à´‚', 75, 0),
(12, 'à´…à´¤à´¿à´®à´§àµà´°à´ªà´¾à´¯à´¸à´‚', 50, 0),
(13, 'à´ªà´¿à´´à´¿à´žàµà´žàµà´ªà´¾à´¯à´¸à´‚', 75, 0),
(14, 'à´†à´±àµà´¨à´¾à´´à´¿à´ªà´¾à´¯à´¸à´‚', 400, 0),
(15, 'à´ªà´¾à´²àµâ€à´ªà´¾à´¯à´¸à´‚', 50, 0),
(16, 'à´ªà´¿à´¤àµƒà´¨à´®à´¸àµà´•à´¾à´°à´‚', 12, 0),
(18, 'à´•àµ‚à´Ÿàµà´Ÿà´¨à´®à´¸àµà´•à´¾à´°à´‚', 30, 0),
(19, 'à´’à´±àµà´±à´¯à´ªàµà´ªà´‚', 30, 0),
(20, 'à´—à´£à´ªà´¤à´¿à´¹àµ‹à´®à´‚', 60, 0),
(21, 'à´…à´·àµà´Ÿà´¦àµà´°à´µàµà´¯à´—à´£à´ªà´¤à´¿à´¹àµ‹à´®à´‚', 200, 0),
(22, 'à´•à´±àµà´•à´¹àµ‹à´®à´‚', 50, 0),
(23, 'à´­à´—à´µà´¤à´¿à´¸àµ‡à´µ', 100, 0),
(24, 'à´¸à´°àµâ€à´ªàµà´ªà´¨àµ‡à´¦àµà´¯à´‚', 10, 0),
(25, 'à´¨àµ‚à´±àµà´‚à´ªà´¾à´²àµà´‚', 50, 0),
(26, 'à´¨à´¿à´±à´®à´¾à´²', 100, 0),
(27, 'à´¨àµ€à´°à´¾à´žàµà´œà´¨à´‚', 10, 0),
(28, 'à´ªà´¤àµà´®à´®à´¿à´Ÿàµà´Ÿàµà´¨àµ‡à´¦àµà´¯à´‚', 15, 0),
(29, 'à´šàµ‹à´±àµ‚à´£àµ', 50, 0),
(30, 'à´µà´¿à´µà´¾à´¹à´‚', 250, 0),
(31, 'à´µà´¾à´¹à´¨à´ªàµ‚à´œ', 100, 0),
(32, 'à´’à´°àµà´¦à´¿à´µà´¸à´¤àµà´¤àµ†à´ªàµ‚à´œ', 300, 0),
(33, 'à´’à´°àµà´¨àµ‡à´°à´ªàµ‚à´œ', 150, 0),
(34, 'à´¤àµà´°à´¿à´•à´¾à´²à´ªàµ‚à´œ', 350, 0),
(35, 'à´¸àµà´®à´‚à´—à´²à´¿à´ªàµ‚à´œ', 500, 0),
(36, 'à´®à´‚à´—à´²àµà´¯à´ªàµ‚à´œ', 500, 0),
(37, 'à´®à´£àµà´¡à´²à´ªàµ‚à´œ', 450, 0),
(38, 'à´šà´¨àµà´¦à´¨à´‚à´šà´¾à´°àµâ€à´¤àµà´¤àµ(à´®àµà´–à´‚)', 30, 0),
(39, 'à´•àµˆà´µàµ†à´Ÿàµà´Ÿà´—àµà´°àµà´¤à´¿', 10, 0),
(40, 'à´ªà´¨àµà´¤àµ€à´°à´¾à´´à´¿', 800, 0),
(41, 'à´…à´°à´ªà´¨àµà´¤àµ€à´°à´´à´¿', 400, 0),
(42, 'à´•à´¾à´²àµâ€à´ªà´¨àµà´¤àµ€à´°à´¾à´´à´¿', 250, 0),
(43, 'à´¤àµà´°à´¿à´®à´§àµà´°à´‚', 30, 0),
(44, 'à´•à´²à´‚à´•à´°à´¿à´•àµà´•à´²àµâ€', 10, 0),
(45, 'à´¤àµà´²à´¾à´­à´¾à´°à´‚', 20, 0),
(46, 'à´­à´°à´£à´¿à´Šà´Ÿàµà´Ÿàµ', 250, 0),
(47, 'à´®à´§àµà´ªàµ‚à´œ', 250, 0),
(48, 'à´µà´²à´¿à´¯à´—àµà´°àµà´¤à´¿', 5500, 0);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE IF NOT EXISTS `report` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `report_head` varchar(250) NOT NULL,
  `lhs` tinyint(1) NOT NULL DEFAULT '2',
  `rhs` tinyint(1) NOT NULL DEFAULT '2',
  `lhs_head` varchar(125) NOT NULL,
  `rhs_head` varchar(125) NOT NULL,
  `header` text NOT NULL,
  `footer` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 for active,2 for inactive',
  PRIMARY KEY (`report_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`report_id`, `report_head`, `lhs`, `rhs`, `lhs_head`, `rhs_head`, `header`, `footer`, `status`) VALUES
(1, 'à´µà´°à´µàµ', 1, 2, 'Particulars', '', '', '', 1),
(2, 'à´šàµ†à´²à´µàµ', 1, 2, 'Particulars', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `report_feature`
--

CREATE TABLE IF NOT EXISTS `report_feature` (
  `feature_id` int(11) NOT NULL AUTO_INCREMENT,
  `report_id` int(11) NOT NULL,
  `ledger_master_id` int(11) NOT NULL COMMENT 'master ledger id',
  `sub_ledgers` varchar(125) NOT NULL,
  `position` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 for LHS ,2 for RHS',
  `sort_order` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 for active, 2 for inactive',
  PRIMARY KEY (`feature_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `report_feature`
--

INSERT INTO `report_feature` (`feature_id`, `report_id`, `ledger_master_id`, `sub_ledgers`, `position`, `sort_order`, `status`) VALUES
(1, 1, 11, '1,3,4,5,6,7,8,9,10', 1, 1, 1),
(2, 2, 10, '13,14,15,16,17,18,19,20', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stars`
--

CREATE TABLE IF NOT EXISTS `stars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `stars`
--

INSERT INTO `stars` (`id`, `name`, `status_id`) VALUES
(1, 'à´…à´¶àµà´µà´¤à´¿', 0),
(2, 'à´­à´°à´£à´¿', 0),
(3, 'à´•à´¾à´°àµâ€à´¤àµà´¤à´¿à´•', 0),
(4, 'à´°àµ‹à´¹à´¿à´£à´¿', 0),
(5, 'à´®à´•à´¯à´¿à´°à´‚', 0),
(6, 'à´¤à´¿à´°àµà´µà´¾à´¤à´¿à´°', 0),
(7, 'à´ªàµà´£à´°àµâ€à´¤à´‚', 0),
(8, 'à´ªàµ‚à´¯à´‚', 0),
(9, 'à´†à´¯à´¿à´²àµà´¯à´‚', 0),
(10, 'à´®à´•à´‚', 0),
(12, 'à´‰à´¤àµà´°à´‚', 0),
(13, 'à´…à´¤àµà´¤à´‚', 0),
(14, 'à´šà´¿à´¤àµà´¤à´¿à´°', 0),
(15, 'à´šàµ‹à´¤à´¿', 0),
(16, 'à´µà´¿à´¶à´¾à´–à´‚', 0),
(17, 'à´…à´¨à´¿à´´à´‚', 0),
(18, 'à´¤àµƒà´•àµà´•àµ‡à´Ÿàµà´Ÿ', 0),
(19, 'à´®àµ‚à´²à´‚', 0),
(20, 'à´ªàµ‚à´°à´¾à´Ÿà´‚', 0),
(21, 'à´‰à´¤àµà´°à´¾à´Ÿà´‚', 0),
(22, 'à´¤à´¿à´°àµà´µàµ‹à´£à´‚', 0),
(23, 'à´…à´µà´¿à´Ÿàµà´Ÿà´‚', 0),
(24, 'à´šà´¤à´¯à´‚', 0),
(25, 'à´ªàµ‚à´°àµà´Ÿàµà´Ÿà´¾à´¤à´¿', 0),
(26, 'à´‰à´¤àµà´°à´Ÿàµà´Ÿà´¾à´¤à´¿', 0),
(27, 'à´°àµ‡à´µà´¤à´¿', 0),
(29, 'à´ªàµ‚à´¯à´¿à´²àµà´¯à´‚', 0);

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE IF NOT EXISTS `statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`) VALUES
(1, 'Active'),
(2, 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `stock_master`
--

CREATE TABLE IF NOT EXISTS `stock_master` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(250) NOT NULL,
  `uom_id` int(11) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '1' COMMENT '2 for deleted,1 not deleted',
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `stock_register`
--

CREATE TABLE IF NOT EXISTS `stock_register` (
  `stk_id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher_number` varchar(125) NOT NULL,
  `voucher_type_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_rate` double(25,2) NOT NULL,
  `input_type` varchar(50) NOT NULL COMMENT 'purchase or donation(+) and auction or delivery(-)',
  `purchase_reference_number` varchar(125) NOT NULL,
  `date` date NOT NULL,
  `tax_id` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`stk_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(125) NOT NULL,
  `supplier_address` text NOT NULL,
  `supplier_phone` varchar(15) NOT NULL,
  `contact_person` varchar(125) NOT NULL,
  `contact_mobile` varchar(15) NOT NULL,
  `contact_email` varchar(15) NOT NULL,
  `supplier_fax` varchar(15) NOT NULL,
  `supplier_cst_number` varchar(50) NOT NULL,
  `supplier_tin_number` varchar(50) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '1' COMMENT '2 for deleted,1 not deleted',
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `uom_master`
--

CREATE TABLE IF NOT EXISTS `uom_master` (
  `uom_id` int(11) NOT NULL AUTO_INCREMENT,
  `uom_value` varchar(125) NOT NULL,
  PRIMARY KEY (`uom_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `uom_master`
--

INSERT INTO `uom_master` (`uom_id`, `uom_value`) VALUES
(1, 'Kilo Gram'),
(2, 'Gram'),
(3, 'Litre'),
(4, 'Piece');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `occupation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_status_id` int(11) DEFAULT NULL,
  `organization_id` int(11) DEFAULT NULL,
  `registration_date` datetime DEFAULT NULL,
  `activation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_status_id` (`user_status_id`),
  KEY `organization_id` (`organization_id`),
  KEY `user_type_id` (`user_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_statuses`
--

CREATE TABLE IF NOT EXISTS `user_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user_statuses`
--

INSERT INTO `user_statuses` (`id`, `name`, `description`) VALUES
(1, 'Active', 'Active'),
(2, 'Waiting Email Activation', 'Email activation required'),
(3, 'Suspended', 'Suspended'),
(4, 'Disabled', 'Disabled');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE IF NOT EXISTS `user_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `name`) VALUES
(1, 'COUNTER'),
(2, 'FINANCE');

-- --------------------------------------------------------

--
-- Table structure for table `vazhipadu`
--

CREATE TABLE IF NOT EXISTS `vazhipadu` (
  `vazhipadu_id` int(11) NOT NULL AUTO_INCREMENT,
  `vazhipadu_rpt_number` varchar(125) NOT NULL,
  `vazhipadu_date` date NOT NULL,
  `star_id` int(11) NOT NULL,
  `pooja_id` int(11) NOT NULL,
  `name` varchar(125) NOT NULL,
  `age` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` double(25,2) NOT NULL,
  PRIMARY KEY (`vazhipadu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `vazhipadu`
--

INSERT INTO `vazhipadu` (`vazhipadu_id`, `vazhipadu_rpt_number`, `vazhipadu_date`, `star_id`, `pooja_id`, `name`, `age`, `quantity`, `amount`) VALUES
(1, '001', '2014-03-13', 4, 2, 'Ramakrishnan', 34, 1, 10.00),
(2, '002', '2014-03-13', 3, 5, 'Raghu', 45, 1, 20.00),
(3, '002', '2014-03-13', 5, 5, 'Sumi', 38, 1, 20.00),
(4, '003', '2014-03-13', 13, 18, 'Siva', 28, 1, 30.00),
(5, '003', '2014-03-13', 15, 18, 'Kannan', 31, 1, 30.00),
(6, '004', '2014-03-13', 3, 21, 'Lakshmi', 25, 1, 200.00),
(7, '004', '2014-03-13', 1, 21, 'Meera', 12, 1, 200.00),
(8, '005', '2014-03-13', 7, 36, 'Radha', 25, 1, 500.00),
(9, '005', '2014-03-13', 9, 36, 'Neeli', 26, 1, 500.00),
(10, '005', '2014-03-13', 6, 36, 'Sandhya', 28, 1, 500.00),
(11, '005', '2014-03-13', 22, 36, 'Pooja', 31, 1, 500.00),
(12, '006', '2014-03-13', 25, 16, 'Manu kumar', 10, 1, 12.00),
(13, '007', '2014-03-13', 24, 29, 'Keshavan', 1, 1, 50.00),
(14, '008', '2014-03-13', 19, 43, 'Madhavan', 50, 1, 30.00),
(15, '009', '2014-03-14', 27, 31, 'Raghavan', 18, 1, 100.00),
(16, '010', '2014-03-13', 4, 30, 'Jayakumar', 31, 1, 250.00),
(17, '010', '2014-03-13', 23, 30, 'Veni P Kumar', 28, 1, 250.00);

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE IF NOT EXISTS `voucher` (
  `voucher_id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher_name` varchar(250) NOT NULL,
  `voucher_description` text NOT NULL,
  `fy_id` int(11) NOT NULL,
  `voucher_master_id` int(11) NOT NULL,
  `header` text,
  `footer` text,
  `number_series` varchar(20) NOT NULL,
  `series_prefix` varchar(10) NOT NULL,
  `series_sufix` varchar(10) NOT NULL,
  `series_start` varchar(50) NOT NULL,
  `series_seperator` varchar(5) NOT NULL,
  `default_from` varchar(50) NOT NULL,
  `default_to` varchar(50) NOT NULL,
  `form_type_id` int(11) NOT NULL,
  `source` tinyint(4) NOT NULL COMMENT '1-voucher for ac and 2-voucher for inventory',
  `hidden` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 show,2hidden',
  `module_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`voucher_id`),
  UNIQUE KEY `module_id` (`module_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`voucher_id`, `voucher_name`, `voucher_description`, `fy_id`, `voucher_master_id`, `header`, `footer`, `number_series`, `series_prefix`, `series_sufix`, `series_start`, `series_seperator`, `default_from`, `default_to`, `form_type_id`, `source`, `hidden`, `module_id`) VALUES
(1, 'Vazhipadu', '', 1, 2, '', '', '001', '', '', '001', '', '1', '12', -1, -1, 2, 1),
(2, 'Cash Receipt', '', 1, 2, '', '', '001', '', '', '001', '', '', 'a:1:{i:0;s:2:"12";}', -1, 1, 1, NULL),
(3, 'Sale', '', 1, 13, '', '', '001', '', '', '001', '', '', 'a:1:{i:0;s:2:"12";}', -1, 2, 1, NULL),
(4, 'Cash Payment', '', 1, 1, '', '', '001', '', '', '001', '', 'a:1:{i:0;s:2:"12";}', '', -1, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `voucher_master`
--

CREATE TABLE IF NOT EXISTS `voucher_master` (
  `voucher_master_id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher_master_name` varchar(250) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1 for active ,2 for inactive',
  PRIMARY KEY (`voucher_master_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `voucher_master`
--

INSERT INTO `voucher_master` (`voucher_master_id`, `voucher_master_name`, `status`) VALUES
(1, 'Cash Payment', 1),
(2, 'Cash Receipt', 1),
(3, 'Cash Receipt Note', 2),
(4, 'Bank Receipt', 1),
(5, 'Bank Payment', 1),
(6, 'Sales Return', 2),
(7, 'Purchase Return', 2),
(8, 'Stock IN', 2),
(9, 'Delivery Note', 1),
(10, 'Receipt Note', 1),
(11, 'Journel', 2),
(12, 'Stock Out', 2),
(13, 'Sales', 1),
(14, 'Purchase', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
