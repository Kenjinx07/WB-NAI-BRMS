-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2025 at 08:35 AM
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
-- Database: `records_management_system_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `blotters`
--

CREATE TABLE `blotters` (
  `B_ID` int(11) NOT NULL,
  `BF_Name` varchar(255) NOT NULL,
  `BM_Name` varchar(255) NOT NULL,
  `BL_Name` varchar(255) NOT NULL,
  `B_Email` varchar(255) NOT NULL,
  `B_Type` varchar(255) DEFAULT NULL,
  `B_Description` varchar(255) NOT NULL,
  `B_Date` date NOT NULL,
  `B_Status` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blotters`
--

INSERT INTO `blotters` (`B_ID`, `BF_Name`, `BM_Name`, `BL_Name`, `B_Email`, `B_Type`, `B_Description`, `B_Date`, `B_Status`) VALUES
(2, 'Kenji', 'Apolinar', 'Ferenal', 'kenjiferenal@gmail.com', 'Fraud', 'gyuhjkm', '2024-10-09', 'Filed'),
(10, 'Kenji', 'Apolinar', 'Ferenal', 'kenjiferenal@gmail.com', 'MissingPerson', 'gesgseGes', '2024-10-11', 'Filed'),
(12, 'Kenji', 'Apolinar', 'Ferenal', 'kenjiferenal@gmail.com', 'MissingPerson', 'grdxgrdgrd', '2024-10-14', 'Filed');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `C_ID` int(11) NOT NULL,
  `CF_Name` varchar(255) NOT NULL,
  `CM_Name` varchar(255) NOT NULL,
  `CL_Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `C_Description` varchar(255) NOT NULL,
  `C_Date` date NOT NULL,
  `C_Status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`C_ID`, `CF_Name`, `CM_Name`, `CL_Name`, `Email`, `C_Description`, `C_Date`, `C_Status`) VALUES
(14, 'Kenji', 'Apolinar', 'Ferenal', 'kenjiferenal@gmail.com', 'ghrsdZHrdfzhrdzhr', '2024-10-09', 'Filed'),
(15, 'Kenjie', 'Apolinar', 'Ferenal', 'kenjiferenal@gmail.com', 'htxjtgxkjmtgxkjtfxk', '2024-10-10', 'Filed'),
(18, 'Kenji', 'Apolinar', 'Ferenal', 'kenjiferenal@gmail.com', 'grdxgrxdgrdx', '2024-10-14', 'Filed');

-- --------------------------------------------------------

--
-- Table structure for table `request_records`
--

