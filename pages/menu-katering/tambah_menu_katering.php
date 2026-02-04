<?php
require_once __DIR__ . '/../../pages/layouts/header.php';
require_once __DIR__ . '/../../koneksi.php';

$old_nama_menu = $_POST['nama_menu'] ?? '';

$error = false;
$error_message = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_menu = $_POST['nama_menu'];

    $cekDataItemPenilaian = $koneksi->prepare(
        "SELECT 1 FROM menu_katering WHERE nama_menu = ?"
    );
    $cekDataItemPenilaian->bind_param("s", $nama_menu);
    $cekDataItemPenilaian->execute();
    $cekDataItemPenilaian->store_result();

    if ($cekDataItemPenilaian->num_rows > 0) {
        $error = true;
        $error_message = "Menu Sudah Ada atau Sudah Digunakan.";
    }
    if ($error) {
        // Jika ada error, simpan nilai lama untuk ditampilkan kembali di form
        $old_nama_menu = $nama_menu;
    } else {
        // Jika tidak ada error, lanjutkan proses penyimpanan data
        $stmt = $koneksi->prepare("INSERT INTO menu_katering (nama_menu) VALUES (?)");
        $stmt->bind_param("s", $nama_menu);
        $stmt->execute();
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    Swal.fire({
        title: "Proses Penambahan Data Menu Katering",
        timer: 1500,
        didOpen: () => {
            Swal.showLoading();
        }
    }).then(() => {
        Swal.fire({
            icon: "success",
            title: "Data Menu Katering Berhasil di Tambahkan",
            showConfirmButton: true,
            timer: 3000
        }).then(() => {
            window.location.href = "index.php?page=menu_katering";
        });
    });
    </script>';
    }

} else if ($_SERVER['REQUEST_METHOD'] == null || $_SERVER['REQUEST_METHOD'] == '') {
    // Tampilkan form tambah aktor
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    Swal.fire({
        title: "Proses Penambahan Data Menu Katering",
        timer: 1500,
        didOpen: () => {
            Swal.showLoading();
        }
    }).then(() => {
        Swal.fire({
            icon: "error",
            title: "Data Menu Katering Gagal di Tambahkan",
            showConfirmButton: true,
            timer: 3000
        }).then(() => {
            window.location.href = "index.php?page=tambah_menu_katering";
        });
    });
    </script>';
}
?>

<!-- Content -->
<section>
    <div class="container border rounded p-4 mb-4 mt-2">
        <!-- start get data value -->
        <h2 class="text-center">Tambah Menu Katering</h2>

        <!-- Form -->
        <form class="needs-validation" method="post">
            <div class="col-md mt-2">
                <label for="nama_menu" class="form-label" style="margin-bottom: -10px;">Nama Menu Katering</label>
                <input type="text" class="form-control" id="nama_menu" name="nama_menu" value="<?= $old_nama_menu ?>">
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
            title: "Proses Penambahan Data Menu Katering",
            timer: 1500,
            didOpen: () => {
                Swal.showLoading();
            }
        }).then(() => {
            Swal.fire({
                icon: "error",
                title: "<?= $error_message ?>",
                text: "Silahkan gunakan kode Menu Katering yang lain.",
                showConfirmButton: true,
                timer: 3000
            });
        });
    </script>
<?php endif; ?>


<?php
require_once __DIR__ . '/../../pages/layouts/footer.php';
?>