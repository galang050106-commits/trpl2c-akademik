<?php
include "koneksi.php";

$aksi = $_GET['aksi'] ?? '';

switch ($aksi) {

    case "tambah":
        $nim    = $_POST['nim'];
        $nama   = $_POST['nama_mhs'];
        $tgl    = $_POST['tgl_lahir'];
        $alamat = $_POST['alamat'];

    // Cek apakah NIM sudah ada
    $cek = mysqli_query($koneksi, "SELECT nim FROM mahasiswa WHERE nim='$nim'");
        if (mysqli_num_rows($cek) > 0) {
            echo "<script>
            alert('NIM sudah ada! Gunakan NIM lain.');
            window.location='create.php';
            </script>";
        exit;
    }

        mysqli_query($koneksi, "INSERT INTO mahasiswa (nim, nama_mhs, tgl_lahir, alamat)
            VALUES ('$nim', '$nama', '$tgl', '$alamat')");
        header("Location: list.php");
        break;


    case "edit":
        $nim    = $_POST['nim'];
        $nama   = $_POST['nama_mhs'];
        $tgl    = $_POST['tgl_lahir'];
        $alamat = $_POST['alamat'];

        mysqli_query($koneksi, "UPDATE mahasiswa SET 
            nama_mhs='$nama',
            tgl_lahir='$tgl',
            alamat='$alamat'
            WHERE nim='$nim'");
        header("Location: list.php");
        break;


    case "hapus":
        $nim = $_GET['nim'];
        mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE nim='$nim'");
        header("Location: list.php");
        break;


    default:
        header("Location: index.php");
}
?>
