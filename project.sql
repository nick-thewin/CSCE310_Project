-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2023 at 02:14 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `App_Num` int(11) NOT NULL,
  `Program_Num` int(11) NOT NULL,
  `UIN` int(11) NOT NULL,
  `Uncom_Cert` varchar(128) NOT NULL,
  `Com_Cert` varchar(128) NOT NULL,
  `Purpose_Statement` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`App_Num`, `Program_Num`, `UIN`, `Uncom_Cert`, `Com_Cert`, `Purpose_Statement`) VALUES
(11, 13, 123456790, 'trigger', 'trigger', 'trigger');

-- --------------------------------------------------------

--
-- Table structure for table `certification`
--

CREATE TABLE `certification` (
  `Cert_ID` int(11) NOT NULL,
  `Level` varchar(128) NOT NULL,
  `Name` varchar(128) NOT NULL,
  `Description` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cert_enrollment`
--

CREATE TABLE `cert_enrollment` (
  `CertE_Num` int(11) NOT NULL,
  `UIN` int(11) NOT NULL,
  `Cert_ID` int(11) NOT NULL,
  `Status` varchar(128) NOT NULL,
  `Training_Status` varchar(128) NOT NULL,
  `Program_Num` int(11) NOT NULL,
  `Semester` varchar(128) NOT NULL,
  `Year` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cert_enrollment`
--

INSERT INTO `cert_enrollment` (`CertE_Num`, `UIN`, `Cert_ID`, `Status`, `Training_Status`, `Program_Num`, `Semester`, `Year`) VALUES
(3, 12341234, 1, 'pass', 'pass', 123, 'spring', '2001'),
(5, 1, 2, '2', '2', 2, '2', '2002'),
(6, 123456790, 1, '1', '1', 1, '1', '2001');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `Class_ID` int(11) NOT NULL,
  `Name` varchar(128) NOT NULL,
  `Description` varchar(128) NOT NULL,
  `Type` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `class_enrollment`
--

CREATE TABLE `class_enrollment` (
  `CE_NUM` int(11) NOT NULL,
  `UIN` int(11) NOT NULL,
  `Class_ID` int(11) NOT NULL,
  `Status` varchar(128) NOT NULL,
  `Semester` varchar(128) NOT NULL,
  `Year` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_enrollment`
--

INSERT INTO `class_enrollment` (`CE_NUM`, `UIN`, `Class_ID`, `Status`, `Semester`, `Year`) VALUES
(10, 11111111, 133, 'd', 'e', '2000'),
(11, 12341234, 123, 'pass', 'spring', '2024'),
(12, 1, 1, '1', '1', '2001'),
(13, 1, 4, '4', '4', '2004'),
(14, 123456790, 1, '1', '1', '2001');

-- --------------------------------------------------------

--
-- Table structure for table `collegestudent`
--

CREATE TABLE `collegestudent` (
  `UIN` int(128) NOT NULL,
  `Gender` varchar(128) DEFAULT NULL,
  `Hispanic/Latino` binary(1) DEFAULT NULL,
  `Race` varchar(128) DEFAULT NULL,
  `U.S._Citizen` binary(1) DEFAULT NULL,
  `First_Generation` binary(1) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `GPA` float DEFAULT NULL,
  `Major` varchar(128) DEFAULT NULL,
  `Minor1` varchar(128) DEFAULT NULL,
  `Minor2` varchar(128) DEFAULT NULL,
  `Expected_Graduation` smallint(128) DEFAULT NULL,
  `School` varchar(128) DEFAULT NULL,
  `Classification` varchar(128) DEFAULT NULL,
  `Phone` int(255) DEFAULT NULL,
  `Student_Type` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `collegestudent`
--

INSERT INTO `collegestudent` (`UIN`, `Gender`, `Hispanic/Latino`, `Race`, `U.S._Citizen`, `First_Generation`, `DOB`, `GPA`, `Major`, `Minor1`, `Minor2`, `Expected_Graduation`, `School`, `Classification`, `Phone`, `Student_Type`) VALUES
(987654322, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(987654325, 'Male', 0x30, 'American', 0x30, 0x31, '2000-02-29', 4, 'Computer Science', NULL, NULL, 2024, 'College of Engineering', 'Senior', 8675309, 'Undergrad'),
(987654334, 'Male', 0x30, 'White', 0x31, 0x30, '2001-05-09', 2.65, 'Construction', 'Business', NULL, 2026, 'Texas A&M', 'Sophomore', 912, 'Graduate');

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `Doc_Num` int(11) NOT NULL,
  `App_Num` int(11) NOT NULL,
  `Link` varchar(128) NOT NULL,
  `Doc_Type` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`Doc_Num`, `App_Num`, `Link`, `Doc_Type`) VALUES
(5, 11, 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf', 'pdf');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `Event_ID` int(11) NOT NULL,
  `UIN` int(11) NOT NULL,
  `Program_Num` int(11) DEFAULT NULL,
  `Start_Date` date DEFAULT NULL,
  `Time` time DEFAULT NULL,
  `Location` varchar(128) DEFAULT NULL,
  `End_Date` date DEFAULT NULL,
  `EndTime` time DEFAULT NULL,
  `Event_Type` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`Event_ID`, `UIN`, `Program_Num`, `Start_Date`, `Time`, `Location`, `End_Date`, `EndTime`, `Event_Type`) VALUES
(2, 1, 4321, '2023-12-12', '01:12:00', 'NotTest', '2023-12-12', '13:12:00', 'NotTesting');

--
-- Triggers `event`
--
DELIMITER $$
CREATE TRIGGER `delete_event` BEFORE DELETE ON `event` FOR EACH ROW DELETE FROM event_tracking
    WHERE Event_ID = OLD.Event_ID
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `event_tracking`
--

CREATE TABLE `event_tracking` (
  `ET_Num` int(11) NOT NULL,
  `Event_ID` int(11) NOT NULL,
  `UIN` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `internship`
--

CREATE TABLE `internship` (
  `Intern_ID` int(11) NOT NULL,
  `Name` varchar(128) NOT NULL,
  `Description` varchar(128) NOT NULL,
  `Is_Gov` binary(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `intern_app`
--

CREATE TABLE `intern_app` (
  `IA_Num` int(11) NOT NULL,
  `UIN` int(11) NOT NULL,
  `Intern_ID` int(11) NOT NULL,
  `Status` varchar(128) NOT NULL,
  `Year` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `intern_app`
--

INSERT INTO `intern_app` (`IA_Num`, `UIN`, `Intern_ID`, `Status`, `Year`) VALUES
(2, 12341234, 1, 'pass', '2024'),
(4, 1, 2, '2', '2002'),
(5, 123456790, 1, '1', '2001');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `Program_Num` int(11) NOT NULL,
  `Name` varchar(128) NOT NULL,
  `Description` varchar(128) NOT NULL,
  `User_Access` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`Program_Num`, `Name`, `Description`, `User_Access`) VALUES
(6, 'Program2', 'This is another test program', 0),
(12, 'view test 2', 'view test 2', 0),
(13, 'view test 3', 'view test 3', 1);

--
-- Triggers `programs`
--
DELIMITER $$
CREATE TRIGGER `delete_application` BEFORE DELETE ON `programs` FOR EACH ROW DELETE FROM applications
    WHERE Program_Num = OLD.Program_Num
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `programview`
-- (See below for the actual view)
--
CREATE TABLE `programview` (
`Program_Num` int(11)
,`Name` varchar(128)
,`Description` varchar(128)
);

-- --------------------------------------------------------

--
-- Table structure for table `track`
--

CREATE TABLE `track` (
  `Program_Num` int(11) NOT NULL,
  `Student_Num` int(11) NOT NULL,
  `Tracking_Num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `track`
--

INSERT INTO `track` (`Program_Num`, `Student_Num`, `Tracking_Num`) VALUES
(4, 4, 2),
(2, 1, 4),
(1, 123456790, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UIN` int(10) NOT NULL,
  `First_Name` varchar(128) NOT NULL,
  `M_Initial` char(1) NOT NULL,
  `Last_Name` varchar(128) NOT NULL,
  `Username` varchar(128) NOT NULL,
  `Passwords` varchar(128) NOT NULL,
  `User_Type` varchar(128) NOT NULL,
  `Email` varchar(128) NOT NULL,
  `Discord_Name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UIN`, `First_Name`, `M_Initial`, `Last_Name`, `Username`, `Passwords`, `User_Type`, `Email`, `Discord_Name`) VALUES
(123456789, 'TES', 'T', 'ING', 'testing123', 'password', 'Admin', 'testing1234@hotmail.com', 'websitetester#1234'),
(123456790, 'Test', 'I', 'Ng', 'anothertester', 'password', 'Student', 'anothertester@outlook.com', 'copytester#1111'),
(987654322, 'Hunter', 'M', 'Pearson', 'hunterpearson36', 'secretpassworddontsteal', 'Student', 'hunterpearson36@gmail.com', 'LeahciMx'),
(987654323, 'Dave', 'L', 'Scy', 'davidlcs', 'p', 'Student', 'davidscy@hotmail.com', 'daveyboi'),
(987654325, 'Joseph', 'F', 'May', 'joef', 'JOEY', 'Student', 'joeyfm@gmail.com', 'joebrr'),
(987654334, 'Jake', 'J', 'Johnson', 'jjjohnson', 'p', 'Student', 'jjj@gmail.com', 'jjjohnson');

--
-- Triggers `user`
--
DELIMITER $$
CREATE TRIGGER `after_user_insert` AFTER INSERT ON `user` FOR EACH ROW BEGIN
    IF NEW.User_Type = 'Student' THEN
        INSERT INTO `collegestudent` (`UIN`, `Gender`, `Hispanic/Latino`, `Race`, `U.S._Citizen`, `First_Generation`, `DOB`, `GPA`, `Major`, `Minor1`, `Minor2`, `Expected_Graduation`, `School`, `Classification`, `Phone`, `Student_Type`)
        VALUES (NEW.UIN, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `delete_collegestudent` BEFORE DELETE ON `user` FOR EACH ROW BEGIN
    DELETE FROM collegestudent WHERE UIN = OLD.UIN;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_college_info`
-- (See below for the actual view)
--
CREATE TABLE `user_college_info` (
`UIN` int(10)
,`First_Name` varchar(128)
,`Middle_Initial` char(1)
,`Last_Name` varchar(128)
,`Username` varchar(128)
,`Password` varchar(128)
,`Email` varchar(128)
,`Discord_Name` varchar(128)
,`Gender` varchar(128)
,`Hispanic_Latino` binary(1)
,`Race` varchar(128)
,`U_S_Citizen` binary(1)
,`First_Generation` binary(1)
,`Date_of_Birth` date
,`GPA` float
,`Major` varchar(128)
,`Minor1` varchar(128)
,`Minor2` varchar(128)
,`Expected_Graduation` smallint(128)
,`School` varchar(128)
,`Classification` varchar(128)
,`Phone` int(255)
,`Student_Type` varchar(128)
);

-- --------------------------------------------------------

--
-- Structure for view `programview`
--
DROP TABLE IF EXISTS `programview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `programview`  AS SELECT `programs`.`Program_Num` AS `Program_Num`, `programs`.`Name` AS `Name`, `programs`.`Description` AS `Description` FROM `programs` WHERE `programs`.`User_Access` = 1 ;

-- --------------------------------------------------------

--
-- Structure for view `user_college_info`
--
DROP TABLE IF EXISTS `user_college_info`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `user_college_info`  AS SELECT `u`.`UIN` AS `UIN`, `u`.`First_Name` AS `First_Name`, `u`.`M_Initial` AS `Middle_Initial`, `u`.`Last_Name` AS `Last_Name`, `u`.`Username` AS `Username`, `u`.`Passwords` AS `Password`, `u`.`Email` AS `Email`, `u`.`Discord_Name` AS `Discord_Name`, `cs`.`Gender` AS `Gender`, `cs`.`Hispanic/Latino` AS `Hispanic_Latino`, `cs`.`Race` AS `Race`, `cs`.`U.S._Citizen` AS `U_S_Citizen`, `cs`.`First_Generation` AS `First_Generation`, `cs`.`DOB` AS `Date_of_Birth`, `cs`.`GPA` AS `GPA`, `cs`.`Major` AS `Major`, `cs`.`Minor1` AS `Minor1`, `cs`.`Minor2` AS `Minor2`, `cs`.`Expected_Graduation` AS `Expected_Graduation`, `cs`.`School` AS `School`, `cs`.`Classification` AS `Classification`, `cs`.`Phone` AS `Phone`, `cs`.`Student_Type` AS `Student_Type` FROM (`user` `u` join `collegestudent` `cs` on(`u`.`UIN` = `cs`.`UIN`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`App_Num`),
  ADD KEY `idx_uin` (`UIN`),
  ADD KEY `idx_program_num` (`Program_Num`);

--
-- Indexes for table `certification`
--
ALTER TABLE `certification`
  ADD PRIMARY KEY (`Cert_ID`);

--
-- Indexes for table `cert_enrollment`
--
ALTER TABLE `cert_enrollment`
  ADD PRIMARY KEY (`CertE_Num`),
  ADD KEY `idx_uin` (`UIN`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`Class_ID`);

--
-- Indexes for table `class_enrollment`
--
ALTER TABLE `class_enrollment`
  ADD PRIMARY KEY (`CE_NUM`),
  ADD KEY `idx_uin` (`UIN`);

--
-- Indexes for table `collegestudent`
--
ALTER TABLE `collegestudent`
  ADD PRIMARY KEY (`UIN`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`Doc_Num`),
  ADD KEY `idx_app_num` (`App_Num`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`Event_ID`),
  ADD KEY `idx_uin` (`UIN`),
  ADD KEY `idx_program_num` (`Program_Num`);

--
-- Indexes for table `event_tracking`
--
ALTER TABLE `event_tracking`
  ADD PRIMARY KEY (`ET_Num`);

--
-- Indexes for table `internship`
--
ALTER TABLE `internship`
  ADD PRIMARY KEY (`Intern_ID`);

--
-- Indexes for table `intern_app`
--
ALTER TABLE `intern_app`
  ADD PRIMARY KEY (`IA_Num`),
  ADD KEY `idx_uin` (`UIN`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`Program_Num`),
  ADD KEY `idx_user_access` (`User_Access`);

--
-- Indexes for table `track`
--
ALTER TABLE `track`
  ADD PRIMARY KEY (`Tracking_Num`),
  ADD KEY `idx_uin` (`Student_Num`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UIN`),
  ADD KEY `user_info_index` (`UIN`,`First_Name`,`M_Initial`,`Last_Name`,`User_Type`,`Email`,`Discord_Name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `App_Num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cert_enrollment`
--
ALTER TABLE `cert_enrollment`
  MODIFY `CertE_Num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `class_enrollment`
--
ALTER TABLE `class_enrollment`
  MODIFY `CE_NUM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `Doc_Num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `Event_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `event_tracking`
--
ALTER TABLE `event_tracking`
  MODIFY `ET_Num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `intern_app`
--
ALTER TABLE `intern_app`
  MODIFY `IA_Num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `Program_Num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `track`
--
ALTER TABLE `track`
  MODIFY `Tracking_Num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UIN` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=987654335;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
