<?php
require_once __DIR__ . '/../../pages/layouts/header.php';
require_once __DIR__ . '/../../koneksi.php';

$old_kode_kriteria = $_POST['kode_kriteria'] ?? '';
$old_nama_kriteria = $_POST['nama_kriteria'] ?? '';
$old_jenis_kriteria = $_POST['jenis_kriteria'] ?? '';
$old_bobot = $_POST['bobot'] ?? '';


$error = false;
$error_message = '';

$getDataKriteria = mysqli_query($koneksi, " SELECT * FROM kriteria "); // mengambil data item penilaian dari tabel item_penilaian





if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kode_kriteria = $_POST['kode_kriteria'];
    $nama_kriteria = $_POST['nama_kriteria'];
    $jenis_kriteria = $_POST['jenis_kriteria'];
    $bobot = $_POST['bobot'];


    $cekDataItemPenilaian = $koneksi->prepare(
        "SELECT 1 FROM kriteria WHERE kode_kriteria = ?"
    );
    $cekDataItemPenilaian->bind_param("s", $kode_kriteria);
    $cekDataItemPenilaian->execute();
    $cekDataItemPenilaian->store_result();

    if ($cekDataItemPenilaian->num_rows > 0) {
        $error = true;
        $error_message = "Kode Item Penilaian sudah digunakan.";
    }
    if ($error) {
        // Jika ada error, simpan nilai lama untuk ditampilkan kembali di form
        $old_kode_kriteria = $kode_kriteria;
        $old_jenis_kriteria = $jenis_kriteria;
        $old_nama_kriteria = $nama_kriteria;
        $old_bobot = $bobot;
    } else {
        // Jika tidak ada error, lanjutkan proses penyimpanan data
        $stmt = $koneksi->prepare("INSERT INTO kriteria (kode_kriteria, nama_kriteria, jenis_kriteria, bobot) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $kode_kriteria, $nama_kriteria, $jenis_kriteria, $bobot);
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
            window.location.href = "index.php?page=item_penilaian";
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
        <h2 class="text-center">Tambah Item Penilaian</h2>

        <!-- Form -->
        <form class="needs-validation" method="post">
            <div class="col-md mt-2">
                <label for="kode_kriteria" class="form-label" style="margin-bottom: -10px;">Kode Kriteria</label>
                <input type="text" class="form-control" id="kode_kriteria" name="kode_kriteria"
                    value="<?= $old_kode_kriteria ?>">
            </div>

            <div class="col-md mt-2">
                <label for="nama_kriteria" class="form-label" style="margin-bottom: -10px;">Nama Kriteria</label>
                <input type="text" class="form-control" id="nama_kriteria" name="nama_kriteria"
                    value="<?= $old_nama_kriteria ?>">
            </div>

            <div class="col-md mt-2">
                <label for="status_item" class="form-label" style="margin-bottom: -10px;">Jenis</label>

                <?php
                $status_kriteria = [
                    'Cost' => 'Cost',
                    'Benefit' => 'Benefit'
                ];
                ?>

                <select class=" form-select" id="jenis_kriteria" name="jenis_kriteria" required>
                    <option selected disabled value="">== Jenis Kriteria ==</option>
                    <?php foreach ($status_kriteria as $value => $label): ?>
                        <option value="<?= $value ?>" <?= ($old_jenis_kriteria == $value) ? 'selected' : '' ?>>
                            <?= $label ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md mt-2">
                <label for="bobot" class="form-label" style="margin-bottom: -10px;">Bobot</label>
                <input type="text" class="form-control" id="bobot" name="bobot" value="<?= $old_bobot ?>">
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