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


$getDataKriteria = mysqli_query(
    $koneksi,
    'SELECT * FROM kriteria
    LIMIT ' . $limit . ' OFFSET ' . $offset . ''
);

// hitung total data untuk pagination
$totalDataResult = mysqli_query(
    $koneksi,
    "SELECT COUNT(*) as total FROM kriteria"
);
$dataTotal = mysqli_fetch_assoc($totalDataResult);
$totalData = $dataTotal['total'];

$totalPages = ceil($totalData / $limit);


$no = $offset + 1;

?>



<!-- Content -->
<section>
    <div class="content">
        <h2 class="content-title text-center">Kriteria</h2>
        <div class="container" style="margin-bottom: -20px;">
            <a href="index.php?page=tambah_kriteria" class="btn btn-primary">+ Tambah Kriteria</a>
        </div>
        <div class="container mt-4 table-responsive" style="max-height: 700px; overflow-y: auto;">
            <table class="table table-striped table-hover" style="max-height:300px;">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kode</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jenis</th>
                        <th scope="col">Bobot</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($getDataKriteria as $row): ?>
                        <tr>
                            <th scope="row"><?= $no++ ?></th>
                            <td><?= $row['kode_kriteria'] ?></td>
                            <td><?= $row['nama_kriteria'] ?></td>
                            <td><?= $row['jenis_kriteria'] ?></td>
                            <td><?= $row['bobot'] ?></td>
                            <td>
                                <a href="index.php?page=edit_kriteria&id_kriteria=<?= $row['id_kriteria'] ?>"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                                <a href="javascript:void(0)"
                                    onclick="konfirmasiDelete('index.php?page=hapus_kriteria&id_kriteria=<?= $row['id_kriteria'] ?>')">
                                    <i class="fa-solid fa-trash-can"></i></a>
                            </td>

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