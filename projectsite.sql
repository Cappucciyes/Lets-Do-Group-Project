-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 24-06-01 13:09
-- 서버 버전: 10.4.32-MariaDB
-- PHP 버전: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `projectsite`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `comment`
--

CREATE TABLE `comment` (
  `id` int(10) UNSIGNED NOT NULL,
  `authorID` int(10) UNSIGNED NOT NULL,
  `postID` int(10) UNSIGNED NOT NULL,
  `body` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `comment`
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
(11, 1, 6, 'though I have to say good bye');

-- --------------------------------------------------------

--
-- 테이블 구조 `invite`
--

CREATE TABLE `invite` (
  `id` int(10) UNSIGNED NOT NULL,
  `authorID` int(10) UNSIGNED NOT NULL,
  `groupID` int(10) UNSIGNED NOT NULL,
  `body` varchar(255) DEFAULT NULL,
  `receivedID` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 테이블 구조 `likes`
--

CREATE TABLE `likes` (
  `id` int(10) UNSIGNED NOT NULL,
  `authorID` int(10) UNSIGNED NOT NULL,
  `postID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 테이블 구조 `project`
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
-- 테이블의 덤프 데이터 `project`
--

INSERT INTO `project` (`id`, `opener`, `name`, `isPublic`, `isClosed`, `dueDate`) VALUES
(1, 5, 'testProject', 0, 0, NULL),
(2, 1, 'testProject1', 0, 1, NULL),
(3, 1, 'testProject2', 0, 0, NULL),
(4, 1, 'test3', 1, 0, NULL),
(11, 1, 'PleaseWhy', 1, 0, '2024-05-30'),
(12, 10, 'testestest', 1, 0, '2024-05-31');

-- --------------------------------------------------------

--
-- 테이블 구조 `projectmembers`
--

CREATE TABLE `projectmembers` (
  `id` int(10) UNSIGNED NOT NULL,
  `groupID` int(10) UNSIGNED NOT NULL,
  `memberID` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `projectmembers`
--

INSERT INTO `projectmembers` (`id`, `groupID`, `memberID`) VALUES
(1, 2, 1),
(2, 3, 1),
(3, 4, 1),
(4, 1, 5),
(6, 11, 1),
(7, 12, 10),
(8, 4, 10),
(9, 11, 10),
(30, 3, 10);

-- --------------------------------------------------------

--
-- 테이블 구조 `student`
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
-- 테이블의 덤프 데이터 `student`
--

INSERT INTO `student` (`id`, `username`, `password`, `firstName`, `lastName`, `email`) VALUES
(1, 'test', '1234', 'Bob', 'Test', 'good@email.com'),
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
-- 테이블 구조 `threadpost`
--

CREATE TABLE `threadpost` (
  `id` int(10) UNSIGNED NOT NULL,
  `groupID` int(10) UNSIGNED NOT NULL,
  `authorID` int(10) UNSIGNED NOT NULL,
  `body` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `threadpost`
--

INSERT INTO `threadpost` (`id`, `groupID`, `authorID`, `body`) VALUES
(1, 12, 10, 'This is the first post made for test in project testestest'),
(2, 12, 10, 'another test'),
(3, 12, 10, 'one more time'),
(4, 4, 1, 'I think there are better ways to do this man'),
(5, 4, 10, 'Is the post working or not'),
(6, 11, 1, 'remember me'),
(7, 3, 1, 'postyPost');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `invite`
--
ALTER TABLE `invite`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `projectmembers`
--
ALTER TABLE `projectmembers`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `threadpost`
--
ALTER TABLE `threadpost`
  ADD PRIMARY KEY (`id`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 테이블의 AUTO_INCREMENT `invite`
--
ALTER TABLE `invite`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 테이블의 AUTO_INCREMENT `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `project`
--
ALTER TABLE `project`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 테이블의 AUTO_INCREMENT `projectmembers`
--
ALTER TABLE `projectmembers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- 테이블의 AUTO_INCREMENT `student`
--
ALTER TABLE `student`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- 테이블의 AUTO_INCREMENT `threadpost`
--
ALTER TABLE `threadpost`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
