<?php
ob_start();
require 'koneksi.php';

// Cek cookie auth
if (!isset($_COOKIE['auth_token'])) {
    header("Location: /api/loginForm.php");
    exit();
}

$tokenData = explode('|', base64_decode($_COOKIE['auth_token']));
$userRole = $tokenData[1] ?? null;

if ($userRole != 'admin') {
    header("Location: /api/loginForm.php");
    exit();
}

// Cek apakah id tersedia
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: /api/dashboardadmin.php");
    exit();
}

$id = mysqli_real_escape_string($koneksi, $_GET['id']);

$query = "DELETE FROM pengguna WHERE id='$id'";

if (mysqli_query($koneksi, $query)) {
    header("Location: /api/dashboardadmin.php");
    exit();
} else {
    echo "Gagal menghapus data: " . mysqli_error($koneksi);
}
?>