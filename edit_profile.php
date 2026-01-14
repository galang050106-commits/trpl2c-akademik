<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['login'] !== TRUE) {
    header("Location: login.php");
    exit;
}

require_once 'koneksi.php';

$success = '';
$error = '';

// Ambil data pengguna saat ini
$email = $_SESSION['email'];
$query_user = $koneksi->query("SELECT * FROM pengguna WHERE email='$email'");
$user_data = $query_user->fetch_assoc();

// Proses update profil
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update_profile'])) {
        $nama_lengkap = trim($_POST['nama_lengkap']);
        
        // Validasi nama
        if (empty($nama_lengkap)) {
            $error = "Nama lengkap tidak boleh kosong.";
        } elseif (strlen($nama_lengkap) < 3) {
            $error = "Nama lengkap minimal 3 karakter.";
        } else {
            // Update nama
            $update_query = "UPDATE pengguna SET nama_lengkap='$nama_lengkap' WHERE email='$email'";
            
            if ($koneksi->query($update_query)) {
                $_SESSION['nama'] = $nama_lengkap;
                $success = "Profil berhasil diperbarui!";
                // Refresh data
                $user_data['nama_lengkap'] = $nama_lengkap;
            } else {
                $error = "Gagal memperbarui profil: " . $koneksi->error;
            }
        }
    }
    
    // Proses update password
    if (isset($_POST['update_password'])) {
        $password_lama = $_POST['password_lama'];
        $password_baru = $_POST['password_baru'];
        $konfirmasi_password = $_POST['konfirmasi_password'];
        
        // Validasi password lama
        if ($password_lama !== $user_data['password']) {
            $error = "Password lama tidak sesuai.";
        } elseif (empty($password_baru)) {
            $error = "Password baru tidak boleh kosong.";
        } elseif (strlen($password_baru) < 6) {
            $error = "Password baru minimal 6 karakter.";
        } elseif ($password_baru !== $konfirmasi_password) {
            $error = "Konfirmasi password tidak sama dengan password baru.";
        } elseif ($password_baru === $password_lama) {
            $error = "Password baru tidak boleh sama dengan password lama.";
        } else {
            // Update password
            $update_query = "UPDATE pengguna SET password='$password_baru' WHERE email='$email'";
            
            if ($koneksi->query($update_query)) {
                $success = "Password berhasil diubah!";
                $user_data['password'] = $password_baru;
            } else {
                $error = "Gagal mengubah password: " . $koneksi->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profil - SIAKAD TI PNP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php?p=home">
                <img src="image/logo_ti.png" alt="Logo TI" height="45" class="me-2">
                <div class="d-none d-md-block">
                    <div class="fw-bold">SIAKAD TI</div>
                    <small style="font-size: 0.75rem;">Politeknik Negeri Padang</small>
                </div>
            </a>

            <div class="ms-auto">
                <a href="index.php" class="btn btn-light btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left me-1" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="mb-4">
                    <h3 class="fw-bold">Edit Profil</h3>
                    <p class="text-muted mb-0">Kelola informasi profil dan keamanan akun Anda</p>
                </div>

                <?php if($success): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-circle-fill me-2" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </svg>
                    <?php echo $success; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php endif; ?>

                <?php if($error): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-exclamation-triangle-fill me-2" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                    </svg>
                    <?php echo $error; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php endif; ?>

                <!-- Informasi Akun -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-primary text-white py-3">
                        <h5 class="mb-0 fw-semibold">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle me-2" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                            </svg>
                            Informasi Akun
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">Email</label>
                                <input type="email" class="form-control form-control-lg" id="email" value="<?= htmlspecialchars($user_data['email']) ?>" disabled>
                                <div class="form-text">Email tidak dapat diubah</div>
                            </div>

                            <div class="mb-4">
                                <label for="nama_lengkap" class="form-label fw-semibold">
                                    Nama Lengkap <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control form-control-lg" id="nama_lengkap" name="nama_lengkap" 
                                       value="<?= htmlspecialchars($user_data['nama_lengkap']) ?>" required>
                                <div class="form-text">Nama yang akan ditampilkan di sistem</div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" name="update_profile" class="btn btn-primary px-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-save me-1" viewBox="0 0 16 16">
                                        <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1z"/>
                                    </svg>
                                    Simpan Perubahan
                                </button>
                                <a href="index.php" class="btn btn-secondary px-4">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Ubah Password -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-warning py-3">
                        <h5 class="mb-0 fw-semibold">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-shield-lock me-2" viewBox="0 0 16 16">
                                <path d="M5.338 1.59a61 61 0 0 0-2.837.856.48.48 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.7 10.7 0 0 0 2.287 2.233c.346.244.652.42.893.533q.18.085.293.118a1 1 0 0 0 .101.025 1 1 0 0 0 .1-.025q.114-.034.294-.118c.24-.113.547-.29.893-.533a10.7 10.7 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.8 11.8 0 0 1-2.517 2.453 7 7 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7 7 0 0 1-1.048-.625 11.8 11.8 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 63 63 0 0 1 5.072.56"/>
                                <path d="M9.5 6.5a1.5 1.5 0 0 1-1 1.415l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99a1.5 1.5 0 1 1 2-1.415"/>
                            </svg>
                            Ubah Password
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="password_lama" class="form-label fw-semibold">
                                    Password Lama <span class="text-danger">*</span>
                                </label>
                                <input type="password" class="form-control form-control-lg" id="password_lama" name="password_lama" required>
                            </div>

                            <div class="mb-3">
                                <label for="password_baru" class="form-label fw-semibold">
                                    Password Baru <span class="text-danger">*</span>
                                </label>
                                <input type="password" class="form-control form-control-lg" id="password_baru" name="password_baru" required>
                                <div class="form-text">Minimal 6 karakter</div>
                            </div>

                            <div class="mb-4">
                                <label for="konfirmasi_password" class="form-label fw-semibold">
                                    Konfirmasi Password Baru <span class="text-danger">*</span>
                                </label>
                                <input type="password" class="form-control form-control-lg" id="konfirmasi_password" name="konfirmasi_password" required>
                            </div>

                            <div class="alert alert-warning border-0" role="alert">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-exclamation-triangle me-2" viewBox="0 0 16 16">
                                    <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.15.15 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.2.2 0 0 1-.054.06.1.1 0 0 1-.066.017H1.146a.1.1 0 0 1-.066-.017.2.2 0 0 1-.054-.06.18.18 0 0 1 .002-.183L7.884 2.073a.15.15 0 0 1 .054-.057m1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767z"/>
                                    <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
                                </svg>
                                <small>Pastikan password baru berbeda dengan password lama dan mudah diingat.</small>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" name="update_password" class="btn btn-warning px-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-key me-1" viewBox="0 0 16 16">
                                        <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8m4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5"/>
                                        <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                                    </svg>
                                    Ubah Password
                                </button>
                                <button type="reset" class="btn btn-secondary px-4">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-white border-top mt-5 py-3">
        <div class="container">
            <div class="text-center">
                <small class="text-muted">Politeknik Negeri Padang &copy; 2025</small>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>