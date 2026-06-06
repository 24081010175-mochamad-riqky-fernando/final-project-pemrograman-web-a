<?php
ob_start();
session_start();

// Pastikan hanya admin sah yang bisa mengeksekusi script ini
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php?pesan=belum_login");
    exit;
}

require_once '../config/koneksi.php';

if (isset($koneksi) && !isset($conn)) {
    $conn = $koneksi;
}

// ========== PROSES TAMBAH PRODUK ==========
if (isset($_POST['tambah'])) {
    
    // Ambil data form dengan proteksi escape string
    $nama_produk = mysqli_real_escape_string($conn, $_POST['nama_produk']);
    $harga       = intval($_POST['harga']);
    $stok        = intval($_POST['stok']);
    $status_po   = mysqli_real_escape_string($conn, $_POST['status_po']); // Menangkap select name="status"
    $id_kategori = intval($_POST['id_kategori']);

    // Logika Pengelolaan File Foto
    $nama_file = $_FILES['foto_produk']['name'];
    $tmp_file  = $_FILES['foto_produk']['tmp_name'];
    $foto_final = "default-pastry.jpg"; // Gambar default jika tidak upload foto

    if (!empty($nama_file)) {
        $ekstensi = pathinfo($nama_file, PATHINFO_EXTENSION);
        $foto_final = $nama_produk;
        $target_dir = "../assets/product/" . $foto_final;
        
        // Pindahkan file dari folder temporary local ke folder assets proyek
        move_uploaded_file($tmp_file, $target_dir);
    }

    // Perintah SQL insert data baru ke database
    $query_tambah = "INSERT INTO tabel_produk (nama_produk, harga, stok, status_po, foto_produk, id_kategori) 
                     VALUES ('$nama_produk', '$harga', '$stok', '$status_po', '$foto_final', '$id_kategori')";

    if (mysqli_query($conn, $query_tambah)) {
        // Jika sukses, kembalikan ke manajemen dengan parameter sukses
        header("Location: katalogmanajemen.php?status=sukses_tambah");
        exit;
    } else {
        // Jika query gagal, cetak error MySQL-nya biar ketahuan salahnya
        die("Gagal menyimpan ke database: " . mysqli_error($conn));
    }
} else {
    // Jika file ini diakses langsung tanpa submit form, tendang balik ke manajemen
    header("Location: katalogmanajemen.php");
    exit;
}

ob_end_flush();
?>