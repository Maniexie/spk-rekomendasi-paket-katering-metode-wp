<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assifa Katering</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .hero {
            background: linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, .5)),
                url('https://plus.unsplash.com/premium_photo-1723867267202-169dfe3b197a?fm=jpg&q=60&w=3000&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8Y2F0ZXJpbmd8ZW58MHx8MHx8fDA%3D');
            background-size: cover;
            background-position: center;
            min-height: 80vh;
            color: white;
            display: flex;
            align-items: center;
        }

        .feature-icon {
            font-size: 40px;
            color: #198754;
        }

        .menu-img {
            height: 220px;
            object-fit: cover;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm fixed-top">
        <div class="container d-flex justify-content-between">
            <a class="navbar-brand fw-bold" href="#">Assifa Katering</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center gap-2">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?page=login" class="btn btn-success btn-sm">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- HERO -->
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
                        <img src="https://www.shutterstock.com/image-photo/food-catering-served-on-paper-600nw-2386457579.jpg"
                            class="card-img-top menu-img">
                        <div class="card-body text-center">
                            <h5>Paket Nasi Box</h5>
                            <p class="text-muted">Lengkap & praktis</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <img src="https://cdn.pixabay.com/photo/2019/09/28/17/25/food-4511335_640.jpg"
                            class="card-img-top menu-img">
                        <div class="card-body text-center">
                            <h5>Paket Prasmanan</h5>
                            <p class="text-muted">Cocok untuk acara besar</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <img src="https://www.unileverfoodsolutions.co.id/id/inspirasi-chef/menu-catering/jcr:content/parsys/set1/row2/span12/image_1338112062.img.jpg/1736551308996.jpg"
                            class="card-img-top menu-img">
                        <div class="card-body text-center">
                            <h5>Paket Harian</h5>
                            <p class="text-muted">Praktis untuk kebutuhan sehari-hari</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="index.php?page=menu_katering" class="btn btn-outline-success">
                    Lihat Semua Menu
                </a>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-dark text-white text-center py-4">
        <p class="mb-0">
            ©
            <?= date('Y') ?> Assifa Katering · Dibuat dengan ❤️
        </p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>