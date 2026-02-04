<?php
require_once __DIR__ . '/../../pages/layouts/header.php';
require_once __DIR__ . '/../../koneksi.php';

$id_paket_katering = $_GET['id_paket_katering'] ?? '';

$query = "SELECT * FROM paket_katering WHERE id_paket_katering = '$id_paket_katering'";
$result = mysqli_query($koneksi, $query);


$deleteQuery = "DELETE FROM paket_katering WHERE id_paket_katering = '$id_paket_katering'";
mysqli_query($koneksi, $deleteQuery);
echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    Swal.fire({
        title: "Proses Hapus Data Paket Katering",
        timer: 1500,
        didOpen: () => {
            Swal.showLoading();
        }
    }).then(() => {
        Swal.fire({
            icon: "success",
            title: "Data Paket Katering Berhasil di Hapus",
            showConfirmButton: true,
            timer: 3000
        }).then(() => {
            window.location.href = "index.php?page=paket_katering";
        });
    })
    </script>';
?>


<?php
require_once __DIR__ . '/../../pages/layouts/footer.php';
?>