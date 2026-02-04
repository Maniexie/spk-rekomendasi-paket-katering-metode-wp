<?php
require_once __DIR__ . '/../koneksi.php';
?>
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
                url('<?= BASE_URL ?>assets/img/hero.jpg') no-repeat;
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
            <a class="navbar-brand fw-bold" href="index.php?page=landing_page">Assifa Katering</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center gap-2">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php?page=landing_page">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=menu_favorit">Menu</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">Tentang Kami</a>
                    </li> -->
                    <li class="nav-item">
                        <a href="index.php?page=login" class="btn btn-success btn-sm">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>