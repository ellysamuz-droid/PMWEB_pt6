<?php
    session_start();
    require 'koneksi.php';
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $role = $_POST['role'];

    $query = "UPDATE pengguna SET username='$username', email='$email', tanggal_lahir='$tanggal_lahir', role='$role' WHERE id='$id'";
    if (mysqli_query($koneksi, $query)) {
        header("Location: dashboardadmin.php");
    }
?>