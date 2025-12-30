<?php
require_once __DIR__ . '/../../pages/layouts/header.php';
require_once __DIR__ . '/../../koneksi.php';

$old_nama_paket = $_POST['nama_paket'] ?? '';
$old_harga = $_POST['harga'] ?? '';
$old_deskripsi = $_POST['deskripsi'] ?? '';
$old_tersedia = $_POST['tersedia'] ?? '';


$error = false;
$error_message = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_paket = $_POST['nama_paket'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $tersedia = $_POST['tersedia'];


    $cekDataItemPenilaian = $koneksi->prepare(
        "SELECT 1 FROM paket_katering WHERE nama_paket = ?"
    );
    $cekDataItemPenilaian->bind_param("s", $nama_paket);
    $cekDataItemPenilaian->execute();
    $cekDataItemPenilaian->store_result();

    if ($cekDataItemPenilaian->num_rows > 0) {
        $error = true;
        $error_message = "Kode Item Penilaian sudah digunakan.";
    }
    if ($error) {
        // Jika ada error, simpan nilai lama untuk ditampilkan kembali di form
        $old_nama_paket = $nama_paket;
        $old_deskripsi = $deskripsi;
        $old_harga = $harga;
    } else {
        // Jika tidak ada error, lanjutkan proses penyimpanan data
        $stmt = $koneksi->prepare("INSERT INTO paket_katering (nama_paket, harga, deskripsi, tersedia) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siss", $nama_paket, $harga, $deskripsi, $tersedia);
        $stmt->execute();
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    Swal.fire({
        title: "Proses Penambahan Data Item Penilaian",
        timer: 1500,
        didOpen: () => {
            Swal.showLoading();
        }
    }).then(() => {
        Swal.fire({
            icon: "success",
            title: "Data Item Penilaian Berhasil di Tambahkan",
            showConfirmButton: true,
            timer: 3000
        }).then(() => {
            window.location.href = "index.php?page=paket_katering";
        });
    });
    </script>';
    }

} else if ($_SERVER['REQUEST_METHOD'] == null || $_SERVER['REQUEST_METHOD'] == '') {
    // Tampilkan form tambah aktor
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    Swal.fire({
        title: "Proses Penambahan Data Item Penilaian",
        timer: 1500,
        didOpen: () => {
            Swal.showLoading();
        }
    }).then(() => {
        Swal.fire({
            icon: "error",
            title: "Data Item Penilaian Gagal di Tambahkan",
            showConfirmButton: true,
            timer: 3000
        }).then(() => {
            window.location.href = "index.php?page=tambah_item_penilaian";
        });
    });
    </script>';
}
?>

<!-- Content -->
<section>
    <div class="container border rounded p-4 mb-4 mt-2">
        <!-- start get data value -->
        <h2 class="text-center">Tambah Paket Katering</h2>

        <!-- Form -->
        <form class="needs-validation" method="post">
            <div class="col-md mt-2">
                <label for="nama_paket" class="form-label" style="margin-bottom: -10px;">Nama Paket Katering</label>
                <input type="text" class="form-control" id="nama_paket" name="nama_paket"
                    value="<?= $old_nama_paket ?>">
            </div>

            <div class="col-md mt-2">
                <label for="harga" class="form-label" style="margin-bottom: -10px;">Harga</label>
                <input type="text" class="form-control" id="harga" name="harga" value="<?= $old_harga ?>">
            </div>

            <div class="col-md mt-2">
                <label for="deskripsi" class="form-label" style="margin-bottom: -10px;">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi"
                    class="form-control"><?= htmlspecialchars($old_deskripsi) ?></textarea>
            </div>

            <div class="col-md mt-2">
                <label for="status_item" class="form-label" style="margin-bottom: -10px;">Paket Tersedia</label>

                <?php
                $status_tersedia = [
                    'Ya' => 'Ya',
                    'Tidak' => 'Tidak',
                ];
                ?>

                <select class=" form-select" id="tersedia" name="tersedia" required>
                    <option selected disabled value="">== Paket Tersedia ==</option>
                    <?php foreach ($status_tersedia as $value => $label): ?>
                        <option value="<?= $value ?>" <?= ($old_tersedia == $value) ? 'selected' : '' ?>>
                            <?= $label ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-12 mt-2">
                <button class="btn btn-primary" type="submit" name="submit">Submit</button>
            </div>
        </form>
    </div>
</section>

<?php if ($error): ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            title: "Proses Penambahan Data Item Penilaian",
            timer: 1500,
            didOpen: () => {
                Swal.showLoading();
            }
        }).then(() => {
            Swal.fire({
                icon: "error",
                title: "<?= $error_message ?>",
                text: "Silahkan gunakan kode item penilaian yang lain.",
                showConfirmButton: true,
                timer: 3000
            });
        });
    </script>
<?php endif; ?>


<?php
require_once __DIR__ . '/../../pages/layouts/footer.php';
?>