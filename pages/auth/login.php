<?php
require_once __DIR__ . '/../../koneksi.php';

// jika sudah login, tendang ke dashboard
if (isset($_SESSION['id_user'])) {
    header('Location: index.php?page=dashboard');
    exit;
}

// initialize variabel error sweet alert
$loginError = null;
$loginSukses = false;

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('Validasi CSRF Gagal!');
    }
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $koneksi->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {

            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['login_success'] = 'Login berhasil!';

            $loginSukses = true;
        } else {
            // jika password salah
            $loginError = "email atau password salah!";
        }
    }

    // jika gagal
    $loginError = "email atau password salah!";
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>

    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.23.0/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(120deg, #f8f9fa, #e9f7ef);
            display: flex;
            align-items: center;
        }

        /* card full height */
        .login-card {
            border-radius: 16px;
            overflow: hidden;
            min-height: 520px;
        }

        /* kolom gambar */
        .login-image {
            height: 100%;
            min-height: 520px;

            background: url('https://static7.depositphotos.com/1020288/794/i/450/depositphotos_7941348-stock-photo-table-with-food-and-drink.jpg') center center / cover no-repeat;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* form biar center vertikal */
        .form-wrapper {
            min-height: 520px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-control {
            border-radius: 10px;
        }

        .btn-login {
            border-radius: 10px;
            padding: 10px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-10">

                <div class="card shadow-lg login-card">
                    <div class="row g-0">

                        <!-- GAMBAR -->
                        <div class="col-md-6 d-none d-md-block">
                            <div class="login-image">
                            </div>
                        </div>

                        <!-- FORM LOGIN -->
                        <div class="col-md-6 p-4 p-md-5">
                            <h3 class="fw-bold mb-2 text-center">Selamat Datang 👋</h3>
                            <p class="text-muted text-center mb-4">
                                Login untuk memesan katering favoritmu
                            </p>

                            <form action="" method="post">
                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="contoh@email.com" required autofocus>
                                </div>

                                <div class="mb-2">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="••••••••" required>
                                </div>

                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" onclick="showHide()"
                                        id="showPassword">
                                    <label class="form-check-label" for="showPassword">
                                        Tampilkan Password
                                    </label>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" name="submit" class="btn btn-success btn-login">
                                        Login
                                    </button>
                                </div>

                                <p class="text-center mt-3 text-muted">
                                    Belum punya akun? <a href="#" class="text-success fw-semibold">Daftar</a>
                                </p>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- SCRIPT -->
    <script>
        function showHide() {
            let inputan = document.getElementById("password");
            inputan.type = inputan.type === "password" ? "text" : "password";
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <?php if ($loginError): ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: "Loading",
                timer: 1500,
                didOpen: () => {
                    Swal.showLoading();
                }
            }).then(() => {
                Swal.fire({
                    icon: "error",
                    title: "Login Gagal",
                    text: "<?= $loginError ?>",
                    showConfirmButton: true,
                    timer: 3000
                });
            });
        </script>
    <?php endif; ?>

    <?php if ($loginSukses): ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: "Loading",
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                },
                timer: 1500
            }).then(() => {
                Swal.fire({
                    icon: "success",
                    title: "Login Berhasil",
                    text: "Selamat datang, <?= $_SESSION['nama'] ?>",
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.href = "index.php?page=dashboard";
                });
            });
        </script>
    <?php endif; ?>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>

</html>