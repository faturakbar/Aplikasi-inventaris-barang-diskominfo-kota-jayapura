-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2022 at 01:35 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventaris`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kode_barang` varchar(15) NOT NULL,
  `kode_jenis` char(3) NOT NULL,
  `kode_rekening` varchar(40) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `satuan` char(10) NOT NULL,
  `tipe` text NOT NULL,
  `merek` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kode_barang`, `kode_jenis`, `kode_rekening`, `nama_barang`, `satuan`, `tipe`, `merek`) VALUES
('BRG001', 'J1', '5.2.02.10.01.003', 'PC Lenovo F0G00167ID', 'Unit', 'F0G00167ID', 'Lenovo'),
('BRG003', 'J2', '5.2.02.10.01.003', 'Laptop Acer A514-54-32XQ', 'Unit', 'A514-54-32XQ', 'Acer'),
('BRG004', 'J3', '5.2.02.05.02.0006', 'Kursi Tamu Lokal Chitose', 'Buah', 'Chitose', 'Lokal'),
('BRG007', 'J6', '5.2.02.10.01.0002', 'Printer Epson Ecotank L3210', 'Unit', 'Ecotank L3210', 'Epson'),
('BRG008', 'J2', '5.2.02.10.01.003', 'Laptop Lenovo YOGA714ACN6', 'Unit', 'YOGA714ACN6', 'Lenovo'),
('BRG010', 'J2', '5.2.02.10.01.003', 'Laptop Asus Vivobook  K3400PA', 'Unit', 'K3400PA', 'Asus Vivobook '),
('BRG011', 'J6', '5.2.02.10.01.003', 'Printer Epson Ecotank L3216', 'Unit', 'Ecotank L3216', 'Epson'),
('BRG012', 'J8', '5.2.02.05.02.0006', 'Televisi Polytron Led 40&quot;  PLD40AD8959', 'Unit', 'PLD40AD8959', 'Polytron Led 40&quot; '),
('BRG013', 'J9', '5.2.02.05.02.0006', 'Lemari Penyimpanan lokal -', 'Unit', '-', 'lokal');

-- --------------------------------------------------------

--
-- Table structure for table `detail_inventaris`
--

CREATE TABLE `detail_inventaris` (
  `no_seri` varchar(50) NOT NULL,
  `kode_inventaris` varchar(50) NOT NULL,
  `kode_ruangan` char(2) NOT NULL,
  `kondisi` text NOT NULL,
  `gambar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_inventaris`
--

INSERT INTO `detail_inventaris` (`no_seri`, `kode_inventaris`, `kode_ruangan`, `kondisi`, `gambar`) VALUES
('A07X21D00221', 'inv-kominf-011', 'R1', 'Layak Pakai', '638a6479bcb36.jpg'),
('kursitamu', 'inv-kominf-003', 'R3', 'Layak Pakai', '638a57d652fba.jpg'),
('MCN0CX07P881499', 'inv-kominf-009', 'R4', 'Layak Pakai', '638a68bd28612.jpg'),
('MCN0CX07P914496', 'inv-kominf-013', 'R4', 'Layak Pakai', '638a69013fe6d.jpg'),
('MP295CPQ', 'inv-kominf-001', 'R1', 'Layak Pakai', '638a64cabb888.jpg'),
('NXA23SN006142175483400', 'inv-kominf-007', 'R1', 'Layak Pakai', '638a652c4d951.jpeg'),
('PF3ECP4V', 'inv-kominf-002', 'R2', 'Layak Pakai', '638a6d4bf12cf.jpg'),
('X8HS017310', 'inv-kominf-014', 'R2', 'Layak Pakai', '638a74af2ed6d.jpg'),
('X8HS017378', 'inv-kominf-014', 'R4', 'Layak Pakai', '638a74c953cb1.jpg'),
('XAGK337360', 'inv-kominf-006', 'R2', 'Layak Pakai', '638a74507d724.jpg'),
('XAGK340552', 'inv-kominf-006', 'R1', 'Layak Pakai', '638a74311bdf4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `inventaris`
--

CREATE TABLE `inventaris` (
  `kode_inventaris` varchar(50) NOT NULL,
  `kode_barang` varchar(15) NOT NULL,
  `kode_sub_kegiatan` varchar(30) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tgl_pengadaan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventaris`
--

