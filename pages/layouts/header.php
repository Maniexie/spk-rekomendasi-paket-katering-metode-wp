<?php
require_once __DIR__ . '/../../koneksi.php';
$BASE_URL = BASE_URL;



?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">

    <!-- <link rel="stylesheet" href="assets/css/style.css"> -->
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOj1EOiFqcLo7l6rXmdpmOZFTobbGdgm225pTqoa0UCEhSh+Q5x8vnX2cvX/7+/Lw==" crossorigin="anonymous">
    <!-- CDN Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
        integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="admin-container">
        <!-- Sidebar Navigation -->
        <nav class="sidebar ">
            <h4>SPK</h4>
            <!-- <p><?= BASE_URL ?></p> -->
            <hr>
            <ul class="nav flex-column">
                <li class="nav-item"><a href="index.php?page=dashboard" class="nav-link"
                        aria-current="page">Dashboard</a></li>
                <li class="nav-item"><a href="index.php?page=profil" class="nav-link">Profil</a></li>


                <?php if ($_SESSION['role'] == 'Pelanggan'): ?>
                    <li class="nav-item"><a href="index.php?page=input_budget_pelanggan" class="nav-link">Input Budget
                            Pelanggan</a></li>
                <?php endif ?>

                <?php if ($_SESSION['role'] == 'Pemilik'): ?>
                    <!-- <li class="nav-item"><a href="index.php?page=kriteria" class="nav-link">Kriteria</a></li> -->
                    <li class="nav-item"><a href="index.php?page=menu_katering" class="nav-link">Menu Katering</a></li>
                    <li class="nav-item"><a href="index.php?page=paket_katering" class="nav-link">Paket Katering</a></li>
                <?php endif ?>

                <li class="nav-item"><a href="index.php?page=hasil_paket_menu" class="nav-link">Daftar Paket
                        Katering</a>
                </li>

                <li><a href="index.php?page=logout" class="nav-link">Logout</a></li>
            </ul>
        </nav>

        <!-- Main Content Area -->
        <div class="main-content">
            <!-- Header -->
            <header>
                <h4><?= $title ?></h4>
                <div class="user-profile text-capitalize">Selamat datang,
                    <?php echo $_SESSION['nama']; ?>(<span class=""><?php echo $_SESSION['role']; ?></span>)
                </div>
            </header>