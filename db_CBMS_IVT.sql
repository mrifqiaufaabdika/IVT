-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 05, 2017 at 06:30 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_CBMS_IVT`
--

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `NIP` varchar(5) NOT NULL,
  `nama_pegawai` varchar(30) NOT NULL,
  `No_HP` varchar(12) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `jabatan` enum('Kepelangganan','Teknisi','Direktur','kolektor') NOT NULL,
  `jenis_kelamin` char(1) NOT NULL,
  `tahun_kerja` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`NIP`, `nama_pegawai`, `No_HP`, `alamat`, `jabatan`, `jenis_kelamin`, `tahun_kerja`) VALUES
('20199', 'Surya Mardinata', '081275093322', 'JL.Pelita Jaya ', 'Kepelangganan', 'L', 0000),
('20200', 'Yasin', '085234432233', 'JL.Harapan', 'Teknisi', 'L', 0000),
('20201', 'Mandu', '081275093388', 'Jl.Pelita Jaya', 'Direktur', 'L', 0000),
('20202', 'Ali', '081275093322', 'jl.garuda sakti', 'Kepelangganan', 'L', 0000);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` varchar(5) NOT NULL,
  `nama_pelanggan` varchar(30) NOT NULL,
  `No_HP` varchar(12) NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin` char(1) NOT NULL,
  `area` enum('Harapan','Pelita Jaya','Sapta Marga') NOT NULL,
  `jumlah_tv` int(2) NOT NULL,
  `iuran` int(11) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `tgl_regristrasi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('aktif','non-aktif','','') NOT NULL,
  `tgl_putus` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `No_HP`, `alamat`, `jenis_kelamin`, `area`, `jumlah_tv`, `iuran`, `tgl_bayar`, `tgl_regristrasi`, `status`, `tgl_putus`) VALUES
('P0001', 'Siti Amina', '081275093322', 'Jl.Harapan GG.Harapan 1', 'P', 'Harapan', 2, 30000, '2017-03-11', '2017-04-13 06:22:25', 'aktif', '0000-00-00'),
('P0002', 'ujang baru', '085355423243', 'JL.Madrasah No.4', 'L', 'Pelita Jaya', 2, 40000, '2017-04-15', '2017-04-13 06:25:54', 'aktif', '0000-00-00'),
('P0003', 'Kholid', '081277332122', 'Jl.kebang', 'L', 'Harapan', 1, 30000, '2017-04-04', '2017-05-04 23:52:30', 'non-aktif', '2017-05-02'),
('P0004', 'Cinta', '081275684567', 'Jl.Gunug Daek', 'P', 'Sapta Marga', 3, 30000, '2017-02-26', '2017-05-04 23:55:43', 'non-aktif', '2017-04-29'),
('P0005', 'Salsabila', '081275093322', 'Parit 11', 'P', 'Sapta Marga', 2, 40000, '2017-04-01', '2017-05-29 08:11:04', 'aktif', '0000-00-00'),
('P0006', 'Raihan', '081275093322', 'subrantas', 'L', 'Sapta Marga', 3, 30000, '2017-05-01', '2017-05-30 13:33:29', 'aktif', '0000-00-00'),
('P0007', 'Fatimah', '082386838916', 'jl. Villa Pesona Paman', 'P', 'Sapta Marga', 2, 40000, '2017-06-01', '2017-06-07 14:25:44', 'non-aktif', '2017-06-07'),
('P0008', 'sofia', '081275093322', 'jl.teratai', 'P', 'Sapta Marga', 2, 40000, '2017-05-01', '2017-06-08 13:43:14', 'aktif', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `NIP` varchar(5) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `tipe_akun` enum('Administrator','Direktur') NOT NULL,
  `validasi_pengguna` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`NIP`, `username`, `password`, `tipe_akun`, `validasi_pengguna`) VALUES
('1', 'aaa', 'a', 'Direktur', 'Aktif'),
('20200', 'aadc', '2', 'Administrator', 'Aktif'),
('20201', 'direktur', 'admin', 'Direktur', 'Aktif'),
('20202', 'admin', 'admin', 'Administrator', 'Non-Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `no_faktur` varchar(5) NOT NULL,
  `id_pelanggan` varchar(5) NOT NULL,
  `NIP` varchar(5) NOT NULL,
  `total` int(11) NOT NULL,
  `tgl_pembayaran` date NOT NULL,
  `jumlah_tunggakan` int(11) NOT NULL,
  `jenis_pembayaran` enum('Iuran Bulanan','Registrasi','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`no_faktur`, `id_pelanggan`, `NIP`, `total`, `tgl_pembayaran`, `jumlah_tunggakan`, `jenis_pembayaran`) VALUES
('F0001', 'P0001', '20199', 120000, '2016-03-01', 3, 'Registrasi'),
('F0004', 'P0003', '20199', 200000, '2017-05-04', 1, 'Registrasi'),
('F0005', 'P0004', '20199', 200000, '2017-03-04', 1, 'Iuran Bulanan'),
('F0007', 'P0005', '20199', 200000, '2017-03-29', 1, 'Iuran Bulanan'),
('F0011', 'P0006', '20199', 200000, '2017-05-30', 1, 'Registrasi'),
('F0012', 'P0005', '20199', 80000, '2017-04-30', 2, 'Iuran Bulanan'),
('F0013', 'P0007', '20199', 200000, '2017-06-07', 1, 'Registrasi'),
('F0014', 'P0008', '20199', 200000, '2017-06-08', 1, 'Registrasi'),
('F0015', 'P0008', '20199', 80000, '2017-06-08', 1, 'Iuran Bulanan'),
('F0016', 'P0003', '20199', 60000, '2017-06-08', 1, 'Iuran Bulanan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`NIP`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`NIP`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`no_faktur`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
