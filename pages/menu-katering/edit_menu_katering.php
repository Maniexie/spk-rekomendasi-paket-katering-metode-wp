<?php
require_once __DIR__ . '/../../pages/layouts/header.php';
require_once __DIR__ . '/../../koneksi.php';

$id_menu_katering = $_GET['id_menu_katering'] ?? '';

$query = "SELECT * FROM menu_katering WHERE id_menu_katering = '$id_menu_katering'";
$result = mysqli_query($koneksi, $query);

$old_nama_menu = '';
if ($row = mysqli_fetch_assoc($result)) {
    $old_nama_menu = $row['nama_menu'];
}

$error = false;
$error_message = '';

if (isset($_POST['submit'])) {

    $id_menu_katering = $_POST['id_menu_katering'];
    $nama_menu = trim($_POST['nama_menu']);

    // ===============================
    // CEK NAMA DUPLIKAT (exclude dirinya sendiri)
    // ===============================
    $cek = $koneksi->prepare(
        "SELECT 1 FROM menu_katering 
         WHERE nama_menu = ? 
         AND id_menu_katering != ?"
    );

    $cek->bind_param("si", $nama_menu, $id_menu_katering);
    $cek->execute();
    $cek->store_result();

    // ===============================
    // JIKA DUPLIKAT → ERROR
    // ===============================
    if ($cek->num_rows > 0) {

        echo '
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
        Swal.fire({
            icon: "error",
            title: "Gagal!",
            text: "Nama menu sudah digunakan, silakan gunakan nama lain.",
            confirmButtonColor: "#d33"
        })
        </script>';

        $old_nama_menu = $nama_menu;
    }

    // ===============================
    // JIKA AMAN → UPDATE
    // ===============================
    else {

        $stmt = $koneksi->prepare(
            "UPDATE menu_katering 
             SET nama_menu = ? 
             WHERE id_menu_katering = ?"
        );

        $stmt->bind_param("si", $nama_menu, $id_menu_katering);
        $stmt->execute();

        echo '
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
        Swal.fire({
            icon: "success",
            title: "Berhasil!",
            text: "Data menu katering berhasil di edit",
            confirmButtonColor: "#3085d6"
        }).then(() => {
            window.location.href = "index.php?page=menu_katering";
        });
        </script>';
    }
}

?>


<!-- Content -->
<section>
    <div class="container border rounded p-4 mb-4 mt-2">
        <h2 class="text-center">Edit Menu Katering</h2>
        <!-- Form -->
        <form class="needs-validation" method="post">
            <div class="col-md mt-2">
                <input type="hidden" name="id_menu_katering" value="<?= $id_menu_katering ?>">
                <label for="nama_menu" class="form-label" style="margin-bottom: -10px;">Nama Menu Katering</label>
                <input type="text" class="form-control" id="nama_menu" name="nama_menu" value="<?= $old_nama_menu ?>">
            </div>

            <div class="col-12 mt-2">
                <button class="btn btn-primary" type="submit" name="submit">Submit</button>
            </div>
        </form>
    </div>
</section>

<?php
require_once __DIR__ . '/../../pages/layouts/footer.php';
?>