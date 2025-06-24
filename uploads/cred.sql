-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2025 at 11:30 AM
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
-- Database: `cred`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `a_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_id`, `email`, `password`, `date`) VALUES
(1, 'stiiadmin@gmail.com', 'admin123', '2025-03-25 19:17:07');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `c_id` int(11) NOT NULL,
  `d_id` int(11) NOT NULL,
  `a_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_status` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`c_id`, `d_id`, `a_id`, `course_name`, `course_status`, `date`) VALUES
(1, 1, 1, 'Bachelor of Science in Information Technology', 'Active', '2025-03-25 19:20:50'),
(2, 1, 1, 'Associates in Computer Technology', 'Active', '2025-03-25 19:20:59'),
(3, 1, 1, 'Bachelor of Science in Computer Science', 'Active', '2025-03-25 19:21:07'),
(4, 1, 1, 'Bachelor of Multimedia Arts', 'Active', '2025-03-25 19:21:14');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `d_id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `department_status` varchar(255) NOT NULL,
  `a_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`d_id`, `department_name`, `department_status`, `a_id`, `date`) VALUES
(1, 'College of Computer Studies', 'Active', 1, '2025-03-27 12:21:33'),
(2, 'College of Agriculture', 'Active', 1, '2025-03-25 19:19:40'),
(3, 'College of Business Administration', 'Active', 1, '2025-03-25 19:19:47'),
(4, 'College of Criminology', 'Active', 1, '2025-03-25 19:19:53'),
(5, 'College of Midwifery', 'Active', 1, '2025-03-25 19:20:00'),
(6, 'College of Hospitality Management', 'Active', 1, '2025-03-25 19:20:12'),
(7, 'College of BAELS', 'Active', 1, '2025-03-25 19:20:22'),
(8, 'College of BTVTED', 'Active', 1, '2025-03-25 19:20:38');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `s_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `suffix_name` varchar(255) NOT NULL,
  `date_birth` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `civil_status` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `municipality` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `student_vcode` varchar(255) NOT NULL,
  `student_status` varchar(255) NOT NULL,
  `year_graduated` varchar(255) NOT NULL,
  `date_graduation` varchar(255) NOT NULL,
  `a_id` int(11) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `diploma` varchar(255) NOT NULL,
  `graduation` varchar(255) NOT NULL,
  `tor` varchar(255) NOT NULL,
  `honors` varchar(255) NOT NULL,
  `c_id` int(11) NOT NULL,
  `d_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`s_id`, `first_name`, `middle_name`, `last_name`, `suffix_name`, `date_birth`, `age`, `gender`, `civil_status`, `province`, `municipality`, `barangay`, `street`, `student_id`, `student_vcode`, `student_status`, `year_graduated`, `date_graduation`, `a_id`, `profile`, `diploma`, `graduation`, `tor`, `honors`, `c_id`, `d_id`, `date`) VALUES
(1, 'Roderick', 'Timtim', 'Alingco', 'None', '2001-06-13', '23', 'Male', 'Single', 'Zamboanga Sibugay', 'Olutanga', 'Fama', 'Purok 1', '701216', '784923', 'Verified', '2025-2026', '2026-06-20', 1, '../uploads/adcc43df-483f-4043-b129-e1ef16d3fc97.jpg', '../diploma/6c5e9524-0017-48e7-8ff2-f53b1fdaa971.jpg', '../Credentials/b3b9a0bb-3abb-4c9c-bba2-6fb5a1189e4c.jpg', '../TOR/485175838_122210362814191808_9095756246607518685_n.jpg', 'Magna Cum Laude', 1, 1, '2025-03-24 16:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`s_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
