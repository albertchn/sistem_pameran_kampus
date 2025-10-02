-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2025 at 04:59 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `seni_db`
--
CREATE DATABASE IF NOT EXISTS `seni_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `seni_db`;

-- --------------------------------------------------------

--
-- Table structure for table `tb_karya`
--
-- Creation: Oct 01, 2025 at 04:30 AM
--

CREATE TABLE `tb_karya` (
  `id_karya` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `judul_karya` varchar(50) NOT NULL,
  `foto_kaya` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `pencipta` varchar(30) NOT NULL,
  `skor` int(3) DEFAULT NULL,
  `tenggat_kurasi` date DEFAULT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `tb_karya`:
--   `id_user`
--       `tb_users` -> `id_user`
--

--
-- Dumping data for table `tb_karya`
--

INSERT INTO `tb_karya` (`id_karya`, `id_user`, `judul_karya`, `foto_kaya`, `deskripsi`, `pencipta`, `skor`, `tenggat_kurasi`, `status`) VALUES
(1, 1, 'Belalang Sembah', 'belalang.webp', 'Belalang sembah yang bijaksana memberikan kata-kata mutiaranya', 'Soekirman', 70, '2025-09-29', 'accepted'),
(2, 1, 'Hujan Es', 'hujan es.jpg', 'Musim dingin pun tiba angin berhembus...', 'Poetri R', 60, '2025-09-30', 'rejected');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kurasi`
--
-- Creation: Oct 01, 2025 at 05:50 AM
--

CREATE TABLE `tb_kurasi` (
  `id_kurasi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_karya` int(11) NOT NULL,
  `tanggal_kurasi` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `skor` int(3) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `tb_kurasi`:
--   `id_karya`
--       `tb_karya` -> `id_karya`
--   `id_user`
--       `tb_users` -> `id_user`
--

--
-- Dumping data for table `tb_kurasi`
--

INSERT INTO `tb_kurasi` (`id_kurasi`, `id_user`, `id_karya`, `tanggal_kurasi`, `skor`, `catatan`, `status`) VALUES
(1, 2, 2, '2025-10-01 13:07:20', 60, 'Kurang detail ini pakai AI pasti', 'submitted'),
(2, 2, 1, '2025-10-01 13:07:20', 70, 'Bagus nih karyanya', 'submitted');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pameran`
--
-- Creation: Sep 29, 2025 at 02:37 AM
--

CREATE TABLE `tb_pameran` (
  `id_pameran` int(11) NOT NULL,
  `id_karya` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `ruang_display` varchar(100) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `tb_pameran`:
--   `id_karya`
--       `tb_karya` -> `id_karya`
--

--
-- Dumping data for table `tb_pameran`
--

INSERT INTO `tb_pameran` (`id_pameran`, `id_karya`, `tanggal`, `lokasi`, `ruang_display`, `status`) VALUES
(1, 1, '2025-10-08', 'Gedung Melati', 'L300', 'scheduled');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--
-- Creation: Sep 28, 2025 at 02:14 PM
--

CREATE TABLE `tb_users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `tb_users`:
--

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id_user`, `nama`, `email`, `password`, `role`) VALUES
(1, 'Steven Sebastian', 'stevensebas@gmail.com', '202cb962ac59075b964b07152d234b70', 'mahasiswa'),
(2, 'Samuel Renaldy 1 ', 'samuelrey@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'kurator'),
(4, 'admin1', 'admin1@gmail.com', '202cb962ac59075b964b07152d234b70', 'admin'),
(6, 'Vargas', 'vargas@gmail.com', '202cb962ac59075b964b07152d234b70', 'mahasiswa'),
(7, 'Chris', 'chris@gmail.com', '202cb962ac59075b964b07152d234b70', 'mahasiswa'),
(8, 'Nico', 'nico@gmail.com', '202cb962ac59075b964b07152d234b70', 'mahasiswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_karya`
--
ALTER TABLE `tb_karya`
  ADD PRIMARY KEY (`id_karya`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_kurasi`
--
ALTER TABLE `tb_kurasi`
  ADD PRIMARY KEY (`id_kurasi`),
  ADD KEY `id_karya` (`id_karya`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_pameran`
--
ALTER TABLE `tb_pameran`
  ADD PRIMARY KEY (`id_pameran`),
  ADD KEY `id_karya` (`id_karya`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id_user`,`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_karya`
--
ALTER TABLE `tb_karya`
  MODIFY `id_karya` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_kurasi`
--
ALTER TABLE `tb_kurasi`
  MODIFY `id_kurasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_pameran`
--
ALTER TABLE `tb_pameran`
  MODIFY `id_pameran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_karya`
--
ALTER TABLE `tb_karya`
  ADD CONSTRAINT `tb_karya_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_kurasi`
--
ALTER TABLE `tb_kurasi`
  ADD CONSTRAINT `tb_kurasi_ibfk_1` FOREIGN KEY (`id_karya`) REFERENCES `tb_karya` (`id_karya`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_kurasi_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tb_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pameran`
--
ALTER TABLE `tb_pameran`
  ADD CONSTRAINT `tb_pameran_ibfk_1` FOREIGN KEY (`id_karya`) REFERENCES `tb_karya` (`id_karya`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
