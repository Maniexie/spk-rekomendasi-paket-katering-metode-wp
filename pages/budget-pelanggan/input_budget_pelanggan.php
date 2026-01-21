<?php
require_once __DIR__ . '/../../pages/layouts/header.php';
require_once __DIR__ . '/../../koneksi.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['budget_pelanggan'] = $_POST['budget_pelanggan'];

    // format rupiah
    $budget = $_POST['budget_pelanggan'];
    $budget = str_replace(['Rp', '.', ' '], '', $budget);
    $_SESSION['budget_pelanggan'] = (int) $budget;


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

<script>
    const budgetInput = document.getElementById('budget_pelanggan');

    budgetInput.addEventListener('keyup', function (e) {
        this.value = formatRupiah(this.value, 'Rp ');
    });

    function formatRupiah(angka, prefix) {
        let number_string = angka.replace(/[^,\d]/g, '').toString();
        let split = number_string.split(',');
        let sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix === undefined ? rupiah : (rupiah ? prefix + rupiah : '');
    }
</script>


<?php
require_once __DIR__ . '/../../pages/layouts/footer.php';
?>