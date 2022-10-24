-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2022 at 04:13 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

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
-- Table structure for table `colleges`
--

CREATE TABLE `colleges` (
  `id` int(11) NOT NULL,
  `abbreviation` varchar(40) NOT NULL,
  `college` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `colleges`
--

INSERT INTO `colleges` (`id`, `abbreviation`, `college`) VALUES
(1, 'CAS', 'College of Arts and Sciences'),
(2, 'COE', 'College of Education'),
(3, 'CME', 'College of Management and Entrepreneurship'),
(4, 'GS', 'Graduate School');

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

--
-- Dumping data for table `kindly_acts`
--

INSERT INTO `kindly_acts` (`id`, `student_id`, `date_issued`, `kindly_act`) VALUES
(10, 1, '2022-08-10', 'sadasdadsadsadsaasdsa'),
(12, 2, '2022-09-13', 'sadsadsad');

-- --------------------------------------------------------

--
-- Table structure for table `leaderships`
--

CREATE TABLE `leaderships` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `date_issued` varchar(100) NOT NULL,
  `event_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leaderships`
--

INSERT INTO `leaderships` (`id`, `student_id`, `semester_id`, `date_issued`, `event_title`) VALUES
(30, 1, 4, '2022-09-14', 'wadwadadawdawdw');

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

--
-- Dumping data for table `mvp_athletes`
--

INSERT INTO `mvp_athletes` (`id`, `student_id`, `coach_name`, `organizer_name`, `sports`, `date_issued`) VALUES
(9, 2, 'wadwadaw', 'dasdwad', 'WADWADAWDA', '2022-09-13'),
(10, 1, 'awawdawd', 'wadwadawd', 'WADWDAWD', '2022-09-14'),
(11, 2, 'SADSADSADASDASss', 'dasdasdss', 'SADSADSAS', '2022-09-18');

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
(1, 'Light Offense'),
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

--
-- Dumping data for table `outstanding_athlete`
--

INSERT INTO `outstanding_athlete` (`id`, `student_id`, `coach_name`, `organizer_name`, `sports`, `date_issued`) VALUES
(9, 1, 'dwadawdawwas', 'wadawdadwasa', 'WADWADAWDAWSS', '2022-09-13'),
(10, 2, 'ddasdasdasd', 'sadasdsa', 'SADSADSAD', '2022-09-13'),
(11, 1, 'ddsadasdas', 'sadsadsa', 'SADSADASDAS', '2022-09-13');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` int(11) NOT NULL,
  `abbreviation` varchar(45) DEFAULT NULL,
  `program_name` varchar(45) DEFAULT NULL,
  `college_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `abbreviation`, `program_name`, `college_id`) VALUES
(1, 'BSIT', 'Bachelor of Science in Information Technology', 1),
(22, 'BEED', 'Bachelor of Elementary Education', 2),
(23, 'BSED', 'Bachelor of Secondary Education', 2),
(24, 'TCP', 'Teacher Certificate Program', 2),
(25, 'ABCOM', 'Bachelor of Arts in Communication', 1),
(26, 'AB PolSci', 'Bachelor of Arts in Political Science', 1),
(27, 'AB English', 'Bachelor of Arts in English', 1),
(28, 'BS Biology', 'Bachelor of Science in Biology', 1),
(29, 'BSSW', 'Bachelor of science in Social Work', 1),
(30, 'BLIS', 'Bachelor of Library and Information Science', 1),
(31, 'BSTHRM', 'Bachelor of Science in Tourism, Hotel and Res', 3),
(32, 'BSHRM', 'Bachelor of Science in Hotel and Restaurant M', 3);

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
  `picture` varchar(255) NOT NULL,
  `remarks` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `student_id`, `retrieval_id`, `date_found`, `date_retrieved`, `date_surrendered`, `type`, `description`, `picture`, `remarks`) VALUES
