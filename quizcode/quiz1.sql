-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2024 at 01:18 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `quiz1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `staffID` varchar(10) NOT NULL,
  `adminEmail` varchar(25) NOT NULL,
  `adminPassword` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`staffID`, `adminEmail`, `adminPassword`) VALUES
('1001', 'admin1@gmail.com', 12345);

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE IF NOT EXISTS `class` (
  `classCode` varchar(15) NOT NULL,
  `className` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`classCode`, `className`) VALUES
('CD1103A', 'CLASS A'),
('CD1103B', 'CLASS B');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

CREATE TABLE IF NOT EXISTS `lecturer` (
  `staffID` varchar(10) NOT NULL,
  `lecturerName` varchar(70) NOT NULL,
  `lecturerEmail` varchar(50) NOT NULL,
  `lecturerPassword` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`staffID`, `lecturerName`, `lecturerEmail`, `lecturerPassword`) VALUES
('1000', 'MUHAMMAD FAIZAL BIN SAMAD', 'faizal@gmail.com', '1234567'),
('1002', 'HAIKAL BIN RIEZZEL', 'haikalriezzel@gmail.com', 'hk123'),
('1005', 'MUHAMMAD AMIN QAIS', 'qais@gmail.com', '123'),
('1006', 'KHAIRUL AZUAN BIN KHAIRUDIN', 'khai@gmail.com', '12343'),
('12554', 'AMIR FIKRI BIN TARMIZI', 'amir@gmail.com', 'amir321');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
`questionid` int(11) NOT NULL,
  `questionCode` int(11) NOT NULL,
  `questionAnswer` text NOT NULL,
  `A` text NOT NULL,
  `B` text NOT NULL,
  `C` text NOT NULL,
  `D` text NOT NULL,
  `questionMarks` int(11) NOT NULL,
  `subjectCode` varchar(6) NOT NULL,
  `questionStatement` text NOT NULL,
  `questionTopic` varchar(70) NOT NULL,
  `classCode` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`questionid`, `questionCode`, `questionAnswer`, `A`, `B`, `C`, `D`, `questionMarks`, `subjectCode`, `questionStatement`, `questionTopic`, `classCode`) VALUES
(19, 1, 'B', 'communication', 'banking', 'military', 'nformation sharing', 10, 'CSC264', 'The early invention of the computer network was for the purpose of the following,EXCEPT _____________', 'REVISION', 'CD1103A'),
(20, 2, 'D', '.org', '.net', '.my', '.gov', 10, 'CSC264', 'What is the domain suffix that represent it is a government website?', 'REVISION', 'CD1103A'),
(21, 3, 'C', 'An HTML Tag is case sensitive and an HTML element is not case sensitiv', 'An HTML Tag is always paired and an HTML element is an "empty" tag', 'An HTML Tag defines content and an HTML Element includes the opening a', 'An HTML Tag defines content and an HTML Element gives additional meani', 10, 'CSC264', 'What is the difference between an HTML Tag and an HTML element?', 'REVISION', 'CD1103A'),
(22, 4, 'D', '<bold> and <emphasise>', ')<em> and <bold>', '<strong> and <bold> ', '<em> and <strong>', 10, 'CSC264', 'Identify the correct answers to emphasize words by bolding the characters using HTML in a browser.', 'REVISION', 'CD1103A'),
(23, 5, 'D', 'p {color: blue;}', 'body {text-align: left;color: blue;} ', 'p {text-align: center;color: blue;}', 'body {text-align: center;color: blue;}', 10, 'CSC264', 'Select the rule set to make all the text in your web page blue and centered.', 'REVISION', 'CD1103A'),
(45, 1, 'A', 'Protocol', 'Devices', 'Message', 'Medium', 10, 'ITT300', 'Which component is essential in Data Communications?', 'REVISION', 'CD1103B'),
(46, 2, 'B', 'protocol', 'medium', 'signal', 'all of the above', 10, 'ITT300', 'The_________ is the physical path over which a message travel', 'REVISION', 'CD1103B'),
(47, 3, 'B', 'Protocol', 'Reliability', 'Devices', 'Performance', 10, 'ITT300', 'Which criteria is essential for the successful network in data communication?', 'REVISION', 'CD1103B'),
(48, 4, 'C', 'HTTP', 'FTP', 'SMTP', 'TCP', 10, 'ITT300', 'What protocol is commonly used for sending emails?', 'REVISION', 'CD1103B'),
(49, 5, 'C', 'Router', 'Modem', 'Switch', 'Hub', 10, 'ITT300', 'What device is typically used to connect multiple computers in a local area network (LAN)?', 'REVISION', 'CD1103B'),
(50, 1, 'A', 'Protocol', 'Devices', 'Message', 'Medium', 10, 'ITT300', 'Which component is essential in Data Communications?', 'REVISION', 'CD1103A'),
(51, 2, 'B', 'protocol', 'medium', 'signal', 'all of the above', 10, 'ITT300', 'The_________ is the physical path over which a message travel', 'REVISION', 'CD1103A'),
(52, 3, 'B', 'Protocol', 'Reliability', 'Devices', 'Performance', 10, 'ITT300', 'Which criteria is essential for the successful network in data communication?', 'REVISION', 'CD1103A'),
(53, 4, 'C', 'HTTP', 'FTP', 'SMTP', 'TCP', 10, 'ITT300', 'What protocol is commonly used for sending emails?', 'REVISION', 'CD1103A'),
(54, 5, 'C', 'Router', 'Modem', 'Switch', 'Hub', 10, 'ITT300', 'What device is typically used to connect multiple computers in a local area network (LAN)?', 'REVISION', 'CD1103A'),
(69, 1, 'B', 'Measured', 'Counted', 'Both', 'None', 10, 'STA116', 'The qualities of discrete data can be:', 'REVISION', 'CD1103B'),
(70, 2, 'A', 'Measured', 'Counted', 'Both', 'None', 10, 'STA116', 'The qualities of continuous data can be:', 'REVISION', 'CD1103B'),
(71, 3, 'A', 'Weight of a watermelon  as measured each week', 'How many students attend the class.', 'How many cars a company sells each day.', 'None of these', 10, 'STA116', 'Which of these is NOT discrete data?', 'REVISION', 'CD1103B'),
(72, 4, 'B', 'Discrete', 'Continuous', 'Both', 'None', 10, 'STA116', 'Daily rainfall is an example of what sort of data:', 'REVISION', 'CD1103B'),
(73, 5, 'B', 'Discrete', 'Continuous', 'Both', 'None', 10, 'STA116', 'The distance that a cyclist rides each day is what sort of data:', 'REVISION', 'CD1103B'),
(74, 1, 'B', 'Measured', 'Counted', 'Both', 'None', 10, 'STA116', 'The qualities of discrete data can be:', 'REVISION', 'CD1103A'),
(75, 2, 'A', 'Measured', 'Counted', 'Both', 'None', 10, 'STA116', 'The qualities of continuous data can be:', 'REVISION', 'CD1103A'),
(76, 3, 'A', 'Weight of a watermelon  as measured each week', 'How many students attend the class.', 'How many cars a company sells each day.', 'None of these', 10, 'STA116', 'Which of these is NOT discrete data?', 'REVISION', 'CD1103A'),
(77, 4, 'B', 'Discrete', 'Continuous', 'Both', 'None', 10, 'STA116', 'Daily rainfall is an example of what sort of data:', 'REVISION', 'CD1103A'),
(78, 5, 'B', 'Discrete', 'Continuous', 'Both', 'None', 10, 'STA116', 'The distance that a cyclist rides each day is what sort of data:', 'REVISION', 'CD1103A'),
(91, 1, 'B', 'Measured', 'Counted', 'Both', 'None', 10, 'STA116', 'The qualities of discrete data can be:', 'REVISION PAST YEAR', 'CD1103A'),
(92, 2, 'A', 'Measured', 'Counted', 'Both', 'None', 10, 'STA116', 'The qualities of continuous data can be:', 'REVISION PAST YEAR', 'CD1103A'),
(93, 3, 'A', 'Weight of a watermelon  as measured each week', 'How many students attend the class.', 'How many cars a company sells each day.', 'None of these', 10, 'STA116', 'Which of these is NOT discrete data?', 'REVISION PAST YEAR', 'CD1103A'),
(94, 4, 'B', 'Discrete', 'Continuous', 'Both', 'None', 10, 'STA116', 'Daily rainfall is an example of what sort of data:', 'REVISION PAST YEAR', 'CD1103A'),
(95, 5, 'B', 'Discrete', 'Continuous', 'Both', 'None', 10, 'STA116', 'The distance that a cyclist rides each day is what sort of data:', 'REVISION PAST YEAR', 'CD1103A'),
(96, 1, 'Choose the Answer', 'communication ', 'banking ', 'military ', 'information sharing ', 10, 'CSC264', 'The early invention of the computer network was for the purpose of the following,EXCEPT _____________. A.communication ', 'REVISION PAST YEAR', 'CD1103B'),
(97, 2, 'Choose the Answer', ' .org ', '.net ', '.my ', '.gov', 10, 'CSC264', 'What is the domain suffix that represent it is a government website? ', 'REVISION PAST YEAR', 'CD1103B'),
(98, 3, 'Choose the Answer', 'An HTML Tag is case sensitive and an HTML element is not case sensitive. ', 'An HTML Tag is always paired and an HTML element is an ', ')An HTML Tag defines content and an HTML Element includes the opening and closing tags and everything in between. ', 'An HTML Tag defines content and an HTML Element gives additional meaning and content. ', 10, 'CSC264', 'What is the difference between an HTML Tag and an HTML element? ', 'REVISION PAST YEAR', 'CD1103B'),
(99, 4, 'Choose the Answer', ' p {color: blue;} ', 'body {text-align: left;color: blue;} ', 'p {text-align: center;color: blue;} ', 'body {text-align: center;color: blue;}', 10, 'CSC264', 'Select the rule set to make all the text in your web page blue and centered.', 'REVISION PAST YEAR', 'CD1103B'),
(100, 5, 'A', '10, 20, 30, 60, 70, 80', '102030', '10, 20, 30', ' Error', 10, 'CSC264', 'What will be the output of the following JavaScript code? document.writeln([10, 20, 30].concat([60, 70, 80]));', 'REVISION PAST YEAR', 'CD1103B');

-- --------------------------------------------------------

--
-- Table structure for table `quiziz`
--

CREATE TABLE IF NOT EXISTS `quiziz` (
  `studentNumber` varchar(10) NOT NULL,
  `questionid` int(11) NOT NULL,
  `answerChoice` varchar(10) NOT NULL,
  `totalmarks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiziz`
--

INSERT INTO `quiziz` (`studentNumber`, `questionid`, `answerChoice`, `totalmarks`) VALUES
('2022349852', 19, 'B', 10),
('2022349852', 20, 'D', 10),
('2022349852', 21, 'C', 10),
('2022349852', 22, 'D', 10),
('2022349852', 23, 'A', 0),
('2022351269', 19, 'B', 10),
('2022351269', 20, 'A', 0),
('2022351269', 21, 'B', 0),
('2022351269', 22, 'A', 0),
('2022351269', 23, 'A', 0),
('2022515484', 19, 'C', 0),
('2022515484', 20, 'A', 0),
('2022515484', 21, 'C', 10),
('2022515484', 22, 'C', 0),
('2022515484', 23, 'B', 0),
('2022663108', 19, 'C', 0),
('2022663108', 20, 'B', 0),
('2022663108', 21, 'C', 10),
('2022663108', 22, 'C', 0),
('2022663108', 23, 'A', 0),
('2025123456', 19, 'B', 10),
('2025123456', 20, 'A', 0),
('2025123456', 21, 'A', 0),
('2025123456', 22, 'C', 0),
('2025123456', 23, 'C', 0);

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE IF NOT EXISTS `registration` (
  `studentNumber` varchar(10) NOT NULL,
  `subjectCode` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`studentNumber`, `subjectCode`) VALUES
('2022159753', 'CSC264'),
('2022349852', 'CSC264'),
('2022351269', 'CSC264'),
('2022515484', 'CSC264'),
('2022663108', 'CSC264'),
('2022789456', 'CSC264'),
('202411111', 'CSC264'),
('2024123456', 'CSC264'),
('2025123456', 'CSC264'),
('2022159753', 'ITT300'),
('2022349852', 'ITT300'),
('2022351269', 'ITT300'),
('2022515484', 'ITT300'),
('2022663108', 'ITT300'),
('2022789456', 'ITT300'),
('202411111', 'ITT300'),
('2024123456', 'ITT300'),
('2025123456', 'ITT300'),
('2022159753', 'STA116'),
('2022349852', 'STA116'),
('2022351269', 'STA116'),
('2022515484', 'STA116'),
('2022663108', 'STA116'),
('2022789456', 'STA116'),
('202411111', 'STA116'),
('2024123456', 'STA116'),
('2025123456', 'STA116');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `staffID` varchar(10) NOT NULL,
  `staffType` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffID`, `staffType`) VALUES
