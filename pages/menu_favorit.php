<?php require_once __DIR__ . "/headerlp.php" ?>

<div class="container py-5">

    <h2 class="text-center mb-4 fw-bold mt-2">Menu Favorit</h2>

    <div class="row g-4">

        <?php
        // contoh data dummy (nanti bisa dari database)
        $menu = [
            ["nama" => "Paket Ayam Bakar", "harga" => 25000, "gambar" => "ayambakar.jpg"],
            ["nama" => "Paket Rendang", "harga" => 28000, "gambar" => "rendang.jpeg"],
            ["nama" => "Paket Ikan Nila Goreng", "harga" => 24000, "gambar" => "ikangoreng.jpg"],
            ["nama" => "Paket Nasi Tumpeng Mini", "harga" => 35000, "gambar" => "nasitumpeng.jpg"],
            ["nama" => "Paket Snack Box", "harga" => 15000, "gambar" => "snackbox.jpg"],

            ["nama" => "Paket Ayam Geprek", "harga" => 23000, "gambar" => "ayamgeprek.jpg"],
            ["nama" => "Paket Ayam Kecap", "harga" => 24000, "gambar" => "ayamkecap.jpg"],
            ["nama" => "Paket Daging Balado", "harga" => 30000, "gambar" => "dagingbalado.jpg"],
            ["nama" => "Paket Nasi Liwet", "harga" => 26000, "gambar" => "nasiliwet.jpg"],
            // ["nama" => "Paket Soto Ayam", "harga" => 22000, "gambar" => "sotoayam.jpg"],
        ];

        foreach ($menu as $m):
            ?>

            <div class="col-md-4"> <!-- 3 kolom -->
                <div class="card h-100 shadow-sm border-0">

                    <img src="assets/img/menulp/<?= $m['gambar'] ?>" class="card-img-top"
                        style="height:200px; object-fit:cover;">

                    <div class="card-body text-center">
                        <h5 class="fw-semibold"><?= $m['nama'] ?></h5>

                        <p class="text-success fw-bold">
                            Rp <?= number_format($m['harga'], 0, ',', '.') ?>
                        </p>

                        <a href="index.php?page=login" class="btn btn-warning w-100">
                            Pesan Sekarang
                        </a>
                    </div>

                </div>
            </div>

        <?php endforeach; ?>

    </div>
</div>

<?php require_once __DIR__ . "/footerlp.php" ?>