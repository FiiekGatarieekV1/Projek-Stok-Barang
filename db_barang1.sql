-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 22, 2024 at 08:51 AM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id21659949_fikli`
--

-- --------------------------------------------------------

--
-- Table structure for table `keluar`
--

CREATE TABLE `keluar` (
  `idkeluar` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `penerima` varchar(30) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keluar`
--

INSERT INTO `keluar` (`idkeluar`, `idbarang`, `tanggal`, `penerima`, `qty`) VALUES
(32, 33, '2023-11-22 15:41:49', 'Toko Tea', 1),
(33, 34, '2023-11-22 15:43:39', 'Toko Klontong', 15),
(34, 33, '2023-11-27 05:14:27', 'Toko Sembako', 23),
(35, 35, '2023-11-27 05:14:53', 'Toko Tea', 25),
(37, 37, '2023-12-03 12:39:36', 'Toko Klontong', 22),
(40, 37, '2023-12-03 12:42:08', 'Toko Sembako', 1),
(41, 38, '2023-12-03 14:55:21', 'Toko Klontong', 7),
(42, 38, '2023-12-03 14:56:39', 'Toko Klontong', 2),
(43, 38, '2023-12-18 05:07:23', 'Toko Klontong', 3),
(44, 33, '2023-12-18 06:00:44', 'toko sembako', 12),
(45, 39, '2023-12-18 06:01:03', 'toko sembako', 12);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `iduser` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`iduser`, `email`, `password`) VALUES
(1, 'fikli@gmail.com', '12345'),
(3, 'test@gmail.com', '123'),
(4, 'admin@gmail.com', '231');

-- --------------------------------------------------------

--
-- Table structure for table `masuk`
--

CREATE TABLE `masuk` (
  `idmasuk` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `keterangan` varchar(30) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `masuk`
--

INSERT INTO `masuk` (`idmasuk`, `idbarang`, `tanggal`, `keterangan`, `qty`) VALUES
(13, 12, '2023-11-13 03:32:56', 'Bambang', 14),
(14, 13, '2023-11-13 04:22:38', 'Dera', 30),
(15, 13, '2023-11-13 04:23:04', 'Dera', 14),
(16, 12, '2023-11-13 05:09:04', 'DELA', 6),
(17, 14, '2023-11-13 05:09:46', 'DELA', 7),
(18, 12, '2023-11-19 15:37:10', 'ha', 23),
(20, 15, '2023-11-19 16:20:32', 'No', 100),
(21, 16, '2023-11-19 17:18:40', 'Toko Tea', 10),
(22, 17, '2023-11-19 17:27:44', 'Toko', 12),
(23, 19, '2023-11-20 04:57:53', 'Toko Klontong', 5),
(24, 20, '2023-11-20 04:59:16', 'Toko Klontong', 5),
(25, 21, '2023-11-20 05:12:30', 'Toko Klontong', 5),
(26, 22, '2023-11-20 05:15:26', 'Toko Klontong', 5),
(27, 23, '2023-11-20 05:19:39', 'Toko Tea', 5),
(28, 24, '2023-11-20 05:21:13', 'Toko Tea', 5),
(29, 25, '2023-11-20 05:32:38', 'Toko Tea', 10),
(30, 26, '2023-11-20 05:38:40', 'Toko Tea', 5),
(31, 27, '2023-11-22 13:30:20', 'Toko', 11),
(33, 29, '2023-11-22 13:52:34', 'Toko Klontong', 10),
(35, 30, '2023-11-22 14:56:59', 'Teh', 14),
(44, 33, '2023-11-22 15:38:31', 'Toko Tea', 10),
(45, 34, '2023-11-22 15:43:11', 'Toko Sembako', 15),
(46, 35, '2023-11-27 05:13:59', 'Toko Klontong', 15),
(47, 36, '2023-11-27 05:42:19', 'Toko Sembako', 15),
(48, 33, '2023-12-03 12:38:37', 'Toko Kopi', 10),
(49, 37, '2023-12-03 12:39:11', 'Toko Kopi', 10),
(50, 38, '2023-12-03 14:55:38', 'Toko Klontong', 1),
(51, 38, '2023-12-03 15:01:47', 'Toko Sembako', 4),
(52, 39, '2023-12-18 06:00:28', 'toko klontong', 10);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `idbarang` int(11) NOT NULL,
  `namabarang` varchar(30) NOT NULL,
  `deskripsi` varchar(30) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`idbarang`, `namabarang`, `deskripsi`, `stock`) VALUES
(33, 'Teh', 'Minuman', 4),
(34, 'Mie', 'Makanan', 10),
(36, 'Kripik tempe', 'Makanan', 25),
(38, 'Coca Cola', 'Minuman', 3),
(39, 'Sarden', 'Makanan', 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keluar`
--
ALTER TABLE `keluar`
  ADD PRIMARY KEY (`idkeluar`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`iduser`);

--
-- Indexes for table `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`idmasuk`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`idbarang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keluar`
--
ALTER TABLE `keluar`
  MODIFY `idkeluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `masuk`
--
ALTER TABLE `masuk`
  MODIFY `idmasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `idbarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
