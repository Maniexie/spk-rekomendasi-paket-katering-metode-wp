<?php
// session_start();
require_once __DIR__ . '/../../koneksi.php';

$keranjang = $_SESSION['keranjang'] ?? [];

if (empty($keranjang)) {
    header("Location: index.php?page=proses_checkout");
    exit;
}

$total = 0;
$pesan = "Halo Admin Assifa Katering,%0A";
$pesan .= "Nama Pemesan: " . $_SESSION['nama'] . "%0A" . "Saya ingin melakukan pemesanan :%0A%0A";

/*
|--------------------------------------------------------------------------
| Hitung total + susun pesan WA
|--------------------------------------------------------------------------
*/

foreach ($keranjang as $id => $item) {

    $subtotal = $item['harga'] * $item['jumlah'];
    $total += $subtotal;

    $pesan .= "- {$item['nama_paket']} ({$item['jumlah']} porsi) = Rp "
        . number_format($subtotal) . "%0A";
}

$pesan .= "%0ATotal Bayar: Rp " . number_format($total);
$pesan .= "%0A%0ATerima kasih.";


/*
|--------------------------------------------------------------------------
| SIMPAN KE DATABASE
|--------------------------------------------------------------------------
*/

$tanggal = date('Y-m-d H:i:s');

mysqli_query($koneksi, "
INSERT INTO transaksi(id_user,total, tanggal)
VALUES('{$_SESSION['id_user']}', '$total', '$tanggal')
");

$id_transaksi = mysqli_insert_id($koneksi);

foreach ($keranjang as $id => $item) {

    mysqli_query($koneksi, "
    INSERT INTO detail_transaksi
    (id_transaksi, id_paket_katering, harga, jumlah)
    VALUES
    ('$id_transaksi', '$id', '{$item['harga']}', '{$item['jumlah']}')
    ");
}


/*
|--------------------------------------------------------------------------
| KOSONGKAN SESSION
|--------------------------------------------------------------------------
*/
unset($_SESSION['keranjang']);


/*
|--------------------------------------------------------------------------
| REDIRECT WHATSAPP
|--------------------------------------------------------------------------
*/

$nomor_admin = "6282285652199"; // ganti nomor kamu
$wa = "https://wa.me/$nomor_admin?text=$pesan";


/*
|--------------------------------------------------------------------------
| REDIRECT KE DASHBOARD
|--------------------------------------------------------------------------
*/

?>

<?php
require_once __DIR__ . '/../../pages/layouts/header.php';
?>
<div class="container text-center mt-4">

    <h3>Pemesanan Sedang Diproses!</h3>
    <a href="<?= $wa ?>" target="_blank" class="btn btn-success">
        Konfirmasi via WhatsApp
    </a>

    <a href="index.php?page=riwayat_pemesanan_pelanggan" class="btn btn-primary">
        Lihat Riwayat Pesanan
    </a>
</div>

<?php
require_once __DIR__ . '/../../pages/layouts/footer.php';
?>