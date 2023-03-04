-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2023 at 09:58 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `patient_details`
--

CREATE TABLE `patient_details` (
  `patient_table_id` int(11) NOT NULL,
  `patient_name` varchar(60) DEFAULT NULL,
  `patient_fh` varchar(60) DEFAULT NULL,
  `patient_conatct` bigint(20) DEFAULT NULL,
  `patient_age` bigint(20) DEFAULT NULL,
  `patient_gender` enum('M','F','O','T') DEFAULT NULL,
  `patient_blood` varchar(20) NOT NULL,
  `patient_address` text DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `modifed_by` varchar(50) DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient_details`
--

INSERT INTO `patient_details` (`patient_table_id`, `patient_name`, `patient_fh`, `patient_conatct`, `patient_age`, `patient_gender`, `patient_blood`, `patient_address`, `created_by`, `created_at`, `modifed_by`, `modified_at`) VALUES
(3, 'patient1', 'pateinfn', 7896541230, 55, 'M', 'O+', 'testing address', NULL, '2023-03-04 07:43:47', NULL, NULL),
(4, 'test2', 'test2', 7896541230, 55, 'M', 'A+', 'test2', NULL, '2023-03-04 07:45:11', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `patient_details`
--
ALTER TABLE `patient_details`
  ADD PRIMARY KEY (`patient_table_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `patient_details`
--
ALTER TABLE `patient_details`
  MODIFY `patient_table_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
