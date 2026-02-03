<?php
require_once __DIR__ . '/../../pages/layouts/header.php';
require_once __DIR__ . '/../../koneksi.php';

$keranjang = $_SESSION['keranjang'] ?? [];

$total = 0;
?>

<div class="container">
    <h3 class="text-center">Keranjang Pemesanan</h3>
    <a href="index.php?page=hasil_budget_pelanggan" class="btn btn-secondary mb-2">
        ← Kembali</a>
    <?php if (!empty($keranjang)): ?>
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Nama Paket</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($keranjang as $id => $item):
                    $subtotal = $item['harga'] * $item['jumlah'];
                    $total += $subtotal;
                    ?>
                    <tr>
                        <td><?= $item['nama_paket']; ?></td>

                        <td>Rp <?= number_format($item['harga']); ?></td>

                        <td>
                            <button class="btn btn-sm btn-secondary btn-minus" data-id="<?= $id; ?>">-</button>

                            <span class="px-2 qty" id="qty-<?= $id; ?>">
                                <?= $item['jumlah']; ?>
                            </span>

                            <button class="btn btn-sm btn-secondary btn-plus" data-id="<?= $id; ?>">+</button>
                        </td>

                        <td id="subtotal-<?= $id; ?>" data-harga="<?= $item['harga']; ?>">
                            Rp <?= number_format($subtotal); ?>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-danger btn-hapus" data-id="<?= $id; ?>">
                                Hapus
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
        <div class="d-flex justify-content-end mb-3 mx-2">
            <h5 class="p-1">Total: Rp <span id="grand-total"><?= number_format($total); ?></span></h5>

            <a href="index.php?page=pesan_paket_katering" class="btn btn-primary">Checkout</a>
        </div>

    <?php else: ?>
        <div class="alert alert-warning">Keranjang masih kosong</div>
    <?php endif; ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        function rupiah(angka) {
            return new Intl.NumberFormat('id-ID').format(angka);
        }

        function updateQty(id, aksi) {

            fetch('index.php?page=update_keranjang_pemesanan', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `id=${id}&aksi=${aksi}`
            })
                .then(res => res.json())
                .then(data => {

                    // jika hapus
                    if (data.hapus) {
                        document.getElementById('qty-' + id).closest('tr').remove();
                        document.getElementById('grand-total').innerText =
                            rupiah(data.total);
                        return;
                    }

                    // update qty
                    document.getElementById('qty-' + id).innerText = data.jumlah;

                    // update subtotal
                    document.getElementById('subtotal-' + id).innerText =
                        'Rp ' + rupiah(data.subtotal);

                    // update total
                    document.getElementById('grand-total').innerText =
                        rupiah(data.total);
                });
        }

        document.querySelectorAll('.btn-plus').forEach(btn => {
            btn.onclick = () => updateQty(btn.dataset.id, 'tambah');
        });

        document.querySelectorAll('.btn-minus').forEach(btn => {
            btn.onclick = () => updateQty(btn.dataset.id, 'kurang');
        });

        document.querySelectorAll('.btn-hapus').forEach(btn => {
            btn.addEventListener('click', () => {

                Swal.fire({
                    title: 'Hapus item?',
                    text: 'Paket ini akan dihapus dari keranjang',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6'
                }).then((result) => {

                    if (result.isConfirmed) {

                        Swal.fire({
                            title: 'Memproses...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        // proses hapus
                        updateQty(btn.dataset.id, 'hapus');

                        // simulasi selesai (atau setelah ajax success)
                        setTimeout(() => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Paket berhasil dihapus dari keranjang',
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.reload();
                            });
                        }, 800);
                    }

                });
            });
        });
    });
</script>



<?php
require_once __DIR__ . '/../../pages/layouts/footer.php';
