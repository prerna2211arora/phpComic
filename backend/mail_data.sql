-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 06, 2022 at 07:24 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rtcamp_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `mail_data`
--

CREATE TABLE `mail_data` (
  `userID` int(100) NOT NULL,
  `userEmail` varchar(100) NOT NULL,
  `userStatus` tinyint(1) NOT NULL DEFAULT '1',
  `userVerified` tinyint(1) NOT NULL DEFAULT '0',
  `verification_code` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mail_data`
--

INSERT INTO `mail_data` (`userID`, `userEmail`, `userStatus`, `userVerified`, `verification_code`) VALUES
(1, 'xyz@gmail.com', 1, 0, 828309);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mail_data`
--
ALTER TABLE `mail_data`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mail_data`
--
ALTER TABLE `mail_data`
  MODIFY `userID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