INSERT INTO `inventaris` (`kode_inventaris`, `kode_barang`, `kode_sub_kegiatan`, `jumlah`, `tgl_pengadaan`) VALUES
('inv-kominf-001', 'BRG001', '22102201002', 1, '2022-07-13'),
('inv-kominf-002', 'BRG008', '21603202008', 1, '2022-06-20'),
('inv-kominf-003', 'BRG004', '21602201010', 15, '2022-06-23'),
('inv-kominf-006', 'BRG007', '21603202008', 2, '2022-09-13'),
('inv-kominf-007', 'BRG003', '00001205002', 1, '2022-10-12'),
('inv-kominf-009', 'BRG010', '2002201003', 1, '2022-09-19'),
('inv-kominf-011', 'BRG012', '21602201010', 1, '2022-06-23'),
('inv-kominf-013', 'BRG010', '22102201002', 1, '2022-06-27'),
('inv-kominf-014', 'BRG011', '21603202011', 2, '2022-10-12');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `kode_jenis` char(3) NOT NULL,
  `jenis_barang` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_barang`
--

INSERT INTO `jenis_barang` (`kode_jenis`, `jenis_barang`) VALUES
('J7', 'Kursi Rapat'),
('J3', 'Kursi Tamu'),
('J2', 'Laptop'),
('J9', 'Lemari Penyimpanan'),
('J4', 'Meja'),
('J1', 'PC'),
('J6', 'Printer'),
('J5', 'Router'),
('J8', 'Televisi');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `kode_kegiatan` varchar(20) NOT NULL,
  `kode_program` varchar(10) NOT NULL,
  `nama_kegiatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`kode_kegiatan`, `kode_program`, `nama_kegiatan`) VALUES
('002201', '002', 'Penyelenggaran Persandian Untuk Pengamanan Informasi Pemerintah Daerah Kabupaten/Kota'),
('01205', '01', 'Administrasi Umum Perangkat Daerah '),
('01207', '01', 'Pengadaan Barang Milik Daerah Penunjang Urusan Pemerintah Daerah'),
('02201', '02', 'Penyelenggaran Statistik Sektoral di Lingkup Daerah Kabupaten/Kota'),
('03201', '03', 'Pengelolaan Nama Domain Yang Telah Ditetapkan Oleh Pemerintah Pusat Dari Sub Domain Di Lingkungan Pemerintah Daerah Kabupaten/Kota'),
('03202', '03', 'Pengelolaan E-Government Di Lingkup Pemerintah Daerah Kabupaten/Kota'),
('21602201', '04', 'Pengelolaan Informasi dan Komunikasi Publik Pemerintah Daerah Kabupaten/Kota');

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `kode_program` varchar(10) NOT NULL,
  `nama_program` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`kode_program`, `nama_program`) VALUES
('002', 'PROGRAM PENYELENGGARAN PERSANDIAN UNTUK PENGAMANAN INFORMASI'),
('01', 'PROGRAM PENUNJANG URUSAN PEMERINTAH DAERAH'),
('02', 'PROGRAM PENYELENGGARAAN STATISTIK SEKTORAL'),
('03', 'PROGRAM PENGELOLAAN APLIKASI INFORMATIKA '),
('04', 'PROGRAM INFORMASI DAN KOMUNIKASI PUBLIK');

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `kode_ruangan` char(2) NOT NULL,
  `ruangan` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`kode_ruangan`, `ruangan`) VALUES
('R3', 'Bidang Informasi dan Komunikasi Publik (IKP)'),
('R2', 'Bidang Informatika'),
('R4', 'Bidang Statistik dan Persandian'),
('R1', 'Sekretariat');

-- --------------------------------------------------------

--
-- Table structure for table `sub_kegiatan`
--

