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
-- Database: `project_students`
--

-- --------------------------------------------------------

--
-- Table structure for table `batch_2020`
--

CREATE TABLE `batch_2020` (
  `student_id` smallint(6) NOT NULL,
  `fname` varchar(20) DEFAULT NULL,
  `lname` varchar(20) DEFAULT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `username` varchar(8) DEFAULT NULL,
  `password` char(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `age` smallint(6) GENERATED ALWAYS AS (timestampdiff(YEAR,`dob`,curdate())) VIRTUAL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `batch_2020`
--

INSERT INTO `batch_2020` (`student_id`, `fname`, `lname`, `phone`, `email`, `username`, `password`, `dob`) VALUES
(1, 'John', 'Doe', 1234567890, 'john@example.com', 'johndoe', '482c811da5d5b4bc6d497ffa98491e38', '1990-05-15'),
(2, 'Jane', 'Smith', 9876543210, 'jane@example.com', 'janesmit', '0f359740bd1cda994f8b55330c86d845', '1995-10-25'),
(3, 'Alice', 'Johnson', 5551234567, 'alice@example.com', 'alicej', 'b0439fae31f8cbba6294af86234d5a28', '1988-12-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `batch_2020`
--
ALTER TABLE `batch_2020`
  ADD PRIMARY KEY (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `batch_2020`
--
ALTER TABLE `batch_2020`
  MODIFY `student_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
