-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2021 at 06:12 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_entries`
--

-- --------------------------------------------------------

--
-- Table structure for table `contest_entries`
--

CREATE TABLE `contest_entries` (
  `ce_id` int(11) NOT NULL,
  `ce_name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `ce_email` varchar(250) CHARACTER SET utf8 NOT NULL,
  `ce_phone` varchar(50) CHARACTER SET utf8 NOT NULL,
  `ce_size` int(11) NOT NULL DEFAULT 1,
  `ce_color` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT 'blue',
  `ce_s_laces` tinyint(1) NOT NULL DEFAULT 0,
  `ce_m_logo` tinyint(1) NOT NULL DEFAULT 0,
  `ce_l_up` tinyint(1) NOT NULL DEFAULT 0,
  `ce_mp3` tinyint(1) NOT NULL DEFAULT 0,
  `ce_reason` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contest_entries`
--

INSERT INTO `contest_entries` (`ce_id`, `ce_name`, `ce_email`, `ce_phone`, `ce_size`, `ce_color`, `ce_s_laces`, `ce_m_logo`, `ce_l_up`, `ce_mp3`, `ce_reason`) VALUES
(3, 'Alex', 'test@mail.com', '71980234837', 23, 'red', 0, 1, 0, 1, 'djfbsuian dvwna cd dnlv cadj ci ndj nbj siabnls, mnxj.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contest_entries`
--
ALTER TABLE `contest_entries`
  ADD PRIMARY KEY (`ce_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contest_entries`
--
ALTER TABLE `contest_entries`
  MODIFY `ce_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
