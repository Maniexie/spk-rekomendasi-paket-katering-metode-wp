<?php

require_once __DIR__ . '/../../koneksi.php';


$keranjang = $_SESSION['keranjang'] ?? [];

$data = [];
$totalQty = 0;
$totalHarga = 0;

foreach ($keranjang as $id => $qty) {

    $q = mysqli_query($koneksi, "
        SELECT nama_paket, harga
        FROM paket_katering
        WHERE id_paket_katering='$id'
    ");

    $p = mysqli_fetch_assoc($q);

    $subtotal = $p['harga'] * $qty;

    $data[] = [
        "id" => $id,
        "nama" => $p['nama_paket'],
        "harga" => $p['harga'],
        "qty" => $qty,
        "subtotal" => $subtotal
    ];

    $totalQty += $qty;
    $totalHarga += $subtotal;
}

echo json_encode([
    "items" => $data,
    "totalQty" => $totalQty,
    "totalHarga" => $totalHarga
]);

header('Location: index.php?page=keranjang_pemesanan');
exit;
