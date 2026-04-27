<?php
    session_start();
    require 'koneksi.php';
    $username = $_POST['username'];
    $email = $_POST['email'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $role = $_POST['role'];

    $query = "INSERT INTO pengguna (username, email, tanggal_lahir, password) VALUES ('$username', '$email', '$tanggal_lahir', '$password_hash')";
    if(mysqli_query($koneksi, $query)) {
        header("Location: dashboardadmin.php");
    }
?>