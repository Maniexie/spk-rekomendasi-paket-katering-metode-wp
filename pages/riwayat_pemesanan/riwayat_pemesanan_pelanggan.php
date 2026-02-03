<?php

require_once __DIR__ . '/../../pages/layouts/header.php';
require_once __DIR__ . '/../../koneksi.php';


$id_user = (int) $_SESSION['id_user'];

$riwayat = mysqli_query($koneksi, "
SELECT 
    t.id_transaksi,
    t.total,
    t.tanggal,
    t.status,
    COUNT(d.id_detail_transaksi) AS jumlah_item
FROM transaksi t
LEFT JOIN detail_transaksi d ON t.id_transaksi = d.id_transaksi
WHERE t.id_user = $id_user
GROUP BY t.id_transaksi
ORDER BY t.tanggal DESC
");
?>

<div class="container mt-4">
    <h3 class="text-center mb-3">Riwayat Transaksi</h3>

    <table class="table table-bordered table-striped text-center">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nomor Transaksi</th>
                <th>Jumlah</th>
                <th>Total Pembayaran</th>
                <th>Tanggal Pemesanan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php $no = 1; ?>

            <?php if (mysqli_num_rows($riwayat) > 0): ?>
                <?php while ($data = mysqli_fetch_assoc($riwayat)): ?>
                    <tr>
                        <td><?= $no++ ?></td>

                        <td>
                            <b><?= $data['id_transaksi'] ?></b>
                        </td>



                        <td>
                            <?= $data['jumlah_item'] ?> Paket
                        </td>
                        <td>Rp
                            <?= number_format($data['total']) ?>
                        </td>


                        <td>
                            <?= date('d-M-Y H:i', strtotime($data['tanggal'])) ?>
                        </td>

                        <td>
                            <?php
                            if ($data['status'] == 'success'):
                                echo '<span class="badge bg-success">Pemesanan Selesai</span>';
                            elseif ($data['status'] == 'progress'):
                                echo '<span class="badge bg-warning">Pesanan Diproses</span>';
                            elseif ($data['status'] == 'pending'):
                                echo '<span class="badge bg-secondary">Menunggu Pembayaran</span>';
                            elseif ($data['status'] == 'cancel'):
                                echo '<span class="badge bg-danger">Pemesanan Dibatalkan</span>';
                            endif;
                            ?>
                        </td>

                        <td>
                            <a href="index.php?page=detail_riwayat_pemesanan_pelanggan&id_transaksi=<?= $data['id_transaksi'] ?>"
                                class="btn btn-info btn-sm">
                                Detail
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">Tidak ada riwayat pemesanan</td>
                </tr>
            <?php endif; ?>
        </tbody>

    </table>
</div>

<?php
require_once __DIR__ . '/../../pages/layouts/footer.php';
?>