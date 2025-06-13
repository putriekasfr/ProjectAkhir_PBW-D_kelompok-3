-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2025 at 04:34 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `b_ekstrakurikuler`
--

-- --------------------------------------------------------

--
-- Table structure for table `ekstrakurikuler`
--

CREATE TABLE `ekstrakurikuler` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ekstrakurikuler`
--

INSERT INTO `ekstrakurikuler` (`id`, `nama`, `deskripsi`, `gambar`) VALUES
(1, 'Futsal', NULL, NULL),
(2, 'PMR', NULL, NULL),
(3, 'Tari', NULL, NULL),
(4, 'Pramuka', NULL, NULL),
(5, 'Modelling', NULL, NULL),
(6, 'Seni Musik', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id`, `nama`) VALUES
(1, 'Teknik Komputer dan Jaringan'),
(2, 'Teknik Kendaraan Ringan'),
(3, 'Desain dan Produksi Busana'),
(4, 'Teknik Permesinan');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaranekstra`
--

CREATE TABLE `pendaftaranekstra` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ekstra_id` int(11) NOT NULL,
  `tanggal_daftar` date DEFAULT NULL,
  `status` enum('menunggu','diterima','ditolak') DEFAULT 'menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pendaftaranekstra`
--

INSERT INTO `pendaftaranekstra` (`id`, `user_id`, `ekstra_id`, `tanggal_daftar`, `status`) VALUES
(6, 6, 4, '2025-06-12', 'diterima'),
(8, 7, 5, '2025-06-13', 'ditolak'),
(9, 8, 4, '2025-06-13', 'diterima');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nis` varchar(20) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `tpt_lahir` varchar(100) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kelas` varchar(20) DEFAULT NULL,
  `jurusan_id` int(11) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` enum('user','admin','superadmin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nis`, `nama`, `tpt_lahir`, `tgl_lahir`, `alamat`, `kelas`, `jurusan_id`, `no_hp`, `username`, `password`, `level`) VALUES
(1, NULL, 'Superadmin', NULL, NULL, NULL, NULL, NULL, '085212341234', 'superadmin', '4297f44b13955235245b2497399d7a93', 'superadmin'),
(2, NULL, 'Admin', NULL, NULL, NULL, NULL, NULL, '0852123123', 'admin', '4297f44b13955235245b2497399d7a93', 'admin'),
(3, NULL, 'davin', NULL, NULL, NULL, NULL, 2, '082330837125', 'vinn', '4297f44b13955235245b2497399d7a93', 'user'),
(4, NULL, 'wahyu', NULL, NULL, NULL, NULL, 1, '54634654675', 'wahyuu', '4297f44b13955235245b2497399d7a93', 'user'),
(5, NULL, 'wahyu2', NULL, NULL, NULL, 'TYUTUY', 1, '4839939393', 'wahyu2', '4297f44b13955235245b2497399d7a93', 'user'),
(6, NULL, 'eka', NULL, NULL, NULL, '10', 1, '352335325325', 'ekaa', '4297f44b13955235245b2497399d7a93', 'user'),
(7, NULL, 'putri ekaa safira', NULL, NULL, NULL, '11', 1, '082330837125', 'firaa', 'e10adc3949ba59abbe56e057f20f883e', 'user'),
(8, NULL, 'Davin Zanjabyla ', NULL, NULL, NULL, '12', 4, '082330837125', 'Davin', '4297f44b13955235245b2497399d7a93', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ekstrakurikuler`
--
ALTER TABLE `ekstrakurikuler`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pendaftaranekstra`
--
ALTER TABLE `pendaftaranekstra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ekstra_id` (`ekstra_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ekstrakurikuler`
--
ALTER TABLE `ekstrakurikuler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pendaftaranekstra`
--
ALTER TABLE `pendaftaranekstra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pendaftaranekstra`
--
ALTER TABLE `pendaftaranekstra`
  ADD CONSTRAINT `pendaftaranekstra_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pendaftaranekstra_ibfk_2` FOREIGN KEY (`ekstra_id`) REFERENCES `ekstrakurikuler` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
