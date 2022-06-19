-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 19, 2022 at 02:37 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vpsdasdata`
--

-- --------------------------------------------------------

--
-- Table structure for table `cases`
--

CREATE TABLE `cases` (
  `id` int(11) NOT NULL,
  `disciplinary_action_id` int(11) NOT NULL,
  `report` varchar(200) NOT NULL,
  `resolution` varchar(200) NOT NULL,
  `recommend` varchar(200) NOT NULL,
  `chairman` varchar(70) NOT NULL,
  `members` varchar(70) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cum_laudes`
--

CREATE TABLE `cum_laudes` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `date_issued` varchar(20) NOT NULL,
  `school_year` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `disciplinary_action`
--

CREATE TABLE `disciplinary_action` (
  `id` int(11) NOT NULL,
  `referral_id` int(11) NOT NULL,
  `committed_date` date NOT NULL,
  `committed_time` time NOT NULL,
  `counselling_date` date NOT NULL,
  `counselling_time` time NOT NULL,
  `issual_date` date NOT NULL,
  `remarks` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `document_filepath`
--

CREATE TABLE `document_filepath` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `path` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `honors`
--

CREATE TABLE `honors` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `gwa` varchar(10) NOT NULL,
  `school_year` varchar(20) NOT NULL,
  `date` varchar(255) NOT NULL,
  `unit_head` varchar(100) NOT NULL,
  `unit_head_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kindly_acts`
--

CREATE TABLE `kindly_acts` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `date_issued` varchar(100) NOT NULL,
  `kindly_act` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `leaderships`
--

CREATE TABLE `leaderships` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `date_issued` varchar(100) NOT NULL,
  `event_title` varchar(100) NOT NULL,
  `vpsdas_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mvp_athletes`
--

CREATE TABLE `mvp_athletes` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `coach_name` varchar(100) NOT NULL,
  `organizer_name` varchar(100) NOT NULL,
  `sports` varchar(50) NOT NULL,
  `date_issued` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `offenses`
--

CREATE TABLE `offenses` (
  `id` int(11) NOT NULL,
  `offense` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offenses`
--

INSERT INTO `offenses` (`id`, `offense`) VALUES
(1, 'Light Offenses'),
(2, 'Serious Offense'),
(3, 'Very Serious Offense');

-- --------------------------------------------------------

--
-- Table structure for table `outstanding_athlete`
--

CREATE TABLE `outstanding_athlete` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `coach_name` varchar(100) NOT NULL,
  `organizer_name` varchar(100) NOT NULL,
  `sports` varchar(100) NOT NULL,
  `date_issued` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `performers`
--

CREATE TABLE `performers` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `type` varchar(150) NOT NULL,
  `description` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` int(11) NOT NULL,
  `abbreviation` varchar(45) DEFAULT NULL,
  `program_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `abbreviation`, `program_name`) VALUES
(1, 'BSIT', 'Bachelor of Science in Information Technology'),
(2, 'BSED', 'Bachelor of Secondary Education');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `retrieval_id` int(10) NOT NULL,
  `date_found` date DEFAULT NULL,
  `date_retrieved` date DEFAULT NULL,
  `date_surrendered` date DEFAULT NULL,
  `type` varchar(45) NOT NULL,
  `description` varchar(200) NOT NULL,
  `picture` longblob NOT NULL,
  `remarks` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `violation_id` int(11) NOT NULL,
  `employee_name` varchar(150) NOT NULL,
  `referred` varchar(45) NOT NULL,
  `date` date NOT NULL,
  `remark` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `student_no` int(11) NOT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `middle_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `section` varchar(45) DEFAULT NULL,
  `email` varchar(35) NOT NULL,
  `program_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_no`, `first_name`, `middle_name`, `last_name`, `age`, `gender`, `section`, `email`, `program_id`) VALUES
(1, 1800771, 'Jan Ramil', 'Pantorilla', 'Intong', 21, 'Male', 'A|34', 'bisoyjan@gmail.com', 1),
(2, 1800674, 'John Paul Ken', 'Go', 'Vinegas', 22, 'Male', 'AI41', 'janbisoy@gmail.com', 1),
(3, 1800891, 'Raplh', 'Delda', 'Amistoso', 22, 'Male', 'A|43', 'amistosoralph31@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `themeplate_filepath`
--

CREATE TABLE `themeplate_filepath` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `path` varchar(250) NOT NULL,
  `save_path` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `themeplate_filepath`
--

INSERT INTO `themeplate_filepath` (`id`, `name`, `path`, `save_path`) VALUES
(1, 'Cum Laude', 'C:\\Users\\bisoy\\Documents\\Important\\Projects\\VPSDAS system\\vpsdas-system\\Themeplates\\CUMLAUDE.docx', 'C:\\Users\\bisoy\\Documents\\Important\\Projects\\VPSDAS system\\vpsdas-system\\Documents\\CumLaude'),
(2, 'Action', 'C:\\Users\\bisoy\\Documents\\Important\\Projects\\VPSDAS system\\vpsdas-system\\Themeplates\\DISCIPLINARY ACTION SLIP FORM.docx', 'C:\\Users\\bisoy\\Documents\\Important\\Projects\\VPSDAS system\\vpsdas-system\\Documents\\Action'),
(3, 'Case', 'C:\\Users\\bisoy\\Documents\\Important\\Projects\\VPSDAS system\\vpsdas-system\\Themeplates\\DISCIPLINARY CASE SLIP FORM.docx', 'C:\\Users\\bisoy\\Documents\\Important\\Projects\\VPSDAS system\\vpsdas-system\\Documents\\Case'),
(4, 'Referral', 'C:\\Users\\bisoy\\Documents\\Important\\Projects\\VPSDAS system\\vpsdas-system\\Themeplates\\DISCIPLINARY REFERRAL SLIP FORM.docx', 'C:\\Users\\bisoy\\Documents\\Important\\Projects\\VPSDAS system\\vpsdas-system\\Documents\\Referral'),
(5, 'Kindly Act', 'C:\\Users\\bisoy\\Documents\\Important\\Projects\\VPSDAS system\\vpsdas-system\\Themeplates\\GOOD-DEEDS-CERTIFICATE.docx', 'C:\\Users\\bisoy\\Documents\\Important\\Projects\\VPSDAS system\\vpsdas-system\\Documents\\Good Deeds'),
(6, 'LeaderShip', 'C:\\Users\\bisoy\\Documents\\Important\\Projects\\VPSDAS system\\vpsdas-system\\Themeplates\\LEADERSHIP.docx', 'C:\\Users\\bisoy\\Documents\\Important\\Projects\\VPSDAS system\\vpsdas-system\\Documents\\Leadership'),
(7, 'Outstanding Athlete', 'C:\\Users\\bisoy\\Documents\\Important\\Projects\\VPSDAS system\\vpsdas-system\\Themeplates\\OUTSTANDING-ATHLETE-CERTIFICATE.docx', 'C:\\Users\\bisoy\\Documents\\Important\\Projects\\VPSDAS system\\vpsdas-system\\Documents\\Outstanding Athlete'),
(8, 'MVP', 'C:\\Users\\bisoy\\Documents\\Important\\Projects\\VPSDAS system\\vpsdas-system\\Themeplates\\REWARDS-ATHLETE-MVP-CERTIFICATE.docx', 'C:\\Users\\bisoy\\Documents\\Important\\Projects\\VPSDAS system\\vpsdas-system\\Documents\\MVP Athlete'),
(9, 'Honors', 'C:\\Users\\bisoy\\Documents\\Important\\Projects\\VPSDAS system\\vpsdas-system\\Themeplates\\REWARDS-GWA-CERTIFICATE.docx', 'C:\\Users\\bisoy\\Documents\\Important\\Projects\\VPSDAS system\\vpsdas-system\\Documents\\GWA');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(65) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `middle_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `type`, `first_name`, `middle_name`, `last_name`) VALUES
(1, 'Admin', '$2y$10$OXNB7HOmz.cd6n3TOFloRes1SRvNhUDx2f5mHqYoz39gK9h8eJpc.', 'Admin', 'aAdmin', 'Admin', 'Admin'),
(2, 'aaaa', '$2y$10$Up.QJo3MOC2tHn2Q8HmpluJcgUTcZNicz22NiWEeICmEErcAbaZbi', 'Admin', 'awadwa', 'dwadawd', 'wadawd'),
(3, 'ssssss', '$2y$10$tQXDLyW.dfL4FBjPoYTD2uYmCefsBrAUi3gdJbQx8dv9mqfduV3ZO', 'Admin', 'awadwa', 'dwadawd', 'wadawd');

-- --------------------------------------------------------

--
-- Table structure for table `violations`
--

CREATE TABLE `violations` (
  `id` int(11) NOT NULL,
  `offenses_id` int(11) NOT NULL,
  `code` varchar(40) NOT NULL,
  `violation` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `violations`
--

INSERT INTO `violations` (`id`, `offenses_id`, `code`, `violation`) VALUES
(1, 1, 'LO1', 'Failure or refusal to present/wear ID properly and/or wear the required students uniform'),
(2, 1, 'LO2', 'Overt behavior untypical of one’s gender such as cross dressing'),
(3, 1, 'LO3', 'Improper grooming (wearing of shorts, slippers, sando, and revealing dresses during non-class days; disruptive hair color; long hair for men, wearing '),
(4, 1, 'LO4', 'Loitering in corridors during class hours'),
(5, 1, 'LO5', 'Littering (throwing of wrappers, etc. anywhere)'),
(6, 1, 'LO6', 'Sptting on walls, floors, and windows'),
(7, 1, 'LO7', 'Non Wearing of ID inside the campus'),
(8, 1, 'LO8', 'Entering a class or breaking into school function without the permission of those concerned'),
(9, 1, 'LO9', 'Staying in campus beyond the authorized time'),
(10, 1, 'LO10', 'Unauthorized distribution or posting within school premise of leaflets handbills or other printed materials whose authorship is not clearly stated the'),
(11, 1, 'LO11', 'Use of cellular phone during classes or lectures'),
(12, 1, 'LO12', 'Attending seminars, lectures, and teach-ins or any similar cases bringing the name of the University, without due notice to thier respective deans/adv'),
(13, 1, 'LO13', 'Gross act of disrespect, in word or in deed, which tend to place any member of the faculty, administration or non-teaching staff in ridicule or in con'),
(14, 1, 'LO14', 'Solicitation of money, donation, contributions in cash or kind without the prior approval of the school'),
(15, 1, 'LO15', 'Such other acts as may herein be determined from time to time by the Disciplinary Committee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cases`
--
ALTER TABLE `cases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `case_disciplinary_id` (`disciplinary_action_id`);

--
-- Indexes for table `cum_laudes`
--
ALTER TABLE `cum_laudes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cumlaude_student_id` (`student_id`);

--
-- Indexes for table `disciplinary_action`
--
ALTER TABLE `disciplinary_action`
  ADD PRIMARY KEY (`id`),
  ADD KEY `disciplinary_action_referral_id` (`referral_id`);

--
-- Indexes for table `document_filepath`
--
ALTER TABLE `document_filepath`
  ADD PRIMARY KEY (`id`),
  ADD KEY `document_filepath_case_id` (`student_id`);

--
-- Indexes for table `honors`
--
ALTER TABLE `honors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `honors_student_id` (`student_id`);

--
-- Indexes for table `kindly_acts`
--
ALTER TABLE `kindly_acts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kindly_student_id` (`student_id`);

--
-- Indexes for table `leaderships`
--
ALTER TABLE `leaderships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leadership_student_id` (`student_id`);

--
-- Indexes for table `mvp_athletes`
--
ALTER TABLE `mvp_athletes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mvm_student_id` (`student_id`);

--
-- Indexes for table `offenses`
--
ALTER TABLE `offenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `outstanding_athlete`
--
ALTER TABLE `outstanding_athlete`
  ADD PRIMARY KEY (`id`),
  ADD KEY `outstanding_student_id` (`student_id`);

--
-- Indexes for table `performers`
--
ALTER TABLE `performers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `properties_returnee_id` (`retrieval_id`);

--
-- Indexes for table `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `referral_violation_id` (`violation_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id_2` (`student_no`),
  ADD UNIQUE KEY `student_no` (`student_no`),
  ADD KEY `student_id` (`student_no`),
  ADD KEY `program_id` (`program_id`),
  ADD KEY `program_id_2` (`program_id`),
  ADD KEY `student_id_3` (`student_no`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `themeplate_filepath`
--
ALTER TABLE `themeplate_filepath`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `violations`
--
ALTER TABLE `violations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offense_id` (`offenses_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cases`
--
ALTER TABLE `cases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cum_laudes`
--
ALTER TABLE `cum_laudes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `disciplinary_action`
--
ALTER TABLE `disciplinary_action`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `document_filepath`
--
ALTER TABLE `document_filepath`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `honors`
--
ALTER TABLE `honors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kindly_acts`
--
ALTER TABLE `kindly_acts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `leaderships`
--
ALTER TABLE `leaderships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `mvp_athletes`
--
ALTER TABLE `mvp_athletes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `offenses`
--
ALTER TABLE `offenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `outstanding_athlete`
--
ALTER TABLE `outstanding_athlete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `performers`
--
ALTER TABLE `performers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `themeplate_filepath`
--
ALTER TABLE `themeplate_filepath`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `violations`
--
ALTER TABLE `violations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cases`
--
ALTER TABLE `cases`
  ADD CONSTRAINT `case_disciplinary_id` FOREIGN KEY (`disciplinary_action_id`) REFERENCES `disciplinary_action` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cum_laudes`
--
ALTER TABLE `cum_laudes`
  ADD CONSTRAINT `cumlaude_student_id` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `disciplinary_action`
--
ALTER TABLE `disciplinary_action`
  ADD CONSTRAINT `disciplinary_action_referral_id` FOREIGN KEY (`referral_id`) REFERENCES `referrals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `document_filepath`
--
ALTER TABLE `document_filepath`
  ADD CONSTRAINT `document_filepath_student_id` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `honors`
--
ALTER TABLE `honors`
  ADD CONSTRAINT `honors_student_id` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kindly_acts`
--
ALTER TABLE `kindly_acts`
  ADD CONSTRAINT `kindly_student_id` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `leaderships`
--
ALTER TABLE `leaderships`
  ADD CONSTRAINT `leadership_student_id` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `mvp_athletes`
--
ALTER TABLE `mvp_athletes`
  ADD CONSTRAINT `mvm_student_id` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `outstanding_athlete`
--
ALTER TABLE `outstanding_athlete`
  ADD CONSTRAINT `outstanding_student_id` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `performers`
--
ALTER TABLE `performers`
  ADD CONSTRAINT `performers_student_id` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `referrals`
--
ALTER TABLE `referrals`
  ADD CONSTRAINT `referral_student_id` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `referral_violation_id` FOREIGN KEY (`violation_id`) REFERENCES `violations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `program_id` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `violations`
--
ALTER TABLE `violations`
  ADD CONSTRAINT `offenses_id` FOREIGN KEY (`offenses_id`) REFERENCES `offenses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;