<?php
session_start();
$ajaxPages = [
    'update_keranjang_pemesanan',
    'get_pemesanan'
];

$allowedPages = [
    'landing_page' => 'pages/landing_page.php',
    'login' => 'pages/auth/login.php',

    'menu_favorit' => 'pages/menu_favorit.php',
    'logout' => 'pages/auth/logout.php',
    'dashboard' => 'pages/dashboard.php',
    'profil' => 'pages/profil.php',

    'input_budget_pelanggan' => 'pages/budget-pelanggan/input_budget_pelanggan.php',
    'hasil_budget_pelanggan' => 'pages/budget-pelanggan/hasil_budget_pelanggan.php',

    'keranjang_pemesanan' => 'pages/keranjang-pemesanan/keranjang_pemesanan.php',
    'tambah_keranjang' => 'pages/keranjang-pemesanan/tambah_keranjang.php',
    'get_pemesanan' => 'pages/keranjang-pemesanan/get_pemesanan.php',
    'update_keranjang_pemesanan' => 'pages/keranjang-pemesanan/update_keranjang_pemesanan.php',

    'kriteria' => 'pages/kriteria/kriteria.php',
    'tambah_kriteria' => 'pages/kriteria/tambah_kriteria.php',

    'menu_katering' => 'pages/menu-katering/menu_katering.php',
    'tambah_menu_katering' => 'pages/menu-katering/tambah_menu_katering.php',
    'edit_menu_katering' => 'pages/menu-katering/edit_menu_katering.php',
    'hapus_menu_katering' => 'pages/menu-katering/hapus_menu_katering.php',

    'paket_katering' => 'pages/paket-katering/paket_katering.php',
    'tambah_paket_katering' => 'pages/paket-katering/tambah_paket_katering.php',
    'edit_paket_katering' => 'pages/paket-katering/edit_paket_katering.php',
    'hapus_paket_katering' => 'pages/paket-katering/hapus_paket_katering.php',


    'hasil_paket_menu' => 'pages/hasil-paket-menu/hasil_paket_menu.php',
    'tambah_hasil_paket_menu' => 'pages/hasil-paket-menu/tambah_hasil_paket_menu.php',

    'pesan_hasil_paket_katering' => 'pages/pesan-paket/pesan_hasil_paket_katering.php',
    'pesan_paket_katering_fix' => 'pages/pesan-paket/pesan_paket_katering_fix.php',

    'pesan_paket_katering' => 'pages/pesan-paket/pesan_paket_katering.php',
    'proses_checkout' => 'pages/pesan-paket/proses_checkout.php',

    'proses_checkout_langsung' => 'pages/pesan-paket/proses_checkout_langsung.php',

    'riwayat_pemesanan_pelanggan' => 'pages/riwayat_pemesanan/riwayat_pemesanan_pelanggan.php',
    'detail_riwayat_pemesanan_pelanggan' => 'pages/riwayat_pemesanan/detail_riwayat_pemesanan_pelanggan.php',

    'riwayat_pemesanan_pemilik' => 'pages/riwayat_pemesanan/riwayat_pemesanan_pemilik.php',
    'detail_riwayat_pemesanan_pemilik' => 'pages/riwayat_pemesanan/detail_riwayat_pemesanan_pemilik.php',

    'update_status_pemesanan' => 'pages/riwayat_pemesanan/update_status_pemesanan.php',

    'forbidden' => 'pages/error/403.php',
    '404' => 'pages/error/404.php',


];

$page = isset($_GET['page']) ? $_GET['page'] : 'landing_page';


switch ($page) {

    case 'landing_page':
        $title = "Landing";
        break;

    case 'menu_favorit':
        $title = "Menu Favorit";
        break;
    case 'dashboard':
        $title = "Dashboard";
        // $content = "pages/dashboard.php";
        break;
    // Auth
    case 'login':
        $title = "Login";
        break;
    case 'logout':
        $title = "Logout";
        break;

    // Profil
    case 'profil':
        $title = "Profil";
        break;

    // Budget Pelanggan
    case 'input_budget_pelanggan':
        $title = "Input Budget Pelanggan";
        break;
    case 'hasil_budget_pelanggan':
        $title = "Hasil Budget Pelanggan";
        break;

    // Keranjang
    case 'keranjang':
        $title = "Keranjang";
        break;
    case 'tambah_keranjang':
        $title = "Tambah Keranjang";
        break;
    case 'keranjang_pemesanan':
        $title = "Keranjang Pemesanan";
        break;



    //kriteria
    case 'kriteria':
        $title = "Kriteria";
        break;
    case 'tambah_kriteria':
        $title = "Tambah Kriteria";
        break;

    //menu katering
    case 'menu_katering':
        $title = "Menu Katering";
        break;
    case 'tambah_menu_katering':
        $title = "Tambah Menu Katering";
        break;
    case 'edit_menu_katering':
        $title = "Edit Menu Katering";
        break;
    case 'hapus_menu_katering':
        $title = "Hapus Menu Katering";
        break;

    //paket katering
    case 'paket_katering':
        $title = "Paket Katering";
        break;
    case 'tambah_paket_katering':
        $title = "Tambah Paket Katering";
        break;
    case 'edit_paket_katering':
        $title = "Edit Paket Katering";
        break;
    case 'hapus_paket_katering':
        $title = "Hapus Paket Katering";
        break;

    case 'pesan_hasil_paket_katering':
        $title = "Pesan Hasil Paket Katering";
        break;
    case 'pesan_paket_katering_fix':
        $title = "Pesan Paket Katering Fix";
        break;

    //hasil paket menu
    case 'hasil_paket_menu':
        $title = "Hasil Paket Menu";
        break;
    case 'tambah_hasil_paket_menu':
        $title = "Tambah Hasil Paket Menu";
        break;


    //pesan paket katering langsung
    case 'proses_checkout_langsung':
        $title = "Proses Checkout Langsung";
        break;
    //pesan paket katering
    case 'pesan_paket_katering':
        $title = "Pesan Paket Katering";
        break;
    case 'proses_checkout':
        $title = "Proses Checkout";
        break;
    //riwayat pemesanan pelanggan
    case 'riwayat_pemesanan_pelanggan':
        $title = "Riwayat Pemesanan Pelanggan";
        break;
    case 'detail_riwayat_pemesanan_pelanggan':
        $title = "Detail Riwayat Pemesanan Pelanggan";
        break;

    //riwayat pemesanan pemilik
    case 'riwayat_pemesanan_pemilik':
        $title = "Riwayat Pemesanan Pemilik";
        break;
    case 'detail_riwayat_pemesanan_pemilik':
        $title = "Detail Riwayat Pemesanan Pemilik";
        break;



    // Error Pages
    case 'forbidden':
        $title = "Forbidden 403";
        break;
    default:
        $title = "404 Page Not Found";
        break;
}
if (!isset($allowedPages[$page])) {
    echo "<h3>404 - Halaman tidak ditemukan</h3>";
    exit;
}

/*
|--------------------------------------------------------------------------
| 🔥 AJAX BYPASS
|--------------------------------------------------------------------------
| halaman ajax jangan kena middleware / header / html
*/
if (in_array($page, $ajaxPages)) {
    require $allowedPages[$page];
    exit;
}


/*
|--------------------------------------------------------------------------
| Normal page (pakai role & layout)
|--------------------------------------------------------------------------
*/
if (!in_array($page, ['login', 'logout'])) {
    require_once __DIR__ . '/middleware/role.php';
    checkRoleAccess($page);
}

require_once $allowedPages[$page];
