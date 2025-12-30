<?php
require_once __DIR__ . '/../../pages/layouts/header.php';
require_once __DIR__ . '/../../koneksi.php';

// jumlah data per halaman
$limit = 10;

// halaman saat ini dari URL, default 1
$page_no = isset($_GET['page_no']) ? (int) $_GET['page_no'] : 1;
if ($page_no < 1)
    $page_no = 1;

// hitung offset
$offset = ($page_no - 1) * $limit;


$getDataHasilPaketMenu = mysqli_query(
    $koneksi,
    'SELECT paket_katering.id_paket_katering,
    paket_katering.nama_paket,
    menu_katering.id_menu_katering,
    paket_katering.tersedia,
    paket_katering.harga,
    GROUP_CONCAT(menu_katering.nama_menu SEPARATOR "<br>") AS nama_menu
    FROM hasil_paket_menu
    JOIN paket_katering ON hasil_paket_menu.id_paket_katering = paket_katering.id_paket_katering
    JOIN menu_katering ON hasil_paket_menu.id_menu_katering = menu_katering.id_menu_katering
    GROUP BY paket_katering.id_paket_katering
    LIMIT ' . $limit . ' OFFSET ' . $offset . ''
);

// hitung total data untuk pagination
$totalDataResult = mysqli_query(
    $koneksi,
    "SELECT COUNT(DISTINCT id_paket_katering) as total FROM hasil_paket_menu"
);
$dataTotal = mysqli_fetch_assoc($totalDataResult);
$totalData = $dataTotal['total'];

$totalPages = ceil($totalData / $limit);


$no = $offset + 1;

?>



<!-- Content -->
<section>
    <div class="content">
        <h2 class="content-title text-center">Daftar Paket Katering</h2>
        <div class="container" style="margin-bottom: -20px;">
            <a href="index.php?page=tambah_hasil_paket_menu" class="btn btn-primary">+ Tambah Paket Katering</a>
        </div>
        <div class="container mt-4 table-responsive" style="max-height: 700px; overflow-y: auto;">
            <table class="table table-striped table-hover" style="max-height:300px;">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Paket Katering</th>
                        <th scope="col">Menu Katering</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Status</th>
                        <!-- <th scope="col">Aksi</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($getDataHasilPaketMenu as $row): ?>
                        <tr>
                            <th scope="row"><?= $no++ ?></th>
                            <td><?= $row['nama_paket'] ?></td>
                            <td><?= $row['nama_menu'] ?></td>
                            <td>Rp<?= number_format($row['harga']) ?></td>
                            <?php
                            if ($row['tersedia'] = 'Ya') {
                                $row['tersedia'] = '<span class="badge bg-white">✅</span>';
                            } else {
                                $row['tersedia'] = '<span class="badge bg-white">❌</span>';
                            }
                            ?>
                            <td><?= $row['tersedia'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center mt-4">
                    <!-- Previous -->
                    <li class="page-item <?= ($page_no <= 1) ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=item_penilaian&page_no=<?= $page_no - 1 ?>">Previous</a>
                    </li>

                    <!-- Nomor halaman -->
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= ($i == $page_no) ? 'active' : '' ?>">
                            <a class="page-link" href="?page=item_penilaian&page_no=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>

                    <!-- Next -->
                    <li class="page-item <?= ($page_no >= $totalPages) ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=item_penilaian&page_no=<?= $page_no + 1 ?>">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</section>

<!-- CONFIRM DELETE ALERT -->
<script>
    function konfirmasiDelete(deleteUrl) {
        Swal.fire({
            title: 'Hapus Data Item Penilaian',
            html: `Anda yakin ingin menghapus data item penilaian?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = deleteUrl;
            }
        }
        );
    }
</script>
<?php if (isset($_SESSION['success'])): ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            html: '<?= $_SESSION['success'] ?>',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
    <?php unset($_SESSION['success']); endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '<?= $_SESSION['error'] ?>',
            showConfirmButton: true
        });
    </script>
    <?php unset($_SESSION['error']); endif; ?>
<?php
require_once __DIR__ . '/../../pages/layouts/footer.php';
?>