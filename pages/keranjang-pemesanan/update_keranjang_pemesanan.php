<?php

header('Content-Type: application/json');

$id = $_POST['id'] ?? null;
$aksi = $_POST['aksi'] ?? null;

if (!$id) {
    echo json_encode(['error' => true]);
    exit;
}

$keranjang = &$_SESSION['keranjang'];

if (!isset($keranjang[$id])) {
    echo json_encode(['error' => true]);
    exit;
}

if ($aksi == 'tambah') {
    $keranjang[$id]['jumlah']++;
} elseif ($aksi == 'kurang') {

    // stop di 1 (tidak boleh kurang)
    if ($keranjang[$id]['jumlah'] > 1) {
        $keranjang[$id]['jumlah']--;
    }
} elseif ($aksi == 'hapus') {
    unset($keranjang[$id]);

    $total = 0;
    foreach ($keranjang as $k) {
        $total += $k['harga'] * $k['jumlah'];
    }

    echo json_encode([
        'hapus' => true,
        'total' => $total
    ]);
    exit;
}



$jumlah = $keranjang[$id]['jumlah'];
$harga = $keranjang[$id]['harga'];
$subtotal = $jumlah * $harga;

$total = 0;
foreach ($keranjang as $k) {
    $total += $k['harga'] * $k['jumlah'];
}

echo json_encode([
    'jumlah' => $jumlah,
    'subtotal' => $subtotal,
    'total' => $total
]);

exit;
