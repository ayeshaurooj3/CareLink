-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2024 at 11:46 AM
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
-- Database: `hms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `updationDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `updationDate`) VALUES
(1, 'admin', 'admin1', '04-03-2024 11:42:05 AM');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `doctorSpecialization` varchar(255) DEFAULT NULL,
  `doctorId` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `consultancyFees` int(11) DEFAULT NULL,
  `appointmentDate` varchar(255) DEFAULT NULL,
  `appointmentTime` varchar(255) DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `userStatus` int(11) DEFAULT NULL,
  `doctorStatus` int(11) DEFAULT NULL,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `doctorSpecialization`, `doctorId`, `userId`, `consultancyFees`, `appointmentDate`, `appointmentTime`, `postingDate`, `userStatus`, `doctorStatus`, `updationDate`) VALUES
(1, 'ENT', 1, 1, 500, '2024-05-30', '9:15 AM', '2024-05-15 03:42:11', 1, 0, '2024-12-02 06:07:30'),
(2, 'Endocrinologists', 2, 2, 800, '2024-05-31', '2:45 PM', '2024-05-16 09:08:54', 1, 1, NULL),
(3, 'ENT', 1, 3, 500, '2024-11-17', '3:30 PM', '2024-11-19 10:22:05', 0, 1, '2024-11-24 07:23:16'),
(4, 'Orthopedics', 0, 3, 0, '2024-11-29', '12:30 PM', '2024-11-24 07:16:30', 1, 1, NULL),
(5, 'Orthopedics', 0, 3, 0, '2024-11-29', '12:30 PM', '2024-11-24 07:23:04', 1, 1, NULL),
(6, 'Obstetrics and Gynecology', 7, 3, 0, '2024-11-25', '12:30 PM', '2024-11-24 07:25:46', 0, 1, '2024-12-02 04:03:24'),
(7, 'Internal Medicine', 6, 3, 1500, '2024-11-26', '3:30 PM', '2024-11-25 10:24:10', 0, 1, '2024-12-02 06:04:52'),
(8, 'Obstetrics and Gynecology', 7, 3, 800, '2024-12-31', '9:15 AM', '2024-12-02 04:03:09', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `specilization` varchar(255) DEFAULT NULL,
  `doctorName` varchar(255) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `docFees` varchar(255) DEFAULT NULL,
  `contactno` bigint(11) DEFAULT NULL,
  `docEmail` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `specilization`, `doctorName`, `address`, `docFees`, `contactno`, `docEmail`, `password`, `creationDate`, `updationDate`) VALUES
(1, 'ENT', 'Dr Ali', 'Service Hospital,Lahore', '500', 142536250, 'ali@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2024-11-01 05:16:52', '2024-12-02 09:24:49'),
(2, 'Endocrinologists', 'Dr Ajlan', 'Adil Hospital,Lahore', '800', 1231231230, 'ajlan@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2024-11-03 02:06:41', '2024-11-03 08:47:28'),
(4, 'Pediatrics', 'Dr Anam', 'CMH Hospital,Lahore', '700', 74561235, 'anam@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2024-11-16 06:12:23', '2024-12-02 10:40:24'),
(5, 'Orthopedics', 'Dr Ijaz', 'Doctor Hospital,Lahore', '1200', 95214563210, 'ijaz@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2024-11-17 09:13:11', '2024-11-18 06:41:20'),
(6, 'Internal Medicine', 'Dr Imtiaz', 'General Hospital, Lahore', '1500', 8563214751, 'imtiaz@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2024-11-19 09:14:11', '2024-12-02 08:53:10'),
(7, 'Obstetrics and Gynecology', 'Dr Ahad', 'Raiwind, Lahore', '800', 745621330, 'ahad@tt.com', 'f925916e2754e5e03f75dd58a5733251', '2024-11-22 09:15:18', '2024-11-23 06:41:55');

-- --------------------------------------------------------

--
-- Table structure for table `doctorslog`
--

