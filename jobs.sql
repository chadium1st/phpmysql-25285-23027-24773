-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 03, 2023 at 01:44 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobs`
--

-- --------------------------------------------------------

--
-- Table structure for table `jobapplication`
--

CREATE TABLE `jobapplication` (
  `application_id` int(11) NOT NULL,
  `job_id` int(11) DEFAULT NULL,
  `job_seeker_id` int(11) DEFAULT NULL,
  `application_status` enum('pending','rejected','accepted') DEFAULT NULL,
  `submission_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobposting`
--

CREATE TABLE `jobposting` (
  `job_id` int(11) NOT NULL,
  `recruiter_id` int(11) DEFAULT NULL,
  `job_title` varchar(255) DEFAULT NULL,
  `job_description` varchar(7000) DEFAULT NULL,
  `qualifications` varchar(255) DEFAULT NULL,
  `job_location` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `reportId` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `report_txt` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resume`
--

CREATE TABLE `resume` (
  `resume_id` int(11) NOT NULL,
  `job_seeker` int(11) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(1000) NOT NULL,
  `user_email` varchar(1500) NOT NULL,
  `user_ph_no` bigint(20) NOT NULL,
  `user_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_password`, `user_email`, `user_ph_no`, `user_role`) VALUES
(1, 'kashan', '$2y$10$61gSTrI3zqEWB2FQlZuuAOI9.7V.BNE7y7SxdTAcbqavI7Oq3wYD.', 'kashan@gmail.com', 12345, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobapplication`
--
ALTER TABLE `jobapplication`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `job_id` (`job_id`),
  ADD KEY `job_seeker_id` (`job_seeker_id`);

--
-- Indexes for table `jobposting`
--
ALTER TABLE `jobposting`
  ADD PRIMARY KEY (`job_id`),
  ADD KEY `recruiter_id` (`recruiter_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`reportId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `resume`
--
ALTER TABLE `resume`
  ADD PRIMARY KEY (`resume_id`),
  ADD KEY `job_seeker` (`job_seeker`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`) USING HASH;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jobapplication`
--
ALTER TABLE `jobapplication`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobposting`
--
ALTER TABLE `jobposting`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `reportId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resume`
--
ALTER TABLE `resume`
  MODIFY `resume_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jobapplication`
--
ALTER TABLE `jobapplication`
  ADD CONSTRAINT `jobapplication_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `jobposting` (`job_id`),
  ADD CONSTRAINT `jobapplication_ibfk_2` FOREIGN KEY (`job_seeker_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `jobposting`
--
ALTER TABLE `jobposting`
  ADD CONSTRAINT `jobposting_ibfk_1` FOREIGN KEY (`recruiter_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `resume`
--
ALTER TABLE `resume`
  ADD CONSTRAINT `resume_ibfk_1` FOREIGN KEY (`job_seeker`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
