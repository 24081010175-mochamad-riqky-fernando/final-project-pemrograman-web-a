<?php
// cofig/koneksi.php

$host = "localhost";
$user = "root";
$pass = "";
$db = "db_umkm_pastry";

$conn = mysqli_connect($host, $user, $pass, $db);

// cek apakah koneksi berhasil 
if (!$conn){
    die("koneksi ke database gagal: " . mysqli_connect_error());

}
?>

<!-- udah bisa connect -->
