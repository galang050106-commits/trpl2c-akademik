<div class="row mb-4">
    <div class="col-md-8">
        <h3 class="fw-bold">Data Program Studi</h3>
        <p class="text-muted mb-0">Daftar program studi yang tersedia</p>
    </div>
    <div class="col-md-4 text-md-end">
        <a href="index.php?p=create_prodi" class="btn btn-success">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle me-1" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
            </svg>
            Tambah Data
        </a>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col" class="ps-4">No</th>
                        <th scope="col">Nama Program Studi</th>
                        <th scope="col">Jenjang</th>
                        <th scope="col">Akreditasi</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col" class="text-center pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once 'koneksi.php';
                        $tampil = $koneksi->query("SELECT * FROM program_studi");
                        $no = 1;
                        while ($data = mysqli_fetch_assoc($tampil)){
                    ?>
                    <tr>
                        <th scope="row" class="ps-4"><?= $no++ ?></th>
                        <td><?= $data['nama_prodi'] ?></td>
                        <td>
                            <span class="badge bg-primary"><?= $data['jenjang'] ?></span>
                        </td>
                        <td>
                            <span class="badge bg-success"><?= $data['akreditasi'] ?></span>
                        </td>
                        <td><?= $data['keterangan'] ?></td>
                        <td class="text-center pe-4">
                            <a href="index.php?id=<?= $data['id'] ?>&p=edit_prodi" class="btn btn-sm btn-warning me-1">Edit</a>
                            <a href="program_studi/proses.php?id=<?= $data['id'] ?>&aksi=hapus"
                               onclick="return confirm('Yakin ingin menghapus data ini?')" 
                               class="btn btn-sm btn-danger">Hapus</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>