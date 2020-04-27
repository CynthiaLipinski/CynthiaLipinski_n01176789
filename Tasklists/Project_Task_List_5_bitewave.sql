-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 27, 2020 at 01:10 AM
-- Server version: 5.7.24
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bitewave`
--

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`id`, `name`, `description`, `userid`) VALUES
(15, 'playlist', '', 37),
(16, 'Music', 'list', 38);

-- --------------------------------------------------------

--
-- Table structure for table `playlistxsongs`
--

CREATE TABLE `playlistxsongs` (
  `id` int(11) NOT NULL,
  `playlistid` int(11) NOT NULL,
  `songid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `playlistxsongs`
--

INSERT INTO `playlistxsongs` (`id`, `playlistid`, `songid`) VALUES
(20, 15, 6),
(21, 15, 7),
(22, 16, 6),
(23, 16, 7),
(24, 16, 8),
(25, 16, 9);

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `username`, `password`, `email`, `gender`, `country`, `admin`) VALUES
(37, 'user', '$2y$10$VenlQYV6ddwayiQbXUnNSeZ7PFCJbdis7n0rnQ7Yp73w8rR.EBAye', 'l.cynthia@live.com', 'Female', 'Canada', 0),
(38, 'admin', '$2y$10$myzfT.ongaayqCMZRiEZOOGBnRnC/3XeHpHBetnjjUJZHvv5Vsxuy', 'admin@admin.ca', 'Male', 'Canada', 1);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `about` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `name`, `position`, `about`) VALUES
(8, 'Rick', 'Team Leader', 'Like cats'),
(9, 'Aaliyah', 'Developer', 'Loves rock music');

-- --------------------------------------------------------

--
-- Table structure for table `uploaded_audio`
--

CREATE TABLE `uploaded_audio` (
  `id` int(11) NOT NULL,
  `audio_title` varchar(255) NOT NULL,
  `audio_artist` varchar(255) NOT NULL,
  `audio_gener` varchar(255) DEFAULT NULL,
  `audio_year` varchar(255) DEFAULT NULL,
  `audio_langauge` varchar(255) DEFAULT NULL,
  `audio_file_location` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `uploaded_audio`
--

INSERT INTO `uploaded_audio` (`id`, `audio_title`, `audio_artist`, `audio_gener`, `audio_year`, `audio_langauge`, `audio_file_location`, `user_id`) VALUES
(6, 'song1', 'author', NULL, NULL, NULL, NULL, 37),
(7, 'Song2', 'Author', NULL, NULL, NULL, NULL, 37),
(8, 'song3', 'author', NULL, NULL, NULL, NULL, 38),
(9, 'song4', 'author4', NULL, NULL, NULL, NULL, 38);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `playlistxsongs`
--
ALTER TABLE `playlistxsongs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `playlist` (`playlistid`),
  ADD KEY `songid` (`songid`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploaded_audio`
--
ALTER TABLE `uploaded_audio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `playlistxsongs`
--
ALTER TABLE `playlistxsongs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `uploaded_audio`
--
ALTER TABLE `uploaded_audio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `playlist_1` FOREIGN KEY (`userid`) REFERENCES `profiles` (`id`);

--
-- Constraints for table `playlistxsongs`
--
ALTER TABLE `playlistxsongs`
  ADD CONSTRAINT `playlistxsong_1` FOREIGN KEY (`playlistid`) REFERENCES `playlist` (`id`),
  ADD CONSTRAINT `playlistxsong_2` FOREIGN KEY (`songid`) REFERENCES `uploaded_audio` (`id`);

--
-- Constraints for table `uploaded_audio`
--
ALTER TABLE `uploaded_audio`
  ADD CONSTRAINT `audio_1` FOREIGN KEY (`user_id`) REFERENCES `profiles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
