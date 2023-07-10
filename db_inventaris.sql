-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2022 at 10:41 AM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kode_barang`, `kode_jenis`, `kode_rekening`, `nama_barang`, `satuan`, `tipe`, `merek`) VALUES
('BRG001', 'J2', '5.1.02.03.02.0411', 'SSD Eksternal Samsung 128 GB', 'Unit', '128 GB', 'Samsung');

-- --------------------------------------------------------

--
-- Table structure for table `detail_inventaris`
--

CREATE TABLE `detail_inventaris` (
  `no_seri` int(50) NOT NULL,
  `kode_inventaris` varchar(50) NOT NULL,
  `kode_ruangan` char(2) NOT NULL,
  `kondisi` text NOT NULL,
  `gambar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_inventaris`
--

INSERT INTO `detail_inventaris` (`no_seri`, `kode_inventaris`, `kode_ruangan`, `kondisi`, `gambar`) VALUES
(234234, 'inv-kominf-001', 'R2', 'Layak Pakai', '');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventaris`
--

INSERT INTO `inventaris` (`kode_inventaris`, `kode_barang`, `kode_sub_kegiatan`, `jumlah`, `tgl_pengadaan`) VALUES
('inv-kominf-001', 'BRG001', '2.16.02.2.01.08', 1, '2022-10-28');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `kode_jenis` char(3) NOT NULL,
  `jenis_barang` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_barang`
--

INSERT INTO `jenis_barang` (`kode_jenis`, `jenis_barang`) VALUES
('J1', 'Bahan Cetak'),
('J2', 'SSD Eksternal');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `kode_kegiatan` varchar(20) NOT NULL,
  `kode_program` varchar(10) NOT NULL,
  `nama_kegiatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`kode_kegiatan`, `kode_program`, `nama_kegiatan`) VALUES
('2.16.02.2.01', '2.16.02', 'Pengelolaan Informasi dan Komunikasi Publik Pemerintah Daerah Kabupaten/Kota ');

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `kode_program` varchar(10) NOT NULL,
  `nama_program` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`kode_program`, `nama_program`) VALUES
('2.16.02', 'PROGRAM INFORMASI DAN KOMUNIKASI PUBLIK ');

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `kode_ruangan` char(2) NOT NULL,
  `ruangan` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`kode_ruangan`, `ruangan`) VALUES
('R2', 'Ruang Informasi dan Komunikasi'),
('R1', 'Ruang Sekretariat');

-- --------------------------------------------------------

--
-- Table structure for table `sub_kegiatan`
--

CREATE TABLE `sub_kegiatan` (
  `kode_sub_kegiatan` varchar(30) NOT NULL,
  `kode_kegiatan` varchar(20) NOT NULL,
  `nama_sub_kegiatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_kegiatan`
--

INSERT INTO `sub_kegiatan` (`kode_sub_kegiatan`, `kode_kegiatan`, `nama_sub_kegiatan`) VALUES
('2.16.02.2.01.08', '2.16.02.2.01', 'Kemitraan dengan Pemangku Kepentingan '),
('2.16.02.2.01.10', '2.16.02.2.01', 'Penguatan Kapasitas Sumber Daya Komunikasi Publik ');

-- --------------------------------------------------------

--
-- Table structure for table `uraian`
--

CREATE TABLE `uraian` (
  `kode_rekening` varchar(40) NOT NULL,
  `uraian` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uraian`
--

INSERT INTO `uraian` (`kode_rekening`, `uraian`) VALUES
('5.1.02.01.01.0026', 'Belanja Alat/Bahan untuk Kegiatan Kantor '),
('5.1.02.03.02.0411', 'Belanja Pemeliharaan Komputer - Peralatan Komputer - Peralatan Komputer Lainnya');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `kode_user` int(2) NOT NULL,
  `username` text NOT NULL,
  `level` varchar(10) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`kode_user`, `username`, `level`, `password`) VALUES
(1, 'admin', 'admin', '$2y$10$93ByXLvNmYtWULcAB0mRUuoNp2wb3SHqt82B0PKNvRcLKg3GbpFYK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode_barang`),
  ADD UNIQUE KEY `nama_barang` (`nama_barang`),
  ADD UNIQUE KEY `kode_rekening` (`kode_rekening`),
  ADD KEY `kode_jenis` (`kode_jenis`),
  ADD KEY `kode_sumber` (`kode_rekening`);

--
-- Indexes for table `detail_inventaris`
--
ALTER TABLE `detail_inventaris`
  ADD PRIMARY KEY (`no_seri`),
  ADD UNIQUE KEY `kode_ruangan` (`kode_ruangan`),
  ADD KEY `kode_inventaris` (`kode_inventaris`);

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
