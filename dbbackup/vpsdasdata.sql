-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2023 at 03:28 PM
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
  `date_issued` varchar(100) NOT NULL,
  `event_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leaderships`
--

INSERT INTO `leaderships` (`id`, `student_id`, `date_issued`, `event_title`) VALUES
(30, 1, '2022-09-14', 'wadwadadawdawdwss'),
(37, 1, '2023-01-16', 'wadwadawdaw');

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
(11, 1, 'ddsadasdas', 'sadsadsa', 'SADSADASDAS', '2022-09-13'),
(12, 2, 'asdasdasdasda', 'sadsadasdas', 'BASKETBALL', '2023-01-16');

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
(19, 1800771, 1800763, '2022-07-09', '2023-01-16', '2022-07-09', 'awdadas', 'adwadssadsa', '../../assets/images/uploads/6709226819.png', 'Surrendered'),
(20, 1800771, 1800763, '2023-01-16', '2023-01-16', '2023-01-16', 'wallpaper', 'gradient', '../../assets/images/uploads/37451926819.png', 'Surrendered');

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
(57, 101, 'wadwad', 'wadwadwad', 'Closed/Resolved', 'ssssssssss', 'awdwadawd', '0000-00-00', '2022-12-03', 1, '2022-12-03 14:58:03'),
(58, 102, 'wadwad', 'awdwadawd', 'Closed/Resolved', 'awdwadaw', 'dwadawdawd', '0000-00-00', '2022-12-03', 1, '2022-12-03 14:57:21'),
(59, 103, 'wadawdwadawdaw', 'adwadawdawd', 'Closed/Resolved', 'wadawdawdaw', 'dawdawdawdawdaw', '0000-00-00', '2022-12-03', 1, '2022-12-03 14:57:34'),
(60, 109, 'dwadwadadawdwadwadwd', 'wadawdsadwadsdwa', 'Closed/Resolved', 'awdawdwa', 'awdadsadwasd', '0000-00-00', '2023-01-16', 1, '2023-01-16 20:52:14');

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
(101, 70, '2022-10-14', '10:10:00', '2022-10-14', '10:10:00', '2022-10-14', 'Closed/Resolved', 1, '2022-10-14 10:27:48'),
(102, 74, '2022-10-20', '09:34:00', '2022-10-20', '09:34:00', '2022-10-20', 'Closed/Resolved', 1, '2022-10-20 09:34:24'),
(103, 71, '2022-10-23', '13:43:00', '2022-10-23', '01:37:00', '2022-10-23', 'Closed/Resolved', 1, '2022-10-23 11:13:18'),
(104, 80, '2022-12-03', '16:05:00', '2022-12-14', '16:06:00', '2022-12-03', NULL, 1, '2022-12-03 16:06:08'),
(105, 78, '2022-12-03', '16:10:00', '2022-12-14', '16:10:00', '2022-12-03', NULL, 1, '2022-12-03 16:10:28'),
(109, 83, '2023-01-16', '08:50:00', '2023-01-16', '08:50:00', '2023-01-16', 'Closed/Resolved', 1, '2023-01-16 20:50:59');

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
  `date_time` datetime DEFAULT NULL,
  `date_validation` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sanction_referrals`
--

INSERT INTO `sanction_referrals` (`id`, `student_id`, `violation_id`, `complainer_name`, `referred`, `date`, `remark`, `semester_id`, `user_id`, `date_time`, `date_validation`) VALUES
(70, 1, 35, 'wadawds', 'Jan Ramil', '2022-10-13', 'Counselled', 4, 1, '2022-10-23 11:12:55', NULL),
(71, 1, 39, 'sadsds', 'adsadasdasd', '2022-10-15', 'Counselled', 4, 1, '2022-10-15 12:45:09', NULL),
(73, 8, 4, 'wadawds', 'Jan Ramils', '2022-10-02', NULL, 4, 1, '2022-12-03 16:55:30', NULL),
(74, 9, 4, 'sadasd', 'sasadasdasds', '2022-10-14', 'Counselled', 4, 1, '2022-10-15 19:58:19', NULL),
(76, 1, 2, 'wadawd', 'Jan Ramils', '2022-10-22', NULL, 4, 1, '2022-10-25 20:03:25', NULL),
(78, 2, 2, 'wadawd', 'adwadawdawd', '2022-11-04', 'Actioned', 4, 1, '2022-11-04 21:21:05', NULL),
(80, 2, 2, 'wadwadaw', 'dwadawdaw', '2022-12-03', 'Actioned', 4, 1, '2022-12-03 15:57:15', NULL),
(83, 1, 2, 'Ken Venigas', 'Jan Ramil', '2023-01-16', 'Counselled', 4, 1, '2023-01-16 20:50:45', NULL),
(87, 1, 35, 'Ken Venigas', 'adwadawdawd', '2023-01-19', NULL, 4, 1, '2023-01-19 20:32:09', '2023-02-03'),
(88, 1, 36, 'Ken Venigas', 'adwadawdawd', '2023-01-19', NULL, 4, 1, '2023-01-19 20:39:06', '2023-02-03'),
(89, 2, 30, 'wadawd', 'Jan Ramil', '2023-01-23', NULL, 4, 1, '2023-01-23 16:51:41', '2023-02-07');

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` int(11) NOT NULL,
  `first_starting` date NOT NULL,
  `first_ending` date NOT NULL,
  `second_starting` date NOT NULL,
  `second_ending` date NOT NULL,
  `school_year` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`id`, `first_starting`, `first_ending`, `second_starting`, `second_ending`, `school_year`) VALUES
