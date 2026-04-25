<?php
ob_start();
session_start();
include 'koneksi.php';

$email = mysqli_real_escape_string($koneksi, $_POST['email']);
$password = $_POST['password'];

if (empty($email) || empty($password)) {
    echo "Email dan Password wajib diisi!";
    exit;
}

$query = "SELECT * FROM pengguna WHERE email='$email'";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);

    if (password_verify($password, $data['password'])) {
        $_SESSION['id'] = $data['id'];
        $_SESSION['email'] = $data['email'];
        $_SESSION['role'] = $data['role'];

        // ← DEBUG: cek session tersimpan tidak
        echo "Session setelah login: <pre>";
        print_r($_SESSION);
        echo "</pre>";
        echo "Akan redirect ke: " . ($data['role'] == 'admin' ? 'dashboardadmin.php' : 'dashboard.php');
        exit; // stop dulu, jangan redirect
    } else {
        echo "Password salah! <a href='loginForm.php'>Kembali</a>";
    }
} else {
    echo "Email tidak ditemukan! <a href='loginForm.php'>Kembali</a>";
}
?>