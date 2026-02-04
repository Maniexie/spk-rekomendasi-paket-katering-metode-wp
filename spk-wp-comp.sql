-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2026 at 01:38 AM
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

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail_transaksi`, `id_transaksi`, `id_paket_katering`, `harga`, `jumlah`) VALUES
(21, 19, 10, 12000.00, 2),
(22, 19, 3, 50000.00, 2),
(23, 20, 8, 10000.00, 4),
(24, 20, 2, 300000.00, 4),
(25, 21, 10, 12000.00, 5),
(26, 21, 2, 300000.00, 5),
(27, 21, 7, 25000.00, 5),
(28, 22, 7, 25000.00, 3),
(29, 22, 2, 300000.00, 4),
(30, 23, 10, 12000.00, 1777),
(31, 24, 10, 12000.00, 11),
(32, 25, 2, 300000.00, 411),
(33, 26, 10, 12000.00, 10261),
(34, 27, 10, 12000.00, 10261),
(35, 28, 10, 12000.00, 10261),
(36, 29, 10, 12000.00, 27);

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
(2, 2),
(2, 3),
(3, 1),
(3, 2),
(3, 3),
(7, 1),
(7, 2),
(7, 3),
(8, 2),
(9, 4),
(9, 6),
(10, 4),
(10, 5),
(10, 6);

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
(1, 'Kerupuk'),
(2, 'Gulai Kambing'),
(3, 'Ayam Bakar'),
(4, 'Nasi Goreng'),
(5, 'Telor Dadar'),
(6, 'Nasi Putih');

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
(2, 'Paket Hemat Berkualitas', 300000, 'Ya', 'Ya'),
(3, 'Paket Goceng', 50000, 'Ya', 'Ya'),
(7, 'Paket Goyang Lidah', 25000, 'Ya', 'Ya'),
(8, 'Paket 10k', 10000, '10k', 'Ya'),
(9, 'Paket Mahasiswa', 8000, '-', 'Ya'),
(10, 'Paket Mahasiswa Spesial', 12000, '-', 'Ya');

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

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `total`, `tanggal`, `status`) VALUES
(19, 1, 124000.00, '2026-02-04 04:12:03', 'progress'),
(20, 1, 1240000.00, '2026-02-04 04:45:58', 'pending'),
(21, 1, 1685000.00, '2026-02-04 04:56:23', 'pending'),
(22, 1, 1275000.00, '2026-02-04 05:43:05', 'pending'),
(23, 1, 21324000.00, '2026-02-04 05:52:00', 'pending'),
(24, 1, 132000.00, '2026-02-04 05:53:45', 'pending'),
(25, 1, 123300000.00, '2026-02-04 05:54:13', 'pending'),
(26, 1, 123132000.00, '2026-02-04 05:55:38', 'pending'),
(27, 1, 123132000.00, '2026-02-04 05:56:36', 'pending'),
(28, 1, 123132000.00, '2026-02-04 06:02:57', 'success'),
(29, 3, 324000.00, '2026-02-04 06:06:55', 'progress');

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
(3, 'userceker', 'userceker@gmail.com', '$2y$10$5rnzju61eFJDP.1NbcqV8.80pmBtBhnVQP/1019KoWMPaNQbAygvy', '08137829522', 'asdasd', 'Pelanggan');

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
  ADD PRIMARY KEY (`id_paket_katering`);

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
  MODIFY `id_detail_transaksi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menu_katering`
--
ALTER TABLE `menu_katering`
  MODIFY `id_menu_katering` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `paket_katering`
--
ALTER TABLE `paket_katering`
  MODIFY `id_paket_katering` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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
