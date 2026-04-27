<?php
ob_start();

// Hapus cookie auth_token
setcookie('auth_token', '', time() - 3600, '/');

header("Location: /api/loginForm.php");
exit();
?>