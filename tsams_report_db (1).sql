-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 03, 2016 at 10:37 AM
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
-- Table structure for table `project_tb`
--

CREATE TABLE `project_tb` (
  `project_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `po_no` varchar(100) DEFAULT NULL,
  `start_date` varchar(20) NOT NULL,
  `expire_date` varchar(20) NOT NULL,
  `service_type_1` varchar(15) DEFAULT NULL,
  `service_type_2` varchar(15) DEFAULT NULL,
  `incident` varchar(20) NOT NULL,
  `pm` varchar(20) DEFAULT NULL,
  `cus_name` varchar(50) DEFAULT NULL,
  `cus_tel` varchar(20) DEFAULT NULL,
  `cus_email` varchar(50) DEFAULT NULL,
  `sale` varchar(70) DEFAULT NULL,
  `product` text NOT NULL,
  `enable` varchar(10) NOT NULL DEFAULT 'Yes',
  `remark` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_tb`
--

INSERT INTO `project_tb` (`project_id`, `customer_id`, `po_no`, `start_date`, `expire_date`, `service_type_1`, `service_type_2`, `incident`, `pm`, `cus_name`, `cus_tel`, `cus_email`, `sale`, `product`, `enable`, `remark`) VALUES
(1, 2, 'asd', '2016-Sep-05', '2016-Sep-30', 'MA', '8*5', '2', '6', 'undefined', 'undefined', 'undefined', 'asdasdasd', 'adsadasd', 'Yes', NULL),
(2, 2, 'asdsfg', '2016-Sep-01', '2016-Sep-30', 'MA', '8*5', '100', '5', 'nameee', 'tel', 'mail', 'testtest', 'asdasdasdasd\nasdasdas\ndasdasdas\nasdasd', 'Yes', NULL),
(3, 5, '1asdasd212', '2016-Oct-01', '2016-Nov-30', 'Incident', '24*7', '0', '0', 'name_2', 'asd', 'email_2', '2test2', 'Paloalto\nCheckpoint', 'No', NULL),
(4, 5, 'sadadasd', '2016-Oct-04', '2016-Nov-04', 'Warranty', '8*5', '0', '0', 'sadsadsada', 'adadasd', 'sad@sdad.com', 'asdsadasd', 'IMSVA\nBluecoat', 'Yes', NULL),
(6, 2, 'test_po', '2016-Oct-01', '2016-Oct-31', 'MA', '8*5', '3', '3', '', '', '', 'asdasdasd', 'sadsad\nasdsadasd', 'Yes', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `report_tb`
--

CREATE TABLE `report_tb` (
  `report_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `project_id` int(11) NOT NULL,
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

INSERT INTO `report_tb` (`report_id`, `customer_id`, `project_id`, `eng_id`, `date_pm`, `date_sent`, `date_create`, `status`, `file_name`, `comment`, `remark`) VALUES
(27, 2, 6, 1, '2016-Oct-01', '2016-Oct-31', '2016-Oct-02', NULL, NULL, '', NULL);

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
-- Indexes for table `project_tb`
--
ALTER TABLE `project_tb`
  ADD PRIMARY KEY (`project_id`);

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
-- AUTO_INCREMENT for table `project_tb`
--
ALTER TABLE `project_tb`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `report_tb`
--
ALTER TABLE `report_tb`
  MODIFY `report_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `team_tb`
--
ALTER TABLE `team_tb`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
