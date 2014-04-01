-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 01, 2014 at 06:22 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=209 ;

--
-- Dumping data for table `account_master`
--

INSERT INTO `account_master` (`account_id`, `voucher_number`, `voucher_type_id`, `fy_id`, `reference_number`, `account_from`, `account_to`, `account_debit`, `account_credit`, `date`, `narration`, `ref_ledger`, `deleted`) VALUES
(5, '0001', 8, 1, '', 3, 2, 130521.00, 0.00, '2014-03-22', '', 3, 1),
(6, '0001', 8, 1, '', 3, 2, 0.00, 130521.00, '2014-03-22', '', 2, 1),
(7, '0001', 9, 1, '', 1, 3, 162204.00, 0.00, '2014-03-22', '', 1, 1),
(8, '0001', 9, 1, '', 1, 3, 0.00, 162204.00, '2014-03-22', '', 3, 1),
(9, '0002', 8, 1, '', 3, 4, 21385.00, 0.00, '2014-03-22', '', 3, 1),
(10, '0002', 8, 1, '', 3, 4, 0.00, 21385.00, '2014-03-22', '', 4, 1),
(11, '0003', 8, 1, '', 3, 5, 11635.00, 0.00, '2014-03-22', '', 3, 1),
(12, '0003', 8, 1, '', 3, 5, 0.00, 11635.00, '2014-03-22', '', 5, 1),
(13, '0004', 8, 1, '', 3, 6, 19785.00, 0.00, '2014-03-22', '', 3, 1),
(14, '0004', 8, 1, '', 3, 6, 0.00, 19785.00, '2014-03-22', '', 6, 1),
(15, '0005', 8, 1, '', 3, 7, 20925.00, 0.00, '2014-03-22', '', 3, 1),
(16, '0005', 8, 1, '', 3, 7, 0.00, 20925.00, '2014-03-22', '', 7, 1),
(17, '0006', 8, 1, '', 3, 8, 2325.00, 0.00, '2014-03-22', '', 3, 1),
(18, '0006', 8, 1, '', 3, 8, 0.00, 2325.00, '2014-03-22', '', 8, 1),
(19, '0007', 8, 1, '', 3, 9, 3160.00, 0.00, '2014-03-22', '', 3, 1),
(20, '0007', 8, 1, '', 3, 9, 0.00, 3160.00, '2014-03-22', '', 9, 1),
(21, '0008', 8, 1, '', 3, 10, 5100.00, 0.00, '2014-03-22', '', 3, 1),
(22, '0008', 8, 1, '', 3, 10, 0.00, 5100.00, '2014-03-22', '', 10, 1),
(23, '0009', 8, 1, '', 3, 11, 3200.00, 0.00, '2014-03-22', '', 3, 1),
(24, '0009', 8, 1, '', 3, 11, 0.00, 3200.00, '2014-03-22', '', 11, 1),
(25, '0010', 8, 1, '', 3, 12, 15375.00, 0.00, '2014-03-22', '', 3, 2),
(26, '0010', 8, 1, '', 3, 12, 0.00, 15375.00, '2014-03-22', '', 12, 2),
(27, '0011', 8, 1, '', 3, 13, 555.00, 0.00, '2014-03-22', '', 3, 1),
(28, '0011', 8, 1, '', 3, 13, 0.00, 555.00, '2014-03-22', '', 13, 1),
(29, '0012', 8, 1, '', 3, 14, 400.00, 0.00, '2014-03-22', '', 3, 1),
(30, '0012', 8, 1, '', 3, 14, 0.00, 400.00, '2014-03-22', '', 14, 1),
(31, '0013', 8, 1, '', 3, 15, 435.00, 0.00, '2014-03-22', '', 3, 1),
(32, '0013', 8, 1, '', 3, 15, 0.00, 435.00, '2014-03-22', '', 15, 1),
(33, '0014', 8, 1, '', 3, 16, 325.00, 0.00, '2014-03-22', '', 3, 1),
(34, '0014', 8, 1, '', 3, 16, 0.00, 325.00, '2014-03-22', '', 16, 1),
(35, '0015', 8, 1, '', 3, 17, 518.00, 0.00, '2014-03-22', '', 3, 1),
(36, '0015', 8, 1, '', 3, 17, 0.00, 518.00, '2014-03-22', '', 17, 1),
(37, '0016', 8, 1, '', 3, 18, 5550.00, 0.00, '2014-03-22', '', 3, 1),
(38, '0016', 8, 1, '', 3, 18, 0.00, 5550.00, '2014-03-22', '', 18, 1),
(39, '0017', 8, 1, '', 3, 19, 1004.00, 0.00, '2014-03-22', '', 3, 1),
(40, '0017', 8, 1, '', 3, 19, 0.00, 1004.00, '2014-03-22', '', 19, 1),
(41, '0018', 8, 1, '', 3, 20, 1160.00, 0.00, '2014-03-22', '', 3, 1),
(42, '0018', 8, 1, '', 3, 20, 0.00, 1160.00, '2014-03-22', '', 20, 1),
(43, '0019', 8, 1, '', 3, 21, 22500.00, 0.00, '2014-03-22', '', 3, 1),
(44, '0019', 8, 1, '', 3, 21, 0.00, 22500.00, '2014-03-22', '', 21, 1),
(45, '0020', 8, 1, '', 3, 22, 150.00, 0.00, '2014-03-22', '', 3, 1),
(46, '0020', 8, 1, '', 3, 22, 0.00, 150.00, '2014-03-22', '', 22, 1),
(47, '0021', 8, 1, '', 3, 23, 1900.00, 0.00, '2014-03-22', '', 3, 1),
(48, '0021', 8, 1, '', 3, 23, 0.00, 1900.00, '2014-03-22', '', 23, 1),
(49, '0022', 8, 1, '', 3, 24, 18600.00, 0.00, '2014-03-22', '', 3, 1),
(50, '0022', 8, 1, '', 3, 24, 0.00, 18600.00, '2014-03-22', '', 24, 1),
(51, '0023', 8, 1, '', 3, 25, 1900.00, 0.00, '2014-03-22', '', 3, 1),
(52, '0023', 8, 1, '', 3, 25, 0.00, 1900.00, '2014-03-22', '', 25, 1),
(53, '0024', 8, 1, '', 3, 26, 6360.00, 0.00, '2014-03-22', '', 3, 1),
(54, '0024', 8, 1, '', 3, 26, 0.00, 6360.00, '2014-03-22', '', 26, 1),
(55, '0025', 8, 1, '', 3, 27, 455.00, 0.00, '2014-03-22', '', 3, 1),
(56, '0025', 8, 1, '', 3, 27, 0.00, 455.00, '2014-03-22', '', 27, 1),
(57, '0026', 8, 1, '', 3, 28, 1000.00, 0.00, '2014-03-22', '', 3, 1),
(58, '0026', 8, 1, '', 3, 28, 0.00, 1000.00, '2014-03-22', '', 28, 1),
(59, '0001', 10, 1, '', 29, 3, 296223.00, 0.00, '2014-03-22', '', 29, 1),
(60, '0001', 10, 1, '', 29, 3, 0.00, 296223.00, '2014-03-22', '', 3, 1),
(63, '0002', 9, 1, '', 32, 3, 5000.00, 0.00, '2014-03-24', 'Salary for the month of March 2014', 32, 1),
(64, '0002', 9, 1, '', 32, 3, 0.00, 5000.00, '2014-03-24', 'Salary for the month of March 2014', 3, 1),
(73, '0003', 9, 1, '', 38, 3, 4000.00, 0.00, '2014-03-24', 'Salary', 38, 1),
(74, '0003', 9, 1, '', 38, 3, 0.00, 4000.00, '2014-03-24', 'Salary', 3, 1),
(75, '', -1, 1, '', 40, 0, 0.00, 1000.00, '2014-03-24', '', 40, 1),
(76, '', -1, 1, '', 41, 0, 0.00, 1000.00, '2014-03-24', '', 41, 1),
(77, '', 0, 1, '', 42, 0, 0.00, 1000.00, '2014-03-24', '', 42, 1),
(78, '', -1, 1, '', 0, 43, 0.00, 1000.00, '2014-03-24', '', 43, 1),
(79, '', -1, 1, '', 44, 0, 1000.00, 0.00, '2014-03-24', '', 44, 1),
(80, '', -1, 1, '', 0, 45, 0.00, 1000.00, '1970-01-01', '', 45, 1),
(81, '', -1, 1, '', 46, 0, 1000.00, 0.00, '2013-04-01', '', 46, 1),
(82, '0001', 14, 1, '', 3, 62, 10000.00, 0.00, '2014-03-25', '', 3, 1),
(83, '0001', 14, 1, '', 3, 62, 0.00, 10000.00, '2014-03-25', '', 62, 1),
(84, '0001', 13, 1, '', 3, 61, 1000.00, 0.00, '2014-03-25', '', 3, 1),
(85, '0001', 13, 1, '', 3, 61, 0.00, 1000.00, '2014-03-25', '', 61, 1),
(86, '0002', 13, 1, '', 3, 61, 1050.00, 0.00, '2014-03-25', '', 3, 1),
(87, '0002', 13, 1, '', 3, 61, 0.00, 1050.00, '2014-03-25', '', 61, 1),
(88, '0002', 14, 1, '', 3, 62, 10500.00, 0.00, '2014-03-25', '', 3, 1),
(89, '0002', 14, 1, '', 3, 62, 0.00, 10500.00, '2014-03-25', '', 62, 1),
(90, '0003', 13, 1, '', 3, 61, 1500.00, 0.00, '2014-03-25', '', 3, 1),
(91, '0003', 13, 1, '', 3, 61, 0.00, 1500.00, '2014-03-25', '', 61, 1),
(113, '0001', 1, 1, '', 3, 37, 400.00, 0.00, '2014-03-27', '', 3, 1),
(114, '0001', 1, 1, '', 3, 37, 0.00, 400.00, '2014-03-27', '', 37, 1),
(115, '0002', 1, 1, '', 3, 36, 5.00, 0.00, '2014-03-27', '', 3, 1),
(116, '0002', 1, 1, '', 3, 36, 0.00, 5.00, '2014-03-27', '', 36, 1),
(117, '0027', 8, 1, '', 3, 31, 1000.00, 0.00, '2014-03-27', 'Salary for the month of March', 3, 1),
(118, '0027', 8, 1, '', 3, 31, 0.00, 1000.00, '2014-03-27', 'Salary for the month of March', 31, 1),
(119, '0003', 1, 1, '', 3, 69, 234.00, 0.00, '2014-03-27', '', 3, 1),
(120, '0003', 1, 1, '', 3, 69, 0.00, 234.00, '2014-03-27', '', 69, 1),
(121, '0028', 8, 1, '', 3, 38, 555.00, 0.00, '2014-03-27', '', 3, 1),
(122, '0028', 8, 1, '', 3, 38, 0.00, 555.00, '2014-03-27', '', 38, 1),
(123, '0029', 8, 1, '', 3, 41, 111.00, 0.00, '2014-03-27', '', 3, 1),
(124, '0029', 8, 1, '', 3, 41, 0.00, 111.00, '2014-03-27', '', 41, 1),
(125, '0004', 9, 1, '', 42, 3, 3000.00, 0.00, '2014-03-27', '', 42, 1),
(126, '0004', 9, 1, '', 42, 3, 0.00, 3000.00, '2014-03-27', '', 3, 1),
(127, '0004', 1, 1, '', 3, 37, 200.00, 0.00, '2014-03-27', '', 3, 1),
(128, '0004', 1, 1, '', 3, 37, 0.00, 200.00, '2014-03-27', '', 37, 1),
(129, '0030', 8, 1, '', 3, 38, 5000.00, 0.00, '2014-03-27', 'Salary', 3, 1),
(130, '0030', 8, 1, '', 3, 38, 0.00, 5000.00, '2014-03-27', 'Salary', 38, 1),
(131, '0003', 14, 1, '', 3, 62, 100.00, 0.00, '2014-03-27', '', 3, 1),
(132, '0003', 14, 1, '', 3, 62, 0.00, 100.00, '2014-03-27', '', 62, 1),
(133, '0004', 13, 1, '', 3, 61, 1145.00, 0.00, '2014-03-27', '', 3, 1),
(134, '0004', 13, 1, '', 3, 61, 0.00, 1145.00, '2014-03-27', '', 61, 1),
(135, '0031', 8, 1, '', 3, 45, 1000.00, 0.00, '2014-03-27', '', 3, 1),
(136, '0031', 8, 1, '', 3, 45, 0.00, 1000.00, '2014-03-27', '', 45, 1),
(137, '0032', 8, 1, '', 3, 41, 50.00, 0.00, '2014-03-27', 'sdf', 3, 1),
(138, '0032', 8, 1, '', 3, 41, 0.00, 50.00, '2014-03-27', 'sdf', 41, 1),
(139, '0005', 1, 1, '', 3, 37, 200.00, 0.00, '2014-03-28', '', 3, 1),
(140, '0005', 1, 1, '', 3, 37, 0.00, 200.00, '2014-03-28', '', 37, 1),
(141, '0033', 8, 1, '', 3, 42, 150.00, 0.00, '2014-03-28', '', 3, 1),
(142, '0033', 8, 1, '', 3, 42, 0.00, 150.00, '2014-03-28', '', 42, 1),
(143, '0006', 1, 1, '', 3, 37, 800.00, 0.00, '2014-03-28', '', 3, 1),
(144, '0006', 1, 1, '', 3, 37, 0.00, 800.00, '2014-03-28', '', 37, 1),
(145, '0007', 1, 1, '', 3, 36, 20.00, 0.00, '2014-03-28', '', 3, 1),
(146, '0007', 1, 1, '', 3, 36, 0.00, 20.00, '2014-03-28', '', 36, 1),
(147, '0008', 1, 1, '', 3, 37, 400.00, 0.00, '2014-03-28', '', 3, 1),
(148, '0008', 1, 1, '', 3, 37, 0.00, 400.00, '2014-03-28', '', 37, 1),
(149, '0009', 1, 1, '', 3, 36, 20.00, 0.00, '2014-03-28', '', 3, 1),
(150, '0009', 1, 1, '', 3, 36, 0.00, 20.00, '2014-03-28', '', 36, 1),
(151, '0010', 1, 1, '', 3, 36, 5.00, 0.00, '2014-03-29', '', 3, 1),
(152, '0010', 1, 1, '', 3, 36, 0.00, 5.00, '2014-03-29', '', 36, 1),
(153, '0011', 1, 1, '', 3, 36, 5.00, 0.00, '2014-03-29', '', 3, 1),
(154, '0011', 1, 1, '', 3, 36, 0.00, 5.00, '2014-03-29', '', 36, 1),
(155, '0012', 1, 1, '', 3, 36, 5.00, 0.00, '2014-03-29', '', 3, 1),
(156, '0012', 1, 1, '', 3, 36, 0.00, 5.00, '2014-03-29', '', 36, 1),
(157, '0013', 1, 1, '', 3, 36, 5.00, 0.00, '2014-03-29', '', 3, 1),
(158, '0013', 1, 1, '', 3, 36, 0.00, 5.00, '2014-03-29', '', 36, 1),
(159, '0014', 1, 1, '', 3, 36, 5.00, 0.00, '2014-03-29', '', 3, 1),
(160, '0014', 1, 1, '', 3, 36, 0.00, 5.00, '2014-03-29', '', 36, 1),
(161, '0015', 1, 1, '', 3, 36, 5.00, 0.00, '2014-03-29', '', 3, 1),
(162, '0015', 1, 1, '', 3, 36, 0.00, 5.00, '2014-03-29', '', 36, 1),
(163, '0016', 1, 1, '', 3, 36, 5.00, 0.00, '2014-03-29', '', 3, 1),
(164, '0016', 1, 1, '', 3, 36, 0.00, 5.00, '2014-03-29', '', 36, 1),
(165, '0017', 1, 1, '', 3, 37, 200.00, 0.00, '2014-03-29', '', 3, 1),
(166, '0017', 1, 1, '', 3, 37, 0.00, 200.00, '2014-03-29', '', 37, 1),
(167, '0018', 1, 1, '', 3, 36, 5.00, 0.00, '2014-03-29', '', 3, 1),
(168, '0018', 1, 1, '', 3, 36, 0.00, 5.00, '2014-03-29', '', 36, 1),
(169, '0019', 1, 1, '', 3, 37, 400.00, 0.00, '2014-03-31', '', 3, 1),
(170, '0019', 1, 1, '', 3, 37, 0.00, 400.00, '2014-03-31', '', 37, 1),
(171, '0020', 1, 1, '', 3, 36, 20.00, 0.00, '2014-03-31', '', 3, 1),
(172, '0020', 1, 1, '', 3, 36, 0.00, 20.00, '2014-03-31', '', 36, 1),
(173, '0021', 1, 1, '', 3, 37, 200.00, 0.00, '2014-03-31', '', 3, 1),
(174, '0021', 1, 1, '', 3, 37, 0.00, 200.00, '2014-03-31', '', 37, 1),
(175, '0022', 1, 1, '', 3, 37, 200.00, 0.00, '2014-03-31', '', 3, 1),
(176, '0022', 1, 1, '', 3, 37, 0.00, 200.00, '2014-03-31', '', 37, 1),
(177, '0023', 1, 1, '', 3, 36, 5.00, 0.00, '2014-03-31', '', 3, 1),
(178, '0023', 1, 1, '', 3, 36, 0.00, 5.00, '2014-03-31', '', 36, 1),
(179, '0024', 1, 1, '', 3, 37, 200.00, 0.00, '2014-03-31', '', 3, 1),
(180, '0024', 1, 1, '', 3, 37, 0.00, 200.00, '2014-03-31', '', 37, 1),
(181, '0025', 1, 1, '', 3, 37, 200.00, 0.00, '2014-03-31', '', 3, 1),
(182, '0025', 1, 1, '', 3, 37, 0.00, 200.00, '2014-03-31', '', 37, 1),
(183, '0026', 1, 1, '', 3, 37, 200.00, 0.00, '2014-03-31', '', 3, 1),
(184, '0026', 1, 1, '', 3, 37, 0.00, 200.00, '2014-03-31', '', 37, 1),
(185, '0027', 1, 1, '', 3, 37, 200.00, 0.00, '2014-03-31', '', 3, 1),
(186, '0027', 1, 1, '', 3, 37, 0.00, 200.00, '2014-03-31', '', 37, 1),
(187, '0028', 1, 1, '', 3, 37, 200.00, 0.00, '2014-03-31', '', 3, 1),
(188, '0028', 1, 1, '', 3, 37, 0.00, 200.00, '2014-03-31', '', 37, 1),
(189, '0029', 1, 1, '', 3, 69, 234.00, 0.00, '2014-03-31', '', 3, 1),
(190, '0029', 1, 1, '', 3, 69, 0.00, 234.00, '2014-03-31', '', 69, 1),
(191, '0030', 1, 1, '', 3, 36, 5.00, 0.00, '2014-03-31', '', 3, 1),
(192, '0030', 1, 1, '', 3, 36, 0.00, 5.00, '2014-03-31', '', 36, 1),
(193, '0031', 1, 1, '', 3, 37, 200.00, 0.00, '2014-03-31', '', 3, 1),
(194, '0031', 1, 1, '', 3, 37, 0.00, 200.00, '2014-03-31', '', 37, 1),
(195, '0032', 1, 1, '', 3, 37, 200.00, 0.00, '2014-03-31', '', 3, 1),
(196, '0032', 1, 1, '', 3, 37, 0.00, 200.00, '2014-03-31', '', 37, 1),
(197, '0033', 1, 1, '', 3, 36, 5.00, 0.00, '2014-03-31', '', 3, 1),
(198, '0033', 1, 1, '', 3, 36, 0.00, 5.00, '2014-03-31', '', 36, 1),
(199, '0005', 13, 1, '', 3, 61, 113.50, 0.00, '2014-03-31', '', 3, 1),
(200, '0005', 13, 1, '', 3, 61, 0.00, 113.50, '2014-03-31', '', 61, 1),
(201, '0006', 13, 1, '', 3, 61, 113.50, 0.00, '2014-03-31', '', 3, 1),
(202, '0006', 13, 1, '', 3, 61, 0.00, 113.50, '2014-03-31', '', 61, 1),
(203, '0007', 13, 1, '', 3, 61, 10.00, 0.00, '2014-03-31', '', 3, 1),
(204, '0007', 13, 1, '', 3, 61, 0.00, 10.00, '2014-03-31', '', 61, 1),
(205, '0008', 13, 1, '', 3, 61, 15.00, 0.00, '2014-03-31', '', 3, 1),
(206, '0008', 13, 1, '', 3, 61, 0.00, 15.00, '2014-03-31', '', 61, 1),
(207, '0009', 13, 1, '', 3, 61, 17.00, 0.00, '2014-03-31', '', 3, 1),
(208, '0009', 13, 1, '', 3, 61, 0.00, 17.00, '2014-03-31', '', 61, 1);

