-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2020 at 04:14 PM
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
(7, '110', 1, 1, 8, 25, 1, 2, 10),
(7, '110', 2, 1, 9, 25, 1, 0, 11),
(7, '111', 1, 2, 8, 30, 1, 1, 12),
(7, '111', 2, 2, 9, 30, 1, 1, 13),
(7, '220', 1, 3, 8, 30, 1, 2, 15),
(8, '110', 3, 1, 8, 30, 1, 0, 16),
(8, '110', 4, 1, 9, 40, 1, 0, 17),
(8, '111', 3, 2, 8, 35, 1, 0, 18),
(8, '111', 4, 2, 9, 45, 1, 0, 19),
(8, '220', 2, 3, 8, 45, 1, 0, 20),
(7, '221', 1, 3, 9, 40, 1, 1, 21),
(7, '230', 1, 3, 11, 45, 1, 3, 22);

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
('faculty1@gmail.com', 'password', 'FAO', 'Faculty One', 7),
('faculty2@gmail.com', 'password', 'FAT', 'Faculty Two', 8),
('faculty3@gmail.com', 'password', 'FAA', NULL, 9),
('faculty4@gmail.com', 'password', 'FAF', NULL, 10),
('faculty5@gmail.com', 'password', 'FAB', NULL, 11);

-- --------------------------------------------------------

--
-- Table structure for table `stcourses`
--

CREATE TABLE `stcourses` (
  `StudentCourses` int(5) NOT NULL,
  `CourseID` varchar(6) CHARACTER SET latin1 NOT NULL,
  `Section` int(2) NOT NULL,
  `FCID` int(5) NOT NULL,
  `AA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stcourses`
--

INSERT INTO `stcourses` (`StudentCourses`, `CourseID`, `Section`, `FCID`, `AA`) VALUES
(9, '110', 1, 10, 7),
(9, '111', 1, 12, 8),
(9, '220', 1, 15, 9),
(9, '221', 1, 21, 10),
(10, '230', 1, 22, 13);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `StudentEmail` varchar(25) NOT NULL,
  `StudentPassword` varchar(15) NOT NULL,
  `StudentName` varchar(25) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Phone` varchar(14) DEFAULT NULL,
  `CourseTaken` int(1) NOT NULL DEFAULT 0,
  `StudentCourses` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`StudentEmail`, `StudentPassword`, `StudentName`, `DOB`, `Phone`, `CourseTaken`, `StudentCourses`) VALUES
('student1@gmail.com', 'password', 'Student One', '1999-12-02', '+8801765432109', 4, 9),
('student2@gmail.com', 'password', 'Student Two', '1999-12-01', '+8801776542738', 1, 10),
('student3@gmail.com', 'password', NULL, NULL, NULL, 0, 11),
('student4@gmail.com', 'password', NULL, NULL, NULL, 0, 12),
('student5@gmail.com', 'password', NULL, NULL, NULL, 0, 13);

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
  ADD UNIQUE KEY `AA` (`AA`),
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
  MODIFY `FCID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `FacultyCourses` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `stcourses`
--
ALTER TABLE `stcourses`
  MODIFY `AA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `StudentCourses` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
