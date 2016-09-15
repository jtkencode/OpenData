-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2016 at 07:13 AM
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
  `ID_TUGAS_AKHIR` int(11) NOT NULL,
  `NAMA_ALUMNI` varchar(40) NOT NULL,
  `TAHUN_MASUK` int(11) NOT NULL,
  `TAHUN_KELUAR` int(11) NOT NULL,
  `EMAIL_ALUMNI` varchar(50) DEFAULT NULL,
  `NO_HP` varchar(14) NOT NULL,
  `ALAMAT_ALUMNI` varchar(50) DEFAULT NULL,
  `PEKERJAAN` varchar(20) DEFAULT NULL,
  `USERNAME` varchar(10) NOT NULL,
  `PASSWORD` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alumni`
--

INSERT INTO `alumni` (`ID_ALUMNI`, `ID_PRODI`, `ID_TUGAS_AKHIR`, `NAMA_ALUMNI`, `TAHUN_MASUK`, `TAHUN_KELUAR`, `EMAIL_ALUMNI`, `NO_HP`, `ALAMAT_ALUMNI`, `PEKERJAAN`, `USERNAME`, `PASSWORD`) VALUES
(1, 2, 1, 'Joni', 2012, 2014, 'joni@gmail.com', '898348387', 'ciwaruga', 'Programmer', 'joni', 'joni99'),
(2, 13, 6, 'Tarmin Casano', 2013, 2016, 'tarmin@yahoo.com', '089847282478', 'Jalan Cagak Subang', 'Programmer', 'tarmin', 'localhost');

-- --------------------------------------------------------

--
-- Table structure for table `beasiswa`
--

CREATE TABLE IF NOT EXISTS `beasiswa` (
  `ID_BEASISWA` int(11) NOT NULL,
  `NAMA_BEASISWA` varchar(20) NOT NULL,
  `PENYELENGGARA_BEASISWA` varchar(30) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `beasiswa`
--

INSERT INTO `beasiswa` (`ID_BEASISWA`, `NAMA_BEASISWA`, `PENYELENGGARA_BEASISWA`) VALUES
(1, 'Djarum', 'Djarum');

-- --------------------------------------------------------

--
-- Table structure for table `bekerja`
--

CREATE TABLE IF NOT EXISTS `bekerja` (
  `ID_BEKERJA` int(11) NOT NULL,
  `ID_ALUMNI` int(11) NOT NULL,
  `ID_PERUSAHAAN` int(11) NOT NULL,
  `JABATAN_PEKERJAAN` varchar(12) NOT NULL,
  `TAHUN_BERHENTI` int(11) NOT NULL,
  `TAHUN_MULAI` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bekerja`
--

INSERT INTO `bekerja` (`ID_BEKERJA`, `ID_ALUMNI`, `ID_PERUSAHAAN`, `JABATAN_PEKERJAAN`, `TAHUN_BERHENTI`, `TAHUN_MULAI`) VALUES
(1, 1, 1, 'Ketua ', 1995, 1991);

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE IF NOT EXISTS `jurusan` (
  `ID_JURUSAN` int(11) NOT NULL,
  `NAMA_JURUSAN` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`ID_JURUSAN`, `NAMA_JURUSAN`) VALUES
(1, 'Administrasi Niaga'),
(2, 'Teknik Sipil'),
(3, 'Teknik Mesin'),
(4, 'Teknik Refrigasi dan Tata Udara'),
(5, 'Teknik Komputer dan Informatika'),
(6, 'Teknik Konversi Energi'),
(7, 'Teknik Elektro'),
(8, 'Teknik Kimia'),
(9, 'Akuntansi'),
(10, 'Bahasa Inggirs'),
(21, 'mm'),
(24, 'Tukijan');

-- --------------------------------------------------------

--
-- Table structure for table `karya_ilmiah`
--

