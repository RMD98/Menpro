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

 Date: 19/06/2020 01:41:38
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
INSERT INTO `tbl_account` VALUES (4, '2', 'FAKULTAS TEKNOLOGI INDUSTRI', '1', 'fakultas');
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
  PRIMARY KEY (`Nip`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Tabel untuk data pegawai digunakan untuk detail pegawai' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_pegawai
-- ----------------------------
INSERT INTO `tbl_pegawai` VALUES ('1', 'ujank', '2020-03-16', 'bandung', 'kircon', '092', 'asd@asd.asd', 'Y');
INSERT INTO `tbl_pegawai` VALUES ('2', 'asep', '2020-03-16', 'bandung', 'kircon', '092', 'asd@asd.asd', 'Y');

-- ----------------------------
-- Table structure for tbl_rapat
-- ----------------------------
DROP TABLE IF EXISTS `tbl_rapat`;
CREATE TABLE `tbl_rapat`  (
  `IdRapat` int(11) NOT NULL COMMENT 'Primary Id Rapat',
  `NIP` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'Pembuat rapat dan foreign key untuk pegawai',
  `TopikRapat` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'topik rapat',
  `TglMulai` date NULL DEFAULT NULL COMMENT 'tanggal mulai rapat',
  `TglAkhir` date NULL DEFAULT NULL COMMENT 'tanggal selesai rapat',
  `WaktuMulai` time(0) NULL DEFAULT NULL COMMENT 'waktu mulai rapat',
  `WaktuAkhir` time(0) NULL DEFAULT NULL COMMENT 'waktu selesai rapat',
  `MOM` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL COMMENT 'MOM rapat',
  PRIMARY KEY (`IdRapat`) USING BTREE,
  INDEX `FK_tbl_rapat_tbl_pegawai`(`NIP`) USING BTREE,
  CONSTRAINT `FK_tbl_rapat_tbl_pegawai` FOREIGN KEY (`NIP`) REFERENCES `tbl_pegawai` (`Nip`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Tabel untuk data rapat digunakan menyimpan data rapat' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_rapat
-- ----------------------------
INSERT INTO `tbl_rapat` VALUES (0, '1', 'test rapat', '2020-06-16', '2020-06-16', '11:30:00', '11:35:00', '-');

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
INSERT INTO `tbl_sk` VALUES ('10', 'Pemberian Tugas & Wewenang Dosen Pengampu', 'fakultas_Pemberian_Tugas_Dosen_Pengampu.docx', '{\"dosenSurat\":{\"type\":\"textSugestion\",\"label\":\"Nama Dosen\",\"source\":\"dosen\"},\"matkul\":{\"type\":\"array\",\"label\":\"List Matakuliah\",\"source\":\"matkul\"}}', 'fakultas', '{\"pembuat\":\"NamaPegawai\",\"nipPembuat\":\"NIP\",\"JenisSurat\":\"jenis\",\"No\":\"test\",\"date\":\"d-m-Y\",\"thn\":\"Y\",\"Departement\":\"NamaDepartement\",\"username\":\"Username\",\"nipSurat\":\"NipSurat\",\"dosenSurat\":\"dosenSurat\",\"arrayofMatkul\":\"test\"}');
INSERT INTO `tbl_sk` VALUES ('11', 'Penugasan Dosen Penguji Pada Ujian Tugas Akhir', 'fakultas_Penugasan_Sebagai_Penguji.docx', '{\"ketuaDosen\":{\"type\":\"textSugestion\",\"label\":\"Ketua\",\"source\":\"dosen\"},\"dosen\":{\"type\":\"array\",\"label\":\"List Penguji(ketua pertama)\",\"source\":\"dosen\"},\"mhs\":{\"type\":\"text\",\"label\":\"Nama Mahasiswa\"},\"judul\":{\"type\":\"text\",\"label\":\"Judul TA\"},\"waktu\":{\"type\":\"datePicker\",\"label\":\"Waktu uji\",\"name\":\"tanggal\"},\"Nrp\":{\"type\":\"text\",\"label\":\"NRP\"}}', 'fakultas', '{\"pembuat\":\"NamaPegawai\",\"nipPembuat\":\"NIP\",\"JenisSurat\":\"jenis\",\"Username\":\"Username\",\"No\":\"test\",\"date\":\"d-m-Y\",\"thn\":\"Y\",\"Departement\":\"NamaDepartement\",\"arrayofDosen\":\"test\",\"ketuaDosen\":\"ketuaDosen\",\"Mahasiswa\":\"mhs\",\"NIM\":\"Nrp\",\"waktu\":\"waktu\",\"judul\":\"judul\"}');
INSERT INTO `tbl_sk` VALUES ('12', 'Pemberian Tugas dan Wewenang mengajar', 'fakultas_pemberian_tugas_mengajar.docx', '{\"dosenSurat\":{\"type\":\"textSugestion\",\"label\":\"Nama Dosen\",\"source\":\"dosen\"},\"matkul\":{\"type\":\"array\",\"label\":\"List Matakuliah\",\"source\":\"matkul\"}}', 'fakultas', '{\"pembuat\":\"NamaPegawai\",\"nipPembuat\":\"NIP\",\"JenisSurat\":\"jenis\",\"No\":\"test\",\"date\":\"d-m-Y\",\"thn\":\"Y\",\"Departement\":\"NamaDepartement\",\"username\":\"Username\",\"nipSurat\":\"NipSurat\",\"dosenSurat\":\"dosenSurat\",\"arrayofMatkul\":\"test\"}');
INSERT INTO `tbl_sk` VALUES ('13', 'Pengangkatan Para Dosen-Kopembimbing Tugas Akhir', NULL, '{\"lokasi\":{\"type\":\"textSugestion\",\"label\":\"Lokasi\",\"source\":\"jurusan\"},\"tujuan\":{\"type\":\"array\",\"label\":\"kepada\",\"source\":\"dosen\"},\"isi\":{\"type\":\"longText\",\"label\":\"isi surat\"}}', 'fakultas', NULL);
INSERT INTO `tbl_sk` VALUES ('14', 'Penugasan Melaksanakan Penelitian', 'jurusan_Penugasan Melaksanakan Penelitian.docx', '{\"dosen\":{\"type\":\"array\",\"label\":\"List Dosen\",\"source\":\"dosen\"}}', 'jurusan', '{\"pembuat\":\"NamaPegawai\",\"nipPembuat\":\"NIP\",\"JenisSurat\":\"jenis\",\"No\":\"test\",\"date\":\"d-m-Y\",\"thn\":\"Y\",\"Departement\":\"NamaDepartement\",\"arrayofDosen\":\"test\"}');
INSERT INTO `tbl_sk` VALUES ('15', 'Penugasan Sebagai Tim Akreditasi', 'jurusan_Penugasan Sebagai Tim Akreditasi.docx', '{\"ketuaDosen\":{\"type\":\"textSugestion\",\"label\":\"Ketua\",\"source\":\"dosen\"},\"dosen\":{\"type\":\"array\",\"label\":\"Anggota\",\"source\":\"dosen\"}}', 'jurusan', '{\"pembuat\":\"NamaPegawai\",\"nipPembuat\":\"NIP\",\"JenisSurat\":\"jenis\",\"No\":\"test\",\"date\":\"d-m-Y\",\"thn\":\"Y\",\"Departement\":\"NamaDepartement\",\"arrayofDosen\":\"test\",\"ketuaDosen\":\"ketuaDosen\"}');
INSERT INTO `tbl_sk` VALUES ('16', 'Penugasan Sebagai Reviewer Publikasi Untuk Jabatan Akademis', 'jurusan_Penugasan Sebagai Reviewer Publikasi.docx', '{\"dosen\":{\"type\":\"array\",\"label\":\"List Dosen\",\"source\":\"dosen\"}}', 'jurusan', '{\"pembuat\":\"NamaPegawai\",\"nipPembuat\":\"NIP\",\"JenisSurat\":\"jenis\",\"No\":\"test\",\"date\":\"d-m-Y\",\"thn\":\"Y\",\"Departement\":\"NamaDepartement\",\"arrayofDosen\":\"test\"}');
INSERT INTO `tbl_sk` VALUES ('17', 'Penugasan Sebagai Redaksi Jurnal Jurusan ', NULL, '{\"dosen\":{\"type\":\"array\",\"label\":\"List Dosen (ketua pertama)\",\"source\":\"dosen\"}}', 'fakultas', NULL);
INSERT INTO `tbl_sk` VALUES ('18', 'Penugasan Sebagai Koordinator Kuliah Tamu', NULL, '{\"dosen\":{\"type\":\"textSugestion\",\"label\":\"List Dosen\",\"source\":\"dosen\"}}', 'fakultas', NULL);
INSERT INTO `tbl_sk` VALUES ('19', 'Penugasan Sebagai Koordinator Tim PKKM', NULL, '{\"dosen\":{\"type\":\"textSugestion\",\"label\":\"List Dosen\",\"source\":\"dosen\"}}', 'fakultas', NULL);
INSERT INTO `tbl_sk` VALUES ('2', 'sk dosen', 'fakultas_BimbinganTugasAkhir.docx', '{\"lokasi\":{\"type\":\"textSugestion\",\"label\":\"Lokasi\",\"source\":\"jurusan\"},\"tujuan\":{\"type\":\"array\",\"label\":\"kepada\",\"source\":\"dosen\"},\"isi\":{\"type\":\"longText\",\"label\":\"isi surat\"}}', 'admin', NULL);
INSERT INTO `tbl_sk` VALUES ('20', 'Penugasan Melaksanakan PKM', NULL, '{\"dosen\":{\"type\":\"array\",\"label\":\"List Dosen\",\"source\":\"dosen\"}}', 'fakultas', NULL);
INSERT INTO `tbl_sk` VALUES ('21', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat Institut Teknologi Nasional', 'lppkm_pkm.docx', '{\"dosenSurat\":{\"type\":\"textSugestion\",\"label\":\"Nama Dosen\",\"source\":\"dosen\"},\"kegiatan\":{\"type\":\"text\",\"label\":\"Nama Kegiatan\"},\"jabatan\":{\"type\":\"text\",\"label\":\"Jabatan\"},\"lokasi\":{\"type\":\"text\",\"label\":\"Lokasi Kegiatan\"},\"waktu\":{\"type\":\"datePicker\",\"label\":\"Waktu Mulai - Selesai\",\"name\":\"rangeTanggal\"},\"sumberDana\":{\"type\":\"text\",\"label\":\"Sumber Dana\"}}', 'dosen', '{\"JenisSurat\":\"jenis\",\"No\":\"test\",\"thn\":\"Y\",\"Departement\":\"NamaDepartement\",\"dosen\":\"dosenSurat\",\"NIP\":\"NIP\",\"jabatan\":\"jabatan\",\"kegiatan\":\"kegiatan\",\"tempat\":\"lokasi\",\"waktuKegiatan\":\"waktu\",\"dana\":\"sumberDana\",\"pembuat\":\"NamaPegawai\",\"NIP\":\"NipSurat\",\"nipPembuat\":\"NIP\",\"date\":\"d-m-Y\"}');
INSERT INTO `tbl_sk` VALUES ('22', 'Pelatihan', NULL, '{\"lokasi\":{\"type\":\"textSugestion\",\"label\":\"Lokasi\",\"source\":\"jurusan\"},\"tujuan\":{\"type\":\"array\",\"label\":\"kepada\",\"source\":\"dosen\"},\"isi\":{\"type\":\"longText\",\"label\":\"isi surat\"}}', 'rektor', NULL);
INSERT INTO `tbl_sk` VALUES ('23', 'Pelaksanaan Penelitian Dosen Muda', 'Rektor_pelatihan dosen muda.docx', '{\"judul\":{\"type\":\"text\",\"label\":\"Judul\"},\"pimpinan\":{\"type\":\"textSugestion\",\"label\":\"pimpinan\",\"source\":\"dosen\"},\"rekan\":{\"type\":\"textSugestion\",\"label\":\"rekan\",\"source\":\"dosen\"},\"dana\":{\"type\":\"text\",\"label\":\"Dana\"},\"waktu\":{\"type\":\"datePicker\",\"label\":\"Waktu Rapat\",\"name\":\"tanggal\"}}', 'rektor', '{\"pembuat\":\"NamaPegawai\",\"nipPembuat\":\"NIP\",\"JenisSurat\":\"jenis\",\"No\":\"test\",\"date\":\"d-m-Y\",\"thn\":\"Y\",\"waktu\":\"waktu\",\"pimpinan\":\"pimpinan\",\"rekan\":\"rekan\",\"dana\":\"dana\",\"Departement\":\"NamaDepartement\",\"judul\":\"judul\"}');
INSERT INTO `tbl_sk` VALUES ('24', 'Pembetukan Tim Auditor Internal', NULL, '{\"lokasi\":{\"type\":\"textSugestion\",\"label\":\"Lokasi\",\"source\":\"jurusan\"},\"tujuan\":{\"type\":\"array\",\"label\":\"kepada\",\"source\":\"dosen\"},\"isi\":{\"type\":\"longText\",\"label\":\"isi surat\"}}', 'rektor', NULL);
INSERT INTO `tbl_sk` VALUES ('25', 'Surat Keluar', NULL, '{\"lokasi\":{\"type\":\"textSugestion\",\"label\":\"Lokasi\",\"source\":\"jurusan\"},\"tujuan\":{\"type\":\"array\",\"label\":\"kepada\",\"source\":\"dosen\"},\"isi\":{\"type\":\"longText\",\"label\":\"isi surat\"}}', 'admin', NULL);
INSERT INTO `tbl_sk` VALUES ('26', 'Surat Masuk', NULL, '{\"lokasi\":{\"type\":\"textSugestion\",\"label\":\"Lokasi\",\"source\":\"jurusan\"},\"tujuan\":{\"type\":\"array\",\"label\":\"kepada\",\"source\":\"dosen\"},\"isi\":{\"type\":\"longText\",\"label\":\"isi surat\"}}', 'admin', NULL);
INSERT INTO `tbl_sk` VALUES ('3', 'Pelaksanaan Bimbingan Tugas Akhir', 'fakultas_BimbinganTugasAkhir.docx', '{\"NamaDosen\":{\"type\":\"textSugestion\",\"label\":\"Nama Dosen Pembimbing\",\"source\":\"dosen\"},\"NamaMahasiswa\":{\"type\":\"text\",\"label\":\"Nama Mahasiswa\"},\"NRP\":{\"type\":\"text\",\"label\":\"NRP\"},\"Jurusan\":{\"type\":\"textSugestion\",\"label\":\"Jurusan\",\"source\":\"jurusan\"},\"JudulTA\":{\"type\":\"text\",\"label\":\"Judul TA\"}}', 'fakultas', '{\"JenisSurat\":\"jenis\",\"Departement\":\"NamaDepartement\",\"dosen\":\"NamaDosen\",\"mahasiswa\":\"NamaMahasiswa\",\"nrp\":\"NRP\",\"jurusan\":\"Jurusan\",\"judulTA\":\"JudulTA\",\"date\":\"d-m-Y\",\"pembuat\":\"NamaPegawai\",\"No\":\"test\",\"thn\":\"Y\"}');
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
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Tabel untuk data tujuan surat digunakan untuk detail surat' ROW_FORMAT = Dynamic;

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
  `File` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'file ketika surat sudah di bentuk, untuk kebutuhan download',
  `Value` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL COMMENT 'berupa jenis input dan data yang sudah diinputkan user',
  `Status` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'status terkirim surat',
  PRIMARY KEY (`IdSurat`) USING BTREE,
  INDEX `FK_tbl_surat_tbl_sk`(`IdSK`) USING BTREE,
  CONSTRAINT `FK_tbl_surat_tbl_sk` FOREIGN KEY (`IdSK`) REFERENCES `tbl_sk` (`IdSK`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 34 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Tabel untuk data surat digunakan untuk menyimpan data surat' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_surat
-- ----------------------------
INSERT INTO `tbl_surat` VALUES (1, '1', 'asd', 'test', '2020-03-16', NULL, '{\"no_surat\":\"asdasd\",\"tujuan\":[\"ujank\",\"asep\"],\"isi\":\"asdapasdpaspd\"}', NULL);
INSERT INTO `tbl_surat` VALUES (2, '1', NULL, 'test', '2020-03-17', NULL, '{\"no_surat\":\"\",\"isi\":\"\"}', NULL);
INSERT INTO `tbl_surat` VALUES (3, '1', NULL, 'test', '2020-03-17', NULL, '{\"no_surat\":\"\",\"isi\":\"\"}', NULL);
INSERT INTO `tbl_surat` VALUES (4, '1', NULL, 'test', '2020-03-17', NULL, '{\"no_surat\":\"123\",\"tujuan\":[\"ujank\"],\"isi\":\"asdasd\"}', NULL);
INSERT INTO `tbl_surat` VALUES (5, '2', NULL, 'test', '2020-03-17', NULL, '{\"no_surat\":\"12313\",\"tujuan\":[\"ujank\"],\"isi\":\"asdasdad\"}', NULL);
INSERT INTO `tbl_surat` VALUES (6, '21', NULL, 'test', '2020-03-17', NULL, '{\"no_surat\":\"asdsad\",\"tujuan\":[\"ujank\",\"asep\"],\"isi\":\"asdsadas\"}', NULL);
INSERT INTO `tbl_surat` VALUES (7, '1', NULL, 'test', '2020-03-17', NULL, '{\"isi\":\"\"}', NULL);
INSERT INTO `tbl_surat` VALUES (8, '21', NULL, 'test', '2020-03-17', NULL, '{\"lokasi\":\"\",\"isi\":\"\"}', NULL);
INSERT INTO `tbl_surat` VALUES (9, '21', 'test', 'test', '2020-03-17', NULL, '{\"lokasi\":[\"Desain dan Komunikasi Visual\"],\"tujuan\":[\"ujank\",\"asep\"],\"isi\":\"asdsadas\"}', NULL);
INSERT INTO `tbl_surat` VALUES (10, '11', 'test', 'Penugasan Dosen Penguji Pada Ujian Tugas Akhir', '2020-03-17', NULL, '{\"penguji\":[\"ujank\",\"asep\"],\"mhs\":\"asd\",\"judul\":\"asdasdasd\"}', NULL);
INSERT INTO `tbl_surat` VALUES (11, '21', 'test', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-03-19', NULL, '{\"dosen\":[\"ujank\"],\"kegiatan\":\"\",\"lokasi\":\"\",\"sumberDana\":\"\"}', NULL);
INSERT INTO `tbl_surat` VALUES (12, '23', 'test', 'Pelaksanaan Penelitian Dosen Muda', '2020-03-19', NULL, '{\"lokasi\":[\"Mesin\"],\"isi\":\"\"}', NULL);
INSERT INTO `tbl_surat` VALUES (13, '25', 'test', 'Surat Keluar', '2020-03-19', NULL, '{\"lokasi\":[\"Informatika\"],\"isi\":\"\"}', NULL);
INSERT INTO `tbl_surat` VALUES (14, '26', 'test', 'Surat Masuk', '2020-03-19', NULL, '{\"lokasi\":[\"Informatika\"],\"isi\":\"\"}', NULL);
INSERT INTO `tbl_surat` VALUES (15, '25', 'test', 'Surat Keluar', '2020-03-19', NULL, '{\"lokasi\":[\"Informatika\"],\"isi\":\"\"}', NULL);
INSERT INTO `tbl_surat` VALUES (16, '25', 'test', 'Surat Keluar', '2020-03-19', NULL, '{\"lokasi\":[\"Informatika\"],\"isi\":\"\"}', NULL);
INSERT INTO `tbl_surat` VALUES (17, '21', 'test', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-03-23', NULL, '{\"dosen\":[\"ujank\"],\"kegiatan\":\"asd\",\"lokasi\":\"asd\",\"sumberDana\":\"asd\"}', NULL);
INSERT INTO `tbl_surat` VALUES (18, '26', 'test', 'Surat Masuk', '2020-03-23', NULL, '{\"lokasi\":[\"Informatika\"],\"tujuan\":[\"asep\"],\"isi\":\"asdasd\"}', NULL);
INSERT INTO `tbl_surat` VALUES (19, '15', 'test', 'Penugasan Sebagai Tim Akreditasi', '2020-03-23', NULL, '{\"dosen\":[\"ujank\",\"asep\"]}', NULL);
INSERT INTO `tbl_surat` VALUES (20, '2', 'test', 'sk dosen', '2020-06-15', 'results/fakultas_BimbinganTugasAkhir_2020-06-15_11', '{\"jenis\":\"Surat Keputusan\",\"lokasi\":\"Informatika\",\"tujuan\":[\"ujank\"],\"isi\":\"asd\"}', NULL);
INSERT INTO `tbl_surat` VALUES (21, '3', 'test', 'Pelaksanaan Bimbingan Tugas Akhir', '2020-06-15', 'results/fakultas_BimbinganTugasAkhir_2020-06-15_11', '{\"jenis\":\"Surat Keputusan\",\"NamaDosen\":\"ujank\",\"NamaMahasiswa\":\"asd\",\"NRP\":\"123\",\"Jurusan\":\"Informatika\",\"JudulTA\":\"asd\"}', NULL);
INSERT INTO `tbl_surat` VALUES (22, '21', '22', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-06-16', 'results/2020-06-16_08-46-00 lppkm_pkm.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"kegiatan\":\"asd\",\"jabatan\":\"asdasd\",\"lokasi\":\"asd\",\"waktu\":\"16-06-2020\",\"sumberDana\":\"asd\"}', NULL);
INSERT INTO `tbl_surat` VALUES (23, '21', '23', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-06-16', 'results/2020-06-16_08-46-32 lppkm_pkm.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"kegiatan\":\"asd\",\"jabatan\":\"asd\",\"lokasi\":\"asd\",\"waktu\":\"16-06-2020 - 16-06-2020\",\"sumberDana\":\"asd\"}', NULL);
INSERT INTO `tbl_surat` VALUES (24, '21', '24', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-06-16', 'results/2020-06-16_08-49-30 lppkm_pkm.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"kegiatan\":\"asd\",\"jabatan\":\"asd\",\"lokasi\":\"asd\",\"waktu\":\"asd\",\"sumberDana\":\"asd\"}', NULL);
INSERT INTO `tbl_surat` VALUES (25, '21', '25', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-06-16', 'results/2020-06-16_08-50-13 lppkm_pkm.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"kegiatan\":\"asd\",\"jabatan\":\"asd\",\"lokasi\":\"asd\",\"waktu\":\"asd\",\"sumberDana\":\"asd\"}', NULL);
INSERT INTO `tbl_surat` VALUES (26, '21', '26', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-06-16', 'results/2020-06-16_08-50-53 lppkm_pkm.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"kegiatan\":\"asd\",\"jabatan\":\"asd\",\"lokasi\":\"asd\",\"waktu\":\"asd\",\"sumberDana\":\"asd\"}', NULL);
INSERT INTO `tbl_surat` VALUES (27, '21', '27', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-06-16', 'results/2020-06-16_08-54-35 lppkm_pkm.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"kegiatan\":\"asd\",\"jabatan\":\"asd\",\"lokasi\":\"asd\",\"waktu\":\"16-06-2020\",\"sumberDana\":\"asd\"}', NULL);
INSERT INTO `tbl_surat` VALUES (28, '21', '28', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-06-16', 'results/2020-06-16_08-54-49 lppkm_pkm.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"kegiatan\":\"asd\",\"jabatan\":\"asd\",\"lokasi\":\"asd\",\"waktu\":\"asd\",\"sumberDana\":\"sad\"}', NULL);
INSERT INTO `tbl_surat` VALUES (29, '21', '29', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-06-16', 'results/2020-06-16_08-55-01 lppkm_pkm.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"kegiatan\":\"asd\",\"jabatan\":\"asd\",\"lokasi\":\"sd\",\"waktu\":\"asd\",\"sumberDana\":\"asd\"}', NULL);
INSERT INTO `tbl_surat` VALUES (30, '21', '30', 'Melakukan Kegiatan Pengabdian Kepada Masyarakat In', '2020-06-16', 'results/2020-06-16_08-55-38 lppkm_pkm.docx', '{\"jenis\":\"Surat Keputusan\",\"dosenSurat\":\"ujank\",\"kegiatan\":\"asd\",\"jabatan\":\"asd\",\"lokasi\":\"sd\",\"waktu\":\"asd\",\"sumberDana\":\"asd\"}', NULL);
INSERT INTO `tbl_surat` VALUES (31, '14', '31', 'Penugasan Melaksanakan Penelitian', '2020-06-16', 'results/2020-06-16_08-56-45 jurusan_Penugasan Melaksanakan Penelitian.docx', '{\"jenis\":\"Surat Keterangan\",\"dosen\":[\"ujank\",\"asep\"]}', NULL);
INSERT INTO `tbl_surat` VALUES (32, '14', '32', 'Penugasan Melaksanakan Penelitian', '2020-06-16', 'results/2020-06-16_08-58-47 jurusan_Penugasan Melaksanakan Penelitian.docx', '{\"jenis\":\"Surat Keterangan\",\"dosen\":[\"ujank\",\"asep\"]}', NULL);
INSERT INTO `tbl_surat` VALUES (33, '14', '33', 'Penugasan Melaksanakan Penelitian', '2020-06-16', 'results/2020-06-16_11-12-10 jurusan_Penugasan Melaksanakan Penelitian.docx', '{\"jenis\":\"Surat Keputusan\",\"dosen\":[\"ujank\",\"asep\"]}', NULL);

SET FOREIGN_KEY_CHECKS = 1;
