<?php
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

    // ⚠️ kalau password masih plain text
    if (password_verify($password, $data['password'])) {
        
        // simpan session
        $_SESSION['id'] = $data['id'];
        $_SESSION['email'] = $data['email'];
        $_SESSION['role'] = $data['role'];

        if ($data['role'] == 'admin') {
            header("Location: dashboardadmin.php");
        } else {
            header("Location: dashboard.php");
        }
        exit;

    } else {
        echo "Password salah! <a href='loginForm.php'>Kembali</a>";
    }

} else {
    echo "Email tidak ditemukan! <a href='loginForm.php'>Kembali</a>";
}
?>