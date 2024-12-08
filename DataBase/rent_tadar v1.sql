-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2024 at 12:07 PM
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
-- Database: `rent_radar`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_owners`
--

CREATE TABLE `tbl_owners` (
  `owner_id` int(11) NOT NULL,
  `owner_name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` int(10) NOT NULL,
  `addresh` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `uploads` varchar(100) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_owners`
--

INSERT INTO `tbl_owners` (`owner_id`, `owner_name`, `email`, `phone`, `addresh`, `password`, `uploads`, `status`) VALUES
(1, 'shree_ram', 'krupal561@gmail.com', 123456789, '32, parijat society gavendar Jahangirpura', '202cb962ac59075b964b07152d234b70', 'uploads/download.png', 1),
(2, 'krupal123', 'krupal561@gmail.com', 2147483647, '32, parijat society gavendar Jahangirpura', '202cb962ac59075b964b07152d234b70', 'uploads/download.png', 1),
(3, 'stave', 'krupal561@gmail.com', 2147483647, 'central park new york', '202cb962ac59075b964b07152d234b70', 'uploads/download.png', 1),
(5, 'tony', 'krupal561@gmail.com', 2147483647, '6-f street California ', '202cb962ac59075b964b07152d234b70', 'uploads/download.png', 1),
(7, 'hulk', 'krupal561@gmail.com', 2147483647, '69-s street Amsterdam ', '202cb962ac59075b964b07152d234b70', 'uploads/download.png', 2),
(8, 'hulk1', 'krupal561@gmail.com', 2147483647, '69-s street Amsterdam ', '202cb962ac59075b964b07152d234b70', 'uploads/download.png', 0),
(9, 'black', 'krupal561@gmail.com', 2147483647, '7-c , Krishna Nagar Soc, Near Choksi Wadi, Adajan,', '202cb962ac59075b964b07152d234b70', 'uploads/download.png', 0),
(10, 'black2', 'krupal561@gmail.com', 2147483647, '7-c , Krishna Nagar Soc, Near Choksi Wadi, Adajan,', '202cb962ac59075b964b07152d234b70', 'uploads/download.png', 0),
(11, 'black3', 'krupal561@gmail.com', 2147483647, '7-c , Krishna Nagar Soc, Near Choksi Wadi, Adajan,', '202cb962ac59075b964b07152d234b70', 'uploads/download.png', 0),
(12, 'krupal33', 'krupal561@gmail.com', 2147483647, '7-c , Krishna Nagar Soc, Near Choksi Wadi, Adajan,', '202cb962ac59075b964b07152d234b70', 'uploads/download.png', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_owners`
--
ALTER TABLE `tbl_owners`
  ADD PRIMARY KEY (`owner_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_owners`
--
ALTER TABLE `tbl_owners`
  MODIFY `owner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
