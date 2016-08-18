-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2016 at 07:54 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_opendata`
--

-- --------------------------------------------------------

--
-- Table structure for table `alumni`
--

CREATE TABLE IF NOT EXISTS `alumni` (
  `ID_ALUMNI` int(11) NOT NULL,
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
  `FOTO` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alumni`
--

INSERT INTO `alumni` (`ID_ALUMNI`, `ID_PRODI`, `NAMA_ALUMNI`, `TAHUN_MASUK`, `TAHUN_KELUAR`, `EMAIL_ALUMNI`, `NO_HP`, `ALAMAT_ALUMNI`, `PEKERJAAN`, `USERNAME`, `PASSWORD`, `FOTO`) VALUES
(1, 16, 'Saya Alumni', 2001, 2005, 'rpl4rt08@gmail.com', '083821708285', 'Lembang', 'WIRASWASTA COOL', 'alumni', 'alumni', 'upload/alumni/raisa.gif'),
(3, 16, 'Reka Alamsyah', 2000, 2013, 'reka.alamsyah.tif415@polban.ac.id', '082214283112', 'Antapani', 'Programmer', 'rekaas', 'localhost', NULL),
(4, 16, 'Rifa Azizah', 2016, 2020, 'rifa.azizah.tif415@polban.ac.id', '08997532192', 'Cimahi', 'Web Developer', 'rifaaz', 'localhost', NULL),
(5, 15, 'Nada Dwi Nurafifah', 2015, 2018, 'nada.dwi.tif15@polban.ac.id', '082213120429', 'Jakarta', 'Analisis Program', 'nadadwi', 'localhost', NULL),
(6, 15, 'Syifana Nurahmi', 2015, 2018, 'syifana.nurahmi.tif15@polban.ac.id', '081224469070', 'Subang', 'Web Developer', 'syifana', 'localhost', NULL),
(7, 15, 'Nur Rachmatika', 2016, 2019, 'nur.rachmatika.tif15@polban.ac.id', '081223912705', 'Cikadut', 'Analisis Program', 'nurrachma', 'localhost', NULL),
(8, 15, 'Lulu Luthfiyatul', 2015, 2019, 'lulu.luthfiyatul.tif15@polban.ac.id', '089765432123', 'Bandung', 'Programmer', 'lululuth', 'localhost', NULL),
(9, 1, 'Sarah Zafira', 2013, 2016, 'sarah.zafira.tif13@polban.ac.id', '081234567898', 'Tasikmalaya', 'Programmer', 'sarahzaf', 'localhost', NULL),
(10, 10, 'Muhammad Rizal', 2013, 2016, 'muhammad.rizal.tif13@polban.ac.id', '087654321234', 'Cimahi', 'Web Developer', 'muhrizal', 'localhost', NULL),
(11, 18, 'Nanda Maulida Agustin', 2014, 2017, 'nanda.maulida.tif14@polban.ac.id', '08887654312', 'Cikampek', 'Analisis Program', 'nandama', 'localhost', NULL),
(12, 7, 'Siska Seliani', 2014, 1991, 'siska.seliani.tif14@polban.ac.id', '085432123452', 'Garut', 'Programmer', 'sisel', 'localhost', NULL),
(13, 18, 'Hanna Hapfifah', 2014, 2017, 'hanna.hapfifah.tif14@polban.ac.id', '089627364598', 'Cimahi', 'Programmer', 'hannahap', 'localhost', NULL),
(14, 16, 'Prasetyo Trimukti Setiko', 2014, 2018, 'prasetyo.trimukti.tif14@polban.ac.id', '087654312345', 'Bandung', 'Game Developer', 'prasetyo', 'localhost', NULL),
(19, 1, 'Mutiara Trie Aprilian', 2015, 2018, 'mutiara.trie.tif15@polban.ac.id', '02389203', 'Cililin', 'Sistem Analis', 'mutiara.tr', 'localhost', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bekerja`
--

CREATE TABLE IF NOT EXISTS `bekerja` (
  `ID_BEKERJA` int(11) NOT NULL,
  `ID_ALUMNI` int(11) NOT NULL,
  `ID_PERUSAHAAN` int(11) NOT NULL,
  `JABATAN_PEKERJAAN` varchar(12) NOT NULL,
  `TAHUN_MULAI` int(11) NOT NULL,
  `TAHUN_BERHENTI` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bekerja`
--

INSERT INTO `bekerja` (`ID_BEKERJA`, `ID_ALUMNI`, `ID_PERUSAHAAN`, `JABATAN_PEKERJAAN`, `TAHUN_MULAI`, `TAHUN_BERHENTI`) VALUES
(1, 12, 1, 'Office manag', 1994, 1995);

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE IF NOT EXISTS `jurusan` (
  `ID_JURUSAN` int(11) NOT NULL,
  `NAMA_JURUSAN` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`ID_JURUSAN`, `NAMA_JURUSAN`) VALUES
(1, 'Administrasi Niaga'),
(2, 'Teknik Sipil'),
(3, 'Teknik Mesin'),
(4, 'Teknik Refrigasi dan Tata Udar'),
(5, 'Teknik Komputer dan Informatik'),
(6, 'Teknik Konversi Energi'),
(7, 'Teknik Elektro'),
(8, 'Teknik Kimia'),
(9, 'Akuntansi'),
(10, 'Bahasa Inggirs'),
(21, 'mm'),
(24, 'Tukijan');

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE IF NOT EXISTS `perusahaan` (
  `ID_PERUSAHAAN` int(11) NOT NULL,
  `NAMA_PERUSAHAAN` varchar(20) NOT NULL,
  `EMAIL_PERUSAHAAN` varchar(40) NOT NULL,
  `NOMOR_TELEPON_PERUSAHAAN` varchar(12) DEFAULT NULL,
  `ALAMAT_PERUSAHAAN` varchar(20) NOT NULL,
  `BIDANG_PEKERJAAN` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perusahaan`
--

INSERT INTO `perusahaan` (`ID_PERUSAHAAN`, `NAMA_PERUSAHAAN`, `EMAIL_PERUSAHAAN`, `NOMOR_TELEPON_PERUSAHAAN`, `ALAMAT_PERUSAHAAN`, `BIDANG_PEKERJAAN`) VALUES
(1, 'Bara Enterprise', 'support@bara.co.id', '83242342', 'Sariwangi', 'IT Consultant'),
(2, '0891174917712', 'mail@bsp.com', '10401855', 'sarijadi', 'PROGRAMMER');

-- --------------------------------------------------------

--
-- Table structure for table `program_studi`
--

CREATE TABLE IF NOT EXISTS `program_studi` (
  `ID_PRODI` int(11) NOT NULL,
  `ID_JURUSAN` int(11) NOT NULL,
  `NAMA_PRODI` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `program_studi`
--

INSERT INTO `program_studi` (`ID_PRODI`, `ID_JURUSAN`, `NAMA_PRODI`) VALUES
(1, 1, 'D3-Administrasi Bisnis'),
(2, 1, 'D3-Manajemen Pemasaran'),
(3, 1, 'D3-Usaha Perjalanan Wisata'),
(4, 1, 'D4-Manajemen Pemasaran'),
(5, 1, 'D4-Manajemen Aset'),
(6, 1, 'D4-Administrisi Bisnis'),
(7, 2, 'D3-Teknik Konstruksi Sipil'),
(8, 2, 'D3-Teknik Konstruksi Gedung'),
(9, 2, 'D4-Teknik Perancangan Jalan dan'),
(10, 2, 'D4-Teknik Perawatan dan Perbaikan'),
(11, 3, 'D3-Teknik Mesin'),
(12, 3, 'D3-Aeronautika'),
(13, 3, 'D4-TPKM'),
(14, 3, 'D4-Proses Manufaktur'),
(15, 5, 'D3-Teknik Informatika'),
(16, 5, 'D4-Teknik Informatika'),
(17, 7, 'D3-Teknik Elektronika'),
(18, 7, 'D3-Teknik Listrik'),
(19, 7, 'D3-Teknik Telekomunikasi'),
(20, 7, 'D4-Teknik Elektronika'),
(21, 7, 'D4-Teknik Telekomunikasi'),
(22, 7, 'D4-Teknik Otomasi Industri'),
(23, 8, 'D3-Teknik Kimia'),
(24, 8, 'D3-Analis Kimia'),
(25, 8, 'D4-Teknik Kimia Produksi Bersi'),
(26, 9, 'D3-Akutansi'),
(27, 9, 'D3-Keuangan Perbankan'),
(28, 9, 'D4-Akutansi Manajemen Pemerint'),
(29, 9, 'D4-Keuangan Syariah'),
(30, 9, 'D4-Akutansi'),
(31, 10, 'D3-Bahasa Inggris'),
(32, 4, 'D3-Teknik Pendingin dan Tata U'),
(33, 4, 'D4-Teknik Pendingin dan Tata U'),
(34, 6, 'D3-Teknik Konversi Energi'),
(35, 6, 'D4-TPTL'),
(36, 6, 'D4-Teknik Konservasi Energi');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID_USER` int(11) NOT NULL,
  `USERNAME` varchar(11) NOT NULL,
  `ID_PRODI` int(11) DEFAULT NULL,
  `PASSWORD_USER` varchar(20) NOT NULL,
  `STATUS` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID_USER`, `USERNAME`, `ID_PRODI`, `PASSWORD_USER`, `STATUS`) VALUES
(1, '141524010', 16, '151524010', 1),
(2, '141524010', 16, '141524010', 1),
(3, '151524011', 16, '151524011', 2),
(4, '151524012', 16, '151524012', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alumni`
--
ALTER TABLE `alumni`
  ADD PRIMARY KEY (`ID_ALUMNI`),
  ADD KEY `FK_KULIAH_DI` (`ID_PRODI`);

--
-- Indexes for table `bekerja`
--
ALTER TABLE `bekerja`
  ADD PRIMARY KEY (`ID_BEKERJA`),
  ADD KEY `FK_BEKERJA_DI` (`ID_ALUMNI`),
  ADD KEY `FK_DITEMPATI_KERJA` (`ID_PERUSAHAAN`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`ID_JURUSAN`);

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`ID_PERUSAHAAN`);

--
-- Indexes for table `program_studi`
--
ALTER TABLE `program_studi`
  ADD PRIMARY KEY (`ID_PRODI`),
  ADD KEY `FK_MEMILIKI` (`ID_JURUSAN`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID_USER`),
  ADD KEY `FK_KULIAH_DI_2_` (`ID_PRODI`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alumni`
--
ALTER TABLE `alumni`
  MODIFY `ID_ALUMNI` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `bekerja`
--
ALTER TABLE `bekerja`
  MODIFY `ID_BEKERJA` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `ID_JURUSAN` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `ID_PERUSAHAAN` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `program_studi`
--
ALTER TABLE `program_studi`
  MODIFY `ID_PRODI` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID_USER` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `alumni`
--
ALTER TABLE `alumni`
  ADD CONSTRAINT `FK_KULIAH_DI` FOREIGN KEY (`ID_PRODI`) REFERENCES `program_studi` (`ID_PRODI`);

--
-- Constraints for table `bekerja`
--
ALTER TABLE `bekerja`
  ADD CONSTRAINT `FK_BEKERJA_DI` FOREIGN KEY (`ID_ALUMNI`) REFERENCES `alumni` (`ID_ALUMNI`),
  ADD CONSTRAINT `FK_DITEMPATI_KERJA` FOREIGN KEY (`ID_PERUSAHAAN`) REFERENCES `perusahaan` (`ID_PERUSAHAAN`);

--
-- Constraints for table `program_studi`
--
ALTER TABLE `program_studi`
  ADD CONSTRAINT `FK_MEMILIKI` FOREIGN KEY (`ID_JURUSAN`) REFERENCES `jurusan` (`ID_JURUSAN`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_KULIAH_DI_2_` FOREIGN KEY (`ID_PRODI`) REFERENCES `program_studi` (`ID_PRODI`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
