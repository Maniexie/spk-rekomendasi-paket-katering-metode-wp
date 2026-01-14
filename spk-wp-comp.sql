-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Jan 2026 pada 00.15
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

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
-- Struktur dari tabel `hasil_paket_menu`
--

CREATE TABLE `hasil_paket_menu` (
  `id_paket_katering` int(11) NOT NULL,
  `id_menu_katering` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `hasil_paket_menu`
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
(8, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kode_kriteria` varchar(10) NOT NULL,
  `nama_kriteria` varchar(50) NOT NULL,
  `jenis_kriteria` enum('Benefit','Cost') DEFAULT NULL,
  `bobot` decimal(4,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kode_kriteria`, `nama_kriteria`, `jenis_kriteria`, `bobot`) VALUES
(1, 'C1', 'Harga', 'Cost', 0.30),
(2, 'C2', 'Tes', 'Cost', 2.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_katering`
--

CREATE TABLE `menu_katering` (
  `id_menu_katering` int(11) NOT NULL,
  `nama_menu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `menu_katering`
--

INSERT INTO `menu_katering` (`id_menu_katering`, `nama_menu`) VALUES
(1, 'Kerupuk'),
(2, 'Gulai Kambing'),
(3, 'Ayam Bakar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket_katering`
--

CREATE TABLE `paket_katering` (
  `id_paket_katering` int(11) NOT NULL,
  `nama_paket` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `tersedia` enum('Ya','Tidak') DEFAULT 'Ya'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `paket_katering`
--

INSERT INTO `paket_katering` (`id_paket_katering`, `nama_paket`, `harga`, `deskripsi`, `tersedia`) VALUES
(2, 'Paket Hemat Berkualitas', 300000, 'Ya', 'Ya'),
(3, 'Paket Goceng', 50000, 'Ya', 'Ya'),
(7, 'Paket Goyang Lidah', 25000, 'Ya', 'Ya'),
(8, 'Paket 10k', 10000, '10k', 'Ya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
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
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama`, `email`, `password`, `nomor_hp`, `alamat`, `role`) VALUES
(1, 'ceker', 'ceker@gmail.com', '$2y$10$5rnzju61eFJDP.1NbcqV8.80pmBtBhnVQP/1019KoWMPaNQbAygvy', '08127885', 'asd', 'Pelanggan'),
(2, 'pemilik', 'pemilik@gmail.com', '$2y$10$5rnzju61eFJDP.1NbcqV8.80pmBtBhnVQP/1019KoWMPaNQbAygvy', '123', '123', 'Pemilik');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `hasil_paket_menu`
--
ALTER TABLE `hasil_paket_menu`
  ADD PRIMARY KEY (`id_paket_katering`,`id_menu_katering`),
  ADD KEY `id_menu_katering` (`id_menu_katering`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `menu_katering`
--
ALTER TABLE `menu_katering`
  ADD PRIMARY KEY (`id_menu_katering`);

--
-- Indeks untuk tabel `paket_katering`
--
ALTER TABLE `paket_katering`
  ADD PRIMARY KEY (`id_paket_katering`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `menu_katering`
--
ALTER TABLE `menu_katering`
  MODIFY `id_menu_katering` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `paket_katering`
--
ALTER TABLE `paket_katering`
  MODIFY `id_paket_katering` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `hasil_paket_menu`
--
ALTER TABLE `hasil_paket_menu`
  ADD CONSTRAINT `hasil_paket_menu_ibfk_1` FOREIGN KEY (`id_paket_katering`) REFERENCES `paket_katering` (`id_paket_katering`) ON DELETE CASCADE,
  ADD CONSTRAINT `hasil_paket_menu_ibfk_2` FOREIGN KEY (`id_menu_katering`) REFERENCES `menu_katering` (`id_menu_katering`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
