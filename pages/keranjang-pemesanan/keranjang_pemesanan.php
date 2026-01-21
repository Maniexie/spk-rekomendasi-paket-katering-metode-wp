<?php
$keranjang = $_SESSION['keranjang'] ?? [];
$total = 0;
?>

<h3>Keranjang Pemesanan</h3>

<?php if (!empty($keranjang)): ?>
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>Nama Paket</th>
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
                    <td>
                        <?= $item['nama_paket']; ?>
                    </td>
                    <td>Rp
                        <?= number_format($item['harga']); ?>
                    </td>
                    <td>
                        <?= $item['jumlah']; ?>
                    </td>
                    <td>Rp
                        <?= number_format($subtotal); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h5>Total: Rp
        <?= number_format($total); ?>
    </h5>

    <a href="index.php?page=checkout" class="btn btn-primary">Checkout</a>

<?php else: ?>
    <div class="alert alert-warning">Keranjang masih kosong</div>
<?php endif; ?>