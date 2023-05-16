-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2023 at 04:19 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `raspberry_rfid_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_db`
--

CREATE TABLE `admin_db` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT '',
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_db`
--

INSERT INTO `admin_db` (`id`, `name`, `user_name`, `password`, `user_type`, `date`) VALUES
(1, 'Joey Sumalpong', 'nice12@gmail.com', '123', 'Admin', '2023-05-12 16:00:00'),
(2, 'Erica', 'kang1@yahoo.com', '123', 'Admin', '2023-05-12 16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `clock_in` int(25) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `rfid_uid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` int(11) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `rfid_uid`, `name`, `created`) VALUES
(1, '000001', 'Joey Sumalpong', 2023);

-- --------------------------------------------------------

--
-- Table structure for table `user_db`
--

CREATE TABLE `user_db` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'User',
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_db`
--

INSERT INTO `user_db` (`id`, `name`, `email`, `password`, `user_type`, `date`) VALUES
(1, 'Jonas', 'sample@gmail.com', '202cb962ac59075b964b07152d234b70', 'user', '2023-05-12 19:32:50'),
(2, 'Lester', 'nas@yahoo.com', '202cb962ac59075b964b07152d234b70', 'user', '2023-05-12 19:32:50'),
(3, 'Joey', 'yamake@gmail.com', '123', 'user', '2023-05-12 19:32:50'),
(4, 'Erica', 'kang@gmail.com', '123', 'user', '2023-05-12 19:32:50'),
(5, 'John Lester', 'lester@gmail.com', '123', 'user', '2023-05-12 19:32:50'),
(6, 'Joey', 'xjazzb@gmail.com', '12345', 'user', '2023-05-12 19:32:50'),
(7, 'Sumalpong', 'nays@gmail.com', '123', 'user', '2023-05-12 19:32:50'),
(8, 'wow', 'wow@gmail.com', '123', 'user', '2023-05-12 19:32:50'),
(9, 'Joey Sumalpong', 'nice@gmail.com', '123', 'user', '2023-05-12 19:32:50'),
(10, 'Joey Sumalpong', 'nice@gmail.com', '123', 'user', '2023-05-12 19:32:50'),
(11, 'Joey Sumalpong', 'nice@gmail.com', '123', 'user', '2023-05-12 19:32:50'),
(12, 'Joey Sumalpong', 'nice@gmail.com', '123', 'user', '2023-05-12 19:32:50'),
(13, 'Joey Sumalpong', 'sample1@yahoo.com', '123', 'user', '2023-05-12 19:32:50'),
(14, 'Dep', 'dep@gmail.com', '123', 'user', '2023-05-12 19:32:50'),
(15, 'Russel', 'russel@gmail.com', '123', 'user', '2023-05-12 19:32:50'),
(16, 'Kamil', 'Kamil@gmail.com', '123', 'user', '2023-05-12 20:59:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_db`
--
ALTER TABLE `admin_db`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_db`
--
ALTER TABLE `user_db`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_db`
--
ALTER TABLE `user_db`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
