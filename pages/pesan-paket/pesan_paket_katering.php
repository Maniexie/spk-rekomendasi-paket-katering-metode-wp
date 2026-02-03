<?php
require_once __DIR__ . '/../../pages/layouts/header.php';
require_once __DIR__ . '/../../koneksi.php';

$keranjang = $_SESSION['keranjang'] ?? [];

if (empty($keranjang)) {
    echo "<div class='container'><div class='alert alert-warning'>Keranjang kosong</div></div>";
    require_once __DIR__ . '/../../pages/layouts/footer.php';
    exit;
}

$total = 0;
?>

<section>
    <div class="container">
        <div class="card p-4">

            <h3 class="text-center mb-4">Checkout Pembayaran</h3>

            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Paket</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($keranjang as $item):
                        $subtotal = $item['harga'] * $item['jumlah'];
                        $total += $subtotal;
                        ?>
                        <tr>
                            <td><?= $item['nama_paket'] ?></td>
                            <td>Rp <?= number_format($item['harga']) ?></td>
                            <td><?= $item['jumlah'] ?></td>
                            <td>Rp <?= number_format($subtotal) ?></td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>

            <div class="text-end">
                <h4>Total Bayar: <b>Rp <?= number_format($total) ?></b></h4>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-6">
                    <h5>Transfer Bank</h5>
                    <img src="<?= BASE_URL ?>/assets/img/bca-logo.png" width="150">
                    <p class="mt-2">
                        a/n Assifa Katering <br>
                        24510706222
                    </p>
                </div>

                <div class="col-md-6 text-end">
                    <form action="index.php?page=proses_checkout" method="POST">
                        <button class="btn btn-success btn-lg" target="_blank">
                            Konfirmasi Pesanan
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../../pages/layouts/footer.php'; ?>