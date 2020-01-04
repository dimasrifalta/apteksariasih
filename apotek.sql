-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2019 at 07:22 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apotek`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id_karyawan` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `telepon` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` int(11) NOT NULL,
  `status` enum('aktif','blokir') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id_karyawan`, `nama`, `telepon`, `email`, `username`, `password`, `level`, `status`) VALUES
('ID004', 'Nadya Rahma', '082134567789', 'nadyarahma@gmail.com', 'nadya', 'd41d8cd98f00b204e9800998ecf8427e', 3, 'aktif'),
('K001', 'Dimas Rifalta', '087877818661', 'dimasrifalta@gmail.com', 'dimas', '202cb962ac59075b964b07152d234b70', 1, 'aktif'),
('K002', 'Renindra Alprisno K', '082119936863', 'renindrak@gmail.com', 'renindra', '202cb962ac59075b964b07152d234b70', 3, 'aktif'),
('K003', 'Alex', '085669919769', 'alex@gmail.com', 'alex', '202cb962ac59075b964b07152d234b70', 2, 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `nopenjualan` varchar(50) NOT NULL,
  `kasir` varchar(50) NOT NULL,
  `tgl_beli` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`nopenjualan`, `kasir`, `tgl_beli`) VALUES
('PN-2019-0000001', 'Renindra Alprisno K', '2019-01-23'),
('PN-2019-0000002', 'Renindra Alprisno K', '2019-01-23'),
('PN-2019-0000003', 'Renindra Alprisno K', '2019-01-23'),
('PN-2019-0000004', 'Renindra Alprisno K', '2019-01-23'),
('PN-2019-0000005', 'Renindra Alprisno K', '2019-01-24'),
('PN-2019-0000006', 'Renindra Alprisno K', '2019-01-24'),
('PN-2019-0000007', 'Renindra Alprisno K', '2019-02-09');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `kd_obat` varchar(50) NOT NULL,
  `nm_obat` varchar(50) NOT NULL,
  `stok` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`kd_obat`, `nm_obat`, `stok`, `kategori`, `satuan`, `harga_beli`, `harga_jual`) VALUES
('OBAT-2019-0000001', 'Amoxicillin', 14, 'Resep dokter', 'Strip', 3500, 4000),
('OBAT-2019-0000002', 'Adem sari', 15, 'Obat bebas', 'Sachet', 1500, 1500),
('OBAT-2019-0000003', 'Paracetamol', 16, 'Resep dokter', 'Strip', 1600, 1500),
('OBAT-2019-0000004', 'Promag', 12, 'Obat bebas', 'Tablet', 350, 500),
('OBAT-2019-0000005', 'Eximer', 14, 'Resep dokter', 'Strip', 14000, 15000),
('OBAT-2019-0000006', 'Vick formula 44 100 ml', 10, 'Obat bebas', 'Botol', 16000, 17000),
('OBAT-2019-0000007', 'Antalgin 500 mg', 9, 'Resep dokter', 'Strip', 4500, 5000),
('OBAT-2019-0000008', 'Tolak Angin', 9, 'Obat bebas', 'Sachet', 2300, 2500),
('OBAT-2019-0000009', 'Betadine 5 ml', 15, 'Obat bebas', 'Botol', 4700, 5000),
('OBAT-2019-0000010', 'Bodrexyn', 12, 'Obat bebas', 'Strip', 2500, 3000),
('OBAT-2019-0000011', 'CAPTOPRIL 50MG', 10, 'Resep dokter', 'Strip', 3600, 4000),
('OBAT-2019-0000012', 'Dettol Antiseptic LIQ 100 ML', 4, 'Obat bebas', 'Botol', 14600, 15000),
('OBAT-2019-0000013', 'Freshcare Citrus 10 ML', 14, 'Obat bebas', 'Botol', 15400, 16000),
('OBAT-2019-0000014', 'Hotin Cream Aromatherapy 60 ML', 18, 'Obat bebas', 'Botol', 11000, 12000),
('OBAT-2019-0000015', 'Panadol Cold & Flu EPH', 3, 'Obat bebas', 'Strip', 10000, 11000),
('OBAT-2019-0000016', 'Panadol Ekstra', 0, 'Obat bebas', 'Strip', 17000, 20000);

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `kd_beli` varchar(50) NOT NULL,
  `tglpembelian` date NOT NULL,
  `kd_obat` varchar(50) NOT NULL,
  `id_supplier` varchar(50) NOT NULL,
  `kode_koreksi` varchar(50) NOT NULL,
  `jumlah_beli` int(11) NOT NULL,
  `harga_pembelian` int(11) NOT NULL,
  `stok_saat_ini` int(11) NOT NULL,
  `totalpembelian` int(11) NOT NULL,
  `tgl_exp` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`kd_beli`, `tglpembelian`, `kd_obat`, `id_supplier`, `kode_koreksi`, `jumlah_beli`, `harga_pembelian`, `stok_saat_ini`, `totalpembelian`, `tgl_exp`, `status`, `created_date`, `created_user`) VALUES
