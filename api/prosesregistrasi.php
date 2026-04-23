<?php
include 'koneksi.php';

$username = $_POST['username'];
$email = $_POST['email'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$password = $_POST['password'];
$password_hash = password_hash($password, PASSWORD_DEFAULT);

if (empty($username) || empty($email) || empty($tanggal_lahir) || empty($password)) {
    echo "Username, Email dan Password wajib diisi!";
    exit;
}

$query = "INSERT INTO pengguna (username, email, tanggal_lahir, password) VALUES ('$username', '$email', '$tanggal_lahir', '$password_hash')";
$result = mysqli_query($koneksi, $query);

if ($result){
        header ("Location: loginForm.php");
    } else {
        echo "Register Gagal: " . mysqli_error($koneksi);
    }
?>