('1000', 'L'),
('1001', 'A'),
('1002', 'L'),
('1005', 'L'),
('1006', 'L'),
('12554', 'L');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `studentNumber` varchar(10) NOT NULL,
  `studentName` varchar(70) NOT NULL,
  `studentEmail` varchar(30) NOT NULL,
  `studentPassword` varchar(20) NOT NULL,
  `classCode` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentNumber`, `studentName`, `studentEmail`, `studentPassword`, `classCode`) VALUES
('2022159753', 'NUR HAMIDAH BINTI AHMAD', 'hamidaaa@gmail.com', 'mida321', 'CD1103B'),
('2022349852', 'KHAIRI JALAL BIN KHAIRIL', 'khai@gmail.com', '123', 'CD1103A'),
('2022351269', 'AMMAR AMSYAR BIN SAIFUL WAHAB', 'ammaaarr@gmail.com', 'amr321', 'CD1103A'),
('2022456132', 'MUHAMMAD HARIS BIN KAMAL', 'kamalharis@gmail.com', 'haris1503', 'CD1103B'),
('2022515484', 'ZAHIRAH ALISYA BINTI ABDUL AHMAD', 'zahiraaa@gmail.com', 'zhrh123', 'CD1103A'),
('2022663108', 'MUHAMMAD HAZIM BIN MAHBUB AHMAD', 'muhammadhazim439@gmail.com', '12345678', 'CD1103A'),
('2022789456', 'IRFAN JAMIL BIN WAHAB', 'irjamil@gmail.com', 'irfan123', 'CD1103B'),
('202411111', 'MUHAMMAD ABU BIN SOMAD', 'abu@gmail.com', '1234', 'CD1103B'),
('2024123456', 'WAN MUHAMMAD FIRDAUS BIN WAN ABDUL RAHMAN', 'wan@gmail.com', '12345', 'CD1103B'),
('2025123456', 'MUHAMMAD FIRDAUS BIN OTHMAN', 'firdaus@gmail.com', '12345', 'CD1103A');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `subjectCode` varchar(6) NOT NULL,
  `staffID` varchar(10) NOT NULL,
  `subjectName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subjectCode`, `staffID`, `subjectName`) VALUES
('CSC264', '1005', 'DEVEPLOMENT WEB'),
('ITT300', '12554', 'INTRODUCTION TO DATA COMMUNICATION AND NETWORKING'),
('STA116', '1002', 'INTRODUCTION TO PROBABILITY AND STATISTICS');

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE IF NOT EXISTS `video` (
`videoCode` int(11) NOT NULL,
  `videoName` varchar(70) NOT NULL,
  `videoURL` text NOT NULL,
  `subjectCode` varchar(6) NOT NULL,
  `classCode` varchar(15) NOT NULL,
  `videoType` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`videoCode`, `videoName`, `videoURL`, `subjectCode`, `classCode`, `videoType`) VALUES
(13, 'JavaScript Basic Function', 'https://www.youtube.com/watch?v=6VsGZv5EGbo', 'CSC264', 'CD1103A', 'link'),
(14, 'JavaScript Function', 'uploads/video-664a2886e2e9c1.26432361.mp4', 'CSC264', 'CD1103A', 'file'),
(16, 'HTML', 'https://www.youtube.com/watch?v=Kgh9TVm4X8s', 'CSC264', 'CD1103A', 'link');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`staffID`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
 ADD PRIMARY KEY (`classCode`);

--
-- Indexes for table `lecturer`
--
ALTER TABLE `lecturer`
 ADD PRIMARY KEY (`staffID`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
 ADD PRIMARY KEY (`questionid`), ADD KEY `fk3` (`subjectCode`), ADD KEY `classCode` (`classCode`);

--
-- Indexes for table `quiziz`
--
ALTER TABLE `quiziz`
 ADD PRIMARY KEY (`studentNumber`,`questionid`), ADD KEY `studentNumber` (`studentNumber`), ADD KEY `questionid` (`questionid`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
 ADD PRIMARY KEY (`studentNumber`,`subjectCode`), ADD KEY `composite2` (`subjectCode`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
 ADD PRIMARY KEY (`staffID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
 ADD PRIMARY KEY (`studentNumber`), ADD KEY `fk` (`classCode`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
 ADD PRIMARY KEY (`subjectCode`), ADD KEY `staffID` (`staffID`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
 ADD PRIMARY KEY (`videoCode`), ADD KEY `fk6` (`subjectCode`), ADD KEY `classCode` (`classCode`), ADD KEY `classCode_2` (`classCode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
MODIFY `questionid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
MODIFY `videoCode` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
ADD CONSTRAINT `fk9` FOREIGN KEY (`staffID`) REFERENCES `staff` (`staffID`);

--
-- Constraints for table `lecturer`
--
ALTER TABLE `lecturer`
ADD CONSTRAINT `fk10` FOREIGN KEY (`staffID`) REFERENCES `staff` (`staffID`);

--
-- Constraints for table `question`
--
ALTER TABLE `question`
ADD CONSTRAINT `fk15` FOREIGN KEY (`classCode`) REFERENCES `class` (`classCode`),
ADD CONSTRAINT `fk3` FOREIGN KEY (`subjectCode`) REFERENCES `subject` (`subjectCode`);

--
-- Constraints for table `quiziz`
--
ALTER TABLE `quiziz`
ADD CONSTRAINT `quiziz_ibfk_1` FOREIGN KEY (`studentNumber`) REFERENCES `student` (`studentNumber`),
ADD CONSTRAINT `quiziz_ibfk_2` FOREIGN KEY (`questionid`) REFERENCES `question` (`questionid`);

--
-- Constraints for table `registration`
--
ALTER TABLE `registration`
ADD CONSTRAINT `composite1` FOREIGN KEY (`studentNumber`) REFERENCES `student` (`studentNumber`),
ADD CONSTRAINT `composite2` FOREIGN KEY (`subjectCode`) REFERENCES `subject` (`subjectCode`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
ADD CONSTRAINT `fk` FOREIGN KEY (`classCode`) REFERENCES `class` (`classCode`);

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`staffID`) REFERENCES `staff` (`staffID`);

--
-- Constraints for table `video`
--
ALTER TABLE `video`
ADD CONSTRAINT `video_ibfk_1` FOREIGN KEY (`classCode`) REFERENCES `class` (`classCode`),
ADD CONSTRAINT `video_ibfk_2` FOREIGN KEY (`subjectCode`) REFERENCES `subject` (`subjectCode`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