('TM-2019-0000001', '2019-01-23', 'OBAT-2019-0000001', 'SP000001', 'K-001', 30, 3500, 28, 105000, '2019-06-10', '', '2019-01-23 15:23:40', 'Dimas Rifalta'),
('TM-2019-0000002', '2019-01-23', 'OBAT-2019-0000002', 'SP000001', 'K-002', 20, 1000, 18, 20000, '2019-08-31', '', '2019-01-23 15:24:03', 'Dimas Rifalta'),
('TM-2019-0000003', '2019-01-23', 'OBAT-2019-0000003', 'SP000002', 'K-003', 40, 1200, 0, 48000, '2020-01-30', 'expired', '2019-01-23 15:26:20', 'Dimas Rifalta'),
('TM-2019-0000004', '2019-01-23', 'OBAT-2019-0000004', 'SP000002', 'K-004', 25, 350, 25, 8750, '2019-09-05', '', '2019-01-23 15:27:15', 'Dimas Rifalta'),
('TM-2019-0000005', '2019-01-23', 'OBAT-2019-0000005', 'SP000001', 'K-005', 15, 14000, 14, 210000, '2020-11-30', '', '2019-01-23 15:28:13', 'Dimas Rifalta'),
('TM-2019-0000006', '2019-01-23', 'OBAT-2019-0000006', 'SP000001', 'K-006', 10, 16000, 10, 160000, '2019-08-01', '', '2019-01-23 15:30:17', 'Dimas Rifalta'),
('TM-2019-0000007', '2019-01-23', 'OBAT-2019-0000007', 'SP000001', 'K-007', 20, 4500, 8, 90000, '2019-05-01', '', '2019-01-23 15:31:05', 'Dimas Rifalta'),
('TM-2019-0000008', '2019-01-23', 'OBAT-2019-0000008', 'SP000001', 'K-008', 40, 2300, 37, 92000, '2019-07-06', '', '2019-01-23 15:31:41', 'Dimas Rifalta'),
('TM-2019-0000009', '2019-01-23', 'OBAT-2019-0000009', 'SP000002', 'K-009', 15, 4700, 15, 70500, '2019-07-01', '', '2019-01-23 15:32:12', 'Dimas Rifalta'),
('TM-2019-0000010', '2019-01-23', 'OBAT-2019-0000010', 'SP000001', 'K-010', 14, 2500, 12, 35000, '2019-11-07', '', '2019-01-23 15:33:06', 'Dimas Rifalta'),
('TM-2019-0000011', '2019-01-23', 'OBAT-2019-0000011', 'SP000002', 'K-011', 10, 3600, 10, 36000, '2019-08-10', '', '2019-01-23 15:36:31', 'Dimas Rifalta'),
('TM-2019-0000012', '2019-01-23', 'OBAT-2019-0000012', 'SP000001', 'K-012', 5, 14600, 4, 73000, '2020-12-30', '', '2019-01-23 15:37:12', 'Dimas Rifalta'),
('TM-2019-0000013', '2019-01-23', 'OBAT-2019-0000013', 'SP000001', 'K-013', 15, 15400, 14, 231000, '2019-12-27', '', '2019-01-23 15:38:54', 'Dimas Rifalta'),
('TM-2019-0000014', '2019-01-23', 'OBAT-2019-0000014', 'SP000001', 'K-014', 20, 11000, 18, 220000, '2019-06-08', '', '2019-01-23 15:43:20', 'Dimas Rifalta'),
('TM-2019-0000015', '2019-01-23', 'OBAT-2019-0000015', 'SP000001', 'K-015', 10, 10000, 3, 100000, '2019-06-06', '', '2019-01-23 15:49:52', 'Dimas Rifalta'),
('TM-2019-0000016', '2019-01-23', 'OBAT-2019-0000001', 'SP000001', 'K-016', 10, 3500, 10, 35000, '2019-06-30', '', '2019-01-23 15:50:53', 'Dimas Rifalta'),
('TM-2019-0000017', '2019-01-23', 'OBAT-2019-0000003', 'SP000001', 'K-017', 15, 1200, 17, 18000, '2020-10-01', '', '2019-01-23 15:51:44', 'Dimas Rifalta'),
('TM-2019-0000026', '2019-01-26', 'OBAT-2019-0000003', 'SP000002', 'K-038', 1, 14000, 1, 1200, '2019-01-30', '', '2019-01-26 04:11:33', 'Dimas Rifalta'),
('TM-2019-0000027', '2019-01-26', 'OBAT-2019-0000003', 'SP000002', 'K-040', 1, 1200, 1, 1200, '2019-02-02', '', '2019-01-26 11:58:42', 'Dimas Rifalta'),
('TM-2019-0000028', '2019-01-26', 'OBAT-2019-0000003', 'SP000001', 'K-041', 1, 1400, 1, 1200, '2019-02-01', '', '2019-01-26 12:02:14', 'Dimas Rifalta'),
('TM-2019-0000029', '2019-01-26', 'OBAT-2019-0000003', 'SP000002', 'K-042', 1, 1500, 1, 1400, '2019-02-01', '', '2019-01-26 12:06:09', 'Dimas Rifalta'),
('TM-2019-0000030', '2019-01-26', 'OBAT-2019-0000003', 'SP000002', 'K-043', 1, 1500, 1, 1500, '2019-02-01', '', '2019-01-26 12:06:27', 'Dimas Rifalta'),
('TM-2019-0000031', '2019-01-26', 'OBAT-2019-0000003', 'SP000001', 'K-044', 1, 1600, 1, 1500, '2019-01-31', '', '2019-01-26 12:06:54', 'Dimas Rifalta'),
('TM-2019-0000032', '2019-01-26', 'OBAT-2019-0000003', 'SP000001', 'K-045', 1, 1600, 1, 1600, '2019-02-02', '', '2019-01-26 12:08:01', 'Dimas Rifalta'),
('TM-2019-0000033', '2019-01-29', 'OBAT-2019-0000002', 'SP000001', 'K-046', 1, 2000, 1, 1000, '2019-01-31', '', '2019-01-29 03:45:31', 'Dimas Rifalta'),
('TM-2019-0000034', '2019-01-29', 'OBAT-2019-0000002', 'SP000002', 'K-047', 1, 1500, 1, 2000, '2019-01-31', '', '2019-01-29 03:46:06', 'Dimas Rifalta');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `kode` int(11) NOT NULL,
  `nopenjualan` varchar(50) NOT NULL,
  `tglpenjualan` date NOT NULL,
  `kd_obat` varchar(50) NOT NULL,
  `kd_pembelian` varchar(50) NOT NULL,
  `itemterjual` int(11) NOT NULL,
  `harga_penjualan` int(11) NOT NULL,
  `total_penjualan` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`kode`, `nopenjualan`, `tglpenjualan`, `kd_obat`, `kd_pembelian`, `itemterjual`, `harga_penjualan`, `total_penjualan`, `created_date`, `created_user`) VALUES
