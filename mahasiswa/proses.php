<?php
    require_once '../koneksi.php';

    //INSERT
    if(isset($_POST['submit'])){
        $nim = $_POST['nim'];
        $nama = $_POST['nama_mhs'];
        $program_studi_id = $_POST['program_studi_id'];
        $tgl = $_POST['tgl_lahir'];
        $alamat = $_POST['alamat'];

        $sql = "INSERT INTO mahasiswa(nim, nama_mhs, program_studi_id, tgl_lahir, alamat)
                    VALUES ('$nim', '$nama', '$program_studi_id', '$tgl', '$alamat')";
        $query = $koneksi->query($sql);

        if($query){
            header('Location: /akademik/index.php?p=list');
            exit;
        }else{
            echo "Gagal Menyimpan Data: " . $koneksi->error;
        }
    }

    //UPDATE
    if(isset($_POST['update'])){
        $nim = $_POST['nim'];
        $nama = $_POST['nama_mhs'];
        $program_studi_id = $_POST['program_studi_id'];
        $tgl = $_POST['tgl_lahir'];
        $alamat = $_POST['alamat'];
        $id = $_POST['id'];

        $sql = "UPDATE mahasiswa SET 
                nim='$nim', 
                nama_mhs='$nama', 
                program_studi_id='$program_studi_id',
                tgl_lahir='$tgl', 
                alamat='$alamat' 
                WHERE id='$id'";
        $query = $koneksi->query($sql);

        if ($query){
           header("Location: /akademik/index.php?p=list");
           exit;
        }else{
            echo "Gagal Mengubah Data: " . $koneksi->error;
        }
    }

    //DELETE
    if(isset($_GET['aksi']) && $_GET['aksi'] == 'hapus'){
        $id = $_GET['id'];
        $query = $koneksi->query("DELETE FROM mahasiswa WHERE id='$id'");

        if($query){
            header("Location: /akademik/index.php?p=list");
            exit;
        }else{
            echo "Gagal Menghapus Data: " . $koneksi->error;
        }
    }

?>