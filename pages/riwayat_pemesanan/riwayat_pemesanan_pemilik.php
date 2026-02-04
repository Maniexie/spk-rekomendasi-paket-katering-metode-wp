<?php

require_once __DIR__ . '/../../pages/layouts/header.php';
require_once __DIR__ . '/../../koneksi.php';

$limit = 10; // 10 data per halaman
$page = $_GET['p'] ?? 1;

$start = ($page - 1) * $limit;

$totalDataQuery = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM transaksi");
$totalData = mysqli_fetch_assoc($totalDataQuery)['total'];

$totalPage = ceil($totalData / $limit);


$riwayat = mysqli_query($koneksi, "
SELECT 
    t.id_transaksi,
    t.id_user,
    t.total,
    t.tanggal,
    t.status,
    COUNT(d.id_detail_transaksi) AS jumlah_item
FROM transaksi t
LEFT JOIN detail_transaksi d ON t.id_transaksi = d.id_transaksi
GROUP BY t.id_transaksi
ORDER BY t.tanggal DESC
LIMIT $start, $limit
");

?>

<div class="container mt-4">
    <h3 class="text-center mb-3">Riwayat Transaksi</h3>

    <table class="table table-bordered table-striped text-center">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>id User</th>
                <th>Nomor Transaksi</th>
                <th>Jumlah</th>
                <th>Total Pembayaran</th>
                <th>Tanggal Pemesanan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php $no = $start + 1; ?>

            <?php if (mysqli_num_rows($riwayat) > 0): ?>
                <?php while ($data = mysqli_fetch_assoc($riwayat)): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data['id_user'] ?></td>

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
                            <a href="index.php?page=detail_riwayat_pemesanan_pemilik&id_transaksi=<?= $data['id_transaksi'] ?>"
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
    <div class="d-flex justify-content-center mt-3">

        <?php if ($page > 1): ?>
            <a href="?page=riwayat_pemesanan_pemilik&p=<?= $page - 1 ?>" class="btn btn-sm btn-secondary me-2">Prev</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPage; $i++): ?>
            <a href="?page=riwayat_pemesanan_pemilik&p=<?= $i ?>"
                class="btn btn-sm <?= ($i == $page ? 'btn-primary' : 'btn-outline-primary') ?> me-1">
                <?= $i ?>
            </a>
        <?php endfor; ?>

        <?php if ($page < $totalPage): ?>
            <a href="?page=riwayat_pemesanan_pemilik&p=<?= $page + 1 ?>" class="btn btn-sm btn-secondary ms-2">Next</a>
        <?php endif; ?>

    </div>
    <p class="text-muted">
        Menampilkan
        <?= $start + 1 ?> -
        <?= min($start + $limit, $totalData) ?>
        dari
        <?= $totalData ?> transaksi
    </p>

</div>

<?php
require_once __DIR__ . '/../../pages/layouts/footer.php';
?>