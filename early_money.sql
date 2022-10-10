-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2022 at 09:43 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `early_money`
--

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE `deposit` (
  `id` int(11) NOT NULL,
  `acct_num` varchar(20) NOT NULL,
  `fname` varchar(150) NOT NULL,
  `amount` int(100) NOT NULL,
  `d_status` varchar(5) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deposit`
--

INSERT INTO `deposit` (`id`, `acct_num`, `fname`, `amount`, `d_status`, `date_created`) VALUES
(1, 'EM3205290', 'Chris Graham  ', 50000, '1', '2022-10-01 15:02:44'),
(2, 'EM3205290', 'Chris Graham  ', 20000, '1', '2022-10-01 15:02:27');

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
  `id` int(11) NOT NULL,
  `userid` varchar(30) NOT NULL,
  `send_acct` varchar(30) NOT NULL,
  `rec_acct` varchar(30) NOT NULL,
  `descr` varchar(300) NOT NULL,
  `amount` int(10) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transfers`
--

INSERT INTO `transfers` (`id`, `userid`, `send_acct`, `rec_acct`, `descr`, `amount`, `date_created`) VALUES
(3, '5', 'EM3205290', 'EM1703415', 'Food', 2000, '2022-10-04 14:38:05'),
(4, '5', 'EM3205290', 'EM1703415', 'Food', 4000, '2022-10-04 14:38:27'),
(5, '3', 'EM1703415', 'EM3205290', 'Food', 1000, '2022-10-04 14:49:09'),
(6, '3', 'EM1703415', 'EM5532817', 'Food', 1000, '2022-10-04 14:53:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `account_uid` varchar(30) NOT NULL,
  `cur_balance` int(30) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(18) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `passwords` varchar(300) NOT NULL,
  `val_pin` varchar(300) NOT NULL,
  `user_role` varchar(10) NOT NULL,
  `prof_pic` varchar(30) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `account_uid`, `cur_balance`, `full_name`, `email`, `phone`, `dob`, `gender`, `passwords`, `val_pin`, `user_role`, `prof_pic`, `date_created`) VALUES
(1, 'EM7928978', 0, 'admin', 'admin@gmail.com', '+2348124423122', '2022-09-19', 'Male', '$2y$10$1yIl2hTQCtiMY8A0vn5vU.GhR09M7wz/M0DL5aQyBkR7nqBHvC14y', '', 'admin', '', '2022-09-20'),
(3, 'EM1703415', 8000, 'Mary', 'mary@gmail.com', '+2348124423122', '2022-08-31', 'Female', '$2y$10$TDXbFofB25b3NcBII0yVduYpu9oomm2s.8kg2KIZFLvdniMHUQEE2', '$2y$10$zr1z2Z0cP84/0aHsTIeII.oCJVRdFvsUVfBm6HJgiGBNHypVIOCva', 'user', '', '2022-09-20'),
(5, 'EM3205290', 60600, 'Chris Graham ', 'tester@gmail.com', '+2348124423122 ', '2022-08-30', 'Male', '$2y$10$eZcmkdtZIxBOU5UfosIPUuWujd5vmG.JcHFJSBegUE1O41UqqggW2', '$2y$10$cLQq1SH8xKJ3EMzvdH1XHeCUPwSRlcRfQ9y5CUujVmFcnOI04tiCa', 'user', '', '2022-09-22'),
(6, 'EM5532817', 1000, 'Andak Shipping', 'andak@gmail.com', '+495402058450', '2022-09-15', 'Male', '$2y$10$82eow7g/q2lRoTTJTZEszOv1uMtDdHFkLemnrudOgmNgldNhsoglS', '', 'user', '', '2022-09-27'),
(8, 'EM3498692', 0, 'Michael Scoffield ', 'michael@gmail.com', '08124423122', '2022-09-23', 'Male', '$2y$10$N47.3iZuI95u8yrW95eR.u2qDCJHgtBtHvBu5DwvuYgB6jCKutoPy', '', 'user', '', '2022-09-29');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw`
--

CREATE TABLE `withdraw` (
  `id` int(11) NOT NULL,
  `acct_num` varchar(30) NOT NULL,
  `fname` varchar(200) NOT NULL,
  `amount` int(100) NOT NULL,
  `d_status` varchar(5) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `withdraw`
--

INSERT INTO `withdraw` (`id`, `acct_num`, `fname`, `amount`, `d_status`, `date_created`) VALUES
(1, 'EM3205290', 'Chris Graham  ', 100, '0', '2022-10-07 07:35:24'),
(2, 'EM3205290', 'Chris Graham  ', 200, '0', '2022-10-07 07:36:46'),
(3, 'EM3205290', 'Chris Graham  ', 200, '1', '2022-10-07 07:41:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw`
--
ALTER TABLE `withdraw`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `deposit`
--
ALTER TABLE `deposit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `withdraw`
--
ALTER TABLE `withdraw`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
