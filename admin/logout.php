<?php
// admin/logout.php
session_start();

// Bersihkan semua isi variabel session
$_SESSION = array();

// Hapus cookie session di browser
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// menghancurkan session
session_destroy();

// redirect ke beranda
header("Location: ../index.php"); 
exit; 