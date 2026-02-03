<?php

require_once __DIR__ . '/../../pages/layouts/header.php';
require_once __DIR__ . '/../../koneksi.php';


$id_user = (int) $_SESSION['id_user'];

$id_transaksi = $_GET['id_transaksi'];
$transaksi = mysqli_fetch_assoc(mysqli_query($koneksi, "
SELECT *
FROM transaksi
WHERE id_transaksi = $id_transaksi
AND id_user = $id_user
"));

$detail = mysqli_query($koneksi, "
SELECT 
    p.nama_paket,
    d.harga,
    d.jumlah,
    (d.harga * d.jumlah) AS subtotal
FROM detail_transaksi d
JOIN paket_katering p ON d.id_paket_katering = p.id_paket_katering
WHERE d.id_transaksi = $id_transaksi
");




?>

<div class="container mt-4">

    <h3 class="text-center mb-4">
        Detail Transaksi Nomor <?= $id_transaksi ?>
    </h3>

    <?php if ($transaksi): ?>

        <!-- INFO TRANSAKSI -->
        <div class="card mb-3 p-3">
            <b>Tanggal :</b> <?= date('d-M-Y H:i', strtotime($transaksi['tanggal'])) ?><br>
            <b>Total :</b> Rp <?= number_format($transaksi['total']) ?><br>
            <b>Status :</b>
            <div class="container">
                <?php
                if ($transaksi['status'] == 'success'):
                    echo '<span class="badge bg-success">Pemesanan Selesai</span>';
                elseif ($transaksi['status'] == 'progress'):
                    echo '<span class="badge bg-warning">Pesanan Diproses</span>';
                elseif ($transaksi['status'] == 'pending'):
                    echo '<span class="badge bg-secondary mb-1">Menunggu Pembayaran</span> 
                    <br/> <a href="https://wa.me/6282285652199?text=*Nomor Transaksi : ' . $transaksi['id_transaksi'] . '*" 
                    target="_blank" class="btn btn-success btn-sm mb-1">Konfirmasi via WhatsApp</a>';
                elseif ($transaksi['status'] == 'cancel'):
                    echo '<span class="badge bg-danger">Pemesanan Dibatalkan</span>';
                endif;
                ?>
            </div>
        </div>


        <!-- DETAIL PAKET -->
        <table class="table table-bordered text-center">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama Paket</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php while ($row = mysqli_fetch_assoc($detail)): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['nama_paket']) ?></td>
                        <td>Rp <?= number_format($row['harga']) ?></td>
                        <td><?= $row['jumlah'] ?></td>
                        <td>Rp <?= number_format($row['subtotal']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <a href="index.php?page=riwayat_pemesanan_pelanggan" class="btn btn-secondary">
            ← Kembali
        </a>

    <?php else: ?>
        <div class="alert alert-danger">Transaksi tidak ditemukan</div>
    <?php endif; ?>

</div>


<?php
require_once __DIR__ . '/../../pages/layouts/footer.php';
?>