-- --------------------------------------------------------

--
-- Table structure for table `account_settings`
--

CREATE TABLE IF NOT EXISTS `account_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `current_fy_id` int(11) NOT NULL,
  `default_capital` int(11) DEFAULT NULL,
  `organization_name` text,
  `organization_address` text,
  `tax_payers_id_no` text,
  `central_sales_tax_reg_no` text,
  `central_exise_reg_no` text,
  `reg_no` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `account_settings`
--

INSERT INTO `account_settings` (`id`, `current_fy_id`, `default_capital`, `organization_name`, `organization_address`, `tax_payers_id_no`, `central_sales_tax_reg_no`, `central_exise_reg_no`, `reg_no`) VALUES
(1, 1, 66, 'Sree Hariharasudha Ayyapa Temple', 'Ernakulam', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ac_books`
--

CREATE TABLE IF NOT EXISTS `ac_books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(125) NOT NULL,
  `ledgers` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ac_books`
--

INSERT INTO `ac_books` (`id`, `name`, `ledgers`) VALUES
(1, 'Bank Book', 'a:1:{i:0;s:2:"29";}'),
(2, 'Cash Book', 'a:1:{i:0;s:1:"3";}'),
(3, 'Day Book', 'a:2:{i:0;s:1:"1";i:1;s:1:"3";}');

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
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'rosy.swapna@acube.co', NULL, '2014-03-22 12:00:53', NULL, NULL, NULL, '2013-04-22 00:00:00', NULL, NULL);

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
  `ledger_sub_id` int(11) NOT NULL DEFAULT '-1',
  `deleted` tinyint(1) NOT NULL DEFAULT '1' COMMENT '2 for deleted,1 not deleted',
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_address`, `customer_phone`, `customer_mobile`, `customer_fax`, `customer_email`, `customer_cst_number`, `customer_tin_number`, `ledger_sub_id`, `deleted`) VALUES
(1, 'Ravi varma', 'sdafsdf', '', '12345645', '', 'rosy.swapna@acube.co', '', '', 1, 1),
(2, 'Sagar', 'fgdfg', '5345645', '546456', '', 'rosy.swapna@gmail.com', '', '', 67, 1);

-- --------------------------------------------------------

--
-- Table structure for table `form_type`
--

CREATE TABLE IF NOT EXISTS `form_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(15) NOT NULL,
  `form_variables` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `form_type`
