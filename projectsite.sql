-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2024 at 04:16 PM
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
-- Database: `projectsite`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(10) UNSIGNED NOT NULL,
  `authorID` int(10) UNSIGNED NOT NULL,
  `postID` int(10) UNSIGNED NOT NULL,
  `body` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `authorID`, `postID`, `body`) VALUES
(1, 1, 4, 'This is good post'),
(9, 10, 4, 'Stop spamming'),
(3, 1, 4, 'better comment'),
(4, 1, 4, 'better comment'),
(5, 1, 4, 'better comment'),
(6, 1, 4, 'psotp'),
(7, 1, 4, 'psotp'),
(8, 1, 4, 'postpso'),
(10, 10, 5, 'works pretty well'),
(11, 1, 6, 'though I have to say good bye'),
(12, 1, 9, 'works fine'),
(13, 10, 9, 'looks good to me');

-- --------------------------------------------------------

--
-- Table structure for table `invite`
--

CREATE TABLE `invite` (
  `id` int(10) UNSIGNED NOT NULL,
  `authorID` int(10) UNSIGNED NOT NULL,
  `groupID` int(10) UNSIGNED NOT NULL,
  `body` varchar(255) DEFAULT NULL,
  `receivedID` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invite`
--

INSERT INTO `invite` (`id`, `authorID`, `groupID`, `body`, `receivedID`) VALUES
(17, 8, 15, 'You are invited', 1);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(10) UNSIGNED NOT NULL,
  `authorID` int(10) UNSIGNED NOT NULL,
  `postID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(10) UNSIGNED NOT NULL,
  `opener` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `isPublic` tinyint(1) NOT NULL DEFAULT 0,
  `isClosed` tinyint(1) NOT NULL DEFAULT 0,
  `dueDate` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `opener`, `name`, `isPublic`, `isClosed`, `dueDate`) VALUES
(1, 5, 'testProject', 0, 0, NULL),
(2, 1, 'testProject1', 0, 0, NULL),
(3, 1, 'testProject2', 0, 0, NULL),
(4, 1, 'test3', 1, 1, NULL),
(11, 1, 'PleaseWhy', 1, 0, '2024-05-30'),
(12, 10, 'testestest', 1, 0, '2024-05-31'),
(13, 1, 'Arranged Party', 0, 0, NULL),
(14, 1, 'Boxy Box', 0, 0, NULL),
(15, 8, 'blah', 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `projectmembers`
--

CREATE TABLE `projectmembers` (
  `id` int(10) UNSIGNED NOT NULL,
  `groupID` int(10) UNSIGNED NOT NULL,
  `memberID` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projectmembers`
--

INSERT INTO `projectmembers` (`id`, `groupID`, `memberID`) VALUES
(1, 2, 1),
(34, 11, 11),
(3, 4, 1),
(4, 1, 5),
(6, 11, 1),
(7, 12, 10),
(8, 4, 10),
(9, 11, 10),
(30, 3, 10),
(31, 13, 1),
(33, 13, 10),
(36, 2, 10),
(37, 14, 1),
(38, 15, 8);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `username`, `password`, `firstName`, `lastName`, `email`) VALUES
(1, 'test', '1234', 'Bobby', 'Test', 'good@email.com'),
(9, 'test4', '4444', 'Bob', 'Lee', NULL),
(8, 'test3', '3333', 'Bob', 'Lee', NULL),
(5, 'test2', '123', 'Bob', 'Lee', NULL),
(10, 'test5', '5555', 'Bob', 'Top', NULL),
(11, 'test6', '6666', 'Bob', 'Lee', NULL),
(12, 'test7', '7777', 'Bob', 'Lee', NULL),
(13, 'test8', '5555', 'Bob', 'Lee', NULL),
(19, 'testRealEmail', '1234', 'Bob', 'Lee', NULL),
(18, 'testForEmail', '1234', 'Bob', 'Lee', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `threadpost`
--

CREATE TABLE `threadpost` (
  `id` int(10) UNSIGNED NOT NULL,
  `groupID` int(10) UNSIGNED NOT NULL,
  `authorID` int(10) UNSIGNED NOT NULL,
  `body` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `threadpost`
--

INSERT INTO `threadpost` (`id`, `groupID`, `authorID`, `body`) VALUES
(1, 12, 10, 'This is the first post made for test in project testestest'),
(2, 12, 10, 'another test'),
(3, 12, 10, 'one more time'),
(4, 4, 1, 'I think there are better ways to do this man'),
(5, 4, 10, 'Is the post working or not'),
(6, 11, 1, 'remember me'),
(7, 3, 1, 'postyPost'),
(8, 13, 1, 'ba'),
(9, 2, 1, 'testPot'),
(10, 15, 8, 'hahaha');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invite`
--
ALTER TABLE `invite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projectmembers`
--
ALTER TABLE `projectmembers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `threadpost`
--
ALTER TABLE `threadpost`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `invite`
--
ALTER TABLE `invite`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `projectmembers`
--
ALTER TABLE `projectmembers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `threadpost`
--
ALTER TABLE `threadpost`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
