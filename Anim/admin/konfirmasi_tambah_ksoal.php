<?php 
    include('../koneksi/koneksi.php');
    $id_kategori = $_POST['id_kategori'];
    $kategori = $_POST['kategori'];
    if(empty($id_kategori)){
        header("Location:tambah_kategori_soal.php?notif=tambahkosong");
    }if(empty($kategori)){
        header("Location:tambah_kategori_soal.php?notif=tambahkosong");
    }else{
        $sql = "insert into `kategori_soal` values ('$id_kategori', '$kategori')";
        mysqli_query($koneksi,$sql);
        header("Location:kategori_soal.php?notif=tambahberhasil");	
    }
?>