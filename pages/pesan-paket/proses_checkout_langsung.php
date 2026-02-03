<?php
require_once __DIR__ . '/../../koneksi.php';


$id_user = $_SESSION['id_user'];

$id_paket = $_POST['id_paket'];
$nama = $_POST['nama_paket'];
$harga = $_POST['harga'];
$jumlah = $_POST['jumlah'];
$total = $_POST['total'];

$tanggal = date('Y-m-d H:i:s');


/*
|--------------------------------------------------------------------------
| SIMPAN TRANSAKSI
|--------------------------------------------------------------------------
*/

mysqli_query($koneksi, "
INSERT INTO transaksi(id_user,total,tanggal,status)
VALUES('$id_user','$total','$tanggal','pending')
");

$id_transaksi = mysqli_insert_id($koneksi);


/*
|--------------------------------------------------------------------------
| SIMPAN DETAIL
|--------------------------------------------------------------------------
*/

mysqli_query($koneksi, "
INSERT INTO detail_transaksi
(id_transaksi,id_paket_katering,harga,jumlah)
VALUES('$id_transaksi','$id_paket','$harga','$jumlah')
");


/*
|--------------------------------------------------------------------------
| PESAN WHATSAPP
|--------------------------------------------------------------------------
*/

$pesan = "Halo Admin Assifa Katering%0A";
$pesan .= "Nama Pemesan: " . $_SESSION['nama'] . "%0A%0A";
$pesan .= "Saya pesan:%0A";
$pesan .= "$nama ($jumlah porsi)%0A";
$pesan .= "Total: Rp " . number_format($total);
$pesan .= "%0ANomor Transaksi: $id_transaksi";

$nomor_admin = "6282285652199";

$wa = "https://wa.me/$nomor_admin?text=$pesan";
?>


<script>
    // buka WA app
    window.location.href = "whatsapp://send?phone=<?= $nomor_admin ?>&text=<?= $pesan ?>";

    // fallback browser
    setTimeout(() => {
        window.open("<?= $wa ?>", "_blank");
    }, 800);

    // redirect riwayat
    setTimeout(() => {
        window.location.href = "index.php?page=riwayat_pemesanan_pelanggan";
    }, 2000);
</script>