CREATE TABLE `doctorslog` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctorslog`
--

INSERT INTO `doctorslog` (`id`, `uid`, `username`, `userip`, `loginTime`, `logout`, `status`) VALUES
(1, 1, 'ijaz@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 05:19:33', NULL, 1),
(2, 2, 'ajlan@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-09 09:01:03', '16-05-2024 02:37:32 PM', 1),
(3, 3, 'anam@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-12 07:31:16', NULL, 0),
(4, 4, 'anam@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-19 07:31:42', NULL, 1),
(5, NULL, 'anam@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-14 04:01:57', NULL, 0),
(6, 4, 'anam@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-15 04:02:11', '15-11-2024 09:32:29 AM', 1),
(7, 4, 'anam@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-15 05:33:36', NULL, 1),
(8, NULL, 'anam@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-15 06:00:07', NULL, 0),
(9, 4, 'anam@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-17 06:06:33', '17-11-2024 11:36:52 AM', 1),
(10, 1, 'ali@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-18 06:07:15', NULL, 1),
(11, NULL, 'ahad@gmaillcom', 0x3a3a3100000000000000000000000000, '2024-11-19 08:02:36', NULL, 0),
(12, NULL, 'ahad@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-20 08:02:58', NULL, 0),
(13, NULL, 'ahad@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-21 08:03:19', NULL, 0),
(14, 4, 'anam@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-21 08:49:36', '02-12-2024 02:52:17 PM', 1),
(15, NULL, 'ahad@gmail.com', 0x3a3a3100000000000000000000000000, '2024-12-02 09:22:30', NULL, 0),
(16, NULL, 'ahad@gmail.com', 0x3a3a3100000000000000000000000000, '2024-12-02 09:22:46', NULL, 0),
(17, NULL, 'ahad@gmail.com', 0x3a3a3100000000000000000000000000, '2024-12-02 09:23:03', NULL, 0),
(18, NULL, 'ahad@gmail.com', 0x3a3a3100000000000000000000000000, '2024-12-02 09:23:15', NULL, 0),
(19, NULL, 'ahad@gmail.com', 0x3a3a3100000000000000000000000000, '2024-12-02 09:23:46', NULL, 0),
(20, NULL, 'ali@gmail.com', 0x3a3a3100000000000000000000000000, '2024-12-02 09:24:33', NULL, 0),
(21, 1, 'ali@gmail.com', 0x3a3a3100000000000000000000000000, '2024-12-02 09:26:04', NULL, 1),
(22, 4, 'anam@gmail.com', 0x3a3a3100000000000000000000000000, '2024-12-02 10:33:13', '02-12-2024 04:08:15 PM', 1),
(23, 4, 'anam@gmail.com', 0x3a3a3100000000000000000000000000, '2024-12-02 10:39:03', '02-12-2024 04:11:29 PM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctorspecilization`
--