CREATE TABLE `sub_kegiatan` (
  `kode_sub_kegiatan` varchar(30) NOT NULL,
  `kode_kegiatan` varchar(20) NOT NULL,
  `nama_sub_kegiatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_kegiatan`
--

INSERT INTO `sub_kegiatan` (`kode_sub_kegiatan`, `kode_kegiatan`, `nama_sub_kegiatan`) VALUES
('00001205002', '01205', 'Penyediaan Peralatan dan Perlengkapan Kantor'),
('00001207005', '01207', 'Pengadaan Mebel'),
('2002201003', '02201', 'Membangun Metadata Statistik Sektoral'),
('21602201010', '21602201', 'Penguatan Kapasitas Sumber Daya Komunikasi Publik '),
('2160220108', '21602201', 'Kemitraan dengan Pemangku Kepentingan '),
('21603201003', '03201', 'Penyelenggaran Sistem Jaringan Intra Pemerintah Daerah'),
('21603202008', '03202', 'Penyelenggaraan Sistem Penghubung Layanan Pemerintah'),
('21603202011', '03202', 'Pengelolaan Government Chief Information Officer (GCIO)'),
('22102201002', '002201', 'Pelaksanakan Analisis Kebutuhan dan Pengelolaan Sumber Daya Keamanan Informasi Pemerintah Daerah Kabupaten/Kota');

-- --------------------------------------------------------

--
-- Table structure for table `uraian`
--

CREATE TABLE `uraian` (
  `kode_rekening` varchar(40) NOT NULL,
  `uraian` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uraian`
--

INSERT INTO `uraian` (`kode_rekening`, `uraian`) VALUES
('5.2.02.05.01.0005', 'Belanja  Modal Alat Kantor Lainnya '),
('5.2.02.05.02.0006', 'Belanja Modal Alat Rumah Tangga Lainnya (Home Use)'),
('5.2.02.10.01.0002', 'Belanja Modal Personal Computer'),
('5.2.02.10.01.003', 'Belanja Modal Komputer Unit Lainnya');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `kode_user` int(2) NOT NULL,
  `username` text NOT NULL,
  `level` varchar(30) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`kode_user`, `username`, `level`, `password`) VALUES
(1, 'admin', 'admin', '$2y$10$qlDomAUmB4vRR4DhZkP5bOxpw2g3Y1Rfcuh4UVBGBc/I3rEBWPjyW'),
(2, 'kepala_dinas', 'kepala_dinas', '$2y$10$885C6Kn0SdJxvfJvs3VuFOc7dkTEknNnmZxbqGWw1JJtdA19dO8OO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode_barang`),
  ADD UNIQUE KEY `nama_barang` (`nama_barang`),
  ADD KEY `kode_jenis` (`kode_jenis`),
  ADD KEY `kode_sumber` (`kode_rekening`),
  ADD KEY `kode_rekening` (`kode_rekening`) USING BTREE;

--
-- Indexes for table `detail_inventaris`
--
ALTER TABLE `detail_inventaris`
  ADD PRIMARY KEY (`no_seri`),
  ADD KEY `kode_inventaris` (`kode_inventaris`),
  ADD KEY `kode_ruangan` (`kode_ruangan`) USING BTREE;

--
-- Indexes for table `inventaris`
--
ALTER TABLE `inventaris`
  ADD PRIMARY KEY (`kode_inventaris`),
  ADD KEY `kode_barang` (`kode_barang`),
  ADD KEY `kode_sub_kegiatan` (`kode_sub_kegiatan`);

--
-- Indexes for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  ADD PRIMARY KEY (`kode_jenis`),
  ADD UNIQUE KEY `jenis_barang` (`jenis_barang`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`kode_kegiatan`),
  ADD KEY `kode_program` (`kode_program`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`kode_program`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`kode_ruangan`),
  ADD UNIQUE KEY `ruangan` (`ruangan`);

--
-- Indexes for table `sub_kegiatan`
--
ALTER TABLE `sub_kegiatan`
  ADD PRIMARY KEY (`kode_sub_kegiatan`),
  ADD KEY `kode_kegiatan` (`kode_kegiatan`);

--
-- Indexes for table `uraian`
--
ALTER TABLE `uraian`
  ADD PRIMARY KEY (`kode_rekening`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`kode_rekening`) REFERENCES `uraian` (`kode_rekening`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_ibfk_2` FOREIGN KEY (`kode_jenis`) REFERENCES `jenis_barang` (`kode_jenis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_inventaris`
--
ALTER TABLE `detail_inventaris`
  ADD CONSTRAINT `detail_inventaris_ibfk_1` FOREIGN KEY (`kode_inventaris`) REFERENCES `inventaris` (`kode_inventaris`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_inventaris_ibfk_2` FOREIGN KEY (`kode_ruangan`) REFERENCES `ruangan` (`kode_ruangan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventaris`
--
ALTER TABLE `inventaris`
  ADD CONSTRAINT `inventaris_ibfk_1` FOREIGN KEY (`kode_sub_kegiatan`) REFERENCES `sub_kegiatan` (`kode_sub_kegiatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inventaris_ibfk_2` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD CONSTRAINT `kegiatan_ibfk_1` FOREIGN KEY (`kode_program`) REFERENCES `program` (`kode_program`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_kegiatan`
--
ALTER TABLE `sub_kegiatan`
  ADD CONSTRAINT `sub_kegiatan_ibfk_1` FOREIGN KEY (`kode_kegiatan`) REFERENCES `kegiatan` (`kode_kegiatan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
