-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2024 at 07:17 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `health_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `mgs_id` int(11) NOT NULL,
  `attachment` varchar(500) NOT NULL,
  `fileType` varchar(500) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `msg` varchar(10000) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`mgs_id`, `attachment`, `fileType`, `sender_id`, `receiver_id`, `msg`, `date`) VALUES
(1, '', '', 1, 0, 'hello', '2024-08-01 10:46:50'),
(2, '', '', 0, 1, 'hi', '2024-08-01 10:49:51'),
(3, '', '', 0, 1, 'welcome', '2024-08-01 11:00:28'),
(4, '', '', 0, 1, 'hi', '2024-08-01 11:05:54'),
(5, '', '', 3, 1, 'hi', '2024-08-01 11:48:09'),
(6, '', '', 3, 2, 'hi', '2024-08-01 11:50:34'),
(7, '', '', 3, 1, 'let\'s try', '2024-08-01 11:51:42'),
(8, '', '', 1, 3, 'sure', '2024-08-01 11:56:45'),
(9, '', '', 3, 1, 'Hi', '2024-08-04 14:01:57'),
(10, '', '', 43, 1, 'Hi', '2024-08-16 19:36:10'),
(11, '', '', 43, 1, 'Please I\'m having some side effects on the medicine ', '2024-08-16 19:36:37'),
(12, '', '', 1, 43, 'How do you feel', '2024-08-16 19:37:57'),
(13, '', '', 1, 43, 'Come for review on Monday 11:45am', '2024-08-16 19:38:37'),
(14, '', '', 43, 1, 'Okay Doc', '2024-08-16 19:39:15'),
(15, '', '', 1, 42, 'hi', '2024-09-05 20:18:38'),
(16, '', '', 43, 1, 'Hi', '2024-09-23 21:14:08'),
(17, '', '', 43, 1, 'Hii', '2024-09-23 21:15:04'),
(18, '', '', 44, 43, 'hi', '2024-09-23 21:15:11'),
(19, '', '', 43, 1, 'Hey', '2024-09-23 21:16:07'),
(20, '', '', 43, 1, 'I hope you\'re doing well ', '2024-09-23 21:17:05'),
(21, '', '', 43, 1, 'Hello ', '2024-09-23 21:18:59'),
(22, '', '', 1, 43, 'i\'m fine and you', '2024-09-23 21:21:13'),
(23, '', '', 40, 1, 'Hello ', '2024-09-23 21:26:29'),
(24, '', '', 1, 40, 'hi Iwin', '2024-09-23 21:27:03'),
(25, '', '', 43, 1, 'Hi', '2024-09-24 11:05:07'),
(26, '', '', 43, 1, 'Hi', '2024-10-02 09:41:53'),
(27, '', '', 43, 1, 'Hope you\'re fine ', '2024-10-02 09:42:10');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `profilePicture` varchar(50) DEFAULT NULL,
  `gender` varchar(2) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `password`, `email`, `profilePicture`, `gender`, `contact`, `date`) VALUES
(5, 'Mark Wommy', 'beta12345', 'markantwi85@gmail.com', NULL, '', '', '2024-07-12 07:31:06'),
(6, 'Antwi Gabriel', '12345', 'ggg@gg', NULL, '', '', '2024-07-12 07:31:06'),
(11, 'West Anderson', '123456', 'smithqsw3dfsr36te@gmail.com', NULL, '', '', '2024-07-12 07:31:06'),
(12, 'Elder Beta', 'beta', 'elder12345', NULL, '', '', '2024-07-12 07:31:06'),
(13, 'James White', '1234', 'Cornelius@Cornelius', NULL, '', '', '2024-07-12 07:31:06'),
(14, 'Elder Gradle', 'elder', 'elder12345', NULL, '', '', '2024-07-12 07:31:06'),
(29, 'Joy Wooyen', 'Joy', 'Joy@Joy', 'uploads/profilePictures/Joy.png', 'F', '025', '2024-07-12 07:31:06'),
(30, 'dall Johnsom', 'dall', 'dall@12345', 'uploads/profilePictures/dall.png', 'M', '024567890', '2024-07-12 07:31:06'),
(39, 'Jame White', '1234', 'jay@gmail.com', 'uploads/profilePictures/gfkfc.jpg', 'F', '0257001055', '2024-07-12 07:31:06'),
(40, 'Mensah Iwin Tetteh', 'df', 'mensahiwintetteh@gmail.com', 'uploads/profilePictures/gfkfc.jpg', 'F', '0257001055', '2024-07-12 07:31:06'),
(41, 'Kobbiah Patrick  Domako', '1234', 'kobbiahpatrickdomako@email', 'uploads/profilePictures/Ivanic.jpg', 'M', '0595199746', '2024-07-12 07:31:06'),
(42, 'Keziah Adoriba', 'hi', 'Adoribaan@gmail.com', 'uploads/profilePictures/hi.jpg', 'M', '0257001055', '2024-07-12 07:31:06'),
(43, 'Hannah Yomley', 'hannah', 'hannah@gmail.com', NULL, 'Fe', '0303454643', '2024-08-16 16:32:23');

-- --------------------------------------------------------

--
-- Table structure for table `emergencies`
--

CREATE TABLE `emergencies` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `lon` varchar(500) NOT NULL,
  `latt` varchar(500) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'no reaction yet'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emergencies`
