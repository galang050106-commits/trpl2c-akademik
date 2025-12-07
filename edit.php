<?php
include "koneksi.php";
$nim = $_GET['nim'];
$data = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nim='$nim'");
$d = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Mahasiswa</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body class="bg-light py-5">

<div class="container">
  <div class="col-md-6 mx-auto">
    <div class="card shadow border-0 p-4">

      <h3 class="text-center mb-4">Edit Mahasiswa</h3>

      <form action="proses.php?aksi=edit" method="post">

        <input type="hidden" name="nim" value="<?= $d['nim'] ?>">

        <div class="mb-3">
          <label class="form-label">Nama Mahasiswa</label>
          <input type="text" name="nama_mhs" class="form-control"
                 value="<?= $d['nama_mhs'] ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Tanggal Lahir</label>
          <input type="date" name="tgl_lahir" class="form-control"
                 value="<?= $d['tgl_lahir'] ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Alamat</label>
          <textarea name="alamat" class="form-control" required><?= $d['alamat'] ?></textarea>
        </div>

        <button class="btn btn-warning w-100">Update</button>
        <a href="list.php" class="btn btn-secondary w-100 mt-2">Kembali</a>

      </form>

    </div>
  </div>
</div>

</body>
</html>
