<?php
session_start();
// Panggil file koneksi database
require_once 'config/koneksi.php';

// Cek apakah tombol login ditekan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Ambil data inputan
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Query untuk mencari admin berdasarkan username
    $query  = "SELECT * FROM tabel_admin WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        // Verifikasi password dengan hash yang ada di database
        if (md5($password) === $row['password']) {
            
            // Jika sukses, buat session rahasia admin
            $_SESSION['id_admin'] = $row['id_admin'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role']     = 'admin';

            // Alihkan langsung masuk ke area admin
            header("Location: admin/katalogmanajemen.php");
            exit;
        }
    }

    // Jika username salah atau password tidak cocok, balik ke login page
    header("Location: index.php?pesan=gagal");
    exit;
} else {
    header("Location: index.php");
    exit;
}
?>