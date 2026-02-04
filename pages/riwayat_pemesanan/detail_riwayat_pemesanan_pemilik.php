<?php

require_once __DIR__ . '/../../pages/layouts/header.php';
require_once __DIR__ . '/../../koneksi.php';


$id_transaksi = $_GET['id_transaksi'];
$transaksi = mysqli_fetch_assoc(mysqli_query($koneksi, "
SELECT *
FROM transaksi
WHERE id_transaksi = $id_transaksi
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

    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-success">
            Status berhasil diperbarui
        </div>
    <?php endif; ?>


    <?php if ($transaksi): ?>

        <!-- INFO TRANSAKSI -->
        <div class="card mb-3 p-3">
            <b>Nomor Transaksi :
                <?= $transaksi['id_transaksi'] ?>
            </b>
            <b>Tanggal :</b> <?= date('d-M-Y H:i', strtotime($transaksi['tanggal'])) ?><br>
            <b>Total :</b> Rp <?= number_format($transaksi['total']) ?><br>
            <b>Status :</b>
            <div class="container">
                <form action="index.php?page=update_status_pemesanan" method="POST" class="d-flex gap-2">

                    <input type="hidden" name="id_transaksi" value="<?= $id_transaksi ?>">

                    <select name="status" class="form-select" style="width:250px">

                        <option value="pending" <?= $transaksi['status'] == 'pending' ? 'selected' : '' ?>>Menunggu Pembayaran
                        </option>

                        <option value="progress" <?= $transaksi['status'] == 'progress' ? 'selected' : '' ?>>Diproses</option>

                        <option value="success" <?= $transaksi['status'] == 'success' ? 'selected' : '' ?>>Selesai</option>

                        <option value="cancel" <?= $transaksi['status'] == 'cancel' ? 'selected' : '' ?>>Dibatalkan</option>

                    </select>

                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>

                </form>

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

        <a href="index.php?page=riwayat_pemesanan_pemilik" class="btn btn-secondary">
            ← Kembali
        </a>

    <?php else: ?>
        <div class="alert alert-danger">Transaksi tidak ditemukan</div>
    <?php endif; ?>

</div>


<?php
require_once __DIR__ . '/../../pages/layouts/footer.php';
?>