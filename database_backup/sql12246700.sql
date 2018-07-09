-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2018 at 12:16 PM
-- Server version: 5.7.17-log
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sql12246700`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE `user_master` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `profile_display_name` varchar(50) NOT NULL,
  `profile_img_path` text,
  `user_pwd` varchar(50) NOT NULL,
  `user_address` text NOT NULL,
  `user_email` varchar(70) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `blood_group` varchar(3) NOT NULL,
  `available_time` varchar(50) NOT NULL,
  `type_of_service` varchar(50) NOT NULL,
  `blocked` tinyint(11) DEFAULT '0',
  `active` tinyint(11) DEFAULT '1',
  `modified_dtm` datetime DEFAULT NULL,
  `created_dtm` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `hidden` tinyint(4) DEFAULT '0',
  `dead` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`user_id`, `first_name`, `last_name`, `profile_display_name`, `profile_img_path`, `user_pwd`, `user_address`, `user_email`, `phone_number`, `blood_group`, `available_time`, `type_of_service`, `blocked`, `active`, `modified_dtm`, `created_dtm`, `hidden`, `dead`) VALUES
(1, 'Jay', 'Prajapati', 'Jay Prajapati', 'img', '1234', 'nadiad', 'jayprajapati857@gmial.com', '9724455857', 'o+', 'Sat-Sun', 'Employee', 0, 1, NULL, '2018-06-30 09:50:05', 0, 0),
(2, 'Jay', 'Prajapati', 'Jay', NULL, '123', 'Nadiad', 'demo@demo.com', '9724455857', 'O+', 'Monday', 'Employee', 0, 1, NULL, '2018-06-30 09:59:34', 0, 0),
(3, 'Nayan', 'Mecwan', 'NYN', NULL, '1234', 'Nadiad', 'nayan@nayan.com', '9898989898', 'A+', 'sat-sun', 'employee', 0, 1, NULL, '2018-06-30 10:07:05', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_master`
--
ALTER TABLE `user_master`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
