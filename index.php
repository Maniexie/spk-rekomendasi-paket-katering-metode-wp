<?php
session_start();

$allowedPages = [
    'login' => 'pages/auth/login.php',
    'logout' => 'pages/auth/logout.php',
    'dashboard' => 'pages/dashboard.php',
    'profil' => 'pages/profil.php',

    'input_budget_pelanggan' => 'pages/budget-pelanggan/input_budget_pelanggan.php',
    'hasil_budget_pelanggan' => 'pages/budget-pelanggan/hasil_budget_pelanggan.php',

    'keranjang_pemesanan' => 'pages/keranjang-pemesanan/keranjang_pemesanan.php',
    'tambah_keranjang' => 'pages/keranjang-pemesanan/tambah_keranjang.php',

    'kriteria' => 'pages/kriteria/kriteria.php',
    'tambah_kriteria' => 'pages/kriteria/tambah_kriteria.php',

    'menu_katering' => 'pages/menu-katering/menu_katering.php',
    'tambah_menu_katering' => 'pages/menu-katering/tambah_menu_katering.php',

    'paket_katering' => 'pages/paket-katering/paket_katering.php',
    'tambah_paket_katering' => 'pages/paket-katering/tambah_paket_katering.php',


    'hasil_paket_menu' => 'pages/hasil-paket-menu/hasil_paket_menu.php',
    'tambah_hasil_paket_menu' => 'pages/hasil-paket-menu/tambah_hasil_paket_menu.php',

    'pesan_hasil_paket_katering' => 'pages/pesan-paket/pesan_hasil_paket_katering.php',
    'pesan_paket_katering_fix' => 'pages/pesan-paket/pesan_paket_katering_fix.php',

    'forbidden' => 'pages/error/403.php',
    '404' => 'pages/error/404.php',


];

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

switch ($page) {
    case 'dashboard':
        $title = "Dashboard";
        // $content = "pages/dashboard.php";
        break;
    // Auth
    case 'login':
        $title = "Login Page";
        break;
    case 'logout':
        $title = "Logout Page";
        break;

    // Profil
    case 'profil':
        $title = "Profil Page";
        break;

    // Budget Pelanggan
    case 'input_budget_pelanggan':
        $title = "Input Budget Pelanggan Page";
        break;
    case 'hasil_budget_pelanggan':
        $title = "Hasil Budget Pelanggan Page";
        break;

    // Keranjang

    case 'keranjang':
        $title = "Keranjang Page";
        break;
    case 'tambah_keranjang':
        $title = "Tambah Keranjang Page";
        break;


    //kriteria
    case 'kriteria':
        $title = "Kriteria Page";
        break;
    case 'tambah_kriteria':
        $title = "Tambah Kriteria Page";
        break;

    //menu katering
    case 'menu_katering':
        $title = "Menu Katering Page";
        break;
    case 'tambah_menu_katering':
        $title = "Tambah Menu Katering Page";
        break;

    //paket katering
    case 'paket_katering':
        $title = "Paket Katering Page";
        break;
    case 'tambah_paket_katering':
        $title = "Tambah Paket Katering Page";
        break;
    case 'pesan_hasil_paket_katering':
        $title = "Pesan Hasil Paket Katering Page";
        break;
    case 'pesan_paket_katering_fix':
        $title = "Pesan Paket Katering Fix Page";
        break;

    //hasil paket menu
    case 'hasil_paket_menu':
        $title = "Hasil Paket Menu Page";
        break;
    case 'tambah_hasil_paket_menu':
        $title = "Tambah Hasil Paket Menu Page";
        break;

    // Error Pages
    case 'forbidden':
        $title = "Forbidden 403 Page";
        break;
    default:
        $title = "404 Page Not Found";
        break;
}
if (!isset($allowedPages[$page])) {
    echo "<h3>404 - Halaman tidak ditemukan</h3>";
    exit;
}


// 2️⃣ cek role (kecuali login & logout)
if (!in_array($page, ['login', 'logout'])) {
    require_once __DIR__ . '/middleware/role.php';
    checkRoleAccess($page);
}

require_once $allowedPages[$page];
