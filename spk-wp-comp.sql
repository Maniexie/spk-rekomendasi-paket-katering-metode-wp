-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2026 at 10:26 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk-wp-comp`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail_transaksi` int(10) UNSIGNED NOT NULL,
  `id_transaksi` int(10) UNSIGNED NOT NULL,
  `id_paket_katering` int(10) UNSIGNED NOT NULL,
  `harga` decimal(12,2) NOT NULL,
  `jumlah` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hasil_paket_menu`
--

CREATE TABLE `hasil_paket_menu` (
  `id_paket_katering` int(11) NOT NULL,
  `id_menu_katering` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hasil_paket_menu`
--

INSERT INTO `hasil_paket_menu` (`id_paket_katering`, `id_menu_katering`) VALUES
(11, 6),
(11, 8),
(11, 9),
(11, 10),
(11, 11),
(11, 12),
(11, 13),
(11, 14),
(11, 27),
(13, 6),
(13, 8),
(13, 9),
(13, 10),
(13, 12),
(13, 13),
(13, 14),
(13, 15),
(13, 16),
(13, 20),
(13, 21),
(14, 6),
(14, 8),
(14, 9),
(14, 10),
(14, 12),
(14, 13),
(14, 14),
(14, 18),
(14, 20),
(14, 21),
(14, 27),
(15, 8),
(15, 12),
(15, 13),
(15, 14),
(15, 15),
(15, 20),
(15, 21),
(15, 22),
(15, 27),
(15, 30),
(16, 24),
(16, 25),
(16, 26),
(16, 27),
(17, 6),
(17, 8),
(17, 12),
(17, 13),
(17, 14),
(17, 15),
(17, 20),
(17, 21),
(17, 27),
(17, 28),
(18, 6),
(18, 8),
(18, 9),
(18, 10),
(18, 13),
(18, 20),
(18, 21),
(18, 27),
(18, 29),
(19, 6),
(19, 7),
(19, 8),
(19, 9),
(19, 10),
(19, 12),
(19, 13),
(19, 14),
(19, 27),
(20, 5),
(20, 6),
(20, 8),
(20, 9),
(20, 10),
(20, 12),
(20, 13),
(20, 14),
(20, 15),
(20, 19),
(20, 20),
(20, 21),
(20, 22),
(20, 27),
(21, 4),
(21, 5),
(21, 8),
(21, 12),
(21, 15),
(21, 27);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kode_kriteria` varchar(10) NOT NULL,
  `nama_kriteria` varchar(50) NOT NULL,
  `jenis_kriteria` enum('Benefit','Cost') DEFAULT NULL,
  `bobot` decimal(4,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kode_kriteria`, `nama_kriteria`, `jenis_kriteria`, `bobot`) VALUES
(1, 'C1', 'Harga', 'Cost', 0.30),
(2, 'C2', 'Tes', 'Cost', 2.00);

-- --------------------------------------------------------

--
-- Table structure for table `menu_katering`
--