CREATE TABLE `doctorspecilization` (
  `id` int(11) NOT NULL,
  `specilization` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctorspecilization`
--

INSERT INTO `doctorspecilization` (`id`, `specilization`, `creationDate`, `updationDate`) VALUES
(1, 'Orthopedics', '2024-04-09 18:09:46', '2024-05-14 09:26:47'),
(2, 'Internal Medicine', '2024-04-09 18:09:46', '2024-05-14 09:26:56'),
(3, 'Obstetrics and Gynecology', '2024-04-09 18:09:46', '2024-05-14 09:26:56'),
(4, 'Dermatology', '2024-04-09 18:09:46', '2024-05-14 09:26:56'),
(5, 'Pediatrics', '2024-04-09 18:09:46', '2024-05-14 09:26:56'),
(6, 'Radiology', '2024-04-09 18:09:46', '2024-05-14 09:26:56'),
(7, 'General Surgery', '2024-04-09 18:09:46', '2024-05-14 09:26:56'),
(8, 'Ophthalmology', '2024-04-09 18:09:46', '2024-05-14 09:26:56'),
(9, 'Anesthesia', '2024-04-09 18:09:46', '2024-05-14 09:26:56'),
(10, 'Pathology', '2024-04-09 18:09:46', '2024-05-14 09:26:56'),
(11, 'ENT', '2024-04-09 18:09:46', '2024-05-14 09:26:56'),
(13, 'Dermatologists', '2024-04-09 18:09:46', '2024-05-14 09:26:56'),
(14, 'Endocrinologists', '2024-04-09 18:09:46', '2024-05-14 09:26:56'),
(15, 'Neurologists', '2024-04-09 18:09:46', '2024-05-14 09:26:56');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontactus`
--

CREATE TABLE `tblcontactus` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contactno` bigint(12) DEFAULT NULL,
  `message` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `AdminRemark` mediumtext DEFAULT NULL,
  `LastupdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `IsRead` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcontactus`
--

INSERT INTO `tblcontactus` (`id`, `fullname`, `email`, `contactno`, `message`, `PostingDate`, `AdminRemark`, `LastupdationDate`, `IsRead`) VALUES
(1, 'Ayesha', 'ayesha@test.com', 9223372036854775807, 'This is for testing purposes.   This is for testing purposes.This is for testing purposes.This is for testing purposes.This is for testing purposes.This is for testing purposes.This is for testing purposes.This is for testing purposes.This is for testing purposes.', '2024-04-20 16:52:03', NULL, '2024-11-19 06:35:19', NULL),
(2, 'Urooj', 'urooj@gmail.com', 1111122233, 'This is for testing', '2024-04-23 13:13:41', 'Contact the patient', '2024-11-19 06:35:39', 1),
(3, 'Ayesha Urooj', 'aminaansar707@gmail.com', 3337626116, '1122', '2024-11-27 09:50:32', NULL, NULL, NULL),
(4, 'Ayesha Urooj', 'ayeshaansar707@gmail.com', 3337626116, 'hello', '2024-12-02 06:00:43', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblmedicalhistory`
--

CREATE TABLE `tblmedicalhistory` (
  `ID` int(10) NOT NULL,
  `PatientID` int(10) DEFAULT NULL,
  `BloodPressure` varchar(200) DEFAULT NULL,
  `BloodSugar` varchar(200) NOT NULL,
  `Weight` varchar(100) DEFAULT NULL,
  `Temperature` varchar(200) DEFAULT NULL,
  `MedicalPres` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblmedicalhistory`
--

INSERT INTO `tblmedicalhistory` (`ID`, `PatientID`, `BloodPressure`, `BloodSugar`, `Weight`, `Temperature`, `MedicalPres`, `CreationDate`) VALUES
(1, 3, '80/120', '110', '85', '97', 'Dolo,\r\nLevocit 5mg', '2024-11-25 10:26:04');

-- --------------------------------------------------------

--
-- Table structure for table `tblpatient`
--

CREATE TABLE `tblpatient` (
  `ID` int(10) NOT NULL,
  `Docid` int(10) DEFAULT NULL,
  `PatientName` varchar(200) DEFAULT NULL,
  `PatientContno` bigint(10) DEFAULT NULL,
  `PatientEmail` varchar(200) DEFAULT NULL,
  `PatientGender` varchar(50) DEFAULT NULL,
  `PatientAdd` mediumtext DEFAULT NULL,
  `PatientAge` int(10) DEFAULT NULL,
  `PatientMedhis` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpatient`
--

INSERT INTO `tblpatient` (`ID`, `Docid`, `PatientName`, `PatientContno`, `PatientEmail`, `PatientGender`, `PatientAdd`, `PatientAge`, `PatientMedhis`, `CreationDate`, `UpdationDate`) VALUES
(1, 1, 'Ahmad', 452463210, 'ahmad@gmail.com', 'male', 'NA', 32, 'Fever, Cold', '2024-05-16 05:23:35', '2024-11-19 09:45:16'),
(2, 1, 'Sami', 4545454545, 'sami@gmail.com', 'male', 'NA', 45, 'Fever', '2024-05-16 09:01:26', '2024-11-19 09:45:43');

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `uid`, `username`, `userip`, `loginTime`, `logout`, `status`) VALUES
(1, 1, 'waleed@test.com', 0x3a3a3100000000000000000000000000, '2024-05-15 03:41:48', NULL, 1),
(2, 2, 'abdullah@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-16 09:08:06', '16-05-2024 02:41:06 PM', 1),
(3, NULL, 'ahmad@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-19 10:08:28', NULL, 0),
(4, NULL, 'ahmad@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-19 10:08:46', NULL, 0),
(5, NULL, 'ahmad@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-19 10:09:05', NULL, 0),
(6, NULL, 'ahmad@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-19 10:14:13', NULL, 0),
(7, 3, 'ayesha@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-19 10:19:18', '19-11-2024 03:52:19 PM', 1),
(8, NULL, 'ahmad@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-24 07:09:46', NULL, 0),
(9, NULL, 'ahmad@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-24 07:10:04', NULL, 0),
(10, NULL, 'ayesha@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-24 07:15:43', NULL, 0),
(11, 3, 'ayesha@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-24 07:15:57', '24-11-2024 12:58:33 PM', 1),
(12, NULL, 'uroojayesha3@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-25 10:19:20', NULL, 0),
(13, 3, 'ayesha@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-25 10:19:37', '26-11-2024 10:30:11 AM', 1),
(14, NULL, 'ayesha1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-27 09:41:09', NULL, 0),
(15, NULL, 'ayesha1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-27 09:41:26', NULL, 0),
(16, 3, 'ayesha@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-27 09:41:44', '27-11-2024 03:12:46 PM', 1),
(17, 3, 'ayesha@gmail.com', 0x3a3a3100000000000000000000000000, '2024-12-02 04:02:47', '02-12-2024 09:33:30 AM', 1),
(18, NULL, 'ayesha@gmail.com', 0x3a3a3100000000000000000000000000, '2024-12-02 05:32:58', NULL, 0),
(19, NULL, 'ayesha@gmail.com', 0x3a3a3100000000000000000000000000, '2024-12-02 05:33:16', NULL, 0),
(20, 3, 'ayesha@gmail.com', 0x3a3a3100000000000000000000000000, '2024-12-02 06:04:23', NULL, 1),
(21, 3, 'ayesha@gmail.com', 0x3a3a3100000000000000000000000000, '2024-12-02 08:51:21', '02-12-2024 02:30:24 PM', 1),
(22, NULL, 'ahmad@gmail.com', 0x3a3a3100000000000000000000000000, '2024-12-02 09:00:41', NULL, 0),
(23, NULL, 'ahmad@gmail.com', 0x3a3a3100000000000000000000000000, '2024-12-02 09:00:59', NULL, 0),
(24, NULL, 'ahmad@gmail.com', 0x3a3a3100000000000000000000000000, '2024-12-02 09:01:14', NULL, 0),
(25, 4, 'sami@gmail.com', 0x3a3a3100000000000000000000000000, '2024-12-02 09:03:24', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullName` varchar(255) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `regDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullName`, `address`, `city`, `gender`, `email`, `password`, `regDate`, `updationDate`) VALUES
(2, 'Ali', 'Raiwind', 'Lahore', 'male', 'ali@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2024-04-21 13:15:32', '2024-11-19 09:48:39'),
(3, 'Ayesha Urooj', '26-B PUEHS TOWN 2, RAIWIND ROAD ,Lahore', 'Lahore', 'female', 'ayesha@gmail.com', '51389378cf66544064453bcc39294af9', '2024-11-19 10:17:56', NULL),
(4, 'Sami Sam', 'Gold Campus', 'Lahore', 'male', 'sami@gmail.com', 'b39024efbc6de61976f585c8421c6bba', '2024-12-02 09:02:24', NULL),
(5, 'Sami Sam', 'Gold Campus', 'Lahore', 'male', 'sami@gmail.com', 'b39024efbc6de61976f585c8421c6bba', '2024-12-02 09:20:09', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctorslog`
--
ALTER TABLE `doctorslog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctorspecilization`
--
ALTER TABLE `doctorspecilization`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcontactus`
--
ALTER TABLE `tblcontactus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblmedicalhistory`
--
ALTER TABLE `tblmedicalhistory`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblpatient`
--
ALTER TABLE `tblpatient`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `doctorslog`
--
ALTER TABLE `doctorslog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `doctorspecilization`
--
ALTER TABLE `doctorspecilization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tblcontactus`
--
ALTER TABLE `tblcontactus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblmedicalhistory`
--
ALTER TABLE `tblmedicalhistory`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblpatient`
--
ALTER TABLE `tblpatient`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
