<?php
include 'koneksi.php';

$username      = $_POST['username'];
$email         = $_POST['email'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$password      = $_POST['password'];
$role          = $_POST['role'];
$password_hash = password_hash($password, PASSWORD_DEFAULT);

if (empty($username) || empty($email) || empty($tanggal_lahir) || empty($password) || empty($role)) {
    echo "Semua field wajib diisi!";
    exit;
}

$query = "INSERT INTO pengguna (username, email, tanggal_lahir, password, role) 
          VALUES ('$username', '$email', '$tanggal_lahir', '$password_hash', '$role')";
$result = mysqli_query($koneksi, $query);

if ($result) {
    header("Location: dashboardAdmin.php");
} else {
    echo "Tambah Data Gagal: " . mysqli_error($koneksi);
}
?>