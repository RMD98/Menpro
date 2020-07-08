/*
 Navicat Premium Data Transfer

 Source Server         : rumah
 Source Server Type    : MySQL
 Source Server Version : 50719
 Source Host           : localhost:3306
 Source Schema         : e-itenice

 Target Server Type    : MySQL
 Target Server Version : 50719
 File Encoding         : 65001

 Date: 07/07/2020 05:57:34
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_account
-- ----------------------------
DROP TABLE IF EXISTS `tbl_account`;
CREATE TABLE `tbl_account`  (
  `id` int(11) NOT NULL COMMENT 'primary id akun',
  `NIP` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'NIP untuk foreign key ke tabel pegawai',
  `Username` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'Username yang digunakan untuk login',
  `Password` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'password yang digunakan untuk login',
  `Status` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'Status aktif akun',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `NIP`(`NIP`) USING BTREE,
  CONSTRAINT `NIP` FOREIGN KEY (`NIP`) REFERENCES `tbl_pegawai` (`Nip`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Tabel untuk data akun digunakan pada proses login' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_account
-- ----------------------------
INSERT INTO `tbl_account` VALUES (1, '1', 'admin', '1', 'admin');
INSERT INTO `tbl_account` VALUES (2, '2', 'rektor', '1', 'rektor');
INSERT INTO `tbl_account` VALUES (3, '1', 'dosen', '1', 'dosen');
INSERT INTO `tbl_account` VALUES (4, '2', 'FAKULTAS TEKNIK INDUSTRI', '1', 'fakultas');
INSERT INTO `tbl_account` VALUES (5, '2', 'jurusan', '1', 'jurusan');
INSERT INTO `tbl_account` VALUES (6, '1', 'ekspedisi', '1', 'ekspedisi');

-- ----------------------------
-- Table structure for tbl_department
-- ----------------------------
DROP TABLE IF EXISTS `tbl_department`;
CREATE TABLE `tbl_department`  (
  `idDepartment` int(11) NOT NULL COMMENT 'primary Id departement',
  `KodeDepartement` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'Kode departement yang digunakan dilapangan',
  `NamaDepartement` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'nama departement ',
  PRIMARY KEY (`idDepartment`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Tabel untuk data departement digunakan untuk detail data pegawai' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_department
-- ----------------------------
INSERT INTO `tbl_department` VALUES (1, 'IF', 'INFORMATIKA');
INSERT INTO `tbl_department` VALUES (2, 'MS', 'MESIN');
INSERT INTO `tbl_department` VALUES (3, 'DKV', 'Desain dan Komunikasi Visual');

-- ----------------------------
-- Table structure for tbl_matkul
-- ----------------------------
DROP TABLE IF EXISTS `tbl_matkul`;
CREATE TABLE `tbl_matkul`  (
  `id` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT 'primary Id mata kuliah',
  `Kode` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT 'Kode matakuliah',
  `Matakuliah` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'nama matakuliah ',
  `Jenis` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'responsi atau kelas',
  `SKS` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'total sks matakuliah',
  `JumlahKelas` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'jumlah kelas yang mengajar',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Tabel dummy untuk data mata kuliah digunakan pada proses pembuatan surat SK yang memiliki data matakuliah' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_matkul
-- ----------------------------
INSERT INTO `tbl_matkul` VALUES ('1', 'IFA-201', 'Basis Data', 'Kuliah', '3', '4');
INSERT INTO `tbl_matkul` VALUES ('2', 'IFA-201', 'Basis Data', 'Responsi', '2', '4');
INSERT INTO `tbl_matkul` VALUES ('3', 'IFA-355', 'Berpikir Kreatif', 'Kuliah', '2', '2');
INSERT INTO `tbl_matkul` VALUES ('4', 'IFA-361', 'Basis Data Lanjut', 'Kuliah', '2', '1');
INSERT INTO `tbl_matkul` VALUES ('5', 'IFA-403', 'Metodologi Penelitian', 'Kuliah', '2', '4');

-- ----------------------------
-- Table structure for tbl_mhs
-- ----------------------------
DROP TABLE IF EXISTS `tbl_mhs`;
CREATE TABLE `tbl_mhs`  (
  `NRP` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT 'Primary id mahasiswa',
  `Nama` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'nama mahasiswa',
  `Jurusan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'jurusan mahasiswa',
  `TA` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'Judul Tugas Akhir',
  PRIMARY KEY (`NRP`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Tabel dummy untuk data mahasiswa' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_mhs
-- ----------------------------
INSERT INTO `tbl_mhs` VALUES ('152016111', 'dia', 'IF', 'implementasi ilmu santet pada smartcity');
INSERT INTO `tbl_mhs` VALUES ('152016126', 'Aku', 'IF', 'implementasi metode usang menggunakan Delphi');

-- ----------------------------
-- Table structure for tbl_pegawai
-- ----------------------------
DROP TABLE IF EXISTS `tbl_pegawai`;
CREATE TABLE `tbl_pegawai`  (
  `Nip` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT 'primary Id Pegawai',
  `NamaPegawai` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'Nama pegawai',
  `TanggalLahir` date NULL DEFAULT NULL COMMENT 'tanggal lahir pegawai',
  `TempatLahir` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'tempat lahir pegawai',
  `Alamat` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL COMMENT 'alamat tinggal pegawai',
  `NoHP` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'No hp pegawai yang bisa di hubungi',
  `Email` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'email pegawai yang bisa dihubungi',
  `Aktif` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'status aktif pegawai',
  `TTD` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Nip`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Tabel untuk data pegawai digunakan untuk detail pegawai' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_pegawai
-- ----------------------------
INSERT INTO `tbl_pegawai` VALUES ('1', 'ujank', '2020-03-16', 'bandung', 'kircon', '092', 'asd@asd.asd', 'Y', 'img/ttd/ujank.jpg');
INSERT INTO `tbl_pegawai` VALUES ('2', 'fredi', '2020-03-16', 'bandung', 'kircon', '092', 'asd@asd.asd', 'Y', 'img/ttd/fredi.jpg');
INSERT INTO `tbl_pegawai` VALUES ('3', 'dadang', '2020-03-16', 'Bandung', 'kircon', '000', 'asd@asd.asd', 'Y', 'img/ttd/dadang.jpg');

-- ----------------------------
-- Table structure for tbl_rapat
-- ----------------------------
DROP TABLE IF EXISTS `tbl_rapat`;
CREATE TABLE `tbl_rapat`  (
  `IdRapat` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Id Rapat',
  `NIP` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'Pembuat rapat dan foreign key untuk pegawai',
  `TopikRapat` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'topik rapat',
  `TglMulai` date NULL DEFAULT NULL COMMENT 'tanggal mulai rapat',
  `TglAkhir` date NULL DEFAULT NULL COMMENT 'tanggal selesai rapat',
  `WaktuMulai` time(0) NULL DEFAULT NULL COMMENT 'waktu mulai rapat',
  `WaktuAkhir` time(0) NULL DEFAULT NULL COMMENT 'waktu selesai rapat',
  `MOM` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL COMMENT 'MOM rapat',
  `IdSurat` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`IdRapat`) USING BTREE,
  INDEX `FK_tbl_rapat_tbl_pegawai`(`NIP`) USING BTREE,
  INDEX `FK`(`IdSurat`) USING BTREE,
  CONSTRAINT `FK` FOREIGN KEY (`IdSurat`) REFERENCES `tbl_staff_surat` (`IdSurat`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_rapat_tbl_pegawai` FOREIGN KEY (`NIP`) REFERENCES `tbl_pegawai` (`Nip`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Tabel untuk data rapat digunakan menyimpan data rapat' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_rapat
-- ----------------------------
INSERT INTO `tbl_rapat` VALUES (1, '1', 'test rapat', '2020-06-16', '2020-06-16', '11:30:00', '11:35:00', '-', NULL);
INSERT INTO `tbl_rapat` VALUES (2, '1', 'pembentukan divisi pembasmian ', '2020-06-23', '2020-06-24', '02:25:00', '02:30:00', 'diharapkan hadir 10 menit sebelum mulai', NULL);
INSERT INTO `tbl_rapat` VALUES (3, '1', 'test rapat', '2020-06-26', '2020-06-27', '11:35:00', '03:35:00', '', NULL);
INSERT INTO `tbl_rapat` VALUES (4, '1', 'test ', '2020-06-16', '2020-06-16', '11:35:00', '11:35:00', 'asd', NULL);
INSERT INTO `tbl_rapat` VALUES (5, '2', 'asd', '2020-06-30', '2020-06-30', '03:24:00', '03:35:00', 'asd', NULL);
INSERT INTO `tbl_rapat` VALUES (6, '1', '', '2020-06-30', '2020-06-30', '00:00:00', '00:00:00', '', NULL);
INSERT INTO `tbl_rapat` VALUES (7, '1', '', '2020-06-30', '2020-06-30', '00:00:00', '00:00:00', '', NULL);
INSERT INTO `tbl_rapat` VALUES (8, '1', '', '2020-06-30', '2020-06-30', '00:00:00', '00:00:00', '', NULL);
INSERT INTO `tbl_rapat` VALUES (9, '1', 'test rapat', '2020-06-30', '2020-06-30', '11:35:00', '08:35:00', 'test', NULL);

-- ----------------------------
-- Table structure for tbl_sk
-- ----------------------------
DROP TABLE IF EXISTS `tbl_sk`;
CREATE TABLE `tbl_sk`  (
  `IdSK` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT 'Primary Id Surat Keterangan',
  `Tema` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'Tema atau topik SK',
  `FileTemplate` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'letak file template SK untuk di download',
  `Input` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL COMMENT 'jenis input yg digunakan pada SK tersebut',
  `Role` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'Role yang bisa akses sk',
  `Parameter` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'parameter isi dari word yang akan di overide',
  PRIMARY KEY (`IdSK`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Tabel untuk data info template surat digunakan pada proses pembuatan Surat' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_sk
-- ----------------------------
INSERT INTO `tbl_sk` VALUES ('1', 'sk admin', 'asd', '{\"lokasi\":{\"type\":\"textSugestion\",\"label\":\"Lokasi\",\"source\":\"jurusan\"},\"tujuan\":{\"type\":\"array\",\"label\":\"kepada\",\"source\":\"dosen\"},\"isi\":{\"type\":\"longText\",\"label\":\"isi surat\"}}', 'admin', NULL);
INSERT INTO `tbl_sk` VALUES ('10', 'Pemberian Tugas & Wewenang Dosen Pengampu', 'fakultas_Pemberian_Tugas_Dosen_Pengampu.docx', '{\"dosenSurat\":{\"type\":\"textSugestion\",\"label\":\"Nama Dosen\",\"source\":\"dosen\"},\"matkul\":{\"type\":\"array\",\"label\":\"List Matakuliah\",\"source\":\"matkul\"}}', 'fakultas', '{\"pembuat\":\"validasi\",\"nipPembuat\":\"NIP\",\"JenisSurat\":\"jenis\",\"No\":\"test\",\"date\":\"d-m-Y\",\"thn\":\"Y\",\"Departement\":\"NamaDepartement\",\"username\":\"Username\",\"nipSurat\":\"NipSurat\",\"dosenSurat\":\"dosenSurat\",\"arrayofMatkul\":\"test\",\"ttd\":\"TTD\"}');
INSERT INTO `tbl_sk` VALUES ('11', 'Penugasan Dosen Penguji Pada Ujian Tugas Akhir', 'fakultas_Penugasan_Sebagai_Penguji.docx', '{\"ketuaDosen\":{\"type\":\"textSugestion\",\"label\":\"Ketua\",\"source\":\"dosen\"},\"dosen\":{\"type\":\"array\",\"label\":\"List Penguji(ketua pertama)\",\"source\":\"dosen\"},\"mhs\":{\"type\":\"text\",\"label\":\"Nama Mahasiswa\"},\"judul\":{\"type\":\"text\",\"label\":\"Judul TA\"},\"waktu\":{\"type\":\"datePicker\",\"label\":\"Waktu uji\",\"name\":\"tanggal\"},\"Nrp\":{\"type\":\"text\",\"label\":\"NRP\"}}', 'fakultas', '{\"pembuat\":\"validasi\",\"nipPembuat\":\"NIP\",\"JenisSurat\":\"jenis\",\"Username\":\"Username\",\"No\":\"test\",\"date\":\"d-m-Y\",\"thn\":\"Y\",\"Departement\":\"NamaDepartement\",\"arrayofDosen\":\"test\",\"ketuaDosen\":\"ketuaDosen\",\"Mahasiswa\":\"mhs\",\"NIM\":\"Nrp\",\"waktu\":\"waktu\",\"judul\":\"judul\",\"ttd\":\"TTD\"}');
INSERT INTO `tbl_sk` VALUES ('12', 'Pemberian Tugas dan Wewenang mengajar', 'fakultas_pemberian_tugas_mengajar.docx', '{\"dosenSurat\":{\"type\":\"textSugestion\",\"label\":\"Nama Dosen\",\"source\":\"dosen\"},\"matkul\":{\"type\":\"array\",\"label\":\"List Matakuliah\",\"source\":\"matkul\"}}', 'fakultas', '{\"pembuat\":\"validasi\",\"nipPembuat\":\"NIP\",\"JenisSurat\":\"jenis\",\"No\":\"test\",\"date\":\"d-m-Y\",\"thn\":\"Y\",\"Departement\":\"NamaDepartement\",\"username\":\"Username\",\"nipSurat\":\"NipSurat\",\"dosenSurat\":\"dosenSurat\",\"arrayofMatkul\":\"test\",\"ttd\":\"TTD\"}');
INSERT INTO `tbl_sk` VALUES ('13', 'Pengangkatan Para Dosen-Kopembimbing Tugas Akhir', NULL, '{\"lokasi\":{\"type\":\"textSugestion\",\"label\":\"Lokasi\",\"source\":\"jurusan\"},\"tujuan\":{\"type\":\"array\",\"label\":\"kepada\",\"source\":\"dosen\"},\"isi\":{\"type\":\"longText\",\"label\":\"isi surat\"}}', 'fakultas', NULL);
INSERT INTO `tbl_sk` VALUES ('14', 'Penugasan Melaksanakan Penelitian', 'jurusan_Penugasan Melaksanakan Penelitian.docx', '{\"dosen\":{\"type\":\"array\",\"label\":\"List Dosen\",\"source\":\"dosen\"}}', 'jurusan', '{\"pembuat\":\"validasi\",\"nipPembuat\":\"NIP\",\"JenisSurat\":\"jenis\",\"No\":\"test\",\"date\":\"d-m-Y\",\"thn\":\"Y\",\"Departement\":\"NamaDepartement\",\"arrayofDosen\":\"test\",\"ttd\":\"TTD\"}');
INSERT INTO `tbl_sk` VALUES ('15', 'Penugasan Sebagai Tim Akreditasi', 'jurusan_Penugasan Sebagai Tim Akreditasi.docx', '{\"ketuaDosen\":{\"type\":\"textSugestion\",\"label\":\"Ketua\",\"source\":\"dosen\"},\"dosen\":{\"type\":\"array\",\"label\":\"Anggota\",\"source\":\"dosen\"}}', 'jurusan', '{\"pembuat\":\"validasi\",\"nipPembuat\":\"NIP\",\"JenisSurat\":\"jenis\",\"No\":\"test\",\"date\":\"d-m-Y\",\"thn\":\"Y\",\"Departement\":\"NamaDepartement\",\"arrayofDosen\":\"test\",\"ketuaDosen\":\"ketuaDosen\",\"ttd\":\"TTD\"}');
INSERT INTO `tbl_sk` VALUES ('16', 'Penugasan Sebagai Reviewer Publikasi Untuk Jabatan Akademis', 'jurusan_Penugasan Sebagai Reviewer Publikasi.docx', '{\"dosen\":{\"type\":\"array\",\"label\":\"List Dosen\",\"source\":\"dosen\"}}', 'jurusan', '{\"pembuat\":\"validasi\",\"nipPembuat\":\"NIP\",\"JenisSurat\":\"jenis\",\"No\":\"test\",\"date\":\"d-m-Y\",\"thn\":\"Y\",\"Departement\":\"NamaDepartement\",\"arrayofDosen\":\"test\",\"ttd\":\"TTD\"}');
INSERT INTO `tbl_sk` VALUES ('17', 'Penugasan Sebagai Redaksi Jurnal Jurusan ', NULL, '{\"dosen\":{\"type\":\"array\",\"label\":\"List Dosen (ketua pertama)\",\"source\":\"dosen\"}}', 'fakultas', NULL);
INSERT INTO `tbl_sk` VALUES ('18', 'Penugasan Sebagai Koordinator Kuliah Tamu', NULL, '{\"dosen\":{\"type\":\"textSugestion\",\"label\":\"List Dosen\",\"source\":\"dosen\"}}', 'fakultas', NULL);
INSERT INTO `tbl_sk` VALUES ('19', 'Penugasan Sebagai Koordinator Tim PKKM', NULL, '{\"dosen\":{\"type\":\"textSugestion\",\"label\":\"List Dosen\",\"source\":\"dosen\"}}', 'fakultas', NULL);
INSERT INTO `tbl_sk` VALUES ('2', 'sk dosen', 'fakultas_BimbinganTugasAkhir.docx', '{\"lokasi\":{\"type\":\"textSugestion\",\"label\":\"Lokasi\",\"source\":\"jurusan\"},\"tujuan\":{\"type\":\"array\",\"label\":\"kepada\",\"source\":\"dosen\"},\"isi\":{\"type\":\"longText\",\"label\":\"isi surat\"}}', 'admin', NULL);
INSERT INTO `tbl_sk` VALUES ('20', 'Penugasan Melaksanakan PKM', NULL, '{\"dosen\":{\"type\":\"array\",\"label\":\"List Dosen\",\"source\":\"dosen\"}}', 'fakultas', NULL);
INSERT INTO `tbl_sk` VALUES ('21', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat Institut Teknologi Nasional', 'lppkm_pkm.docx', '{\"dosenSurat\":{\"type\":\"textSugestion\",\"label\":\"Nama Dosen\",\"source\":\"dosen\"},\"kegiatan\":{\"type\":\"text\",\"label\":\"Nama Kegiatan\"},\"jabatan\":{\"type\":\"text\",\"label\":\"Jabatan\"},\"lokasi\":{\"type\":\"text\",\"label\":\"Lokasi Kegiatan\"},\"waktu\":{\"type\":\"datePicker\",\"label\":\"Waktu Mulai - Selesai\",\"name\":\"rangeTanggal\"},\"sumberDana\":{\"type\":\"text\",\"label\":\"Sumber Dana\"}}', 'dosen', '{\"JenisSurat\":\"jenis\",\"No\":\"test\",\"thn\":\"Y\",\"Departement\":\"NamaDepartement\",\"dosen\":\"dosenSurat\",\"NIP\":\"NIP\",\"jabatan\":\"jabatan\",\"kegiatan\":\"kegiatan\",\"tempat\":\"lokasi\",\"waktuKegiatan\":\"waktu\",\"dana\":\"sumberDana\",\"pembuat\":\"validasi\",\"NIP\":\"NipSurat\",\"nipPembuat\":\"NIP\",\"date\":\"d-m-Y\",\"ttd\":\"TTD\"}');
INSERT INTO `tbl_sk` VALUES ('22', 'Pelatihan', NULL, '{\"lokasi\":{\"type\":\"textSugestion\",\"label\":\"Lokasi\",\"source\":\"jurusan\"},\"tujuan\":{\"type\":\"array\",\"label\":\"kepada\",\"source\":\"dosen\"},\"isi\":{\"type\":\"longText\",\"label\":\"isi surat\"}}', 'rektor', NULL);
INSERT INTO `tbl_sk` VALUES ('23', 'Pelaksanaan Penelitian Dosen Muda', 'Rektor_pelatihan dosen muda.docx', '{\"judul\":{\"type\":\"text\",\"label\":\"Judul\"},\"pimpinan\":{\"type\":\"textSugestion\",\"label\":\"pimpinan\",\"source\":\"dosen\"},\"rekan\":{\"type\":\"textSugestion\",\"label\":\"rekan\",\"source\":\"dosen\"},\"dana\":{\"type\":\"text\",\"label\":\"Dana\"},\"waktu\":{\"type\":\"datePicker\",\"label\":\"Waktu Rapat\",\"name\":\"tanggal\"}}', 'rektor', '{\"pembuat\":\"validasi\",\"nipPembuat\":\"NIP\",\"JenisSurat\":\"jenis\",\"No\":\"test\",\"date\":\"d-m-Y\",\"thn\":\"Y\",\"waktu\":\"waktu\",\"pimpinan\":\"pimpinan\",\"rekan\":\"rekan\",\"dana\":\"dana\",\"Departement\":\"NamaDepartement\",\"judul\":\"judul\",\"ttd\":\"TTD\"}');
INSERT INTO `tbl_sk` VALUES ('24', 'Pembetukan Tim Auditor Internal', NULL, '{\"lokasi\":{\"type\":\"textSugestion\",\"label\":\"Lokasi\",\"source\":\"jurusan\"},\"tujuan\":{\"type\":\"array\",\"label\":\"kepada\",\"source\":\"dosen\"},\"isi\":{\"type\":\"longText\",\"label\":\"isi surat\"}}', 'rektor', NULL);
INSERT INTO `tbl_sk` VALUES ('25', 'Surat Keluar', NULL, '{\"lokasi\":{\"type\":\"textSugestion\",\"label\":\"Lokasi\",\"source\":\"jurusan\"},\"tujuan\":{\"type\":\"array\",\"label\":\"kepada\",\"source\":\"dosen\"},\"isi\":{\"type\":\"longText\",\"label\":\"isi surat\"}}', 'admin', NULL);
INSERT INTO `tbl_sk` VALUES ('26', 'Surat Masuk', NULL, '{\"lokasi\":{\"type\":\"textSugestion\",\"label\":\"Lokasi\",\"source\":\"jurusan\"},\"tujuan\":{\"type\":\"array\",\"label\":\"kepada\",\"source\":\"dosen\"},\"isi\":{\"type\":\"longText\",\"label\":\"isi surat\"}}', 'admin', NULL);
INSERT INTO `tbl_sk` VALUES ('28', 'Rapat', NULL, NULL, 'kosong', NULL);
INSERT INTO `tbl_sk` VALUES ('3', 'Pelaksanaan Bimbingan Tugas Akhir', 'fakultas_BimbinganTugasAkhir.docx', '{\"NamaDosen\":{\"type\":\"textSugestion\",\"label\":\"Nama Dosen Pembimbing\",\"source\":\"dosen\"},\"NamaMahasiswa\":{\"type\":\"text\",\"label\":\"Nama Mahasiswa\"},\"NRP\":{\"type\":\"text\",\"label\":\"NRP\"},\"Jurusan\":{\"type\":\"textSugestion\",\"label\":\"Jurusan\",\"source\":\"jurusan\"},\"JudulTA\":{\"type\":\"text\",\"label\":\"Judul TA\"}}', 'fakultas', '{\"JenisSurat\":\"jenis\",\"Departement\":\"NamaDepartement\",\"dosen\":\"NamaDosen\",\"mahasiswa\":\"NamaMahasiswa\",\"nrp\":\"NRP\",\"jurusan\":\"Jurusan\",\"judulTA\":\"JudulTA\",\"date\":\"d-m-Y\",\"pembuat\":\"validasi\",\"No\":\"test\",\"thn\":\"Y\",\"ttd\":\"TTD\"}');
INSERT INTO `tbl_sk` VALUES ('4', 'sk rektor', 'asd', '{\"lokasi\":{\"type\":\"textSugestion\",\"label\":\"Lokasi\",\"source\":\"jurusan\"},\"tujuan\":{\"type\":\"array\",\"label\":\"kepada\",\"source\":\"dosen\"},\"isi\":{\"type\":\"longText\",\"label\":\"isi surat\"}}', 'admin', NULL);
INSERT INTO `tbl_sk` VALUES ('5', 'sk jurusan', 'asd', '{\"lokasi\":{\"type\":\"textSugestion\",\"label\":\"Lokasi\",\"source\":\"jurusan\"},\"tujuan\":{\"type\":\"array\",\"label\":\"kepada\",\"source\":\"dosen\"},\"isi\":{\"type\":\"longText\",\"label\":\"isi surat\"}}', 'admin', NULL);
INSERT INTO `tbl_sk` VALUES ('6', 'sk dosen 2', 'asd', '{\"lokasi\":{\"type\":\"textSugestion\",\"label\":\"Lokasi\",\"source\":\"jurusan\"},\"tujuan\":{\"type\":\"array\",\"label\":\"kepada\",\"source\":\"dosen\"},\"isi\":{\"type\":\"longText\",\"label\":\"isi surat\"}}', 'admin', NULL);
INSERT INTO `tbl_sk` VALUES ('7', 'Pengangkatan Para Dosen Penguji Ujian Tugas Akhir', NULL, '{\"lokasi\":{\"type\":\"textSugestion\",\"label\":\"Lokasi\",\"source\":\"jurusan\"},\"tujuan\":{\"type\":\"array\",\"label\":\"kepada\",\"source\":\"dosen\"},\"isi\":{\"type\":\"longText\",\"label\":\"isi surat\"}}', 'fakultas', NULL);
INSERT INTO `tbl_sk` VALUES ('8', 'Pengangkatan Dosen Pembimbing Kerja Praktik', NULL, '{\"lokasi\":{\"type\":\"textSugestion\",\"label\":\"Lokasi\",\"source\":\"jurusan\"},\"tujuan\":{\"type\":\"array\",\"label\":\"kepada\",\"source\":\"dosen\"},\"isi\":{\"type\":\"longText\",\"label\":\"isi surat\"}}', 'fakultas', NULL);
INSERT INTO `tbl_sk` VALUES ('9', 'Pengangkatan Dosen Pembimbing Tugas Akhir', NULL, '{\"lokasi\":{\"type\":\"textSugestion\",\"label\":\"Lokasi\",\"source\":\"jurusan\"},\"tujuan\":{\"type\":\"array\",\"label\":\"kepada\",\"source\":\"dosen\"},\"isi\":{\"type\":\"longText\",\"label\":\"isi surat\"}}', 'fakultas', NULL);

-- ----------------------------
-- Table structure for tbl_staff_departement
-- ----------------------------
DROP TABLE IF EXISTS `tbl_staff_departement`;
CREATE TABLE `tbl_staff_departement`  (
  `IdStaffDept` int(11) NOT NULL COMMENT 'primary id staff departement',
  `NIP` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'foreign key untuk tabel pegawai',
  `idDepartement` int(11) NULL DEFAULT NULL COMMENT 'foreign key untuk tabel departement',
  `jabatan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'jabatan pegawai',
  PRIMARY KEY (`IdStaffDept`) USING BTREE,
  INDEX `FK_tbl_staff_departement_tbl_pegawai`(`NIP`) USING BTREE,
  INDEX `FK_tbl_staff_departement_tbl_department`(`idDepartement`) USING BTREE,
  CONSTRAINT `FK_tbl_staff_departement_tbl_department` FOREIGN KEY (`idDepartement`) REFERENCES `tbl_department` (`idDepartment`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_staff_departement_tbl_pegawai` FOREIGN KEY (`NIP`) REFERENCES `tbl_pegawai` (`Nip`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Tabel untuk detail data departement dan pegawai digunakan untuk menghubungkan pegawai dengan departement' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_staff_departement
-- ----------------------------
INSERT INTO `tbl_staff_departement` VALUES (1, '1', 1, 'Dosen');
INSERT INTO `tbl_staff_departement` VALUES (2, '2', 1, 'Kajur');

-- ----------------------------
-- Table structure for tbl_staff_rapat
-- ----------------------------
DROP TABLE IF EXISTS `tbl_staff_rapat`;
CREATE TABLE `tbl_staff_rapat`  (
  `IdStaffRapat` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary id staff surat',
  `IdRapat` int(11) NULL DEFAULT NULL COMMENT 'Id Surat ',
  `NIP` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'penghubung table pegawai',
  `StatusSurat` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'Status terkirim surat',
  PRIMARY KEY (`IdStaffRapat`) USING BTREE,
  INDEX `FK_tbl_staff_surat_tbl_pegawai`(`NIP`) USING BTREE,
  INDEX `FK_tbl_staff_surat_tbl_surat`(`IdRapat`) USING BTREE,
  CONSTRAINT `tbl_staff_rapat_ibfk_1` FOREIGN KEY (`NIP`) REFERENCES `tbl_pegawai` (`Nip`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_staff_rapat_ibfk_2` FOREIGN KEY (`IdRapat`) REFERENCES `tbl_rapat` (`IdRapat`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 45 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Tabel untuk data tujuan surat digunakan untuk detail surat' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_staff_rapat
-- ----------------------------
INSERT INTO `tbl_staff_rapat` VALUES (43, 8, '1', 'Y');
INSERT INTO `tbl_staff_rapat` VALUES (44, 8, '2', 'N');

-- ----------------------------
-- Table structure for tbl_staff_surat
-- ----------------------------
DROP TABLE IF EXISTS `tbl_staff_surat`;
CREATE TABLE `tbl_staff_surat`  (
  `IdStaffSurat` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary id staff surat',
  `IdSurat` int(11) NULL DEFAULT NULL COMMENT 'Id Surat ',
  `NIP` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'penghubung table pegawai',
  `StatusSurat` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'Status terkirim surat',
  PRIMARY KEY (`IdStaffSurat`) USING BTREE,
  INDEX `FK_tbl_staff_surat_tbl_pegawai`(`NIP`) USING BTREE,
  INDEX `FK_tbl_staff_surat_tbl_surat`(`IdSurat`) USING BTREE,
  CONSTRAINT `FK_tbl_staff_surat_tbl_pegawai` FOREIGN KEY (`NIP`) REFERENCES `tbl_pegawai` (`Nip`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_staff_surat_tbl_surat` FOREIGN KEY (`IdSurat`) REFERENCES `tbl_surat` (`IdSurat`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 52 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Tabel untuk data tujuan surat digunakan untuk detail surat' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_staff_surat
-- ----------------------------
INSERT INTO `tbl_staff_surat` VALUES (1, 13, '1', 'Y');
INSERT INTO `tbl_staff_surat` VALUES (2, 13, '2', 'N');
INSERT INTO `tbl_staff_surat` VALUES (3, 29, '1', 'N');
INSERT INTO `tbl_staff_surat` VALUES (4, 30, '1', 'N');
INSERT INTO `tbl_staff_surat` VALUES (5, 32, '1', 'Y');
INSERT INTO `tbl_staff_surat` VALUES (6, 32, '2', 'N');
INSERT INTO `tbl_staff_surat` VALUES (7, 33, '1', 'N');
INSERT INTO `tbl_staff_surat` VALUES (8, 33, '2', 'N');
INSERT INTO `tbl_staff_surat` VALUES (9, 34, '1', 'N');
INSERT INTO `tbl_staff_surat` VALUES (10, 35, '1', 'N');
INSERT INTO `tbl_staff_surat` VALUES (11, 36, '1', 'N');
INSERT INTO `tbl_staff_surat` VALUES (12, 37, '2', 'Y');
INSERT INTO `tbl_staff_surat` VALUES (13, 38, '2', 'Y');
INSERT INTO `tbl_staff_surat` VALUES (14, 39, '1', 'N');
INSERT INTO `tbl_staff_surat` VALUES (15, 40, '1', 'N');
INSERT INTO `tbl_staff_surat` VALUES (16, 41, '1', 'Y');
INSERT INTO `tbl_staff_surat` VALUES (17, 42, '1', 'N');
INSERT INTO `tbl_staff_surat` VALUES (18, 43, '1', 'N');
INSERT INTO `tbl_staff_surat` VALUES (19, 44, '1', 'N');
INSERT INTO `tbl_staff_surat` VALUES (20, 46, '2', 'N');
INSERT INTO `tbl_staff_surat` VALUES (21, 47, '2', 'N');
INSERT INTO `tbl_staff_surat` VALUES (22, 48, '1', 'N');
INSERT INTO `tbl_staff_surat` VALUES (23, 49, '1', 'N');
INSERT INTO `tbl_staff_surat` VALUES (24, 50, '1', 'N');
INSERT INTO `tbl_staff_surat` VALUES (25, 51, '1', 'N');
INSERT INTO `tbl_staff_surat` VALUES (26, 52, '1', 'N');
INSERT INTO `tbl_staff_surat` VALUES (27, 53, '1', 'N');
INSERT INTO `tbl_staff_surat` VALUES (28, 54, '1', 'N');
INSERT INTO `tbl_staff_surat` VALUES (29, 55, '1', 'N');
INSERT INTO `tbl_staff_surat` VALUES (30, 56, '1', 'N');
INSERT INTO `tbl_staff_surat` VALUES (31, 57, '1', 'N');
INSERT INTO `tbl_staff_surat` VALUES (32, 58, '1', 'N');
INSERT INTO `tbl_staff_surat` VALUES (33, 58, '1', 'N');
INSERT INTO `tbl_staff_surat` VALUES (34, 59, '1', 'N');
INSERT INTO `tbl_staff_surat` VALUES (35, 59, '1', 'N');
INSERT INTO `tbl_staff_surat` VALUES (36, 60, '1', 'N');
INSERT INTO `tbl_staff_surat` VALUES (37, 60, '1', 'N');
INSERT INTO `tbl_staff_surat` VALUES (38, 61, '1', 'N');
INSERT INTO `tbl_staff_surat` VALUES (39, 62, '1', 'N');
INSERT INTO `tbl_staff_surat` VALUES (40, 63, '1', 'N');
INSERT INTO `tbl_staff_surat` VALUES (41, 64, '1', 'N');
INSERT INTO `tbl_staff_surat` VALUES (42, 65, '1', 'N');
INSERT INTO `tbl_staff_surat` VALUES (43, 66, '1', 'N');
INSERT INTO `tbl_staff_surat` VALUES (44, 67, '1', 'N');
INSERT INTO `tbl_staff_surat` VALUES (45, 68, '1', 'N');
INSERT INTO `tbl_staff_surat` VALUES (46, 69, '1', 'N');
INSERT INTO `tbl_staff_surat` VALUES (47, 70, '1', 'N');
INSERT INTO `tbl_staff_surat` VALUES (48, 71, '1', 'N');
INSERT INTO `tbl_staff_surat` VALUES (49, 72, '1', 'N');
INSERT INTO `tbl_staff_surat` VALUES (50, 73, '1', 'N');
INSERT INTO `tbl_staff_surat` VALUES (51, 74, '1', 'N');

-- ----------------------------
-- Table structure for tbl_surat
-- ----------------------------
DROP TABLE IF EXISTS `tbl_surat`;
CREATE TABLE `tbl_surat`  (
  `IdSurat` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary id surat',
  `IdSK` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'penghubung dengan tabel SK',
  `NoSurat` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'No Surat',
  `Topik` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'topik atau tema surat',
  `TglDibuat` date NULL DEFAULT NULL COMMENT 'tanggal dibuat surat',
  `FilePdf` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `File` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'file ketika surat sudah di bentuk, untuk kebutuhan download',
  `Value` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL COMMENT 'berupa jenis input dan data yang sudah diinputkan user',
  `Status` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'status terkirim surat',
  `Pembuats` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Validator` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`IdSurat`) USING BTREE,
  INDEX `FK_tbl_surat_tbl_sk`(`IdSK`) USING BTREE,
  INDEX `Pembuats`(`Pembuats`) USING BTREE,
  INDEX `Validator`(`Validator`) USING BTREE,
  CONSTRAINT `FK_tbl_surat_tbl_sk` FOREIGN KEY (`IdSK`) REFERENCES `tbl_sk` (`IdSK`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_surat_ibfk_1` FOREIGN KEY (`Pembuats`) REFERENCES `tbl_pegawai` (`Nip`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_surat_ibfk_2` FOREIGN KEY (`Validator`) REFERENCES `tbl_pegawai` (`Nip`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 75 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Tabel untuk data surat digunakan untuk menyimpan data surat' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_surat
-- ----------------------------
INSERT INTO `tbl_surat` VALUES (1, '1', 'asd', 'test', '2020-03-16', NULL, NULL, '{\"no_surat\":\"asdasd\",\"tujuan\":[\"ujank\",\"asep\"],\"isi\":\"asdapasdpaspd\"}', NULL, '1', NULL);
INSERT INTO `tbl_surat` VALUES (2, '1', NULL, 'test', '2020-03-17', NULL, NULL, '{\"no_surat\":\"\",\"isi\":\"\"}', NULL, '1', NULL);
INSERT INTO `tbl_surat` VALUES (3, '1', NULL, 'test', '2020-03-17', NULL, NULL, '{\"no_surat\":\"\",\"isi\":\"\"}', NULL, '1', NULL);
INSERT INTO `tbl_surat` VALUES (4, '1', NULL, 'test', '2020-03-17', NULL, NULL, '{\"no_surat\":\"123\",\"tujuan\":[\"ujank\"],\"isi\":\"asdasd\"}', NULL, '1', NULL);
INSERT INTO `tbl_surat` VALUES (5, '2', NULL, 'test', '2020-03-17', NULL, NULL, '{\"no_surat\":\"12313\",\"tujuan\":[\"ujank\"],\"isi\":\"asdasdad\"}', NULL, '1', NULL);
INSERT INTO `tbl_surat` VALUES (6, '21', NULL, 'test', '2020-03-17', NULL, NULL, '{\"no_surat\":\"asdsad\",\"tujuan\":[\"ujank\",\"asep\"],\"isi\":\"asdsadas\"}', NULL, '1', NULL);
INSERT INTO `tbl_surat` VALUES (7, '1', NULL, 'test', '2020-03-17', NULL, NULL, '{\"isi\":\"\"}', NULL, '1', NULL);
INSERT INTO `tbl_surat` VALUES (8, '21', NULL, 'test', '2020-03-17', NULL, NULL, '{\"lokasi\":\"\",\"isi\":\"\"}', NULL, '1', NULL);
INSERT INTO `tbl_surat` VALUES (9, '21', 'test', 'test', '2020-03-17', NULL, NULL, '{\"lokasi\":[\"Desain dan Komunikasi Visual\"],\"tujuan\":[\"ujank\",\"asep\"],\"isi\":\"asdsadas\"}', NULL, '1', NULL);
INSERT INTO `tbl_surat` VALUES (10, '11', 'test', 'Penugasan Dosen Penguji Pada Ujian Tugas Akhir', '2020-03-17', NULL, NULL, '{\"penguji\":[\"ujank\",\"asep\"],\"mhs\":\"asd\",\"judul\":\"asdasdasd\"}', NULL, '1', NULL);
INSERT INTO `tbl_surat` VALUES (11, '21', 'test', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-03-19', NULL, NULL, '{\"dosen\":[\"ujank\"],\"kegiatan\":\"\",\"lokasi\":\"\",\"sumberDana\":\"\"}', NULL, '1', NULL);
INSERT INTO `tbl_surat` VALUES (12, '23', 'test', 'Pelaksanaan Penelitian Dosen Muda', '2020-03-19', NULL, NULL, '{\"lokasi\":[\"Mesin\"],\"isi\":\"\"}', NULL, '1', NULL);
INSERT INTO `tbl_surat` VALUES (13, '25', 'test', 'Surat Keluar', '2020-03-19', NULL, NULL, '{\"lokasi\":[\"Informatika\"],\"isi\":\"\"}', NULL, '1', NULL);
INSERT INTO `tbl_surat` VALUES (14, '26', 'test', 'Surat Masuk', '2020-03-19', NULL, NULL, '{\"lokasi\":[\"Informatika\"],\"isi\":\"\"}', NULL, '1', NULL);
INSERT INTO `tbl_surat` VALUES (15, '25', 'test', 'Surat Keluar', '2020-03-19', NULL, NULL, '{\"lokasi\":[\"Informatika\"],\"isi\":\"\"}', NULL, '1', NULL);
INSERT INTO `tbl_surat` VALUES (16, '25', 'test', 'Surat Keluar', '2020-03-19', NULL, NULL, '{\"lokasi\":[\"Informatika\"],\"isi\":\"\"}', 'tervalidasi', '1', NULL);
INSERT INTO `tbl_surat` VALUES (17, '21', 'test', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-03-23', NULL, NULL, '{\"dosen\":[\"ujank\"],\"kegiatan\":\"asd\",\"lokasi\":\"asd\",\"sumberDana\":\"asd\"}', NULL, '1', NULL);
INSERT INTO `tbl_surat` VALUES (18, '26', 'test', 'Surat Masuk', '2020-03-23', NULL, NULL, '{\"lokasi\":[\"Informatika\"],\"tujuan\":[\"asep\"],\"isi\":\"asdasd\"}', NULL, '1', NULL);
INSERT INTO `tbl_surat` VALUES (19, '15', 'test', 'Penugasan Sebagai Tim Akreditasi', '2020-03-23', NULL, NULL, '{\"dosen\":[\"ujank\",\"asep\"]}', NULL, '1', NULL);
INSERT INTO `tbl_surat` VALUES (20, '2', 'test', 'sk dosen', '2020-06-15', NULL, 'results/fakultas_BimbinganTugasAkhir_2020-06-15_11', '{\"jenis\":\"Surat Keputusan\",\"lokasi\":\"Informatika\",\"tujuan\":[\"ujank\"],\"isi\":\"asd\"}', NULL, '1', NULL);
INSERT INTO `tbl_surat` VALUES (21, '3', 'test', 'Pelaksanaan Bimbingan Tugas Akhir', '2020-06-15', NULL, 'results/fakultas_BimbinganTugasAkhir_2020-06-15_11', '{\"jenis\":\"Surat Keputusan\",\"NamaDosen\":\"ujank\",\"NamaMahasiswa\":\"asd\",\"NRP\":\"123\",\"Jurusan\":\"Informatika\",\"JudulTA\":\"asd\"}', NULL, '1', NULL);
INSERT INTO `tbl_surat` VALUES (22, '21', '22', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-06-16', NULL, 'results/2020-06-16_08-46-00 lppkm_pkm.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"kegiatan\":\"asd\",\"jabatan\":\"asdasd\",\"lokasi\":\"asd\",\"waktu\":\"16-06-2020\",\"sumberDana\":\"asd\"}', NULL, '1', NULL);
INSERT INTO `tbl_surat` VALUES (23, '21', '23', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-06-16', NULL, 'results/2020-06-16_08-46-32 lppkm_pkm.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"kegiatan\":\"asd\",\"jabatan\":\"asd\",\"lokasi\":\"asd\",\"waktu\":\"16-06-2020 - 16-06-2020\",\"sumberDana\":\"asd\"}', NULL, '1', NULL);
INSERT INTO `tbl_surat` VALUES (24, '21', '24', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-06-16', NULL, 'results/2020-06-16_08-49-30 lppkm_pkm.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"kegiatan\":\"asd\",\"jabatan\":\"asd\",\"lokasi\":\"asd\",\"waktu\":\"asd\",\"sumberDana\":\"asd\"}', NULL, '1', NULL);
INSERT INTO `tbl_surat` VALUES (25, '21', '25', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-06-16', NULL, 'results/2020-06-16_08-50-13 lppkm_pkm.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"kegiatan\":\"asd\",\"jabatan\":\"asd\",\"lokasi\":\"asd\",\"waktu\":\"asd\",\"sumberDana\":\"asd\"}', NULL, '1', NULL);
INSERT INTO `tbl_surat` VALUES (26, '21', '26', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-06-16', NULL, 'results/2020-06-16_08-50-53 lppkm_pkm.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"kegiatan\":\"asd\",\"jabatan\":\"asd\",\"lokasi\":\"asd\",\"waktu\":\"asd\",\"sumberDana\":\"asd\"}', NULL, '1', NULL);
INSERT INTO `tbl_surat` VALUES (27, '21', '27', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-06-16', NULL, 'results/2020-06-16_08-54-35 lppkm_pkm.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"kegiatan\":\"asd\",\"jabatan\":\"asd\",\"lokasi\":\"asd\",\"waktu\":\"16-06-2020\",\"sumberDana\":\"asd\"}', NULL, '1', NULL);
INSERT INTO `tbl_surat` VALUES (28, '21', '28', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-06-16', NULL, 'results/2020-06-16_08-54-49 lppkm_pkm.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"kegiatan\":\"asd\",\"jabatan\":\"asd\",\"lokasi\":\"asd\",\"waktu\":\"asd\",\"sumberDana\":\"sad\"}', NULL, '1', NULL);
INSERT INTO `tbl_surat` VALUES (29, '21', '29', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-06-16', NULL, 'results/2020-06-16_08-55-01 lppkm_pkm.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"kegiatan\":\"asd\",\"jabatan\":\"asd\",\"lokasi\":\"sd\",\"waktu\":\"asd\",\"sumberDana\":\"asd\"}', NULL, '1', NULL);
INSERT INTO `tbl_surat` VALUES (30, '21', '30', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-06-16', NULL, 'results/2020-06-16_08-55-38 lppkm_pkm.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"kegiatan\":\"asd\",\"jabatan\":\"asd\",\"lokasi\":\"sd\",\"waktu\":\"asd\",\"sumberDana\":\"asd\"}', NULL, '1', NULL);
INSERT INTO `tbl_surat` VALUES (31, '14', '31', 'Penugasan Melaksanakan Penelitian', '2020-06-16', NULL, 'results/2020-06-16_08-56-45 jurusan_Penugasan Melaksanakan Penelitian.docx', '{\"jenis\":\"Surat Keterangan\",\"dosen\":[\"ujank\",\"asep\"]}', NULL, '1', NULL);
INSERT INTO `tbl_surat` VALUES (32, '14', '32', 'Penugasan Melaksanakan Penelitian', '2020-06-16', NULL, 'results/2020-06-16_08-58-47 jurusan_Penugasan Melaksanakan Penelitian.docx', '{\"jenis\":\"Surat Keterangan\",\"dosen\":[\"ujank\",\"asep\"]}', NULL, '1', NULL);
INSERT INTO `tbl_surat` VALUES (33, '14', '33', 'Penugasan Melaksanakan Penelitian', '2020-06-16', NULL, 'results/2020-06-16_11-12-10 jurusan_Penugasan Melaksanakan Penelitian.docx', '{\"jenis\":\"Surat Keputusan\",\"dosen\":[\"ujank\",\"asep\"]}', NULL, '1', NULL);
INSERT INTO `tbl_surat` VALUES (34, '21', '34', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-06-23', NULL, 'results/2020-06-23_02-22-39 lppkm_pkm.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"kegiatan\":\"asd\",\"jabatan\":\"asd\",\"lokasi\":\"asd\",\"waktu\":\"02-06-2020 - 03-06-2020\",\"sumberDana\":\"adsa\"}', NULL, '1', NULL);
INSERT INTO `tbl_surat` VALUES (35, '21', '35', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-06-23', NULL, 'results/2020-06-23_11-43-47 lppkm_pkm.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"kegiatan\":\"asd\",\"jabatan\":\"asd\",\"lokasi\":\"asd\",\"waktu\":\"10-06-2020 - 11-06-2020\",\"sumberDana\":\"asd\"}', NULL, '1', NULL);
INSERT INTO `tbl_surat` VALUES (36, '21', '36', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-06-23', NULL, 'results/2020-06-23_11-52-11 lppkm_pkm.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"kegiatan\":\"asd\",\"jabatan\":\"asd\",\"lokasi\":\"asd\",\"waktu\":\"23-06-2020 - 24-06-2020\",\"sumberDana\":\"asd\"}', NULL, '1', NULL);
INSERT INTO `tbl_surat` VALUES (37, '21', '37', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-06-23', NULL, 'results/2020-06-23_11-56-34 lppkm_pkm.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"asep\",\"kegiatan\":\"asd\",\"jabatan\":\"asd\",\"lokasi\":\"asd\",\"waktu\":\"25-06-2020 - 26-06-2020\",\"sumberDana\":\"asd\"}', NULL, '1', NULL);
INSERT INTO `tbl_surat` VALUES (38, '21', '38', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-06-23', NULL, 'results/2020-06-23_11-57-12 lppkm_pkm.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"asep\",\"kegiatan\":\"asd\",\"jabatan\":\"asd\",\"lokasi\":\"ad\",\"waktu\":\"16-06-2020 - 17-06-2020\",\"sumberDana\":\"asd\"}', NULL, '1', NULL);
INSERT INTO `tbl_surat` VALUES (39, '10', '39', 'Pemberian Tugas & Wewenang Dosen Pengampu', '2020-06-23', NULL, 'results/2020-06-23_12-11-51 fakultas_Pemberian_Tugas_Dosen_Pengampu.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"matkul\":[\"Basis Data Responsi\",\"Basis Data Lanjut Kuliah\"]}', NULL, '1', NULL);
INSERT INTO `tbl_surat` VALUES (40, '10', '40', 'Pemberian Tugas & Wewenang Dosen Pengampu', '2020-06-23', NULL, 'results/2020-06-23_12-13-10fakultas_Pemberian_Tugas_Dosen_Pengampu.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"matkul\":[\"Basis Data Kuliah\",\"Basis Data Responsi\",\"Basis Data Lanjut Kuliah\"]}', NULL, '1', NULL);
INSERT INTO `tbl_surat` VALUES (41, '21', '41', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-06-30', NULL, 'results/2020-06-30_03-36-30lppkm_pkm.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"kegiatan\":\"asd\",\"jabatan\":\"asd\",\"lokasi\":\"asd\",\"waktu\":\"01-07-2020 - 09-07-2020\",\"sumberDana\":\"asd\"}', 'tervalidasi', '1', NULL);
INSERT INTO `tbl_surat` VALUES (42, '21', '42', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-06-30', NULL, 'results/2020-06-30_03-51-17lppkm_pkm.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"kegiatan\":\"\",\"jabatan\":\"\",\"lokasi\":\"\",\"waktu\":\"\",\"sumberDana\":\"\"}', 'tervalidasi', '1', NULL);
INSERT INTO `tbl_surat` VALUES (43, '21', '43', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-06-30', NULL, 'results/2020-06-30_04-45-11lppkm_pkm.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"kegiatan\":\"asd\",\"jabatan\":\"asd\",\"lokasi\":\"asd\",\"waktu\":\"17-06-2020 - 19-06-2020\",\"sumberDana\":\"asd\",\"validasi\":\"ujank\"}', 'belum tervalidasi', NULL, NULL);
INSERT INTO `tbl_surat` VALUES (44, '10', '44', 'Pemberian Tugas & Wewenang Dosen Pengampu', '2020-06-30', NULL, 'results/2020-06-30_04-47-39fakultas_Pemberian_Tugas_Dosen_Pengampu.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"matkul\":[\"Basis Data Responsi\",\"Berpikir Kreatif Kuliah\"],\"validasi\":\"fredi\"}', 'belum tervalidasi', NULL, NULL);
INSERT INTO `tbl_surat` VALUES (46, '10', '45', 'Pemberian Tugas & Wewenang Dosen Pengampu', '2020-06-30', NULL, 'results/2020-06-30_05-04-33fakultas_Pemberian_Tugas_Dosen_Pengampu.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"fredi\",\"matkul\":[\"Basis Data Responsi\",\"Berpikir Kreatif Kuliah\"],\"validasi\":\"ujank\"}', 'tervalidasi', '2', '1');
INSERT INTO `tbl_surat` VALUES (47, '10', '47', 'Pemberian Tugas & Wewenang Dosen Pengampu', '2020-06-30', NULL, 'results/2020-06-30_05-05-57fakultas_Pemberian_Tugas_Dosen_Pengampu.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"fredi\",\"matkul\":[\"Basis Data Responsi\",\"Berpikir Kreatif Kuliah\"],\"validasi\":\"ujank\"}', 'tervalidasi', '2', '1');
INSERT INTO `tbl_surat` VALUES (48, '10', '48', 'Pemberian Tugas & Wewenang Dosen Pengampu', '2020-06-30', NULL, 'results/2020-06-30_05-18-49fakultas_Pemberian_Tugas_Dosen_Pengampu.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"matkul\":[\"Basis Data Responsi\",\"Berpikir Kreatif Kuliah\"],\"validasi\":\"ujank\"}', 'belum tervalidasi', '2', '1');
INSERT INTO `tbl_surat` VALUES (49, '10', '49', 'Pemberian Tugas & Wewenang Dosen Pengampu', '2020-06-30', NULL, 'results/2020-06-30_05-19-06fakultas_Pemberian_Tugas_Dosen_Pengampu.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"matkul\":[\"Berpikir Kreatif Kuliah\",\"Basis Data Lanjut Kuliah\"],\"validasi\":\"ujank\"}', 'belum tervalidasi', '2', '1');
INSERT INTO `tbl_surat` VALUES (50, '10', '50', 'Pemberian Tugas & Wewenang Dosen Pengampu', '2020-06-30', NULL, 'results/2020-06-30_05-29-00fakultas_Pemberian_Tugas_Dosen_Pengampu.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"matkul\":[\"Berpikir Kreatif Kuliah\",\"Basis Data Lanjut Kuliah\"],\"validasi\":\"ujank\"}', 'belum tervalidasi', '2', '1');
INSERT INTO `tbl_surat` VALUES (51, '10', '51', 'Pemberian Tugas & Wewenang Dosen Pengampu', '2020-06-30', NULL, 'results/2020-06-30_05-29-37fakultas_Pemberian_Tugas_Dosen_Pengampu.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"matkul\":[\"Berpikir Kreatif Kuliah\",\"Basis Data Lanjut Kuliah\"],\"validasi\":\"ujank\"}', 'belum tervalidasi', '2', '1');
INSERT INTO `tbl_surat` VALUES (52, '10', '52', 'Pemberian Tugas & Wewenang Dosen Pengampu', '2020-06-30', NULL, 'results/2020-06-30_05-31-13fakultas_Pemberian_Tugas_Dosen_Pengampu.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"matkul\":[\"Basis Data Responsi\",\"Berpikir Kreatif Kuliah\"],\"validasi\":\"ujank\"}', 'belum tervalidasi', '2', '1');
INSERT INTO `tbl_surat` VALUES (53, '10', '53', 'Pemberian Tugas & Wewenang Dosen Pengampu', '2020-06-30', NULL, 'results/2020-06-30_05-34-07fakultas_Pemberian_Tugas_Dosen_Pengampu.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"matkul\":[\"Basis Data Responsi\",\"Berpikir Kreatif Kuliah\"],\"validasi\":\"ujank\"}', 'belum tervalidasi', '2', '1');
INSERT INTO `tbl_surat` VALUES (54, '10', '54', 'Pemberian Tugas & Wewenang Dosen Pengampu', '2020-06-30', NULL, 'results/2020-06-30_05-34-33fakultas_Pemberian_Tugas_Dosen_Pengampu.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"matkul\":[\"Basis Data Responsi\",\"Berpikir Kreatif Kuliah\"],\"validasi\":\"ujank\"}', 'belum tervalidasi', '2', '1');
INSERT INTO `tbl_surat` VALUES (55, '10', '55', 'Pemberian Tugas & Wewenang Dosen Pengampu', '2020-06-30', NULL, 'results/2020-06-30_05-36-01fakultas_Pemberian_Tugas_Dosen_Pengampu.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"matkul\":[\"Basis Data Responsi\",\"Berpikir Kreatif Kuliah\"],\"validasi\":\"ujank\"}', 'belum tervalidasi', '2', '1');
INSERT INTO `tbl_surat` VALUES (56, '10', '56', 'Pemberian Tugas & Wewenang Dosen Pengampu', '2020-06-30', NULL, 'results/2020-06-30_05-36-32fakultas_Pemberian_Tugas_Dosen_Pengampu.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"matkul\":[\"Basis Data Responsi\",\"Berpikir Kreatif Kuliah\"],\"validasi\":\"ujank\"}', 'belum tervalidasi', '2', '1');
INSERT INTO `tbl_surat` VALUES (57, '10', '57', 'Pemberian Tugas & Wewenang Dosen Pengampu', '2020-06-30', NULL, 'results/2020-06-30_05-37-01fakultas_Pemberian_Tugas_Dosen_Pengampu.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"matkul\":[\"Basis Data Kuliah\",\"Berpikir Kreatif Kuliah\"],\"validasi\":\"fredi\"}', 'belum tervalidasi', '2', '2');
INSERT INTO `tbl_surat` VALUES (58, '11', '58', 'Penugasan Dosen Penguji Pada Ujian Tugas Akhir', '2020-06-30', NULL, 'results/2020-06-30_05-41-31fakultas_Penugasan_Sebagai_Penguji.docx', '{\"jenis\":\"Surat Keputusan\",\"ketuaDosen\":\"ujank\",\"dosen\":[\"ujank\"],\"mhs\":\"asd\",\"judul\":\"asd\",\"waktu\":\"30-06-2020\",\"Nrp\":\"asd\",\"validasi\":\"fredi\"}', 'belum tervalidasi', '2', '2');
INSERT INTO `tbl_surat` VALUES (59, '11', '59', 'Penugasan Dosen Penguji Pada Ujian Tugas Akhir', '2020-06-30', NULL, 'results/2020-06-30_05-46-37fakultas_Penugasan_Sebagai_Penguji.docx', '{\"jenis\":\"Surat Keputusan\",\"ketuaDosen\":\"ujank\",\"dosen\":[\"ujank\"],\"mhs\":\"asd\",\"judul\":\"asd\",\"waktu\":\"30-06-2020\",\"Nrp\":\"asd\",\"validasi\":\"fredi\"}', 'belum tervalidasi', '2', '2');
INSERT INTO `tbl_surat` VALUES (60, '11', '60', 'Penugasan Dosen Penguji Pada Ujian Tugas Akhir', '2020-06-30', NULL, 'results/2020-06-30_05-46-55fakultas_Penugasan_Sebagai_Penguji.docx', '{\"jenis\":\"Surat Keputusan\",\"ketuaDosen\":\"ujank\",\"dosen\":[\"ujank\"],\"mhs\":\"asd\",\"judul\":\"asd\",\"waktu\":\"30-06-2020\",\"Nrp\":\"asd\",\"validasi\":\"fredi\"}', 'tervalidasi', '2', '2');
INSERT INTO `tbl_surat` VALUES (61, '10', '61', 'Pemberian Tugas & Wewenang Dosen Pengampu', '2020-06-30', NULL, 'results/2020-06-30_05-47-15fakultas_Pemberian_Tugas_Dosen_Pengampu.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"matkul\":[\"Berpikir Kreatif Kuliah\",\"Metodologi Penelitian Kuliah\"],\"validasi\":\"ujank\"}', 'belum tervalidasi', '2', '1');
INSERT INTO `tbl_surat` VALUES (62, '10', '62', 'Pemberian Tugas & Wewenang Dosen Pengampu', '2020-06-30', NULL, 'results/2020-06-30_05-47-32fakultas_Pemberian_Tugas_Dosen_Pengampu.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"matkul\":[\"Basis Data Lanjut Kuliah\"],\"validasi\":\"dadang\"}', 'belum tervalidasi', '2', '3');
INSERT INTO `tbl_surat` VALUES (63, '10', '63', 'Pemberian Tugas & Wewenang Dosen Pengampu', '2020-06-30', NULL, 'results/2020-06-30_05-51-43fakultas_Pemberian_Tugas_Dosen_Pengampu.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"matkul\":[\"Basis Data Responsi\"],\"validasi\":\"ujank\"}', 'belum tervalidasi', '2', '1');
INSERT INTO `tbl_surat` VALUES (64, '10', '64', 'Pemberian Tugas & Wewenang Dosen Pengampu', '2020-06-30', NULL, 'results/2020-06-30_05-52-09fakultas_Pemberian_Tugas_Dosen_Pengampu.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"matkul\":[\"Berpikir Kreatif Kuliah\"],\"validasi\":\"fredi\"}', 'tervalidasi', '2', '2');
INSERT INTO `tbl_surat` VALUES (65, '21', '65', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-06-30', NULL, 'results/2020-06-30_06-04-16lppkm_pkm.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"kegiatan\":\"asd\",\"jabatan\":\"asd\",\"lokasi\":\"\",\"waktu\":\"\",\"sumberDana\":\"\",\"validasi\":\"ujank\"}', 'tervalidasi', '1', '1');
INSERT INTO `tbl_surat` VALUES (66, '21', '66', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-07-06', NULL, 'results/2020-07-06_11-21-37lppkm_pkm.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"kegiatan\":\"asd\",\"jabatan\":\"asd\",\"lokasi\":\"asd\",\"waktu\":\"07-07-2020 - 08-07-2020\",\"sumberDana\":\"asd\",\"validasi\":\"ujank\"}', 'belum tervalidasi', '1', '1');
INSERT INTO `tbl_surat` VALUES (67, '21', '67', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-07-06', NULL, 'results/2020-07-06_11-56-15lppkm_pkm.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"kegiatan\":\"asd\",\"jabatan\":\"asd\",\"lokasi\":\"asd\",\"waktu\":\"07-07-2020 - 08-07-2020\",\"sumberDana\":\"asd\",\"validasi\":\"ujank\"}', 'belum tervalidasi', '1', '1');
INSERT INTO `tbl_surat` VALUES (68, '21', '68', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-07-06', NULL, 'results/2020-07-06_11-58-01lppkm_pkm.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"kegiatan\":\"\",\"jabatan\":\"\",\"lokasi\":\"\",\"waktu\":\"\",\"sumberDana\":\"\",\"validasi\":\"ujank\"}', 'belum tervalidasi', '1', '1');
INSERT INTO `tbl_surat` VALUES (69, '21', '69', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-07-07', NULL, 'results/2020-07-07_12-00-28lppkm_pkm.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"kegiatan\":\"\",\"jabatan\":\"\",\"lokasi\":\"\",\"waktu\":\"\",\"sumberDana\":\"\",\"validasi\":\"ujank\"}', 'belum tervalidasi', '1', '1');
INSERT INTO `tbl_surat` VALUES (70, '21', '70', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-07-07', NULL, 'results/2020-07-07_12-00-55lppkm_pkm.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"kegiatan\":\"\",\"jabatan\":\"\",\"lokasi\":\"\",\"waktu\":\"\",\"sumberDana\":\"\",\"validasi\":\"ujank\"}', 'belum tervalidasi', '1', '1');
INSERT INTO `tbl_surat` VALUES (71, '21', '71', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-07-07', NULL, 'results/2020-07-07_12-04-32lppkm_pkm.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"kegiatan\":\"\",\"jabatan\":\"\",\"lokasi\":\"\",\"waktu\":\"\",\"sumberDana\":\"\",\"validasi\":\"ujank\"}', 'belum tervalidasi', '1', '1');
INSERT INTO `tbl_surat` VALUES (72, '21', '72', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-07-07', 'results/pdf/2020-07-07_12-08-34lppkm_pkm.pdf', 'results/2020-07-07_12-08-34lppkm_pkm.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"kegiatan\":\"\",\"jabatan\":\"\",\"lokasi\":\"\",\"waktu\":\"\",\"sumberDana\":\"\",\"validasi\":\"ujank\"}', 'belum tervalidasi', '1', '1');
INSERT INTO `tbl_surat` VALUES (73, '21', '73', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-07-07', 'results/pdf/2020-07-07_12-10-03lppkm_pkm.pdf', 'results/2020-07-07_12-10-03lppkm_pkm.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"kegiatan\":\"\",\"jabatan\":\"\",\"lokasi\":\"\",\"waktu\":\"\",\"sumberDana\":\"\",\"validasi\":\"ujank\"}', 'belum tervalidasi', '1', '1');
INSERT INTO `tbl_surat` VALUES (74, '21', '74', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-07-07', 'results/pdf/2020-07-07_12-10-33lppkm_pkm.pdf', 'results/2020-07-07_12-10-33lppkm_pkm.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"kegiatan\":\"\",\"jabatan\":\"\",\"lokasi\":\"\",\"waktu\":\"\",\"sumberDana\":\"\",\"validasi\":\"ujank\"}', 'belum tervalidasi', '1', '1');

SET FOREIGN_KEY_CHECKS = 1;
