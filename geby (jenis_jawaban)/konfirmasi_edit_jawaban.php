<?php 
    session_start();
    include('../koneksi/koneksi.php');
    if(isset($_SESSION['kode_jawaban'])){
    $kode_jawaban = $_SESSION['kode_jawaban'];
    $jenis_jawaban = $_POST['jenis_jawaban'];
        
    if(empty($jenis_jawaban)){
    header("Location:edit_jawaban.php?data=".$kode_jawaban."
    &notif=editkosong");
    }else{
    $sql = "update `jenis_jawaban` set `jenis_jawaban`='$jenis_jawaban' 
    where `id`='$kode_jawaban'";
    mysqli_query($koneksi,$sql);
    header("Location:jawaban.php?notif=editberhasil");
    }
    }
?>