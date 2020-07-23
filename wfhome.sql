-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2020 at 04:15 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wfhome`
--

-- --------------------------------------------------------

--
-- Table structure for table `pekerjaan`
--

CREATE TABLE `pekerjaan` (
  `pekerjaan_id` int(11) NOT NULL,
  `pekerjaan_nama` varchar(250) NOT NULL,
  `pekerjaan_unit` int(11) NOT NULL DEFAULT '0',
  `pekerjaan_kontraktor` varchar(250) NOT NULL,
  `pekerjaan_jumlah_pekerja` int(11) NOT NULL DEFAULT '0',
  `pekerjaan_tgl_mulai` datetime NOT NULL,
  `pekerjaan_deadline` datetime NOT NULL,
  `pekerjaan_progress` int(11) NOT NULL DEFAULT '0',
  `pekerjaan_status` varchar(50) NOT NULL DEFAULT '0',
  `pekerjaan_keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pekerjaan`
--

INSERT INTO `pekerjaan` (`pekerjaan_id`, `pekerjaan_nama`, `pekerjaan_unit`, `pekerjaan_kontraktor`, `pekerjaan_jumlah_pekerja`, `pekerjaan_tgl_mulai`, `pekerjaan_deadline`, `pekerjaan_progress`, `pekerjaan_status`, `pekerjaan_keterangan`) VALUES
(3, '1', 20, 'vdcdcdcdcd', 33, '2020-07-16 00:00:00', '2020-07-07 00:00:00', 0, 'Selesai', 'cdcsxssxs');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `fullname` varchar(250) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `pass_show` varchar(250) NOT NULL,
  `level` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `fullname`, `email`, `password`, `pass_show`, `level`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', 'admin@gmail.com', '$2y$10$LzDeqop2NQP.9xLCor1iD./MYoT7wncPbHrLVZJa7PsZUMMmacKvm', 'admin123', 'admin', 'activated', '2020-06-26 13:03:47', '2020-06-26 13:03:48'),
(5, 'dayat123', 'Hidayat', 'pengawas@gmail.com', '$2y$10$srCcpGCCj7mjbWbb6DmYBeXAKqoaqzGG8GzQAj4DHuA5TKOKiugae', 'pengawas123', 'pengawas', 'activated', '2020-07-19 09:02:33', NULL),
(7, 'igun123', 'Aryaguna Dhanes', 'manajer@gmail.com', '$2y$10$m16PLFHbNMZI1GgwIioMquBOg5fz5xtKTNN9eXzmv3KQRyFBbi/ha', 'manajer123', 'manajer', 'activated', '2020-07-19 09:02:11', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  ADD PRIMARY KEY (`pekerjaan_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  MODIFY `pekerjaan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
