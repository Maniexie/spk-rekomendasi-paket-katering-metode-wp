<?php

require_once __DIR__ . '/../../pages/layouts/header.php';
require_once __DIR__ . '/../../koneksi.php';

$id_paket_katering = $_GET['id_paket_katering'] ?? '';
$budget = $_GET['budget'] ?? '';

$query = "
    SELECT paket_katering.*,
    hasil_paket_menu.id_menu_katering,
    menu_katering.id_menu_katering,
    GROUP_CONCAT(menu_katering.nama_menu SEPARATOR '<br>') AS nama_menu
    FROM paket_katering 
    JOIN hasil_paket_menu ON paket_katering.id_paket_katering = hasil_paket_menu.id_paket_katering 
    JOIN menu_katering ON hasil_paket_menu.id_menu_katering = menu_katering.id_menu_katering
    WHERE hasil_paket_menu.id_paket_katering = '$id_paket_katering' "
;
$result = mysqli_query($koneksi, $query);


if (mysqli_num_rows($result) > 0) {
    $paket_katering = mysqli_fetch_assoc($result);
} else {
    header('Location: index.php?page=paket_katering');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $_SESSION['id_paket_katering'] = $_POST['id_paket_katering'];
    $_SESSION['budget'] = $_POST['budget'];
    $_SESSION['porsi'] = $_POST['porsi'];


    // $simpanData = mysqli_query($koneksi, "INSERT INTO riwayat_pemesanan (id_paket_katering, budget, porsi) VALUES ('$id_paket_katering', '$budget', '$porsi')");

    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            title: "Memproses Pemesanan",
            timer: 1500,
            didOpen: () => {
                Swal.showLoading();
            }
        }).then(() => {
            window.location.href = "index.php?page=pesan_paket_katering_fix";
        });
    </script>';
    exit;
}



?>
<h2 class="content-title text-center">Pesan Hasil Paket Katering</h2>


<div class="container">
    <div class="card">
        <div class="alert alert-success">
            <strong>Hasil Budget Paket Katering dengan harga Rp <?= number_format($budget); ?> mendapatkan:</strong><br>
            Nama Paket: <?= $paket_katering['nama_paket']; ?><br>
            Harga: Rp <?= number_format($paket_katering['harga']); ?><br>
            Menu: <?= $paket_katering['nama_menu']; ?><br>
        </div>
        <form action="" method="post">
            <input type="hidden" name="id_paket_katering" value="<?= $id_paket_katering; ?>">
            <input type="hidden" name="budget" value="<?= $budget; ?>">
            <label for="porsi">
                <strong>Porsi</strong>
                <input type="number" class="form-control" id="porsi" name="porsi" value="1" required>
            </label>
            <button type="submit" class="btn btn-primary" name="submit">Pesan</button>
        </form>
    </div>
</div>