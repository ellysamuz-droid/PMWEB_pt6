<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
ob_start();

require __DIR__ . '/koneksi.php';

$email    = $_POST['email']    ?? '';
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    echo "Email dan Password wajib diisi!";
    exit;
}

try {
    $db   = Database::getInstance();
    $rows = $db->query(
        "SELECT * FROM pengguna WHERE email = ? LIMIT 1",
        's',
        [$email]
    );

    if (empty($rows)) {
        echo "Email tidak ditemukan! <a href='/api/loginForm.php'>Kembali</a>";
        exit;
    }

    $data = $rows[0];

    if (!password_verify($password, $data['password'])) {
        echo "Password salah! <a href='/api/loginForm.php'>Kembali</a>";
        exit;
    }

    $token = base64_encode($data['id'] . '|' . $data['role'] . '|' . $data['email']);
    setcookie('auth_token', $token, time() + 3600, '/', '', false, true);

    if ($data['role'] == 'admin') {
        header("Location: /api/dashboardadmin.php");
    } else {
        header("Location: /api/dashboard.php");
    }
    exit;

} catch (RuntimeException $e) {
    echo "<b>ERROR LENGKAP:</b> " . $e->getMessage() . "<br>";
    echo "<b>File:</b> " . $e->getFile() . "<br>";
    echo "<b>Line:</b> " . $e->getLine() . "<br>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}
?> 