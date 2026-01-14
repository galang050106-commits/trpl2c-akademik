<div class="row mb-4">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php?p=home" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="index.php?p=list" class="text-decoration-none">Mahasiswa</a></li>
                <li class="breadcrumb-item active">Tambah Data</li>
            </ol>
        </nav>
        <h3 class="fw-bold">Tambah Data Mahasiswa</h3>
        <p class="text-muted mb-0">Isi form di bawah untuk menambahkan data mahasiswa baru</p>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="mb-0 fw-semibold">Form Input Mahasiswa</h5>
            </div>
            <div class="card-body p-4">
                <form action="mahasiswa/proses.php" method="post">
                    <div class="mb-3">
                        <label for="nim" class="form-label fw-semibold">
                            NIM <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control form-control-lg" id="nim" name="nim" placeholder="Contoh: 2201010001" required>
                        <div class="form-text">Nomor Induk Mahasiswa harus unik</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="nama_mhs" class="form-label fw-semibold">
                            Nama Lengkap <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control form-control-lg" id="nama_mhs" name="nama_mhs" placeholder="Masukkan nama lengkap" required>
                    </div>

                    <div class="mb-3">
                        <label for="program_studi_id" class="form-label fw-semibold">
                            Program Studi <span class="text-danger">*</span>
                        </label>
                        <select class="form-select form-select-lg" id="program_studi_id" name="program_studi_id" required>
                            <option value="">-- Pilih Program Studi --</option>
                            <?php
                                require_once 'koneksi.php';
                                $prodi = $koneksi->query("SELECT * FROM program_studi ORDER BY nama_prodi ASC");
                                while($p = $prodi->fetch_assoc()){
                                    echo "<option value='{$p['id']}'>{$p['jenjang']} - {$p['nama_prodi']}</option>";
                                }
                            ?>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="tgl_lahir" class="form-label fw-semibold">
                            Tanggal Lahir <span class="text-danger">*</span>
                        </label>
                        <input type="date" class="form-control form-control-lg" id="tgl_lahir" name="tgl_lahir" required>
                    </div>
                    
                    <div class="mb-4">
                        <label for="alamat" class="form-label fw-semibold">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="4" placeholder="Masukkan alamat lengkap"></textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" name="submit" class="btn btn-primary btn-lg px-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-save me-1" viewBox="0 0 16 16">
                                <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1z"/>
                            </svg>
                            Simpan Data
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
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-info-circle me-2" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                    </svg>
                    Petunjuk Pengisian
                </h6>
                <ul class="small mb-0">
                    <li class="mb-2">NIM harus unik dan tidak boleh sama dengan mahasiswa lain</li>
                    <li class="mb-2">Nama lengkap sesuai dengan identitas resmi</li>
                    <li class="mb-2">Pilih program studi sesuai dengan jurusan mahasiswa</li>
                    <li class="mb-2">Tanggal lahir dalam format yang benar</li>
                    <li>Field dengan tanda <span class="text-danger">*</span> wajib diisi</li>
                </ul>
            </div>
        </div>
    </div>
</div>