-- phpMyAdmin SQL Dump
-- version 4.7.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 21, 2018 at 12:16 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xeptkb`
--

-- --------------------------------------------------------

--
-- Table structure for table `hocki`
--

CREATE TABLE `hocki` (
  `HOCKI` varchar(2) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `hocki`
--

INSERT INTO `hocki` (`HOCKI`) VALUES
('2');

-- --------------------------------------------------------

--
-- Table structure for table `lop_hoc_phan`
--

CREATE TABLE `lop_hoc_phan` (
  `MAHP` varchar(10) COLLATE utf8_vietnamese_ci NOT NULL,
  `TENHP` varchar(100) COLLATE utf8_vietnamese_ci NOT NULL,
  `KIHIEU` varchar(5) COLLATE utf8_vietnamese_ci NOT NULL,
  `THU` varchar(1) COLLATE utf8_vietnamese_ci NOT NULL,
  `TIETBD` varchar(2) COLLATE utf8_vietnamese_ci NOT NULL,
  `SOTIET` varchar(2) COLLATE utf8_vietnamese_ci NOT NULL,
  `PHONG` varchar(10) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `SISO` varchar(3) COLLATE utf8_vietnamese_ci NOT NULL,
  `TINCHI` varchar(2) COLLATE utf8_vietnamese_ci NOT NULL,
  `MALOP` varchar(8) COLLATE utf8_vietnamese_ci NOT NULL,
  `TUANHOC` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `namhoc`
--

CREATE TABLE `namhoc` (
  `NAMHOC` varchar(5) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `namhoc`
--

INSERT INTO `namhoc` (`NAMHOC`) VALUES
('17-18');

-- --------------------------------------------------------

--
-- Table structure for table `nguoi_dung`
--

CREATE TABLE `nguoi_dung` (
  `MSSV` varchar(8) COLLATE utf8_vietnamese_ci NOT NULL,
  `HOTEN` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `EMAIL` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `MKHAU` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `MALOP` varchar(8) COLLATE utf8_vietnamese_ci NOT NULL,
  `KICHHOAT` varchar(1) COLLATE utf8_vietnamese_ci DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tkb`
--

CREATE TABLE `tkb` (
  `ID` smallint(6) NOT NULL,
  `MSSV` varchar(8) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `xep_tkb`
--

CREATE TABLE `xep_tkb` (
  `ID` smallint(6) NOT NULL,
  `MSSV` varchar(8) COLLATE utf8_vietnamese_ci NOT NULL,
  `MAHP` varchar(10) COLLATE utf8_vietnamese_ci NOT NULL,
  `KIHIEU` varchar(5) COLLATE utf8_vietnamese_ci NOT NULL,
  `THU` varchar(1) COLLATE utf8_vietnamese_ci NOT NULL,
  `TIETBD` varchar(2) COLLATE utf8_vietnamese_ci NOT NULL,
  `NAMHOC` varchar(5) COLLATE utf8_vietnamese_ci NOT NULL,
  `HOCKI` varchar(2) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hocki`
--
ALTER TABLE `hocki`
  ADD PRIMARY KEY (`HOCKI`);

--
-- Indexes for table `lop_hoc_phan`
--
ALTER TABLE `lop_hoc_phan`
  ADD PRIMARY KEY (`MAHP`,`KIHIEU`,`THU`,`TIETBD`);

--
-- Indexes for table `namhoc`
--
ALTER TABLE `namhoc`
  ADD PRIMARY KEY (`NAMHOC`);

--
-- Indexes for table `nguoi_dung`
--
ALTER TABLE `nguoi_dung`
  ADD PRIMARY KEY (`MSSV`);

--
-- Unique `email` for table `nguoi_dung`
--
ALTER TABLE `nguoi_dung` 
  ADD UNIQUE(`EMAIL`);

--
-- Indexes for table `tkb`
--
ALTER TABLE `tkb`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_TKB_NGDUNG` (`MSSV`);

--
-- Indexes for table `xep_tkb`
--
ALTER TABLE `xep_tkb`
  ADD PRIMARY KEY (`ID`,`MSSV`,`MAHP`,`KIHIEU`,`THU`,`TIETBD`,`NAMHOC`,`HOCKI`),
  ADD KEY `FK_HOCKI_XEPTKB` (`HOCKI`),
  ADD KEY `FK_LOPHP_XEPTKB` (`MAHP`,`KIHIEU`,`THU`,`TIETBD`),
  ADD KEY `FK_NAMHOC_XEPTKB` (`NAMHOC`),
  ADD KEY `FK_NGUOI_XEPTKB` (`MSSV`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tkb`
--
ALTER TABLE `tkb`
  ADD CONSTRAINT `FK_TKB_NGDUNG` FOREIGN KEY (`MSSV`) REFERENCES `nguoi_dung` (`MSSV`);

--
-- Constraints for table `xep_tkb`
--
ALTER TABLE `xep_tkb`
  ADD CONSTRAINT `FK_HOCKI_XEPTKB` FOREIGN KEY (`HOCKI`) REFERENCES `hocki` (`HOCKI`),
  ADD CONSTRAINT `FK_LOPHP_XEPTKB` FOREIGN KEY (`MAHP`,`KIHIEU`,`THU`,`TIETBD`) REFERENCES `lop_hoc_phan` (`MAHP`, `KIHIEU`, `THU`, `TIETBD`),
  ADD CONSTRAINT `FK_NAMHOC_XEPTKB` FOREIGN KEY (`NAMHOC`) REFERENCES `namhoc` (`NAMHOC`),
  ADD CONSTRAINT `FK_NGUOI_XEPTKB` FOREIGN KEY (`MSSV`) REFERENCES `nguoi_dung` (`MSSV`),
  ADD CONSTRAINT `FK_TKB_XEPTKB` FOREIGN KEY (`ID`) REFERENCES `tkb` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
