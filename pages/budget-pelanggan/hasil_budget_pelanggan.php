<?php
require_once __DIR__ . '/../../pages/layouts/header.php';
require_once __DIR__ . '/../../koneksi.php';

$budget = $_SESSION['budget_pelanggan'] ?? 0;
$keranjang = $_SESSION['keranjang'] ?? [];


$query = mysqli_query($koneksi, "
    SELECT 
        pk.id_paket_katering,
        pk.nama_paket,
        pk.harga,
        mk.id_menu_katering,
        mk.nama_menu,
        COUNT(hpm.id_menu_katering) AS jumlah_menu,
        (pk.harga / $budget) AS nilai_budget,
        GROUP_CONCAT(mk.nama_menu SEPARATOR '<br>') AS menu_katering
    FROM paket_katering pk
    JOIN hasil_paket_menu hpm 
        ON pk.id_paket_katering = hpm.id_paket_katering
    JOIN menu_katering mk 
        ON hpm.id_menu_katering = mk.id_menu_katering
    WHERE pk.harga <= '$budget'
    GROUP BY pk.id_paket_katering
");


$bobot = [
    'budget' => 0.4,    // BENEFIT (kesesuaian budget)
    'benefit' => 0.6   // BENEFIT (jumlah menu)
];

$hasil_wp = [];

while ($row = mysqli_fetch_assoc($query)) {

    $S =
        pow($row['nilai_budget'], -$bobot['budget']) *
        pow($row['jumlah_menu'], $bobot['benefit']);


    $hasil_wp[] = [
        'id_paket' => $row['id_paket_katering'],
        'nama_paket' => $row['nama_paket'],
        'harga' => $row['harga'],
        'menu' => $row['jumlah_menu'],
        'nilai_wp' => $S,
        'menu_item' => $row['menu_katering'],
        'budget' => $budget
    ];
}


usort($hasil_wp, function ($a, $b) {
    return $b['nilai_wp'] <=> $a['nilai_wp'];
});
?>

<section>
    <div class="container">
        <h3>Rekomendasi Paket Katering</h3>

        <?php if (!empty($hasil_wp)): ?>
            <?php $rekomendasi = $hasil_wp[0]; ?>
            <div class="cards">
                <div class="card">
                    <div class="alert">
                        <strong>Rekomendasi Terbaik untuk Budget Pelanggan :Rp <?= number_format($rekomendasi['budget']); ?>
                            :</strong><br>
                        Jumlah Porsi yang didapatkan :
                        <?= ceil($rekomendasi['budget'] / $rekomendasi['harga']); ?><br>
                        Nama Paket: <strong><?= $rekomendasi['nama_paket']; ?></strong><br>
                        Menu : <br>
                        <?= $rekomendasi['menu_item']; ?><br>
                        Harga Paket: Rp <?= number_format($rekomendasi['harga']); ?>

                    </div>
                    <div class="container">
                        <a href="index.php?page=pesan_paket_katering_fix&id_paket_katering=<?= $rekomendasi['id_paket'] ?>&budget=<?= $rekomendasi['budget'] ?>&jumlah_porsi=<?= ceil($rekomendasi['budget'] / $rekomendasi['harga']) ?>"
                            class="btn btn-primary">Pesan</a>
                        <a href="index.php?page=tambah_keranjang&id_paket=<?= $rekomendasi['id_paket']; ?>"
                            class="btn btn-success">
                            Keranjang
                        </a>
                    </div>
                </div>
            </div>

            <hr>

            <h5>Alternatif Paket Lain</h5>
            <div class="container mt-4 table-responsive" style="max-height: 400px; overflow-y: auto;">
                <table class="table table-striped table-hover text-center" style="max-height:100px;">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Paket</th>
                            <th scope="col">Harga Paket</th>
                            <th scope="col">Menu</th>
                            <th scope="col">Nilai WP</th>
                            <th scope="col">Porsi</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($hasil_wp as $no => $paket): ?>
                            <tr>
                                <th scope="row"><?= $no + 1; ?></th>
                                <td><?= $paket['nama_paket']; ?></td>
                                <td>Rp <?= number_format($paket['harga']); ?></td>
                                <td><?= $paket['menu_item']; ?></td>
                                <td><?= round($paket['nilai_wp'], 2); ?></td>
                                <td>
                                    <?= $jumlahPorsi = ceil($paket['budget'] / $paket['harga']); ?>
                                </td>
                                <td>
                                    <a href="index.php?page=pesan_paket_katering_fix&id_paket_katering=<?= $paket['id_paket'] ?>&budget=<?= $paket['budget'] ?>&jumlah_porsi=<?= $jumlahPorsi ?>"
                                        class="btn btn-primary">Pesan</a>
                                    <a href="index.php?page=tambah_keranjang&id_paket=<?= $paket['id_paket']; ?>"
                                        class="btn btn-success">
                                        Keranjang
                                    </a>
                                </td>


                                </td>
                                <!-- <td>
                                    <a href="index.php?page=tambah_keranjang&id_paket=<?= $paket['id_paket']; ?>"
                                        class="btn btn-success">
                                        + Keranjang
                                    </a>
                                </td> -->
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        <?php else: ?>
            <a href="index.php?page=input_budget_pelanggan" class="btn btn-secondary mb-2">
                < Kembali </a>
                    <div class="alert alert-warning">
                        Tidak ada paket yang sesuai dengan budget dan porsi.
                    </div>
                <?php endif; ?>

    </div>
</section>





<?php
require_once __DIR__ . '/../../pages/layouts/footer.php';
?>