CREATE TABLE `request_records` (
  `R_ID` int(11) NOT NULL,
  `RF_Name` varchar(255) NOT NULL,
  `RM_Name` varchar(255) NOT NULL,
  `RL_Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Request_Type` varchar(255) DEFAULT NULL,
  `Request_Reason` varchar(255) NOT NULL,
  `R_Date` date NOT NULL,
  `Status` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_records`
--

INSERT INTO `request_records` (`R_ID`, `RF_Name`, `RM_Name`, `RL_Name`, `Email`, `Request_Type`, `Request_Reason`, `R_Date`, `Status`) VALUES
(38, 'Kenji', 'Apolinar', 'Ferenal', 'kenjiferenal@gmail.com', 'Barangay Clearance', 'Educational Assistance', '2025-02-12', 'Processing'),
(41, 'Kenji', 'Apolinar', 'Ferenal', 'kenjiferenal@gmail.com', 'Barangay Clearance', 'Job Requirement', '2025-02-13', 'Processing'),
(45, 'Jane', 'Marasigan', 'Doe', 'janedoe@gmail.com', 'Barangay Clearance', 'Educ Assistance', '2025-02-13', 'Processing'),
(48, 'Kenji', 'Apolinar', 'Ferenal', 'kenjiferenal@gmail.com', 'Indigence Certificate', 'Ayuda', '2025-02-19', 'Processing'),
(49, 'Jane', 'Marasigan', 'Doe', 'janedoe@gmail.com', 'Indigence Certificate', 'Ayuda Requirement', '2025-02-19', 'Processing');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `description`) VALUES
(1, 'admin', 'Administrator with full access'),
(2, 'secretary', 'Secretary with access to resident accounts'),
(3, 'bhw', 'Barangay Health Worker with access to specific groups'),
(4, 'verified', 'Verified resident with full dashboard access'),
(5, 'unverified', 'Unverified resident with limited dashboard access');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID_No` int(11) NOT NULL,
  `Role` varchar(20) DEFAULT 'unverified',
  `Email` varchar(255) DEFAULT NULL,
  `Password` varchar(255) NOT NULL,
  `F_Name` varchar(255) NOT NULL,
  `M_Name` varchar(255) DEFAULT NULL,
  `L_Name` varchar(255) NOT NULL,
  `BirthDate` date NOT NULL,
  `Contact_No` varchar(255) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `Civil_Status` varchar(255) NOT NULL,
  `Nationality` varchar(255) NOT NULL,
  `Barangay` varchar(255) NOT NULL,
  `Subdivision` varchar(255) NOT NULL,
  `Street_Name` varchar(255) NOT NULL,
  `Block` int(5) NOT NULL,
  `Lot` int(5) NOT NULL,
  `uploads` int(11) NOT NULL,
  `Profile_Picture` varchar(255) DEFAULT NULL,
  `Signature` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID_No`, `Role`, `Email`, `Password`, `F_Name`, `M_Name`, `L_Name`, `BirthDate`, `Contact_No`, `Gender`, `Civil_Status`, `Nationality`, `Barangay`, `Subdivision`, `Street_Name`, `Block`, `Lot`, `uploads`, `Profile_Picture`, `Signature`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$BcPJxNGTlvFkLDnhZn6jFuCs5WAw5mLzur1CEvOu7nO4B9b68eNrO', 'John', 'Marasigan', 'Doe', '0000-00-00', '09999999999', 'Male', 'Single', 'Filipino', 'Pasong Buaya 2', 'Woodsite 1', 'Tecson', 3, 15, 0, NULL, NULL),
(6, 'verified', 'kenjiferenal@gmail.com', '$2y$10$Ccqtoqcqq1ESQg8uGNxRveaw4qsHicAw3bNriLPej2kMG4BxTXvpS', 'Kenji', 'Apolinar', 'Ferenal', '2002-01-03', '09214336349', 'Male', 'Single', 'Filipino', 'Pasong Buaya 2', 'Woodsite 3', 'Colayco', 7, 4, 1, NULL, NULL),
(16, 'unverified', 'kenjferenal@gmail.com', '$2y$10$t.0JoTLb5lrTmwICSekxdOLpWjHOopUcUJuVghPn0kLFbzORVkQp6', 'Kenj', 'Apolin', 'Ferenal', '2002-01-03', '09674071029', 'Male', 'Single', 'Filipino', 'Pasong Buaya 2', 'Woodsite 3', 'Colayco', 7, 4, 0, NULL, NULL),
(17, 'verified', 'janedoe@gmail.com', '$2y$10$dawijsk6hjuO3806XJ6AEuF6udGtS1xiPlTA64ieD3WtVtjNOqftq', 'Jane', 'Marasigan', 'Doe', '2000-12-03', '09543265532', 'Female', 'Single', 'Filipino', 'Pasong Buaya 2', 'Woodsite 3', 'Bugallon', 6, 4, 0, NULL, NULL),
(18, 'unverified', 'kenferenal@gmail.com', '$2y$10$U6A.4WWzacx3qfsuiBfdyusCAiwld35o2FdMnsW7M9rJiVghhpPtS', 'ken', 'Apo', 'Fern', '2002-01-03', '092153463723', 'Male', 'Single', 'Filipino', 'Pasong Buaya 2', 'Woodsite', '1', 3, 2, 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blotters`
--
ALTER TABLE `blotters`
  ADD PRIMARY KEY (`B_ID`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`C_ID`);

--
-- Indexes for table `request_records`
--
ALTER TABLE `request_records`
  ADD PRIMARY KEY (`R_ID`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID_No`) USING BTREE,
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blotters`
--
ALTER TABLE `blotters`
  MODIFY `B_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `C_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `request_records`
--
ALTER TABLE `request_records`
  MODIFY `R_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID_No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
