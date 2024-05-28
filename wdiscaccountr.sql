-- phpMyAdmin SQL Dump
-- version 5.0.4deb2+deb11u1
-- https://www.phpmyadmin.net/
--
-- Host: 103.247.8.177:3306
-- Generation Time: Jul 18, 2022 at 09:00 PM
-- Server version: 10.5.15-MariaDB-0+deb11u1
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mimj5729_matahari`
--

-- --------------------------------------------------------

--
-- Table structure for table `wdiscaccountr`
--

CREATE TABLE `wdiscaccountr` (
  `id` int(11) NOT NULL,
  `s_code` varchar(40) NOT NULL,
  `r_date` date NOT NULL,
  `r_desc` text NOT NULL,
  `r_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wdiscaccountr`
--

INSERT INTO `wdiscaccountr` (`id`, `s_code`, `r_date`, `r_desc`, `r_amount`) VALUES
(2, 'MTHR2022070515453', '2022-07-11', 'TestLAgi', 100000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wdiscaccountr`
--
ALTER TABLE `wdiscaccountr`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wdiscaccountr`
--
ALTER TABLE `wdiscaccountr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
