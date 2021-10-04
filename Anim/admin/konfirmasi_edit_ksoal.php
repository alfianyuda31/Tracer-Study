<?php 
    session_start();
    include('../koneksi/koneksi.php');
    if(isset($_SESSION['id_kategori'])){
        $id_kat = $_SESSION['id_kategori'];
        $kategori = $_POST['kategori'];
            
        if(empty($kategori)){
            header("Location:edit_ksoal.php?data=".$id_kat."&notif=editkosong");
        }else{
            $sql = "update `kategori_soal` set `kategori` = '$kategori' where `id_kategori` = '$id_kat'";
            mysqli_query($koneksi,$sql);
            header("Location:kategori_soal.php?notif=editberhasil");
        }
    }
?>