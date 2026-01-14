<?php
    require_once __DIR__ . '/../koneksi.php';

    if (!isset($_GET['id'])){
        echo "<div class='alert alert-danger'>ID tidak ditemukan!</div>";
        exit;
    }

    $id = $_GET['id'];
    $sql = "SELECT * FROM mahasiswa WHERE id = $id";
    $result = $koneksi->query($sql);

    if($result->num_rows == 0){
        echo "<div class='alert alert-danger'>Data tidak ditemukan!</div>";
        exit;
    }

    $data = $result->fetch_assoc();
?>

<div class="row mb-4">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php?p=home" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="index.php?p=list" class="text-decoration-none">Mahasiswa</a></li>
                <li class="breadcrumb-item active">Edit Data</li>
            </ol>
        </nav>
        <h3 class="fw-bold">Edit Data Mahasiswa</h3>
        <p class="text-muted mb-0">Perbarui informasi data mahasiswa</p>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-warning py-3">
                <h5 class="mb-0 fw-semibold">Form Edit Mahasiswa</h5>
            </div>
            <div class="card-body p-4">
                <form action="mahasiswa/proses.php" method="post">
                    <input type="hidden" name="id" value="<?= $data['id'] ?>">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            NIM <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control form-control-lg" name="nim" value="<?= $data['nim'] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Nama Lengkap <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control form-control-lg" name="nama_mhs" value="<?= $data['nama_mhs'] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="program_studi_id" class="form-label fw-semibold">
                            Program Studi <span class="text-danger">*</span>
                        </label>
                        <select class="form-select form-select-lg" id="program_studi_id" name="program_studi_id" required>
                            <option value="">-- Pilih Program Studi --</option>
                            <?php
                                $prodi = $koneksi->query("SELECT * FROM program_studi ORDER BY nama_prodi ASC");
                                while($p = $prodi->fetch_assoc()){
                                    $selected = ($p['id'] == $data['program_studi_id']) ? 'selected' : '';
                                    echo "<option value='{$p['id']}' $selected>{$p['jenjang']} - {$p['nama_prodi']}</option>";
                                }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Tanggal Lahir <span class="text-danger">*</span>
                        </label>
                        <input type="date" class="form-control form-control-lg" name="tgl_lahir" value="<?= $data['tgl_lahir'] ?>" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Alamat</label>
                        <textarea class="form-control" name="alamat" rows="4"><?= $data['alamat'] ?></textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" name="update" class="btn btn-warning btn-lg px-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-repeat me-1" viewBox="0 0 16 16">
                                <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41m-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9"/>
                                <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5 5 0 0 0 8 3M3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9z"/>
                            </svg>
                            Update Data
                        </button>
                        <a href="index.php?p=list" class="btn btn-secondary btn-lg px-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-x-lg me-1" viewBox="0 0 16 16">
                                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                            </svg>
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 bg-light">
            <div class="card-body p-4">
                <h6 class="fw-semibold mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-exclamation-triangle me-2" viewBox="0 0 16 16">
                        <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.15.15 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.2.2 0 0 1-.054.06.1.1 0 0 1-.066.017H1.146a.1.1 0 0 1-.066-.017.2.2 0 0 1-.054-.06.18.18 0 0 1 .002-.183L7.884 2.073a.15.15 0 0 1 .054-.057m1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767z"/>
                        <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
                    </svg>
                    Perhatian
                </h6>
                <ul class="small mb-0">
                    <li class="mb-2">Pastikan data yang diubah sudah benar</li>
                    <li class="mb-2">NIM tidak boleh sama dengan mahasiswa lain</li>
                    <li>Perubahan data akan langsung tersimpan</li>
                </ul>
            </div>
        </div>
    </div>
</div>