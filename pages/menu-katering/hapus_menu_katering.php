<?php
require_once __DIR__ . '/../../pages/layouts/header.php';
require_once __DIR__ . '/../../koneksi.php';

$id_menu_katering = $_GET['id_menu_katering'] ?? '';

$query = "SELECT * FROM menu_katering WHERE id_menu_katering = '$id_menu_katering'";
$result = mysqli_query($koneksi, $query);


$deleteQuery = "DELETE FROM menu_katering WHERE id_menu_katering = '$id_menu_katering'";
mysqli_query($koneksi, $deleteQuery);
echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    Swal.fire({
        title: "Proses Hapus Data Menu Katering",
        timer: 1500,
        didOpen: () => {
            Swal.showLoading();
        }
    }).then(() => {
        Swal.fire({
            icon: "success",
            title: "Data Menu Katering Berhasil di Hapus",
            showConfirmButton: true,
            timer: 3000
        }).then(() => {
            window.location.href = "index.php?page=menu_katering";
        });
    })
    </script>';
?>


<?php
require_once __DIR__ . '/../../pages/layouts/footer.php';
?>