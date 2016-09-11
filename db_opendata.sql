/*
Navicat MariaDB Data Transfer

Source Server         : MariaDB
Source Server Version : 100109
Source Host           : localhost:3306
Source Database       : db_opendata

Target Server Type    : MariaDB
Target Server Version : 100109
File Encoding         : 65001

Date: 2016-08-18 22:26:53
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for alumni
-- ----------------------------
DROP TABLE IF EXISTS `alumni`;
CREATE TABLE `alumni` (
  `ID_ALUMNI` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PRODI` int(11) NOT NULL,
  `NAMA_ALUMNI` varchar(40) NOT NULL,
  `TAHUN_MASUK` int(11) NOT NULL,
  `TAHUN_KELUAR` int(11) NOT NULL,
  `EMAIL_ALUMNI` varchar(50) DEFAULT NULL,
  `NO_HP` varchar(12) NOT NULL,
  `ALAMAT_ALUMNI` varchar(50) DEFAULT NULL,
  `PEKERJAAN` varchar(20) DEFAULT NULL,
  `USERNAME` varchar(10) NOT NULL,
  `PASSWORD` varchar(20) NOT NULL,
  `FOTO` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_ALUMNI`),
  KEY `FK_KULIAH_DI` (`ID_PRODI`),
  CONSTRAINT `FK_KULIAH_DI` FOREIGN KEY (`ID_PRODI`) REFERENCES `program_studi` (`ID_PRODI`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of alumni
-- ----------------------------
INSERT INTO `alumni` VALUES ('1', '16', 'Saya Alumni', '2010', '2015', 'rpl4rt08@gmail.com', '083821708285', 'Lembang', 'Software Engineer', 'alumni', 'alumni', 'upload/alumni/alumni_20160815015056.gif');
INSERT INTO `alumni` VALUES ('2', '16', 'Saya Alumni Lagi', '2010', '2015', 'rpl4rt08@gmail.com', '083821708285', 'Lembang', 'Software Engineer', 'alumni2', 'alumni', null);
INSERT INTO `alumni` VALUES ('3', '8', 'Dick', '2003', '2009', 'rpl@yahoo.com', '08327313131', 'lembang', 'Naon we', '', '', null);

-- ----------------------------
-- Table structure for bekerja
-- ----------------------------
DROP TABLE IF EXISTS `bekerja`;
CREATE TABLE `bekerja` (
  `ID_BEKERJA` int(11) NOT NULL AUTO_INCREMENT,
  `ID_ALUMNI` int(11) NOT NULL,
  `ID_PERUSAHAAN` int(11) NOT NULL,
  `JABATAN_PEKERJAAN` varchar(12) NOT NULL,
  `TAHUN_MULAI` int(11) NOT NULL,
  `TAHUN_BERHENTI` int(11) NOT NULL,
  PRIMARY KEY (`ID_BEKERJA`),
  KEY `FK_BEKERJA_DI` (`ID_ALUMNI`),
  KEY `FK_DITEMPATI_KERJA` (`ID_PERUSAHAAN`),
  CONSTRAINT `FK_BEKERJA_DI` FOREIGN KEY (`ID_ALUMNI`) REFERENCES `alumni` (`ID_ALUMNI`),
  CONSTRAINT `FK_DITEMPATI_KERJA` FOREIGN KEY (`ID_PERUSAHAAN`) REFERENCES `perusahaan` (`ID_PERUSAHAAN`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of bekerja
-- ----------------------------
INSERT INTO `bekerja` VALUES ('1', '1', '2', 'Programmer', '2013', '0');
INSERT INTO `bekerja` VALUES ('2', '1', '1', 'Adaw', '1991', '1992');

-- ----------------------------
-- Table structure for jurusan
-- ----------------------------
DROP TABLE IF EXISTS `jurusan`;
CREATE TABLE `jurusan` (
  `ID_JURUSAN` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_JURUSAN` varchar(30) NOT NULL,
  PRIMARY KEY (`ID_JURUSAN`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of jurusan
-- ----------------------------
INSERT INTO `jurusan` VALUES ('1', 'Administrasi Niaga');
INSERT INTO `jurusan` VALUES ('2', 'Teknik Sipil');
INSERT INTO `jurusan` VALUES ('3', 'Teknik Mesin');
INSERT INTO `jurusan` VALUES ('4', 'Teknik Refrigasi dan Tata Udar');
INSERT INTO `jurusan` VALUES ('5', 'Teknik Komputer dan Informatik');
INSERT INTO `jurusan` VALUES ('6', 'Teknik Konversi Energi');
INSERT INTO `jurusan` VALUES ('7', 'Teknik Elektro');
INSERT INTO `jurusan` VALUES ('8', 'Teknik Kimia');
INSERT INTO `jurusan` VALUES ('9', 'Akuntansi');
INSERT INTO `jurusan` VALUES ('10', 'Bahasa Inggris');

-- ----------------------------
-- Table structure for perusahaan
-- ----------------------------
DROP TABLE IF EXISTS `perusahaan`;
CREATE TABLE `perusahaan` (
  `ID_PERUSAHAAN` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_PERUSAHAAN` varchar(20) NOT NULL,
  `EMAIL_PERUSAHAAN` varchar(40) NOT NULL,
  `NOMOR_TELEPON_PERUSAHAAN` varchar(12) DEFAULT NULL,
  `ALAMAT_PERUSAHAAN` varchar(20) NOT NULL,
  `BIDANG_PEKERJAAN` varchar(20) NOT NULL,
  PRIMARY KEY (`ID_PERUSAHAAN`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of perusahaan
-- ----------------------------
INSERT INTO `perusahaan` VALUES ('1', 'Bara Enterprise', 'support@bara.co.id', '083242342', 'Sariwangi', 'IT Developer');
INSERT INTO `perusahaan` VALUES ('2', 'Javan Cipta Solusi', 'mail@javan.co.id', '83242342', 'Bandung', 'IT Consultant');

-- ----------------------------
-- Table structure for program_studi
-- ----------------------------
DROP TABLE IF EXISTS `program_studi`;
CREATE TABLE `program_studi` (
  `ID_PRODI` int(11) NOT NULL AUTO_INCREMENT,
  `ID_JURUSAN` int(11) NOT NULL,
  `NAMA_PRODI` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_PRODI`),
  KEY `FK_MEMILIKI` (`ID_JURUSAN`),
  CONSTRAINT `FK_MEMILIKI` FOREIGN KEY (`ID_JURUSAN`) REFERENCES `jurusan` (`ID_JURUSAN`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of program_studi
-- ----------------------------
INSERT INTO `program_studi` VALUES ('1', '1', 'D3-Administrasi Bisnis');
INSERT INTO `program_studi` VALUES ('2', '1', 'D3-Manajemen Pemasaran');
INSERT INTO `program_studi` VALUES ('3', '1', 'D3-Usaha Perjalanan Wisata');
INSERT INTO `program_studi` VALUES ('4', '1', 'D4-Manajemen Pemasaran');
INSERT INTO `program_studi` VALUES ('5', '1', 'D4-Manajemen Aset');
INSERT INTO `program_studi` VALUES ('6', '1', 'D4-Administrisi Bisnis');
INSERT INTO `program_studi` VALUES ('7', '2', 'D3-Teknik Konstruksi Sipil');
INSERT INTO `program_studi` VALUES ('8', '2', 'D3-Teknik Konstruksi Gedung');
INSERT INTO `program_studi` VALUES ('9', '2', 'D4-Teknik Perancangan Jalan dan');
INSERT INTO `program_studi` VALUES ('10', '2', 'D4-Teknik Perawatan dan Perbaikan');
INSERT INTO `program_studi` VALUES ('11', '3', 'D3-Teknik Mesin');
INSERT INTO `program_studi` VALUES ('12', '3', 'D3-Aeronautika');
INSERT INTO `program_studi` VALUES ('13', '3', 'D4-TPKM');
INSERT INTO `program_studi` VALUES ('14', '3', 'D4-Proses Manufaktur');
INSERT INTO `program_studi` VALUES ('15', '5', 'D3-Teknik Informatika');
INSERT INTO `program_studi` VALUES ('16', '5', 'D4-Teknik Informatika');
INSERT INTO `program_studi` VALUES ('17', '7', 'D3-Teknik Elektronika');
INSERT INTO `program_studi` VALUES ('18', '7', 'D3-Teknik Listrik');
INSERT INTO `program_studi` VALUES ('19', '7', 'D3-Teknik Telekomunikasi');
INSERT INTO `program_studi` VALUES ('20', '7', 'D4-Teknik Elektronika');
INSERT INTO `program_studi` VALUES ('21', '7', 'D4-Teknik Telekomunikasi');
INSERT INTO `program_studi` VALUES ('22', '7', 'D4-Teknik Otomasi Industri');
INSERT INTO `program_studi` VALUES ('23', '8', 'D3-Teknik Kimia');
INSERT INTO `program_studi` VALUES ('24', '8', 'D3-Analis Kimia');
INSERT INTO `program_studi` VALUES ('25', '8', 'D4-Teknik Kimia Produksi Bersi');
INSERT INTO `program_studi` VALUES ('26', '9', 'D3-Akutansi');
INSERT INTO `program_studi` VALUES ('27', '9', 'D3-Keuangan Perbankan');
INSERT INTO `program_studi` VALUES ('28', '9', 'D4-Akutansi Manajemen Pemerint');
INSERT INTO `program_studi` VALUES ('29', '9', 'D4-Keuangan Syariah');
INSERT INTO `program_studi` VALUES ('30', '9', 'D4-Akutansi');
INSERT INTO `program_studi` VALUES ('31', '10', 'D3-Bahasa Inggris');
INSERT INTO `program_studi` VALUES ('32', '4', 'D3-Teknik Pendingin dan Tata U');
INSERT INTO `program_studi` VALUES ('33', '4', 'D4-Teknik Pendingin dan Tata U');
INSERT INTO `program_studi` VALUES ('34', '6', 'D3-Teknik Konversi Energi');
INSERT INTO `program_studi` VALUES ('35', '6', 'D4-TPTL');
INSERT INTO `program_studi` VALUES ('36', '6', 'D4-Teknik Konservasi Energi');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `ID_USER` int(11) NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar(11) NOT NULL,
  `ID_PRODI` int(11) DEFAULT NULL,
  `PASSWORD_USER` varchar(20) NOT NULL,
  `STATUS` int(11) NOT NULL,
  PRIMARY KEY (`ID_USER`),
  KEY `FK_KULIAH_DI_2_` (`ID_PRODI`),
  CONSTRAINT `FK_KULIAH_DI_2_` FOREIGN KEY (`ID_PRODI`) REFERENCES `program_studi` (`ID_PRODI`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('2', '151524010', '16', '151524010', '1');
INSERT INTO `user` VALUES ('3', '151524011', '16', '151524011', '2');
INSERT INTO `user` VALUES ('4', '151524012', '16', '151524012', '1');
