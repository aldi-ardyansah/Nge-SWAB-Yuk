-- phpMyAdmin SQL Dump
-- version 6.0.0-dev+20260902.697a6874b0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 16, 2026 at 01:42 PM
-- Server version: 9.6.0
-- PHP Version: 8.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nge-swab-yuk`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_a_accounts`
--
CREATE TABLE `tb_a_accounts` (
  `NIK` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Access` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_a_accounts`
--

INSERT INTO `tb_a_accounts` (`NIK`, `Password`, `Name`, `Access`) VALUES
('8000669', '123', 'Rima Aviyani', 'Administrator'),
('8000670', '123', 'Aldi Dwi Ardyansah', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `tb_b_swab_zone_1`
--
CREATE TABLE `tb_b_swab_zone_1` (
  `ID` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Analysis_Date` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Area` varchar(100) NOT NULL,
  `Zone_1_Machine` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `SWAB_Point` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `TPC` varchar(100) NOT NULL,
  `Enterobacteriaceae` varchar(100) NOT NULL,
  `Notes` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_b_swab_zone_2`
--
CREATE TABLE `tb_b_swab_zone_2` (
  `ID` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Analysis_Date` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Area` varchar(100) NOT NULL,
  `Zone_2_Machine` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `SWAB_Point` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `TPC` varchar(100) NOT NULL,
  `Enterobacteriaceae` varchar(100) NOT NULL,
  `Notes` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_a_accounts`
--
ALTER TABLE `tb_a_accounts`
  ADD PRIMARY KEY (`NIK`);

--
-- Indexes for table `tb_b_swab_zone_1`
--
ALTER TABLE `tb_b_swab_zone_1`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tb_b_swab_zone_2`
--
ALTER TABLE `tb_b_swab_zone_2`
  ADD PRIMARY KEY (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