--

INSERT INTO `emergencies` (`id`, `date`, `lon`, `latt`, `status`) VALUES
(1, '2024-07-10 22:05:07', '-2.347321', '7.354255', ''),
(2, '2024-07-17 20:18:19', '-2.343989', '7.351331', 'no reaction yet'),
(3, '2024-07-17 20:18:19', '-2.343989', '7.351331', 'no reaction yet'),
(4, '2024-07-19 16:21:07', '-2.343989', '7.351331', 'no reaction yet'),
(5, '2024-07-19 16:21:07', '-2.343989', '7.351331', 'no reaction yet'),
(6, '2024-07-19 16:21:07', '-2.343989', '7.351331', 'no reaction yet'),
(7, '2024-07-19 16:21:24', '-2.343989', '7.351331', 'no reaction yet'),
(8, '2024-07-19 16:22:55', '-2.343989', '7.351331', 'no reaction yet'),
(9, '2024-07-19 16:50:13', '-2.343989', '7.351331', 'no reaction yet'),
(10, '2024-07-27 14:41:37', '-0.2162688', '5.6131584', 'no reaction yet'),
(11, '2024-08-04 00:07:00', '-2.3460487', '7.356525', 'no reaction yet'),
(12, '2024-08-04 00:07:08', '-2.3460487', '7.356525', 'no reaction yet'),
(13, '2024-08-04 00:07:08', '-2.3460487', '7.356525', 'no reaction yet'),
(14, '2024-08-04 00:07:08', '-2.3460487', '7.356525', 'no reaction yet'),
(15, '2024-08-04 00:07:08', '-2.3460487', '7.356525', 'no reaction yet'),
(16, '2024-08-04 00:07:14', '-2.3460487', '7.356525', 'no reaction yet'),
(17, '2024-08-04 00:07:23', '-2.3460487', '7.356525', 'no reaction yet'),
(18, '2024-08-04 00:07:23', '-2.3460487', '7.356525', 'no reaction yet'),
(19, '2024-08-04 00:07:23', '-2.3460487', '7.356525', 'no reaction yet'),
(20, '2024-08-04 00:07:23', '-2.3460487', '7.356525', 'no reaction yet'),
(21, '2024-08-04 00:07:53', '-2.3460487', '7.356525', 'no reaction yet'),
(22, '2024-08-04 00:07:58', '-2.3460487', '7.356525', 'no reaction yet'),
(23, '2024-08-04 00:07:58', '-2.3460487', '7.356525', 'no reaction yet'),
(24, '2024-08-14 16:24:30', '-2.3466653', '7.3544975', 'no reaction yet'),
(25, '2024-08-14 16:24:30', '-2.3466653', '7.3544975', 'no reaction yet'),
(26, '2024-08-14 16:24:40', '-2.3466653', '7.3544975', 'no reaction yet'),
(27, '2024-08-14 16:24:40', '-2.3466653', '7.3544975', 'no reaction yet'),
(28, '2024-08-14 16:27:18', '-2.347321', '7.354255', 'no reaction yet'),
(29, '2024-09-05 20:34:49', '-2.3414245', '7.3508138', 'no reaction yet'),
(30, '2024-09-05 20:34:49', '-2.3414245', '7.3508138', 'no reaction yet'),
(31, '2024-09-05 20:34:52', '-2.3414245', '7.3508138', 'no reaction yet'),
(32, '2024-09-05 20:35:06', '-2.3414245', '7.3508138', 'no reaction yet'),
(33, '2024-09-05 20:35:11', '-2.3414245', '7.3508138', 'no reaction yet'),
(34, '2024-09-05 20:35:11', '-2.3414245', '7.3508138', 'no reaction yet'),
(35, '2024-09-05 20:35:11', '-2.3414245', '7.3508138', 'no reaction yet'),
(36, '2024-09-05 21:43:39', '-2.3429156', '7.3495617', 'no reaction yet'),
(37, '2024-09-05 21:43:39', '-2.3429156', '7.3495617', 'no reaction yet'),
(38, '2024-09-23 21:33:35', '-2.3420113650991063', '7.350882688777273', 'no reaction yet'),
(39, '2024-09-23 21:33:55', '-2.341768223540044', '7.351038863959641', 'no reaction yet'),
(40, '2024-09-23 21:33:57', '-2.341964775719431', '7.350886102105835', 'no reaction yet'),
(41, '2024-09-23 21:33:58', '-2.341977824394366', '7.350880377254076', 'no reaction yet'),
(42, '2024-09-23 21:33:59', '-2.3419771177625677', '7.3508814154663025', 'no reaction yet'),
(43, '2024-09-23 21:34:16', '-2.341977308502073', '7.350881448791547', 'no reaction yet'),
(44, '2024-09-23 21:34:16', '-2.341977308502073', '7.350881448791547', 'no reaction yet'),
(45, '2024-09-23 21:34:16', '-2.341977308502073', '7.350881448791547', 'no reaction yet'),
(46, '2024-09-23 21:34:17', '-2.341977308502073', '7.350881448791547', 'no reaction yet'),
(47, '2024-09-23 21:34:17', '-2.341977308502073', '7.350881448791547', 'no reaction yet'),
(48, '2024-09-23 21:34:51', '-2.341977308502073', '7.350881448791547', 'no reaction yet'),
(49, '2024-09-23 21:34:51', '-2.341977308502073', '7.350881448791547', 'no reaction yet'),
(50, '2024-09-23 21:34:52', '-2.341977308502073', '7.350881448791547', 'no reaction yet'),
(51, '2024-09-23 21:34:53', '-2.341977308502073', '7.350881448791547', 'no reaction yet'),
(52, '2024-09-23 21:34:54', '-2.341977308502073', '7.350881448791547', 'no reaction yet'),
(53, '2024-09-23 21:34:59', '-2.341977308502073', '7.350881448791547', 'no reaction yet'),
(54, '2024-09-23 21:34:59', '-2.341977308502073', '7.350881448791547', 'no reaction yet'),
(55, '2024-09-23 21:35:13', '-2.341977308502073', '7.350881448791547', 'no reaction yet'),
(56, '2024-09-23 21:35:13', '-2.341977308502073', '7.350881448791547', 'no reaction yet'),
(57, '2024-09-23 21:35:13', '-2.341977308502073', '7.350881448791547', 'no reaction yet'),
(58, '2024-09-23 21:35:14', '-2.341977308502073', '7.350881448791547', 'no reaction yet'),
(59, '2024-09-23 21:35:14', '-2.341977308502073', '7.350881448791547', 'no reaction yet'),
(60, '2024-09-23 21:35:14', '-2.341977308502073', '7.350881448791547', 'no reaction yet'),
(61, '2024-09-23 21:35:14', '-2.341977308502073', '7.350881448791547', 'no reaction yet'),
(62, '2024-09-23 21:35:15', '-2.341977308502073', '7.350881448791547', 'no reaction yet'),
(63, '2024-09-23 21:35:15', '-2.341977308502073', '7.350881448791547', 'no reaction yet'),
(64, '2024-10-01 16:01:02', '-2.3421188967725115', '7.35077290645548', 'no reaction yet'),
(65, '2024-10-01 16:02:04', '-2.342148331372335', '7.350647835423572', 'no reaction yet'),
(66, '2024-10-01 16:02:57', '-2.3422616207028932', '7.350545803397554', 'no reaction yet'),
(67, '2024-10-02 00:18:08', '-0.2012', '5.5486', 'no reaction yet'),
(68, '2024-10-02 10:04:04', '-2.341948843195982', '7.349390540328873', 'no reaction yet'),
(69, '2024-10-02 10:05:24', '-2.34211263898465', '7.349278978714567', 'no reaction yet');

