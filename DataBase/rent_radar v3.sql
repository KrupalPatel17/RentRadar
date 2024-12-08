-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2024 at 09:50 AM
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
-- Table structure for table `tbl_con`
--

CREATE TABLE `tbl_con` (
  `contact_id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `owner_id` int(10) NOT NULL,
  `house_id` int(10) NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_con`
--

INSERT INTO `tbl_con` (`contact_id`, `user_id`, `owner_id`, `house_id`, `status`) VALUES
(1, 5, 1, 4, 1),
(2, 5, 1, 12, 2),
(3, 5, 1, 14, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_house`
--

CREATE TABLE `tbl_house` (
  `house_id` int(11) NOT NULL,
  `house_num` varchar(15) NOT NULL,
  `soc_name` varchar(20) NOT NULL,
  `landmark` varchar(30) NOT NULL,
  `state` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `pincode` int(6) NOT NULL,
  `members` int(10) NOT NULL,
  `furnishing` varchar(15) NOT NULL,
  `rent` int(20) NOT NULL,
  `num_bed` int(10) NOT NULL,
  `num_bath` int(10) NOT NULL,
  `description` varchar(50) NOT NULL,
  `img` varchar(10000) NOT NULL,
  `owner_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_house`
--

INSERT INTO `tbl_house` (`house_id`, `house_num`, `soc_name`, `landmark`, `state`, `city`, `pincode`, `members`, `furnishing`, `rent`, `num_bed`, `num_bath`, `description`, `img`, `owner_id`) VALUES
(4, '395005', '32, parijat society ', 'shishukunj school', 'Gujarat', 'Surat', 395005, 5, 'Furnished', 23453, 2, 2, 'sdfgt', 'img/OIP.jpg', 1),
(12, '395009', '7-c , Krishna Nagar ', 'shishukunj school', 'Gujarat', 'Surat', 395009, 4, 'Furnished', 400, 3, 3, 'only veg persons are allowed ', 'img/images.jpeg', 1),
(14, '31a', 'sai pujan', 'adajan', 'Goa', 'Margao', 395004, 6, 'Furnished', 8999, 2, 5, 'Make Home Clean Daily ', 'img/download.jpg', 1),
(15, '3a', 'Rajhansh', 'Pal', 'Rajasthan', 'Jaipur', 395000, 4, 'Semi-Furnished\"', 6000, 2, 1, 'Non Vge Is Not Allowed', 'img/download (1).jpg', 1);

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
  `status` int(2) NOT NULL,
  `verification` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_owners`
--

INSERT INTO `tbl_owners` (`owner_id`, `owner_name`, `email`, `phone`, `addresh`, `password`, `uploads`, `status`, `verification`) VALUES
(1, 'shree_ram', 'krupal561@gmail.com', 123456789, '32, parijat society gavendar Jahangirpura', '202cb962ac59075b964b07152d234b70', 'uploads/download.png', 1, 1),
(2, 'krupal123', 'krupal561@gmail.com', 2147483647, '32, parijat society gavendar Jahangirpura', '202cb962ac59075b964b07152d234b70', 'uploads/download.png', 1, 1),
(3, 'stave', 'krupal561@gmail.com', 2147483647, 'central park new york', '202cb962ac59075b964b07152d234b70', 'uploads/download.png', 1, 1),
(5, 'tony', 'krupal561@gmail.com', 2147483647, '6-f street California ', '202cb962ac59075b964b07152d234b70', 'uploads/download.png', 1, 1),
(7, 'hulk', 'krupal561@gmail.com', 2147483647, '69-s street Amsterdam ', '202cb962ac59075b964b07152d234b70', 'uploads/download.png', 2, 1),
(8, 'hulk1', 'krupal561@gmail.com', 2147483647, '69-s street Amsterdam ', '202cb962ac59075b964b07152d234b70', 'uploads/download.png', 0, 1),
(9, 'black', 'krupal561@gmail.com', 2147483647, '7-c , Krishna Nagar Soc, Near Choksi Wadi, Adajan,', '202cb962ac59075b964b07152d234b70', 'uploads/download.png', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` int(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `verification` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `email`, `phone`, `address`, `password`, `verification`) VALUES
(5, 'ram', 'patelkrupal679@gmail.com', 2147483647, '32, parijat society gavendar Jahangirpura', '202cb962ac59075b964b07152d234b70', 1),
(6, 'krupal12', 'krupal561@gmail.com', 2147483647, '32, parijat society gavendar Jahangirpura', '202cb962ac59075b964b07152d234b70', 1),
(7, 'krupal', 'patelkrupal679@gmail.com', 2147483647, '32, parijat society gavendar Jahangirpura', '202cb962ac59075b964b07152d234b70', 1),
(10, 'paper', 'liralpatel@gmail.com', 2147483647, '32, parijat society gavendar Jahangirpura', '202cb962ac59075b964b07152d234b70', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_watchlist`
--

CREATE TABLE `tbl_watchlist` (
  `wtch_id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `owner_id` int(10) NOT NULL,
  `house_id` int(10) NOT NULL,
  `state` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `rent` int(10) NOT NULL,
  `img` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_watchlist`
--

INSERT INTO `tbl_watchlist` (`wtch_id`, `user_id`, `owner_id`, `house_id`, `state`, `city`, `rent`, `img`) VALUES
(3, 5, 1, 14, 'Goa', 'Margao', 8999, 'img/download.jpg'),
(4, 5, 1, 4, 'Gujarat', 'Surat', 23453, 'img/OIP.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_con`
--
ALTER TABLE `tbl_con`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `tbl_house`
--
ALTER TABLE `tbl_house`
  ADD PRIMARY KEY (`house_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `tbl_owners`
--
ALTER TABLE `tbl_owners`
  ADD PRIMARY KEY (`owner_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_watchlist`
--
ALTER TABLE `tbl_watchlist`
  ADD PRIMARY KEY (`wtch_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_con`
--
ALTER TABLE `tbl_con`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_house`
--
ALTER TABLE `tbl_house`
  MODIFY `house_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_owners`
--
ALTER TABLE `tbl_owners`
  MODIFY `owner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_watchlist`
--
ALTER TABLE `tbl_watchlist`
  MODIFY `wtch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
