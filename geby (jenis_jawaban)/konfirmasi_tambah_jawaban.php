<?php 
    include('../koneksi/koneksi.php');
    $jenis_jawaban = $_POST['jenis_jawaban'];
    if(empty($jenis_jawaban)){
        header("Location:jawaban.php?notif=tambahkosong");
    }else{
        $sql = "insert into `jenis_jawaban` (`jenis_jawaban`) 
        values ('$jenis_jawaban')";
        mysqli_query($koneksi,$sql);
        header("Location:jawaban.php?notif=tambahberhasil");	
}
?>