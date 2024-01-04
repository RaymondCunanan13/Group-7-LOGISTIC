-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2024 at 04:33 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `go_shdc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `mobile` bigint(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `gender` enum('Male','Female','o') NOT NULL,
  `email` varchar(50) NOT NULL,
  `age` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `firstname`, `lastname`, `username`, `password`, `mobile`, `address`, `gender`, `email`, `age`) VALUES
(65894, 'asdas', 'asdasd', 'momon002', 'asdasd', 9297799262, 'sadasd', '', 'retrosix44@gmail.com', 13),
(659430, 'ray', 'mond', 'Sana', 'mon', 9701823843, 'sadasd', '', 'cunanan_raymond13@yahoo.com', 13),
(659438, 'fdgdfg', 'gdfg', 'yuyu', 'werewr', 9214821015, 'ewrewre', '', 'gino_reyes@yahoo.com', 121);

-- --------------------------------------------------------

--
-- Table structure for table `cargo`
--

CREATE TABLE `cargo` (
  `username` varchar(50) NOT NULL,
  `carname` enum('Compact Car','Sedan','SUV','Pickup Truck','Van','Box Truck (Small)','Box Truck (Medium)','Box Truck (Large)','Bus (Standard)','Tractor Trailer','Motorcycle') NOT NULL,
  `maxweight` int(2) NOT NULL,
  `location` varchar(50) NOT NULL,
  `loadingtime` enum('Special Time','6:00 am','7:00 am','8:00 am','9:00 pm','10;00 pm','12:00 pm') NOT NULL,
  `unloadingtime` enum('Special Time','6:00 am','7:00 am','8:00 am','9:00 pm','10:00 pm','12:00 pm') NOT NULL,
  `length` int(2) NOT NULL,
  `width` int(2) NOT NULL,
  `height` int(2) NOT NULL,
  `timestamp_column` timestamp NOT NULL DEFAULT current_timestamp(),
  `id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cargo`
--

INSERT INTO `cargo` (`username`, `carname`, `maxweight`, `location`, `loadingtime`, `unloadingtime`, `length`, `width`, `height`, `timestamp_column`, `id`) VALUES
('momon002', 'Compact Car', 12, 'asdasd', 'Special Time', 'Special Time', 12, 12, 121, '2024-01-03 12:14:56', 65954),
('momon002', 'Compact Car', 3424, 'fgdg', 'Special Time', 'Special Time', 12, 12, 5, '2024-01-03 12:15:12', 65954),
('momon002', 'Compact Car', 3424, 'fgdg', 'Special Time', 'Special Time', 13, 12, 5, '2024-01-03 12:15:53', 65954);

-- --------------------------------------------------------

--
-- Table structure for table `cargo_details`
--

CREATE TABLE `cargo_details` (
  `id` int(11) NOT NULL,
  `cargo_name` varchar(255) NOT NULL,
  `pickup_point` varchar(255) NOT NULL,
  `dropoff_point` varchar(255) NOT NULL,
  `weight` decimal(10,2) NOT NULL,
  `length` decimal(10,2) NOT NULL,
  `width` decimal(10,2) NOT NULL,
  `height` decimal(10,2) NOT NULL,
  `distance` decimal(10,2) NOT NULL,
  `rate` enum('0.10','0.25','0.40','') NOT NULL,
  `currency` enum('USD','PHP','EUR','JPY','GBP','AUD','CAD','CNY','INR') NOT NULL,
  `cargo_cost` decimal(15,2) NOT NULL,
  `username` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `situation` enum('pending','cancel','complete','reject','progressing') NOT NULL,
  `timestamp_column` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `mobile` bigint(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `gender` enum('Male','Female','o') NOT NULL,
  `email` varchar(50) NOT NULL,
  `age` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `mobile` bigint(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `gender` enum('Male','Female','o') NOT NULL,
  `email` varchar(50) NOT NULL,
  `age` int(100) NOT NULL,
  `platenumber` varchar(255) DEFAULT NULL,
  `drivers_license` varchar(255) DEFAULT NULL,
  `area_of_delivery` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `timestamp_column` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `username` varchar(200) NOT NULL,
  `message` varchar(200) NOT NULL,
  `account` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

CREATE TABLE `progress` (
  `id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `username` varchar(200) NOT NULL,
  `message` varchar(200) NOT NULL,
  `account` varchar(50) NOT NULL,
  `deliver` varchar(50) NOT NULL,
  `item` varchar(50) NOT NULL,
  `cargo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `progress`
--

INSERT INTO `progress` (`id`, `timestamp`, `username`, `message`, `account`, `deliver`, `item`, `cargo`) VALUES
(0, '2024-01-03 14:02:02', 'momon002', '2024', 'momon002', 'momon002', '1211', 'Tractor Trailer'),
(0, '2024-01-03 14:07:29', 'momon002', 'the cargo was dropdoen on this area', 'momon002', 'momon002', '1211', 'Tractor Trailer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cargo_details`
--
ALTER TABLE `cargo_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cargo_details`
--
ALTER TABLE `cargo_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