CREATE TABLE IF NOT EXISTS `karya_ilmiah` (
  `ID_KARYA_ILMIAH` int(11) NOT NULL,
  `JUDUL_KARYA_ILMIAH` varchar(50) NOT NULL,
  `TUJUAN_PEMBUATAN_KARYA` varchar(50) DEFAULT NULL,
  `TAHUN_SELESAI_KARYA` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karya_ilmiah`
--

INSERT INTO `karya_ilmiah` (`ID_KARYA_ILMIAH`, `JUDUL_KARYA_ILMIAH`, `TUJUAN_PEMBUATAN_KARYA`, `TAHUN_SELESAI_KARYA`) VALUES
(1, 'Tempat Sampah Otomatis', 'agar bersih', 2015);

-- --------------------------------------------------------

--
-- Table structure for table `kompetisi`
--

CREATE TABLE IF NOT EXISTS `kompetisi` (
  `ID_KOMPETISI` int(11) NOT NULL,
  `NAMA_KOMPETISI` varchar(40) NOT NULL,
  `PENYELENGGARA_KOMPETISI` varchar(40) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kompetisi`
--

INSERT INTO `kompetisi` (`ID_KOMPETISI`, `NAMA_KOMPETISI`, `PENYELENGGARA_KOMPETISI`) VALUES
(1, 'Game Development', 'Comfest'),
(2, 'Competitive Programming', 'Comfest');

-- --------------------------------------------------------

--
-- Table structure for table `membuat_karya_ilmiah`
--

CREATE TABLE IF NOT EXISTS `membuat_karya_ilmiah` (
  `ID_MEMBUAT_KARYA` int(11) NOT NULL,
  `ID_ALUMNI` int(11) NOT NULL,
  `ID_KARYA_ILMIAH` int(11) NOT NULL,
  `TAHUN_PEMBUATAN` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `membuat_karya_ilmiah`
--

INSERT INTO `membuat_karya_ilmiah` (`ID_MEMBUAT_KARYA`, `ID_ALUMNI`, `ID_KARYA_ILMIAH`, `TAHUN_PEMBUATAN`) VALUES
(1, 1, 1, 2015);

-- --------------------------------------------------------

--
-- Table structure for table `mendapat_beasiswa`
--

CREATE TABLE IF NOT EXISTS `mendapat_beasiswa` (
  `ID_MENDAPAT_BEASISWA` int(11) NOT NULL,
  `ID_BEASISWA` int(11) NOT NULL,
  `ID_ALUMNI` int(11) NOT NULL,
  `TAHUN_MULAI_BEASISWA` int(11) NOT NULL,
  `TAHUN_SELESAI_BEASISWA` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mendapat_beasiswa`
--

INSERT INTO `mendapat_beasiswa` (`ID_MENDAPAT_BEASISWA`, `ID_BEASISWA`, `ID_ALUMNI`, `TAHUN_MULAI_BEASISWA`, `TAHUN_SELESAI_BEASISWA`) VALUES
(1, 1, 1, 2012, 2013);

-- --------------------------------------------------------

--
-- Table structure for table `organisasi`
--

CREATE TABLE IF NOT EXISTS `organisasi` (
  `ID_ORGANISASI` int(11) NOT NULL,
  `NAMA_ORGANISASI` varchar(40) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organisasi`
--

INSERT INTO `organisasi` (`ID_ORGANISASI`, `NAMA_ORGANISASI`) VALUES
(1, 'Pramuka'),
(2, 'HIMAKOM');

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE IF NOT EXISTS `perusahaan` (
  `ID_PERUSAHAAN` int(11) NOT NULL,
  `NAMA_PERUSAHAAN` varchar(20) NOT NULL,
  `EMAIL_PERUSAHAAN` varchar(40) NOT NULL,
  `NOMOR_TELEPON_PERUSAHAAN` int(11) DEFAULT NULL,
  `ALAMAT_PERUSAHAAN` varchar(20) NOT NULL,
  `BIDANG_PEKERJAAN` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perusahaan`
--

INSERT INTO `perusahaan` (`ID_PERUSAHAAN`, `NAMA_PERUSAHAAN`, `EMAIL_PERUSAHAAN`, `NOMOR_TELEPON_PERUSAHAAN`, `ALAMAT_PERUSAHAAN`, `BIDANG_PEKERJAAN`) VALUES
(1, 'Bara Enterprise', 'support@bara.co.id', 83242342, 'Sariwangi', 'IT Consultant'),
(2, '0891174917712', 'mail@bsp.com', 10401855, 'sarijadi', 'PROGRAMMER');

-- --------------------------------------------------------

--
-- Table structure for table `program_studi`
--

CREATE TABLE IF NOT EXISTS `program_studi` (
  `ID_PRODI` int(11) NOT NULL,
  `ID_JURUSAN` int(11) NOT NULL,
  `NAMA_PRODI` varchar(60) NOT NULL
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
(9, 2, 'D4-Teknik Perancangan Jalan dan Jembatan'),
(10, 2, 'D4-Teknik Perawatan dan Perbaikan Gedung'),
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
(25, 8, 'D4-Teknik Kimia Produksi Bersih'),
(26, 9, 'D3-Akutansi'),
(27, 9, 'D3-Keuangan Perbankan Syariah'),
(28, 9, 'D4-Akutansi Manajemen Pemerintahan'),
(29, 9, 'D4-Keuangan Syariah'),
(30, 9, 'D4-Akutansi'),
(31, 10, 'D3-Bahasa Inggris'),
(32, 4, 'D3-Teknik Pendingin dan Tata Udara'),
(33, 4, 'D4-Teknik Pendingin dan Tata Udara'),
(34, 6, 'D3-Teknik Konversi Energi'),
(35, 6, 'D4-Teknologi Pembangkit Tenaga Listrik'),
(36, 6, 'D4-Teknik Konservasi Energi');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_kompetisi`
--

CREATE TABLE IF NOT EXISTS `riwayat_kompetisi` (
  `ID_RIWAYAT_KOMPETISI` int(11) NOT NULL,
  `ID_KOMPETISI` int(11) NOT NULL,
  `ID_ALUMNI` int(11) DEFAULT NULL,
  `PRESTASI` varchar(30) NOT NULL,
  `TAHUN_KOMPETISI` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `riwayat_kompetisi`
--

INSERT INTO `riwayat_kompetisi` (`ID_RIWAYAT_KOMPETISI`, `ID_KOMPETISI`, `ID_ALUMNI`, `PRESTASI`, `TAHUN_KOMPETISI`) VALUES
(1, 2, 1, 'Juara 2', 2015);

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_organisasi`
--

CREATE TABLE IF NOT EXISTS `riwayat_organisasi` (
  `ID_RIWAYAT_ORGANISASI` int(11) NOT NULL,
  `ID_ORGANISASI` int(11) NOT NULL,
  `ID_ALUMNI` int(11) NOT NULL,
  `JABATAN_DI_ORGANISASI` varchar(30) NOT NULL,
  `TAHUN_MULAI_JABATAN` int(11) NOT NULL,
  `TAHUN_SELESAI_JABATAN` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `riwayat_organisasi`
--

INSERT INTO `riwayat_organisasi` (`ID_RIWAYAT_ORGANISASI`, `ID_ORGANISASI`, `ID_ALUMNI`, `JABATAN_DI_ORGANISASI`, `TAHUN_MULAI_JABATAN`, `TAHUN_SELESAI_JABATAN`) VALUES
(1, 2, 1, 'KAHIM', 2014, 2015),
(2, 1, 1, 'Ketua', 1991, 1991);

-- --------------------------------------------------------

--
-- Table structure for table `tugas_akhir`
--

CREATE TABLE IF NOT EXISTS `tugas_akhir` (
  `ID_TUGAS_AKHIR` int(11) NOT NULL,
  `JUDUL_TUGAS_AKHIR` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tugas_akhir`
--

INSERT INTO `tugas_akhir` (`ID_TUGAS_AKHIR`, `JUDUL_TUGAS_AKHIR`) VALUES
(1, 'Sistem Management Pemerintahan'),
(2, 'Aplikasi Akuntansi Perhitungan Pajak Tahunan'),
(3, 'Analisa Traffic Internet pada Jaringan Local Area Network SMU Negeri 13'),
(4, 'Laporan Kerja Praktek Perangkat Lunak Pengelolaan Data Counter Di V Comm Cell'),
(5, 'Membangun Jaringan PC Cloning Menggunakan Software Winconnect'),
(6, 'Aplikasi Logika Matematika pada Penyusunan Jaringan Listrik'),
(7, 'Kurangnya perbendaharaan kosa kata siswa dalam pembelajaran bahasa Inggris'),
(8, 'Pembuatan Alat Penghitung Meteran Listrik Digital');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID_USER` int(11) NOT NULL,
  `USERNAME` varchar(11) NOT NULL,
  `ID_PRODI` int(11) NOT NULL,
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
  ADD KEY `FK_KULIAH_DI` (`ID_PRODI`),
  ADD KEY `FK_MEMBUAT_TA` (`ID_TUGAS_AKHIR`);

--
-- Indexes for table `beasiswa`
--
ALTER TABLE `beasiswa`
  ADD PRIMARY KEY (`ID_BEASISWA`);

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
-- Indexes for table `karya_ilmiah`
--
ALTER TABLE `karya_ilmiah`
  ADD PRIMARY KEY (`ID_KARYA_ILMIAH`);

--
-- Indexes for table `kompetisi`
--
ALTER TABLE `kompetisi`
  ADD PRIMARY KEY (`ID_KOMPETISI`);

--
-- Indexes for table `membuat_karya_ilmiah`
--
ALTER TABLE `membuat_karya_ilmiah`
  ADD PRIMARY KEY (`ID_MEMBUAT_KARYA`),
  ADD KEY `FK_KARYA_DIBUAT` (`ID_KARYA_ILMIAH`),
  ADD KEY `FK_MEMBUAT_KARYA` (`ID_ALUMNI`);

--
-- Indexes for table `mendapat_beasiswa`
--
ALTER TABLE `mendapat_beasiswa`
  ADD PRIMARY KEY (`ID_MENDAPAT_BEASISWA`),
  ADD KEY `FK_BEASISWA_DIDAPAT` (`ID_BEASISWA`),
  ADD KEY `FK_MENDAPATKAN_BEASISWA` (`ID_ALUMNI`);

--
-- Indexes for table `organisasi`
--
ALTER TABLE `organisasi`
  ADD PRIMARY KEY (`ID_ORGANISASI`);

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
-- Indexes for table `riwayat_kompetisi`
--
ALTER TABLE `riwayat_kompetisi`
  ADD PRIMARY KEY (`ID_RIWAYAT_KOMPETISI`),
  ADD KEY `FK_KOMPETISI_DIIKUTI` (`ID_KOMPETISI`),
  ADD KEY `FK_MENGIKUTI_KOMPETISI` (`ID_ALUMNI`);

--
-- Indexes for table `riwayat_organisasi`
--
ALTER TABLE `riwayat_organisasi`
  ADD PRIMARY KEY (`ID_RIWAYAT_ORGANISASI`),
  ADD KEY `FK_MENGIKUTI_ORGANISASI` (`ID_ALUMNI`),
  ADD KEY `FK_ORGANISASI_DIIKUTI` (`ID_ORGANISASI`);

--
-- Indexes for table `tugas_akhir`
--
ALTER TABLE `tugas_akhir`
  ADD PRIMARY KEY (`ID_TUGAS_AKHIR`);

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
  MODIFY `ID_ALUMNI` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `beasiswa`
--
ALTER TABLE `beasiswa`
  MODIFY `ID_BEASISWA` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
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
-- AUTO_INCREMENT for table `karya_ilmiah`
--
ALTER TABLE `karya_ilmiah`
  MODIFY `ID_KARYA_ILMIAH` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `kompetisi`
--
ALTER TABLE `kompetisi`
  MODIFY `ID_KOMPETISI` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `membuat_karya_ilmiah`
--
ALTER TABLE `membuat_karya_ilmiah`
  MODIFY `ID_MEMBUAT_KARYA` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `mendapat_beasiswa`
--
ALTER TABLE `mendapat_beasiswa`
  MODIFY `ID_MENDAPAT_BEASISWA` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `organisasi`
--
ALTER TABLE `organisasi`
  MODIFY `ID_ORGANISASI` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
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
-- AUTO_INCREMENT for table `riwayat_kompetisi`
--
ALTER TABLE `riwayat_kompetisi`
  MODIFY `ID_RIWAYAT_KOMPETISI` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `riwayat_organisasi`
--
ALTER TABLE `riwayat_organisasi`
  MODIFY `ID_RIWAYAT_ORGANISASI` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tugas_akhir`
--
ALTER TABLE `tugas_akhir`
  MODIFY `ID_TUGAS_AKHIR` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
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
  ADD CONSTRAINT `FK_KULIAH_DI` FOREIGN KEY (`ID_PRODI`) REFERENCES `program_studi` (`ID_PRODI`),
  ADD CONSTRAINT `FK_MEMBUAT_TA` FOREIGN KEY (`ID_TUGAS_AKHIR`) REFERENCES `tugas_akhir` (`ID_TUGAS_AKHIR`);

--
-- Constraints for table `bekerja`
--
ALTER TABLE `bekerja`
  ADD CONSTRAINT `FK_BEKERJA_DI` FOREIGN KEY (`ID_ALUMNI`) REFERENCES `alumni` (`ID_ALUMNI`),
  ADD CONSTRAINT `FK_DITEMPATI_KERJA` FOREIGN KEY (`ID_PERUSAHAAN`) REFERENCES `perusahaan` (`ID_PERUSAHAAN`);

--
-- Constraints for table `membuat_karya_ilmiah`
--
ALTER TABLE `membuat_karya_ilmiah`
  ADD CONSTRAINT `FK_KARYA_DIBUAT` FOREIGN KEY (`ID_KARYA_ILMIAH`) REFERENCES `karya_ilmiah` (`ID_KARYA_ILMIAH`),
  ADD CONSTRAINT `FK_MEMBUAT_KARYA` FOREIGN KEY (`ID_ALUMNI`) REFERENCES `alumni` (`ID_ALUMNI`);

--
-- Constraints for table `mendapat_beasiswa`
--
ALTER TABLE `mendapat_beasiswa`
  ADD CONSTRAINT `FK_BEASISWA_DIDAPAT` FOREIGN KEY (`ID_BEASISWA`) REFERENCES `beasiswa` (`ID_BEASISWA`),
  ADD CONSTRAINT `FK_MENDAPATKAN_BEASISWA` FOREIGN KEY (`ID_ALUMNI`) REFERENCES `alumni` (`ID_ALUMNI`);

--
-- Constraints for table `program_studi`
--
ALTER TABLE `program_studi`
  ADD CONSTRAINT `FK_MEMILIKI` FOREIGN KEY (`ID_JURUSAN`) REFERENCES `jurusan` (`ID_JURUSAN`);

--
-- Constraints for table `riwayat_kompetisi`
--
ALTER TABLE `riwayat_kompetisi`
  ADD CONSTRAINT `FK_KOMPETISI_DIIKUTI` FOREIGN KEY (`ID_KOMPETISI`) REFERENCES `kompetisi` (`ID_KOMPETISI`),
  ADD CONSTRAINT `FK_MENGIKUTI_KOMPETISI` FOREIGN KEY (`ID_ALUMNI`) REFERENCES `alumni` (`ID_ALUMNI`);

--
-- Constraints for table `riwayat_organisasi`
--
ALTER TABLE `riwayat_organisasi`
  ADD CONSTRAINT `FK_MENGIKUTI_ORGANISASI` FOREIGN KEY (`ID_ALUMNI`) REFERENCES `alumni` (`ID_ALUMNI`),
  ADD CONSTRAINT `FK_ORGANISASI_DIIKUTI` FOREIGN KEY (`ID_ORGANISASI`) REFERENCES `organisasi` (`ID_ORGANISASI`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_KULIAH_DI_2_` FOREIGN KEY (`ID_PRODI`) REFERENCES `program_studi` (`ID_PRODI`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
