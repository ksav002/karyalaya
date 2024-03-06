-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2024 at 05:47 PM
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
-- Database: `project_semesters`
--

-- --------------------------------------------------------

--
-- Table structure for table `eighth_semester`
--

CREATE TABLE `eighth_semester` (
  `course_code` varchar(10) NOT NULL,
  `course_title` varchar(50) DEFAULT NULL,
  `credit_hours` smallint(6) DEFAULT NULL,
  `lecture_hours` smallint(6) DEFAULT NULL,
  `tutorial_hours` smallint(6) DEFAULT NULL,
  `lab_hours` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eighth_semester`
--

INSERT INTO `eighth_semester` (`course_code`, `course_title`, `credit_hours`, `lecture_hours`, `tutorial_hours`, `lab_hours`) VALUES
('CACS453', 'Database Programming', 3, 3, NULL, NULL),
('CACS454', 'Geographical Information System', 3, 3, NULL, NULL),
('CACS455', 'Data Analysis and Visualization', 3, 3, NULL, NULL),
('CACS456', 'Machine Learning', 3, 3, NULL, NULL),
('CACS457', 'Multimedia System', 3, 3, NULL, NULL),
('CACS458', 'Knowledge Engineering', 3, 3, NULL, NULL),
('CACS459', 'Information Security', 3, 3, NULL, NULL),
('CAOR451', 'Operations Research', 3, 3, 1, NULL),
('CAPJ452', 'Project III', 6, NULL, NULL, 12);

-- --------------------------------------------------------

--
-- Table structure for table `fifth_semester`
--

CREATE TABLE `fifth_semester` (
  `course_code` varchar(10) NOT NULL,
  `course_title` varchar(50) DEFAULT NULL,
  `credit_hours` smallint(6) DEFAULT NULL,
  `lecture_hours` smallint(6) DEFAULT NULL,
  `tutorial_hours` smallint(6) DEFAULT NULL,
  `lab_hours` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fifth_semester`
--

INSERT INTO `fifth_semester` (`course_code`, `course_title`, `credit_hours`, `lecture_hours`, `tutorial_hours`, `lab_hours`) VALUES
('CACS301', 'MIS and e-Business', 3, 3, NULL, 2),
('CACS302', 'DotNet Technology', 3, 3, NULL, 3),
('CACS303', 'Computer Networking', 3, 3, NULL, 2),
('CACS305', 'Computer Graphics and Animation', 3, 3, 1, 2),
('CAMG304', 'Introduction to Management', 3, 3, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `first_semester`
--

CREATE TABLE `first_semester` (
  `course_code` varchar(10) NOT NULL,
  `course_title` varchar(50) DEFAULT NULL,
  `credit_hours` smallint(6) DEFAULT NULL,
  `lecture_hours` smallint(6) DEFAULT NULL,
  `tutorial_hours` smallint(6) DEFAULT NULL,
  `lab_hours` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `first_semester`
--

INSERT INTO `first_semester` (`course_code`, `course_title`, `credit_hours`, `lecture_hours`, `tutorial_hours`, `lab_hours`) VALUES
('CACS101', 'Computer Fundamentals & Applications', 4, 4, NULL, 4),
('CACS105', 'Digital Logic', 3, 3, NULL, 2),
('CAEN103', 'English I', 3, 3, 1, NULL),
('CAMT104', 'Mathematics I', 3, 3, 1, 1),
('CASO102', 'Society and Technology', 3, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fourth_semester`
--

CREATE TABLE `fourth_semester` (
  `course_code` varchar(10) NOT NULL,
  `course_title` varchar(50) DEFAULT NULL,
  `credit_hours` smallint(6) DEFAULT NULL,
  `lecture_hours` smallint(6) DEFAULT NULL,
  `tutorial_hours` smallint(6) DEFAULT NULL,
  `lab_hours` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fourth_semester`
--

INSERT INTO `fourth_semester` (`course_code`, `course_title`, `credit_hours`, `lecture_hours`, `tutorial_hours`, `lab_hours`) VALUES
('CACS251', 'Operating System', 4, 4, NULL, 4),
('CACS252', 'Numerical Methods', 3, 3, NULL, NULL),
('CACS253', 'Software Engineering', 3, 3, 1, NULL),
('CACS254', 'Scripting Language', 3, 3, 1, 1),
('CACS255', 'Database Management System', 3, 3, NULL, 2),
('CAPJ256', 'Project I', 2, NULL, NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `second_semester`
--

CREATE TABLE `second_semester` (
  `course_code` varchar(10) NOT NULL,
  `course_title` varchar(50) DEFAULT NULL,
  `credit_hours` smallint(6) DEFAULT NULL,
  `lecture_hours` smallint(6) DEFAULT NULL,
  `tutorial_hours` smallint(6) DEFAULT NULL,
  `lab_hours` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `second_semester`
--

INSERT INTO `second_semester` (`course_code`, `course_title`, `credit_hours`, `lecture_hours`, `tutorial_hours`, `lab_hours`) VALUES
('CAAC152', 'Financial Accounting', 3, 3, 1, 1),
('CACS151', 'C programming', 4, 4, 1, 3),
('CACS155', 'Microprocessor and Computer Architecture', 3, 3, 1, 2),
('CAEN153', 'English III', 3, 3, 1, NULL),
('CAMT154', 'Mathematics II', 3, 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `seventh_semester`
--

CREATE TABLE `seventh_semester` (
  `course_code` varchar(10) NOT NULL,
  `course_title` varchar(50) DEFAULT NULL,
  `credit_hours` smallint(6) DEFAULT NULL,
  `lecture_hours` smallint(6) DEFAULT NULL,
  `tutorial_hours` smallint(6) DEFAULT NULL,
  `lab_hours` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seventh_semester`
--

INSERT INTO `seventh_semester` (`course_code`, `course_title`, `credit_hours`, `lecture_hours`, `tutorial_hours`, `lab_hours`) VALUES
('CACS401', 'Cyber Law and Professional Ethics', 3, 3, 1, NULL),
('CACS402', 'Cloud Computing', 3, 3, NULL, 3),
('CACS404', 'Image Processing', 3, 3, NULL, NULL),
('CACS405', 'Database Administration', 3, 3, NULL, NULL),
('CACS406', 'Network Administration', 3, 3, NULL, NULL),
('CACS408', 'Advanced Dot Net Technology', 3, 3, NULL, NULL),
('CACS409', 'E-Governance', 3, 3, NULL, NULL),
('CAIN103', 'Internship', 3, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sixth_semester`
--

CREATE TABLE `sixth_semester` (
  `course_code` varchar(10) NOT NULL,
  `course_title` varchar(50) DEFAULT NULL,
  `credit_hours` smallint(6) DEFAULT NULL,
  `lecture_hours` smallint(6) DEFAULT NULL,
  `tutorial_hours` smallint(6) DEFAULT NULL,
  `lab_hours` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sixth_semester`
--

INSERT INTO `sixth_semester` (`course_code`, `course_title`, `credit_hours`, `lecture_hours`, `tutorial_hours`, `lab_hours`) VALUES
('CACS351', 'Mobile Programming', 3, 3, NULL, 3),
('CACS352', 'Distributed System', 3, 3, 1, NULL),
('CACS353', 'Applied Economics', 3, 3, 1, NULL),
('CACS354', 'Advanced Java Programming', 3, 3, NULL, 3),
('CACS355', 'Network Programming', 3, 3, NULL, 2),
('CAPJ356', 'PROJECT', 2, NULL, NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `third_semester`
--

CREATE TABLE `third_semester` (
  `course_code` varchar(10) NOT NULL,
  `course_title` varchar(50) DEFAULT NULL,
  `credit_hours` smallint(6) DEFAULT NULL,
  `lecture_hours` smallint(6) DEFAULT NULL,
  `tutorial_hours` smallint(6) DEFAULT NULL,
  `lab_hours` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `third_semester`
--

INSERT INTO `third_semester` (`course_code`, `course_title`, `credit_hours`, `lecture_hours`, `tutorial_hours`, `lab_hours`) VALUES
('CACS201', 'Data Structure and Algorithms', 3, 3, NULL, 3),
('CACS203', 'System Analysis and Design', 3, 3, 1, NULL),
('CACS204', 'OOP in Java', 3, 3, 1, 2),
('CACS205', 'Web Technology', 3, 3, NULL, 3),
('CAST202', 'Probability and Statistics', 3, 3, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eighth_semester`
--
ALTER TABLE `eighth_semester`
  ADD PRIMARY KEY (`course_code`);

--
-- Indexes for table `fifth_semester`
--
ALTER TABLE `fifth_semester`
  ADD PRIMARY KEY (`course_code`);

--
-- Indexes for table `first_semester`
--
ALTER TABLE `first_semester`
  ADD PRIMARY KEY (`course_code`);

--
-- Indexes for table `fourth_semester`
--
ALTER TABLE `fourth_semester`
  ADD PRIMARY KEY (`course_code`);

--
-- Indexes for table `second_semester`
--
ALTER TABLE `second_semester`
  ADD PRIMARY KEY (`course_code`);

--
-- Indexes for table `seventh_semester`
--
ALTER TABLE `seventh_semester`
  ADD PRIMARY KEY (`course_code`);

--
-- Indexes for table `sixth_semester`
--
ALTER TABLE `sixth_semester`
  ADD PRIMARY KEY (`course_code`);

--
-- Indexes for table `third_semester`
--
ALTER TABLE `third_semester`
  ADD PRIMARY KEY (`course_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
