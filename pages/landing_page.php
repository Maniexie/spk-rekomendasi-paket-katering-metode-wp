<?php require_once __DIR__ . "/headerlp.php" ?>
<section class="hero">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">Katering Lezat & Terpercaya</h1>
        <p class="lead mt-3">
            Solusi katering harian, acara, dan kebutuhan kantor Anda
        </p>

        <div class="mt-4">
            <a href="index.php?page=menu_katering" class="btn btn-success btn-lg me-2">
                Lihat Menu
            </a>
            <a href="#keunggulan" class="btn btn-outline-light btn-lg">
                Kenapa Kami?
            </a>
        </div>
    </div>
</section>

<!-- KEUNGGULAN -->
<section id="keunggulan" class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Kenapa Pilih Assifa Katering?</h2>
            <p class="text-muted">Kami mengutamakan kualitas & kepuasan pelanggan</p>
        </div>

        <div class="row text-center">
            <div class="col-md-4">
                <div class="feature-icon mb-3">🍱</div>
                <h5>Menu Variatif</h5>
                <p class="text-muted">Pilihan menu lengkap & bisa custom sesuai kebutuhan</p>
            </div>
            <div class="col-md-4">
                <div class="feature-icon mb-3">⏰</div>
                <h5>Tepat Waktu</h5>
                <p class="text-muted">Pemesanan selalu sesuai jadwal yang disepakati</p>
            </div>
            <div class="col-md-4">
                <div class="feature-icon mb-3">💰</div>
                <h5>Harga Terjangkau</h5>
                <p class="text-muted">Kualitas premium dengan harga bersahabat</p>
            </div>
        </div>
    </div>
</section>

<!-- GRID MENU -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="fw-bold">Menu Favorit</h2>
            <p class="text-muted">Pilihan menu yang paling diminati pelanggan</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <img src="<?= BASE_URL ?>assets/img/gambarlp1.jpg" class="card-img-top menu-img"
                        alt="Gambar menu 1 Assifa Katering">
                    <div class="card-body text-center">
                        <h5>Paket Nasi Box</h5>
                        <p class="text-muted">Lengkap & praktis</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm">
                    <img src="<?= BASE_URL ?>assets/img/gambarlp2.jpg" class="card-img-top menu-img">
                    <div class="card-body text-center">
                        <h5>Paket Prasmanan</h5>
                        <p class="text-muted">Cocok untuk acara besar</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm">
                    <img src="<?= BASE_URL ?>assets/img/gambarlp3.jpg" class="card-img-top menu-img">
                    <div class="card-body text-center">
                        <h5>Paket Harian</h5>
                        <p class="text-muted">Praktis untuk kebutuhan sehari-hari</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="index.php?page=menu_favorit" class="btn btn-outline-success">
                Lihat Semua Menu
            </a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . "/footerlp.php" ?>