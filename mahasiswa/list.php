<div class="row mb-4">
    <div class="col-md-8">
        <h3 class="fw-bold">Data Mahasiswa</h3>
        <p class="text-muted mb-0">Daftar mahasiswa Jurusan Teknologi Informasi</p>
    </div>
    <div class="col-md-4 text-md-end">
        <a href="index.php?p=create" class="btn btn-primary">
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
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col" class="ps-4">No</th>
                        <th scope="col">NIM</th>
                        <th scope="col">Nama Mahasiswa</th>
                        <th scope="col">Program Studi</th>
                        <th scope="col">Tanggal Lahir</th>
                        <th scope="col">Alamat</th>
                        <th scope="col" class="text-center pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once $_SERVER['DOCUMENT_ROOT'] . '/akademik/koneksi.php';
                        $tampil = $koneksi->query("
                            SELECT m.*, p.nama_prodi, p.jenjang 
                            FROM mahasiswa m
                            LEFT JOIN program_studi p ON m.program_studi_id = p.id
                            ORDER BY m.id DESC
                        ");
                        $no = 1;
                        if($tampil->num_rows > 0){
                            while ($data = mysqli_fetch_assoc($tampil)){
                    ?>
                            <tr>
                                <th scope="row" class="ps-4"><?= $no++ ?></th>
                                <td><span class="badge bg-secondary"><?=  $data['nim'] ?></span></td>
                                <td class="fw-semibold"><?=  $data['nama_mhs'] ?></td>
                                <td>
                                    <?php if($data['nama_prodi']): ?>
                                        <div>
                                            <span class="badge bg-primary"><?= $data['jenjang'] ?></span>
                                            <?= $data['nama_prodi'] ?>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-muted small">Belum ditentukan</span>
                                    <?php endif; ?>
                                </td>
                                <td><?=  date('d/m/Y', strtotime($data['tgl_lahir'])) ?></td>
                                <td><?= $data['alamat'] ?></td>
                                <td class="text-center pe-4">
                                    <a href="index.php?id=<?= $data['id'] ?>&p=edit" class="btn btn-sm btn-warning me-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                        </svg>
                                    </a>
                                    <a href="mahasiswa/proses.php?id=<?= $data['id'] ?>&aksi=hapus" 
                                       onclick="return confirm('Yakin ingin menghapus data mahasiswa ini?')" 
                                       class="btn btn-sm btn-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                    <?php 
                            }
                        } else {
                    ?>
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-inbox mb-3" viewBox="0 0 16 16">
                                        <path d="M4.98 4a.5.5 0 0 0-.39.188L1.54 8H6a.5.5 0 0 1 .5.5 1.5 1.5 0 1 0 3 0A.5.5 0 0 1 10 8h4.46l-3.05-3.812A.5.5 0 0 0 11.02 4zm9.954 5H10.45a2.5 2.5 0 0 1-4.9 0H1.066l.32 2.562a.5.5 0 0 0 .497.438h12.234a.5.5 0 0 0 .496-.438zM3.809 3.563A1.5 1.5 0 0 1 4.981 3h6.038a1.5 1.5 0 0 1 1.172.563l3.7 4.625a.5.5 0 0 1 .105.374l-.39 3.124A1.5 1.5 0 0 1 14.117 13H1.883a1.5 1.5 0 0 1-1.489-1.314l-.39-3.124a.5.5 0 0 1 .106-.374z"/>
                                    </svg>
                                    <p class="mb-0">Belum ada data mahasiswa</p>
                                </td>
                            </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>