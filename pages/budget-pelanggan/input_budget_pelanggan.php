<?php
require_once __DIR__ . '/../../pages/layouts/header.php';
require_once __DIR__ . '/../../koneksi.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['budget_pelanggan'] = $_POST['budget_pelanggan'];
    // $_SESSION['porsi'] = $_POST['porsi'];


    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    Swal.fire({
        title: "Proses Mencari Budget Pelanggan",
        timer: 1500,
        didOpen: () => {
            Swal.showLoading();
        }
    }).then(() => {
        Swal.fire({
            icon: "success",
            title: "Berhasil Menemukan Budget Pelanggan",
            showConfirmButton: true,
            timer: 3000
        }).then(() => {
            window.location.href = "index.php?page=hasil_budget_pelanggan";
        });
    });
    </script>';
    exit;
}
?>


<section>
    <div class="container">
        <h3 class="text-center">Input Budget Pelanggan</h3>
        <form action="" method="post">
            <div class="col-md">
                <label for="budget_pelanggan" class="form-label">Budget Pelanggan</label>
                <input type="text" class="form-control" id="budget_pelanggan" name="budget_pelanggan" value="" required>
            </div>
            <!-- <div class="col-md">
                <label for="porsi" class="form-label">Porsi</label>
                <input type="text" class="form-control" id="porsi" name="porsi" value="" required>
            </div> -->
            <button class="btn btn-primary mt-2" type="submit">Submit</button>
        </form>
    </div>
</section>


<?php
require_once __DIR__ . '/../../pages/layouts/footer.php';
?>