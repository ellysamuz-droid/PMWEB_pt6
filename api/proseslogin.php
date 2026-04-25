<?php
ob_start();
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
        // Simpan ke cookie
        $token = base64_encode($data['id'] . '|' . $data['role'] . '|' . $data['email']);
        setcookie('auth_token', $token, time() + 3600, '/', '', false, true); // false agar jalan di http juga

        if ($data['role'] == 'admin') {
            header("Location: /api/dashboardadmin.php");
        } else {
            header("Location: /api/dashboard.php");
        }
        exit;
    } else {
        echo "Password salah! <a href='/api/loginForm.php'>Kembali</a>";
    }
} else {
    echo "Email tidak ditemukan! <a href='/api/loginForm.php'>Kembali</a>";
}
?>