-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2020 at 12:24 PM
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
  `AdminName` varchar(25) NOT NULL,
  `AdminID` int(5) NOT NULL,
  `AdminEmail` varchar(25) NOT NULL,
  `AdminPassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminName`, `AdminID`, `AdminEmail`, `AdminPassword`) VALUES
('Yager', 10000, 'admin@gmail.com', 'password');

-- --------------------------------------------------------

--
-- Table structure for table `facourses`
--

CREATE TABLE `facourses` (
  `FacultyCourses` int(5) NOT NULL,
  `CourseID` varchar(6) NOT NULL,
  `Section` int(2) NOT NULL,
  `Day` int(2) NOT NULL,
  `Time` int(2) NOT NULL,
  `Seat` int(2) NOT NULL,
  `ActiveStatus` int(1) NOT NULL,
  `TotalStudents` int(2) NOT NULL DEFAULT 0,
  `FCID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `facourses`
--

INSERT INTO `facourses` (`FacultyCourses`, `CourseID`, `Section`, `Day`, `Time`, `Seat`, `ActiveStatus`, `TotalStudents`, `FCID`) VALUES
(2, '110', 2, 1, 11, 35, 0, 2, 4),
(2, '220', 3, 3, 8, 35, 1, 1, 5),
(2, '260', 3, 2, 8, 30, 1, 1, 7),
(4, '230', 1, 1, 11, 35, 1, 35, 8),
(1, '230', 2, 1, 11, 35, 1, 2, 9);

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
('faculty1@bracu.ac.bd', 'password', 'FAO', NULL, 1),
('faculty2@gmail.com', 'password', 'FAT', 'Faculty Two', 2),
('faculty3@gmail.com', 'password', 'FAA', NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `stcourses`
--

CREATE TABLE `stcourses` (
  `StudentCourses` int(5) NOT NULL,
  `CourseID` varchar(6) CHARACTER SET latin1 NOT NULL,
  `Section` int(2) NOT NULL,
  `FCID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stcourses`
--

INSERT INTO `stcourses` (`StudentCourses`, `CourseID`, `Section`, `FCID`) VALUES
(4, '110', 2, 4),
(3, '230', 2, 9),
(3, '110', 2, 4),
(4, '230', 2, 9),
(4, '220', 3, 5),
(4, '260', 3, 7);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `StudentEmail` varchar(25) NOT NULL,
  `StudentPassword` varchar(15) NOT NULL,
  `StudentName` varchar(25) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Phone` int(11) DEFAULT NULL,
  `CourseTaken` int(1) NOT NULL DEFAULT 0,
  `StudentCourses` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`StudentEmail`, `StudentPassword`, `StudentName`, `DOB`, `Phone`, `CourseTaken`, `StudentCourses`) VALUES
('student1@gmail.com', 'password', NULL, NULL, NULL, 0, 1),
('student2@gmail.com', 'password', 'Student Two', '1998-06-02', 2147483647, 0, 3),
('student3@gmail.com', 'password', NULL, NULL, NULL, 0, 4),
('student4@gmail.com', 'password', NULL, NULL, NULL, 0, 5),
('student5@gmail.com', 'password', NULL, NULL, NULL, 0, 6);

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
-- Indexes for table `facourses`
--
ALTER TABLE `facourses`
  ADD UNIQUE KEY `FCID` (`FCID`),
  ADD KEY `FacultyCourses` (`FacultyCourses`),
  ADD KEY `CourseID` (`CourseID`,`Section`),
  ADD KEY `FacultyCourses_2` (`FacultyCourses`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`FacultyEmail`),
  ADD UNIQUE KEY `FacultyInitial` (`FacultyInitial`),
  ADD KEY `FacultyCourses` (`FacultyCourses`);

--
-- Indexes for table `stcourses`
--
ALTER TABLE `stcourses`
  ADD KEY `StudentCourses` (`StudentCourses`),
  ADD KEY `FCID` (`FCID`);

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
-- AUTO_INCREMENT for table `facourses`
--
ALTER TABLE `facourses`
  MODIFY `FCID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `FacultyCourses` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `StudentCourses` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `facourses`
--
ALTER TABLE `facourses`
  ADD CONSTRAINT `facourses_ibfk_1` FOREIGN KEY (`FacultyCourses`) REFERENCES `faculty` (`FacultyCourses`);

--
-- Constraints for table `stcourses`
--
ALTER TABLE `stcourses`
  ADD CONSTRAINT `stcourses_ibfk_1` FOREIGN KEY (`StudentCourses`) REFERENCES `student` (`StudentCourses`),
  ADD CONSTRAINT `stcourses_ibfk_3` FOREIGN KEY (`FCID`) REFERENCES `facourses` (`FCID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
