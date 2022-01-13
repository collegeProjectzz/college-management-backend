-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 13, 2022 at 09:19 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `college-management`
--

-- --------------------------------------------------------

--
-- Table structure for table `Course`
--

CREATE TABLE `Course` (
  `cId` int(11) NOT NULL,
  `cName` varchar(55) DEFAULT NULL,
  `credit` int(1) DEFAULT NULL,
  `fId` int(11) DEFAULT NULL,
  `sem` int(1) NOT NULL,
  `dNo` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Course`
--

INSERT INTO `Course` (`cId`, `cName`, `credit`, `fId`, `sem`, `dNo`) VALUES
(1, 'DBMS', 4, 119, 5, 1),
(2, 'IOT', 3, 122, 5, 1),
(3, 'CT', 4, 126, 5, 1),
(4, 'CN', 3, 122, 4, 1),
(5, 'C++', 4, 127, 3, 1),
(6, 'GT', 4, 123, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Department`
--

CREATE TABLE `Department` (
  `dNo` int(2) NOT NULL,
  `dName` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Department`
--

INSERT INTO `Department` (`dNo`, `dName`) VALUES
(1, 'IT'),
(2, 'ETC'),
(3, 'Computer'),
(4, 'ENE'),
(5, 'Mechanical'),
(6, 'Civil');

-- --------------------------------------------------------

--
-- Table structure for table `Exam`
--

CREATE TABLE `Exam` (
  `rollNo` int(5) DEFAULT NULL,
  `cId` int(11) DEFAULT NULL,
  `it1` float DEFAULT NULL,
  `it2` float DEFAULT NULL,
  `it3` float NOT NULL,
  `sem` int(1) NOT NULL,
  `total` float NOT NULL,
  `avg` float NOT NULL,
  `ExamPaperId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Exam`
--

INSERT INTO `Exam` (`rollNo`, `cId`, `it1`, `it2`, `it3`, `sem`, `total`, `avg`, `ExamPaperId`) VALUES
(63, 6, 18, 2, 21, 5, 41, 13.66, 1),
(63, 1, 20, 20, 20, 5, 60, 20, 2),
(63, 2, 22, 22, 20, 5, 64, 21.33, 3),
(63, 3, 25, 25, 25, 5, 75, 25, 4),
(75, 1, 10, 10, 10, 5, 30, 10, 6),
(24, 1, 11, 11, 11, 5, 33, 11, 9);

-- --------------------------------------------------------

--
-- Table structure for table `Faculty`
--

CREATE TABLE `Faculty` (
  `fId` int(11) NOT NULL,
  `fName` varchar(55) DEFAULT NULL,
  `fEmail` varchar(55) DEFAULT NULL,
  `dNo` int(2) DEFAULT NULL,
  `fPassword` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Faculty`
--

INSERT INTO `Faculty` (`fId`, `fName`, `fEmail`, `dNo`, `fPassword`) VALUES
(119, 'Nadine dias', 'nadine@gmail.com', 1, 'nadine22'),
(122, 'Aparna', 'aparna@gmail.com', 1, 'aparna'),
(123, 'Bipin', 'bipin@gmail.com', 1, 'bipin'),
(126, 'amogh', 'amogh@gmail.com', 1, 'amogh'),
(127, 'vaishali', 'vaishali@gmail.com', 1, 'vaishali'),
(129, 'Megha', 'megha@gmail.com', 1, 'megha'),
(130, 'Siya', 'siya@gmail.com', 1, 'siya');

-- --------------------------------------------------------

--
-- Table structure for table `Students`
--

CREATE TABLE `Students` (
  `rollNo` int(5) NOT NULL,
  `name` varchar(55) DEFAULT NULL,
  `email` varchar(55) DEFAULT NULL,
  `phone` int(10) DEFAULT NULL,
  `password` varchar(55) DEFAULT NULL,
  `dNo` int(2) DEFAULT NULL,
  `sem` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Students`
--

INSERT INTO `Students` (`rollNo`, `name`, `email`, `phone`, `password`, `dNo`, `sem`) VALUES
(24, 'seven', 'seven@gmail.com', 7777777, 'password', 1, 1),
(63, 'qweqwe', '1234567', 1234567, '1234567', 1, 5),
(75, 'lol', 'lol@gmail.com', 889999999, 'lol', 2, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Course`
--
ALTER TABLE `Course`
  ADD PRIMARY KEY (`cId`),
  ADD KEY `Course_ibfk_1` (`fId`),
  ADD KEY `dNo` (`dNo`);

--
-- Indexes for table `Department`
--
ALTER TABLE `Department`
  ADD PRIMARY KEY (`dNo`);

--
-- Indexes for table `Exam`
--
ALTER TABLE `Exam`
  ADD PRIMARY KEY (`ExamPaperId`),
  ADD KEY `rollNo` (`rollNo`);

--
-- Indexes for table `Faculty`
--
ALTER TABLE `Faculty`
  ADD PRIMARY KEY (`fId`),
  ADD KEY `dNo` (`dNo`);

--
-- Indexes for table `Students`
--
ALTER TABLE `Students`
  ADD PRIMARY KEY (`rollNo`),
  ADD KEY `Students_ibfk_1` (`dNo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Course`
--
ALTER TABLE `Course`
  MODIFY `cId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Exam`
--
ALTER TABLE `Exam`
  MODIFY `ExamPaperId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Faculty`
--
ALTER TABLE `Faculty`
  MODIFY `fId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `Students`
--
ALTER TABLE `Students`
  MODIFY `rollNo` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Course`
--
ALTER TABLE `Course`
  ADD CONSTRAINT `Course_ibfk_1` FOREIGN KEY (`fId`) REFERENCES `Faculty` (`fId`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `Course_ibfk_2` FOREIGN KEY (`dNo`) REFERENCES `Department` (`dNo`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `Exam`
--
ALTER TABLE `Exam`
  ADD CONSTRAINT `rollNo` FOREIGN KEY (`rollNo`) REFERENCES `Students` (`rollNo`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `Faculty`
--
ALTER TABLE `Faculty`
  ADD CONSTRAINT `Faculty_ibfk_1` FOREIGN KEY (`dNo`) REFERENCES `Department` (`dNo`);

--
-- Constraints for table `Students`
--
ALTER TABLE `Students`
  ADD CONSTRAINT `Students_ibfk_1` FOREIGN KEY (`dNo`) REFERENCES `Department` (`dNo`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