-- --------------------------------------------------------

--
-- Table structure for table `patient_records`
--

CREATE TABLE `patient_records` (
  `id` int(11) NOT NULL,
  `patient` int(11) NOT NULL,
  `health_status` text NOT NULL,
  `glucose_level` varchar(10) NOT NULL,
  `blood_pressure` varchar(10) NOT NULL,
  `heart_rate` varchar(10) NOT NULL,
  `temperature` varchar(10) NOT NULL,
  `medications` text NOT NULL,
  `attachment` varchar(500) NOT NULL,
  `additional_notes` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `doctor` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient_records`
--

INSERT INTO `patient_records` (`id`, `patient`, `health_status`, `glucose_level`, `blood_pressure`, `heart_rate`, `temperature`, `medications`, `attachment`, `additional_notes`, `date`, `doctor`) VALUES
(1, 3, 'polikjkn', 'njk;l', 'jkl;;', 'fgb', 'fdg', 'dgfh', '171720628226.jpg', '0', '2024-07-10 16:17:06', '17'),
(2, 5, 'polikjkn', 'njk;l', 'jkl;;', 'fgb', 'fdg', 'dgfh', '171720628352.jpg', '0', '2024-07-10 16:19:12', '17'),
(3, 6, 'polikjkn', 'njk;l', 'jkl;;', 'fgb', 'fdg', 'dgfh', '171720628443.jpg', '0', '2024-07-10 16:20:43', '17'),
(4, 1, 'normal', 'njk;l', 'jkl;;', 'fgb', 'fdg', 'dgfh', '171720628525.jpg', '0', '2024-07-10 16:22:05', '17'),
(5, 10, 'normal', '42', '34', '72', '37', 'lkdflkgvf', '', 'kjh klgdbf', '2024-07-17 10:10:20', 'Admin'),
(6, 31, 'normal', '42', '34', '72', '37', 'lkdflkgvf', '', 'kjh klgdbf', '2024-07-17 10:13:04', 'Admin'),
(7, 31, 'normal', '42', '34', '72', '37', 'lkdflkgvf', '', 'kjh klgdbf', '2024-07-17 10:13:50', 'Admin'),
(8, 43, 'Healthy', '42', '100/85', '72', '37', 'Paracetamol 2X3 daily', '', 'Just follow the prescription', '2024-08-16 19:42:41', '1'),
(9, 42, 'stable', '42', '60\\30', '72', '37', 'para', '', 'you need to rest more', '2024-09-05 20:14:21', '1'),
(10, 42, 'r56tf ghjk', '45', '54/32', '72', '37', 'ktfoktf0oi', '', 'tfhuioklp-[;u98brvr5', '2024-09-05 20:16:16', '1'),
(11, 40, 'healthy', '45', '60/120 ', '56', '36', 'need to take more vitamins', '', 'take good care of yourself ', '2024-09-23 20:38:12', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `profilePicture` varchar(50) DEFAULT NULL,
  `gender` varchar(2) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `profilePicture`, `gender`, `contact`, `date`) VALUES
(5, 'Mark Wommy', 'beta12345', 'markantwi85@gmail.com', NULL, '', '', '2024-07-12 07:31:06'),
(6, 'Antwi Gabriel', '12345', 'ggg@gg', NULL, '', '', '2024-07-12 07:31:06'),
(11, 'West Anderson', '123456', 'smithqsw3dfsr36te@gmail.com', NULL, '', '', '2024-07-12 07:31:06'),
(12, 'Elder Beta', 'beta', 'elder12345', NULL, '', '', '2024-07-12 07:31:06'),
(13, 'Cornelia James White', 'Cornelia', 'Cornelius@Cornelius', NULL, '', '', '2024-07-12 07:31:06'),
(14, 'Elder Gradle', 'elder', 'elder12345', NULL, '', '', '2024-07-12 07:31:06'),
(29, 'Joy Wooyen', 'Joy', 'Joy@Joy', 'uploads/profilePictures/Joy.png', 'F', '025', '2024-07-12 07:31:06'),
(30, 'dall Johnsom', 'dall', 'dall@12345', 'uploads/profilePictures/dall.png', 'M', '024567890', '2024-07-12 07:31:06'),
(31, 'Mark Ivan', 'mar', 'mark@212', 'uploads/profilePictures/Mark Ivan.jpg', 'M', '02000000', '2024-07-12 07:31:06'),
(39, 'Jame White', '1234', 'jay@gmail.com', 'uploads/profilePictures/gfkfc.jpg', 'F', '0257001055', '2024-07-12 07:31:06'),
(40, 'Mensah Iwin Tetteh', 'tetteh', 'mensahiwintetteh@gmail.com', 'uploads/profilePictures/gfkfc.jpg', 'F', '0257001055', '2024-07-12 07:31:06'),
(41, 'Kobbiah Patrick  Adomako', '1234', 'kobbiahpatrickadomako@email', 'uploads/profilePictures/Ivanic.jpg', 'M', '0595199746', '2024-07-12 07:31:06'),
(42, 'Keziah Adoriba', 'hi', 'Adoribaan@gmail.com', 'uploads/profilePictures/hi.jpg', 'M', '0257001055', '2024-07-12 07:31:06'),
(43, 'Hannah Yomley', 'hannah', 'hannah@gmail.com', NULL, 'Fe', '0303454643', '2024-08-16 16:32:23'),
(44, 'ama gina', 'Asf50', 'red@gmail.com', NULL, 'Fe', '0555351200', '2024-09-23 20:40:43'),
(45, 'RANSFORD', 'RANS', 'juniorniklaus65@gmail.com', NULL, 'Ma', '0555351200', '2024-09-24 11:12:30'),
(46, 'Max', 'maxihealth', 'maxi17@gmail.com', NULL, 'Ma', '0524672915', '2024-09-24 11:26:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`mgs_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emergencies`
--
ALTER TABLE `emergencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_records`
--
ALTER TABLE `patient_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `mgs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `emergencies`
--
ALTER TABLE `emergencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `patient_records`
--
ALTER TABLE `patient_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
