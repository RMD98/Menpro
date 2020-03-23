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
  `id` int(11) NOT NULL COMMENT 'primary id akun',
  `NIP` varchar(11) DEFAULT NULL COMMENT 'NIP untuk foreign key ke tabel pegawai',
  `Username` varchar(50) DEFAULT NULL COMMENT 'Username yang digunakan untuk login',
  `Password` varchar(20) DEFAULT NULL COMMENT 'password yang digunakan untuk login',
  `Status` varchar(20) DEFAULT NULL COMMENT 'Status aktif akun',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `NIP` (`NIP`),
  CONSTRAINT `NIP` FOREIGN KEY (`NIP`) REFERENCES `tbl_pegawai` (`Nip`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabel untuk data akun digunakan pada proses login';

-- Dumping data for table e-itenice.tbl_account: ~6 rows (approximately)
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
  `idDepartment` int(11) NOT NULL COMMENT 'primary Id departement',
  `KodeDepartement` varchar(5) DEFAULT NULL COMMENT 'Kode departement yang digunakan dilapangan',
  `NamaDepartement` varchar(30) DEFAULT NULL COMMENT 'nama departement ',
  PRIMARY KEY (`idDepartment`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabel untuk data departement digunakan untuk detail data pegawai';

-- Dumping data for table e-itenice.tbl_department: ~2 rows (approximately)
DELETE FROM `tbl_department`;
/*!40000 ALTER TABLE `tbl_department` DISABLE KEYS */;
INSERT INTO `tbl_department` (`idDepartment`, `KodeDepartement`, `NamaDepartement`) VALUES
	(1, 'IF', 'Informatika'),
	(2, 'MS', 'Mesin'),
	(3, 'DKV', 'Desain dan Komunikasi Visual');
/*!40000 ALTER TABLE `tbl_department` ENABLE KEYS */;

-- Dumping structure for table e-itenice.tbl_matkul
DROP TABLE IF EXISTS `tbl_matkul`;
CREATE TABLE IF NOT EXISTS `tbl_matkul` (
  `id` varchar(50) NOT NULL COMMENT 'primary Id mata kuliah',
  `Kode` varchar(50) NOT NULL COMMENT 'Kode matakuliah',
  `Matakuliah` varchar(50) DEFAULT NULL COMMENT 'nama matakuliah ',
  `Jenis` varchar(50) DEFAULT NULL COMMENT 'responsi atau kelas',
  `SKS` varchar(50) DEFAULT NULL COMMENT 'total sks matakuliah',
  `JumlahKelas` varchar(50) DEFAULT NULL COMMENT 'jumlah kelas yang mengajar',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabel dummy untuk data mata kuliah digunakan pada proses pembuatan surat SK yang memiliki data matakuliah';

-- Dumping data for table e-itenice.tbl_matkul: ~4 rows (approximately)
DELETE FROM `tbl_matkul`;
/*!40000 ALTER TABLE `tbl_matkul` DISABLE KEYS */;
INSERT INTO `tbl_matkul` (`id`, `Kode`, `Matakuliah`, `Jenis`, `SKS`, `JumlahKelas`) VALUES
	('1', 'IFA-201', 'Basis Data', 'Kuliah', '3', '4'),
	('2', 'IFA-201', 'Basis Data', 'Responsi', '2', '4'),
	('3', 'IFA-355', 'Berpikir Kreatif', 'Kuliah', '2', '2'),
	('4', 'IFA-361', 'Basis Data Lanjut', 'Kuliah', '2', '1'),
	('5', 'IFA-403', 'Metodologi Penelitian', 'Kuliah', '2', '4');
/*!40000 ALTER TABLE `tbl_matkul` ENABLE KEYS */;

-- Dumping structure for table e-itenice.tbl_mhs
DROP TABLE IF EXISTS `tbl_mhs`;
CREATE TABLE IF NOT EXISTS `tbl_mhs` (
  `NRP` varchar(50) NOT NULL COMMENT 'Primary id mahasiswa',
  `Nama` varchar(50) DEFAULT NULL COMMENT 'nama mahasiswa',
  `Jurusan` varchar(50) DEFAULT NULL COMMENT 'jurusan mahasiswa',
  `TA` varchar(50) DEFAULT NULL COMMENT 'Judul Tugas Akhir',
  PRIMARY KEY (`NRP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabel dummy untuk data mahasiswa';

-- Dumping data for table e-itenice.tbl_mhs: ~2 rows (approximately)
DELETE FROM `tbl_mhs`;
/*!40000 ALTER TABLE `tbl_mhs` DISABLE KEYS */;
INSERT INTO `tbl_mhs` (`NRP`, `Nama`, `Jurusan`, `TA`) VALUES
	('152016111', 'dia', 'IF', 'implementasi ilmu santet pada smartcity'),
	('152016126', 'Aku', 'IF', 'implementasi metode usang menggunakan Delphi');
/*!40000 ALTER TABLE `tbl_mhs` ENABLE KEYS */;

-- Dumping structure for table e-itenice.tbl_pegawai
DROP TABLE IF EXISTS `tbl_pegawai`;
CREATE TABLE IF NOT EXISTS `tbl_pegawai` (
  `Nip` varchar(11) NOT NULL COMMENT 'primary Id Pegawai',
  `NamaPegawai` varchar(50) DEFAULT NULL COMMENT 'Nama pegawai',
  `TanggalLahir` date DEFAULT NULL COMMENT 'tanggal lahir pegawai',
  `TempatLahir` varchar(30) DEFAULT NULL COMMENT 'tempat lahir pegawai',
  `Alamat` longtext COMMENT 'alamat tinggal pegawai',
  `NoHP` varchar(15) DEFAULT NULL COMMENT 'No hp pegawai yang bisa di hubungi',
  `Email` varchar(30) DEFAULT NULL COMMENT 'email pegawai yang bisa dihubungi',
  `Aktif` enum('Y','N') DEFAULT NULL COMMENT 'status aktif pegawai',
  PRIMARY KEY (`Nip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabel untuk data pegawai digunakan untuk detail pegawai';

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
  `IdRapat` int(11) NOT NULL COMMENT 'Primary Id Rapat',
  `NIP` varchar(11) DEFAULT NULL COMMENT 'Pembuat rapat dan foreign key untuk pegawai',
  `TopikRapat` varchar(50) DEFAULT NULL COMMENT 'topik rapat',
  `TglMulai` date DEFAULT NULL COMMENT 'tanggal mulai rapat',
  `TglAkhir` date DEFAULT NULL COMMENT 'tanggal selesai rapat',
  `WaktuMulai` time DEFAULT NULL COMMENT 'waktu mulai rapat',
  `WaktuAkhir` time DEFAULT NULL COMMENT 'waktu selesai rapat',
  `MOM` longtext COMMENT 'MOM rapat',
  PRIMARY KEY (`IdRapat`),
  KEY `FK_tbl_rapat_tbl_pegawai` (`NIP`),
  CONSTRAINT `FK_tbl_rapat_tbl_pegawai` FOREIGN KEY (`NIP`) REFERENCES `tbl_pegawai` (`Nip`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabel untuk data rapat digunakan menyimpan data rapat';

-- Dumping data for table e-itenice.tbl_rapat: ~0 rows (approximately)
DELETE FROM `tbl_rapat`;
/*!40000 ALTER TABLE `tbl_rapat` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_rapat` ENABLE KEYS */;

-- Dumping structure for table e-itenice.tbl_sk
DROP TABLE IF EXISTS `tbl_sk`;
CREATE TABLE IF NOT EXISTS `tbl_sk` (
  `IdSK` varchar(5) NOT NULL COMMENT 'Primary Id Surat Keterangan',
  `Tema` varchar(200) DEFAULT NULL COMMENT 'Tema atau topik SK',
  `FileTemplate` varchar(50) DEFAULT NULL COMMENT 'letak file template SK untuk di download',
  `Input` longtext COMMENT 'jenis input yg digunakan pada SK tersebut',
  `Role` varchar(10) DEFAULT NULL COMMENT 'Role yang bisa akses sk',
  PRIMARY KEY (`IdSK`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabel untuk data info template surat digunakan pada proses pembuatan Surat';

-- Dumping data for table e-itenice.tbl_sk: ~23 rows (approximately)
DELETE FROM `tbl_sk`;
/*!40000 ALTER TABLE `tbl_sk` DISABLE KEYS */;
INSERT INTO `tbl_sk` (`IdSK`, `Tema`, `FileTemplate`, `Input`, `Role`) VALUES
	('1', 'sk admin', 'asd', '{"lokasi":{"type":"textSugestion","label":"Lokasi","source":"jurusan"},"tujuan":{"type":"array","label":"kepada","source":"dosen"},"isi":{"type":"longText","label":"isi surat"}}', 'admin'),
	('10', 'Pemberian Tugas & Wewenang Dosen Pengampu', NULL, '{"matkul":{"type":"array","label":"List Matakuliah","source":"matkul"}}', 'fakultas'),
	('11', 'Penugasan Dosen Penguji Pada Ujian Tugas Akhir', NULL, '{"penguji":{"type":"array","label":"List Penguji(ketua pertama)","source":"dosen"},"mhs":{"type":"text","label":"Nama Mahasiswa"},"judul":{"type":"text","label":"Judul TA"}}', 'fakultas'),
	('12', 'Pemberian Tugas dan Wewenang mengajar', NULL, '{"matkul":{"type":"array","label":"List Matakuliah","source":"matkul"}}', 'fakultas'),
	('13', 'Pengangkatan Para Dosen-Kopembimbing Tugas Akhir', NULL, '{"lokasi":{"type":"textSugestion","label":"Lokasi","source":"jurusan"},"tujuan":{"type":"array","label":"kepada","source":"dosen"},"isi":{"type":"longText","label":"isi surat"}}', 'fakultas'),
	('14', 'Penugasan Melaksanakan Penelitian', NULL, '{"dosen":{"type":"array","label":"List Dosen","source":"dosen"}}', 'jurusan'),
	('15', 'Penugasan Sebagai Tim Akreditasi', NULL, '{"dosen":{"type":"array","label":"List Dosen (ketua pertama)","source":"dosen"}}', 'jurusan'),
	('16', 'Penugasan Sebagai Reviewer Publikasi Untuk Jabatan Akademis', NULL, '{"dosen":{"type":"array","label":"List Dosen","source":"dosen"}}', 'jurusan'),
	('17', 'Penugasan Sebagai Redaksi Jurnal Jurusan ', NULL, '{"dosen":{"type":"array","label":"List Dosen (ketua pertama)","source":"dosen"}}', 'fakultas'),
	('18', 'Penugasan Sebagai Koordinator Kuliah Tamu', NULL, '{"dosen":{"type":"textSugestion","label":"List Dosen","source":"dosen"}}', 'fakultas'),
	('19', 'Penugasan Sebagai Koordinator Tim PKKM', NULL, '{"dosen":{"type":"textSugestion","label":"List Dosen","source":"dosen"}}', 'fakultas'),
	('2', 'sk dosen', 'asd', '{"lokasi":{"type":"textSugestion","label":"Lokasi","source":"jurusan"},"tujuan":{"type":"array","label":"kepada","source":"dosen"},"isi":{"type":"longText","label":"isi surat"}}', 'dosen'),
	('20', 'Penugasan Melaksanakan PKM', NULL, '{"dosen":{"type":"array","label":"List Dosen","source":"dosen"}}', 'fakultas'),
	('21', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat Institut Teknologi Nasional', NULL, '{"dosen":{"type":"textSugestion","label":"Nama Dosen","source":"dosen"},"kegiatan":{"type":"text","label":"Nama Kegiatan"},"lokasi":{"type":"text","label":"Lokasi Kegiatan"},"waktuMulai":{"type":"datePicker","label":"Waktu Mulai"},"waktuSelesai":{"type":"datePicker","label":"Waktu Selesai"},"sumberDana":{"type":"text","label":"Sumber Dana"}}', 'dosen'),
	('22', 'Pelatihan', NULL, '{"lokasi":{"type":"textSugestion","label":"Lokasi","source":"jurusan"},"tujuan":{"type":"array","label":"kepada","source":"dosen"},"isi":{"type":"longText","label":"isi surat"}}', 'rektor'),
	('23', 'Pelaksanaan Penelitian Dosen Muda', NULL, '{"lokasi":{"type":"textSugestion","label":"Lokasi","source":"jurusan"},"tujuan":{"type":"array","label":"kepada","source":"dosen"},"isi":{"type":"longText","label":"isi surat"}}', 'rektor'),
	('24', 'Pembetukan Tim Auditor Internal', NULL, '{"lokasi":{"type":"textSugestion","label":"Lokasi","source":"jurusan"},"tujuan":{"type":"array","label":"kepada","source":"dosen"},"isi":{"type":"longText","label":"isi surat"}}', 'rektor'),
	('25', 'Surat Keluar', NULL, '{"lokasi":{"type":"textSugestion","label":"Lokasi","source":"jurusan"},"tujuan":{"type":"array","label":"kepada","source":"dosen"},"isi":{"type":"longText","label":"isi surat"}}', 'admin'),
	('26', 'Surat Masuk', NULL, '{"lokasi":{"type":"textSugestion","label":"Lokasi","source":"jurusan"},"tujuan":{"type":"array","label":"kepada","source":"dosen"},"isi":{"type":"longText","label":"isi surat"}}', 'admin'),
	('3', 'Pelaksanaan Bimbingan Tugas Akhir', 'asd', '{"NamaDosen":{"type":"textSugestion","label":"Nama Dosen Pembimbing","source":"dosen"},"NamaMahasiswa":{"type":"text","label":"Nama Mahasiswa"},"NRP":{"type":"text","label":"NRP"},"Jurusan":{"type":"textSugestion","label":"Jurusan","source":"jurusan"},"JudulTA":{"type":"text","label":"Judul TA"}}', 'fakultas'),
	('4', 'sk rektor', 'asd', '{"lokasi":{"type":"textSugestion","label":"Lokasi","source":"jurusan"},"tujuan":{"type":"array","label":"kepada","source":"dosen"},"isi":{"type":"longText","label":"isi surat"}}', 'rektor'),
	('5', 'sk jurusan', 'asd', '{"lokasi":{"type":"textSugestion","label":"Lokasi","source":"jurusan"},"tujuan":{"type":"array","label":"kepada","source":"dosen"},"isi":{"type":"longText","label":"isi surat"}}', 'jurusan'),
	('6', 'sk dosen 2', 'asd', '{"lokasi":{"type":"textSugestion","label":"Lokasi","source":"jurusan"},"tujuan":{"type":"array","label":"kepada","source":"dosen"},"isi":{"type":"longText","label":"isi surat"}}', 'dosen'),
	('7', 'Pengangkatan Para Dosen Penguji Ujian Tugas Akhir', NULL, '{"lokasi":{"type":"textSugestion","label":"Lokasi","source":"jurusan"},"tujuan":{"type":"array","label":"kepada","source":"dosen"},"isi":{"type":"longText","label":"isi surat"}}', 'fakultas'),
	('8', 'Pengangkatan Dosen Pembimbing Kerja Praktik', NULL, '{"lokasi":{"type":"textSugestion","label":"Lokasi","source":"jurusan"},"tujuan":{"type":"array","label":"kepada","source":"dosen"},"isi":{"type":"longText","label":"isi surat"}}', 'fakultas'),
	('9', 'Pengangkatan Dosen Pembimbing Tugas Akhir', NULL, '{"lokasi":{"type":"textSugestion","label":"Lokasi","source":"jurusan"},"tujuan":{"type":"array","label":"kepada","source":"dosen"},"isi":{"type":"longText","label":"isi surat"}}', 'fakultas');
/*!40000 ALTER TABLE `tbl_sk` ENABLE KEYS */;

-- Dumping structure for table e-itenice.tbl_staff_departement
DROP TABLE IF EXISTS `tbl_staff_departement`;
CREATE TABLE IF NOT EXISTS `tbl_staff_departement` (
  `IdStaffDept` int(11) NOT NULL COMMENT 'primary id staff departement',
  `NIP` varchar(11) DEFAULT NULL COMMENT 'foreign key untuk tabel pegawai',
  `idDepartement` int(11) DEFAULT NULL COMMENT 'foreign key untuk tabel departement',
  `jabatan` varchar(50) DEFAULT NULL COMMENT 'jabatan pegawai',
  PRIMARY KEY (`IdStaffDept`),
  KEY `FK_tbl_staff_departement_tbl_pegawai` (`NIP`),
  KEY `FK_tbl_staff_departement_tbl_department` (`idDepartement`),
  CONSTRAINT `FK_tbl_staff_departement_tbl_department` FOREIGN KEY (`idDepartement`) REFERENCES `tbl_department` (`idDepartment`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_staff_departement_tbl_pegawai` FOREIGN KEY (`NIP`) REFERENCES `tbl_pegawai` (`Nip`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabel untuk detail data departement dan pegawai digunakan untuk menghubungkan pegawai dengan departement';

-- Dumping data for table e-itenice.tbl_staff_departement: ~1 rows (approximately)
DELETE FROM `tbl_staff_departement`;
/*!40000 ALTER TABLE `tbl_staff_departement` DISABLE KEYS */;
INSERT INTO `tbl_staff_departement` (`IdStaffDept`, `NIP`, `idDepartement`, `jabatan`) VALUES
	(1, '1', 1, 'Dosen'),
	(2, '2', 1, 'Kajur');
/*!40000 ALTER TABLE `tbl_staff_departement` ENABLE KEYS */;

-- Dumping structure for table e-itenice.tbl_staff_surat
DROP TABLE IF EXISTS `tbl_staff_surat`;
CREATE TABLE IF NOT EXISTS `tbl_staff_surat` (
  `IdStaffSurat` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary id staff surat',
  `IdSurat` int(11) DEFAULT NULL COMMENT 'Id Surat ',
  `NIP` varchar(11) DEFAULT NULL COMMENT 'penghubung table pegawai',
  `StatusSurat` enum('Y','N') DEFAULT NULL COMMENT 'Status terkirim surat',
  PRIMARY KEY (`IdStaffSurat`),
  KEY `FK_tbl_staff_surat_tbl_pegawai` (`NIP`),
  KEY `FK_tbl_staff_surat_tbl_surat` (`IdSurat`),
  CONSTRAINT `FK_tbl_staff_surat_tbl_pegawai` FOREIGN KEY (`NIP`) REFERENCES `tbl_pegawai` (`Nip`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_staff_surat_tbl_surat` FOREIGN KEY (`IdSurat`) REFERENCES `tbl_surat` (`IdSurat`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='Tabel untuk data tujuan surat digunakan untuk detail surat';

-- Dumping data for table e-itenice.tbl_staff_surat: ~2 rows (approximately)
DELETE FROM `tbl_staff_surat`;
/*!40000 ALTER TABLE `tbl_staff_surat` DISABLE KEYS */;
INSERT INTO `tbl_staff_surat` (`IdStaffSurat`, `IdSurat`, `NIP`, `StatusSurat`) VALUES
	(1, 13, '1', 'Y'),
	(2, 13, '2', 'N');
/*!40000 ALTER TABLE `tbl_staff_surat` ENABLE KEYS */;

-- Dumping structure for table e-itenice.tbl_surat
DROP TABLE IF EXISTS `tbl_surat`;
CREATE TABLE IF NOT EXISTS `tbl_surat` (
  `IdSurat` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary id surat',
  `IdSK` varchar(5) DEFAULT NULL COMMENT 'penghubung dengan tabel SK',
  `NoSurat` varchar(50) DEFAULT NULL COMMENT 'No Surat',
  `Topik` varchar(50) DEFAULT NULL COMMENT 'topik atau tema surat',
  `TglDibuat` date DEFAULT NULL COMMENT 'tanggal dibuat surat',
  `File` varchar(50) DEFAULT NULL COMMENT 'file ketika surat sudah di bentuk, untuk kebutuhan download',
  `Value` longtext COMMENT 'berupa jenis input dan data yang sudah diinputkan user',
  `Status` varchar(50) DEFAULT NULL COMMENT 'status terkirim surat',
  PRIMARY KEY (`IdSurat`),
  KEY `FK_tbl_surat_tbl_sk` (`IdSK`),
  CONSTRAINT `FK_tbl_surat_tbl_sk` FOREIGN KEY (`IdSK`) REFERENCES `tbl_sk` (`IdSK`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COMMENT='Tabel untuk data surat digunakan untuk menyimpan data surat';

-- Dumping data for table e-itenice.tbl_surat: ~18 rows (approximately)
DELETE FROM `tbl_surat`;
/*!40000 ALTER TABLE `tbl_surat` DISABLE KEYS */;
INSERT INTO `tbl_surat` (`IdSurat`, `IdSK`, `NoSurat`, `Topik`, `TglDibuat`, `File`, `Value`, `Status`) VALUES
	(1, '1', 'asd', 'test', '2020-03-16', NULL, '{"no_surat":"asdasd","tujuan":["ujank","asep"],"isi":"asdapasdpaspd"}', NULL),
	(2, '1', NULL, 'test', '2020-03-17', NULL, '{"no_surat":"","isi":""}', NULL),
	(3, '1', NULL, 'test', '2020-03-17', NULL, '{"no_surat":"","isi":""}', NULL),
	(4, '1', NULL, 'test', '2020-03-17', NULL, '{"no_surat":"123","tujuan":["ujank"],"isi":"asdasd"}', NULL),
	(5, '2', NULL, 'test', '2020-03-17', NULL, '{"no_surat":"12313","tujuan":["ujank"],"isi":"asdasdad"}', NULL),
	(6, '21', NULL, 'test', '2020-03-17', NULL, '{"no_surat":"asdsad","tujuan":["ujank","asep"],"isi":"asdsadas"}', NULL),
	(7, '1', NULL, 'test', '2020-03-17', NULL, '{"isi":""}', NULL),
	(8, '21', NULL, 'test', '2020-03-17', NULL, '{"lokasi":"","isi":""}', NULL),
	(9, '21', 'test', 'test', '2020-03-17', NULL, '{"lokasi":["Desain dan Komunikasi Visual"],"tujuan":["ujank","asep"],"isi":"asdsadas"}', NULL),
	(10, '11', 'test', 'Penugasan Dosen Penguji Pada Ujian Tugas Akhir', '2020-03-17', NULL, '{"penguji":["ujank","asep"],"mhs":"asd","judul":"asdasdasd"}', NULL),
	(11, '21', 'test', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-03-19', NULL, '{"dosen":["ujank"],"kegiatan":"","lokasi":"","sumberDana":""}', NULL),
	(12, '23', 'test', 'Pelaksanaan Penelitian Dosen Muda', '2020-03-19', NULL, '{"lokasi":["Mesin"],"isi":""}', NULL),
	(13, '25', 'test', 'Surat Keluar', '2020-03-19', NULL, '{"lokasi":["Informatika"],"isi":""}', NULL),
	(14, '26', 'test', 'Surat Masuk', '2020-03-19', NULL, '{"lokasi":["Informatika"],"isi":""}', NULL),
	(15, '25', 'test', 'Surat Keluar', '2020-03-19', NULL, '{"lokasi":["Informatika"],"isi":""}', NULL),
	(16, '25', 'test', 'Surat Keluar', '2020-03-19', NULL, '{"lokasi":["Informatika"],"isi":""}', NULL),
	(17, '21', 'test', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-03-23', NULL, '{"dosen":["ujank"],"kegiatan":"asd","lokasi":"asd","sumberDana":"asd"}', NULL),
	(18, '26', 'test', 'Surat Masuk', '2020-03-23', NULL, '{"lokasi":["Informatika"],"tujuan":["asep"],"isi":"asdasd"}', NULL),
	(19, '15', 'test', 'Penugasan Sebagai Tim Akreditasi', '2020-03-23', NULL, '{"dosen":["ujank","asep"]}', NULL);
/*!40000 ALTER TABLE `tbl_surat` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
