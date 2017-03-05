-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 21, 2016 at 04:44 PM
-- Server version: 5.7.11
-- PHP Version: 5.5.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tsams_report_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_tb`
--

CREATE TABLE `customer_tb` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(40) NOT NULL,
  `img_path` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_tb`
--

INSERT INTO `customer_tb` (`customer_id`, `customer_name`, `img_path`) VALUES
(2, 'SCB_10', 'bg.jpg'),
(5, 'asdasdasdsad', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `engineer_tb`
--

CREATE TABLE `engineer_tb` (
  `eng_id` int(10) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `nick_name` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `role` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `enable_user` varchar(10) NOT NULL DEFAULT 'yes',
  `team_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `engineer_tb`
--

INSERT INTO `engineer_tb` (`eng_id`, `first_name`, `last_name`, `nick_name`, `username`, `password`, `role`, `email`, `enable_user`, `team_id`) VALUES
(1, 'MongkolLLL', 'Thongkraikaew', 'Pome_tanee', 'mongktho', 'testtest', 'Admin', 'mongkol_ttm@hotmail.com', 'yes', 2),
(2, 'Test', 'test', 'test', 'test_t', 'P@ssw0rd', 'User', 'test@test.co.th', 'no', 2),
(3, 'sadasd', 'adsasda', 'sdasdasd', 'asdasd', 'P@ssw0rd', 'User', 'asdasdasd', 'yes', 2),
(4, 'asdsadsadasd', 'asdasdasd', 'asdasdd', 'rooot', 'P@ssw0rd', 'User', 'mongkol_Tasd@dasad.com', 'yes', 2);

-- --------------------------------------------------------

--
-- Table structure for table `report_tb`
--

CREATE TABLE `report_tb` (
  `report_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `eng_id` int(10) NOT NULL,
  `date_pm` varchar(20) NOT NULL,
  `date_sent` varchar(20) NOT NULL,
  `date_create` varchar(20) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `file_name` varchar(70) DEFAULT NULL,
  `comment` varchar(50) DEFAULT NULL,
  `remark` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `report_tb`
--

INSERT INTO `report_tb` (`report_id`, `customer_id`, `eng_id`, `date_pm`, `date_sent`, `date_create`, `status`, `file_name`, `comment`, `remark`) VALUES
(7, 2, 1, '2016-Sep-05', '2016-Sep-12', '2016-Sep-09', NULL, 'SCB.docx', '', 'complete'),
(8, 2, 1, '2016-Sep-06', '2016-Oct-05', '2016-Sep-09', NULL, NULL, '', NULL),
(9, 2, 1, '2016-Sep-13', '2016-Sep-16', '2016-Sep-09', NULL, NULL, 'asdasdasd', NULL),
(10, 2, 1, '2016-Sep-05', '2016-Sep-13', '2016-Sep-09', NULL, NULL, '', NULL),
(11, 5, 1, '2016-Sep-06', '2016-Sep-20', '2016-Sep-09', NULL, NULL, '', NULL),
(12, 2, 1, '2016-Sep-07', '2016-Sep-27', '2016-Sep-09', NULL, NULL, 'test', 'complete'),
(13, 2, 1, '2016-Sep-22', '2016-Sep-29', '2016-Sep-09', NULL, NULL, '', NULL),
(14, 2, 1, '2016-Sep-06', '2016-Sep-20', '2016-Sep-09', NULL, NULL, '', NULL),
(15, 2, 1, '2016-Sep-13', '2016-Sep-14', '2016-Sep-09', NULL, NULL, '', NULL),
(16, 2, 1, '2016-Sep-05', '2016-Sep-13', '2016-Sep-09', NULL, NULL, '', NULL),
(17, 2, 1, '2016-Sep-21', '2016-Sep-21', '2016-Sep-09', NULL, NULL, '', ''),
(18, 2, 1, '2016-Sep-07', '2016-Sep-21', '2016-Sep-09', NULL, 'Sep_2016/MCOT McAfee_SIEM OJT  (Thai) V2.docx', 'test 2_', 'complete'),
(19, 2, 1, '2016-Sep-13', '2016-Sep-20', '2016-Sep-09', NULL, NULL, '', NULL),
(20, 2, 1, '2016-Sep-28', '2016-Sep-29', '2016-Sep-09', NULL, NULL, 'daadasd', NULL),
(21, 2, 1, '2016-Sep-05', '2016-Sep-20', '2016-Sep-09', NULL, NULL, '', NULL),
(22, 2, 1, '2016-Sep-19', '2016-Sep-20', '2016-Sep-09', NULL, NULL, '', NULL),
(23, 2, 1, '2016-Sep-23', '2016-Sep-24', '2016-Sep-09', NULL, NULL, '', NULL),
(24, 2, 1, '2016-Sep-01', '2016-Sep-08', '2016-Sep-10', NULL, NULL, 'tesss', NULL),
(25, 5, 3, '2016-Sep-21', '2016-Sep-29', '2016-Sep-18', NULL, NULL, '', NULL),
(26, 5, 3, '2016-Sep-16', '2016-Sep-20', '2016-Sep-18', NULL, NULL, 'bkuhkj', '');

-- --------------------------------------------------------

--
-- Table structure for table `team_tb`
--

CREATE TABLE `team_tb` (
  `team_id` int(11) NOT NULL,
  `team_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `team_tb`
--

INSERT INTO `team_tb` (`team_id`, `team_name`) VALUES
(2, 'Network Security');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_tb`
--
ALTER TABLE `customer_tb`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `engineer_tb`
--
ALTER TABLE `engineer_tb`
  ADD PRIMARY KEY (`eng_id`);

--
-- Indexes for table `report_tb`
--
ALTER TABLE `report_tb`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `team_tb`
--
ALTER TABLE `team_tb`
  ADD PRIMARY KEY (`team_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_tb`
--
ALTER TABLE `customer_tb`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `engineer_tb`
--
ALTER TABLE `engineer_tb`
  MODIFY `eng_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `report_tb`
--
ALTER TABLE `report_tb`
  MODIFY `report_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `team_tb`
--
ALTER TABLE `team_tb`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
