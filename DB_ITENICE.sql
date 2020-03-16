-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.19 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for e-itenice
DROP DATABASE IF EXISTS `e-itenice`;
CREATE DATABASE IF NOT EXISTS `e-itenice` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `e-itenice`;

-- Dumping structure for table e-itenice.tbl_account
DROP TABLE IF EXISTS `tbl_account`;
CREATE TABLE IF NOT EXISTS `tbl_account` (
  `id` int(11) NOT NULL,
  `NIP` varchar(11) DEFAULT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `Password` varchar(20) DEFAULT NULL,
  `Status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `NIP` (`NIP`),
  CONSTRAINT `NIP` FOREIGN KEY (`NIP`) REFERENCES `tbl_pegawai` (`Nip`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table e-itenice.tbl_account: ~1 rows (approximately)
DELETE FROM `tbl_account`;
/*!40000 ALTER TABLE `tbl_account` DISABLE KEYS */;
INSERT INTO `tbl_account` (`id`, `NIP`, `Username`, `Password`, `Status`) VALUES
	(1, '1', 'admin', '1', 'admin'),
	(2, '2', 'rektor', '1', 'rektor'),
	(3, '1', 'dosen', '1', 'dosen'),
	(4, '2', 'fakultas', '1', 'fakultas'),
	(5, '2', 'jurusan', '1', 'jurusan'),
	(6, '1', 'ekspedisi', '1', 'ekspedisi');
/*!40000 ALTER TABLE `tbl_account` ENABLE KEYS */;

-- Dumping structure for table e-itenice.tbl_department
DROP TABLE IF EXISTS `tbl_department`;
CREATE TABLE IF NOT EXISTS `tbl_department` (
  `idDepartment` int(11) NOT NULL,
  `KodeDepartement` varchar(5) DEFAULT NULL,
  `NamaDepartement` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idDepartment`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table e-itenice.tbl_department: ~0 rows (approximately)
DELETE FROM `tbl_department`;
/*!40000 ALTER TABLE `tbl_department` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_department` ENABLE KEYS */;

-- Dumping structure for table e-itenice.tbl_pegawai
DROP TABLE IF EXISTS `tbl_pegawai`;
CREATE TABLE IF NOT EXISTS `tbl_pegawai` (
  `Nip` varchar(11) NOT NULL,
  `NamaPegawai` varchar(50) DEFAULT NULL,
  `TanggalLahir` date DEFAULT NULL,
  `TempatLahir` varchar(30) DEFAULT NULL,
  `Alamat` longtext,
  `NoHP` varchar(15) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `Aktif` enum('Y','N') DEFAULT NULL,
  PRIMARY KEY (`Nip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table e-itenice.tbl_pegawai: ~2 rows (approximately)
DELETE FROM `tbl_pegawai`;
/*!40000 ALTER TABLE `tbl_pegawai` DISABLE KEYS */;
INSERT INTO `tbl_pegawai` (`Nip`, `NamaPegawai`, `TanggalLahir`, `TempatLahir`, `Alamat`, `NoHP`, `Email`, `Aktif`) VALUES
	('1', 'ujank', '2020-03-16', 'bandung', 'kircon', '092', 'asd@asd.asd', 'Y'),
	('2', 'asep', '2020-03-16', 'bandung', 'kircon', '092', 'asd@asd.asd', 'Y');
/*!40000 ALTER TABLE `tbl_pegawai` ENABLE KEYS */;

-- Dumping structure for table e-itenice.tbl_rapat
DROP TABLE IF EXISTS `tbl_rapat`;
CREATE TABLE IF NOT EXISTS `tbl_rapat` (
  `IdRapat` int(11) NOT NULL,
  `NIP` varchar(11) DEFAULT NULL,
  `TopikRapat` varchar(50) DEFAULT NULL,
  `TglMulai` date DEFAULT NULL,
  `TglAkhir` date DEFAULT NULL,
  `WaktuMulai` time DEFAULT NULL,
  `WaktuAkhir` time DEFAULT NULL,
  `MOM` longtext,
  PRIMARY KEY (`IdRapat`),
  KEY `FK_tbl_rapat_tbl_pegawai` (`NIP`),
  CONSTRAINT `FK_tbl_rapat_tbl_pegawai` FOREIGN KEY (`NIP`) REFERENCES `tbl_pegawai` (`Nip`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table e-itenice.tbl_rapat: ~0 rows (approximately)
DELETE FROM `tbl_rapat`;
/*!40000 ALTER TABLE `tbl_rapat` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_rapat` ENABLE KEYS */;

-- Dumping structure for table e-itenice.tbl_sk
DROP TABLE IF EXISTS `tbl_sk`;
CREATE TABLE IF NOT EXISTS `tbl_sk` (
  `IdSK` varchar(5) NOT NULL,
  `Tema` varchar(200) DEFAULT NULL,
  `FileTemplate` varchar(50) DEFAULT NULL,
  `Input` longtext,
  `Role` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`IdSK`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table e-itenice.tbl_sk: ~14 rows (approximately)
DELETE FROM `tbl_sk`;
/*!40000 ALTER TABLE `tbl_sk` DISABLE KEYS */;
INSERT INTO `tbl_sk` (`IdSK`, `Tema`, `FileTemplate`, `Input`, `Role`) VALUES
	('1', 'sk admin', 'asd', '{"no_surat":{"type":"text","label":"no surat"},"tujuan":{"type":"array","label":"kepada"},"isi":{"type":"longText","label":"isi surat"}}', 'admin'),
	('10', 'Pemberian Tugas & Wewenang Dosen Pengampu', NULL, '{"no_surat":{"type":"text","label":"no surat"},"tujuan":{"type":"array","label":"kepada"},"isi":{"type":"longText","label":"isi surat"}}', 'fakultas'),
	('11', 'Penugasan Dosen Penguji Pada Ujian Tugas Akhir', NULL, '{"no_surat":{"type":"text","label":"no surat"},"tujuan":{"type":"array","label":"kepada"},"isi":{"type":"longText","label":"isi surat"}}', 'fakultas'),
	('12', 'Pemberian Tugas dan Wewenang mengajar', NULL, '{"no_surat":{"type":"text","label":"no surat"},"tujuan":{"type":"array","label":"kepada"},"isi":{"type":"longText","label":"isi surat"}}', 'fakultas'),
	('13', 'Pengangkatan Para Dosen-Kopembimbing Tugas Akhir', NULL, '{"no_surat":{"type":"text","label":"no surat"},"tujuan":{"type":"array","label":"kepada"},"isi":{"type":"longText","label":"isi surat"}}', 'fakultas'),
	('14', 'Penugasan Melaksanakan Penelitian', NULL, '{"no_surat":{"type":"text","label":"no surat"},"tujuan":{"type":"array","label":"kepada"},"isi":{"type":"longText","label":"isi surat"}}', 'jurusan'),
	('15', 'Penugasan Sebagai Tim Akreditasi', NULL, '{"no_surat":{"type":"text","label":"no surat"},"tujuan":{"type":"array","label":"kepada"},"isi":{"type":"longText","label":"isi surat"}}', 'jurusan'),
	('16', 'Penugasan Sebagai Reviewer Publikasi Untuk Jabatan Akademis', NULL, '{"no_surat":{"type":"text","label":"no surat"},"tujuan":{"type":"array","label":"kepada"},"isi":{"type":"longText","label":"isi surat"}}', 'jurusan'),
	('17', 'Penugasan Sebagai Redaksi Jurnal Jurusan ', NULL, '{"no_surat":{"type":"text","label":"no surat"},"tujuan":{"type":"array","label":"kepada"},"isi":{"type":"longText","label":"isi surat"}}', 'fakultas'),
	('18', 'Penugasan Sebagai Koordinator Kuliah Tamu', NULL, '{"no_surat":{"type":"text","label":"no surat"},"tujuan":{"type":"array","label":"kepada"},"isi":{"type":"longText","label":"isi surat"}}', 'fakultas'),
	('19', 'Penugasan Sebagai Koordinator Tim PKKM', NULL, '{"no_surat":{"type":"text","label":"no surat"},"tujuan":{"type":"array","label":"kepada"},"isi":{"type":"longText","label":"isi surat"}}', 'fakultas'),
	('2', 'sk dosen', 'asd', '{"no_surat":{"type":"text","label":"no surat"},"tujuan":{"type":"array","label":"kepada"},"isi":{"type":"longText","label":"isi surat"}}', 'dosen'),
	('20', 'Penugasan Melaksanakan PKM', NULL, '{"no_surat":{"type":"text","label":"no surat"},"tujuan":{"type":"array","label":"kepada"},"isi":{"type":"longText","label":"isi surat"}}', 'fakultas'),
	('21', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat Institut Teknologi Nasional', NULL, '{"no_surat":{"type":"text","label":"no surat"},"tujuan":{"type":"array","label":"kepada"},"isi":{"type":"longText","label":"isi surat"}}', 'dosen'),
	('22', 'Pelatihan', NULL, '{"no_surat":{"type":"text","label":"no surat"},"tujuan":{"type":"array","label":"kepada"},"isi":{"type":"longText","label":"isi surat"}}', 'rektor'),
	('23', 'Pelaksanaan Penelitian Dosen Muda', NULL, '{"no_surat":{"type":"text","label":"no surat"},"tujuan":{"type":"array","label":"kepada"},"isi":{"type":"longText","label":"isi surat"}}', 'rektor'),
	('24', 'Pembetukan Tim Auditor Internal', NULL, '{"no_surat":{"type":"text","label":"no surat"},"tujuan":{"type":"array","label":"kepada"},"isi":{"type":"longText","label":"isi surat"}}', 'rektor'),
	('3', 'Pelaksanaan Bimbingan Tugas Akhir', 'asd', '{"no_surat":{"type":"text","label":"no surat"},"tujuan":{"type":"array","label":"kepada"},"isi":{"type":"longText","label":"isi surat"}}', 'fakultas'),
	('4', 'sk rektor', 'asd', '{"no_surat":{"type":"text","label":"no surat"},"tujuan":{"type":"array","label":"kepada"},"isi":{"type":"longText","label":"isi surat"}}', 'rektor'),
	('5', 'sk jurusan', 'asd', '{"no_surat":{"type":"text","label":"no surat"},"tujuan":{"type":"array","label":"kepada"},"isi":{"type":"longText","label":"isi surat"}}', 'jurusan'),
	('6', 'sk dosen 2', 'asd', '{"no_surat":{"type":"text","label":"no surat"},"tujuan":{"type":"array","label":"kepada"},"isi":{"type":"longText","label":"isi surat"}}', 'dosen'),
	('7', 'Pengangkatan Para Dosen Penguji Ujian Tugas Akhir', NULL, '{"no_surat":{"type":"text","label":"no surat"},"tujuan":{"type":"array","label":"kepada"},"isi":{"type":"longText","label":"isi surat"}}', 'fakultas'),
	('8', 'Pengangkatan Dosen Pembimbing Kerja Praktik', NULL, '{"no_surat":{"type":"text","label":"no surat"},"tujuan":{"type":"array","label":"kepada"},"isi":{"type":"longText","label":"isi surat"}}', 'fakultas'),
	('9', 'Pengangkatan Dosen Pembimbing Tugas Akhir', NULL, '{"no_surat":{"type":"text","label":"no surat"},"tujuan":{"type":"array","label":"kepada"},"isi":{"type":"longText","label":"isi surat"}}', 'fakultas');
/*!40000 ALTER TABLE `tbl_sk` ENABLE KEYS */;

-- Dumping structure for table e-itenice.tbl_staff_departement
DROP TABLE IF EXISTS `tbl_staff_departement`;
CREATE TABLE IF NOT EXISTS `tbl_staff_departement` (
  `IdStaffDept` int(11) NOT NULL,
  `NIP` varchar(11) DEFAULT NULL,
  `idDepartement` int(11) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IdStaffDept`),
  KEY `FK_tbl_staff_departement_tbl_pegawai` (`NIP`),
  KEY `FK_tbl_staff_departement_tbl_department` (`idDepartement`),
  CONSTRAINT `FK_tbl_staff_departement_tbl_department` FOREIGN KEY (`idDepartement`) REFERENCES `tbl_department` (`idDepartment`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_staff_departement_tbl_pegawai` FOREIGN KEY (`NIP`) REFERENCES `tbl_pegawai` (`Nip`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table e-itenice.tbl_staff_departement: ~0 rows (approximately)
DELETE FROM `tbl_staff_departement`;
/*!40000 ALTER TABLE `tbl_staff_departement` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_staff_departement` ENABLE KEYS */;

-- Dumping structure for table e-itenice.tbl_staff_surat
DROP TABLE IF EXISTS `tbl_staff_surat`;
CREATE TABLE IF NOT EXISTS `tbl_staff_surat` (
  `IdStaffSurat` int(11) NOT NULL,
  `IdSurat` int(11) DEFAULT NULL,
  `NIP` varchar(11) DEFAULT NULL,
  `StatusSurat` enum('Y','N') DEFAULT NULL,
  PRIMARY KEY (`IdStaffSurat`),
  KEY `FK_tbl_staff_surat_tbl_pegawai` (`NIP`),
  KEY `FK_tbl_staff_surat_tbl_surat` (`IdSurat`),
  CONSTRAINT `FK_tbl_staff_surat_tbl_pegawai` FOREIGN KEY (`NIP`) REFERENCES `tbl_pegawai` (`Nip`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_staff_surat_tbl_surat` FOREIGN KEY (`IdSurat`) REFERENCES `tbl_surat` (`IdSurat`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table e-itenice.tbl_staff_surat: ~0 rows (approximately)
DELETE FROM `tbl_staff_surat`;
/*!40000 ALTER TABLE `tbl_staff_surat` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_staff_surat` ENABLE KEYS */;

-- Dumping structure for table e-itenice.tbl_surat
DROP TABLE IF EXISTS `tbl_surat`;
CREATE TABLE IF NOT EXISTS `tbl_surat` (
  `IdSurat` int(11) NOT NULL AUTO_INCREMENT,
  `IdSK` varchar(5) DEFAULT NULL,
  `NoSurat` varchar(50) DEFAULT NULL,
  `Topik` varchar(50) DEFAULT NULL,
  `TglDibuat` date DEFAULT NULL,
  `File` varchar(50) DEFAULT NULL,
  `Value` longtext,
  `Status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IdSurat`),
  KEY `FK_tbl_surat_tbl_sk` (`IdSK`),
  CONSTRAINT `FK_tbl_surat_tbl_sk` FOREIGN KEY (`IdSK`) REFERENCES `tbl_sk` (`IdSK`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table e-itenice.tbl_surat: ~0 rows (approximately)
DELETE FROM `tbl_surat`;
/*!40000 ALTER TABLE `tbl_surat` DISABLE KEYS */;
INSERT INTO `tbl_surat` (`IdSurat`, `IdSK`, `NoSurat`, `Topik`, `TglDibuat`, `File`, `Value`, `Status`) VALUES
	(1, '1', NULL, 'test', '2020-03-16', NULL, '{"no_surat":"asdasd","tujuan":["ujank","asep"],"isi":"asdapasdpaspd"}', NULL);
/*!40000 ALTER TABLE `tbl_surat` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
