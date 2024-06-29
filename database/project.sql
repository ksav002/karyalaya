-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2024 at 03:48 PM
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
-- Database: `project`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateSemesterForBatch` (IN `batchYearParam` YEAR)   BEGIN
    DECLARE graduatedRemark VARCHAR(20);
    
    SET graduatedRemark = (SELECT CASE WHEN (SELECT semester_number + 1 FROM batch WHERE batch_year = batchYearParam) > 8 THEN 'graduated' ELSE NULL END);
    
    UPDATE batch
    SET semester_number = semester_number + 1,
        remarks = graduatedRemark
    WHERE batch_year = batchYearParam;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`) VALUES
(1, 'Admin One', 'admin1@example.com', 'password123'),
(2, 'Admin Two', 'admin2@example.com', '123password');

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `assignment_id` int(11) NOT NULL,
  `assignment_category_id` int(11) DEFAULT NULL,
  `assignment_text` text NOT NULL,
  `deadline` date NOT NULL,
  `assignment_file` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`assignment_id`, `assignment_category_id`, `assignment_text`, `deadline`, `assignment_file`) VALUES
(105, 1, 'This is assignment of chapter 1 of CACS205.', '2024-06-29', ''),
(106, 2, 'This is assignment of chapter 2 of CACS205.', '2024-06-05', ''),
(107, 1, 'This is assignment of chapter 1 of CACS205.', '2024-04-11', ''),
(108, 2, 'This is assignment of chapter 2 of CACS205.', '2024-05-08', ''),
(131, 53, 'This is a assignment title.', '2024-07-05', 'question_663756f54bb206.60781696.pdf'),
(132, 47, 'Check this file and submit answers accordingly.', '2024-06-05', 'question_66375959ad4b18.14660373.pdf'),
(133, 47, 'Provide a thesis on \"THIS TOPIC\".', '2024-05-02', 'question_66375d9cea88b7.70670099.pdf'),
(184, 3, 'A new question added here', '2024-06-20', ''),
(185, 72, 'Proposal Submission', '2024-06-28', 'answer_6674f394d73220.33294310.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `assignment_category`
--

CREATE TABLE `assignment_category` (
  `assignment_category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `teacher_courses_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignment_category`
--

INSERT INTO `assignment_category` (`assignment_category_id`, `category_name`, `teacher_courses_id`) VALUES
(1, 'Chapter 1', 1),
(2, 'Chapter 2', 1),
(3, 'Chapter 3', 1),
(47, 'Chapter 4', 1),
(53, 'Chapter 5', 1),
(54, 'Chapter 6', 1),
(55, 'Chapter 7', 1),
(61, 'Chapter 1', 2),
(63, 'Chapter 2', 2),
(64, 'Chapter 3', 2),
(65, 'Chapter 4', 2),
(71, 'Chapter 8', 1),
(72, 'Project Work', 1);

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `batch_year` year(4) NOT NULL,
  `semester_number` smallint(6) DEFAULT NULL,
  `remarks` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`batch_year`, `semester_number`, `remarks`) VALUES
('2020', 7, NULL),
('2021', 5, NULL),
('2022', 3, NULL),
('2023', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chosen_electives`
--

CREATE TABLE `chosen_electives` (
  `elective_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `semester_number` smallint(6) DEFAULT NULL,
  `elective_courses_code` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chosen_electives`
--

INSERT INTO `chosen_electives` (`elective_id`, `student_id`, `semester_number`, `elective_courses_code`) VALUES
(1, 105, 7, 'CACS410'),
(2, 105, 7, 'CACS405');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_code` varchar(10) NOT NULL,
  `course_title` varchar(50) DEFAULT NULL,
  `credit_hours` smallint(6) DEFAULT NULL,
  `lecture_hours` smallint(6) DEFAULT NULL,
  `tutorial_hours` smallint(6) DEFAULT NULL,
  `lab_hours` smallint(6) DEFAULT NULL,
  `elective_subject` tinyint(1) NOT NULL,
  `semester_number` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_code`, `course_title`, `credit_hours`, `lecture_hours`, `tutorial_hours`, `lab_hours`, `elective_subject`, `semester_number`) VALUES
('CAAC152', 'Financial Accounting', 3, 3, 1, 1, 0, 2),
('CACS101', 'Computer Fundamentals & Applications', 4, 4, NULL, 4, 0, 1),
('CACS105', 'Digital Logic', 3, 3, NULL, 2, 0, 1),
('CACS151', 'C programming', 4, 4, 1, 3, 0, 2),
('CACS155', 'Microprocessor and Computer Architecture', 3, 3, 1, 2, 0, 2),
('CACS201', 'Data Structure and Algorithms', 3, 3, NULL, 3, 0, 3),
('CACS203', 'System Analysis and Design', 3, 3, 1, NULL, 0, 3),
('CACS204', 'OOP in Java', 3, 3, 1, 2, 0, 3),
('CACS205', 'Web Technology', 3, 3, NULL, 3, 0, 3),
('CACS251', 'Operating System', 4, 4, NULL, 4, 0, 4),
('CACS252', 'Numerical Methods', 3, 3, NULL, NULL, 0, 4),
('CACS253', 'Software Engineering', 3, 3, 1, NULL, 0, 4),
('CACS254', 'Scripting Language', 3, 3, 1, 1, 0, 4),
('CACS255', 'Database Management System', 3, 3, NULL, 2, 0, 4),
('CACS301', 'MIS and e-Business', 3, 3, NULL, 2, 0, 5),
('CACS302', 'DotNet Technology', 3, 3, NULL, 3, 0, 5),
('CACS303', 'Computer Networking', 3, 3, NULL, 2, 0, 5),
('CACS305', 'Computer Graphics and Animation', 3, 3, 1, 2, 0, 5),
('CACS351', 'Mobile Programming', 3, 3, NULL, 3, 0, 6),
('CACS352', 'Distributed System', 3, 3, 1, NULL, 0, 6),
('CACS353', 'Applied Economics', 3, 3, 1, NULL, 0, 6),
('CACS354', 'Advanced Java Programming', 3, 3, NULL, 3, 0, 6),
('CACS355', 'Network Programming', 3, 3, NULL, 2, 0, 6),
('CACS401', 'Cyber Law and Professional Ethics', 3, 3, 1, NULL, 0, 7),
('CACS402', 'Cloud Computing', 3, 3, NULL, 3, 0, 7),
('CACS404', 'Image Processing', 3, 3, NULL, NULL, 1, 7),
('CACS405', 'Database Administration', 3, 3, NULL, NULL, 1, 7),
('CACS406', 'Network Administration', 3, 3, NULL, NULL, 1, 7),
('CACS408', 'Advanced Dot Net Technology', 3, 3, NULL, NULL, 1, 7),
('CACS409', 'E-Governance', 3, 3, NULL, NULL, 1, 7),
('CACS410', 'Artificial Intelligence', 3, 3, NULL, NULL, 1, 7),
('CACS453', 'Database Programming', 3, 3, NULL, NULL, 1, 8),
('CACS454', 'Geographical Information System', 3, 3, NULL, NULL, 1, 8),
('CACS455', 'Data Analysis and Visualization', 3, 3, NULL, NULL, 1, 8),
('CACS456', 'Machine Learning', 3, 3, NULL, NULL, 1, 8),
('CACS457', 'Multimedia System', 3, 3, NULL, NULL, 1, 8),
('CACS458', 'Knowledge Engineering', 3, 3, NULL, NULL, 1, 8),
('CACS459', 'Information Security', 3, 3, NULL, NULL, 1, 8),
('CACS460', 'Internet of Things', 3, 3, NULL, NULL, 1, 8),
('CAEN103', 'English I', 3, 3, 1, NULL, 0, 1),
('CAEN153', 'English II', 3, 3, 1, NULL, 0, 2),
('CAIN103', 'Internship', 3, NULL, NULL, NULL, 0, 7),
('CAMG304', 'Introduction to Management', 3, 3, 1, NULL, 0, 5),
('CAMT104', 'Mathematics I', 3, 3, 1, 1, 0, 1),
('CAMT154', 'Mathematics II', 3, 3, 1, 1, 0, 2),
('CAOR451', 'Operations Research', 3, 3, 1, NULL, 0, 8),
('CAPJ256', 'Project I', 2, NULL, NULL, 4, 0, 4),
('CAPJ356', 'Project II', 2, NULL, NULL, 4, 0, 6),
('CAPJ452', 'Project III', 6, NULL, NULL, 12, 0, 8),
('CASO102', 'Society and Technology', 3, 3, NULL, NULL, 0, 1),
('CAST202', 'Probability and Statistics', 3, 3, 1, 1, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `semester_number` smallint(6) NOT NULL,
  `semester_value` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`semester_number`, `semester_value`) VALUES
(1, 'first_semester'),
(2, 'second_semester'),
(3, 'third_semester'),
(4, 'fourth_semester'),
(5, 'fifth_semester'),
(6, 'sixth_semester'),
(7, 'seventh_semester'),
(8, 'eighth_semester'),
(9, ' for_miscellaneous_data');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `fname` varchar(20) DEFAULT NULL,
  `lname` varchar(20) DEFAULT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `username` varchar(8) DEFAULT NULL,
  `password` char(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `batch_year` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `fname`, `lname`, `phone`, `email`, `username`, `password`, `dob`, `batch_year`) VALUES
(101, 'John', 'Doe', 1234567890, 'john.doe@example.com', 'johndoe', '482c811da5d5b4bc6d497ffa98491e38', '1995-05-20', '2022'),
(102, 'Jane', 'Smith', 9876543210, 'jane.smith@example.com', 'janesmit', '5edb023cae7c00f792358e9c82db531d', '1998-10-15', '2023'),
(103, 'Alice', 'Johnson', 1112223333, 'alice.johnson@example.com', 'alicej', '50b9798b5454b52f93f37b15ad4680cd', '1997-08-28', '2023'),
(104, 'Bob', 'Williams', 5554447777, 'bob.williams@example.com', 'bobby', 'd201b6428943b9487fb7d524441219c3', '1996-03-12', '2022'),
(105, 'Emily', 'Brown', 9998887777, 'emily.brown@example.com', 'emilyb', '0abcba6bdc4f558493de86b8d3e19c84', '1999-12-05', '2020'),
(110, 'sujan', 'shrestha', 111111111, 'sujan@example.com', 'sujan123', '5f4dcc3b5aa765d61d8327deb882cf99', '2003-05-12', '2021');

-- --------------------------------------------------------

--
-- Table structure for table `submission`
--

CREATE TABLE `submission` (
  `submission_id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `teacher_courses_id` int(11) NOT NULL,
  `uploaded_datetime` timestamp NOT NULL DEFAULT current_timestamp(),
  `submission_file` varchar(50) NOT NULL,
  `feedback` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `submission`
--

INSERT INTO `submission` (`submission_id`, `assignment_id`, `student_id`, `teacher_courses_id`, `uploaded_datetime`, `submission_file`, `feedback`) VALUES
(106, 105, 105, 1, '2024-04-29 05:17:36', '', 'asadsadasdas'),
(119, 184, 101, 1, '2024-06-20 06:01:54', 'answer_6673c5d2d3b3e8.71203376.pdf', NULL),
(121, 185, 101, 1, '2024-06-21 03:50:18', 'answer_6674f87ae05642.39842071.pdf', NULL),
(122, 105, 101, 1, '2024-06-28 07:44:11', 'answer_667e69cb357316.13547033.pdf', 'xzcczx');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacher_id` int(11) NOT NULL,
  `fname` varchar(20) DEFAULT NULL,
  `lname` varchar(20) DEFAULT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `username` varchar(8) DEFAULT NULL,
  `password` char(255) DEFAULT NULL,
  `dob` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `fname`, `lname`, `phone`, `email`, `username`, `password`, `dob`) VALUES
(101, 'David', 'Garcia', 1234567890, 'david.garcia@example.com', 'daveg', '7d347cf0ee68174a3588f6cba31b8a67', '1980-06-01'),
(102, 'Jessica', 'Rodriguez', 9876543210, 'jessica.rodriguez@example.com', 'jessrodr', 'b06fd89c47434bb57edd340255b5ef73', '1985-11-17'),
(103, 'Daniel', 'Martinez', 1112223333, 'daniel.martinez@example.com', 'danmart', '6931702550544ff0db1db216f351192c', '1987-02-09'),
(104, 'Michelle', 'Lopez', 5554447777, 'michelle.lopez@example.com', 'michllop', '06ee2d4b9ce7961f4718f66da1851ed4', '1989-09-24'),
(105, 'Kevin', 'Hernandez', 9998887777, 'kevin.hernandez@example.com', 'kevhern', 'f8a1d9cf3df31609b223416d6352457c', '1992-05-08');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_courses`
--

CREATE TABLE `teacher_courses` (
  `teacher_courses_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `course_code` varchar(10) NOT NULL,
  `active_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_courses`
--

INSERT INTO `teacher_courses` (`teacher_courses_id`, `teacher_id`, `course_code`, `active_status`) VALUES
(1, 101, 'CACS205', 1),
(2, 101, 'CACS254', 1),
(3, 102, 'CAST202', 1),
(4, 102, 'CACS252', 1),
(5, 103, 'CACS251', 1),
(6, 104, 'CACS253', 1),
(7, 104, 'CACS203', 0),
(8, 105, 'CACS255', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`assignment_id`),
  ADD KEY `assignments_ibfk_1` (`assignment_category_id`),
  ADD KEY `assignment_id` (`assignment_id`) USING BTREE;

--
-- Indexes for table `assignment_category`
--
ALTER TABLE `assignment_category`
  ADD PRIMARY KEY (`assignment_category_id`),
  ADD KEY `teacher_courses_id` (`teacher_courses_id`);

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`batch_year`),
  ADD KEY `semester_number` (`semester_number`);

--
-- Indexes for table `chosen_electives`
--
ALTER TABLE `chosen_electives`
  ADD PRIMARY KEY (`elective_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `semester_number` (`semester_number`),
  ADD KEY `elective_courses_code` (`elective_courses_code`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_code`),
  ADD KEY `semester_number` (`semester_number`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`semester_number`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `batch_year` (`batch_year`);

--
-- Indexes for table `submission`
--
ALTER TABLE `submission`
  ADD PRIMARY KEY (`submission_id`),
  ADD KEY `assignment_id` (`assignment_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `teacher_courses_id` (`teacher_courses_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `teacher_courses`
--
ALTER TABLE `teacher_courses`
  ADD PRIMARY KEY (`teacher_courses_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `course_code` (`course_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT for table `assignment_category`
--
ALTER TABLE `assignment_category`
  MODIFY `assignment_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `chosen_electives`
--
ALTER TABLE `chosen_electives`
  MODIFY `elective_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `submission`
--
ALTER TABLE `submission`
  MODIFY `submission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `teacher_courses`
--
ALTER TABLE `teacher_courses`
  MODIFY `teacher_courses_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `assignments_ibfk_1` FOREIGN KEY (`assignment_category_id`) REFERENCES `assignment_category` (`assignment_category_id`);

--
-- Constraints for table `assignment_category`
--
ALTER TABLE `assignment_category`
  ADD CONSTRAINT `assignment_category_ibfk_1` FOREIGN KEY (`teacher_courses_id`) REFERENCES `teacher_courses` (`teacher_courses_id`);

--
-- Constraints for table `batch`
--
ALTER TABLE `batch`
  ADD CONSTRAINT `batch_ibfk_1` FOREIGN KEY (`semester_number`) REFERENCES `semesters` (`semester_number`);

--
-- Constraints for table `chosen_electives`
--
ALTER TABLE `chosen_electives`
  ADD CONSTRAINT `chosen_electives_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`),
  ADD CONSTRAINT `chosen_electives_ibfk_2` FOREIGN KEY (`semester_number`) REFERENCES `semesters` (`semester_number`),
  ADD CONSTRAINT `chosen_electives_ibfk_3` FOREIGN KEY (`elective_courses_code`) REFERENCES `courses` (`course_code`);

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`semester_number`) REFERENCES `semesters` (`semester_number`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`batch_year`) REFERENCES `batch` (`batch_year`);

--
-- Constraints for table `submission`
--
ALTER TABLE `submission`
  ADD CONSTRAINT `submission_ibfk_1` FOREIGN KEY (`assignment_id`) REFERENCES `assignments` (`assignment_id`),
  ADD CONSTRAINT `submission_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`),
  ADD CONSTRAINT `submission_ibfk_3` FOREIGN KEY (`teacher_courses_id`) REFERENCES `teacher_courses` (`teacher_courses_id`);

--
-- Constraints for table `teacher_courses`
--
ALTER TABLE `teacher_courses`
  ADD CONSTRAINT `teacher_courses_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`),
  ADD CONSTRAINT `teacher_courses_ibfk_2` FOREIGN KEY (`course_code`) REFERENCES `courses` (`course_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
