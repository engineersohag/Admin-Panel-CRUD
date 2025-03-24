-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2025 at 06:02 PM
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
-- Database: `crypto`
--

-- --------------------------------------------------------

--
-- Table structure for table `exparts`
--

CREATE TABLE `exparts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `profile_img` varchar(255) NOT NULL,
  `certificate_img` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `nationality` varchar(150) NOT NULL,
  `citizenship` varchar(255) DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `expart_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exparts`
--

INSERT INTO `exparts` (`id`, `name`, `phone`, `email`, `profile_img`, `certificate_img`, `date_of_birth`, `nationality`, `citizenship`, `language`, `description`, `expart_id`) VALUES
(16, 'Sohag Hosen', '017505522', 'gj@gg.com', 'img/uploads/Sohag-Black.jpg', 'img/uploads/basic Computer Hi-Tech .jpg', '2025-03-21', 'Antarctica', 'BD, Japan', 'Bangla, English, Hindi', '<p>Testing</p>', 2597891831);

-- --------------------------------------------------------

--
-- Table structure for table `expart_education`
--

CREATE TABLE `expart_education` (
  `id` int(11) NOT NULL,
  `expart_id` bigint(11) DEFAULT NULL,
  `school` varchar(255) DEFAULT NULL,
  `degree` varchar(255) DEFAULT NULL,
  `field_of_study` varchar(255) DEFAULT NULL,
  `grade` varchar(50) DEFAULT NULL,
  `study_year` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expart_experience`
--

CREATE TABLE `expart_experience` (
  `id` int(11) NOT NULL,
  `expart_id` bigint(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `emp_type` varchar(255) DEFAULT NULL,
  `organization_name` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'Sohag Hosen', 'sss@gmail.com', '$2y$10$jq9yAf/sytWNNOi1Nr038OcVkxm80gKF3WW1CEu.x43.W.UV8Ehlm', 0),
(2, 'Hamil Hosen', 'ss@gmail.gg', '$2y$10$p.LJ6zh9LBDv3nkapV19TOdRiklmga7jjmy29bhpYQtlMD0UGL1nm', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exparts`
--
ALTER TABLE `exparts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `expart_id` (`expart_id`);

--
-- Indexes for table `expart_education`
--
ALTER TABLE `expart_education`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expart_education_ibfk_1` (`expart_id`);

--
-- Indexes for table `expart_experience`
--
ALTER TABLE `expart_experience`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expart_experience_ibfk_1` (`expart_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exparts`
--
ALTER TABLE `exparts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `expart_education`
--
ALTER TABLE `expart_education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `expart_experience`
--
ALTER TABLE `expart_experience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `expart_education`
--
ALTER TABLE `expart_education`
  ADD CONSTRAINT `expart_education_ibfk_1` FOREIGN KEY (`expart_id`) REFERENCES `exparts` (`expart_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `expart_experience`
--
ALTER TABLE `expart_experience`
  ADD CONSTRAINT `expart_experience_ibfk_1` FOREIGN KEY (`expart_id`) REFERENCES `exparts` (`expart_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
