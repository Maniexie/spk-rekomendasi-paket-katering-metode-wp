<?php

require_once __DIR__ . '/../../koneksi.php';

$id_paket = $_GET['id_paket'] ?? 0;

// Ambil data paket
$query = mysqli_query($koneksi, "
    SELECT id_paket_katering, nama_paket, harga
    FROM paket_katering
    WHERE id_paket_katering = '$id_paket'
");

$paket = mysqli_fetch_assoc($query);

if (!$paket) {
    header('Location: index.php?page=hasil_budget_pelanggan');
    exit;
}

// Jika keranjang belum ada
if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}

// Jika paket sudah ada di keranjang → tambah jumlah
if (isset($_SESSION['keranjang'][$id_paket])) {
    $_SESSION['keranjang'][$id_paket]['jumlah']++;
} else {
    $_SESSION['keranjang'][$id_paket] = [
        'id_paket' => $paket['id_paket_katering'],
        'nama_paket' => $paket['nama_paket'],
        'harga' => $paket['harga'],
        'jumlah' => 1
    ];
}

header('Location: index.php?page=keranjang_pemesanan');
exit;
