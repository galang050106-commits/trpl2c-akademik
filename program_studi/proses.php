<?php
    require'../koneksi.php';

    //INSERT
    if(isset($_POST['submit'])){
        $nama = $_POST['nama'];
        $jenjang = $_POST['jenjang'];
        $akreditasi = $_POST['akreditasi'];
        $keterangan = $_POST['keterangan'];

        $sql = "INSERT INTO program_studi(nama_prodi, jenjang, akreditasi, keterangan)
                    VALUES ('$nama','$jenjang','$akreditasi','$keterangan')";
        $query = $koneksi->query($sql);

        if ($query) {
            header("Location: ../index.php?p=data_prodi");
            exit;
        } else {
            echo "Gagal menyimpan data";
        }
    }

    //UPDATE
    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $jenjang = $_POST['jenjang'];
        $akreditasi = $_POST['akreditasi'];
        $keterangan = $_POST['keterangan'];

        $sql = "UPDATE program_studi SET nama_prodi='$nama', jenjang='$jenjang', akreditasi='$akreditasi', 
        keterangan='$keterangan' WHERE
        id='$id'";
        $query = $koneksi->query($sql);

        if ($query) {
            header("Location: ../index.php?p=data_prodi");
            exit;
        } else {
            echo "Gagal mengubah data";
        }
    }

    //DELETE
    if(isset($_GET['aksi']) && $_GET['aksi'] == 'hapus'){
        $id = $_GET['id'];
        $query = $koneksi->query("DELETE FROM program_studi WHERE id='$id'");

        if($query){
            header("Location: ../index.php?p=data_prodi");
            exit;
        }else{
            echo "Gagal Menghapus Data";
        }
    }
?>