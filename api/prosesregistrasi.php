<?php
include 'koneksi.php';

$username      = $_POST['username']      ?? '';
$email         = $_POST['email']         ?? '';
$tanggal_lahir = $_POST['tanggal_lahir'] ?? '';
$password      = $_POST['password']      ?? '';

if (empty($username) || empty($email) || empty($tanggal_lahir) || empty($password)) {
    echo "Username, Email dan Password wajib diisi!";
    exit;
}

$password_hash = password_hash($password, PASSWORD_DEFAULT);

try {
    $db = Database::getInstance();

    $db->execute(
        "INSERT INTO pengguna (username, email, tanggal_lahir, password) VALUES (?, ?, ?, ?)",
        'ssss',
        [$username, $email, $tanggal_lahir, $password_hash]
    );

    header("Location: loginForm.php");
    exit;

} catch (RuntimeException $e) {
    echo "Register Gagal: " . $e->getMessage();
}
?>