(112, 'PN-2019-0000001', '2019-01-23', 'OBAT-2019-0000002', 'TM-2019-0000002', 2, 1500, 3000, '2019-01-23 21:54:05', 'Renindra Alprisno K'),
(113, 'PN-2019-0000001', '2019-01-23', 'OBAT-2019-0000013', 'TM-2019-0000013', 1, 16000, 16000, '2019-01-23 21:54:25', 'Renindra Alprisno K'),
(114, 'PN-2019-0000002', '2019-01-23', 'OBAT-2019-0000012', 'TM-2019-0000012', 1, 15000, 15000, '2019-01-23 21:59:47', 'Renindra Alprisno K'),
(115, 'PN-2019-0000003', '2019-01-23', 'OBAT-2019-0000010', 'TM-2019-0000010', 2, 3000, 6000, '2019-01-23 22:01:42', 'Renindra Alprisno K'),
(116, 'PN-2019-0000004', '2019-01-23', 'OBAT-2019-0000015', 'TM-2019-0000015', 2, 11000, 22000, '2019-01-23 22:03:01', 'Renindra Alprisno K'),
(117, 'PN-2019-0000004', '2019-01-23', 'OBAT-2019-0000008', 'TM-2019-0000008', 3, 2500, 7500, '2019-01-23 22:03:23', 'Renindra Alprisno K'),
(118, 'PN-2019-0000004', '2019-01-23', 'OBAT-2019-0000005', 'TM-2019-0000005', 1, 15000, 15000, '2019-01-23 22:03:53', 'Renindra Alprisno K'),
(119, 'PN-2019-0000005', '2019-01-24', 'OBAT-2019-0000001', 'TM-2019-0000001', 2, 4000, 8000, '2019-01-24 05:16:04', 'Renindra Alprisno K'),
(120, 'PN-2019-0000005', '2019-01-24', 'OBAT-2019-0000015', 'TM-2019-0000015', 2, 11000, 22000, '2019-01-24 05:16:45', 'Renindra Alprisno K'),
(121, 'PN-2019-0000006', '2019-01-24', 'OBAT-2019-0000007', 'TM-2019-0000007', 2, 5000, 10000, '2019-01-24 05:20:51', 'Renindra Alprisno K'),
(122, 'PN-2019-0000006', '2019-01-24', 'OBAT-2019-0000014', 'TM-2019-0000014', 2, 12000, 24000, '2019-01-24 05:21:09', 'Renindra Alprisno K'),
(123, 'PN-2019-0000007', '2019-02-09', 'OBAT-2019-0000015', 'TM-2019-0000015', 3, 11000, 33000, '2019-02-09 17:43:12', 'Renindra Alprisno K');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `telepon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama`, `alamat`, `telepon`) VALUES
('SP000001', 'Kimia frama', 'Bandung', 352364634),
('SP000002', 'Sentosa jaya', 'Jakarta', 125325353);

