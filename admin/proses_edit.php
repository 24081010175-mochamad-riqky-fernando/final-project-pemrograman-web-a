<?php
session_start();

// akses sudah login admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php?pesan=belum_login");
    exit;
}

// Panggil koneksi database
require_once '../config/koneksi.php';

if (isset($_POST['edit_produk'])) {
    // Tangkap data dari form edit
    $id_produk    = mysqli_real_escape_string($conn, $_POST['id_produk']);
    $id_kategori  = mysqli_real_escape_string($conn, $_POST['id_kategori']);
    $nama_produk  = mysqli_real_escape_string($conn, $_POST['nama_produk']);
    $harga        = $_POST['harga'];
    $stok         = $_POST['stok'];
    $status_po    = $_POST['status_po'];

    // PROSES VALIDASI INPUT (DOKUMEN SRS) 
    if ($harga < 0) {
        header("Location: katalogmanajemen.php?id=$id_produk&error=harga_minus");
        exit;
    }

    if (!is_numeric($stok) || $stok < 0) {
        header("Location: katalogmanajemen.php?id=$id_produk&error=stok_invalid");
        exit;
    }

    // Ambil data foto lama dari database untuk cadangan
    $query_lama = mysqli_query($conn, "SELECT foto_produk FROM tabel_produk WHERE id_produk = '$id_produk'");
    $data_lama  = mysqli_fetch_assoc($query_lama);
    $foto_lama  = $data_lama['foto_produk'];

    // Tangkap data foto baru (jika ada yang diupload)
    $foto_name = $_FILES['foto_produk']['name'];
    $foto_size = $_FILES['foto_produk']['size'];
    $foto_tmp  = $_FILES['foto_produk']['tmp_name'];
    $error_foto= $_FILES['foto_produk']['error'];

    // Cek apakah admin mengupload foto baru
    if ($error_foto === 0) {
        $ekstensi_valid = ['jpg', 'jpeg', 'png'];
        $ekstensi_file  = explode('.', $foto_name);
        $ekstensi_file  = strtolower(end($ekstensi_file));

        // Validasi format dan ukuran
        if (!in_array($ekstensi_file, $ekstensi_valid)) {
            header("Location: katalogmanajemen.php?id=$id_produk&error=ekstensi_salah");
            exit;
        }

        if ($foto_size > 2097152) {
            header("Location: katalogmanajemen.php?id=$id_produk&error=ukuran_kebesaran");
            exit;
        }

        // Generate nama unik untuk foto baru
        $nama_foto_baru = uniqid() . '.' . $ekstensi_file;
        $folder_tujuan  = "../assets/product/" . $nama_foto_baru;

        // Pindahkan file baru ke folder assets
        if (move_uploaded_file($foto_tmp, $folder_tujuan)) {
            // HAPUS FOTO LAMA dari folder komputer agar tidak jadi sampah
            $lokasi_foto_lama = "../assets/product/" . $foto_lama;
            if (file_exists($lokasi_foto_lama) && $foto_lama != 'default-pastry.jpg' && !empty($foto_lama)) {
                unlink($lokasi_foto_lama);
            }
        }
    } else {
        // Jika tidak upload foto baru, tetap gunakan nama foto yang lama
        $nama_foto_baru = $foto_lama;
    }

    // UPDATE DATA KE DATABASE MYSQL
    $query_update = "UPDATE tabel_produk SET 
                        id_kategori = '$id_kategori', 
                        nama_produk = '$nama_produk', 
                        harga = '$harga', 
                        stok = '$stok', 
                        status_po = '$status_po', 
                        foto_produk = '$nama_foto_baru' 
                     WHERE id_produk = '$id_produk'";
    
    $eksekusi = mysqli_query($conn, $query_update);

    if ($eksekusi) {
        header("Location: katalogmanajemen.php?status=edit_sukses");
        exit;
    } else {
        header("Location: katalogmanajemen.php?id=$id_produk&error=update_gagal");
        exit;
    }

} else {
    header("Location: katalogmanajemen.php");
    exit;
}
?>