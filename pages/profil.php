<?php
require_once __DIR__ . '/../pages/layouts/header.php';
require_once __DIR__ . '/../koneksi.php';

$id_user = $_SESSION['id_user'];

$getProfil = mysqli_query($koneksi, "SELECT * FROM users WHERE id_user = '$id_user'");
$data = mysqli_fetch_assoc($getProfil);


?>


<!-- Content -->
<section>
    <div class="container border p-4 mt-4">
        <h2 class="text-center">Profil (<span class=""><?= $_SESSION['role'] ?></span>)</h2>
        <!-- Form -->
        <form class="row g-2 needs-validation">
            <div class="col-md-6">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama'] ?>" disabled>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">email</label>
                <input type="text" class="form-control" id="email" name="email" value="<?= $data['email'] ?> " disabled>
            </div>
            <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control disabled" id="password" name="password"
                    value="hackdongsayang❤️❤️❤️" disabled>
            </div>
        </form>
    </div>
</section>


<?php
require_once __DIR__ . '/../pages/layouts/footer.php';
?>