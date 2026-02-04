<?php
require_once __DIR__ . '/../../pages/layouts/header.php';
require_once __DIR__ . '/../../koneksi.php';
$id_paket_katering = $_GET['id_paket_katering'] ?? '';

$query = "SELECT * FROM paket_katering WHERE id_paket_katering = '$id_paket_katering'";
$result = mysqli_query($koneksi, $query);

$old_nama_paket = '';
$old_harga = '';
$old_deskripsi = '';
$old_tersedia = '';

if ($row = mysqli_fetch_assoc($result)) {
    $old_nama_paket = $row['nama_paket'];
    $old_harga = $row['harga'];
    $old_deskripsi = $row['deskripsi'];
    $old_tersedia = $row['tersedia'];
}


$error = false;
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id_paket_katering = $_POST['id_paket_katering'];
    $nama_paket = trim($_POST['nama_paket']);
    $harga = intval($_POST['harga']);
    $deskripsi = trim($_POST['deskripsi']);
    $tersedia = $_POST['tersedia'];

    // =========================
    // VALIDASI KOSONG
    // =========================
    if ($nama_paket == '' || $harga <= 0) {

        echo '
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
        Swal.fire("Oops!", "Nama paket dan harga wajib diisi!", "warning");
        </script>';

        return;
    }

    // =========================
    // CEK DUPLIKAT
    // =========================
    $cek = $koneksi->prepare(
        "SELECT 1 FROM paket_katering 
         WHERE nama_paket = ? 
         AND id_paket_katering != ?"
    );

    $cek->bind_param("si", $nama_paket, $id_paket_katering);
    $cek->execute();
    $cek->store_result();
    // =========================
    // JIKA DUPLIKAT → ERROR
    // =========================
    if ($cek->num_rows > 0) {

        echo '
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
        Swal.fire({
            icon: "error",
            title: "Gagal!",
            text: "Nama paket sudah digunakan, silakan ganti nama lain",
            confirmButtonText: "Oke",
            confirmButtonColor: "#d33"
        }).then(result => {
            if (result.isConfirmed) {
                window.history.back();
            }
        });
        </script>';

        return;
    }

    // =========================
    // UPDATE DATA
    // =========================
    $stmt = $koneksi->prepare(
        "UPDATE paket_katering 
         SET nama_paket=?, harga=?, deskripsi=?, tersedia=? 
         WHERE id_paket_katering=?"
    );

    $stmt->bind_param("sissi", $nama_paket, $harga, $deskripsi, $tersedia, $id_paket_katering);
    $stmt->execute();

    // =========================
    // SWEET ALERT LOADING + TIMER
    // =========================
    echo '
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    Swal.fire({
        title: "Memproses Edit Paket...",
        timer: 1500,
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    setTimeout(() => {
        Swal.fire({
            icon: "success",
            title: "Berhasil!",
            text: "Data paket katering berhasil diperbarui",
            timer: 1500,
            showConfirmButton: false
        }).then(() => {
            window.location.href = "index.php?page=paket_katering";
        });
    }, 1500);
    </script>';

    exit;
}




?>

<!-- Content -->
<section>
    <div class="container border rounded p-4 mb-4 mt-2">
        <!-- start get data value -->
        <h2 class="text-center">Edit Paket Katering</h2>

        <!-- Form -->
        <form class="needs-validation" method="post">
            <input type="hidden" name="id_paket_katering" value="<?= $id_paket_katering ?>">

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
            title: "Proses Penambahan Data Paket Katering",
            timer: 1500,
            didOpen: () => {
                Swal.showLoading();
            }
        }).then(() => {
            Swal.fire({
                icon: "error",
                title: "<?= $error_message ?>",
                text: "Silahkan gunakan kode Paket Katering yang lain.",
                showConfirmButton: true,
                timer: 3000
            });
        });
    </script>
<?php endif; ?>


<?php
require_once __DIR__ . '/../../pages/layouts/footer.php';
?>