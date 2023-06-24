-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2023 at 01:22 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vehicle_registration`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `surname`, `email`, `password`) VALUES
(1, 'John', 'Doe', 'john.doe@gmail.com', '$2y$10$3nKRmQIYsFSMaqrC4wQEk.C41p7Pd0DAvn1l58sf2Z0eHCpPdnZ8m'),
(2, 'Jane', 'Smith', 'jane.smith@gmail.com', '$2y$10$jLDxbmEnRedQ..QAymKapOQIDjVyHyt0j25ifJbedObgHe009eXea'),
(3, 'Alice', 'Johnson', 'alice.johnson@gmail.com', '$2y$10$RToV63dLPcv5CWp/A7I4P.zOLcrv1Z2YFVIJbm8FCpMSsMhg/w18K'),
(4, 'Bob', 'Anderson', 'bob.anderson@gmail.com', '$2y$10$m.SY/JTHsobOAgNQT4lLS.nEumfajjghIo985QgDEhicSr8uPCQ0u'),
(5, 'Eve', 'Wilson', 'eve.wilson@gmail.com', '$2y$10$RXDSsGVe8/fEyokON/D/dOJ8U2TuqF6pI7LGRCuSK6gaJO1TUunwi');

-- --------------------------------------------------------

--
-- Table structure for table `fuel_types`
--

CREATE TABLE `fuel_types` (
  `id` int(11) NOT NULL,
  `fuel_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fuel_types`
--

INSERT INTO `fuel_types` (`id`, `fuel_type`) VALUES
(1, 'Gasoline'),
(2, 'Diesel'),
(3, 'Electric');

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `id` int(11) NOT NULL,
  `vehicle_model` int(11) NOT NULL,
  `vehicle_type` int(11) NOT NULL,
  `vehicle_chassis_number` varchar(255) NOT NULL,
  `vehicle_production_year` date NOT NULL,
  `registration_number` varchar(255) NOT NULL,
  `fuel_type` int(11) NOT NULL,
  `registration_to` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`id`, `vehicle_model`, `vehicle_type`, `vehicle_chassis_number`, `vehicle_production_year`, `registration_number`, `fuel_type`, `registration_to`) VALUES
(1, 2, 1, 'WAUZZZ8K0BA123456', '2015-08-29', 'XYZ789', 2, '2024-06-30'),
(2, 4, 3, '5TFHW5F13AX136128', '2016-02-12', 'AWS345', 3, '2024-02-12'),
(3, 1, 4, 'JH4KA3140KC015221', '2014-05-24', 'JKL143', 2, '2023-06-29'),
(4, 9, 2, '1G8AN15F07Z174255', '2007-01-12', 'BNM654', 1, '2024-02-05'),
(6, 7, 3, '1B7GG2AN9YS629756', '2003-12-12', 'CVB443', 1, '2023-03-12'),
(7, 3, 1, 'JNKCV51F04M710639', '2018-08-12', 'ASD897', 1, '2023-07-07'),
(8, 1, 5, '2G1WL54T4R9165225', '2015-09-09', 'OPL442', 1, '2023-06-12');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_models`
--

CREATE TABLE `vehicle_models` (
  `id` int(11) NOT NULL,
  `vehicle_model` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle_models`
--

INSERT INTO `vehicle_models` (`id`, `vehicle_model`) VALUES
(1, 'Mercedes'),
(2, 'Audi'),
(3, 'BMW'),
(4, 'Ford'),
(5, 'Opel'),
(7, 'Seat'),
(9, 'Honda'),
(13, 'Porsche');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_types`
--

CREATE TABLE `vehicle_types` (
  `id` int(11) NOT NULL,
  `vehicle_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle_types`
--

INSERT INTO `vehicle_types` (`id`, `vehicle_type`) VALUES
(1, 'Sedan'),
(2, 'Coupe'),
(3, 'Hatchback'),
(4, 'Suv'),
(5, 'Minivan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fuel_types`
--
ALTER TABLE `fuel_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_model` (`vehicle_model`),
  ADD KEY `vehicle_type` (`vehicle_type`),
  ADD KEY `registrations_ibfk_3` (`fuel_type`);

--
-- Indexes for table `vehicle_models`
--
ALTER TABLE `vehicle_models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_types`
--
ALTER TABLE `vehicle_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `fuel_types`
--
ALTER TABLE `fuel_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `vehicle_models`
--
ALTER TABLE `vehicle_models`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `vehicle_types`
--
ALTER TABLE `vehicle_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `registrations`
--
ALTER TABLE `registrations`
  ADD CONSTRAINT `registrations_ibfk_1` FOREIGN KEY (`vehicle_model`) REFERENCES `vehicle_models` (`id`),
  ADD CONSTRAINT `registrations_ibfk_2` FOREIGN KEY (`vehicle_type`) REFERENCES `vehicle_types` (`id`),
  ADD CONSTRAINT `registrations_ibfk_3` FOREIGN KEY (`fuel_type`) REFERENCES `fuel_types` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