CREATE TABLE `menu_katering` (
  `id_menu_katering` int(11) NOT NULL,
  `nama_menu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_katering`
--

INSERT INTO `menu_katering` (`id_menu_katering`, `nama_menu`) VALUES
(4, 'Nasi Goreng'),
(5, 'Telor Dadar'),
(6, 'Nasi Putih'),
(7, 'Ayam Balado'),
(8, 'Kerupuk'),
(9, 'Tempe'),
(10, 'Tahu'),
(11, 'Ayam Bakar'),
(12, 'Timun'),
(13, 'Cabe Sambal'),
(14, 'Daun Kemangi'),
(15, 'Tomat'),
(16, 'Rendang Daging'),
(17, 'Rendang Ayam'),
(18, 'Nila Goreng'),
(19, 'Mie Kuning'),
(20, 'Kol'),
(21, 'Selada'),
(22, 'Balado Teri Tempe'),
(23, 'Snack Box'),
(24, 'Risoles'),
(25, 'Bakwan'),
(26, 'Lemper Ayam'),
(27, 'Cup Gelas'),
(28, 'Ayam Geprek'),
(29, 'Ayam Kecap'),
(30, 'Nasi Tumpeng');

-- --------------------------------------------------------

--
-- Table structure for table `paket_katering`
--

CREATE TABLE `paket_katering` (
  `id_paket_katering` int(11) NOT NULL,
  `nama_paket` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `tersedia` enum('Ya','Tidak') DEFAULT 'Ya'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paket_katering`
--

INSERT INTO `paket_katering` (`id_paket_katering`, `nama_paket`, `harga`, `deskripsi`, `tersedia`) VALUES
(11, 'Paket Ayam Bakar', 25000, '-', 'Ya'),
(13, 'Paket Rendang Daging', 28000, '-', 'Ya'),
(14, 'Paket Ikan Nila Goreng', 24000, '-', 'Ya'),
(15, 'Paket Nasi Tumpeng Mini', 35000, '-', 'Ya'),
(16, 'Paket Snack Box', 15000, '-', 'Ya'),
(17, 'Paket Ayam Geprek', 23000, '-', 'Ya'),
(18, 'Paket Ayam Kecap', 24000, '-', 'Ya'),
(19, 'Paket Daging Balado', 30000, '-', 'Ya'),
(20, 'Paket Nasi Liwet', 26000, '-', 'Ya'),
(21, 'Paket Nasi Goreng', 12000, '-', 'Ya');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(10) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `total` decimal(12,2) NOT NULL,
  `tanggal` datetime NOT NULL,
  `status` enum('success','progress','pending','cancel') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(64) NOT NULL,
  `nomor_hp` varchar(20) NOT NULL,
  `alamat` text DEFAULT NULL,
  `role` enum('Pemilik','Pelanggan') DEFAULT 'Pelanggan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `email`, `password`, `nomor_hp`, `alamat`, `role`) VALUES
(1, 'ceker', 'ceker@gmail.com', '$2y$10$5rnzju61eFJDP.1NbcqV8.80pmBtBhnVQP/1019KoWMPaNQbAygvy', '08127885', 'asd', 'Pelanggan'),
(2, 'pemilik', 'pemilik@gmail.com', '$2y$10$5rnzju61eFJDP.1NbcqV8.80pmBtBhnVQP/1019KoWMPaNQbAygvy', '123', '123', 'Pemilik'),
(3, 'pelanggan', 'pelanggan@gmail.com', '$2y$10$5rnzju61eFJDP.1NbcqV8.80pmBtBhnVQP/1019KoWMPaNQbAygvy', '08137829522', 'asdasd', 'Pelanggan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail_transaksi`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indexes for table `hasil_paket_menu`
--
ALTER TABLE `hasil_paket_menu`
  ADD PRIMARY KEY (`id_paket_katering`,`id_menu_katering`),
  ADD KEY `id_menu_katering` (`id_menu_katering`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `menu_katering`
--
ALTER TABLE `menu_katering`
  ADD PRIMARY KEY (`id_menu_katering`);

--
-- Indexes for table `paket_katering`
--
ALTER TABLE `paket_katering`
  ADD PRIMARY KEY (`id_paket_katering`),
  ADD UNIQUE KEY `nama_paket` (`nama_paket`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail_transaksi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menu_katering`
--
ALTER TABLE `menu_katering`
  MODIFY `id_menu_katering` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `paket_katering`
--
ALTER TABLE `paket_katering`
  MODIFY `id_paket_katering` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE;

--
-- Constraints for table `hasil_paket_menu`
--
ALTER TABLE `hasil_paket_menu`
  ADD CONSTRAINT `hasil_paket_menu_ibfk_1` FOREIGN KEY (`id_paket_katering`) REFERENCES `paket_katering` (`id_paket_katering`) ON DELETE CASCADE,
  ADD CONSTRAINT `hasil_paket_menu_ibfk_2` FOREIGN KEY (`id_menu_katering`) REFERENCES `menu_katering` (`id_menu_katering`) ON DELETE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
