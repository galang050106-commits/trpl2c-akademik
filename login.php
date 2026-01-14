<?php
session_start();
require 'koneksi.php'; 

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $pass  = $_POST['password'];

    $ceklogin = $koneksi->query(
        "SELECT * FROM pengguna 
         WHERE email='$email' AND password='$pass'"
    );

    if ($ceklogin && $ceklogin->num_rows == 1) {
        $data = $ceklogin->fetch_assoc();

        $_SESSION['login'] = TRUE;
        $_SESSION['email'] = $data['email'];
        $_SESSION['nama']  = $data['nama_lengkap'];

        header('Location: index.php');
        exit;
    } else {
        $error = "Login gagal. Email atau password salah.";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - SIAKAD TI PNP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container">
        <div class="row min-vh-100 align-items-center">
            <div class="col-lg-10 mx-auto">
                <div class="card shadow-lg border-0 overflow-hidden">
                    <div class="row g-0">
                        <!-- Left Side - Info Panel -->
                        <div class="col-lg-5 bg-primary text-white d-none d-lg-flex flex-column justify-content-center p-5">
                            <div class="mb-4">
                                <img src="image/logo_ti.png" alt="Logo TI PNP" class="img-fluid mb-4" style="max-width: 180px;">
                            </div>
                            <h3 class="fw-bold mb-3">Sistem Informasi Akademik</h3>
                            <p class="mb-4 opacity-75">Jurusan Teknologi Informasi</p>
                            <div class="mt-auto">
                                <div class="d-flex align-items-start mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-circle-fill me-2 flex-shrink-0" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                    </svg>
                                    <div>
                                        <h6 class="mb-1">Kelola Data Mahasiswa</h6>
                                        <small class="opacity-75">Manajemen data mahasiswa dengan mudah</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-start">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-circle-fill me-2 flex-shrink-0" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                    </svg>
                                    <div>
                                        <h6 class="mb-1">Kelola Program Studi</h6>
                                        <small class="opacity-75">Informasi program studi terintegrasi</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Side - Login Form -->
                        <div class="col-lg-7">
                            <div class="p-5">
                                <div class="text-center d-lg-none mb-4">
                                    <img src="image/logo_ti.png" alt="Logo TI PNP" class="img-fluid mb-4" style="max-width: 180px;">
                                </div>
                                
                                <div class="mb-5">
                                    <h4 class="fw-bold mb-2">Selamat Datang</h4>
                                    <p class="text-muted">Silakan login untuk melanjutkan</p>
                                </div>

                                <?php if($error): ?>
                                <div class="alert alert-danger d-flex align-items-center" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-exclamation-triangle-fill me-2" viewBox="0 0 16 16">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                                    </svg>
                                    <?php echo $error; ?>
                                </div>
                                <?php endif; ?>

                                <form action="" method="post">
                                    <div class="mb-3">
                                        <label for="email" class="form-label fw-semibold">Email</label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text bg-light border-end-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-envelope text-muted" viewBox="0 0 16 16">
                                                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
                                                </svg>
                                            </span>
                                            <input type="email" class="form-control form-control-lg border-start-0" id="email" name="email" placeholder="nama@student.pnp.ac.id" required>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="password" class="form-label fw-semibold">Password</label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text bg-light border-end-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-lock text-muted" viewBox="0 0 16 16">
                                                    <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2M5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1"/>
                                                </svg>
                                            </span>
                                            <input type="password" class="form-control form-control-lg border-start-0" id="password" name="password" placeholder="Masukkan password" required>
                                        </div>
                                    </div>
                                    
                                    <div class="d-grid mb-3">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            Login
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-right ms-2" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
                                            </svg>
                                        </button>
                                    </div>
                                </form>

                                <div class="text-center mt-5 pt-4 border-top">
                                    <small class="text-muted">Politeknik Negeri Padang &copy; 2025</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>