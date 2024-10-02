-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 02, 2024 at 02:46 PM
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
-- Database: `res_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `role`) VALUES
(1, 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `booking_details`
--

CREATE TABLE `booking_details` (
  `id` int(11) NOT NULL,
  `booking_id` varchar(200) DEFAULT NULL,
  `res_id` int(11) DEFAULT NULL,
  `c_id` int(11) DEFAULT NULL,
  `make_date` date DEFAULT NULL,
  `make_time` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `booking_date` date DEFAULT NULL,
  `booking_time` varchar(30) DEFAULT NULL,
  `bill` float DEFAULT NULL,
  `transactionid` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0- reject, 1-confirmed',
  `reject` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `booking_details`
--

INSERT INTO `booking_details` (`id`, `booking_id`, `res_id`, `c_id`, `make_date`, `make_time`, `name`, `phone`, `booking_date`, `booking_time`, `bill`, `transactionid`, `status`, `reject`) VALUES
(2, '66e733223e663', 12, 12, '2024-09-16', '01:18:58am', 'et', '0702214136', '2024-09-26', '10:00am', 1500, '123456', 1, 0),
(3, '66edba9bd5542', 14, 4, '2024-09-21', '12:10:35am', 'Park View Restaurant', '01821356478', '2024-09-26', '10:00am', 9000, '123456', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `booking_menus`
--

CREATE TABLE `booking_menus` (
  `id` int(11) NOT NULL,
  `booking_id` varchar(200) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `booking_menus`
--

INSERT INTO `booking_menus` (`id`, `booking_id`, `item_id`, `qty`) VALUES
(1, '5ccbd8f5609b3', 4, 2),
(2, '5ccbd8f5609b3', 5, 2),
(3, '66e733223e663', 10, 1),
(4, '66edba9bd5542', 14, 6);

-- --------------------------------------------------------

--
-- Table structure for table `foodOrder`
--

CREATE TABLE `foodOrder` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_phone` varchar(20) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `food_type` varchar(255) DEFAULT NULL,
  `food_count` int(11) DEFAULT 1,
  `order_date` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu_item`
--

CREATE TABLE `menu_item` (
  `id` int(11) NOT NULL,
  `res_id` int(11) DEFAULT NULL,
  `item_name` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `madeby` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `food_type` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `cuisine_type` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `price` float DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_item`
--

INSERT INTO `menu_item` (`id`, `res_id`, `item_name`, `madeby`, `food_type`, `cuisine_type`, `price`, `image`) VALUES
(28, 9, 'test123 e', 'tt tt', 'Main Cuisine', 'Srilankan', 1220, '2.png'),
(29, 9, 'tttt', 'hb', 'Drink', '', 3456, '19938421.jpeg'),
(30, 9, 'test11', 'me', 'Main Cuisine', 'Chinese', 1200, 'ast-compressed.jpeg'),
(31, 9, 'new', 'sh', 'Main Cuisine', 'Italian', 1200, 'miles-morales-spider-man-dark-black-background-artwork-5k-8k-8000x4518-1902.png'),
(32, 9, 'des', 'te', 'Dessert', '', 122, 'b69b4ab3268044c6ad1c10af7c07b888.jpg'),
(33, 9, 'ww', 's', 'Main Cuisine', 'Srilankan', 22, '1.png'),
(34, 9, 'dd', 'www', 'Main Cuisine', 'Srilankan', 222, 'b69b4ab3268044c6ad1c10af7c07b888.jpg'),
(35, 9, 'www', 'dd', 'Main Cuisine', 'Srilankan', 111, '19938421.jpeg'),
(36, 9, 'ee', 'ww', 'Main Cuisine', 'Srilankan', 11, '1.png'),
(37, 9, 'rr', 'ee', 'Main Cuisine', 'Srilankan', 33, '19938421.jpeg'),
(38, 9, 'eeeee', 'ee', 'Main Cuisine', 'Srilankan', 22, '19938421.jpeg'),
(39, 9, 'aa', 'ss', 'Main Cuisine', 'Srilankan', 22, '1.png'),
(42, 9, 's', 'ss', 'Main Cuisine', 'Srilankan', 22, '19938421.jpeg'),
(43, 9, 'hs', 's', 'Main Cuisine', 'Srilankan', 22, '19938421.jpeg'),
(44, 9, 'wh', 'dj', 'Main Cuisine', 'Srilankan', 22, '19938421.jpeg'),
(45, 1, 'T1123', 'tes 123', 'Dessert', '', 1500, '1.png');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `user_name`, `user_email`, `message`, `created_at`) VALUES
(1, 15, 'test', 'my@gmail.com', 'aaaa', '2024-09-28 22:27:23'),
(2, 15, 'test', 'my@gmail.com', 'testttt', '2024-09-29 00:14:42');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `table_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `guests` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` tinyint(4) DEFAULT 0,
  `approvedBy` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `table_id`, `name`, `email`, `phone`, `guests`, `date`, `time`, `status`, `approvedBy`) VALUES
