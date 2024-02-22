-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 30, 2019 at 03:16 PM
-- Server version: 10.1.37-MariaDB-0+deb9u1
-- PHP Version: 7.0.33-0+deb9u3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `utama`
--

-- --------------------------------------------------------

--
-- Table structure for table `wselltail`
--

CREATE TABLE `wselltail` (
  `s_code` varchar(30) NOT NULL,
  `i_code` varchar(50) NOT NULL,
  `i_name` varchar(50) NOT NULL,
  `i_qty` float NOT NULL,
  `i_sell` float NOT NULL,
  `i_disc1` float NOT NULL DEFAULT '0',
  `i_disc2` float NOT NULL DEFAULT '0',
  `i_disc3` float NOT NULL DEFAULT '0',
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wselltail`
--

INSERT INTO `wselltail` (`s_code`, `i_code`, `i_name`, `i_qty`, `i_sell`, `i_disc1`, `i_disc2`, `i_disc3`, `id`) VALUES
('UTM2019033089348', '103CA0001TS38', 'CARDINAL FBSB100196B ABU 38', 1, 0, 0, 0, 0, 85),
('UTM2019033078838', '103CA0001TS38', 'CARDINAL FBSB100196B ABU 38', 1, 0, 0, 0, 0, 86),
('UTM2019033020686', '103CA0001TS38', 'CARDINAL FBSB100196B ABU 38', 1, 0, 0, 0, 0, 87),
('UTM2019033085239', '103CA0001TS37', 'CARDINAL FBSB100196B ABU 37', 1, 285000, 0, 0, 0, 88);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wselltail`
--
ALTER TABLE `wselltail`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wselltail`
--
ALTER TABLE `wselltail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
