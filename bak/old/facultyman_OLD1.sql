-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 29, 2020 at 07:05 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `facultyman`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` int(5) NOT NULL,
  `AdminEmail` varchar(25) NOT NULL,
  `AdminPassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `AdminEmail`, `AdminPassword`) VALUES
(10000, 'admin@gmail.com', '$2y$10$Rgg1IsQmhrMP6urlMKmIK.qqsChj/Ju3YGkCVkN7ts.wZWTUp/2m.');

-- --------------------------------------------------------

--
-- Table structure for table `coursesection`
--

CREATE TABLE `coursesection` (
  `CourseID` varchar(6) CHARACTER SET latin1 NOT NULL,
  `Section` int(2) NOT NULL,
  `ClassOne` varchar(10) NOT NULL,
  `ClassTwo` varchar(10) NOT NULL,
  `ClassTime` varchar(10) NOT NULL,
  `Lab` varchar(10) DEFAULT NULL,
  `LabTime` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `facourses`
--

CREATE TABLE `facourses` (
  `FacultyCourses` int(5) NOT NULL,
  `CourseID` varchar(6) NOT NULL,
  `Section` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `FacultyEmail` varchar(25) NOT NULL,
  `FacultyPassword` varchar(15) NOT NULL,
  `FacultyInitial` varchar(3) NOT NULL,
  `FacultyName` varchar(25) DEFAULT NULL,
  `FacultyCourses` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`FacultyEmail`, `FacultyPassword`, `FacultyInitial`, `FacultyName`, `FacultyCourses`) VALUES
('faculty1@bracu.ac.bd', '$2y$10$rqY9LH1c', '', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `MessageID` int(5) NOT NULL,
  `FacultyEmail` varchar(25) CHARACTER SET latin1 DEFAULT NULL,
  `StudentEmail` varchar(25) DEFAULT NULL,
  `Message` varchar(255) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  `Time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stcourses`
--

CREATE TABLE `stcourses` (
  `StudentCourses` int(5) NOT NULL,
  `CourseID` varchar(6) CHARACTER SET latin1 NOT NULL,
  `Section` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `StudentEmail` varchar(25) NOT NULL,
  `StudentPassword` varchar(15) NOT NULL,
  `StudentName` varchar(25) DEFAULT NULL,
  `StudentCourses` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`StudentEmail`, `StudentPassword`, `StudentName`, `StudentCourses`) VALUES
('student1@gmail.com', '$2y$10$angaq/Xr', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminEmail`),
  ADD KEY `AdminID` (`AdminID`);

--
-- Indexes for table `coursesection`
--
ALTER TABLE `coursesection`
  ADD UNIQUE KEY `CourseID` (`CourseID`,`Section`);

--
-- Indexes for table `facourses`
--
ALTER TABLE `facourses`
  ADD KEY `FacultyCourses` (`FacultyCourses`),
  ADD KEY `CourseID` (`CourseID`,`Section`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`FacultyEmail`),
  ADD UNIQUE KEY `FacultyInitial` (`FacultyInitial`),
  ADD KEY `FacultyCourses` (`FacultyCourses`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`MessageID`),
  ADD KEY `FacultyEmail` (`FacultyEmail`),
  ADD KEY `StudentEmail` (`StudentEmail`);

--
-- Indexes for table `stcourses`
--
ALTER TABLE `stcourses`
  ADD UNIQUE KEY `CourseID` (`CourseID`,`Section`),
  ADD KEY `StudentCourses` (`StudentCourses`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`StudentEmail`),
  ADD KEY `StudentCourses` (`StudentCourses`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `FacultyCourses` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `StudentCourses` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `coursesection`
--
ALTER TABLE `coursesection`
  ADD CONSTRAINT `coursesection_ibfk_1` FOREIGN KEY (`CourseID`,`Section`) REFERENCES `facourses` (`CourseID`, `Section`);

--
-- Constraints for table `facourses`
--
ALTER TABLE `facourses`
  ADD CONSTRAINT `facourses_ibfk_1` FOREIGN KEY (`FacultyCourses`) REFERENCES `faculty` (`FacultyCourses`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`FacultyEmail`) REFERENCES `faculty` (`FacultyEmail`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`StudentEmail`) REFERENCES `student` (`StudentEmail`);

--
-- Constraints for table `stcourses`
--
ALTER TABLE `stcourses`
  ADD CONSTRAINT `stcourses_ibfk_1` FOREIGN KEY (`StudentCourses`) REFERENCES `student` (`StudentCourses`),
  ADD CONSTRAINT `stcourses_ibfk_2` FOREIGN KEY (`CourseID`,`Section`) REFERENCES `coursesection` (`CourseID`, `Section`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
