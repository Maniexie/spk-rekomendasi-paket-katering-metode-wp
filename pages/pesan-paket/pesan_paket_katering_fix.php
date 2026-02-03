<?php

require_once __DIR__ . '/../../pages/layouts/header.php';
require_once __DIR__ . '/../../koneksi.php';

$id_paket_katering = $_GET['id_paket_katering'] ?? '';
$budget = $_GET['budget'] ?? '';
$jumlahPorsi = $_GET['jumlah_porsi'] ?? '';

$getDataHasilPaketMenu = mysqli_query($koneksi, "SELECT hasil_paket_menu.*,
menu_katering.nama_menu,
paket_katering.nama_paket,
paket_katering.harga,
GROUP_CONCAT(menu_katering.nama_menu SEPARATOR '<br>') AS nama_menu
 FROM hasil_paket_menu 
 JOIN menu_katering ON hasil_paket_menu.id_menu_katering = menu_katering.id_menu_katering
 JOIN paket_katering ON hasil_paket_menu.id_paket_katering = paket_katering.id_paket_katering
 WHERE hasil_paket_menu.id_paket_katering = '$id_paket_katering'");


$dataPaketKatering = [];
if (mysqli_num_rows($getDataHasilPaketMenu) > 0) {
    $dataPaketKatering = mysqli_fetch_assoc($getDataHasilPaketMenu);
}

?>

<section>
    <div class="container">
        <div class="cards">
            <div class="card">
                <h3 class="card-title text-center">Pesan Paket Katering</h3>
                <div class="row">
                    <div class="col-md-6">
                        <p class="card-text">
                            budget Anda: Rp
                            <?= number_format($budget) ?><br>
                            Nama Paket Katering: <?= $dataPaketKatering['nama_paket'] ?>
                            <br>
                            Harga: Rp <?= number_format($dataPaketKatering['harga']) ?>
                            <br>
                            Menu :
                            <br>
                            <?= $dataPaketKatering['nama_menu'] ?>
                            <br>

                            Total Porsi: <?= $jumlahPorsi ?><br>
                            Total Pembayaran: Rp <?= number_format($dataPaketKatering['harga'] * $jumlahPorsi) ?>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p class="card-text text-center">
                            <img src="<?= BASE_URL ?>/assets/img/bca-logo.png" class="img-fluid" width="200px"
                                height="200px" alt="">
                            <br>
                            <span>a/n Assifa Katering <br> 24510706222</span>
                        </p>
                    </div>
                </div>
                <form action="index.php?page=proses_checkout_langsung" method="POST">

                    <input type="hidden" name="id_paket" value="<?= $id_paket_katering ?>">
                    <input type="hidden" name="nama_paket" value="<?= $dataPaketKatering['nama_paket'] ?>">
                    <input type="hidden" name="harga" value="<?= $dataPaketKatering['harga'] ?>">
                    <input type="hidden" name="jumlah" value="<?= $jumlahPorsi ?>">
                    <input type="hidden" name="total" value="<?= $dataPaketKatering['harga'] * $jumlahPorsi ?>">

                    <button class="btn btn-success btn w-24 text-center mt-2" target="_blank">
                        Konfirmasi Pesanan
                    </button>
                </form>

            </div>
        </div>
    </div>
</section>




<?php
require_once __DIR__ . '/../../pages/layouts/footer.php';
?>