--

INSERT INTO `form_type` (`id`, `value`, `form_variables`) VALUES
(1, 'Form8', 'a:15:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"4";i:3;s:1:"5";i:4;s:1:"6";i:5;s:1:"7";i:6;s:1:"8";i:7;s:1:"9";i:8;s:2:"10";i:9;s:2:"11";i:10;s:2:"12";i:11;s:2:"13";i:12;s:2:"14";i:13;s:2:"15";i:14;s:2:"16";}'),
(2, 'Form8B', 'a:11:{i:0;s:1:"1";i:1;s:1:"3";i:2;s:1:"4";i:3;s:1:"6";i:4;s:1:"7";i:5;s:1:"8";i:6;s:2:"11";i:7;s:2:"12";i:8;s:2:"13";i:9;s:2:"14";i:10;s:2:"15";}');

-- --------------------------------------------------------

--
-- Table structure for table `form_variables`
--

CREATE TABLE IF NOT EXISTS `form_variables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `form_variables`
--

INSERT INTO `form_variables` (`id`, `description`) VALUES
(1, 'SlNo'),
(2, 'Schl with entry No.'),
(3, 'Commodity Code'),
(4, 'Commodity'),
(5, 'HSN Code'),
(6, 'Rate of Tax'),
(7, 'Unit Price'),
(8, 'Qty'),
(9, 'Value'),
(10, 'Excise Duty'),
(11, 'Gross Value'),
(12, 'Cash discount'),
(13, 'Net Taxable Value'),
(14, 'Tax in %'),
(15, 'Total'),
(16, 'Qty discount/gifts free etc.');

-- --------------------------------------------------------

--
-- Table structure for table `fy_ledger_sub`
--

CREATE TABLE IF NOT EXISTS `fy_ledger_sub` (
  `fy_id` int(11) NOT NULL,
  `ledger_sub_id` int(11) NOT NULL,
  KEY `fy_id` (`fy_id`,`ledger_sub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fy_ledger_sub`
--

INSERT INTO `fy_ledger_sub` (`fy_id`, `ledger_sub_id`) VALUES
(-1, 63),
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 36),
(1, 37),
(1, 38),
(1, 39),
(1, 40),
(1, 41),
(1, 42),
(1, 43),
(1, 44),
(1, 45),
(1, 46),
(1, 51),
(1, 60),
(1, 61),
(1, 62),
(1, 64),
(1, 66),
(1, 67),
(1, 68),
(1, 69),
(1, 71),
(1, 72),
(1, 73),
(1, 74),
(1, 75),
(1, 76),
(1, 77),
(1, 78),
(1, 79),
(2, 12);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `fy_master`
--

INSERT INTO `fy_master` (`fy_id`, `fy_name`, `fy_start`, `fy_end`, `status`) VALUES
(1, '2013-2014', '2013-04-01', '2014-03-31', 1),
(2, '2014-2015', '2014-04-01', '2015-03-31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ledger_master`
--