(4, '2022-08-01', '2022-12-26', '2023-01-01', '2023-05-31', '2022-2023');

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
(2, 1800763, 'Melvin', 'Carag', 'Copioso', 22, 'Male', 'A|42', 'admin@example.com', 22),
(8, 1800891, 'Ralph', 'Delda', 'Amistoso', 21, 'Male', 'A|42', 'ralphzkienamistoso@gmail.com', 1),
(9, 1800674, 'Ken', 'Go', 'Venigas', 22, 'Male', 'A|42', '12345@gmail.com', 1),
(10, 111111111, 'wdwadawd', 'awdawdwadaw', 'adawdawdawd', 22, 'Male', 'wadwadwad', 'wadawd@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `syslogs`
--

CREATE TABLE `syslogs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `section` varchar(100) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `syslogs`
--

INSERT INTO `syslogs` (`id`, `user_id`, `description`, `section`, `date`) VALUES
(38, 1, 'Created data Primary key:10', 'Outstanding Athlete', '2022-09-13 09:48:10'),
(39, 1, 'Created data Primary key:11', 'Outstanding Athlete', '2022-09-13 09:49:18'),
(40, 1, 'Created data Primary key:56', 'Sanction Referral', '2022-09-13 09:52:23'),
(42, 1, 'Created data Primary key:10', 'MVP Athlete', '2022-09-13 09:59:39'),
(44, 1, 'Created data Primary key:', 'Programs', '2022-09-13 10:00:59'),
(45, 1, 'Deleted data Primary key:20', 'Programs', '2022-09-13 10:01:12'),
(46, 1, 'Created data Primary key:13', 'Good Deeds', '2022-09-13 10:01:37'),
(47, 1, 'Deleted data Primary key:13', 'Good Deeds', '2022-09-13 10:04:43'),
(48, 1, 'User Logout to the system ', '', '2022-09-13 10:04:57'),
(49, 1, 'User Login to the system', '', '2022-09-13 10:05:02'),
(50, 1, 'Created data Primary key:11', 'MVP Athlete', '2022-09-13 10:08:06'),
(51, 1, 'Updated data Primary key:11', 'MVP Athlete', '2022-09-13 10:08:53'),
(52, 1, 'Created data Primary key:', 'Programs', '2022-09-13 10:09:17'),
(53, 1, 'User Logout to the system ', '', '2022-09-13 10:18:04'),
(54, 1, 'User Login to the system', '', '2022-09-13 10:26:06'),
(55, 1, 'User Logout to the system ', '', '2022-09-13 10:28:02'),
(56, 1, 'User Login to the system', '', '2022-09-13 10:30:31'),
(57, 1, 'User Login to the system', '', '2022-09-14 01:46:33'),
(58, 1, 'Created data Primary key:30', 'Leadership', '2022-09-14 02:06:34'),
(59, 1, 'User Login to the system', '', '2022-09-14 05:51:09'),
(60, 1, 'Deleted data Primary key:2', 'Programs', '2022-09-14 05:51:58'),
(61, 1, 'Deleted data Primary key:4', 'Programs', '2022-09-14 05:52:00'),
(62, 1, 'Deleted data Primary key:5', 'Programs', '2022-09-14 05:52:01'),
(63, 1, 'Deleted data Primary key:7', 'Programs', '2022-09-14 05:52:02'),
(64, 1, 'Deleted data Primary key:19', 'Programs', '2022-09-14 05:52:06'),
(65, 1, 'Deleted data Primary key:21', 'Programs', '2022-09-14 05:52:08'),
(66, 1, 'Created data Primary key:22', 'Programs', '2022-09-14 05:54:01'),
(67, 1, 'Created data Primary key:23', 'Programs', '2022-09-14 05:54:37'),
(68, 1, 'Created data Primary key:24', 'Programs', '2022-09-14 05:54:54'),
(69, 1, 'Created data Primary key:25', 'Programs', '2022-09-14 05:55:29'),
(70, 1, 'Created data Primary key:26', 'Programs', '2022-09-14 05:55:53'),
(71, 1, 'Created data Primary key:27', 'Programs', '2022-09-14 05:56:32'),
(72, 1, 'Created data Primary key:28', 'Programs', '2022-09-14 05:56:53'),
(73, 1, 'Created data Primary key:29', 'Programs', '2022-09-14 05:57:14'),
(74, 1, 'Created data Primary key:30', 'Programs', '2022-09-14 05:57:38'),
(75, 1, 'Created data Primary key:31', 'Programs', '2022-09-14 05:58:48'),
(76, 1, 'Created data Primary key:32', 'Programs', '2022-09-14 05:59:09'),
(77, 1, 'Deleted data Primary key:4', 'Students', '2022-09-14 06:00:01'),
(78, 1, 'User Logout to the system ', '', '2022-09-14 06:21:35'),
(79, 1, 'User Login to the system', '', '2022-09-14 06:21:56'),
(80, 1, 'Updated data Primary key:2', 'Account', '2022-09-14 06:36:14'),
(81, 1, 'User Logout to the system ', '', '2022-09-14 06:36:19'),
(82, 2, 'User Login to the system', '', '2022-09-14 06:36:23'),
(83, 2, 'User Logout to the system ', '', '2022-09-14 06:36:35'),
(84, 1, 'User Login to the system', '', '2022-09-14 06:36:39'),
(85, 1, 'User Login to the system', '', '2022-09-14 09:48:00'),
(86, 1, 'User Logout to the system ', '', '2022-09-14 15:20:24'),
(87, 1, 'User Login to the system', '', '2022-09-14 15:20:50'),
(88, 1, 'Created data Primary key:57', 'Sanction Referral', '2022-09-14 15:21:20'),
(89, 1, 'User Login to the system', '', '2022-09-16 07:38:59'),
(90, 1, 'User Login to the system', '', '2022-09-16 11:21:17'),
(91, 1, 'User Login to the system', '', '2022-09-16 14:22:29'),
(92, 1, 'User Login to the system', '', '2022-09-16 16:58:12'),
(93, 1, 'Updated data Primary key:4', 'Semester', '2022-09-16 17:11:37'),
(94, 1, 'User Login to the system', '', '2022-09-17 07:38:50'),
(95, 1, 'User Login to the system', '', '2022-09-18 05:44:39'),
(96, 1, 'User sets semester to the system', '', '2022-09-18 05:44:46'),
(97, 1, 'User Logout to the system ', '', '2022-09-18 06:27:16'),
(98, 1, 'User Login to the system', '', '2022-09-18 06:27:21'),
(99, 1, 'User sets semester to the system', '', '2022-09-18 06:27:40'),
(100, 1, 'Updated data Primary key:11', 'MVP Athlete', '2022-09-18 07:06:56'),
(101, 1, 'Updated data Primary key:11', 'MVP Athlete', '2022-09-18 07:07:04'),
(102, 1, 'Updated data Primary key:11', 'MVP Athlete', '2022-09-18 07:07:54'),
(103, 1, 'User Login to the system', '', '2022-09-18 10:15:48'),
(104, 1, 'User Login to the system', '', '2022-09-19 06:46:43'),
(105, 1, 'User Login to the system', '', '2022-09-20 02:05:44'),
(106, 1, 'User Login to the system', '', '2022-09-21 09:14:05'),
(107, 1, 'User sets semester to the system', '', '2022-09-21 09:16:01'),
(108, 1, 'User Logout to the system ', '', '2022-09-21 09:23:19'),
(109, 1, 'User Login to the system', '', '2022-09-21 09:23:24'),
(110, 1, 'User sets semester to the system', '', '2022-09-21 09:23:27'),
(111, 1, 'Created data Primary key:63', 'Sanction Referral', '2022-09-21 09:29:59'),
(112, 1, 'Updated data Primary key:63', 'Sanction Referral', '2022-09-21 09:33:07'),
(113, 1, 'Created data Primary key:64', 'Sanction Referral', '2022-09-21 09:34:11'),
(114, 1, 'Updated data Primary key:64', 'Sanction Referral', '2022-09-21 09:35:35'),
(115, 1, 'Created data Primary key:65', 'Sanction Referral', '2022-09-21 09:35:57'),
(116, 1, 'Updated data Primary key:65', 'Sanction Referral', '2022-09-21 09:37:11'),
(117, 1, 'Created data Primary key:66', 'Sanction Referral', '2022-09-21 09:37:32'),
(118, 1, 'Updated data Primary key:66', 'Sanction Referral', '2022-09-21 09:38:47'),
(119, 1, 'Created data Primary key:67', 'Sanction Referral', '2022-09-21 09:39:08'),
(120, 1, 'Updated data Primary key:67', 'Sanction Referral', '2022-09-21 09:40:53'),
(121, 1, 'Created data Primary key:68', 'Sanction Referral', '2022-09-21 09:41:09'),
(122, 1, 'User Login to the system', '', '2022-09-23 02:40:23'),
(123, 1, 'User sets semester to the system', '', '2022-09-23 02:40:27'),
(124, 1, 'User Logout to the system ', '', '2022-09-23 02:47:21'),
(125, 2, 'User Login to the system', '', '2022-09-23 02:47:29'),
(126, 2, 'User Logout to the system ', '', '2022-09-23 03:10:58'),
(127, 1, 'User Login to the system', '', '2022-09-23 03:11:05'),
(128, 1, 'User sets semester to the system', '', '2022-09-23 03:11:09'),
(129, 1, 'User Login to the system', '', '2022-09-23 08:47:46'),
(130, 1, 'User Login to the system', '', '2022-09-23 08:55:44'),
(131, 1, 'User Login to the system', '', '2022-09-26 07:27:44'),
(132, 1, 'User Logout to the system ', '', '2022-09-26 07:54:58'),
(133, 2, 'User Login to the system', '', '2022-09-26 07:55:02'),
(134, 2, 'User Logout to the system ', '', '2022-09-26 08:03:22'),
(135, 1, 'User Login to the system', '', '2022-09-26 08:03:27'),
(136, 1, 'User Logout to the system ', '', '2022-09-26 08:03:41'),
(137, 2, 'User Login to the system', '', '2022-09-26 08:03:45'),
(138, 1, 'User Login to the system', '', '2022-09-26 14:14:04'),
(139, 1, 'User Logout to the system ', '', '2022-09-26 14:35:14'),
(140, 1, 'User Login to the system', '', '2022-09-26 14:35:21'),
(141, 1, 'User Logout to the system ', '', '2022-09-26 14:37:03'),
(142, 1, 'User Login to the system', '', '2022-09-26 14:37:08'),
(143, 1, 'User Logout to the system ', '', '2022-09-26 14:39:30'),
(144, 1, 'User Login to the system', '', '2022-09-26 14:39:34'),
(145, 1, 'User sets semester to the system', '', '2022-09-26 14:39:38'),
(146, 1, 'User Logout to the system ', '', '2022-09-26 14:41:44'),
(147, 1, 'User Login to the system', '', '2022-09-26 14:41:49'),
(148, 1, 'User sets semester to the system', '', '2022-09-26 14:42:02'),
(149, 1, 'User Logout to the system ', '', '2022-09-26 14:56:41'),
(150, 1, 'User Login to the system', '', '2022-09-26 14:56:45'),
(151, 1, 'User sets semester to the system', '', '2022-09-26 14:56:58'),
(152, 1, 'User Logout to the system ', '', '2022-09-26 14:57:40'),
(153, 1, 'User Login to the system', '', '2022-09-26 14:57:43'),
(154, 1, 'User sets semester to the system', '', '2022-09-26 14:57:48'),
(155, 1, 'User Logout to the system ', '', '2022-09-26 15:00:33'),
(156, 1, 'User Login to the system', '', '2022-09-26 15:00:36'),
(157, 1, 'User sets semester to the system', '', '2022-09-26 15:00:41'),
(158, 1, 'Updated data Primary key:57', 'Sanction Referral', '2022-09-26 16:01:53'),
(159, 1, 'Updated data Primary key:56', 'Sanction Referral', '2022-09-26 16:14:51'),
(160, 1, 'Updated data Primary key:68', 'Sanction Referral', '2022-09-26 16:42:57'),
(161, 1, 'User Login to the system', '', '2022-09-28 08:34:20'),
(162, 1, 'User Login to the system', '', '2022-09-28 08:37:00'),
(163, 1, 'User Login to the system', '', '2022-09-28 08:37:06'),
(164, 1, 'User Login to the system', '', '2022-09-28 08:39:50'),
(165, 1, 'User sets semester to the system', '', '2022-09-28 08:40:00'),
(166, 1, 'User Login to the system', '', '2022-09-28 08:42:38'),
(167, 1, 'User Login to the system', '', '2022-09-28 08:43:29'),
(168, 1, 'User Logout to the system ', '', '2022-09-28 09:17:27'),
(170, 1, 'User Login to the system', '', '2022-09-28 09:23:37'),
(171, 1, 'User Logout to the system ', '', '2022-09-28 12:09:26'),
(173, 1, 'User Login to the system', '', '2022-10-05 12:51:28'),
(174, 1, 'User sets semester to the system', '', '2022-10-05 12:55:28'),
(175, 1, 'User Logout to the system ', '', '2022-10-05 12:56:54'),
(176, 1, 'User Login to the system', '', '2022-10-05 12:56:59'),
(177, 1, 'User Login to the system', '', '2022-10-06 08:00:28'),
(178, 1, 'User sets semester to the system', '', '2022-10-06 08:00:39'),
(179, 1, 'User Logout to the system ', '', '2022-10-06 08:00:48'),
(180, 1, 'User Login to the system', '', '2022-10-06 08:00:54'),
(181, 1, 'Updated data Primary key:68', 'Sanction Referral', '2022-10-06 08:15:08'),
(182, 1, 'Updated data Primary key:49', 'Sanction Counselling', '2022-10-06 08:19:25'),
(183, 1, 'User sets semester to the system', '', '2022-10-06 08:44:23'),
(184, 1, 'User Logout to the system ', '', '2022-10-06 12:50:18'),
(185, 1, 'User Login to the system', '', '2022-10-13 00:37:31'),
(186, 1, 'User sets semester to the system', '', '2022-10-13 00:37:39'),
(187, 1, 'User Login to the system', '', '2022-10-13 08:27:46'),
(188, 1, 'User sets semester to the system', '', '2022-10-13 11:34:05'),
(189, 1, 'Created data Primary key:69', 'Sanction Referral', '2022-10-13 11:34:24'),
(190, 1, 'Created data Primary key:70', 'Sanction Referral', '2022-10-13 11:35:49'),
(191, 1, 'Updated data Primary key:70', 'Sanction Referral', '2022-10-13 11:57:15'),
(192, 1, 'User Login to the system', '', '2022-10-14 02:58:42'),
(193, 1, 'User sets semester to the system', '', '2022-10-14 04:06:30'),
(194, 1, 'Created data Primary key:100', 'Sanction Action', '2022-10-14 04:07:02'),
(195, 1, 'Deleted data Primary key:', 'Sanction Action', '2022-10-14 10:09:09'),
(196, 1, 'Created data Primary key:101', 'Sanction Action', '2022-10-14 10:11:08'),
(197, 1, 'Updated data Primary key:70', 'Sanction Referral', '2022-10-14 10:25:36'),
(198, 1, 'Updated data Primary key:', 'Sanction Action', '2022-10-14 10:26:28'),
(199, 1, 'Updated data Primary key:101', 'Sanction Action', '2022-10-14 10:27:55'),
(200, 1, 'User Login to the system', '', '2022-10-14 14:57:35'),
(201, 1, 'Created data Primary key:51', 'Sanction Counselling', '2022-10-14 14:59:27'),
(202, 1, 'Updated data Primary key:51', 'Sanction Counselling', '2022-10-14 15:13:23'),
(203, 1, 'Updated data Primary key:70', 'Sanction Referral', '2022-10-14 15:13:46'),
(204, 1, 'Updated data Primary key:51', 'Sanction Counselling', '2022-10-14 15:16:28'),
(205, 1, 'Updated data Primary key:51', 'Sanction Counselling', '2022-10-14 15:18:31'),
(206, 1, 'Updated data Primary key:51', 'Sanction Counselling', '2014-10-22 03:22:05'),
(207, 1, 'Updated data Primary key:51', 'Sanction Counselling', '2022-10-14 15:23:06'),
(208, 1, 'User Login to the system', '', '2022-10-15 12:29:28'),
(209, 1, 'User sets semester to the system', '', '2022-10-15 12:44:49'),
(210, 1, 'Created data Primary key:71', 'Sanction Referral', '2022-10-15 12:45:09'),
(211, 1, 'Updated data Primary key:8', 'Students', '2022-10-15 15:12:46'),
(212, 1, 'Created data Primary key:72', 'Sanction Referral', '2022-10-15 15:16:45'),
(213, 1, 'Created data Primary key:73', 'Sanction Referral', '2022-10-15 15:17:22'),
(214, 1, 'Created data Primary key:9', 'Students', '2022-10-15 19:51:37'),
(215, 1, 'Created data Primary key:74', 'Sanction Referral', '2022-10-15 19:52:34'),
(216, 1, 'Updated data Primary key:72', 'Sanction Referral', '2022-10-15 19:56:53'),
(217, 1, 'Updated data Primary key:74', 'Sanction Referral', '2022-10-15 19:58:19'),
(218, 1, 'Updated data Primary key:72', 'Sanction Referral', '2022-10-15 19:59:21'),
(219, 1, 'User Login to the system', '', '2022-10-16 21:19:39'),
(220, 1, 'Updated data Primary key:9', 'Students', '2022-10-16 21:19:48'),
(221, 1, 'User Login to the system', '', '2022-10-19 09:24:35'),
(222, 1, 'User Login to the system', '', '2022-10-19 16:10:19'),
(223, 1, 'User Login to the system', '', '2022-10-20 09:15:47'),
(224, 1, 'User sets semester to the system', '', '2022-10-20 09:34:07'),
(225, 1, 'Created data Primary key:102', 'Sanction Action', '2022-10-20 09:34:32'),
(226, 1, 'Created data Primary key:52', 'Sanction Counselling', '2022-10-20 09:49:21'),
(227, 1, 'Updated data Primary key:51', 'Sanction Counselling', '2022-10-20 10:25:26'),
(228, 1, 'Updated data Primary key:51', 'Sanction Counselling', '2022-10-20 10:26:41'),
(229, 1, 'Updated data Primary key:51', 'Sanction Counselling', '2022-10-20 10:28:23'),
(230, 1, 'Created data Primary key:75', 'Sanction Referral', '2022-10-20 11:59:03'),
(231, 1, 'Deleted data Primary key:75', 'Sanction Referral', '2022-10-20 12:06:28'),
(232, 1, 'Updated data Primary key:51', 'Sanction Counselling', '2022-10-20 13:37:30'),
(233, 1, 'Created data Primary key:103', 'Sanction Action', '2022-10-20 13:38:05'),
(234, 1, 'Created data Primary key:53', 'Sanction Counselling', '2022-10-20 13:38:32'),
(235, 1, 'User Login to the system', '', '2022-10-20 14:05:10'),
(236, 1, 'User Login to the system', '', '2022-10-22 08:10:45'),
(237, 1, 'User Login to the system', '', '2022-10-22 08:37:49'),
(238, 1, 'User sets semester to the system', '', '2022-10-22 08:39:25'),
(239, 1, 'User Login to the system', '', '2022-10-22 15:22:45'),
(240, 1, 'User sets semester to the system', '', '2022-10-22 15:23:36'),
(241, 1, 'Created data Primary key:76', 'Sanction Referral', '2022-10-22 15:23:49'),
(242, 1, 'User Login to the system', '', '2022-10-23 09:45:59'),
(243, 1, 'Deleted data Primary key:51', 'Sanction Action', '2022-10-23 11:10:35'),
(244, 1, 'Updated data Primary key:70', 'Sanction Referral', '2022-10-23 11:12:55'),
(245, 1, 'Updated data Primary key:103', 'Sanction Action', '2022-10-23 11:13:24'),
(246, 1, 'User sets semester to the system', '', '2022-10-23 12:57:46'),
(247, 1, 'User Login to the system', '', '2022-10-24 14:59:23'),
(248, 1, 'User Login to the system', '', '2022-10-25 19:48:26'),
(249, 1, 'User sets semester to the system', '', '2022-10-25 19:49:29'),
(250, 1, 'Updated data Primary key:2', 'Students', '2022-10-25 19:52:00'),
(251, 1, 'Updated data Primary key:73', 'Sanction Referral', '2022-10-25 19:57:48'),
(252, 1, 'Updated data Primary key:76', 'Sanction Referral', '2022-10-25 19:58:13'),
(253, 1, 'Updated data Primary key:76', 'Sanction Referral', '2022-10-25 20:03:25'),
(254, 1, 'Created data Primary key:10', 'Students', '2022-10-25 20:12:50'),
(255, 1, 'User Login to the system', '', '2022-10-25 20:14:26'),
(256, 1, 'User sets semester to the system', '', '2022-10-25 20:15:19'),
(257, 1, 'User Logout to the system ', '', '2022-10-25 20:20:20'),
(258, 1, 'User Login to the system', '', '2022-10-25 20:20:25'),
(259, 1, 'User Login to the system', '', '2022-10-25 20:23:16'),
(260, 1, 'User sets semester to the system', '', '2022-10-25 20:23:24'),
(261, 1, 'Created data Primary key:77', 'Sanction Referral', '2022-10-25 20:24:28'),
(262, 1, 'User Login to the system', '', '2022-10-26 09:44:40'),
(263, 1, 'User Login to the system', '', '2022-10-26 11:18:55'),
(264, 1, 'User Login to the system', '', '2022-10-26 11:48:30'),
(265, 1, 'User sets semester to the system', '', '2022-10-26 11:53:31'),
(266, 1, 'User Login to the system', '', '2022-10-26 19:45:24'),
(267, 1, 'User sets semester to the system', '', '2022-10-26 19:52:39'),
(268, 1, 'Deleted data Primary key:77', 'Sanction Referral', '2022-10-26 19:54:58'),
(269, 1, 'User Login to the system', '', '2022-10-27 18:52:25'),
(270, 1, 'User Login to the system', '', '2022-11-02 14:29:11'),
(271, 1, 'User Login to the system', '', '2022-11-02 20:10:23'),
(272, 1, 'User sets semester to the system', '', '2022-11-02 20:10:32'),
(273, 1, 'User Logout to the system ', '', '2022-11-02 20:13:45'),
(274, 1, 'User Login to the system', '', '2022-11-02 20:13:48'),
(275, 1, 'User sets semester to the system', '', '2022-11-02 20:16:07'),
(276, 1, 'User Login to the system', '', '2022-11-04 11:45:45'),
(277, 1, 'User Login to the system', '', '2022-11-04 12:51:45'),
(278, 1, 'User sets semester to the system', '', '2022-11-04 14:51:25'),
(279, 1, 'Created data Primary key:78', 'Sanction Referral', '2022-11-04 21:21:05'),
(280, 1, 'User Login to the system', '', '2022-11-05 10:17:23'),
(281, 1, 'User sets semester to the system', '', '2022-11-05 10:17:30'),
(282, 1, 'User Login to the system', '', '2022-11-09 15:19:22'),
(283, 1, 'User Login to the system', '', '2022-11-12 09:34:46'),
(284, 1, 'User Login to the system', '', '2022-11-19 15:33:43'),
(285, 1, 'User Login to the system', '', '2022-11-24 16:06:37'),
(286, 1, 'Updated data Primary key:10', 'Students', '2022-11-24 16:07:45'),
(287, 1, 'Updated data Primary key:10', 'Students', '2022-11-24 16:09:47'),
(288, 1, 'Updated data Primary key:10', 'Students', '2022-11-24 16:21:25'),
(289, 1, 'Updated data Primary key:10', 'Students', '2022-11-24 18:55:14'),
(290, 1, 'Updated data Primary key:10', 'Students', '2022-11-24 18:55:22'),
(291, 1, 'Updated data Primary key:10', 'Students', '2022-11-24 18:56:41'),
(292, 1, 'Updated data Primary key:10', 'Students', '2022-11-24 18:56:51'),
(293, 1, 'Updated data Primary key:10', 'Students', '2022-11-24 18:56:55'),
(294, 1, 'Updated data Primary key:10', 'Students', '2022-11-24 18:57:02'),
(295, 1, 'Updated data Primary key:10', 'Students', '2022-11-24 18:57:20'),
(296, 1, 'Updated data Primary key:10', 'Students', '2022-11-24 18:57:23'),
(297, 1, 'User Login to the system', '', '2022-11-28 17:37:32'),
(298, 1, 'User Login to the system', '', '2022-11-29 22:15:16'),
(299, 1, 'User Login to the system', '', '2022-11-30 12:40:26'),
(300, 1, 'User sets semester to the system', '', '2022-11-30 12:40:33'),
(301, 1, 'User Login to the system', '', '2022-12-01 21:14:23'),
(302, 1, 'Updated data Primary key:32', 'Programs', '2022-12-01 21:16:46'),
(303, 1, 'Updated data Primary key:32', 'Programs', '2022-12-01 21:16:56'),
(304, 1, 'Updated data Primary key:32', 'Programs', '2022-12-01 21:19:04'),
(305, 1, 'Updated data Primary key:32', 'Programs', '2022-12-01 21:19:10'),
(306, 1, 'Updated data Primary key:32', 'Programs', '2022-12-01 21:19:14'),
(307, 1, 'Updated data Primary key:32', 'Programs', '2022-12-01 21:19:20'),
(308, 1, 'Updated data Primary key:32', 'Programs', '2022-12-01 21:19:28'),
(309, 1, 'Updated data Primary key:32', 'Programs', '2022-12-01 21:19:31'),
(310, 1, 'Created data Primary key:33', 'Programs', '2022-12-01 21:22:09'),
(311, 1, 'Deleted data Primary key:33', 'Programs', '2022-12-01 21:22:12'),
(312, 1, 'User sets semester to the system', '', '2022-12-01 21:45:04'),
(313, 1, 'User Login to the system', '', '2022-12-03 08:51:24'),
(314, 1, 'User Logout to the system ', '', '2022-12-03 13:15:33'),
(315, 2, 'User Login to the system', '', '2022-12-03 13:15:37'),
(316, 2, 'User Logout to the system ', '', '2022-12-03 13:16:07'),
(317, 1, 'User Login to the system', '', '2022-12-03 13:16:12'),
(318, 1, 'User sets semester to the system', '', '2022-12-03 13:19:37'),
(319, 1, 'Created data Primary key:54', 'Sanction Counselling', '2022-12-03 14:01:16'),
(320, 1, 'User Login to the system', '', '2022-12-03 14:06:31'),
(321, 1, 'User Login to the system', '', '2022-12-03 14:12:34'),
(322, 1, 'Created data Primary key:55', 'Sanction Counselling', '2022-12-03 14:37:15'),
(323, 1, 'Deleted data Primary key:52', 'Sanction Action', '2022-12-03 14:47:52'),
(324, 1, 'Deleted data Primary key:54', 'Sanction Action', '2022-12-03 14:48:35'),
(325, 1, 'Deleted data Primary key:55', 'Sanction Action', '2022-12-03 14:52:27'),
(326, 1, 'Created data Primary key:56', 'Sanction Counselling', '2022-12-03 14:56:54'),
(327, 1, 'Deleted data Primary key:56', 'Sanction Action', '2022-12-03 14:57:02'),
(328, 1, 'Created data Primary key:57', 'Sanction Counselling', '2022-12-03 14:57:12'),
(329, 1, 'Created data Primary key:58', 'Sanction Counselling', '2022-12-03 14:57:21'),
(330, 1, 'Created data Primary key:59', 'Sanction Counselling', '2022-12-03 14:57:34'),
(331, 1, 'Updated data Primary key:57', 'Sanction Counselling', '2022-12-03 14:58:03'),
(332, 1, 'User sets semester to the system', '', '2022-12-03 15:55:35'),
(333, 1, 'Created data Primary key:79', 'Sanction Referral', '2022-12-03 15:55:51'),
(334, 1, 'Deleted data Primary key:79', 'Sanction Referral', '2022-12-03 15:57:01'),
(335, 1, 'Created data Primary key:80', 'Sanction Referral', '2022-12-03 15:57:15'),
(336, 1, 'Created data Primary key:104', 'Sanction Action', '2022-12-03 16:06:08'),
(337, 1, 'Created data Primary key:105', 'Sanction Action', '2022-12-03 16:10:28'),
(338, 1, 'Updated data Primary key:73', 'Sanction Referral', '2022-12-03 16:55:30'),
(339, 1, 'User Login to the system', '', '2022-12-04 15:11:30'),
(340, 1, 'Updated data Primary key:30', 'Leadership', '2022-12-04 15:27:05'),
(341, 1, 'Updated data Primary key:30', 'Leadership', '2022-12-04 15:27:24'),
(342, 1, 'User sets semester to the system', '', '2022-12-04 16:03:13'),
(343, 1, 'User Login to the system', '', '2022-12-04 21:21:35'),
(344, 1, 'User sets semester to the system', '', '2022-12-04 21:21:42'),
(345, 1, 'User Login to the system', '', '2023-01-05 19:33:38'),
(346, 1, 'User Logout to the system ', '', '2023-01-05 20:02:50'),
(347, 2, 'User Login to the system', '', '2023-01-05 20:02:55'),
(348, 2, 'User Logout to the system ', '', '2023-01-05 20:39:25'),
(349, 1, 'User Login to the system', '', '2023-01-05 20:39:28'),
(350, 1, 'User Logout to the system ', '', '2023-01-05 20:39:31'),
(352, 2, 'User Login to the system', '', '2023-01-05 20:39:42'),
(353, 2, 'User Logout to the system ', '', '2023-01-05 20:48:42'),
(354, 1, 'User Login to the system', '', '2023-01-05 20:48:53'),
(355, 1, 'User Logout to the system ', '', '2023-01-05 22:08:15'),
(356, 1, 'User Login to the system', '', '2023-01-05 22:08:24'),
(357, 1, 'User Login to the system', '', '2023-01-10 09:53:41'),
(358, 1, 'User Login to the system', '', '2023-01-10 22:32:01'),
(359, 1, 'User Logout to the system ', '', '2023-01-10 22:38:14'),
(360, 2, 'User Login to the system', '', '2023-01-10 22:38:20'),
(361, 2, 'User Logout to the system ', '', '2023-01-10 22:38:33'),
(362, 1, 'User Login to the system', '', '2023-01-10 23:31:55'),
(363, 1, 'User sets semester to the system', '', '2023-01-10 23:41:10'),
(364, 1, 'User Login to the system', '', '2023-01-11 20:47:49'),
(365, 1, 'User sets semester to the system', '', '2023-01-11 20:48:05'),
(366, 1, 'Created data Primary key:81', 'Sanction Referral', '2023-01-11 20:48:18'),
(367, 1, 'Created data Primary key:106', 'Sanction Action', '2023-01-11 20:48:36'),
(368, 1, 'Deleted data Primary key:81', 'Sanction Action', '2023-01-11 20:50:08'),
(369, 1, 'Created data Primary key:107', 'Sanction Action', '2023-01-11 20:51:39'),
(370, 1, 'Deleted data Primary key:81', 'Sanction Action', '2023-01-11 21:03:09'),
(371, 1, 'Deleted data Primary key:81', 'Sanction Referral', '2023-01-11 21:03:18'),
(372, 1, 'User Login to the system', '', '2023-01-12 14:09:04'),
(373, 1, 'User sets semester to the system', '', '2023-01-12 15:00:23'),
(374, 1, 'User Logout to the system ', '', '2023-01-12 15:51:59'),
(376, 2, 'User Login to the system', '', '2023-01-12 15:52:50'),
(377, 2, 'User Logout to the system ', '', '2023-01-12 15:53:24'),
(378, 1, 'User Login to the system', '', '2023-01-12 15:53:35'),
(379, 1, 'User Logout to the system ', '', '2023-01-12 15:54:07'),
(380, 1, 'User Login to the system', '', '2023-01-12 16:13:40'),
(381, 1, 'User Login to the system', '', '2023-01-15 19:28:34'),
(382, 1, 'User Login to the system', '', '2023-01-16 20:29:34'),
(383, 1, 'User Logout to the system ', '', '2023-01-16 20:35:19'),
(384, 1, 'User Login to the system', '', '2023-01-16 20:40:57'),
(385, 1, 'User Logout to the system ', '', '2023-01-16 20:41:01'),
(386, 2, 'User Login to the system', '', '2023-01-16 20:41:06'),
(387, 2, 'User Logout to the system ', '', '2023-01-16 20:41:12'),
(389, 1, 'User Login to the system', '', '2023-01-16 20:41:37'),
(390, 1, 'User sets semester to the system', '', '2023-01-16 20:42:01'),
(391, 1, 'Updated data Primary key:32', 'Programs', '2023-01-16 20:43:57'),
(392, 1, 'Created data Primary key:82', 'Sanction Referral', '2023-01-16 20:46:42'),
(393, 1, 'Created data Primary key:108', 'Sanction Action', '2023-01-16 20:49:16'),
(394, 1, 'Deleted data Primary key:82', 'Sanction Action', '2023-01-16 20:50:24'),
(395, 1, 'Deleted data Primary key:82', 'Sanction Referral', '2023-01-16 20:50:30'),
(396, 1, 'Created data Primary key:83', 'Sanction Referral', '2023-01-16 20:50:45'),
(397, 1, 'Created data Primary key:109', 'Sanction Action', '2023-01-16 20:50:59'),
(398, 1, 'Created data Primary key:60', 'Sanction Counselling', '2023-01-16 20:52:14'),
(399, 1, 'Created data Primary key:20', 'Lost and Found', '2023-01-16 20:53:17'),
(400, 1, 'Updated data Primary key:', 'Lost and Found', '2023-01-16 20:53:53'),
(401, 1, 'Updated data Primary key:', 'Lost and Found', '2023-01-16 20:54:05'),
(402, 1, 'Created data Primary key:12', 'Outstanding Athlete', '2023-01-16 20:55:42'),
(403, 1, 'User Logout to the system ', '', '2023-01-16 20:56:21'),
(404, 2, 'User Login to the system', '', '2023-01-16 20:56:25'),
(405, 2, 'User Logout to the system ', '', '2023-01-16 20:57:39'),
(408, 1, 'User Login to the system', '', '2023-01-16 20:59:16'),
(409, 1, 'Updated data Primary key:30', 'Leadership', '2023-01-16 21:02:02'),
(410, 1, 'Created data Primary key:37', 'Leadership', '2023-01-16 21:19:50'),
(411, 1, 'Created data Primary key:14', 'Good Deeds', '2023-01-16 21:28:45'),
(412, 1, 'Deleted data Primary key:14', 'Good Deeds', '2023-01-16 21:30:56'),
(413, 1, 'User Login to the system', '', '2023-01-18 20:24:29'),
(414, 1, 'User Login to the system', '', '2023-01-19 09:08:35'),
(415, 1, 'User sets semester to the system', '', '2023-01-19 09:09:28'),
(416, 1, 'Updated data Primary key:72', 'Sanction Referral', '2023-01-19 16:19:55'),
(417, 1, 'Updated data Primary key:72', 'Sanction Referral', '2023-01-19 16:27:32'),
(418, 1, 'Updated data Primary key:72', 'Sanction Referral', '2023-01-19 16:29:58'),
(419, 1, 'User Login to the system', '', '2023-01-19 20:19:13'),
(420, 1, 'User sets semester to the system', '', '2023-01-19 20:19:34'),
(421, 1, 'Created data Primary key:84', 'Sanction Referral', '2023-01-19 20:23:44'),
(422, 1, 'Created data Primary key:85', 'Sanction Referral', '2023-01-19 20:26:01'),
(423, 1, 'Deleted data Primary key:85', 'Sanction Referral', '2023-01-19 20:27:51'),
(424, 1, 'Deleted data Primary key:84', 'Sanction Referral', '2023-01-19 20:27:55'),
(425, 1, 'Created data Primary key:86', 'Sanction Referral', '2023-01-19 20:28:13'),
(426, 1, 'Deleted data Primary key:86', 'Sanction Referral', '2023-01-19 20:32:01'),
(427, 1, 'Created data Primary key:87', 'Sanction Referral', '2023-01-19 20:32:09'),
(428, 1, 'Deleted data Primary key:72', 'Sanction Referral', '2023-01-19 20:38:35'),
(429, 1, 'Created data Primary key:88', 'Sanction Referral', '2023-01-19 20:39:06'),
(430, 1, 'User Login to the system', '', '2023-01-20 20:36:09'),
(431, 1, 'User Login to the system', '', '2023-01-21 15:10:12'),
(432, 1, 'User sets semester to the system', '', '2023-01-21 15:15:10'),
(433, 1, 'User Logout to the system ', '', '2023-01-21 15:56:54'),
(434, 1, 'User Login to the system', '', '2023-01-21 16:14:56'),
(435, 1, 'User sets semester to the system', '', '2023-01-21 16:43:32'),
(436, 1, 'User Login to the system', '', '2023-01-21 20:38:31'),
(437, 1, 'User sets semester to the system', '', '2023-01-21 22:05:50'),
(438, 1, 'User Login to the system', '', '2023-01-22 08:46:49'),
(439, 1, 'User sets semester to the system', '', '2023-01-22 09:39:15'),
(440, 1, 'User Login to the system', '', '2023-01-23 16:41:08'),
(441, 1, 'User Login to the system', '', '2023-01-23 16:46:38'),
(442, 1, 'User sets semester to the system', '', '2023-01-23 16:51:10'),
(443, 1, 'Created data Primary key:89', 'Sanction Referral', '2023-01-23 16:51:41'),
(444, 1, 'User Login to the system', '', '2023-01-23 17:20:15'),
(445, 1, 'User Login to the system', '', '2023-01-23 22:18:13'),
(446, 1, 'User Login to the system', '', '2023-01-23 23:03:11'),
(447, 1, 'User sets semester to the system', '', '2023-01-23 23:09:29'),
(448, 1, 'User Login to the system', '', '2023-01-24 17:35:50'),
(449, 1, 'User Logout to the system ', '', '2023-01-24 17:36:03'),
(450, 1, 'User Login to the system', '', '2023-01-24 17:36:13'),
(451, 1, 'User Login to the system', '', '2023-01-24 22:26:29');

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
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `syslogs`
--
ALTER TABLE `syslogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `leaderships`
--
ALTER TABLE `leaderships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `sanction_cases`
--
ALTER TABLE `sanction_cases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `sanction_disciplinary_action`
--
ALTER TABLE `sanction_disciplinary_action`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `sanction_referrals`
--
ALTER TABLE `sanction_referrals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `syslogs`
--
ALTER TABLE `syslogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=452;

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
-- Constraints for table `syslogs`
--
ALTER TABLE `syslogs`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `violations`
--
ALTER TABLE `violations`
  ADD CONSTRAINT `offenses_id` FOREIGN KEY (`offenses_id`) REFERENCES `offenses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
