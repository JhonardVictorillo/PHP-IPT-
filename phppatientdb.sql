-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2024 at 05:27 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phppatientdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patients`
--

CREATE TABLE `tbl_patients` (
  `p_id` int(60) NOT NULL,
  `p_firstname` varchar(60) NOT NULL,
  `p_lastname` varchar(60) NOT NULL,
  `p_age` int(60) NOT NULL,
  `p_gender` varchar(60) NOT NULL,
  `p_dateofbirth` varchar(60) NOT NULL,
  `p_contact` varchar(60) NOT NULL,
  `p_address` varchar(60) NOT NULL,
  `p_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_patients`
--

INSERT INTO `tbl_patients` (`p_id`, `p_firstname`, `p_lastname`, `p_age`, `p_gender`, `p_dateofbirth`, `p_contact`, `p_address`, `p_image`) VALUES
(4, 'mary', 'lapiz', 32, 'Male', '3/23/23', '212133323', 'mayana', '0'),
(10, 'cristine', 'test', 16, 'Female', '06/26/2008', '0992339453', 'Minglanilla', 'images/VL72FsUT/a8b25d0d-64d5-402f-99f5-a58f483c38c6.jpg'),
(32, 'dsd', 'dsad', 0, 'fg', 'dd', 'ds', 'sad', 'images/H8pNvQ5F/icons8-register-100.png'),
(34, 'dfsdfss', 'fdfgg', 0, 'gfgfd', 'gfgfdg', 'fdgd', 'gdfgf', 'images/HeTR9AWF/1931a28d3d668efb6533155db7b03ad4.jpg'),
(35, 'JHONARD', 'VICTORILLO', 21, 'MALE', '06/03/2003', '09922365452', 'MAYANA', 'images/sAGYhqsb/Fernando Amorsolo (2).jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_patients`
--
ALTER TABLE `tbl_patients`
  ADD PRIMARY KEY (`p_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_patients`
--
ALTER TABLE `tbl_patients`
  MODIFY `p_id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