CREATE TABLE IF NOT EXISTS `ledger_master` (
  `ledger_id` int(11) NOT NULL AUTO_INCREMENT,
  `ledger_name` varchar(100) NOT NULL,
  PRIMARY KEY (`ledger_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=95 ;

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
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 for active, 2 for inactive',
  `deleted` tinyint(4) NOT NULL DEFAULT '1' COMMENT '2 for deleted,1 not deleted',
  PRIMARY KEY (`ledger_sub_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=80 ;

--
-- Dumping data for table `ledger_sub`
--

INSERT INTO `ledger_sub` (`ledger_sub_id`, `ledger_sub_name`, `ledger_id`, `parent_sub_ledger_id`, `fy_id`, `status`, `deleted`) VALUES
(2, 'വഴിപാട്', 11, -1, 1, 1, 1),
(3, 'Cash', 6, -1, 1, 1, 1),
(4, 'പുഷ്പാഞ്ജലി', 11, -1, 1, 1, 1),
(5, 'എണ്ണ', 11, -1, 1, 1, 1),
(6, 'എള്ളുതിരി', 11, -1, 1, 1, 1),
(7, 'നീരാന്ജനം', 11, -1, 1, 1, 1),
(8, 'വെറ്റില മാല', 11, -1, 1, 1, 1),
(9, 'നെയ്യ് വിളക്ക്', 11, -1, 1, 1, 1),
(10, 'ബാഗ്യസൂക്തം', 11, -1, 1, 1, 1),
(11, 'മൃത്യുംജ്ജയം', 11, -1, 1, 1, 1),
(12, 'വട മാല', 11, -1, 2, 1, 1),
(13, 'പനിനീര്‍', 11, -1, 1, 1, 1),
(14, 'കര്‍പ്പൂരം', 11, -1, 1, 1, 1),
(15, 'ഭസ്മം', 11, -1, 1, 1, 1),
(16, 'മഞ്ഞള്‍പൊടി', 11, -1, 1, 1, 1),
(17, 'ചന്ദനത്തിരി', 11, -1, 1, 1, 1),
(18, 'ബാഹ്യം', 11, -1, 1, 1, 1),
(19, 'വിറ്റുവരവ്', 11, -1, 1, 1, 1),
(20, 'വാടക', 11, -1, 1, 1, 1),
(21, 'ഊട്ടുപുര', 11, -1, 1, 1, 1),
(22, 'സര്‍വ ഐശ്യര്യപൂജ', 11, -1, 1, 1, 1),
(23, 'നാരങ്ങ വിളക്ക്', 11, -1, 1, 1, 1),
(24, 'നവഗ്രഹ ശാന്തി ഹോമം', 11, -1, 1, 1, 1),
(25, 'മുദ്ര', 11, -1, 1, 1, 1),
(26, 'ബലി', 11, -1, 1, 1, 1),
(27, 'സംഭാവന', 11, -1, 1, 1, 1),
(28, 'അന്ഗത്വഫീസ്', 11, -1, 1, 1, 1),
(29, 'ക്ഷേത്ര ബാങ്ക് അക്കൗണ്ട്‌', 1, -1, 1, 1, 1),
(30, 'ശമ്പളം + ഭക്ഷണം', 10, -1, 1, 1, 1),
(31, 'സെക്യൂരിറ്റി ശമ്പളം + ബാറ്റ', 10, -1, 1, 1, 1),
(32, 'Ramakrishnan', 10, 30, 1, 1, 1),
(36, 'പുഷ്പാഞ്ജലി', 11, 2, 1, 1, 1),
(37, 'പാല്‍പായസം', 11, 2, 1, 1, 1),
(38, 'Siva kumar', 10, 30, 1, 1, 1),
(39, 'Manu', 11, 4, 1, 1, 1),
(40, 'Manu', 11, 4, 1, 1, 1),
(41, 'Fees', 11, -1, 1, 1, 1),
(42, 'Fees2', 11, -1, 1, 1, 1),
(43, 'Fees3', 11, -1, 1, 1, 1),
(44, 'Fees4', 11, -1, 1, 1, 1),
(45, 'Fees5', 11, -1, 1, 1, 1),
(46, 'Fees6', 11, -1, 1, 1, 1),
(51, 'rosy swapna I J', 31, -1, 1, 1, 1),
(60, 'Narayana Shops', 32, -1, 1, 1, 1),
(61, 'Sales', 28, -1, 1, 1, 1),
(62, 'Purchase', 25, -1, 1, 1, 1),
(63, 'Siva Kumar', 10, 30, 1, 1, 1),
(64, 'parvathy', 10, 30, 1, 1, 1),
(65, 'Lakshmi', 10, 30, 1, 1, 1),
(66, 'Temple Capital Account', 5, -1, 1, 1, 1),
(67, 'Sagar', 31, -1, 1, 1, 1),
(68, 'ghdr sdf ds', 32, -1, 1, 1, 1),
(69, 'test', 11, 2, 1, 1, 1),
(78, 'Input vat @ 13.5%', 12, -1, 1, 1, 1),
(79, 'Input kvat @ 14.5%', 12, -1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pooja`
--

CREATE TABLE IF NOT EXISTS `pooja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `rate` double NOT NULL,
  `ledger_sub_id` int(11) NOT NULL DEFAULT '-1',
  `status_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pooja`
--

INSERT INTO `pooja` (`id`, `name`, `rate`, `ledger_sub_id`, `status_id`) VALUES
(1, 'പുഷ്പാഞ്ജലി', 5, 36, 1),
(2, 'പാല്‍പായസം', 200, 37, 1),
(3, 'test', 234, 69, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`report_id`, `report_head`, `lhs`, `rhs`, `lhs_head`, `rhs_head`, `header`, `footer`, `status`) VALUES
(1, 'Income', 1, 2, 'Particulars', '', '', '', 1),
(2, 'test report head', 1, 1, 'Income', 'Expense', '', '', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `report_feature`
--

INSERT INTO `report_feature` (`feature_id`, `report_id`, `ledger_master_id`, `sub_ledgers`, `position`, `sort_order`, `status`) VALUES
(1, 1, 11, '5,6,7,8,9,10,11,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,36,37,39,40,41,42,43,44,45,46,69', 1, 1, 1),
(25, 2, 11, '36,37', 1, 1, 1),
(26, 2, 10, '38', 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stars`
--

CREATE TABLE IF NOT EXISTS `stars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status_id` int(10) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `stars`
--

INSERT INTO `stars` (`id`, `name`, `status_id`) VALUES
(1, 'അത്തം', 1),
(3, 'ചിത്തിര', 1),
(4, 'ചോതി', 1);

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE IF NOT EXISTS `statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `stock_master`
--

INSERT INTO `stock_master` (`item_id`, `item_name`, `uom_id`, `deleted`) VALUES
(1, 'Product1', 1, 1),
(2, 'product2', 2, 1),
(3, 'product3', 3, 1),
(6, 'product4', 2, 1),
(7, 'product5', 4, 1),
(8, 'Product6', 3, 1),
(9, 'Product7', 3, 1),
(10, 'Product8', 2, 1),
(11, 'Product9', 3, 1),
(12, 'Product10', 1, 1),
(13, 'Product11', 1, 1),
(14, 'Product12', 1, 1),
(15, 'Product13', 2, 1);

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
  `input_type` varchar(50) NOT NULL COMMENT 'purchase or donation(+) and auction or delivery(-) opening(+)',
  `purchase_reference_number` varchar(125) NOT NULL,
  `date` date NOT NULL,
  `tax_id` int(11) NOT NULL DEFAULT '-1',
  `fy_id` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`stk_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `stock_register`
--

INSERT INTO `stock_register` (`stk_id`, `voucher_number`, `voucher_type_id`, `item_id`, `quantity`, `unit_rate`, `input_type`, `purchase_reference_number`, `date`, `tax_id`, `fy_id`) VALUES
(1, '', -1, 6, 120, 0.00, 'Opening', '', '2013-04-01', -1, 1),
(2, '', -1, 7, 110, 0.00, 'Opening', '', '2013-04-01', -1, 1),
(3, '0001', 14, 1, 100, 100.00, 'Purchase', '', '2014-03-25', -1, 1),
(4, '0001', 13, 1, -10, 100.00, 'Sale', '', '2014-03-25', -1, 1),
(5, '', -1, 8, 15, 0.00, 'Opening', '', '2013-04-01', -1, 1),
(6, '', -1, 9, 50, 0.00, 'Opening', '', '2013-04-01', -1, 1),
(7, '0002', 13, 1, -10, 105.00, 'Sale', '', '2014-03-25', -1, 1),
(8, '0002', 14, 1, 100, 105.00, 'Purchase', '', '2014-03-25', -1, 1),
(9, '0003', 13, 1, -15, 100.00, 'Sale', '', '2014-03-25', -1, 1),
(10, '', -1, 10, 100, 100.00, 'Opening', '', '2013-04-01', -1, 1),
(11, '', -1, 11, 50, 0.00, 'Opening', '', '2013-04-01', -1, 1),
(12, '', -1, 14, 0, 15.00, 'Opening', '', '2013-04-01', -1, 1),
(13, '', -1, 15, 10, 25.00, 'Opening', '', '2013-04-01', -1, 1),
(14, '0003', 14, 1, 1, 100.00, 'Purchase', '', '2014-03-27', -1, 1),
(15, '0004', 13, 1, -10, 100.00, 'Sale', '', '2014-03-27', 1, 1),
(16, '0005', 13, 1, -1, 100.00, 'Sale', '', '2014-03-31', 1, 1),
(17, '0006', 13, 1, -1, 100.00, 'Sale', '', '2014-03-31', 1, 1),
(18, '0007', 13, 1, -1, 10.00, 'Sale', '', '2014-03-31', -1, 1),
(19, '0008', 13, 1, -1, 10.00, 'Sale', '', '2014-03-31', -1, 1),
(23, '0009', 13, 1, -1, 10.00, 'Sale', '', '2014-03-31', 0, 1),
(24, '0009', 13, 6, -1, 2.00, 'Sale', '', '2014-03-31', 0, 1),
(25, '0009', 13, 7, -1, 5.00, 'Sale', '', '2014-03-31', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(255) NOT NULL,
  `supplier_address` text NOT NULL,
  `supplier_phone` varchar(15) NOT NULL,
  `contact_person` varchar(125) NOT NULL,
  `contact_mobile` varchar(15) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `supplier_fax` varchar(15) NOT NULL,
  `supplier_cst_number` varchar(50) NOT NULL,
  `supplier_tin_number` varchar(50) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '1' COMMENT '2 for deleted,1 not deleted',
  `ledger_sub_id` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `supplier_address`, `supplier_phone`, `contact_person`, `contact_mobile`, `contact_email`, `supplier_fax`, `supplier_cst_number`, `supplier_tin_number`, `deleted`, `ledger_sub_id`) VALUES
(1, 'Narayana Shops', 'fdsf', '234234', '', '', 'rosy.swapna@acube.co', '', '', '', 1, 60),
(2, 'ghdr sdf ds', 'sdfsdaf', '43546', '', '', 'rosy.swapna@gmail.com', '', '', '', 1, 68);

-- --------------------------------------------------------

--
-- Table structure for table `tax_master`
--

CREATE TABLE IF NOT EXISTS `tax_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(125) NOT NULL,
  `rate` double NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '2',
  `deleted` tinyint(4) NOT NULL DEFAULT '1' COMMENT '2 for deleted,1 not deleted',
  `ledger_sub_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tax_master`
--

INSERT INTO `tax_master` (`id`, `name`, `rate`, `status`, `deleted`, `ledger_sub_id`) VALUES
(1, 'Input vat @ 13.5%', 0.135, 1, 1, 78),
(2, 'Input kvat @ 14.5%', 0.145, 1, 1, 79);

-- --------------------------------------------------------

--
-- Table structure for table `uom_master`
--

CREATE TABLE IF NOT EXISTS `uom_master` (
  `uom_id` int(11) NOT NULL AUTO_INCREMENT,
  `uom_value` varchar(125) NOT NULL,
  PRIMARY KEY (`uom_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `phone`, `address`, `occupation`, `user_status_id`, `organization_id`, `registration_date`, `activation_token`, `password_token`, `user_type_id`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'administrator', '', 'rosy.swapna@acube.co', NULL, NULL, NULL, 1, NULL, '2014-03-21 00:00:00', NULL, NULL, 3),
(2, 'testcounter', 'e10adc3949ba59abbe56e057f20f883e', 'test', 'counter', '', '', '', '', 1, 0, '2014-03-31 10:25:09', '', NULL, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `name`) VALUES
(1, 'COUNTER'),
(2, 'FINANCE'),
(3, 'ADMINISTRATOR');

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
  `deleted` tinyint(4) NOT NULL DEFAULT '1' COMMENT '2 for deleted,1 not deleted',
  PRIMARY KEY (`vazhipadu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `vazhipadu`
--

INSERT INTO `vazhipadu` (`vazhipadu_id`, `vazhipadu_rpt_number`, `vazhipadu_date`, `star_id`, `pooja_id`, `name`, `age`, `quantity`, `amount`, `deleted`) VALUES
(1, '0001', '2014-03-27', 1, 2, 'Raghui', 0, 1, 200.00, 1),
(2, '0001', '2014-03-27', 3, 2, 'sfdsf', 0, 1, 200.00, 1),
(3, '0002', '2014-03-27', 3, 1, 'sfdsf', 0, 1, 5.00, 1),
(4, '0003', '2014-03-27', 3, 3, 'sfadsf', 0, 1, 234.00, 1),
(5, '0004', '2014-03-27', 4, 2, 'sadf', 0, 1, 200.00, 1),
(6, '0005', '2014-03-28', 3, 2, 'sd', 0, 1, 200.00, 1),
(7, '0006', '2014-03-28', 1, 2, 'റോസി സ്വപ്ന', 0, 1, 200.00, 1),
(8, '0006', '2014-03-28', 3, 2, 'നിജോ ജോസഫ്‌', 0, 1, 200.00, 1),
(9, '0006', '2014-03-28', 4, 2, 'അരുണ്‍ കുമാര്‍ ', 0, 1, 200.00, 1),
(10, '0006', '2014-03-28', 1, 2, 'പ്രമോദ് മേനോന്‍', 0, 1, 200.00, 1),
(11, '0007', '2014-03-28', 1, 1, 'രതീഷ്‌', 0, 1, 5.00, 1),
(12, '0007', '2014-03-28', 1, 1, 'രാജേഷ്‌', 0, 1, 5.00, 1),
(13, '0007', '2014-03-28', 1, 1, 'നിജോ', 0, 1, 5.00, 1),
(14, '0007', '2014-03-28', 4, 1, 'അരുണ്‍', 0, 1, 5.00, 1),
(15, '0008', '2014-03-28', 1, 2, 'ഇന്ദു', 0, 1, 200.00, 1),
(16, '0008', '2014-03-28', 1, 2, 'ബിന്ദു', 0, 1, 200.00, 1),
(17, '0009', '2014-03-28', 1, 1, 'rajesh', 0, 1, 5.00, 1),
(18, '0009', '2014-03-28', 1, 1, 'rathessh', 0, 1, 5.00, 1),
(19, '0009', '2014-03-28', 1, 1, 'parmod', 0, 1, 5.00, 1),
(20, '0009', '2014-03-28', 1, 1, 'nijo', 0, 1, 5.00, 1),
(21, '0010', '2014-03-29', 1, 1, 'Narayanan', 0, 1, 5.00, 1),
(22, '0011', '2014-03-29', 1, 1, 'Narayanan', 0, 1, 5.00, 1),
(23, '0012', '2014-03-29', 1, 1, 'Narayana Shop', 0, 1, 5.00, 1),
(24, '0013', '2014-03-29', 1, 1, 'Narayana Shop', 0, 1, 5.00, 1),
(25, '0014', '2014-03-29', 1, 1, 'Narayana Shop', 0, 1, 5.00, 1),
(26, '0015', '2014-03-29', 1, 1, 'Narayana Shop', 0, 1, 5.00, 1),
(27, '0016', '2014-03-29', 1, 1, 'rajesh', 0, 1, 5.00, 1),
(28, '0017', '2014-03-29', 4, 2, 'Rajesh', 0, 1, 200.00, 1),
(29, '0018', '2014-03-29', 1, 1, 'Rajesh', 0, 1, 5.00, 1),
(30, '0019', '2014-03-31', 3, 2, 'sdfd', 0, 1, 200.00, 1),
(31, '0019', '2014-03-31', 1, 2, 'sdf', 0, 1, 200.00, 1),
(32, '0020', '2014-03-25', 1, 1, 'fd', 0, 1, 5.00, 1),
(33, '0020', '2014-03-25', 3, 1, 'df.;''', 0, 1, 5.00, 1),
(34, '0020', '2014-03-25', 3, 1, 'SDFL', 0, 1, 5.00, 1),
(35, '0020', '2014-03-25', 3, 1, 'FDF', 0, 1, 5.00, 1),
(36, '0021', '2014-03-31', 1, 2, 'sdf', 0, 1, 200.00, 1),
(37, '0022', '2014-03-31', 1, 2, 'sdf', 0, 1, 200.00, 1),
(38, '0023', '2014-03-31', 3, 1, 'dsf', 0, 1, 5.00, 1),
(39, '0024', '2014-03-31', 1, 2, 'sdf', 0, 1, 200.00, 1),
(40, '0025', '2014-03-31', 1, 2, 'dfg', 0, 1, 200.00, 1),
(41, '0026', '2014-03-31', 1, 2, 'sdf', 0, 1, 200.00, 1),
(42, '0027', '2014-03-31', 3, 2, 'dsf', 0, 1, 200.00, 1),
(43, '0028', '2014-03-31', 3, 2, 'rosy swapna', 0, 1, 200.00, 1),
(44, '0029', '2014-03-31', 3, 3, 'sdf', 0, 1, 234.00, 1),
(45, '0030', '2014-03-31', 3, 1, 'sdf', 0, 1, 5.00, 1),
(46, '0031', '2014-03-31', 1, 2, 'sdf', 0, 1, 200.00, 1),
(47, '0032', '2014-03-31', 3, 2, 'sanitha', 0, 1, 200.00, 1),
(48, '0033', '2014-03-31', 1, 1, 'dfgf', 0, 1, 5.00, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`voucher_id`, `voucher_name`, `voucher_description`, `fy_id`, `voucher_master_id`, `header`, `footer`, `number_series`, `series_prefix`, `series_sufix`, `series_start`, `series_seperator`, `default_from`, `default_to`, `form_type_id`, `source`, `hidden`, `module_id`) VALUES
(1, 'Vazhipadu', '', 1, 2, '', '', '0001', '', '', '0001', '', '3', '2', -1, -1, 2, 1),
(8, 'Cash Receipt', '', 1, 2, '', '', '0001', '', '', '0001', '', 'a:1:{i:0;s:1:"3";}', '', -1, 1, 1, NULL),
(9, 'Cash Payment', '', 1, 1, '', '', '0001', '', '', '0001', '', '', 'a:1:{i:0;s:1:"3";}', -1, 1, 1, NULL),
(10, 'Bank Receipt', '', 1, 4, '', '', '0001', '', '', '0001', '', 'a:1:{i:0;s:2:"29";}', '', -1, 1, 1, NULL),
(11, 'Bank Payment', '', 1, 5, '', '', '0001', '', '', '0001', '', '', 'a:1:{i:0;s:2:"29";}', -1, 1, 1, NULL),
(13, 'Sale', '', 1, 13, '<table border="1" cellpadding="0" cellspacing="0" style="height:645px; width:801px">\r\n    <tbody>\r\n        <tr>\r\n            <td style="height:25px; width:322px">\r\n            <p>Tax payers Identification No : 32090935735</p>\r\n            </td>\r\n            <td style="height:25px; width:322px">\r\n            <p style="text-align:right">Central Sales Tax Reg.No.: 32090935735 C</p>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td style="height:25px; width:322px">\r\n            <p>CENTRAL EXCISE REGN.No :</p>\r\n            </td>\r\n            <td style="height:25px; width:322px">\r\n            <p>&nbsp;</p>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td style="height:25px; width:322px">\r\n            <p>SSI / MSI / LSI Regn.No.:</p>\r\n            </td>\r\n            <td style="height:25px; width:322px">\r\n            <p>&nbsp;</p>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td colspan="2" style="height:139px; width:645px">\r\n            <p style="text-align:center"><span style="font-size:16px"><strong>Organization Name.</strong></span><br />\r\n            Door N.XIV/513, Kamblichungam,, Thekkedesam -P.O., Chittur.,Palakkad, Kerala- 678553<br />\r\n            THE KERALA VALUE ADDED TAX RULES, 2005<br />\r\n            <br />\r\n            <strong><span style="font-size:16px">FORM NO. 8</span></strong><br />\r\n            [See rule 58(10)]</p>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td colspan="2" style="height:71px; width:645px">\r\n            <p style="text-align:center"><span style="font-size:16px"><strong>TAX INVOICE</strong></span><br />\r\n            CASH / CREDIT<br />\r\n            (To be Prepared in Quadruplicate*)</p>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td style="height:23px; width:322px">\r\n            <p><strong>Invoice No.: 72</strong></p>\r\n            </td>\r\n            <td style="height:23px; width:322px">\r\n            <p style="text-align:right"><strong>Date :16-Nov-2013 </strong></p>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td style="height:23px; width:322px">\r\n            <p><strong>Purchase order No.&amp; Date :</strong></p>\r\n            </td>\r\n            <td style="height:23px; width:322px">\r\n            <p style="text-align:right">&nbsp;</p>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td style="height:71px; width:322px">\r\n            <p><strong>Name &amp; Address of Purchasing Dealer :</strong></p>\r\n\r\n            <p>Sri Mari Traders , 130, Melapulivard Road,<br />\r\n            Mailam Chandai - 1(C), Tamil Nadu.</p>\r\n            </td>\r\n            <td style="height:71px; width:322px">\r\n            <p style="text-align:right">&nbsp;</p>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td style="height:23px; width:322px">\r\n            <p>TIN : 33113422385</p>\r\n            </td>\r\n            <td style="height:23px; width:322px">\r\n            <p style="text-align:right">Central Sales Tax Reg.No.: 204622</p>\r\n            </td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n', '', '0001', 'pk', '2014', '0001', '/', 'a:1:{i:0;s:1:"3";}', 'a:1:{i:0;s:2:"61";}', 1, 2, 1, NULL),
(14, 'Purchase', '', 1, 14, '', '', '0001', '', '', '0001', '', 'a:1:{i:0;s:1:"3";}', 'a:1:{i:0;s:2:"62";}', -1, 2, 1, NULL),
(15, 'sdf', '', 1, 1, '', '', '001', '', '', '001', '', 'a:1:{i:0;s:1:"3";}', '', -1, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `voucher_master`
--

CREATE TABLE IF NOT EXISTS `voucher_master` (
  `voucher_master_id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher_master_name` varchar(250) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1 for active ,2 for inactive',
  PRIMARY KEY (`voucher_master_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

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
