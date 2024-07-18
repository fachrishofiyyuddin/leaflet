-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jul 18, 2024 at 05:10 AM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `leaflet`
--

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `coordinates` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `name`, `coordinates`) VALUES
(1, 'Batas Area Kampus Undip', '[{\"lat\": -7.040865, \"lng\": 110.390625}, {\"lat\": -7.056482, \"lng\": 110.417023}, {\"lat\": -7.076736, \"lng\": 110.431099}, {\"lat\": -7.091463, \"lng\": 110.408306}]'),
(2, 'Batas Area Kampus Unnes', '[{\"lat\": -7.099904, \"lng\": 110.419607}, {\"lat\": -7.111846, \"lng\": 110.43888}, {\"lat\": -7.108275, \"lng\": 110.461845}, {\"lat\": -7.088727, \"lng\": 110.466634}]'),
(3, 'Batas Area Kampus UDINUS', '[{\"lat\": -7.027466, \"lng\": 110.411556}, {\"lat\": -7.032768, \"lng\": 110.418767}, {\"lat\": -7.032046, \"lng\": 110.427046}, {\"lat\": -7.025963, \"lng\": 110.430486}]');

-- --------------------------------------------------------

--
-- Table structure for table `coordinates`
--

CREATE TABLE `coordinates` (
  `id` int(11) NOT NULL,
  `id_area` int(11) NOT NULL,
  `point` enum('point-1','point-2','point-3','point-4') NOT NULL,
  `lat` text NOT NULL,
  `lng` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coordinates`
--

INSERT INTO `coordinates` (`id`, `id_area`, `point`, `lat`, `lng`) VALUES
(1, 1, 'point-1', '-7.040865', '110.390625'),
(2, 1, 'point-2', '-7.056482', '110.417023'),
(3, 1, 'point-3', '-7.076736', '110.431099'),
(4, 1, 'point-4', '-7.091463', '110.408306'),
(5, 2, 'point-1', '-7.099904', '110.419607'),
(6, 2, 'point-2', '-7.111846', '110.43888'),
(7, 2, 'point-3', '-7.108275', '110.461845'),
(8, 2, 'point-4', '-7.088727', '110.466634'),
(9, 3, 'point-1', '-7.027466', '110.411556'),
(10, 3, 'point-2', '-7.032768', '110.418767'),
(11, 3, 'point-3', '-7.032046', '110.427046'),
(12, 3, 'point-4', '-7.025963', '110.430486');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `id_area` int(11) NOT NULL,
  `jumlah` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `id_area`, `jumlah`) VALUES
(1, 1, '3.200'),
(2, 2, '1.200'),
(3, 3, '1.000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coordinates`
--
ALTER TABLE `coordinates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `coordinates`
--
ALTER TABLE `coordinates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
