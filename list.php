<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html>
<head>
  <title>List Mahasiswa</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body class="bg-light py-5">

<div class="container">

  <div class="d-flex justify-content-between mb-4">
    <h2 class="fw-bold">Data Mahasiswa</h2>
    <a href="create.php" class="btn btn-primary">Tambah Data Baru</a>
  </div>

  <div class="card shadow border-0">
    <div class="card-body p-4">

      <table class="table table-hover align-middle">
        <thead class="table-dark">
          <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Tanggal Lahir</th>
            <th>Alamat</th>
            <th width="170">Aksi</th>
          </tr>
        </thead>

        <?php
        $data = mysqli_query($koneksi, "SELECT * FROM mahasiswa ORDER BY nama_mhs ASC");
        while ($d = mysqli_fetch_array($data)) {
        ?>

        <tr>
          <td><?= $d['nim'] ?></td>
          <td><?= $d['nama_mhs'] ?></td>
          <td><?= $d['tgl_lahir'] ?></td>
          <td><?= $d['alamat'] ?></td>
          <td>
            <a href="edit.php?nim=<?= $d['nim'] ?>" class="btn btn-warning btn-sm">Edit</a>
            <a href="proses.php?aksi=hapus&nim=<?= $d['nim'] ?>"
               class="btn btn-danger btn-sm"
               onclick="return confirm('Hapus data?')">
               Delete
            </a>
          </td>
        </tr>

        <?php } ?>
      </table>

    </div>
  </div>

  <a href="index.php" class="btn btn-secondary mt-3">Kembali</a>

</div>

</body>
</html>