-- --------------------------------------------------------

--
-- Table structure for table `tb_keterangan`
--

CREATE TABLE `tb_keterangan` (
  `id_keterangan` int(11) NOT NULL,
  `kode_koreksi` varchar(50) NOT NULL,
  `jumlah_update` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `log_tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_keterangan`
--

INSERT INTO `tb_keterangan` (`id_keterangan`, `kode_koreksi`, `jumlah_update`, `status`, `keterangan`, `log_tanggal`) VALUES
(46, 'K-017', 2, 'KOREKSI STOK', 'Stok Hilang', '2019-01-23'),
(47, 'K-007', 2, 'KOREKSI STOK', 'Obat Hilang', '2019-01-24'),
(48, 'K-007', 5, 'KOREKSI STOK', 'Obat hilang', '2019-02-09'),
(49, 'K-007', 7, 'RETUR', 'Obat rusak', '2019-02-09'),
(50, 'K-003', 40, 'EXPIRED', 'obat sudah kadaluarsa', '2019-02-09');

-- --------------------------------------------------------

--
-- Table structure for table `tb_koreksi`
--

CREATE TABLE `tb_koreksi` (
  `id_koreksi` varchar(50) NOT NULL,
  `kode_beli` varchar(50) NOT NULL,
  `koreksi_stok` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_koreksi`
--

INSERT INTO `tb_koreksi` (`id_koreksi`, `kode_beli`, `koreksi_stok`, `keterangan`) VALUES
('K-001', 'TM-2019-0000001', 0, ''),
('K-002', 'TM-2019-0000002', 0, ''),
('K-003', 'TM-2019-0000003', 0, ''),
('K-004', 'TM-2019-0000004', 0, ''),
('K-005', 'TM-2019-0000005', 0, ''),
('K-006', 'TM-2019-0000006', 0, ''),
('K-007', 'TM-2019-0000007', 15, ''),
('K-008', 'TM-2019-0000008', 0, ''),
('K-009', 'TM-2019-0000009', 0, ''),
('K-010', 'TM-2019-0000010', 0, ''),
('K-011', 'TM-2019-0000011', 0, ''),
('K-012', 'TM-2019-0000012', 0, ''),
('K-013', 'TM-2019-0000013', 0, ''),
('K-014', 'TM-2019-0000014', 0, ''),
('K-015', 'TM-2019-0000015', 0, ''),
('K-016', 'TM-2019-0000016', 0, ''),
('K-017', 'TM-2019-0000017', 17, ''),
('K-018', 'TM-2019-0000018', 0, ''),
('K-019', 'TM-2019-0000018', 0, ''),
('K-020', 'TM-2019-0000019', 0, ''),
('K-021', 'TM-2019-0000020', 0, ''),
('K-022', 'TM-2019-0000021', 0, ''),
('K-023', 'TM-2019-0000021', 0, ''),
('K-024', 'TM-2019-0000022', 0, ''),
('K-025', 'TM-2019-0000023', 0, ''),
('K-026', 'TM-2019-0000024', 0, ''),
('K-027', 'TM-2019-0000025', 0, ''),
('K-028', 'TM-2019-0000018', 0, ''),
('K-029', 'TM-2019-0000019', 0, ''),
('K-030', 'TM-2019-0000020', 0, ''),
('K-031', 'TM-2019-0000021', 0, ''),
('K-032', 'TM-2019-0000022', 0, ''),
('K-033', 'TM-2019-0000022', 0, ''),
('K-034', 'TM-2019-0000022', 0, ''),
('K-035', 'TM-2019-0000023', 0, ''),
('K-036', 'TM-2019-0000024', 0, ''),
('K-037', 'TM-2019-0000025', 0, ''),
('K-038', 'TM-2019-0000026', 0, ''),
('K-039', 'TM-2019-0000027', 0, ''),
('K-040', 'TM-2019-0000027', 0, ''),
('K-041', 'TM-2019-0000028', 0, ''),
('K-042', 'TM-2019-0000029', 0, ''),
('K-043', 'TM-2019-0000030', 0, ''),
('K-044', 'TM-2019-0000031', 0, ''),
('K-045', 'TM-2019-0000032', 0, ''),
('K-046', 'TM-2019-0000033', 0, ''),
('K-047', 'TM-2019-0000034', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `temp_penjualan`
--

CREATE TABLE `temp_penjualan` (
  `id_temp` int(11) NOT NULL,
  `tglpenjualan` date NOT NULL,
  `kd_obat` varchar(50) NOT NULL,
  `kd_pembelian` varchar(50) NOT NULL,
  `itemterjual` int(11) NOT NULL,
  `harga_penjualan` int(11) NOT NULL,
  `total_penjualan` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`nopenjualan`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`kd_obat`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`kd_beli`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `tb_keterangan`
--
ALTER TABLE `tb_keterangan`
  ADD PRIMARY KEY (`id_keterangan`);

--
-- Indexes for table `tb_koreksi`
--
ALTER TABLE `tb_koreksi`
  ADD PRIMARY KEY (`id_koreksi`);

--
-- Indexes for table `temp_penjualan`
--
ALTER TABLE `temp_penjualan`
  ADD PRIMARY KEY (`id_temp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `kode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `tb_keterangan`
--
ALTER TABLE `tb_keterangan`
  MODIFY `id_keterangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `temp_penjualan`
--
ALTER TABLE `temp_penjualan`
  MODIFY `id_temp` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