(19, 1800771, 1800763, '2022-07-09', NULL, '2022-07-09', 'awdadas', 'adwadssadsa', '../../assets/images/uploads/879778screenshot_2.png', 'Surrendered');

-- --------------------------------------------------------

--
-- Table structure for table `sanction_cases`
--

CREATE TABLE `sanction_cases` (
  `id` int(11) NOT NULL,
  `sanction_disciplinary_action_id` int(11) NOT NULL,
  `report` varchar(200) NOT NULL,
  `resolution` varchar(200) NOT NULL,
  `recommend` varchar(200) NOT NULL,
  `chairman` varchar(70) NOT NULL,
  `members` varchar(70) NOT NULL,
  `hearing_date` date DEFAULT NULL,
  `date_issued` date DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sanction_cases`
--

INSERT INTO `sanction_cases` (`id`, `sanction_disciplinary_action_id`, `report`, `resolution`, `recommend`, `chairman`, `members`, `hearing_date`, `date_issued`, `user_id`, `date_time`) VALUES
(52, 102, 'sadasdas', 'dasdasdsa', 'Closed/Resolved', 'dasdsadas', 'dasdasdas', '0000-00-00', '2022-10-20', 1, '2022-10-20 09:49:21');

-- --------------------------------------------------------

--
-- Table structure for table `sanction_disciplinary_action`
--

CREATE TABLE `sanction_disciplinary_action` (
  `id` int(11) NOT NULL,
  `sanction_referral_id` int(11) NOT NULL,
  `committed_date` date NOT NULL,
  `committed_time` time NOT NULL,
  `counselling_date` date NOT NULL,
  `counselling_time` time NOT NULL,
  `issual_date` date NOT NULL,
  `remarks` varchar(40) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sanction_disciplinary_action`
--

INSERT INTO `sanction_disciplinary_action` (`id`, `sanction_referral_id`, `committed_date`, `committed_time`, `counselling_date`, `counselling_time`, `issual_date`, `remarks`, `user_id`, `date_time`) VALUES
(101, 70, '2022-10-14', '10:10:00', '2022-10-14', '10:10:00', '2022-10-14', NULL, 1, '2022-10-14 10:27:48'),
(102, 74, '2022-10-20', '09:34:00', '2022-10-20', '09:34:00', '2022-10-20', 'Closed/Resolved', 1, '2022-10-20 09:34:24'),
(103, 71, '2022-10-23', '13:43:00', '2022-10-23', '01:37:00', '2022-10-23', NULL, 1, '2022-10-23 11:13:18');

-- --------------------------------------------------------

--
-- Table structure for table `sanction_referrals`
--

CREATE TABLE `sanction_referrals` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `violation_id` int(11) NOT NULL,
  `complainer_name` varchar(150) NOT NULL,
  `referred` varchar(45) NOT NULL,
  `date` date NOT NULL,
  `remark` varchar(45) DEFAULT NULL,
  `semester_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sanction_referrals`
--

INSERT INTO `sanction_referrals` (`id`, `student_id`, `violation_id`, `complainer_name`, `referred`, `date`, `remark`, `semester_id`, `user_id`, `date_time`) VALUES
(70, 1, 35, 'wadawds', 'Jan Ramil', '2022-10-13', 'Continuing Hearing', 4, 1, '2022-10-23 11:12:55'),
(71, 1, 39, 'sadsds', 'adsadasdasd', '2022-10-15', 'Actioned', 4, 1, '2022-10-15 12:45:09'),
(72, 8, 4, 'Ken Venigas', 'Jan Ramil', '2022-10-01', NULL, 4, 1, '2022-10-15 19:59:21'),
(73, 8, 4, 'wadawd', 'Jan Ramil', '2022-10-02', NULL, 4, 1, '2022-10-15 15:17:22'),
(74, 9, 4, 'sadasd', 'sasadasdasds', '2022-10-14', 'Actioned', 4, 1, '2022-10-15 19:58:19'),
(76, 1, 2, 'wadawd', 'Jan Ramil', '2022-10-22', NULL, 4, 1, '2022-10-22 15:23:49');

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
(1, 1800771, 'Jan Ramil', 'Pantorilla', 'Intong', 22, 'Male', 'AI42', 'bisoyjan@gmail.com', 1),
(2, 1800763, 'Melvin', 'Carag', 'Copioso', 22, 'Male', 'A|42', 'admin@example.com', 1),
(8, 1800891, 'Ralph', 'Delda', 'Amistoso', 21, 'Male', 'A|42', 'ralphzkienamistoso@gmail.com', 1),
(9, 1800674, 'Ken', 'Go', 'Venigas', 22, 'Male', 'A|42', '12345@gmail.com', 1);

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
(1, 'Admin', '$2y$10$j91BGsxmOVPESpirJseRc.BnYrUJ1VHlCmBFRC1TP4gSPHp.LRLpC', 'Admin', 'Admin', 'Admin', 'Admin'),
(2, 'User', '$2y$10$x9zsdND2ozL7OQTVvsrc.uiLfKCPaqflnh8SK1MeSP..77TE76ra2', 'User', 'User', 'User', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `violations`
--

CREATE TABLE `violations` (
  `id` int(11) NOT NULL,
  `offenses_id` int(11) NOT NULL,
  `code` varchar(40) NOT NULL,
  `violation` varchar(255) NOT NULL
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
(15, 1, 'LO15', 'Such other acts as may herein be determined from time to time by the Disciplinary Committee'),
(16, 2, 'SO1', 'Gambling in any form within the campus'),
(17, 2, 'SO2', 'Deliberate shouting, giggling, conducting boisterous and disruptive conversations, running along the corridors and creating any noise that disturbs ongoing classes'),
(18, 2, 'SO3', 'Public display of affection within the school premises which offend the sensibilities of fellow students, faculty and administrative officials or which may be deemed by them as improper, vulgar, repulsive or immoral'),
(19, 2, 'SO4-A', 'Cheating - deliberately looking at a neighbor’s examination papers'),
(20, 2, 'SO4-B', 'Cheating - copying from or allowing another to copy from one’s examination papers'),
(21, 2, 'SO4-C', 'Cheating - copying from or allowing another to copy from one’s examination\r\npapers'),
(22, 2, 'SO4-D', 'Cheating - unauthorized possession of notes or any material relative to the examination'),
(23, 2, 'SO4-E', 'Cheating - passing as one’s own work, any assigned report, term paper, case analysis, reaction paper, and the like which are copied from others'),
(24, 2, 'SO5', 'Use of somebody else’s ID card or allowing others to use his/her ID'),
(25, 2, 'SO6', 'Deliberate disruption of any school function or activity'),
(26, 2, 'SO7', 'Vandalism or destruction of school property'),
(27, 2, 'SO8', 'Display or distribution of pornographic materials within the University'),
(28, 2, 'SO9', 'Entering or being in the school premises under the influence of liquor\r\nand/or drugs'),
(29, 2, 'SO10', 'Conducting, initiating, or joining unofficial or unauthorized field trips under the guise or presuming to be a part of the academic requirement'),
(30, 2, 'SO11', 'Use of school premises and/or facilities for meetings and assemblies without prior permit'),
(31, 2, 'SO12', 'Committing acts inside and outside the campus that affect the good name of the University and/or ones status as a student of the university'),
(32, 2, 'SO13', 'Gross act of disrespect, in word or in deed, which tend to place any member of the faculty, administration or non-teaching staff in ridicule or in contempt'),
(33, 2, 'SO14', 'Solicitation of money, donation, contributions in cash or kind without the prior approval of the school'),
(34, 2, 'SO15', 'Such other acts as may herein be determined from time to time by the Disciplinary Committee'),
(35, 3, 'VSO1', 'Stealing or influencing others to steal'),
(36, 3, 'VSO2', 'Acts of misbehavior involving destruction of school property or that of the members of the school community, including those guests and visitors'),
(37, 3, 'VSO3', 'Having somebody else take exams for student concerned'),
(38, 3, 'VSO4', 'Illegal possession of deadly weapons'),
(39, 3, 'VSO5-A', 'Acts of subversion or insurgency - Instigating, inciting, provoking, leading or taking part in\r\nillegal and/or violent demonstrations or activities'),
(40, 3, 'VSO5-B', 'Acts of subversion or insurgency - Giving support thereto in any manner, whether financial, physical or material');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `colleges`
--
ALTER TABLE `colleges`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `leadership_student_id` (`student_id`),
  ADD KEY `leadership_semester_id` (`semester_id`);

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
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `college_id` (`college_id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `properties_returnee_id` (`retrieval_id`);

--
-- Indexes for table `sanction_cases`
--
ALTER TABLE `sanction_cases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `case_disciplinary_id` (`sanction_disciplinary_action_id`),
  ADD KEY `sanction_case_user_id` (`user_id`);

--
-- Indexes for table `sanction_disciplinary_action`
--
ALTER TABLE `sanction_disciplinary_action`
  ADD PRIMARY KEY (`id`),
  ADD KEY `disciplinary_action_referral_id` (`sanction_referral_id`),
  ADD KEY `disciplinary_action_user_id` (`user_id`);

--
-- Indexes for table `sanction_referrals`
--
ALTER TABLE `sanction_referrals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `referral_violation_id` (`violation_id`),
  ADD KEY `referrals_semester_id` (`semester_id`),
  ADD KEY `referrals_user_id` (`user_id`);

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
-- AUTO_INCREMENT for table `colleges`
--
ALTER TABLE `colleges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kindly_acts`
--
ALTER TABLE `kindly_acts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `leaderships`
--
ALTER TABLE `leaderships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `mvp_athletes`
--
ALTER TABLE `mvp_athletes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `offenses`
--
ALTER TABLE `offenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `outstanding_athlete`
--
ALTER TABLE `outstanding_athlete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `sanction_cases`
--
ALTER TABLE `sanction_cases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `sanction_disciplinary_action`
--
ALTER TABLE `sanction_disciplinary_action`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `sanction_referrals`
--
ALTER TABLE `sanction_referrals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `violations`
--
ALTER TABLE `violations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kindly_acts`
--
ALTER TABLE `kindly_acts`
  ADD CONSTRAINT `kindly_student_id` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `leaderships`
--
ALTER TABLE `leaderships`
  ADD CONSTRAINT `leadership_semester_id` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`) ON UPDATE CASCADE,
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
-- Constraints for table `programs`
--
ALTER TABLE `programs`
  ADD CONSTRAINT `college_id` FOREIGN KEY (`college_id`) REFERENCES `colleges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sanction_cases`
--
ALTER TABLE `sanction_cases`
  ADD CONSTRAINT `sanction_case_disciplinary_id` FOREIGN KEY (`sanction_disciplinary_action_id`) REFERENCES `sanction_disciplinary_action` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sanction_case_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `sanction_disciplinary_action`
--
ALTER TABLE `sanction_disciplinary_action`
  ADD CONSTRAINT `disciplinary_action_referral_id` FOREIGN KEY (`sanction_referral_id`) REFERENCES `sanction_referrals` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `disciplinary_action_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `sanction_referrals`
--
ALTER TABLE `sanction_referrals`
  ADD CONSTRAINT `referral_student_id` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `referral_violation_id` FOREIGN KEY (`violation_id`) REFERENCES `violations` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `referrals_semester_id` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`),
  ADD CONSTRAINT `referrals_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `program_id` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `violations`
--
ALTER TABLE `violations`
  ADD CONSTRAINT `offenses_id` FOREIGN KEY (`offenses_id`) REFERENCES `offenses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
