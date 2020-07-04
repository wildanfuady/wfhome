-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for wfhome
CREATE DATABASE IF NOT EXISTS `wfhome` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `wfhome`;

-- Dumping structure for table wfhome.pekerjaan
CREATE TABLE IF NOT EXISTS `pekerjaan` (
  `pekerjaan_id` int(11) NOT NULL AUTO_INCREMENT,
  `pekerjaan_nama` varchar(250) NOT NULL,
  `pekerjaan_unit` int(11) NOT NULL DEFAULT '0',
  `pekerjaan_kontraktor` varchar(250) NOT NULL,
  `pekerjaan_jumlah_pekerja` int(11) NOT NULL DEFAULT '0',
  `pekerjaan_tgl_mulai` datetime NOT NULL,
  `pekerjaan_deadline` datetime NOT NULL,
  `pekerjaan_progress` int(11) NOT NULL DEFAULT '0',
  `pekerjaan_status` varchar(50) NOT NULL DEFAULT '0',
  `pekerjaan_keterangan` text,
  PRIMARY KEY (`pekerjaan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table wfhome.pekerjaan: ~1 rows (approximately)
/*!40000 ALTER TABLE `pekerjaan` DISABLE KEYS */;
INSERT INTO `pekerjaan` (`pekerjaan_id`, `pekerjaan_nama`, `pekerjaan_unit`, `pekerjaan_kontraktor`, `pekerjaan_jumlah_pekerja`, `pekerjaan_tgl_mulai`, `pekerjaan_deadline`, `pekerjaan_progress`, `pekerjaan_status`, `pekerjaan_keterangan`) VALUES
	(3, '1', 20, 'vdcdcdcdcd', 33, '2020-07-16 00:00:00', '2020-07-07 00:00:00', 0, 'Selesai', 'cdcsxssxs');
/*!40000 ALTER TABLE `pekerjaan` ENABLE KEYS */;

-- Dumping structure for table wfhome.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `fullname` varchar(250) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `pass_show` varchar(250) NOT NULL,
  `level` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table wfhome.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `fullname`, `email`, `password`, `pass_show`, `level`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'Administrator', 'admin@wfhome.com', '$2y$10$LzDeqop2NQP.9xLCor1iD./MYoT7wncPbHrLVZJa7PsZUMMmacKvm', 'admin123', 'admin', 'activated', '2020-06-26 13:03:47', '2020-06-26 13:03:48'),
	(5, 'wildanfuady', 'Wildan Fuady', 'pengawas@gmail.com', '$2y$10$0Gim4OofeagnLM/939NS1epmHTVBxBp4UZi4TtsBLZE4Vr/E51VBW', 'admin123', 'pengawas', 'activated', '2020-06-26 20:52:58', NULL),
	(7, 'wildanfuady', 'Wildan Fuady', 'manajer@gmail.com', '$2y$10$/X/IzQ.EfzjEynDjLFAHAOhqx0LMTgGyKODdvoGj8qU8PfKX128uK', 'admin123', 'manajer', 'activated', '2020-07-03 07:15:01', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
