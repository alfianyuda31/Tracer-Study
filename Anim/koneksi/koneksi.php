<?php
	$koneksi = mysqli_connect("localhost","root","","tracer_study");
	// cek koneksi
	if (!$koneksi){
		die("Error koneksi: " . mysqli_connect_errno());
	}
?>
