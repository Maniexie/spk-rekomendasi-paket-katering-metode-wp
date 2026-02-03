<?php


function checkRoleAccess($page)
{
    $role = $_SESSION['role'] ?? null;


    $rolePages = [
        'Pemilik' => [
            'dashboard',
            'profil',

            // kriteria
            'kriteria',
            'tambah_kriteria',

            // menu katering
            'menu_katering',
            'tambah_menu_katering',

            // paket katering
            'paket_katering',
            'tambah_paket_katering',

            // hasil paket menu
            'hasil_paket_menu',
            'tambah_hasil_paket_menu',

            // pesan hasil paket katering
            'pesan_hasil_paket_katering',
            'pesan_paket_katering_fix',



        ],

        'Pelanggan' => [
            'dashboard',
            'profil',
            'input_budget_pelanggan',
            'hasil_budget_pelanggan',
            //  keranjang pemesanan
            'keranjang_pemesanan',
            'tambah_keranjang',
            'update_keranjang_pemesanan',
            'get_pemesanan',

            // kriteria
            'kriteria',
            'tambah_kriteria',

            // menu katering
            'menu_katering',
            'tambah_menu_katering',

            // paket katering
            'paket_katering',
            'tambah_paket_katering',

            // hasil paket menu
            'hasil_paket_menu',
            'tambah_hasil_paket_menu',

            // pesan hasil paket katering
            'pesan_hasil_paket_katering',
            'pesan_paket_katering_fix',
            'pesan_paket_katering',
            'proses_checkout',
            'riwayat_pemesanan_pelanggan',
            'detail_riwayat_pemesanan_pelanggan',

            // proses checkout langsung
            'proses_checkout_langsung',

        ],
    ];

    if (!isset($rolePages[$role]) || !in_array($page, $rolePages[$role])) {
        http_response_code(403);
        require_once __DIR__ . '/../pages/errors/forbidden.php';
        // header("Location: index.php?page=forbidden");
        exit;
    }



}
