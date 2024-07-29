-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 29, 2024 at 10:53 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nrws`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`) VALUES
(5, 'fery', '$2a$12$YCQS9YngebamcYl76U4u2uanG.aNvWUIP6ej9UxFZDe6f6c.xHzyO', 'FERY FADUL '),
(6, 'nisra', '$2y$10$eO8vKygJXCmry7FHRwY.o.fczvD0blYPGOTBpNbOznWWkCaec2iba', 'nisra');

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `tarif` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `nama_kota`, `tarif`) VALUES
(1, 'Makassar', 15000),
(2, 'Parepare ', 25000),
(3, 'Palopo ', 50000),
(4, 'Enrekang ', 12000),
(5, 'Bau-Bau', 35000),
(6, 'Soppeng', 55000);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int NOT NULL,
  `email_pelanggan` varchar(100) NOT NULL,
  `password_pelanggan` varchar(50) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `telepon_pelanggan` varchar(25) NOT NULL,
  `alamat_pelanggan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `email_pelanggan`, `password_pelanggan`, `nama_pelanggan`, `telepon_pelanggan`, `alamat_pelanggan`) VALUES
(7, 'ryoogenmedia@gmail.com', 'ryoogen123', 'ryoogen', '123213132', 'adwdawwdwa'),
(9, 'rahma@gmail.com', 'rahma12345678', 'Nurul Rahmatul Islami', '0979878782', 'Jl.Mamuju Blok.09');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int NOT NULL,
  `id_pelanggan` int NOT NULL,
  `id_ongkir` int NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `total_pembelian` int NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `tarif` int NOT NULL,
  `alamat_pengiriman` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_pelanggan`, `id_ongkir`, `tanggal_pembelian`, `total_pembelian`, `nama_kota`, `tarif`, `alamat_pengiriman`) VALUES
(58, 6, 1, '2024-07-29', 265000, 'Makassar', 15000, 'adwad'),
(59, 7, 1, '2024-07-29', 515000, 'Makassar', 15000, 'awdawdawddaw'),
(60, 7, 6, '2024-07-29', 1805000, 'Soppeng', 55000, 'aawd'),
(61, 7, 5, '2024-07-29', 285000, 'Bau-Bau', 35000, 'awdaw'),
(62, 7, 6, '2024-07-29', 305000, 'Soppeng', 55000, 'awd'),
(63, 7, 2, '2024-07-29', 375000, 'Parepare ', 25000, 'awdaw');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int NOT NULL,
  `id_pembelian` int NOT NULL,
  `id_produk` int NOT NULL,
  `jumlah` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int NOT NULL,
  `berat` int NOT NULL,
  `subberat` int NOT NULL,
  `subharga` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pembelian_produk`, `id_pembelian`, `id_produk`, `jumlah`, `nama`, `harga`, `berat`, `subberat`, `subharga`) VALUES
(24, 58, 1, 5, 'Lipstik', 50000, 350, 1750, 250000),
(25, 59, 2, 2, 'Make Over', 250000, 500, 1000, 500000),
(26, 60, 2, 5, 'Make Over', 250000, 500, 2500, 1250000),
(27, 60, 5, 1, 'goundation make over', 500000, 1000, 1000, 500000),
(28, 61, 2, 1, 'Make Over', 250000, 500, 500, 250000),
(29, 62, 2, 1, 'Make Over', 250000, 500, 500, 250000),
(30, 63, 1, 7, 'Lipstik', 50000, 350, 2450, 350000);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` int NOT NULL,
  `berat_produk` int NOT NULL,
  `foto_produk` varchar(100) NOT NULL,
  `deskripsi_produk` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga_produk`, `berat_produk`, `foto_produk`, `deskripsi_produk`) VALUES
(1, 'Lipstik', 50000, 350, 'lipstik.jpg', 'Warna Bagus		  '),
(2, 'Make Over', 250000, 500, 'bedaktabur.jpg', 'bedak ini dapat memutihkan wajah anda dari wardah...'),
(3, 'Wardah', 500000, 50, 'eyeliner.jpg', 'Anti Luntur'),
(5, 'goundation make over', 500000, 1000, 'foundation.jpg', 'foundation yang bisa mengcover jerawat dan noda hi...'),
(6, 'eyeshadow', 150000, 600, 'eyeshadow.jpg', 'warna nya cantik-cantik'),
(7, 'consiler pixy', 85000, 185, 'consiler.jpg', 'bisa membuat hidung lebih mancung'),
(8, 'conture reveline', 350000, 600, 'conture.jpg', 'membuat pipi lebih tirus');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
