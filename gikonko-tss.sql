-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2025 at 03:04 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gikonko_tsss`
--

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `Mark_Id` int(11) NOT NULL,
  `Trainee_Id` int(11) DEFAULT NULL,
  `Module_Id` int(11) DEFAULT NULL,
  `Formative_Assessment` int(11) DEFAULT NULL CHECK (`Formative_Assessment` between 0 and 50),
  `Summative_Assessment` int(11) DEFAULT NULL CHECK (`Summative_Assessment` between 0 and 50),
  `Total_Marks` int(11) GENERATED ALWAYS AS (`Formative_Assessment` + `Summative_Assessment`) STORED CHECK (`Total_Marks` <= 100)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`Mark_Id`, `Trainee_Id`, `Module_Id`, `Formative_Assessment`, `Summative_Assessment`) VALUES
(2, 8, 1, 49, 50),
(3, 8, 1, 45, 50),
(4, 8, 1, 26, 30),
(5, 8, 1, 21, 12),
(6, 8, 1, 21, 12);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `Module_Id` int(11) NOT NULL,
  `Module_Name` varchar(255) NOT NULL,
  `Trade_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`Module_Id`, `Module_Name`, `Trade_Id`) VALUES
(1, 'php programming', 1),
(2, 'autocard', 4),
(3, 'backend', 1),
(4, 'php programming', 1),
(5, 'php programming', 1),
(6, 'management', 6),
(7, 'backend', 6),
(8, 'management', 6),
(9, 'graphic design', 1);

-- --------------------------------------------------------

--
-- Table structure for table `trades`
--

CREATE TABLE `trades` (
  `Trade_Id` int(11) NOT NULL,
  `Trade_Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trades`
--

INSERT INTO `trades` (`Trade_Id`, `Trade_Name`) VALUES
(6, 'Accounting'),
(4, 'Building Construction'),
(5, 'Electrical Technology'),
(1, 'Multimedia');

-- --------------------------------------------------------

--
-- Table structure for table `trainees`
--

CREATE TABLE `trainees` (
  `Trainee_Id` int(11) NOT NULL,
  `FirstNames` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `Gender` enum('Male','Female','Other') NOT NULL,
  `Trade_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainees`
--

INSERT INTO `trainees` (`Trainee_Id`, `FirstNames`, `LastName`, `Gender`, `Trade_Id`) VALUES
(8, 'ndayisaba', 'luis', 'Male', 5),
(9, 'bamenya', 'damour', 'Male', 6),
(12, 'ganza aime', 'patience', 'Male', 6),
(14, 'mutyweyezu', 'aime blandon', 'Male', 5),
(16, 'mutyweyezu', 'aime blandon', 'Male', 5),
(17, 'ganza holly', 'orga', 'Male', 6),
(18, 'john', 'aime blandon', 'Male', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `User_Id` int(11) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` enum('DOS','Admin','Teacher') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_Id`, `Username`, `Password`, `Role`) VALUES
(1, 'damour', '$2y$10$JekRngWHzwlMJ9X2z1uudOY/BAfRsQ9x61pNmuVQmU6O6.O0almQK', 'Admin'),
(2, 'kampire', '$2y$10$vLR45DkIq7JyOIROt7xv7OcskcQs23wgZQp0dlAyhOTD/YWiBFyBG', 'DOS'),
(4, 'jean damour', '$2y$10$pbNufNhIlGCO5Ud/rZyWt.EOhQaHSQFmXTg4weiamx2ZO0biMNWOa', 'Admin'),
(13, 'irambona', '$2y$10$LmCPYdlBIgmL.uEu14vg8OpJheVzPH0IZcDyKlhIX.yAhR6Ck4tlC', 'Teacher'),
(15, 'igiraneza', '$2y$10$BkQOF/LPZg6NtnPVxYlX..ZQpOBaS1/uYvFD6O1.W/Oc3LR4in4Qq', ''),
(21, 'braise', '$2y$10$Maczb5T0v1g/wHzDVP4gVOK9aSzm700RY4CqdE5tnRKaCgcNsn2Py', 'DOS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`Mark_Id`),
  ADD KEY `Trainee_Id` (`Trainee_Id`),
  ADD KEY `Module_Id` (`Module_Id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`Module_Id`),
  ADD KEY `Trade_Id` (`Trade_Id`);

--
-- Indexes for table `trades`
--
ALTER TABLE `trades`
  ADD PRIMARY KEY (`Trade_Id`),
  ADD UNIQUE KEY `Trade_Name` (`Trade_Name`);

--
-- Indexes for table `trainees`
--
ALTER TABLE `trainees`
  ADD PRIMARY KEY (`Trainee_Id`),
  ADD KEY `Trade_Id` (`Trade_Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_Id`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `Mark_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `Module_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `trades`
--
ALTER TABLE `trades`
  MODIFY `Trade_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `trainees`
--
ALTER TABLE `trainees`
  MODIFY `Trainee_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `marks`
--
ALTER TABLE `marks`
  ADD CONSTRAINT `marks_ibfk_1` FOREIGN KEY (`Trainee_Id`) REFERENCES `trainees` (`Trainee_Id`),
  ADD CONSTRAINT `marks_ibfk_2` FOREIGN KEY (`Module_Id`) REFERENCES `modules` (`Module_Id`);

--
-- Constraints for table `modules`
--
ALTER TABLE `modules`
  ADD CONSTRAINT `modules_ibfk_1` FOREIGN KEY (`Trade_Id`) REFERENCES `trades` (`Trade_Id`);

--
-- Constraints for table `trainees`
--
ALTER TABLE `trainees`
  ADD CONSTRAINT `trainees_ibfk_1` FOREIGN KEY (`Trade_Id`) REFERENCES `trades` (`Trade_Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
