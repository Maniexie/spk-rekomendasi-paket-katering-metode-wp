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

                <li class="nav-item"><a href="index.php?page=input_budget_pelanggan" class="nav-link">Input Budget
                        Pelanggan</a></li>
                <li class="nav-item"><a href="index.php?page=kriteria" class="nav-link">Kriteria</a></li>
                <li class="nav-item"><a href="index.php?page=menu_katering" class="nav-link">Menu Katering</a></li>
                <li class="nav-item"><a href="index.php?page=paket_katering" class="nav-link">Paket Katering</a>
                <li class="nav-item"><a href="index.php?page=hasil_paket_menu" class="nav-link">Daftar Paket
                        Katering</a>
                </li>

                <!-- <li class="nav-item">
                    <a class="nav-link text-white d-flex justify-content-between align-items-center"
                        data-bs-toggle="collapse" href="#supervisi" role="button" aria-expanded="false"
                        aria-controls="supervisi">
                        <span>Supervisiasd</span>
                        <i class="fa fa-chevron-down"></i>
                    </a>

                    <div class="collapse ps-3 mt-1" id="supervisi">
                        <ul class="nav flex-column">


                            <li class="nav-item">
                                <a class="nav-link text-white sub-list"
                                    href="index.php?page=kategori_tindak_lanjut_hasil_supervisi">
                                    Kategori Tindak Lanjut Hasil Supervisi
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white sub-list" href="index.php?page=kategori_penilaian">
                                    Kategori Item Penilaian
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white sub-list" href="index.php?page=item_penilaian">
                                    Item Penilaian
                                </a>
                            </li>
                            <li class="nav-item test">
                                <a class="nav-link text-white sub-list"
                                    href="index.php?page=daftar_versi_hasil_uji_validitas">
                                    Hasil Uji Validitas
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link" href="javascript:void(0)" onclick="logoutAlert()">Logout</a>
                </li> -->
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