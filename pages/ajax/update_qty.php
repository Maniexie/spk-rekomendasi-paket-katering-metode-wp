<?php

$id = $_POST['id'];
$aksi = $_POST['aksi'];

foreach ($_SESSION['keranjang'] as $key => &$item) {

    if ($item['id'] == $id) {

        if ($aksi == 'tambah')
            $item['jumlah']++;
        if ($aksi == 'kurang')
            $item['jumlah']--;

        if ($item['jumlah'] <= 0) {
            unset($_SESSION['keranjang'][$key]);
            echo json_encode(["hapus" => true]);
            exit;
        }

        $subtotal = $item['harga'] * $item['jumlah'];

        echo json_encode([
            "jumlah" => $item['jumlah'],
            "subtotal" => $subtotal
        ]);
        exit;
    }
}

// hitung total baru
$total = 0;
foreach ($_SESSION['keranjang'] as $i) {
    $total += $i['harga'] * $i['jumlah'];
}

echo json_encode(["total" => $total]);
