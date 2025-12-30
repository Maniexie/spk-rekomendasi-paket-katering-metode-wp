<?php
require_once __DIR__ . '/../../pages/layouts/header.php';
require_once __DIR__ . '/../../koneksi.php';


$old_id_paket_katering = $_POST['id_paket_katering'] ?? '';

$error = false;
$error_message = '';

$getDataPaketKatering = mysqli_query($koneksi, " SELECT * FROM paket_katering "); // mengambil data paket katering dari tabel paket_katering
$getDataMenutKatering = mysqli_query($koneksi, " SELECT * FROM menu_katering "); // mengambil data menu katering dari tabel menu_katering

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_paket_katering = $_POST['id_paket_katering'] ?? '';
    $menu = $_POST['menu'] ?? [];

    // VALIDASI
    if (empty($id_paket_katering)) {
        $error = true;
        $error_message = "Paket katering harus dipilih";
    } elseif (empty($menu)) {
        $error = true;
        $error_message = "Minimal pilih 1 menu katering";
    } else {

        // (OPSIONAL) hapus menu lama jika edit
        mysqli_query($koneksi, "
            DELETE FROM hasil_paket_menu 
            WHERE id_paket_katering = '$id_paket_katering'
        ");

        // INSERT MENU KE TABEL RELASI
        foreach ($menu as $id_menu_katering) {
            mysqli_query($koneksi, "
                INSERT INTO hasil_paket_menu (id_paket_katering, id_menu_katering)
                VALUES ('$id_paket_katering', '$id_menu_katering')
            ");
        }

        // NOTIFIKASI BERHASIL
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Menu berhasil ditambahkan ke paket katering',
                timer: 2000,
                showConfirmButton: false
            }).then(() => {
                window.location.href = 'index.php?page=hasil_paket_menu';
            });
        </script>";
        exit;
    }
}
?>

<!-- Content -->
<section>
    <div class="container border rounded p-4 mb-4 mt-2">
        <!-- start get data value -->
        <h2 class="text-center">Tambah Daftar Paket Katering</h2>

        <!-- Form -->
        <form class="needs-validation" method="post">
            <div class="col-md mt-2">
                <label for="id_paket_katering" class="form-label" style="margin-bottom: -10px;">Nama Paket
                    Katering</label>
                <select class="form-select" id="id_paket_katering" name="id_paket_katering" required>
                    <option selected disabled value="">==Nama Paket==</option>
                    <?php while ($paket = mysqli_fetch_assoc($getDataPaketKatering)): ?>
                        <option value="<?= $paket['id_paket_katering'] ?>"
                            <?= ($old_id_paket_katering == $paket['id_paket_katering']) ? 'selected' : '' ?>>
                            <?= $paket['nama_paket'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="col-md mt-3">
                <label class="form-label">Pilih Menu Katering</label>
                <div class="border rounded p-3">

                    <?php while ($menu = mysqli_fetch_assoc($getDataMenutKatering)): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="menu[]"
                                value="<?= $menu['id_menu_katering']; ?>" id="menu<?= $menu['id_menu_katering']; ?>">
                            <label class="form-check-label" for="menu<?= $menu['id_menu_katering']; ?>">
                                <?= $menu['nama_menu']; ?>
                            </label>
                        </div>
                    <?php endwhile; ?>

                </div>
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