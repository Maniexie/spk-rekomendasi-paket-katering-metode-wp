<?php

header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

/*
|--------------------------------------------------------------------------
| Halaman public (boleh tanpa login)
|--------------------------------------------------------------------------
*/
$publicPages = [
    'landing_page',
    'menu_katering',
    'paket_katering',
    'hasil_paket_menu',
    'login'
];

/*
|--------------------------------------------------------------------------
| belum login → hanya blokir halaman private
|--------------------------------------------------------------------------
*/
if (!isset($_SESSION['id_user']) && !in_array($page, $publicPages)) {
    header("Location: index.php?page=login");
    exit;
}

/*
|--------------------------------------------------------------------------
| sudah login → cegah balik login
|--------------------------------------------------------------------------
*/
if (isset($_SESSION['id_user']) && $page === 'login') {
    header("Location: index.php?page=dashboard");
    exit;
}
