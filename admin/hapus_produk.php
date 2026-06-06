<?php
// admin/hapus_produk.php
session_start();

// hanya admin sah yang bisa menghapus
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php?pesan=belum_login");
    exit;
}

// Panggil file koneksi database
require_once '../config/koneksi.php';

// Tangkap id_produk yang dikirim lewat URL tombol hapus
if (isset($_GET['id'])) {
    $id_produk = $_GET['id'];

    // 1. Ambil nama file gambar dari database sebelum datanya dihapus
    $query_foto  = "SELECT foto_produk FROM tabel_produk WHERE id_produk = '$id_produk'";
    $result_foto = mysqli_query($conn, $query_foto);
    
    if (mysqli_num_rows($result_foto) === 1) {
        $row = mysqli_fetch_assoc($result_foto);
        $nama_foto = $row['foto_produk'];
        
        // Tentukan jalur lokasi fisik foto tersebut
        $path_foto = "../assets/product/" . $nama_foto;

        // 2. Cek apakah file fotonya beneran ada di folder harddisk, lalu hapus
        if (file_exists($path_foto)) {
            unlink($path_foto);
        }
    }

    // 3. hapus data barisnya di MySQL
    $query_delete = "DELETE FROM tabel_produk WHERE id_produk = '$id_produk'";
    $execute_delete = mysqli_query($conn, $query_delete);

    if ($execute_delete) {
        // Jika sukses, kembalikan ke tabel utama dengan status sukses
        header("Location: katalogmanajemen.php?status=hapus_sukses");
        exit;
    } else {
        echo "Gagal menghapus data dari database: " . mysqli_error($conn);
    }

} else {
    // Kalau tidak ada ID yang dikirim di URL, balikkan ke halaman utama
    header("Location: katalogmanajemen.php");
    exit;
}