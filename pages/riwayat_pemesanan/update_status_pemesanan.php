<?php
require_once __DIR__ . '/../../koneksi.php';

$id_transaksi = $_POST['id_transaksi'];
$status = $_POST['status'];

$allowed = ['pending', 'progress', 'success', 'cancel'];

if (!in_array($status, $allowed)) {
    die("Status tidak valid");
}

mysqli_query($koneksi, "
UPDATE transaksi 
SET status='$status'
WHERE id_transaksi='$id_transaksi'
");

header("Location: index.php?page=detail_riwayat_pemesanan_pemilik&id_transaksi=$id_transaksi&msg=updated");
exit;