(1, 22, 'test', 'my@gmail.com', '011111111', 10, '2024-09-30', '22:11:00', 1, 'admin@gmail.com'),
(2, 19, 'test', 'my@gmail.com', '011111111', 2, '2024-09-26', '06:30:00', 1, 'test@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_tables`
--

CREATE TABLE `restaurant_tables` (
  `id` int(11) NOT NULL,
  `table_name` varchar(100) DEFAULT NULL,
  `chair_count` int(11) NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `restaurant_tables`
--

INSERT INTO `restaurant_tables` (`id`, `table_name`, `chair_count`, `status`) VALUES
(19, 'TBL-01', 2, 0),
(21, 'tt', 3, 0),
(22, 'Tblw -test', 10, 1),
(23, 'Tbl-004', 5, 0),
(24, 'TBL-06', 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `empId` int(11) NOT NULL,
  `firstName` varchar(100) DEFAULT NULL,
  `lastName` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `jobTitle` varchar(50) DEFAULT NULL,
  `mobileNo` varchar(15) DEFAULT NULL,
  `addr` varchar(255) DEFAULT NULL,
  `nic` varchar(20) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`empId`, `firstName`, `lastName`, `email`, `jobTitle`, `mobileNo`, `addr`, `nic`, `dob`, `password`, `photo`, `status`) VALUES
(2, 'ii', 'iioo', 'bdh@gmail.com', 'kitchenHelper', '977998', 'colomvo', '45678', '2023-07-18', 'a3aca2964e72000eea4c56cb341002a4', 'staff-image/66f1dce1c89da.png', 9),
(3, 'yy', 'yy', 'yy@gmail.com', 'cashier', '099', 'hdh', '22', '2024-05-21', '8f60c8102d29fcd525162d02eed4566b', 'staff-image/66f1dee83ece9.png', 1),
(4, 'test', 'yes', 'test@gmail.com', 'cashier', '111111', 'colombo', '111111v', '2024-09-04', 'e10adc3949ba59abbe56e057f20f883e', 'staff-image/66f1ee5d931ec.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) DEFAULT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `phone`, `address`, `gender`, `password`, `created_at`, `status`, `role`) VALUES
(9, 'user1', 'user1@gmail.com', '0776531846', 'colombo', 'Male', 'e10adc3949ba59abbe56e057f20f883e', '2024-09-20 17:40:02', 9, 'user'),
(10, 'test12', 'tt@gmail.com', '077652617', 'oop', 'Male', 'e10adc3949ba59abbe56e057f20f883e', '2024-09-21 11:46:58', 9, 'user'),
(12, 'ttff', 'ttff@gmail.com', '1111111111', 'kk', 'Female', 'e10adc3949ba59abbe56e057f20f883e', '2024-09-21 13:06:35', 9, 'user'),
(13, 'tt', 'te@gmail.com', '2222222222', 'hsh', 'Male', '827ccb0eea8a706c4c34a16891f84e7b', '2024-09-22 20:56:54', 9, 'user'),
(14, 'test', 'aa@gmail.com', '1111111111', 'nisns', 'Male', 'fcea920f7412b5da7be0cf42b8c93759', '2024-09-22 21:17:55', 9, 'user'),
(15, 'test', 'my@gmail.com', '011111111', 'Kaduwela', 'Male', 'e10adc3949ba59abbe56e057f20f883e', '2024-09-26 18:25:49', 1, 'user'),
(16, 'Ran', 'ran@gmail.com', '0118282882', 'colombo', 'Male', 'e10adc3949ba59abbe56e057f20f883e', '2024-09-26 19:18:24', 1, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_menus`
--
ALTER TABLE `booking_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foodOrder`
--
ALTER TABLE `foodOrder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_item`
--
ALTER TABLE `menu_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `table_id` (`table_id`);

--
-- Indexes for table `restaurant_tables`
--
ALTER TABLE `restaurant_tables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`empId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking_details`
--
ALTER TABLE `booking_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `booking_menus`
--
ALTER TABLE `booking_menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `foodOrder`
--
ALTER TABLE `foodOrder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu_item`
--
ALTER TABLE `menu_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `restaurant_tables`
--
ALTER TABLE `restaurant_tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `empId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`table_id`) REFERENCES `restaurant_tables` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
